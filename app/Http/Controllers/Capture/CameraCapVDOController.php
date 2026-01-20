<?php

namespace App\Http\Controllers\capture;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Department;
use App\Models\Mongo;

class CameraCapVDOController extends Controller
{


    public function index(Request $r)
    {
        $view['id']             = 0;
        $view['text']           = 'TEST CAMERA';
        $view['room']           = Department::room(uid());
        $view['scope']          = Department::scope(uid());
        $view['nurse']          = Department::user('nurse');
        $view['register']       = Department::user('register');
        $view['case']           = (object) array();
        $view['case']->case_hn  = 'test';
        return view('endocapture.camera.main', $view);
    }

    public function show($id,Request $r)
    {
        $view['id'] = $id;
        if(isset($id)){
            $data['case_status'] = 1;
            // DB::table('tb_case')->where('case_id',$id)->update($data);
            Mongo::table('tb_case')->where('_id',$id)->update($data);
        }

        if(@getCONFIG('admin')->station_room!=null){
            $data['case_room'] = getCONFIG('admin')->station_room;
            $tb_room = DB::table('tb_room')->where('room_id',getCONFIG('admin')->station_room)->first();
            if($tb_room!=null){
                // case_jsonSave($id,'room',$tb_room->room_name);
            }
        }

        $case = Mongo::table('tb_case')
        ->where('_id',$id)
        ->first();
        $case = (object) $case;
        $view['case']       = $case;
        $view['nurse']      = Department::user('nurse');
        $view['register']   = Department::user('register');
        $view['room']       = Department::room(uid());
        $view['modal']      = Mongo::table('tb_case')->where('hn',$case->hn)->whereDate('case_dateappointment',date('Y-m-d'))->get();


        $view['scope']      = Department::scope(uid());
        $view['patient']    = Mongo::table('tb_patient')->where('hn',$case->hn)->first();
        $view['age']        = 'ไม่ระบุ';
        $view['gender']     = 'ไม่ระบุ';
        if(isset($case->birthdate)){
            $Y              = date('Y')+543;
            $newdate        = date("$Y-m-d");
            $or             = date_create($case->birthdate);
            $te             = date_create($newdate);
            $interval       = date_diff($or, $te);
            $view['age']    = $interval->format('%Y ปี');
        }
        if(isset($case->gender)){
            if($case->gender==1){
                $view['gender'] = 'Male';
            }
            if($case->gender==2){
                $view['gender'] = 'Female';
            }
        }

        $view['json']       = [];

        // $tb_casevdo         = $this->get_vdo($r->vdo);
        // $view['vdo_url']    = $tb_casevdo->vdo_url;
        $vdo_name           = isset($r->vdo) ? $r->vdo : '';
        $operation_date     = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
        $view['vdo_url']    = domainname("store/$case->hn/$operation_date/vdo/$vdo_name");
        $vdo_dir            = htdocs("store/$case->hn/$operation_date/vdo/");
        $view['pathORI']    = str_replace("/","#",str_replace("\\","#","$vdo_dir#$vdo_name"));
        $view['pathCOPY']   = str_replace("/","#",str_replace("\\","#","$vdo_dir#00$vdo_name"));
        // $view['pathORI']    = str_replace("/","#",str_replace("\\","#","$tb_casevdo->vdo_dir#$tb_casevdo->vdo_name"));
        // $view['pathCOPY']   = str_replace("/","#",str_replace("\\","#","$tb_casevdo->vdo_dir#00$tb_casevdo->vdo_name"));

        if(isset($r->renameVDO)){
            if($r->renameVDO=="true"){
                $this->renameVDO($view);
                return redirect(url("cameracapvdo/$id?vdo=$r->vdo"));
            }
        }

        return view('capture.cameracapvdo.main', $view);
    }

    public function get_vdo($vdo_name){
        $tb_casevdo   = (object) Mongo::table('tb_casevdo')->where('vdo_name', $vdo_name)->first();
        return $tb_casevdo;
    }

    public function store(Request $r){
        if($r->event == "takephoto")        {$this->takephoto($r);}
        if($r->event == "takephoto2pic")    {$this->takephoto2pic($r);}
        if($r->event == "takephoto3pic")    {$this->takephoto3pic($r);}
        if($r->event == "change_bitrate")   {return $this->change_bitrate($r);}
        if($r->event == "get_progress")     {return $this->get_progress($r);}
        if($r->event == "pictest_delete")   {$this->pictest_delete($r); return redirect(url('home'));}
    }

