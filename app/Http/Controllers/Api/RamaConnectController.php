<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Hash;
use App\Models\Mongo;
use Illuminate\Support\Facades\Http;

class RamaConnectController extends Controller
{

    //Server เทส
    // public $server = "http://d-frontserv1.rama.mahidol.ac.th";

    //Server จริง
    public $server = "http://prod-frontserv1.rama.mahidol.ac.th";

    public function index()
    {
        session_start();
        // dd($_SESSION);
        $json = $_SESSION['userjson'];
        $view['user'] = $json->resultDetails;
        return view("endocapture.ramaconnect.index", $view);
    }


    public function store(Request $r)
    {

        if (isset($r->event)) {
            $event = $r->event;
            if ($event == "login") {
                $this->login();
            }
            if ($event == "user_add") {
                $this->user_add($r);
                $arr['email']       = $r->email;
                $arr['password']    = $r->password;
                if (Auth::attempt($arr)) {
                    return redirect()->intended('dashboard')->withSuccess('Signed in');
                }
            }
            if ($event == "vna_pdf") {
                $this->vna_pdf($r);
            }
            if ($event == "vna_photopdf") {
                $this->vna_photopdf($r);
            }
            if ($event == "vna_photo") {
                $this->vna_photo($r);
            }
            if ($event == "check_user_formcode") {
                $this->check_user_formcode($r);
            }

            if ($event == "check_hn") {
                $this->check_hn($r);
            }
            if ($event == "user_add_formcode") {
                $this->user_add_formcode($r);
                return view("endocapture.ramaconnect.useradd");
            }
        }
    }

    public function check_user_formcode($r)
    {
        $header         = $this->header();
        $arr['staffId'] = $r->user_code;
        $json           = jsonEncode($arr);
        $str            = connectwebJSON("$this->server/api/staffservice/getstaffinfobyid", $json, $header);

        echo $str;
    }





    public function user_add_formcode($r)
    {
        $header         = $this->header();
        $arr['staffId'] = $r->usercode;
        $json           = jsonEncode($arr);
        $str            = connectwebJSON("$this->server/api/staffservice/getstaffinfobyid", $json, $header);
        $json2          = jsonDecode($str);





        if ($json2->success) {
            $json2      = $json2->data;
            $tb_user    = Mongo::table("users")
                ->where("user_code", $json2->staffId)
                ->first();

            // dd($json2,$tb_user);

            if ($tb_user == null) {
                $count  = Mongo::table('users')
                    ->orderby('id', 'desc')
                    ->first();
                $count  = (object) $count;
                $number                 = $count->id + 1;
                $usertype               = $this->check_position($json2->positionName);
                $val['id']              = get_last_id_server('id', 'users') + 1;
                $val['department']      = "GI";
                $val['user_status']     = "active";
                $val['comname']         = "endocapture01";
                $val['tablename']       = "tb_department";
                $val['user_code']       = $json2->staffId;
                $val['user_type']       = $usertype;
                $val['user_branch']     = "";
                $val['practical']       = "";
                $val['color']           = "";
                $val['name']            = $usertype;
                $val['user_rfid']       = "";
                $val['user_prefix']     = "";
                $val['user_firstname']  = $json2->firstName;
                $val['user_lastname']   = $json2->lastName;
                $val['user_email']      = $usertype . $number;
                $val['user_config']     = "";
                $val['email']           = $usertype . $number;
                $val['phone']           = "";

                $val['password']        = Hash::make("123456");

                $val['opencase']        = "1";
                $val['remember_token']  = "";

                $val['procedure_json']  = "";
                $val['created_at']      = date("Y-m-d H:i:s");

                Mongo::table('users')->insert($val);
                $uid = DB::getPdo()->$number ?? '';
                // dd($uid);
                $this->adduserindepartments(strval($number), "GI");
                $this->adduserindepartments(strval($number), "OR");
                createTEMPMASTERDATA("users");
                createTEMPMASTERDATA("tb_department");
            }
        }
    }

