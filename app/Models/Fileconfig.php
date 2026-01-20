<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;

class Fileconfig extends Model
{


    public static function first($file){
        try {
            //code...
            $str    = file_get_contents("D:/laragon/htdocs/config/project/$file.txt");
        } catch (\Throwable $th) {
            //throw $th;
            $json = "{}";
            file_put_contents("D:/laragon/htdocs/config/project/$file.txt",$json);
            $str    = file_get_contents("D:/laragon/htdocs/config/project/$file.txt");
        }
        $decode = jsonDecode($str);
        return $decode;
    }



}
