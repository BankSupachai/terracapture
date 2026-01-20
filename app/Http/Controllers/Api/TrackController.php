<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Track\Scope;
use App\Models\Mongo;

class TrackController extends Controller
{
    // capture          กำลังถ่ายรูป
    // precleaning      เตรียมการล้างกล้อง
    // leaktest         เช็ครั่ว
    // manualcleaning   ทำความสะอาดภายนอก
    // aer              ทำความสะอาดด้วยเครื่องล้าง
    // disinfection     แช่น้ำยาฆ่าเชื้อ
    // drying           ทำให้แห้ง
    // storage          เก็บเข้าตู้



    public function show($id, Request $r)
    {
        if(strlen($id)>7){
            $val['temp_text']   = $id;
            Mongo::table('atemp')->insert($val);
            echo "$id";
        }
    }

    public function store(Request $r)
    {
        if(isset($r->event)){
            if($r->event=="rfid_trigger")       {$this->rfid_trigger($r);}
            if($r->event=="rfid_capture")       {$this->rfid_capture($r);}
            if($r->event=="track_capture")      {$this->track_capture($r);}
            if($r->event=="record_cleaning")    {$this->record_cleaning($r);}
            if($r->event=="keep_scope")         {$this->keep_scope($r);}
            if($r->event=="track_right")        {$this->track_right($r); return redirect($r->url_return);}
        }
    }

    public function keep_scope($r){
        // dd($r);
    }

    public function track_right($r){
        if(isset($r->scope_id) && isset($r->user_id)){
            $scope_id = array_unique($r->scope_id);
            foreach($scope_id as $id){
                Scope::trackUPDATE($r,$id);
            }
        }
    }


    public function record_cleaning($r){
        $scope_id = array_unique($r->scope_id);
        foreach($scope_id as $id){
            $this->trackUPDATE($r,$id);
        }
    }





    public function rfid_trigger($r){

        $val['temp_text']   = $r->rfid;
        Mongo::table('atemp')->insert($val);

        $rfid = $r->rfid;


        $data['type']   = "nodata123";
        $tb_user        = (object) Mongo::table('users')->where('user_rfid',$rfid)->first();
        $tb_scope       = (object) Mongo::table('tb_scope')->where('scope_rfid',$rfid)->first();

        if(isset($tb_user->id)){
            $data['type']           = "user";
            $data['id']             = @$tb_user->id;
            $data['user_prefix']    = @$tb_user->user_prefix;
            $data['user_pic']       = @$tb_user->user_pic."?m=".rand(0,99999);
            $data['user_firstname'] = @$tb_user->user_firstname;
            $data['user_lastname']  = @$tb_user->user_lastname;
            $data['room']           = @$r->room;
        }

        if(isset($tb_scope->scope_id)){
            if($tb_scope->scope_status=="available"){
                $data['type']           = "scope";
                $data['id']             = @$tb_scope->scope_id;
                $data['scope_name']     = @$tb_scope->scope_name;
                $data['scope_model']    = @$tb_scope->scope_model;
                $data['scope_serial']   = @$tb_scope->scope_serial;
                $data['room']           = $r->room;
            }else{
                $data['type']           = "Endoscope repair";
            }
        }
        $json = jsonEncode($data);
        echo $json;
    }





    public function rfid_capture($r){
        $data['type']   = "nodata";
        $tb_scope       = Mongo::table('tb_scope')->where('scope_rfid',$r->rfid)->first();

        if($tb_scope!=null){
            $data['type']           = "scope";
            $data['id']             = $tb_scope->scope_id;
            $data['scope_name']     = $tb_scope->scope_name;
            $data['scope_model']    = $tb_scope->scope_model;
            $data['scope_serial']   = $tb_scope->scope_serial;

            $tb_room = Mongo::table('tb_room')->where('room_name',$r->room)->first();
            $val['track_process']   = $tb_room->room_type;
            $val['track_rfid']      = $tb_scope->scope_rfid;
            $val['track_caseuniq']  = $r->caseuniq;
            $val['track_serial']    = $tb_scope->scope_serial;
            $val['track_station']   = $tb_room->room_id;
            $val['track_user']      = $r->userID;
            $val['track_date']      = date('Y-m-d');
            $val['track_time']      = date('H:i:s');

            Mongo::table('tb_casetrack')
            ->where('track_rfid',$tb_scope->scope_rfid)
            ->update(['track_status'=>1]);
            Mongo::table('tb_casetrack')->insert($val);
        }
        $json = jsonEncode($data);
        echo $json;
    }




    public function track_capture($r){
        $data['type']   = "nodata";
        $tb_scope       = Mongo::table('tb_scope')->where('scope_id',$r->scope_id)->first();

        if($tb_scope!=null){
            $data['type']           = "scope";
            $data['id']             = $tb_scope->scope_id;
            $data['scope_name']     = $tb_scope->scope_name;
            $data['scope_model']    = $tb_scope->scope_model;
            $data['scope_serial']   = $tb_scope->scope_serial;

            $tb_room = Mongo::table('tb_room')->where('room_name',$r->room)->first();


            $val['track_process']   = $tb_room->room_type;
            $val['track_rfid']      = $tb_scope->scope_rfid;
            $val['track_caseuniq']  = $r->caseuniq;
            $val['track_serial']    = $tb_scope->scope_serial;
            $val['track_station']   = $tb_room->room_id;
            $val['track_user']      = $r->userID;
            $val['track_date']      = date('Y-m-d');
            $val['track_time']      = date('H:i:s');

            Mongo::table('tb_casetrack')
            ->where('track_rfid',$tb_scope->scope_rfid)
            ->update(['track_status'=>1]);

            $tb_casetrack = Mongo::table('tb_casetrack')
            ->where('track_rfid',$tb_scope->scope_rfid)
            ->where('track_status',0)
            ->first();

            if($tb_casetrack==null){
                Mongo::table('tb_casetrack')->insert($val);
            }
        }

        $json = jsonEncode($data);
        echo $json;
    }






}
