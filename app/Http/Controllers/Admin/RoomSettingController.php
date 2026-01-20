<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;
use App\Models\Server;

class RoomSettingController extends Controller
{
    // public function __construct(Request $r){checklogin();}
    public function index(){

        if(Server::check_connection()){return redirect(url('servererror'));}

        $view['rooms'] = Server::table('tb_room')->get();
        $view['departments'] = Server::table('tb_department')->get();
        return view('admin.room.index', $view);
    }

    public function create(){
        $view['type'] = 'ADD';
        $view['departments'] = Server::table('tb_department')->get();
        return view('admin.room.create', $view);
    }

    public function edit($id){
        $view['type'] = 'EDIT';
        $view['departments'] = Server::table('tb_department')->get();
        $view['room'] = Server::table('tb_room')->where('room_id', intval($id))->first();
        return view('admin.room.create', $view);
    }

    public function show($id){

    }

    public function store(Request $r){
        // dd($r->all());
        if($r->event){
            if($r->event=='room_create')                    {return $this->room_create($r);}
            if($r->event=='room_edit')                      {return $this->room_edit($r);}
            if($r->event=='get_masterdata')                 {return $this->get_masterdata($r);}
        }
    }

    public function room_create($r){
        if(isset($r->room_name)){
            $w[0] = array('room_name', $r->room_name);
            $tb_room = Server::table('tb_room')->where($w)->first();
            if(isset($tb_room)  && $tb_room != []){
                return redirect(url('admin/room'));
            }
        }

        $i    = $this->set_room_array($r);
        $this->add_room_department($i['room_department'], $i['room_id']);
        Server::table('tb_room')->insert($i);
        semi_createtemp_masterdata("tb_room");
        $log['room_id'] = @$i['room_id'];
        logdata('tb_loguser', uid(), 'add room', $log);
        return redirect(url('admin/room'));
    }

    public function room_edit($r){
        $room_id      = $r->room_id;
        $u            = $this->set_room_array($r);
        Server::table('tb_room')->where('room_id', intval($room_id))->update($u);

        // dd($u);
        // dd($r);
        $this->add_room_department($u['room_department'], $u['room_id']);
        $log['room_id'] = @$u['room_id'];
        logdata('tb_loguser', uid(), 'edit room', $log);
        // $this->check_room_department($u['room_department'], $u['room_id']);

        // $this->setdepartment($r);

        semi_createtemp_masterdata("tb_room");
        return redirect(url('admin/room'));
    }

    public function setdepartment($r){
        // $roomid = (int) $r->room_id;
        // $tb_department = Server::table('tb_department')->get();
        // foreach($tb_department as $department){


        //         if($r->room_department!=null){
        //             $temp = $department["department_room"];
        //             foreach($r->room_department as $depart){
        //                 if($depart==)
        //                 array_push($temp,$roomid);

        //             }

        //         }else{
        //             $temp = $department["department_room"];
        //             if (($key = array_search($roomid, $temp)) !== false) {
        //                 unset($temp[$key]);
        //             }
        //         }



        //     $val['department_room'] = array_unique($temp);
        //     Server::table("tb_department")->where("id",$department['department_id'])->update($val);
        // }
    }


    public function set_room_array($r){
        $i['room_id']              = isset($r->room_id) && $r->room_id != ""  ? intval($r->room_id) : get_last_id_server('room_id', 'tb_room') + 1;
        $i['room_department']      = $r->department;
        $i['room_type']            = $r->room_type;
        $i['room_name']            = @$r->room_name."";
        $i['room_storage']         = 0;
        $i['room_color']           = '';
        $i['room_ready']           = @$r->room_ready."";

        if(isset($r->type)){
            if($r->type == 'ADD'){
                $i['room_doctor']          = array();
                $i['room_nurse']           = array();
                $i['room_register']        = array();
            } else {
                $w[] = array('room_id', intval($r->room_id));
                $tb_room = Server::table('tb_room')->where($w)->first();
                $i['room_doctor']          = isset($tb_room->room_doctor)   ? $tb_room->room_doctor   : [];
                $i['room_nurse']           = isset($tb_room->room_nurse)    ? $tb_room->room_nurse    : [];
                $i['room_register']        = isset($tb_room->room_register) ? $tb_room->room_register : [];
            }
        }

        return $i;

    }

    public function get_room_department($room_id, $departments){
        $room_departments = [];
        foreach ($departments as $department) {
            $department = (object) $department;
            $department_name = @$department->department_name."";
            $department_user = isset($department->department_user) ? $department->department_user : [];
            if(is_array($department_user)){
                if(in_array($room_id, $department_user)){
                    $room_departments[] = $department_name;
                }
            }
        }
        return $room_departments;
    }

    public function add_room_department($departments, $id){
        if(isset($departments)){
                // need remove all before add it
            $all_departments = Server::table('tb_department')->get();
            foreach (isset($all_departments)?$all_departments:[] as $d) {
                $d = (object) $d;
                $room = isset($d->department_room) ? $d->department_room : [];
                if (($key = array_search($id, $room)) !== false || ($key = array_search($id, $room)) !== false) {
                    unset($room[$key]);
                }
                $u['department_room'] = $room;
                Server::table('tb_department')->where('department_name', $d->department_name)->update($u);
            }
            //

            $tb_department = (object) Server::table('tb_department')->where('department_name', $departments)->first();
            if(isset($tb_department->department_user)){
                $department_room = $tb_department->department_room;
                if(is_array($department_room)){
                    if(in_array($id, $department_room) || in_array(intval($id), $department_room)){
                        return;
                    }
                    $department_room[] = $id;
                } else {
                    $department_room   = [$id];
                }
            } else {
                $department_room = [$id];
            }
            $arr['department_room'] = $department_room;
            Server::table('tb_department')->where('department_name', $departments)->update($arr);
        }
    }

    public function check_room_department($room_department, $id){
        $all_department = Server::table('tb_department')->get();
        foreach ($all_department as $d) {
            $d = (object) $d;

            // dd($d);
            $ori = $d->department_user;
            if(in_array($d->department_name, $room_department) == false){
                if (($index = array_search($id, $ori)) !== false) {
                    unset($ori[$index]);
                }
                $u['department_room'] = (object) $ori;
                Server::table('tb_department')->where('department_name', $d->department_name)->update($u);
            }
        }
    }

    public function get_masterdata($r) {
        $host             = config('database.connections.mongodb.host');
        $database         = config('database.connections.mongodb.database');
        $this_collection  = $r->tb_name;
        $status           = get_master_data($host, $database, $this_collection, 'tb_department');
        return redirect(url('admin').'/room')->with('status', $status);
    }


}
