<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Accessory extends Model
{
    use HasFactory;
    protected $table = "accessory";
    const UPDATED_AT = null;
    const CREATED_AT = null;

    protected $fillable = ['accessory_code','accessory_name','accessory_price','accessory_company','accessory_procedure','accessory_status'];

    public static function get_accessory(){
        $data = DB::table('accessory')
        ->leftjoin('accessory_com', 'accessory_com.accessorycom_id', 'accessory.accessory_company')
        ->leftjoin('tb_procedure', 'tb_procedure.procedure_code', 'accessory.accessory_procedure')
        ->paginate(100);
        return $data;
    }

    public static function get_accessory_com(){
        $data = DB::table('accessory_com')->get();
        return $data;
    }

    public static function get_accessory_by_id($id){
        $data = DB::table('accessory')->where('accessory_id', $id)->first();
        return $data;
    }

    public static function insert_accessory($r){
        $count = count($r->accessory_procedure);
        for ($i=0; $i < $count; $i++) {
            $procedure_code     = $r->accessory_procedure[$i];
            if(!isset($procedure_code)){
                continue;
            }

            $data               = DB::table('tb_procedure')->where('procedure_code', $procedure_code)->first();
            $procedure_id       = isset($data) ? $data->procedure_id : 0;

            $val['accessory_name']      = $r->accessory_name;
            $val['accessory_price']     = $r->accessory_price[$i];
            $val['accessory_sale']      = 5;
            $val['accessory_company']   = 5;
            $val['accessory_procedure'] = $procedure_id;
            DB::table('accessory')->insert($val);
        }
    }

    public static function update_accessory($r, $id){
        $val['accessory_name']      = $r->accessory_name;
        $val['accessory_price']     = $r->accessory_price;
        $val['accessory_sale']      = $r->accessory_sale;
        $val['accessory_company']   = $r->accessory_company;
        $val['accessory_procedure'] = $r->accessory_procedure;
        DB::table('accessory')->where('accessory_id', $id)->update($val);
    }
}
