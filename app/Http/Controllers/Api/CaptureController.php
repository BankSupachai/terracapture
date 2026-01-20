<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo;
use Exception;
use App\Models\Server;
use App\Models\Datacase;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Camera;

class CaptureController extends Controller
{

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            if (method_exists($this, $event)) {
                return $this->$event($r);
            }
        }
        return response()->json(['error' => 'Invalid event'], 400);
    }

    public function load_userincase($r)
    {
        $case = Mongo::table('tb_case')->where('id', $r->cid)->first();
        $user_in_case = $case->user_in_case ?? [];
        $html = '';
        foreach ($user_in_case as $key => $value) {
            $value = intval($value);
            $tb_user = Mongo::table('users')->where('uid', $value)->first();
            $html .= '
            <div class="row">
                <div class="col-9">
                    ' . @$tb_user->user_prefix . ' ' . @$tb_user->user_firstname . ' ' . @$tb_user->user_lastname . ' ' . @$tb_user->user_code . '
                </div>
            </div>';
        }
        echo $html;
    }

    public function case_update($r)
    {
        $val[$r->key] = $r->value;
        Mongo::table('tb_case')->where('_id', $r->cid)->update($val);
    }

    public function attendant_update($r)
    {
        $user_in_case = [];
        $tb_case = Mongo::table('tb_case')->where('_id', $r->cid)->first();
        if (isset($tb_case->user_in_case)) {
            $user_in_case = $tb_case->user_in_case;
        }
        $user_in_case[] = (int) $r->data_id;
        $user_in_case = array_unique($user_in_case);
        Mongo::table('tb_case')->where('_id', $r->cid)->update(['user_in_case' => $user_in_case]);
        return response()->json($user_in_case);
    }

    public function update_tb_case($r)
    {


        $tb_case = Mongo::table("tb_case")->where("id", $r->cid)->first();
        $current_user_in_case = isset($tb_case->user_in_case) ? $tb_case->user_in_case : [];
        $new_user_in_case = [];
        foreach ($r->user_id as $user_id) {
            $new_user_in_case[] = $user_id;
        }
        $new_user_in_case = array_unique(array_merge($current_user_in_case, $new_user_in_case));


        Mongo::table("tb_case")->where("id", $r->cid)->update(["user_in_case" => $new_user_in_case]);
        return response()->json($new_user_in_case);
    }


    public function delete_user_in_case($r)
    {
        $current_tb_case = Mongo::table("tb_case")->where("id", $r->cid)->first();
        if (!$current_tb_case) {
            return response()->json(['error' => 'Case not found'], 404);
        }

        $selected_uid = (int) $r->id;

        $current_user_in_case = isset($current_tb_case->user_in_case) ? $current_tb_case->user_in_case : [];
        $new_user_in_case = [];
        foreach ($current_user_in_case as $user_id) {
            if ((int) $user_id != $selected_uid) {
                $new_user_in_case[] = $user_id;
            }
        }
        Mongo::table("tb_case")->where("id", $r->cid)->update(["user_in_case" => $new_user_in_case]);
        return response()->json($new_user_in_case);
    }


    public function back2home($r)
    {

        $feature    = getCONFIG("feature");
        $is_photocaseuniq = false;
        $w[0] = array('_id', $r->cid);
        if (@$feature->photocaseuniq) {
            $is_photocaseuniq = true;
            $w[0] = array('caseuniq', $r->caseuniq);
        }
        $is_photocaseuniq ? autocrop($r->caseuniq, $r->hn) : autocrop($r->cid, $r->hn);
        $case = $is_photocaseuniq ? (object) Mongo::table('tb_case')->where('caseuniq', $r->caseuniq)->first() : Datacase::first($r->cid);
        createTEMP('tb_case', $case->caseuniq, $case->comcreate, date("ymdHis"));
        NURSEMONITORreporting($case->caseuniq);
        SYSTEMQueue('operation', $case);
        Mongo::table("tb_case")->where($w)->update(['statusjob' => "operation"]);
        fastsemi($r->cid);
    }


    public function scopetracking($r)
    {
        $admin  = getCONFIG("admin");
        $room   = $admin->station_room;
        $sid    = intval($r->val);
        $scope  = SERVER::table("tb_scope")->where("scope_id", $sid)->first();
        $uid    = isset($r->uid) ? $r->uid : uid();
        if (isset($scope)) {
            $rfid   = $scope["scope_rfid"];
            $serial = $scope["scope_serial"];
            if (isset($rfid) && isset($serial)) {
                $val['track_rfid']      = $rfid;
                $val['track_user']      = $uid;
                $val['track_username']  = "endo";
                $val['track_time']      = date("H:i:s");
                $val['track_date']      = date("Y-m-d");
                $val['track_serial']    = $serial;
                $val['track_station']   = $room;
                $val['track_status']    = "success";
                $val['track_type']      = "capture";
                SERVER::table("tb_casetrack")->insert($val);

                $w1['scope_serial']  = $serial;
                $u['scope_status'] = 'capture';
                SERVER::table('tb_scope_update')->where($w1)->update($u);
            }
        }
    }

    public function set_lumina_config($r)
    {
        $id = isset($r->_id) ?  $r->_id : '';
        $tb_lumina = Mongo::table('tb_lumina')->where('id', 1)->first();
        if (!isset($tb_lumina)) {
            $arr['id'] = 1;
            Mongo::table('tb_lumina')->insert($arr);
        }
        try {
            $this_case = Mongo::table('tb_case')->where('_id', $id)->first();
            $this_case = (object) $this_case;
            $data['patientname'] = isset($this_case->patientname) ? $this_case->patientname : '';
            $data['doctorname']  = isset($this_case->doctorname) ? $this_case->doctorname : '';
            $data['procedurename']   = isset($this_case->procedurename) ? $this_case->procedurename : '';
            $data['age'] = isset($this_case->age) ? $this_case->age : '';
            $data['hn'] = isset($this_case->hn) ? $this_case->hn : '';
            $data['appointment_date'] = isset($this_case->appointment_date) ? $this_case->appointment_date : '';
            $data['appointment'] = isset($this_case->appointment) ? $this_case->appointment : '';
            $data['cid'] = isset($id) ? $id : '';
            $data['open'] = 'capture';
            $data['event'] = 'case_data';
            $data['python'] = "true";
            $data['caseuniq'] = isset($this_case->caseuniq) ? $this_case->caseuniq : '';
            $json = json_encode($data);
            Mongo::table('tb_lumina')->where('id', 1)->update($data);
            return $json;
        } catch (Exception $e) {
            return '';
        }
    }

    public function recorder_action($r)
    {
        $tb_lumina = Mongo::table('tb_lumina')->where('id', 1)->first();
        if (!isset($tb_lumina)) {
            $u['id'] = 1;
            Mongo::table('tb_lumina')->insert($u);
        }

        if (isset($r->cid)) {
            $case = (object) Mongo::table('tb_case')->where('_id', $r->cid)->first();
            if (isset($case)) {
                if ($r->type == 'record_start') {
                    $data['case_status']  = 1;
                    $data['record_start'] = date('Y-m-d H:i:s');
                    $data['statusjob']    = 'operation';
                    Mongo::table('tb_case')->where('_id', $r->cid)->update($data);
                    try {
                        foreach (isset($r->config) ? $r->config : [] as $key => $val) {
                            $u[$key] = $val;
                            Mongo::table('tb_lumina')->where('id', 1)->update($u);
                        }
                    } catch (\Exception $e) {
                        dd($e);
                    }
                } else {
                }
            }
        }
    }

    public function set_data_config($r)
    {
        $data = $r->data;
        $tb_lumina = Mongo::table('tb_lumina')->where('id', 1)->first();
        if (!isset($tb_lumina)) {
            $u['id'] = 1;
            Mongo::table('tb_lumina')->insert($u);
        }

        foreach (isset($data) ? $data : [] as $key => $val) {
            $decode[$key] = $val;
        }
        $decode['python'] = 'true';
        Mongo::table('tb_lumina')->where('id', 1)->update($decode);
        $case = Mongo::table('tb_case')->where('caseuniq', @$decode['caseuniq'] . "")->first() ?? [];
        // dd($decode, $case);
        echo jsonEncode($case);
        // return $case;
    }

    public function set_marker_height($r)
    {
        try {
            setCONFIG('camera', 'marker_height', $r->height);
        } catch (Exception) {
        }
    }

    public function set_doctorname($r)
    {
        $tb_user = Mongo::table("users")->where("uid", intval($r->value))->first();
        $u['doctorname'] = fullName($tb_user);
        $u['case_physicians01'] = intval($r->value);
        $w[] = array('_id', $r->cid);
        Mongo::table('tb_case')->where($w)->update($u);
        echo $u['doctorname'];
    }

    public function get_patient($r)
    {
        $cid = $r->cid ?? $r->id;
        $case = Datacase::first($cid);
        if (!$case) {
            return response()->json(['error' => 'Case not found'], 404);
        }

        $patient = Patient::first($case->case_hn);
        if (!$patient) {
            return response()->json(['error' => 'Patient not found'], 404);
        }

        $birthdate = $patient->birthdate ?? null;
        $age_value = '';
        if ($birthdate) {
            $age_value = age($birthdate);
        }

        $gender_text = match ($patient->gender ?? null) {
            '1' => 'Male',
            '2' => 'Female',
            default => $patient->gender ?? '-',
        };

        return response()->json([
            'hn' => $patient->hn ?? '',
            'firstname' => $patient->firstname ?? '',
            'middlename' => $patient->middlename ?? '',
            'lastname' => $patient->lastname ?? '',
            'gender' => $gender_text,
            'gender_code' => $patient->gender ?? '',
            'birthdate' => $birthdate,
            'age' => $age_value,
        ]);
    }

    public function get_case($r)
    {
        if($r->id=="test"){
            return response()->json([
                'id' => 'test',
                'cid' => 'test',
                'caseuniq' => 'test',
                'procedurename' => 'TEST CAMERA',
                'hn' => 'test',
                'patientname' => 'test',
                'doctorname' => 'test',
                'case_hn' => 'test',
                'case_procedurecode' => 'test',
                'procedure_color' => 'test',
                'room_id' => 'test',
                'room_name' => 'test',
                'user_in_case' => [],
            ]);
        }
        $cid = $r->cid ?? $r->id;
        $case = Datacase::first($cid);

        $admin = Mongo::table('tb_config')->where("config_type","admin")->first();

        // dd($admin);
        if(isset($admin->station_room)){
            $station = $admin->station_room;
            $room = Mongo::table("tb_room")->where("room_id",intval($station))->first();
            $val['room_id']=$station;
            $val['room_name']=$room->room_name??"";
            Mongo::table("tb_case")->where("_id",$cid)->update($val);
            // dd($room);
        }

        // ดึง procedure_color จาก procedure table
        $procedure_color = '';
        if (isset($case->case_procedurecode) && $case->case_procedurecode) {
            $procedure = Mongo::table('tb_procedure')->where('code', $case->case_procedurecode)->first();
            $procedure_color = $procedure->color ?? $case->case_procedurecode;
        }

        return response()->json([
            'id' => $case->id ?? $cid,
            'cid' => $cid,
            'caseuniq' => $case->caseuniq ?? '',
            'procedurename' => $case->procedurename ?? 'TEST CAMERA',
            'procedure_code'=>$case->case_procedurecode ?? '',
            'doctorname' => $case->doctorname ?? '',
            'case_hn' => $case->case_hn ?? '',
            'hn' => $case->hn ?? $case->case_hn ?? '',
            'patientname' => $case->patientname ?? '',
            'time_patientin' => $case->time_patientin ?? '',
            'time_start' => $case->time_start ?? '',
            'time_withdrawal' => $case->time_withdrawal ?? '',
            'time_end' => $case->time_end ?? '',
            'department' => $case->department ?? '',
            'appointment' => $case->appointment ?? '',
            'scope' => $case->scope ?? [],
            'room_id' => $room->room_id ?? '',
            'room_name' => $room->room_name ?? '',
            'user_in_case' => $case->user_in_case ?? [],
            'case_physicians01' => $case->case_physicians01 ?? null,
            'case_procedurecode' => $case->case_procedurecode ?? '',
            'procedure_color' => $procedure_color,
        ]);
    }

    public function get_scopes($r)
    {
        $scopes = Department::scope(uid());
        $result = [];
        foreach ($scopes as $scope) {
            $result[] = [
                'scope_id' => $scope->scope_id ?? '',
                'scope_name' => $scope->scope_name ?? '',
                'scope_serial' => $scope->scope_serial ?? '',
            ];
        }
        return response()->json($result);
    }

    public function get_users($r)
    {
        $type = $r->type ?? 'doctor';
        $users = Department::user($type, uid());
        $result = [];
        foreach ($users as $user) {
            $result[] = [
                'uid' => $user->uid ?? '',
                'user_prefix' => $user->user_prefix ?? '',
                'user_firstname' => $user->user_firstname ?? '',
                'user_lastname' => $user->user_lastname ?? '',
                'user_code' => $user->user_code ?? '',
                'fullname' => fullName($user),
            ];
        }
        return response()->json($result);
    }

    public function get_rooms($r)
    {
        $rooms = Department::room(uid());
        $result = [];
        foreach ($rooms as $room) {
            $result[] = [
                'room_id' => $room->room_id ?? '',
                'room_name' => $room->room_name ?? '',
            ];
        }
        return response()->json($result);
    }

    public function get_images($r)
    {
        $cid = $r->cid ?? $r->id;
        $view = [];
        $view = Camera::loadimg($cid, $view);
        $imgall = $view['imgall'] ?? [];

        $result = [];
        foreach ($imgall as $img) {
            $result[] = [
                'img' => $img['img'] ?? '',
                'num' => $img['num'] ?? 0,
            ];
        }
        return response()->json($result);
    }

    public function get_storage($r)
    {
        $view = [];
        $view = Camera::drive_percent($view);

        return response()->json([
            'drive_color' => $view['drive_color'] ?? 'bg-success',
            'persen' => $view['persen'] ?? 0,
            'ds' => $view['ds'] ?? 0,
            'drive' => $view['drive'] ?? 0,
        ]);
    }

    public function get_config($r)
    {
        $config = getCONFIG("admin");
        $camera = getCONFIG("camera");
        $feature = getCONFIG("feature");
        $yuan = getCONFIG("yuan");

        $new_url = str_replace('/endoindex', '', url(''));
        $scope_serial = Camera::get_scopeserial();

        return response()->json([
            'com_name' => $config->com_name ?? '',
            'olympus_disabled' => $yuan->olympus_disabled ?? '',
            'olympus_picname' => $yuan->olympus_ocr ?? '',
            'fuji_picname' => $yuan->fuji_ocr ?? '',
            'ocr_img' => "$new_url/ScreenRecord",
            'camera' => [
                'force_select' => $camera->force_select ?? false,
                'firstimg_starttime' => $camera->firstimg_starttime ?? false,
            ],
            'scope_serial' => $scope_serial,
            'feature' => [
                'photocaseuniq' => $feature->photocaseuniq ?? false,
                'liveconsult' => $feature->liveconsult ?? false,
            ],
        ]);
    }

    public function get_procedures($r)
    {
        $procedures = Mongo::table('tb_procedure')
            ->orderBy('name', 'asc')
            ->get();
        $result = [];
        foreach ($procedures as $procedure) {
            $result[] = [
                'code' => $procedure->code ?? '',
                'name' => $procedure->name ?? '',
            ];
        }
        return response()->json($result);
    }

    public function get_case_today($r)
    {
        $cid = $r->cid ?? $r->id ?? '';
        $casetoday = Camera::casetoday($cid);
        $result = [];
        foreach ($casetoday as $case) {
            $result[] = [
                'id' => $case->id ?? '',
                'hn' => $case->hn ?? $case->case_hn ?? '',
                'patientname' => $case->patientname ?? '',
                'doctorname' => $case->doctorname ?? '',
                'procedurename' => $case->procedurename ?? '',
                'case_hn' => $case->case_hn ?? '',
            ];
        }
        return response()->json($result);
    }


    public function camera_copy_pcd($r)
    {
        // dd($r->all());
        $val['caseuniq']       = date("ymdHis");
        $val['updatetime']     = date("ymdHis");
        $val['comcreate']      = getCONFIG('admin')->com_name;
        $tb_case = (object) Mongo::table('tb_case')->where('id', $r->case_id)->first();
        autocrop($r->case_id, $tb_case->hn);
        createTEMP('tb_case', $tb_case->caseuniq, $tb_case->comcreate, date("ymdHis"));
        $case       = (object) Mongo::table('tb_case')->where('_id', $r->case_id)->first();
        $patient    = (object) Mongo::table('tb_patient')->where('hn', $case->hn)->first();
        $doctorname = explode(" ", $case->doctorname);
        $exp = explode('.', $doctorname[0]);
        $first = @$exp[1];
        $last  = @$doctorname[1];
        $wd[] = array('user_firstname', 'like', '%' . $first . '%');
        $wd[] = array('user_lastname', 'like', '%' . $last . '%');
        $doctor     = (object) Mongo::table('users')->where($wd)->first();
        $room       = (object) Mongo::table('tb_room')->where('room_id', intval($case->room))->first();
        $str['patientname']         = $patient->firstname . " " . $patient->lastname;
        $str['hn']                  = $patient->hn;
        $str['age']                 = age($patient->birthdate);
        $ex = explode(' ', $case->appointment);
        $appointment_date = $ex[0];

        // /// Insert ///
        insertMEDICATION($val);
        $arr = array();
        // dd($r->all());
        $procedurearr[] = $r->case_procedurecode;
        $arr['case_procedurecode']      = $procedurearr;
        $arr['hn']                      = $patient->hn;
        $arr['case_hn']                 = $patient->hn;
        $arr['case_physicians01']       = $doctor->uid;
        $arr['appointment']             = @$case->appointment;
        $arr['appointment_date']        = $appointment_date;
        $arr['accessionno']             = @$case->accessionno;
        $arr['room']                    = @$case->room . '';
        $arr['opd']                     = @$case->opd . '';
        $arr['ward']                    = @$case->ward . '';
        $arr['refer']                   = @$case->refer . '';
        $arr['doctor02']                = @$case->physicians02 . '';
        $arr['doctor03']                = @$case->physicians03 . '';
        $arr['nurse01']                 = @$case->nurse01 . '';
        $arr['nurse02']                 = @$case->nurse02 . '';
        $arr['nurse03']                 = @$case->nurse03 . '';
        $arr['nurse04']                 = @$case->nurse04 . '';
        $arr['anes']                    = @$case->anes . '';
        $arr['prediagnostic_other']     = @$case->prediagnostic_other . '';
        $arr['patientid']               = @$case->patient_id . '';
        $arr['useropen']                = @$case->useropencase . '';
        $arr['treatment_coverage']      = isset($case->treatment_coverage) && $case->treatment_coverage != '' ? $case->treatment_coverage : (isset($case->righttotreatment) ? $case->righttotreatment : '');
        $arr['user_in_case']            = @$case->user_in_case;
        $arr = (object) $arr;
        $cid = insertCASE($val, $arr);

        echo $cid;
    }

    public function movetestphoto()
    {
        $dir= exfolder("ScreenRecord");
        $files1 = scandir($dir);
        unset($files1[0]);
        unset($files1[1]);
        makedirfull(exfolder("store/testcamera"));
        foreach ($files1 as $file) {
            $file_name = explode("_", $file);
            if ($file_name[0] == "") {
                rename(exfolder("ScreenRecord/$file"), exfolder("store/testcamera/$file"));
            }
        }
    }

    public function update_scope($r)
    {
        $tb_case    = Mongo::table("tb_case")->where("_id", $r->cid)->first();
        $scopes     = isset($tb_case->scope) ? $tb_case->scope : [];
        $scopes[]   = (int) $r->scope;
        $case_update['scope'] = array_unique($scopes);
        Mongo::table("tb_case")->where("_id", $r->cid)->update($case_update);
    }


    public function casemonitor_operation($r)
    {
        $case = Datacase::first($r->cid);
        Datacase::dataUPDATE($r->cid, ['statusjob' => 'operation']);
        createTEMP('tb_case', $case->caseuniq, $case->comcreate, date("ymdHis"));
    }
}
