<?php

use App\Models\Datacase;
use App\Models\Mongo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Foreach_;

    function insertMEDICATION($val){
        $medi['caseuniq']      = $val['caseuniq'];
        $medi['comcreate']     = $val['comcreate'];
        $medi['updatetime']    = $val['updatetime'];
        Mongo::table('tb_casemedication')->insert($medi);
        createTEMP('tb_casemedication',$val['caseuniq'],$val['comcreate'],$val['updatetime']);
    }

    function insertPACs($val){
        $pacs['caseuniq']      = $val['caseuniq'];
        $pacs['comcreate']     = $val['comcreate'];
        $pacs['updatetime']    = $val['updatetime'];
        Mongo::table('tb_casepacs')->insert($pacs);
    }

    function checkNURSENOTE($hn,$date, $department=""){
        $tb_casenote    = (object) Mongo::table('tb_casenote')
        ->where('hn',$hn)
        ->where('department',$department)
        ->where('status','create')
        ->first();

        if(@$tb_casenote->status == "create"){
            $nid = $tb_casenote->id;
        }else{
            $val['appointment'] = date('Y-m-d');
            $val['date']        = date('Y-m-d');
            $val['department']  = $department;
            $val['hn']          = $hn;
            $val['status']      = "create";
            $nid = Mongo::table('tb_casenote')->insertGetId($val);
        }
        return $nid;
    }






    function proceduredefaultvalue($val){
        $tb_procedure = Mongo::table("tb_procedure")->where("code",$val['case_procedurecode'])->first();
        if(isset($tb_procedure->defaultvalue)){
            foreach($tb_procedure->defaultvalue as $key=>$value){
                $val[$key] = $value;
            }
        }

        return $val;
    }



    function insertCASE($val,$r){
        $config_admin = getConfig('admin');
        $r = (object) $r;
        // dd($config_admin);

        if (isset($r->case_procedurecode)){
            $code = $r->case_procedurecode;
            if(is_array($code)){
                if(count($code) == 1){
                    // procedure_code ที่ส่งมาใน request เป็น array ทุกกรณีไม่ว่าจะเลือก
                    // เป็นการสร้างแค่ procedure เดียว ฉะนั้นต้องทำการเลือกที่ index=0
                    // เพื่อไม่ให้บันทึกเข้าไปทั้ง array
                    $r->case_procedurecode = $code[0];
                }
            }
            $val['case_procedurecode']  = $r->case_procedurecode;
        }else{
            $val['case_procedurecode']  = 'op001';
        }


        $val = proceduredefaultvalue($val);
        $val['case_hn']             = $r->hn;
        // dd($r);
        $val['case_physicians01']   = intval($r->case_physicians01);
        $minute = isset($r->meet_minute) ? $r->meet_minute : "00";
        if(!isset($r->appointment)){
            $val['appointment']= $r->meet_date . " " .$r->meet_hour.":".$minute;
            $val['appointment_date'] = $r->meet_date;
            $val['appointment_date'] = $r->meet_date;
        }else{
            $val['appointment']= $r->appointment;
            $ex = explode(" ",$r->appointment);
            $val['appointment_date'] = $ex[0];
        }

        $hn         = $val['case_hn'];
        $casedate   = $val['appointment_date'];
        makedirfull(htdocs("store/$hn/$casedate/backup"));


        if(isset($r->appointment)){
            $val['appointment'] = $r->appointment;
        }
        $userdepartment             = uget('department');

        $val['department']          = $userdepartment ?? "OR";

        $nid = checkNURSENOTE($r->hn,$val['appointment'], $val['department'] );
        $val['case_id']             = get_last_id('case_id', 'tb_case') + 1;
        $val['noteid']              = (string) $nid;
        $val['case_status']         = 0;
        $val['case_room']           = $r->room;
        $val['case_roomsort']       = 0;
        $val['case_pacs']           = [];
        $val['case_dateregister']   = date("Y-m-d H:i:s");
        $val['updatetime']          = date("ymdHis");
        $val['created_from']        = @$val['created_from']."";

        $patient                    = (object) Mongo::table('tb_patient')->where('hn',$r->hn)->first();
        $doctor                     = (object) Mongo::table('users')->where('uid','=',intval($r->case_physicians01))->orWhere('uid','=',$r->case_physicians01)->first();
        $procedure                  = (object) Mongo::table('tb_procedure')->where('code',$val['case_procedurecode'])->first();
        $room                       = (object) Mongo::table('tb_room')->where('room_id',$r->room)->first();

        $val['patientname']         = patientName($patient);
        $val['gender']              = intval($patient->gender);
        $val['hn']                  = $r->hn;
        $val['age']                 = age(@$patient->birthdate);
        $val['doctorname']          = fullName($doctor);
        $val['procedurename']       = @$procedure->name."";
        $val['opd']                 = @$r->opd."";
        $val['ward']                = @$r->ward."";
        $val['typeofcase']          = @$r->typeofcase."";
        $val['refer']               = @$r->refer."";
        $val['user_in_case']        = isset($r->user_in_case) ? $r->user_in_case : [];
        $val['room']                = @$r->room."";
        $val['physicians02']        = @$r->doctor02."";
        $val['physicians03']        = @$r->doctor03."";
        $val['physicians04']        = null;
        $val['statusjob']           = "holding";
        $val['nurse01']             = @$r->nurse01."";
        $val['nurse02']             = @$r->nurse02."";
        $val['nurse03']             = @$r->nurse03."";
        $val['nurse04']             = @$r->nurse04."";
        $val['anes']                = @$r->anes."";
        $val['prediagnostic_other'] = @$r->prediagnosis_other."";
        $val['patient_id']          = @$r->patientid."";
        $val['branch']              = @$doctor->user_branch."";
        $val['anesthesia']     = @$r->anesthesia ?? [];
        $val['anesthesiaother']     = @$r->anesthesiaother."";
        if(uid()==null){
            $useropencase = uid();
        }else{
            $useropencase = intval(@$r->useropen);
        }

        $val['useropencase']        = $useropencase;
        $val['treatment_coverage']  = @$r->treatment_coverage."";
        $val['user_appoint']        = @$r->user_appoint."";
        $val['date']                = @$patient->birthdate;
        $hospital                   = getCONFIG("hospital");
        $val['hospitalcode']        = @$hospital->hospital_code;
        $val['accessionno']         = @$r->accessionno."";
        $val['patientname_eng']     = @$r->patienteng."";
        $val['visitno']             = @$r->visitno."";
        $val['urgent']              = @$r->case_urgent . "";
        $val['pdftype']             = @$config_admin->pdf_default;
        $val['pdfcreate']           = false;

        $cid = (string) Mongo::table('tb_case')->insertGetId($val);
        Datacase::dataUPDATE($cid,['caseuniq'=>$cid]);

        // dd($val, $r->all());
        // /
        $case = Mongo::table('tb_case')->where('id',$cid)->first();
        unset($case->id);
        Mongo::table("tb_cloudtemp")->insert((array)$case);

        createTEMP('tb_case',$cid,$val['comcreate'],$val['updatetime']);
        // socketioTRIGGER('casemonitor');
        return $cid;
    }

    function create_cases($val, $r){
        $procedures = $r->case_procedurecode;
        foreach(isset($procedures)?$procedures:[] as $prod){
            $r->case_procedurecode = $prod;
            $cid                = insertCASE($val,$r);
            $val['caseuniq']    = $cid;
            insertMEDICATION($val);
        }
    }

    function string_to_int($array){
        $new_array = [];
        foreach($array as $data){
            if(isset($data)&&$data!=''){
                $new_array[] =  intval($data);
            }
        }
        return $new_array;
    }

    function checkPROCEDURE($str){
        $arr = array();
        $tb_hisfindtext = DB::table('tb_hisfindtext')->get();
        foreach($tb_hisfindtext as $tb){
            $text   = array($tb->hisfindtext_find,$tb->hisfindtext_return);
            $have   = strpos($str,$text[0]);
            if($have>-1){
                array_push($arr,$text[1]);
            }
        }
        return $arr;
    }

    function check_count_cases($status, $is_all=false, $department){
        $count = 0;
        $w[] = array('appointment_date', date('Y-m-d'));
        $w[] = array('department', @$department);
        if($is_all == false){
            $w[] = array('statusjob', $status);
        }
        $count = Mongo::table('tb_case')->where($w)->get()->count();
        if($status == 'delete'){
            $w1[] = array('appointment_date', date('Y-m-d'));
            $w1[] = array('department', @$department);
            $count = Mongo::table('tb_casebackup')->where($w1)->get()->count();
        }
        return intval($count);
    }

    function count_follow($count){

        $w[] = array('appointment_date', date('Y-m-d'));
        $w[] = array('statusjob', 'recovery');
        $count = Mongo::table('tb_case')->where($w)->where('appointment', '%'.Carbon::now()->toDateString())->get()->count();
        return intval($count);
    }


    function get_obj_id($hn, $appointment, $statusjob){
        $w[] = array('hn', $hn);
        $w[] = array('appointment', $appointment);
        $w[] = array('statusjob', $statusjob);

        $data = Mongo::table('tb_case')->where($w)->first();
        $_id = '';
        if(isset($data['_id'])){
            $_id = (array) $data['_id'];
        }

        return $_id;

    }

    function get_case_count($data){
        $count = 0;
        if(isset($data)){
            if(is_array($data)){
                foreach ($data as $i => $case) {
                    $case = (object) $case;
                    if(isset($case->procedure)){
                        $count = $count + count($case->procedure);
                    }
                }
            }
        }
        return $count;
    }

    function get_procedure_image($name){
        $w[]          = array('name', $name);
        $tb_procedure = (object) Mongo::table('tb_procedure')->where($w)->first();
        $img_name     = isset($tb_procedure->img) ? $tb_procedure->img : '';
        if($img_name !== ''){
            $path = "D:/laragon/htdocs/config/procedure/$img_name";
            if(!file_exists($path)){
                $img_name = base_path()."/public/image/Endoscope_white.png";
            }
        }
        // $host = Config::get('app.url');
        $url  = domainname("config/procedure/$img_name");
        // $url  = "http://110.171.123.140/config/procedure/$img_name";
        return $url;
    }

    function updateMEDICATION($val, $old_medidata){
        $new_arr = [];
        $w[] = array('caseuniq', $val['caseuniq']);
        $w[] = array('updatetime', $val['updatetime']);
        foreach(isset($old_medidata)?$old_medidata:[] as $key=>$medi){
            $skip = ['_id', 'caseuniq', 'comcreate', 'updatetime', ""];
            if(in_array($key, $skip)){
                continue;
            }

            $new_arr[$key] = $medi;
        }

        // dd($new_arr, $w);

        Mongo::table('tb_casemedication')->where($w)->update($new_arr);
    }
