<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// use App\Models\Department;
use App\Models\Server;

class Nursemonitor extends Model
{
    use HasFactory;
    protected $table = 'tb_casemonitor';
    const UPDATED_AT = null;





    public static function count_success(){
        $w[0]       = array('monitor_status',"Success");
        $count = Server::table("tb_casemonitor")->where($w)->count();
        return $count;
    }

    public static function count_all(){
        // $w[0]       = array('monitor_status',"Success");
        $count = Server::table("tb_casemonitor")->count();
        return $count;
    }


    public static function list_booking($r){

        // $w[0]       = array('appointment',date);
        $w[0]       = array('monitor_status',"Booking");
        $tb_casemonitor = Server::table('tb_casemonitor')->where($w)->get();

        // $book_all   = nursemonitor::department($w);
        $arr        = array();

        foreach($tb_casemonitor as $book){
            $book = (object) $book;
            $arr[$book->monitor_hn]['hn']           = @$book->monitor_hn;
            $arr[$book->monitor_hn]['timevisit']    = @$book->monitor_timevisit;
            $arr[$book->monitor_hn]['procedure'][]  = @$book->monitor_procedure;
            $arr[$book->monitor_hn]['patientname']  = @$book->monitor_patientname;
            $arr[$book->monitor_hn]['prediagnostic']    = @$book->monitor_prediagnostic;
            $arr[$book->monitor_hn]['doctorname']   = @$book->monitor_doctorname;
            $arr[$book->monitor_hn]['room']         = @$book->monitor_room;
            $arr[$book->monitor_hn]['remark']       = @$book->monitor_remark;
            $arr[$book->monitor_hn]['queue']        = @$book->monitor_queue;
        }


        // dd($arr);


        return $arr;
    }

    public static function list_regis($r){
        $w[]        = array('monitor_status',"!=","Success");
        $w[]        = array('monitor_status',"!=","Recovery");
        $w[]        = array('monitor_status',"!=","Cancel");
        $w[]        = array('monitor_status', '!=', 'delete');
        $w[]        = array('monitor_status',"!=","Operation");
        $w[]        = array('monitor_status',"!=","Discharged");
        $w[]        = array('monitor_status',"!=","Reporting");
        // $w[]        = array('monitor_date',date('Ymd'));
        // $book_all   = nursemonitor::department($w);

        $book_all   = Server::table("tb_casemonitor")->where($w)->get();


        $arr        = array();
        foreach($book_all as $book){
            $book = (object) $book;
            $arr[$book->monitor_hn]['hn']               = @$book->monitor_hn;
            $arr[$book->monitor_hn]['timevisit']        = @$book->monitor_timevisit;
            $arr[$book->monitor_hn]['room']             = @$book->monitor_room;
            $arr[$book->monitor_hn]['location']         = @$book->monitor_location;
            $arr[$book->monitor_hn]['prediagnostic']    = @$book->monitor_prediagnostic;
            $arr[$book->monitor_hn]['procedure'][]      = @$book->monitor_procedure;
            $arr[$book->monitor_hn]['patientname']      = @$book->monitor_patientname;
            $arr[$book->monitor_hn]['doctorname']       = @$book->monitor_doctorname;
            $arr[$book->monitor_hn]['remark']           = @$book->monitor_remark;
        }
        return $arr;
    }

    public static function list_recovery($r){
        $w[]        = array('monitor_status',"Recovery");
        $book_all   = nursemonitor::department($r,$w);
        $arr        = array();
        foreach($book_all as $book){
            $book   = (object) $book;
            $w2[0] = array('monitor_hn',$book->monitor_hn);
            $w2[2] = array('monitor_status', '!=', 'delete');
            $w2[1] = array('monitor_status','!=',"Recovery");
            $tb_casemonitor = Server::table("tb_casemonitor")->where($w2)->first();

            if(@$tb_casemonitor==null){
                $book = (object) $book;
                $arr[$book->monitor_hn]['hn']           = @$book->monitor_hn;
                $arr[$book->monitor_hn]['timevisit']    = @$book->monitor_timevisit;
                $arr[$book->monitor_hn]['room']         = @$book->monitor_room;
                $arr[$book->monitor_hn]['location']     = @$book->monitor_location;
                $arr[$book->monitor_hn]['prediagnostic']    = @$book->monitor_prediagnostic;
                $arr[$book->monitor_hn]['procedure'][]  = @$book->monitor_procedure;
                $arr[$book->monitor_hn]['patientname']  = @$book->monitor_patientname;
                $arr[$book->monitor_hn]['doctorname']   = @$book->monitor_doctorname;
                $arr[$book->monitor_hn]['remark']       = @$book->monitor_remark;
            }
        }
        return $arr;
    }

