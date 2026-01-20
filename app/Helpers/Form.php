<?php


function inputform($route, $event)
{
    $str  = '<form action="' . url($route) . '" method="post" enctype="multipart/form-data">' . "\n";
    $str .= '<input type="hidden" name="_token" value="' . csrf_token() . '">' . "\n";
    $str .= '<input type="hidden" name="event" value="' . $event . '">' . "\n";
    echo htmlspecialchars_decode($str);
}


function endinputform($route, $event)
{
    $str = '</form>';
    echo htmlspecialchars_decode($str);
}



function create_form($val)
{
    $txt = "<form action=''>\n";
    $i = 0;
    foreach ($val[0] as $m => $a) {
        $txt .= "<input type='text' id='" . $m . "' name='" . $m . "' placeholder='" . $m . "'><br>\n";
    }
    $txt .= "</form>\n";
    return $txt;
}


function checkinarray($case, $group, $value)
{
    $checked = "";
    if (isset($case->$group)) {
        if (in_array($value, $case->$group)) {
            $checked = "checked";
        }
    }
    return $checked;
}

function checkradio($case, $group, $value)
{
    $checked = "";
    if (isset($case->$group)) {
        if ($case->$group == $value) {
            $checked = "checked";
        }
    }
    return $checked;
}

function saveselect($case, $group, $value)
{
    $selected = "";
}


// Convert a string to an array with multibyte string
function getMBStrSplit($string, $split_length = 1)
{
    mb_internal_encoding('UTF-8');
    mb_regex_encoding('UTF-8');

    $split_length = ($split_length <= 0) ? 1 : $split_length;
    $mb_strlen = mb_strlen($string, 'utf-8');
    $array = array();
    $i = 0;

    while ($i < $mb_strlen) {
        $array[] = mb_substr($string, $i, $split_length);
        $i = $i + $split_length;
    }

    return $array;
}
