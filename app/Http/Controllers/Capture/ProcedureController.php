<?php

namespace App\Http\Controllers\Capture;

use App\Http\Controllers\Api\ProcedureController as ApiProcedureController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Datacase;
use App\Models\Department;
use App\Models\Mainpartsub;
use App\Models\casemedication;
use App\Models\Mongo;
use App\Models\Server;
use App\Models\User;
use App\Models\users;
use Exception;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\fileExists;
use MongoDB\BSON\ObjectId;

class ProcedureController extends Controller
{

    public function __construct(Request $r)
    {
        checklogin();
    }

    public function index(Request $r)
    {
        $needMigrate = false;
        if ($needMigrate) {
            Datacase::migrate();
            dd('success in migrate');
        }
        $view['days'] = $this->get_days_in_week();
        $view['hours'] = $this->get_time_in_day();
        $view['rooms'] = Mongo::table('tb_room')->get();
        $view['count_case'] = [];
        $view['count_time'] = [];
        $view['now'] = date('Y-m-d');
        $view['before'] = (clone Carbon::now())->subDays(7)->format('Y-m-d');
        if (isset($r->generate)) {
            $cond[]  = array('case_status', '!=', 90);
            if (!empty($r->room)) {
                $view['graph_room'] = $r->room;
                $cond[] = array('room_name', $r->room);
            }

            // if (!empty($r->day)) {
            //     $view['graph_day'] = $r->day;
            //     $cond[] = array('act_dayweek', $r->day);
            // }

            $range = [];
            if (!empty($r->start_date)) {
                $view['graph_start'] = $r->start_date;
                $range[] = $r->start_date . ' 00:00';
                if (!empty($r->end_date)) {
                    $view['graph_end'] = $r->end_date;
                    $range[] = $r->end_date . " 23:59";
                }
            }

            $view['count_case'] = $this->get_case_in_day($cond, $range);
            $view['count_time'] = $this->get_time_in_month($cond, $range);
        }
        return view('capture.room.index', $view);
    }

    public function get_days_in_week()
    {
        $week = [];
        $start = Carbon::now()->startOfWeek();
        $end = Carbon::now()->endOfWeek();
        for ($date = $start; $date->lte($end); $date->addDay()) {
            $week[] = $date->format('D');
        }
        return $week;
    }

    public function get_time_in_day()
    {
        $hours = [];
        $hour = Carbon::today()->startOfDay();
        for ($i = 0; $i <= 24; $i++) {
            $hours[] = $hour->format('H:00');
            $hour->addHour();
        }
        return $hours;
    }

    public function get_day_in_month($month, $year)
    {
        $days = Carbon::createFromDate($year, $month)->daysInMonth;
        return range(1, $days);
    }

    public function get_time_in_month($cond, $range)
    {
        $exp = explode('-', $range[0]);
        $year = $exp[0];
        $month = $exp[1];
        $days = $this->get_day_in_month($month, $year);

        $arr['line'] = [];
        $arr['column'] = [];

        foreach ($days as $day) {
            // $cond[3] = ['act_timestart', $time];
            $day = strlen($day) == 1  ? '0' . $day : $day;
            $cond[3] = ['act_date', strval($day)];
            $cond[4] = ['act_month', strval($month)];
            $count = Mongo::table('tb_case')
                ->where($cond)
                ->count();
            $arr['line'][] = $count;
        }


        // dd($range, $days);

    }

