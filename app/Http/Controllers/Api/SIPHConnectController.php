<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Mongo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use stdClass;

class SIPHConnectController extends Controller
{
    public function index(Request $r){
        switch ($r->event) {
            case 'vna_pdf'              : $this->vna_pdf($r);
            case 'get_worklist'         : return $this->get_worklist($r);
            case 'import_caseworklist'  : return $this->import_caseworklist($r);
            case 'send_pdf'             : $this->send_pdf($r);
        }
        $this->mmmm(@$sss['mmmmm']);
    }

    public function mmmm($ssss){
        if(isset($ssss)){
            echo $ssss;
        }else{
            echo "ERROR";
        }
    }

    public function store(Request $r){
        switch ($r->event) {
            case 'vna_pdf'                      : $this->vna_pdf($r); break;
            case 'get_worklist'                 : return $this->get_worklist($r); break;
            case 'import_caseworklist'          : return $this->import_caseworklist($r); break;
            case 'send_pdf'                     : $this->send_pdf($r); break;
            case 'call_worklist_python'         : return $this->call_worklist_python($r); break;
            case 'import_caseworklist_recorder' : return $this->import_caseworklist_recorder($r); break;
            case 'match_procedure'              : return $this->match_procedure($r); break;
            case 'match_doctor'                 : return $this->match_doctor($r); break;
            case 'getinfo_accessionnumber'      : return $this->getinfo_accessionnumber($r); break;
            case 'getdoccat'                    : return $this->getdoccat($r); break;
            case 'getusercode'                  : return $this->getusercode($r); break;
        }
    }

    public function send_pdf($r){
        $w[] = array('id', intval($r->doctor));
        $users = (object) Mongo::table('users')->where($w)->first();
        $user_code = @$users->user_code."";

        $w1[] = array('procedurename', $r->procedure);
        $w1[] = array('accessionno', $r->accessno);
        $case = (object) Mongo::table('tb_case')->where($w1)->first();
        $visitno    = @$case->visitno;
        $date       = @$r->folderdate."";
        $date       = str_replace('-', '', $date);
        $accessno   = @$r->accessno."";

        $json['status'] = 'success';
        // config pdf file here//
        if(isset($r->diskname)){
            foreach ($r->diskname as $key => $disk) {
                $diskname   = $disk;
                $basepath   = "$diskname";

                $tb_lumina  = (object) Mongo::table('tb_lumina')->where('id',1)->first();
                // if(isset($tb_lumina->pdf_path)){
                //     if($accessno == ''){
                //         $json['status'] = 'No accession number';
                //         $json['disk'] = $disk;
                //         echo jsonEncode($json);
                //         return '';
                //     }
                // }

                $doccat     = $this->get_doccat($r->procedure);
                $filename   = "$visitno-00000-$doccat-$date-$user_code-$accessno-1.pdf";
                for($i=1;$i<99;$i++){
                    if(file_exists("$basepath\\$filename")){
                        $filename = "$visitno-00000-$doccat-$date-$user_code-$accessno-$i.pdf";
                    }else{
                        break;
                    }
                }

                if(isset($tb_lumina->pdf_video_path)){
                    $default_room = $tb_lumina->default_room;
                    if(str_contains(strtolower($tb_lumina->pdf_video_path), $disk) || str_contains(strtoupper($tb_lumina->pdf_video_path), $disk)){
                        $basepath   = "$diskname\\$default_room";
                        $case = (object) Mongo::table('tb_case')->where('_id', $r->cid)->first();
                        $datefolder = isset($case->appointment_date) ? $case->appointment_date : explode(' ', $case->appointment)[0];
                        $timefolder = $case->time_start ?? '';
                        if(!empty($datefolder)){
                            $datefolder = str_replace('-', '', $datefolder);
                        }

                        if(!empty($timefolder)){
                            $timefolder = str_replace(':', '', $timefolder);
                        }
                        $patientname = $case->patientname ?? '';
                        $hn = $case->case_hn ?? '';
                        $filename = "$datefolder-$timefolder-$hn-$patientname-01.pdf";
                        for($i=1;$i<99;$i++){
                            if(file_exists("$basepath\\$filename")){
                                $filename = "$datefolder-$timefolder-$hn-$patientname-01.pdf";
                            }else{
                                break;
                            }
                        }
                    }
                }

                makedirfull($basepath);
                // $fileurl  = domainname("endoindex/api/pdf?id=$r->cid");
                // $fileurl  = domainname("endoindex/api/pdf?id=$r->cid");
                try{
                    file_put_contents("$basepath\\$filename", file_get_contents($r->url));
                    $json['status'] = 'success';
                } catch (\Exception $e){
                    $json['status'] = 'unsuccess';
                }

                $lower_disk = strtolower($disk);
                if (str_contains(strtolower($tb_lumina->pdf_video_path), $lower_disk) ) {
                    $this->save_filesendto($filename, $json['status'], $r->cid, 'pdf_video_version');
                }

                if(str_contains(strtolower($tb_lumina->pdf_path), $lower_disk)) {
                    $this->save_filesendto($filename, $json['status'], $r->cid, 'pdf_version');
                }

                $log['case_from'] = @$case->caseuniq;
                $log['case_hn']   = $r->hn;
                $log['path']      = "$basepath\\$filename";
                $log['status']    = $json['status'];
                logdata('tb_logsendto', uid(), 'send file', $log);
            }
        }
        printJSON($json);


    }