    public function pictest_delete(){
        $dir    = exfolder("ScreenRecord");
        $files1 = scandir($dir);
        unset($files1[0]);
        unset($files1[1]);
        foreach ($files1 as $filename) {
            $f = explode("_", $filename);
            if ($f[0] == "0") {
                unlink($dir."/".$filename);
            }
        }
    }


    public function takephoto($r){
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
        echo $name_img;
    }

    public function takephoto2pic($r){
        $directory  = "ScreenRecord";
        $cid        = $r->case_id;
        $hn         = $r->hn;
        $scope      = $r->scope;

        $arr = array();
        $picture = array($_POST['datapic01'],$_POST['datapic02']);
        foreach($picture as $pic){
            $name_img   = $cid."_".$scope."_".$hn."_".date('YmdHis')."_".rand(1000,9999);
            file_put_contents(exfolder("$directory/$name_img.png"), file_get_contents($pic));
            $image = imagecreatefrompng(exfolder("$directory/$name_img.png"));
            //ปรับคุณภาพรูป
            imagejpeg($image, exfolder("$directory/$name_img.jpg"), 80);
            imagedestroy($image);
            unlink(exfolder("$directory/$name_img.png"));
            array_push($arr,$name_img);
        }
        printJSON($arr);
    }


    public function takephoto3pic($r){
        $directory  = "ScreenRecord/";
        $cid        = $r->case_id;
        $hn         = $r->hn;
        $scope      = $r->scope;

        $arr = array();
        $picture = array($_POST['datapic01'],$_POST['datapic02'],$_POST['datapic03']);
        foreach($picture as $pic){
            $name_img   = $cid."_".$scope."_".$hn."_".date('YmdHis')."_".rand(1000,9999);
            file_put_contents(exfolder("$directory/$name_img.png"), file_get_contents($pic));
            $image = imagecreatefrompng(exfolder("$directory/$name_img.png"));
            //ปรับคุณภาพรูป
            imagejpeg($image, exfolder("$directory/$name_img.jpg"), 80);
            imagedestroy($image);
            unlink(exfolder("$directory/$name_img.png"));
            array_push($arr,$name_img);
        }
        printJSON($arr);
    }

    public function renameVDO($view){
        $input_path = str_replace("#","\\",$view['pathORI']);
        $output_path= str_replace("#","\\",$view['pathCOPY']);
        if (file_exists($input_path) && file_exists($output_path)){
            rename($output_path,$input_path);
        }
    }

    function change_bitrate($r){
        $input_path = str_replace("#","\\",$r->vdo_input);
        $output_path= str_replace("#","\\",$r->vdo_output);
        $text_path  = "D:\\allindex\\ffmpg\\progress.txt";
        // empty ไฟล์
        file_put_contents($text_path, "");
        try{
            // set system environment variable ชี้มายังโฟล์เดอร์ที่มี ffmpeg
            // ปรับขนาดของ video ( ในที่นี้คือ 1280x720 แต่ยังไม่สามารถกำหนดขนาด bitrate ที่เจาะจงได้)
            $output = exec("D:\\allindex\\ffmpg\\ffmpeg.exe -y -i $input_path -vf scale=1920:1080 -b:v 4096k $output_path -progress $text_path");
        } catch(\Throwable $e) {
            echo 0;
        }
    }

    function get_progress($r){
        $input_path = str_replace("#","\\",$r->vdo_input);
        $text_path  = "D:\\allindex\\ffmpg\\progress.txt";
        try {
            // หา frame ทั้งหมดใน video
            $all_frame  = exec("D:\\allindex\\ffmpg\\ffprobe.exe -v error -select_streams v:0 -count_packets -show_entries stream=nb_read_packets -of csv=p=0 $input_path");
            $array      = explode("\n", file_get_contents($text_path));
            $frame      = '0';
            foreach ( $array as $line){
                if(str_contains($line, 'frame=')){
                    $frame = str_replace('frame=', '', $line);
                }
            }
            $frame = intval($frame);
            $percent = ($frame / (intval($all_frame))) * 100;
            echo $percent;
        } catch(\Throwable $e) {
            echo 0;
        }
    }
}
