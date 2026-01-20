<?php

namespace App\Http\Controllers\Migration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Department;
use App\Models\Mongo;

class UserController extends Controller
{

    public function index(){
        $arr_user = array();
        $users = Mongo::table('users')->get();

        foreach ($users as $data) {
            // $val["id"]              = $data->id;

            $val["user_department"] = array("GI");
            $val['user_status'] = 'active';

            
            Mongo::table("users")->update($val);

            # code...
        }



    }










    // public function index(){
    //     $arr_user = array();
    //     $users = DB::table('users')->get();
    //     foreach ($users as $data) {
    //         // $val["id"]              = $data->id;
    //         $val['uid']             = $data->id;
    //         $val["user_department"] = array("GI");
    //         $val["department"]      = 'GI';
    //         $val["user_status"]     = 'active';
    //         $val["user_code"]       = $data->user_code;
    //         $val["user_type"]       = $data->user_type;
    //         $val["user_branch"]     = $data->user_branch;
    //         $val["practical"]       = $data->practical;
    //         $val["color"]           = $data->color;
    //         $val["name"]            = $data->name;
    //         $val["user_rfid"]       = $data->user_rfid;
    //         $val["user_prefix"]     = $data->user_prefix;
    //         $val["user_firstname"]  = $data->user_firstname;
    //         $val["user_lastname"]   = $data->user_lastname;
    //         $val["user_email"]      = $data->user_email;
    //         $val["user_config"]     = $data->user_config??'';
    //         $val["email"]           = $data->email;
    //         $val["password"]        = $data->password;
    //         $val["remember_token"]  = $data->remember_token;
    //         $val["opencase"]        = $data->opencase;
    //         $val["procedure_json"]  = $data->procedure_json;
    //         $val["created_at"]      = $data->created_at;
    //         $val["updated_at"]      = $data->updated_at;
    //         $val["signature"]       = $this->readsign($data->user_code);

    //         $newuser = Mongo::table("users")
    //         ->where('user_firstname' , $data->user_firstname)
    //         ->where('user_lastname' , $data->user_lastname)
    //         ->first();

    //         if($newuser){
    //             Mongo::table("users")
    //             ->where('user_firstname' , $data->user_firstname)
    //             ->where('user_lastname' , $data->user_lastname)
    //             ->update($val);
    //         }else{
    //             Mongo::table("users")->insert($val);
    //         }


    //         if($data->user_type != 'adfdfsdfsd'){
    //             $arr_user[] = $data->id;
    //         }


    //         # code...
    //     }

    //     Mongo::table("tb_department")->where('department_name', 'GI')->update(['department_user' => $arr_user]);

    // }


    public function show($id){

    }

    public function readsign($code){
        $sign = "";
        if(file_exists("D:/laragon/htdocs/config/doctor/".$code.".txt")){
            $sign = file_get_contents("D:/laragon/htdocs/config/doctor/".$code.".txt");
        }
        return $sign;
    }

    public function create(){
        $tb_scope = Mongo::table("tb_scope")->get();

        dd($tb_scope);
    }



}
