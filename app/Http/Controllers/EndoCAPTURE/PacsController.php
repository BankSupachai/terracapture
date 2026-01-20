<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use DB;
use Carbon\Carbon;
use Image;
use Org_Heigl\Ghostscript\Ghostscript;
use Spatie\PdfToImage\Pdf;

class PacsController extends Controller
{

    public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {
        $where_status[]   = array('tb_case.case_status', '!=', "90");
        $view['case']   = DB::table('tb_case')
        ->where($where_status)
        ->join('patient', 'tb_case.case_hn', '=', 'patient.hn')
        ->join('tb_procedure', 'tb_case.case_procedurecode', 'tb_procedure.procedure_code')
        ->leftjoin('tb_casepacs','tb_case.caseuniq','tb_casepacs.pacs_caseuniq')
        ->orderBy('case_id', 'desc')
        ->paginate(15);
        return view('pacs.index', $view);
    }

    public function store(Request $r)
    {
        if (isset($r->event)) {
            if ($r->event == "dicom_photo")     {$this->dicom_photo($r);}
            if ($r->event == "dicom_pdf")       {$this->dicom_pdf($r);}
            if ($r->event == "dicom_photopdf")  {$this->dicom_photopdf($r);}
        }
    }

    public function dicom_pdf($r)
    {

        $w['caseuniq']      = $r->pacs_caseuniq;
        $w['comcreate']     = $r->pacs_comcreate;
        $tb_case = DB::table('tb_case')->join('patient', 'patient.hn', 'tb_case.case_hn')->where($w)->first();
        $json = jsonDecode($tb_case->case_json);
        if($tb_case->gender==1){$gender="M";}else{$gender="F";}
        $age            = $json->age;
        $procedure      = str_replace(" ","",$json->procedurename);
        $birthdate      = $tb_case->birthdate;
        $hn             = $tb_case->case_hn;
        $folderdate     = $r->folderdate;

        $fulltime       = explode(' ',$tb_case->case_dateappointment);
        $casedate       = $fulltime[0];
        $casetime       = $fulltime[1];
        $ward           = @$json->ward."";
        $doctorname     = $json->doctorname;

        $ex = explode("-",$casedate);
        $invertdate = $ex[0].$ex[1].$ex[2];

        makedir(htdocs("store/$hn/temp"));
        $pdf_file       = htdocs("store/$hn/temp/temp.pdf");
        file_put_contents($pdf_file, file_get_contents(str_replace("+","&",$r->url)));
        $output_path    = htdocs("store/$hn/$folderdate/temp/$r->pacs_caseuniq"."%d");

        Ghostscript::setGsPath("C:\Program Files\gs\gs9.54.0\bin\gswin64c.exe");
        $pdf = new \Spatie\PdfToImage\Pdf($pdf_file);
        $pdf->setResolution(200);
        $pdf->setOutputFormat('jpeg')->saveImage($output_path);

        $dir            = htdocs("store/$hn/$folderdate/");
        $dt             = date('Ymdhi').gettimeofday()['usec'];

        $str_firstname  = str_replace(" ","",$tb_case->firstname);
        $str_lastname   = str_replace(" ","",$tb_case->lastname);
        $ward           = str_replace(" ","",$ward);

        exec("D:\DCM_SCU\ToDCM\bin\Debug\ToDCM.exe $tb_case->caseuniq!$hn!$str_firstname!$str_lastname!$invertdate!$gender!$age!$casedate!$casetime!$procedure!$birthdate!$ward!$doctorname");
        $this->deleteall($dir);

        exec("D:\DCM_SCU\SendToPacs\dicom.scu");
        echo "success";
    }


