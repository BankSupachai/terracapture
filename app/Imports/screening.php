<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Mongo;
use Illuminate\Support\Facades\DB;
class screening implements ToModel, WithHeadingRow
{

    public $i=0;
    public function model(array $data)
    {

        // 'patient_id' int NOT NULL,
        // $val['hn']              = str_pad($data['hn'], 7, '0', STR_PAD_LEFT);
        $val[$this->i]['hn']              = $data['hn'];
        $val[$this->i]['prefix']          = $data['prefix'];
        $val[$this->i]['firstname']       = $data['firstname'];
        $val[$this->i]['lastname']        = $data['lastname'];
        $val[$this->i]['gender']          = $data['gender'];
        $val[$this->i]['nationality']     = 1;
        $val[$this->i]['created_at']      = date("Y-m-d H:i:s");
        $val[$this->i]['phone']           = "";
        $val[$this->i]['address']         = "";
        $val[$this->i]['email']        = "";

        if(@$data['birthdate']!="no" && @$data['birthdate']!=null){
            dd($data['birthdate']);
            $val[$this->i]['birthdate']       = $data['birthdate'];
        }else{
            $year = date("Y")-$data['age'];
            $val[$this->i]['birthdate']       = "$year-01-01";
        }

        $this->i++;
        // $patient = check_patient($val['hn']);
        // dd($patient);
        // if($patient==null){
            // DB::connection("mongodb")->collection("tb_patient")->insert($val);
            // Mongo::table("tb_patient")->insert($val);
        // }

        // sleep(0.5);
        // unset($val);
        $file = fopen("D:/laragon/htdocs/import_log.txt", "a");
        $text = jsonEncode($val[$this->i-1]) . "\n";
        fwrite($file, $text);
        fclose($file);
    }
}
