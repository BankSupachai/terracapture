<?php

namespace App\Imports;

use App\Models\icd9;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class icd9import implements ToModel, WithHeadingRow
{

    public function model(array $data)
    {
        if(isset($data['procedure'])){
            $pcd = DB::table('tb_procedure')->where('procedure_name',$data['procedure'])->first();
            return new icd9([
                'icd9'              => @$data['icd9'],
                'icd9_billprice'    => @$data['icd9_billprice'],
                'icd9_billname'     => @$data['icd9_billname'],
                'proicd9_name'      => @$data['icd9_billname'],
                'extra'             => 0,
                'extra_text'        => '',
                'procedure_code'    => $pcd->procedure_code,
                'icd9_json'         => "{}",
                'icd9_status'       => @$data['status'],
            ]);
        }
    }
}
