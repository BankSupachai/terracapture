<?php

namespace App\Imports;

use App\Models\preventive;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class preventiveImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new preventive([
            'sp_scope_serial_number'    => @$row['scope_serial_number'],
            'sp_pm_date'                => @$row['pm_date'],
            'sp_pm_next_date'           => @$row['pm_next_date'],
            'sp_pm_result'              => @$row['pm_result'],
            'sp_result_detail_pm'       => @$row['result_detail_pm'],
            'sp_ma_users'               => @$row['ma_users'],
        ]);
    }
}