    public static function list_success($r){
        $w[]        = array('monitor_status',"Success");
        $book_all   = nursemonitor::department($r,$w);
        $arr        = array();
        foreach($book_all as $book){
            $book = (object) $book;
            $arr[$book->monitor_hn]['hn']           = @$book->monitor_hn;
            $arr[$book->monitor_hn]['timevisit']    = @$book->monitor_timevisit;
            $arr[$book->monitor_hn]['room']         = @$book->monitor_room;
            $arr[$book->monitor_hn]['location']     = @$book->monitor_location;
            $arr[$book->monitor_hn]['prediagnostic']    = @$book->monitor_prediagnostic;
            $arr[$book->monitor_hn]['procedure'][]  = @$book->monitor_procedure;
            $arr[$book->monitor_hn]['patientname']  = @$book->monitor_patientname;
            $arr[$book->monitor_hn]['doctorname']   = @$book->monitor_doctorname;
            $arr[$book->monitor_hn]['remark']       = @$book->monitor_remark;
        }
        return $arr;
    }


    public static function list_regis_control($r){
        $w[0]       = array('monitor_status',"Register");
        $book_all   = nursemonitor::department($r,$w);
        $arr        = array();
        foreach($book_all as $book){
            $book = (object) $book;
            $arr[$book->monitor_hn]['hn']           = @$book->monitor_hn;
            $arr[$book->monitor_hn]['timevisit']    = @$book->monitor_timevisit;
            $arr[$book->monitor_hn]['room']         = @$book->monitor_room;
            $arr[$book->monitor_hn]['location']     = @$book->monitor_location;
            $arr[$book->monitor_hn]['prediagnostic']    = @$book->monitor_prediagnostic;
            $arr[$book->monitor_hn]['procedure'][]  = @$book->monitor_procedure;
            $arr[$book->monitor_hn]['patientname']  = @$book->monitor_patientname;
            $arr[$book->monitor_hn]['doctorname']   = @$book->monitor_doctorname;
            $arr[$book->monitor_hn]['remark']       = @$book->monitor_remark;
        }
        return $arr;
    }



    public static function list_room_unselect($r){
        $w[]        = array('monitor_status',"!=","Success");
        $w[]        = array('monitor_status',"!=","Recovery");
        $w[]        = array('monitor_status',"!=","Cancel");
        $w[]        = array('monitor_status',"!=","delete");
        $w[]        = array('monitor_status',"!=","Operation");
        $w[]        = array('monitor_status',"!=","Reporting");
        $w[]        = array('monitor_status',"!=","Discharged");
        $w[]        = array('monitor_room',0);
        $book_all   = nursemonitor::department($r,$w);
        $arr        = array();

        // dd($book_all);
        foreach($book_all as $book){
            $book = (object) $book;
            $arr[$book->monitor_hn]['hn']           = @$book->monitor_hn;
            $arr[$book->monitor_hn]['timevisit']    = @$book->monitor_timevisit;
            $arr[$book->monitor_hn]['room']         = @$book->monitor_room;
            $arr[$book->monitor_hn]['location']     = @$book->monitor_location;
            $arr[$book->monitor_hn]['prediagnostic']    = @$book->monitor_prediagnostic;
            $arr[$book->monitor_hn]['procedure'][]  = @$book->monitor_procedure;
            $arr[$book->monitor_hn]['patientname']  = @$book->monitor_patientname;
            $arr[$book->monitor_hn]['doctorname']   = @$book->monitor_doctorname;
            $arr[$book->monitor_hn]['remark']       = @$book->monitor_remark;
        }
        return $arr;
    }


    public static function department($r,$w){
        $department = NurseMonitor::arr($r->department,'department_procedure');
        foreach($department as $data){
            $procedure = Server::table('tb_procedure')->where('code',$data)->first();
            if($procedure!=null){
                $arr[] = $procedure->name;
            }
        }
        $table = Server::table("tb_casemonitor")->where($w)->wherein('monitor_procedure',$arr)->get();
        // dd($w,$arr);
        return $table;
    }

    public static function procedure($r){
        $department = NurseMonitor::arr($r->department,'department_procedure');
        foreach($department as $data){
            $procedure = Server::table('tb_procedure')->where('code',$data)->first();
            if($procedure!=null){
                $arr[] = $procedure->name;
            }
        }
        return $arr;
    }


