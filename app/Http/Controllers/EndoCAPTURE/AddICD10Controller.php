<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Http\Request;

class AddICD10Controller extends Controller
{
    public function __construct(Request $r){checklogin();}

    public function store(Request $r)
    {
        DB::table('tb_diagnostic')->insert([
            "diagnostic_name"   => $r['icd10name']."",
            "icd10"             => $r['icd10value']."",
            'procedure_code'    =>$r['pcode']
        ]);

        return redirect('admin/procedure/'.$r['pcode'].'/?procedure_code='.$r['pcode']);
    }



    public function update(Request $r, $id)
    {
        foreach ($r['valueicd10'] as $key => $value) {
            if($value!="")
            {
                DB::table('tb_diagnostic')->where('diagnostic_id','=',$key)->update(['icd10'=>$value]);
            }
            else
            {
                DB::table('tb_diagnostic')->where('diagnostic_id','=',$key)->update(['icd10'=>""]);
            }
        }

        foreach ($r['nameicd10'] as $key => $value) {
            if($value!="")
            {
                DB::table('tb_diagnostic')->where('diagnostic_id','=',$key)->update(['diagnostic_name'=>$value]);
            }
            else
            {
                DB::table('tb_diagnostic')->where('diagnostic_id','=',$key)->update(['diagnostic_name'=>""]);
            }
        }


        return redirect('admin/procedure/'.$r['pcode'].'/?procedure_code='.$r['pcode']);

    }
}
