<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Datacase;
use App\Models\Procedure;
use App\Models\Mongo;
use App\Models\casemedication;
use App\Models\Fileconfig;
use Intervention\Image\Facades\Image;

class PDFController extends Controller
{

    public function change_pdf($r){
        // dd($r->all());
        $val['pdftype'] = $r->pdftype;
        Mongo::table("tb_case")->where("_id",$r->cid)->update($val);
    }



    public function index(Request $request)
    {
        // รับ id จาก query parameter และเรียกใช้ show method
        if ($request->has('id')) {
            return $this->show($request->id);
        }

        // หากไม่มี id ให้แสดงข้อความแจ้งเตือน
        return response()->json(['error' => 'ID parameter is required'], 400);
    }


    public function show($id)
    {
        // ตรวจสอบและดึงข้อมูล PDF version history จากไฟล์ที่มีอยู่แล้ว
        $this->syncExistingPDFVersions($id);

        $val['casedata']            = Datacase::first($id);
        // dd($val['casedata']);
        $apppoint                   = explode(" ", $val['casedata']->appointment);
        $val['folderdate']          = $apppoint[0];
        $val['hospital']            = getCONFIG('hospital');
        $val['patient']             = (object) Mongo::table("tb_patient")->where("hn", @$val['casedata']->case_hn)->first();

        $val['gender_name']         = $this->get_gender_name($val['casedata']->gender ?? "");
        $val['procedure']           = (object) Mongo::table("tb_procedure")->where("code", @$val['casedata']->case_procedurecode)->first();
        $val['pdfnameshow']         = Procedure::pdfnameshow($val['procedure']);
        $str                        = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        $connection                 = jsonDecode($str);
        $val['img_first']           = 8;
        $val['tb_casemedication']   = CASEMEDICATION::checkdata($val['casedata'], '');
        if (isset($connection->pdf_img)) {
            $val['img_first'] = $connection->pdf_img;
        }
        $val['body_line']        = '8px';
        $val['scopeall']         = Mongo::table("tb_scope")->get();

        $val['tb_procedure_header'] = $val['procedure']->pdf['head'];

        $val['admin'] = getCONFIG("admin");
        $val['pdf_language'] = @$val['casedata']->pdf_language;

        $val['users'] = (object) Mongo::table("users")->where("uid", @$val['casedata']->case_physicians01)->first();

        // $consultname = array();

        foreach ($val['casedata']->consultant ?? [] as $consultname) {

            $consult = Mongo::table("users")->where("uid" , intval($consultname))->first();
            $consultname = @$consult->user_prefix . " " . @$consult->user_firstname . " " . @$consult->user_lastname;
            $consultcase[] = $consultname;
            # code...
        }
        $val['consultcase'] = @$consultcase;
        $val    = $this->photoselect($val);
        $val    = $this->pic_draw($val);

        $val    = $this->check_typepdf($val);
        $val    = $this->check_department($val);
        $camera_id          = @$val['casedata']->cysto_serial . '';
        $tb_scope           = (object) Mongo::table("tb_scope")->where("scope_id", intval($camera_id))->first();
        $val['casedata']->cameraname = isset($tb_scope->scope_name) ? $tb_scope->scope_name : '';

        if(isset($val['pdftype'])){
            $pdftype = $val['pdftype'];
            $val = $this->$pdftype($val);
        }else{
            $val = $this->procedure($val);
        }

        $val    = $this->onepage($val);
        $val    = $this->html($val);




        $namefile = @$val['casedata']->case_hn . "_" . date('Ymd') . "_" . @$val['procedure']->name . ".pdf";
        $pdf            = PDF::loadHtml($val['html']);
        $pdf->add_info('Title', "$namefile");
        $pdf->getDomPDF()->set_option('isFontSubsettingEnabled', true);

        $this->savepdf($val, $pdf);
        return $pdf->stream($namefile);
    }