    public static function list_remain($r){
        $w[0]       = array('monitor_status','!=',"Booking");
        $w[1]       = array('monitor_status','!=',"Register");
        $w[2]       = array('monitor_status','!=',"Success");
        $w[3]       = array('monitor_status','!=',"Cancel");
        $w[4]       = array('monitor_status','!=',"Recovery");
        $book_all   = nursemonitor::department($r,$w);
        $arr        = array();
        foreach($book_all as $book){
            $book = (object) $book;
            $arr[$book->monitor_hn]['hn']               = @$book->monitor_hn;
            $arr[$book->monitor_hn]['timevisit']        = @$book->monitor_timevisit;

            $room = (object) Server::table('tb_room')->where('room_id',@$book->monitor_room)->first();
            if($room){
                $arr[$book->monitor_hn]['room']         = @$room->room_name."";
            }else{
                $arr[$book->monitor_hn]['room']         = "No Room";
            }

            $arr[$book->monitor_hn]['patientname']      = @$book->monitor_patientname;
            $arr[$book->monitor_hn]['doctorname']       = @$book->monitor_doctorname;
            $arr[$book->monitor_hn]['prediagnostic']    = @$book->monitor_prediagnostic;
            $arr[$book->monitor_hn]['procedure'][]      = @$book->monitor_procedure;
            $arr[$book->monitor_hn]['status'][]         = @$book->monitor_status;
            $arr[$book->monitor_hn]['monitor_id'][]     = @$book->monitor_id;
            if(isset($book->monitor_status)){
                if($book->monitor_status=="Waiting")        {$arr[$book->monitor_hn]['color'][]= "warning";}
                if($book->monitor_status=="Operation")      {$arr[$book->monitor_hn]['color'][]= "info";}
                if($book->monitor_status=="Reporting")      {$arr[$book->monitor_hn]['color'][]= "success";}
            }else{
                $arr[$book->monitor_hn]['color'][]= "warning";
            }

        }
        return $arr;
    }

    public static function location(){
        $location   = file_get_contents("D:/laragon/htdocs/config/project/nurse_monitor_location.txt");
        return $location;
    }

    public static function countcase_doctor_status($doctorname,$status){
        $count = Server::table("tb_casemonitor")
        ->where("monitor_doctorname",$doctorname)
        ->where("monitor_status" ,$status)
        ->where("monitor_display" ,"show")
        ->count();
        return $count;
    }

    public static function countcase_branch_status($branch,$status){
        $count = Server::table("tb_casemonitor")
        ->where("monitor_branch",$branch)
        ->where("monitor_status" ,$status)
        ->where("monitor_display" ,"show")
        ->count();
        return $count;
    }









    public static function percentage_status($countall,$countstatus){
        $num = 0;
        if($countstatus  != 0){
            $num = ($countstatus / $countall) * 100;
        }
        return $num;
    }



    public static function user($r,$type){
        $data = Server::table("users")->whereIn('uid',NurseMonitor::arr($r->department,'department_user'))
        ->orderBy('user_firstname')
        ->where('user_type',$type)
        ->get();
        return $data;
    }

    public static function get_room_type($department, $type)
    {
        $department_rooms = NurseMonitor::arr($department, 'department_room');

        // ตรวจสอบว่ามีค่าหรือไม่
        if (empty($department_rooms)) {
            return collect([]); // ส่งคืนค่า collection ว่าง
        }

        $data = Server::table('tb_room')
            ->whereIn('room_type', [$type])
            ->whereIn('room_id', $department_rooms)
            ->orderBy('room_name')
            ->get();

        return $data;
    }

    public static function userall($r){
        $data = Server::table("users")->whereIn('id',NurseMonitor::arr($r->department,'department_user'))
        ->orderBy('user_firstname')
        ->get();
        return $data;
    }

    public static function room($r){
        $data = Server::table('tb_room')
        ->whereIn('room_type',["capture","recovery"])
        ->whereIn('room_id',NurseMonitor::arr($r->department,'department_room'))
        ->orderby('room_name')
        ->get();



        return $data;
    }

    public static function storage($r){
        $data = Server::table('tb_room')
        ->whereIn('room_type',["storage"])
        ->whereIn('room_id',NurseMonitor::arr($r->department,'department_room'))
        ->get();
        return $data;
    }



    public static function room_ready($r){
        $data = Server::table('tb_room')
        ->where('room_ready',1)
        ->whereIn('room_id',NurseMonitor::arr("GI",'department_room'))
        ->orderby('room_name')
        ->get();
        return $data;
    }

    public static function arr($name,$field)
    {
        $arr=array();
        $department_arr = array();
        $tb_department = Server::table('tb_department')->where("department_name",$name)->first();

        // foreach ($tb_department as $department) {
        //     if(in_array($uid, $department['department_user'])){
        //         $department_arr[] = $department;
        //     }
        // }

        // $tb_department = $department_arr;
        // foreach($tb_department as $data){
        //     $arr = array_merge($arr,$data[$field]);
        // }

        // $arr = array_filter(array_unique($arr));
        // dd($tb_department);
        return @$tb_department->$field;
    }




    // public static function procedure($uid)
    // {
    //     $data = Server::table('tb_procedure')
    //     ->whereIn('code',NurseMonitor::arr($uid,'department_procedure'))
    //     ->get();
    //     return $data;
    // }



    public static function scope($uid)
    {
        $data = Server::table('tb_scope')->whereIn('scope_id',NurseMonitor::arr($uid,'department_scope'))
        ->where('scope_status',"available")
        ->get();
        return $data;
    }






    public static function getuserid($str){
        $doctor_fullname = explode(' ',$str);
        $doctor_lastname = end($doctor_fullname);
        $doctor = Server::table('table')->where('user_lastname',$doctor_lastname)->first();
        return $doctor;
    }


}
