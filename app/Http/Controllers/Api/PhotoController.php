<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Patient;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Exception;
use Jenssegers\Mongodb\MongodbServiceProvider;
use Image;


class PhotoController extends Controller
{
    public function get_vdo($r)
    {
        $case = Datacase::fromID($r->cid);
        $vdo = $case->video ?? [];
        $arr = [];
        $i = 0;
        foreach ($vdo ?? [] as $i => $vdo_name) {
            $vdo_url = domainname("store") . "/$case->case_hn/$case->appointment_date/vdo/$vdo_name";
            $arr[$i]['vdo_url'] = $vdo_url;
            $arr[$i]['vdo_name'] = $vdo_name;
            $i++;
        }
        printJSON($arr);
    }

    public function upload_photo($r)
    {

        $view['feature']                = getCONFIG("feature");
        if (@$view['feature']->photocaseuniq) {
            $is_photocaseuniq = true;
            $w[0] = array('caseuniq', $r->caseuniq);
        } else {
            $is_photocaseuniq = false;
            $w[0] = array('id', $r->_id);
        }

        $id         = $is_photocaseuniq ? $r->caseuniq : $r->_id;
        $case       = (object) Mongo::table('tb_case')->where($w)->first();
        $app        = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
        $scope_id   = isset($r->scope_id) ? $r->scope_id : 0;
        $hn         = isset($r->hn) ? $r->hn : '';
        $millisec   = strval(gettimeofday()['usec']);
        $sec        = str_pad(date("s"), 2, '0', STR_PAD_LEFT);
        $mili1      = isset($millisec[1]) ? $millisec[1] : 0;
        $mili       = $millisec[0] . $mili1;
        $name       = '';
        $case_vdo   = isset($case->video) ? $case->video : [];
        $only_date  = isset($case->appointment) ? explode(" ", $case->appointment)[0] : '';

        $arr['case_hn'] = $hn;

        $path = htdocs("store/$case->case_hn/$only_date/vdo");
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        if ($r->hasFile('files')) {
            $file = $r->file('files');
            $mimetype = $file->getMimeType();
            $filename = $file->getClientOriginalName();
            $filepath = $file->getPathname();
            $is_dicom = ["application/octet-stream", "application/dicom"];
            $video_ext = ['mp4', 'mov'];
            if (in_array(strtolower($file->getClientOriginalExtension()), $video_ext)) {
                $vdo      = $file;
                $name     = $id . "_$scope_id" . "_$hn" . "_" . date("dmyhis") . $sec . $mili . "." . $vdo->getClientOriginalExtension();
                $destinationPath    = htdocs('store') . "/$case->case_hn/$only_date/vdo/";
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $vdo->move($destinationPath, $name);

                if(isset($case->video)){
                    $vdo_array = is_array($case->video) ? $case->video : [];
                    $vdo_array[] = $name;
                    $val2['video'] = $vdo_array;
                } else {
                    $val2['video'] = array($name);
                }

                if ($is_photocaseuniq) {
                    Mongo::table('tb_case')->where('caseuniq', $r->caseuniq)->update($val2);
                } else {
                    Mongo::table('tb_case')->where('_id', $r->_id)->update($val2);
                }

                $storepath = htdocs('store') . "/$case->case_hn/$only_date/vdo/$name";
                $arr['path'] = $storepath;
                $arr['hn']   = $hn;
                logdata('tb_logupload', uid(), $storepath, $arr);
            } else if (in_array($mimetype, $is_dicom) || str_contains(strtolower($filename), 'dcm')) {
                $name     = $id . "_$scope_id" . "_$hn" . "_" . date("dmyhis") . $sec . $mili;
                $script      = "D:/laragon/htdocs/playground/python/pydicom/test2.py";
                $script      = "D:/allindex/dicom/create_image/convert.py";
                $process = new Process(['python', $script, $name, $filepath, $filename]);
                $process->run();
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
                $output = $process->getOutput();
                echo $output;
            } else {
                $img      = $file;
                $name     = $id . "_$scope_id" . "_$hn" . "_" . date("dmyhis") . $sec . $mili . "_1." . $img->getClientOriginalExtension();
                $destinationPath    = htdocs('ScreenRecord');
                $path = "$destinationPath\\$name";
                $storepath    = htdocs('store') . "/$hn/$app/$name";
                if (str_contains($img->getClientOriginalExtension(), 'tif')) {
                    try {
                        $path   = $destinationPath . "\\" . $id . "_$scope_id" . "_$hn" . "_" . date("dmyhis") . $sec . $mili . "_1.jpg";
                        $temp['filestart'] = $img->getPathName();
                        $temp['fileend'] = $path;
                        $json = json_encode($temp);
                        $json = base64_encode($json);
                        exec("D:/allindex/sfunction/__pycache__/tif2jpg.cpython-310.pyc $json");
                    } catch (Exception $e) {
                        dd($e);
                    }
                } else {
                    $img->move($destinationPath, $name);
                }
                $size = file_exists($path) ? filesize($path) : 0;
                $arr['path'] = $storepath;
                $arr['hn']   = $hn;
                Photo::logphoto($name, 'photoincase', $size, $arr);
                logdata('tb_logupload', uid(), $storepath, $arr);
            }
        }
    }

