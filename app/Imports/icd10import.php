<?php

namespace App\Imports;

use App\Models\icd10;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class icd10import implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row['procedure_code'])){
            // $pcd = DB::table('tb_procedure')->where('procedure_name',$row['procedure_code'])->first();
            return new icd10([
                'diagnostic_id'     => $row['diagnostic_id'],
                'diagnostic_name'   => $row['diagnostic_name'],
                'procedure_code'    => $row['procedure_code'],
                'icd10'             => $row['icd10'],
                'icd10_index'       => $row['icd10_index'],
                'icd10_status'      => $row['icd10_status'],
            ]);
        }

    }
}
