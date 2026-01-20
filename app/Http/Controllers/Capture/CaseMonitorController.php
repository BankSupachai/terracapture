<?php

namespace App\Http\Controllers\capture;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\NurseMonitor;

use App\Models\Server;
use App\Models\Queue;

class CaseMonitorController extends Controller
{
    // public function __construct(Request $r){checklogin();}

    public function index()
    {
        return redirect(url('casemonitor/display'));
    }

    public function store(Request $r)

    {
        // dd($r->event);
        if (isset($r->event)) {
            switch ($r->event) {
                case "roomchange":
                    $this->roomchange($r);
                    break;
                case "edit_status":
                    $this->edit_status($r);
                    return redirect('casemonitor/control');

                    break;
                case "room_select":
                    $this->room_select($r);
                    break;
                case "location_select":
                    $this->location_select($r);
                    break;
                case "room_ready":
                    $this->room_ready($r);
                    break;
                case "room_register":
                    $this->room_register($r);
                    break;
                case "checkin":
                    $req = $this->checkin($r);
                    // if(isset($req)){
                    //     return redirect(url('book/registration/'.$req));
                    // }

                    break;
                case "set_officer":
                    $this->set_officer($r);
                    return redirect('casemonitor/control');
                    break;
                case "getdoctor":
                    $this->getdoctor($r);
                    break;
                case "getnurse":
                    $this->getnurse($r);
                    break;
                case "getregister":
                    $this->getregister($r);
                    break;
                case "check_in_all":
                    $this->check_in_all($r);
                    break;
                case "update_nursemonitor":
                    $this->update_nursemonitor($r);
                    break;
                case "remark":
                    $this->remark($r);
                    break;
                case "regis2book":
                    $this->regis2book($r);
                    break;
                case "discharge":
                    $this->discharge($r);
                    break;
                case "queue_new":
                    $this->queue_new($r);
                    break;
                case "cancel_hn":
                    $this->cancel_hn($r);
                    return redirect('casemonitor/control');
                    break;
                case "cancel_caseuniq":
                    $this->cancel_caseuniq($r);
                    return redirect('casemonitor/control');
                    break;
                case "doctor_select":
                    $this->doctor_select($r);
                    return redirect('casemonitor/control');
                    break;
                case "nurse_select":
                    $this->nurse_select($r);
                    return redirect('casemonitor/control');
                    break;
                case "register_select":
                    $this->register_select($r);
                    return redirect('casemonitor/control');
                    break;
                case "cancel_case":
                    $this->cancel_case($r);
                    return redirect('casemonitor/control');
                    break;
                case "discharge_send":
                    $this->discharge_send($r);
                    break;
                case "hide_case":
                    $this->hide_case($r);
                    break;
                case "hide_multicase":
                    $this->hide_multicase($r);
                    break;
                case "show_case":
                    $this->show_case($r);
                    break;
                case "show_multicase":
                    $this->show_multicase($r);
                    break;
                case "get_casemonitor_detail":
                    $this->get_casemonitor_detail($r);
                    break;
                case "casemonitor_discharge_to":
                    $this->inchargemonitor($r);
                    return redirect('casemonitor/control');

                    break;
                case "search_inchargemonitor":
                    $view = $this->inchargemonitor($r);
                    // dd($view);
                    return view('endocapture.nurse_monitor.inchargeMonitor.index', $view);
                    // return redirect('casemonitor/inchargemonitor');
                    break;
            }
        }
    }
    // public function search_inchargemonitor($r)
    // {
    // //   dd($r->all());
    // $hn = $r->search_hn;
    // $procedure = $r->search_procedure;
    // $physician = $r->doctor;


    // }
    public function set_officer($r)
    {
        $user = array();
        $user = array_merge($user, $r->doctor_select??[]);
        $user = array_merge($user, $r->nurse_select??[]);
        $user = array_merge($user, $r->nurse_assist_select??[]);
        foreach ($user as $u) {
            $arr[] = intval($u);
        }
        // dd($arr,$r);
        $val['room_user'] = $arr;
        Server::table('tb_room')->where('_id', $r->room_id)->update($val);
    }



    public function edit_status($r)
    {
        $caseuniq_dec = jsonDecode($r->caseuniq);
        // $caseuniq = isset($caseuniq[0]) ? $caseuniq[0] : '';
        $val['monitor_status'] = $r->monitor_status;
        foreach ($caseuniq_dec as $c) {
            Server::table('tb_casemonitor')->where('caseuniq', $c)->update($val);
        }
    }



    public function remark($r)
    {
        $val['monitor_remark'] = $r->value;
        Server::table('tb_casemonitor')->where('monitor_hn', $r->hn)->update($val);
    }

    public function regis2book($r)
    {
        $val['monitor_timevisit']   = 0;
        $val['monitor_status']      = "Booking";
        Server::table('tb_casemonitor')->where('monitor_hn', $r->hn)->update($val);
    }

    public function cancel_case($r)
    {
        $_id = isset($r->one_case) ? $r->cancel_id : $r->multi_case;
        $w[] = array('_id', $_id);
        if (isset($r->tb_book)) {
            $u['status']         = 'delete';
            Server::table('tb_booking')->where($w)->update($u);
        } else {
            $u['monitor_status'] = 'delete';
            Server::table('tb_casemonitor')->where($w)->update($u);
        }
    }

