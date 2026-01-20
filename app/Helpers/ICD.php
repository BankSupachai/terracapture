<?php

use App\Models\Mongo;

    function sort3column($data){
        $newarray = array();
        $newarraynum = 0;
        foreach ($data as $key => $value) {
            if($value['diagnostic_name']=="Normal"){
                $newarray[$newarraynum] = "Normal";
            }
        }
        foreach ($data as $key => $value) {
            if($value['diagnostic_name']!="Normal"){
                $newarraynum++;
                $newarray[$newarraynum] = $value['diagnostic_name'];
            }
        }
        return $newarray;
    }

    /**
     * Function array_checked
     *
     * Path : app/Helpers/ICD.php
     * @param  $array ค่าที่เก็บใน database
     * @param  $value ค่าที่ของ input
     * @return string
     */
    function array_checked($array,$value){
        $val="";
        foreach($array as $key){
            if($value==$key){
                $val .= "checked";
            }else{
                $val .= "";
            }
        }
        return $val;
    }

    function get_icd10_code($key, $procedure){
        $code = '';
        $tb_procedure = (object) Mongo::table('tb_procedure')->where('name', $procedure)->first();
        if(isset($tb_procedure)){
            $icd10 = isset($tb_procedure->icd10) ? $tb_procedure->icd10 : [];
            foreach(isset($icd10)?$icd10:[] as $key_icd10=>$i10){
                foreach ($i10 as $key_i10 => $data) {
                    if(@$icd10[$key_icd10][$key_i10]['name']."" == $key){
                        $code = $icd10[$key_icd10][$key_i10]['code'];
                    }
                }
            }
        }
        return $code;
    }

    function get_icd9_code($key, $procedure){
        $code = '';
        $tb_procedure = (object) Mongo::table('tb_procedure')->where('name', $procedure)->first();
        if(isset($tb_procedure)){
            $icd9 = isset($tb_procedure->icd9) ? $tb_procedure->icd9 : [];
            foreach(isset($icd9)?$icd9:[] as $key_icd9=>$i9){
                foreach ($i9 as $key_i9 => $data) {
                    if(@$icd9[$key_icd9][$key_i9]['name']."" == $key){
                        $code = $icd9[$key_icd9][$key_i9]['code'];
                    }
                }
            }
        }
        return $code;
    }
