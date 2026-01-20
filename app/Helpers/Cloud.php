<?php

function insertclouddata($array){
    $url = "http://medicaendo.com/api/cloud";
    $post['event'] = 'iudb';
    $arr['table'] = "tb_cloudcasestatus";
    $arr['check'][] = array("md5",$array['md5']);
    $arr['value'] = $array;
    $post['json'] = jsonEncode($arr);
    connectwebPOST($url,$post);
}


function queuesystem($hn,$status){
    $hospital = getCONFIG("hospital");
    $array['hn']            = $hn;
    $array['date']          = date("Y-m-d");
    $array['department'] = uget("department");
    $array['hospitalcode']  = $hospital->hospital_code;
    if($status=="Register"){
        $array['status'] =      "Register";
        $array['statustext'] = "รอทำหัตถการ";
    }
    if($status=="Operation"){
        $array['status'] =      "Operation";
        $array['statustext'] = "ทำหัตถการ";
    }
    if($status=="Recovery"){
        $array['status'] =      "Recovery";
        $array['statustext'] = "พักฟื้น";
    }
    if($status=="Discharge"){
        $array['status'] =      "Discharge";
        $array['statustext'] = "เสร็จสิ้น";
    }

    $array['md5'] = md5($array['hospitalcode'].$array['department'].$array['date'].$array['hn']);
    insertclouddata($array);
}
