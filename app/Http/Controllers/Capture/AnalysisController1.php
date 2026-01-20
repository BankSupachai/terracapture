<?php

namespace App\Http\Controllers\Capture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Department;
use App\Models\Mongo;

class AnalysisController1 extends Controller
{
    // public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {

            $view['month_all']              = baseMONTH();
            $view['filter_procedure']       = Department::procedure(uid());
            $view['filter_room']            = Department::room(uid());
            $view['filter_scope']           = Department::scope(uid());
            $view['filter_prediagnostic']   = Mongo::table('prediagnostic')->get();
            $view['filter_medication']      = Mongo::table('dd_anesthesis')
            ->select('anesthesis_name')
            ->orderby('anesthesis_name')
            ->distinct()
            ->get();
            $view['hospital']               = get_hospital();
            $view = $this->search($view,$r);
            // dd($view);
            return view('capture.dashboard1.00_main',$view);


    }

    public function show($id,Request $r)
    {

        $view['month_all']              = baseMONTH();
        $view['filter_procedure']       = Department::procedure(uid());
        $view['filter_room']            = Department::room(uid());
        $view['filter_scope']           = Department::scope(uid());
        $view['filter_prediagnostic']   = Mongo::table('prediagnostic')->get();
        $view['filter_medication']      = Mongo::table('dd_anesthesis')
        ->select('anesthesis_name')
        ->orderby('anesthesis_name')
        ->distinct()
        ->get();
        $view['hospital']               = get_hospital();
        $view = $this->search($view,$id);

        $w[] = array('updatetime','!=',"");
        if(isset($r->date))
        {
            if($r->date != 'All'){
                $w[] = array('case_dateregister',"like",$r->date."%");
            }
        }
        if(isset($r->hoscode))
        {
            if($r->hoscode != 'All'){
                $w[] = array('hospitalcode',$r->hoscode);
            }
        }

        // dd($w);

        if ($id == 'diagnosis') {
            $view['diagnostic']         = $this->diagnostic($w,300);
            return view('capture.dashboard.15_fulldiagnosis',$view);
        }
        if ($id == 'intervention') {
            $view['procedure_sub']      = $this->procedure_sub($w,300);
            return view('capture.dashboard.16_fullintervention',$view);
        }
        if ($id == 'physician') {
            $view['physician'] = $this->physician($w,300);
            return view('capture.dashboard.17_fullphysician',$view);
        }
    }


    public function search($view,$r){

        // 10736 รพ.พระจอมเกล้า
        // 11311 รพ.ท่ายาง
        // 11310 รพ.ชะอำ
        $whos01[0]  = array('hospitalcode',"10736");
        $whos02[0]  = array('hospitalcode',"11311");
        $whos03[0]  = array('hospitalcode',"11310");
        $discharged[0] = array("statusjob","discharged");
        // $notest     = array("patientname","not like","notest");

        $w[] = array('updatetime','!=',"");
        // $w[] = array('case_hn',"not like","%test%");
        if(isset($r->date))
        {
            if($r->date != 'All'){
                $w[] = array('case_dateregister',"like",$r->date."%");
            }
        }
        if(isset($r->hoscode))
        {
            if($r->hoscode != 'All'){
                $w[] = array('hospitalcode',$r->hoscode);
            }
        }

        $hos1 = Mongo::table('tb_case')->where($w)->where($whos01)->count();
        $hos2 = Mongo::table('tb_case')->where($w)->where($whos02)->count();
        $hos3 = Mongo::table('tb_case')->where($w)->where($whos03)->count();

        $view['case_count'] = $hos1 + $hos2 + $hos3;


        // $view['case_countdischarged']   = Mongo::table('tb_case')->where($w)->where($discharged)->count();
        // $view['hospital01_count']   = Mongo::table('tb_case')->where($whos01)->count();
        // $view['hospital02_count']   = Mongo::table('tb_case')->where($whos02)->count();
        // $view['hospital03_count']   = Mongo::table('tb_case')->where($whos03)->count();

        $view['hos01_gender']       = $this->gender($w,$whos01,$discharged);
        $view['hos02_gender']       = $this->gender($w,$whos02,$discharged);
        $view['hos03_gender']       = $this->gender($w,$whos03,$discharged);

        $view['case_countdischarged'] = $view['hos01_gender'][0]['val']+$view['hos02_gender'][0]['val']+$view['hos03_gender'][0]['val'];


        $view['agegender_male']     = $this->agegender($w,"1");
        $view['agegender_female']   = $this->agegender($w,"2");
        $view['bowel']              = $this->bowel($w);
        $view['diagnostic']         = $this->diagnostic($w,5);
        $view['procedure_sub']      = $this->procedure_sub($w,5);
        $view['physician']          = $this->physician($w,5);
        $view['treatment']          = $this->treatment($w);
        $view['hos01_cancel'] = $this->possiblecolorectalcancer($w,$whos01);
        $view['hos02_cancel'] = $this->possiblecolorectalcancer($w,$whos02);
        $view['hos03_cancel'] = $this->possiblecolorectalcancer($w,$whos03);

        return $view;
    }


    public function possiblecolorectalcancer($w,$whos){
        $w[] = $whos[0];

        $neww1      = $w;
        $neww2      = $w;
        $neww3      = $w;
        $neww4      = $w;
        $neww1[]    = array('diagnostic','like',"%"."CA Cecum"."%");
        $neww2[]    = array('diagnostic','like',"%"."CA colon"."%");
        $neww3[]    = array('diagnostic','like',"%"."CA Rectum"."%");
        $neww4[]    = array('possiblecolorectalcancer',"yes");
        $tb_case = Mongo::table('tb_case')
        // ->where([$w[0],['diagnostic','like',"%"."CA Cecum"."%"]])
        // ->orWhere([$w[0],['diagnostic','like',"%"."CA colon"."%"]])
        // ->orWhere([$w[0],['diagnostic','like',"%"."CA Rectum"."%"]])
        ->where($neww1)
        ->orWhere($neww2)
        ->orWhere($neww3)
        ->orwhere($neww4)
        ->count();



        return $tb_case;
    }




    public function treatment($w){
        $treatment = Mongo::table('tb_case')->distinct()->get(['treatment_coverage']);
        foreach ($treatment as $step01) {
            $view[$step01] = Mongo::table('tb_case')->where($w)->where('treatment_coverage',$step01)->count();
        }
        arsort($view);
        $view = array_slice($view, 0, 5);
        return $view;
    }


    public function physician($w,$num){
        $doctor = Mongo::table('tb_case')->distinct()->get(['doctorname']);
        foreach ($doctor as $step01) {
            $view[$step01] = Mongo::table('tb_case')->where($w)->where('doctorname',$step01)->count();
        }
        arsort($view);
        $view = array_slice($view, 0, $num);
        return $view;
    }





    public function bowel($w){
        $view['Excellent']  = Mongo::table('tb_case')->where($w)->where('bowel','Excellent')->count();
        $view['Good']       = Mongo::table('tb_case')->where($w)->where('bowel','Good')->count();
        $view['Fair']       = Mongo::table('tb_case')->where($w)->where('bowel','Fair')->count();
        $view['Poor']       = Mongo::table('tb_case')->where($w)->where('bowel','Poor')->count();
        return $view;
    }

    public function diagnostic($w){
        $colono = Mongo::table('tb_procedure')->where('code','gi002')->first();
        foreach ($colono['icd10'] as $step01) {
            foreach($step01 as $key=>$value) {
                $view[$value['name']] = Mongo::table('tb_case')->where($w)->where('diagnostic','like',"%".$value['name']."%")->count();
            }
        }
        arsort($view);
        $view = array_slice($view, 0, 5);
        return $view;
    }


    public function procedure_sub($w){
        $colono = Mongo::table('tb_procedure')->where('code','gi002')->first();
        foreach ($colono['icd9'] as $step01) {
            foreach($step01 as $key=>$value) {
                $view[$value['name']] = Mongo::table('tb_case')->where($w)->where('procedure_sub','like',"%".$value['name']."%")->count();
            }
        }
        arsort($view);
        $view = array_slice($view, 0, 5);
        return $view;
    }






    public function store(Request $r)
    {
        // dd($r->all());
        $w[0]       = array('report_cid','>',0);
        $procedure  = array();
        if(isset($r->filter_procedure)){
            array_push($procedure,$r->filter_procedure);
        }else{
            $proce      = Department::procedure(uid());
            foreach($proce as $p){
                $p = (object) $p;
                array_push($procedure,$p->name);
            }
        }
        $arr        = array();
        $month_all  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $year_all   = yearALL();
        if(checkNULL($r->year))             {$w[0]  = array('report_appointment_year',$r->year);}
        if(checkNULL($r->month))            {$w[1]  = array('report_appointment_month',$r->month);}
        if(checkNULL($r->procedure))        {$w[2]  = array('report_procedure',$r->procedure);}
        if(checkNULL($r->age))              {$w[3]  = array('report_age',$r->age);}
        if(checkNULL($r->room))             {$w[4]  = array('report_room',$r->room);}
        if(checkNULL($r->icd10))            {$w[5]  = array('report_diagnostic','like','%'.$r->icd10.'%');}
        if(checkNULL($r->icd9))             {$w[6]  = array('report_procedure_icd9','like','%'.$r->icd9.'%');}
        if(checkNULL($r->scope))            {$w[7]  = array('report_scope','like','%'.$r->scope.'%');}
        if(checkNULL($r->prediagnostic))    {$str   = explode('...',$r->prediagnostic);$w[8]  = array('report_prediagnosis','like','%'.$str[0].'%');}
        if(checkNULL($r->medication))       {$w[9]  = array('report_medication','like','%'.$r->medication.'%');}
        if(checkNULL($r->finding))          {$w[10] = array('report_finding','like','%'.$r->finding.'%');}

        $year                   = $this->year                   ($w,$r,$procedure);
        $month                  = $this->month                  ($w,$r,$procedure);
        $arr['data_procedure']  = $this->procedure              ($w,$r,$procedure);
        $arr['age']             = $this->age_normal             ($w,$r,$procedure);
        $arr['gender']          = $this->gender                 ($w,$r,$procedure);
        $arr['room']            = $this->room                   ($w,$r,$procedure);
        $icd10                  = $this->icd10                  ($w,$r,$procedure);
        $icd9                   = $this->icd9                   ($w,$r,$procedure);
        $scope                  = $this->scope                  ($w,$r,$procedure);
        $prediagnostic_other    = $this->prediagnostic_other    ($w,$r,$procedure);
        $arr['allcase']         = $this->allcase                ($w,$r,$procedure);
        $arr['allpatient']      = $this->allpatient             ($w,$r,$procedure);
        $arr['alldoctor']       = count(Department::user('doctor'));
        $arr['allnurse']        = count(Department::user('nurse'));
        $arr['allroom']         = count(Department::room(uid()));
        $medication             = $this->medication             ($w,$r,$procedure);
        $arr['finding']         = $this->finding                ($w,$r,$procedure);

        $i = 0;
        foreach($year_all as $m){
            $arr['year'][$i]['country']  = $m;
            $arr['year'][$i]['visits']   = 0;
            foreach($year as $key=>$val){
                if($key==$m){
                    $arr['year'][$i]['visits'] = $val;
                }
            }
            $i++;
        }


        $i = 0;
        foreach($month_all as $m){
            $arr['month'][$i]['country']  = $m;
            $arr['month'][$i]['visits']   = 0;
            foreach($month as $key=>$val){
                if($key==$m){

                    if($val==0){
                        $arr['month'][$i]['visits'] = 0;
                    }else{
                        $arr['month'][$i]['visits'] = $val;
                    }

                }
            }
            $i++;
        }

        $i=0;
        foreach($icd10 as $key=>$val){
            if($i<5){
                $arr['icd10_show5'][$i]['category']  = $key;
                $arr['icd10_show5'][$i]['value']   = $val;
            }
                $arr['icd10_showall'][$i]['country']= $key;
                $arr['icd10_showall'][$i]['visits'] = $val;
            $i++;
        }

        $i=0;
        foreach($icd9 as $key=>$val){
            if($i<5){
                $arr['icd9_show5'][$i]['category']  = $key;
                $arr['icd9_show5'][$i]['value']   = $val;
            }
                $arr['icd9_showall'][$i]['country']  = $key;
                $arr['icd9_showall'][$i]['visits']   = $val;
            $i++;
        }

        $i=0;
        $color = array("#84e0db","#56bbb5","#3e9e9d","#1f827d","#065852","#354749");
        foreach($medication as $key=>$val){
            if($i<5){
                $arr['medication_show5'][$i]['country']     = $key;
                $arr['medication_show5'][$i]['value']      = $val;
                $arr['medication_show5'][$i]['color']      = $color[$i];
            }
                $arr['medication_showall'][$i]['country']  = $key;
                $arr['medication_showall'][$i]['value']   = $val;
            $i++;
        }

        $i=0;
        foreach($scope as $key=>$val){
            if($i<5){
                $arr['scope_show5'][$i]['country']  = $key;
                $arr['scope_show5'][$i]['visits']   = $val;
            }
                $arr['scope_showall'][$i]['country']  = $key;
                $arr['scope_showall'][$i]['visits']   = $val;
            $i++;
        }


        $json = jsonEncode($arr);
        echo $json;
    }


    public function gender($w,$hos,$discharged){
        $view[1]['key']     ='male';
        $view[1]['val']     = Mongo::table('tb_case')
        ->where($w)
        ->where($hos)
        ->where("statusjob","!=","discharged")
        ->count();
        $view[1]['color']   = '#84e0db';

        $view[0]['key']     ='female';
        $view[0]['val']     = Mongo::table('tb_case')
        ->where($w)
        ->where($hos)
        ->where($discharged)
        ->count();
        $view[0]['color']   = '#354749';
        $view['all'] = $view[0]['val'] + $view[1]['val'];
        return $view;
    }

    public function allcase($w,$r,$procedure)
    {
        $num = DB::connection('endocapture_server')
        ->table('tb_report')
        ->where($w)
        ->whereIn('report_procedure', $procedure)
        ->count();
        return $num;
    }

    public function allpatient($w,$r,$procedure)
    {
        /* mockup รามา
        $num = DB::connection('endocapture_server')
        ->table('tb_report')->where($w)
        ->whereIn('report_procedure', $procedure)
        ->distinct('report_hn')
        ->count();
        return $num;
        */

        $num = DB::connection('endocapture_server')
        ->table('tb_report')->where($w)
        ->whereIn('report_procedure', $procedure)
        // ->distinct('report_hn')
        ->count();
        return $num;

    }

    public function year($w,$r,$procedure)
    {
        $view = array();
        $yearscope = array('2019', '2020', '2021', '2022');
        foreach ($yearscope as $year) {
            if(checkNULL($r->year)){
                $w[0] = array('report_appointment_year', $r->year);
                // $view[$r->year] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$r->year] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }else{
                $w[0] = array('report_appointment_year', $year);
                // $view[$year] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$year] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }
        }
        return $view;
    }

    public function month($w,$r,$procedure)
    {
        // dd($w, $r->month, $procedure);
        $view = array();
        $monthscope = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        foreach ($monthscope as $month) {
            if(checkNULL($r->month)){
                $w[1] = array('report_appointment_month',$r->month);
                $view[$r->month] =
                // DB::connection('endocapture_server')
                // ->table('tb_report')
                Mongo::table('tb_report')
                ->where($w)
                ->whereIn('report_procedure', $procedure)
                ->count();
            }else{
                $w[1] = array('report_appointment_month',$month);
                $view[$month] =
                // DB::connection('endocapture_server')
                // ->table('tb_report')
                Mongo::table('tb_report')
                ->where($w)
                // ->where($wh)
                ->whereIn('report_procedure', $procedure)
                ->count();
            }
        }
        return $view;
    }

    public function procedure($w,$r,$procedure)
    {
        $view = array();
        $procedureall = Department::procedure(uid());
        foreach ($procedureall as $pro) {
            $pro = (object) $pro;
            if(checkNULL($r->filter_procedure)){
                $w[2]  = array('report_procedure',$r->filter_procedure);
                // $view[$r->procedure] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$r->procedure] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();

            }else{
                $w[2] = array('report_procedure',$pro->name);
                // $view[$pro->name] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$pro->name] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }
        }
        return $view;
    }


    public function agegender($w,$gender){
        $view = array();
        $w[98]   = array('gender', $gender);
        $w[99]  = array('age', '>', 0);
        $w[100] = array('age', '<=', 20);

        $view[0]['key'] ='0-20';
        $view[0]['val']  = Mongo::table('tb_case')->where($w)->count();

        $w[99]  = array('age', '>', 20);
        $w[100] = array('age', '<=', 40);
        $view[1]['key'] ='21-40';
        $view[1]['val']= Mongo::table('tb_case')->where($w)->count();

        $w[99]  = array('age', '>', 40);
        $w[100] = array('age', '<=', 60);
        $view[2]['key'] ='40-60';
        $view[2]['val']= Mongo::table('tb_case')->where($w)->count();

        $w[99]  = array('age', '>', 60);
        $w[100] = array('age', '<=', 80);
        $view[3]['key'] ='60-80';
        $view[3]['val']= Mongo::table('tb_case')->where($w)->count();

        $w[99]  = array('age', '>', 80);
        $w[100] = array('age', '<=', 150);
        $view[4]['key'] ='80up';
        $view[4]['val'] = Mongo::table('tb_case')->where($w)->count();
        return $view;
        dd($view);
    }

    public function age($w,$r,$procedure)
    {
        $view = array();
        $w[99]  = array('report_age', '>', 0);
        $w[100] = array('report_age', '<=', 20);

        $w[98]  = array('report_gender', 'male');
        // $view['0-20']['male']    = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['0-20']['male']    = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();

        $w[98]  = array('report_gender', 'female');
        // $view['0-20']['female']  = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['0-20']['female']  = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();

        $w[99]  = array('report_age', '>', 20);
        $w[100] = array('report_age', '<=', 40);
        $w[98]  = array('report_gender', 'male');
        // $view['21-40']['male']    = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['21-40']['male']    = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $w[98]  = array('report_gender', 'female');
        // $view['21-40']['female']  = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['21-40']['female']  = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();

        $w[99]  = array('report_age', '>', 40);
        $w[100] = array('report_age', '<=', 60);
        $w[98]  = array('report_gender', 'male');
        // $view['40-60']['male']    = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['40-60']['male']    = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $w[98]  = array('report_gender', 'female');
        // $view['40-60']['female']  = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['40-60']['female']  = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();

        $w[99]  = array('report_age', '>', 60);
        $w[100] = array('report_age', '<=', 80);
        $w[98]  = array('report_gender', 'male');
        // $view['60-80']['male']    = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['60-80']['male']    = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $w[98]  = array('report_gender', 'female');
        // $view['60-80']['female']  = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['60-80']['female']  = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();

        $w[99]  = array('report_age', '>', 80);
        $w[100] = array('report_age', '<=', 150);
        $w[98]  = array('report_gender', 'male');
        // $view['80up']['male']    = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['80up']['male']    = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $w[98]  = array('report_gender', 'female');
        // $view['80up']['female']  = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
        $view['80up']['female']  = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();


        return $view;

    }

    public function room($w,$r,$procedure)
    {
        $view = array();
        $roomall = Department::room(uid());
        foreach ($roomall as $room) {
            $room = (object) $room;
            if(checkNULL($r->room)){
                $w[4]  = array('report_room',$r->room);
                $view[$r->room] =
                // DB::connection('endocapture_server')
                // ->table('tb_report')
                Mongo::table('tb_report')
                ->where($w)
                ->whereIn('report_procedure', $procedure)
                ->count();
            }else{
                $w[4] = array('report_room',$room->room_name);
                $view[$room->room_name] =
                // DB::connection('endocapture_server')
                // ->table('tb_report')
                Mongo::table('tb_report')
                ->where($w)
                ->whereIn('report_procedure', $procedure)
                ->count();
            }
        }
        return $view;
    }


    public function icd10($w,$r,$procedure)
    {
        $view = array();
        // $diagnostic = DB::connection('endocapture_server')->table('tb_diagnostic')->get();
        $diagnostic = Mongo::table('tb_diagnostic')->get();
        foreach ($diagnostic as $diag) {
            $diag = (object) $diag;
            if(checkNULL($r->icd10)){
                $w[5] = array('report_diagnostic','like','%'.$r->icd10.'%');
                // $view[$r->icd10] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$r->icd10] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }else{
                $w[5] = array('report_diagnostic','like','%'.$diag->diagnostic_name.'%');
                // $view[$diag->diagnostic_name] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$diag->diagnostic_name] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }
        }
        arsort($view);
        return $view;
    }

    public function icd9($w,$r,$procedure)
    {
        $view = array();
        // $tb_procedureicd9 = DB::connection('endocapture_server')->table('tb_procedureicd9')->get();
        $tb_procedureicd9 = Mongo::table('tb_procedureicd9')->get();
        foreach ($tb_procedureicd9 as $icd) {
            $icd = (object) $icd;
            if(checkNULL($r->icd9)){
                $w[6] = array('report_procedure_icd9','like','%'.$r->icd9.'%');
                // $view[$r->icd9] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$r->icd9] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }else{
                $w[6] = array('report_procedure_icd9','like','%'.$icd->proicd9_name.'%');
                // $view[$icd->proicd9_name] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$icd->proicd9_name] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }
        }
        arsort($view);
        return $view;
    }

    public function scope($w,$r,$procedure)
    {
        $view   = array();
        // $scope  = DB::connection('endocapture_server')->table('tb_scope')->get();
        $scope  = Mongo::table('tb_scope')->get();
        foreach ($scope as $s) {
            $s = (object) $s;
            if(checkNULL($r->scopre)){
                $w[7] = array('report_scope','like','%'.$r->scope.'%');
                // $view[$r->scope] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$r->scope] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }else{
                $w[7] = array('report_scope','like','%'.$s->scope_name.'%');
                // $view[$s->scope_name] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$s->scope_name] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }
        }
        arsort($view);
        return $view;
    }

    public function medication($w,$r,$procedure)
    {
        $view   = array();
        // $dd_anesthesis  = DB::connection('endocapture_server')->table('dd_anesthesis')->get()->unique('anesthesis_name');
        $dd_anesthesis  = Mongo::table('dd_anesthesis')->get()->unique('anesthesis_name');
        foreach ($dd_anesthesis as $s) {
            $s = (object) $s;
            if(checkNULL($r->medication)){
                $w[9]  = array('report_medication','like','%'.$r->medication.'%');
                // $view[$r->medication] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$r->medication] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }else{
                $w[9] = array('report_medication','like','%'.$s->anesthesis_name.'%');
                // $view[$s->anesthesis_name] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$s->anesthesis_name] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }
        }
        arsort($view);
        return $view;
    }

    public function prediagnostic_other($w,$r,$procedure)
    {
        $view = array();
        // $pre = DB::connection('endocapture_server')->table('autotext')->where('auto_textid','prediagnostic_other')->select('auto_text')->get();
        $pre = Mongo::table('autotext')->where('auto_textid','prediagnostic_other')->select('auto_text')->get();
        foreach($pre as $p)
        {
            $p = (object) $p;
            if(checkNULL($r->prediagnostic)){
                $str = explode('...',$r->prediagnostic);
                $w[8]  = array('report_prediagnosis','like','%'.$str[0].'%');
                // $view[$r->prediagnostic] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$r->prediagnostic] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }else{
                $w[8] = array('report_prediagnosis',$p->auto_text);
                // $view[$p->auto_text] = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
                $view[$p->auto_text] = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            }
        }
        arsort($view);
        return $view;
    }

    public function finding($w,$r,$procedure)
    {
        $view   = array();
        $w[]    = array('report_finding','like','%'.$r->finding.'%');
        if(checkNULL($r->finding)){
            // $count = DB::connection('endocapture_server')->table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            $count = Mongo::table('tb_report')->where($w)->whereIn('report_procedure', $procedure)->count();
            $view[0]['country'] = $r->finding;
            $view[0]['visits']  = $count;
        }else{
            $view[0]['country'] ='';
            $view[0]['visits']  = 0;
        }
        return $view;
    }



}
