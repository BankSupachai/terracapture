<?php

namespace App\Imports;

use App\Models\billing;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class billingimport implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {
        if(isset($row['procedure'])){
            $pcd = DB::table('tb_procedure')->where('procedure_name',$row['procedure'])->first();
            return new billing([
                'accessory_code'        => $row['accessory_code'],
                'accessory_name'        => @$row['accessory_name'],
                'accessory_price'       => @$row['accessory_price'],
                'accessory_sale'        => '',
                'accessory_type'        => '',
                'accessory_company'     => 0,
                'accessory_procedure'   => $pcd->procedure_code,
                'accessory_status'      => 1,
            ]);
        }
    }
}
