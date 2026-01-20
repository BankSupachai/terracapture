<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;
use App\Models\Server;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Image;


class UserSettingController extends Controller
{
    // public function __construct(Request $r){checklogin();}
    public function index(){
        if(Server::check_connection()){return redirect(url('servererror'));}
        $view['users']          = Server::table('users')->get();
        $view['departments']    = Server::table('tb_department')->get();
        return view('admin.user.index', $view);
    }

    public function store(Request $r)
    {
        if ($r->event == "doctor_create") {
            $this->doctor_create($r);
            return redirect(url('registration') . '/' . $r->id);
        }
        if($r->event == "user_create"){
            $this->user_create($r);
            return redirect(url("admin/user"));
        }
        if($r->event == "user_edit"){
            $this->user_edit($r);
            return redirect(url("admin/user"));
        }
    }

    public function create(){
        $view['type'] = 'ADD';
        $view['departments'] = Server::table('tb_department')->get();
        $url             = str_replace('endoindex', '', url(''));
        $view['img_url'] = $url."store/user/";
        return view('admin.user.create', $view);
    }

    public function edit($id){
        $view['type']   = 'EDIT';
        $view['id']     = $id;
        $view['uid']    = $id;
        $view['departments'] = Server::table('tb_department')->get();
        $view['user'] = (object) Server::table('users')->where('uid', intval($id))->first();
        $url             = str_replace('endoindex', '', url(''));
        $view['img_url'] = $url."store/user/";
        $view['url']     = url('');
        $view['signed_data'] = isset($view['user']->user_code) ? $this->get_sign_doctor($view['user']->user_code) : null;
        return view('admin.user.edit', $view);
    }

    public function show($id){

    }

    public function doctor_create($r){

        $admin      = getCONFIG("admin");
        $comname    = $admin->com_name;

        $w[] = array('user_firstname', $r->user_firstname);
        $w[] = array('user_lastname', $r->user_lastname);

        $tb_users = server::table("users")->where($w)->first();
        if ($tb_users == Null) {

            $temp = Server::table("users")->max("uid");
            $temp++;

            $val['uid']              = $temp;
            $val['user_code']       = $r->user_code;
            $val['color']           = '';
            $val['phone']           = '';
            $val['opencase']        = 1;
            $val['procedure_json']  = '';
            $val['user_type']       = "doctor";
            $val['name']            = "Doctor";
            $val['department']      = uget('department');
            $val['user_status']     = 'active';
            $val['comname']         = $comname;
            $val['user_prefix']     = $r->user_prefix;
            $val['user_firstname']  = $r->user_firstname;
            $val['user_lastname']   = $r->user_lastname;
            $val['created_at']      = Carbon::now()->toDateTimeString();
            $val['email']           = "doctor$temp";
            $val['password']        = Hash::make("123456");

            $local_cid = Mongo::table('users')->insertGetId($val);
            // $cid = server::table('users')->insertGetId($val);

            $local_case = Mongo::table("users")->where('uid', $local_cid)->first();
            // $case = server::table("users")->where('_id', $cid)->first();
            $local_id = $local_case['uid'] ?? '';
            $tb_department = Mongo::table('tb_department')->where('department_name', uget('department'))->first();
            $department_user = (array)$tb_department->department_user ?? [];
            $department_user[] = $temp;
            $u['department_user'] = $department_user;

            Mongo::table('tb_department')->where('department_name', uget('department'))->update($u);
           
            // $id = $case['id'] ?? '';
            // $val2['email'] = "doctor$local_id";
            // $val2['password'] = Hash::make("123456");
            // $val2['opencase'] = 1;
            // server::table("users")->where("uid" , $id)->update($val2);
            // Mongo::table("users")->where("uid", $local_id)->update($val2);
            semi_createtemp_masterdata("users");
            semi_createtemp_masterdata("tb_department");
            $procedure_api = new \App\Http\Controllers\Api\ProcedureController;
            $procedure_api->compartrecord("users", $comname, "id");
            $procedure_api->compartrecord("tb_department", $comname, "department_id");
            // dd($r->all());
            // return redirect("capture/registration/$r->id");
            // dd($id);
        }
    }

