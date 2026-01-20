<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class MainpartController extends Controller
{
    public function store(Request $r){
        switch($r->event){
            case "mainpart_update"  : $this->mainpart_update($r);      break;
            case "mainpart_update_group"  : $this->mainpart_update_group($r);      break;
        }
    }

    public function mainpart_update($r){
        $group_key  = $r->group_key;
        $value      = $r->value;
        $cid        = $r->cid;
        $tb_case    = (array) Mongo::table('tb_case')->where("id", $cid)->first();
        $tb_case['mainpart'][$group_key] = $value;
        unset($tb_case['id']);
        Mongo::table('tb_case')->where("id", $cid)->update($tb_case);
    }

    public function mainpart_update_group($r){
        $group  = $r->group;
        $value      = $r->value;
        $cid        = $r->cid;
        $tb_case    = (array) Mongo::table('tb_case')->where("id", $cid)->first();
        foreach($group as $data){
            $tb_case['mainpart'][$data] = $value;
        }
        unset($tb_case['id']);
        Mongo::table('tb_case')->where("id", $cid)->update($tb_case);
    }



}
