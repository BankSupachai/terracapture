<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
// use DB;
// use App\Models\Mongo;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
// use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
// use Illuminate\Database\Eloquent\Model as Eloquent;
use MongoDB\Laravel\Eloquent\Model as Eloquent;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Passport\HasApiTokens;

// class User extends Authenticatable
class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
    use AuthenticableTrait;
    use Notifiable;
    use CanResetPassword;
    use HasApiTokens;

    const UPDATED_AT = null;

    // protected $fillable   = ['*'];
    // protected $guarded = [];
    protected $hidden     = ['password','remember_token',];
    protected $casts      = ['email_verified_at'=>'datetime',];
    // protected $table      = 'users';
    protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $primaryKey = 'id';


    public static function fullname($uid){
        $name = "";
        if($uid!=null){
            $users =  Mongo::table('users')->where('uid', intval($uid))->first();
            $name = @$users->user_prefix.@$users->user_firstname." ".@$users->user_lastname;
        }
        return $name;
    }

    public static function inarray($arr){
        $user = array();
        if($arr){
            $user = Mongo::table('users')->whereIn('uid',$arr)->get();
        }
        return $user;
    }

    public static function get_doctor(){
        return Mongo::table('users')->where('user_type','doctor')->get();
    }

    public static function group($type){
        // dd(uid());
        $department = Mongo::table('tb_department')->where('department_name',uget("department"))->first();
        $user = Mongo::table('users')
        ->where('user_type',$type)
        ->where('id',$department->department_user)
        ->get();
        return $user;
    }



    public static function id_($id){
        $val = User::where('id',$id)->first();
        return $val;
    }

    public static function add_user_excel($data){

        // user_code


        // 6423ba77e6cc4504a50b6e8f	endocapture01	tb_department1	1	0	admin			#000000	Admin		123		123	admin		admin		$2y$10$dnuo1aTRmoCSS/6D1jq9iObijjssauUltjm62fykFbLlHCQW8r0DS		2023-03-28 11:41:39	2023-05-09 19:13:47	1	0	inactive	["GI"]
        $arr['id']              = get_last_id('id', 'users') + 1;
        $arr['user_type']       = @$data[0]."";
        $arr['name']            = @$data[1]."";
        $arr['user_prefix']     = @$data[2]."";
        $arr['user_firstname']  = @$data[3]."";
        $arr['user_lastname']   = @$data[4]."";
        $arr['user_email']      = @$data[5]."";
        $arr['phone']           = @$data[6]."";
        $arr['email']           = @$data[0].$arr['id'];
        $arr['password']        = bcrypt('123456');
        $arr['created_at']      = Carbon::now()->toDateTimeString();
        $arr['updated_at']      = Carbon::now()->toDateTimeString();
        $arr['opencase']        = 1;
        Mongo::table('users')->insert($arr);

        $tb_department = Mongo::table('tb_department')->where('department_id',1)->first();
        $arr2 = array();
        if(isset($tb_department['department_user'])){
            $arr2 = $tb_department['department_user'];
        }
        array_push($arr2,$arr['id']);

        $val['department_user'] = $arr2;
        Mongo::table('tb_department')->where('department_id',1)->update($val);;


    }



    public static function filter_type_user_in_case($user_in_case,$type){
        
        $arr['doctor_sel'] = [];
        $arr['anesthesia_sel'] = [];
        $arr['nurse_sel']  = [];
        $arr['nurse_anas_sel']  = [];
        $arr['register_sel']  = [];
        $arr['viewer_sel']  = [];
        $arr['nurse_a_select']  = [];
        $arr['sci_sel']  = [];


        foreach (isset($user_in_case)?$user_in_case:[] as $user) {
            $w[] = array('uid', intval($user));
            $data = Mongo::table('users')->where($w)->first();
            if(isset($data->user_type)){
                if($data->user_type == 'doctor'){
                    $arr['doctor_sel'][] = $data;
                }
                if($data->user_type == 'anesthesia'){
                    $arr['anesthesia_sel'][] = $data;
                }
                if($data->user_type == 'nurse'){
                    $arr['nurse_sel'][] = $data;
                }
                if($data->user_type == 'nurse_anas'){
                    $arr['nurse_anas_sel'][] = $data;
                }
                if($data->user_type == 'register'){
                    $arr['register_sel'][] = $data;
                }
                if($data->user_type == 'viewer'){
                    $arr['viewer_sel'][] = $data;
                }
                if($data->user_type == 'nurse_assistant'){
                    $arr['nurse_a_select'][] = $data;
                }
                if($data->user_type == 'scientific'){
                    $arr['sci_sel'][] = $data;
                }
            }
            $w = [];
        }

        return $arr[$type];
    }








}
