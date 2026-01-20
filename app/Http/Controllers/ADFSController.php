<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Datacase;
use App\Models\Casebooking;
use App\Models\Department;
use App\Models\Mongo;
use MongoDB\BSON\ObjectId;
use PDO;

class ADFSController extends Controller
{

    public function edit($id)
    {
        // dd($_COOKIE);
        $server     = getCONFIG("server");
        $tb_user = Mongo::table('users')
        ->where('email', $id)
        ->orwhere('email', strtoupper($id))
        ->first();
        $local = $_COOKIE['adfsredirect'] ?? "";
        $email = $tb_user['email'];
        if($local=="local"){
            unset($_COOKIE['adfsredirect']);
            return redirect("$server->urlbase/endoindex/api/adfs?email=$email");
        }else{
            $timeend = time() + 2592000; // seconds in month
            logdata('tb_logauth', $tb_user['id'], 'login');
            setcookie("uid", $tb_user['id'], $timeend, "/");
            return redirect('home');
        }
    }

    public function show($id){
        $server = getCONFIG("server");
        setcookie("adfsredirect", $id);
        return redirect("$server->adfsurl");
    }

}
