<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Datacase;
use App\Models\Casebooking;
use App\Models\Department;
use App\Models\Mongo;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
use App\Models\Config;
use PDO;


class HomeController extends Controller
{
    public function __construct(Request $r)
    {
        checklogin();
    }
    public function index(Request $r)
    {
        $view['doctor']             = Department::user('doctor', uid());
        $view['procedure']          = Department::procedure(uid());
        $view['tb_case'] = Mongo::table('tb_case')->get();
        // $view['tb_case'] = $this->test($r);
        return view('capture.home.index', $view);
    }



    public function show(Request $r, $id)
    {
        $view['doctor']             = Department::user('doctor', uid());
        $view['procedure']          = Department::procedure(uid());
        $view['room']               = Department::room(uid());
        $str                        = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        $view['config']             = jsonDecode($str);
        $view['date']               = date('Y-m-d');
        $view['set_page']           = jsonDecode($str);
        $view['book']               = Casebooking::booktoday();
        $view['i']                  = 0;
        $view['url']                = url('');
        $view['count_casetoday']    = Datacase::counttoday();
        $view['alltoday_case']      = $this->statusholding($r, 'all');
        $view['case_worklist']      = $this->worklist_today();
        $view['configadmin']        = getCONFIG('admin');
        $view['feature']            = getCONFIG("feature");
        $view['pacs']               = getCONFIG("pacs");
        return view('capture.home.index', $view);
    }



    public function havedata($json, $date)
    {
        foreach ($json->Result as $j) {
            $this->checkHN($j);
            $this->insertHIS_CONNECT($j, $date);
        }
    }

    public function checkHN($j)
    {
        $val['hn']          = $j->HN;
        $exname             = explode(" ", $j->PTNAME);
        $val['firstname']   = current($exname);
        $val['lastname']    = end($exname);
        $year               = date('Y') - $j->AGE;
        $val['birthdate']   = $year . "-01-01";
        if ($j->MALE == "ชาย") {
            $gender = 1;
        } else {
            $gender = 2;
        }
        $val['gender']      = $gender;
        $patient = DB::table('patient')->where('hn', $j->HN)->first();
        if ($patient == null) {
            DB::table('patient')->insert($val);
        }
    }

    public function worklist_today()
    {
        $today = date("Ymd");
        $w[]   = array('date', $today);
        $w[]   = array('import_status', '!=', 'success');
        if (uget('department') == 'GYNE') {
            $w[] = array('proceduredescription', 'Colposcopy');
        }
        $tb_caseworklist = Mongo::table('tb_caseworklist')->where($w)->orderBy('time', 'desc')->limit(100)->get();
        return isset($tb_caseworklist) ? $tb_caseworklist : [];
    }





    public function store(Request $r)
    {
        if ($r->event == "s_appointment") {
            $this->s_appointment($r);
        }
        if ($r->event == "s_appointmentbox") {
            $this->s_appointmentbox($r);
        }
        if ($r->event == "barcodescan") {
            $this->barcodescan($r);
        }
        if ($r->event == "his_detail") {
            $this->his_detail($r);
        }
        if ($r->event == "book_detail") {
            $this->book_detail($r);
        }
        if ($r->event == "render_cases") {
            $this->render_cases($r);
        }
        if ($r->event == "same_hn_cases") {
            $this->same_hn_cases($r);
        }
        if ($r->event == "auto_gencase") {
            $this->auto_gencase($r);
            return redirect("home");
        }
        if ($r->event == "delete_case") {
            return $this->delete_case($r);
        }
        if ($r->event == "job_all") {
            $this->job_all($r);
        }
        if ($r->event == "edit_urease") {
            return $this->edit_urease($r);
        }
    }

