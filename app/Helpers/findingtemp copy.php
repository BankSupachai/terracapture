<?php

    function fidingtempbackup($tb_case){
        $str = "";
        try {
            if(isset($tb_case->fidingtemp)){
                    foreach ($tb_case->fidingtemp as $key01=>$key02) {
                        $str.=$key01."\n";
                        if(gettype($key02)=="string"){
                            // $str.=$key02."\n";
                        }
                        if(gettype($key02)=="array"){
                            $str.="\n";
                            // $str.=" - ".$$key02."\n\n";
                            foreach ($key02 as $key03=>$key04) {
                                $str.= $key03;
                                $array = array();
                                foreach ($key04 as $key05=>$key06) {
                                    foreach ($key06 as $key07=>$key08){
                                        if(isset($array[$key07])){
                                            $array[$key07] .= $key08." ";
                                        }else{
                                            $array[$key07] = $key08." ";
                                        }
                                    }
                                }
                                foreach ($array as $key09){
                                    $str.=$key09."\n";
                                }
                            }
                        }
                    }
            }else{
                $str = @$tb_case->overall_finding."";
            }
       } catch (\Throwable $th) {}
       return $str;
    }

    if(!function_exists("selectadvanced")){
        function selectadvanced($name,$source,$data){
            $str='';
            $str.='<select name="'.$name.'[]" class="form-select">';
            $str.='<option value="">Select</option>';
            foreach ($source as $value) {
                if($value==$data){
                    $str.='<option selected value="'.$value.'">'.$value.'</option>';
                }else{
                    $str.='<option value="'.$value.'">'.$value.'</option>';
                }
            }
            $str.='</select>';
            return $str;
        }
    }
