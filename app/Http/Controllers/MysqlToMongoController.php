<?php

namespace App\Http\Controllers;

use App\Models\Mongo;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Schema;
use PDO;

class MysqlToMongoController extends Controller
{
    public function index(Request $r){    
        $example  = [];
        $types    = [];
        $databasename = config('database.connections.mysql.database');
        $tablenames = DB::connection('mysql')->select('SHOW TABLES');
        $connection = Schema::connection('mysql');
        if(isset($r->event) && @$r->event."" == 'search_table'){
            // mysql
            $columns = $connection->getColumnListing($r->tablename);
            $types   = [];
            foreach ($columns??[] as $key => $col) {
                $type = $connection->getColumnType($r->tablename, $col);
                $types[$col] = $type;
            }
            $tablename = $r->tablename == 'patient' ? 'tb_'.$r->tablename : $r->tablename;
            // mongo
            $mongo = DB::connection('mongodb')->collection($tablename)->where('caseuniq', '!=', '')->get();
            $mongokey = [];
            $mongotypes = [];
            // foreach ($mongo??[] as $val) {
            //     foreach ($val as $key => $value) {
            //         $mongokey[$key] = $value;  
            //     }
            // }
            // $mongokey = $this->clean_data($mongokey);

            // foreach ($mongokey??[] as $key => $value) {
            //     $mongotypes[$key] = gettype($value);
            // }

            $keyname = '';
            if($tablename == 'tb_case'){
                $keyname = 'case_json';
            } else if($tablename == 'tb_patient'){
                $keyname = 'patient_json';
            } else if($tablename == 'tb_casemedication'){
                $keyname = 'medi_casejson';
            }
            
            if(@$keyname."" == ""){
                $get      = DB::connection('mysql')->table($r->tablename)->get();
                $example  = (array) $get[0] ?? [];
            } else {
                $get      = DB::connection('mysql')->table($r->tablename)->where($keyname, '!=', null)->where($keyname, '!=', "[]")->get();
                foreach ($get??[] as $key => $val) {
                    if($key == 0){
                        $example    = $this->format_json((array) $val, $val, $keyname, false);
                    }
                    $types      = $this->format_json($types, $val, $keyname);
                    $example    = $this->format_json($example, $val, $keyname, false);
                }
            }

            if($tablename == 'tb_case'){
                $types      = $this->clean_data($types);
                $example    = $this->clean_data($example);
            }

            $view['tabledata'] = $types;
            $view['mongodata'] = $mongotypes;
            $view['exampledata'] = $example;
            $view['tablename'] = $tablename;
            $view['default']   = Mongo::table('tb_mysqlmigrate')->where('table_name', $r->tablename)->first();
            $view['diffkeys']  = [];
            // $view['diffkeys']  = $this->compare_array($mongotypes, $types);
            // dd($mongo, $view);
        }
        $view['tablenames'] = $tablenames;
        $view['databasename'] = $databasename;
        return view('test.migrate', $view);
    }

    public function format_json($types, $first, $keyname, $get_type=true){
        if(@$keyname."" != ""){
            $json_decode = jsonDecode($first->{$keyname}) ?? [];
            foreach ($json_decode??[] as $key => $value) {
                if($get_type){
                    $this_type = gettype($value);
                    $types[$key] = $this_type == 'NULL' ? 'string' : $this_type ;
                } else {
                    $types[$key] = $value;
                }
            }
        } else {
            $types = (array) $types;
        }
        
        return $types;
    }

    public function format_type($data, $type){
        $data = $data ?? '';
        try{
            switch ($type) {
                case 'array':
                    if(is_null($data)){
                        return [];
                    } elseif (is_string($data)) {
                        $dec = jsonDecode($data, true);
                        return is_array($dec) ? $dec : [$data];
                    } elseif (is_array($data)) {
                        return $data;
                    } else {
                        return [$data];
                    }
                case 'int':
                    return (int) $data;
                case 'string':
                    if(gettype($data) == 'array'){
                        return $data;
                    }
                    return (string) $data;
                case 'bool':
                    return (bool) $data;         
                default:
                    return '';
            }
        } catch(\Exception $e){}
    }

