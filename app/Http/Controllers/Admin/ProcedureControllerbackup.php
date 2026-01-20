<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\tb_diagnostic;
use App\Models\tb_mainpart;
use App\Models\tb_procedure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Models\Mongo;
use App\Models\Server;

class ProcedureController extends Controller
{
    // public function __construct(Request $r){checklogin();}


    public function index(Request $request)
    {
        if(Server::check_connection()){return redirect(url('servererror'));}
        // $time1 = date_create("13:00:00");
        // $time2 = date_create("13:40:00");
        // $time = date_diff($time2,$time1);
        // dd($time->format("%H:%I:%S"));
        $view['procedure'] = Server::table('tb_procedure')->get();
        return view('admin.procedure.index', $view);
    }

    public function create()
    {
        return view('admin.procedure_create');
    }


    public function store(Request $r){

        if(isset($r->event)){
            if($r->event=='get_masterdata')                 {return $this->get_masterdata($r);}
            if($r->event=='add_procedurename')                 {return $this->add_procedurename($r);}
            if($r->event=='del_proc_show')                 {return $this->del_proc_show($r);}


        }

        if(isset($r->add_sp)){
            tb_procedure::insert_procedure_set($r);
        }elseif(isset($r->addpdf)){
            tb_procedure::insert_procedure_pdf($r);
        }else{
            tb_procedure::insert_procedure($r);
        }
        return redirect('admin/procedure');
    }

    public function del_proc_show($r) {
        $tb_procedure = Server::table("tb_procedure")->where("code",$r->proccode)->first();
        $temp= $tb_procedure['pdf']['show'];
        $arr = array();
        foreach($temp as $data){
            if($r->procname!=$data){
                $arr[] = $data;
            }
        }
        $tb_procedure['pdf']['show'] = $arr;
        Server::table("tb_procedure")->where("code",$r->proccode)->update($tb_procedure);
    }

    public function add_procedurename($r) {
        $currentData = Mongo::table("tb_procedure")
        ->where("code", $r->code)
        ->first();

    if(isset($currentData['pdf']['show'])) {
        $currentData['pdf']['show'][] = $r->pdf_show;
    }

    // อัปเดตข้อมูลใน MongoDB
    Mongo::table("tb_procedure")
        ->where("code", $r->code)
        ->update($currentData);

        return redirect('admin/procedure/'.$r->code );

    }










    public function get_masterdata($r) {
        $host             = config('database.connections.mongodb.host');
        $database         = config('database.connections.mongodb.database');
        $this_collection  = $r->tb_name;
        $status           = get_master_data($host, $database, $this_collection, 'tb_department');
        return redirect(url('admin').'/procedure')->with('status', $status);
    }

    public function show($id)
    {

        $folderPath = resource_path('views/Endocapture/pdf/component/left_section');
        $bladeFiles = File::glob($folderPath . '/*.blade.php');
        // foreach ($bladeFiles as $bladeFile) {
        //     $file = basename($bladeFile);
        // }
        // $view['procedure']      = tb_procedure::get_procedure_by_id($id);
        // $view['procedure_sub']  = tb_procedure::get_procedure_sub_by_procedure_id($view['procedure']->procedure_id);
        // $view['main_part']      = tb_mainpart::get_mainpart_by_procedure_code($id);
        // $view['diagnostic']     = tb_diagnostic::get_diagnostic_by_procedure_code($view['procedure']->procedure_code);
        // $view['tb_proicd9']     = tb_procedure::get_procedureicd9_by_procedure_code($view['procedure']->procedure_code);
        // $view['setting']        = tb_procedure::get_procedure_set();
        // $view['settingpdf']     = tb_procedure::get_procedure_pdf();
        // $procedure = $view['procedure'];
        // if((@$procedure->case_recordshow!= null) || (@$procedure->case_recordshow!= '')){
        //     $view['json']  = (array) json_decode($procedure->case_recordshow);
        // }
        // $view['all_procedure'] = tb_procedure::get_procedure_set();
        // if(isset($view['json'])){
        //     $view['setting'] = tb_procedure::get_procedure_set_not_used($view['json']);
        // }
        // if(@$procedure->procedure_pdfshow != null || @$procedure->procedure_pdfshow != ""){
        //     $view['json2']  = (array) json_decode($procedure->procedure_pdfshow);
        // }
        // if(isset($view['json2'])){
        //     $view['settingpdf'] = tb_procedure::get_procedure_pdf_not_used($view['json2']);
        // }
        $view['files'] = $bladeFiles;
        $view['tab'] = 'general';
        if(isset($_GET['tab'])){
            $view['tab'] = $_GET['tab'];
        }
        $view['procedure_all'] = Server::table('tb_procedure')->get();
        $view['procedure'] =  Server::table('tb_procedure')->where('code',$id)->first();
        $view['procedure_head'] = $view['procedure']->pdf['head'];
        $view['procedure_show'] = $view['procedure']->pdf['show'];

        // dd($view);
        return view('admin.procedure.show', $view);

        // return view('admin.procedureedit',$view);
    }

    public function update(Request $r, $id)
    {
        if(isset($r->general)){
            $data['name'] = @$r->name;
            $data['color'] = @$r->color;
            Server::table('tb_procedure')->where('code',$id)->update($data);
        }else{
            tb_procedure::update_procedure($r, $id);
        }
        semi_createtemp_masterdata("tb_procedure");
        return redirect("admin/procedure/$id?tab=general");
    }

    public function destroy($id ,Request $r)
    {
        if(isset($r->btn_edit)){
            if(isset($r->sp_name) && isset($r->sp_file)){
                tb_procedure::update_procedure_set_by_id($r);
            }
        }
        if(isset($r->btn_del)){
            tb_procedure::delete_procedure_set_by_id($r->sp_id);
        }
        return redirect()->back();
    }

}
