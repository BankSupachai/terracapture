<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mongo;
use App\Models\Datacase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use stdClass;
use Symfony\Component\Process\Process;

class PacsPythonController extends Controller
{

    // public $create_dicom  = 'D:\\allindex\\dicom\\create_dcm\\__pycache__\\create_multi.cpython-310.pyc';
    public $create_dicom  = 'D:\\allindex\\dicom\\create_dcm\\__pycache__\\create_one_phoppha.cpython-310.pyc';
    // public $create_dicom  = 'D:\\allindex\\dicom\\create_dcm\\__pycache__\\create_one_siph.cpython-310.pyc';
    // public $create_dicom  = 'D:\\allindex\\dicom\\create_dcm\\__pycache__\\create_one.cpython-310.pyc';

    public function index(Request $r)
    {
        switch ($r->event) {
            case 'vna_pdf':
                $this->vna_pdf($r);
            case 'get_worklist':
                return $this->get_worklist($r);
            case 'import_caseworklist':
                return $this->import_caseworklist($r);
            case 'send_pdf':
                $this->send_pdf($r);
        }
    }

    public function store(Request $r)
    {
        switch ($r->event) {
            case "dicom_photo":
                $this->dicom_photo($r);
                $this->create_dicom($r);
                break;
            case "dicom_pdf":
                $this->dicom_pdf($r);
                $this->create_dicom($r);
                break;
            case "dicom_pacs":
                $this->dicom_pacs($r);
                $this->create_dicom($r);
                break;
            case "dicom_photopdf":
                $this->dicom_photopdf($r);
                $this->create_dicom($r);
                break;
            case "send_pacs":
                $this->send_pacs($r);
                break;
            case "saveaccessionno":
                    $this->saveaccessionno($r);
                    break;
        }
    }

    public function saveaccessionno($r)
    {
        $val['accessionno'] = $r->accessionno;
        Datacase::change($r->cid, $val);
    }

    public function create_dicom($r)
    {
        $tb_case            = (object) Mongo::table("tb_case")->where("_id", $r->cid)->first();
        $hn                 = $tb_case->case_hn;
        $folderdate         = $tb_case->appointment_date;
        $log['case_from']   = $tb_case->caseuniq;
        $log['case_hn']     = $tb_case->case_hn;
        logdata('tb_logdicom', uid(), 'create dicom', $log);
        $base64 = $this->baseDATA($r);
        $check  = shell_exec("$this->create_dicom $base64");
        $this->deleteall(htdocs("store/$hn/$folderdate"));
        echo $check;
        if (isset($r->is_photoall)) {
            $dec = json_decode($check, true);
            return @$dec['status'] . "";
        }
    }

    public function dicom_pdf($r)
    {
        $tb_case = (object) Mongo::table("tb_case")->where("_id", $r->cid)->first();
        $this->makedir($tb_case);
        $hn             = $tb_case->case_hn;
        $folderdate     = $tb_case->appointment_date;
        $pdf_file       = htdocs("store/$hn/temp/$tb_case->case_procedurecode.pdf");
        $pdf_file       = str_replace("/", "\\", $pdf_file);
        $arr['filein']  = $pdf_file;
        $arr['fileout'] = htdocs("store/$hn/$folderdate/temp/00000_");
        $arr['type']    = "jpg";
        $arr['zoom']    = 1.5;
        $jsonEN         = jsonEncode($arr);
        $base64         = base64_encode($jsonEN);
        shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");
    }

