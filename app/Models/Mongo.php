<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mongo extends Model
{
    use HasFactory;
    public static function table($name)
    {
        return DB::connection("mongodb")->table($name);
    }

    public static function create($name)
    {
        return DB::connection("mongodb")->createCollection($name);
    }

    public static function test($name)
    {
        DB::table("test")->where("test", $name)->first();
    }

    public static function insertID($name, $data)
    {
        $newid = 1;
        $table = Mongo::table($name)->orderBy("_id", "desc")->first();
        if (isset($table['ID'])) {
            $newid = $table['ID'] + 1;
        }
        $data['ID'] = $newid;
        array_multisort($data);
        Mongo::table($name)->insert($data);
        return $newid;
    }



}