    public function get_screenrecord_photo($r)
    {
        $photohn        = Datacase::first($r->_id);
        $view['feature']                = getCONFIG("feature");
        if (@$view['feature']->photocaseuniq) {
            $view['havephoto']  = autocrop($photohn->caseuniq, $photohn->case_hn, true);
        } else {
            $view['havephoto']  = autocrop($photohn->_id, $photohn->case_hn, true);
        }
        echo 'success';
    }

    public function unselect_image($r)
    {
        $case           = Datacase::fromID($r->cid);
        $remove_index   = intval($r->img_index);
        foreach ($case->photo ?? [] as $in => $p) {
            $photo_index = intval($p['nu']);
            if (($photo_index > $remove_index) && ($p['ns'] != 0)) {
                $photo_index -= 1;
                $p['ns'] = intval($photo_index);
            } else if ($photo_index == $remove_index) {
                $p['ns'] = 0;
            }
            $photo[$in] = $p;
        }
        $up['photo'] = $photo;
        Mongo::table('tb_case')->where('_id', $r->cid)->update($up);
        echo 'success';
    }

    public function unselect_vdo($r)
    {
        $case           = Datacase::fromID($r->cid);
        $remove_index   = intval($r->vdo_index);
        $sub = $case->video_status ?? [];
        $sub[$remove_index] = 'hide';
        $up['video_status'] = $sub;
        Mongo::table('tb_case')->where('_id', $r->cid)->update($up);
        echo 'success';
    }

    public function get_pacs_photo($r)
    {
        $_id = isset($r->_id) ? $r->_id : null;
        if (isset($_id)) {
            $case = Mongo::table('tb_case')->where('_id', $_id)->first();
            if (isset($case)) {
                $case = (object) $case;
                $hn = isset($case->case_hn) ? $case->case_hn : '';
                $appointment = isset($case->appointment) ?  $case->appointment : '';
                $date = '';
                if (str_contains($appointment, ' ')) {
                    $date = explode(' ', $case->appointment)[0];
                    $date = str_replace('-', '', $date);
                }

                $drive = 'D:';
                $drive = 'S:';
                $path  = "$drive\\jpg\\$date\\$hn\\";
                $y = [];
                try {
                    $dir = scandir($path);
                    foreach (isset($dir) ? $dir : [] as $i => $file) {
                        if (@$file != '' && @$file != '.' && @$file != '..') {
                            $millisec   = strval(gettimeofday()['usec']);
                            $sec        = str_pad(date("s"), 2, '0', STR_PAD_LEFT);
                            $mili1      = isset($millisec[1]) ? $millisec[1] : 0;
                            $mili       = $millisec[0] . $mili1;
                            $rand       = rand(1000000, 9999999);
                            $name     = $case->id . "_0_$hn" . "_" . date("dmyhis") . $sec . $mili . "_$rand" . "_1.jpg";
                            $destinationPath    = htdocs('ScreenRecord');
                            $to_path = "$destinationPath\\$name";
                            $from_path = "$path/$file";
                            $status = $this->move_file($from_path, $to_path);
                            echo $to_path . "\n";
                            $y[] = $status;
                        }
                    }
                    return 1;
                } catch (Exception $e) {
                    return 0;
                }
            }
        }
    }

