<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Carbon;
use App\Classes\ReceiptPrinter;
use function GuzzleHttp\json_decode;

class ReadCitizencardController extends Controller
{


    public function index(){
        $exec= exec("D:\DCM_SCU\idcard.pyc");
        $json = jsonDecode($exec);
        $ex = explode(" ",$json->th_name);
        $arr["cid"]         = $json->cid;
        $arr["prefix"]      = $ex[0];
        $arr["firstname"]   = $ex[1];
        $arr["lastname"]    = end($ex);

        if($json->gender==1){
            $arr['gender'] = "ชาย";
        }else{
            $arr['gender'] = "หญิง";
        }
        $arr["dob"]=$json->dob;

        $ex = str_split($arr["dob"]);
        $arr['year'] = $ex[0].$ex[1].$ex[2].$ex[3];
        $arr['month']= $ex[4].$ex[5];
        $arr['day']  = $ex[6].$ex[7];

        $birth_eng = ($arr['year']-543)."-".$arr['month']."-".$arr['day'];
        $arr['age'] = age($birth_eng);

        $jsonencode = jsonEncode($arr);
        echo $jsonencode;
    }


    public function show($id)
    {

    }



}