    public function adduserindepartments($uid,$department){
        $tb_department = Mongo::table('tb_department')
        ->where('department_name',$department)
        ->first();
        $j1 = jsonDecode($tb_department['department_user']);
        array_push($j1,$uid);
        $v1['department_user'] = jsonEncode($j1);
        Mongo::table('tb_department')
        ->where('department_name',$department)
        ->update($v1);
    }

    public function check_position($str){
        // แพทย์
        // อาจารย์
        // พยาบาล
        // ผู้ช่วยพยาบาล
        // ผู้ปฏิบัติงานทางวิทยาศาสตร์
        // พ.ผู้ช่วยพยาบาล
        $val = "nurse";
        if($str=="แพทย์" || $str=="อาจารย์"){
            $val = "doctor";
        }
        return $val;
    }


    public function check_hn($r)
    {
        $header     = $this->header();
        $arr['mrn'] = $r->hn;
        $json       = jsonEncode($arr);
        $str        = connectwebJSON("$this->server/api/MR/Patients/GetPatientProfileByMrn", $json, $header);
        $json2      = jsonDecode($str);
        if ($json2->success) {
            $data = $json2->data;
            $birth = explode("-", $data->dateOfBirth);
            $arr['year']        = $birth[0] + 543;
            $arr['month']       = $birth[1];
            $arr['day']         = $birth[2];
            $arr['age']         = age($data->dateOfBirth);
            $arr['prefix']      = $data->titleName;
            $arr['firstname']   = $data->firstName;
            $arr['lastname']    = $data->lastName;
            $arr['status']      = true;
            if ($data->gender == "M") {
                $arr['gender'] = 1;
            } else {
                $arr['gender'] = 2;
            }
            echo jsonEncode($arr);
        }
    }

    public function check_user($r)
    {
        $header         = $this->header();
        $arr['staffId'] = $r->user_id;
        $json       = jsonEncode($arr);
        $str        = connectwebJSON("$this->server/api/staffservice/getstaffinfobyid", $json, $header);
        $json2      = jsonDecode($str);
        if ($json2->success) {
            echo $str;
            // $data = $json2->data;
            // $birth = explode("-",$data->dateOfBirth);
            // $arr['year']        = $birth[0]+543;
            // $arr['month']       = $birth[1];
            // $arr['day']         = $birth[2];
            // $arr['age']         = age($data->dateOfBirth);
            // $arr['prefix']      = $data->titleName;
            // $arr['firstname']   = $data->firstName;
            // $arr['lastname']    = $data->lastName;
            // $arr['status']      = true;
            // if($data->gender=="M"){
            //     $arr['gender'] = 1;
            // }else{
            //     $arr['gender'] = 2;
            // }
            // echo jsonEncode($arr);
        }
    }


    public function aasort(&$array, $key)
    {
        $sorter = array();
        $ret = array();
        $numarr = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va->$key;
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $numarr[] = $ii;
        }
        $numarr2 = array_reverse($numarr);
        foreach ($numarr2 as $ii) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;

