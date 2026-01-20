<?php

use App\Models\Mongo;
use App\Models\Server;

function backup_mongo_table($host, $dbname, $collection)
{
    $date           = date('Ymd');
    $output_file    = "D:\mongodb\\$date\\$collection.json";
    $command        = 'D:\allindex\mongo\mongoexport.exe --host ' . $host . ' --db ' . $dbname . ' --collection ' . $collection . ' --out ' . $output_file;
    exec("{$command} 2>&1", $output, $return_var);
}

function clear_mongo_table($collection)
{
    Mongo::table($collection)->delete();
}

function get_data_servermongo($collection)
{
    $data = Server::table($collection)->get();
    foreach (isset($data) ? $data : [] as $d) {
        Mongo::table($collection)->insert($d);
    }
}

function update_table($collection, $need_clear = false)
{
    if ($need_clear) {
        clear_mongo_table($collection);
    }
    get_data_servermongo($collection);
}

function get_master_data($host, $dbname, $collection, $collection2)
{
    $status = '';
    try {
        // backup local collection data
        backup_mongo_table($host, $dbname, $collection);
        // clear local collection + get server data
        update_table($collection, true);
        // update collection (tb_department)
        update_table($collection2, true);
        // set status
        $status = 'success';
        return $status;
    } catch (Exception $e) {
        return 'error';
    }
}

function remove_id($data)
{
    if ($data != null) {
        $gettype = gettype($data);
        if($gettype=="object"){
            $data = (array) $data;
        }

        if (isset($data['id'])) {
            unset($data['id']);
        } else {
            foreach ($data as $key => $value) {
                if (gettype($value) == "array") {
                    $value['id'] = (string) $value['id'];
                    $data[$key] = $value;
                } else {
                    $value->id = (string) $value->id;
                    $data->$key = $value;
                }
            }

        }



    } else {
        $data = array();
    }



    return $data;
}
