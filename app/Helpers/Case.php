<?php

use App\Models\Mongo;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

    function move_case($detail){
        $patient_hn = $detail->move_hn;
        $upper      = strtoupper($patient_hn);
        $lower      = strtolower($patient_hn);

        // old data
        $case = (object) Mongo::table('tb_case')->where('_id',$detail->case_id)->first();
        $procedure = (object) Mongo::table('tb_procedure')->where('code', $detail->procedure_code)->first();
        $user = (object) Mongo::table('users')->where('uid', intval($detail->physician_id))->first();
        $patient = (object) Mongo::table('tb_patient')->where('hn', $upper)->orWhere('hn', $lower)->first();

        $val['caseuniq']       = date("ymdHis");
        $val['updatetime']     = date("ymdHis");
        $val['comcreate']      = getCONFIG("admin")->com_name;

        // // /// Patient ///
        $str['patientname']         = $patient->firstname." ".$patient->lastname;
        $str['hn']                  = $patient->hn;
        $str['age']                 = age($patient->birthdate);
        $json                       = jsonEncode($str);
        // /// Insert ///
        insertMEDICATION($val);
        insertPACs($val);

        // old medication data
        // $obj_id = new ObjectId($case->caseuniq);
        // $medication = Mongo::table('tb_casemedication')->where('caseuniq', $obj_id)->first();
        // updateMEDICATION($val, $medication);

        $r['case_procedurecode']      = @$procedure->code."";
        $r['hn']                      = @$patient->hn."";
        // $r['case_physicians01']       = @$case->case_physicians01."";
        $r['case_physicians01']       = @$user->uid."";
        $r['case_dateappointment']    = @$case->case_dateappointment."";
        $r['room']                    = @$case->room."";
        $r['opd']                     = @$case->opd."";
        $r['ward']                    = @$case->ward."";
        $r['refer']                   = @$case->refer."";
        $r['anes']                    = @$case->anes."";
        $r['prediagnosis']            = @$case->prediagnostic_other."";
        $r['patientid']               = @$case->patient_id."";
        $r['useropen']                = @$case->useropencase."";
        $r['righttotreatment']        = @$case->righttotreatment."";
        $r['appointment']             = @$case->appointment."";
        $r['visitno']                 = @$detail->visitno."";
        $r['accessionno']             = @$detail->accessionno."";
        $r = (object) $r;
        $cid = insertCASE($val,$r);

        // new data
        $check = (object) Mongo::table('tb_case')->where('_id', $cid)->first();

        $data['comcreate']              = @$case->comcreate;
        $data['case_hn']                = @$patient->hn."";
        $data['case_dateregister']      = @$case->case_dateregister;
        $data['case_dateappointment']   = @$case->case_dateappointment;
        $data['case_physicians01']      = @$user->uid;
        $data['case_status']            = @$case->case_status;
        $data['case_status_queue']      = @$case->case_status_queue;
        $data['case_photo']             = @$case->case_photo;
        $data['case_pdfversion']        = @$case->case_pdfversion;
        $data['case_room']              = @$case->case_room;
        $data['case_roomsort']          = @$case->case_roomsort;
        $data['ready_status']           = @$case->ready_status;
        $data['ready_comment']          = @$case->ready_comment;
        $data['case_vip']               = @$case->case_vip;
        $data['case_semi']              = @$case->case_semi;
        $data['case_booking']           = @$case->case_booking;

        $old_case = get_head((array) $case);
        $new_case = get_head((array) $check);
        $key_left = compare_head($old_case, $new_case);

        $old_case_array = (array) $case;
        foreach ($key_left as $key) {
            $js[$key] = $old_case_array[$key];
        }
        $js['hn'] = $patient->hn;
        $js['patientname'] = $str['patientname'];
        $js['age']  = @$case->age;

        Mongo::table('tb_case')->where('_id', $cid)->update($js);
        $old['case_status'] = 90;
        Mongo::table('tb_case')->where('_id',$detail->case_id)->update($old);


        $cid_old    = $detail->case_id;
        $cid_new    = (string) $cid;
        $hn         = $case->case_hn;
        $folderdate = $detail->folderdate;

        $hn_new = $check->hn;
        $hn_old = $case->case_hn;
        $folder_hnpath = htdocs("store/$hn_new/$folderdate/backup/");
        makedirfull($folder_hnpath);

        $picjson = isset($case->photo) ? $case->photo : [];

        $new_photo_arr = [];
        foreach($picjson as $index=>$pic){
            $pic = (object) $pic;
            if(isset($pic->na)){
                $photo = $pic->na;
                $new_photo = edit_photoname($cid_new, $pic->na);

                try {
                    $img = Image::make(htdocs("store/$hn_old/$folderdate/backup/$photo"));
                    $img->save(htdocs("store/$hn_new/$folderdate/backup/$new_photo"));
                    $img->destroy();
                    unlink(htdocs("store/$hn/$folderdate/backup/$photo"));

                    $img = Image::make(htdocs("store/$hn_old/$folderdate/$photo"));
                    $img->save(htdocs("store/$hn_new/$folderdate/$new_photo"));
                    $img->destroy();
                    unlink(htdocs("store/$hn/$folderdate/$photo"));
                } catch (Exception $e) {}

                $new_photo_arr[] = $pic;
                $new_photo_arr[$index]->na = $new_photo;
            }
        }

        // $exp_folderdate = explode('-', $folderdate);
        // if(isset($exp_folderdate[0])){
        //     $yearmonth = $exp_folderdate[0].$exp_folderdate[1];
        // }

        // $video_path = htdocs('recorder')."/$case->id";
        // $new_path = htdocs('recorder')."/".$check->_id;
        $ori = htdocs('store')."/$hn_old/$folderdate";
        $new = htdocs('store')."/$hn_new/$folderdate";


        $video_path = "$ori/vdo";
        $new_path = "$new/vdo";
        if($video_path){
            if(file_exists($new_path) == false){
                mkdir($new_path);
            }

            try{
                $files1 = scandir($video_path);
            } catch(Exception $e){$files1 = [];}
            foreach ($files1 as $filename) {
                $f = explode("_", $filename);
                if ($f[0] == $case->id) {
                    $f[0] = $cid;
                    $new_video_name = join("_", $f);
                    $old_video_path = $video_path."/$filename";
                    $new_video_path = $new_path."/$new_video_name";
                    try{
                        rename($old_video_path, $new_video_path);
                        $u['video'][]   =  $new_video_name;
                    } catch (Exception $e) {
                        // dd($e);
                    }
                }
            }
        }

        $preview_path = "$ori/preview";
        $preview_newpath = "$new/preview";
        if($preview_path){
            if(file_exists($preview_newpath) == false){
                mkdir($preview_newpath);
            }

            try{
                $files1 = scandir($preview_path);
            } catch(Exception $e){$files1 = [];}

            foreach ($files1 as $filename) {
                $f = explode("_", $filename);
                if ($f[0] == $case->id) {
                    $f[0] = $cid;
                    $new_pv_name = join("_", $f);
                    $old_pv_path = $preview_path."/$filename";
                    $new_pv_path = $preview_newpath."/$new_pv_name";
                    try{
                        rename($old_pv_path, $new_pv_path);
                    } catch (Exception $e) {
                        // dd($e);
                    }
                }
            }
        }


        $u['photo'] = $new_photo_arr;
        // Mongo::table('tb_case')->where('_id', $cid)->update($u);
        Mongo::table('tb_case')->where('_id', $cid_new)->update($u);

        $case_old = (object) Mongo::table('tb_case')->where('_id',$cid_old)->first();
        $case_new = (object) Mongo::table('tb_case')->where('_id',$cid_new)->first();
        $js2['case_form']        = $case_old->caseuniq;
        $js2['case_receive']     = $case_new->caseuniq;
        $js2['case_time_do']     = Carbon::now()->format('Y-m-d H:i:s');
        $data2['edit_remark']    = 'Move patient';
        $data2['edit_status']    = 1;
        $data2['edit_json']      = jsonEncode($js2);
        $data2['edit_event']     = 'CASE MOVE';
        $data2['edit_userid']    = uid();
        Mongo::table('tb_logedit')->insert($data2);

        $log['case_from']        = $case_old->caseuniq;
        $log['case_to']          = $case_new->caseuniq;
        $log['event']            = 'move case';
        logdata('tb_logcase', uid(), 'lumina move case', $log);
        return $case_new->_id;
    }

    function get_head($data_row){
        $head = array();
        foreach ($data_row as $key => $data) {
            $head[] = $key;
        }
        return $head;
    }
    function smalltext($value){
        $text = preg_replace('/[^A-Za-z0-9\-]/', '', $value);
        $text = strtolower($value);
        $text = str_replace(' ', '', $text);
        return $text;
    }

    function compare_head($old_case, $new_case){
        $compare = array();
        if(is_array($old_case) && is_array($new_case)){
            $compare = array_diff($old_case, $new_case);
        }
        return $compare;
    }

    function edit_photoname($new_case_id, $photoname){
        $new_photoname = '';
        $exp           = explode("_", $photoname);
        if(isset($exp[0])){
            $exp[0]        = $new_case_id;
            $new_photoname = join('_', $exp);
        }
        return $new_photoname;
    }

    function get_lastitem($entries) {
        $last_entry = count($entries) > 0 ? end($entries) : '-';
        if (is_array($last_entry) && isset($last_entry['when'])) {
            $today = date('Y-m-d');
            if (str_contains($last_entry['when'], $today)) {
                $last_entry = str_replace($today, 'Today', $last_entry['when']);
            } else {
                $last_entry = @$last_entry['when']."";
            }
        }
        return $last_entry;
    }




?>
