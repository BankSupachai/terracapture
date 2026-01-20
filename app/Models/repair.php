<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;
use DB;
class repair extends Model
{
    use HasFactory;

    protected $table = "tb_scope_repair_temp";

    protected $fillable = [
        'sr_scope_serial_number',
        'sr_broken_date',
        'sr_main_phenomenon_repair',
        'sr_repair_analyze',
        'sr_bringback_date',
        'sr_repair_price',
        'sr_return_date',
        'sr_repair_status'
    ];

}