    public function hide_case($r)
    {
        if (isset($r->caseuniq)) {
            $caseuniq = jsonDecode($r->caseuniq);
            $caseuniq = isset($caseuniq[0]) ? $caseuniq[0] : '';
            $u['monitor_display'] = 'hide';
            Server::table('tb_casemonitor')->where('caseuniq', $caseuniq)->update($u);

            $u1['case_display'] = 'hide';
            Server::table('tb_case')->where('caseuniq', $caseuniq)->update($u1);
        }
    }

    public function hide_multicase($r)
    {
        if (isset($r->caseuniq)) {
            $caseuniq = isset($r->caseuniq) ? explode(',', $r->caseuniq) : '';
            foreach (isset($caseuniq) ? $caseuniq : [] as $data) {
                $u['monitor_display'] = 'hide';
                Server::table('tb_casemonitor')->where('caseuniq', $data)->update($u);

                $u1['case_display'] = 'hide';
                Server::table('tb_case')->where('caseuniq', $data)->update($u1);
            }
        }
    }

    public function show_case($r)
    {
        if (isset($r->caseuniq)) {
            $caseuniq = jsonDecode($r->caseuniq);
            $caseuniq = isset($caseuniq[0]) ? $caseuniq[0] : '';
            $u['monitor_display'] = 'show';
            Server::table('tb_casemonitor')->where('caseuniq', $caseuniq)->update($u);

            $u1['case_display'] = 'show';
            Server::table('tb_case')->where('caseuniq', $caseuniq)->update($u1);
        }
    }

    public function show_multicase($r)
    {
        if (isset($r->caseuniq)) {
            $caseuniq = isset($r->caseuniq) ? explode(',', $r->caseuniq) : '';
            foreach (isset($caseuniq) ? $caseuniq : [] as $data) {
                $u['monitor_display'] = 'show';
                Server::table('tb_casemonitor')->where('caseuniq', $data)->update($u);

                $u1['case_display'] = 'show';
                Server::table('tb_case')->where('caseuniq', $data)->update($u1);
            }
        }
    }

    public function get_casemonitor_detail($r)
    {
        $main = [];
        if (isset($r->caseuniq)) {
            $caseuniq = jsonDecode($r->caseuniq);
            foreach (isset($caseuniq) ? $caseuniq : [] as $data) {
                $casemonitor = Server::table('tb_casemonitor')->where('caseuniq', $data)->first();
                if (isset($casemonitor)) {
                    $main[] = $casemonitor;
                }
            }
        }
        echo json_encode($main);
    }

    public function show($id, Request $r)
    {

        if (Server::check_connection()) {
            return redirect(url('servererror'));
        }

        if (!isset($r->department)) {
            $r->department = "GI";
        }

        $this->check_tbcasemonitor($r);


        if (isMobile()) {
            // blade สำหรับ Ipad
            if ($id == "patienttv") {
                $view = $this->patienttv($r);

                return view('endocapture.nurse_monitor.patienttv.index', $view);
            }
        } else {
            // blade สำหรับ Pc

            if ($id == "patienttv") {
                $view = $this->patienttv($r);

                // dd($view);
                return view('endocapture.nurse_monitor.patienttv.index', $view);
            }
            if ($id == "display") {
                $view = $this->display($r);
                return view('endocapture.nurse_monitor.display.index', $view);
            }
            if ($id == "board") {
                $view = $this->control($r);
                return view('capture.control.index', $view);
            }
            if ($id == "control") {
                $view = $this->control($r);
                return view('capture.control.index', $view);
            }
            if ($id == "incharge") {
                $view = $this->incharge($r);
                return view('endocapture.nurse_monitor.incharge.index', $view);
            }

            if ($id == "inchargemonitor") {
                $view = $this->inchargemonitor($r) ?? [];
                return view('endocapture.nurse_monitor.inchargeMonitor.index', $view);
            }
        }
    }


    public function queue_new($r)
    {
        $tb_casemonitor = (object) Server::table("tb_casemonitor")->where("monitor_hn", $r->hn)->first();
        if (isset($tb_casemonitor->monitor_queue)) {
            $hospital = getCONFIG("hospital");
            $array['q_number']      = $tb_casemonitor->monitor_queue;
            $array['department']    = uget("department");
            $array['hn']            = $r->hn;
            $array['date']          = date("Y-m-d");
            $array['hospitalcode']  = $hospital->hospital_code;
            $array['starttime']     = date("H:i");
            $array['status'] =      "Register";
            $array['statustext'] = "รอทำหัตถการ";
            // $array['statustext'] = "ทำหัตถการ";
            // $array['statustext'] = "พักฟื้น";
            // $array['statustext'] = "เสร็จสิ้น";
            $array['md5'] = md5($array['hospitalcode'] . $array['department'] . $array['date'] . $array['hn']);
            printJSON($array);
            insertclouddata($array);
            // echo @$tb_casemonitor->monitor_queue;
        } else {
            $w[0] = array('q_type', $r->qtype_code);
            $data['q_status']       = "normal";
            $check                  = Server::table('tb_queue')->where($w)->count();
            $check++;
            $q_number               = $r->qtype_prefix . sprintf("%02d", $check);
            $data['q_statustext']   = "รอซักประวัติ";
            $data['q_department']   = "GI";
            if (isset($r->hn)) {
                $data['q_hn']           = $r->hn;
            } else {
                $data['q_hn']           = $r->value;
            }
            $data['q_id']           = get_last_id('q_id', 'tb_queue') + 1;
            $data['q_type']         = $r->qtype_code;
            $data['q_start']        = date('Y-m-d H:i:s');
            $data['q_number']       = $q_number;
            $data['q_datetime']     = date('Y-m-d H:i:s');
            $data['q_date']         = date("Y-m-d");
            $json['status']         = 0;
            $json['time']           = $data['q_start'];
            $data['q_json']         = json_encode($json);
            $data['q_skip']         = "false";
            $data['q_qrcode']       = RandomString(5);
            do {
                $refrence_id = mt_rand(10000, 99999);
            } while (
                Server::table('tb_queue')->where('q_qrcode', $refrence_id)->exists()
            );
            $data['q_qrcode'] =  $refrence_id;
            Server::table('tb_queue')->insert($data);

            $queue['monitor_queue'] = $q_number;
            Server::table("tb_casemonitor")->where("monitor_hn", $r->hn)->update($queue);

            $hospital = getCONFIG("hospital");


            $array['hn']            = $r->hn;
            $array['department']    = uget("department");
            $array['date']          = date("Y-m-d");
            $array['hospitalcode']  = $hospital->hospital_code;
            $array['md5']           = md5($array['hospitalcode'] . $array['department'] . $array['date'] . $array['hn']);
            $array['q_number']      = $q_number;
            $array['starttime']     = date("H:i");
            $array['status'] =      "Register"; //mockup status จะกลับมาเก็บทีหลัง
            $array['statustext']    = "รอทำหัตถการ";
            // $array['statustext'] = "ทำหัตถการ";
            // $array['statustext'] = "พักฟื้น";
            // $array['statustext'] = "เสร็จสิ้น";
            printJSON($array);
            // dd($array);
            insertclouddata($array);
        }
    }

