<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo;
use Exception;
use App\Models\Server;
use App\Models\Department;
use Carbon\Carbon;

class LuminaController extends Controller
{

    public function index(){
        $data = $this->procedure_all();
        // dd(jsonEncode($data));
    }

    public function store(Request $r){
        if (isset($r->e)||isset($r->event)) {
            $event  = $r->e??$r->event;
            return $this->$event($r);
        }
    }

    public function physician_all(){
        $physician = Department::user("doctor");
        $arr = array();
        $i=0;
        foreach($physician as $data){
            $arr[$i]['id']      = $data['id'];
            $arr[$i]['name']    = fullName($data);
            $i++;
        }
        printJSON($arr);
    }

    public function casedetail($r){
        $tb_case = Mongo::table("tb_case")->where("_id",$r->cid)->first();
        $this->tb_lumina_update($tb_case);
        printJSON($tb_case);
    }

    public function create_case($r){
        $id = $this->create_casenew($r);
        $data = $this->set_case_data($id);
        $this->set_data_table($data, 'lumina');
        echo jsonEncode($data);
    }

    public function create_patient($hn, $date, $val=null){
        $i['firstname'] = isset($val) ? @$val['firstname'].""  : 'test';
        $i['lastname']  = isset($val) ? @$val['lastname'].""   : 'test';
        $i['prefix']    = isset($val['prefix']) ? @$val['prefix']."" : 'นาย';
        $i['hn']        = isset($val) ? @$val['hn'].""         : $hn;
        $i['gender']    = isset($val) ? @$val['gender'].""     : 1;
        $i['birthdate'] = isset($val) ? @$val['date'].""       : $date;
        Mongo::table('tb_patient')->insert($i);
    }

    public function create_case_without_hn($r){

        $fixed_hn   = '0000000000';
        $date       = date("YmdHis");
        $now        = Carbon::now()->format('Y-m-d');
        $tb_patient = Mongo::table('tb_patient')->where('hn', $fixed_hn)->first();
        if(!isset($tb_patient)){
            $this->create_patient($fixed_hn, $now);
            $tb_patient = Mongo::table('tb_patient')->where('hn', $fixed_hn)->first();
        }


        $config_procedure_code   = get_key_config("default_procedure_code", 'lumina');
        $config_procedure        = get_key_config("default_procedure", 'lumina');
        $config_modality         = get_key_config("default_modality", 'lumina');
        $key_procedure           = !isset($config_procedure_code) ? $this->get_procedurecode($config_procedure) : $config_procedure_code;
        // $config_department       = get_key_config("department");
        $config                  = getCONFIG('admin');
        $config_room             = @$config->station_room;
        $room                    = (object) Mongo::table('tb_room')->where('room_id', intval($config_room))->first();
        $roomid                  = @$room->room_id;

        $tb_lumina = (object) Mongo::table('tb_lumina')->where('id', 1)->first();

        $tb_patient              = (object) $tb_patient;
        $r->useropen             = @uid();
        $r->case_hn              = $fixed_hn;
        $r->hn                   = $fixed_hn;
        $r->case_dateappointment = "$now 08:00";
        $r->case_procedurecode   = (@$key_procedure."" != "") ? $key_procedure : "uro011";
        $r->case_physicians01     = 49;


        $r->room                 = $roomid;
        $val['firstname']        = !checkNULL($r->firstname) ? $tb_patient->firstname : $r->firstname;
        $val['lastname']         = !checkNULL($r->lastname)  ? $tb_patient->lastname  : $r->lastname;
        $val['hn']               = $date;
        // $val['case_hn']          = $date;
        $val['case_hn']          = $fixed_hn;
        $val['hntemp']           = $date;
        $val['gender']           = !checkNULL($r->gender)    ? $tb_patient->gender       : $r->gender;
        $val['age']              = !checkNULL($r->age)       ? age(@$tb_patient->birthdate) : $r->age;
        $val['date']             = $now;
        $val['procedure']        = $r->procedurename;
        $val['physician']        = $r->physicianname;
        $val['doctorname']        = $r->physicianname;
        $val['updatetime']       = date("ymdHis");
        $val['comcreate']        = getconfig('admin')->com_name;
        $val['modality']         = $config_modality;
        $val['appointment_date'] = $now;
        $val['room']             = intval($roomid);
        $val['room_id']          = intval($roomid);
        $val['room_name']        = $config_room;

        $cid                     = insertCASE($val,$r);
        // dd("ccccc");
        $val['caseuniq']         = $cid;
        $val['department']       = $tb_lumina->default_lumina ?? 'OR';

        insertMEDICATION($val);

        $arr['cid'] = $cid;
        printJSON($arr);
        // return $cid;
    }


