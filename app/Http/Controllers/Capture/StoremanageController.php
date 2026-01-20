<?php

namespace App\Http\Controllers\capture;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Fileconfig;
use App\Models\Mongo;
use App\Models\Server;
use App\Models\Department;
use App\Models\Equipment;


class StoremanageController extends Controller
{

    public function index(Request $r)
    {
        $view['files'] = "mmmmm";
        $view['nurse']             = Department::user('nurse', uid());

        $tb_eq = Server::table("tb_equipment_store")->orderBy("_id", "desc")->first();

        $view['tb_eq'] = Server::table("tb_equipment")->get();
        return view('capture.store.index', $view);
    }

    public function create()
    {
        $view['tb_equipment'] = Server::table("tb_equipment")->get();
        $view['nurse']             = Department::userall(uid());
        // dd($view);
        // dd(get_defined_vars());
        return view('capture.store.create', $view);
    }

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }

    public function balance($r)
    {
        $id = $r->id;
        return Equipment::balance($id);
    }

    public function get_valueformselect($r)
    {

        $tb_case_equipment = Server::table("case_equipment")->where("eq_id" , intval($r->eq_id))->first();
        $selfsum = Server::table("case_equipment")->where("caseuniq" , $tb_case_equipment->caseuniq)->sum("amount");
        $resource = Equipment::balance(intval($r->eq_id)) + $selfsum;
        // dd($resource , $selfsum);
        return $resource;

    }




    public function equitment_fill($r)
    {
        // dd($r->all());
            $equitment = $r->equipment;
            $amount = $r->amount;
            $i = 0;
            foreach ($equitment as $key => $value) {
                // dd($value);
                if(isset($value)){
                    if(isset($amount[$i])){
                        $tb_equipment = Server::table("tb_equipment")->where("eq_id",intval($value))->first();
                        $val['name']            = $tb_equipment->name;
                        $val['equipment_id']    = $tb_equipment->eq_id;;
                        $val['amount']          = intval($amount[$i]);
                        $val['datetime']        = date("Y-m-d H:i:s");
                        $val['user_use']        = intval($r->user_use_equitment);
                        $val['display']         = "show";
                        Server::table("tb_equipment_store")->insert($val);

                    }
                }
                $i++;
                # code...
            }
        return redirect(url("storemanage/create"));

    }

    // public function equipment_add($r)
    // {
    //     // dd($r->all());
    //     $val['name']    = $r->equipment_name;
    //     $val['status']          = "active";
    //     $val['user']            = intval($r->user_equitment);

    //     $eid = Server::insertid("tb_equipment", $val);
    //     // dd($eid);
    //     $val2['name']    = $r->equipment_name;
    //     $val2['equipment_id']    = $eid;
    //     $val2['amount']          = intval($r->equipment_amount);
    //     $val2['datetime']        = date("Y-m-d H:i:s");
    //     $val2['display']         = "show";
    //     Server::insertid("tb_equipment_store", $val2);

    //     return redirect(url("storemanage/create"));
    // }

    public function equipment_add($r)
    {

        $eq_id = 1;
        $check_id = Server::table("tb_equipment")->orderBy("eq_id", "desc")->first();
        if($check_id){
            $eq_id = $check_id->eq_id + 1;
        }
        $val['eq_id'] = $eq_id;
        $val['name']    = $r->equipment_name;
        $val['status']          = "active";
        $val['user']            = intval($r->user_equitment);

        Server::table("tb_equipment")->insert($val);

        $val2['name']    = $r->equipment_name;
        $val2['equipment_id']    = $eq_id;
        $val2['amount']          = intval($r->equipment_amount);
        $val2['datetime']        = date("Y-m-d H:i:s");
        $val2['display']         = "show";
        Server::table("tb_equipment_store")->insert($val2);

        return redirect(url("storemanage/create"));
    }




    public function edit($id)
    {

        $view['id'] = $id;
        $view['tb_eq'] = Server::table("tb_equipment_store")
        ->where("equipment_id" , intval($id))
        ->where("display", "show")
        ->get();
        $view['balance'] = Equipment::balance(intval($id));
        return view('capture.store.edit' , $view);
    }




    public function edit_store($r)
    {
        $ck_id = $r->ck_name;
        $eq_id = intval($r->eq_id);

        $val = [
            'status' => $r->check_status,
            'name' => $r->edit_name
        ];
        Server::table("tb_equipment")->where("eq_id", $eq_id)->update($val);

        Server::table("tb_equipment_store")->where("equipment_id", $eq_id)->update(['name' => $r->edit_name]);

        if($ck_id) {
            foreach ($ck_id as $value) {
                Server::table("tb_equipment_store")
                    ->where("equipment_id", intval($value))
                    ->update(['display' => 'hidden']);
            }
        }

        return redirect(url("storemanage/$eq_id/edit"));
    }

    public function show(Request $r) {}

    public function update(Request $r, $id) {}

    public function getBalance(Request $request)
    {
        $balance = Equipment::balance($request->eq_id);
        return response()->json(['balance' => $balance]);
    }
}