    public function dicom_photopdf($r)
    {
        //เอาไว้ใส่ใน superadmin วันหลัง
        $twoinone = false;
        if ($twoinone) {
            // dd("mmmmm");
            $this->makedir($r);
            $w['caseuniq']      = $r->pacs_caseuniq;
            $w['comcreate']     = $r->pacs_comcreate;
            // $tb_case            = $this->join_patient_tbcase($r);
            $hn                 = $tb_case->hn;
            $folderdate         = $r->folderdate;
            $pdf_file           = htdocs("store/$hn/temp/$tb_case->case_procedurecode.pdf");
            file_put_contents($pdf_file, file_get_contents(str_replace("+", "&", $r->url)));
            $arr['filein']  = $pdf_file;
            $arr['fileout'] = htdocs("store/$hn/$folderdate/temp/0");
            $arr['type']    = "jpg";
            $arr['zoom']    = 3;
            $jsonEN         = jsonEncode($arr);
            $base64         = base64_encode($jsonEN);
            shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");
            $photoall       = $tb_case->photo;
            $photoselect    = photoSELECT($photoall);
            $dir            = htdocs("store/$hn/$folderdate/");
            $size           = $this->get_wh($dir, $photoselect);
            $this->copyphoto($dir, $photoselect, $size, 2);
            $size           = $this->get_whnew($dir);
            $new_hn         = $tb_case->hn;
            $this->resizejpeg($dir, $new_hn, $size);
            $base64 = $this->baseDATA($r);
            $check  = shell_exec("$this->create_dicom $base64");
            $this->deleteall(htdocs("store/$hn/$folderdate"));
            echo $check;
        } else {
            $this->dicom_pdf($r);
            $this->dicom_photo($r);
        }
    }




    public function dicom_photo($r)
    {
        $tb_case        = (object) Mongo::table("tb_case")->where("_id", $r->cid)->first();
        $this->makedir($tb_case);
        $photoall       = $tb_case->photo;
        $photoselect    = photoSELECT($photoall);
        // $photoselect  =  photoALL($photoall);
        if ($r->is_allphoto=="true") {
            $photoselect    = $photoall;
        }
        // dd($r);
        // dd($photoselect);
        $new_hn         = $tb_case->case_hn;
        $dir            = htdocs("store/$new_hn/$tb_case->appointment_date/");
        $size           = $this->get_wh($dir, $photoselect);
        $this->copyphoto($dir, $photoselect, $size, 1);
        // dd(1);
    }

    public function gender($data)
    {
        if ($data == 1) {
            $gender = "M";
        } else {
            $gender = "F";
        }
        return $gender;
    }

    public function baseDATA($r)
    {
        // $w['caseuniq']          = $r->pacs_caseuniq;
        // $w['comcreate']         = $r->pacs_comcreate;
        // $tb_case                = $this->join_patient_tbcase($r);


        $tb_case                = (object) Mongo::table("tb_case")->where("_id", $r->cid)->first();
        $tb_patient             = (object) Mongo::table("tb_patient")->where("hn", $tb_case->case_hn)->first();
        $hn                     = $tb_case->case_hn;
        $folderdate             = $tb_case->appointment_date;
        $procedure              = $tb_case->procedurename; //str_replace(" ","",$json->procedurename);
        $fulltime               = explode(' ', $tb_case->appointment);
        $casedate               = $fulltime[0];
        $casetime               = $fulltime[1];
        $ward                   = @$tb_case->ward . "";
        $doctorname             = $tb_case->doctorname;
        $dt                     = date('His');
        $gender                 = $this->gender($tb_patient->gender);
        $dirtemp                = htdocs("store/$hn/$folderdate/temp");
        $size                   = $this->get_whnew($dirtemp);
        $arr['width']           = $size['w'];
        $arr['height']          = $size['h'];
        $arr['folder_input']    = $dirtemp;
        $arr['modality']        = "ES";
        $arr['caseuniq']        = $tb_case->caseuniq;
        $arr['hn']              = $hn;
        $arr['patientname']     = $tb_case->patientname;
        $arr['datetime']        = $dt;
        $arr['gender']          = $gender;
        $arr['age']             = $tb_case->age;
        $arr['studydate']       = str_replace("-", "", $casedate);
        $arr['casedate']        = $casedate;
        $arr['casetime']        = str_replace(":", "", $casetime);
        $arr['procedure']       = $procedure;
        $arr['birthdate']       = str_replace("-", "", $tb_patient->birthdate);
        $arr['ward']            = $ward;
        $arr['doctorname']      = $doctorname;
        $arr['accessionNUMBER'] = @$tb_case->accessionno . "";
        $arr['folderdate']      = $folderdate;
        $json                   = jsonEncode($arr);
        $base64                 = base64_encode($json);
        return $base64;
    }