    public function save_filesendto($filename, $status, $cid, $key){

        $case          = Mongo::table('tb_case')->where('_id', $cid)->first();
        $key_data      = $case[$key] ?? [];
        $arr['file']     = $filename;
        $arr['status']   = $status;
        $arr['datetime'] = Carbon::now()->toDateTimeString();
        $key_data[]      = $arr;
        $u[$key]         = $key_data;
        try{
            Mongo::table('tb_case')->where('_id', $cid)->update($u);
        } catch (\Exception $e) {dd($e);}
    }

    public function get_doccat($procedure){
        $doccat = 'RES_COLSCP';
        if(isset($procedure)){
            $w[] = array('name', $procedure);
            $tb_doccat = (object) Mongo::table('tb_doccat')->where($w)->first();
            try {
                $doccat  = $tb_doccat->doccat;
            } catch(\Exception $e) {}
        }
        return $doccat;
    }

    public function call_worklist_python($r){
        try {
            if(isset($r->date)){
                $date_obj = Carbon::parse($r->date);
                $date = $date_obj->format('Ymd');
            } else {
                $date = date("Ymd");
            }
            $command = "start /B pythonw D:\allindex\worklist\getworklist_mongo222.pyw $date";
            exec($command);
            return 'success';
        } catch (\Exception){ return 'error'; }
    }

    public static function get_worklist($r){
        // sleep(5);
        $date = isset($r->date) ? str_replace("-", "", $r->date) : date("Ymd");
        $dateformat = \Datetime::createFromFormat('dmY', $date);
        $date = $dateformat->format('Ymd');
        $w[]  = array('date', $date);
        $tb_caseworklist = Mongo::table('tb_caseworklist')->where($w)->orderBy('date', 'desc')->orderBy('time', 'desc')->get();

        $siph_api = new SIPHConnectController;

        $pacs = getCONFIG('pacs');
        $is_patientapi = $pacs->apipatientdetail ?? false;
        if($is_patientapi){
            foreach (isset($tb_caseworklist)?$tb_caseworklist:[] as $index => $worklist) {
                $worklist = (object) $worklist;
                $siph_api->get_worklist_patient($worklist->patientid, $worklist->accessionnumber);
            }
        }

        $arr['worklist'] = [];
        $tb_caseworklist = Mongo::table('tb_caseworklist')->where($w)->orderBy('date', 'desc')->orderBy('time', 'desc')->get();

        if(@$r->from.'' == 'recorder'){
            $arr = [];
            foreach (isset($tb_caseworklist)?$tb_caseworklist:[] as $index =>  $worklist) {
                $worklist = (object) $worklist;
                $wk_procedure = isset($worklist->proceduredescription) ? $worklist->proceduredescription : '';
                $matchs = $siph_api->match_procedure($wk_procedure, 'recorder');
                if(isset($matchs[0])){
                    $worklist->match_procedure =  $matchs[0];
                } else{
                    $worklist->match_procedure = get_key_config("default_procedure", 'lumina');
                }
                if(empty($worklist->match_procedure)){
                    $worklist->match_procedure = get_key_config("default_procedure", 'lumina');
                }
                $tb_caseworklist[$index] = $worklist;
            }
            return json_encode($tb_caseworklist);
        }

        $obj = new stdClass();

        foreach ($tb_caseworklist as $worklist) {
            $worklist   = (object) $worklist;
            $hn         = isset($worklist->patientid) ? $worklist->patientid : '';
            $doctorname = '';
            $id         = @$worklist->_id."";

            $obj->procedure = @$worklist->proceduredescription."";

            if(@$worklist->import_status."" == 'success'){
                continue;
            }

            if(@$r->only_colpo == 'true'){
                if(@$worklist->proceduredescription != 'Colposcopy'){
                    continue;
                }
            }

            if(@$hn."" != ""){
                if(isset($worklist->physicianname)){
                    $doctorname = $worklist->physicianname;
                }
                // $match_procedure = $siph_api->match_procedure($obj, 'recorder');

                $arr['worklist']["$id"]['patientname']     = isset($worklist->patient_nameTH) ? $worklist->patient_nameTH : $worklist->patientname;
                $arr['worklist']["$id"]['hn']              = $hn;
                // $arr['worklist']["$hn"]['doctorname']    = isset($arr['worklist']["$hn"]['doctorname']) ? $arr['worklist']["$hn"]['doctorname'] : $doctorname;
                $arr['worklist']["$id"]['doctorname']      = isset($doctorname) ? $doctorname : '';
                $arr['worklist']["$id"]['procedure']       = isset($worklist->proceduredescription) ? $worklist->proceduredescription : '';
                $arr['worklist']["$id"]['prediagnosis']    = isset($worklist->prediagnostic_other) ? $worklist->prediagnostic_other : '';
                $arr['worklist']["$id"]['accessionnumber'] = isset($worklist->accessionnumber) ? $worklist->accessionnumber : '';
                $arr['worklist']["$id"]['patienteng']      = isset($worklist->patientname) ? $worklist->patientname : '';
                $arr['worklist']["$id"]['visitno']         = isset($worklist->visitno) ? $worklist->visitno : '';
                $arr['worklist']["$id"]['time']            = isset($worklist->time) ? $siph_api->format_datestr($worklist->time) : '';
                // $arr['worklist']["$hn"]['match_procedure'] = isset($match_procedure) ? jsonDecode($match_procedure)[0] : get_key_config("procedure", 'lumina');
            }
        }

        $data               = isset($arr['worklist']) ? $arr : [];
        $data['count']      = count($arr['worklist']);
        $data['procedure']  = Mongo::table('tb_procedure')->get();
        $data['users']      = Mongo::table('users')->where('user_type', '!=', 'endo')->get();
        $view['html']       = view('endocapture.home.list-table.worklist', $data)->render();
        $view['wl_count']   = count($tb_caseworklist);
        return jsonEncode($view);
    }