    public function check_array($data){
        $checked = array_filter($data, function($value){
            return $value !== "";
        });
        $data = empty($checked) ? [] : $data;
        return $data;
    }

    public function clean_data($data, $filter_key=true){
        $filter_out = ['icd9text', 'ordata', 'icdninegroup', 'toggle_', 'undefined', 'boxicdten', 'box_'];
        $filtered   = array_filter($data, function ($item, $key) use ($filter_key, $filter_out) {
            $which = $filter_key ? $key : $item;
            foreach ($filter_out as $text) {
                if (stripos($which, $text) !== false) {
                    return false;
                }
            }
            return true;
        }, ARRAY_FILTER_USE_BOTH);
        return $filtered;
    }

    public function format_casedata($data){
        $patient = DB::connection('mysql')->table('patient')->where('hn', $data['hn'])->first();
        $user    = DB::connection('mysql')->table('users')->where('id', intval($data['case_physicians01']))->first();
        switch ($data['case_status']) {
            case 0:
                $case_status = 'holding';
                break;
            case 1:
                $case_status = 'operation';
                break;
            case 2:
                $case_status = 'recovery';
                break;
            default:
                $case_status = 'holding';
                break;
        }

        $mediwhere[] = array('caseuniq',intval($data['caseuniq']));
        $mediwhere[] = array('comcreate',$data['comcreate']);
        $medication  = DB::connection('mysql')->table('tb_casemedication')->where($mediwhere)->first();

        $useropencase = $data['useropencase'] ?? 0;
        if($useropencase != 0){

        }

          

        $data['appointment']            = $data['case_dateappointment'];
        $data['appointment_date']       = explode(' ', $data['case_dateappointment'])[0];
        $data['gender']                 = intval($patient->gender);
        $data['statusjob']              = $case_status;
        $data['treatment_coverage']     = $data['righttotreatment'] ?? '';
        $data['user_appoint']           = '';
        $data['hospitalcode']           = '';
        $data['noteid']                 = '';
        $data['patient_id']             = (string) $patient->patient_id ?? '';
        $data['scope']                  = $data['endoscope'] ?? [];
        $data['diagnostic_text']        = $data['texticd10'] ?? [];
        $data['diagnostic']             = $data['texticd10'] ?? [];
        $data['followup_date']          = '';
        $data['mainpart']               = !empty($data['finding']) ? $data['finding'][0] : [];
        $data['procedure_sub']          = $data['texticd9'] ?? [];
        $data['overall_diagnosis']      = $data['overall_diagnosis'] ?? '';
        $data['procedure_subtext']      = $data['texticd9'] ?? [];
        $data['department']             = $this->find_department($useropencase);
        $data['gastriccontent']         = $data['gastric_content'] ?? [];
        $data['gastriccontent_other']   = $data['gastric_content_other'] ?? '';
        $data['rapid_urease_test']      = $data['rapid_other'] ?? '';
        $data['physician_id']           = $data['case_physicians01'];
        $data['physician_name']         = fullName($user);
        $data['room_id']                = $this->get_roomid($data['room'] ?? '');
        $data['room_name']              = $data['room'] ?? '';
        $data['room']                   = $this->get_roomid($data['room'] ?? '');
        $data['semi']                   = $data['case_semi'] ??  false;
        $data['procedurename']          = $this->find_procedure($data['case_procedurecode']);
        $data['bowel']                  = $this->convert_bowel($data);
        $data['rapid_other']            = $this->convert_rapid($data);
        $data = $this->convert_photo($data);
        $data = $this->format_casemedication($data, $medication);
        return $data;
    }

    public function convert_bowel($data){
        $bowel = '';
        if(@$data['bowel']."" != ""){
            switch ($data['bowel']) {
                case 1 : case "1": $bowel = "Excellent"; break;
                case 2 : case "2": $bowel = "Good"; break;
                case 3 : case "3": $bowel = "Fair"; break;
                case 4 : case "4": $bowel = "Poor"; break;
            }
        }
        return $bowel;
    }

