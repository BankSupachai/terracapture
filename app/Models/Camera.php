<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;
use App\Models\Server;
use Exception;

class Camera extends Model
{


    public static function scopetracking($r){
        $admin  = getCONFIG("admin");
        $room   = $admin->station_room;
        $sid    = intval($r->val);
        $scope  = SERVER::table("tb_scope")->where("scope_id",$sid)->first();
        $uid    = isset($r->uid) ? $r->uid : uid();
        if(isset($scope)){
            $rfid   = $scope["scope_rfid"];
            $serial = $scope["scope_serial"];
            if(isset($rfid) && isset($serial)){
                $val['track_rfid']      = $rfid;
                $val['track_user']      = $uid;
                $val['track_username']  = "endo";
                $val['track_time']      = date("H:i:s");
                $val['track_date']      = date("Y-m-d");
                $val['track_serial']    = $serial;
                $val['track_station']   = $room;
                $val['track_status']    = "success";
                $val['track_type']      = "capture";
                SERVER::table("tb_casetrack")->insert($val);

                $w1['scope_serial']  = $serial;
                $u['scope_status'] = 'capture';
                SERVER::table('tb_scope_update')->where($w1)->update($u);
            }
        }
    }

    public static function get_scope_config($filename, $case){
        $path        = "D:/laragon/htdocs/config/project/$filename.txt";
        $scope       = '';
        $scope2      = '';
        if(file_exists($path)){
            $content = file_get_contents($path);
            if(isset($content) && $content != ""){
                $decode = (array) jsonDecode($content);
                if(isset($decode['caseID']) && isset($decode['scope2'])){
                    if($decode['caseID'] == $case->id){
                        $scope  = isset($decode['scope']) ? $decode['scope'] : '';
                        $scope2 = isset($decode['scope2']) ? $decode['scope2'] : '';
                    } else {
                        // new case -> reset all
                        Camera::create_cameratemp($case, $path);
                    }
                } else {
                    Camera::create_cameratemp($case, $path);
                }
            }
        } else {
            Camera::create_cameratemp($case, $path);
        }

        return [$scope, $scope2];
    }

    public static function create_cameratemp($case, $path){
        $status = '';
        $write['caseID']    = @$case->id."";
        $write['hn']        = @$case->case_hn."";
        $write['procedure'] = @$case->procedurename."";
        $write['scope']     = "";
        $write['scope2']    = "";
        $enc                = jsonEncode($write);
        if(!file_put_contents($path, $enc)){
            $status = 'fail writing';
        }
        return $status;
    }

    public static function get_scopeserial(){
        $scopes = Mongo::table('tb_scope')->pluck('scope_serial')->toArray();
        return $scopes ?? [];
    }

    public static function save_room_id($room_config, $case){
        if(isset($room_config)){
            $w2[0] = array('room_name', $room_config);
            $orw[0] = array('room_id', $room_config);
            $room = Mongo::table('tb_room')->where($w2)->orWhere($orw)->first();
            if(isset($room)){
                $w1[0] = array('id', strval($case->id));
                $u['room'] = $room_config;
                Mongo::table('tb_case')->where($w1)->update($u);
            }
        }
    }


    public static function drive_percent($view){
        $ds             = disk_total_space("D:/")/1073741824;
        $ds             = intval($ds);
        $drive          = disk_free_space("D:/")/1073741824;
        $drive = intval($drive);
        $persen = ($drive*100)/$ds;
        $persen = 100-intval($persen);
        $view['drive_color'] = 'bg-success';
        if($persen>25){$view['drive_color'] = 'bg-success';}
        if($persen>50){$view['drive_color'] = 'bg-info';}
        if($persen>75){$view['drive_color'] = 'bg-warning';}
        if($persen>90){$view['drive_color'] = 'bg-danger';}
        $view['drive']  = $drive;
        $view['ds']     = $ds;
        $view['persen'] = $persen;
        return $view;
    }

