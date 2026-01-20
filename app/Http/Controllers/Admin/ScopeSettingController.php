<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;
use App\Models\Server;

class ScopeSettingController extends Controller
{
    // public function __construct(Request $r){checklogin();}
    public function index(){

        if(Server::check_connection()){return redirect(url('servererror'));}

        $view['scopes'] = Server::table('tb_scope')->get();
        $view['departments'] = Server::table('tb_department')->get();
        return view('admin.scope.index', $view);
    }

    public function create(){
        $view['type'] = 'ADD';
        $view['departments'] = Server::table('tb_department')->get();
        return view('admin.scope.create', $view);
    }

    public function edit($id){
        $view['type'] = 'EDIT';
        $view['departments'] = Server::table('tb_department')->get();
        $view['scope'] = Server::table('tb_scope')->where('scope_id', intval($id))->first();
        return view('admin.scope.create', $view);

    }

    public function store(Request $r){
        if($r->event){
            if($r->event=='scope_create')                   {return $this->scope_create($r);}
            if($r->event=='scope_edit')                     {return $this->scope_edit($r);}
            if($r->event=='get_masterdata')                 {return $this->get_masterdata($r);}
            if($r->event=='tb_scope_update')                {return $this->tb_scope_update($r);}
        }
    }


    public function tb_scope_update($r){
        $tb_scope = Server::table("tb_scope")->get();
        foreach($tb_scope as $data){
            $tb_scope_update = Server::table("tb_scope_update")->where("scope_id",$data['scope_id'])->first();
            if(isset($tb_scope_update['scope_id'])){

            }else{
                Server::table("tb_scope_update")->insert($data);
            }
        }

        semi_createtemp_masterdata("tb_scope_update");

    }


    public function scope_create($r){
        if(isset($r->scope_serial) && isset($r->scope_brand)){
            $w[0] = array('scope_serial', 'like', '%'.@$r->scope_serial.'%');
            $w[1] = array('scope_brand', 'like', '%'.@$r->scope_brand.'%');
            $tb_scope = Server::table('tb_scope')->where($w)->first();
            if(isset($tb_scope)  && $tb_scope != []){
                return redirect(url('admin/scope'));
            }
        }

        $i = $this->set_scope_array($r);
        $this->add_scope_department($i['scope_department'], $i['scope_id']);
        Server::table('tb_scope')->insert($i);
        Server::table('tb_scope_update')->insert($i);
        semi_createtemp_masterdata("tb_scope");
        $log['scope_id'] = @$i['scope_id'];
        logdata('tb_loguser', uid(), 'add scope', $log);
        return redirect(url('admin/scope'));
    }

    public function scope_edit($r){
        $scope_id      = $r->scope_id;
        $scope_data    = (object) Server::table('tb_scope')->where('scope_id', intval($scope_id))->first();
        $u            = $this->set_scope_array($r, $scope_data);
        Server::table('tb_scope')->where('scope_id', intval($scope_id))->update($u);
        Server::table('tb_scope_update')->where('scope_id', intval($scope_id))->update($u);
        $this->add_scope_department($u['scope_department'], $u['scope_id']);
        semi_createtemp_masterdata("tb_scope");
        $log['scope_id'] = @$u['scope_id'];
        logdata('tb_loguser', uid(), 'edit scope', $log);
        return redirect(url('admin/scope'));
    }

    public function show($id){

    }