    public function lineidtocloud($r){
        $url = "http://endoindex.com/api/user";
        $post["event"] = "userformlocal";
        $post["lineid"] = $r->lindid;
        $res = connectwebPOST($url,$post);
        dd($res);
    }


    public function usertypecreate($r){
        $maxuser            = Server::table("users")->count()+1;
        $arr['username']    = $r->usertype.$maxuser;
        $arr['status']      = true;
        printJSON($arr);
    }


    public function user_create($r){
        // dd($r->all());
        if(isset($r->user_tab)){
            if(isset($r->user_firstname) && isset($r->user_lastname)){
                $w[0] = array('user_firstname', $r->user_firstname);
                $w[1] = array('user_lastname', $r->user_lastname);
                $user = Server::table('users')->where($w)->first();
                if(isset($user)  && $user != []){
                    return redirect(url('admin/user'));
                }
            }
            $user = $r->user_tab;
            $i    = $this->set_user_array($r, $user);
            $this->add_user_department($i['department'], $i['uid']);
            Server::table('users')->insert($i);
            semi_createtemp_masterdata("users");

            $log['create_name'] = $r->user_firstname.' '.$r->user_lastname;
            $log['create_type'] = $i['user_type'];
            logdata('tb_loguser', uid(), 'user create', $log);
        }
        return redirect('admin/user');
    }
    public function user_edit($r){
        if(isset($r->user_code_esign) && isset($r->user_code_dataurl)){
            $this->create_sign_doctor($r->user_code_dataurl, $r->user_code);
        } else if (isset($r->user_code_esign) && isset($r->user_sign_upload)) {
            $this->img_to_dataurl($r->file('user_sign_upload'), $r->user_code);
        }

        $user_id      = $r->id;
        $user         = $r->user_tab;
        $user_data    = (object) Server::table('users')->where('uid', intval($user_id))->first();
        $u            = $this->set_user_array($r, $user, $user_data);
        $this->add_user_department($u['department'], $u['uid']);
        Server::table('users')->where('uid', intval($user_id))->update($u);
        $this->update_doctor_tb_case($u);
        semi_createtemp_masterdata("users");

        $log['edit_name'] = $user_data->user_firstname.' '.$user_data->user_lastname;
        $log['edit_type'] = $u['user_type'];
        logdata('tb_loguser', uid(), 'user edit', $log);
        return redirect('admin/user');
    }

    public function create_sign_doctor($dataurl, $user_code){
        $sign_data = $dataurl;
        $this_file = fopen(htdocs("config/doctor/$user_code.txt"), "w") or die("Unable to open file!");
        fwrite($this_file, $sign_data);
        fclose($this_file);
    }

