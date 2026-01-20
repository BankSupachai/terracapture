<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Endocapture\ProcedureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Server;
use App\Models\Fileconfig;

class CaseController extends Controller
{

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $this->$event($r);
        }
    }



    public function compare_photo($r)
    {
        $case01 = Mongo::table('tb_case')->where('id',$r->cid)->first();
        $case02 = Mongo::table('tb_case')->where('id',$r->cid_02)->first();

        $photo01 = $case01->photo ?? [];
        $photo02 = $case02->photo ?? [];

        $photo_array = array();
        $photo_array['photoname01'] = [];
        $photo_array['photoname02'] = [];

        if (is_array($photo01)) {
            foreach ($photo01 as $key => $value) {
                if (isset($value['na'])) {
                    $photo_array['photoname01'][] = $value['na'];
                }
            }
        }

        if (is_array($photo02)) {
            foreach ($photo02 as $key => $value) {
                if (isset($value['na'])) {
                    $photo_array['photoname02'][] = $value['na'];
                }
            }
        }

        $photo_array['case01'] = $case01;
        $photo_array['case02'] = $case02;


        echo json_encode($photo_array);
    }
    public function compare_video($r)
    {
        $case01 = Mongo::table('tb_case')->where('id',$r->cid)->first();
        $case02 = Mongo::table('tb_case')->where('id',$r->cid_02)->first();

        $video01 = $case01->video ?? [];
        $video02 = $case02->video ?? [];

        $video_array = array();
        $video_array['videoname01'] = [];
        $video_array['videoname02'] = [];

        if (is_array($video01)) {
            foreach ($video01 as $videoname) {
                if (!empty($videoname)) {
                    $video_array['videoname01'][] = $videoname;
                }
            }
        }

        if (is_array($video02)) {
            foreach ($video02 as $videoname) {
                if (!empty($videoname)) {
                    $video_array['videoname02'][] = $videoname;
                }
            }
        }

        $video_array['case01'] = $case01;
        $video_array['case02'] = $case02;

        echo json_encode($video_array);
    }







    public function statuschange($r){
        $feature = getCONFIG("feature");
        $case = (object) Mongo::table("tb_case")->where('_id',$r->cid)->first();
        if($feature->queue){
            if($r->datatype=="Operation"){
                $room_id = 3;//Mockup ค่า
                NURSEMONITORoperation($case->case_hn,$case->caseuniq,$room_id);
            }

            if($r->datatype=="Recovery"){
                NURSEMONITORreporting($case->caseuniq);
            }
            queuesystem($r->hn,$r->datatype);
        }
    }




    public function go2folder($r)
    {
        $path = "D:\\laragon\\htdocs\\config\\views\\pdfhead\\$r->folder";
        exec("EXPLORER /E,$path");
    }




    public function jsonboxSAVE($r)
    {
        Datacase::jsonUPDATE($r->cid, $r->ele, $r->val);
    }


    public function get_casedata($r)
    {
        $case = DB::table('tb_case')->where("case_id", $r->cid)->first();
        $json = $case->case_json;
        echo $json;
    }

    public function update_rapid($r)
    {
        $case               = DB::table('tb_case')->where("case_id", $r->cid)->first();
        $json               = jsonDecode($case->case_json);
        $json->rapid        = $r->rapid;
        $json->rapid_other  = $r->rapid_other;
        $val['case_json']   = jsonEncode($json);
        DB::table('tb_case')->where("case_id", $r->cid)->update($val);
    }

    public function get_caseviewer($r)
    {
        if (!isset($r->case_id) || !isset($r->hn) || !isset($r->is_endosmart)) {
            return 'error';
        } else {

            if ($r->is_endosmart == 'true') {
                $w[]  = array('id', $r->case_id);
                $w[]  = array('hn', $r->hn);
                $case = Server::table('newendosmart_data')->where($w)->first();

                if (isset($case)) {
                    $case['photo']          = [];
                    $case['is_endosmart']   = 'true';
                    $case['video'] = [];
                    $case['case_pdfversion'] = [];
                    // $url = domainname($case['url']);
                    // $url = "https://endocapture.siph.com/".$case['url'];
                    $file_path = $case['url'] ?? "";
                    $config     = getCONFIG("admin");
                    $url        = !empty($config->endosmart_url) ? $config->endosmart_url.$file_path.'/' : domainname('store').'/';
                    foreach (isset($case['pdf']) ? $case['pdf'] : [] as $pdf) {
                        $case['case_pdfversion'][] = $url.$pdf;
                    }
                    foreach (isset($case['image']) ? $case['image'] : [] as $img) {
                        $case['photo'][] = $url.$img;
                    }
                }
            } else {
                $w[]  = array('_id', $r->case_id);
                $w[]  = array('case_hn', $r->hn);
                $case = Server::table('tb_case')->where($w)->first();
                // dump($w,$case,$r);
                // $case['video'] = ProcedureController::get_vdo_server($r->case_id);
                $case->video = $case->video??[];
                $case->is_endosmart   = 'false';
            }
            echo isset($case) ? json_encode($case) : jsonEncode('error');
        }
    }

    public function checkfileexist($r){
        $filename = isset($r->filename) ? $r->filename : '';
        if($filename == '') {return '';}
        $hn         = $r->hn;
        $folderdate = $r->folderdate;
        $istest     = $r->istest;
        // $servername = Server::$servername;
        // $host       = config("database.connections.$servername.host");
        $config       = (object) getCONFIG('admin');
        $config_host  = isset($config->server_url) ? $config->server_url : '';
        $host         = $istest == 'test' ? "https://endocapturetest.siph.com/" : "https://endocapture.siph.com/";
        $data['type']   = str_contains($filename, '.mp4') ? "video" : 'photo';
        $is_video   = $data['type'] == 'video' ? 'vdo/' : '';
        // $admin      = getCONFIG("admin");
        // $host    = $admin->server_name;
        $fullPath = "$host/store/$hn/$folderdate/$is_video$filename";
        // $data['status'] = @file_get_contents($fullPath) ? "true" : "false";
        // $data['status'] = @$this->fileExists($fullPath) ? "true" : "false";
        $data['status'] = connectweb($fullPath) != false ?  "true" : "false";
        $data['type']   = str_contains($filename, '.mp4') ? "video" : 'photo';
        echo jsonEncode($data);

    }

    // function fileExists($url) {
    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_NOBODY, true);
    //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_HEADER, false);
    //     // Execute the cURL request
    //     curl_exec($ch);
    //     // Check HTTP response code
    //     $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //     // Close cURL session
    //     curl_close($ch);
    //     // Check if the request was successful (HTTP 200)
    //     return ($responseCode == 200);
    // }











    public function filter_caselist($r){
        $w[]      = array('statusjob', '!=', 'delete');
        $w[]      = array('statusjob', '!=', 'cancel');
        $w[]      = array('case_status', '!=', 90);

        $lumina = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
        $def_dep = isset($lumina->default_department) ? $lumina->default_department : "OR";
        $w[]      = array('department', $def_dep);

        if(isset($r->patient_id)){
            $w[] = array('case_hn', 'like', '%'.$r->patient_id.'%');
        }

        if(isset($r->patient_name)){
            $w[] = array('patientname', 'like', '%'.$r->patient_name.'%');
        }

        $tb_case  = (object) Mongo::table('tb_case')->where($w)->limit(100)->orderby("appointment","desc")->get();
        $main     = [];

        foreach (isset($tb_case)?$tb_case:[] as $index=>$case) {
            $case = (object) $case;
            $photo_empty = true;
            $video_empty = true;
            if((isset($case->photo)) || isset($case->video)){
                if(!isset($case->photo)){
                    $case->photo = [];
                }

                if(!isset($case->video)){
                    $case->video = [];
                }

                $count_video = is_array($case->video) ? count($case->video) : 0;
                $count_photo = is_array($case->photo) ? count($case->photo) : 0;
                if($count_video > 0){
                    $video_empty = false;
                }

                if($count_photo > 0){
                    $photo_empty = false;
                }

                if($video_empty && $photo_empty){
                    $main[] = $case;
                }
            } else {
                $count_video = isset($case->video) ? count($case->video) : 0;
                $count_photo = isset($case->photo) ? count($case->photo) : 0;
                $video_empty = $count_video > 0    ? false : true;
                $photo_empty = $count_photo > 0    ? false : true;
                if($video_empty && $photo_empty){
                    $case->id = strval($case->id);
                    $tb_case[$index] = $case;
                    $main[] = $case;
                }
            }


        }

        $main = collect($main);
        echo $main;
    }

    public function filter_storage($r){
        $w[]      = array('statusjob', '!=', 'delete');
        $w[]      = array('statusjob', '!=', 'cancel');
        // $w[]      = array('case_hn', '!=', '0000000000');
        $w[]      = array('case_status', '!=', 90);

        $lumina = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
        $def_dep = isset($lumina->default_department) ? $lumina->default_department : "OR";
        $w[]      = array('department', $def_dep);

        if(isset($r->patient_id)){
            $w[] = array('case_hn', 'like', '%'.$r->patient_id.'%');
        }

        if(isset($r->patient_name)){
            $w[] = array('patientname', 'like', '%'.$r->patient_name.'%');
        }

        $tb_case  = (object) Mongo::table('tb_case')->where($w)->limit(100)->orderby("appointment","desc")->get();
        $main     = [];
        foreach (isset($tb_case)?$tb_case:[] as $case) {
            $case = (object) $case;
            $photo_empty = true;
            $video_empty = true;
            if((isset($case->photo)) || isset($case->video)){
                if(!isset($case->photo)){
                    $case->photo = [];
                }

                if(!isset($case->video)){
                    $case->video = [];
                }

                $count_video = is_array($case->video) ? count($case->video) : 0;
                $count_photo = is_array($case->photo) ? count($case->photo) : 0;
                if($count_video > 0){
                    $video_empty = false;
                }

                if($count_photo > 0){
                    $photo_empty = false;
                }
            }

            if(($video_empty == false && $photo_empty == false) || ($video_empty == true && $photo_empty == false) || ($video_empty == false && $photo_empty == true)){
                $main[] = $case;
            }
        }

        $main = collect($main);
        echo $main;
    }

    public function set_casetime($r){
        $key = $r->key ?? '';
        $val = $r->val ?? '';
        $cid = $r->cid ?? '';
        if($key == 'time_start'){
            $u['statusjob'] = 'operation';
        }
        $u[$key] = $val;
        Mongo::table('tb_case')->where('_id', $cid)->update($u);
    }

    public function check_casetime($r){
        $cid = $r->cid ?? '';
        $case = Datacase::fromID($cid);
        $time_end = isset($case->datetime_end) && @$case->datetime_end."" != "" ? $case->datetime_end : null;
        $time_start = isset($case->datetime_start) && @$case->datetime_start."" != "" ? $case->datetime_start : null;
        $have_both  = (@$time_end."" != "") && (@$time_start."" != "") ? true : false;
        echo $have_both ? '' : str_replace(' ', 'T', $time_start);
    }
}
