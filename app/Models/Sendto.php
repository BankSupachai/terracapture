<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;

class Sendto extends Model
{

    public static function  pdf2folder($r){

    }

    public static function  img2folder($id){

    }

    public static function  pdf2img2folder($cid){

        $base64         = Sendto::baseDATA($cid);
        $tb_case        = (object) Mongo::table('tb_case')->where("case_id",$cid)->first();
        $hn             = $tb_case->case_hn;
        $pdf_file       = htdocs("store/$hn/temp/temp.pdf");
        file_put_contents($pdf_file, file_get_contents(str_replace("+","&",$r->url)));
        makedirfull("D:\EMR\\$tb_case->appointment_date\\$hn");

        $arr['filein']  = $pdf_file;
        $arr['fileout'] = "D:\EMR\\$tb_case->appointment_date\\$hn\\"."_".$tb_case->procedurename."_";
        $arr['type']    = "jpg";
        $arr['zoom']    = 2;
        $jsonEN         = jsonEncode($arr);
        $base64         = base64_encode($jsonEN);
        shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");
    }

    public function baseDATA($cid){
        $tb_case                = (object) Mongo::table('tb_case')->where("case_id",$cid)->first();
        $tb_patient             = (object) Mongo::table('tb_patient')->where("hn",$tb_case->case_hn)->first();
        $hn                     = $tb_case->case_hn;
        $folderdate             = $tb_case->appointment_date;
        $json                   = jsonDecode($tb_case->case_json);
        $fulltime               = explode(' ',$tb_case->appointment);
        $casedate               = $fulltime[0];
        $casetime               = $fulltime[1];
        $dt                     = date('His');
        $gender                 = $this->gender($tb_patient->gender);

        makedirfull(htdocs("store/$hn/temp"));
        makedirfull(htdocs("store/$hn/$folderdate/temp"));

        $arr['caseuniq']        = $tb_case->caseuniq;
        $arr['hn']              = $hn;
        $arr['firstname']       = $tb_patient->firstname;
        $arr['lastname']        = $tb_patient->lastname;
        $arr['datetime']        = $dt;
        $arr['gender']          = $gender;
        $arr['age']             = age($tb_patient->birthdate);
        $arr['casedate']        = $casedate;
        $arr['casetime']        = $casetime;
        $arr['birthdate']       = $tb_patient->birthdate;
        $arr['procedure']       = $tb_case->procedurename;
        $arr['ward']            = $tb_case->ward;
        $arr['doctorname']      = $tb_case->doctorname;
        $arr['accessionNUMBER'] = $tb_case->accessionNUMBER."";
        $arr['folderdate']      = $folderdate;
        $json           = jsonEncode($arr);
        $base64         = base64_encode($json);
        return $base64;
    }

    public function gender($data){
        if($data==1){
            $gender="M";
        }else{
            $gender="F";
        }
        return $gender;
    }

}
