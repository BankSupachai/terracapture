<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Procedure;
use App\Models\Department;
use App\Models\Mongo;

class EsignController extends Controller
{
    public function index(){
        $view['users'] = Department::user('doctor');

        return view("EndoCAPTURE.cloud.esign_show",$view);
    }

    public function store(Request $r){
        switch($r->event){
            case "create_sign_doctor"   : $this->create_sign_doctor($r);   break;
            case "check_doctorcode"     : $this->check_doctorcode($r);   break;
        }
    }

    public function show($id){
        $view['mmm'] = "";
        return view("EndoCAPTURE.cloud.esign_complete",$view);
    }


    public function create_sign_doctor($r){
        $datapic    = $r->datapic;

        $val['user_code']       = $r->user_code;
        $val['user_fullname']   = $r->user_fullname;
        $val['hospital_name']   = $r->hospital_name;

        $userCODE = date("Ymd")."_".$r->user_code;


        $myfile     = fopen(htdocs("config/doctor/$userCODE.txt"), "w") or die("Unable to open file!");
        fwrite($myfile, $datapic);
        fclose($myfile);

        DB::table("tb_cloud_esign")->insert($val);

        echo $r->user_id;
    }

    public function check_doctorcode($r){
        $code = @$r->code."";
        $id   = @$r->id."";
        $w[0] = array('user_code', $code);
        $w[1] = array('user_code', '!=', "");
        $check = 'duplicate';
        // 1. check if duplicate
        // 2. check if $user not empty, check if that record is it own record
        $user = Mongo::table('users')->where($w)->first();
        if(!empty($user)){
            if($user['id'] == $id){
                $check = "";
            }
        } else {
            $check = "";
        }
        echo @$check."";
    }





}
