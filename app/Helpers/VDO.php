<?php

use App\Http\Controllers\Endocapture\ProcedureController;
use App\Models\Mongo;

// require 'vendor/autoload.php';

// $ffmpeg = FFMpeg\FFMpeg::create([
//     "ffmpeg.binaries"=>"D:\\allindex\\ffmpg\\ffmpeg.exe",
//     "ffprobe.binaries"=>"D:\\allindex\\ffmpg\\ffprobe.exe",
// ]);

function vdo_dir(){
    $str = getCONFIG("admin")->htdocs_path;
    return $str;
}

function vdo_url(){
    $str = "http://localhost/";
    return $str;
}

function moveVDO($f,$filename,$tb_case,$number_loop){
    $tb_case = Mongo::table('tb_case')->where('id',$tb_case->id)->first();
    $filenamenew = $tb_case->id."_".$tb_case->case_hn."_".$tb_case->appointment_date."_".date('His')."_".$number_loop.".mp4";
    try {
        $folder = htdocs("store/$tb_case->case_hn/$tb_case->appointment_date/vdo");
        makedirfull($folder);
        rename(exfolder("ScreenRecord/$filename"),"$folder/$filenamenew");
    } catch (\Throwable $th) {}

    if(isset($tb_case->video)){
        $vdo = $tb_case->video;
        $vdo[] = $filenamenew;
        $val2['video'] = $vdo;
    }else{
        $val2['video'] = array($filenamenew);
    }
    Mongo::table('tb_case')->where('id',$tb_case->id)->update($val2);

}

function get_video_viewer($cid){
    $videos = ProcedureController::get_vdo($cid);

    return $videos;
}

// function get_duration_recorder($_id){
//     $tb_case = (object) Mongo::table('tb_case')->where('_id', $_id)->first();
//     $duration = 0;
//     if(isset($tb_case)){
//         $video = isset($tb_case->video) ? $tb_case->video : [];
//         foreach ($video as $v) {
//             if(str_contains($v, '.jpg')){
//                 continue;
//             }
//             $folderdate         = isset($tb_case->appointment) ?  explode(' ',$tb_case->appointment)[0] : '';
//             $path               = "store/$tb_case->hn/$folderdate/vdo/$v";
//             $fullpath           = htdocs($path);
//             $cmd = "ffmpeg -i " . escapeshellarg($fullpath) . " 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//";
//             $output = shell_exec($cmd);
//             if(isset($output) && str_contains($output, ':')){
//                 list($hours, $minutes, $seconds) = explode(":", $output);
//                 $totalMinutes = $hours * 60 + $minutes + $seconds / 60;
//                 $duration = intval($duration + $totalMinutes);
//             }
//         }
//     }
//     return $duration;
// }




