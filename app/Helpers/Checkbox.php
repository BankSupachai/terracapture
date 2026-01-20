<?php

    function checkbokAllarray($arr){
        $checked = "checked";
        foreach($arr as $step01){
            foreach(isset($step01)?$step01:[] as $step02){
                if($step02!=""){
                    $checked = "";
                }
            }
        }
        return $checked;
    }


