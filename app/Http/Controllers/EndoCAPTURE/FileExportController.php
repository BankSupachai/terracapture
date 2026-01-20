<?php

namespace App\Http\Controllers\Endocapture;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Mongo;

class FileExportController extends Controller
{



    public function index(){
        // dd("mmfdkjfdlfj");
        $view["tb_case"] = Mongo::table("tb_case")->limit(500)->orderby("desc")->get();
        return view("fileexport.index",$view);
    }



    public function show($id, Request $r){

        sleep(2);
        $this->update_video($id);
        $data['statusjob']    = 'recovery';
        Mongo::table('tb_case')->where('_id',$id)->update($data);

        $view['cid'] = $id;
        $hn = 1;
        $w['case_id']       = $id;
        $tb_case            = (object) Mongo::table('tb_case')->where('_id',$id)->first();
        $view['havephoto']  = autocrop($id,$tb_case->hn);
        $tb_case            = (object) Mongo::table('tb_case')->where('_id',$id)->first();

        if(!isset($tb_case->date) && isset($tb_case->appointment_date)){
            $u['date']      = $tb_case->age;
            $tb_case->date  = $u['date'];
        }


        if(isset($tb_case->appointment_date)){
            $tb_case->date  = $tb_case->appointment_date;
        }

        if(isset($tb_case->appointment)){
            $tb_case->date  = explode(' ', $tb_case->appointment)[0];
        }

        makedirfull(htdocs("store/$tb_case->hn/$tb_case->date"));
        // makedir(htdocs("lumina/$id"));
        makedir(htdocs("store/$tb_case->hn/$tb_case->date/vdo"));
        $view['case']       = $tb_case;
        $view['case_id']    = $id;
        // $view['path']       = "lumina/$id";
        $path               = "store/$tb_case->hn/$tb_case->date/vdo";
        // $videos             = $this->getrecorder($id);
        $videos             = isset($tb_case->video) ? $tb_case->video : [];
        $view['videos']     = $this->get_video_url($videos, $path, []);
        if(count($view['videos']) == 0){
            $videos         = $this->getrecorder($id, true);
            $path           = "lumina/$id";
            $view['videos'] = $this->get_video_url($videos, $path, $view['videos']);
        }


        return view('fileexport.show', $view);

    }