    public function format_datestr($time_str){
        $str = '';
        if(isset($time_str) && $time_str != ''){
            for ($i=0; $i <= 5; $i++) {
                $char = isset($time_str[$i]) ? $time_str[$i] : '0';
                if($i == 1 || $i == 3){
                    $special  = ':';
                } else {
                    $special  = '';
                }
                $str  = $str.$char.$special;

            }
        }
        return $str;
    }

    public function save_patient($worklist){
        $patient['PatientFName']    = $worklist->firstname ?? '';
        $patient['PatientMName']    = '';
        $patient['PatientLName']    = $worklist->lastname ?? '';
        $patient['PatientTitle']    = '';
        $patient['PatientGender']   = $worklist->gender ?? '';
        $patient['PatientDob']      = $worklist->birthdate ?? '';
        $tb_patient =  Mongo::table('tb_patient')->where('hn', $worklist->patientid)->first();
        if(!isset($tb_patient)){
            $this->set_patient_data($patient, $worklist->patientid);
        }
    }

    public function get_worklist_patient($patient_hn, $accessionnumber){
        $siph = getCONFIG("siph");
        if($siph->server=="test"){
            $url = "http://EnvisionTest2/EnvisionRIEGet3rdPartyDataMedica/Service/SetOrder";
        }else{
            $url = "http://SiPHVmRis/EnvisionRIEGet3rdPartyDataMedica/Service/SetOrder";
        }

        $client = new \GuzzleHttp\Client();
        $data['AccessionNo'] = $accessionnumber;
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $json = jsonDecode($response->getBody());
        $json = (array) $json;

        // need delete
        // $json = [
        //     "Hn" => "2315861",
        //     "PatientTitle" => "นาง",
        //     "PatientFName" => "ดวงหทัย",
        //     "PatientMName" => "",
        //     "PatientLName" => "เวลาประภา",
        //     "PatientTitleEng" => "Mrs.",
        //     "PatientFNameEng" => "Duangrai",
        //     "PatientLNameEng" => "Veraprapa",
        //     "PatientGender" => "F",
        //     "PatientDob" => "1966-05-30T00:00:00",
        //     "PatientSsn" => "222222222222222",
        //     "VisitNo" => "1005012138",
        //     "AcknownledgementCode" => "AA",
        //     "TextMessage" => "Accept"
        // ];

        // dd($accessionnumber, $json);
        if($json['TextMessage'] == 'Accept'){
            $this->save_worklist_patient($json, $patient_hn, $accessionnumber);
        } else {
            // post data but not found patient data
            $u['patient_nameTH'] = '';
            $u['patient_status'] = 'unsuccess';
            Mongo::table('tb_caseworklist')->where('accessionnumber', $accessionnumber)->update($u);
        }

        return $json;
    }

