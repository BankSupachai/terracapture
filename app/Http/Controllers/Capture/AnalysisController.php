<?php

namespace App\Http\Controllers\capture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use stdClass;

class AnalysisController extends Controller
{
    public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {
        // dd($r);
        if(Server::check_connection()){return redirect(url('servererror'));}

        $view = $this->init();
        $need_filter = Session::get('need_filter');
        if($need_filter == 'true'){
            $r      = Session::get('filter');
            $r      = jsonDecode($r);
            $view   = $this->search($view,$r);
        } else {
            $view = $this->search($view, $r);
        }

        if(isMobile()){

            $view = $this->show_all_graph($r, '', $view);
            // return view('Endocapture.home.mockup.dashboardipad.dataanalyze', $view);
        }
        return view('capture.Dashboard02.main',$view);

    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=="filter_search")                                {return $this->request_filter($r);}
        }
    }

    public function request_filter(Request $r){
        Session::put('need_filter', 'true');
        Session::put('filter', json_encode($r->all()));
        if(isset($r->clear)){
            Session::forget('filter');
            Session::forget('need_filter');
        }
        return redirect(url('analysis'));
    }

    public function init(){
        $view['month_all']              = baseMONTH();
        $view['filter_procedure']       = Department::procedure(uid());
        $view['filter_room']            = Department::room(uid());
        $view['filter_scope']           = Department::scope(uid());
        $view['filter_department']      = Server::table('tb_department')->get() ?? [];
        $view['hospital']               = get_hospital_config();
        $view['filter_prediagnostic']   = Server::table('prediagnostic')->get() ?? [];
        $view['filter_doctor']          = $this->get_staff_count('doctor', null, true, false);
        // $view['filter_doctor']          = Department::user(uid());
        $view['menu']                   = 'home';
        $view['filter_medication']      = Server::table('dd_anesthesis')
        ->select('anesthesis_name')
        ->orderby('anesthesis_name')
        ->distinct()
        ->get();
        return $view;
    }


    public function search($view,$r){

        $wc[0]     = array('updatetime', '!=', '');
        $wc[1]     = array('statusjob', '!=', 'cancel');
        $wc[2]     = array('statusjob', '!=', 'delete');
        $wc[3]     = array('case_status', '!=', 90);
        $wp[0]     = array('user_firstname', '!=', '');

        $wr[0]     = array("room_type","capture");

        if(isset($r->event)){
            if(isset($r->date_from)){
                $new_date = "$r->date_from 00:00";
                $wc[] = array('appointment', '>=', $new_date);
                $view['filter_datefrom'] = $new_date;
            }

            if(isset($r->date_to)){
                $new_date = "$r->date_to 23:59";
                $wc[] = array('appointment', '<=', $new_date);
                $view['filter_dateto'] = $new_date;
            }

            if(isset($r->physician)){
                // dd($wc);
                $wc[] = array('doctorname', $r->physician);
                $view['filter_physician'] = $r->physician;
            }

            if(isset($r->procedure)){
                $wc[] = array('procedurename', $r->procedure);
                $view['filter_procedurename'] = $r->procedure;
            }

            if(isset($r->department)){
                $wc[] = array('department', $r->department);
                $wr[] = array('room_department', $r->department);
                $view['department'] = $r->department;
            }

        }

        // $department = uget('department') ?? 'GI';
        $department = @$r->department;
        // $wc[] = array('department', $department);

        $view['cases']                  = Server::table('tb_case')->where($wc)->get();
        $view['patients']               = $this->get_patient($wc);
        $view['doctors']                = $this->get_staff_count('doctor', $department);
        $view['nurses']                 = $this->get_staff_count('nurse', $department);
        $view['nurses_anes']            = $this->get_staff_count('nurse_anes', $department);
        $view['anes']                   = $this->get_staff_count('anesthesia', $department);
        $view['nurses_assit']           = $this->get_staff_count('viewer', $department);
        $view['doctor_active']          = $this->get_staff_count('doctor', $department, true);
        $view['nurse_active']           = $this->get_staff_count('nurse', $department, true);
        $view['nurse_anes_active']      = $this->get_staff_count('nurse_anes', $department, true);
        $view['anes_active']            = $this->get_staff_count('anesthesia', $department, true);
        $view['nurses_assit_active']    = $this->get_staff_count('viewer', $department, true);
        // $view['rooms']                  = Server::table('tb_room')
        //                                     // ->where("room_type","capture")
        //                                     // ->where('room_department', $department)
        //                                     ->where($wr)
        //                                     ->get();
        // $view['scopes']                 = isset($department) ? Server::table('tb_scope')->where(function($query) use ($department){
        //                                     $query->where('scope_department', $department)
        //                                     ->orWhereRaw(['scope_department' => ['$in' => [$department]]]);
        //                                 })->get() : Server::table('tb_scope')->get();

        $view['rooms']                      = $this->get_key_department('room', $department);
        $view['scopes']                     = $this->get_key_department('scope', $department);
        $view['procedure']                  = $this->get_procedure($wc, $r, $view);
        $view['treatment_coverage']         = $this->get_treatment_coverage($wc, $r);
        $view['tb_treatment']               = Server::table('tb_treatmentcoverage')->get();
        $view['age']                        = $this->get_age($wc, $r);
        // to here
        $view['diagnosis']                  = $this->get_icd10($view['cases'], $r);
        $view['intervention']               = $this->get_icd9($view['cases'], $r);
        $view['complication']               = $this->get_complication($view['cases'], $r);
        $view['physician']                  = $this->get_physician($view['cases'], $r);
        $view['bowel']                      = $this->get_bowel($view['cases'], $r);
        $view['gastric']                    = $this->get_gastric_content($view['cases'], $r);
        $view['rapid']                      = $this->get_rapid($view['cases'], $r);
        return $view;

    }

    public function get_casedata($key, $w){
        $tb_case = Server::table('tb_case')
                    ->where($w)
                    ->where($key, '!=', "")
                    ->groupBy($key, 'caseuniq')
                    ->get()
                    ->pluck($key)
                    ->toArray();

        $tb_case = array_filter($tb_case);
        if(isset($tb_case)){
            $procedurecount = array_count_values($tb_case) ?? [];
            $keys = array_keys($procedurecount) ?? [];
        } else {
            $procedurecount = [];
            $keys = [];
        }
        $arr['tb_case'] = $tb_case ?? [];
        $arr[$key]      = $procedurecount ?? [];
        $arr['keys']    = $keys ?? [];
        return $arr;
    }

    public function get_staff_count($type, $department, $is_active=false, $is_count=true){
        $data = [];
        if(@$department."" != ""){
            $w1[] = array('department_name', $department);
            $data = Server::table("tb_department")->where($w1)->get() ?? collect();
        } else{
            $data = Server::table("tb_department")->select('department_user')->get() ?? collect();
        }
        $data = $data->pluck('department_user')->flatten()->toArray();
        $data = array_values(array_unique($data));
        $w[] = array('user_type', $type);
        if($is_active){
            $w[] = array("user_status","active");
        }
        $data = Server::table("users")->whereIn('uid', $data)->where($w)->get();
        if($is_count){
            $data = count($data);
        }
        return $data;
    }

    public function get_key_department($type, $department){
        $data = [];
        if(@$department."" != ""){
            $w1[] = array('department_name', $department);
            $data = Server::table("tb_department")->where($w1)->get() ?? collect();
        } else{
            $data = Server::table("tb_department")->get() ?? collect();
        }
        $data = $data->pluck('department_'.$type)->flatten()->toArray();

        if($type == 'room'){
            $data = Server::table("tb_room")->where('room_type', 'capture')->whereIn('room_id', $data)->get();
        }
        return $data;
    }

    public function get_patient($cases){
        $patients = [];
        try{
            $patients = Server::table('tb_case')->where($cases)->groupby('hn')->distinct()->get();
        } catch(\Exception $e) {}
        return $patients ?? [];
    }

    public function get_procedure($cases, $r, $view){
        $arr = $this->get_casedata('procedurename', $cases);
        $procedurecount = $arr['procedurename'];
        $keys = $arr['keys'];

        $procedures = [];
        foreach(isset($view['filter_procedure'])? $view['filter_procedure']:[] as $proc){
            $proc = (object) $proc;
            $procedurename = isset($proc->name) ? $proc->name : null;
            $procedures[$procedurename] = $procedurecount[$procedurename] ?? 0;
            if(str_contains($procedurename, 'PEG')){
                // กรณี "Change PEG" กับ "PEG"
                $search = "PEG";
                $find_peg = array_filter($keys, function($procedure) use ($search) {
                    return strpos($procedure, $search) !== false;
                });
                $peg = !empty($find_peg) ? reset($find_peg) : "";
                $procedures[$procedurename] = $procedurecount[$peg] ?? 0;
            }
        }
        arsort($procedures);
        return $procedures;
    }

    public function get_treatment_coverage($cases, $r){
        $all_cases = Server::table('tb_case')
                    ->where($cases)
                    ->where('hn', '!=', '')
                    ->where('hn', '!=', null)
                    ->where('treatment_coverage', '!=', '')
                    ->where('treatment_coverage', '!=', null)
                    ->get();

        $treatment = [];
        $processed_hn = [];

        foreach($all_cases as $case) {
            $case = (object) $case;
            $hn = isset($case->hn) ? trim($case->hn) : '';
            $treatment_coverage = isset($case->treatment_coverage) ? $case->treatment_coverage : '';

            if($hn == '' || $treatment_coverage == '') {
                continue;
            }

            // กรอง HN ที่ซ้ำออก โดยใช้ HN เป็น key
            if(!in_array($hn, $processed_hn)) {
                if(!isset($treatment[$treatment_coverage])) {
                    $treatment[$treatment_coverage] = 0;
                }
                $treatment[$treatment_coverage]++;
                $processed_hn[] = $hn;
            }
        }

        return $treatment;
    }

    public function get_patient_count($gender, $age_from, $age_to, $wc){
        $wc[] = array('gender', intval($gender));
        $wc[] = array('age', '>=', intval($age_from));
        if(isset($age_to)){
            $wc[] = array('age', '<=', intval($age_to));
        }
        // ดึงข้อมูล HN ทั้งหมดที่ตรงเงื่อนไข
        $all_hn = Server::table('tb_case')
                    ->where($wc)
                    ->where('hn', '!=', '')
                    ->where('hn', '!=', null)
                    ->pluck('hn')
                    ->map(function($hn) {
                        return trim($hn);
                    })
                    ->filter(function($hn) {
                        return $hn != '';
                    })
                    ->toArray();

        // กรอง HN ที่ซ้ำออกโดยใช้ array_unique
        $unique_hn = array_unique($all_hn);
        $count = count($unique_hn);
        return $count;
    }

    public function get_age($cases, $r){
        // 0 => 0-20, 1=>21-40, 2=>41-60, 3=>61-80, 4=>80+
        $ages           = [];
        $ages['male'][0] = $this->get_patient_count(1, 0, 20, $cases);
        $ages['male'][1] = $this->get_patient_count(1, 21, 40, $cases);
        $ages['male'][2] = $this->get_patient_count(1, 41, 60, $cases);
        $ages['male'][3] = $this->get_patient_count(1, 61, 80, $cases);
        $ages['male'][4] = $this->get_patient_count(1, 81, null, $cases);
        $ages['female'][0] = $this->get_patient_count(2, 0, 20, $cases);
        $ages['female'][1] = $this->get_patient_count(2, 21, 40, $cases);
        $ages['female'][2] = $this->get_patient_count(2, 41, 60, $cases);
        $ages['female'][3] = $this->get_patient_count(2, 61, 80, $cases);
        $ages['female'][4] = $this->get_patient_count(2, 81, null, $cases);
        return $ages;
    }


    public function get_icd10($cases, $r){
        if(isset($r->procedure)){
            $w[] = array('name', $r->procedure);
        }

        $w[] = array('icd10', '!=', null);
        $tb_procedure = Server::table('tb_procedure')->where($w)->select('name', 'icd10')->get();
        $icd10        = [];
        foreach ($tb_procedure as $proc) {
            $proc = (object) $proc;
            if(!isset($proc->name) || !isset($proc->icd10)){
                continue;
            }

            $icd10_proc = is_array($proc->icd10) ? $proc->icd10 : [];
            foreach ($icd10_proc as $key => $data) {
                if(isset($data)){
                    for ($i=0; $i < count($data) ; $i++) {
                        $name = $data[$i]['name'];
                        if(isset($name) && @$name."" != ""){
                            $icd10[$name] = 0;
                        }

                    }
                }
            }
        }

        foreach($cases as $case){
            $case = (object) $case;
            if(!isset($case->diagnostic) ){
                continue;
            } else if(!is_array($case->diagnostic)){
                continue;
            }

            $case_diagnostic = isset($case->diagnostic) ? $case->diagnostic : [];
            for ($i=0; $i < count($case_diagnostic); $i++) {
                $name = isset($case_diagnostic[$i]) ? $case_diagnostic[$i] : '';
                if(isset($icd10[$name])){
                    $icd10[$name] = $icd10[$name] + 1;
                }
            }

            $case_diagnostictext = isset($case->diagnostic_text)? $case->diagnostic_text : [];
            if(is_array($case_diagnostictext)){
                for ($i=0; $i < count($case_diagnostictext); $i++) {
                    $name = isset($case_diagnostictext[$i]) ? $case_diagnostictext[$i] : '';
                    if(str_contains($name, 'Normal') && !isset($icd10[$name])){
                        $icd10[$name] = 1;
                    } else if(str_contains($name, 'Normal')) {
                        $icd10[$name] = $icd10[$name] + 1;
                    }
                }
            }
        }

        // sort
        arsort($icd10);
        return $icd10;
    }

    public function get_icd9($cases, $r){
        if(isset($r->procedure)){
            $w[] = array('name', $r->procedure);
        }

        $w[] = array('icd9', '!=', null);
        $tb_procedure = Server::table('tb_procedure')->where($w)->select('name', 'icd9')->get();
        $icd9        = [];
        foreach ($tb_procedure as $proc) {
            $proc = (object) $proc;
            if(!isset($proc->name) || !isset($proc->icd9)){
                continue;
            }

            $icd9_proc = is_array($proc->icd9) ? $proc->icd9 : [];
            foreach ($icd9_proc as $key => $data) {
                if(isset($data)){
                    for ($i=0; $i < count($data) ; $i++) {
                        $name = $data[$i]['name'];
                        if(isset($name) && @$name."" != ""){
                            $icd9[$name] = 0;
                        }

                    }
                }
            }
        }

        foreach($cases as $case){
            $case = (object) $case;
            // if(!isset($case->procedure_sub) && !isset($case->procedure_subtext)){
            //     continue;
            // } else if(!is_array($case->procedure_sub) && !is_array($case->procedure_subtext)){
            //     continue;
            // }

            $case_proceduresub = isset($case->procedure_sub) ? $case->procedure_sub : [];
            for ($i=0; $i < count($case_proceduresub); $i++) {
                $name = isset($case_proceduresub[$i]) ? $case_proceduresub[$i] : '';
                if(isset($icd9[$name])){
                    $icd9[$name] = $icd9[$name] + 1;
                }
            }

            $case_proceduresubtext = isset($case->procedure_subtext)? $case->procedure_subtext : [];
            if(is_array($case_proceduresubtext)){
                for ($i=0; $i < count($case_proceduresubtext); $i++) {
                    $name = isset($case_proceduresubtext[$i]) ? $case_proceduresubtext[$i] : '';
                    if(str_contains($name, 'None') && !isset($icd9[$name])){
                        $icd9[$name] = 1;
                    } else if(str_contains($name, 'None')){
                        $icd9[$name] = $icd9[$name] + 1;
                    }
                }
            }
        }
        // sort
        arsort($icd9);
        return $icd9;
    }

    public function get_complication($cases, $r){
        $proc = [];
        $proc['EGD'] = ['Perforation', 'Hypoxia', 'Bleeding', 'Cardiovascular instability'];
        $proc['Colonoscopy'] = ['Perforation', 'Hypoxia', 'Bleeding', 'Cardiovascular instability', 'Colononic redundancy'];
        $proc['ERCP'] = ['Perforation', 'Hypoxia', 'Bleeding', 'Cardiovascular instability'];
        $proc['EUS'] = ['Perforation', 'Hypoxia', 'Bleeding', 'Cardiovascular instability'];
        $proc['Bronchoscope'] = ['Pneumothorax', 'Cardiac arrest', 'Respiratory failure', 'Hemorrhage', 'Arrhythmia', 'Hypoxemia'];

        $complication = [];
        foreach($proc as $key => $data){
            for ($i=0; $i < count($data); $i++) {
                $name = $data[$i];
                if(!isset($complication[$name])){
                    $complication[$name] = 0;
                }
            }
        }

        foreach($cases as $case){
            $case = (object) $case;
            // dd($cases);
            if(!isset($case->complication) && @$case->complication_other."" == ""){
                continue;
            } else if(!is_array(@$case->complication) && @$case->complication_other."" == ""){
                continue;
            }
            if(isset($case->complication)){
                $case_complication = array();
               if(gettype($case->complication) == "array"){
                   $case_complication = $case->complication;
                   for ($i=0; $i < count($case_complication); $i++) {
                       $name = isset($case_complication[$i]) ? $case_complication[$i] : '';
                       if(isset($complication[$name])){
                           $complication[$name] = $complication[$name] + 1;
                       }
                   }

               }
            }

            $case_complicationother = isset($case->complication_other)? $case->complication_other : '';
            // if($case_complicationother != ""){
            //     if(str_contains($case_complicationother, 'None') && !isset($complication[$case_complicationother])){
            //         $complication[$case_complicationother] = 1;
            //     } else {
            //         $complication[$case_complicationother] = $complication[$case_complicationother] + 1;
            //     }
            // }
        }

        if(isset($r->procedure)){
            $count = isset($proc[$r->procedure]) ? count($proc[$r->procedure]) : 0;
            $new_arr = [];
            for ($i=0; $i < $count ; $i++) {

                if(isset($complication[$proc[$r->procedure][$i]])){
                    $new_arr[$proc[$r->procedure][$i]] = $complication[$proc[$r->procedure][$i]];
                }
            }
            $complication = $new_arr;
        }
        arsort($complication);
        return $complication;
    }

    public function get_physician($cases, $r){
        $physician = [];

        foreach ($cases as $case) {
            $case = (object) $case;
            $doctorname = isset($case->doctorname) ? $case->doctorname : '';
            if($doctorname == '' || $doctorname == null){
                continue;
            }

            if(!isset($physician[$doctorname])){
                $physician[$doctorname] = 1;
            } else {
                $physician[$doctorname] += 1;
            }
        }

        if(isset($r->physician)){
            $new_arr = [];
            if(isset($physician[$r->physician])){
                $new_arr[$r->physician] = $physician[$r->physician];
            }
            $physician = $new_arr;
        }

        // sort
        arsort($physician);
        // dd($physician);
        return $physician;
    }

    public function get_bowel($cases, $r){
        $bowel = [];
        $bowel['Excellent'] = 0;
        $bowel['Good']      = 0;
        $bowel['Fair']      = 0;
        $bowel['Poor']      = 0;

        foreach ($cases as $case) {
            $case = (object) $case;
            $case_bowel = isset($case->bowel) ? $case->bowel : '';
            if(@$case_bowel."" == ""){
                $case_bowel = @$case->bowel_preparation."" ?? "";
            }
            // dd($case_bowel);

            if(is_array($case_bowel)){
                $case_bowel = isset($case_bowel[0]) ? $case_bowel[0] : '';
            }

            if($case_bowel == ''){
                continue;
            }

            if(isset($bowel[$case_bowel])){
                $bowel[$case_bowel] += 1;
            }
        }
        return $bowel;
    }

    public function get_gastric_content($cases, $r){
        $gastric = [];
        $gastric['Food content'] = 0;
        $gastric['Blood'] = 0;
        $gastric['Bile'] = 0;
        $gastric['Coffee ground'] = 0;
        // $gastric['Clear'] = 0;
        foreach($cases as $case){
            $case = (object) $case;
            // if(!isset($case->gastriccontent) && @$case->gastriccontent_other."" == ""){
            //     continue;
            // } else if(!is_array($case->gastriccontent) && @$case->gastriccontent_other."" == ""){
            //     continue;
            // }

            $case_gastric = isset($case->gastriccontent) ? $case->gastriccontent : [];
            for ($i=0; $i < count($case_gastric); $i++) {
                $name = isset($case_gastric[$i]) ? $case_gastric[$i] : '';
                if(isset($gastric[$name])){
                    $gastric[$name] = $gastric[$name] + 1;
                }
            }
        }

        return $gastric;
    }

    public function get_rapid($cases, $r){
        $rapid = [];
        $rapid['Positive (+)'] = 0;
        $rapid['Negative (-)'] = 0;
        $rapid['Positive [   ]         Negative [   ]'] = 0;

        foreach($cases as $case){
            $case      = (object) $case;
            $case_rapid = isset($case->rapid_urease_test) && @$case->rapid_urease_test."" != ""  ? $case->rapid_urease_test : null;
            if(!isset($case_rapid)){
                continue;
            }

            if(!isset($rapid[$case_rapid])){
                $rapid[$case_rapid] = 1;
            } else {
                $rapid[$case_rapid] = $rapid[$case_rapid] + 1;
            }
        }

        return $rapid;
    }

    public function show(Request $r, $chart){
        $view = $this->show_all_graph($r, $chart, []);
        return view("Dashboard02.showall.$chart", $view);

    }

    public function show_all_graph($r, $chart, $view){
        $wc[0]     = array('updatetime', '!=', '');
        $wc[1]     = array('statusjob', '!=', 'cancel');
        $wc[2]     = array('statusjob', '!=', 'delete');
        $wc[3]     = array('case_status', '!=', 90);
        $cases = Server::table('tb_case')->where($wc)->get();

        $view =  $this->init();

        $view['filter']['date_from'] = isset($r->date_from) ? $r->date_from : null;
        $view['filter']['date_to']   = isset($r->date_to)   ? $r->date_to : null;
        $view['filter']['physician'] = isset($r->physician) ? $r->physician : null;
        $view['filter']['procedure'] = isset($r->procedure) ? $r->procedure : null;

        $arr = (object) array();
        if(isset($r->date_from) || isset($r->date_to) || isset($r->physician) || isset($r->procedure)){
            $arr->event     = 'filter_search';
            $arr->date_from = $view['filter']['date_from'];
            $arr->date_to   = $view['filter']['date_to'];
            $arr->physician = $view['filter']['physician'];
            $arr->procedure = $view['filter']['procedure'];
            $wc = $this->get_where($wc, $arr);
            $cases = Server::table('tb_case')->where($wc)->get();
        }

        if($chart != ''){
            switch ($chart) {
                case $chart == 'procedure':
                    $view['procedure_data']     = $this->get_procedure($wc, $r, $view); break;
                case $chart == 'treatment':
                    $view['treatment_data']     = $this->get_treatment_coverage($wc, $r, $view); break;
                case $chart == 'diagnosis':
                    $view['diagnosis_data']     = $this->get_icd10($cases, $arr); break;
                case $chart == 'intervention':
                    $view['intervention_data']  = $this->get_icd9($cases, $arr); break;
                case $chart == 'complication':
                    $view['complication_data']  = $this->get_complication($cases, $arr); break;
                case $chart == 'physician':
                    $view['physician_data']     = $this->get_physician($cases, $arr); break;
            }
        } else {
            $view['procedure_data']     = $this->get_procedure($cases,$r, $arr);
            $view['treatment_data']     = $this->get_treatment_coverage($cases, $arr);
            $view['diagnosis_data']     = $this->get_icd10($cases, $arr);
            $view['intervention_data']  = $this->get_icd9($cases, $arr);
            $view['complication_data']  = $this->get_complication($cases, $arr);
        }
        // dd($view, $chart);


        return $view;
    }

    function get_where($where, $r){

        if(isset($r->date_from) && @$r->date_from.'' != ''){
            $new_date = "$r->date_from 00:00";
            $where[] = array('appointment', '>=', $new_date);
        }

        if(isset($r->date_to) && @$r->date_to.'' != ''){
            $new_date = "$r->date_to 23:59";
            $where[] = array('appointment', '<=', $new_date);
        }

        if(isset($r->physician) && @$r->physician.'' != ''){
            $where[] = array('doctorname', $r->physician);
        }

        if(isset($r->procedure) && @$r->procedure.'' != ''){
            $where[] = array('procedurename', $r->procedure);
        }

        return $where;
    }



}