        return $array;
    }



    public function login()
    {
        $ramafolder = htdocs("config/rama");
        makedir($ramafolder);
        $header[0] = 'Content-Type:application/json';
        $arr['data']['username']    = "MedicaHealthcare";
        $arr['data']['password']    = "G1Sc0pe";
        $arr['data']['appCode']     = "GI Scope";
        $post['json']               = jsonEncode($arr);
        $str        = connectwebJSON("$this->server/api/client/login", $post['json'], $header);

        // dd($str,$arr);
        $json       = jsonDecode($str);
        $tokenlogin = htdocs("config/rama/tokenlogin.txt");
        if (isset($json->data->accessToken)) {
            if (file_exists($tokenlogin)) {
                file_put_contents($tokenlogin, $json->data->accessToken);
            } else {
                $myfile = fopen($tokenlogin, "w");
                fwrite($myfile, $json->data->accessToken);
            }
        }
    }

    public function show($id, Request $r)
    {
        $this->login();

        if (isset($r->hn)) {
            $patient = $this->getpatientprofile($id);
            dd($patient);
        }

        if (isset($r->case)) {
            $patient = $this->getencounter($id);
            dd($patient);
        }

        if (isset($r->allcase)) {
            $header     = $this->header();
            $arr['mrn'] = $id;
            $json       = jsonEncode($arr);
            $str        = connectwebJSON("$this->server/api/Encounter/search/$id", $json, $header);
            $json       = jsonDecode($str);

            // $arr = ksort($json->data);
            $arr = $this->aasort($json->data, "objectId");
            dd($json, $arr, $json);
        }
        if ($id == "useradd") {
            return view('endocapture.ramaconnect.useradd');
        }
    }



    public function send2or()
    {
    }


    public function getpatientprofile($hn)
    {
        $header     = $this->header();
        $arr['mrn'] = $hn;
        $json       = jsonEncode($arr);
        $str        = connectwebJSON("$this->server/api/MR/Patients/GetPatientProfileByMrn", $json, $header);
        $json       = jsonDecode($str);
        return $json;
    }

    public function getencounter($hn)
    {
        $header     = $this->header();
        $arr['mrn'] = $hn;
        $json       = jsonEncode($arr);
        $str        = connectwebJSON("$this->server/api/Encounter/search/$hn", $json, $header);
        $json       = jsonDecode($str);
        // dd($json);
        $data = $this->aasort($json->data, "objectId");
        // ksort($json->data);
        // $data = $json->data;

        $count_data = count($json->data);

        $i      = 0;
        $found  = false;
        // dd($data,$json);

        // while($i < $count_data){
        //     if($data[$i]->encounterType=="IMP"){
        //         $encounterId    = $data[$i]->encounterId;
        //         $encounterType  = $data[$i]->encounterType;
        //         $found          = true;
        //         break;
        //     }
        //     if($data[$i]->encounterType=="AMB"){
        //         if(strpos($data[$i]->sdlocId,"GI")){
        //             $encounterId    = $data[$i]->encounterId;
        //             $encounterType  = $data[$i]->encounterType;
        //             $found          = true;
        //             break;
        //         }
        //     }
        //     if($i>20){break;}
        //     $i++;
        // }

        if (!isset($json->data[0])) {
            return '{status:"unsuccess"}';
        }


        $i      = 0;
        $found  = false;
        foreach ($json->data as $data2) {
            if ($data2->encounterType == "IMP") {
                $encounterId    = $data2->encounterId;
                $encounterType  = $data2->encounterType;
                $found          = true;
                break;
            }
            if ($data2->encounterType == "AMB") {
                if (strpos($data2->sdlocId, "GI")) {
                    $encounterId    = $data2->encounterId;
                    $encounterType  = $data2->encounterType;
                    $found          = true;
                    break;
                }
                if (strpos($data2->sdlocId, "GP")) {
                    $encounterId    = $data2->encounterId;
                    $encounterType  = $data2->encounterType;
                    $found          = true;
                    break;
                }
            }
            if ($i > 20) {
                break;
            }
            $i++;
        }






        if ($found == false) {
            $encounterId    = $json->data[0]->encounterId;
            $encounterType  = $json->data[0]->encounterType;
        }


        // +"encounterId": "2896255"
        // +"encounterType": "OTH"
        // +"enterer": "992740"
        // +"insuranceCode": "ISSI"
        // +"mrn": "3700007"

        $arr['encounterId']     = $encounterId;
        $arr['encounterType']   = $encounterType;
        return $arr;
    }

    public function header()
    {
        $tokenlogin     = htdocs("config/rama/tokenlogin.txt");
        if (is_file($tokenlogin)) {
        } else {
            $this->login();
        }
        $token          = file_get_contents($tokenlogin);
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = 'Authorization: Bearer ' . $token;
        return $header;
    }


    public function vnatest($r, $temppath, $hn)
    {

        //API เส้นเทส
        // $url = "http://envisionvna/VNA3rdpartyAPITest/api/HisRequest/UploadFileBase64";

        //API เส้นจริง
        $url = "http://envisionvna/VNA3rdpartyAPIServices/api/HisRequest/UploadFileBase64";
        // $url = "http://localhost/endocapture5.0/api/test";
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = 'Authorization: Basic Vk5BTWlyYWNsZTpSQU1BIzIwMjI='; //ค่านี้ได้มาจากโปรแกรม postman


        $encounter =  $this->getencounter($hn);

        if ($encounter == '{status:"unsuccess"}') {
            echo $encounter;
            return true;
        }


        // vnatest($r,$temppath,$hn,$encounter);
        // dd($encounter);

        if (isset($r->vna_encounter)) {
            $encounter2 = $r->vna_encounter;
        } else {
            $encounter2 = $encounter['encounterId'];
        }

        $arr['UserName']            = $r->vna_usercode;
        $arr['EncId']               = $encounter2;
        $arr['EncType']             = $encounter['encounterType'];
        $arr['StmoName']            = "Endoscope";
        $arr['ProcName']            = $r->vna_procedure;
        $arr['Comment']             = $r->vna_comment;
        $arr['RefferingPhysician']  = $r->vna_physician;
        $arr['Age']                 = $r->vna_age;
        $arr['Height']              = "";
        $arr['Weight']              = "";




        $allfile  = array_diff(scandir($temppath), array('.', '..'));
        $i = 0;
        foreach ($allfile as $key => $val) {
            $arr['Files'][$i]["Filename"]        = $val;
            $arr['Files'][$i]["FileType"]        = "image";
            $arr['Files'][$i]["FileBase64"]      = $this->encode64($temppath, $val);
            $arr['Files'][$i]["Description"]     = "none";
            $arr['Files'][$i]["DocumentDate"]    = date("Y-m-d H:i:s"); //"2022-07-21 12:22:22";
            $i++;
        }

        if($r->event=="vna_photopdf" || $r->event=="vna_photo"){
            $tb_case        = Mongo::table('tb_case')->where("id", $r->caseid)->first();
            $photoselect    = photoSELECT($tb_case['photo']);
            $hn             = $tb_case['case_hn'];
            $folderdate     = $r->folderdate;
            $temppath       = htdocs("store/$hn/$folderdate");
            foreach ($photoselect as $key => $val) {
                $arr['Files'][$i]["Filename"]        = $val['na'];
                $arr['Files'][$i]["FileType"]        = "image";
                $arr['Files'][$i]["FileBase64"]      = $this->encode64($temppath, $val['na']);
                $arr['Files'][$i]["Description"]     = "none";
                $arr['Files'][$i]["DocumentDate"]    = date("Y-m-d H:i:s"); //"2022-07-21 12:22:22";
                $i++;
            }
        }

        $json       = jsonEncode($arr);
        file_put_contents("D:/laragon/htdocs/store/vna_log.txt", $json);
        $str        = connectwebJSON($url, $json, $header);

        $this->transaction_vna($r, $str, $encounter2);

        echo $str;
    }

    public function transaction_vna($r, $str, $encounterId)
    {
        // dd($r);
        $tb_case    = Mongo::table('tb_case')->where('_id', $r->caseid)->first();
        $arr        = $tb_case['vna'] ?? [];
        $json       = jsonDecode($str);
        if (isset($tb_case['vna'])) {
            $count = count($tb_case["vna"]);
            $arr[$count]['enid'] = $encounterId;
            $arr[$count]['code'] = @$json->code . "";
            $arr[$count]['text'] = @$json->message . "";
            $arr[$count]['time'] = date("Y-m-d H:i");
        } else {
            $arr[0]['enid']  = $encounterId;
            $arr[0]['code']  = @$json->code . "";
            $arr[0]['text']  = @$json->message . "";
            $arr[0]['time']  = date("Y-m-d H:i");
        }
        $val['vna'] = $arr;

        Mongo::table('tb_case')->where('_id', $r->caseid)->update($val);
        createTEMP('tb_case', $tb_case['caseuniq'], $tb_case['comcreate'], date("ymdHis"));
    }





    public function encode64($temppath, $filename)
    {
        $path   = "$temppath/$filename";
        $type   = pathinfo($path, PATHINFO_EXTENSION);
        $data   = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }



    public function vna_pdf($r)
    {


        // $w['caseuniq']  = $r->pacs_caseuniq;
        // $w['comcreate'] = $r->pacs_comcreate;
        // $tb_case        = Mongo::table('tb_case')->where("id", $r->caseid)->first();
        $tb_case        = Mongo::table('tb_case')->where("id", $r->caseid)->first();
        $hn             = $tb_case['case_hn'];
        $folderdate     = $r->folderdate;
        makedir(htdocs("store/$hn/temp"));
        $dir            = htdocs("store/$hn/$folderdate/");

        $url =  str_replace("&amp;", "&", $r->url);
        $url =  str_replace("+", "&", $url);

        // file_put_contents($pdf_file, stream_get_contents($stream, 5));
        // connectweb($url."&temp=true");

        // dd($r);
        $pdf_file       = htdocs("store/$hn/temp/temp.pdf");
        $arr['filein']  = $pdf_file;
        $arr['fileout'] = htdocs("store/$hn/$folderdate/temp/0");
        $arr['type']    = "jpg";
        $arr['zoom']    = 2;
        $jsonEN         = jsonEncode($arr);
        $base64         = base64_encode($jsonEN);
        $this->temp_pdf($r->caseid, $r->pdf_type);
        // $this->deleteall($dir);
        shell_exec("py D:\allindex\pdf2img\pdf.py $base64");
        // shell_exec("D:\allindex\pdf2img\dist\pdf\pdf.exe $base64");

        $this->vnatest($r, htdocs("store/$hn/$folderdate/temp"), $hn);
        $this->deleteall($dir);
        $res['code'] = "200";
        printJSON($res);
    }

    public function vna_photopdf($r)
    {
        $tb_case        = Mongo::table('tb_case')->where("id", $r->caseid)->first();
        $hn             = $tb_case['case_hn'];
        $folderdate     = $r->folderdate;
        makedir(htdocs("store/$hn/temp"));
        $pdf_file       = htdocs("store/$hn/temp/temp.pdf");
        $url =  str_replace("&amp;", "&", $r->url);
        $url =  str_replace("+", "&", $url);

        $arr['filein']  = $pdf_file;
        $arr['fileout'] = htdocs("store/$hn/$folderdate/temp/0");
        $arr['type']    = "jpg";
        $arr['zoom']    = 2;
        $jsonEN         = jsonEncode($arr);
        $base64         = base64_encode($jsonEN);
        $photoselect    = photoSELECT($tb_case['photo']);
        $dir            = htdocs("store/$hn/$folderdate/");
        shell_exec("py D:\allindex\pdf2img\pdf.py $base64");
        $this->vnatest($r, htdocs("store/$hn/$folderdate/temp"), $hn);
        $this->deleteall($dir);
    }

    public function temp_pdf($id, $type)
    {
        //มรดกไบร์ท
        $pdfcontroller = new PDFController();
        $r = new Request([
            'id' => $id,
            'type' => $type,
            'temp' => 'true'
        ]);
        return $pdfcontroller->show($id);
    }



    public function vna_photo($r)
    {
        // dd($r);
        // $w['caseuniq']  = $r->pacs_caseuniq;
        // $w['comcreate'] = $r->pacs_comcreate;
        $tb_case        = Mongo::table('tb_case')->where("id", $r->caseid)->first();
        $hn             = $tb_case['case_hn'];
        $folderdate     = $r->folderdate;
        makedir(htdocs("store/$hn/$folderdate/temp"));
        $photoselect    = photoSELECT($tb_case['photo']);
        $dir            = htdocs("store/$hn/$folderdate/");

        $this->deleteall($dir);
        // $this->copyphoto($dir, $photoselect);
        $this->vnatest($r, htdocs("store/$hn/$folderdate/temp"), $hn);
        $this->deleteall($dir);
    }


    public function copyphoto($dir, $photoselect)
    {
        foreach ($photoselect as $photo) {
            $pathphoto = $dir . $photo['na'];
            if (file_exists($pathphoto) == 1) {
                $pic = Image::make($pathphoto);
                $pic->save($dir . "/temp/" . $photo['na']);
            }
        }
    }

    public function deleteall($dir)
    {
        $files = glob($dir . "temp/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
    }

    public function user_add($r)
    {
        $val['user_type']       = $r->user_type;
        $val['user_prefix']     = $r->user_prefix;
        $val['user_firstname']  = $r->user_firstname;
        $val['user_lastname']   = $r->user_lastname;
        $val['phone']           = $r->phone . "";
        $val['color']           = $r->color . "";
        $val['opencase']        = 1;

        $r->department = jsonEncode($r->department_id);
        if ($r->email == null) {
            $count = DB::connection('endocapture_server')->table('users')->orderby('id', 'desc')->first();
            $number = $count->id + 1;
            $val['email']       = $r->user_type . $number;
            $val['password']    = Hash::make('123456');
        } else {
            $val['email']       = $r->email;
            $val['password']    = Hash::make($r->password);
        }

        DB::connection('endocapture_server')->table('users')->insert($val);
        $r->id = DB::connection('endocapture_server')->getPdo()->lastInsertId();
        createTEMPMASTERDATA('users');
        $this->department_update($r, 'department_user');

        sameMASTERDATA();
    }

    public function department_update($r, $field)
    {

        $tb_department = DB::connection('endocapture_server')->table('tb_department')->get();
        foreach ($tb_department as $data) {
            $arr = (array) jsonDecode($data->$field);
            $search = array($r->id);
            $newarray = array_diff($arr, $search);
            $newdata[$field] = jsonEncode($newarray);
            DB::connection('endocapture_server')
                ->table('tb_department')
                ->where('department_id', $data->department_id)
                ->update($newdata);
        }

        $json = jsonDecode($r->department);
        foreach ($json as $data) {
            $tb_department = DB::connection('endocapture_server')->table('tb_department')->where('department_id', $data)->first();
            $arr = (array) jsonDecode($tb_department->$field);
            array_push($arr, $r->id);
            $j = array_values(array_unique($arr));
            $dep[$field] = jsonEncode($j);
            DB::connection('endocapture_server')
                ->table('tb_department')
                ->where('department_id', $data)
                ->update($dep);
        }
        createTEMPMASTERDATA('tb_department');
    }

    public function create()
    {

        $patient['mrn']          = "4096233";
        $patient['sdloc']        = "SDOR5";
        $patient['clinicname']   = "ธรรมดา";
        $patient['enc_type']     = "AMB";
        $patient['enc_id']       = "278358";
        $patient['op_dt']        = "06/06/2022";

        $a['patientdetail'] = $patient;
        $a['checkin']       = "04/06/2022 22:32:00";
        $a['checkout']      = "04/06/2022 23:32:00";
        $a['keyid']         = "005748";
        $a['keydt']         = "04/06/2022 23:35:00";
        $a['type']          = "major";
        $team['teamid']         = "027";
        $team['room']           = "xxx";
        $team['timeinroom']     = "04/06/2022 22:32:00";
        $team['timeoutroom']    = "04/06/2022 22:32:00";
        $team['starop']         = "04/06/2022 22:32:00";
        $team['endop']          = "04/06/2022 22:32:00";
        $team['staff']          = "005748";
        $team['surgeon']        = ["005748"];
        $team['assistants']     = ["005748", "005749"];
        $team['scrubnurse']     = ["005748"];
        $team['circnurse']      = ["005748"];
        $team['anesthesilogist'] = ["005738", "005739"];
        $team['anestechnique']  = "RA fail+GA";
        $team['opnote']         = "ข้อความ report";

        /* ************************************************** */

        $dia['code']    = "0109";
        $dia['codeseq'] = "01";
        $dia['desc']    = "Aspiration cyst thalamic";
        $dia['gendesc'] = "Other cranial puncture ";
        $dia['acc']     = "";
        $dia['detail']  = "Aspiration ";
        $secondary1[]    = $dia;
        $secondary1[]    = $dia;
        $empty = [];
        $secondary2[] = array();
        $diagnosis['prediag']['principle']  = $dia;
        $diagnosis['prediag']['secondary']  = $secondary1;
        $diagnosis['postdiag']['principle'] = $dia;
        $diagnosis['postdiag']['secondary'] = $secondary2;
        $team['diagnosis'] = $diagnosis;

        $operation['preop']['principle']    = $dia;
        $operation['preop']['secondary']    = $empty;
        $operation['postop']                = $empty;
        $team['operation']                  = $operation;

        $a['team'] = $team;

        $json = jsonEncode($a);
        echo $json;
    }
}
