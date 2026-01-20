<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Mongo;

class Department extends Model
{

    use HasFactory;
    protected $table = 'tb_department';


    public static function user($type, $uid=''){
        // $data = Mongo::table("users")->whereIn('id',Department::arr(Auth::id(),'department_user'))
        // ->orderBy('user_firstname')
        // ->where('user_type',$type)
        // ->get();
        $id = Auth::id() !== null ? Auth::id() : uid();

        // dd($uid, Department::arr($uid,'department_user'));

        $data = Mongo::table("users")
        ->whereIn('uid', Department::arr($id,'department_user'))
        ->orderBy('user_firstname')
        ->where('user_type',$type)
        // ->where("user_status","active")
        ->get();




        // dd($data,Department::arr($id,'department_user'),$type);
        // dd('uid', Department::arr($id,'department_user'));
        return $data;
    }
    public static function usernot($type, $uid=''){
        // $data = Mongo::table("users")->whereIn('id',Department::arr(Auth::id(),'department_user'))
        // ->orderBy('user_firstname')
        // ->where('user_type',$type)
        // ->get();
        $id = Auth::id() !== null ? Auth::id() : $uid;
        $data = Mongo::table("users")->whereIn('uid',Department::arr($id,'department_user'))
        ->orderBy('user_firstname')
        ->where('user_type',"!=",   $type)
        ->where('user_type',"!=",   'endo')
        ->where('user_type',"!=",   'nurse')
        ->where("user_status","active")
        ->get();
        return $data;
    }
    public static function userActive($type){
        $data = Mongo::table("users")
        ->orderBy('user_firstname')
        ->where('user_type',$type)
        ->where("user_status","active")
        ->get();
        return $data;
    }




    // public function arrdepart


    public static function server_user($type, $uid=''){
        $id = Auth::id() !== null ? Auth::id() : $uid;
        $data = Server::table("users")->whereIn('uid',Department::server_arr($id,'department_user'))

        ->orderBy('user_firstname')
        ->where('user_type',$type)
        ->get();

        return $data;
    }

    public static function get_room_type($type){
        $data = Mongo::table('tb_room')
        ->whereIn('room_type',[$type])
        ->whereIn('room_id',Department::arr(Auth::id(),'department_room'))
        ->get();
        return $data;
    }

    public static function userall($uid=''){
        $id = Auth::id() !== null ? Auth::id() : $uid;
        $data = Mongo::table("users")->whereIn('uid',Department::arr($id,'department_user'))
        ->orderBy('user_firstname')
        ->get();
        return $data;
    }

    public static function room($uid=''){
        $id = Auth::id() !== null ? Auth::id() : $uid;
        $data = Mongo::table('tb_room')
        ->whereIn('room_type',["capture","recovery"])
        ->whereIn('room_id',Department::arr($id,'department_room'))
        ->orderby('room_name')
        ->get();
        return $data;
    }

    public static function server_room($uid){
        $uid = Auth::id() !== null ? Auth::id() : $uid;
        $data = Server::table('tb_room')
        ->whereIn('room_type',["capture","recovery"])
        ->whereIn('room_id',Department::server_arr($uid,'department_room'))
        ->orderby('room_name')
        ->get();
        return $data;
    }

    public static function storage(){
        $data = Mongo::table('tb_room')
        ->whereIn('room_type',["storage"])
        ->whereIn('room_id',Department::arr(Auth::id(),'department_room'))
        ->get();
        return $data;
    }



    public static function room_ready(){
        $data = Mongo::table('tb_room')
        ->where('room_ready',1)
        ->whereIn('room_id',Department::arr(Auth::id(),'department_room'))
        ->orderby('room_name')
        ->get();
        return $data;
    }

    public static function arr($uid,$field)
    {
        $tb_department = Mongo::table("tb_department")->where("department_name", uget("department"))->first();
        if($tb_department==null){
            $tb_department = Mongo::table("tb_department")->where("department_name","GI")->first();
        }
        return $tb_department->$field;
    }

    public static function server_arr($uid,$field)
    {
        $arr=array();
        $department_arr = array();
        $tb_department = Server::table('tb_department')->get();
        foreach ($tb_department as $department) {
            if(in_array($uid, $department->department_user)){
                $department_arr[] = $department;
            }
        }
        $tb_department = $department_arr;
        foreach($tb_department as $data){
            $arr = array_merge($arr,$data->$field);
        }
        $arr = array_filter(array_unique($arr));

        return $arr;
    }

    public static function procedure($uid)
    {
        $uid = Auth::id() !== null ? Auth::id() : $uid;
        $data = Mongo::table('tb_procedure')
        ->whereIn('code',Department::arr($uid,'department_procedure'))
        ->orderBy('name', 'asc')
        ->get();
        return $data;
    }

    public static function server_procedure($uid)
    {
        $uid = Auth::id() !== null ? Auth::id() : $uid;
        $data = Server::table('tb_procedure')
        ->whereIn('code',Department::server_arr($uid,'department_procedure'))
        ->get();
        return $data;
    }

    public static function scope($uid)
    {
        $data = Mongo::table('tb_scope')->whereIn('scope_id',Department::arr($uid,'department_scope'))
        // ->where('scope_status',"available")
        ->get();
        return $data;
    }

    public static function server_scope($uid)
    {
        $uid = Auth::id() !== null ? Auth::id() : $uid;
        $data = Server::table('tb_scope')->whereIn('scope_id',Department::server_arr($uid,'department_scope'))
        // ->where('scope_status',"available")
        ->get();
        return $data;
    }

    public static function getuserid($str){
        $doctor_fullname = explode(' ',$str);
        $doctor_lastname = end($doctor_fullname);
        $doctor = Mongo::table('table')->where('user_lastname',$doctor_lastname)->first();
        return $doctor;
    }

}
