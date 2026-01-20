<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Mongo;

class ADFSController extends Controller
{

    public function index(Request $r)
    {
        $tb_user = Mongo::table('users')
        ->where('email', $r->email)
        ->orwhere('email', strtoupper($r->email))
        ->first();
        if($tb_user!=null){
            $timeend = time() + 2592000; // seconds in month
            logdata('tb_logauth', $tb_user['id'], 'login');
            setcookie("uid", $tb_user['id'], $timeend, "/");
            return redirect('home');
        }else{
            $server = getCONFIG("server");
            $view['urlredirect'] = "$server->urlbase/endoindex/api/adfs/local";
            return view('adfs.nouser', $view);
        }
    }



    public function create(){
        $feature    = getCONFIG("feature");
        $server     = getCONFIG("server");
        if(@$feature->adfs){
            return redirect("$server->urlbase/endoindex/api/adfs/local");
        }else{
            return redirect("login2");
        }
    }



    public function store(Request $r)
    {
        if(isset($r->SAMLResponse)){
            $server = getCONFIG("server");
            $user =  $this->checktoken($r);
            $view['user'] = $user;
            $view['server_adfs'] = $server->adfsurl;





            $tb_user = Mongo::table('users')
            ->where('email', @$user['email'])
            ->orwhere('email', strtoupper(@$user['email']))
            ->first();
            if ($tb_user != null){
                $email = $user['email'];
                return redirect("adfs/$email/edit");
            }else{
                $view['urlredirect'] = "$server->urlbase/endoindex/api/adfs/logout/edit";
                return view('adfs.nouser', $view);
            }
        }

        if (isset($r->event)) {
            $event = $r->event;
            $this->$event($r);

            if($event == 'logout'){
                $tb_user = Mongo::table('users')->where('uid', uid())->first();
                logdata('tb_logauth', $tb_user['id'], 'logout');
                Auth::logout();
                Cookie::forget('user', '/');
                Cookie::forget('uid', '/');
                unset($_COOKIE['user']);
                unset($_COOKIE['uid']);
            }
        }
    }

    public function logout(Request $r)
    {
        Auth::logout();
        Cookie::forget('user', '/');
        Cookie::forget('uid', '/');
        unset($_COOKIE['user']);
        unset($_COOKIE['uid']);
    }



    public function show($id)
    {
        return redirect("adfs/$id");
    }


    public function edit($id)
    {
        if($id=="logout"){
            if(uid()){
                $tb_user = Mongo::table('users')->where('uid', uid())->first();
                logdata('tb_logauth', $tb_user['id'], 'logout');
                Auth::logout();
                Auth::logout();
                Cookie::forget('user', '/');
                Cookie::forget('uid', '/');
                setcookie("uid","",time()-5000000,"/");
            }
            return view("adfs.logout",);
        }
    }


    public function checktoken(Request $r)
    {

        $server = getCONFIG("server");
        $user = array();
        $token = $server->adfstoken;
        $str = $r->SAMLResponse;
        $decodedString = base64_decode($str);
        if(strpos($decodedString,$token)==0){
            return $user;
        };

        $xml = simplexml_load_string($decodedString);
        $data = $xml->Assertion->AttributeStatement;
        foreach ($data->Attribute as $key => $value) {
            $value = (array) $value;
            if ($value['@attributes']['Name'] == 'NameID') {
                $user['name'] = $value['AttributeValue'];
            }
            if ($value['@attributes']['Name'] == 'Email') {
                $user['email'] = $value['AttributeValue'];
            }
        }
        return $user;
    }
}
