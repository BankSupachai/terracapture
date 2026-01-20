<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;

class Note extends Model
{

    public static function first($case){
        $w[] = array('hn',@$case->case_hn);
        $w[] = array('date',@$case->appointment_date);
        $w[] = array('department',@$case->department);

        $note = Mongo::table("tb_casenote")->where($w)->first();
        if($note!=null){
            return (object) $note;
        }else{
            $val['date']        = @$case->appointment_date;
            $val['appointment'] = @$case->appointment;
            $val['hn']          = @$case->case_hn;
            $val['department']  = @$case->department;
            $noteID = Mongo::table("tb_casenote")->insertGetId($val);
            $note   = Mongo::table("tb_casenote")->where("id",$noteID)->first();
            return (object) $note;
        }
    }


    public static function hndate($hn,$date){
        $w[] = array('hn',$hn);
        $w[] = array('date',$date);
        $w[] = array('department',uget("department"));

        $note = Mongo::table("tb_casenote")->where($w)->first();
        if($note!=null){
            return (object) $note;
        }else{
            $val['date']        = $date;
            $val['appointment'] = $date."00:00:00";
            $val['hn']          = $hn;
            $val['department']  = uget("department");
            $noteID = Mongo::table("tb_casenote")->insertGetId($val);
            $note   = Mongo::table("tb_casenote")->where("id",$noteID)->first();
            return (object) $note;
        }
    }



    public static function all_procedure($case){
        $w[] = array('hn',$case->case_hn);
        $w[] = array('appointment_date',$case->appointment_date);
        $w[] = array('department',$case->department);
        $tb_case = Mongo::table("tb_case")->where($w)
        ->select("case_procedurecode")
        ->get();
        $arr = array();
        foreach ($tb_case as $key => $value ) {
            $arr[] = $value->case_procedurecode;
        }
        $procedure_show = array_unique($arr);
        return $procedure_show;
    }

    public static function all_procedurebook($data){
        $arr = array();
        foreach ($data as $value ) {
            if(isset($value)){
                $arr[] = $value;
            }
        }
        $procedure_show = array_unique($arr);
        return $procedure_show;
    }



}
