<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\tb_department;
use Illuminate\Support\Facades\DB;

class tb_procedure extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = "tb_procedure";


    public static function get_procedure_by_id($id){
        $tb_procedure = Mongo::table('tb_procedure')->where('code', $id)->first();
        $procedurename = @$tb_procedure->name;
        return $procedurename;
    }



    public static function insert_procedure($r){
        $val['procedure_name']      = $r->procedure_name;
        $val['procedure_scope']     = "";
        $val['procedure_color']     = $r->procedure_color;
        $val['procedure_json']      = "";
        $val['case_recordshow']     = "[]";
        $val['procedure_pdfshow']   = "[]";

        if ($r->hasFile('file')) {
            $image           = $r->file('file');
            $name            = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $name);
            $image           = $r->file('file');
            $name            = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $name);
            $val['procedure_pic'] = $name;
        }else{
            $val['procedure_pic']       = "";
        }
        DB::table('tb_procedure')->insert($val);
    }



    public static function update_procedure($r, $id){
        $json['price_charge']           = $r->price_charge;
        $json['price_procedure']        = $r->price_procedure;
        $json['rtt_government']         = $r->rtt_government;
        $json['rtt_insurance_health']   = $r->rtt_insurance_health;
        $json['rtt_insurance_social']   = $r->rtt_insurance_social;
        $json['rtt_insurance_foreign']  = $r->rtt_insurance_foreign;
        $json['rtt_insurance_life']     = $r->rtt_insurance_life;

        if($r->hasFile('file')){
            $image              = $r->file('file');
            $name               = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath    = public_path('/images/');
            $image->move($destinationPath, $name);
            $val['procedure_pic'] = $name;
        }

        $val['procedure_name']  = $r['procedure_name'];
        $val['procedure_scope'] = $r['procedure_scope'];
        $val['procedure_color'] = $r['procedure_color'];
        $val['procedure_json']  = jsonEncode($json);
        DB::table('tb_procedure')
        ->where('procedure_code', $id)
        ->update($val);
    }

    // tb_procedure_set
    public static function get_procedure_set(){
        $data = DB::table('tb_procedure_set')->get();
        return $data;
    }

    public static function get_procedure_set_not_used($array){
        $data = DB::table('tb_procedure_set')->whereNotIn('sp_file',$array)->get();
        return $data;
    }

    public static function insert_procedure_set($r){
        $data['sp_name'] = $r->sp_name;
        $data['sp_file'] = $r->sp_file;
        DB::table('tb_procedure_set')->insert($data);
        return $data;
    }



    public static function update_procedure_set_by_id($r){
        $data['sp_name']   = $r->sp_name."";
        $data['sp_file']   = $r->sp_file."";
        DB::table('tb_procedure_set')->where('sp_id',$r->sp_id)->update($data);
    }

    public static function delete_procedure_set_by_id($id){
        DB::table('tb_procedure_set')->where('sp_id',$id)->delete();
    }


    // tb_procedure_pdf
    public static function get_procedure_pdf(){
        $data = DB::table('tb_procedure_pdf')->get();
        return $data;
    }

    public static function insert_procedure_pdf($r){
        $data['pdf_name'] = $r->pdf_name;
        $data['pdf_file'] = $r->pdf_file;
        DB::table('tb_procedure_pdf')->insert($data);
        return $data;
    }

    public static function get_procedure_pdf_not_used($array){
        $data = DB::table('tb_procedure_pdf')->whereNotIn('pdf_file',$array)->get();
        return $data;
    }

    // tb_procedure_sub
    public static function get_procedure_sub_by_procedure_id($procedure_id){
        $data = DB::table('tb_procedure_sub') ->where('psub_procedure_id', $procedure_id)->get();
        return $data;
    }

    // tb_procedureicd9
    public static function get_procedureicd9_by_procedure_code($procedure_code){
        $data = DB::table('tb_procedureicd9') ->where('procedure_code',$procedure_code)->get();
        return $data;
    }



}
