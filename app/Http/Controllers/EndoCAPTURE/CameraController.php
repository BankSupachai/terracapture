<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\casemedication;
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\User;
use App\Models\Camera;
use App\Models\Department;
use App\Models\Patient;


class CameraController extends Controller
{
    public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {
        $text = 'TEST CAMERA';
        $view['id']                         = 0;
        $view['type']                       = 'test';
        $view['room']                       = Department::room(uid());
        $view['scope']                      = Department::scope(uid());
        $view['procedure']                  = Department::procedure(uid());
        $view['nurse']                      = Department::user('nurse', uid());
        $view['nurse_anes']                 = Department::user('nurse_anes', uid());
        $view['anes']                       = Department::user('anes', uid());
        $view['register']                   = Department::user('register', uid());
        $view['case']                       = (object) array();
        $view['scope_select']               = 0;
        $view['case']->_id                  = 0;
        $view['cid']                        = 0;
        $view['case']->case_hn              = $text;
        $view['caseuniq']                   = $text;
        $view['hn']                         = $text;
        $view['case']->doctorname           = $text;
        $view['patient']                    = Camera::patienttest();
        $view['case_today']                 = Camera::casetoday("test");
        $view['doctor']                     = Department::user('doctor', uid());
        $view['assistant']                  = Department::usernot('doctor');
        $view['case']->case_id              = 0;
        $view['case']->case_hn = "TEST CASE";
        $view['case']->caseuniq             = 0;
        $view['case']->case_procedurecode   = $text;
        $view['case']->comcreate            = $text;
        $view['userID']                     = uid();
        $view['url']                        = 'test';
        $view['this_scope']                 = [0, 0];
        $view['count_img']                  = Camera::count_img($view['case']);
        $view                               = Camera::config_ocr($text,$view);
        $view                               = Camera::drive_percent($view);
        $view                               = Camera::loadimg(0,$view);
        $view                               = Camera::config_video('cameratemp',0,$view);
        $view['scope_serial']               = Camera::get_scopeserial();
        $view['connection']                 = getCONFIG("camera");
        $view['feature']                    = getCONFIG("feature");
        $view['camera']                     = getCONFIG("camera");

        if(@$view['camera']->obs_source){
            return view('EndoCAPTURE.camera.obs.01obsblank', $view);
        }else{
            return view('EndoCAPTURE.camera.supernewcamera', $view);
        }
    }