    public function auto_gencase($r)
    {
        $hn           = $r->hn;
        $prefix       = $r->prefix;
        $firstname    = $r->firstname;
        $lastname     = $r->lastname;
        $gender       = $r->gender;
        $age          = $r->age;
        $physician    = $r->physician;
        $appointment_date         = $r->appointment_date;
        $calbirthdate = '2024';
        $birthdate    = date('Y');
        foreach ($r->procedure as $key => $value) {
            try {
                $birthdate =  intval($calbirthdate) - intval($age[$key]);
            } catch (\Throwable $th) {
            }
            if ($value != 'Procedure') {
                $data = (object) array();
                $data->hn                   = $hn[$key];
                $data->prefix               = $prefix[$key];
                $data->firstname            = $firstname[$key];
                $data->lastname             = $lastname[$key];
                $data->gender               = $gender[$key];
                $data->age                  = $age[$key];
                $data->birthdate            = $birthdate;
                $data->physician            = $physician[$key];
                $data->appointment_date     = $appointment_date;

                if (isset($hn[$key])) {
                    $this->createPatienttest($hn[$key], $prefix[$key], $firstname[$key], $lastname[$key], $gender[$key], $birthdate, $age[$key], $physician[$key], $appointment_date[$key]);
                    //fix physician01
                    $data->case_physicians01    = $physician[$key];
                    $data->meet_date            = $appointment_date;
                    $data->meet_hour            = "08";
                    //fix room
                    $data->room                 = "1";
                    $data->useropencase         = "1";
                    $data->case_procedurecode   = $value;
                    $val['updatetime']  = date("ymdHis");
                    $val['comcreate']   = getCONFIG('admin')->com_name;
                    $val['created_from'] = 'regis';
                    // dd($val, $data);
                    $cid                = insertCASE($val, $data);
                    $val['caseuniq']    = $cid;
                    //  Mongo::table("tb_case")->insert($value);
                    insertMEDICATION($val);
                }
            }
        }
    }


    public function createPatienttest($hn, $prefix, $firstname, $lastname, $gender, $birthdate, $age)
    {
        $patient = Mongo::table("tb_patient")->where("hn", $hn)->first();
        if ($patient == null) {
            $val['allergic']            = "";
            $val['congenital_disease']  = "";
            $val['emer_name']           = "";
            $val['emer_tel']            = "";
            $val['firstname']           = $firstname;
            $val['middlename']          = "";
            $val['lastname']            = $lastname;
            $val['phone']               = "";
            $val['an']                  = "";
            $val['citizen']             = "";
            $val['pic']                 = "";
            $val['email']               = "";
            $val['prefix']              = $prefix;
            $val['hn']                  = $hn;
            $val['gender']              = $gender;
            $val['birthdate']           = $birthdate . "-01-01";
            $val['nationality']         = "";
            $val['regis_date']          = "";
            $val['regis_time']          = "";
            $val['age']                 = $age;
            Mongo::table("tb_patient")->insert($val);
        }
    }



    public function job_all($r)
    {
        $view['all_case'] = $this->statusall($r);
        $html = view("EndoCAPTURE.home.table.02allcase", $view)->render();
        echo $html;
    }


    public function render_cases($r)
    {
        if ($r->type == "all") {
            $view['tb_case'] = $this->statusall($r);
            $html = view("EndoCAPTURE.home.table.02allcase", $view)->render();
        }
        echo $html;
    }


