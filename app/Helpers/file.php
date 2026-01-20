<?php

function zip_file($zip, $storepath, $file, $type){
    foreach ($file??[] as $key => $f) {
        if($type == 'photo'){
            $path = $storepath.@$f['na']."";
        } else if ($type == 'report'){
            $path = "$storepath/pdf/".@$f['pdf']."";
        } else {
            $path = "$storepath/vdo/$f";
        }
        try{
            if (file_exists($path)) {
                $zip->addFile($path, basename($path));
            }
        } catch (\Exception $e){dd($e);}
    }
}
