@php
//test

$arr = array(0,1,2,3,4,5);

foreach($arr as $i){
    $a[$i]['name'] = "finding";
    $a[$i]['code'] = "0001";
    for($e=0;$e<rand(1,5);$e++){
        $a[$i]['obj'][$e]['label']      = "aaaa";
        $a[$i]['obj'][$e]['id']         = "aaaa";
        $a[$i]['obj'][$e]['class']      = "aaaa";
        $a[$i]['obj'][$e]['component']  = "aaaa";
    }
}


$json = jsonEncode($a);

echo $json;








@endphp