    public function inchargemonitor($r)
    {

        $tb_doctor_casemonitor = Server::table("tb_casemonitor")
            ->select("monitor_doctorname")
            ->distinct()
            ->get();

        $tb_branch_casemonitor = Server::table("tb_casemonitor")
            ->select("monitor_branch")
            ->distinct()
            ->get();
            // dd($tb_branch_casemonitor);
        $arr   = array();

        $arr2   = array();
        foreach ($tb_branch_casemonitor as $data2) {
            // dd($data2);


        // if ($data2 != "")
            $statusregis = NurseMonitor::countcase_branch_status($data2, "Register");
            $statushol = NurseMonitor::countcase_branch_status($data2, "Holding");

            $arr2[$data2]['count_holding'] = $statusregis + $statushol;
            $arr2[$data2]['count_operation'] = NurseMonitor::countcase_branch_status($data2, "Operation");
            $arr2[$data2]['count_recovery'] = NurseMonitor::countcase_branch_status($data2, "Recovery");
            $arr2[$data2]['count_discharged'] = NurseMonitor::countcase_branch_status($data2, "Discharged");
            $arr2[$data2]['count_cancel'] = Server::table("tb_casemonitor")
                ->where("monitor_doctorname", $data2)
                ->where("monitor_display", "hide")
                ->count();
            $arr2[$data2]['count_totalregis'] =  $arr2[$data2]['count_discharged'] +    $arr2[$data2]['count_recovery'] + $arr2[$data2]['count_operation'] + $arr2[$data2]['count_holding'];
            $arr2[$data2]['count_holding_percentage'] = NurseMonitor::percentage_status($arr2[$data2]['count_totalregis'], $arr2[$data2]['count_holding']);
            $arr2[$data2]['count_operation_percentage'] = NurseMonitor::percentage_status($arr2[$data2]['count_totalregis'], $arr2[$data2]['count_operation']);
            $arr2[$data2]['count_recovery_percentage'] = NurseMonitor::percentage_status($arr2[$data2]['count_totalregis'], $arr2[$data2]['count_recovery']);
            $arr2[$data2]['count_discharged_percentage'] = NurseMonitor::percentage_status($arr2[$data2]['count_totalregis'], $arr2[$data2]['count_discharged']);



            $arr2[$data2]['count_booking'] = Server::table("tb_case")
            ->where("branch", $data2)
            ->where("appointment_date", date("Y-m-d"))
            ->where("created_from", "booking")->count();



            $arr2[$data2]['count_w_regis'] = Server::table("tb_case")
            ->where("branch", $data2)
            ->where("appointment_date", date("Y-m-d"))
            ->where("created_from", "regis")->count();



            $w[] = array('monitor_date', date("Ymd"));
            $w[] = array("monitor_display", "show");
            // dd($arr2);
    }



        foreach ($tb_doctor_casemonitor as $data) {
                // dd($data);
            if ($data != "")
                $statusregis = NurseMonitor::countcase_doctor_status($data, "Register");
                $statushol = NurseMonitor::countcase_doctor_status($data, "Holding");


                $arr[$data]['count_holding'] = $statusregis + $statushol;
                $arr[$data]['count_operation'] = NurseMonitor::countcase_doctor_status($data, "Operation");
                $arr[$data]['count_recovery'] = NurseMonitor::countcase_doctor_status($data, "Recovery");
                $arr[$data]['count_discharged'] = NurseMonitor::countcase_doctor_status($data, "Discharged");
                $arr[$data]['count_cancel'] = Server::table("tb_casemonitor")
                    ->where("monitor_doctorname", $data)
                    ->where("monitor_display", "hide")
                    ->count();
                $arr[$data]['count_totalregis'] =  $arr[$data]['count_discharged'] +    $arr[$data]['count_recovery'] + $arr[$data]['count_operation'] + $arr[$data]['count_holding'];
                $arr[$data]['count_holding_percentage'] = NurseMonitor::percentage_status($arr[$data]['count_totalregis'], $arr[$data]['count_holding']);
                $arr[$data]['count_operation_percentage'] = NurseMonitor::percentage_status($arr[$data]['count_totalregis'], $arr[$data]['count_operation']);
                $arr[$data]['count_recovery_percentage'] = NurseMonitor::percentage_status($arr[$data]['count_totalregis'], $arr[$data]['count_recovery']);
                $arr[$data]['count_discharged_percentage'] = NurseMonitor::percentage_status($arr[$data]['count_totalregis'], $arr[$data]['count_discharged']);

                // $explodefirstname = explode("." , $data);
                // $explodefullname = explode(" " , end($explodefirstname));


                // $med = Server::table("users")
                // ->where("user_branch" ,"med")
                // ->first();


                // $sur01             = Server::table("users")->where("user_branch" ,"sur(gen)")->get();

                // $arr[$data]['med'] = $med;
                // $med               = Server::table("users")->where("user_branch" ,"med")->get();
                // $sur               = Server::table("users")->where("user_branch" ,"sur")->get();
                // $sur01             = Server::table("users")->where("user_branch" ,"sur(gen)")->get();
                // $sur02             = Server::table("users")->where("user_branch" ,"sur(ped)")->get();




                $arr[$data]['count_booking'] = Server::table("tb_case")
                    ->where("doctorname", $data)
                    ->where("appointment_date", date("Y-m-d"))
                    ->where("created_from", "booking")->count();

                    $arr[$data]['count_w_regis'] = Server::table("tb_case")
                    ->where("doctorname", $data)
                    ->where("appointment_date", date("Y-m-d"))
                    ->where("created_from", "regis")->count();
                    // dd($arr[$data]);
                $w[] = array('monitor_date', date("Ymd"));
                $w[] = array("monitor_display", "show");

                // if ($i==2) {
                    //     # code...
                    // }


                    if ($r->event == 'casemonitor_discharge_to') {
                        // dd($r->all());
                        $hn = $r->data_hn;
                        $updateData = [
                            'monitor_status' => "Discharged",
                            'monitor_discharge_time' => date("H:i"),
                            'monitor_discharge_to' => $r->discharged_to
                        ];
                        Server::table("tb_casemonitor")
                            ->where("monitor_hn", $hn)
                            ->update($updateData);

                        $val2 = ['statusjob' => "Discharged"];
                        // dd($val2);
                        $w2[] = array('case_hn', $hn);
                        $w2[] = array('appointment_date', date("Y-m-d"));

                        Server::table("tb_case")->where($w2)->update($val2);



                        $tb_case = Server::table('tb_case')->where($w2)->get();

                        foreach ($tb_case as $data) {
                            createTEMP('tb_case', $data['_id'], $data['comcreate'], date("ymdHis"));
                        }
                    }





        }
        if (isset($r->event)) {
            // dd($r->all());
            if ($r->event == 'search_inchargemonitor') {
                if (isset($r->search_hn)) {
                    $w[] = array("monitor_hn", 'like', '%' . $r->search_hn  . '%');
                    $view['search_hn'] = $r->search_hn;
                }
                if (isset($r->seacrh_name)) {
                    $w[] = array("monitor_patientname", 'like', '%' . $r->search_name  . '%');
                    $view['search_name'] = $r->search_name;
                }
                if (isset($r->search_procedure)) {
                    $w[] = array("monitor_procedure",  $r->search_procedure);
                    $view['search_procedure'] = $r->search_procedure;
                }

                if (isset($r->search_doctor)) {
                    $w[] = array("monitor_doctorname", 'like', '%' . $r->search_doctor  . '%');
                    $view['seacrh_doctor'] = $r->search_doctor;
                }
                $view['tb_casemonitor'] = Server::table("tb_casemonitor")->where($w)->get();
                // dd($view , $w);


            }


        }
        if ($r->event != 'search_inchargemonitor') {
            $view['tb_casemonitor'] = Server::table("tb_casemonitor")
            ->where("monitor_date", date("Ymd"))
            ->where("monitor_display", "show")
            ->get();
        }


        $view['doctor'] = $tb_doctor_casemonitor;
        // $view['doctor_all']             = NurseMonitor::user($r, 'doctor');
        $view['procedure'] = Department::procedure(uid());
        $view['doctor_all'] = $arr;
        $view['branch_all'] = $arr2;

        // dd($view['branch_all']);

        return $view;
    }
    public function discharge_send($r)
    {

        $val['monitor_status'] = "Discharged";
        Server::table('tb_casemonitor')->where('monitor_hn', $r->hn)->update($val);

        $val2['statusjob'] = "Discharged";
        $w[] = array('hn', $r->hn);
        $w[] = array('appointment_date', date("Y-m-d"));
        Server::table('tb_case')->where($w)->update($val2);

        $tb_case = Server::table('tb_case')->where($w)->get();
        foreach ($tb_case as $data) {
            createTEMP('tb_case', $data['_id'], $data['comcreate'], date("ymdHis"));
        }
    }

