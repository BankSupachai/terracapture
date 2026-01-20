<?php
use App\Imports\excelimport;

function wording($app,$type){
    $path   = htdocs("config/wording/$app.xlsx");
    $data   = Excel::toArray(new excelimport,$path);
    $arr    = array();
    foreach($data[0] as $key=>$val){
        foreach($val as $k=>$v){
            if($k==$type){
                $arr[$val['var']] = $v;
            }
        }
    }
    $obj = (object) $arr;
    return $obj;
}



?>