    public function set_case_data($id){
        $this_case = Mongo::table('tb_case')->where('_id', $id)->first();
        $this_case = (Object) $this_case;
        $user_code = Mongo::table('users')->where('uid', @intval($this_case->case_physicians01))->pluck('user_code')->first() ?? '';
        $data['patientname']        = isset($this_case->patientname) ? $this_case->patientname : '';
        $data['doctorname']         = isset($this_case->doctorname) ? $this_case->doctorname : '';
        $data['procedurename']      = isset($this_case->procedurename) ? $this_case->procedurename : '';
        $data['caseuniq']           = isset($this_case->caseuniq) ? $this_case->caseuniq : '';
        $data['age']                = isset($this_case->age) ? $this_case->age : '';
        $data['hn']                 = isset($this_case->hn) ? $this_case->hn : '';
        $data['cid']                = isset($id) ? $id : '';
        $data['appointment']        = isset($this_case->appointment) ? $this_case->appointment : '';
        $data['appointment_date']   = isset($this_case->appointment_date) ? $this_case->appointment_date : '';
        $data['open']               = 'capture';
        $data['id']                 = 1;
        $data['_id']                = isset($this_case->caseuniq) ? $this_case->caseuniq : '';
        $data['doctorcode']         = @$user_code."";
        $data['time_start']         = isset($this_case->time_start) ? $this_case->time_start : '';
        $data['time_stop']          = isset($this_case->time_stop)  ? $this_case->time_stop : '';
        return $data;
    }



    public function create_casenew($r){
        // $birth =  ($r->birthyear-543). "-" . $r->birthmonth . "-" . $r->birthday;
        $birth = (date('Y') - intval($r->age)). "-01-01";
        if ($r['myHiddenField'] != null) {
            $data              = $r['myHiddenField'];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data              = base64_decode($data);
            file_put_contents('pic_patient/' . $r->hn . '.png', $data);
            $pic = $r->hn . '.png';
        } else {
            $pic = "";
        }
        $date       = date("YmdHis");
        $now        = Carbon::now()->format('Y-m-d');
        $r->case_dateappointment = "$now 08:00";
        $r->case_procedurecode   = $r->case_procedurecode;
        $r->useropen        = @uid();
        $tb_lumina = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
        // $config_room             = get_key_config("default_room", 'lumina');
        $config                  = getCONFIG('admin');
        $config_room             = @$config->station_room;
        $room                    = (object) Mongo::table('tb_room')->where('room_id', intval($config_room))->first();
        $roomid                  = @$room->room_id;
        $r->room                 = $roomid;
        $val['prefix']          = $r->prefix;
        $val['firstname']       = $r->firstname;
        $val['lastname']        = $r->lastname;
        $val['hn']              = $r->hn;
        $val['gender']          = $r->gender;
        $val['age']             = $r->age;
        $val['date']            = $birth;
        $val['birthdate']       = $birth;
        $val['procedure']       = $r->procedurename;
        $val['physician']       = $r->physicianname;
        $val['case_procedurecode']  = $r->case_procedurecode;
        $val['room']             = intval($roomid);
        $val['room_id']          = intval($roomid);
        $val['room_name']        = $config_room;
        $val['updatetime']  = date("ymdHis");
        $val['comcreate']   = getconfig('admin')->com_name;
        $val['appointment_date'] = $now;
        $val['department']       = $tb_lumina->default_lumina ?? 'OR';

        $tb_patient = Mongo::table('tb_patient')->where('hn', $val['hn'])->first();
        if(!isset($tb_patient)){
            $this->create_patient('', '', $val);
            $tb_patient = Mongo::table('tb_patient')->where('hn', $val['hn'])->first();
        } else {
            // check if the patient data is the same as in the tb_patient - if not update it
            $this->check_patient($tb_patient, $val);
        }

        $cid                = insertCASE($val,$r);
        $val['caseuniq']    = $cid;
        insertMEDICATION($val);

        return $cid;
    }

