<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    use HasFactory;

    public static function name($file,$data){
        $get = file_get_contents("D:/laragon/htdocs/config/api/$file.txt");
        $json = jsonDecode($get);
            $post_json = jsonDecode($json->list_data);
            for($i=0;$i<count($post_json->key);$i++){
                $key = $post_json->key[$i];
                $name = $post_json->key[$i];
                if(isset($data[$name])){
                    $value = $data[$name];
                }else{
                    $value = $post_json->value[$i];
                }
                if($post_json->checked[$i]=='checked'){
                    $post[$key] = $value;
                }
            }
        if($json->type_connect=='1'){
            return connectwebPOST($json->url,$post);
        }elseif($json->type_connect=='2'){
            $x=0;
            $url = $json->url;
            if(isset($post)){
                foreach ($post as $k => $val) {
                    if($x==0){
                        $url .= '?'.$k.'='.$val;
                    }else{
                        $url .= '&'.$k.'='.$val;
                    }
                    $x++;
                }
            }
            return connectweb($url);
        }
    }
}
