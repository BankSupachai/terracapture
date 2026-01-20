<?php
use App\models\Mongo;
//Show Date with user timezone
if (!function_exists('jsonDecode')) {
    function jsonDecode($value)
    {
        $value = json_decode($value);
        if ($value == null) {
            $value = array("");
        }
        return $value;
    }
}



if (!function_exists('jsonEncode')) {
    function jsonEncode($value)
    {
        $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        if ($value == "null") {
            $value = array("");
        }
        return $value;
    }
}


if (!function_exists('printJSON')) {
    function printJSON($value)
    {
        $json = jsonEncode($value);
        echo $json;
    }
}

if (!function_exists('pdpaEncode')) {
    function pdpaEncode($value)
    {
        $step01 = base64_encode($value);
        $step02 = strrev($step01);
        $step03 = base64_encode($step02);
        return $step03;
    }
}

if (!function_exists('pdpaDecode')) {
    function pdpaDecode($value)
    {
        $step01 = base64_decode($value);
        $step02 = strrev($step01);
        $step03 = base64_decode($step02);
        return $step03;
    }
}

function clientALL()
{
    $str    = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
    $json   = jsonDecode($str);
    $arr  = jsonDecode($json->all_client);
    return $arr;
}




if (!function_exists('box')) {
    function box($value)
    {
        $str = "";
        if ($value != null) {
            if ($value == "true") {
                $str = "checked";
            }
        }
        return $str;
    }
}

if (!function_exists('box2text')) {
    function box2text($value, $text)
    {
        $str = "";
        if ($value != null) {
            if ($value == "true") {
                $str = $text;
            }
        }
        return $str;
    }
}

if (!function_exists('text2print')) {
    function text2print($text1, $value, $text2)
    {
        $str = "";
        if ($value != null) {
            if ($value != "") {
                $str = $text1 . $value . $text2;
            }
        }
        return $str;
    }
}

function checkselect($val1, $val2)
{
    if (in_array($val1, (array) $val2)){
        return "checked";
    }else{
        return "";
    }
}


function case_jsonSave($cid, $name, $value)
{
    $tb_case = (array) Mongo::table('tb_case')->where('_id', $cid)->first();
    $tb_case[$name] = $value;
    $tb_case['case_edit']   = true;
    $tb_case['pdfcreate']   = false;
    unset($tb_case['id']);
    Mongo::table('tb_case')->where('_id', $cid)->update($tb_case);
}




function case_jsonSaveEXTRA($cid, $name, $value)
{
    $tb_case = DB::table('tb_case')->where('case_id', $cid)->first();
    $arr = (array) jsonDecode($tb_case->case_json);
    $arr[$name] = $value;
    $json['case_json'] = jsonEncode($arr);
    DB::table('tb_case')->where('case_id', $cid)->update($json);
}


function case_jsonNOTE($nid, $name, $value)
{
    $tb_casenote = DB::table('tb_casenote')->where('note_id', $nid)->first();
    $arr = (array) jsonDecode($tb_casenote->note_casejson);
    $arr[$name] = $value;
    $json['note_casejson'] = jsonEncode($arr);
    DB::table('tb_casenote')->where('note_id', $nid)->update($json);
}

function case_jsonpatient($nid, $name, $value)
{
    $patient = DB::table('patient')->where('patient_id', $nid)->first();
    $arr = (array) jsonDecode($patient->patient_json);
    $arr[$name] = $value;
    $json['patient_json'] = jsonEncode($arr);
    DB::table('patient')->where('patient_id', $nid)->update($json);
}

function saveJSONCOMPONENT($r)
{
    $w[0] = array('caseuniq', $r->caseuniq);
    $w[1] = array('comcreate', $r->comcreate);
    $tb_case = DB::table('tb_case')->where($w)->first();
    $arr = (array) jsonDecode($tb_case->case_json);
    $arr[$r->name] = $r->value;
    $json['case_json'] = jsonEncode($arr);
    DB::table('tb_case')->where($w)->update($json);
}

function case_jsonSaveUniq($uniq, $name, $value)
{
    $tb_case = DB::table('tb_case')->where('caseuniq', $uniq)->first();
    $arr = (array) jsonDecode($tb_case->case_json);
    $arr[$name] = $value;
    $json['case_json'] = jsonEncode($arr);
    DB::table('tb_case')->where('caseuniq', $uniq)->update($json);
}


if (!function_exists('RandomString')) {
    function RandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}


if (!function_exists('arraycheck')) {
    function arraycheck($value)
    {
        if ($value == null) {
            $value = "";
            return $value;
        }

        $i = 0;
        foreach ($value as $key => $v) {
            if ($v != "") {
                $i++;
            }
        }
        if ($i == 0) {
            return "";
        } else {
            $value = json_encode($value);
            if ($value == "null") {
                $value = array("");
            }
            return $value;
        }
    }
}


function extradata($num, $procedure, $hn, $step1)
{
    if ($num > 0) {
        $step2 = explode($procedure, $step1);
        $step3 = substr($step2[0], -10, 10);
        $step4 = explode($step3, $step2[0]);
        $count = strlen($hn);
        $step5 = substr($step2[1], $count, 100);
        $path = $step4[0] . "/" . $step3 . "/" . $procedure . "/" . $hn . "/" . $step5;
        return $path;
    }
}



function array_pluck($object, $name, $id)
{
    $array =  array();
    foreach ($object as $loop) {
        $array[$loop->$id] = $loop->$name;
    }
    return $array;
}

function array_pluck2($object, $name, $id)
{
    $array =  array();
    foreach ($object as $key) {
        $array[$key['id']] = $key['name'];
    }
    return $array;
}


function without_tagP($str0)
{
    $str1 = str_replace("\n", "<br>", $str0);
    // $str2 = str_replace("</p>","",$str1);
    return $str1;
}




