<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MigratdataController extends Controller
{

    public function index(){
        return view('endocapture.superadmin.migration');
    }

    public function store(Request $r){
        if(isset($r->event)){
            $event = $r->event;
            if($event=="tb_case")       {$this->tb_case($r);}
            if($event=="change_id2code")  {$this->change_id2code($r);}
            if($event=="tb_mainpart")   {$this->tb_mainpart($r);}
        }
        return redirect('superadmin');
    }


    public function show($id){
        return redirect('superadmin');
    }


    public function change_id2code($r){
        $table = DB::table($r->table)->get();
        foreach($table as $data){
            $procedure = DB::table('tb_procedure')->where("procedure_id",$data->procedure_code)->first();
            $val['procedure_code'] = $procedure->procedure_code;
            DB::table($r->table)->where("procedure_code",$data->procedure_code)->update($val);
        }
    }

    public function tb_mainpart($r){
        $table = DB::table("tb_mainpart")->get();
        foreach($table as $data){
            $procedure = DB::table('tb_procedure')->where("procedure_id",$data->mainpart_procedure_id)->first();
            $val['mainpart_procedure_code'] = $procedure->procedure_code;
            DB::table("tb_mainpart")->where("mainpart_procedure_id",$data->mainpart_procedure_id)->update($val);
        }
    }

    public function tb_case($r){
        $data = DB::table('tb_case')->where('case_procedure','!=',0)->select('case_id','case_procedure')->get();
        if(isset($data)){
            foreach ($data as $d) {
                $check = DB::table('tb_procedure')->where('procedure_id',$d->case_procedure)->first();
                $value['case_procedurecode'] = $check->procedure_code;
                DB::table('tb_case')->where('case_id',$d->case_id)->update($value);
            }
        }
    }
}