    public function get_case_in_day($cond, $range)
    {
        // $times = $this->get_time_in_day();
        // foreach ($times as $time) {
        //     $cond[3] = array('act_timestart', $time);
        //     $count[] = Mongo::table('tb_case')
        //     ->where('appointment', '>=', $range[0])
        //     ->where('appointment', '<=', $range[1])
        //     ->where($cond)
        //     ->count();
        // }
        // return $count;
        $times = $this->get_time_in_day();
        $daysOfWeek = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
        $results = [];

        foreach ($daysOfWeek as $day) {
            $dayCounts = []; // Reset counts for each day of the week
            foreach ($times as $time) {
                $cond[3] = ['act_timestart', $time];
                $count = Mongo::table('tb_case')
                    ->where('appointment', '>=', $range[0])
                    ->where('appointment', '<=', $range[1])
                    ->where($cond)
                    ->where('act_dayweek', $day) // Filter by day of the week
                    ->count();
                $dayCounts[] = $count;
            }
            $results[$day] = $dayCounts;
        }
        return $results;
    }



    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }
    public function findingtemp($r)
    {
        $alldata = $r->all();
        $findinggroup = $r->findinggroup;
        $arr = array();
        $tempg = "";
        foreach ($findinggroup as $group) {
            $obj = array();
            foreach ($alldata as $key => $value) {
                try {
                    $ex = explode("_", $key);
                    if ($ex[0] == $group) {
                        if (isset($ex[2])) {
                            if ($tempg != $ex[2]) {
                                $tempg = $ex[2];
                                $obj = array();
                            }
                            $i = 0;
                            foreach ($value as $vaa) {
                                $obj[$i][$ex[1]] = $vaa;
                                $arr[$group][$ex[2]][$i] = $obj[$i];
                                $i++;
                            }
                        } else {
                            $arr[$group][$ex[1]] = $value;
                        }
                    }
                } catch (\Throwable $th) {
                }
            }
        }
        $val['fidingtemp'] = $arr;

        // $val['fidingtemp_status'] = true;

        $val['overall_finding'] = fidingtemp($arr) ?? "";
        // dd($val);
        Mongo::table("tb_case")->where("_id", $r->cid)->update($val);
        return redirect("procedure/$r->cid");
    }


    public function show($id, Request $r)
    {

        $this->update_room($id);
        $view['cid']    = $id;
        $view['case']   = Datacase::fromID($id);
        $view['word']   = wording("endocapture", "defalut");
        $photohn        = Datacase::first($id);
        $wcase[0]       = array('procedure_code', $photohn->case_procedurecode);
        $wcaseuniq[0]   = array('caseuniq', $photohn->caseuniq);
        $wcaseuniq[1]   = array('comcreate', $photohn->comcreate);
        $vip = $this->vip($photohn, $id);
        if ($vip) {
            return redirect(url("vip/$id"));
        }
        $view['feature']                = getCONFIG("feature");



        if (@$view['feature']->photocaseuniq) {
            $view['havephoto']  = autocrop($photohn->caseuniq, $photohn->case_hn);
        } else {
            $view['havephoto']  = autocrop($id, $photohn->case_hn);
        }


        $view['case']                   = Datacase::fromID($id);
        // dd($view['case']);
        if (@$view['feature']->queue) {
            queuesystem($view['case']->case_hn, "Recovery");
        }

        $admin  = getCONFIG("admin");
        $case                           = $view['case'];
        $view['today']                  = Carbon::now()->format('Y-m-d');
        $view['room']                   = Department::room(uid());
        $view['tb_procedure']           = Department::procedure(uid());
        $view['nurse']                  = Department::user('nurse', uid());
        $view['register']               = Department::user('register', uid());
        $view['doctor']                 = Department::user('doctor', uid());
        $view['anes']                   = Department::user('anes', uid());
        $view['nurse_anes']             = Department::user('nurse_anes', uid());
        $view['users']                  = Department::userall(uid());
        $view['patient']                = (object) Mongo::table('tb_patient')->where('hn', $case->case_hn)->first();
        $view['caseuniq']               = $case->caseuniq;
        $view['tb_casemedication']      = CASEMEDICATION::checkdata($case, $wcaseuniq);
        $view['doseunit']               = CASEMEDICATION::get_unitdose();
        $view['histopathology']         = CASEMEDICATION::get_histopathology();
        $view['photo']                  = $case->photo;
        $view['mainpartsub']            = Mainpartsub::sort($id);
        $view['mainpart']               = Mainpartsub::get_mainpart($view['case']->case_procedurecode);
        $view['procedure']              = (object) Mongo::table("tb_procedure")->where("code", $case->case_procedurecode)->first();
        // dd($view['procedure']);
        $view['procode']                = $case->case_procedurecode;
        $view['case_json']              = isset($case->case_json) ? $case->case_json : [];
        $view['treatment']              = (object) Mongo::table('tb_casenote')->where('_id', $view['case']->noteid)->first();
        $view['noteid']                 = (string) $view['case']->noteid;
        $view['tb_treatmentcoverage']   = (object) Mongo::table('tb_treatmentcoverage')->get();
        $view['DOCUMENT_ROOT']          = $_SERVER['DOCUMENT_ROOT'];
        $view = $this->procedurepic($view);
        $this->update_field_in_case($id, 'pdfcreate', false);
        $view['photo']                  = $this->photo($case);
        $view['photoselect']            = photoSELECT($case->photo);
        $view['vdo']                    = isset($case->video) ? $case->video : [];
        $operation_date                 = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
        $view['vdo_url']                = domainname("store/$case->hn/$operation_date/vdo");
        $view['scopes']                 = Department::scope(uid());
        $view['otherprocedure']         = Datacase::otherprocedure($case);
        $result_check                   = $this->check_has_pacs($case);
        $view['have_pacs']              = $result_check['status'];
        $view['photo_pacs']             = $result_check['images'];
        $view['date_pacs']              = $result_check['datefolder'];
        $view['tapactive']              = "physicianrecord";

        $view['department_user']             = uget('department');
        $view['count_photo']                 = count($view['photo']);
        makedirfull(htdocs("store/$case->hn/$case->appointment_date/backup"));
        makedirfull(htdocs("store/$case->hn/$case->appointment_date/pdf"));
        makedirfull(htdocs("store/$case->hn/$case->appointment_date/vdo"));
        // $this->checkphotolocal($case);
        // dd("cccccccccccccccccc");


        $arr['dayweek']     = Datacase::getweekday("2024-02-20");
        $arr['day']         = Datacase::getdate("2024-02-20 08:00:00");
        $arr['month']       = Datacase::getmonth("2024-02-20 08:00:00");
        $arr['year']        = Datacase::getyear("2024-02-20 08:00:00");
        $view['project_name'] = "capture";
        // $arr['timeuse']     = Datacase::timeuse($case);
        // $arr['timeroomuse'] = Datacase::timeroomuse($case);
        // dd($arr);

        return view('capture.case.procedure_select', $view);
    }


    public function checkphotolocal($case)
    {
        $server = getCONFIG("server");
        $admin  = getCONFIG("admin");
        foreach ($case->photo as $data) {
            $filename   = $data['na'];
            $path       = storePATH("$case->case_hn\\$case->appointment_date\\$filename");
            if (!file_exists($path)) {
                if (!Server::check_connection() && $admin->com_type == "client") {
                    $file_end   = storePATH("$case->case_hn\\$case->appointment_date\\$filename");
                    $file_start = "$server->urlbase/store/$case->case_hn/$case->appointment_date/$filename";
                    try {
                        copy($file_start, $file_end);
                    } catch (\Throwable $e) {}

                    $file_end   = storePATH("$case->case_hn\\$case->appointment_date\\backup\\$filename");
                    $file_start = "$server->urlbase/store/$case->case_hn/$case->appointment_date/backup/$filename";
                    try {
                        copy($file_start, $file_end);
                    } catch (\Throwable $e) {
                    }
                }
            }
        }
    }




    public function procedure_change($r)
    {
        $tb_case                        = Mongo::table('tb_case')->where('_id', $r->cid)->first();
        $apppoint                       = explode(" ", $tb_case->appointment);
        $folderdate                     = $apppoint[0];
        $hn                             = $tb_case->hn;
        $caseuniq                       = $tb_case->caseuniq;
        $comcreate                      = $tb_case->comcreate;
        $uniqpic                        = htdocs("store/$hn/$folderdate/$caseuniq.jpg");
        if (file_exists($uniqpic)) {
            if (fileExists($uniqpic)) {
                unlink($uniqpic);
            }
        }
        $tb_procedure                   = Mongo::table('tb_procedure')->where('code', $r->case_procedurecode)->first();
        $str['case_procedurecode']      = $tb_procedure->code;
        $str['updatetime']              = date("ymdHis");
        $str['patientname']             = $tb_case->patientname;
        $str['hn']                      = $tb_case->hn;
        $str['age']                     = $tb_case->age;
        $str['doctorname']              = $tb_case->doctorname;
        $str['procedurename']           = $tb_procedure->name;
        $str['opd']                     = @$tb_case->opd . "";
        $str['ward']                    = @$tb_case->ward . "";
        $str['refer']                   = @$tb_case->refer . "";
        $str['room']                    = @$tb_case->room . "";
        $str['physicians02']            = @$tb_case->physicians02 . "";
        $str['physicians03']            = @$tb_case->physicians03 . "";
        $str['physicians04']            = @$tb_case->physicians04 . "";
        $str['nurse01']                 = @$tb_case->nurse01 . "";
        $str['nurse02']                 = @$tb_case->nurse02 . "";
        $str['nurse03']                 = @$tb_case->nurse03 . "";
        $str['nurse04']                 = @$tb_case->nurse04 . "";
        $str['anes']                    = @$tb_case->anes . "";
        $str['prediagnostic_other']     = @$tb_case->prediagnostic_other . "";
        $str['patient_id']              = @$tb_case->patient_id . "";
        $str['useropencase']            = @$tb_case->useropencase . "";
        $str['prediagnostic_other']     = @$tb_case->prediagnostic_other . "";
        $str['righttotreatment']        = isset($tb_case->righttotreatment) ? $tb_case->righttotreatment : @$tb_case->treatment_coverage;
        $str['anesthesia']              = [];
        $str['diagnostic_text']         = [];
        $str['diagnostic']              = [];
        $str['procedure_sub']           = [];
        $str['procedure_subtext']       = [];
        $str['icdninegroup19']          = [];
        $str['mainpart']                = [];
        $str['anesthesiaother']         = "";
        $str['overall_finding']         = "";
        $str['case_history']            = "";
        $str['gastriccontent_other']    = "";
        $str['complication_other']      = "";
        $str['rapid_other']             = "";
        $str['blood_loss']              = "";
        $str['blood_transfusion']       = "";
        $str['histopathology_volumn']   = "";
        $str['followup_date']           = "";
        $str['case_comment']            = "";

        if ($r->case_procedure == 1) {
            if (getCONFIG('admin')->topical) {
                $arr = array("Topical");
                $str['anesthesia'] = jsonEncode($arr);
            }
        }

        // $val['case_json'] = jsonEncode($str);
        Mongo::table('tb_case')->where('_id', $r->cid)->update($str);
        createTEMP('tb_case', $caseuniq, $comcreate, $str['updatetime']);

        // old medication
        $obj_id = new ObjectId($r->cid);
        $medication = (object)Mongo::table('tb_casemedication')->where('caseuniq', $obj_id)->first();

        $medi['medi_casejson']  = '[]';
        $medi['medi_other']     = '';
        $medi['medi_otherdose'] = '';
        $medi['medi_otherunit'] = 0;
        $mediwhere[0] = array('caseuniq', $caseuniq);
        $mediwhere[1] = array('comcreate', $comcreate);

        foreach ($medication as $key => $m) {
            $skip = ['_id', 'caseuniq', 'comcreate', 'updatetime', ""];
            if (in_array($key, $skip)) {
                continue;
            }

            $medi[$key] = $m;
        }

        Mongo::table('tb_casemedication')->where($mediwhere)->update($medi);
        createTEMP('tb_casemedication', $caseuniq, $comcreate, $str['updatetime']);

        $js['case_form']        = $caseuniq;
        $js['case_time_do']     = Carbon::now()->format('Y-m-d H:i:s');
        $data['edit_remark']    = @$r->edit_remark . '';
        $data['edit_status']    = 1;
        $data['edit_json']      = jsonEncode($js);
        $data['edit_event']     = 'procedure change';
        $data['edit_userid']    = @$r->uid;
        Mongo::table('tb_logedit')->insert($data);

        $log['case_from']        = $caseuniq;
        $log['case_hn']          = $tb_case->hn;
        $log['procedure_from']   = $tb_case->procedurename;
        $log['procedure_to']     = $tb_procedure->name;
        logdata('tb_logcase', uid(), 'change procedure', $log);
        return redirect("procedure/$r->cid");
    }

    public function add_doctor($r)
    {

        $admin      = getCONFIG("admin");
        $comname    = $admin->com_name;

        $w[] = array('user_firstname', $r->user_firstname);
        $w[] = array('user_lastname', $r->user_lastname);

        $tb_users = server::table("users")->where($w)->first();
        if ($tb_users == Null) {
            $val['uid']              = get_last_id('uid', 'users') + 1;
            $val['user_code']       = $r->user_code;
            $val['color']           = '';
            $val['phone']           = '';
            $val['opencase']        = 1;
            $val['procedure_json']  = '';
            $val['user_type']       = "doctor";
            $val['name']            = "Doctor";

            $val['department']      = uget('department');
            $val['user_status']     = 'active';
            $val['comname']         = $comname;
            $val['user_prefix']     = $r->user_prefix;
            $val['user_firstname']  = $r->user_firstname;
            $val['user_lastname']   = $r->user_lastname;
            $val['created_at']        = Carbon::now()->toDateTimeString();


            // dd($val);
            $local_cid = Server::table('users')->insert($val);
            // $cid = server::table('users')->insertGetId($val);

            $local_case = Server::table("users")->where('uid', get_last_id('uid', 'users'))->first();
            // $case = server::table("users")->where('_id', $cid)->first();
            $department_name = uget('department');
            // dd($department_name);
            $local_id = $local_case->uid ?? '';
            $tb_department = Server::table('tb_department')->where('department_name', $department_name)->first();
            $department_user = $tb_department->department_user ?? [];
            $department_user[] = intval($local_id);

            $u['department_user'] = $department_user;
            // dd($u);
            // dd(Mongo::table('tb_department')->where('department_name', $department_name)->first());
            Server::table('tb_department')->where('department_name', $department_name)->update($u);

            // $id = $case['id'] ?? '';
            $val2['email'] = "doctor$local_id";
            $val2['password'] = Hash::make("123456");
            $val2['opencase'] = 1;
            // server::table("users")->where("uid" , $id)->update($val2);

            Server::table("users")->where("uid", $local_id)->update($val2);
            semi_createtemp_masterdata("users");
            semi_createtemp_masterdata("tb_department");
            // $procedure_api = new ApiProcedureController;

            // $procedure_api->compartrecord("users", $comname, "uid");
            // $procedure_api->compartrecord("tb_department", $comname, "department_id");

            // dd($r->id);


                      return redirect(url('procedure') . '/' . $r->id);


                // return redirect("capture/procedure/$r->id");
        }
    }

    public function selectallphoto($r)
    {
        $case_id = $r->id;
        $data    = Mongo::table('tb_case')->where('_id', $case_id)->first();
        $data    = isset($data) && $data != [] ? (object) $data : [];
        if (isset($data->photo)) {
            $photos = $data->photo != '' ? $data->photo : [];
            $i      = 1;
            foreach ($photos as $index => $p) {
                $p['ns']        = $i;
                $photos[$index] = $p;
                $i++;
            }
            $u['photo']  = $photos;
            Mongo::table('tb_case')->where('_id', $case_id)->update($u);
        }
        return redirect("procedure/$case_id");
    }

    public function unselectallphoto($r)
    {
        $case_id = $r->id;
        $data    = Mongo::table('tb_case')->where('_id', $case_id)->first();
        $data    = isset($data) && $data != [] ? (object) $data : [];
        if (isset($data->photo)) {
            $photos = $data->photo != '' ? $data->photo : [];
            foreach ($photos as $index => $p) {
                $p['ns']        = 0;
                $photos[$index] = $p;
            }
            $u['photo']  = $photos;
            Mongo::table('tb_case')->where('_id', $case_id)->update($u);
        }
        return redirect("procedure/$case_id");
    }

    public function rollbackallphoto($r)
    {
        $case_id    = $r->id;
        $data       = Mongo::table('tb_case')->where('_id', $case_id)->first();
        $data       = isset($data) && $data != [] ? (object) $data : [];
        $folderdate = isset($data->appointment) ? explode(' ', $data->appointment)[0] : '';
        $hn         = isset($data->hn)          ? $data->hn : $data->case_hn;

        if (isset($data->photo)) {
            $photos = $data->photo != '' ? $data->photo : [];
            foreach ($photos as $p) {
                $photoname  = $p['na'];
                try {
                    copy(htdocs(("store/$hn/$folderdate/backup/$photoname")), htdocs("store/$hn/$folderdate/$photoname"));
                } catch (Exception $e) {
                }
            }
        }

        return redirect(url("procedure/$case_id"));
    }

    public function cropallphoto($r)
    {
        $case_id    = $r->id;
        $data       = Mongo::table('tb_case')->where('_id', $case_id)->first();
        $data       = isset($data) && $data != [] ? (object) $data : [];
        $folderdate = isset($data->appointment) ? explode(' ', $data->appointment)[0] : '';
        $hn         = isset($data->hn)          ? $data->hn : $data->case_hn;

        if (isset($data->photo)) {
            $photos = $data->photo != '' ? $data->photo : [];
            foreach ($photos as $p) {
                $photoname = $p['na'];
                $path = htdocs("store/$hn/$folderdate/backup/$photoname");
                $this->cropphoto($hn, $folderdate, $path, $photoname);
            }
        }
        return redirect(url("procedure/$case_id"));
    }

    public function loadallphoto($r)
    {
        $case_id = $r->id;
        $case    = (object) Mongo::table('tb_case')->where('_id', $case_id)->first();
        $hn      = isset($case->case_hn) ? $case->case_hn : null;
        if (isset($hn)) {
            $dir         = exfolder("store");
            $appointment = isset($case->appointment_date) ? $case->appointment_date : '';
            if ($appointment == '') {
                $appointment = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
            }
            $dir         = "$dir/$hn/$appointment";
            $skip        = ['.', '..', 'backup'];

            $photo_new   = [];
            $x           = 0;
            $files       = scandir($dir);
            foreach ($files as $file) {
                if (!in_array($file, $skip) && str_contains($file, '_')) {
                    if (explode('_', $file)[0] == $case_id) {
                        $photo_new[$x]["nu"] = $x + 1;
                        $photo_new[$x]['ns'] = 0;
                        $photo_new[$x]["na"] = $file;
                        $photo_new[$x]["sc"] = "";
                        $photo_new[$x]['st'] = 0;
                        $photo_new[$x]['tx'] = "";
                        $x++;
                    }
                }
            }
            $u['photo'] = $photo_new;
            Mongo::table('tb_case')->where('_id', $case_id)->update($u);
        }
        return redirect(url("procedure/$case_id"));
    }

    public function cropphoto($hn, $folderdate, $name, $photoname)
    {
        try {
            $myImage                = imagecreatefromjpeg($name);
            list($width, $height)   = getimagesize($name);
            $scale                  = 0.5;
            $myImageZoom            = imagecreatetruecolor($width * $scale, $height * $scale);
            $c = cropblack($name);
            $left                   = $c[2]; //ลดภาพด้านซ้าย
            $top                    = $c[0]; //ลดภาพด้านบน
            $rigth                  = $c[3]; //ลดภาพด้านขวา
            $bottom                 = $c[1]; //ลดภาพด้านล่าง
            $width                  = $rigth - $left;
            $height                 = $bottom - $top;
            $myImageCrop            = imagecreatetruecolor($width, $height);
            imagecopyresampled($myImageCrop, $myImage, 0, 0, $c[2], $c[0], $c[3], $c[1], $c[3], $c[1]);
            imagejpeg($myImageCrop, htdocs("store/$hn/$folderdate/$photoname"));
        } catch (\Throwable $e) {
        }
    }


    public function formsubmit($r)
    {
        $arr = array();
        $i = 0;
        foreach ($r->request as $key => $value) {
            $ex = explode("_", $key);
            if ($ex[0] == "formsubmit") {
                unset($ex[0]);
                $arr[$i]['name']    = implode("_", $ex);
                $arr[$i]['value']   = $value;
                $i++;
            }
        }

        return $arr;
    }

    public function mainpart($r)
    {
        $arr    = array();
        $i      = 0;
        if (isset($r->mainpart_name)) {
            foreach ($r->mainpart_name as $data) {
                $arr[$data] = $r->mainpart_value[$i];
                $i++;
            }
        }
        return $arr;
    }



    public function caserecord($r)
    {


        makedir(htdocs("store/$r->hn/$r->folderdate/pdf"));
        makedir(htdocs("store/$r->hn/$r->folderdate/temp"));

        $val = Mongo::table('tb_case')->where('id', $r->cid)->first();

        $users = Mongo::table('users')->where('uid', intval($r->case_physicians01))->first();



        $val->statusreport    = true;
        if ($val->statusjob != "Discharged") {
            $val->statusjob      = "recovery";
        }

        $val->pdf_language    = 'th';
        $val->doctor_eng      = @$users->name_eng;
        $val->urgent          = @$r->urgent;
        $val->mainpart        = $this->mainpart($r);
        $val->doctorname      = $this->doctorname($r);
        $val->case_physicians01 = intval($r->case_physicians01);

        $val->case_consultname = User::fullname($r->case_consultant);
        $formsubmit             = $this->formsubmit($r);



        foreach ($formsubmit as $data) {
            $formname   = $data['name'];
            $formvalue  = $data['value'];
            $val->$formname = $formvalue;
        }



        $val = (array) $val;
        ksort($val);

        // dd($r->case_physicians01);
        // dd($r->cid);

        unset($val['id']);
        Mongo::table('tb_case')->where('id', $r->cid)->update($val);
        $case       = Mongo::table('tb_case')->where('id', $r->cid)->first();
        $caseuniq   = $case->caseuniq;
        $comcreate  = $case->comcreate;

        createTEMP('tb_case', $caseuniq, $comcreate, date("ymdHis"));
        createTEMP('tb_casemedication', $caseuniq, $comcreate, date("ymdHis"));
        createTEMP('tb_report', $caseuniq, $comcreate, date("ymdHis"));
        createTEMPVDO('tb_casevdo', $caseuniq, $comcreate, date("ymdHis"));
        NURSEMONITORsuccess($caseuniq);


        $this->tb_data($r->cid);


        /* Start send to Cloud แต่ไม่มีระบบตรวจสอบว่าส่งสำเร็จหรือไม่
        ***********************************************************************
        **                                                                   **
        //cloudreceive
        $url                    = "http://medicaendo.com/api/cloudreceive";
        $post['noteid']         = $id;
        $post['event']          = "caseoncloud_receive";
        $post['hospital_code']  = "10672";
        // $post['json']        = jsonEncode(array_merge($tb_casenote,$tb_booking));
        connectwebPOST($url,$post);
        **                                                                   **
        ***********************************************************************
        /* End send to Cloud */
        $case = (array) $case;
        unset($case['id']);
        Mongo::table("tb_cloudtemp")->insert($case);
        Mongo::table("tb_cloudtempphoto")->insert($case);
        return redirect("report/$r->cid");


    }

    public function tb_data($cid)
    {
        $arr = array();
        $tb_case = Mongo::table("tb_case")->where("id", $cid)->first();
        foreach ($tb_case as $key => $val) {
            if ($key != "_id") {
                if (gettype($val) == "string") {
                    $arr[$key] = pdpaEncode($val);
                } else {
                    // $arr[$key] = pdpaEncode(jsonEncode($val));
                }
            }
        }
        Mongo::table("tb_data")->insert($arr);
    }


    public function doctorname($r)
    {
        $user = User::fullname($r->case_physicians01);
        return $user;
    }



    public function update_video_in_case($cid)
    {
        $videos         = $this->get_vdo($cid, true);
        $temp           = Mongo::table("tb_case")->where("_id", $cid)->first();
        $videosincase   = isset($temp['video']) ? $temp['video'] : [];
        $new            = array_unique(array_merge($videos, $videosincase));
        $this->update_field_in_case($cid, 'video', $new);
    }

    public function update_field_in_case($_id, $col, $value)
    {
        $u[$col] = $value;
        Mongo::table('tb_case')->where('_id', $_id)->update($u);
    }

    public function check_has_pacs($case)
    {
        $hn = isset($case->case_hn) ? $case->case_hn : '';
        $appointment = isset($case->appointment) ?  $case->appointment : '';
        $date = '';
        if (str_contains($appointment, ' ')) {
            $date = explode(' ', $case->appointment)[0];
            $date = str_replace('-', '', $date);
        }

        $status = false;
        $drive = 'D:';
        $drive = 'S:';
        $path  = "$drive\\jpg\\$date\\$hn\\";
        $img = [];
        try {
            $dir = scandir($path);
            foreach (isset($dir) ? $dir : [] as $i => $file) {
                if (@$file != '' && @$file != '.' && @$file != '..') {
                    $status = true;
                    $img[] = $file;
                }
            }
        } catch (Exception $e) {
        }

        $arr['status'] = $status;
        $arr['images'] = $img;
        $arr['datefolder'] = $date;
        return $arr;
    }

    public function get_pacs_photo($r)
    {
        $_id = isset($r->_id) ? $r->_id : null;
        if (isset($_id)) {
            $case = Mongo::table('tb_case')->where('_id', $_id)->first();
            if (isset($case)) {
                $case = (object) $case;
                $hn = isset($case->case_hn) ? $case->case_hn : '';
                $appointment = isset($case->appointment) ?  $case->appointment : '';
                $date = '';
                if (str_contains($appointment, ' ')) {
                    $date = explode(' ', $case->appointment)[0];
                    $date = str_replace('-', '', $date);
                }

                $drive = 'D:';
                $drive = 'S:';
                $path  = "$drive\\jpg\\$date\\$hn\\";
                $y = [];
                try {
                    $files = json_decode($r->pacs_photo, true);
                    foreach (isset($files) ? $files : [] as $i => $file) {
                        if (@$file != '' && @$file != '.' && @$file != '..') {
                            $millisec   = strval(gettimeofday()['usec']);
                            $sec        = str_pad(date("s"), 2, '0', STR_PAD_LEFT);
                            $mili1      = isset($millisec[1]) ? $millisec[1] : 0;
                            $mili       = $millisec[0] . $mili1;
                            $rand       = rand(1000000, 9999999);
                            $name       = $case->id . "_0_$hn" . "_" . date("dmyhis") . $sec . $mili . "_$rand" . "_1.jpg";
                            $destinationPath    = htdocs('ScreenRecord');
                            $to_path = "$destinationPath\\$name";
                            $from_path = "$path/$file";
                            $status = $this->move_file($from_path, $to_path);
                            $y[] = $status;
                        }
                    }
                } catch (Exception $e) {
                }
            }
        }

        return redirect(url('procedure') . "/$_id");
    }

    public function move_file($path, $to)
    {
        if (copy($path, $to)) {
            //    unlink($path);
            return true;
        } else {
            return false;
        }
    }



    public function merge_video_data($case)
    {
        $new_video  = [];
        $video      = isset($case->video) ? $case->video : [];
        $case_video = isset($case->case_video) ? $case->case_video : [];

        foreach ($video as $vdo) {
            if (isset($vdo)) {
                $new_video[] = $vdo;
            }
        }

        foreach ($case_video as $vdo) {
            if (isset($vdo)) {
                $new_video[] = $vdo;
            }
        }

        $u['video'] = $new_video;
        Mongo::table('tb_case')->where('_id', $case->id)->update($u);

        return $$new_video;
    }

    public function photo($case)
    {
        $x = 0;
        $photo = array();
        foreach ($case->photo as $p) {
            if (isset($p['st'])) {
                if ($p['st'] == 0 || $p['st'] == 1) {
                    $photo[$x]['nu'] = $p['nu'];
                    $photo[$x]['ns'] = $p['ns'];
                    $photo[$x]['na'] = $p['na'];
                    $photo[$x]['sc'] = $p['sc'];
                    $photo[$x]['st'] = $p['st'];
                    $photo[$x]['tx'] = $p['tx'];
                    $x++;
                }
            }
        }
        return $photo;
    }

    public function update_room($case_id)
    {
        $w[] = array('_id', $case_id);
        $case = (object) Mongo::table('tb_case')->where($w)->first();
        if (!isset($case->room) || @$case->room . "" == "") {
            $u['room'] = configTYPE("admin", "station_room");
            Mongo::table('tb_case')->where($w)->update($u);
        }
    }

    public function procedurepic($view)
    {

        $case                       = $view['case'];
        $procedure                  = (object) $view['procedure'];
        $procedure_picori           = urlconfig("procedure/$procedure->img");

        // dd($procedure_picori);
        // if (file_exists($procedure_picori)) {
        //     // dd(1);
        // } else {
        //     $procedure_picori = url("public/image/blank.jpg");
        // }
        // $procedure_picori           = urlconfig("procedure/$procedure->img");
        // dd($procedure_picori);
        $appointment                = explode(" ", $case->appointment);
        $folderdate                 = $appointment[0];
        $view['folderdate']         = $folderdate;
        $folder_hnpath              = htdocs("store/$case->case_hn/$folderdate/");
        $view['procedure_piccopy']  = $folder_hnpath . $case->caseuniq . ".jpg";
        makedir($folder_hnpath);
        try {
            if (!file_exists($view['procedure_piccopy'])) {
                copy($procedure_picori, $view['procedure_piccopy']);
            }
        } catch (\Throwable $e) {
            if (!file_exists($view['procedure_piccopy'])) {
                copy(url("public/image/blank.jpg"), $view['procedure_piccopy']);
            }
        }


        return $view;
    }

    public function vip($case, $id)
    {
        $vip = false;
        if ($case->case_hn == "vip") {
            $casejson = $case->case_json;
            if (!isset($casejson->procedurename)) {
                $vip = true;
            }
        }
        return $vip;
    }


    public static function get_vdo($id, $only_name = false)
    {
        $tb_casevdo   = Mongo::table('tb_casevdo')->get();
        $vdos         = array();
        foreach ($tb_casevdo as $vdo) {
            $vdo   = (object) $vdo;
            // dd($vdo);
            $vdo_cid   = (array) $vdo->vdo_cid;
            if (isset($vdo_cid['oid'])) {
                if ($id == $vdo_cid['oid']) {
                    if ($only_name && isset($vdo->vdo_name)) {
                        $vdos[] = $vdo->vdo_name;
                    } else {
                        $vdos[] = $vdo;
                    }
                }
            }
        }
        return $vdos;
    }

    public static function get_vdo_server($id, $only_name = false)
    {
        $tb_casevdo   = Server::table('tb_casevdo')->get();
        $vdos         = array();
        foreach (isset($tb_casevdo) ? $tb_casevdo : [] as $vdo) {
            $vdo   = (object) $vdo;
            $vdo_cid   = (array) $vdo->vdo_cid;
            if (isset($vdo_cid['oid'])) {
                if ($id == $vdo_cid['oid']) {
                    if ($only_name && isset($vdo->vdo_name)) {
                        $vdos[] = $vdo->vdo_name;
                    } else {
                        $vdos[] = $vdo;
                    }
                }
            }
        }
        return $vdos;
    }
}