    public function getrecorder($id, $is_recorder=false){
        $case           = (object) Mongo::table('tb_case')->where('_id',$id)->first();
        $operation_date = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
        // $video_path = "D:/laragon/htdocs/recorder/$_id";
        $video_path     = $is_recorder==false ? htdocs("store")."/$case->hn/$operation_date/vdo" : "D:/laragon/htdocs/recorder/$id";
        $arr = array();
        // makedir(htdocs("lumina/$id"));
        makedir($video_path);
        if ($handle = opendir($video_path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    array_push($arr, $entry);
                }
            }
            closedir($handle);
        }
        return $arr;
    }

    public function get_video_url($videos, $path, $arr){
        foreach ($videos as $vdo) {
            $arr[] = "$path/$vdo";
        }
        return $arr;
    }

    public function update_video($_id){
        $case           = (object) Mongo::table('tb_case')->where('_id',$_id)->first();
        $operation_date = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
        // $video_path = "D:/laragon/htdocs/recorder/$_id";
        $video_path     = htdocs("store")."/$case->hn/$operation_date/vdo";
        $videos     = [];
        if (file_exists($video_path) && is_dir($video_path)){
            if ($handle = opendir($video_path)) {
                while (false !== ($file = readdir($handle))) {
                    if ($file != "." && $file != "..") {
                        $videos[] = $file;
                    }
                }
                closedir($handle);
            }
        }
        $u['video'] = $videos;
        $this->vdo2db($_id);
        $w[] = array('_id', $_id);
        $data['record_end'] = date('Y-m-d H:i:s');
        $update = Mongo::table('tb_case')->where($w)->update($u);

        return $update;
    }

    public function vdo2db($id){
        $case = (object) Mongo::table('tb_case')->where('_id',$id)->first();
        // $video_path = htdocs("recorder")."/$id";
        $operation_date = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
        $video_path     = htdocs("store")."/$case->hn/$operation_date/vdo";
        $url            = domainname("store/$case->hn/$operation_date/vdo");
        // $url            = str_replace('endoindex', '', url(''));
        if (!file_exists($video_path)) {
            mkdir($video_path, 0777, true);
        }

        if($video_path){
            $files1 = scandir($video_path);
            foreach ($files1 as $filename) {
                $f = explode("_", $filename);
                if ($f[0] == $case->id) {
                    $filesize =  filesize("$video_path/$filename");
                    if($filesize>50000){
                        $checkvdo = Mongo::table("tb_casevdo")->where("vdo_name",$filename)->first();
                        if($checkvdo==null){
                            $val2['vdo_cid']     = $case->id;
                            $val2['vdo_name']    = $filename;
                            $val2['caseuniq']    = $case->caseuniq;
                            $val2['updatetime']  = $case->updatetime;
                            $val2['comcreate']   = $case->comcreate;
                            // $val2['vdo_dir']     = htdocs("recorder")."/$id";
                            // $val2['vdo_url']     = $url."/recorder/$id/".$filename;
                            $val2['vdo_dir']     = $video_path;
                            $val2['vdo_url']     = $url.'/'.$filename;
                            Mongo::table('tb_casevdo')->insert($val2);
                        }
                    }
                }
            }
        }
    }


    public function get_files($dir, $type, $hn){
        $arr = [];
        if ($handle = opendir($dir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if($type == 'vdo'){
                        $exp = explode('_', $entry);
                        if($exp[2] == $hn){
                            array_push($arr, $entry);
                        }
                    }

                    if($type == 'image'){
                        array_push($arr, $entry);
                    }
                }
            }

            closedir($handle);
        }
        return $arr;
    }

    public function store(Request $r){
        if($r->event == 'get_file_size')            {return $this->get_file_size($r);}
        if($r->event == 'get_disk')                 {return $this->get_disk($r);}
        if($r->event == 'upload_pdf')               {return $this->upload_pdf($r);}


    }

    public function print_alldrives(){
        $alphabet = str_split('EFGHIJKLMNOPQRSTUVWXYZ');
        // dd($alphabet);
        $i = 0;
        $arr = array();
        // $GB = 1024*1024*1024;
        $GB = 1073741824;
        foreach($alphabet as $drive){
            try {
                $disk_total_space   = disk_total_space("$drive:");
                $disk_free_space    = disk_free_space("$drive:");
                $arr[$i]['drive']   = "$drive:\\";
                $arr[$i]['total']   = number_format($disk_total_space/$GB,1);
                $arr[$i]['free']    = number_format($disk_free_space/$GB,1);
                $arr[$i]['used']    = number_format(($disk_total_space-$disk_free_space)/$GB,1);
            } catch (\Throwable $th) {}
        }
        printJSON($arr);
    }




    function get_disk(){
        exec('wmic logicaldisk get caption', $output);
        $disk_names = array_slice($output, 2);
        $all_disks = [];
        foreach ($disk_names as $disk) {
            if(str_contains(strtolower($disk), 'c') || str_contains(strtolower($disk), 'd')  || @$disk."" == ''){
                continue;
            }
            try {
                //code...
            $free_space = disk_free_space($disk);
            if($free_space != 0){
                $space_unit = $this->get_disk_unit($free_space);
                $sub[0] = $disk;
                $sub[1] = $space_unit;
                $sub[2] = $free_space;
                array_push($all_disks, $sub);
                $sub = [];
            }
            } catch (\Throwable $th) {
                //throw $th;
            }

        }
        return json_encode($all_disks);
    }

    function get_disk_unit($bytes) {
        $symbols = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $exp = floor(log($bytes)/log(1024));
        return sprintf('%.2f '.$symbols[$exp], ($bytes/pow(1024, floor($exp))));
    }

    public function get_file_size($r){
        $hn           = $r->hn;
        $date         = $r->date;
        $img_dir      = htdocs("store/$hn/$date");
        $vdo_dir      = htdocs("");
        $size         = 0;

        if(isset($r->images)){
            $dec = jsonDecode($r->images);
            if(count($dec) > 0){
                foreach($dec as $img){


                    $file       = "$img_dir\\$img";

                    // dd($file);
                    $file       = str_replace(Array("\n", "\r", "\n\r"), '', $file);
                    if(file_exists($file)){
                        $file_size  = filesize($file);
                        $size       = $size + intval($file_size);
                    }

                }
            }
        }


        // dd($r->videos);
        if(isset($r->videos)){
            $dec = jsonDecode($r->videos);
            if(count($dec) > 0){
                foreach ($dec as $vdo) {
                    $file = "$vdo_dir\\$vdo";
                    if(file_exists($file)){
                        $file_size  = filesize($file);
                        $size       = $size + intval($file_size);
                    }
                }
            }
        }

        $size = $size / (pow(2, 30));

        echo $size;

    }

    public function upload_pdf($r){
        $new_path = $r->disk.":\\LuminaCapture\\$r->case_hn\\$r->folderdate\\pdf\\";
        $fileurl  = domainname("endoindex/lumina/print/$r->cid");

        if (!file_exists($new_path)) {
            mkdir($new_path, 0777, true);
        }

        try{
            file_put_contents("$new_path\\$r->pdfname", file_get_contents($fileurl));
            return 'success';
        } catch (Exception $e){
            dd($e);
        }
    }
}