    public function convert_rapid($data){
        $rapid = '';
        if(@$data['rapid']."" != ""){
            switch ($data['rapid']) {
                case 1 : case "1": $rapid = "Positive (+)"; break;
                case 2 : case "2": $rapid = "Negative (-)"; break;
                case 3 : case "3": $rapid = "Pending"; break;
            }
        }
        return $rapid;
    }

    public function convert_photo($data){
        if(isset($data['photo'])){
            foreach ($data['photo'] as $index=>$p) {
                $p = (array) $p;
                if(@$p['sc'].'' == ''){
                    continue;
                }
                $sc = intval($p['sc']);
                $mainpartsub  = DB::connection('mysql')->table('tb_mainpartsub')->where('mainpartsub_id', $sc)->first();
                $data['photo'][$index] = (array) $data['photo'][$index]; 
                $data['photo'][$index]['sc'] = @$mainpartsub->mainpartsub_name."";
            }
            return $data;
        }
    }

    public function convert_room($data){
        if(isset($data['room'])){
            return $this->map_roomid($data['room']);
            // $mapped = $this->map_roomid($data['room']);
            // $data['room'] = $mapped;
            // $data['room_id'] = $mapped;
            // return $data;
        }
    }

    public function map_roomid($room_id){
        $room_id = intval($room_id);
        switch ($room_id) {
            case 1: return 2; break;
            case 2: return 3; break;
            case 4: return 9; break;
            case 5: return 4; break;
            case 6: return 5; break;
            case 7: return 6; break;
            case 8: return 7; break;
            case 9: return 8; break;
            case 10: return 17; break;
            case 17: return 21; break;
            case 18: return 22; break;
            case 19: return 25; break;
            case 20: return 12; break;
            case 21: return 13; break;
            case 22: return 14; break;
            case 23: return 18; break;
            case 30: return 10; break;
            case 31: return 11; break;
            case 32: return 15; break;
            default: return 2; break;
        }
    }

    public function format_casemedication($data, $medication){
        $tb_procedure = (object) Mongo::table('tb_procedure')->where('name', $data['procedurename'])->first();
        $anesthesis   = $tb_procedure->anesthesis ?? [];
        $sub = [];
        $select = [];
        if(isset($medication)){
            if(count($anesthesis) > 0){
                foreach ($anesthesis as $in => $anes) {
                    $sub[$anes['name']]['dose'] = null;
                    $sub[$anes['name']]['unit'] = $anes['unit'];
                }
    
                $medi_casejson = jsonDecode($medication->medi_casejson);
                foreach ($medi_casejson??[] as $key => $value) {
                    $newkey = (strpos($key, 'box') === 0) ? substr($key, 3) : $key;
                    $anes = DB::connection('mysql')->table('dd_anesthesis')->where('anesthesis_id', intval($newkey))->first();
                    $anes_name = $anes->anesthesis_name ?? '';
                    if(@$anes_name."" != ""){
                        if(strpos($key, 'box') === 0){
                            $select[] = $anes_name;
                        } else {
                            $sub[$anes_name]['dose'] = $value;
                        }
                    }
                }
            }
    
        }
        $data['select'] = $select;
        $data['medication_unit'] = $sub;
        $data['medi_other'] = $medication->medi_other ?? '';
        $data['medi_otherdose'] = $medication->medi_otherdose ?? '';
        $data['medi_otherunit'] = isset($medication->medi_otherunit) && @$medication->medi_otherunit != 0 ? $medication->medi_otherunit : '';
        return $data;
    }

    public function format_autotext($data, $key){
        $auto_procedure = $data['auto_procedure'] ?? 0;
        $tb_procedure   = DB::connection('mysql')->table('tb_procedure')->where('procedure_id', intval($auto_procedure))->first();
        $procedure_code = $tb_procedure->procedure_code ?? ''; 
        $data[$key]     = $procedure_code;
        return $data;
    }

    public function find_procedure($procedure_code){
        $tb_department = DB::connection('mysql')->table('tb_procedure')->where('procedure_code', $procedure_code)->first();
        return $tb_department->procedure_name ?? '';
    }

