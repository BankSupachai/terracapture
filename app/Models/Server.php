<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Server extends Model
{
    use HasFactory;
    public static $servername = 'mongodbserver';

    public static function table($name){
        return DB::connection("mongodbserver")->table($name);
    }

    public static function check_connection(){
        $status = true;
        try {
            // ตรวจสอบ connection กับ server
            $check = DB::connection(Server::$servername)->getMongoClient()->listDatabases();
            $status = false;
        } catch (Exception $e) {
            $status = true;
        }
        return $status;
    }


    public static function getall(){
        $all = [];
        foreach (DB::connection(Server::$servername)->getMongoDB()->listCollections() as $collection) {
            if(isset($collection)){
                $all[] = @$collection->getName()."";
            }
        }
        return $all;
    }

    public static function create($name){
        return DB::connection("mongodbserver")->createCollection($name);
    }

    public static function insertID($name, $data)
    {
        $newid = 1;
        $table = Server::table($name)->orderBy("id", "desc")->first();
        if (isset($table->ID)) {
            $newid = $table->ID + 1;
        }
        $data['ID'] = $newid;
        array_multisort($data);
        Server::table($name)->insert($data);
        return $newid;
    }





}
