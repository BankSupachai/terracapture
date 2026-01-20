<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;
use App\Models\Server;
use Exception;

class DepartmentSettingController extends Controller
{
    // public function __construct(Request $r){checklogin();}
    public function index(){

        if(Server::check_connection()){return redirect(url('servererror'));}

        $view['departments'] = Server::table('tb_department')->get();

        return view('admin.department2.index', $view);
    }

    public function create(){
        $view['type'] = 'ADD';
        return view('admin.department2.create', $view);
    }

    public function edit($id) {
        $view['type']           = 'EDIT';
        $view['department']     = Server::table('tb_department')->where('department_id', intval($id))->first();
        $view['tb_room']        = Server::table("tb_room")->get();
        $view['tb_user']        = Server::table("users")->get();
        $view['tb_scope']       = Server::table("tb_scope")->get();
        $view['tb_procedure']   = Server::table("tb_procedure")->get();
        
        return view('admin.department2.edit', $view);
    }

    public function store(Request $r){
        if($r->event){
            if($r->event=='department_create')                    {return $this->department_create($r);}
            if($r->event=='department_edit')                      {return $this->department_edit($r);}
        }
    }

    public function department_create($r){
        $w[0] = array('department_name', $r->department_name);
        $is_exist = Server::table('tb_department')->where($w)->first();
        if(isset($is_exist) && $is_exist != []){
            return redirect(url('').'/admin/department');
        }

        $i['department_id']        = get_last_id_server('department_id', 'tb_department') + 1;
        $i['department_name']      = @$r->department_name."";
        $i['department_user']      = [];
        $i['department_procedure'] = [];
        $i['department_room']      = [];
        $i['department_scope']     = [];
        $sub['nurse_monitor']      = false;
        $i['department_json']      = $sub;
        $i['department_status']    = $r->department_status;
        Server::table('tb_department')->insert($i);
        return redirect(url('').'/admin/department');
    }

    public function department_edit($r){

        // dd($r->room,$r->scope,$r->user);
        $val['department_name']         = @$r->department_name."";
        $val['department_status']       = $r->department_status;
        $val['department_room']         = $this->intgroup($r->room);
        $val['department_user']         = $this->intgroup($r->user);
        $val['department_scope']        = $this->intgroup($r->scope);
        $val['department_procedure']    = isset($r->procedure)?$r->procedure:[];
        Server::table('tb_department')->where('department_id', intval($r->department_id))->update($val);
        return redirect(url('').'/admin/department');
    }

    public function intgroup($group){
        $arr = array();
        if($group!=null){
            foreach($group as $rr){
                $num = (int) $rr;
                array_push($arr,$num);
            }
        }
        return $arr;
    }

    public function show($id){

    }





}
