<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class Casebooking extends Model
{
    use HasFactory;
    protected $table = 'tb_casebooking';
    const UPDATED_AT = null;


    public static function booktoday(){
        $data = DB::table('tb_casebooking')
        ->whereDate('book_date_end',date('Y-m-d'))
        ->where('book_topic','endoscopy')
        ->where('book_status','<',90)
        ->get();
        return $data;
    }




}
