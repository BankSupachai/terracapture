<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Mongo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use stdClass;

class LampangcancerController extends Controller
{

    public function index(){
        $view['mmmm'] =  "mmm";

        return view("lampangcancer/index",$view);
    }


    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $this->$event($r);
        }
    }


    public function create(){
        // $this->gettoken();
        $tb_apitoken    = Mongo::table("tb_apitoken")->first();
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = 'Authorization: Bearer '.$tb_apitoken["access_token"];
        $arr['HN']      = "380000147";
        $post           = jsonEncode($arr);
        $res    = connectwebJSON("http://172.16.1.137:8081/api/Endo/PatientProfile",$post,$header);
        $json   = jsonDecode($res);
        if(isset($json->Status)){
            if($json->Status=="success"){
                $data = $json->Data;
                // +"HN": "380000147"
                // +"TitleName": "นาย"
                // +"FirstName": "ทุเรียน"
                // +"LastName": "โสภารัตนากูล"
                // +"MiddleName": ""
                // +"BirthDT": "1932-08-20T00:00:00"
                // +"GenderName": "ชาย"
                // +"AgeText": "91 ปี 7 เดือน "
                dd($data);
            }
        }
    }

    public function gethn($r){
        $this->gettoken();
        $tb_apitoken    = Mongo::table("tb_apitoken")->first();
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = 'Authorization: Bearer '.$tb_apitoken["access_token"];
        $arr['HN']      = $r->hn;
        $post           = jsonEncode($arr);
        $res            = connectwebJSON("http://172.16.1.137:8081/api/Endo/PatientProfile",$post,$header);
        $json           = jsonDecode($res);
        if(isset($json->Status)){
            if($json->Status=="success"){
                $data = $json->Data;
                $age = explode(" ",$data->AgeText);
                $data                   = (array) $data;
                $patient["prefixname"]  = $data['TitleName'];
                $patient["firstname"]   = $data['FirstName'];
                $patient["lastname"]    = $data['LastName'];
                $patient['gender']      = $this->gendercheck($data['GenderName']) ;
                $birth                  = $this->birthdate($data['BirthDT']);
                $patient["age"]         = $age[0];
                $patient["birth_day"]   = $birth['day'];
                $patient["birth_month"] = $birth['month'];
                $patient["birth_year"]  = (string) $birth['year'];
                $patient["status"]      = true;
                $patient['gendername']  = $data['GenderName'] ;
            }else{
                // $patient["status"]      = false;
            }
        }else{
            // $patient["status"]      = false;
        }
        printJson($patient);
    }


    public function gethnbook($r){
        $this->gettoken();
        $tb_apitoken    = Mongo::table("tb_apitoken")->first();
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = 'Authorization: Bearer '.$tb_apitoken["access_token"];
        $arr['HN']      = $r->hn;
        $post           = jsonEncode($arr);
        $res            = connectwebJSON("http://172.16.1.137:8081/api/Endo/PatientProfile",$post,$header);
        $json           = jsonDecode($res);
        if(isset($json->Status)){
            if($json->Status=="success"){
                $data = $json->Data;
                $age = explode(" ",$data->AgeText);
                $data                   = (array) $data;
                $this->patientadd($data,$r);
                $patient["prefixname"]  = $data['TitleName'];
                $patient["firstname"]   = $data['FirstName'];
                $patient["lastname"]    = $data['LastName'];
                $patient['gender']      = $this->gendercheck($data['GenderName']) ;
                $birth                  = $this->birthdate($data['BirthDT']);
                $patient["age"]         = $age[0];
                $patient["birth_day"]   = $birth['day'];
                $patient["birth_month"] = $birth['month'];
                $patient["birth_year"]  = (string) $birth['year'];
                $patient["status"]      = true;
                $patient['gendername']  = $data['GenderName'] ;
            }else{
                $patient["status"]      = false;
            }
        }else{
            $patient["status"]      = false;
        }
        printJson($patient);
    }


    public function patientadd($data,$r){
        $tb_patient = Mongo::table("tb_patient")->where("hn",$r->hn)->first();
        if($tb_patient==null){
            $val['allergic']            = $r->allergic."";
            $val['congenital_disease']  = $r->congenital_disease."";
            $val['emer_name']           = $r->emer_name."";
            $val['emer_tel']            = $r->emer_tel."";
            $val['firstname']           = $data['FirstName'];
            $val['middlename']          = '';
            $val['lastname']            = $data['LastName'];
            $val['phone']               = $r->phone;
            $val['an']                  = $r->an;
            $val['citizen']             = $r->citizen;
            $val['pic']                 = null;
            $val['email']               = $r->email;
            $val['prefix']              = $data['TitleName'];
            $hn                         =  str_replace(".","",$r->hn);
            $val['hn']                  = $hn;
            $val['gender']              = $this->gendercheck($data['GenderName']) ;
            $val['birthdate']           = str_replace("T00:00:00","",$data['BirthDT']);
            $val['nationality']         = $r->nationality;
            $val['regis_date']          = $r->regis_date;
            $val['regis_time']          = $r->regis_time;
            $lastid = Mongo::table('tb_patient')->insertGetId($val);
        }



    }

    public function gendercheck($gender){
        $gen = 1;
        // dd($gender);
        if($gender!="ชาย"){
            $gen=2;
        }
        return $gen;
    }

    public function birthdate($date){
        $ex             = explode("T",$date);
        $ex2            = explode("-",$ex[0]);
        $arr["day"]     = $ex2[2];
        $arr["month"]   = $ex2[1];
        $arr["year"]    = $ex2[0]+543;
        return $arr;
    }

    public function gettoken(){
        $header[0]          = 'XApiKey: 1vFHh@D6e0r11KW^1K^27e5633*w$F';
        $header[1]          = 'content-type: application/x-www-form-urlencoded';
        $post['UserName']   = "lpchendowebapi";
        $post['Password']   = "rw4R1P%9c56V*%&QVJ@eHEH#*vcRwK";
        $post['grant_type'] = "password";
        $res = connectpostheader("http://172.16.1.137:8081/api/RequestToken",$post,$header);
        $arr = (array) jsonDecode($res);
        Mongo::table("tb_apitoken")->update($arr);
    }

    public function test($r){
        dd($r);
    }



}