    public function patienttv($r)
    {

        $today                      = date('ymd');
        $view['date']               = date('D');
        $view['full_date']          = date('d/m/Y');
        $view['today']              = $today;
        $view['list_regis']         = NurseMonitor::list_regis($r);
        $view['list_room_unselect'] = NurseMonitor::list_room_unselect($r);
        $view['list_remain']        = NurseMonitor::list_remain($r);
        $view['list_recovery']      = NurseMonitor::list_recovery($r);
        $view['list_success']       = NurseMonitor::list_success($r);
        $view['list_booking']       = NurseMonitor::list_booking($r);
        $view['location']           = NurseMonitor::location($r);
        $view['count_success']      = NurseMonitor::count_success($r);
        $view['count_all']          = NurseMonitor::count_all($r);
        $view['room_all']           = NurseMonitor::room_ready($r);
        $view['nurse']              = NurseMonitor::user($r, 'nurse');
        $view['doctor']             = NurseMonitor::user($r, 'doctor');
        $view['register']           = NurseMonitor::user($r, 'register');
        $view['procedure_in']       = NurseMonitor::procedure($r);
        $view['count_book']         = count($view['list_booking']);
        $view['count_regis']        = count($view['list_regis']);
        $view['count_remain']       = count($view['list_remain']);
        $view['count_operation']    = $view['count_regis'] + $view['count_remain'];
        $view['writeboard']         = file_get_contents("D:/laragon/htdocs/config/project/nurse_monitor.txt");
        return $view;
    }

