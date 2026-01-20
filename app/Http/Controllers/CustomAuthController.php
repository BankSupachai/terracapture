<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;


class CustomAuthController extends Controller
{
    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $page = $this->$event($r);
        }
        return redirect($page);
    }


    public function index()
    {
        $project = configTYPE("admin","project");
        if($project=="capture"){
            return view('capture.login.index');
        }
        return view('auth.login');
    }

    public function login($r)
    {
        $email  = $r->email;
        $pass   = $r->password;

        $user = User::where('email', $email)->first();
        // dd($email,$pass);
        if($user!=null) {
            $check  = Hash::check($pass, $user['password']);
            if($check){
                $timeend = time() + 2592000; // seconds in month
                setcookie("uid", $user['uid'], $timeend, "/");
                logdata('tb_logauth', $user['uid'], 'login');
                Auth::login($user);
                return "home";
            }else{
                return "login";
            }
        }else{
            return "login";
        }
    }

    public function registration(){
        return view('auth.registration');
    }




    public function loginRAMA($r){
        $url                = "http://wsback.rama.mahidol.ac.th/VerifyUser/api/Rama/ITLogin";
        $header[0]          = 'Content-Type:application/json';
        $arr["user"]        = $r->email;
        $arr["password"]    = $r->password;
        $arr["System"]      = "Home-Care";
        $arr["IPAddres"]    = $_SERVER['SERVER_ADDR'];
        $arr["Terminal"]    = "nurse";
        $json               = jsonEncode($arr);
        $str                = connectwebJSON($url,$json,$header);
        if(!$str){return false;}
        $json = jsonDecode($str);
        $json->resultDetails->pass = $r->password;
        session_start();
        $_SESSION['userjson'] = $json;
        return $json->result;
    }




    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = $this->create($data);
        return redirect("dashboard")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Auth::logout();
        return Redirect('login');
    }

    public function logout(){
        Auth::logout();
        Cookie::forget('user', '/');
        Cookie::forget('uid', '/');
        return redirect("login");
    }
    public function logoutcapture(){
        Auth::logout();
        Cookie::forget('user', '/');
        Cookie::forget('uid', '/');
        return redirect("login");
    }
}
