<?php

namespace App\Http\Controllers\Migration;
use App\Http\Controllers\Controller;
use App\Models\Datetime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;

class DateFormatController extends Controller
{

    public function index(){

        $tb_case = Mongo::table("tb_case")
        ->where("appointment_date",null)
        ->get();
        foreach ($tb_case as $data) {
            $data = (object) $data;
            $date_string = $this->date_only($data->case_dateappointment);
            $val['appointment_date'] = $date_string;
            Mongo::table("tb_case")->where("_id" , $data->id)->update($val);
        }


        // dd($check_appoint);
    }




    public function date_only($fulltime){
        $ex = explode(" " , ($fulltime));
        return $ex[0];
    }
}

