<?php
function photoSELECT($photo)
{
    $photoselect = array();
    foreach ($photo as $c) {
        $c = (object) $c;
        if (isset($c->st)) {
            if ($c->ns > 0) {
                $photoselect[$c->ns]['nu'] = $c->nu;
                $photoselect[$c->ns]['ns'] = $c->ns;
                $photoselect[$c->ns]['na'] = $c->na;
                $photoselect[$c->ns]['sc'] = $c->sc;
                $photoselect[$c->ns]['st'] = $c->st;
                $photoselect[$c->ns]['tx'] = $c->tx;
            }
        }
    }
    ksort($photoselect);
    return $photoselect;
}

function photoALL($photo)
{
    $photoall = array();
    foreach ($photo as $c) {
        $c = (object) $c;
        $photoall[$c->nu]['nu'] = $c->nu;
        $photoall[$c->nu]['ns'] = $c->ns;
        $photoall[$c->nu]['na'] = $c->na;
        $photoall[$c->nu]['sc'] = $c->sc;
        $photoall[$c->nu]['st'] = $c->st;
        $photoall[$c->nu]['tx'] = $c->tx;
    }
    ksort($photoall);
    return $photoall;
}

function get_preview_image($arr, $path){
    $folder = "D:/laragon/htdocs/$path";
    try{
        $images = glob($folder . "/*.jpg");
        foreach($images as $image){
            if(@$image != ''){
                $image = str_replace('D:/laragon/htdocs/', '', $image);
                $image = hostname($image);
                $arr[] = $image;
            }
        }
    } catch (Exception $e) {dd($e);}
    return $arr;
}


