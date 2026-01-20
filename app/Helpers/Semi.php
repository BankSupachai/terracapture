<?php
use App\Models\Mongo;
use App\Models\Server;
use App\Models\Datacase;

function semi_createtemp_masterdata($table){
    $admin      = getCONFIG("admin");
    $allclient  = jsonDecode(@$admin->all_client);


    foreach($allclient as $data){
        $w[0]    = array("table",$table);
        $w[1]    = array("client",$data);
        $tb_semimasterdata = Server::table("tb_semimasterdata")->where($w)->first();

        if(!isset($tb_semimasterdata->table)){
            $val["table"]   = $table;
            $val["client"]  = $data;
            Server::table("tb_semimasterdata")->insert($val);
            // dd($table,$allclient,$tb_semimasterdata,"mmmm");
        }
    }
}

function fastsemi($cid){
    if(!Server::check_connection()){
        $case       = Datacase::first($cid);
        $admin      = getCONFIG("admin");
        $server     = getCONFIG("server");
        $com_name   = $admin->com_name;
        $w[0]       = array("caseuniq",$case->caseuniq);
        $w[1]       = array("comcreate",$case->comcreate);
        $case_client = Mongo::table("tb_case")->where($w)->first();
        $case_server = Server::table("tb_case")->where($w)->first();
        unset($case_client->id);
        if($case_server==null){
            $case_client = (array) $case_client;
            Server::table("tb_case")->insert($case_client);
            connectweb("$server->urlbase/synchronize?com_name=$com_name&hn=$case->hn");
        }else{
            if($case_client->updatetime > $case_server->updatetime){
                $case_client = (array) $case_client;
                Server::table("tb_case")->where($w)->update($case_client);
                connectweb("$server->urlbase/synchronize?com_name=$com_name&hn=$case->hn");
            }
        }
    }
}