    public function img_to_dataurl($file, $user_code){
        $type    = pathinfo($file->path(), PATHINFO_EXTENSION);
        $dataurl = base64_encode(file_get_contents($file->path()));
        $dataurl = 'data:image/' . $type . ';base64,' . $dataurl;
        $this->create_sign_doctor($dataurl, $user_code);
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

    public function update_doctor_tb_case($doctor){
        $u['doctorname'] = @$doctor['user_prefix'].@$doctor['user_firstname'].' '.@$doctor['user_lastname']."";
        $u['doctor_eng'] = @$doctor['user_engname'];
        Server::table('tb_case')->where('case_physicians01', $doctor['uid'])->orWhere('case_physicians01', strval($doctor['uid']))->update($u);
    }

    public function set_user_array($r, $user, $user_data=null){
        // dd($r->all() , $user);
        $i['uid']                = isset($r->id) && $r->id != ""  ? $user_data->uid : get_last_id_server('uid', 'users') + 1;
        $i['department']        = isset($r->department)?$r->department:'';
        $i["user_status"]       = $r->input($user."_status");
        $i['comname']           = "endocapture01";
        $i['tablename']         = "tb_department";
        $i['user_code']         = isset($r->user_code)   == false && $r->user_code != ""           ? $user_data->user_code : @$r->user_code."";
        $i["user_type"]         = $r->input($user."_type");
        $i['user_branch']       = isset($r->user_branch) == false && $r->user_branch != ""         ? $user_data->user_branch : @$r->user_branch."";
        $i['practical']         = isset($r->practical)   == false && $r->practical != ""           ? $user_data->practical : @$r->practical."";
        $i['color']             = isset($r->color)       == false && $r->color != ""               ? $user_data->color : @$r->user_color."";
        $i['name_eng']          = isset($r->user_engname) == false && $r->user_engname != ""         ? $user_data->name_eng : @$r->user_engname."";
        $i["name"]              = ($user == 'user') ? ucfirst($r->input($user."_type")) : $r->input("endo_name");
        $i['user_rfid']         = isset($r->user_rfid)      == false && $r->user_rfid != ""      ? $user_data->user_rfid : @$r->user_rfid."";
        $i['user_prefix']       = isset($r->user_prefix)    == false && $r->user_prefix != ""    ? $user_data->user_prefix : @$r->user_prefix."";
        $i['user_firstname']    = isset($r->user_firstname) == false && $r->user_firstname != "" ? $user_data->user_firstname : @$r->user_firstname."";
        $i['user_lastname']     = isset($r->user_lastname)  == false  && $r->user_lastname != "" ? $user_data->user_lastname : @$r->user_lastname."";
        $i['user_email']        = isset($r->user_email)     == false && $r->user_lastname != ""  ? $user_data->user_email : @$r->user_email."";
        $i['user_config']       = isset($r->user_config)    == false && $r->user_config != ""    ? $user_data->user_config : @$r->user_config."";
        $i["email"]             = isset($r->email) == false && $r->email != ""                   ? $user_data->email : $r->input($user."_email");
        $i['phone']             = isset($r->phone) == false && $r->phone != ""                   ? $user_data->phone : @$r->user_phone."";
        $is_same_password       = isset($r->user_password) && isset($user_data->password)        ? ($r->user_password == $user_data->password ): false;
        $i["password"]          = $is_same_password  ? $user_data->password : bcrypt($r->input($user."_password"));// Hash::make($r->input($user."_password"));
        $i['remember_token']    = isset($r->remember_token) == false && $r->remember_token != "" ? $user_data->remember_token : @$r->remember_token."";
        $i['opencase']          = 1;
        $i['procedure_json']    = isset($r->procedure_json) == false && $r->procedure_json != "" ? $user_data->procedure_json  : @$r->procedure_json."";

        if(isset($user_data->name)){
            $i['name']          = $user_data->name;
        }

        if(isset($user_data)){
            $i['updated_at']        = Carbon::now()->toDateTimeString();
        } else {
            $i['created_at']        = Carbon::now()->toDateTimeString();
        }

        if($r->hasFile('user_image')){
            $img  = $r->file('user_image');
            $ext  = $img->getClientOriginalExtension();
            $name = $i['id'].".".$ext;
            $destinationPath = htdocs('store/user');
            $img->move($destinationPath, $name);
            $i['user_pic'] = $name;
        }

        return $i;
    }

    public function add_user_department($departments, $id){
        $id = intval($id);
        if(isset($departments)){

            // need remove all before add it
            $all_departments = Server::table('tb_department')->get();
            foreach (isset($all_departments)?$all_departments:[] as $d) {
                $d = (object) $d;
                $user = isset($d->department_user) ? $d->department_user : [];
                if (($key = array_search($id, $user)) !== false || ($key = array_search($id, $user)) !== false) {
                    unset($user[$key]);
                }
                $u['department_user'] = $user;
                Server::table('tb_department')->where('department_name', $d->department_name)->update($u);
            }
            //

            $tb_department = (object) Server::table('tb_department')->where('department_name', $departments)->first();
            if(isset($tb_department->department_user)){
                $department_user = $tb_department->department_user;
                if(is_array($department_user)){
                    if(in_array($id, $department_user) || in_array(intval($id), $department_user)){
                        return;
                    }
                    $department_user[] = $id;
                } else {
                    $department_user   = [$id];
                }
            } else {
                $department_user = [$id];
            }
            $arr['department_user'] = $department_user;
            Server::table('tb_department')->where('department_name', $departments)->update($arr);
        }
    }







    public function get_masterdata($r) {
        $host             = config('database.connections.mongodb.host');
        $database         = config('database.connections.mongodb.database');
        $this_collection  = $r->tb_name;
        $status           = get_master_data($host, $database, $this_collection, 'tb_department');
        return redirect(url('admin').'/user')->with('status', $status);
    }

}