    public function find_department($userid){
        $tb_department = DB::connection('mysql')->table('tb_department')->get();
        $departmentname = '';
        foreach ($tb_department??[] as $department) {
            $dep_user = json_decode($department->department_user, true) ?? [];
            if(in_array($userid, $dep_user)){
                $departmentname = $department->department_name ?? '';
            }
        }
        return $departmentname;
    }

    public function compare_array($arr1, $arr2){
        $diff = [];
        $arr1 = $this->clean_data($arr1);
        $arr2 = $this->clean_data($arr2);
        try{
            $diff = array_diff_key($arr1, $arr2);
            $diff = array_keys($diff);
        } catch (\Exception $e){}
        return $diff;
    }

    public function get_roomid($room_name){
        $room_id = '';
        if(!empty($room_name)){
            $tb_room = DB::connection('mysql')->table('tb_room')->where('room_name', $room_name)->first();
            $room_id = !empty($tb_room->room_id) ? intval($tb_room->room_id) : '';
            $room_id = $this->map_roomid($room_id);
        }
        return $room_id;
    }

    public function get_roomname($room_id){
        $room_name = '';
        if(!empty($room_id)){
            $tb_room =  DB::connection('mongodb')->collection('tb_case')->where('room_id', intval($room_id))->first();
            $room_name = !empty($tb_room['room_name']) ? $tb_room['room_name'] : '';
        }
        return $room_name;
    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event == 'migrate_data')                     {return $this->migrate_data($r);}
            if($r->event == 'convert_photos')                     {return $this->convert_photos($r);}
            if($r->event == 'convert_rooms')                     {return $this->convert_rooms($r);}
        }
    }  
    
    public function convert_photos($r){
        $tb_case = DB::connection('mongodb')->collection('tb_case')->where('caseuniq', '!=', '')->get();
        foreach ($tb_case??[] as $index => $case) {
            $caseuniq = $case['caseuniq'];
            $case  = $this->convert_photo($case);
            $u['photo']      = $case['photo'];
            DB::connection('mongodb')->collection('tb_case')->where('caseuniq', $caseuniq)->update($u);
            echo $case['case_id']."<br>";
        }
        return redirect()->back();
    }

    public function convert_rooms($r){
        $tb_case = DB::connection('mongodb')->collection('tb_case')->where('caseuniq', '!=', '')->get();
        foreach ($tb_case??[] as $index => $case) {
            $caseuniq = $case['caseuniq'];
            $room = $case['room'];
            if(empty($room) || empty($case['room_id'])){
                $u['room']      = $this->map_roomid($case['case_room']);
                $u['room_id']      = $this->map_roomid($case['case_room']);
                DB::connection('mongodb')->collection('tb_case')->where('caseuniq', $caseuniq)->update($u);
                echo $case['case_id'].' '.$case['room_id']."<br>";
            } 
            
            if ( empty($case['room_name'])) {
                $this_case = DB::connection('mongodb')->collection('tb_case')->where('caseuniq', $caseuniq)->first();
                $room_name = $this->get_roomname($this_case['room']);
                $u1['room_name'] = $room_name;
                DB::connection('mongodb')->collection('tb_case')->where('caseuniq', $caseuniq)->update($u1);
                echo $case['case_id'].' '.$case['room_id'].' '.$room_name."<br>";
            }
            // $case  = $this->convert_room($case);
        }
        return redirect()->back();
    }

    public function migrate_data($r){
        // 1. mysql -> format data to array
        $tablename = $r->tablename ?? '';
        if($tablename == 'tb_patient'){
            $r->tablename = 'patient';
        }
        $data = DB::connection('mysql')->table($r->tablename)->get();
        // $data = DB::connection('mysql')->table($r->tablename)->limit(500)->get(); // 10496
        // $data = DB::connection('mysql')->table($r->tablename)->where('case_id' , 38524)->get();
        foreach ($data??[] as $key => $value) {
            $arr        = (array) $value;
            if($r->tablename == 'tb_case'){
                $data[$key] = $this->format_json($arr, $value, 'case_json', false);
            } elseif ($r->tablename == 'patient') {
                $data[$key] = $this->format_json($arr, $value, 'patient_json', false);
            } 
        }

        // 2. create key array from inputs and match it
        $main = [];
        $sub  = [];
        $i = 0;
        foreach ($data??[] as $mainkey => $mainval) {
            $sub   = [];
            foreach ($mainval as $subkey => $subval) {
                $index = $subkey;
                $orikey = $r->{'ori_key'.$index} ?? '';
                $newkey = $r->{'new_key'.$index} ?? '';
                $newtype = $r->{'new_type'.$index} ?? '';
                if((@$orikey."" != "" && @$newkey."" != "" && @$newtype."" != "")){
                    $mainval = (array) $mainval;
                    $sub[$newkey] = $this->format_type(@$mainval[$orikey], $newtype);
                    if(gettype($sub[$newkey]) == 'array'){
                        $sub[$newkey] = $this->check_array($sub[$newkey]);
                    }
                } 
            }

            if($r->tablename == 'tb_case'){
                $sub = $this->format_casedata($sub);
            } else if($r->tablename == 'autotext'){
                $sub = $this->format_autotext($sub, 'auto_procedure');
            } elseif($r->tablename == 'users'){
                $sub['department'] = $sub['id']>=1 && $sub['id']<=5 ? 'GI' : $this->find_department($sub['id']);
                $sub['user_status'] = 'active';
            } elseif($r->tablename == 'tb_department'){
                foreach ($sub['department_user']??[] as $key => $value) {
                    $sub['department_user'][$key] = $this->format_type($sub['department_user'][$key], 'int');
                }
                foreach ($sub['department_room']??[] as $key => $value) {
                    $sub['department_room'][$key] = $this->format_type($sub['department_room'][$key], 'int');
                }
                foreach ($sub['department_scope']??[] as $key => $value) {
                    $sub['department_scope'][$key] = $this->format_type($sub['department_scope'][$key], 'int');
                }
            } elseif($r->tablename == 'tb_room'){
                foreach ($sub['room_doctor']??[] as $key => $value) {
                    $sub['room_doctor'][$key] = $this->format_type($sub['room_doctor'][$key], 'int');
                }
                foreach ($sub['room_nurse']??[] as $key => $value) {
                    $sub['room_nurse'][$key] = $this->format_type($sub['room_nurse'][$key], 'int');
                }
                foreach ($sub['room_register']??[] as $key => $value) {
                    $sub['room_register'][$key] = $this->format_type($sub['room_register'][$key], 'int');
                }
            } 

            // format case
            $main[] = $sub;

            $id = $sub['case_id'] ?? '';
            $keyid = 'case_id';
            $check = Mongo::table($tablename)->where(function($query) use ($id, $keyid) {
                $query->where($keyid, (int) $id)
                ->orWhere($keyid, (string) $id);
            })->first() ?? [];
            
            if(count($check) == 0 && count($sub) > 0){
                $_id = Mongo::table($tablename)->insertGetId($sub);

                if($tablename == 'tb_case'){
                    $u['caseuniq'] = (string) $_id;
                    $u['old_caseuniq'] = (string) $sub['caseuniq'];
                    Mongo::table($tablename)->where('_id', $_id)->update($u);
                    $u = array();

                    $u['select']          = $sub['select'];
                    $u['medication_unit'] = $sub['medication_unit'];
                    $u['medi_other']      = $sub['medi_other'];
                    $u['medi_other']      = $sub['medi_otherdose'] ;
                    $u['medi_otherunit']  = $sub['medi_otherunit'];
                    $u['caseuniq']        = (string) $_id;
                    $u['comcreate']       = $sub['comcreate'];
                    $u['updatetime']      = $sub['updatetime'];
                    Mongo::table('tb_casemedication')->insert($u);
                    $u = array();
                }
            } 

            $i++;   
            if($i == 500){
                // break;
            }
        }
        return redirect()->back();
    }

    public function show(){

    }
}