    /**
     * ตรวจสอบและดึงข้อมูล PDF version history จากไฟล์ที่มีอยู่แล้วในโฟลเดอร์
     * เพื่อแก้ปัญหาการซิงค์ไฟล์ระหว่างเครื่อง
     */
    public function syncExistingPDFVersions($cid)
    {
        try {
            $casedata = Datacase::first($cid);
            if (!$casedata) {
                return false;
            }

        $hn = isset($casedata->case_hn) ? $casedata->case_hn : $casedata->hn;
        $apppoint = explode(" ", $casedata->appointment);
        $folderdate = $apppoint[0];

        // ตรวจสอบว่ามีโฟลเดอร์ PDF หรือไม่
        $pdfFolder = htdocs("store/$hn/$folderdate/pdf");
        if (!is_dir($pdfFolder)) {
            return false;
        }

                // ดึงข้อมูล case_pdfversion ปัจจุบัน (อาจไม่มีใน MongoDB)
        $currentVersions = isset($casedata->case_pdfversion) ? $casedata->case_pdfversion : [];
        $currentVersionFiles = [];

        // แปลงข้อมูลให้เป็น array format เพื่อความสอดคล้อง (ถ้ามีข้อมูล)
        $normalizedVersions = [];
        if (!empty($currentVersions)) {
            foreach ($currentVersions as $version) {
                if (is_array($version)) {
                    $normalizedVersions[] = $version;
                } else {
                    $normalizedVersions[] = [
                        'user' => $version->user ?? 'Endocapture',
                        'when' => $version->when ?? date('Y-m-d H:i:s'),
                        'pdf' => $version->pdf ?? ''
                    ];
                }
            }
            $currentVersions = $normalizedVersions;

            // สร้าง array ของไฟล์ที่มีอยู่ใน version history
            foreach ($currentVersions as $version) {
                if (isset($version['pdf'])) {
                    $currentVersionFiles[] = $version['pdf'];
                }
            }
        }

                // ตรวจสอบไฟล์ PDF ที่มีอยู่ในโฟลเดอร์
        $pdfFiles = glob($pdfFolder . "/*.pdf");
        $allVersions = [];
        $hasNewVersion = false;

        // ตรวจสอบว่ามีไฟล์ PDF ในโฟลเดอร์หรือไม่
        if (empty($pdfFiles)) {
            return true; // ไม่มีไฟล์ PDF ให้ออกจากฟังก์ชัน
        }

        // ถ้าไม่มีข้อมูลใน MongoDB ให้สร้างจากไฟล์ในโฟลเดอร์ทั้งหมด
        if (empty($currentVersions)) {
            foreach ($pdfFiles as $pdfFile) {
                $filename = basename($pdfFile);
                $fileTime = filemtime($pdfFile);
                $fileDate = date('Y-m-d H:i:s', $fileTime);

                // สร้างข้อมูล version จากไฟล์
                $version = [
                    'user' => 'Endocapture (Synced)',
                    'when' => $fileDate,
                    'pdf' => $filename
                ];

                // ตรวจสอบภาษาในชื่อไฟล์
                if (strpos($filename, '_TH_') !== false) {
                    $version['user'] .= ' (TH)';
                } elseif (strpos($filename, '_ENG_') !== false) {
                    $version['user'] .= ' (ENG)';
                }

                $allVersions[] = $version;
                $hasNewVersion = true;
            }
        } else {
            // ถ้ามีข้อมูลใน MongoDB ให้ตรวจสอบไฟล์ใหม่
            foreach ($pdfFiles as $pdfFile) {
                $filename = basename($pdfFile);

                // ตรวจสอบว่าไฟล์นี้มีอยู่ใน version history หรือไม่
                if (!in_array($filename, $currentVersionFiles)) {
                    // ไฟล์ใหม่ที่ยังไม่มีใน version history
                    $fileTime = filemtime($pdfFile);
                    $fileDate = date('Y-m-d H:i:s', $fileTime);

                    // สร้างข้อมูล version ใหม่
                    $newVersion = [
                        'user' => 'Endocapture (Synced)',
                        'when' => $fileDate,
                        'pdf' => $filename
                    ];

                    // ตรวจสอบภาษาในชื่อไฟล์
                    if (strpos($filename, '_TH_') !== false) {
                        $newVersion['user'] .= ' (TH)';
                    } elseif (strpos($filename, '_ENG_') !== false) {
                        $newVersion['user'] .= ' (ENG)';
                    }

                    $allVersions = array_merge($currentVersions, [$newVersion]);
                    $hasNewVersion = true;
                    break; // ออกจากลูปหลังจากเจอไฟล์ใหม่
                }
            }

            // ถ้าไม่มีไฟล์ใหม่ ให้ใช้ข้อมูลเดิม
            if (!$hasNewVersion) {
                $allVersions = $currentVersions;
            }
        }

                // หากมี version ใหม่ ให้อัปเดตฐานข้อมูล
        if ($hasNewVersion) {
            // เรียงลำดับตามเวลา
            usort($allVersions, function($a, $b) {
                return strtotime($a['when']) - strtotime($b['when']);
            });

                        $updateData = ['case_pdfversion' => $allVersions];
            Mongo::table('tb_case')->where('_id', $cid)->update($updateData);
        }

        return true;
        } catch (\Exception $e) {
            // บันทึก error log
            $log['case_from'] = $cid;
            $log['error'] = $e->getMessage();
            logdata('tb_logpdf', uid(), 'sync pdf versions error', $log);
            return false;
        }
    }


