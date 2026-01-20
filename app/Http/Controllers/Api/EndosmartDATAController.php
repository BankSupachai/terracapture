<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;
use App\Models\Mongo;
use DateTime;
use DirectoryIterator;
use Exception;
use PDO;

class EndosmartDATAController extends Controller
{

    public function index(Request $r){
        $view['data'] = '';
        if(isset($r->search)){
            $view['folders'] = $this->get_folder($r);

            if($r->search=='select_folder'){
                $view['date_folder'] = @$r->date_folder."";
                $view['rows'] = $this->get_endosmartdata($r);
                $view['tb_head'] = $this->getHEAD($view['rows']);
                // dd($view);
            }
        }
        return view('endoindex.update_endosmart', $view);
    }

    public function store(Request $r){
        dd($r);
        if(isset($r->event)){

        }
    }

    public function get_folder($r){
        $subdir = [];
        try{
            $dir = scandir($r->search_path);
            foreach (isset($dir)?$dir:[] as $fol) {
                if($fol == '.' || $fol == '..' || $fol == ''){
                    continue;
                }
                $subdir[] = $fol;
            }
        } catch(Exception $e) {}
        return $subdir;
    }

    public function get_endosmartdata($r){
        $mainpath = $r->search_path;
        $fullpath = "$mainpath/$r->date_folder";
        $main_arr  = [];


        try{
            $data      = $this->getDirContents($fullpath);
            $inner_arr = $this->create_data_array();

            for ($i = 0; $i < count($data); $i++) {
                $exp         = explode("\\", $data[$i]);
                if(!str_contains(end($exp), 'jpg') && !str_contains(end($exp), '-')){
                    continue;
                }

                if(!isset($exp[6])){
                    continue;
                }

                // diff at $exp[6]
                // จัดเก็บข้อมูลแบบเก่า
                if(str_contains($exp[6], 'P-')){
                    
                    $split_hn = explode("P-", $exp[6]);
                    $hn = isset($split_hn[1]) ? $split_hn[1] : '';
                    $inner_arr = $this->set_data($exp, $inner_arr, $data[$i], true, $hn, $split_hn[0]);
                    if(isset($exp[7])){
                        if((str_contains($exp[7], '.ctl') || str_contains($exp[7], '.lay'))){
                            continue;
                        }
                    }

                    if(!isset($exp[7]) ){
                        if(str_contains($inner_arr['caseid'], 'rpt')){
                            continue;
                        }
                        $check_db = $this->check_have_in_db($inner_arr['hn'], $inner_arr['caseid'], $inner_arr);
                        $main_arr[] = $check_db;
                        $inner_arr = $this->create_data_array();
                    }

                } else if (isset($exp[7])) {
                    
                    // จัดเก็บข้อมูลแบบใหม่
                    if(!str_contains($exp[7], 'P-')){
                        continue;
                    }

                    $hn = '';
                    if(str_contains($exp[7], 'P-')){
                        $split_hn = explode("P-", $exp[7]);
                        $hn = isset($split_hn[1]) ? $split_hn[1] : '';
                    }
                    
                    $inner_arr = $this->set_data($exp, $inner_arr, $data[$i], false, $hn, $split_hn[0]);
                    if(!isset($exp[8])){
                        if(str_contains($inner_arr['caseid'], 'rpt')){
                            continue;
                        }
                        $check_db = $this->check_have_in_db($inner_arr['hn'], $inner_arr['caseid'], $inner_arr);
                        $main_arr[] = $check_db;
                        $inner_arr = $this->create_data_array();
                    }
                }
            }

            foreach ($main_arr as $key => $case) {
                $case = (array) $case;
                unset($case['_id']);
                if(@$case['DATA_FOLDER'] == '' && @$case['pathfolder']."" == '') {continue;}
                // dd($case, gettype($case));
                Mongo::table('newendosmart_data')->insert($case);
            }

            return $main_arr;

        } catch (Exception $e) {
            dd($e);
            return [];
        }

    }

