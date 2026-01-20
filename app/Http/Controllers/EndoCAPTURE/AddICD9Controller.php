<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AddICD9Controller extends Controller
{
    public function __construct(Request $r){checklogin();}

    public function store(Request $r)
    {
        $data['proicd9_name']   = $r->icd9name."";
        $data['icd9']           = $r->icd9value."";
        $data['procedure_code'] = $r->pcode."";
        $data['extra']          = 0;
        $data['extra_text']     = "";
        $data['icd9_json']      = "";
        DB::table('tb_procedureicd9')->insert($data);
        return redirect()->back();
    }

    public function update(Request $r, $id)
    {
        foreach ($r['valueicd9'] as $key => $value) {
            if($value!=""){
                DB::table('tb_procedureicd9')->where('proicd9_id','=',$key)->update(['icd9'=>$value]);
            }else{
                DB::table('tb_procedureicd9')->where('proicd9_id','=',$key)->update(['icd9'=>""]);
            }
        }
        foreach ($r['price_type'] as $key => $val) {
            $v['icd9_json'] = jsonEncode($val);
            DB::table('tb_procedureicd9')->where('proicd9_id','=',$key)->update($v);
        }
        foreach ($r['nameicd9'] as $key => $value) {
            if($value!=""){
                DB::table('tb_procedureicd9')->where('proicd9_id','=',$key)->update(['proicd9_name'=>$value]);
            }else{
                DB::table('tb_procedureicd9')->where('proicd9_id','=',$key)->update(['proicd9_name'=>""]);
            }
        }
        return redirect('admin/procedure/'.$r['pcode'].'/?procedure_code='.$r['pcode']);
    }

}