    public function create_caseworklist($worklist, $patient){
        $val['updatetime']     = date("ymdHis");
        $val['comcreate']      = getCONFIG('admin')->com_name;

        $data = (object) array();
        $data->hn =  @$worklist->patientid."";
        $data->meet_date        = $this->change_date_format($worklist->date, "Y-m-d");
        $data->meet_hour        = "08:00";
        $data->case_physicians01 = "";
        $data->prediagnosis_other = "";
        $data->room               = "";
        $data->worklist_import    = true;
        $data->patienteng         = @$worklist->patientname."";
        $data->accessionno        = @$worklist->accessionnumber."";
        $data->visitno            = @$patient['VisitNo']."";
        $cid                      = insertCASE($val,$data);
        $val['caseuniq']    = $cid;
        insertMEDICATION($val);
    }

    public function change_date_format($date, $format){
        $date = date_format(date_create($date), $format);
        return $date;
    }

    public function save_worklist_patient($data, $hn, $accessionnumber){
        $u = [];
        $tb_patient = Mongo::table('tb_patient')->where('hn', $hn)->first();

        // if(isset($tb_patient) == false){
        //     // create patient
        //     $_id = $this->set_patient_data($data, $hn);
        // }

        if(isset($tb_patient) == false){
            // create patient -if ทดสอบ222 ต้องยิง api ใหม่
            if(str_contains($data['PatientFName'], 'ทดสอบ222') || str_contains($data['PatientLName'], 'ทดสอบ222')){
                $data = $this->get_patientname_api($hn, $accessionnumber);
            }
            $_id = $this->set_patient_data($data, $hn);
        } else {
            if(str_contains(@$tb_patient['firstname']."", 'ทดสอบ222') || str_contains(@$tb_patient['lastname']."", 'ทดสอบ222')){
                $data = $this->get_patientname_api($hn, true);
            }
        }

        $u['patient_nameTH'] = '';
        if(isset($data['PatientFName']) && isset($data['PatientLName'])){
            $u['patient_nameTH'] = @$data['PatientTitle']."".@$data['PatientFName'].""." ".@$data['PatientMName'].""." ".@$data['PatientLName']."";
            $u['patient_status'] = 'success';
        } else {
            $u['patient_nameTH'] = '';
            $u['patient_status'] = 'unsuccess';
        }


        if(isset($data['VisitNo'])){
            $u['visitno']        = @$data['VisitNo']."";
            // $u['visitno']        = "1005012138";
        }

        if(isset($data['ReferringDoctorUid']) && @$data['ReferringDoctorUid']."" != ""){
            // remove 0 from doctor uid
            // $doctor_uid = str_replace('0', '', $data['ReferringDoctorUid']);
            $doctor_uid = ltrim($data['ReferringDoctorUid'], '0');
            $w1[0] = array('user_code', $doctor_uid);
            $orw1[0] = array('user_code', intval($doctor_uid));
            $user = (object) Mongo::table('users')->where($w1)->orWhere($orw1)->first();
            $u['physicianname'] = @$data['ReferringDoctorFName']." ".@$data['ReferringDoctorLName'];
            $u['physiciancode']   = strval($doctor_uid);
            $u['physicianid']   = isset($user->id) ? strval(@$user->id) : '';
        } else {
            $u['physiciancode'] = "";
            $u['physicianid']   = "";
        }
        // dd($data);
        if(isset($data['Hn'])){
            Mongo::table('tb_caseworklist')->where('patientid', $data['Hn'])->where('accessionnumber', $accessionnumber)->update($u);
        }
    }

    public function get_patientname_api($patient_hn, $update_patient=false){
        $client = new \GuzzleHttp\Client();
        $data['Hn'] = $patient_hn;
        $url = "http://SiPHVmRis/EnvisionRIEGet3rdPartyDataMedica/Service/Setpatient";
        $response = $client->post($url, [
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'body'    => json_encode($data)
        ]);
        $json = jsonDecode($response->getBody());
        $json = (array) $json;
        if($update_patient){
            $this->update_patient_again($json, $patient_hn);
        }
        return $json ?? [];
    }

