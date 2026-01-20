<?php

namespace App\Http\Controllers\Capture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Mongo;

use Exception;

class EsignController extends Controller
{
    public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {

        $view['users'] = Department::user('doctor', uid());

        return view('capture.esign',$view);
    }




    public function store(Request $r)
    {
        if(isset($r->event)){
            $event  =   $r->event;
            if($event=="save_sign") {return $this->save_sign($r);}

        }
    }


    public function save_sign($r){
        // if($r->user_code==null){dd("กรุณากรอกรหัส");}

        // $w[0] = array('id','!=',$r->userID);
        // $w[1] = array('user_code',$r->user_code);
        // $user = User::where($w)->count();

        // if($user==0){
        //     rename(htdocs("config/doctor/temp.txt"),htdocs("config/doctor/$r->user_code.txt"));
        //     $val['user_code'] = $r->user_code;
        //     User::where('id',$r->userID)->update($val);
        // }else{
        //     dd("รหัสคุณซ้ำกับแพทย์ท่านอื่น");
        // }
        // dd($r->all());

        // if(isset($r->user_code_esign) && isset($r->user_code_dataurl)){
        //     $this->create_sign_doctor($r->user_code_dataurl, $r->user_code);
        // } else if (isset($r->user_code_esign) && isset($r->user_sign_upload)) {
        //     $this->img_to_dataurl($r->file('user_sign_upload'), $r->user_code);
        // }

        $dataurl = @$r->user_code_dataurl."";
        $user_id = @$r->userID."";
        $user_code = @$r->usercode."";
        if(!empty($r->user_code_esign) && !empty($r->user_code_dataurl)){
            $this->esign_base64($dataurl, $user_id, $user_code);
        }

        if(isset($r->from)){
            return redirect(url("admin/user/$r->userID/edit"));
        } else {
            // dd($r->all());
            return redirect(url("report")."/".$r->caseid);
        }

    }

    public function create_sign_doctor($dataurl, $user_code){
        $sign_data = $dataurl;
        $this_file = fopen(htdocs("config/doctor/$user_code.txt"), "w") or die("Unable to open file!");
        fwrite($this_file, $sign_data);
        fclose($this_file);
        // $this->esign_base64($sign_data, $user_code);
    }

    public function img_to_dataurl($file, $user_code){
        $type    = pathinfo($file->path(), PATHINFO_EXTENSION);
        $dataurl = base64_encode(file_get_contents($file->path()));
        $dataurl = 'data:image/' . $type . ';base64,' . $dataurl;
        $this->create_sign_doctor($dataurl, $user_code);
        // $this->esign_base64($dataurl, $user_code);
    }

    public function esign_base64($dataurl, $user_id, $user_code){
        $u['signature'] = @$dataurl."";
        Mongo::table('users')->where('uid', intval($user_id))->update($u);
        $user = Mongo::table('users')->where('uid', intval($user_id))->first();
        if(!empty($user)){
                if(@$user->user_code."" == ""){
                $u1['user_code'] = $user_code;
                Mongo::table('users')->where('uid', intval($user_id))->update($u1);
            }
        }
    }

    public function get_sign_doctor($user_code){
        $path = htdocs('config')."/doctor/$user_code.txt";
        $str  = '';
        try{
            $file = fopen($path,'r');
            while(!feof($file)){
                $str = fgets($file)."";
            }
            fclose($file);
        } catch (Exception $e){

        }
        return $str;
    }




    public function show(Request $r, $id)
    {
        $view['userID'] = $id;
        $view['user']   = (object) Mongo::table('users')->where('uid', intval($id))->first();
        $view['url']     = url('');
        $view['signed_data'] = isset($view['user']->user_code) ? $this->get_sign_doctor($view['user']->user_code) : null;
        $view['id']     = $r->id;
        if(isset($r->from)){
            $view['from'] = 'admin';
        }


        return view('capture.esign_show',$view);
    }





    public function delfile($filename){
        $file = file_exists(htdocs("config/doctor/$filename"));
        if($file){
            unlink(htdocs("config/doctor/$filename"));
        }
    }


}
