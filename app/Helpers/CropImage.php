<?php
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Photo;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;



function crop_avg($cid){
    $droot = $_SERVER['DOCUMENT_ROOT'];
    $screenrecord = $droot."/ScreenRecord";
    $temp = $droot.$_SERVER['PHP_SELF'];
    $temp = str_replace("index.php","assets/python/crop_avg.pyc",$temp);
    exec($temp);
    $tb_case = Mongo::table('tb_case')->where('_id',$cid)->first();
    $hn = $tb_case->case_hn;
    $folderdate = $tb_case->appointment_date;
    $photo = $tb_case->photo??[];
    $x = count($photo);
    makedirfull($droot."/store/$hn/$folderdate/backup");
    $backup_dir = $screenrecord."/backup";
    $crop_dir   = $screenrecord."/endocapture_crop";
    $backup_files   = scandir($backup_dir);
    foreach($backup_files as $file){
        if(in_array($file,$backup_files)){
            $ex = explode("_",$file);
            if($file != "." && $file != ".." && $cid == $ex[0]){
                if(file_exists($backup_dir."/".$file)){
                    rename($backup_dir."/".$file,$droot."/store/$hn/$folderdate/backup/".$file);
                }
                if(file_exists($crop_dir."/".$file)){
                    rename($crop_dir."/".$file,$droot."/store/$hn/$folderdate/".$file);
                    $photo[$x]["nu"] = $x + 1;
                    $photo[$x]['ns'] = 0;
                    $photo[$x]["na"] = $file;
                    $photo[$x]["sc"] = "";
                    $photo[$x]['st'] = 0;
                    $photo[$x]['tx'] = "";
                    $x++;
                }
            }
        }
    }
    Mongo::table('tb_case')->where('_id',$cid)->update(['photo'=>$photo]);
}