    public function update_patient_again($patient, $hn){
        $val['firstname']   = @$patient['PatientFName']."";
        $val['middlename']  = @$patient['PatientMName']."";
        $val['lastname']    = @$patient['PatientLName']."";
        $val['prefix']      = @$patient['PatientTitle']."";
        if(isset($patient['PatientGender'])){
            $val['gender']  = @$patient['PatientGender'] == 'F' ? 2 : 1;
        } else {
            $val['gender']  = 1;
        }

        if(isset($patient['PatientDob'])){
            // $val['birthdate']           = str_replace("T", " ", @$patient['PatientDob']);
            $val['birthdate']           = str_contains(@$patient['PatientDob'], 'T') ? explode("T",@$patient['PatientDob'])[0] : @$patient['PatientDob']."";
        } else {
            $val['birthdate']           = "";
        }

        if($val['firstname'] != "" && $val['lastname'] != ""){
            try{
                $lastid = Mongo::table('tb_patient')->where('hn', $hn)->update($val);
            } catch(\Exception $e){}
        }
    }

    public function set_patient_data($patient, $hn){
        // dd($patient);
        $val['allergic']            = "";
        $val['congenital_disease']  = "";
        $val['emer_name']           = "";
        $val['emer_tel']            = "";
        $val['firstname']           = @$patient['PatientFName']."";
        $val['middlename']          = @$patient['PatientMName']."";
        $val['lastname']            = @$patient['PatientLName']."";
        $val['phone']               = "";
        $val['an']                  = "";
        $val['citizen']             = "";
        $val['pic']                 = "";
        $val['email']               = "";
        $val['prefix']              = @$patient['PatientTitle']."";
        // $val['hn']                  = $patient['Hn']."";
        $val['hn']                  = $hn."";


        if(isset($patient['PatientGender'])){
            $val['gender']              = @$patient['PatientGender'] == 'F' ? 2 : 1;
        } else {
            $val['gender']              = 1;
        }

        $val['birthdate']  = "";
        if(isset($patient['PatientDob'])){
            // $val['birthdate']           = str_replace("T", " ", @$patient['PatientDob']);
            $val['birthdate']           = str_contains(@$patient['PatientDob'], 'T') ? explode("T",@$patient['PatientDob'])[0] : @$patient['PatientDob']."";
            if($val['birthdate'] != ""){
                try{
                    $val['birthdate'] = date('Y-m-d', strtotime($val['birthdate']));
                } catch(Exception $e){}
            }
        }

        $val['nationality']         = "";
        $val['regis_date']          = "";
        $val['regis_time']          = "";
        $val['created_at']          = Carbon::now()->toDateTimeString();
        // dd($val);
        $lastid = Mongo::table('tb_patient')->insertGetId($val);
    }


    public function update_caseworklist($accessionnumber){
        if(isset($accessionnumber)){
            $w['accessionnumber'] = $accessionnumber;
            Mongo::table('tb_caseworklist')->where($w)->insert(['import_status'=>'success']);
        }
    }

    public function import_caseworklist($r){
        $status['text'] = '';
        if(isset($r->hn) && isset($r->patientname) && isset($r->procedure)){
            $procedure = $r->procedure;
            $time      = isset($r->time) ? $r->time : '';
            if($time != '' && isset($r->time)){
                $exp = explode(':', $time);
                $hour = isset($exp[0]) ? $exp[0] : '';
                $minute = isset($exp[1]) ? $exp[1] : '';
            } else {
                $hour = '';
                $minute = '';
            }

            $pacs = getCONFIG('pacs');
            $is_patientapi = $pacs->apipatientdetail ?? false;
            if(!$is_patientapi){
                $w1['patientid'] = @$r->hn;
                $w1['accessionnumber'] = @$r->accessionnumber;
                $wk         =  Mongo::table("tb_caseworklist")->where($w1)->first();
                $this->save_patient((object) $wk);
            }

            // $decode_proc = json_decode($r->procedure, true);
            $val['updatetime']     = date("ymdHis");
            $val['comcreate']      = getCONFIG('admin')->com_name;
            $val['created_from']   = @$r->from;

            $data = (object) array();
            $data->hn =  $r->hn;
            $data->meet_date        = date("Y-m-d");
            $data->meet_hour        = isset($hour) ? $hour : "08";
            $data->meet_minute      = isset($minute) ? $minute : "00";
            $data->room             = "";
            $data->case_physicians01 = @$r->doctorname."";
            $data->useropen         = $r->useropen;
            // if(isset($data->case_physician01)){
            //     $data->case_physician01 = intval($data->case_physician01);
            // }
            $data->prediagnosis_other = @$r->prediagnosis_other."";
            $data->worklist_import    = true;
            $data->patienteng         = @$r->patienteng."";
            $data->accessionno        = @$r->accessionnumber."";
            $data->visitno            = @$r->visitno."";

            try {
                foreach (isset($procedure)?$procedure:[] as $proc) {
                    $data->case_procedurecode = $proc;
                    $cid                = insertCASE($val,$data);
                    $val['caseuniq']    = $cid;
                    insertMEDICATION($val);
                    // $procedurename      = $this->get_procedurename($proc);
                    // $this->update_caseworklist($r->accessionnumber);
                }

                $status['text'] = 'success';
            } catch (\Exception $e){
                $status['text'] = 'error';
            }



            return json_encode($status);
        } else {
            $status['text'] = 'success';
            return json_encode($status);
        }


    }

