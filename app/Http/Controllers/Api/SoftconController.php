<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Hash;
use App\Models\Mongo;
use PhpParser\Node\Expr\Cast\Object_;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Models\Server;
use App\Models\Booking;

class SoftconController extends Controller
{


    //Server จริง
    public $server = "http://172.16.1.137:8081/api/";

    public function sendphoto2softcon($r){
        $tb_case = Mongo::table("tb_case")->where("_id",$r->cid)->first();
        if($tb_case){
            $hn = $tb_case["case_hn"];
            $date = $tb_case["appointment_date"];

            makedirfull(htdocs("store/$hn/$date/tempsoftcon"));
            if($r->sendtype=="photo")       {$this->softcon_photo($r);}
            if($r->sendtype=="pdf")         {$this->softcon_pdf($r);}
            if($r->sendtype=="photopdf")    {$this->softcon_photopdf($r);}
            if($r->sendtype=="nursereport") {$this->softcon_nursereport($r);}

            // dd($r);
            // if(isset($tb_case['XIssueKey'])){
            //     $XIssueKey          = $tb_case['XIssueKey'];
            //     $temp["XIssueKey"]  = $XIssueKey;
            //     $temp["IsIpd"]      = $tb_case['IsIpd'];
            //     $appointment        = (Object) $temp;
            // }else{
                $appointment        = $this->appointment($tb_case['case_hn'],$tb_case['appointment_date']);
                $XIssueKey          = $appointment->XIssueKey??0;

                if($XIssueKey==0){
                    $appointment        = $this->appointmentvs($tb_case);
                    $XIssueKey          = $appointment->XIssueKey??0;
                }

                $val["XIssueKey"]   = @$appointment->XIssueKey;
                $val["IsIpd"]       = @$appointment->IsIpd;
                Mongo::table("tb_case")
                ->where("case_hn",$tb_case['case_hn'])
                ->where("appointment_date",$tb_case['appointment_date'])
                ->update($val);

            if($XIssueKey!=0){
                $this->loopphoto($tb_case,$appointment);
            }else{
                $arr["Status"]  = "Unsuccess";
                $arr["Message"] = "No appointment";
                $arr["Data"]    = "";
                printJSON($arr);
            }
        }
    }



    public function index(Request $r){
        // $moss = $this->appointment("670002786","2024-05-02");

        // $year0  = date("Y");
        // $year1  = date("Y")+1;
        // $moss = $this->order($year0.date("-m-d"),$year1.date("-m-d"));
        $order = $this->order("2024-05-16","2024-05-20");
        $this->booking($order);
        dd($order);

        $this->sendphoto2softcon($r);
        // $this->softcon_photopdf($r);

    }


    public function store(Request $r){

        if (isset($r->event)) {
            $event      = $r->event;
            $redirect   = $this->$event($r);
            return $redirect;
        }

    }


    public function updatebooking($r){
        $year0  = date("Y");
        $year1  = date("Y")+1;
        $order = $this->order($year0.date("-m-d"),$year1.date("-m-d"));
        // $order = $this->order("2024-05-16","2024-05-20");
        $this->booking($order);
        return redirect("book/cal");
    }




