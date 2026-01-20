<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCAL extends Model{

    use HasFactory;

    public static function calculate($r){

        // dd($r);
        $arrwork = array();

        $tb_bookset_doctor = Server::table("tb_bookset_doctor")->where('doctor_id',$r->physician)->first();

        //STEP01 ค้นหาว่าวันจันทร์-อาทิตย์ หมอคนนี้ทำงานวันไหนบ้าง
        //ถ้าวันไหนหยุดก็ไม่เอามาร่วมคำนวณ
        $step01     = BookingCAL::step01_workdate($r,$tb_bookset_doctor);
        if(!isset($step01['arrwork'])) {return $arrwork;}
        $arrwork    = $step01['arrwork'];
        $dayinweek  = $step01['dayinweek'];

        // dd($arrwork,$step01);

        //STEP02 ค้นหาว่าแผนกสามารถลงงานได้วันไหนบ้าง
        //มีเงื่อนไขคือเริ่มค้นหาจาก 15 วันหลังจากวันที่ปัจจุบัน
        $step02     = BookingCAL::step02_checkjobsoon($r,$dayinweek,$arrwork);
        $arrwork    = $step02['arrwork'];


        // dd($arrwork);

        //STEP03 คำนวณว่าภาระงานเกินที่กำหนดไว้แล้วหรือยัง
        $step03     = BookingCAL::step03_caljobload($r,$arrwork);
        $arrwork    = $step03['arrwork'];


        return $arrwork;
    }



    public static function step01_workdate($r,$tb_bookset_doctor){
        $arrwork        = array();
        $workdate       = array();
        $dayinweek      = array();

        //เอา null และ array ซ้ำออก
        $procedure  = array_unique(array_filter($r->procedure));
        $procedure  = array_diff( $procedure, ["anes01","anes02","anes03","equ01","equ02","equ03"] );
        $count_procedure= count($procedure);
        if($tb_bookset_doctor==null)    {
            return $arrwork;
        }else{
            $doctor_json    = jsonDecode($tb_bookset_doctor['doctor_json']);
            foreach($doctor_json as $key=>$val){
                if(@$val->work=="true" && $val->procedure!=null){
                    $array_temp = array_intersect($procedure,$val->procedure);
                    $count_temp = count($array_temp);
                    if($count_temp==$count_procedure){
                        $period = $val->period;
                        if(strpos(" $period",$r->period)>0){
                            $workdate[$key]['period']       = $period;
                            $workdate[$key]['procedure']    = $val->procedure;
                            $dayinweek[] = $key;
                        }
                    }
                }
            }
        }

        // dd($r->procedure);

        $step01['arrwork']  = $arrwork;
        $step01['workdate'] = $workdate;
        $step01['dayinweek']= $dayinweek;
        return $step01;
    }

    public static function step02_checkjobsoon($r,$dayinweek,$arrwork){

        // dd($r,$dayinweek,$arrwork);
        $tb_bookset_department  = (object) Server::table('tb_bookset_department')->where('department_code',"GI")->first();
        // $departmentJSON         = jsonDecode($tb_bookset_department['department_json']);
        $startday = 0;

        if($r->urgent=="elective")  {$startday = 0;}
        // dd(Datetime::dayADD($startday));
        $new[]  = ['whereIn','calendar_weekday',$dayinweek];
        $new[]  = ['where','calendar_date','>=',Datetime::dayADD($startday)];
        $tb_bookset_calendar_department =   Server::table('tb_bookset_calendar_department')
                                            ->whereArr($new)
                                            ->orderBy("calendar_date")
                                            ->get();

        // dd($tb_bookset_calendar_department,$dayinweek);

        $i = 0;
        foreach($tb_bookset_calendar_department as $data){
            $data = (object) $data;
            $arrwork[$i]["calendar_date"]   = $data->calendar_date;
            $arrwork[$i]["calendar_weekday"]= $data->calendar_weekday;
            $arrwork[$i]["calendar_roomam"] = isset($data->calendar_roomam) ? $data->calendar_roomam : 0;
            $arrwork[$i]["calendar_roompm"] = isset($data->calendar_roompm) ? $data->calendar_roompm : 0;
            $arrwork[$i]["calendar_roomot"] = isset($data->calendar_roomot) ? $data->calendar_roomot : 0;

            $arrwork[$i]["am"]              = $tb_bookset_department->time_am  * $arrwork[$i]["calendar_roomam"]    * 60;
            $arrwork[$i]["pm"]              = $tb_bookset_department->time_pm  * $arrwork[$i]["calendar_roompm"]    * 60;
            $arrwork[$i]["ot"]              = $tb_bookset_department->time_ot  * $arrwork[$i]["calendar_roomot"]   * 60;
            $arrwork[$i]["am1room"]         = $tb_bookset_department->time_am;
            $arrwork[$i]["pm1room"]         = $tb_bookset_department->time_pm;
            $arrwork[$i]["ot1room"]         = $tb_bookset_department->time_ot;
            $i++;
        }

        // dd($arrwork);

        $step02['arrwork']  = $arrwork;
        return $step02;
    }

    public static function step03_caljobload($r,$arrwork){
        $vacation = array();
        $calendar_doctor    =   Server::table('tb_bookset_calendar_doctor')
                                ->select("calendardoctor_date")
                                ->where("calendardoctor_user_id",$r->physician)
                                ->where("calendardoctor_date",">=",date("Y-m-d"))
                                ->get();
        foreach($calendar_doctor as $k => $v){
            $vacation[] = $v['calendardoctor_date'];
        }

        // dd($arrwork);


        $department         = (object) Server::table('tb_bookset_department')->where('department_code',uget("department"))->first();
        // $json               = jsonDecode($department['department_json']);
        $i = 0;
        foreach($arrwork as $data){
            $canfill    = true;
            $data       = (object) $data;
            // dd($data);
            if (!in_array($data->calendar_date, $vacation)){
                // dd($r,$data->calendar_date, $vacation);
                $canfill    = BookingCAL::canfill_department($r,$canfill,$data,$department);
                $canfill    = BookingCAL::canfill_doctor($r,$canfill,$data,$department);
                // dd($canfill1,$canfill2);
            }else{
                $canfill    = false;
            }
            $arrwork[$i]["canfill"] = $canfill;
            $i++;
        }
        $step03['arrwork'] = $arrwork;
        return $step03;
    }



    public static function canfill_department($r,$canfill, $data,$json){

        // dd($canfill);
        $procedure  = array();
        $period     = $r->period;
        $cal_period = "cal_$r->period";
        $tb_booking =  Server::table("tb_booking")
                        ->select("physician","period","procedure")
                        ->where("period",$period)
                        ->where("date",$data->calendar_date)
                        ->get();

        foreach($tb_booking as $d2){
            $d2 = (object) $d2;
            foreach($d2->procedure as $d3){
                if(isset($procedure[$d3])){
                    $procedure[$d3]++;
                    if($procedure[$d3]>=$json->procedure[$d3]['times'])     {$canfill1=false;}
                    if($procedure[$d3]>=$json->procedure[$d3][$cal_period]) {$canfill2=false;}

                    // dd($procedure[$d3],$json->procedure[$d3]['times']);
                    // dd($procedure[$d3],$json,$canfill1);

                }else{
                    $procedure[$d3]=1;
                }
            }
        }



        //Calculate percents
        $min = 0;
        foreach($procedure as $k4=>$v4){
            if(isset($json->procedure[$k4])){
                $min = $min +($json->procedure[$k4]['min']*$v4);
            }
        }

        if($min!=0){
            $percent = ($min*100) / $data->$period;
            if($percent>100){$canfill=false;}
        }

        // dd($procedure,$percent,$canfill);


        //tb_booksum_department
        $val['date']        = $data->calendar_date;
        $val['period']      = $period;
        $val['min']         = $min;
        $val['procedure']   = $procedure;
        $w[0] = array('date',$val['date']);
        $w[1] = array('period',$val['period']);
        $tb_booksum_department = Server::table("tb_booksum_department")->where($w)->first();
        if($tb_booksum_department==null){
            Server::table("tb_booksum_department")->insert($val);
        }else{
            Server::table("tb_booksum_department")->where($w)->update($val);
        }

        return $canfill;
    }


    public static function canfill_doctor($r,$canfill,$data,$json){
        // dd($canfill);

        $procedure  = array();
        $period     = $r->period;
        $cal_period = "cal_$period";
        $oneroom    = $period."1room";
        $tb_booking =   Server::table("tb_booking")
                        ->select("period","procedure")
                        ->where("date",$data->calendar_date)
                        ->where("period",$period)
                        ->where("physician",$r->physician)
                        ->get();

        foreach($tb_booking as $d2){
            $d2 = (object) $d2;
            foreach($d2->procedure as $d3){
                if(isset($procedure[$d3])){
                    $procedure[$d3]++;
                    // if($procedure[$d3]>=$json->procedure->$d3->times)           {$canfill=false;}
                    // if($procedure[$d3]>=$json->procedure->$d3->$cal_period)     {$canfill=false;}
                }else{
                    $procedure[$d3]=1;
                }
            }
        }

        //Calculate percents
        $min = 0;
        foreach($procedure as $k4=>$v4){
            if(isset($json->procedure[$k4])){
                $min = $min +($json->procedure[$k4]['min']*$v4);
            }
        }

        if($min!=0){
            $percent = ($min*100) / $data->$oneroom;
            if($percent>100){$canfill=false;}
        }

        $val['date']        = $data->calendar_date;
        $val['physician']   = $r->physician;
        $val['period']      = $period;
        $val['min']         = $min;
        $val['procedure']   = $procedure;

        $w[0] = array('date',$val['date']);
        $w[1] = array('period',$val['period']);
        $w[2] = array('physician',$val['physician']);
        $tb_booksum_physician = Server::table("tb_booksum_physician")->where($w)->first();
        if($tb_booksum_physician==null){
            Server::table("tb_booksum_physician")->insert($val);
        }else{
            Server::table("tb_booksum_physician")->where($w)->update($val);
        }

        return $canfill;
    }


}
