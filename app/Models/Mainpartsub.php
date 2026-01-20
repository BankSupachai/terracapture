<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;


class Mainpartsub extends Model
{
    use HasFactory;
    protected $table = 'tb_mainpartsub';
    const UPDATED_AT = null;

    public static function sort($id){
        $val = DB::table('tb_mainpart')
        ->select('tb_mainpartsub.*')
        ->distinct('mainpartsub_id')
        ->join('tb_case', 'tb_case.case_procedurecode', 'tb_mainpart.mainpart_procedure_code')
        ->join('tb_mainpartsub', 'tb_mainpart.mainpart_id', 'tb_mainpartsub.mainpartsub_mp_id')
        ->where('case_id', $id)
        ->orderby('mainpartsub_sort','asc')
        ->get();

        return $val;
    }

    public static function count_success(){
        $w[0]       = array('monitor_status',"Success");
        $count = nursemonitor::where($w)->count();
        return $count;
    }

    public static function get_mainpart($code){
        $w[0]  = array('code', $code);
        $w1[0] = array('code', 'gi001');
        $data  = Mongo::table('tb_procedure')->where($w)->first();
        $data1 = Mongo::table('tb_procedure')->where($w1)->first();
        $mainpart = isset($data->mainpart) ? $data->mainpart : array();
        return $mainpart;
    }


}
