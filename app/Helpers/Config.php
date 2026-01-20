<?php

use App\Models\Mongo;

function getCONFIG($file){
    $config = Mongo::table('tb_config')->where('config_type',$file)->first();
    return $config;
}


function setCONFIG($file,$varname,$value){
    $config = (array)Mongo::table('tb_config')->where('config_type',$file)->first();
    
    if($config){
        $config[$varname] = $value;
        unset($config['id']);
        Mongo::table('tb_config')->where('config_type',$file)->update($config);
    }else{
        
        $confignew['config_type'] = $file;
        $confignew[$varname] = $value;
        Mongo::table('tb_config')->insert($confignew);
    }
}




function configTYPE($type,$key){
    $config = getCONFIG($type);
    if(isset($config->$key)){
        $val = $config->$key;
    }else{
        $val = "";
    }

    if($type == 'lumina'){
        $tb_lumina = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
        $default   = ['department', 'room', 'modality', 'procedure', 'procedure_code'];
        if(in_array($key, $default)){
            $key = "default_$key";
        }
        $val = isset($tb_lumina->{$key}) ? $tb_lumina->{$key} : '';
        if($val == 'true' || $val == 'false'){
            $val = $val == 'true' ? true : false;
        }

        if($key == 'auto_record'){
            $val = $val == true ? 'true' : 'false';
        }
    }
    return $val;
}

function get_config_scope(){
    $status = false;
    try {
        $is_python = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
        if(isset($is_python->python)){
            $status = $is_python->python;
        }
    } catch(Exception $e) {}
    return $status;
}

function get_key_config($key, $filename){
    $val = '';
    $data = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
    if(isset($data->{$key})){
        $val = $data->{$key};
    }
    return $val;
}