    public function show($id)
    {
        $view                       = Camera::returnpage($id);
        $case                       = Datacase::first($id);
        $view['type']               = 'camera';
        $view['case_today']         = Camera::casetoday($id);
        $view['case']               = $case;
        $view['this_procedure']     = Mongo::table('tb_procedure')->where('code',$case->case_procedurecode)->first();
        $view['caseuniq']           = $case->caseuniq;
        $view['nurse']              = Department::user('nurse');
        $view['anes']               = isset($view['this_procedure']->anesthesia) ? $view['this_procedure']->anesthesia : [];
        $view['nurse_anes']         = Department::user('nurse_anes');
        $view['register']           = Department::user('register');
        $view['assistant']          = Department::usernot('doctor');
        $view['room']               = Department::room(uid());
        $view['userID']             = uid();
        $view['modal']              = Mongo::table('tb_case')->where('case_hn',$case->case_hn)->whereDate('appointment',date('Y-m-d'))->get();
        $view['cid']                = $id;
        $view['hn']                 = $case->case_hn;
        $view['case_id']            = isset($case->case_id) ? $case->case_id : null;
        $view['caseuniq']           = $case->caseuniq;
        $view['doseunit']           = CASEMEDICATION::get_unitdose();
        $view['tb_casemedication']  = (object) Mongo::table('tb_casemedication')->where('caseuniq', $view['caseuniq'])->first();
        $view['case_json']          = isset($case->case_json) ? $case->case_json : [];
        $view['procedure']          = Department::procedure(uid());
        $view['scope']              = Department::scope(uid());
        $view['scope_data']         = '';
        if(isset($case->scope[0])){
            $selected_scope =(object)Mongo::table("tb_scope")->where("scope_id" , intval($case->scope[0]))->first() ?? '';
            $view['scope_data']         = $selected_scope != '' ? @$selected_scope->scope_name." (" . @$selected_scope->scope_serial." )" : '';
        }
        $view['patient']            = (array) Patient::first($case->case_hn);
        $view['doctor']             = Department::user('doctor', uid());
        $view['users']              = Mongo::table('users')->where('user_firstname','!=',null)->get();
        $view['word']               = wording("endocapture","defalut");
        $view['url']                = url('');
        $view['count_img']          = Camera::count_img($view['case']);
        $user_in_case               = isset($case->user_in_case) ? $case->user_in_case : [];
        $view['doctor_select']      = User::filter_type_user_in_case($user_in_case, 'doctor_sel');
        $view['nurse_select']       = User::filter_type_user_in_case($user_in_case, 'nurse_sel');
        $view['nurse_a_select']     = User::filter_type_user_in_case($user_in_case, 'nurse_a_select');
        $view['register_select']    = User::filter_type_user_in_case($user_in_case, 'register_sel');
        $view['viewer_select']      = User::filter_type_user_in_case($user_in_case, 'viewer_sel');
        $view['sci_select']         = User::filter_type_user_in_case($user_in_case, 'sci_sel');

        $view['nurse_assis'] = array_merge(
            $view['nurse_select'],
            $view['nurse_a_select'],
            $view['register_select'],
            $view['viewer_select'],
            $view['sci_select']
        );
        $view['this_scope']         = Camera::get_scope_config('cameratemp', $case);
        $view                       = Camera::config_ocr($case->case_hn, $view);
        $view                       = Camera::drive_percent($view);
        $view                       = Camera::loadimg($id,$view);
        $view                       = Camera::config_video('cameratemp', $id, $view) ;
        $view['scope_serial']       = Camera::get_scopeserial();
        $view['feature']            = getCONFIG("feature");
        $view['camera']             = getCONFIG("camera");
        $view['configscope']        = getCONFIG("scope");
        $config                     = getCONFIG("admin");
        $room_id                    = isset($config->station_room)?(int) $config->station_room:0;
        Camera::save_room_id($room_id, $case);
        $this_room                  = (object) Mongo::table("tb_room")->where("room_id", @$room_id)->first();
        $view['this_room']          = @$this_room->room_name."";
        $view['case']               = Datacase::first($id);
        Datacase::dataUPDATE($id,['statusjob'=>'operation']);
        createTEMP('tb_case',$case->caseuniq,$case->comcreate,date("ymdHis"));
        NURSEMONITORoperation($case->case_hn,$case->caseuniq,$room_id);
        SYSTEMQueue('operation',$case);
        if(@$view['feature']->queue){queuesystem($case->case_hn,"Operation");}
        if(@$view['camera']->obs_source){
            return view('EndoCAPTURE.camera.obs.01obs', $view);
        }else{
            return view('EndoCAPTURE.camera.supernewcamera', $view);
        }

    }

    public function store(Request $r){
        if($r->event == "takephoto")        {Camera::takephoto($r);}
        if($r->event == "vdostop")          {Camera::vdostop($r);}
        if($r->event == "vdostart")         {Camera::vdostart($r);}
        if($r->event == "boxclick")         {Camera::boxclick($r);}
        if($r->event == "checkblack")       {Camera::checkblack($r);}
        if($r->event == "python_capture")   {Camera::python_capture($r);}
        if($r->event == "python_vdostart")  {Camera::python_vdostart($r);}
        if($r->event == "python_vdostop")   {Camera::python_vdostop($r);}
        if($r->event == "cameraselect")     {Camera::cameraselect($r);}
        if($r->event == "takephoto2pic")    {Camera::takephoto2pic($r);}
        if($r->event == "takephoto3pic")    {Camera::takephoto3pic($r);}
        if($r->event == "scope_select")     {Camera::scope_select($r);}
        if($r->event == "caseconfig")       {Camera::caseconfig($r);}
        if($r->event == "vdo1getsize")      {Camera::vdo1getsize($r);}
        if($r->event == "scopetracking")    {Camera::scopetracking($r);}
        if($r->event == "pictest_delete")   {Camera::pictest_delete($r);  return redirect(url('home'));}
        if($r->event == "finish_record")    {Camera::finish_record($r);  return redirect("loadpic/$r->cid");}
    }


    public function update_tb_case($id,$idhtml, $value){
        $w[] = array('id',$id);
        $data[$idhtml] = jsonDecode($value);
        Mongo::table('tb_case')->where($w)->update($data);
    }

    public function update_user_in_case($id,$idhtml, $value){
        $decode = isset($value) ? jsonDecode($value, true) : [];
        $w[] = array('id',$id);
        $tb_case = Mongo::table('tb_case')->where($w)->first();
        $tb_case = (object) $tb_case;
        $user_in_case = isset($tb_case->user_in_case) ? $tb_case->user_in_case : [];
        foreach($decode as $d){
            if(in_array($d, $user_in_case) == false && $d != " " && $d != ""){
                $user_in_case[] = $d;
            }
        }
        $data['user_in_case'] = $user_in_case;
        Mongo::table('tb_case')->where($w)->update($data);
    }

    public function edit($id){
        $view['cid'] = $id;
        return view('EndoCAPTURE.camera.edit', $view);
    }

}
