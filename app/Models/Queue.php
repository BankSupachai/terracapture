<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Queue extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'tb_queue';
    const UPDATED_AT = null;

    public static function clearnotdate(){
        Mongo::table('tb_queue')->where('q_date','!=',date('Y-m-d'))->delete();
    }


    public static function status($status){
        $w[0]   = array('q_status',$status);
        $data   = queue::where($w)->get();
        return $data;
    }

    public static function queueall(){
        $w[0] = array('q_department','GI');
        $val = Mongo::table('tb_queue')->where($w)->count();
        return $val;
    }

    public static function queuelist($code){
        $val = Mongo::table('tb_queue')->where('q_type',$code)->get();
        return $val;
    }

    public static function typedetail($code){
        $val = (object) Mongo::table('tb_queuetype')->where('qtype_code',$code)->first();
        return $val;
    }

    public static function typehold($code){
        $w[0] = array('q_type',$code);
        $w[1] = array('q_status','hold');
        $w[2] = array('q_skip','!=','true');
        $tb_queue = Mongo::table('tb_queue')->where($w)->first();
        if($tb_queue!=null && $tb_queue != []){
            $tb_queue       = (object) $tb_queue;
            $val['button1'] = "none";
            $val['button3'] = "show";
            $val['id']      = $tb_queue->q_id;
            $val['number']  = $tb_queue->q_number;
        }else{
            $val['button1'] = "show";
            $val['button3'] = "none";
            $val['id']      = "0";
            $val['number']  = "0";
        }

        return $val;
    }

    public static function typecount($code){
        $w[0] = array('q_type',$code);
        $w[1] = array('q_status','!=','cancel');
        $w[2] = array('q_status','!=','success');
        $w[4] = array('q_status','!=','operation');
        $w[5] = array('q_status','!=','recovery');
        $val = Mongo::table('tb_queue')->where($w)->count();
        return $val;
    }

    public static function queuetype($id){
        $tb_queuetype = Mongo::table('tb_queuetype')
        ->orderby("qtype_id")
        ->get();
        $arr = array();
        foreach($tb_queuetype as $data){
            $data = (object) $data;
            $code = $data->qtype_code;
            $arr[$code]['code']     = $code;
            $arr[$code]['name']     = $data->qtype_name;
            $arr[$code]['textpatient'] = $data->qtype_textpatient;

            $w[0] = array('q_type',$code);
            $arr[$code]['countall']    = Mongo::table('tb_queue')->where($w)->count();

            $w[1] = array('q_status','!=','cancel');
            $w[2] = array('q_status','!=','success');
            $w[4] = array('q_status','!=','operation');
            $w[5] = array('q_status','!=','recovery');
            $arr[$code]['count']    = Mongo::table('tb_queue')->where($w)->count();

            $w2[0] = array('q_type',$code);
            $w2[1] = array('q_skip','true');
            $arr[$code]['countskip']    = Mongo::table('tb_queue')->where($w2)->count();
            $w2[1] = array('q_status','cancel');
            $arr[$code]['countcancel']    = Mongo::table('tb_queue')->where($w2)->count();

            if($code==$id){
                $arr[$code]['active'] = "";
            }else{
                $arr[$code]['active'] = "-s";
            }
            $w = array();
            $w2 = array();
        }
        return $arr;
    }

    public static function count($status){
        $w[0]   = array('q_status',$status);
        $data   = Mongo::table('tb_queue')->where($w)->count();
        return $data;
    }

    public static function countall($type){
        $w[0]   = array('q_type',$type);
        $data   = Mongo::table('tb_queue')->where($w)->count();
        return $data;
    }








    public static function dataARRAY($code,$status,$skip){
        $w[0]   = array('q_type',$code);
        $w[1]   = array('q_skip',$skip);
        if($status!=false){$w[2] = array('q_status',$status);}
        $data   = Mongo::table('tb_queue')->where('q_date',date('Y-m-d'))->where($w)->get();
        $i      = 0;
        $arr = array();
        foreach($data as $q){
            $q          = (object) $q;
            $time       = Carbon::parse($q->q_start);
            $class      = 'bg-success text-white';
            $start      = date_create($q->q_start);
            $end_temp   = date('Y-m-d H:i:s');
            $end        = date_create($end_temp);
            $diff       = date_diff($end,$start);
            $count_time = $diff->format("%H ชั่วโมง %i นาที");
            $hour       = $diff->format("%H");
            $minute     = $diff->format("%i");
            $arr['queue'][$i]['q_id']           = $q->q_id;
            $arr['queue'][$i]['q_status']       = $q->q_status;
            $arr['queue'][$i]['q_type']         = $q->q_type;
            $arr['queue'][$i]['q_tel']          = @$q->q_tel."";
            $arr['queue'][$i]['q_number']       = @$q->q_number."";
            $arr['queue'][$i]['q_statustext']   = @$q->q_statustext."";
            $arr['queue'][$i]['q_hn']           = @$q->q_hn."";

            $patient = Mongo::table('tb_patient')->where('hn',$q->q_hn)->first();
            if($patient!=null && $patient != []){
                $patient  = (object) $patient;
                $arr['queue'][$i]['q_patientname']  = $patient->prefix.$patient->firstname." ".$patient->lastname;
            }else{
                $arr['queue'][$i]['q_patientname']  = "No Name";
            }



            $arr['queue'][$i]['hour']           = $hour;
            $arr['queue'][$i]['minute']         = $minute;
            $arr['queue'][$i]['class']          = $class;
            $arr['queue'][$i]['q_start']        = $count_time;
            $i++;
        }
        $arr['url'] = url('');
        if(!isset($arr['queue'])){
            $arr['queue'] = array();
        }
        return $arr;
    }


    public static function queuecalllist(){
        $w[0] = array('callcurrent_date','!=',date('Y-m-d'));
        Mongo::table('tb_queuecallcurrent')->where($w)->delete();

        $data   = Mongo::table('tb_queuecallcurrent')
        ->limit(6)
        ->orderby('callcurrent_time','desc')
        ->get();

        $i      = 0;
        $arr = array();
        foreach($data as $q){
            $q = (object) $q;
            $tb_queuetype = (object) Mongo::table('tb_queuetype')->where('qtype_code',$q->callcurrent_qtype)->first();
            $arr['queue'][$i]['q_type']     = $tb_queuetype->qtype_textpatient;
            $arr['queue'][$i]['q_number']   = $q->callcurrent_number;
            $i++;
        }
        return $arr;
    }


    public static function dataARRAY2($status,$skip){
        $w[1]   = array('q_skip',$skip);
        if($status!=false){$w[2] = array('q_status',$status);}
        $data   = Mongo::table('tb_queue')
        ->where('q_datetime',date('Y-m-d'))
        ->where($w)
        ->get();
        $i      = 0;
        $arr = array();
        foreach($data as $q){
            $q          = (object) $q;
            $time       = Carbon::parse($q->q_start);
            $class      = 'bg-success text-white';
            $start      = date_create($q->q_start);
            $end_temp   = date('Y-m-d H:i:s');
            $end        = date_create($end_temp);
            $diff       = date_diff($end,$start);
            $count_time = $diff->format("%H ชั่วโมง %i นาที");
            $hour       = $diff->format("%H");
            $minute     = $diff->format("%i");

            $tb_queuetype = (object) Mongo::table('tb_queuetype')->where('qtype_code',$q->q_type)->first();
            $arr['queue'][$i]['q_station']  = $tb_queuetype->qtype_textpatient;


            $arr['queue'][$i]['q_id']           = $q->q_id;
            $arr['queue'][$i]['q_status']       = $q->q_status;
            $arr['queue'][$i]['q_type']         = $q->q_type;
            $arr['queue'][$i]['q_tel']          = $q->q_tel;
            $arr['queue'][$i]['q_number']       = $q->q_number;
            $arr['queue'][$i]['q_statustext']   = $q->q_statustext;
            $arr['queue'][$i]['q_hn']           = $q->q_hn;
            $arr['queue'][$i]['q_patientname']  = "No Name";
            $arr['queue'][$i]['hour']           = $hour;
            $arr['queue'][$i]['minute']         = $minute;
            $arr['queue'][$i]['class']          = $class;
            $arr['queue'][$i]['q_start']        = $count_time;
            $i++;
        }
        $arr['url'] = url('');
        if(!isset($arr['queue'])){
            $arr['queue'] = array();
        }
        return $arr;
    }




    public static function dataARRAYstatustext($status,$skip){
        $w[0]   = array('q_statustext',$status);
        $w[1]   = array('q_skip',$skip);
        $data   = Mongo::table('tb_queue')->where('q_datetime',date('Y-m-d'))->where($w)->get();
        $i      = 0;

        $arr = array();
        foreach($data as $q){
            $q          = (object) $q;
            $time       = Carbon::parse($q->q_start);
            $class      = 'bg-success text-white';
            $start      = date_create($q->q_start);
            $end_temp   = date('Y-m-d H:i:s');
            $end        = date_create($end_temp);
            $diff       = date_diff($end,$start);
            $count_time = $diff->format("%H ชั่วโมง %i นาที");
            $hour       = $diff->format("%H");
            $minute     = $diff->format("%i");
            if($q->q_skip=="true"){$class = 'bg-light text-dark';}

            $arr['queue'][$i]['style']          = "";

            if($q->q_statustext!="พักฟื้น" && $q->q_status=="operation_current")
            {$arr['queue'][$i]['style']="display:none";}

            $arr['queue'][$i]['q_id']           = $q->q_id;
            $arr['queue'][$i]['q_status']       = $q->q_status;
            $arr['queue'][$i]['q_type']         = $q->q_type;
            $arr['queue'][$i]['q_number']       = $q->q_number;
            $arr['queue'][$i]['q_statustext']   = $q->q_statustext;
            $arr['queue'][$i]['q_hn']           = $q->q_hn;
            $arr['queue'][$i]['hour']           = $hour;
            $arr['queue'][$i]['minute']         = $minute;
            $arr['queue'][$i]['class']          = $class;
            $arr['queue'][$i]['q_start']        = $count_time;
            $i++;
        }

        if(!isset($arr['queue'])){
            $arr['queue'] = array();
        }

        return $arr;
    }




}
