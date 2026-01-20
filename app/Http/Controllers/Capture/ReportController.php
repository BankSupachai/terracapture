<?php

namespace App\Http\Controllers\Capture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Datacase;
use App\Models\Mongo;
use Symfony\Component\Process\Process;

class ReportController extends Controller
{

    public function __construct(Request $r){checklogin();}

    public function index(){}


    public function store(Request $r)
    {
        if(isset($r->event)){
            if($r->event=="create_sign"){$this->create_sign($r);}
        }
        if(isset($r->event)){
            if($r->event=="pdf_head_lang"){$this->pdf_head_lang($r);}
        }
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
        $tb_case            = (object) Mongo::table('tb_case')->where('_id',$id)->first();
        // dd($tb_case);
        $view['users']      = Department::userall(uid());
        $apppoint           = explode(" ",$tb_case->appointment);
        $view['folderdate'] = $apppoint[0];
        $view['casedata']   = Datacase::first($id);

        $wtoday[0] = array('case_hn',$view['casedata']->case_hn);
        $wtoday[1] = array('appointment',$view['casedata']->appointment);
        $wtoday[2] = array('case_status','!=','90');
        $view['casetoday']  = Mongo::table("tb_case")->where($wtoday)->get();
        $view['url']        = url('');
        $view['note']       = (object) Mongo::table('tb_casenote')->where('_id',$tb_case->noteid)->first();
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


        $department = uget('department');
        $hospital_name = configTYPE('pdf', 'pdf_folder_head');



        return view('capture.reportendocapture.copy', $view);
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
        return view('capture.test.test_vdo');
    }

}
