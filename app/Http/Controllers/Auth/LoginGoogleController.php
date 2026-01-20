<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Server;
use Carbon\Carbon;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class LoginGoogleController extends Controller
{



    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            return $this->$event($r);
        }
    }

    public function redirect_to_google($r){
        // click button to post to this function
        return Socialite::driver('google')->redirect();
    }


    public function index(){
        dd('index...');
    }

    public function show($id, Request $r){
        if($id == 'callback'){
            return $this->google_callback();
        }
    }

    public function google_callback(){
        try {
            // test login error
            // throw new \Exception('Error');
            $user = Socialite::driver('google')->user();
            $user_data = Mongo::table('users')->where('user_email', $user->email)->first();
            if(isset($user_data)){
                $user_data = (object) $user_data;
                try {
                    if($user_data->user_verified){
                        if($user_data){
                            $timeend = time() + 2592000; // seconds in month
                            setcookie("uid", $user_data->id, $timeend, "/");
                            return redirect('/home');
                        } else {return $this->to_verify();}
                    }
                } catch (\Exception $e) {
                    return $this->to_verify();
                }

            } else {
                $data = $this->set_user_array($user);
                Mongo::table('users')->insert($data);
                return $this->to_verify();
            }

        } catch (Exception $e){
            return redirect('/login')->with('google-error', 'Failed to log in with Google, Please try again');
        }
    }

    public function set_user_array($user){
        $i['id']                = get_last_id_server('id', 'users') + 1;
        $i['department']        = 'GI';
        $i["user_status"]       = 'active';
        $i['comname']           =  getCONFIG('admin')->com_name;
        $i['tablename']         = "tb_department";
        $i['user_code']         = "";
        $i["user_type"]         = 'doctor';
        $i['user_branch']       = "";
        $i['practical']         = "";
        $i['color']             = "#000000";
        $i["name"]              = "Doctor";
        $i['user_rfid']         = "";
        $i['user_prefix']       = "";
        $i['user_firstname']    = @$user->user['given_name']."";
        $i['user_lastname']     = @$user->user['family_name']."";
        $i['user_email']        = @$user->user['email']."";
        $i['user_verified']     = false;
        $i['user_config']       = "";
        $i["email"]             = "doctor".$i['id'];
        $i['phone']             = "";
        $i["password"]          = bcrypt('123456');
        $i['remember_token']    = "";
        $i['opencase']          = 1;
        $i['procedure_json']    = 0;
        $i['created_at']        = Carbon::now()->toDateTimeString();
        return $i;
    }

    public function to_verify(){
        // currently redirect to blank page, user_verified is false, no page yet
        return redirect('/auth/verify');
    }

}