    public function import_caseworklist_recorder($r){
        $status['text'] = '';
        if(isset($r->hn) && isset($r->patientname) && isset($r->procedure)){
            $procedure = $r->procedure;
            $time      = isset($r->time) ? $r->time : '';
            if($time != '' && isset($r->time)){
                $exp = explode(':', $time);
                $hour = isset($exp[0]) ? $exp[0] : '';
                $minute = isset($exp[1]) ? $exp[1] : '';
            } else {
                $hour = '';
                $minute = '';
            }

            $pacs = getCONFIG('pacs');
            $is_patientapi = $pacs->apipatientdetail ?? false;
            if(!$is_patientapi){
                $w1['patientid'] = @$r->hn;
                $w1['accessionnumber'] = @$r->accessionnumber;
                $wk         =  Mongo::table("tb_caseworklist")->where($w1)->first();
                $this->save_patient((object) $wk);
            }

            $config                  = getCONFIG('admin');
            $config_room             = @$config->station_room;
            $room                    = (object) Mongo::table('tb_room')->where('room_id', intval($config_room))->first();
            $roomid                  = @$room->room_id;

            // $decode_proc = json_decode($r->procedure, true);
            $val['updatetime']     = date("ymdHis");
            $val['comcreate']      = getCONFIG('admin')->com_name;
            $val['room_id']           = $roomid;
            $val['room']              = $roomid;
            $val['room_name']         = $config_room;
            $val['created_from']      = @$r->from."" == 'recorder' ? 'worklist' : '';

            $data = (object) array();
            $data->hn =  $r->hn;
            $data->meet_date        = date("Y-m-d");
            $data->meet_hour        = isset($hour) ? $hour : "08";
            $data->meet_minute      = isset($minute) ? $minute : "00";
            $data->room               = $roomid;
            // $data->case_physicians01 = @$r->doctorname."";
            $data->useropen          = $r->useropen;
            // if(isset($data->case_physician01)){
            //     $data->case_physician01 = intval($data->case_physician01);
            // }
            $data->prediagnosis_other = @$r->prediagnosis_other."";
            $data->worklist_import    = true;
            $data->patienteng         = @$r->patienteng."";
            $data->accessionno        = @$r->accessionnumber."";
            $data->visitno            = @$r->visitno."";
            $nulluser = false;

            try {
                // $exp = explode(' ', $r->doctorname);
                // $firstname = isset($exp[0]) ? $exp[0] : '';
                // $lastname  = isset($exp[1]) ? $exp[1] : '';
                // $w1[0] = array('user_firstname', $firstname);
                // $w1[1] = array('user_lastname', $lastname);
                // $user_test = (object) Mongo::table('users')->where($w1)->first();
                $wk         = Mongo::table("tb_caseworklist")->where("accessionnumber",@$r->accessionnumber)->first();
                $user_test  = @$wk['physiciancode']."" == '' ? null : (object) Mongo::table('users')->where("user_code",@$wk['physiciancode']."")->first();
                if(isset($user_test->_id)){
                    $data->case_physicians01 = @$user_test->id."" != "" ? intval($user_test->id) : 1;
                    $data->doctorname = @$user_test->user_prefix.@$user_test->user_firstname." ".@$user_test->user_lastname;
                }else{
                    if(isset($r->doctorname)){
                        $exp = explode(' ', $r->doctorname);
                        if(count($exp) == 2){
                            $exp2 = explode('.', $exp[0]);
                            $firstname = @$exp2[1]."";
                            $lastname = @$exp[1]."";
                        } else {
                            $firstname = @$exp[1]."";
                            $lastname = @$exp[2]."";
                        }
                        $w1[0] = array('user_firstname', @$firstname."");
                        $w1[1] = array('user_lastname', @$lastname."");
                        $user = (object) Mongo::table('users')->where($w1)->first();
                        $data->case_physicians01 = @$user->id."" != "" ? intval($user->id) : 1;
                        $data->doctorname = @$user->user_prefix.@$user->user_firstname." ".@$user->user_lastname;
                    } else { $nulluser = true; }

                }
            } catch (Exception $e) {
                $nulluser = true;
            }



            if($nulluser){
                $w[] = array('email', 'like','%test%');
                $w[] = array('department', get_key_config("default_department", 'lumina'));
                $user_test = (object) Mongo::table('users')->where($w)->first();
                $data->case_physicians01 = @$user_test->id."" != "" ? intval($user_test->id) : 1;
                $data->doctorname = @$user_test->user_prefix.@$user_test->user_firstname." ".@$user_test->user_lastname;
            }


            // $config_procedure_code   = get_key_config("procedure_code", 'lumina');
            // $config_procedure        = get_key_config("procedure", 'lumina');
            $config_procedure        = !isset($r->procedure) ? get_key_config("default_procedure", 'lumina') : $r->procedure;
            $key_procedure           = !isset($config_procedure_code) ? $this->get_procedurecode($config_procedure) : '';
            if($key_procedure == ''){
                $key_procedure = $this->get_procedurecode(get_key_config("default_procedure", 'lumina'));
            }
            $data->case_procedurecode = $key_procedure;
            $procedure               = [$key_procedure];

            try {
                foreach (isset($procedure)?$procedure:[] as $proc) {
                    $data->case_procedurecode = $proc;
                    $cid                = insertCASE($val,$data);
                    $val['caseuniq']    = $cid;
                    insertMEDICATION($val);
                    // $procedurename      = $this->get_procedurename($proc);
                    // $this->update_caseworklist($r->accessionnumber);
                    if(@$r->from.'' == 'recorder'){
                        $data = $this->set_case_data($cid);
                        $data['open'] = "close";
                        $this->set_data_config($data, 'lumina');
                        $this_case = Mongo::table('tb_case')->where('_id', $cid)->first();
                        return json_encode($this_case);
                    }
                }

                $status['text'] = 'success';
            } catch (\Exception $e){
                $status['text'] = 'error';
            }



            return json_encode($status);
        } else {
            $status['text'] = 'success';
            return json_encode($status);
        }
    }

