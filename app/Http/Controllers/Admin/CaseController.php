<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;

class CaseController extends Controller
{

    public function index(){}

    public function store(Request $r)
    {
        switch($r->event){
            case "get_casedata"     :   $this->get_casedata($r);    break;
            case "update_rapid"     :   $this->update_rapid($r);    return redirect("reportendocapture/$r->cid");break;
            case "jsonboxSAVE"      :   $this->jsonboxSAVE($r);     break;
        }
    }

    public function jsonboxSAVE($r){
        Datacase::jsonUPDATE($r->cid,$r->ele,$r->val);
    }


    public function get_casedata($r){
        $case = DB::table('tb_case')->where("case_id",$r->cid)->first();
        $json = $case->case_json;
        echo $json;
    }

    public function update_rapid($r){
        $case               = DB::table('tb_case')->where("case_id",$r->cid)->first();
        $json               = jsonDecode($case->case_json);
        $json->rapid        = $r->rapid;
        $json->rapid_other  = $r->rapid_other;
        $val['case_json']   = jsonEncode($json);
        DB::table('tb_case')->where("case_id",$r->cid)->update($val);
    }

}
