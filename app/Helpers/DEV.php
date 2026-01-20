<?php

function bladelink($path)
{
    if (env("APP_DEBUG")) {
        $editor = "cursor";
        $basepath = base_path();
        $path = str_replace(".", "/", $path);
        $view = "resources/views";
        $link = "$editor://file/$basepath/$view/$path.blade.php";
        $str = "<div class='bladename' style='display: none;'>";
        $str .= "<div class='div_left'>";
        $str .= "<div class='div_left_content'>";
        $str .= "<a href='$link'>$path</a>";
        $str .= "</div>";
        $str .= "</div>";
        $str .= "</div>";
        echo $str;
    }
}

function controllerpath($path)
{
    if (env("APP_DEBUG")) {
        $editor = "cursor";
        $link = "$editor://file/$path";
        $str = "<div class='bladename' style='display: none;'>";
        $str .= "<div class='div_left'>";
        $str .= "<div class='div_left_content'>";
        $str .= "<a href='$link'>$path</a>";
        $str .= "</div>";
        $str .= "</div>";
        $str .= "</div>";
        echo $str;
    }
}
