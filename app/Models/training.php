<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;
use DB;
class training extends Model
{
    use HasFactory;

    protected $table = "tb_scope_training_temp";

    protected $fillable = ['st_scope_serial_number','st_training_date','st_next_training_date','st_training_topic','st_trainer_name','st_trainer_tel'];

}