    public function move_file($path, $to)
    {
        if (copy($path, $to)) {
            //    unlink($path);
            return true;
        } else {
            return false;
        }
    }

    public function note_prepare($r)
    {
        $val["prepare01"]       = $r->txt_head01;
        $val["prepare02"]       = $r->txt_head02;
        $val["prepare03"]       = $r->txt_head03;
        $val["prepare_date01"]  = $r->date_head01;
        $val["prepare_date02"]  = $r->date_head02;
        Mongo::table("tb_casenote")->where('_id', $r->nid)->update($val);
    }



    public function save_template($r)
    {
        $val["templatename"]    = $r->templatename;
        $val["txt_head01"]      = $r->txt_head01;
        $val["txt_head02"]      = $r->txt_head02;
        $val["txt_head03"]      = $r->txt_head03;
        Mongo::table("tb_preparetemplate")->insert($val);
    }





    public function medication_update($r)
    {
        // dd($r->all());
        $tb_case            = Mongo::table('tb_case')->where('_id', $r->cid)->first();
        $w['caseuniq']      = $tb_case['caseuniq'];
        $tb_casemedication  = Mongo::table('tb_casemedication')->where($w)->first();



        if ($tb_casemedication == null) {
            $w[$r->name] = $r->value;
            Mongo::table('tb_casemedication')->insert($w);
        } else {
            Mongo::table('tb_casemedication')->where($w)->update([$r->name => $r->value]);
        }
    }





    public function medication_update2($r)
    {
        $tb_case            = Mongo::table('tb_case')->where('_id', $r->cid)->first();
        $caseuniq           =  $tb_case->caseuniq;
        $str_caseuniq       = $tb_case->caseuniq;
        $tb_casemedication  = Mongo::table('tb_casemedication')->where('caseuniq', $caseuniq)->orWhere('caseuniq', $str_caseuniq)->first();
        // dd($tb_casemedication);
        $i = 0;
        foreach ($r->key as $data) {
            $val["medication_unit"][$data]['dose'] = $r->dose[$i];
            $val["medication_unit"][$data]['unit'] = $r->unit[$i];
            $i++;
        }
        $val['select']   = isset($tb_casemedication->select) ? $tb_casemedication->select : [];
        if (isset($r->select) && @$r->select . "" == 'none') {
            $val['select'] = [];
        }
        $val['caseuniq'] = $tb_case->caseuniq;
        if (isset($tb_casemedication->comcreate)) {
            array_pop($val);
            Mongo::table('tb_casemedication')->where('caseuniq', $caseuniq)->orWhere('caseuniq', $str_caseuniq)->update($val);
        } else {
            Mongo::table('tb_casemedication')->insert($val);
        }
        Mongo::table('tb_case')->where('caseuniq', $caseuniq)->orWhere('caseuniq', $str_caseuniq)->update($val);
        echo jsonEncode($val);
    }