    public function booking($order){

        // +"HN": "630005416"
        // +"Clinic": "ห้องส่องตรวจพิเศษ"
        // +"Department": "กลุ่มงานศัลยศาสตร์"
        // +"DateTimeAppoint": "2024-05-16T11:00:00"
        // +"TitleName": "นาย"
        // +"FirstName": "กิตติกร"
        // +"LastName": "แก้วใจ"
        // +"MiddleName": ""
        // +"BirthDT": "1958-03-25T00:00:00"
        // +"GenderName": "ชาย"
        // +"AgeText": "66 ปี 1 เดือน 20 วัน "
        // +"Procedure": ""

        foreach($order as $data){
            $hn     = $data->HN;
            $date   = substr($data->DateTimeAppoint,0,-9);

            $tb_booking = Mongo::table("tb_booking")->where("hn",$hn)->where("date",$date)->first();

            // dd($tb_booking);
            if($tb_booking==null){
                $val["age"] = age(substr($data->BirthDT,0,-9));
                $val["booker"] = 2;
                $val["caim"] = "";
                $val["create_time"] = date("Ymdhis");
                $val["date"] = $date;
                $val["department"] = uget("department");
                $val["hn"] = $hn;
                $val["patient_name"] = $data->TitleName.$data->FirstName." ".$data->LastName;
                $val["patient_type"] = "service";
                $val["period"] = "am";
                $val["physician"] = 2;
                $val["physician_name"] = $data->DoctorName;
                $val["procedure"] = array();
                $val["status"] = "booking";
                $val["urgent"] = "elective";
                $val["source"] = "his";

                $this->checkpatient($data);

                // Mongo::table("tb_booking")->insert($val);
                $id = Server::table("tb_booking")->insertGetId($val);

                Booking::book2cloud($id);
            }
        }

    }


    public function checkpatient($data){

        $tb_patient = Mongo::table("tb_patient")->where("hn",$data->HN)->first();
        if($tb_patient==null){
            $gender = "1";
            if($data->GenderName!="ชาย"){$gender="2";}

            $val["allergic"]            = "";
            $val["congenital_disease"]  = "";
            $val["emer_name"]           = "";
            $val["emer_tel"]            = "";
            $val["firstname"]           = $data->FirstName;
            $val["middlename"]          = $data->MiddleName;
            $val["lastname"]            = $data->LastName;
            $val["phone"]               = null;
            $val["an"]                  = null;
            $val["citizen"]             = null;
            $val["pic"]                 = "";
            $val["email"]               = null;
            $val["prefix"]              = $data->TitleName;
            $val["hn"]                  = $data->HN;
            $val["gender"]              = $gender;
            $val["birthdate"]           = substr($data->BirthDT,0,-9);
            $val["nationality"]         = null;
            $val["regis_date"]          = null;
            $val["regis_time"]          = null;
            Mongo::table("tb_patient")->insert($val);
        }

    }





    public function loopphoto($tb_case,$appointment){
        $hn         = $tb_case['case_hn'];
        $folderdate = $tb_case['appointment_date'];
        $procedure  = $tb_case['procedurename'];
        $temppath   = htdocs("store/$hn/$folderdate/tempsoftcon");
        $allfile    = array_diff(scandir($temppath), array('.','..'));


        $data   = array();
        $i      = 0;
        foreach($allfile as $key=>$val){
            $data[$i]["fileName"]    = $procedure.$val;
            $data[$i]["base64"]      = $this->encode64($temppath,$val);
            // $i++;
            // sleep(1.2);
            $res = $this->upload($appointment,$data);
        }

        echo $res;

        $dir = htdocs("store/$hn/$folderdate/");
        $this->deleteall($dir);
    }

    public function upload($appointment,$data){
        $arr["XIssueKey"]       = $appointment->XIssueKey;
        $arr["IsIPD"]           = $appointment->IsIpd;
        // $arr["IsIPD"]           = false;
        $arr["UploadImages"]    = $data;
        $header[0]              = 'Content-Type:application/json';
        $header[1]              = 'Authorization: Bearer '.$this->gettoken();
        $post                   = jsonEncode($arr);
        $res                    = connectwebJSON($this->api("Endo/UpdateResult"),$post,$header);
        return $res;
    }



    public function encode64($temppath,$filename){
        $path   = "$temppath/$filename";
        $data   = file_get_contents($path);
        $base64 = base64_encode($data);
        return $base64;
    }



    public function api($value){
        $str = $this->server.$value;
        return $str;
    }

