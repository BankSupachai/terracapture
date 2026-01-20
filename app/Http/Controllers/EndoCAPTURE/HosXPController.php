<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use DB;
use Image;
use Illuminate\Http\Request;

class HosXPController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $r)
    {
        $view = array();
        // select o.hn, Concat(p.pname, p.fname, ' ', p.lname) as tname ,
        // p.cid     ,
        // p.sex ,
        // v.age_y    ,
        // s.pttype  ,
        // s.name   ,
        // pr.name ,
        // d.name,
        // i.name    ,
        // oa.nextdate
        // from ovst o
        // left outer join vn_stat v ON v.vn = o.vn
        // left outer join patient p on p.hn =  o.hn
        // left outer join pttype s ON s.pttype = o.pttype
        // left outer join icd101 i ON i.code = v.main_pdx
        // left outer join doctor d ON d.code = o.doctor
        // left outer join oapp oa ON oa.hn = o.hn
        // left outer join provis_aptype pr ON pr.code = o.hn
        // where oa.nextdate between "2021-08-17" and "2021-08-17" and o.main_dep in("317","902")
        // limit 1000

        // ####################
        // $ddd =DB::connection('pgsql')->table('patient')
        // ->limit(30)
        // ->get();


        $f[0]   = "patient.hn";
        $f[1]   = "patient.sex";
        $f[2]   = "vn_stat.age_y";
        $f[3]   = "pttype.pttype as ptt_code";
        $f[4]   = "pttype.name as ptt_name";
        $f[5]   = "provis_aptype.name as provis_aptype_name";
        $f[6]   = "doctor.pname as doctor_prefixname";
        $f[7]   = "doctor.fname as doctor_firstname";
        $f[8]   = "doctor.lname as doctor_lastname";
        $f[9]   = "icd101.name as icd10_name";
        $f[10]  = "oapp.nextdate as requestdate";
        $f[11]  = "patient.pname as patient_prefixname";
        $f[12]  = "patient.fname as patient_firstname";
        $f[13]  = "patient.lname as patient_lastname";

        $tb_his = DB::connection('pgsql')->table('ovst')
        ->select($f)
        ->leftjoin('vn_stat','vn_stat.vn','ovst.vn')
        ->leftjoin('patient','patient.hn','ovst.hn')
        ->leftjoin('pttype','pttype.pttype','ovst.pttype')
        ->leftjoin('icd101','icd101.code','vn_stat.main_pdx')
        ->leftjoin('doctor','doctor.code','ovst.doctor')
        ->leftjoin('oapp','oapp.hn','ovst.hn')
        ->leftjoin('provis_aptype','provis_aptype.code','ovst.hn')
        ->where('oapp.nextdate',date('Y-m-d'))
        ->whereIn('ovst.main_dep',["317","902"])
        ->get();

        foreach($tb_his as $his){$this->havedata($his);}

        icd10_name
        $view['tb_hisconnect']  = DB::table('tb_hisconnect')->where('his_status',0)
        ->whereDate('his_date',date('Y-m-d'))
        ->get();

        $json = jsonEncode($view['tb_hisconnect']);
        echo $json;
    }





    public function checkHN($j){
        // $exname             = explode(" ",$j->PTNAME);

        $val['hn']          = $j->hn;
        $val['firstname']   = $j->patient_firstname;
        $val['lastname']    = $j->patient_lastname;
        $year               = date('Y')-$j->age_y;
        $val['birthdate']   = $year."-01-01";
        if($j->sex=="ชาย"){$gender = 1;}else{$gender = 2;}
        $val['gender']      = $gender;
        $patient = DB::table('patient')->where('hn',$j->hn)->first();
        if($patient==null){
            DB::table('patient')->insert($val);
        }
    }

}