    public static function config_ocr($hn, $view){
        $new_url                    = str_replace('/endoindex', '', url(''));
        $ocr_path                   = htdocs('ScreenRecord').'\\';
        $view['olympus_disabled']   = configTYPE("yuan","olympus_disabled");
        $view['fuji_disabled']      = configTYPE("yuan","fuji_disabled");
        $view['olympus_picname']    = configTYPE("yuan","olympus_ocr");
        $view['fuji_picname']       = configTYPE("yuan","fuji_ocr");
        $view['ocr_img']            = "$new_url/ScreenRecord";

        try{
            Camera::delete_img($ocr_path.$hn."_".$view['olympus_picname']);
            Camera::delete_img($ocr_path.$hn."_crop_".$view['olympus_picname']);
            Camera::delete_img(file_exists($ocr_path.$hn."_".$view['fuji_picname']));
            Camera::delete_img($ocr_path.$hn."_crop_".$view['fuji_picname']);
        } catch(Exception $e) {}
        return $view;
    }

    public static function delete_img($path){
        if(file_exists($path)){
            unlink($path);
        }
    }


    public static function config_video($filename, $cid, $view){
        $read               = (array) getCONFIG($filename);
        $config_cid         = isset($read['caseID']) && @$read['caseID']."" != "" ? $read['caseID'] : null;
        $arr['video']['1']  = [];
        $arr['video']['2']  = [];
        if($config_cid != null){
            if($config_cid == $cid){
                for ($i=1; $i <= 2; $i++) {
                    $arr['video']["$i"]['brightness']   = isset($read["brightness$i"])  ? $read["brightness$i"] : 128;
                    $arr['video']["$i"]['hue']          = isset($read["hue$i"])         ? $read["hue$i"] : 128;
                    $arr['video']["$i"]['saturation']   = isset($read["saturation$i"])  ? $read["saturation$i"] : 128;
                    $arr['video']["$i"]['sharpness']    = isset($read["sharpness$i"])   ? $read["sharpness$i"] : 128;
                    $arr['video']["$i"]['contrast']     = isset($read["contrast$i"])    ? $read["contrast$i"] : 128;
                }
            }
        }
        $view['vdo_property'] = $arr;
        return $view;
    }


