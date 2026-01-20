<?php
    function comtxt($json,$name,$class){
        $txt = "";
        if(isset($json->$name)){
            $txt = $json->$name;
        }
        $str = "<input type='text' name='$name' id='$name' value='$txt' class='savejson $class'>";
        return $str;
    }

    function combox($json,$name){
        $check="";
        if(isset($json->$name)){
            if($json->$name=="true"){
                $check = "checked";
            }
        }
        $str = "<input type='checkbox' name='$name' id='$name' class='savejson' $check>";
        return $str;
    }

    function comtxt_patient($json,$name,$class){
        $txt = "";
        if(isset($json->$name)){
            $txt = $json->$name;
        }
        $str = "<input type='text' name='$name' id='$name' value='$txt' class='savejson_patient $class'>";
        return $str;
    }
    function comnum_patient($json,$name,$class){
        $txt = "";
        if(isset($json->$name)){
            $txt = $json->$name;
        }
        $str = "<input type='number' name='$name' id='$name' value='$txt' class='savejson_patient $class'>";
        return $str;
    }

    function combox_patient($json,$name){
        $check="";
        if(isset($json->$name)){
            if($json->$name=="true"){
                $check = "checked";
            }
        }
        $str = "<input type='checkbox' name='$name' id='$name' class='savejson_patient' $check>";
        return $str;
    }

    function mevalue($json,$value){
        $condition = false;
        foreach($value as $val){
            if(isset($json->$val)){
                if($json->$val!=null && $json->$val!=""){
                    $condition=true;
                }
            }
        }
        return $condition;
    }

    function checkNULL($name){
        $condition = false;
        if($name!=null && $name!=""){
            $condition=true;
        }
        return $condition;
    }

    function checkarr($arr,$str){
        $val = "";
        if(isset($arr)){
            foreach($arr as $data){
                if($data==$str){
                    $val = "checked";
                }
            }
        }
        return $val;
    }

    function advance_text($mainpart,$i,$val,$label){
        $name = smalltext($label);
        $val = $val[$name]??"";
        // $val  = $val[$i][$name]??"";
        // $val = jsonEncode($val);

        // $val = jsonEncode($val);

        $str = "<label for='$name' class='form-label'>$label</label>";
        $str.= "<input type='text' class='form-control advance_text'";
        $str.= " mainpart='$mainpart' lesion='$i' component_name='$name' value='$val'>";
        return $str;
    }

    function advance_select($mainpart,$i,$val,$data,$label){
        $name   = smalltext($label);
        $val    = $val[$name]??"";
        $str    = "<label for='$name' class='form-label'>$label</label>";

        $str.= "<select class='form-select advance_text' lesion='$i' mainpart='$mainpart' component_name='$name'>";
        $str.= "<option value=''>--Select--</option>";
        foreach($data as $d){
            $selected = "";
            if($val==$d){
                $selected = "selected";
            }
            $str.= "<option value='$d' $selected>$d</option>";
        }
        $str.= "</select>";
        return $str;
    }

    function advance_checkbox($mainpart,$i,$val,$data,$col,$label){
        $name   = smalltext($label);
        $val    = $val[$name]??"";
        $str    = "<label for='$name' class='form-label'>$label</label>";
        $str    .= "<div class='row'>";
        foreach($data as $key=>$d){
            $md5 = md5($mainpart.$name.$d);
            $checked = "";
            try {
                if(in_array($d,$val)){
                    $checked = "checked";
                }
            } catch (\Throwable $th) {}
            $str.= "<div class='col-$col'>";
            $str.= "<input type='checkbox' group='$name' lesion='$i' id='$i$md5' class='form-check-input advance_checkbox' mainpart='$mainpart' component_name='$key' value='$d' $checked>";
            $str.= "<label class='form-check-label' for='$i$md5'>&nbsp;&nbsp;$d</label>";
            $str.= "</div>";
        }
        $str.= "</div>";

        return $str;
    }




?>