    public function get_procedurename($proc){
        $w[] = array('code', $proc);
        $tb_procedure = (object) Mongo::table('tb_procedure')->where($w)->first();
        $name = $tb_procedure->name;
        return $name;
    }

    public function get_procedurecode($procedurename){
        $w[] = array('name',  'like', '%'.$procedurename.'%');
        $tb_procedure = Mongo::table('tb_procedure')->where($w)->first();
        $code = '';
        if(isset($tb_procedure)){
            $tb_procedure = (object) $tb_procedure;
            $code = isset($tb_procedure->code) ? $tb_procedure->code : '';
        }
        return $code;
    }

    public function set_case_data($id){
        $this_case = Mongo::table('tb_case')->where('_id', $id)->first();
        $this_case = (Object) $this_case;
        $data['patientname'] = isset($this_case->patientname) ? $this_case->patientname : '';
        $data['doctorname']  = isset($this_case->doctorname) ? $this_case->doctorname : '';
        $data['procedurename']   = isset($this_case->procedurename) ? $this_case->procedurename : '';
        $data['age'] = isset($this_case->age) ? $this_case->age : '';
        $data['hn'] = isset($this_case->hn) ? $this_case->hn : '';
        $data['cid'] = isset($id) ? $id : '';
        $data['appointment'] = isset($this_case->appointment) ? explode(' ', $this_case->appointment)[0] : '';
        $data['open'] = 'capture';
        return $data;
    }

    public function set_data_config($data, $configname){
        $path = "D:/laragon/htdocs/config/project/$configname.txt";
        try {
            if(file_exists($path)){
                foreach ($data as $key => $val) {
                    setCONFIG($configname, $key, $val);
                }
            } else {
                $data['python'] = true;
                $json = json_encode($data);
                file_put_contents($path, $json);
            }
        } catch(\Exception $e) {}
    }