    public function incharge($r)
    {
        $today                      = date('ymd');
        $view['date']               = date('D');
        $view['full_date']          = date('d/m/Y');
        $view['today']              = $today;
        $view['list_regis']         = NurseMonitor::list_regis($r);
        $view['list_room_unselect'] = NurseMonitor::list_room_unselect($r);
        $view['list_remain']        = NurseMonitor::list_remain($r);
        $view['list_recovery']      = NurseMonitor::list_recovery($r);
        $view['list_success']       = NurseMonitor::list_success($r);
        $view['list_booking']       = NurseMonitor::list_booking($r);
        $view['location']           = NurseMonitor::location($r);
        $view['count_success']      = NurseMonitor::count_success($r);
        $view['count_all']          = NurseMonitor::count_all($r);
        $view['room_all']           = NurseMonitor::room_ready($r);
        $view['nurse']              = NurseMonitor::user($r, 'nurse');
        $view['doctor']             = NurseMonitor::user($r, 'doctor');
        $view['register']           = NurseMonitor::user($r, 'register');
        $view['procedure_in']       = NurseMonitor::procedure($r);
        $view['count_book']         = count($view['list_booking']);
        $view['count_regis']        = count($view['list_regis']);
        $view['count_remain']       = count($view['list_remain']);
        $view['count_operation']    = $view['count_regis'] + $view['count_remain'];
        $view['writeboard']         = file_get_contents("D:/laragon/htdocs/config/project/nurse_monitor.txt");

        return $view;
    }



    public function display($r)
    {
        $today                      = date('ymd');
        $view['date']               = date('D');
        $view['full_date']          = date('d/m/Y');
        $view['today']              = $today;
        $view['list_regis']         = NurseMonitor::list_regis($r);
        $view['list_room_unselect'] = NurseMonitor::list_room_unselect($r);
        $view['list_remain']        = NurseMonitor::list_remain($r);
        $view['list_recovery']      = NurseMonitor::list_recovery($r);
        $view['list_success']       = NurseMonitor::list_success($r);
        $view['list_booking']       = NurseMonitor::list_booking($r);
        $view['location']           = NurseMonitor::location($r);
        $view['count_book']         = count($view['list_booking']);
        $view['count_regis']        = count($view['list_regis']);
        $view['count_remain']       = count($view['list_remain']);
        $view['count_success']      = NurseMonitor::count_success($r);
        $view['count_all']          = NurseMonitor::count_all($r);
        $view['count_operation']    = $view['count_regis'] + $view['count_remain'];
        $view['writeboard']         = file_get_contents("D:/laragon/htdocs/config/project/nurse_monitor.txt");
        $view['room_all']           = NurseMonitor::room_ready($r);
        $view['room_captures']         = NurseMonitor::get_room_type(uget("department"), "capture");
        $view['room_display']         = Server::table("tb_room")
        ->where("room_ready",1)
        ->where("room_type" , "capture")
        ->orderBy("room_name")
        ->get();
        $view['nurse']              = NurseMonitor::user($r, 'nurse');
        $view['doctor']             = NurseMonitor::user($r, 'doctor');
        $view['register']           = NurseMonitor::user($r, 'register');
        $view['procedure_in']       = NurseMonitor::procedure($r);
        $view['room_location']      = NurseMonitor::get_room_type("GI","process");

        // dd($view['room_location']);
        return $view;
    }

    public function control($r)
    {
        // dd($r);
        $view['department']         = $r->department;

        $view['room_all']           = NurseMonitor::room($r);
        $view['room_location']      = NurseMonitor::get_room_type("GI","process");
        // dd($view['room_location']);

        $view['room_ready']         = NurseMonitor::room_ready($r);
        $view['nurse']              = NurseMonitor::user($r, 'nurse');
        $view['doctor']             = NurseMonitor::user($r, 'doctor');
        $view['register']           = NurseMonitor::user($r, 'register');
        $view['room_capture']       = NurseMonitor::get_room_type("GI", "capture");
        $view['list_regis']         = NurseMonitor::list_regis_control($r);
        $view['list_remain']        = NurseMonitor::list_remain($r);
        $view['list_recovery']      = NurseMonitor::list_recovery($r);
        $view['list_success']       = NurseMonitor::list_success($r);
        $view['list_booking']       = NurseMonitor::list_booking($r);
        $view['location']           = NurseMonitor::location();
        $view['count_book']         = count($view['list_booking']);
        $view['count_regis']        = count($view['list_regis']);
        $view['count_remain']       = count($view['list_remain']);
        $view['procedure']          = Department::procedure(uid());

        $w[] = array('date', 'like', Carbon::now()->toDateString() . '%');
        $w[] = array('status', '!=', 'createcase');
        $w[] = array('status', '!=', 'cancel');
        $w[] = array('status', '!=', 'delete');
        $view['tb_booking']         = Server::table('tb_booking')
        ->where($w)
        ->where("confirm" , "confirm")
        ->get();
        // dd($view['tb_booking']);
        $arr                        = array();
        $arr['booking_no_system']   = $this->statusholding('Booking');

        $arr['register']            = $this->statusholding('Register');
        $arr['holding']             = $this->statusholding('Holding');
        $arr['operation']           = $this->statusholding('Operation');
        $arr['recovery']            = $this->statusholding('Recovery');
        $arr['discharged']          = $this->statusholding('Discharged');
        $arr['hide']                = $this->allhide();
        $view['tb_casemonitor']            = $arr;
        $view['writeboard']         = file_get_contents("D:/laragon/htdocs/config/project/nurse_monitor.txt");

        $view['room_captures']         = NurseMonitor::get_room_type(uget("department"), "capture");




        // dd($view);
        return $view;
    }

