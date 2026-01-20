<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Server;
class Booking extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $table = "tb_casebooking";


    public static function todaynext(){
        $tb_booking = Server::table('tb_booking')
        ->where('date','>' , date('Y-m-d'))
        ->where('department',uget("department"))
        ->orderby('date','asc')
        ->get();
        // dd($tb_booking);

        return $tb_booking;
    }

    public static function book2cloud($id){
        $hospital                   = getCONFIG("hospital");
        $tb_booking                 = (array) Server::table("tb_booking")->where("_id",$id)->first();
        $user                       = Server::table("users")->where("uid",$tb_booking['physician'])->first();
        $tb_booking['hospitalcode'] = $hospital->hospital_code;
        $tb_booking['doctoremail']  = "";
        $tb_booking['status']       = "wait";
        $tb_booking['uid_line']     = @$user->uid_line."";
        Server::table("tb_book2cloud")->insert($tb_booking);
    }



    public static function add_book_excel($data){
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
        Server::table('users')->insert($arr);
    }


}
