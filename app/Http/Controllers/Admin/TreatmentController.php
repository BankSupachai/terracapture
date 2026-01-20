<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\tb_diagnostic;
use App\Models\tb_mainpart;
use App\Models\tb_procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\Mongo;

//ตัวอย่างการใช้ connection ที่เชื่อมต่อกับ SERVER
use App\Models\Server;


class TreatmentController extends Controller
{

    public function index(){
        //ตัวอย่างการใช้ connection ที่เชื่อมต่อกับ SERVER
        // $view['treatment'] = Server::table('tb_treatmentcoverage')->get();

        if(Server::check_connection()){return redirect(url('servererror'));}

        $view['treatment'] = Server::table('tb_treatmentcoverage')->get();
        // dd($view);
        return view('admin.treatment.index', $view);
    }

    public function create(){
        $view['type'] = 'ADD';
        return view('admin.treatment.create', $view);
    }

    public function edit($code){
        $view['type'] = 'EDIT';
        $view['treatment'] = (object) Server::table('tb_treatmentcoverage')->where('code', $code)->first();
        return view('admin.treatment.create', $view);
    }

    public function store(Request $r){
        if($r->event){
            if($r->event=='treatment_create')                    {return $this->treatment_create($r);}
            if($r->event=='treatment_edit')                      {return $this->treatment_edit($r);}
            if($r->event=='get_masterdata')                      {return $this->get_masterdata($r);}

        }
    }

    public function treatment_create($r){
        $i = $this->set_treatment_array($r, null);
        Server::table('tb_treatmentcoverage')->insert($i);
        return redirect(url('admin/treatment'));
    }

    public function treatment_edit($r){
        $tb_treatment = (object) Server::table('tb_treatmentcoverage')->where('code', $r->code)->first();
        $u = $this->set_treatment_array($r, $tb_treatment);
        Server::table('tb_treatmentcoverage')->where('code', $r->code)->update($u);
        return redirect(url('admin/treatment'));
    }

    public function set_treatment_array($r, $tb_treatment){
        $i['name']   = $r->treatment_name;
        // $i['status'] = $r->treatment_status;
        $i['code']   = isset($tb_treatment) == false ? $this->cal_treatment_code() : $tb_treatment->code;
        // dd($i);
        return $i;
    }

    public function cal_treatment_code(){
        $init = 0;
        $tb_treatmentcoverage = Server::table('tb_treatmentcoverage')->get();
        foreach ($tb_treatmentcoverage as $data) {
            $data = (object) $data;
            $code = isset($data->code) ? intval($data->code) : 0;
            if($code > $init){
                $init = $code;
            }
        }
        $init = $init + 1;

        $init_num = strlen(strval($init));
        $zero_num = 3 - $init_num;
        for ($i=0; $i < $zero_num; $i++) {
            $init = "0".$init;
        }

        return $init;
    }

    public function get_masterdata($r) {
        $host             = config('database.connections.mongodb.host');
        $database         = config('database.connections.mongodb.database');
        $this_collection  = $r->tb_name;
        $status           = get_master_data($host, $database, $this_collection, 'tb_department');
        return redirect(url('admin').'/treatment')->with('status', $status);
    }



}