    public function statusholding($status)
    {
        if ($status == 'Register') {
            $wnew[0] = array('monitor_room', "!=", 0);
            $wnew[1] = array("monitor_status", $status);
            $tb_case = Server::table('tb_casemonitor')->where($wnew)->update(['monitor_status' => 'Holding']);
        }


        $w[0] = array('monitor_date', date('Ymd'));
        $w[1] = array("monitor_status", $status);
        $w[2] = array("monitor_display", '!=', 'hide');
        $tb_case = Server::table('tb_casemonitor')->where($w)->orderBy('_id', 'DESC')->limit(100)->get();




        if ($status == 'Operation') {
            $orw[0] = array('monitor_date', date('Ymd'));
            $orw[1] = array("monitor_status", 'Reporting');
            $orw[2] = array("monitor_display", '!=', 'hide');
            $tb_case = Server::table('tb_casemonitor')->where($w)->orWhere($orw)->orderBy('_id', 'DESC')->limit(100)->get();
        }

        if ($status == 'Recovery') {
            $orw[0] = array('monitor_date', date('Ymd'));
            $orw[1] = array("monitor_status", 'Discharged');
            $orw[2] = array("monitor_display", '!=', 'hide');
            $tb_case = Server::table('tb_casemonitor')->where($w)->orWhere($orw)->orderBy('_id', 'DESC')->limit(100)->get();
        }

        $arr = array();
        foreach ($tb_case as $data) {
            $data   = (object) $data;
            // dd($data);
            $hn     = $data->monitor_hn;
            $arr[$hn]['_id'][]            = $data->id;
            $arr[$hn]['caseuniq'][]       = @$data->caseuniq;
            $arr[$hn]['hn']               = @$data->monitor_hn;
            $arr[$hn]['patientname']      = @$data->monitor_patientname . "";
            $arr[$hn]['physician']        = @$data->monitor_doctorname . "";
            $arr[$hn]['procedure'][]      = @$data->monitor_procedure . "";
            $arr[$hn]['description']       = @$data->monitor_description . "";
            $arr[$hn]['waitinglocation']  = @$data->monitor_waitinglocation . "";
            $arr[$hn]['statusjob'][]      = @$data->monitor_status . "";
            $arr[$hn]['room']             = @$data->monitor_room . "";
            $arr[$hn]['appointment']      = @$data->monitor_date . "";
            $arr[$hn]['location']         = @$data->monitor_location . "";
            $arr[$hn]['queue']            = @$data->monitor_queue . "";
            $arr[$hn]['timevisit']        = @$data->monitor_timevisit . "";
            $arr[$hn]['dischargedto']     = @$data->monitor_discharge_to . "";
        }
        return $arr;
    }

    public function allhide()
    {
        $w[0] = array('monitor_date', date('Ymd'));
        $w[2] = array("monitor_display", 'hide');
        $tb_casemonitor = Server::table('tb_casemonitor')->where($w)->orderBy('_id', 'DESC')->limit(100)->get();
        $arr = array();
        foreach ($tb_casemonitor as $data) {
            $data = (object) $data;
            $arr[$data->monitor_hn]['_id'][]            = $data->id;
            $arr[$data->monitor_hn]['caseuniq'][]       = @$data->caseuniq;
            $arr[$data->monitor_hn]['hn']               = $data->monitor_hn;
            $arr[$data->monitor_hn]['patientname']      = @$data->monitor_patientname . "";
            $arr[$data->monitor_hn]['physician']        = @$data->monitor_doctorname . "";
            $arr[$data->monitor_hn]['procedure'][]      = @$data->monitor_procedure . "";
            $arr[$data->monitor_hn]['desciption']      = @$data->monitor_desciption . "";
            $arr[$data->monitor_hn]['waitinglocation']  = @$data->monitor_waitinglocation . "";
            $arr[$data->monitor_hn]['statusjob'][]      = @$data->monitor_status . "";
            $arr[$data->monitor_hn]['room']             = @$data->monitor_room . "";
            $arr[$data->monitor_hn]['appointment']      = @$data->monitor_date . "";
            $arr[$data->monitor_hn]['location']         = @$data->monitor_location . "";
            $arr[$data->monitor_hn]['queue']            = @$data->monitor_queue . "";
            $arr[$data->monitor_hn]['timevisit']        = @$data->monitor_timevisit . "";
        }
        return $arr;
    }