    public function match_procedure($r, $type=''){
        $procedurename = $type == '' ? @$r->procedure : $r;
        $tb_worklistfindtext = Mongo::table('tb_worklistfindtext')->get();
        $match = [];
        foreach(isset($tb_worklistfindtext)?$tb_worklistfindtext:[] as $findtext){
            $findtext = (object) $findtext;
            $find = @$findtext->text_find."";
            $text = @$findtext->text_match."";
            if(str_contains(strtolower($procedurename), strtolower($find))){
                $match[] = $text;
            }
        }
        if(isset($r->save) && $r->save){
            $w[] = array('accessionnumber', @$r->accessno."");
            $u['match_procedure'] = $match;
            Mongo::table('tb_caseworklist')->where($w)->update($u);
        }
        return $type == '' ? json_encode($match) : $match;
    }

    public function match_doctor($r){
        $accessionno = @$r->accessno;
        $w[0]   = array('accessionnumber', $accessionno);
        $orw[0] = array('accessionnumber', intval($accessionno));
        if(@$accessionno."" != ''){

            $tb_caseworklist = (object) Mongo::table('tb_caseworklist')
            ->where($w)
            ->orWhere($orw)
            ->first();

            $userid = isset($tb_caseworklist->physicianid) && @$tb_caseworklist->physicianid."" != "" ? $tb_caseworklist->physicianid : 'error';
        } else {
            $userid = 'error';
        }
        if(isset($r->save) && $r->save){
            $u['match_physician'] = $userid != 'error' ? $userid : '';
            Mongo::table('tb_caseworklist')->where($w)->update($u);
        }
        return json_encode($userid);
    }

    // python send requests - Lumina

    public function getdoccat($r){
        $procedure = $r->procedurename;
        $doccat = 'RES_COLSCP';
        if(isset($procedure)){
            $w[] = array('name', $procedure);
            $tb_doccat = (object) Mongo::table('tb_doccat')->where($w)->first();
            try {
                $doccat  = $tb_doccat->doccat;
            } catch(\Exception $e) {}
        }
        echo $doccat;
    }

    public function getusercode($r){
        $doctor_id = $r->case_physicians01;
        $w1[0] = array('id', intval($doctor_id));
        $users = (object) Mongo::table('users')->where($w1)->first();
        $user_code = @$users->user_code."";
        echo $user_code;
    }

    public function getinfo_accessionnumber($r){
        $accessionno = $r->accessno;
        $cid = $r->cid;

        $json = [
            "TextMessage" => ""
        ];

        try {
            $url = "http://SiPHVmRis/EnvisionRIEGet3rdPartyDataMedica/Service/SetOrder";
            $client = new \GuzzleHttp\Client();
            $data['AccessionNo'] = $accessionno;
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'body'    => json_encode($data)
            ]);
            $json = jsonDecode($response->getBody());
            $json = (array) $json;
        } catch (\Exception $e){}

        // mock data
        // $json = [
        //     "Hn" => "2315861",
        //     "PatientTitle" => "นาง",
        //     "PatientFName" => "ดวงหทัย",
        //     "PatientMName" => "",
        //     "PatientLName" => "เวลาประภา",
        //     "PatientTitleEng" => "Mrs.",
        //     "PatientFNameEng" => "Duangrai",
        //     "PatientLNameEng" => "Veraprapa",
        //     "PatientGender" => "F",
        //     "PatientDob" => "1966-05-30T00:00:00",
        //     "PatientSsn" => "222222222222222",
        //     "VisitNo" => "1005012138",
        //     "AcknownledgementCode" => "AA",
        //     "TextMessage" => "Accept"
        // ];

        // force error
        // $json['TextMessage'] = 'no';

        if($json['TextMessage'] == 'Accept'){
            $up['accessionno'] = $accessionno;
            $up['visitno'] = @$json['VisitNo'];
            $wup[0] = array('_id', $cid);
            Mongo::table('tb_case')->where($wup)->update($up);

            $w[0] = array('accessionno', $accessionno);
            $orw[0] = array('accessionno', intval($accessionno));
            $tb_case = Mongo::table('tb_case')->where($w)->orWhere($orw)->orderBy('appointment','desc')->first();

            if (isset($tb_case)){
                $tb_case = (object) $tb_case;
                $doccat = '';
                try {
                    $doccat     = $this->get_doccat($tb_case->procedurename);
                } catch(\Exception) {}

                $w1[0]              = array('id', intval($tb_case->case_physicians01));
                $users              = (object) Mongo::table('users')->where($w1)->first();
                $user_code          = @$users->user_code."";
                $tb_case->doccat    = $doccat;
                $tb_case->user_code = $user_code;
                echo jsonEncode($tb_case);
            } else {
                echo @$r->from."" == '' ? 'error' : jsonEncode('error');
            }
        } else {
           echo @$r->from."" == '' ? 'error' : jsonEncode('error');
        }
    }


}
