<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Date;

class Datacase extends Model
{
    use HasFactory;
    protected $table = 'tb_case';
    const UPDATED_AT = null;

    public static function change($cid, $data)
    {
        Mongo::table("tb_case")->where("_id", $cid)->update($data);
    }

    public static function fromID($id)
    {
        $val = (object) Mongo::table('tb_case')
            ->where('_id', $id)
            ->first();
        return $val;
    }


    public static function otherprocedure($case)
    {
        $data = (object) Mongo::table('tb_case')
            ->select('procedurename', 'id')
            ->where('hn', $case->hn)
            ->where('case_status', '!=', 90)
            ->where('statusjob', '!=', 'delete')
            ->where('statusjob', '!=', 'cancel')
            ->where('id', '!=', $case->id)
            ->where('appointment', @$case->appointment)
            ->orderBy('case_id', 'desc')
            ->get();
        return $data;
    }

    public static function counttoday()
    {
        $data = Mongo::table('tb_case')
            ->where('case_status', '!=', 90)
            ->where('case_dateappointment', 'like', date('Y-m-d') . '%')
            ->count();
        return $data;
    }

    public static function first($id)
    {
        $val = (object) Mongo::table('tb_case')->where('id', $id)->first();
        return $val;
    }

    public static function dataUPDATE($id, $val)
    {
        Mongo::table('tb_case')->where('id', $id)->update($val);
    }

    public static function dataUPDATE2($id, $name, $value)
    {
        $data           = (array) Mongo::table('tb_case')->where('id', $id)->first();
        $data[$name]    = $value;
        unset($data['id']);
        Mongo::table('tb_case')->where('id', $id)->update($data);
    }

    public static function dataINSERT($val)
    {
        Mongo::table('tb_case')->insert($val);
    }

    public static function photoALL($id)
    {
        $tb_case = (object) Mongo::table('tb_case')->where('id', $id)->first();
        return $tb_case->photo;
    }

    public static function jsonUPDATE($id, $name, $data)
    {
        $table      = Mongo::table('tb_case')->where('id', $id)->first();
        $val[$name] = $data;
        Mongo::table('tb_case')->where('id', $id)->update($val);
    }


    public static function getweekday($date)
    {
        $days   = array('sun', 'mon', 'tue', 'wed','thu','fri', 'sat');
        $day    = date('w', strtotime($date));
        return $days[$day];
    }

    public static function getdate($date)
    {
        $date   = explode(' ', $date);
        $ex     = explode("-", $date[0]);
        return $ex[2];
    }

    public static function getmonth($date)
    {
        $date   = explode(' ', $date);
        $ex     = explode("-", $date[0]);
        return $ex[1];
    }

    public static function getyear($date)
    {
        $date   = explode(' ', $date);
        $ex     = explode("-", $date[0]);
        return $ex[0];
    }


    /*
        ยังไม่เสร็จ
        ใช้ try ในกรณีที่คำนวนเวลาไม่สำเร็จ
        และ catch ให้ค่าเป็น $min = 0;
        return ค่าที่คิดเป็นนาทีโดยปัดเศษขึ้น
    */
    public static function timeuse($case){
        $case       = (object) $case;
        $min        = 0;
        $time_start = $case->time_start;
        $time_end   = $case->time_end;
        $min = minuteDiff($time_start, $time_end);
        return $min;
    }


