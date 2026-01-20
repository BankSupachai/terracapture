<?php

namespace App\Http\Controllers\Capture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Server;
use App\Models\Mongo;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{
    // public function __construct(Request $r){checklogin();}

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }

    public function index(Request $r)
    {
        if (Server::check_connection()) {
            return redirect(url('servererror'));
        }
        $serverconnect = @fsockopen(getCONFIG('admin')->server_name, portnumber(), $errno, $errstr, 1);
        $view   = array();
        $view   = $this->query_data($r, $view);
        // dd($view);
        return $view;
    }




    public function indexfirst($r)
    {

        // dd("mmmm");
        $data['doctor']     = Department::userActive("doctor");
        $data['nurse']      = Department::server_user('nurse', uid());
        $data['register']   = Department::server_user('register', uid());
        $data['procedure']  = Server::table('tb_procedure')->get();
        $data['scope']      = Server::table('tb_scope')->get();
        $data['allroom']    = Server::table('tb_room')->get();
        $data['department']    = Server::table('tb_department')->get();

        $data['users']      = Server::table('users')->where('user_type', '!=', 'endo')->get();

        $data['data2']      = $r;
        $data['icd9']       = $this->geticd9($r);  // intervention
        $data['icd10']      = $this->geticd10($r); // diagnosis
        $admin = getCONFIG('admin');
        $scope = getCONFIG('scope');
        $data['year_install'] = $admin->year_install;
        $data['is_phutshin'] = $scope->phutchin_scope ?? false;
        $data['users_modal'] = Server::table('users')->get();
        $data['data_limit']  = 250;
        return $data;
    }

    public function query_data(Request $r)
    {


        session_start();
        if (isset($_SESSION['inputall']) && $r->page) {
            $page = $r->page;
            $r = (object) $_SESSION['inputall'];
            $r->page = $page;
        } else {
            unset($_SESSION['inputall']);
        }
        try {
            $_SESSION['inputall'] = $r->all();
        } catch (\Throwable $th) {
            $_SESSION['inputall'] = $r;
        }

        $view = $this->indexfirst($r);

        $tb_case = Mongo::table("tb_case");

        if (checkNULL(@$r->keyword)) {
            $tb_case = $tb_case->where('case_status', '!=', 90)
                               ->where(function ($query) use ($r) {
                                   $columns = Mongo::table('tb_case')->first(); // ดึงข้อมูลแถวแรกเพื่อดูว่ามีคอลัมน์อะไรบ้าง
                                   foreach ($columns as $column => $value) {
                                       $query->orWhere($column, "like", "%" . $r->keyword . "%");
                                   }
                               });
        }
        $tb_case->where(function ($query) use ($r) {
            if (isset($r->procedure)) {

                $query->whereIn('case_procedurecode', $r->procedure ?? []);
            }

            if (isset($r->user)) {
                $query->whereIn('case_physicians01', array_map('intval', $r->user));
            }

            if (isset($r->start_date)) {

                $query->where('appointment_date', '>=', $r->start_date);
            }

            if (isset($r->end_date)) {
                $query->where('appointment_date', '<=', $r->end_date);
            }

        });
        $view['tb_case'] = $tb_case->paginate(100);
        $view['case_count'] = $view['tb_case']->total();
        $view['download']       = ceil($view['case_count'] / 10000);
        $view['filter']         = $r->all();
        return view('capture.exportdata.index', $view);
    }



    public function checksearch($r, $w, $text, $array)
    {
        if (isset($r->$text)) {
            $w[] = $array;
        }

        return $w;
    }

    public function export() {}

    public function geticd($r)
    {
        $arr['icd9'] = $this->geticd9($r);
        $arr['icd10'] = $this->geticd10($r);
        return jsonEncode($arr);
    }

    public static function geticd9($r)
    {
        $w[] = array('icd9', '!=', null);
        $tb_procedure   = Server::table('tb_procedure')->where($w)->select('name', 'icd9')->get();
        if (isset($r->procedure)) {
            $tb_procedure = Server::table('tb_procedure')->where($w)->whereIn('name', $r->procedure)->select('name', 'icd9')->get();
        }

        $icd9        = [];
        foreach ($tb_procedure as $proc) {
            $proc = (object) $proc;
            if (!isset($proc->name) || !isset($proc->icd9)) {
                continue;
            }

            $icd9_proc = is_array($proc->icd9) ? $proc->icd9 : [];
            foreach ($icd9_proc as $key => $data) {
                if (isset($data)) {
                    for ($i = 0; $i < count($data); $i++) {
                        $name = $data[$i]['name'];
                        if (isset($name) && @$name . "" != "") {
                            $icd9[] = $name;
                        }
                    }
                }
            }
        }

        return $icd9;
    }




    public static function geticd10($r)
    {
        $w[] = array('icd10', '!=', null);
        $tb_procedure = Server::table('tb_procedure')->where($w)->select('name', 'icd10')->get();
        if (isset($r->procedure)) {
            $tb_procedure = Server::table('tb_procedure')->where($w)->whereIn('name', $r->procedure)->select('name', 'icd10')->get();
        }
        $icd10        = [];
        foreach ($tb_procedure as $proc) {
            $proc = (object) $proc;
            if (!isset($proc->name) || !isset($proc->icd10)) {
                continue;
            }
            $icd10_proc = is_array($proc->icd10) ? $proc->icd10 : [];
            foreach ($icd10_proc as $key => $data) {
                if (isset($data)) {
                    for ($i = 0; $i < count($data); $i++) {
                        $name = $data[$i]['name'];
                        if (isset($name) && @$name . "" != "") {
                            $icd10[] = $name;
                        }
                    }
                }
            }
        }
        return $icd10;
    }

    public function edit($id)
    {
        session_start();
        $_SESSION['download_start'] = $id * 10000;
        $end    = $_SESSION['download_start'] + 10000;
        $moss   = new DataExport;

        return Excel::download($moss, 'report' . $_SESSION['download_start'] . "_" . $end . ".xls");
    }
}
