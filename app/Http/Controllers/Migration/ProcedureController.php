<?php

namespace App\Http\Controllers\Migration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;

class ProcedureController extends Controller
{

    public function index(){
        $tb_autotext = Mongo::table('tb_autotext')->get();

        foreach($tb_autotext as $data){
            // $tb_procedure = Mongo::table('tb_procedure')->where('id', $data['id'])->first();
            if($data['auto_procedure']==1){$val['auto_procedure'] = "gi001";}
            if($data['auto_procedure']==2){$val['auto_procedure'] = "gi002";}
            if($data['auto_procedure']==3){$val['auto_procedure'] = "gi003";}
            $a = $val['auto_procedure'];
            if($a == "gi003"||$a=="gi001" || $a=="gi002"){
                Mongo::table('tb_autotext')->where('_id',$data['_id'])->update($val);
            }
        }
    }


    public function show($id){
        $tb_report = DB::table('tb_report')->get();
        foreach($tb_report as $data){
            $val['report_hn']           = pdpaEncode($data->report_hn);
            $val['report_patientname']  = pdpaEncode($data->report_patientname);
            DB::table('tb_report')->where('report_id', $data->report_id)->update($val);

        }

    }


}