    public function medication_update3($r)
    {
        // dd($r->all());
        if (!isset($r->value) || @$r->value . "" == "" || @$r->type . "" == "") {
            return 'error';
        }
        $tb_case            = Mongo::table('tb_case')->where('_id', $r->cid)->first();
        $caseuniq           =  $tb_case->caseuniq;
        $str_caseuniq       = $tb_case->caseuniq;
        $tb_casemedication  = Mongo::table('tb_casemedication')->where('caseuniq', $caseuniq)->orWhere('caseuniq', $str_caseuniq)->first();

        $select             = isset($tb_casemedication->select) ? $tb_casemedication->select : [];
        if ($r->type == 'add') {
            $select[]           = $r->value;
        } else {
            $index = array_search($r->value, $select);
            if ($index !== FALSE) {
                unset($select[$index]);
            }
        }

        $select             = array_unique($select);
        $up['select']       = $select;
        Mongo::table('tb_casemedication')->where('caseuniq', $caseuniq)->orWhere('caseuniq', $str_caseuniq)->update($up);
        Mongo::table('tb_case')->where('caseuniq', $caseuniq)->orWhere('caseuniq', $str_caseuniq)->update($up);
    }

    public function case_update($r)
    {
        $val[$r->key] = $r->val;
        Mongo::table('tb_case')->where('_id', $r->cid)->update($val);
    }
    public function phototxt($r)
    {
        $tb_case    = (object) Mongo::table('tb_case')->where('_id', $r->case_id)->first();
        $ppp        = array();
        $x          = 0;
        foreach ($tb_case->photo as $j) {
            $j = (object) $j;
            $ppp[$x]['nu'] = $j->nu;
            $ppp[$x]['ns'] = $j->ns;
            $ppp[$x]['na'] = $j->na;
            $ppp[$x]['sc'] = $j->sc;
            $ppp[$x]['st'] = $j->st;
            if ($j->nu == $r->id) {
                $ppp[$x]['tx'] = $r->value . "";
            } else {
                $ppp[$x]['tx'] = $j->tx;
            }

            $x++;
        }
        $val['photo'] = $ppp;
        Mongo::table('tb_case')->where('_id', $r->case_id)->update($val);
        if ($r->value != "" && $r->value != null) {
            $wa[0] = array('auto_text', $r->value);
            $wa[1] = array('auto_textid', $r->idhtml);
            $wa[2] = array('auto_procedure', $r->procedure);
            $count = Mongo::table('tb_autotext')->where($wa)->count();
            if ($count == 0) {
                $auto['auto_procedure']  = $r->procedure;
                $auto['auto_text']       = $r->value;
                $auto['auto_textid']     = $r->idhtml;
                Mongo::table('tb_autotext')->insert($auto);
            }
        }
        echo @$r->value . "";
    }
    public function selectmainsub($r)
    {
        $cid        = $r->cid;
        $val        = $r->value;
        $phoid      = $r->photo_id;
        $tb_case    = (object) Mongo::table('tb_case')->where('_id', $cid)->first();
        $ppp = array();
        $i = 0;
        foreach ($tb_case->photo as $photo) {
            $photo = (object) $photo;
            $ppp[$i]['nu'] = $photo->nu;
            $ppp[$i]['ns'] = $photo->ns;
            $ppp[$i]['na'] = $photo->na;
            $ppp[$i]['sc'] = $photo->sc;
            $ppp[$i]['st'] = $photo->st;
            $ppp[$i]['tx'] = $photo->tx;
            if ($photo->nu == $phoid) {
                $ppp[$i]['sc'] = $val;
            }
            $i++;
        }
        $value['photo'] = $ppp;
        Mongo::table('tb_case')->where('_id', $cid)->update($value);
    }
    public function jqinputdropdown($r)
    {
        $w[0] = array('auto_textid', $r->textid);
        $w[1] = array('auto_procedure', $r->procedure);
        if ($r->value != "") {
            $w[2] = array('auto_text', 'like', '%' . $r->value . '%');
        }
        $autotext = Mongo::table('tb_autotext')->where($w)->orderby('auto_text', 'asc')->get();
        $arr = array();
        $i = 0;
        foreach ($autotext as $auto) {
            $arr[$i]['name'] = $auto->auto_text;
            $arr[$i]['value'] = $auto->auto_text;
            $i++;
        }
        printJSON($arr);
    }
    public function cancel_booking($r)
    {
        $noteid = $r->noteid;
        Mongo::table('tb_casenote')->where('_id', $noteid)->delete();
        Mongo::table('tb_booking')->where('noteid', $noteid)->delete();
    }



