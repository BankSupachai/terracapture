<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Image;


class EMRController extends Controller
{

    public function index(Request $r){}

    public function store(Request $r)
    {
        switch($r->event){
            case "emr_photo"      :   $this->emr_photo($r);
                                        echo "success";
                                        break;
            case "emr_pdf"        :   $this->emr_pdf($r);
                                        echo "success";
                                        break;
            case "emr_photopdf"   :   $this->emr_photopdf($r);
                                        echo "success";
                                        break;
        }
    }

    public function emr_pdf($r)
    {
        $base64 = $this->baseDATA($r);
        $w['caseuniq']  = $r->pacs_caseuniq;
        $w['comcreate'] = $r->pacs_comcreate;
        $tb_case        = DB::table('tb_case')->join('patient', 'patient.hn', 'tb_case.case_hn')->where($w)->first();
        $json           = jsonDecode($tb_case->case_json);
        $hn             = $tb_case->case_hn;
        $pdf_file       = htdocs("store/$hn/temp/temp.pdf");
        file_put_contents($pdf_file, file_get_contents(str_replace("+","&",$r->url)));
        makedirfull("D:\EMR\\$r->folderdate\\$hn");

        $arr['filein']  = $pdf_file;
        $arr['fileout'] = "D:\\EMR\\$r->folderdate\\$hn\\"."_".$json->procedurename."_";
        $arr['type']    = "jpg";
        $arr['zoom']    = 2;
        $jsonEN         = jsonEncode($arr);
        $base64         = base64_encode($jsonEN);
        shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");
    }




    public function emr_photopdf($r)
    {
        $this->emr_pdf($r);
        $this->emr_photo($r);
    }




    public function emr_photo($r)
    {
        $base64         = $this->baseDATA($r);
        $w['caseuniq']  = $r->pacs_caseuniq;
        $w['comcreate'] = $r->pacs_comcreate;
        $tb_case        = DB::table('tb_case')->join('patient', 'patient.hn', 'tb_case.case_hn')->where($w)->first();
        $photoall       = jsonDecode($tb_case->case_photo);
        $photoselect    = photoSELECT($photoall);
        $dir            = htdocs("store/$tb_case->case_hn/$r->folderdate/");
        $size           = $this->get_wh($dir, $photoselect);
        $this->copyphoto2($dir, $photoselect, $size,1,$r);

    }

    public function gender($data){
        if($data==1){
            $gender="M";
        }else{
            $gender="F";
        }
        return $gender;
    }

    public function baseDATA($r){
        $w['caseuniq']          = $r->pacs_caseuniq;
        $w['comcreate']         = $r->pacs_comcreate;
        $tb_case                = DB::table('tb_case')->join('patient', 'patient.hn', 'tb_case.case_hn')->where($w)->first();
        $hn                     = $tb_case->case_hn;
        $folderdate             = $r->folderdate;
        $json                   = jsonDecode($tb_case->case_json);
        $procedure              = str_replace(" ","",$json->procedurename);
        $fulltime               = explode(' ',$tb_case->case_dateappointment);
        $casedate               = $fulltime[0];
        $casetime               = $fulltime[1];
        $ward                   = @$json->ward."";
        $doctorname             = $json->doctorname;
        $dt                     = date('His');
        $gender                 = $this->gender($tb_case->gender);

        makedirfull(htdocs("store/$hn/temp"));
        makedirfull(htdocs("store/$hn/$folderdate/temp"));

        $arr['caseuniq']        = $tb_case->caseuniq;
        $arr['hn']              = $hn;
        $arr['firstname']       = $tb_case->firstname;
        $arr['lastname']        = $tb_case->lastname;
        $arr['datetime']        = $dt;
        $arr['gender']          = $gender;
        $arr['age']             = $json->age;
        $arr['casedate']        = $casedate;
        $arr['casetime']        = $casetime;
        $arr['procedure']       = $procedure;
        $arr['birthdate']       = $tb_case->birthdate;
        $arr['ward']            = $ward;
        $arr['doctorname']      = $doctorname;
        $arr['accessionNUMBER'] = @$json->accessionNUMBER."";
        $arr['folderdate']      = $folderdate;
        $json           = jsonEncode($arr);
        $base64         = base64_encode($json);
        return $base64;
    }



    public function get_wh($dir, $photoselect)
    {
        $size['w'] = 0;
        $size['h'] = 0;
        $files = glob($dir . "temp/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                $data = getimagesize($file);
                if ($size['w'] < $data[0]) {
                    $size['w'] = $data[0];
                }
                if ($size['h'] < $data[1]) {
                    $size['h'] = $data[1];
                }
            }
        }

        foreach ($photoselect as $photo) {
            $pathphoto = $dir . $photo['na'];
            if (file_exists($pathphoto) == 1) {
                $data = getimagesize($pathphoto);
                if ($size['w'] < $data[0]) {
                    $size['w'] = $data[0];
                }
                if ($size['h'] < $data[1]) {
                    $size['h'] = $data[1];
                }
            }
        }
        return $size;
    }

    public function get_whnew($dir){
        $size['w'] = 0;
        $size['h'] = 0;
        $files = glob($dir . "temp/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                $data = getimagesize($file);
                if ($size['w'] < $data[0]) {
                    $size['w'] = $data[0];
                }
                if ($size['h'] < $data[1]) {
                    $size['h'] = $data[1];
                }
            }
        }
        return $size;
    }



    public function copyphoto($dir, $photoselect, $size,$division)
    {
        foreach ($photoselect as $photo) {
            $pathphoto = $dir . $photo['na'];
            if (file_exists($pathphoto) == 1) {
                $div2 = $size['h']/$division;
                $img = Image::make('public/images/black.jpg');
                $img->resize($div2, $div2);
                $img->insert($pathphoto, 'center');
                $img->save($dir . "/temp/" . $photo['na']);
            }
        }
    }

    public function copyphoto2($dir, $photoselect, $size,$division,$r)
    {
        $w['caseuniq']  = $r->pacs_caseuniq;
        $w['comcreate'] = $r->pacs_comcreate;
        $tb_case        = DB::table('tb_case')->join('patient', 'patient.hn', 'tb_case.case_hn')->where($w)->first();
        $json           = jsonDecode($tb_case->case_json);
        $hn             = $tb_case->case_hn;
        makedirfull("D:\EMR\\$r->folderdate\\$hn");
        foreach ($photoselect as $photo) {
            $pathphoto = $dir . $photo['na'];
            if (file_exists($pathphoto) == 1) {
                $img = Image::make($dir.$photo['na']);
                $img->save("D:\EMR\\$r->folderdate\\$hn\\" . $photo['na']);
            }
        }
    }

    public function resizejpeg($dir, $hn, $size)
    {
        $files = glob($dir . "temp/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                $pic = Image::make($file);
                $pic->resize($size['w']/2,$size['h']/2, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $pic->save($file);
                $img = Image::make('public/images/black.jpg');
                $img->resize($size['w']/2, $size['h']/2);
                $img->insert($file,'center');
                $img->save($file);
            }
        }
    }

    public function deleteall($dir){
        $files = glob($dir . "temp/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
    }

}
