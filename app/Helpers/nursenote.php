<?php

if (!function_exists('notebox')) {
    function notebox($note,$process,$group,$name,$text){
        $box    = @$note->$process[$group][$name];
        $id     = $group."_".$name;
        $html = "<input
                type    = 'checkbox'
                group   = '$group'
                id      = '".md5($text)."'
                name    = '$name"."[]'
                value   = '$text'
                class   = 'form-check-input notebox' $box/>
                <label class='form-check-label m-0' for='".md5($text)."'>&nbsp; &nbsp; $text</label>";
        return $html;
    }
}


if (!function_exists('noteradio')) {
    function noteradio($note,$process,$group,$name,$text){
        if(@$note->$process[$group]==$name){
            $checked = "checked";
        }else{
            $checked = "";
        }
        $id     = $group."_".$name;
        $html   = "<input
        type    ='radio'
        id      ='$id'
        name    ='$group'
        class   ='form-check-input noteradio'
        value   ='$text' $checked/>
        <label class='form-check-label m-0' for='$id'>$text</label>";
        return $html;
    }
}
?>