    function multiple_crop($r)
    {
        $image_data = isset($r->imagedata) ? $r->imagedata : '';
        if ($image_data == '') {
            return 'error';
        }
        $path = exfolder("store/$r->hn/$r->folderdate/$r->photoname");
        Image::make(file_get_contents($image_data))->save($path);
    }

    function upload_pdffile($r)
    {
        $tb_case = Datacase::fromID(@$r->_id);
        $w[] = array('caseuniq', @$r->caseuniq);
        $w[] = array('comcreate', @$r->comcreate);
        if (!isset($tb_case)) {
            $tb_case = Mongo::table('tb_case')->where($w)->first();
        }

        $tb_case = (object) $tb_case ?? null;

        $file = $r->file('files');
        if (isset($tb_case) && $file) {
            $hn   = @$tb_case->hn ?? '';
            $folderdate = explode(' ', $tb_case->appointment)[0] ?? '';
            $storepath  = htdocs('store') . "/$hn/$folderdate/pdf";
            $temppath   = $file->getPathname();
            $tempname   = $file->getFilename();

            $orifilename = $file->getClientOriginalName();
            $orifilename = str_replace(' ', '', $orifilename);
            $newfilename = "uploaded_$hn" . "_" . date("dmyhis") . ".pdf";

            $newpath     = "$storepath/$newfilename";
            $oripath     = "$temppath";

            if (!file_exists($storepath)) {
                mkdir($storepath, 0777, true);
            }

            try {
                if ($file->getClientOriginalExtension() != 'pdf') {
                    $ghostscriptpath = 'D:/allindex/compile/gxpswin64.exe';
                    if (file_exists($temppath)) {
                        if (is_readable($temppath)) {
                            $command = "$ghostscriptpath -sDEVICE=pdfwrite -sOutputFile=$newpath -dNOPAUSE $oripath";
                            exec($command, $output, $return_var);
                            if ($return_var === 0) {
                                $output = 'success';
                            }
                        }
                    }
                } else {
                    $file->move($storepath, $newpath);
                    $output = 'success';
                }
            } catch (\Exception $e) {
                dd($e);
            }

            $t['original_name'] = $orifilename ?? '';
            $t['new_name']      = $newfilename ?? '';
            $t['datetime']      = now()->format('Y-m-d H:i:s');
            $t['status']        = 'show';

            $uploaded_file      = $tb_case->uploaded_file ?? [];
            $uploaded_file[]    = $t;
            $u['uploaded_file'] = $uploaded_file;
            Mongo::table('tb_case')->where($w)->update($u);
            $arr['path'] = $storepath;
            $arr['hn']   = $hn;
            logdata('tb_logupload', uid(), 'upload_capsule', $arr);

            $return['filename'] = $newfilename;
            $return['oldname']  = $orifilename;
            $return['src'] = "$hn/$folderdate/pdf/" . $newfilename;
            echo jsonEncode($return);
        }
    }


    public function update_pdffile($r)
    {
        $w[] = array('caseuniq', @$r->caseuniq);
        $w[] = array('comcreate', @$r->comcreate);
        $case = (object) Mongo::table('tb_case')->where($w)->first();

        if (isset($case)) {
            $uploaded_file = $case->uploaded_file ?? [];
            foreach ($uploaded_file as $in => $file) {
                $name = $file['new_name'];
                if (@$r->filename == $name) {
                    $uploaded_file[$in]['status'] = 'hide';
                }
            }
            $u['uploaded_file'] = $uploaded_file;
            Mongo::table('tb_case')->where($w)->update($u);
        }
    }
}
