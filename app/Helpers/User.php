<?php
use App\Models\Mongo;
use App\Models\Server;
use App\Models\users;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

    function genderCODE($sex){
        $num = "3";
        if($sex =="male")   {$num = "1";}
        if($sex =="ชาย")    {$num = "1";}
        if($sex =="M")      {$num = "1";}
        if($sex =="m")      {$num = "1";}

        if($sex =="female") {$num = "2";}
        if($sex =="f")      {$num = "2";}
        if($sex =="F")      {$num = "2";}
        if($sex =="หญิง")    {$num = "2";}
        return $num;
    }

    function endoversion(){
        $files      = glob("D:\laragon\htdocs\\endoindex\\version\\*.txt"); // get all file names
        $path       = end($files);
        $ex01       = explode("\\",$path);
        $ex02       = explode("_",end($ex01));
        $filename   = $ex02[0];
        return $filename;
    }

    function select_users($data,$fill,$fill_id,$value,$name,$def,$class){
        echo "<select name='".$name."' id='".$name."' class='".$class."'>";

        echo "<option value=''>$def</option>";
        foreach ($data as $dt){
            $dt = (object) $dt;
            echo "<option value='".$dt->$fill_id."'";
            if($dt->$fill_id == $fill){
                echo " selected ";
            }
            echo ">";
            foreach($value as $n){
                echo $dt->$n.' &nbsp; ';
            }
            echo "</option>";
        }

        echo "</select>";
    }

    function patientName($data){
        $name = "";
        if(isset($data->middlename)){
            $name = @$data->firstname." ".@$data->middlename." ".@$data->lastname;
        }else{
            $name = @$data->firstname." ".@$data->lastname;
        }

        return $name;
    }

    function getpatient ($hn){
        $name = "";
        if(isset($hn)){
            $tb_patient = Mongo::table('tb_patient')->where('hn', $hn)->first();
            $tb_patient = (object) $tb_patient;
            $prefix = isset($tb_patient->prefix) ? $tb_patient->prefix : '';
            $firstname = isset($tb_patient->firstname) ? $tb_patient->firstname : '';
            $lastname = isset($tb_patient->lastname) ? $tb_patient->lastname : '';

        $name = $prefix.' '.$firstname.' '.$lastname;
        }


        return $name;
    }

    function fullName($data){
        if(gettype($data) == 'array'){
            $name = @$data['user_prefix'].@$data['user_firstname']." ".@$data['user_lastname'];
        }else{
            $name = @$data->user_prefix.@$data->user_firstname." ".@$data->user_lastname;
        }
        return $name;
    }


    function userSELECT($inputname,$default,$userdata,$find,$attr){
        $str = "<select name='".$inputname."' id='".$inputname."' $attr>";
        $str.= "<option value=''>$default</option>";
        foreach($userdata as $user){
            if($user['id']==$find){
                $selected="selected";
            }else{
                $selected="";
            }
            $str.= "<option value='".$user['id']."' $selected>";
            $str.= $user['user_prefix'];
            $str.= $user['user_firstname']." ";
            $str.= $user['user_lastname'];
            $str.= " ";
            $str.= @$user['user_code'];
            $str.= "</option>";
        }
        $str.= "</select>";
        return $str;
    }

    function userSELECT2($inputname,$default,$userdata,$find,$attr){
        $str = "<select name='".$inputname."' id='".$inputname."' $attr>";
        $str.= "<option value=''>$default</option>";
        foreach($userdata as $user){
            $fullname = $user->user_prefix.$user->user_firstname." ".$user->user_lastname;
            if($fullname==$find){
                $selected="selected";
            }else{
                $selected="";
            }
            $str.= "<option value='$user->id' $selected>";
            $str.= $user->user_prefix;
            $str.= $user->user_firstname." ";
            $str.= $user->user_lastname;
            $str.= " ";
            $str.= @$user->user_code."";
            $str.= "</option>";
        }
        $str.= "</select>";
        return $str;
    }

    function userSELECT3($inputname,$default,$userdata,$find,$attr){
        $str = "<select name='".$inputname."' id='".$inputname."' $attr>";
        $str.= "<option value=''>$default</option>";
        foreach($userdata as $user){
            $user = (object) $user;
            $fullname = $user->user_prefix.$user->user_firstname." ".$user->user_lastname;
            if($user->id==$find){
                $selected="selected";
            }else{
                $selected="";
            }
            $str.= "<option value='$user->id' $selected>";
            $str.= $user->user_prefix;
            $str.= $user->user_firstname." ";
            $str.= $user->user_lastname;
            $str.= " ";
            $str.= @$user->user_code."";
            $str.= "</option>";
        }
        $str.= "</select>";
        return $str;
    }

    function get_disk_size($drive_name, $type='') {
        try {
            $bytes = disk_free_space($drive_name);
            if($bytes != false){
                if ($bytes >= 1073741824) {
                    $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                }
                elseif ($bytes >= 1048576) {
                    $bytes = number_format($bytes / 1048576, 2) . ' MB';
                }
                elseif ($bytes >= 1024) {
                    $bytes = number_format($bytes / 1024, 2) . ' KB';
                }
                elseif ($bytes > 1) {
                    $bytes = $bytes . ' bytes';
                }
                elseif ($bytes == 1) {
                    $bytes = $bytes . ' byte';
                }
                else {
                    $bytes = '0 bytes';
                }


            } else {
                $bytes = 0;
            }
        } catch (Exception $e) {
            $bytes = 'Disk not found';
        }

        return $bytes;
    }

    function get_room_name($room_id){
        $room_name = '';
        $tb_room = (object) Mongo::table('tb_room')->where('room_id', intval($room_id))->first();
        if(isset($tb_room->room_name)){
            $room_name = $tb_room->room_name;
        }
        return $room_name;
    }

    function get_scope_data($scope_data, $field){
        $scope = null;
        if(isset($scope_data)){
            $tb_scope = Mongo::table('tb_scope')->where($field, $scope_data)->first();
            $tb_scope = (object) $tb_scope;
            $scope    = $tb_scope;
        }
        return $scope;
    }

    function get_user_data($staff_id){
        $w[] = array('id', $staff_id);
        $users = Mongo::table('users')->where($w)->first();
        $users = isset($users) ? (object) $users : null;
        return $users;
    }

    function get_user_type($type){
        $type_str = '';
        if($type == 'doctor'){
            $type_str = 'Doctor';
        } else {
            $type_str = 'Nurse';
        }
        return $type_str;
    }

    function get_treatment_name($code){
        $name = '';
        if(isset($code)){
            $tb_treatmentcoverage = (object) Mongo::table('tb_treatmentcoverage')->where('code', $code)->first();
            $name = isset($tb_treatmentcoverage->code) ? $tb_treatmentcoverage->name : '';
        }
        return $name;
    }

    function append_user_name($data, $users){

        try {
            $master = jsonDecode($data);
        } catch (\Throwable $th) {
            $master = array();
        }

        $users = "";
        foreach ($master as $id) {
            $user = get_user_data(intval($id));
            if(isset($user)){
                $name = @$user->user_prefix.@$user->user_firstname.' '.@$user->user_lastname;
                $users = $users.$name.', ';
            }
        }
        return $users;
    }

    function append_user_name_server($data, $users){

        try {
            $master = jsonDecode($data);
        } catch (\Throwable $th) {
            $master = array();
        }

        $users = "";
        foreach ($master as $id) {
            $user = Server::table('users')->where('uid', intval($id))->first();
            if(isset($user)){
                $user = (object) $user;
                $name = @$user->user_prefix.@$user->user_firstname.' '.@$user->user_lastname;
                $users = $users.$name.', ';
            }
        }
        return $users;
    }

    function get_user_data_server($id){
        $users = "";
        if(isset($id)){
            $user = Server::table('users')->where('uid', intval($id))->first();
            if(isset($user)){
                $user = (object) $user;
                $name = @$user->user_prefix.@$user->user_firstname.' '.@$user->user_lastname;
                $users = $users.$name.', ';
            }
        }
        return $users;
    }

    function get_patient_data($hn, $key){
        $patient = Mongo::table('tb_patient')->where('hn', $hn)->first();
        $data = '';
        if(isset($patient)){
            $data = isset($patient->$key) ? $patient->$key : '';
        }
        return $data;
    }

    function get_user_branch($userid){
        $user = Server::table('users')->where('uid', intval($userid))->first();
        return @$user['user_branch'] ?? '';
    }

    function get_user_department($userid){
        $departments = Server::table('tb_department')->get();
        $names = [];
        foreach ($departments as $dep) {
            $dep_user = $dep['department_user'] ?? [];
            if(in_array($userid, $dep_user)){
                $names[] = @$dep['department_name']."";
            }
        }
        $names = join(', ', $names);
        return $names ?? '';
    }

    function get_user_in_room($room_id, $type){
        $main = [];
        $tb_room = Mongo::table('tb_room')->where('room_id', intval($room_id))->first();
        if(isset($tb_room)){
            $tb_room = (object) $tb_room;
            $userinroom = @$tb_room->room_user;
            foreach ($userinroom ?? [] as $user) {
                $tb_user = Mongo::table('users')->where('uid', $user)->first();
                $tb_user = (object) $tb_user;
                if($type == 'doctor' && @$tb_user->user_type == 'doctor'){
                    $main[] = fullName($tb_user);
                }
                if($type == 'nurse' && @$tb_user->user_type == 'nurse'){
                    $main[] = fullName($tb_user);
                }
                if($type == 'nurse assist' && @$tb_user->user_type == 'nurse assist'){
                    $main[] = fullName($tb_user);
                }
            }
        }
        return $main;
    }

    function get_data_cookie($r){
        if($r->cookie('user') !== null){
            $user = (object) Mongo::table('users')->where('id', strval($r->cookie('user')))->first();
        } else {
            $user = array();
        }
        $r->cookie = $user;
        return $r;
    }


    function checklogin(){

        $project = configTYPE("admin","project");
        if(isset($_COOKIE['uid'])){
            return true;
        }

        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-3600, '/');
                unset($_COOKIE[$name]);
            }
        }

        if($project == "capture"){
            header( "location: ".url("login"));
        }else{
            header( "location: ".url("login"));
        }
        exit(0);
    }

    function uid(){
        $uid = null;
        if(isset($_COOKIE['uid'])){
            $uid = (int) $_COOKIE['uid'];
            // dd($uid);
            return $uid;
        }
        return $uid;
    }

    function uget($field){
        if(isset($_COOKIE['uid'])){
            $uid = (int) $_COOKIE['uid'];
            $user = Mongo::table("users")->where("uid",$uid)->first();
            if(isset($user->$field)){
                $val = $user->$field;
            }else{
                $val = "";
            }
            return $val;
        }else{
            return "";
        }
    }

    function login_lumina(){
        $is_recorder = get_config_scope();
        if($is_recorder){
            $uconfig = get_key_config('username', 'lumina');
            $user = User::where('email', $uconfig)->first();
            if(isset($user)){
                Auth::login($user);
                $timeend = time() + 2592000; // seconds in month
                setcookie("uid", $user['id'], $timeend, "/");
                $_COOKIE['uid'] = $user['id'];
            }
        }
    }