if (!function_exists('autocrop')) {
    function autocrop($cid, $hn, $need_selected=false)
    {
        $vdocount = 1;


        crop_avg($cid);



        // dd($cid, $hn, $need_selected);
        $dir= exfolder("ScreenRecord");

        $files1 = scandir($dir);
        $havephoto = false;

        unset($files1[0]);
        unset($files1[1]);
        $photo_new  = array();
        $tb_case    = Datacase::first($cid);
        if(empty($tb_case)){
            $tb_case    = (object) Mongo::table('tb_case')->where('_id', $cid)->first();
        }

        $feature    = getCONFIG("feature");
        $is_photocaseuniq = false;
        if(@$feature->photocaseuniq){
            $tb_case    = (object) Mongo::table('tb_case')->where('caseuniq', $cid)->first();
            $is_photocaseuniq = true;
        }

        if(isset($tb_case->appointment)){
            $apppoint   = explode(" ",$tb_case->appointment);
            $folderdate = $apppoint[0];
        }

        if(isset($tb_case->appointment_date) && !isset($tb_case->appointment)){
            $folderdate = $tb_case->appointment_date;
        }

        if(isset($tb_case->photo)){
            $photo_old  = $tb_case->photo;
        }else{
            $photo_old  = array();
        }

        if(@$folderdate."" == ""){
            $folderdate = date('Y-m-d');
        }

        // crop โดยการใช้ python
        $scope = getCONFIG('scope');
        $is_python_crop = $scope->crop_python ?? false;

        $x = count($photo_old);
        $camera_arr = array();
        $count_img  = 0;
        $arr_index  = 0;
        foreach ($files1 as $filename) {
            $f = explode("_", $filename);

            if ($f[0] == $cid && strpos($filename, ".mkv") == false) {

                // for split images into part (if not, line in command line will be too long)
                $count_img += 1;
                if($count_img > 50){
                    $count_img = 0;
                    $arr_index += 1;
                }

                //For create casetemp
                $val['semi']    = true;

                $havephoto      = true;
                $findvdo_mp4    = strpos($filename, ".mp4");
                $findvdo_webm   = strpos($filename, ".webm");

                makedirfull(htdocs("store/$hn/$folderdate/backup"));

                $scope = (object) Mongo::table('tb_scope')->where('scope_id', (int) $f[1])->first();
                if(isset($scope->scope_id)){array_push($camera_arr,$scope->scope_id);}

                // dd($scope->scope_autocrop);

                //ตรวจสอบไฟล์วีดีโอ
                if ($findvdo_mp4 > 10 || $findvdo_webm > 10) {
                    $vdocount++;
                    moveVDO($f,$filename,$tb_case,$count_img);
                } else {


                    if(strpos($filename, ".thu")==0){
                        $photo_new[$x]["nu"] = $x + 1;
                        $photo_new[$x]['ns'] = !$need_selected ? 0 : $x + 1;
                        $photo_new[$x]["na"] = $filename;
                        $photo_new[$x]["sc"] = "";
                        $photo_new[$x]['st'] = 0;
                        $photo_new[$x]['tx'] = "";
                        $x++;
                    }

                    $name = htdocs("ScreenRecord/$filename");


                    try {

                        if($is_python_crop){
                            $to_python['images'][$arr_index]['filename'][] = $filename;
                            if(@$scope->scope_autocrop == "inactive"){
                                $left                   = $scope->scope_left ?? 0;
                                $top                    = $scope->scope_top ?? 0;
                                $right                  = $scope->scope_right ?? 0;
                                $bottom                 = $scope->scope_bottom ?? 0;
                                $to_python['images'][$arr_index]['is_autocrop'][] = 'inactive';
                                $to_python['images'][$arr_index]['crop'][] = [$top, $bottom, $left, $right];
                            } else {
                                $to_python['images'][$arr_index]['is_autocrop'][] = 'active';
                                $to_python['images'][$arr_index]['crop'][] = [0, 0, 0, 0];
                            }
                        } else {
                            if (@$scope->scope_autocrop == "inactive") {
                                $myImage                = imagecreatefromjpeg($name);
                                list($width, $height)   = getimagesize($name);
                                $scale                  = 0.5;
                                $myImageZoom            = imagecreatetruecolor($width * $scale, $height * $scale);
                                $left                   = $scope->scope_left;   //ลดภาพด้านซ้าย
                                $top                    = $scope->scope_top;    //ลดภาพด้านบน
                                $rigth                  = $scope->scope_right;  //ลดภาพด้านขวา
                                $bottom                 = $scope->scope_bottom; //ลดภาพด้านล่าง
                                $width                  = $width - ($rigth + $left);
                                $height                 = $height - ($bottom + $top);
                                $myImageCrop            = imagecreatetruecolor($width, $height);
                                imagecopyresampled($myImageCrop, $myImage, 0, 0, $left, $top, $width, $height, $width, $height);
                                rename(htdocs("ScreenRecord/$filename"),htdocs("store/$hn/$folderdate/backup/$filename"));
                                imagejpeg($myImageCrop, htdocs("ScreenRecord/$filename"));
                                rename(htdocs("ScreenRecord/$filename"),htdocs("store/$hn/$folderdate/$filename"));
                            } else {
                                $myImage                = imagecreatefromjpeg($name);
                                list($width, $height)   = getimagesize($name);
                                $scale                  = 0.5;
                                $myImageZoom            = imagecreatetruecolor($width * $scale, $height * $scale);
                                $c                      = cropblack($name);
                                $left                   = $c[2]; //ลดภาพด้านซ้าย
                                $top                    = $c[0]; //ลดภาพด้านบน
                                $rigth                  = $c[3]; //ลดภาพด้านขวา
                                $bottom                 = $c[1]; //ลดภาพด้านล่าง
                                $width                  = $rigth - $left;
                                $height                 = $bottom - $top;

                                $wdh = $width / $height;
                                $hdw = $height / $width;

                                if ($width < 300 && $height < 300 || $wdh>1.7 || $hdw>1.7) {
                                    copy(htdocs("ScreenRecord/$filename"),htdocs("store/$hn/$folderdate/backup/$filename"));
                                    rename(htdocs("ScreenRecord/$filename"),htdocs("store/$hn/$folderdate/$filename"));
                                } else {
                                    $myImageCrop = imagecreatetruecolor($width, $height);
                                    imagecopyresampled($myImageCrop, $myImage, 0, 0, $c[2], $c[0], $c[3], $c[1], $c[3], $c[1]);
                                    rename(htdocs("ScreenRecord/$filename"),htdocs("store/$hn/$folderdate/backup/$filename"));
                                    imagejpeg($myImageCrop, htdocs("ScreenRecord/$filename"));
                                    rename(htdocs("ScreenRecord/$filename"),htdocs("store/$hn/$folderdate/$filename"));
                                }

                            }
                        }

                    } catch(\Throwable $e) {
                        try {
                            //code...
                            if(file_exists(htdocs("ScreenRecord/$filename"))){
                                copy(htdocs("ScreenRecord/$filename"),htdocs("store/$hn/$folderdate/backup/$filename"));
                                rename(htdocs("ScreenRecord/$filename"),htdocs("store/$hn/$folderdate/$filename"));
                            }
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                }
            }
        }

        $output = '';
        if($is_python_crop){
            foreach ($to_python['images']??[] as $in=>$images_arr) {
                $arr['folderdate'] = $folderdate;
                $arr['hn']         = @$hn ?? '';
                $arr['images']     = $images_arr;
                $json = jsonEncode($arr);
                $base64 = base64_encode($json);
                $output = crop_image_python($base64);
            }
        }

        if(str_contains($output, 'end') || !$is_python_crop || count($photo_new) == 0){
            if(isset($tb_case->scope)){
                $oldscope = (array) $tb_case->scope;
            }else{
                $oldscope = array();
            }


            $val['scope']   = array_unique(array_merge($oldscope,$camera_arr));
            $val['photo']   = array_merge($photo_old, $photo_new);
            if($is_photocaseuniq){
                $w[0] = array('caseuniq', $cid);
            } else {
                $w[0] = array('_id', $cid);
            }
            Mongo::table('tb_case')->where($w)->update($val);
            if(!empty($tb_case)){
                Mongo::table('tb_case')->where('caseuniq', $cid)->update($val);
            }
            // Mongo::table('tb_case')->where('_id', $cid)->update($val);

            foreach ($val['photo'] as $p) {
                $filename = isset($p['na']) ? $p['na'] : '';
                Photo::updatepath(htdocs("store/$hn/$folderdate/$filename"), $filename);
            }
        }


        return $havephoto;
    }
}


if (!function_exists('checktype_fuji1')) {
    function checktype_fuji1($path)
    {
        $image      = imagecreatefromjpeg($path);
        $info       = getimagesize($path);
        $toprightcheck = array();

        $loop = $info[0] / 10;
        for ($e = 1; $e < $loop; $e++) {
            $toprightcheck[$e] = $info[0] - ($e * 10);
        }

        $i          = 1;
        $fujitype1  = 0;
        $startpoint = 0;

        foreach ($toprightcheck as $trc) {
            $rgb[$i]    = imagecolorat($image, $trc, 30);
            $red        = ($rgb[$i] >> 16) & 255;
            $green      = ($rgb[$i] >> 8) & 255;
            $blue       =   $rgb[$i] & 255;
            $sum[$i]    = $red + $green + $blue;
            if ($i < 70) {
                if ($sum[$i] > 50 && $i > 2) {            #ปรับค่าสี 50-60 สีเขียว
                    if ($rgb[$i] == $rgb[$i - 1]) {
                        $fujitype1++;
                    }
                    $color[$i]  = "No Black";
                } else {
                    if ($i > 40 && $startpoint == 0) {
                        $startpoint = $i;
                    }
                    $color[$i]  = "Black";
                }
            }
            $i++;
        }

        if ($fujitype1 > 28) {
            $info[0] = $info[0] - ($startpoint * 10);
            $info[4] = "Fuji_type_1";
        } else {
            $info[4] = "Normal";
        }
        return $info;
    }
}

if (!function_exists('checktype_fuji2')) {
    function checktype_fuji2($path)
    {
        $image      = imagecreatefromjpeg($path);
        $info       = getimagesize($path);
        $toprightcheck = array();

        $loop = (($info[0] / 10) / 2);
        for ($e = 1; $e < $loop; $e++) {
            $cc = $info[0] - 500;
            if ($cc > 500) {
                $toprightcheck[$e] = ($info[0] - 500) - ($e * 10);
            }
        }

        $i          = 1;
        $fujitype1  = 0;
        $startpoint = 0;

        foreach ($toprightcheck as $trc) {
            $rgb[$i]    = imagecolorat($image, $trc, $info[1] - 40);
            $red        = ($rgb[$i] >> 16) & 255;
            $green      = ($rgb[$i] >> 8) & 255;
            $blue       =   $rgb[$i] & 255;
            $sum[$i]    = $red + $green + $blue;
            if ($i < 70) {
                if ($sum[$i] > 50 && $i > 2) {        #ปรับค่าสี 50-60 สีเขียว
                    if ($rgb[$i] == $rgb[$i - 1]) {
                        $fujitype1++;
                    }
                    $color[$i]  = "No Black";
                } else {
                    if ($i > 40 && $startpoint == 0) {
                        $startpoint = $i;
                    }
                    $color[$i]  = "Black";
                }
            }
            $i++;
        }

        if ($fujitype1 > 28) {
            $info[1] = $info[1] - 100;
            $pictype = "Fuji_type_2";
        } else {
            $pictype = "Normal";
        }

        return $info;
    }
}

if (!function_exists('cropblack')) {
    function cropblack($path)
    {

        $image      = imagecreatefromjpeg($path);
        $info       = checktype_fuji1($path);
        if ($info[4] == "Normal") {
            $info   = checktype_fuji2($path);
        }

        $top[0]             = 0;
        $top_mark[0]        = $info[0] / 4;
        $top_mark[1]        = $info[0] / 2;
        $top_mark[2]        = ($info[0] / 4) * 3;
        $top_value[0]       = 0;
        $top_value[1]       = 0;
        $top_value[2]       = 0;

        $button[0]          = $info[1];
        $button_value[0]    = $info[1];
        $button_value[1]    = $info[1];
        $button_value[2]    = $info[1];

        $left[0]            = $info[1] / 2;
        $left[1]            = 0;

        // dd($left, $top);
        $rigth[0]           = $info[1] / 2;
        $rigth[1]           = $info[0];

        $val[0]             = 0;
        $val[1]             = $info[1] - 10;
        $val[2]             = 0;
        $val[3]             = $info[0] - 10;
        $val[4]             = $info[0];
        $val[5]             = $info[1];


        $chmin = 100;
        $chmax = 715;


        // dd($info);

        //top 1-1
        for ($i = $top[0]; $i < $info[1]; $i = $i + 10) {
            $rgb    = imagecolorat($image, $top_mark[0], $i);
            $red    = ($rgb >> 16) & 255;
            $green  = ($rgb >> 8) & 255;
            $blue   = $rgb & 255;
            $sum    = $red + $green + $blue;
            if ($sum > $chmin && $sum < $chmax) {
                break;
            }
            $top_value[0] = $top_value[0] + 10;
        }

        //top 1-2
        for ($i = $top[0]; $i < $info[1]; $i = $i + 10) {
            $rgb    = imagecolorat($image, $top_mark[1], $i);
            $red    = ($rgb >> 16) & 255;
            $green  = ($rgb >> 8) & 255;
            $blue   = $rgb & 255;
            $sum    = $red + $green + $blue;
            if ($sum > $chmin && $sum < $chmax) {
                break;
            }
            $top_value[1] = $top_value[1] + 10;
        }

        //top 1-3
        for ($i = $top[0]; $i < $info[1]; $i = $i + 10) {
            $rgb    = imagecolorat($image, $top_mark[2], $i);
            $red    = ($rgb >> 16) & 255;
            $green  = ($rgb >> 8) & 255;
            $blue   = $rgb & 255;
            $sum    = $red + $green + $blue;
            if ($sum > $chmin && $sum < $chmax) {
                break;
            }
            $top_value[2] = $top_value[2] + 10;
        }

        sort($top_value);
        $val[0] = $top_value[0];


        //button 1-1
        for ($i = $info[1] - 10; $i > 0; $i = $i - 10) {
            $rgb    = imagecolorat($image, $top_mark[0], $i);
            $red    = ($rgb >> 16) & 255;
            $green  = ($rgb >> 8) & 255;
            $blue   = $rgb & 255;
            $sum    = $red + $green + $blue;
            if ($sum > $chmin && $sum < $chmax) {
                break;
            }
            $button_value[0] = $button_value[0] - 10;
        }

        //button 1-2
        for ($i = $info[1] - 10; $i > 0; $i = $i - 10) {
            $rgb    = imagecolorat($image, $top_mark[1], $i);
            $red    = ($rgb >> 16) & 255;
            $green  = ($rgb >> 8) & 255;
            $blue   = $rgb & 255;
            $sum    = $red + $green + $blue;
            if ($sum > $chmin && $sum < $chmax) {
                break;
            }
            $button_value[1] = $button_value[1] - 10;
        }

        //button 1-3
        for ($i = $info[1] - 10; $i > 0; $i = $i - 10) {
            $rgb    = imagecolorat($image, $top_mark[2], $i);
            $red    = ($rgb >> 16) & 255;
            $green  = ($rgb >> 8) & 255;
            $blue   = $rgb & 255;
            $sum    = $red + $green + $blue;
            if ($sum > $chmin && $sum < $chmax) {
                break;
            }
            $button_value[2] = $button_value[2] - 10;
        }

        rsort($button_value);
        $val[1] = $button_value[0];

        //left
        for ($i = 0; $i < $info[0]; $i = $i + 10) {
            $rgb    = imagecolorat($image, $i, $left[0]);
            $red    = ($rgb >> 16) & 255;
            $green  = ($rgb >> 8) & 255;
            $blue   = $rgb & 255;
            $sum    = $red + $green + $blue;
            // if ($sum > 60 && $sum < 715) {
            //     break;
            // }

            // if ($sum < 715) {break;}
            if ($sum > $chmin) {

                // dd($i,$sum,$chmin);
                //เพิ่มการตรวจจับตัวอักษร
                $alphabet = 0;
                for ($e = 0; $e < 20; $e++) {
                    $newpoint = $e+$i;
                    $rgb    = imagecolorat($image, $newpoint, $left[0]);
                    $red    = ($rgb >> 16) & 255;
                    $green  = ($rgb >> 8) & 255;
                    $blue   = $rgb & 255;
                    $sum2    = $red + $green + $blue;
                    if ($sum2 > 60) {
                        $alphabet++;
                    }
                }
                if($alphabet>15){break;}

            }
            $val[2] = $val[2] + 10;
        }

        //right
        for ($i = $info[0] - 10; $i > 0; $i = $i - 10) {
            $rgb    = imagecolorat($image, $i, $left[0]);
            $red    = ($rgb >> 16) & 255;
            $green  = ($rgb >> 8) & 255;
            $blue   = $rgb & 255;
            $sum    = $red + $green + $blue;

            // if ($sum > 60 && $sum < 715) {break;}
            if ($sum > $chmin) {
                //เพิ่มการตรวจจับตัวอักษร
                $alphabet = 0;
                for ($e = 0; $e < 20; $e++) {
                    $newpoint = $i-$e;
                    $rgb    = imagecolorat($image, $newpoint, $left[0]);
                    $red    = ($rgb >> 16) & 255;
                    $green  = ($rgb >> 8) & 255;
                    $blue   = $rgb & 255;
                    $sum2    = $red + $green + $blue;
                    if ($sum2 > 60) {
                        $alphabet++;
                    }
                }
                if($alphabet>15){break;}
            }



            $val[3] = $val[3] - 10;
        }

        return $val;
    }
}

function checkpictureblack($path){
    if(@getCONFIG("admin")->checkphotoblack){
        $image      = imagecreatefromjpeg($path);
        $info       = getimagesize($path);
        $toprightcheck = array();

        $loop = $info[0] / 10;
        for ($e = 1; $e < $loop; $e++) {
            $toprightcheck[$e] = $info[0] - ($e * 10);
        }
        $color = "black";
        $blue_sum = 0;
        $i = 1;
        foreach ($toprightcheck as $trc) {
            $rgb[$i]    = imagecolorat($image, $trc, 30);
            $red        = ($rgb[$i] >> 16) & 255;
            $green      = ($rgb[$i] >> 8) & 255;
            $blue       = $rgb[$i] & 255;
            $sum[$i]    = $red + $green + $blue;
            $blue_sum   = $blue_sum+$blue;
            if ($i < 70) {
                if ($sum[$i] > 50 && $i > 2) {            #ปรับค่าสี 50-60 สีเขียว
                    $color  = "color";
                }
            }
            $i++;
        }

        if(($blue_sum/$i)>250){
            $color = "blue";
        }
    }else{
        $color = "color";
    }

    return $color;
}

function crop_image_python($base64){
    // $command = "python D:/precompile/crop/crop_image.py $base64";
    $command = "D:/allindex/compile/crop_image.exe $base64";
    // สร้าง temp folder ขึ้นมาเนื่องจาก exe ไม่สามารถทำการ overwrite TEMP ใน env ได้
    $temp_dir = base_path().'/public/temp';
    if (!file_exists($temp_dir)) {
        mkdir($temp_dir, 0777, true);
    }
    $process = new Process(explode(' ', $command));
    $process->setEnv(['TEMP' => $temp_dir, 'TMP' => $temp_dir]);
    $process->run();
    $output = $process->isSuccessful() ? $process->getOutput() : '';
    return $output;
}