    public static function loadimg($cid,$view){
        $count_img = 0;
        $dir = '../ScreenRecord';
        $str = '';

        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    $pic = explode('_',$file);
                    if($pic[0]==$cid){
                        if(substr($file,-3) == "jpg" || substr($file,-3) == "png"){
                            $count_img++;
                        }
                    }
                }
                closedir($dh);
            }
        }
        $imgall = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                $arr = array();
                while (($file = readdir($dh)) !== false) {
                    $pic = explode('_',$file);
                    if($pic[0]==$cid){
                        if(substr($file,-3) == "jpg" || substr($file,-3) == "png"){
                            $arr[] = $file;
                        }
                    }
                }
                $invert = array_reverse($arr);

                $i = 0;
                foreach ($invert as $key) {
                    $imgall[$i]['img']  = $key;
                    $imgall[$i]['num']  = $count_img;
                    $i++;
                    $count_img--;
                }
                closedir($dh);
            }
        }
        $view['imgall'] = $imgall;
        return $view;
    }


    public static function delfile($filename){
        $file = file_exists(htdocs("ScreenRecord/$filename"));

        if($file){
            unlink(htdocs("ScreenRecord/$filename"));
        }
    }

    public static function pictest_delete(){
        $dir    = exfolder("ScreenRecord");
        $files1 = scandir($dir);
        unset($files1[0]);
        unset($files1[1]);
        foreach ($files1 as $filename) {
            $f = explode("_", $filename);
            if ($f[0] == "0") {
                makedir(htdocs("store/testcamera"));
                rename(htdocs("ScreenRecord/$filename"),htdocs("store/testcamera/$filename"));
            }
        }
    }

    public static function takephoto2pic($r){
        $directory  = "ScreenRecord";
        $cid        = $r->case_id;
        $hn         = $r->hn;
        $scope      = $r->scope;
        $arr        = array();
        $picture    = array($_POST['datapic01'],$_POST['datapic02']);
        $i = 0;
        foreach($picture as $pic){
            $name_img   = $cid."_".$scope."_".$hn."_".date('YmdHis')."_".rand(1000,9999);
            file_put_contents(exfolder("$directory/$name_img.png"), file_get_contents($pic));
            $image = imagecreatefrompng(exfolder("$directory/$name_img.png"));
            imagejpeg($image, exfolder("$directory/$name_img.jpg"), 80);
            imagedestroy($image);
            unlink(exfolder("$directory/$name_img.png"));
            $arr['picname'][$i] = "$name_img.jpg";
            $arr['status'][$i]  = checkpictureblack(exfolder("$directory/$name_img.jpg"));
            $i++;
        }
        $json = jsonEncode($arr);
        echo $json;
    }

    public static function takephoto3pic($r){
        $directory  = "ScreenRecord";
        $cid        = $r->case_id;
        $hn         = $r->hn;
        $scope      = $r->scope;

        $arr = array();
        $i = 0;
        $picture = array($_POST['datapic01'],$_POST['datapic02'],$_POST['datapic03']);
        foreach($picture as $pic){
            $name_img   = $cid."_".$scope."_".$hn."_".date('YmdHis')."_".rand(1000,9999);
            file_put_contents(exfolder("$directory/$name_img.png"), file_get_contents($pic));
            $image = imagecreatefrompng(exfolder("$directory/$name_img.png"));
            //ปรับคุณภาพรูป
            imagejpeg($image, exfolder("$directory/$name_img.jpg"), 80);
            imagedestroy($image);
            unlink(exfolder("$directory/$name_img.png"));
            $arr['picname'][$i] = "$name_img.jpg";
            $arr['status'][$i]  = checkpictureblack(exfolder("$directory/$name_img.jpg"));
            $i++;
        }
        printJSON($arr);
    }

    public static function vdo1getsize($r){
        if(file_exists($r->vdoname)){
            $arr['size']    = filesize($r->vdoname);
            $arr['status']  = "ok";
        }else{
            $arr['size']    = "0";
            $arr['status']  = "not ok";
        }
        echo jsonEncode($arr);
    }

    public static function takephoto($r){
        $directory  = "ScreenRecord";
        $cid        = $r->case_id;
        $hn         = $r->hn;
        $scope      = $r->scope;
        $name_img   = $cid."_".$scope."_".$hn."_".date('YmdHis')."_".rand(100,999);
        file_put_contents(exfolder("$directory/$name_img.png"), file_get_contents($_POST['datapic']));
        $image = imagecreatefrompng(exfolder("$directory/$name_img.png"));

        //ปรับคุณภาพรูป
        imagejpeg($image, exfolder("$directory/$name_img.jpg"), 80);
        imagedestroy($image);
        unlink(exfolder("$directory/$name_img.png"));
        $arr['picname'] = "$name_img.jpg";
        $arr['status']  = checkpictureblack(exfolder("$directory/$name_img.jpg"));
        $json = jsonEncode($arr);
        echo $json;
    }

    public static function python_capture($r){
        $screenrecord = htdocs("ScreenRecord");
        fopen("$screenrecord/cap$r->source.txt", "w");
        sleep(1);  //หน่วงเวลาเพื่อนำภาพล่าสุดมาแสดง
        $files = array_merge(glob("$screenrecord/*$r->source.jpg"));
        $files = array_combine($files, array_map("filemtime", $files));
        arsort($files);

        $latest_file = key($files);
        $str = str_replace($screenrecord,"",$latest_file);
        echo $str;
    }

    public static function caseconfig($r){
        $screenrecord = htdocs("ScreenRecord");
        if(file_exists("$screenrecord/config/case$r->cid.txt")){
            $str                = file_get_contents(htdocs("ScreenRecord/config/case$r->cid.txt"));
            $config             = jsonDecode($str);
            $component          = $r->component_name;
            $config->$component = $r->value;
            $json               = jsonEncode($config);
            file_put_contents(htdocs("ScreenRecord/config/case$r->cid.txt"), $json);
        }else{
            $myfile = fopen("$screenrecord/config/case$r->cid.txt", "w");
            $config[$r->component_name] = $r->value;
            $json = jsonEncode($config);
            fwrite($myfile, $json);
        }
    }

    public static function count_img($case){
        $count_img = 0;
        $dir = htdocs("ScreenRecord");
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    $pic = explode('_', $file);
                    if ($pic[0] == @$case->id) {
                        if (substr($file, -3) == 'jpg' || substr($file, -3) == 'png') {
                            $count_img++;
                        }
                    }
                }
                closedir($dh);
            }
        }
        return $count_img;
    }


    public static function python_vdostart($r){
        $screenrecord = htdocs("ScreenRecord");
        if(isset($r->source)){
            fopen("$screenrecord/start$r->source.txt", "w");
        }else{
            fopen("$screenrecord/start0.txt", "w");
            fopen("$screenrecord/start1.txt", "w");
        }

    }
    public static function python_vdostop($r){
        $screenrecord = htdocs("ScreenRecord");
        if(isset($r->source)){
            fopen("$screenrecord/stop$r->source.txt", "w");
        }else{
            fopen("$screenrecord/stop0.txt", "w");
            fopen("$screenrecord/stop1.txt", "w");
        }
    }


    public static function another_procedure($r){
       $old_case = Datacase::first($r->old_cid);
       $val['user_in_case'] = $old_case->user_in_case;
       Mongo::table('tb_case')->where('id',$r->new_cid)->update($val);

    }

    public static function checkblack($r){
        $directory  = "ScreenRecord";
        $arr['picname'] = "$r->name_img";
        $arr['status']  = checkpictureblack(exfolder("$directory/$r->name_img"));
        $json = jsonEncode($arr);
        echo $json;
    }



    public static function scope_select($r){
        case_jsonSave($r->cid,'scope_select',$r->value);
    }
    public static function vdostop($r){
        case_jsonSave($r->cid,'vdo_status','stop');
        case_jsonSave($r->cid,'vdo_time','00:00:00');
    }
    public static function boxclick($r){
        case_jsonSave($r->cid,'boxclick',$r->value);
    }
    public static function vdostart($r){
        case_jsonSave($r->cid,'vdo_status','recording');
    }
    public static function cameraselect($r){
        case_jsonSave($r->cid,$r->forvideo,$r->usbport);
    }


    public static function finish_record($r){
        // dd($r->all());
        $feature    = getCONFIG("feature");
        $is_photocaseuniq = false;
        $w[0] = array('_id',$r->cid);
        if(@$feature->photocaseuniq){
            $is_photocaseuniq = true;
            $w[0] = array('caseuniq', $r->caseuniq);
        }
        $is_photocaseuniq ? autocrop($r->caseuniq,$r->hn) : autocrop($r->cid,$r->hn);
        $case = $is_photocaseuniq ? (object) Mongo::table('tb_case')->where('caseuniq', $r->caseuniq)->first() : Datacase::first($r->cid);
        createTEMP('tb_case',$case->caseuniq,$case->comcreate,date("ymdHis"));
        NURSEMONITORreporting($case->caseuniq);

        fastsemi($r->cid);
    }


    public static function casetoday($id){
        $w[] = array("appointment_date", date("Y-m-d"));
        $w[] = array("_id", '!=', $id);
        $w[] = array("statusjob", '!=', 'delete');
        $w[] = array("statusjob", '!=', 'cancel');
        $casetoday = (object) Mongo::table('tb_case')->where($w)->get()->unique("caseuniq");
        // dd($casetoday);
        return $casetoday;
    }

    public static function patienttest(){
        $text = "TEST CAMERA";
        $patient['hn']              = $text;
        $patient['firstname']       = $text;
        $patient['lastname']        = '';
        $patient['middlename']      = '';
        $patient['gender']          = $text;
        $patient['birthdate']       = $text;
        return $patient;
    }


}
