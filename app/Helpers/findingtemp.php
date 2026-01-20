<?php

function fidingtemp($arr)
{
    $str = "";
    try {
            foreach ($arr as $key01 => $key02) {
                foreach ($key02 as $key03 => $key04) {
                    if (gettype($key04) == "string") {
                        $str .= @$key04 . "\n";
                    }
                    if (gettype($key04) == "array") {
                        foreach ($key04 as $key05) {
                            foreach ($key05 as $key06) {
                                $str .= @$key06 . " ";
                            }
                            $str.= "\n";
                        }
                    }
                }
            }
        }
    catch (\Throwable $th) {
        $str = $th;
    }
    // dd($arr,$str);
    return $str;
}


// Delete when 2025-01-01 [moss]
// function fidingtemp($tb_case)
// {
//     $str = "";
//     try {
//         if (isset($tb_case->fidingtemp)) {
//             foreach ($tb_case->fidingtemp as $key01 => $key02) {
//                 foreach ($key02 as $key03 => $key04) {
//                     if (gettype($key04) == "string") {
//                             $str .= @$key04 . "\n";
//                     }
//                     if (gettype($key04) == "array") {
//                         foreach ($key04 as $key05) {
//                             foreach ($key05 as $key06) {
//                                 $str .= @$key06 . " ";
//                             }
//                             $str.= "\n";
//                             // $str = str_replace(" ", "", $str);
//                         }
//                     }
//                     // $str.= "\n";
//                 }
//             }
//         } else {
//             $str = @$tb_case->overall_finding . "";
//         }
//     } catch (\Throwable $th) {
//         $str = $th;
//     }
//     return $str;
// }








if (!function_exists("selectadvanced")) {
    function selectadvanced($name, $source, $data)
    {
        $str = '';
        $str .= '<select name="' . $name . '[]" class="form-select">';
        $str .= '<option value="">Select</option>';
        foreach ($source as $value) {
            if ($value == $data) {
                $str .= '<option selected value="' . $value . '">' . $value . '</option>';
            } else {
                $str .= '<option value="' . $value . '">' . $value . '</option>';
            }
        }
        $str .= '</select>';
        return $str;
    }
}
