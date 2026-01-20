<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;

use App\Models\Datacase;
use Exception;

class MigrateDataController extends Controller
{

    public function index()
    {
        return view('admin.migrate.index');
    }

    public function edit($id)
    {

 

    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=='move_medication') {return $this->move_medication($r);}
        }
    }


    public function move_medication($r){
        $tb_case = Mongo::table('tb_case')->where('case_status', '!=', 90)->get();
        foreach ($tb_case??[] as $case) {
            $case = (object) $case;

            if(isset($case->medication_unit) || isset($case->medi_other)){
                continue;
            }

            $w[0] = array('comcreate', @$case->comcreate."");
            $w[1] = array('caseuniq', @$case->caseuniq."");
            $medication = Mongo::table('tb_casemedication')->where($w)->first();
            $u = array();
            foreach ($medication??[] as $key => $medi) {
                $to_skip = ['_id', 'caseuniq', 'comcreate', 'updatetime'];
                if(!in_array($key, $to_skip)){
                    $u[$key] = @$medi;
                }
            }
            if(count($u) > 0){
                try {
                    Mongo::table('tb_case')->where($w)->update($u);
                } catch(Exception $e) {dd($e);}
            }
        }
        return redirect()->back();
    }



}