    public function pdf_head_lang($r){

        $val['pdf_language'] = $r->value;

        Mongo::table("tb_case")->where("_id", $r->id)->update($val);

        // สร้าง PDF ใหม่หลังจากเปลี่ยนภาษา
        $this->create_new_pdf_for_language_change($r->id);

        return $val;
    }

    public function create_new_pdf_for_language_change($cid)
    {
        // ตรวจสอบและดึงข้อมูล PDF version history จากไฟล์ที่มีอยู่แล้ว
        $this->syncExistingPDFVersions($cid);

        // ดึงข้อมูล case
        $casedata = Datacase::first($cid);
        if (!$casedata) {
            return false;
        }

        // เตรียมข้อมูลสำหรับสร้าง PDF
        $apppoint = explode(" ", $casedata->appointment);
        $folderdate = $apppoint[0];
        $hospital = getCONFIG('hospital');
        $patient = (object) Mongo::table("tb_patient")->where("hn", @$casedata->case_hn)->first();
        $gender_name = $this->get_gender_name($casedata->gender ?? "");
        $procedure = (object) Mongo::table("tb_procedure")->where("code", @$casedata->case_procedurecode)->first();
        $pdfnameshow = Procedure::pdfnameshow($procedure);

        $val = [
            'casedata' => $casedata,
            'folderdate' => $folderdate,
            'hospital' => $hospital,
            'patient' => $patient,
            'gender_name' => $gender_name,
            'procedure' => $procedure,
            'pdfnameshow' => $pdfnameshow,
            'img_first' => 8,
            'tb_casemedication' => CASEMEDICATION::checkdata($casedata, ''),
            'body_line' => '8px',
            'scopeall' => Mongo::table("tb_scope")->get(),
            'tb_procedure_header' => $procedure->pdf['head'],
            'admin' => getCONFIG("admin"),
            'pdf_language' => $casedata->pdf_language,
            'users' => (object) Mongo::table("users")->where("uid", @$casedata->case_physicians01)->first()
        ];

        // ตรวจสอบการตั้งค่า PDF
        $str = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        $connection = jsonDecode($str);
        if (isset($connection->pdf_img)) {
            $val['img_first'] = $connection->pdf_img;
        }

        // ประมวลผลข้อมูล
        $val = $this->photoselect($val);
        $val = $this->pic_draw($val);
        $val = $this->check_typepdf($val);
        $val = $this->check_department($val);

        $camera_id = @$casedata->cysto_serial . '';
        $tb_scope = (object) Mongo::table("tb_scope")->where("scope_id", intval($camera_id))->first();
        $val['casedata']->cameraname = isset($tb_scope->scope_name) ? $tb_scope->scope_name : '';

        // เลือกประเภท PDF
        if(isset($casedata->pdftype)){
            $pdftype = $casedata->pdftype;
            $val = $this->$pdftype($val);
        }else{
            $val = $this->procedure($val);
        }

        $val = $this->onepage($val);
        $val = $this->html($val);

        // สร้าง PDF
        $namefile = @$casedata->case_hn . "_" . date('Ymd') . "_" . @$procedure->name . ".pdf";
        $pdf = PDF::loadHtml($val['html']);
        $pdf->add_info('Title', "$namefile");
        $pdf->getDomPDF()->set_option('isFontSubsettingEnabled', true);

        // บันทึก PDF และอัปเดต case_pdfversion
        $this->savepdf_with_version_update($val, $pdf, $cid);

        return true;
    }

