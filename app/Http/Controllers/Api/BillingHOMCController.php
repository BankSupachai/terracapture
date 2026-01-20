<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class BillingHOMCController extends Controller
{

    public function index(Request $r)
    {

        $view['case_list']  = $this->case_list($r);
        $view['case_data']  = $this->case_data($r);
        $view['patient']    = $this->patient($r);

        $serverconnect = @fsockopen(getCONFIG("admin")->server_name, portnumber(), $errno, $errstr, 1);
        if($serverconnect){
            return view('endobilling.homc.index', $view);
        }else{
            return view('endocapture.iframe/export_excell');
        }
    }

    public function show($id,Request $r)
    {
        $hn     = $r->hn;
        $date   = $r->date;
        $str = "D:\python\billing\__pycache__\step01.cpython-39.pyc $hn $date";
        exec($str);
    }

    public function create(Request $r)
    {

    }

    public function case_list($r){
        if (isset($r->search)) {
            $val = DB::table('tb_case')
            ->where('case_json', 'like', "%$r->search%")
            ->where('case_status',2)
            ->where('case_dateappointment','like',date('Y-m-d')."%")
            ->orwhere('case_hn',$r->search)
            ->orderBy('case_id','desc')
            ->paginate(200);
        } else {
            $val = DB::table('tb_case')
            ->where('case_status',2)
            ->where('case_dateappointment','like',date('Y-m-d')."%")
            ->orderBy('case_id', 'desc')
            ->paginate(200);
        }
        return $val;
    }

    public function case_data($r){
        $val = "";
        if (isset($r->hn)) {
            $val = DB::table('tb_case')
            ->where('case_hn', $r->hn)
            ->where('case_status',2)
            ->where('case_dateappointment','like',$r->date."%")
            ->orderBy('case_id','desc')
            ->paginate(200);
        }
        return $val;
    }

    public function patient($r){
        $val = "";
        if (isset($r->hn)) {
            $val = DB::table('patient')->where('hn',$r->hn)->first();
        }
        return $val;
    }


    public function store(Request $r)
    {
        if(isset($r->event)){
            if($r->event=="step01")             {$this->step01($r);}
            if($r->event=="step02")             {$this->step02($r);}
            if($r->event=="step03")             {$this->step03($r);}
            if($r->event=="step04")             {$this->step04($r);}
            if($r->event=="emr_send")           {$this->emr_send($r);}
            if($r->event=="createbilling")      {
                $this->createbilling($r);
                return redirect("billhomc?search=&bill=true&hn=$r->hn&date=$r->date");
            }
        }
    }


    public function emr_send($r){
        $case           = DB::table('tb_case')->where('case_id',$r->cid)->first();
        $apppoint       = explode(" ",$case->case_dateappointment);
        $folderdate     = $apppoint[0];
        $hn             = $case->case_hn;
        $caseuniq       = $case->caseuniq;
        $date           = date('dmY');
        $doctor         = DB::table('users')->where('id',$case->case_physicians01)->first();
        $departmentcode = "1214";
        $newfile    = $hn."_".$date."_".$departmentcode."_".$doctor->user_code.".pdf";
        $path_ori   = storePATH("$hn\\$folderdate\pdf\\$caseuniq.pdf");
        $path_copy  = "w:\\$newfile";
        copy($path_ori,$path_copy);
    }



    public function createbilling($r){
        if($r->doctorcode=="have_no_doctor" || $r->doctorcode==""){
            dd($r->doctorname,"ไม่พบรหัสแพทย์");
        }

        $timeuse = 0;
        foreach($r->time as $time){
            $timeuse = $timeuse+$time;
        }


        $timeuse = ($timeuse/60*100)/100;
        $timeuse = number_format((float)$timeuse, 2, '.', '');

        $val['billing_timeuse']     = $timeuse;
        $val['billing_hn']          = $r->hn;
        $val['billing_date']        = $r->date;
        $val['billing_doctor']      = $r->doctorcode;
        $val['billing_department']  = $r->department;

        $arr10 = array();
        $i=0;
        foreach($r->icd10code as $data){
            $arr10[$i] = $data;
            $i++;
        }
        $val['billing_icd10'] = jsonEncode($arr10);


        $arr9 = array();
        $i=0;
        foreach($r->icd9code as $data){
            $arr9[$i]['code'] = $data;
            $arr9[$i]['discount'] = $r->discount[$i];
            $i++;
        }
        $val['billing_icd9'] = jsonEncode($arr9);

        $w[0] = array('billing_hn',$r->hn);
        $w[1] = array('billing_date',$r->date);
        $billing = DB::table('tb_casebilling')->where($w)->first();
        if($billing==null){
            DB::table('tb_casebilling')->insert($val);
        }else{
            DB::table('tb_casebilling')->where($w)->update($val);
        }
    }



    public function step01($r){
        $hn     = $r->hn;
        $date   = $r->date;
        $str = "D:\python\billing\__pycache__\step01.cpython-39.pyc $hn $date";
        exec($str);
    }

    public function step02($r){
        exec("D:\python\billing\__pycache__\step02.cpython-39.pyc");
    }

    public function step03($r){
        exec("D:\python\billing\__pycache__\step03.cpython-39.pyc");
    }

    public function step04($r){
        exec("D:\python\billing\__pycache__\step04.cpython-39.pyc");
    }









}
