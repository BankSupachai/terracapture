<?php

namespace App\Imports;
use App\Models\insurance;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class excelimport implements ToArray, WithHeadingRow
{
    public function array($row):array
    {
        return [
            't1'        => @$row['t1'],
            't2'        => @$row['t2'],
            't3'        => @$row['t3'],
            't4'        => @$row['t4'],
        ];
    }
}