    public function savepdf_with_version_update($val, $pdf, $cid)
    {
        $tb_case = (object) $val['casedata'];
        $folderdate = $val['folderdate'];
        $hn = isset($tb_case->case_hn) ? $tb_case->case_hn : $tb_case->hn;
        $content = $pdf->output();
        $datetime = date('YmdHis');
        $pdfversion = $hn . '_' . $datetime . '.pdf';

        // สร้างโฟลเดอร์และบันทึกไฟล์
        makedirfull(htdocs("store/$hn/$folderdate/pdf"));
        file_put_contents(htdocs("store/$hn/$folderdate/pdf/$pdfversion"), $content);
        makedirfull(htdocs("store/$hn/temp"));
        file_put_contents(htdocs("store/$hn/temp/temp.pdf"), $content, LOCK_EX);

        // บันทึก log
        $log['case_from'] = $tb_case->caseuniq;
        $log['case_hn'] = $hn;
        $log['path'] = htdocs("store/$hn/$folderdate/pdf/$pdfversion");
        logdata('tb_logpdf', uid(), 'create pdf language change', $log);

        // อัปเดต case_pdfversion
        $temp['user'] = uget("name");
        $temp['when'] = date('Y-m-d H:i:s');
        $temp['pdf'] = $pdfversion;

        // เพิ่มกำกับภาษา
        $language_label = '';
        if (isset($val['casedata']->pdf_language)) {
            if ($val['casedata']->pdf_language == 'th') {
                $language_label = ' (TH)';
            } elseif ($val['casedata']->pdf_language == 'eng') {
                $language_label = ' (ENG)';
            }
        }
        $temp['user'] .= $language_label;

        $case_pdfversion = isset($tb_case->case_pdfversion) ? $tb_case->case_pdfversion : [];
        $case_pdfversion[] = (object) $temp;

        $arr['case_pdfversion'] = $case_pdfversion;
        Mongo::table('tb_case')->where('_id', $cid)->update($arr);
    }


    public function get_gender_name($gender){
        $gender = "-";
        if($gender == 1){
            $gender = "Male";
        }else{
            $gender = "Female";
        }
        return $gender;
    }


    public function savepdf($val, $pdf)
    {
        $tb_case    = (object) $val['casedata'];
        $cid        = $tb_case->id;
        $folderdate = $val['folderdate'];
        $hn         = isset($tb_case->case_hn) ? $tb_case->case_hn : $tb_case->hn;
        $content    = $pdf->output();
        $datetime   = date('YmdHis');
        $pdfversion = $hn . '_' . $datetime . '.pdf';
        makedirfull(htdocs("store/$hn/$folderdate/pdf"));
        file_put_contents(htdocs("store/$hn/$folderdate/pdf/$pdfversion"), $content);
        makedirfull(htdocs("store/$hn/temp"));
        file_put_contents(htdocs("store/$hn/temp/temp.pdf"), $content, LOCK_EX);
        if (isset($tb_case->pdfcreate)) {
            if (!$tb_case->pdfcreate) {
                $log['case_from'] = $tb_case->caseuniq;
                $log['case_hn']   = $hn;
                $log['path'] = htdocs("store/$hn/$folderdate/pdf/$pdfversion");
                logdata('tb_logpdf', uid(), 'create pdf', $log);

                $temp['user']   = uget("name");
                $temp['when']   = date('Y-m-d H:i:s');
                $temp['pdf']    = $pdfversion;

                // เพิ่มกำกับภาษา
                $language_label = '';
                if (isset($tb_case->pdf_language)) {
                    if ($tb_case->pdf_language == 'th') {
                        $language_label = ' (TH)';
                    } elseif ($tb_case->pdf_language == 'eng') {
                        $language_label = ' (ENG)';
                    }
                }
                $temp['user'] .= $language_label;
                if(isset($tb_case->case_pdfversion)){
                    $array      = $tb_case->case_pdfversion;
                    $array[]    = (object) $temp;
                }else{
                    $array[]    = (object) $temp;
                }


                $arr['pdfcreate']       = true;
                $arr['case_pdfversion'] = $array;
                Mongo::table('tb_case')->where('_id', $cid)->update($arr);

            }



        }

        // $mydir = "z:\\";
        // if(file_exists($mydir)){
        //     file_put_contents($mydir.$hn."_".$tb_case->caseuniq.'.pdf', $content);
        // }
    }


