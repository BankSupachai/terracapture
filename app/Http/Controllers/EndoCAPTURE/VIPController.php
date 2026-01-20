<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;



class VIPController extends Controller
{

    public function index(Request $r){



    }

    public function show($id){
        $view['cid'] = $id;
        return view('endocapture.vip.show',$view);
    }


    public function encode($r){
        $tb_case        = DB::table('tb_case')->where('case_id',$r->cid)->first();
        $json           = $tb_case->case_json;
        $jsonDecode     = jsonDecode($json);
        if(isset($jsonDecode->patientname)){
            $base64_step00  = base64_encode($json);
            $str            = $base64_step00;
            $count_step00   = strlen($base64_step00);
            $code           = str_split($r->code);
            $i              = 0;
            foreach($code as $c){
                $num    = ord($c);
                $arr[$i]['start']  = substr($str,0,$num);
                $arr[$i]['center'] = substr($str,$num,$num);
                $arr[$i]['end']    = substr($str,$num*2,$count_step00);
                echo "[$c]$str<br>";
                $k = ($num%2);
                if ($k) {
                    $str = $arr[$i]['start'].$arr[$i]['end'].$arr[$i]['center'];
                }else{
                    $str = $arr[$i]['center'].$arr[$i]['start'].$arr[$i]['end'];
                }
                $i++;
            }
            // echo "<br>$str";
            $val['case_json'] =  $str;
            DB::table('tb_case')->where('case_id',$r->cid)->update($val);
        }
    }

    public function decode($r){
        $tb_case        = DB::table('tb_case')->where('case_id',$r->cid)->first();
        $json           = $tb_case->case_json;
        $jsonDecode     = jsonDecode($json);
        $str            = $json;
        $count_step00   = strlen($str);
        if(!isset($jsonDecode->patientname)){
            $recode = strrev($r->code);
            $code   = str_split($recode);
            $i      = 0;
            foreach($code as $c){
                $num    = ord($c);
                $k      = ($num%2);
                if($k){
                    //เลขคี่
                    $arr[$i]['center']  = substr($str,-1*$num);
                    $arr[$i]['start']   = substr($str,0,$num);
                    $arr[$i]['end']     = substr($str,$num,$count_step00-($num*2));
                    $str = $arr[$i]['start'].$arr[$i]['center'].$arr[$i]['end'];
                }else{
                    //เลขคู่
                    $arr[$i]['center']  = substr($str,$num,$num);
                    $arr[$i]['start']   = substr($str,0,$num);
                    $arr[$i]['end']     = substr($str,$num*2,$count_step00);
                    $str = $arr[$i]['center'].$arr[$i]['start'].$arr[$i]['end'];
                }
                $i++;
            }
            $val['case_json']   = base64_decode($str);
            $casejson           = jsonDecode($val['case_json']);
            if(isset($casejson->patientname)){
                DB::table('tb_case')->where('case_id',$r->cid)->update($val);
                return "success";
            }

        }
    }



    public function store(Request $r){
        // $tb_case = DB::table('tb_case')->where('case_id',$r->cid)->first();

        if(isset($r->event)){
            if($r->event=="encode")     {
                $this->encode($r);
                return redirect(url('home'));
            }
            if($r->event=="decode")     {
               $status =  $this->decode($r);
               if($status=="success"){
                   return redirect(url("loadpic/$r->cid"));
               }else{
                   return redirect(url("vip/$r->cid"));
               }
            }
        }



    }


}
