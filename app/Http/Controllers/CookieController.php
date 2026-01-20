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

class CookieController extends Controller
{

    public function edit($id)
    {

    }

    public function show($id){
        foreach ($_COOKIE as $name => $value) {
            setcookie($name, '', time() - 3600, '/');
            unset($_COOKIE[$name]);
        }
        echo "<script>
            setTimeout(function() {
                window.location.href = '".url("home")."';
            }, 2000);
        </script>";
        // return redirect("login");
    }

}
