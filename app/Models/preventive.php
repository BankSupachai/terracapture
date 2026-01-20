<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;
use DB;
class preventive extends Model
{
    use HasFactory;

    protected $table = "tb_scope_pm_temp";

    protected $fillable = ['sp_scope_serial_number','sp_pm_date','sp_pm_next_date','sp_pm_result','sp_result_detail_pm','sp_ma_users'];
}