    public function statusholding($r, $status)
    {
        $department = [];
        $department = uget("department");
        $w[0]       = array('appointment', "like", date('Y-m-d') . "%");
        $w[5]       = array("department", $department);
        $orw[5]     = array("department", $department);
        $orw1[5]    = array("department", $department);
        $tb_case    = Mongo::table('tb_case')->where($w)->orderBy('id', 'DESC')->limit(500)->get()->unique("caseuniq");

        if ($status == 'holding') {
            $orw[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw[1] = array("statusjob", 'operation');
            $orw1[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw1[1] = array("statusjob", 'recovery');
            $tb_case = Mongo::table('tb_case')->where($w)->orWhere($orw)->orWhere($orw1)->orderBy('id', 'DESC')->limit(500)->get()->unique("caseuniq");
        } elseif ($status == 'operation') {
            $orw[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw[1] = array("statusjob", "recovery");
            $orw1[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw1[1] = array("statusjob", "holding");
            $tb_case = Mongo::table('tb_case')->where($w)->orWhere($orw)->orWhere($orw1)->orderBy('id', 'DESC')->limit(500)->get()->unique("caseuniq");
        } elseif ($status == 'recovery') {
            $orw[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw[1] = array("statusjob", 'discharged');
            $orw1[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw1[1] = array("statusjob", 'operation');
            $tb_case = Mongo::table('tb_case')->where($w)->orWhere($orw)->orWhere($orw1)->orderBy('id', 'DESC')->limit(500)->get()->unique("caseuniq");
        } else if ($status == 'all') {
            $tb_case = Mongo::table('tb_case')->where($w)->orderBy('id', 'DESC')->limit(500)->get()->unique("caseuniq");
        }

        $arr = array();
        foreach ($tb_case as $data) {
            $data = (object) $data;
            if ($status == 'holding') {
                if ($data->statusjob == 'recovery' || $data->statusjob == 'discharged') {
                    continue;
                }
            }

            if ($data->statusjob == 'delete' || $data->statusjob == 'cancel') {
                continue;
            }

            $w1[0]        = array('caseuniq', $data->caseuniq);
            $case_monitor = (object) Mongo::table('tb_casemonitor')->where($w1)->first();

            $case_hn      = isset($data->case_hn)       ? $data->case_hn     : $data->hn;
            $patient_name = isset($data->patientname)   ? $data->patientname :  @$data->firstname . ' ' . @$data->lastname;
            $doctor1      = isset($data->doctorname) && @$data->doctorname . "" !== "" ? @$data->doctorname  : @$data->physician;
            if (isset($data->physician) && @$data->physician . "" !== "") {
                $doctor1  = $data->physician;
            }
            $room         = isset($data->room)          ? $data->room        : '';
            $pdfversion   = isset($data->case_pdfversion) ? $data->case_pdfversion : 0;

            $arr[$case_hn]['id']                   = $data->id;
            $arr[$case_hn]['case_id']               = @$data->case_id . "";
            $arr[$case_hn]['hn']                    = $case_hn;
            $arr[$case_hn]['patientname']           = @$patient_name . "";
            $arr[$case_hn]['physician']             = @$doctor1 . "";
            $arr[$case_hn]['procedure'][]           = @$data->procedurename . "";
            $arr[$case_hn]['description']           = @$data->description . "";
            $arr[$case_hn]['waitinglocation']       = @$data->waitinglocation . "";
            $arr[$case_hn]['statusjob'][]           = @$data->statusjob . "";
            $arr[$case_hn]['statuspacs'][]          = @$data->statuspacs;
            $arr[$case_hn]['vna'][]                 = @$data->vna;
            $arr[$case_hn]['statusreport'][]        = @$data->statusreport . "";
            $arr[$case_hn]['prediagnosis_other']    = @$data->prediagnostic_other . "";
            $arr[$case_hn]['rapid_urease_test'][]   = isset($data->rapid_urease_test) ? @$data->rapid_urease_test . "" : '';
            $arr[$case_hn]['rapid_other'][]         = isset($data->rapid_other) ? @$data->rapid_other . "" : '';
            // dd($arr);

            $arr[$case_hn]['complication_other']    = @$data->complication_other . "";

            if ($pdfversion != 0 && is_array($pdfversion)) {
                $arr[$case_hn]['case_pdfversion'][] = @$pdfversion;
            }


            if (!isset($arr[$case_hn]['room'])) {
                $arr[$case_hn]['room'] = '';
            }

            if ($room != "") {
                $arr[$case_hn]['room'] = $room;
            } else {
                $arr[$case_hn]['room'] = $arr[$case_hn]['room'];
            }



            $arr[$case_hn]['appointment']       = @$data->appointment . "";
            $arr[$case_hn]['description']       = isset($case_monitor->monitor_description) ? $case_monitor->monitor_description : '';
        }

        return $arr;
    }

    public function statusall($r)
    {
        $query = Mongo::table('tb_case');
        $query->where("statusjob", "!=", "delete");
        $query->where("statusjob", "!=", "cancel");
        $r->search_name         ? $query->where('patientname',  'LIKE', '%' . $r->search_name . '%') : '';
        $r->search_hn           ? $query->where('case_hn',      'LIKE', '%' . $r->search_hn . '%') : '';
        $r->search_physician    ? $query->where('doctorname',   'LIKE', '%' . $r->search_physician . '%') : '';
        $r->search_procedure    ? $query->where('procedurename', 'LIKE', '%' . $r->search_procedure . '%') : '';


        if ($r->search_room != "") {
            $query = $query->where(function ($q) use ($r) {
                $q->where('room', 'LIKE', '%' . $r->search_room . '%')
                    ->orWhere('room_id', 'LIKE', '%' . $r->search_room . '%');
            });
        }

        $tb_case = $query->orderBy('id', 'DESC')->limit(100)->get();
        if ($r->search_datefrom != '' && $r->search_dateto != '') {
            $tb_case = $query->whereDate('appointment', '>=', $r->search_datefrom)
                ->whereDate('appointment', '<=', $r->search_dateto)
                ->orderBy('appointment', 'DESC')
                ->limit(500)
                ->get();
        } elseif ($r->search_datefrom != '' && $r->search_dateto == '') {
            $tb_case = $query->whereDate('appointment', '>=', $r->search_datefrom)
                ->orderBy('appointment', 'DESC')
                ->limit(500)
                ->get();
        }

        $arr        = isset($tb_case) ? $tb_case : [];
        return $arr;
    }

    public function same_hn_cases($r)
    {
        $w[] = array('hn', $r->case_hn);
        $view['status'] = strtolower($r->status_name);

        $w[] = array('statusjob', '!=', 'delete');
        $w[] = array('statusjob', '!=', 'cancel');
        if ($r->date != 'all') {
            $w[] = array('appointment', 'LIKE', '%' . date('Y-m-d') . '%');
        }

        $data      = Mongo::table('tb_case')->where($w)->orderby('appointment', 'desc')->get();
        $patient   = (object) Mongo::table('tb_patient')->where('hn', $r->case_hn)->first();
        $view['tb_case'] = $data;
        $view['patient'] = $patient;
        $view['type']    = $r->btn;
        $view['url']     = url('');


        $html = view("EndoCAPTURE.home.component.content_case", $view)->render();
        echo $html;
    }

    public function delete_case($r)
    {
        $w[] = array('id', $r->del_caseid);
        $u['statusjob'] = 'delete';
        $update = Mongo::table('tb_case')->where($w)->update($u);
        return  redirect(url('home'));
    }

    public function count_duplicate($array)
    {
        $vals = array_count_values($array);
    }

    public function edit_urease($r)
    {
        $project = fileconfig('project');
        if (isset($r->case_id)) {
            $up['rapid_other']        = @$r->urease_text . "";
            $up['rapid_urease_test']  = @$r->urease . "";
            Mongo::table('tb_case')->where('id', $r->case_id)->update($up);
        }
        return redirect(url('home'));
    }


    public function destroy($id)
    {
        $w[0] = array('id', $id);
        $case_old = Mongo::table('tb_case')->where($w)->first();
        unset($case_old->id);
        Mongo::table('tb_case')->where($w)->delete();
        $old = (array) $case_old;
        $casebackup_id = Mongo::table('tb_casebackup')->insertGetId($old);

        $w[0] = array('id', $casebackup_id);
        $case = (object) Mongo::table('tb_casebackup')->where($w)->first();
        // dd($case);
        createTEMP('tb_case', $case->caseuniq, $case->comcreate, date("ymdHis"));
        $this->delete_case_backup($id, $case->caseuniq);
        $log['case_from'] = $case->caseuniq;
        $log['case_hn']   = $case->case_hn;
        logdata('tb_logcase', uid(), 'cancel case', $log);
        return redirect('home');
    }

    public function delete_case_backup($id, $caseuniq)
    {
        $w[] = array('id', $id);
        $w1[] = array('caseuniq', $caseuniq);
        $orw1[] = array('caseuniq', new ObjectId($caseuniq));
        $tb_casetemp = Mongo::table('tb_case')->where($w)->project(['id' => 0])->first();
        $tb_casemedicationtemp = Mongo::table('tb_casemedication')->where($w1)->orWhere($orw1)->project(['id' => 0])->first();
        if (isset($tb_casetemp)) {
            Mongo::table('tb_casebackup')->insert($tb_casetemp);
            $check_insert = Mongo::table('tb_casebackup')->where($w1)->first();
            if (isset($check_insert)) {
                Mongo::table('tb_case')->where($w)->delete();
            }
        }

        if (isset($tb_casemedicationtemp)) {
            $old = (array) $tb_casemedicationtemp;
            Mongo::table('tb_casebackup_medication')->insert($old);
            $check_insert = Mongo::table('tb_casebackup_medication')->where($w1)->orWhere($orw1)->first();
            if (isset($check_insert)) {
                Mongo::table('tb_casemedication')->where($w1)->delete();
            }
        }
    }


    public function test($r)
    {
        $query = Mongo::table("tb_case");
        $query->where("appointment", "<", "2025-02-12");
        $tb_case = $query->get();
        dd($tb_case);
    }






    public function s_appointment($r)
    {
        $w[] = array('case_status', '!=', 90);
        if (checkNULL($r->sl_status)) {
            $w[] = array('case_status', $r->sl_status);
        }
        if (checkNULL($r->tx_hn)) {
            $w[] = array('case_hn', 'like', "%$r->tx_hn%");
        }
        if (checkNULL($r->sl_room)) {
            $w[] = array('case_room', $r->sl_room);
        }
        if (checkNULL($r->tx_name)) {
            $w[] = array('case_json', 'like', "%patientname%$r->tx_name%");
        }
        if (checkNULL($r->sl_procedure)) {
            $w[] = array('case_procedure', $r->sl_procedure);
        }
        if (checkNULL($r->tx_datepicker)) {
            $exdate = explode(' / ', $r->tx_datepicker);
            $end = (new Carbon($exdate[1]))->addDays(1);
            $w[] = array('case_dateappointment', '>=', $exdate[0]);
            $w[] = array('case_dateappointment', '<=', $end);
        }
        if (checkNULL($r->tx_age)) {
            $w[] = array('case_json', 'like', "%age%$r->tx_age%");
        }
        if ($r->switch_on != 'allday') {
            $w[] = array('case_dateappointment', 'like', date('Y-m-d') . '%');
        }

        if (uget("user_type") == "doctor") {
            $w[]        = array('case_physicians01', uid());
            $tb_case    = Mongo::table('tb_case')
                ->join('tb_patient', 'tb_case.case_hn', 'patient.hn')
                ->where($w)
                ->orderBy('case_id', 'desc')
                ->paginate(100);
        } else {

            if (checkNULL($r->sl_doctor)) {
                $w[] = array('case_physicians01', $r->sl_doctor);
                $tb_case    = Mongo::table('tb_case')
                    ->where($w)
                    ->orderBy('case_id', 'desc')
                    ->paginate(100);
            } else {
                $allprocedure   = Department::arr(uid(), 'department_procedure');
                $tb_case        = Mongo::table('tb_case')
                    ->whereIn('case_procedure', $allprocedure)
                    ->where($w)
                    ->orderBy('case_id', 'desc')
                    ->paginate(100);
            }
        }

        $i      = 0;
        $arr    = array();
        foreach ($tb_case as $case) {
            // $json = jsonDecode($case->case_json);
            $case_status = "Registered";
            $date = explode(' ', $case->case_dateappointment);
            if ($case->case_status == 0) {
                $case_status = " Registered ";
                $class = "label label-warning label-pill label-inline mr-2";
            }
            if ($case->case_status == 1) {
                $case_status = " Operation  ";
                $class = "label label-info label-pill label-inline mr-2";
            }
            if ($case->case_status == 2) {
                $case_status = " Finished   ";
                $class = "label label-success label-pill label-inline mr-2";
            }
            $arr[$i]['case_id']         = $case->case_id;
            $arr[$i]['case_status']     = $case_status;
            $arr[$i]['case_hn']         = $case->case_hn;
            $arr[$i]['case_patient']    = @$case->patientname . "";
            $arr[$i]['case_age']        = @$case->age . "";
            $arr[$i]['case_doctor']     = @$case->doctorname . "";
            $arr[$i]['case_procedure']  = @$case->procedurename . "";
            $arr[$i]['case_room']       = @$case->room . "";
            $arr[$i]['case_appointment'] = $date[0];
            $i++;
        }
        printJSON($arr);
    }


    public function s_appointmentbox($r)
    {

        // dd($r);
        $w[] = ['where', 'case_status', '!=', 90];
        if (checkNULL($r->sl_status)) {
            $w[] = ['where', 'case_status', "=", $r->sl_status];
        }
        if (checkNULL($r->tx_hn)) {
            $w[] = ['where', 'case_hn', 'like', "%$r->tx_hn%"];
        }
        if (checkNULL($r->sl_room)) {
            $w[] = ['where', 'case_room', "=", $r->sl_room];
        }
        if (checkNULL($r->tx_name)) {
            $w[] = ['where', 'case_json', 'like', "%patientname%$r->tx_name%"];
        }
        if (checkNULL($r->sl_procedure)) {
            $w[] = ['where', 'case_procedurecode', "=", $r->sl_procedure];
        }
        if (checkNULL($r->tx_age)) {
            $w[] = ['where', 'case_json', 'like', "%age%$r->tx_age%"];
        }
        if ($r->switch_on != 'allday') {
            $w[] = ['where', 'case_dateappointment', 'like', date('Y-m-d') . '%'];
        } else {
            $daterange = explode(" - ", $r->tx_datepicker);
            if ($daterange[0] != $daterange[1]) {
                $datestart  = $this->formatdate($daterange[0]);
                $dateend    = $this->formatdate($daterange[1]);
                $w[]        = ['whereBetween', 'case_dateappointment', $datestart, $dateend];
            }
        }



        if (uget("user_type") == "doctor") {
            $w[] = ['where', 'case_physicians01', "=", uid()];
        } else {
            if (checkNULL($r->sl_doctor)) {
                if ($r->sl_doctor != "SUR" && $r->sl_doctor != "MED") {
                    $w[] = ['where', 'case_physicians01', "=", $r->sl_doctor];
                } else {
                    $users      = DB::table('users')->where("user_branch", $r->sl_doctor)->get();
                    $userarr    = array();
                    foreach ($users as $data) {
                        $userarr[] = $data->id;
                    }
                    $w[] = ['whereIn', 'case_physicians01', $userarr];
                }
            }
        }

        $tb_case    = Mongo::table('tb_case')
            ->whereArr($w)
            ->orderBy('case_id', 'desc')
            ->paginate(100);

        $i                  = 0;
        $arr                = array();
        $arr['url']         = url('camera');
        $array['status']    = false;

        foreach ($tb_case as $case) {
            // $json           = jsonDecode($case->case_json);
            $case_status    = "Registered";
            $date           = explode(' ', $case->case_dateappointment);
            if ($case->case_status == 0) {
                $case_status = "Registered";
                $colorstatus = "warning";
                $colorreport = "secondary text-dark";
                $href = "";
            }
            if ($case->case_status == 1) {
                $case_status = "Operation";
                $colorstatus = "info";
                $colorreport = "secondary text-dark";
                $href = "";
            }
            if ($case->case_status == 2) {
                $case_status    = "Reported";
                $colorstatus    = "success";
                $colorreport    = "primary";
                $url            = url("reportendocapture/$case->case_id");
                $href           = 'href="' . $url . '"';
            }
            $arr['caseall'][$i]['colorreport']      = $colorreport;
            $arr['caseall'][$i]['colorstatus']      = $colorstatus;
            $arr['caseall'][$i]['case_status']      = $case_status;
            $arr['caseall'][$i]['href']             = $href;
            $arr['caseall'][$i]['case_id']          = $case->case_id;
            $arr['caseall'][$i]['case_hn']          = $case->case_hn;
            $arr['caseall'][$i]['case_patient']     = @$case->patientname . "";
            $arr['caseall'][$i]['case_age']         = @$case->age . "";
            $arr['caseall'][$i]['case_doctor']      = @$case->doctorname . "";
            $arr['caseall'][$i]['case_procedure']   = @$case->procedurename . "";
            $arr['caseall'][$i]['case_room']        = @$case->room . "";
            $arr['caseall'][$i]['case_appointment'] = $date[0];

            $i++;
            $array['status'] = true;
        }

        $array['caseall'] = $arr;
        printJSON($array);
    }

    public function formatdate($date)
    {
        $date   = explode('/', $date);
        $new    = $date['2'] . '-' . $date['0'] . '-' . $date['1'] . " 00:00:00";
        return $new;
    }

    public function barcodescan($r)
    {
        $arr['casetoday']           = Datacase::barcode_today($r->value);
        $arr['caseother']           = Datacase::barcode_other($r->value);
        $arr['casetodaystatus']     = (count($arr['casetoday']) == 0) ? false : true;
        $arr['caseotherdaystatus']  = (count($arr['caseother']) == 0) ? false : true;
        printJSON($arr);
    }
}