    public function check_patient($patient, $data){
        $keys = ['firstname', 'lastname', 'prefix', 'birthdate'];
        $u = array();
        foreach ($keys??[] as $key) {
            if (isset($patient[$key], $data[$key]) && @$patient[$key] !== @$data[$key]) {
                $u[$key] = $data[$key];
            }
        }

        if (isset($patient['gender'], $data['gender']) && intval($patient['gender']) !== intval($data['gender'])) {
            $u['gender'] = intval($data['gender']);
        }

        if(!empty($u)){
            Mongo::table('tb_patient')->where('hn', $data['hn'])->update($u);
        }

    }



    public function tb_lumina_update($data){
        $val['age']             = $data['age'];
        $val['appointment']     = $data['appointment_date'];
        $val['caseuniq']        = $data['caseuniq'];
        $val['cid']             = $data['_id']."";
        $val['doctorname']      = $data['doctorname'];
        $val['hn']              = $data['case_hn'];
        $val['patientname']     = $data['patientname'];
        $val['procedurename']   = $data['procedurename'];
        $val['procedure_code']  = $data['case_procedurecode'];
        Mongo::table("tb_lumina")->update($val);
    }

    public function procedure_all(){
        //เลขห้า คือ การmockup ไว้ก่อน
        $procedure = Department::procedure(5);
        $arr = array();
        $i=0;
        foreach($procedure as $data){
            $arr[$i]['code']    = $data['code'];
            $arr[$i]['name']    = $data['name'];
            $i++;
        }
        printJSON($arr);
    }


    public function set_data_table($data, $configname){
        try{
            Mongo::table('tb_lumina')->where('id', 1)->update($data);
        } catch (Exception $e) {}
    }






    public function caselist_index(){
        $w[]      = array('department', $def_dep??"GI");
        $w[]      = array('statusjob', '!=', 'delete');
        $w[]      = array('statusjob', '!=', 'cancel');
        $w[]      = array('case_status', '!=', 90);
        $tb_case  = Mongo::table('tb_case')
        ->where($w)
        ->limit(100)
        ->orderby("appointment","desc")
        ->get();

        $main = array();
        $i=0;
        foreach ($tb_case??[] as $case) {
            $ex     = explode(" ", $case['case_dateregister']??"00-00-00 00:00:00");
            $gender = $this->gender($case['gender']);
            $main[$i]['id']         = $case['_id']."";
            $main[$i]['hn']         = $case['case_hn'];
            $main[$i]['patient']    = $case['patientname'];
            $main[$i]['gender']     = $gender;
            $main[$i]['age']        = $case['age'];
            $main[$i]['procedure']  = $case['procedurename'];
            $main[$i]['date']       = $ex[0];
            $main[$i]['time']       = $ex[1];
            $i++;
        }
        printJSON($main);
    }

    public function storage_index(){
        $w[]      = array('department', $def_dep??"GI");
        $w[]      = array('statusjob', '!=', 'delete');
        $w[]      = array('statusjob', '!=', 'cancel');
        $w[]      = array('case_status', '!=', 90);
        $tb_case  = Mongo::table('tb_case')
        ->where($w)
        ->limit(100)
        ->orderby("appointment","desc")
        ->get();

        $main = array();
        $i=0;
        foreach ($tb_case??[] as $case) {
            $ex     = explode(" ", $case['case_dateregister']??"00-00-00 00:00:00");
            $gender = $this->gender($case['gender']);
            $main[$i]['id']         = $case['_id']."";
            $main[$i]['hn']         = $case['case_hn'];
            $main[$i]['patient']    = $case['patientname'];
            $main[$i]['gender']     = $gender;
            $main[$i]['age']        = $case['age'];
            $main[$i]['procedure']  = $case['procedurename'];
            $main[$i]['photo']      = count($case['photo']??[]);
            $main[$i]['video']      = count($case['video']??[]);
            $main[$i]['duration']   = $this->duration($case);
            $main[$i]['pacs']       = $this->pacsstatus($case);
            $main[$i]['date']       = $ex[0];
            $main[$i]['time']       = $ex[1];
            $i++;
        }
        printJSON($main);
    }