    public function set_scope_array($r){
        $i['scope_id']     = isset($r->scope_id) && $r->scope_id != ""  ? intval($r->scope_id) : get_last_id_server('scope_id', 'tb_scope') + 1;
        $i['scope_rfid']   = @$r->scope_rfid."";
        $i['scope_name']   = @$r->scope_name."";
        $i['scope_band']   = @$r->scope_brand."";
        $i['scope_model']  = @$r->scope_model."";
        $i['scope_serial'] = @$r->scope_serial."";
        $i['scope_installdate'] = @$r->scope_installdate."";

        if($r->scope_setting == 'auto_crop'){
            $i['scope_autocrop'] = 'active';
        } else {
            $i['scope_autocrop'] = 'inactive';
        }

        $i['scope_top']     = isset($r->scope_top)    ? @$r->scope_top."" : null;
        $i['scope_bottom']  = isset($r->scope_bottom) ? @$r->scope_bottom."" : null;
        $i['scope_right']   = isset($r->scope_right)  ? @$r->scope_right."" : null;
        $i['scope_left']    = isset($r->scope_left)   ? @$r->scope_left."" : null;
        $i['scope_comment'] = '';
        $i['scope_status']  = ($r->scope_status == 'active') ? 'available' : 'disable';
        $i['scope_comment'] = '';
        $i['scope_type']    = '';

        $i['scope_working_channel']          = '';
        $i['scope_distal_end_diameter']      = '';
        $i['scope_selling_price']            = '';
        $i['scope_warranty_year']            = '';
        $i['scope_contract_warrantee_start'] = '';
        $i['scope_contract_warrantee_end']   = '';
        $i['scope_sale_name']                = '';
        $i['scope_sale_tel']                 = '';
        $i['scope_service_name']             = '';

        $i['scope_department']   = $r->input("department");


        return $i;
    }

    public function add_scope_department($departments, $id){
        $id = intval($id);
        if(isset($departments)){

            // need remove all before add it
            $all_departments = Server::table('tb_department')->get();
            foreach (isset($all_departments)?$all_departments:[] as $d) {
                $d = (object) $d;
                $scope = isset($d->department_scope) ? $d->department_scope : [];
                if (($key = array_search($id, $scope)) !== false || ($key = array_search($id, $scope)) !== false) {
                    unset($scope[$key]);
                }
                $u['department_scope'] = $scope;
                Server::table('tb_department')->where('department_name', $d->department_name)->update($u);
            }
            //

            $tb_department = (object) Server::table('tb_department')->where('department_name', $departments)->first();
            if(isset($tb_department->department_user)){
                $department_scope = $tb_department->department_scope;
                if(is_array($department_scope)){
                    if(in_array($id, $department_scope) || in_array(intval($id), $department_scope)){
                        return;
                    }
                    $department_scope[] = $id;
                } else {
                    $department_scope   = [$id];
                }
            } else {
                $department_scope = [$id];
            }
            $arr['department_scope'] = $department_scope;
            Server::table('tb_department')->where('department_name', $departments)->update($arr);
        }
    }

    public function get_scope_department($scope_id, $departments){
        $scope_departments = [];
        foreach ($departments as $department) {
            $department = (object) $department;
            $department_name = @$department->department_name."";
            $department_scope = isset($department->department_scope) ? $department->department_scope : [];
            if(is_array($department_scope)){
                if(in_array($scope_id, $department_scope)){
                    $scope_departments[] = $department_name;
                }
            }
        }
        return $scope_departments;
    }

    public function check_scope_department($scope_department, $id){
        // delete scope_id from department_scope
        $all_department = Server::table('tb_department')->get();
        foreach ($all_department as $d) {
            $d = (object) $d;
            $ori = $d->department_scope;
            if(in_array($d->department_name, $scope_department) == false){
                if (($index = array_search($id, $ori)) !== false) {
                    unset($ori[$index]);
                }
                $u['department_user'] = (object) $ori;
                Server::table('tb_department')->where('department_name', $d->department_name)->update($u);
            }
        }
    }

    public function get_masterdata($r) {
        $host             = config('database.connections.mongodb.host');
        $database         = config('database.connections.mongodb.database');
        $this_collection  = $r->tb_name;
        $status           = get_master_data($host, $database, $this_collection, 'tb_department');
        return redirect(url('admin').'/scope')->with('status', $status);
    }

}