    public function dicom_photopdf($r)
    {
        $w['caseuniq']  = $r->pacs_caseuniq;
        $w['comcreate'] = $r->pacs_comcreate;
        $tb_case        = DB::table('tb_case')->join('patient', 'patient.hn', 'tb_case.case_hn')->where($w)->first();
        $hn             = $tb_case->case_hn;
        $folderdate     = $r->folderdate;

        makedir(htdocs("store/$hn/temp"));
        $pdf_file       = htdocs("store/$hn/temp/temp.pdf");
        file_put_contents($pdf_file, file_get_contents(str_replace("+","&",$r->url)));
        $output_path    = htdocs("store/$hn/$folderdate/temp/$r->pacs_caseuniq"."%d");

        //
        $json = jsonDecode($tb_case->case_json);
        if($tb_case->gender==1){$gender="M";}else{$gender="F";}
        $age        = $json->age;
        $procedure  = str_replace(" ","",$json->procedurename);
        $birthdate  = $tb_case->birthdate;
        $fulltime   = explode(' ',$tb_case->case_dateappointment);
        $casedate   = $fulltime[0];
        $casetime   = $fulltime[1];
        $ward       = @$json->ward."";
        $doctorname = $json->doctorname;

        $ex = explode("-",$casedate);
        $invertdate = $ex[0].$ex[1].$ex[2];

        // dd($casedate);

        Ghostscript::setGsPath("C:\Program Files\gs\gs9.54.0\bin\gswin64c.exe");
        $pdf = new \Spatie\PdfToImage\Pdf($pdf_file);
        $pdf->setResolution(200);
        $pdf->setOutputFormat('jpeg')->saveImage($output_path);

        $photoall       = jsonDecode($tb_case->case_photo);
        $photoselect    = photoSELECT($photoall);

        $dir            = htdocs("store/$hn/$folderdate/");
        $size           = $this->get_wh($dir, $photoselect);
        $this->copyphoto($dir, $photoselect, $size,2);

        $size           = $this->get_whnew($dir);
        $this->resizejpeg($dir, $tb_case->case_hn, $size);

        $dt             = date('Ymdhi').gettimeofday()['usec'];

        $str_firstname  = str_replace(" ","",$tb_case->firstname);
        $str_lastname   = str_replace(" ","",$tb_case->lastname);
        $ward           = str_replace(" ","",$ward);

        exec("D:\DCM_SCU\ToDCM\bin\Debug\ToDCM.exe $tb_case->caseuniq!$tb_case->case_hn!$str_firstname!$str_lastname!$invertdate!$gender!$age!$casedate!$casetime!$procedure!$birthdate!$ward!$doctorname");
        $this->deleteall($dir);
        exec("D:\DCM_SCU\SendToPacs\dicom.scu");
        echo "success";
    }




    public function dicom_photo($r)
    {
        $w['caseuniq']  = $r->pacs_caseuniq;
        $w['comcreate'] = $r->pacs_comcreate;
        $tb_case = DB::table('tb_case')->join('patient', 'patient.hn', 'tb_case.case_hn')->where($w)->first();
        $hn             = $tb_case->case_hn;
        $folderdate     = $r->folderdate;
        ///
        $json = jsonDecode($tb_case->case_json);
        if($tb_case->gender==1){$gender="M";}else{$gender="F";}
        $age            = $json->age;
        $procedure      = str_replace(" ","",$json->procedurename);
        $birthdate      = $tb_case->birthdate;
        $fulltime       = explode(' ',$tb_case->case_dateappointment);
        $casedate       = $fulltime[0];
        $casetime       = $fulltime[1];
        $ward           = @$json->ward."";
        $doctorname     = $json->doctorname;

        $ex = explode("-",$casedate);
        $invertdate = $ex[0].$ex[1].$ex[2];

        makedir(htdocs("store/$hn/$folderdate/temp"));

        $photoall       = jsonDecode($tb_case->case_photo);
        $photoselect    = photoSELECT($photoall);
        $dir            = htdocs("store/$hn/$folderdate/");
        $size           = $this->get_wh($dir, $photoselect);


        $this->copyphoto($dir, $photoselect, $size,1);

        $dt             = date('Ymdhi').gettimeofday()['usec'];

        $str_firstname  = str_replace(" ","",$tb_case->firstname);
        $str_lastname   = str_replace(" ","",$tb_case->lastname);
        $ward           = str_replace(" ","",$ward);

        exec("D:\DCM_SCU\ToDCM\bin\Debug\ToDCM.exe $tb_case->caseuniq!$tb_case->case_hn!$str_firstname!$str_lastname!$invertdate!$gender!$age!$casedate!$casetime!$procedure!$birthdate!$ward!$doctorname");
        $this->deleteall($dir);

        exec("D:\DCM_SCU\SendToPacs\dicom.scu");
        echo "success";
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

    public function deleteall($dir)
    {
        $files = glob($dir . "temp/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                unlink($file); // delete file
            }
        }
    }

}
