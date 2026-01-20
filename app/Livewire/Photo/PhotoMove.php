<?php

namespace App\Livewire\Photo;

use Livewire\Component;
use App\Models\Mongo;

class PhotoMove extends Component
{

    public $cid;
    public $case_id;
    public $selected_hn;
    public $selected_patientname;
    public $selected_procedure;
    public $selected_photo = [];
    public $newcase_id;
    public $photo_arr = [];
    public $folderdate;
    public $folderdate_new;
    public $show_move = false;


    public function render()
    {
        $view['case']       =  (object)Mongo::table('tb_case')->where('_id', $this->cid)->first();
        $view['photo_all']  = $this->photoall($view['case']);
        $view['tb_case']    = (object) Mongo::table('tb_case')
            ->where('_id', '!=', $this->cid)
            ->where('case_hn', '!=', 'vip')
            ->where('statusjob', '!=', 'delete')
            ->where('statusjob', '!=', 'cancel')
            ->limit(100)
            ->orderBy('appointment_date', 'desc')
            ->get();
        $this->folderdate_new = $this->folderdate_new;
        $this->folderdate = $view['case']->appointment_date;
        return view('livewire.photo.photomove', $view);
    }

    public function move_photo()
    {
        $oldcase = Mongo::table('tb_case')->where('_id', $this->cid)->first();
        $newcase = Mongo::table('tb_case')->where('_id', $this->newcase_id)->first();
        $this->folderdate       = $oldcase->appointment_date;
        $this->folderdate_new   = $newcase->appointment_date;
        $this->move_photo_file($oldcase, $newcase);
        $this->casenewphotoupdate($newcase->photo ?? []);
        $this->clearphotodata($oldcase->photo ?? []);
    }


    public function photoall($case)
    {
        $temp = isset($case->photo) ? $case->photo : [];
        $arr = [];
        foreach ($temp as $key => $value) {
            if(file_exists(htdocs("store/".$case->case_hn."/".$case->appointment_date."/".$value['na']))){
                $arr[] = $value;
            }
        }
        return $arr;
    }


    public function casenewphotoupdate($photo_save)
    {
        $photo_save = $temp_case['photo'] ?? [];
        $i = count($photo_save);
        $e = $i + 1;
        foreach ($this->photo_arr as $key => $value) {
            $photo_save[$i]["nu"] = $e;
            $photo_save[$i]["ns"] = 0;
            $photo_save[$i]["na"] = $value;
            $photo_save[$i]["sc"] = "";
            $photo_save[$i]["st"] = 0;
            $photo_save[$i]["tx"] = "";
            $i++;
            $e++;
        }
        $val['photo'] = $photo_save;
        Mongo::table('tb_case')->where('_id', $this->newcase_id)->update($val);
    }


    public function clearphotodata($photo_old)
    {
        // dd($photo_old);
        foreach ($photo_old as $key2 => $value2) {
            foreach ($this->selected_photo as $value) {
                if ($value2['na'] == $value) {
                    $photo_old[$key2] = null;
                }
            }
        }

        $genphoto = array();
        $i = 0;
        $j = $i + 1;
        foreach ($photo_old as $key => $value) {
            if ($value != null) {
                $genphoto[$i] = $value;
                $genphoto[$i]['nu'] = $j;
                $i++;
                $j++;
            }
        }
        $val2['photo'] = $genphoto;

        // dd($this->cid, $val2);
        Mongo::table('tb_case')->where('_id', $this->cid)->update($val2);
        $this->selected_photo = [];
    }

    public function select_case($newcase_id)
    {
        $tb_case = Mongo::table('tb_case')->where('_id', $newcase_id)->first();
        $this->selected_hn = $tb_case->case_hn;
        $this->selected_patientname = $tb_case->patientname;
        $this->selected_procedure = $tb_case->procedurename;
        $this->newcase_id = $newcase_id;
        $this->show_move = true;
    }

    public function move_photo_file($oldcase, $newcase)
    {
        foreach ($this->selected_photo as $photo) {
            $photoname_old[]    = $photo;
            $photoname_new      = $this->renamephoto($photo, $newcase->case_hn);
            $old_photo_folder   = htdocs("store/" . $oldcase->case_hn . "/" . $oldcase->appointment_date . "/");
            $new_photo_folder   = htdocs("store/" . $newcase->case_hn . "/" . $newcase->appointment_date . "/");
            makedirfull($new_photo_folder . "backup/");
            try {
                rename($old_photo_folder . $photo, $new_photo_folder . $photoname_new);
                rename($old_photo_folder . "backup/" . $photo, $new_photo_folder . "backup/" . $photoname_new);
            } catch (\Exception $e) {
            }
            $this->photo_arr[] = $photoname_new;
        }
    }

    public function renamephoto($photo, $newcase_hn)
    {
        $ex = explode("_", $photo);
        return $this->newcase_id . "_" . $ex[1] . "_" . $newcase_hn . "_" . $ex[3] . "_" . @$ex[4];
    }
}