    public function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    function create_data_array(){
        $data['date_operation'] = '';
        $data['procedure']      = '';
        $data['hn']             = '';
        $data['caseid']         = '';
        $data['pdf']            = [];
        $data['image']          = [];
        $data['patientname']    = '';
        $data['pathfolder']     = '';
        $data['url']            = '';
        return $data;
    }

    function check_have_in_db($hn, $case_id, $inner_arr){
        // ต้อง match ทั้ง case id  และ hn
        $data = [];
        $w[] = array('HN_ID', strval($hn));
        $w[] = array('CASE_ID', strval($case_id));
        $endosmart_data = Mongo::table('endosmart_data')->where($w)->first();

        if(isset($endosmart_data)){
            $status = true;
            foreach (isset($endosmart_data)?$endosmart_data:[] as $key => $value) {
                $data[$key] = $value;
            }
        }

        foreach($inner_arr as $key => $arr){
            $data[$key] = $arr;
        }

        return $data;
    }

    public function set_data($explode, $inner_arr, $path, $diff=false, $hn=null, $caseid=null){
        $inner_arr['date_operation'] = isset($explode[5]) ? $explode[5] : '';
        $inner_arr['procedure']      = isset($explode[6]) ? $explode[6] : '';
        $inner_arr['hn']             = isset($explode[7]) && $hn == null ? $explode[7] : $hn;
        $inner_arr['caseid']         = isset($caseid) ? $caseid : '';

        if($diff){
            $inner_arr['procedure']      = '';
            $inner_arr['hn']             = isset($hn) ? $hn : '';
        }

        if(str_contains(end($explode), 'jpg') && strlen(end($explode)) > 30){
            $status = $this->check_pdf_name($inner_arr['hn'], end($explode));
            if($status){
                $inner_arr['pdf'][] = end($explode);
            }

            if($diff && !in_array(end($explode), $inner_arr['pdf'])){
                $inner_arr['pdf'][] = end($explode);
            }
        }
        else if(str_contains(end($explode), 'jpg') && strlen(end($explode)) < 30){
            $status = $this->check_img_name($inner_arr['hn'], $explode);
            if($status){
                $inner_arr['image'][] = end($explode);
            }

            if($diff && !in_array(end($explode), $inner_arr['image'])){
                $inner_arr['image'][] = end($explode);
            }
        }
        else if(!str_contains(end($explode), 'jpg')  && str_contains(end($explode), '-')  && !str_contains(end($explode), '.lay') && !str_contains(end($explode), 'ctl') ) {
            $inner_arr['pathfolder'] = $path;
            $url = str_replace("D:\\laragon\\htdocs\\", '', $path);
            $inner_arr['url'] = $url;
        }

        return $inner_arr;
    }

    public function check_img_name($hn, $fullarr){
        $status = false;
        $count = is_array($fullarr) ? count($fullarr) : 0;
        if(is_array($fullarr)){
            if(str_contains($fullarr[$count-2], $hn) ){
                $status = true;
            }
        }
        return $status;
    }

    public function check_pdf_name($hn, $img_name){
        $status = false;
        $exp = explode("-", $img_name);
        if(isset($exp[1])){
            if($exp[1] == $hn){
                $status = true;
            }
        }
        return $status;
    }

    public static function getHEAD($arr){
        $val = array();
        foreach($arr as $data){

            foreach ($data as $key => $value){
                if($key == '_id'){
                    continue;
                }
                $val[] = $key;
            }
        }
        $val = array_values(array_unique($val));
        return $val;
    }

    public function show($id){
        $main = [];
        $hn  = $id;
        $endosmart = Mongo::table('endosmart_data')->where('hn', $hn)->get();
        foreach (isset($endosmart)?$endosmart:[] as $index => $data) {
            $data = (object) $data;
            if(isset($data->url)){
                $url = domainname($data->url);
                foreach (isset($data->pdf)?$data->pdf:[] as $pdf) {
                    echo "$url/$pdf"."<br>";
                    echo "<img src='$url/$pdf'>";
                    $main[] = "$url/$pdf";
                }

                foreach (isset($data->image)?$data->image:[] as $image) {
                    echo "$url/$image"."<br>";
                    echo "<img src='$url/$image'>";
                    $main[] = "$url/$image";
                }
            }
        }
        // dd($main);
    }

}
