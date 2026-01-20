<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Server;

class Equipment extends Model
{

    public static function  cleardata($r){
        $case_equipment = Mongo::table("case_equipment")
        ->where("comcreate", $r->comcreate)
        ->where("caseuniq", $r->caseuniq)->get();
        foreach($case_equipment as $olddata){
            $olddata = (array) $olddata;
            unset($olddata['eq_id']);
            sleep(1);
            Mongo::table("case_equipment_temp")->insert($olddata);
        }
        Mongo::table("case_equipment")
        ->where("caseuniq", $r->caseuniq)
        ->where("comcreate", $r->comcreate)
        ->delete();
        $arr['equipment']= array();
        Mongo::table("tb_case")
        ->where("caseuniq" , $r->caseuniq)
        ->where("comcreate", $r->comcreate)
        ->update($arr);
    }

    public static function  balance($id){
    
        $sum1 = Server::table("tb_equipment_store")
        ->where("equipment_id" , intval($id))
        ->where("display" , "show")
        ->sum("amount");

        $sum2 = Server::table("case_equipment")
        ->where("eq_id" , intval($id))
        ->sum("amount");
        // dd($sum1 , $sum2);
        $balance = $sum1 - $sum2;

        return $balance;

    }

}