    public function cancel_hn($r)
    {
        $w[0] = array('monitor_hn', $r->hn);
        $val['monitor_status'] = "Cancel";
        NurseMonitor::where($w)->update($val);

        $nursemonitor = NurseMonitor::where($w)->get();
        foreach ($nursemonitor as $data) {
            $w2[0] = array('caseuniq', $data->caseuniq);
            $w2[1] = array('comcreate', $data->comcreate);
            $val2['case_status'] = 90;
            Server::table('tb_case')->where($w2)->update($val2);
            createTEMP('tb_case', $data->caseuniq, $data->comcreate, date("ymdHis"));
        }
    }

    public function cancel_caseuniq($r)
    {
        $w[0] = array('monitor_id', $r->monitor_id);
        $val['monitor_status'] = "Cancel";
        NurseMonitor::where($w)->update($val);

        $nursemonitor = NurseMonitor::where($w)->get();
        foreach ($nursemonitor as $data) {
            $w2[0] = array('caseuniq', $data->caseuniq);
            $w2[1] = array('comcreate', $data->comcreate);
            $val2['case_status'] = 90;
            Server::table('tb_case')->where($w2)->update($val2);
            createTEMP('tb_case', $data->caseuniq, $data->comcreate, date("ymdHis"));
        }
    }


    public function update_nursemonitor($r)
    {
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/config/project/nurse_monitor.txt", $r->text);
    }

    public function room_select($r)
    {
        $w[0] = array('monitor_hn', $r->hn);
        $val['monitor_room'] = (int) $r->room_id;
        Server::table('tb_casemonitor')->where($w)->update($val);
    }

    public function room_register($r)
    {
        $hn = isset($r->hn) ? $r->hn : '';
        $ids = isset($r->ids) ? $r->ids : [];
        $room_id = isset($r->room_id) ? $r->room_id : 0;
        if (isset($hn) && count($ids) != 0 && $room_id != 0) {
            foreach ($ids as $id) {
                $w[] = array('monitor_hn', $hn);
                $w[] = array('_id', $id);
                $u['monitor_timevisit']   = date('H:i');
                $u['monitor_status'] = 'Holding';
                Server::table('tb_casemonitor')->where($w)->update($u);
                $w   = [];
            }
        }
    }

    public function location_select($r)
    {
        $w[0] = array('monitor_hn', $r->hn);
        $val['monitor_location'] = $r->location;
        Server::table('tb_casemonitor')->where($w)->update($val);
    }

    public function room_ready($r)
    {
        if ($r->checked == "true") {
            $val['room_ready'] = 1;
        } else {
            $val['room_ready'] = 0;
        }
        Server::table('tb_room')->where('room_id', $r->room_id)->update($val);
    }


    public function roomchange($r)
    {
        $i          = 1;
        $roomnum    = $r->room;
        foreach ($r->val as $uniq) {
            if ($uniq != "") {
                $value['monitor_order']     = $i;
                $value['monitor_room']      = (int) $roomnum;
                $w[0] = array('caseuniq', $uniq);
                $tb_casemonitor = Server::table('tb_casemonitor')->where($w)->first();

                $w2[0] = array('monitor_hn', $tb_casemonitor->monitor_hn);
                Server::table('tb_casemonitor')->where($w2)->update($value);
                $i++;
            }
        }
    }

    public function checkin($r)
    {
        //printQที่บรรทัดนี้
        $this->queue_new($r);
        $w[0]           = array('monitor_hn', $r->hn);
        $nursemonitor   = (object) Server::table("tb_casemonitor")->where($w)->first();
        if ($nursemonitor != null) {
            $val['monitor_timevisit']   = date('H:i');
            $val['monitor_status']      = "Holding";
            Server::table("tb_casemonitor")->where($w)->update($val);
            $tb_casenote = Server::table('tb_casenote')->where('hn', $r->hn)->orderBy('_id', 'desc')->first();
            if (isset($tb_casenote)) {
                $tb_casenote = (object) $tb_casenote;
                $note_id = isset($tb_casenote->id) ? $tb_casenote->id : '';
                // echo $note_id;
            }
            // echo "true";
        } else {
            // echo "false";
        }
    }



    public function check_in_all($r)
    {
        $w[0]           = array('monitor_status', "Booking");
        $nursemonitor   = NurseMonitor::where($w)->get();

        foreach ($nursemonitor as $monitor) {
            $val['monitor_room']        = 0;
            $val['monitor_timevisit']   = date('H:i');
            $val['monitor_status']      = "Register";
            $doctor     = NurseMonitor::getuserid($monitor->monitor_doctorname);
            $room_ready = NurseMonitor::room_ready($r);
            foreach ($room_ready as $room) {
                $room_json = jsonDecode($room->room_doctor);
                foreach ($room_json as $doctorid) {
                    if ($doctor->id == $doctorid) {
                        $val['monitor_room'] = (int) $room->room_id;
                    }
                }
            }
            NurseMonitor::where('caseuniq', $monitor->caseuniq)->update($val);
        }
    }



    public function discharge($r)
    {
        $w[0]           = array('monitor_hn', $r->hn);
        $val['monitor_status'] = "Success";
        NurseMonitor::where($w)->update($val);

        $val2['q_status']       = "discharge";
        $val2['q_statustext']   = "discharge";


        $feature    = getCONFIG("feature");
        if ($feature->queue) {
            queuesystem($r->hn, "Discharge");
        }

        Queue::where('q_hn', $r->hn)->update($val2);
    }



    public function getdoctor($r)
    {
        $room_id = (int) $r->room;
        $w[0] = array('room_id', $room_id);
        $room = Server::table('tb_room')->where($w)->first();
        echo $room->room_doctor;
    }

