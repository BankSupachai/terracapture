<?php

namespace App\Http\Controllers\capture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Datacase;
use App\Models\Department;
use App\Models\Mongo;
use App\Models\Server;
use App\Models\Equipment;
class StoreController extends Controller
{

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }

    public function show($id, Request $r)
    {
        if (Server::check_connection()) {
            return redirect(url('servererror'));
        }


        $view['cid']            = $id;
        $view['case']           = Datacase::fromID($id);
        $view['tb_procedure']   = Department::procedure(uid());
        $view['tb_equipment']   = Server::table("tb_equipment")
        ->where("status" , "active")
        ->get();
        $view['users']          = Server::table("users")->get();
        $view['caseuniq']                   = $view['case']->caseuniq;

        // dd($view);
        return view('capture.store.equitment', $view);
    }


    public function case_equitment($r)
    {
        // dd($r->all());
        $equitment  = $r->equipment;
        $num        = $r->num;
        $caseuniq   = $r->caseuniq;
        $i = 0;


        Equipment::cleardata($r);

        foreach ($equitment as $key => $value) {

            if (isset($value)) {
                if (isset($num[$i])) {
                    $tb_equitment         = Server::table("tb_equipment")->where("eq_id", intval($value))->first();
                    $val['eq_id']         = $tb_equitment->eq_id;
                    $val['comcreate']     = $r->comcreate;
                    $val['caseuniq']      = $caseuniq;
                    $val['name']          = $tb_equitment->name;
                    $val['amount']        = intval($num[$i]);
                    $val['txt_equipment'] = @$r->other_equipment ?? "";
                    $val['user_record']   = intval($r->equit_record_by);
                    $val['date']          = date("Y-m-d H:i:s");

                    Server::table("case_equipment")->insert($val);


                    $val2['equit_id']    = $tb_equitment->eq_id;
                    $val2['amount']      = intval($num[$i]);
                    $val2['date']        = date("Y-m-d H:i:s");
                    $val2['user_record']   = intval($r->equit_record_by);
                    $val2['txt_equipment'] = @$r->other_equipment ?? "";

                    $arr['equipment'][]  = $val2;

                    Server::table("tb_case")->where("caseuniq" , $caseuniq)->update($arr);

                }
            }
            $i++;
        }


        // dd("sldfkjsljfjklsd");

        return redirect(url("procedure/$r->cid"));

    }









}
