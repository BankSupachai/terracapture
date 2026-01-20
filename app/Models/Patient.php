<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Models\Mongo;

class Patient extends Model
{
    use HasFactory;
    public $table = "patient";
    const UPDATED_AT = null;
    const CREATED_AT = null;

    public static function get_patient_by_id($id, $database = 'phpmyadmin')
    {
        $w[] = array('hn', 'like', $id);
        if ($database == 'mongo') {
            $patient = Mongo::table('tb_patient')->where($w)->first();
        } else if ($database == 'server') {
            $patient = Server::table('tb_patient')->where($w)->first();
        } else {
            $patient = DB::table('patient')->where($w)->first();
        }
        return $patient;
    }

    public static function fullname_patient($hn)
    {
        $patient = (object) Mongo::table("tb_patient")->where("hn", $hn)->first();

        $fullname = @$patient->firstname . ' ' .@$patient->middlename .' ' .@$patient->lastname;
        return $fullname;
    }
    public static function first($hn)
    {
        $patient = (object) Mongo::table("tb_patient")->where("hn", $hn)->first();
        return $patient;
    }

    public static function fullname($hn)
    {

        $fullname   = "";
        $patient    = (object) Mongo::table("tb_patient")->where("hn", $hn)->first();
        $fullname   .= @$patient->prefix . ' ';
        $fullname   .= @$patient->firstname. ' ';
        $fullname   .= " ";
        $fullname   .= @$patient->lastname . ' ';
        return $fullname;
    }



    public static function add_patient_excel($data)
    {
        // dd($data);

        $gender = "1";
        if ($data[2] == "หญิง") {
            $gender = "2";
        }

        $tb_patient = Mongo::table("tb_patient")->where("hn", @$data[1])->first();

        if ($tb_patient == null) {
            $arr['patient_id']  = get_last_id('patient_id', 'tb_patient') + 1;
            $arr['createdate']  = @$data[99] . "";
            $arr['regis_date']  = @$data[99] . "";
            $arr['regis_time']  = @$data[99] . "";
            $arr['hn']          = @$data[1] . "";   //hn
            $arr['an']          = @$data[99] . "";
            $arr['citizen']     = @$data[99] . "";
            $arr['pic']         = @$data[99] . "";
            $arr['prefix']      = @$data[99] . "";
            $arr['firstname']   = @$data[3] . "";    //firstname
            $arr['middlename']  = @$data[99] . "";
            $arr['lastname']    = @$data[4] . "";    //lastname
            $arr['gender']      = $gender;
            $arr['nationality'] = @$data[99] . "";
            $arr['birthdate']   = @$data[6] . "";    //birthdate
            $arr['phone']       = @$data[99] . "";
            $arr['email']       = @$data[99] . "";
            $arr['patient_json'] = @$data[99] . "";
            $arr['vip']         = @$data[99] . "";
            $arr['treatment']   = @$data[99] . "";
            Mongo::table('tb_patient')->insert($arr);
        }

        $case = (object) array();

        $case->case_physicians01    = null;
        $case->hn                   = @$data[1];
        $case->meet_date            = @$data[0];
        $case->meet_hour            = "08";
        $case->room                 = "1";
        $case->useropencase         = "1";
        $case->case_procedurecode   = "gi002";
        $val['updatetime']  = date("ymdHis");
        $val['comcreate']   = getCONFIG('admin')->com_name;
        insertCASE($val, $case);
    }
}