    public function makedir($r)
    {
        makedirfull(htdocs("store/$r->case_hn/temp"));
        makedirfull(htdocs("store/$r->case_hn/$r->appointment_date/temp"));
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

    public function get_whnew($dir)
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
        return $size;
    }



    public function copyphoto($dir, $photoselect, $size, $division)
    {
        $num = 100;
        foreach ($photoselect as $photo) {
            $pathphoto = $dir . $photo['na'];
            $num++;
            $numpic = str_pad($num, 5, '0', STR_PAD_LEFT);
            if (file_exists($pathphoto) == 1) {
                copy($pathphoto,$dir . "/temp/" . $numpic . $photo['na']);
            }
        }

        // dd("Upload");
    }

    public function resizejpeg($dir, $hn, $size)
    {
        $files = glob($dir . "temp/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (is_file($file)) {
                $pic = Image::make($file);
                $pic->resize($size['w'] / 2, $size['h'] / 2, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $pic->save($file);
                $img = Image::make('public/images/black.jpg');
                $img->resize($size['w'] / 2, $size['h'] / 2);
                $img->insert($file, 'center');
                $img->save($file);
            }
        }
    }

    public function deleteall($dir)
    {
        // dd($dir);
        $dir = str_replace("\\", "/", $dir);
        $dir = "$dir/temp";
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        unlink("$dir/$file");
                    }
                }
                closedir($dh);
            }
        }
    }

    public function uniq_string($hn)
    {
        // $tb_case = Mongo::table("tb_case")->where("case_hn", $hn)->get();
        // foreach ($tb_case as $data) {
        //     $_id = $data['_id'];
        //     $val['caseuniq'] = $data['caseuniq'];
        //     Mongo::table("tb_case")->where("_id", $_id)->update($val);
        // }
    }


    public function send_pacs($r)
    {

        $this->uniq_string($r->hn);
        // $id,$hn,$name, $_id
        $arr['hn']          = $r->hn;
        // $w['caseuniq']  = $r->pacs_caseuniq;
        // $w['comcreate'] = $r->pacs_comcreate;
        $w['_id'] = $r->cid;
        $jsonEN             = jsonEncode($arr);
        $base64             = base64_encode($jsonEN);
        $pacs_return        = exec("D:\allindex\dicom\send2pacs\__pycache__\send2pac.cpython-310.pyc $base64");




        $temp   = jsonDecode($pacs_return);
        $status = "success";
        foreach ($temp as $tem) {
            if ($tem != "0000") {
                $status = $tem;
            }
        }

        $data['user']       = @$name;
        $data['when']       = date('Y-m-d H:i:s');
        $data['hn']         = $r->hn;
        $data['status']     = $status;
        $case               = Mongo::table('tb_case')->where($w)->first();
        $json               = isset($case->case_pacs) ? $case->case_pacs : [];
        if (isset($json[0])) {
            $json[] = $data;
        } else {
            $json[0] = $data;
        }
        $val['case_pacs']   = $json;

        if ($status == "success") {
            $val['statuspacs'] = true;
        }

        $log['pacs_status'] = $status;
        $log['case_from']   = $case->caseuniq;
        $log['case_hn']     = $case->case_hn;
        logdata('tb_logdicom', uid(), 'send pacs', $log);
        Mongo::table('tb_case')->where($w)->update($val);
        createTEMP('tb_case', $case->caseuniq, $case->comcreate, date("ymdHis"));
        // createTEMP($table,$caseuniq,$comcreate,$updatetime)

        $arr['status'] = $status;
        printJSON($arr);

        if (isset($r->is_photoall)) {
            return $status;
        }

        // echo ;
    }
}
