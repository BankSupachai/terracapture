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

        $query = Server::table('tb_procedure');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%");
            });
        }

        // Apply procedure filter
        if ($request->filled('procedure')) {
            $query->where('name', $request->procedure);
        }

        // Apply modality filter
        if ($request->filled('modality')) {
            $query->where('modality', $request->modality);
        }

        // Apply sorting
        $sortField = $request->input('sort', 'code');
        $sortDirection = $request->input('direction', 'asc');
        $query->orderBy($sortField, $sortDirection);

        $view['procedure'] = $query->get();
        return view('admin.procedure.index', $view);
    }

    public function show($code){
        $view['config'] = getCONFIG("pdf");
        $view['tb_procedure'] = Server::table("tb_procedure")->where("code",$code)->first();

        $dir = glob(resource_path('views/EndoCAPTURE/pdf/component/left_section/*.blade.php'));
        $left_section = $view['tb_procedure']->pdf['show'];
        foreach($dir as $d){
            $ex = explode("left_section/", $d);
            $view['left_section'][] = $ex[1];
        }
        $department = uget('department');

        $view['hospital'] = Mongo::table('tb_config')->where('config_type', 'hospital')->first();
        $arr['patientname'] = 'สมชาย สมบูรณ์';
        $arr['gender'] = 'ชาย';
        $view['casedata'] = (object) $arr;
        $department = Mongo::table('tb_department')->where('department_name', $department)->first();
        $view['position'] = $department->position??[];
        $view['txt_setting'] = $department->txt_setting??[];
        $view['department'] = $department;
        return view('pdfcustom.index',$view);
    }

    public function updateposition($r){

        $department = Mongo::table('tb_department')->where('department_name', $r->department)->first();
        $val['position'] = $department->position??[];
        $val['position'][$r->name] = "position: absolute; left: $r->x"."px; top: $r->y"."px;";
        Mongo::table('tb_department')->where('department_name', $r->department)->update($val);
    }

    public function update_font_size($r){

        $department = Mongo::table('tb_department')->where('department_name', $r->department)->first();
        $val['txt_setting'] = $department->txt_setting??[];
        $val['txt_setting'][$r->name][$r->attr] = $r->value;
        $str = '';
        foreach($val['txt_setting'][$r->name] as $key => $value){
            if($key == 'size'){
                $str .= "font-size: $value"."px;";
            }
            if($key == 'color'){
                $str .= "color: $value;";
            }
        }
        $val['txt_setting'][$r->name]['str'] = $str;
        Mongo::table('tb_department')->where('department_name', $r->department)->update($val);
    }


    public function custom_body($r){
        $pdf_show = $r->pdf_show;
        $code = $r->code;
        $tb_procedure = Server::table("tb_procedure")->where("code",$code)->first();
        $val['pdf']['head'] = $tb_procedure->pdf['head'];

        foreach ($pdf_show as $value) {
            $val['pdf']['show'][] = $value;
            Server::table("tb_procedure")->where("code",$code)->update($val);
        }
        return redirect("pdfcustom/".$r->code);
    }

}