    public function gettoken(){
        $post["UserName"]       = "lpchendowebapi";
        $post["Password"]       = "rw4R1P%9c56V*%&QVJ@eHEH#*vcRwK";
        $post["grant_type"]     = "password";
        $header[]               = 'XApiKey:1vFHh@D6e0r11KW^1K^27e5633*w$F';
        $str                    = connectpostheader($this->api("RequestToken"),$post,$header);
        $json                   = jsonDecode($str);
        return $json->access_token;
    }

    public function appointmentres($r){
        $header[0]              = 'Content-Type:application/json';
        $header[1]              = 'Authorization: Bearer '.$this->gettoken();
        $arr['HN']              = $r->hn;
        $arr["ServiceUnitCode"] = "09948";
        $arr["Date"]            = $r->date."T00:00:00.000";
        $post                   = jsonEncode($arr);
        $res                    = connectwebJSON($this->api("Endo/Appointment"),$post,$header);
        $json                   = jsonDecode($res);
        $data                   = $json->Data??[];
        return $data;
    }

    public function appointmentvs($r){
        $hn     = $r->hn??$r['case_hn'];
        $date   = $r->date??$r['appointment_date'];


        $header[0]              = 'Content-Type:application/json';
        $header[1]              = 'Authorization: Bearer '.$this->gettoken();
        $arr['HN']              = $hn;
        $arr["ServiceUnitCode"] = "09948";
        $arr["Date"]            = $date."T00:00:00.000";
        $post                   = jsonEncode($arr);
        $res                    = connectwebJSON($this->api("Endo/AppointmentVS"),$post,$header);
        $json                   = jsonDecode($res);
        $data                   = $json->Data??[];
        return $data;
    }

    public function appointment($hn,$date){
        $header[0]              = 'Content-Type:application/json';
        $header[1]              = 'Authorization: Bearer '.$this->gettoken();
        $arr['HN']              = $hn;
        $arr["ServiceUnitCode"] = "09948";
        $arr["Date"]            = $date."T00:00:00.000";
        $post                   = jsonEncode($arr);
        $res                    = connectwebJSON($this->api("Endo/Appointment"),$post,$header);
        $json                   = jsonDecode($res);
        $data                   = $json->Data[0]??[];
        return $data;
    }



    public function order($datestart,$dateend){
        $header[0]              = 'Content-Type:application/json';
        $header[1]              = 'Authorization: Bearer '.$this->gettoken();
        $arr["ServiceUnitCode"] = "09948";
        $arr['StartDate']       = $datestart."T00:00:00.000";
        $arr["EndDate"]         = $dateend."T00:00:00.000";
        $post                   = jsonEncode($arr);
        $res                    = connectwebJSON($this->api("Endo/Order"),$post,$header);
        $json                   = jsonDecode($res);
        $data                   = $json->Data??[];
        return $data;
    }


    public function header(){
        $tokenlogin     = htdocs("config/rama/tokenlogin.txt");
        if(is_file($tokenlogin)){}else{$this->login();}
        $token          = file_get_contents($tokenlogin);
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = 'Authorization: Bearer '.$token;
        return $header;
    }


    public function softcon_pdf($r){
        $tb_case        = Mongo::table('tb_case')->where("id",$r->cid)->first();
        $hn             = $tb_case['case_hn'];
        $folderdate     = $tb_case['appointment_date'];
        makedir(htdocs("store/$hn/temp"));

        $dir    = htdocs("store/$hn/$folderdate/");
        $url    =  str_replace("&amp;","&",$r->url);
        $url    =  str_replace("+","&",$url);
        connectweb($url."&temp=true");

        $pdf_file       = htdocs("store/$hn/temp/temp.pdf");
        $arr['filein']  = $pdf_file;
        $arr['fileout'] = htdocs("store/$hn/$folderdate/tempsoftcon/0");
        $arr['type']    = "jpg";
        $arr['zoom']    = 2;
        $jsonEN         = jsonEncode($arr);
        $base64         = base64_encode($jsonEN);
        shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");
    }