    public function pdfendosmart(Request $r)
    {
        $view   = "Recorder.pdf.index";
        $pdf    = PDF::loadView($view, $r);
        return @$pdf->stream();
    }




    public function html($val)
    {
        $val['html'] = '';
        $view = view($val['view'])->with($val);
        $val['html'] .= $view->render();
        $view = view($val['view2'])->with($val);
        $val['html'] .= $view->render();
        return $val;
    }



    public function pic_draw($val)
    {
        $procedure_pic      = $this->change_procedure_pic($val);
        $hn                 = @$val['casedata']->case_hn . "";
        $folderdate         = $val['folderdate'];
        $procedure_picori   = fileconfig("procedure/" . @$procedure_pic . ".jpg");
        $folder_hnpath      = htdocs("store/$hn/$folderdate/");
        $procedure_piccopy  = $folder_hnpath . @$val['casedata']->caseuniq . ".jpg";
        $val['pic_draw']    = @$val['casedata']->caseuniq . ".jpg";
        makedir($folder_hnpath);
        if (!file_exists($procedure_piccopy)) {
            copy($procedure_picori, $procedure_piccopy);
        }
        return $val;
    }

    public function change_procedure_pic($val)
    {
        $procedure_pic      = isset($val['casedata']->procedure_pic) ? $val['casedata']->procedure_pic : $val['casedata']->procedurename;
        $procedure_pic      = str_replace(' ', '_', $procedure_pic);
        return $procedure_pic;
    }

