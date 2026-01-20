<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;

class Procedure extends Model
{
    use HasFactory;
    protected $table = 'tb_procedure';
    const UPDATED_AT = null;

    public static function cardshow($case)
    {
        $tb_procedure   = (object) Mongo::table("tb_procedure")->where('code', $case->case_procedurecode)->first();
        return $tb_procedure->case;
    }

    public static function findding($case)
    {
        $tb_procedure = (object) Mongo::table("tb_procedure")->where('code', $case->case_procedurecode)->first();
        return $tb_procedure->mainpart;
    }

    public static function get_procedure_by_id($procedure_id)
    {
        $w[0] = array('procedure_id', $procedure_id);
        $tb_procedure = Mongo::table('tb_procedure')->where($w)->first();
        return $tb_procedure;
    }

    public static function pdfnameshow($procedure){
        $procedure  = (array) $procedure;
        $name       = $procedure['name'];
        if(isset($procedure['pdf']['nameshow'])){
            $name = $procedure['pdf']['nameshow'];
        }
        return $name;
    }

}
