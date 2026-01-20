<?php

namespace App\Http\Controllers\Endocapture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Datacase;
use App\Models\Department;
use App\Models\Mainpartsub;
use App\Models\casemedication;
use App\Models\Mongo;
use App\Models\Server;
use App\Models\User;
use App\Models\users;
use Exception;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\fileExists;
use MongoDB\BSON\ObjectId;

class ProcedureAdvanceController extends Controller{

    public function __construct(Request $r){checklogin();}

    public function index(Request $r){

    }


    public function store(Request $r){

    }


    public function photo($case){
        $x = 0;
        $photo = array();
        foreach($case->photo as $p){
            if(isset($p['st'])){
                if($p['st'] == 0 || $p['st']==1){
                    $photo[$x]['nu'] = $p['nu'];
                    $photo[$x]['ns'] = $p['ns'];
                    $photo[$x]['na'] = $p['na'];
                    $photo[$x]['sc'] = $p['sc'];
                    $photo[$x]['st'] = $p['st'];
                    $photo[$x]['tx'] = $p['tx'];
                    $x++;
                }
            }
        }
        return $photo;
    }
    public function procedurepic($view){
        $case                       = $view['case'];
        $procedure                  = (object) $view['procedure'];
        $procedure_picori           = fileconfig("procedure/$procedure->img");
        $appointment                = explode(" ",$case->appointment);
        $folderdate                 = $appointment[0];
        $view['folderdate']         = $folderdate;
        $folder_hnpath              = htdocs("store/$case->case_hn/$folderdate/");
        $view['procedure_piccopy']  = $folder_hnpath.$case->caseuniq.".jpg";
        makedir($folder_hnpath);
        if(!file_exists($view['procedure_piccopy'])){copy($procedure_picori,$view['procedure_piccopy']);}
        return $view;
    }


    public function show($id,Request $r){
        $view['cid']    = $id;
        $view['case']   = Datacase::fromID($id);
        $view['word']   = wording("endocapture","defalut");
        $photohn        = Datacase::first($id);
        $wcase[0]       = array('procedure_code'    ,$photohn->case_procedurecode);
        $wcaseuniq[0]   = array('caseuniq'          ,$photohn->caseuniq);
        $wcaseuniq[1]   = array('comcreate'         ,$photohn->comcreate);
        $view['case']                   = Datacase::fromID($id);
        // dd($view['case']);
        if(@$view['feature']->queue){
            queuesystem($view['case']->case_hn,"Recovery");
        }



        $case                           = $view['case'];
        $view['today']                  = Carbon::now()->format('Y-m-d');
        $view['room']                   = Department::room(uid());
        $view['tb_procedure']           = Department::procedure(uid());
        $view['nurse']                  = Department::user('nurse', uid());
        $view['register']               = Department::user('register', uid());
        $view['doctor']                 = Department::user('doctor', uid());
        $view['anes']                   = Department::user('anes', uid());
        $view['nurse_anes']             = Department::user('nurse_anes', uid());
        $view['users']                  = Department::userall(uid());
        $view['patient']                = (object) Mongo::table('tb_patient')->where('hn',$case->case_hn)->first();
        $view['caseuniq']               = $case->caseuniq;
        $view['tb_casemedication']      = CASEMEDICATION::checkdata($case,$wcaseuniq);
        $view['doseunit']               = CASEMEDICATION::get_unitdose();
        $view['histopathology']         = CASEMEDICATION::get_histopathology();
        $view['photo']                  = $case->photo;
        $view['mainpartsub']            = Mainpartsub::sort($id);
        $view['mainpart']               = Mainpartsub::get_mainpart($view['case']->case_procedurecode);
        $view['procedure']              = (object) Mongo::table("tb_procedure")->where("code",$case->case_procedurecode)->first();
        // dd($view['procedure']);
        $view['procode']                = $case->case_procedurecode;
        $view['case_json']              = isset($case->case_json) ? $case->case_json : [];
        $view['treatment']              = (object) Mongo::table('tb_casenote')->where('_id', $view['case']->noteid)->first();
        $view['noteid']                 = (string) $view['case']->noteid;
        $view['tb_treatmentcoverage']   = (object) Mongo::table('tb_treatmentcoverage')->get();
        $view['DOCUMENT_ROOT']          = $_SERVER['DOCUMENT_ROOT'];
        $view = $this->procedurepic($view);

        $view['photo']                  = $this->photo($case);
        $view['photoselect']            = photoSELECT($case->photo);
        $view['vdo']                    = isset($case->video) ? $case->video : [];
        $operation_date                 = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
        $view['vdo_url']                = domainname("store/$case->hn/$operation_date/vdo");
        $view['scopes']                 = Department::scope(uid());
        $view['otherprocedure']         = Datacase::otherprocedure($case);

        makedirfull(htdocs("store/$case->hn/$case->appointment_date/backup"));
        makedirfull(htdocs("store/$case->hn/$case->appointment_date/pdf"));
        makedirfull(htdocs("store/$case->hn/$case->appointment_date/vdo"));
      


        $arr['dayweek']     = Datacase::getweekday("2024-02-20");
        $arr['day']         = Datacase::getdate("2024-02-20 08:00:00");
        $arr['month']       = Datacase::getmonth("2024-02-20 08:00:00");
        $arr['year']        = Datacase::getyear("2024-02-20 08:00:00");


        return view('case.component.ercp_advance',$view);
    }



}
