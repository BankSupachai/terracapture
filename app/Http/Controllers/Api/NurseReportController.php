<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Symfony\Component\Process\Process;
use App\Models\casemedication;
use App\Models\Department;

class NurseReportController extends Controller
{
    public function index(Request $r)
    {

        return view('EndoINDEX.nursereport');
    }

    // public function store(Request $r)
    // {

    //     if (isset($r->event)) {
    //         $event      = $r->event;
    //         $redirect   = $this->$event($r);
    //     }

    //     if ($r->event == 'add_vitalsign') {
    //         $this->add_vitalsign($r);
    //     }
    //     if (isset($redirect)) {
    //         return redirect($redirect);
    //     }
    // }

    public function add_vitalsign($r)
    {

        $data = $r->all();
        $arr = array();
        $i = 0;
        foreach ($data['time'] as $value) {
            // $arr[$i]['procedure']        = $data['procedure'][$i];
            $arr[$i]['time']        = $data['time'][$i];
            $arr[$i]['bp']          = $data['bp'][$i];
            $arr[$i]['pr']          = $data['pr'][$i];
            $arr[$i]['rr']          = $data['rr'][$i];
            $arr[$i]['o2']          = $data['o2'][$i];
            $arr[$i]['description']   = $data['description'][$i] ?? '';
            $i++;
        }
        $val[$r->vitalsign_type] = $arr;
        Mongo::table("tb_casenote")->where('id' , $data['nid'])->update($val);
        // return redirect(url("note/note/$data[nid]"));
        return redirect()->back();
    }
    public function ck_paper($r)
    {
        $tb_casenote = Mongo::table("tb_casenote")->where("id", $r->nid)->first();
        $tb_casenote[$r->group][$r->subgroup][$r->component] = $r->value;
        Mongo::table("tb_casenote")->where("id", $r->nid)->update($tb_casenote);
    }
    public function radio_paper($r)
    {
        $tb_casenote = Mongo::table("tb_casenote")->where("id", $r->nid)->first();
        $tb_casenote[$r->group][$r->subgroup] = $r->component;
        Mongo::table("tb_casenote")->where("id", $r->nid)->update($tb_casenote);
    }
    public function text_paper($r)
    {
        $tb_casenote = Mongo::table("tb_casenote")->where("id", $r->nid)->first();
        // dd($r->nid ,$tb_casenote);
        $tb_casenote[$r->group][$r->subgroup] = $r->value;
        Mongo::table("tb_casenote")->where("id", $r->nid)->update($tb_casenote);
    }


