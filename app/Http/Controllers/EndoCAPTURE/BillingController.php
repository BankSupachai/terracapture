<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use DB;
use Image;

use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $r){


    }


    public function show($id)
    {

        $val['tb_case']             = DB::table('tb_case')->where('case_id',$id)->first();
        $apppoint                   = explode(" ",$val['tb_case']->case_dateappointment);
        $val['folderdate']          = $apppoint[0];


        $val['json']                = jsonDecode($val['tb_case']->case_json);

        $val['casedata']            = DB::table('tb_case')
        ->join('patient', 'tb_case.case_hn','patient.hn')
        ->join('dd_gender', 'patient.gender','dd_gender.gender_id')
        ->join('tb_procedure', 'tb_case.case_procedurecode', 'tb_procedure.procedure_code')
        ->where('case_id', $id)
        ->first();

        $val['hospital']            = get_hospital();
        $val['size_page']           = '50%';
        $val['right_page']          = '48%';
        $val['position']            = 1;
        $val['picperrow']           = 4;
        $val['right_page']          = '65%';
        $val['showprocedure']       = true;
        $val['num1']                = 1000;    //8 จำนวนรูปที่แสดงในหน้าแรก
        $val['num2']                = 1000;    //9 จำนวนรูปที่แสดงในหน
        $val['view']                = "endocapture.pdf.page_accessory";
        $val['leftpagewidth']       =  "width:10cm;";
        $val['num3']                = 1000;
        $val['picperpage']          = 1000;
        $val['doctor01']            = DB::table('tb_case as tc')->join('users as u', 'tc.case_physicians01', 'u.id')->where('tc.case_id', '=', $id)->first();

        $val    = $this->totaltime($val);
        $val    = $this->staffname($val);
        $val    = $this->scopeall($val);


        $val['html'] = '';
        $view = view($val['view'])->with($val);
        $val['html'] .= $view->render();
        $val    = $this->html($val);
        $pdf    = PDF::loadHtml($val['html']);
        return $pdf->stream();
    }

    public function book($id){

    }

    public function html($val){
        $val['html'] = '';
        $view = view($val['view'])->with($val);
        $val['html'] .= $view->render();
        return $val;
    }

    public function scopeall($val){
        $val['scopeall'] = array();
        if(isset($val['json']->endoscope)){
            foreach($val['json']->endoscope as $endoscope){
                $tb_scope = DB::table('tb_scope')->where('scope_id',$endoscope)->first();
                if(isset($tb_scope->scope_name)){
                    $val['scopeall'][]=$tb_scope->scope_name;
                }
            }
        }
        return $val;
    }

    public function checkUSERNULL($uid){
        $user   = DB::table('users')->where('id',$uid)->first();
        $str    = "";
        if($user!=null){
            $str.= $user->user_prefix;
            $str.= $user->user_firstname." ";
            $str.= $user->user_lastname;
        }
        return $str;
    }


    public function staffname($val){
        $pati = $val['casedata']->firstname.$val['casedata']->lastname;
        if (!preg_match('/[^A-Za-z0-9]/', $pati)){
            if($val['doctor01']->name!=""){
                // $val['doctor'][1]   = $val['doctor01']->name;
                $val['doctor'][1]   = @$val['json']->doctorname."";
            }else{
                $val['doctor'][1]   = @$val['json']->doctorname."";
            }
        }else{
            $val['doctor'][1]   = @$val['json']->doctorname."";
        }
        $val['doctor'][2]   = $this->checkUSERNULL(@$val['json']->physicians02);
        $val['doctor'][3]   = $this->checkUSERNULL(@$val['json']->physicians03);
        $val['doctor'][4]   = $this->checkUSERNULL(@$val['json']->physicians04);
        $val['nurse'][1]    = $this->checkUSERNULL(@$val['json']->nurse01);
        $val['nurse'][2]    = $this->checkUSERNULL(@$val['json']->nurse02);
        $val['nurse'][3]    = $this->checkUSERNULL(@$val['json']->nurse03);
        $val['nurse'][4]    = $this->checkUSERNULL(@$val['json']->nurse04);
        return $val;
    }

    public function totaltime($val){
        $val['totaltime'] = ' - ';
        if(isset($val['json']->time_start) && isset($val['json']->time_finish)){
            $val['totaltime'] = $val['json']->time_start." - ".$val['json']->time_finish;
            $start      = new Carbon($val['json']->time_start);
            $end        = new Carbon($val['json']->time_finish);
            $toltal     = Carbon::parse($start)->diffInMinutes($end);
            $val['totaltime'] .= " [".$toltal."] นาที";
        }
        return $val;
    }




    public function store(Request $r){
        $head = configTYPE('pdf','pdf_folder_head');

        if(isset($r->event)){
            if($r->event=="billing_file"){
                $view['cid'] = $r->cid;
                return view("his.$head.bill",$view);
            }
        }
    }





}