    public function photoselect($val)
    {
        $case_photo         = @$val['casedata']->photo;
        $val['photoselect'] = array();
        foreach (isset($case_photo) ? $case_photo : array() as $photo) {
            $photo = (object) $photo;
            if (isset($photo->ns)) {
                if ($photo->ns > 0 && $photo->st != 10) {
                    $val['photoselect'][$photo->ns]['nu'] = $photo->nu;
                    $val['photoselect'][$photo->ns]['ns'] = $photo->ns;
                    $val['photoselect'][$photo->ns]['na'] = $photo->na;
                    $val['photoselect'][$photo->ns]['sc'] = $photo->sc;
                    $val['photoselect'][$photo->ns]['st'] = $photo->st;
                    $val['photoselect'][$photo->ns]['tx'] = $photo->tx;
                }
            }
        }
        ksort($val['photoselect']);
        return $val;
    }
    public function accessory($val)
    {
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
            $val['num1']            = 7;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = 8;    //9 จำนวนรูปที่แสดงในหน
        } else {
            $val['showprocedure']   = false;
            $val['num1']            = 8;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = 9;    //9 จำนวนรูปที่แสดงในหน
        }
        $val['size_page']           = '50%';
        $val['right_page']          = '48%';
        $val['position']            = 1;
        $val['picperrow']           = 4;
        $val['right_page']          = '65%';
        $val['showprocedure']       = true;
        $val['num1']                = 1000;    //8 จำนวนรูปที่แสดงในหน้าแรก
        $val['num2']                = 1000;    //9 จำนวนรูปที่แสดงในหน
        $val['view']                = "endocapture.pdf.page_accessory";
        $val['view2']               = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']       =  "360px";
        $val['num3']                = 1000;
        $val['picperpage']          = 1000;
        return $val;
    }


    public function ent_standard($val)
    {
        $val['size_page']   = '55%';
        $val['right_page']  = '45%';
        $val['position']    = 1;
        $val['view']        = "endocapture.pdf.page_start";
        $val['view2']       = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "300px";
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
        } else {
            $val['showprocedure']   = false;
        }
        $val['picperrow']   = configTYPE("pdf", "pagetwo");
        if ($val['showprocedure']) {
            $val['num1']    = $val['img_first'] / 2;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']    = $val['img_first'] / 2;    //9 จำนวนรูปที่แสดงในหน
        } else {
            if ($val['img_first'] != 0) {
                $val['img_first'] = ($val['img_first'] / 2);
            }
            $val['num1']    = $val['img_first'];    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']    = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน

        }
        $val['num3']        = 1000; //
        $val['picperpage']  = 16;
        return $val;
    }



    public function procedure($val)
    {

        $val['size_page']       = '50%';
        $val['right_page']      = '45%';
        $val['position']        = 1;
        if (isset(getCONFIG("pdf")->pdf_procedure_pic) && getCONFIG("pdf")->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
            $val['num1']        = 7;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 6;    //9 จำนวนรูปที่แสดงในหน
        } else {
            $val['showprocedure']   = false;
            $val['num1']        = 8;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 9;    //9 จำนวนรูปที่แสดงในหน
        }
        $val['picperrow']       = configTYPE("pdf", "pagetwo");
        $val['view']            = "endocapture.pdf.page_start";
        $val['view2']           = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "360px";
        $val['num3']        = 4;
        $val['picperpage']  = 16;

        return $val;
    }



    public function prc_std7($val)
    {
        $val['size_page']       = '50%';
        $val['right_page']      = '48%';
        $val['position']        = 1;
        $val['pdf_procedure_pic'] = true;
        $val['showprocedure']   = true;
        $val['num1']            = 7;    //8 จำนวนรูปที่แสดงในหน้าแรก
        $val['num2']            = 8;    //9 จำนวนรูปที่แสดงในหน
        $val['picperrow']       = configTYPE("pdf", "pagetwo");
        $val['view']            = "endocapture.pdf.page_start";
        $val['view2']           = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "360px";
        $val['num3']        = 10;
        $val['picperpage']  = 16;
        return $val;
    }





    public function no_writing($val)
    {
        if (isset(getCONFIG("pdf")->pdf_procedure_pic) && getCONFIG("pdf")->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
            $val['num1']        = 7;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 6;    //9 จำนวนรูปที่แสดงในหน
        } else {
            $val['showprocedure']   = false;
            $val['num1']        = 8;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 9;    //9 จำนวนรูปที่แสดงในหน
        }

        $val['size_page']           = '50%';
        $val['right_page']          = '48%';
        $val['position']            = 1;
        $val['picperrow']           = configTYPE("pdf", "pagetwo");
        $val['right_page']          = '65%';
        $val['showprocedure']       = true;

        $val['view']                = "endocapture.pdf.page_no";
        $val['view2']               = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']       = "360px";
        $val['num3']                = 1000;
        $val['picperpage']          = 1000;
        return $val;
    }




    public function long_writing($val)
    {
        $val['size_page']   = '10%';
        $val['right_page']  = '72%';
        $val['position']    = 1;
        $val['view']        = "endocapture.pdf.page_start";
        $val['view2']       = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "550px";
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
        } else {
            $val['showprocedure']   = false;
        }
        $val['picperrow']   = configTYPE("pdf", "pagetwo");
        if ($val['showprocedure']) {
            $val['num1']    = $val['img_first'] / 2;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']    = $val['img_first'] / 2;    //9 จำนวนรูปที่แสดงในหน
        } else {
            if ($val['img_first'] != 0) {
                $val['img_first'] = ($val['img_first'] / 2) + 1;
            }
            $val['num1']    = $val['img_first'];    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']    = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน
        }
        $val['num3']        = 1000; //
        $val['picperpage']  = 16;
        return $val;
    }


    public function procedure_custom($val)
    {
        // dd($val);
        $val['showprocedure']   =  false;
        $val['size_page']       = '50%';
        $val['right_page']      = '48%';
        $val['position']        = 1;
        $val['picperrow']       = configTYPE("pdf", "pagetwo");
        $val['right_page']      = '65%';
        $val['num1']            = 1000;    //8 จำนวนรูปที่แสดงในหน้าแรก
        $val['num2']            = 0;    //9 จำนวนรูปที่แสดงในหน
        $val['view']            = "endocapture.pdf.page_new";
        $val['view2']           = "endocapture.pdf.page_blank";

        $val['leftpagewidth']   = "360px";
        $val['num3']            = 1000;
        $val['picperpage']      = 1000;
        $val['pdfshow']         = false;
        $val['pdfshownew']      = false;
        return $val;
    }
    public function pdf_picturebottom($val)
    {

        if (getCONFIG('admin')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
        } else {
            $val['showprocedure']   = false;
        }
        if ($val['showprocedure']) {
            $val['num1']            = $val['img_first'] ;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน
        } else {
            $val['num1']            = $val['img_first'];    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน
        }
        $val['procedure_type']      = $val['casedata']->pdftype;
        $val['showprocedure']   = true;

        $val['size_page']           = '50%';
        $val['right_page']          = '48%';
        $val['position']            = 1;
        $val['picperrow']           = configTYPE("pdf", "pagetwo");
        $val['right_page']          = '65%';
        $val['showprocedure']       = true;
        $val['num1']                = 4;    //8 จำนวนรูปที่แสดงในหน้าแรก
        $val['num2']                = 1000;    //9 จำนวนรูปที่แสดงในหน
        $val['view']                = "endocapture.pdf.page_new";
        $val['view2']               = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']       = "360px";
        $val['num3']                = 1000;
        $val['picperpage']          = 1000;
        // dd($val);
        return $val;
    }

    public function largepicture($val)
    {
        $val['size_page']       = '50%';
        $val['right_page']      = '30%';
        $val['position']        = 1;
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
            $val['num1']        = 6;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 6;    //9 จำนวนรูปที่แสดงในหน
        } else {
            $val['showprocedure']   = false;
            $val['num1']        = 6;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 6;    //9 จำนวนรูปที่แสดงในหน
        }
        $val['picperrow']       = configTYPE("pdf", "pagetwo");
        $val['view']            = "endocapture.pdf.page_start";
        $val['view2']           = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "150";
        $val['num3']        = 15;
        $val['picperpage']  = 16;
        return $val;
    }
    public function long_image($val)
    {
        $val['size_page']   = '50%';
        $val['right_page']  = '50%';
        $val['position']    = 2;
        $val['view']        = "endocapture.pdf.page_start";
        $val['view2']       = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "360px";
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
        } else {
            $val['showprocedure']   = false;
        }
        $val['picperrow']   = configTYPE("pdf", "pagetwo");
        $val['num1']        = 0; //7
        $val['num2']        = 0; //8
        $val['num3']        = 8; //
        $val['picperpage']  = 9;
        if ($val['img_first'] != 0) {
            $val['num1'] = ($val['img_first'] / 2) - 1;
            $val['num2'] = ($val['img_first'] / 2);
        }
        return $val;
    }

    public function drawing($val)
    {
        $val['size_page']   = '60%';
        $val['right_page']  = '53%';
        $val['position']    = 2;
        $val['view']        = "endocapture.pdf.page_start";
        $val['view2']       = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "360px";
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
        } else {
            $val['showprocedure']   = false;
        }
        $val['picperrow']   = configTYPE("pdf", "pagetwo");
        $val['num1']        = 0; //7
        $val['num2']        = 0; //8
        $val['num3']        = 8; //
        $val['picperpage']  = 9;
        if ($val['img_first'] != 0) {
            $val['num1'] = ($val['img_first'] / 2);
            $val['num2'] = ($val['img_first'] / 2) + 1;
        }
        return $val;
    }

    public function onlypicture($val){
        $val['size_page']       = '50%';
        $val['right_page']      = '48%';
        $val['position']        = 1;
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
            $val['num1']        = 0;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 0;    //9 จำนวนรูปที่แสดงในหน
        }else{
            $val['showprocedure']   = false;
            $val['num1']        = 0;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 0;    //9 จำนวนรูปที่แสดงในหน
        }
        $val['picperrow']       = configTYPE("pdf","pagetwo");
        $val['view']            = "endocapture.pdf.page_start_onlypicture";
        $val['view2']           = "endocapture.pdf.page_blank";
        $val['leftpagewidth']   =  "0";
        $val['num3']        = 15;
        $val['picperpage']  = 16;
        $val['width']       = 300;
        $val['height']       = 200;
        // dd($val);
        return $val;
    }

    public function pathology($val)
    {
        $val['size_page']   = '50%';
        $val['right_page']  = '50%';
        $val['position']    = 2;
        $val['leftpagewidth']   =  "360px";
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
        } else {
            $val['showprocedure']   = false;
        }
        $val['picperrow']     = configTYPE("pdf", "pagetwo");
        $val['num1']        = 8;
        $val['num2']        = 9;
        $val['num3']        = 8;
        $val['picperpage']  = 16;
        $val['view']        = "pdf.pdf_pathology";
        $val['view2']       = "pdf.pdf_pathology_page2";
        return $val;
    }

    public function discharge($val)
    {
        $val['size_page']   = '50%';
        $val['right_page']  = '50%';
        $val['position']    = 2;
        $val['leftpagewidth']   =  "width:10cm;";
        if (isset(getCONFIG('pdf')->pdf_procedure_pic) && getCONFIG('pdf')->pdf_procedure_pic == "true") {
            $val['showprocedure']   = true;
        } else {
            $val['showprocedure']   = false;
        }
        $val['picperrow']   = configTYPE("pdf", "pagetwo");
        $val['view']        = "pdf.pdf_discharge";
        $val['view2']       = "pdf.pdf_discharge_page2";
        $val['num1']        = 4; //7
        $val['num2']        = 5; //8
        $val['num3']        = 8; //
        $val['picperpage']  = 16;
        return $val;
    }

    public function onepage($val)
    {
        $countrow = count($val['photoselect']);
        $val['num'] = ceil(($countrow - $val['num1']) / $val['picperpage']);
        if ($countrow > 16) {
            $val['num'] = $val['num'] + 1;
        }
        $val['pagecurrent'] = 1;
        $val['pageall'] = $val['num'] + 1;

        if ($val['num'] == 0) {
            $val['onepage'] = true;
        } else {
            $val['onepage'] = false;
        }

        return $val;
    }

    public function check_typepdf($val)
    {
        if (!isset($val['casedata']->pdftype)) {
            $val['pdftype'] = "procedure";
        }else{
            $val['pdftype'] = $val['casedata']->pdftype;
        }
        return $val;
    }

    public function check_department($val)
    {
        $val['department'] = uget("department") ?? "GI";
        return $val;
    }


    public function cal_pdf_type($val)
    {
        $procedure_pic      = $this->change_procedure_pic($val);
        $val['tb_case']     = $val['casedata'];
        $count = count($val['photoselect']);
        if ($count < 5) {
            $val['pdftype'] = "long_writing";
        } else {
            $val['pdftype'] = "procedure";
        }
        $procedure_picori   = fileconfig("procedure/" . $procedure_pic . '.jpg');
        $folder_hnpath      = storePATH($val['tb_case']->case_hn . "/" . $val['folderdate'] . '/');
        $procedure_piccopy  = $folder_hnpath . $val['tb_case']->caseuniq . ".jpg";
        $val['pic_draw']    = $val['tb_case']->caseuniq . ".jpg";
        makedir($folder_hnpath);
        if (!file_exists($procedure_piccopy)) {
            copy($procedure_picori, $procedure_piccopy);
        }
        try {
            if (file_exists($procedure_picori) && file_exists($procedure_piccopy)) {
                $ori = Image::make($procedure_picori);
                $end = Image::make($procedure_piccopy);
                if ($ori->filesize() != $end->filesize()) {
                    $val['pdftype'] = "drawing";
                }
            }
        } catch (\Exception $e) {
            // Ignore image processing errors
        }

        //long_image
        foreach ($val['photoselect'] as $data => $photo) {
            if ($photo['ns'] > 0) {
                try {
                    $photo_path = mePHOTO($val['tb_case']->case_hn, $photo['na'], $val['folderdate']);
                    if (file_exists($photo_path)) {
                        $img = Image::make($photo_path);
                        $width = $img->width();
                        $height = $img->height();
                        if ($width > ($height * 2)) {
                            $val['pdftype'] = "long_image";
                        }
                    }
                } catch (\Exception $e) {
                    // Ignore image processing errors
                }
            }
        }
        return $val;
    }
}
