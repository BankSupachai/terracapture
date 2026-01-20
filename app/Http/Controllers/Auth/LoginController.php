<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Mongo;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';
    protected function redirectTo()
    {
        // dd("sssss");
        if(isset(auth()->user()->email)){
            $w[]    = array('email',auth()->user()->email);
            $w[]    = array('password',auth()->user()->password);
            $user   = DB::table('users')->where($w)->first();
            $data['logindata_user_id'] = $user->id;
            $data['logindata_login_time'] = date('Y-m-d H:i:s');
            Mongo::table('tb_logindata')->insert($data);
        }
        return '/';
    }

    protected function authenticated(Request $r, $user)
    {
        Auth::logoutOtherDevices($r->get('password'));
    }

    public function __construct(Request $r)
    {
        $data['logindata_logout_time'] = date('Y-m-d H:i:s');
        $w[] = array('logindata_logout_time',null);
        $w[] = array('logindata_user_id',$r->userid);
        Mongo::table('tb_logindata')->where($w)->update($data);
        $this->middleware('guest')->except('logout');
    }
}
