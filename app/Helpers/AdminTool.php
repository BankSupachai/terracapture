<?php

use App\Models\Mongo;

    function viewmode(){
        $str = '
        var viewmode = 0;
        document.addEventListener("keydown", function(event) {
            //console.log(event);
            var shiftkey    = event.shiftKey;
            var ctrlkey     = event.ctrlKey;
            var altkey      = event.altKey;
            if(shiftkey&&ctrlkey&&altkey){
                console.log(event);
                if(viewmode==0){
                    viewmode = 1;
                    $(".cardcode").show();
                }else{
                    viewmode = 0;
                    $(".cardcode").hide();
                }
            }
        });';
        return $str;
    }

    function editcard($cardcode,$viewname){
        $link   = url("autoit?run=visualcode_open\\endo.exe&path=$viewname");
        $str    = " <div class='cardcode col-12' style='background-color: red;color:white;display:none;'>
                        Cardcode : $cardcode
                        <a href='$link'>Edit</a>
                    </div>";
        return $str;
    }

    function cardADMIN($arr){
        $controllername = $arr['controllername'];
        $viewname       = $arr['viewname'];

        $txt = '';
        $txt.= '<div class="col-12 cardcode" style="display: none">';
        $txt.= '<div class="card card-custom">';
        $txt.= '<div class="card-body">';
        $txt.= '<label id="discharge_toggle">';
        $txt.= '<font size="4"><b>Page Detail</b></font>';
        $txt.= '</label>';
        $txt.= '<div class="row">';
        $txt.= '<div class="col-12">';
        $txt.= '<a id="test123">HomeController -> Index</a>';
        $txt.= '<br>';
        $txt.= 'Controller : <a href="';
        $txt.= url("autoit?path=$controllername");
        $txt.= '">'.$controllername.'</a>';
        $txt.= '</div>';
        $txt.= '<div class="col-12">';
        $txt.= 'View : <a href="';
        $txt.= url("autoit?path=$viewname");
        $txt.= '">'.$viewname.'</a>';
        $txt.= '</div>';
        $txt.= '</div>';
        $txt.= '</div>';
        $txt.= '</div>';
        $txt.= '</div>';
        echo $txt;
    }



    function find_duplicate($array, $status)
    {
        $count = 0;
        foreach ($array as $arr) {
            if ($arr == $status) {
                $count += 1;
            }
        }

        $array_count = count($array);
        $is_same = $count == $array_count ? true : false;
        return $is_same;
    }

    function set_colot($data){
        $color = '#000';
        $text = "<span class=\" \" style=\"color:$color;font-size:16px;\">$data</span>";
        echo $text;
    }

    function check_value($value,$text){
        $data = $text;
        if(isset($value)){
            if($value!=''){
                $data = $value;
            }
        }
        echo $data;
    }

    function format_array_to_string($arr, $should_empty=true, $seperator=' ; '){
        $str = '';
        try{
            if(!empty($arr)){
                if(is_array($arr)){
                    $filtered_arr = array_filter($arr, function($value) {
                        return $value !== '' && !empty($value);
                    });

                    if (!empty($filtered_arr)) {
                        // $str = join(" ; ", $filtered_arr);
                        $str = join($seperator, $filtered_arr);
                    }
                } else {
                    $str = $should_empty ? '' : $arr;
                }
            }
        } catch (\Exception $e){}
        return $str;
    }

    function check_is_array($data){
        $str = '';
        if(isset($data)){
            if(is_array($data)){
                $str = isset($data[0]) ? $data[0] : '';
            } else {
                $str = $data;
            }
        }
        return $str;
    }

    function safe_array_to_string($data, $separator = ', ', $default = '') {
        try {
            if (empty($data)) {
                return $default;
            }

            if (is_array($data)) {
                // Filter out null, empty, and non-string values
                $filtered = array_filter($data, function($value) {
                    return $value !== null && $value !== '' && (is_string($value) || is_numeric($value));
                });

                if (empty($filtered)) {
                    return $default;
                }

                return implode($separator, $filtered);
            }

            if (is_object($data)) {
                // Convert object to array
                $data = (array)$data;
                return safe_array_to_string($data, $separator, $default);
            }

            // If it's already a string or numeric value
            return (string)$data;
        } catch (\Exception $e) {
            return $default;
        }
    }

