<?php
use App\Models\Mongo;
use App\Models\Server;

function logdata($tablename, $userid, $event, $others=[]){
    $user = (object) Mongo::table('users')->where('uid', intval($userid))->first();
    $fullname = '';
    if(isset($user)){
        $fullname = fullName($user);
    }

    $config           = (object) getCONFIG('admin');
    $i['comname']     = @$config->com_name;
    $i['datetime']    = date('Y-m-d H:i:s');
    $i['event']       = $event;
    $i['user_id']     = $userid;
    $i['user_name']   = $fullname;
    foreach ($others as $key => $value) {
        $i[$key] = $value;
    }

    try {
        Mongo::table($tablename)->insert($i);
    } catch (\Exception $e) {}
}