    public function show($id)
    {
        $view['casedata']                   = Datacase::fromID($id);
        $get_e5                         = Datacase::first($id);
        $wcase[0]                       = array('procedure_code', $get_e5->case_procedurecode);
        $wcaseuniq[0]                   = array('caseuniq', $get_e5->caseuniq);
        $wcaseuniq[1]                   = array('comcreate', $get_e5->comcreate);
        $w[0]                           = array('id', $get_e5->noteid);
        $view['tb_casemedication']      = CASEMEDICATION::checkdata($get_e5, $wcaseuniq);
        $this->createnote($get_e5);
        $view['hospital']               = get_hospital();
        $get_e5                         = Datacase::first($id);
        $case                           = $view['casedata'];
        // $view['tb_procedure']           = Department::procedure(uid());

        // $view['note']                   = (object) Mongo::table('tb_casenote')->where($w)->first();
        $view['nurse']                  = (object) Mongo::table('users')->where("user_type", "nurse")->get();
        $view['doctor']                 = (object) Mongo::table('users')->where("user_type", "doctor")->get();
        $view['patient']                = (object) Mongo::table('tb_patient')->where('hn', $get_e5->case_hn)->first();
        $view['treatment']              = (object) Mongo::table('tb_casenote')->where('_id', $view['casedata']->noteid)->first();
        $view['tb_treatmentcoverage']   = (object) Mongo::table('tb_treatmentcoverage')->get();
        $view['procedure']              = (object) Mongo::table("tb_procedure")->where("code", $case->case_procedurecode)->first();
        $view['procedure_all']          = $this->procedure_all($id);
        $view['otherprocedure']         = Datacase::otherprocedure($case);
        $date                           = date_create($view['patient']->birthdate);
        $date_now                       = date_create(date('Y-m-d'));
        $diff                           = date_diff($date, $date_now);
        $view['age']                    = $diff->format('%Y');
        $view['DOB']                    = date_format($date, "d F,Y");
        // $wnote[0] = array("hn",$case->case_hn);
        // $wnote[1] = array("appointment","like",$case->appointment_date."%");
        // $view['note']                   = (object) Mongo::table('tb_casenote')->where($wnote)->first();
        $w1[0] = array('date', $case->appointment_date);
        $w1[1] = array('hn', $case->case_hn);
        $w1[2] = array('department', $case->department);
        $view['note'] = (object) Mongo::table("tb_casenote")->where($w1)->first();
        $view['caseall']                = Mongo::table('tb_case')->where("noteid", $case->noteid)->get();
        $view['case']                   = Datacase::fromID($id);
        $view['room']                   = Department::room(uid());
        $view['tb_procedure']           = Department::procedure(uid());
        $view['id']                     = $id;
        $view['cid']                    = $id;
        $apppoint                       = explode(" ", $view['casedata']->appointment);
        $folderdate                     = $apppoint[0];
        $view['folderdate']             = $folderdate;
        $view['tab_reportfollowup']    = "active";
        $view['tab_billing']           = "active";
        $view['hn']             = @$case->case_hn;

        // dd($view['note']);
        // $view['nursepdf'] = $this->generate_nursepdf($view['casedata'],$id);

        return view('EndoINDEX.nursereport', $view);
    }

    public function createnote($tb_case)
    {
        if (!isset($tb_case->appointment_date)) {
            $ex = explode(" ", $tb_case->appointment);
            $val['appointment_date'] = $ex[0];
            Mongo::table("tb_case")->where("_id", $tb_case->_id)->update($val);
            $tb_case = (object) Mongo::table("tb_case")->where("_id", $tb_case->_id)->first();
        }


        checkNURSENOTE($tb_case->case_hn, $tb_case->appointment_date, $tb_case->department);

    }

    public function procedure_all($id)
    {
        $tb_case = Mongo::table("tb_case")->where("_id", $id)->first();
        // dd($tb_case);
        $w[] = array('appointment_date', $tb_case['appointment_date']);
        $w[] = array('hn', $tb_case['hn']);
        return  Mongo::table("tb_case")->where($w)->get();
    }


    public function generate_nursepdf($case, $id)
    {
        // $scriptPath = htdocs('endoindex'). "/public/pdf/nursereport.py $id";
        shell_exec("py D:\\laragon\\htdocs\\endoindex\\public\\pdf\\nursereport.py $id");
        // $pdfPath = $this->store_pdfdata($case);
        // try {
        //     $process = new Process(['python', $scriptPath]);
        //     $process->run();
        // } catch (\Throwable $th) {}
        // return $pdfPath;
    }

    public function store_pdfdata($case)
    {
        $folderdate = @$case->appointment_date ?? explode(' ', @$case->appointment . "")[0];
        $hn = @$case->hn ?? @$case->case_hn;
        $datetime   = date('YmdHis');
        if (!empty($folderdate)) {
            $pdf_data = Mongo::table('tb_temppdf')->where('id', 1)->first();
            if (empty($pdf_data)) {
                $i['id'] = 1;
                Mongo::table('tb_temppdf')->insert($i);
            }
            $u['folderdate'] = $folderdate;
            $u['hn'] = $hn;
            $u['datetime'] = $datetime;
            Mongo::table('tb_temppdf')->where('id', 1)->update($u);
        }
        return "store/$hn/$folderdate/pdf/nurse_$hn" . "_$datetime.pdf";
    }
}