    public function softcon_photopdf($r){
        $tb_case        = Mongo::table('tb_case')->where("id",$r->cid)->first();
        // dd($tb_case);
        $hn             = $tb_case['case_hn'];
        $folderdate     = $tb_case['appointment_date'];
        makedir(htdocs("store/$hn/temp"));
        $pdf_file       = htdocs("store/$hn/temp/temp.pdf");
        $url =  str_replace("&amp;","&",$r->url);
        $url =  str_replace("+","&",$url);
        connectweb($url."&temp=true");

        $arr['filein']  = $pdf_file;
        $arr['fileout'] = htdocs("store/$hn/$folderdate/tempsoftcon/0");
        $arr['type']    = "jpg";
        $arr['zoom']    = 2;
        $jsonEN         = jsonEncode($arr);
        $base64         = base64_encode($jsonEN);
        shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");

        $photoselect    = photoSELECT($tb_case['photo']);
        $dir            = htdocs("store/$hn/$folderdate/");
        $this->copyphoto($dir, $photoselect);
    }

    public function copyphoto($dir, $photoselect){
        foreach ($photoselect as $photo) {
            $pathphoto = $dir . $photo['na'];
            if (file_exists($pathphoto) == 1) {
                $pic = Image::make($pathphoto);
                $pic->save($dir . "/tempsoftcon/" . $photo['na']);
            }
        }
    }


    public function softcon_photo($r){

        $tb_case        = Mongo::table('tb_case')->where("id",$r->cid)->first();
        $hn             = $tb_case['case_hn'];
        $folderdate     = $tb_case['appointment_date'];
        makedir(htdocs("store/$hn/$folderdate/tempsoftcon"));
        $photoselect    = photoSELECT($tb_case['photo']);
        $dir            = htdocs("store/$hn/$folderdate/");
        $this->copyphoto($dir, $photoselect);
    }

    public function deleteall($dir){
        $files = glob($dir . "tempsoftcon/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
    }





    public function softcon_nursereport($r){
        $tb_case        = Mongo::table('tb_case')->where("id",$r->cid)->first();
        // dd($tb_case);
        $note   = Mongo::table("tb_casenote")
        ->where("hn",$tb_case['case_hn'])
        ->where("date",$tb_case['appointment_date'])
        ->first();

        $id = (string) $note['_id'];

        // dd($id);

        $hn     = $note['hn'];
        $date   = $note['date'];
        // shell_exec(htdocs('endoindex'). "/public/pdf/nursereport2.py $id $hn $date");
        $process = new Process(['python', htdocs('endoindex'). "/public/pdf/nursereport2.py", $id, $hn, $date]);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $file   = "D:\\laragon\\htdocs\\store\\$hn\\$date\\pdf\\nurse_".$hn."_".$date.".pdf";
        $url    = "http://localhost/store/$hn/$date/pdf/nurse_$hn"."_".$date.".pdf";
        $this->pdftemp($url,$file,$hn,$date);
    }


    public function pdftemp($url,$file,$hn,$date){

        // dd($url,$file,$hn,$date);
        makedir(htdocs("store/$hn/temp"));
        $arr['filein']  = $file;
        $arr['fileout'] = htdocs("store/$hn/$date/tempsoftcon/99");
        $arr['type']    = "jpg";
        $arr['zoom']    = 2;
        $jsonEN         = jsonEncode($arr);
        $base64         = base64_encode($jsonEN);
        shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");
    }



    // public static function book2cloud($id){
    //     $hospital                   = getCONFIG("hospital");
    //     $tb_booking                 = Server::table("tb_booking")->where("_id",$id)->first();
    //     $user                       = Server::table("users")->where("uid",$tb_booking['physician'])->first();
    //     $tb_booking['hospitalcode'] = $hospital->hospital_code;
    //     $tb_booking['doctoremail']  = "";
    //     $tb_booking['status']       = "wait";
    //     $tb_booking['uid_line']     = @$user['uid_line']."";
    //     Server::table("tb_book2cloud")->insert($tb_booking);
    // }





}
