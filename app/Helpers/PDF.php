<?php
function pdfcheckvalue($casedata, $str)
{
    $check  = false;
    $arr    = explode("|", $str);

    foreach ($arr as $data) {
        if (isset($casedata->$data)) {
            if ($casedata->$data != "false") {
                if ($casedata->$data == "true") {
                    $check = true;
                }
                if ($casedata->$data != "") {
                    $check = true;
                }
            }
        }
    }


    return $check;
}


function checknullblank($casedata, $str)
{
    $status = false;
    if (isset($casedata->$str)) {
        if ($casedata->$str != "") {
            $status = true;
        }

        if(gettype($casedata->$str) == 'array'){
            if($casedata->$str == []){
                $status = false;
            }
        }
    }

    return $status;
}

function checknotarray($str) {
    $val = '';
    if(isset($str)){
        $val = $str;
        if(gettype($str) == 'array'){
            if($str == []){
                $val = '';
            }
        }
    }
    return $val;
}

function checknullval($data, $str , $nullval)
{

    $data = (object) $data;
    if (isset($data->$str)) {
        if ($data->$str != "") {
            $nullval = $data->$str;
        }
    }

    return $nullval;
}

function printdot($num)
{

    $dot = '';
    for ($i=0; $i < $num; $i++) {
        $dot = $dot.".";
    }
    return $dot;
}