    public function pacsstatus($case){
        $str = "";
        if(isset($case['case_pacs'])){
            $end = end($case['case_pacs']);
            $str = @$end['status']."";
        }
        return $str;
    }

    public function duration($case){
        $min = 0;
        if(isset($case['time_start']) && isset($case['time_end'])){
            $start      = $case['time_start'];
            $end        = $case['time_end'];
            $to_time    = strtotime("2008-12-13 $end");
            $from_time  = strtotime("2008-12-13 $start");
            $min =  round(abs($to_time - $from_time) / 60,0);
        }
        return $min;
    }

    public function gender($data){
        $str="None";
        if($data==1){
            $str="M";
        }
        if($data==2){
            $str="F";
        }
        if($data==3){
            $str="None";
        }
        if($data==4){
            $str="Not to say";
        }
        return $str;
    }

    public function create_user($r){
        $data = $this->set_user_array($r);
        try {
            Mongo::table('users')->insert($data);
        } catch(\Exception $e) {dd($e);}
    }

    public function update_user($r){
        $w[0] = array('department', strtoupper($r->department));
        $w[1] = array('username', $r->email);
        $user = Mongo::table('users')->where($w)->first();
        if(isset($user)){
            $data = $this->set_user_array($r, (object) $user);
            Mongo::table('users')->where($w)->update($data);
        }
    }

    public function set_user_array($r, $user_data=null){
        $i['id']                = isset($user_data->id) && @$user_data->id."" != ""  ? $user_data->id : get_last_id('id', 'users') + 1;
        $i['department']        = $r->department;
        $i["user_status"]       = 'active';
        $i['comname']           = getconfig('admin')->com_name;
        $i['tablename']         = "tb_department";
        $i['user_code']         = "";
        $i["user_type"]         = "endo";
        $i['user_branch']       = "";
        $i['practical']         = "";
        $i['color']             = "#000000";
        $i['user_rfid']         = "";
        $i['user_prefix']       = "";
        $i['user_firstname']    = "$r->department";
        $i['user_lastname']     = "";
        $i['user_email']        = @$r->username."";
        $i['user_config']       = "";
        $i["name"]              = "Doctor";
        $i["email"]             = @$r->username."";
        $i['phone']             = "";
        $is_same_password       = isset($r->password) && isset($user_data->password)        ? ($r->user_password == $user_data->password ): false;
        $hash                   =  bcrypt($r->password);
        $i["password"]          = $is_same_password  ? $user_data->password : $hash;// Hash::make($r->input($user."_password"));
        $i['remember_token']    = "";
        $i['opencase']          = 1;
        $i['procedure_json']    = "";

        if(isset($user_data)){
            $i['updated_at']        = Carbon::now()->toDateTimeString();
        } else {
            $i['created_at']        = Carbon::now()->toDateTimeString();
        }

        return $i;
    }


    public function set_lumina_config($r){
        $update_key = isset($r->id) ? $r->id : '';
        $update_val = isset($r->val) ? $r->val : '';
        if($update_key != '' && $update_val != ''){
            $tb_lumina = Mongo::table('tb_lumina')->where('id', 1)->first();
            if(!isset($tb_lumina)){
                $arr['id'] = 1;
                Mongo::table('tb_lumina')->insert($arr);
            }
            $u[$update_key] = $update_val;
            try{
                Mongo::table('tb_lumina')->where('id', 1)->update($u);
                return 'success';
            } catch (Exception $e) {return 'error';}
        }
    }


}
