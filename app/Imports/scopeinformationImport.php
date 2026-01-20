<?php

namespace App\Imports;

use App\Models\scopeinformation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class scopeinformationImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new scopeinformation([
            'scope_type'                    => @$row['scope_type'],
            'scope_model'                   => @$row['scope_model'],
            'scope_name'                   => @$row['scope_name'],
            'scope_serial'                  => @$row['scope_serial_number'],
            'scope_working_channel'         => @$row['scope_working_channel'],
            'scope_distal_end_diameter'     => @$row['scope_distal_end_diameter'],
            'scope_band'                    => @$row['scope_company'],
            'scope_installdate'             => @$row['scope_installation_date'],
            'scope_selling_price'           => @$row['scope_selling_price'],
            'scope_warranty_year'           => @$row['scope_warranty_year'],
            'scope_contract_warrantee_start'=> @$row['scope_contract_warrantee_start'],
            'scope_contract_warrantee_end'  => @$row['scope_contract_warrantee_end'],
            'scope_sale_name'               => @$row['sale_name'],
            'scope_sale_tel'                => @$row['sale_tel'],
            'scope_service_name'            => @$row['service_name'],
            'scope_service_tel'             => @$row['service_tel'],
        ]);
    }
}
