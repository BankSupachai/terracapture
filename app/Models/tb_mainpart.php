<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class tb_mainpart extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = "tb_mainpart";

    public static function get_mainpart_by_procedure_code($procedure_code){
        $data = DB::table('tb_mainpart')->where('mainpart_procedure_code', $procedure_code)->get();
        return $data;
    }




}
