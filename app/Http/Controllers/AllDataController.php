<?php

namespace App\Http\Controllers;

// use App\Models\ake;
use App\Models\Mongo;
use Illuminate\Http\Request;
use App\Exports\AllDataExport;
use App\Models\Department;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AllDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $r)
    {
        $view['procedure'] = Mongo::table('tb_procedure')->get();
        $view['doctor'] = Department::userActive('doctor');

        // dd($view);
        if(isset($r->event)){
            if($r->event=='query_data'){
                $view = $this->query_data($r);
            }
        }else{
            $view['tb_case'] = Mongo::table('tb_prepareexport')->paginate(1000);
            $view['download'] = ceil($view['tb_case']->total() / 10000);
            $view['title'] = 'All Data';
        }

        return view('alldata.index', $view);
    }


    public function query_data($r)
    {
        $view['procedure'] = Mongo::table('tb_procedure')->get();
        $view['doctor'] = Department::userActive('doctor');

        // dd($r);

        $query = Mongo::table('tb_prepareexport');
        if (isset($r->keyword) && $r->keyword) {
            $query->where('text', 'like', '%' . $r->keyword . '%');
        }
        if (isset($r->user) && $r->user) {
            $query->where('doctorcode', intval($r->user));
        }
        if (isset($r->procedure) && $r->procedure) {
            $query->where('procedurecode', $r->procedure);
        }
        if (isset($r->start_date) && $r->start_date) {
            $query->where('date', '>=', $r->start_date);
        }
        if (isset($r->end_date) && $r->end_date) {
            $query->where('date', '<=', $r->end_date);
        }
        $view['tb_case'] = $query->paginate(100);
        $view['case_count'] = $view['tb_case']->total();
        $view['download']       = ceil($view['case_count'] / 10000);
        $view['title'] = 'All Data';
        return $view;
    }


    public function show($id)
    {
        $tb_prepareexport = Mongo::table('tb_prepareexport')->get();
        dd($tb_prepareexport);
    }

    public function prepare($r)
    {
        Mongo::table('tb_prepareexport')->truncate();

        $tb_case = Mongo::table('tb_case')->get();

        foreach ($tb_case as $data) {
            $val['date'] = isset($data->appointment_date) ? $data->appointment_date : "";
            $val['caseuniq'] = isset($data->caseuniq) ? $data->caseuniq : $data->case_id;
            $val['doctorcode'] = isset($data->case_physicians01) ? $data->case_physicians01 : "";
            $val['procedurecode'] = isset($data->case_procedurecode) ? $data->case_procedurecode : "";
            $val['nurse'] = isset($data->user_in_case) ? $this->user_in_case("nurse",$data->user_in_case) : [];
            $val['nurse_assistant'] = isset($data->user_in_case) ? $this->user_in_case("nurse_assistant",$data->user_in_case) : [];
            $val['anesthesia'] = isset($data->user_in_case) ? $this->user_in_case("anesthesia",$data->user_in_case) : [];
            $val['nurse_anes'] = isset($data->user_in_case) ? $this->user_in_case("nurse_anes",$data->user_in_case) : [];
            $val['scientific'] = isset($data->user_in_case) ? $this->user_in_case("scientific",$data->user_in_case) : [];
            $val['text'] = json_encode($data);
            Mongo::table('tb_prepareexport')->insert($val);
        }

        $arr['status'] = 'success';
        $arr['message'] = 'Prepare data exported successfully';
        return response()->json($arr);
    }


    public function user_in_case($type, $user_in_case)
    {
        $arr = [];
        foreach ($user_in_case as $data) {
            $w[0] = array('uid', intval($data));
            $w[1] = array('user_type', $type);
            $user = Mongo::table('users')->where($w)->first();
            if (isset($user)) {
                $arr[] = fullname($user);
            }
        }
        return $arr;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $r)
    {

        $new = array();
        foreach ($r->all() as $key => $value) {
            $key = str_replace('amp;', '', $key);
            $new[$key] = $value;
        }
        $r = (object) $new;
        $query = Mongo::table('tb_prepareexport');

        if (isset($r->keyword) && $r->keyword) {
            $query->where('text', 'like', '%' . $r->keyword . '%');
        }
        if (isset($r->user) && $r->user) {
            $query->where('doctorcode', intval($r->user));
        }
        if (isset($r->procedure) && $r->procedure) {
            $query->where('procedurecode', $r->procedure);
        }
        if (isset($r->start_date) && $r->start_date) {
            $query->where('date', '>=', $r->start_date);
        }
        if (isset($r->end_date) && $r->end_date) {
            $query->where('date', '<=', $r->end_date);
        }


        // dd($query);
        // dd($r);
        $r->download_start = $id * 10000;
        $end    = $r->download_start + 10000;
        $moss   = new AllDataExport($r);

        // dd($moss);

        return Excel::download($moss, 'report' . $r->download_start . "_" . $end . ".xls");
    }

}