    /*
        ยังไม่เสร็จ
        ให้ลองสร้างเคส ขึ้นมา 3 เคสแล้วทำให้ผลลัพธ์ของการคำนวณเป็น
        เอาเวลา time_patientin แรกสุด มาลบกับ time_end ของเคสท้ายสุด
        return ค่าที่คิดเป็นนาทีโดยปัดเศษขึ้น
    */
    public static function timeroomuse($case){
        $case   = (object) $case;
        $min    = 0;
        $w      = array();
        if(isset($case->appointment_date)){
            $w[]    = array("appointment_date",$case->appointment_date);
        } else if(isset($case->appointment)){
            $date = explode(' ', $case->appointment)[0];
            $w[]    = array("appointment_date", 'like', '%'.$date.'%');
        }

        $w[]    = array("department",$case->department);
        $w[]    = array("case_hn",$case->case_hn);
        $w[]    = array("case_status", "!=", 90);
        $tb_case = Mongo::table("tb_case")->where($w)->get();

        $start  = "";
        $end    = "";
        $flattened_times = [];
        $first_id = '';
        $have_timeuse = false;
        foreach($tb_case as $data){
            $data = (object) $data;
            $first_id = $data->id;
            //กำหนดให้ เวลาที่น้อยที่สุดเอามาบันทึก
            // $start  = $data->time_patientin;
            //กำหนดให้เวลาที่มากสุดเอามาบันทึก
            // $end    = $data->time_end;
            if(!empty($data->time_patientin)){
                $cktime_patientin = static::check_timeformat($data->time_patientin);
                $flattened_times[] = $cktime_patientin;
            }

            if(!empty($data->time_end)){
                $cktime_end = static::check_timeformat($data->time_end);
                $flattened_times[] = $cktime_end;
            }

            if(isset($data->act_timeroomuse)){
                $have_timeuse = true;
            }
        }
        sort($flattened_times);
        $start = reset($flattened_times);
        $end = end($flattened_times);

        $min = 0;
        try {
                $min = minuteDiff($start, $end);
                if($min > 0){
                    $min += 15;
                }
        } catch(\Exception) {}

        $arr['act_timeroomuse'] = $min;
        if(!$have_timeuse){
            Mongo::table('tb_case')->where('_id', $first_id)->update($arr);
        }
        return $min;
    }

    /*
        ในกรณีที่เวลาผิดรูปแบบเช่น 08:45:
    */
    public static function check_timeformat($time) {
        $length = strlen($time);
        if ($length == 5) {
            $time .= ':00';
        } else if($length >=6 && $length <= 7){
            $zero = 8 - $length;
            for ($i=0; $i < $zero; $i++) {
                $time .= '0';
            }
        }
        return $time;
    }

    public static function migrate($is_skip=false){
        $tb_case = Mongo::table('tb_case')->where('case_status', '!=', 90)->get();
        if($is_skip){
            $tb_case = Mongo::table('tb_case')
                ->where('case_status', '!=', 90)
                ->where(function($query){
                    $query->whereNull('act_day')
                        ->orWhere('act_day', '=', '');
                })
                ->get();
        }
        $arr = [];
        foreach (isset($tb_case)?$tb_case:[] as $case) {
            $case = (object) $case;

            if(gettype(@$case->room) == 'array'){
                $room = $case->room;
                $case->room = $room[0] ?? '';
            }

            if(@$case->room."" != ""){
                $roomValue = $case->room;
                $query = [
                    '$or' => [
                        ['room_id' => intval($roomValue)],
                        ['room_id' => $roomValue],
                        ['room_name' => $roomValue]
                    ]
                ];
                $tb_room = (object) Mongo::table('tb_room')->where($query)->first();
                if(isset($tb_room->room_id)){
                    $arr['room_id'] = @$tb_room->room_id;
                    $arr['room_name'] = @$tb_room->room_name;
                }
            }

            if(@$case->case_physicians01."" != ""){
                $users = (object) Mongo::table('users')->where('uid', intval($case->case_physicians01))->orWhere('id', $case->case_physicians01)->first();
                $arr['physician_id'] = @$users->id."";
                $arr['physician_name'] = fullName($users);
            }

            $appointment = @$case->appointment."";
            if($appointment != ""){
                $date = explode(' ', $appointment)[0];
                $arr['act_dayweek']     = static::getweekday($date);
                $arr['act_day']         = static::getdate($appointment);
                $arr['act_month']       = static::getmonth($appointment);
                $arr['act_year']        = static::getyear($appointment);
            }

            if(isset($case->time_start)){
                try{
                    $timestart = new DateTime($case->time_start);
                    $arr['act_timestart'] = $timestart->format('H:00');
                } catch(Exception $e) {$arr['act_timestart'] = '';}
            }

            if(isset($case->time_start) && isset($case->time_end)){
                $arr['act_timeuse'] = static::timeuse($case);
            } else {
                $arr['act_timeuse'] = 0;
            }

            // $arr['act_timeroomuse'] = Datacase::timeroomuse($case);
            Datacase::timeroomuse($case);

            Mongo::table('tb_case')->where('_id', $case->id)->update($arr);
            $arr = [];
        }
    }



}
