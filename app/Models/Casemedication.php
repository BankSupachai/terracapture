<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;
use MongoDB\BSON\ObjectID;

class Casemedication extends Model
{
    use HasFactory;
    protected $table = "tb_casemedication";
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public static function checkdata($case,$w){
        $caseuniq_obj               = $case->caseuniq;
        $caseuniq_str               = (string) $case->caseuniq;
        $tb_casemedication          = Mongo::table('tb_casemedication')->where('caseuniq', $caseuniq_str)->orWhere('caseuniq', $caseuniq_obj)->first();
        if(!isset($tb_casemedication)){
            $mval['caseuniq']   = $case->caseuniq;
            $mval['comcreate']  = $case->comcreate;
            $mval['updatetime'] = $case->updatetime;
            insertMEDICATION($mval);
            $tb_casemedication      = Mongo::table('tb_casemedication')->where('caseuniq', $caseuniq_str)->orWhere('caseuniq', $caseuniq_obj)->first();
        }
        return (object) $tb_casemedication;
    }

    public static function get_unitdose(){
        $arr      = array();
        $arr[0]   = 'mg.';
        $arr[1]   = 'ug.';
        $arr[2]   = 'ml.';
        $arr[3]   = 'mcg.';
        return $arr;
    }

    public static function get_histopathology(){
        $arr      = array();
        $arr[0]   = 'Biopsy';
        $arr[1]   = 'Hot biopsy';
        $arr[2]   = 'Polypectomy';
        $arr[3]   = 'Flow Anesthsia';
        return $arr;
    }

}
