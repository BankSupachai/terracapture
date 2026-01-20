<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Mongo;
use Carbon\Carbon;

class Photo extends Model
{
    use HasFactory;
    protected $table = 'tb_logphoto';

    public static function logphoto($name, $event, $size, $others=[]){
        $i['name']  = $name;
        $i['path']  = '';
        $i['time']  = Carbon::now()->toDateTimeString();
        $i['event'] = $event;
        $i['size']  = $size;
        foreach ($others as $key => $value) {
            $i[$key] = $value;
        }
        Mongo::table('tb_logphoto')->insert($i);
    }

    public static function updatepath($path, $photoname){
        $data = Mongo::table('tb_logphoto')->where('name', $photoname)->first();
        if(isset($data) && $data != []){
            $u['path'] = $path;
            Mongo::table('tb_logphoto')->where('name', $photoname)->update($u);
        }
    }
}
