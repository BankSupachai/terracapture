<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Datacase;
use App\Models\Casebooking;
use App\Models\Department;
use App\Models\Server;
use App\Models\Mongo;


class SendtoController extends Controller
{
    public function index(Request $r)
    {

        // dd(1);
        $paginate = 15;
        $view['page']               = isset($r->page) ? $r->page : '1';
        $view['paginate']           = $paginate;

        $view['pacs']               = getCONFIG('pacs');
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
        $view['casetoday']          = Mongo::table('tb_case')->where('appointment_date', date('Y-m-d'))->get();

        $w[] = array('case_status', '!=', 90); // การสร้างตัวแปร w เพื่อใช้เช็คว่ามีเคสนั้นหรือไม่
        $w[] = array('statusjob', 'recovery');
        // $w[] = array('department', uget('department'));

        $view['casesendto']         = Mongo::table('tb_case')->where('statusjob', 'recovery')->orderBy('_id', 'desc')->paginate($paginate);
        $view['count_casetoday']    = Datacase::counttoday();
        $view['alltoday_case']      = $this->statusholding($r, 'all');
        $view['configadmin']        = getCONFIG('admin');
        $view['feature']            = getCONFIG("feature");



        if (isset($r->event) && $r->event == 'filter_case') {
            $query = Mongo::table('tb_case');

            $filters = [
                'search_hn' => 'case_hn',
                'search_name' => 'patientname',
                'search_doctor' => 'case_physicians01',
                'search_date' => 'appointment_date',
                'search_procedure' => 'procedurename',
            ];

            foreach ($filters as $input => $column) {
                if ($r->filled($input)) { // ใช้ filled() เพื่อเช็คค่าว่าง
                    $query->where($column, 'like', '%' . $r->$input . '%');
                    $view[$input] = $r->$input;
                }
            }

            $view['casesendto'] = $query->orderBy('_id', 'desc')->paginate($paginate);
            $view['event'] = $r->event;
        }
//
        if ($r->filled('search_keyword')) {
            $view['casesendto'] = Server::table('tb_case')
                ->where(function ($query) use ($r) {
                    $query->where('overall_finding', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('case_history', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('medi_other', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('indication_other', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('overall_diagnosis', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('diagnostic_text', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('overall_procedure', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('procedure_subtext', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('finding', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('complication_other', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('technique_other', 'like', '%' . $r->search_keyword . '%')
                        ->orWhere('anesthesiaother', 'like', '%' . $r->search_keyword . '%');

                })
                ->orderBy('_id', 'desc')
                ->paginate($paginate);
        }

        $view['search_keyword'] = $r->search_keyword;
        $query = request('query');
        $view['result'] = Server::table('tb_case')->where('case_hn', 'like', '%' . $query . '%')->get();

        if (isMobile()) {
            return redirect("tablet/home");
        }

        // dd($view);
        return view('endoindex.showup.index', $view);
    }




    public function show(Request $r)
    {
        // dd(1);
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
        $view['casetoday']          = Server::table('tb_case')->where('appointment_date', date('Y-m-d'))->get();
        $view['count_casetoday']    = Datacase::counttoday();
        $view['alltoday_case']      = $this->statusholding($r, 'all');
        $view['configadmin']        = getCONFIG('admin');
        $view['feature']            = getCONFIG("feature");

        // $drives = range('A' , 'Z');
        // dd($drives);
        if (isMobile()) {
            return redirect("tablet/home");
        }

        // dd($view);
        return view('endoindex.showup.index', $view);
    }







    public function statusholding($r, $status)
    {

        $department = [];


        $department = uget("department");


        $w[0]       = array('appointment', "like", date('Y-m-d') . "%");
        // $w[1] = array("statusjob" , $status);
        $w[5]       = array("department", $department);
        $orw[5]     = array("department", $department);
        $orw1[5]    = array("department", $department);
        $tb_case    = Server::table('tb_case')->where($w)->orderBy('_id', 'DESC')->limit(500)->get();

        if ($status == 'holding') {
            $orw[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw[1] = array("statusjob", 'operation');
            $orw1[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw1[1] = array("statusjob", 'recovery');
            $tb_case = Server::table('tb_case')->where($w)->orWhere($orw)->orWhere($orw1)->orderBy('_id', 'DESC')->limit(500)->get();
        } elseif ($status == 'operation') {
            $orw[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw[1] = array("statusjob", "recovery");
            $orw1[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw1[1] = array("statusjob", "holding");
            $tb_case = Server::table('tb_case')->where($w)->orWhere($orw)->orWhere($orw1)->orderBy('_id', 'DESC')->limit(500)->get();
        } elseif ($status == 'recovery') {
            $orw[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw[1] = array("statusjob", 'discharged');
            $orw1[0] = array('appointment', "like", date('Y-m-d') . "%");
            $orw1[1] = array("statusjob", 'operation');
            $tb_case = Server::table('tb_case')->where($w)->orWhere($orw)->orWhere($orw1)->orderBy('_id', 'DESC')->limit(500)->get();
        } else if ($status == 'all') {
            // array_pop($w);
            $tb_case = Server::table('tb_case')->where($w)->orderBy('_id', 'DESC')->limit(500)->get();
            // dd($w,$tb_case);
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
            $case_monitor = (object) Server::table('tb_casemonitor')->where($w1)->first();

            $case_hn      = isset($data->case_hn)       ? $data->case_hn     : $data->hn;
            $patient_name = isset($data->patientname)   ? $data->patientname :  $data->firstname . ' ' . $data->lastname;
            $doctor1      = isset($data->doctorname) && @$data->doctorname . "" !== "" ? $data->doctorname  : $data->physician;
            if (isset($data->physician) && @$data->physician . "" !== "") {
                $doctor1  = $data->physician;
            }
            $room         = isset($data->room)          ? $data->room        : '';
            $pdfversion   = isset($data->case_pdfversion) ? $data->case_pdfversion : 0;

            $arr[$case_hn]['_id']                   = $data->id;
            $arr[$case_hn]['case_id']               = @$data->case_id . "";
            $arr[$case_hn]['hn']                    = $case_hn;
            $arr[$case_hn]['patientname']           = @$patient_name . "";
            $arr[$case_hn]['physician']             = @$doctor1 . "";
            $arr[$case_hn]['procedure'][]           = @$data->procedurename . "";
            $arr[$case_hn]['description']           = @$data->description . "";
            $arr[$case_hn]['waitinglocation']       = @$data->waitinglocation . "";
            $arr[$case_hn]['statusjob'][]           = @$data->statusjob . "";
            $arr[$case_hn]['statuspacs'][]          = @$data->statuspacs;
            $arr[$case_hn]['statusreport'][]        = @$data->statusreport . "";
            $arr[$case_hn]['prediagnosis_other']    = @$data->prediagnostic_other . "";
            $arr[$case_hn]['rapid_urease_test'][]   = isset($data->rapid_urease_test) ? @$data->rapid_urease_test . "" : '';
            $arr[$case_hn]['rapid_other'][]         = isset($data->rapid_other) ? @$data->rapid_other . "" : '';
            $arr[$case_hn]['complication_other']    = @$data->complication_other . "";

            if ($pdfversion != 0 && is_array($pdfversion)) {
                $arr[$case_hn]['case_pdfversion'][] = @$pdfversion;
            }

            $arr[$case_hn]['room']              = gettype($room) != 'array' ? @$room . "" : join(" ", $room);
            $arr[$case_hn]['appointment']       = @$data->appointment . "";
            $arr[$case_hn]['description']       = isset($case_monitor->monitor_description) ? $case_monitor->monitor_description : '';
        }

        return $arr;
    }

    public function statusall($r)
    {
        $w[]        = array('statusjob', '!=', 'delete');
        $w[]        = array('statusjob', '!=', 'cancel');

        $name       = $r->search_name;
        $hn         = $r->search_hn;
        $physician  = $r->search_physician;
        $procedure  = $r->search_procedure;
        $datefrom   = isset($r->search_datefrom) ? $r->search_datefrom . ' 00:00' : '';
        $dateto     = isset($r->search_dateto) ? $r->search_dateto . ' 00:00' : '';

        if ($physician != "") {
            $w[] = array('doctorname', 'LIKE', '%' . $physician . '%');
        }
        if ($procedure != "") {
            $w[] = array('procedurename', $procedure);
        }
        if ($name != "") {
            $w[] = array('patientname', 'LIKE', '%' . $name . '%');
        }
        if ($hn != "") {
            $w[] = array('case_hn', 'LIKE', '%' . $hn . '%');
        }

        $tb_case    = Server::table('tb_case')->where($w)->orderBy('_id', 'DESC')->limit(500)->get();

        if ($datefrom != '' && $dateto != '') {
            $tb_case    = Server::table('tb_case')->where($w)->whereDate('appointment', '>=', $datefrom)->whereDate('appointment', '<=', $dateto)->orderBy('_id', 'DESC')->limit(500)->get();
        } elseif ($datefrom != '' && $dateto == '') {
            $tb_case    = Server::table('tb_case')->where($w)->whereDate('appointment', '>=', $datefrom)->orderBy('_id', 'DESC')->limit(500)->get();
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

        $data      = Server::table('tb_case')->where($w)->orderby('appointment', 'desc')->get();
        $patient   = (object) Server::table('tb_patient')->where('hn', $r->case_hn)->first();
        $view['tb_case'] = $data;
        $view['patient'] = $patient;
        $view['type']    = $r->btn;
        $view['url']     = url('');


        $html = view("EndoCAPTURE.home.component.content_case", $view)->render();
        echo $html;
    }

    public function delete_case($r)
    {
        $w[] = array('_id', $r->del_caseid);
        $u['statusjob'] = 'delete';
        $update = Server::table('tb_case')->where($w)->update($u);
        return  redirect(url('home'));
    }

    public function count_duplicate($array)
    {
        $vals = array_count_values($array);
    }
}