    public function getnurse($r)
    {
        $room_id = (int) $r->room;
        $w[0] = array('room_id', $room_id);
        $room = Server::table('tb_room')->where($w)->first();
        echo $room->room_nurse;
    }

    public function getregister($r)
    {
        $room_id = (int) $r->room;
        $w[0] = array('room_id', $room_id);
        $room = Server::table('tb_room')->where($w)->first();
        echo $room->room_register;
    }

    public function doctor_select($r)
    {
        $room_id = (int) $r->room;
        $w[0] = array('room_id', $room_id);
        $val['room_doctor'] = jsonEncode($r->doctor);
        Server::table('tb_room')->where($w)->update($val);
    }

    public function nurse_select($r)
    {
        $room_id = (int) $r->room;
        $w[0] = array('room_id', $room_id);
        $val['room_nurse'] = jsonEncode($r->nurse);
        Server::table('tb_room')->where($w)->update($val);
    }

    public function register_select($r)
    {
        $room_id = (int) $r->room;
        $w[0] = array('room_id', $room_id);
        $val['room_register'] = jsonEncode($r->register);
        Server::table('tb_room')->where($w)->update($val);
    }

    public function check_tbcasemonitor($r)
    {
        $tb_user = server::table("users")->get();
        $today = date('Ymd');
        $tb_case = Server::table('tb_case')
            ->where('appointment', 'like', date("Y-m-d") . "%")
            ->where('case_hn', '!=', 'vip')
            ->where('case_status', '!=', 90)
            ->get();

        foreach ($tb_case as $data) {
            $data = (object) $data;
            $w_brance[0] = array('user_type' , 'doctor');
            $w_brance[1] = array('id' , (int)$data->case_physicians01);



            $tb_user = Server::table('users')->where($w_brance)->first();


            // dd($tb_user['user_branch']);




            $w[0] = array('caseuniq', (string) $data->caseuniq);
            $w[1] = array('comcreate', $data->comcreate);
            $table = Server::table('tb_casemonitor')->where($w)->first();


            if (!$table) {
                // $json = jsonDecode($data->case_json);
                $val['caseuniq']                = (string) $data->caseuniq;
                $val['comcreate']               = @$data->comcreate;
                $val['updatetime']              = @$data->updatetime;
                $val['monitor_hn']              = @$data->case_hn;
                $val['monitor_patientname']     = @$data->patientname;
                $val['monitor_procedure']       = @$data->procedurename;
                $val['monitor_doctorname']      = @$data->doctorname;
                $val['monitor_doctorid']        = @$data->case_physicians01;
                $val['monitor_prediagnostic']   = @$data->prediagnostic_other . "";
                $val['monitor_casestatus']      = @$data->case_status;
                $val['monitor_branch']          = @$tb_user['user_branch'] . "";
                // if ($data->case_room == null) {
                //     $val['monitor_room']    = 0;
                // } else {
                //     $val['monitor_room']     = (int) $data->case_room;
                // }

                // if($data->case_status==1){
                //     $val['monitor_status']  = "Operation";
                // }

                $monitor = (object) Server::table('tb_casemonitor')->where('monitor_hn', $data->case_hn)->first();
                if ($monitor) {
                    // dd($monitor);
                    // $val['monitor_status']  = @$monitor->monitor_status;
                    // $val['monitor_status']  = "Booking";
                    $val['monitor_status']  = "Register";
                    $val['monitor_display'] = "show";
                }



                $val['monitor_order']       = 0;
                $val['monitor_date']        = $today;
                $val['monitor_timehis']     = 0;
                $val['monitor_timevisit']   = date("H:i");
                $val['monitor_room']        = 0;
                $val['monitor_description']  = @$data->description . "";

                $roomdepartment = NurseMonitor::get_room_type("GI", "capture");
                // dd($roomdepartment);
                foreach ($roomdepartment as $rd) {
                    // dd($rd['room_id']);
                    // dd($data->case_physicians01,$rd['room_doctor']);
                    // dd(array_search($data->case_physicians01,$rd['room_doctor']));
                    if ($rd->room_doctor != null) {
                        if (gettype(array_search($data->case_physicians01, $rd->room_doctor)) == "integer") {
                            // dd("mmmmmmm");
                            $val['monitor_room'] = $rd->room_id;
                            break;
                        }
                    }
                }





                Server::table('tb_casemonitor')->insert($val);

                // if($monitor){
                //     $r->hn = @$data->case_hn;
                //     $r->qtype_code = "009";
                //     $r->qtype_prefix = "9";
                //     $r->value = 'none';
                //     $this->queue_new($r);
                // }

                // $val2['monitor_room']        = 0;
                // $doctor     = NurseMonitor::getuserid($data->doctorname);
                // $room_ready = NurseMonitor::room_ready($r);
                // foreach ($room_ready as $room) {
                //     if (isset($room->room_doctor)) {
                //         $room_json = jsonDecode($room->room_doctor);
                //         foreach ($room_json as $doctorid) {
                //             if (isset($doctor->id)) {
                //                 if ($doctor->id == $doctorid) {
                //                     $val2['monitor_room'] = (int) $room->room_id;
                //                 }
                //             }
                //         }
                //     }
                // }
                // $val2['monitor_timevisit']        = date('H:i');
                // $w2[0] = array('monitor_hn', $data->case_hn);
                // Server::table("tb_casemonitor")->where($w2)->update($val2);
            } else {
            }
            unset($val);
        }
        Server::table("tb_casemonitor")->where('monitor_date', '!=', $today)->delete();
        Server::table("tb_queue")->where('q_date', '!=', date("Y-m-d"))->delete();
    }
}
