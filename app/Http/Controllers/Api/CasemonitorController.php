<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Datacase;
use App\Models\Casebooking;
use App\Models\Holiday;
use App\Models\Department;
use App\Models\Mongo;
use Exception;
use PDO;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Input\Input as InputInput;
use App\Models\Patient;
class CasemonitorController extends Controller
{

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $this->$event($r);
        }
    }


    public function get_case_detail($r)
    {

        $caseuniq_dec = jsonDecode($r->caseuniq);
        $caseuniq = isset($caseuniq_dec[0]) ? $caseuniq_dec[0] : '';
        $tb_case = Mongo::table('tb_casemonitor')->where("caseuniq", $caseuniq)->first();


        $procedures = [];
        foreach ($caseuniq_dec as $c) {
            $case = Mongo::table('tb_casemonitor')->where("caseuniq", $c)->first();
            $procedures[] = $case->monitor_procedure ?? '';
        }
        $tb_case->monitor_procedure = array_values(array_filter($procedures));
        $tb_case->caseuniq = $caseuniq_dec;
        $tb_case->patient_name = Patient::fullname_patient($tb_case->monitor_hn);
        // dd($tb_case);
        printJSON($tb_case);
    }



    public function get_detail_formodal($r)
    {

       $caseuniqs   = jsonDecode($r->caseuniq);
       $caseuniq = isset($caseuniqs[0]) ? $caseuniqs[0] : '';

       $patient_data = new \stdClass();

       $tb_case = Mongo::table('tb_case')->where("id", $caseuniq)->first();
       $patient_data->tb_case = (object) $tb_case;

       if($tb_case) {
           $patient_data->tb_patient = (object) Mongo::table('tb_patient')->where("hn", $tb_case->case_hn)->first();
       }

       $patient_data->tb_casemonitor = (object) Mongo::table("tb_casemonitor")->where("caseuniq", $caseuniq)->first();
       $patient_data->tb_caseid = (string)$tb_case->id;
       printJson($patient_data);
    }



    // public function get_2_procedure($r)
    // {
    //     $caseuniq = jsonDecode($r->caseuniq);
    //     $tb_case = Mongo::table('tb_casemonitor')->whereIn("caseuniq", $caseuniq)->first();
    //     $tb_cases = Mongo::table('tb_casemonitor')->whereIn("caseuniq", $caseuniq)->get();
    //     $procedure_text = '';
    //     // dd($tb_cases);
    //     foreach ($tb_cases as $key => $data) {
    //         $data = (object) $data;
    //         $procedure = @$data->monitor_procedure."";
    //         $procedure_text = $procedure_text.$procedure.'  ,  ';

    //     }
    //     $procedure_text = rtrim($procedure_text, " , ");

    //     $html = ' ';
    //     $html.= "
    //     <div class='col-3'>Procedure</div>
    //     <div class='col-9'>
    //     <input class='form-check-input' type='checkbox' id='formCheck'>
    //     <label class='form-check-label' for='formCheck1'>
    //     $procedure_text
    //     </label>
    //     </div>
    //     ";
    //     $tb_case = (object) $tb_case;
    //     // dd($tb_case );
    //     $hn  = $tb_case->monitor_hn;
    //     $patientname  = $tb_case->monitor_patientname;
    //     $doctorname   = $tb_case->monitor_doctorname;
    //     $html1 = '';
    //     $html1.="
    //     <div class='col-3'>HN / Name</div>
    //     <div class='col-9'>
    //         <span></span>$hn / &ensp; <span>$patientname</span>
    //     </div>
    //     <div class='row mt-2'>
    //         <div class='col-3'>Endoscopist</div>
    //         <div class='col-9'>

    //              <span>&ensp;$doctorname</span>
    //         </div>
    //     </div>
    //     ";

    //     echo $html1 ,$html ;
    // }

}
