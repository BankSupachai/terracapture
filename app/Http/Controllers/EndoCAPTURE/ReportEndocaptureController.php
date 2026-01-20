<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Datacase;
use App\Models\Mongo;
use Symfony\Component\Process\Process;

class ReportEndocaptureController extends Controller
{

    public function __construct(Request $r){checklogin();}

    public function index(){}


    public function store(Request $r)
    {
        if(isset($r->event)){
            if($r->event=="create_sign"){$this->create_sign($r);}
        }
        if(isset($r->event)){
            if($r->event=="change_statusnursenote"){
                $this->change_statusnursenote($r);
            }
        }
    }


    public function change_statusnursenote($r){

        $tb_casenote = Mongo::table('tb_casenote')
            ->where('id',$r->nid)
        ->first();
        
        $val['status'] = "print";
        Mongo::table('tb_casenote')->where('id',$tb_casenote->id)->update($val);
    }

    public function create_sign($r){
        $uid        = $r->doctor_id;
        $cid        = $r->cid;
        $code       = $r->doctor_code;
        $folderdate = $r->folderdate;
        $caseuniq   = $r->caseuniq;
        $comcreate  = $r->comcreate;
        $hn         = $r->hn;
        $user = DB::table('users')->where('id',$uid)->first();

        if($user!=null){
            if($code==$user->user_code){
                $picdoctor      = fileconfig("doctor/$code.txt");
                $sign_url       = storePATH("$hn/$folderdate/$caseuniq.txt");
                if(!file_exists($picdoctor)){
                    copy($picdoctor,$sign_url);
                }else{
                    $picdoctorwhite = fileconfig("doctor/white.txt");
                    copy($picdoctorwhite,$sign_url);
                }

                createTEMP('tb_case',$caseuniq,$comcreate,date("ymdHis"));

                $case = DB::table('tb_case')->where('case_id',$cid)->first();
                $json = jsonDecode($case->case_json);
                $json->pdfcreate    = false;
                $arr['case_json']   = jsonEncode($json);
                Mongo::table('tb_case')->where('_id',$cid)->update($arr);
                echo "success";
            }else{
                echo "unsuccess";
            }
        }else{
            echo "unsuccess";
        }


    }


    public function show($id, Request $r){
        $view['feature']    = getCONFIG("feature");
        $view['config']     = getCONFIG("admin");
        $view['id']         = $id;
        $view['cid']        = $id;
        $tb_case            = (object) Mongo::table('tb_case')->where('id',$id)->first();

        $view['users']      = Department::userall(uid());
        $apppoint           = explode(" ",$tb_case->appointment);
        $view['folderdate'] = $apppoint[0];
        $view['casedata']   = Datacase::first($id);
        $wtoday[0] = array('case_hn',$view['casedata']->case_hn);
        $wtoday[1] = array('appointment',$view['casedata']->appointment);
        $wtoday[2] = array('case_status','!=','90');
        $view['casetoday']  = Mongo::table("tb_case")->where($wtoday)->get();
        $view['url']        = url('');
        $view['note']       = (object) Mongo::table('tb_casenote')
        ->where('hn',$tb_case->hn)
        ->where('department',$tb_case->department)
        // ->where('appointment',$tb_case->appointment_date)
        ->first();
        // dd($view['note']);
        $w[] = array("appointment_date",$apppoint[0]);
        $w[] = array('statusjob', '!=', 'delete');
        $w[] = array('statusjob', '!=', 'cancel');
        $w[] = array("case_hn",$tb_case->hn);
        $view['tb_casefirst']       = (object) Mongo::table('tb_case')->where($w)->first();
        $view['tb_caseall']         = (object) Mongo::table('tb_case')->where($w)->get();

        $view['store_url']          = str_replace('endoindex', '', $view['url']);
        $view['sendto_vdo']         = isset($view['config']->sendto_vdo) ? $view['config']->sendto_vdo : false;
        $view['procedure']          = Mongo::table("tb_procedure")->where('code' , $tb_case->case_procedurecode)->first();
        $view['emr'] = getCONFIG("emr");
        $view['lumina'] = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
        $appname        = app_name();
        $view['file_check_advance'] = file_exists("D:/laragon/htdocs/" . $appname . "/resources/views/EndoCAPTURE/pdf/component/pdf_picturebottom/" . $tb_case->case_procedurecode . ".blade.php");
        return view('reportendocapture.copy', $view);
    }



    public function departmentdrive($drive){
        $name = '';
        if($drive=="W"){$name="GYNE";}
        if($drive=="X"){$name="OR";}
        if($drive=="Y"){$name="URO";}
        if($drive=="Z"){$name="GI";}
        return $name;
    }



    public function edit($id, Request $r)
    {
        return view('test.test_vdo');
    }

}
