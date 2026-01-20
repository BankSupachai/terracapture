<?php

namespace App\Imports;

use App\Models\repair;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class repairImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new repair([
            'sr_scope_serial_number'        => @$row['scope_serial_number'],
            'sr_broken_date'                => @$row['broken_date'],
            'sr_main_phenomenon_repair'     => @$row['main_phenomenon_repair'],
            'sr_repair_analyze'             => @$row['repair_analyze'],
            'sr_bringback_date'             => @$row['bringback_date'],
            'sr_repair_price'               => @$row['repair_price'],
            'sr_return_date'                => @$row['return_date'],
            'sr_repair_status'              => @$row['repair_status'],
        ]);
    }
}
