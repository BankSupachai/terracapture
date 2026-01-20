<?php
namespace App\Http\Controllers\capture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Models\Server;
use App\Http\Controllers\Api\ProcedureController as ApiProcedureController;

use App\Models\Department;
use App\Models\Mongo;


class RegistrationController extends Controller
{

    public function __construct(Request $r){checklogin();}

    public function index(){}

    public function show($id, Request $r)
    {

        $view['word']   = wording("endocapture","defalut");
        $view['patient'] = (object) Mongo::table('tb_patient')
        ->where('id',$id)
        ->first();

        $view['patient_id'] = $id;
        $view['id']      = $id;
        $view['today']   = Carbon::now()->format('Y-m-d');
        $view['room']    = Department::room(uid());
        $view['procedure'] = Department::procedure(uid());
        $view['nurse_select']       = Department::user('nurse', uid());
        $view['register_select']    = Department::user('register', uid());
        $view['anes_select']        = Department::user('anesthesia', uid());
        $view['nurse_anes_select']        = Department::user('nurse_anes', uid());
        $view['nurse_assistant_select']   = Department::user('nurse_assistant', uid());
        $view['doctor_select']      = Department::user('doctor', uid());
        $view['tb_treatmentcoverage'] = Mongo::table('tb_treatmentcoverage')->get();
        $view['pname']              = "";
        $view['users']              = Department::userall(uid());
        $view['userall']            = Department::userall(uid());
        $view['page']               = "registration";
        $project = configTYPE("admin","project");
        return view('capture.report.newregistration',$view);

    }
    public function edit(Request $r, $id)
    {

        $view['user']    = DB::table('users')->where('uid',uid())->first();
        if($view['user']->room_json=="" || $view['user']->room_json==null){
            $view['room'] = DB::table('tb_room')->get();
        }else{
            $room_json = jsonDecode($view['user']->room_json);
            $view['room'] = DB::table('tb_room')->whereIn('id',$room_json)->get();
        }
        $view['patient'] = DB::table('patient')
        ->join('dd_gender','dd_gender.gender_id', '=', 'patient.gender')
        ->where('patient.patient_id',$id)
        ->first();
        $view['today']              = Carbon::now()->format('Y-m-d');
        $view['nurse']              = DB::table('users')->where('user_type','nurse')->get();
        $view['register']           = DB::table('users')->where('user_type','register')->get();
        $view['doctor']             = DB::table('users')->where('user_type','doctor')->get();
        $view['doctor_select']      = samedepartment($view['doctor']);
        $view['nurse_select']       = samedepartment($view['nurse']);
        $view['register_select']    = samedepartment($view['register']);
        // $view['procedure']          = proceduredepartment(uget("procedure_json"));
        $view['pname']              = "";
        return view('capture.report.edit_registration',$view);
    }

    public function update($id,Request $r)
    {
        $val['case_procedure']                      = $r->procedure;
        $val['case_json']['opd']                    = $r->opd;
        $val['case_json']['ward']                   = $r->ward;
        $val['case_json']['refer']                  = $r->refer;
        $val['case_json']['physicians01']           = $r->case_physicians01;
        $val['case_json']['room']                   = $r->procedureroom;
        $val['case_json']['dateappointment']        = $r->meet_date . " " . $r->meet_hour . ":" . $r->meet_minute;
        $val['case_json']['nurse01']                = $r->case_nurse01."";
        $val['case_json']['nurse02']                = $r->case_nurse02."";
        $val['case_json']['nurse03']                = $r->case_nurse03."";
        $val['case_json']['nurse04']                = $r->case_nurse04."";
        $val['case_json']['anes']                   = $r->anes."";
        $val['case_json']['preicd10']               = $r->preicd10."";
        $val['case_json']['patient_id']             = $r->patientid;
        $val['case_json']['useropencase']           = $r->useropen;
        $val['case_json']['dateregister']           = $r->meet_date;
        $val['case_json']['prediagnostic_other']    = $r->prediagnostic_other;
        $val['case_json']['righttotreatment']       = $r->righttotreatment;
        DB::table('tb_case')->where('case_id',$id)->update($val);

        if(isset($r->takephoto)){
            return redirect(url("camera/$id"));
        }
        return redirect('home');
    }

    public function destroy($id)
    {

    }

    public function store(Request $r)
    {
        $val['updatetime']  = date("ymdHis");
        $val['comcreate']   = getCONFIG('admin')->com_name;
        $cid                = insertCASE($val,$r);
        $val['caseuniq']    = $cid;
        insertMEDICATION($val);
        $redirect           = isset($r->takephoto) ? true : false;
        if($redirect){
            return redirect(url("camera/$cid"));
        }else{
            return redirect('home');
        }
    }









}
