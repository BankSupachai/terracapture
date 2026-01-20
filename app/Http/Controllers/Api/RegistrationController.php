<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo;
use App\Models\Patient;


class RegistrationController extends Controller
{

    public function store(Request $r)
    {
        // dd($r->all());
        $val['updatetime']     = date("ymdHis");
        $val['comcreate']      = getCONFIG('admin')->com_name;
        $val['created_from']   = "regis";
        $booking = getCONFIG("booking");

        if(isset($r->event)){

            if($r->event == 'check_same_hn')        {return $this->check_same_hn($r);}
            if($r->event == 'check_create_case')    {return $this->check_create_case($r);}
        }


        if(@$booking->futureinbooking){
            if(true){
            // if($r->meet_date!=date('Y-m-d')){
                $noteid = $this->booking_create($r);
                if(@$booking->appointcard){
                    return redirect("book/prepare/$noteid");
                }
            }else{
                create_cases($val, $r);
            }
        }else{
            create_cases($val, $r);
        }

        if(isset($_COOKIE['createcase'])){
            if($_COOKIE['createcase'] != ""){
                // dd($_COOKIE);
                $url = $_COOKIE['createcase'];
                setcookie('createcase', '', time() - 3600, '/');
                return redirect($url);
            }
        }



        if(isset($r->book)){
            return redirect('book');
        // }else if(isset($r->capture)){
        //     return redirect('capture');
        }else{

            return redirect('home');
        }

    }

    public function booking_create($r){
        // form booking
        $physicianID            = intval($r->case_physicians01);
        $patient                = Mongo::table("tb_patient")->where("hn",$r->hn)->first();
        $physician              = Mongo::table("users")->where("uid",$physicianID)->first();

        $val["noteid"]          = $this->casenote_create($r);
        $val["create_time"]     = date("YmdHis");
        $val["patient_type"]    = "service";
        $val["period"]          = "am";
        $val["hn"]              = $r->hn;
        $val['patient_name']    = Patient::fullname($r->hn);
        $val['department']      = "GI";
        $val["age"]             = age($patient['birthdate']);
        $val["caim"]            = $r->treatment_coverage;
        $val["procedure"]       = $r->case_procedurecode;
        $val["booker"]          = uid();
        $val["physician"]       = intval($r->case_physicians01);
        $val["physician_name"]  = fullName($physician);
        $val["hn"]              =  $r->hn;
        $val["date"]            =  $r->meet_date;
        $val["urgent"]          = "elective";
        $val["status"]          = "booking";
        ksort($val);
        Mongo::table("tb_booking")->insert($val);
        return $val["noteid"];
    }

    public function casenote_create($r){
        $id = checkNURSENOTE($r->hn, $r->meet_date, uget("department"));

        return $id;
    }

    public function check_same_hn($r){
        $hn = $r->hn;
        $appointment = $r->appointment;
        $procedure_tocheck = $r->procedure;

        $w[] = array('case_hn', $hn);
        $w[] = array('appointment', 'like', '%'.$appointment.'%');
        $w[] = array('statusjob', '!=', 'delete');
        $w[] = array('statusjob', '!=', 'cancel');

        $tb_case = Mongo::table('tb_case')->where($w)->get();
        foreach (isset($tb_case)?$tb_case:[] as $case) {
            $case = (object) $case;
            $procedure = $case->case_procedurecode;
            if($procedure == $procedure_tocheck && $case->statusjob != 'delete'){
                return 'false';
            }
        }
        return 'true';
    }

    public static function check_create_case($r) {
        $w[] = array('appointment', 'like', '%'.$r->date.'%');
        $w[] = array('hn', $r->hn);
        $w[] = array('statusjob', '!=', 'delete');
        $w[] = array('statusjob', '!=', 'cancel');
        $data = Mongo::table('tb_case')->where($w)->get();
        $procedure = Mongo::table('tb_procedure')->select('name', 'code')->get();
        $disabled_proc = [];
        foreach ($data as $d) {
            $d = (object) $d;
            $disabled_proc[] = $d->case_procedurecode;
        }
        $arr['disabled'] = $disabled_proc;
        $arr['procedure'] = $procedure;
        return jsonEncode($arr);
    }


}
