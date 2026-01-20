<?php

namespace App\Http\Controllers\Capture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use phpseclib3\Crypt\Hash;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;

class LoginController extends Controller
{
    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $page = $this->$event($r);
        }
        return $page;
    }
    public function index()
    {
        $view['mmmm'] = "";
        // $view['checkpass'] = Hash::check();
        // dd($view['checkpass']);
        return view('capture.login.index', $view);
    }

    public function login($r)
    {
        // dd($r->all());
        $email  = $r->email;
        $pass   = $r->password;
        $user = Mongo::table('users')
                    ->where('email', $email)
                    ->first();

        $view['notsuccess'] = "";

        if ($user != null) {
            $checkpass  = Hash::check($pass, $user->password );

            if ($checkpass) {
                // $checkuser = 1;
                $timeend = time() + 2592000; // seconds in month
                setcookie("uid", $user->uid, $timeend, "/");
                logdata('tb_logauth', $user->uid, 'login');

                // dd($user);
                $authUser = User::where('email', $user->email)->first();
                Auth::login($authUser);
                return redirect('home');
            } else {
                // dd(1);
                $view['notsuccess'] = "ล็อคอินไม่สำเร็จ กรุณาตรวจสอบอีเมลหรือรหัสผ่าน";
                return view("capture.login.index", $view);
            }
        } else {
            // dd(2);

            $view['notsuccess'] = "ล็อคอินไม่สำเร็จ กรุณาตรวจสอบอีเมลหรือรหัสผ่าน";
            return view("capture.login.index", $view);
        }
    }
}

