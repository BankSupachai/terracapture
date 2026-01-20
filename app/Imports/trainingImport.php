<?php

namespace App\Imports;

use App\Models\training;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class trainingImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new training([
            'st_scope_serial_number'    => @$row['scope_serial_number'],
            'st_training_date'          => @$row['training_date'],
            'st_next_training_date'     => @$row['next_training_date'],
            'st_training_topic'         => @$row['training_topic'],
            'st_trainer_name'           => @$row['trainer_name'],
            'st_trainer_tel'            => @$row['trainer_tel'],
        ]);
    }
}
