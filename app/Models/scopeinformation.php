<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;
use DB;
class scopeinformation extends Model
{
    use HasFactory;

    // protected $table = "scopeinformation";

    // protected $fillable = ['type','model','serial_number','working_channel','distal_end_diameter','company','installation_date','selling_price','purchasing_warranty','start','end','sale_contact','service_contact'];

    protected $table = "tb_scope_temp";

    protected $fillable = ['scope_type','scope_model','scope_name','scope_serial','scope_working_channel','scope_distal_end_diameter','scope_band','scope_installdate','scope_selling_price','scope_warranty_year',
                            'scope_contract_warrantee_start','scope_contract_warrantee_end','scope_sale_name','scope_sale_tel','scope_service_name','scope_service_tel'];

    // public static function getEmployee()
    // {
    //     $records = DB::table('employee')->select('FirstName','LastName','Company','COT','TOT','FirstYearOfMembership','TotalMDRTMembership')->get();
    //     return $records;
    // }
}
