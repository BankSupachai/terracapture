<?php

if (! function_exists('mediVALUE')) {
    function mediVALUE($medi_id,$medi_json){
        $str = "";
        $decode = jsonDecode($medi_json);
        foreach($decode as $key=>$val){
            if($medi_id==$key){
                $str = $val;
            }
        }
        return $str;
    }
}
