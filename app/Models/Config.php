<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Config extends Model
{
    public static function name($name){
        return DB::connection("config")->collection($name);
    }

    public static function get($name){
        return (object) DB::connection("config")->collection($name)->first();
    }

    public static function obj($file){
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
