<?php

namespace App\Http\Controllers\capture;

use App\Http\Controllers\Controller;
use App\Models\Mongo;
use App\Models\Department;
use MongoDB\BSON\Regex;
use App\Models\Fileconfig;

use Illuminate\Http\Request;

class CasehistoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $r)
    {
        $view['procedure']          = Department::procedure(uid());
        $view['doctor'] = Department::user('doctor', uid());
        unset($r['_token']);
        $view['tb_case'] = $this->search_history($r);
        $view['project'] = configTYPE("admin", "project");
        $view['search_hn'] = $r->search_hn ?? null;
        $view['search_physician'] = $r->sel_physician ?? null;
        $view['search_procedure'] = $r->sel_procedure ?? null;
        $view['search_keyword'] = $r->search_keyword ?? null;
        $view['date_start'] = $r->date_start ?? null;
        $view['date_end'] = $r->date_end ?? null;;
        $config             = Fileconfig::first("admin");
        $store_url          = !empty($config->endosmart_url) ? $config->endosmart_url : domainname('store');
        $view['store_url']  = $store_url;

        // $config             = getCONFIG("admin");
        // $store_url          = !empty($config->endosmart_url) ? $config->endosmart_url : domainname('store').'/';
        // $view['store_url']  = $store_url;
        return view('capture.casehistory.index', $view);
    }

    public function show($id, Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }



    public function download_video($r)
    {
        // dd($r->all());
        $tb_case = Mongo::table('tb_case')->find($r->cid);

        // ตรวจสอบและใช้ case_hn หรือ hn
        $hn = $tb_case->case_hn ?? $tb_case->hn ?? '';
        $date = $tb_case->appointment_date ?? $tb_case->appointment ?? '';

        // แยกวันที่ออกจาก appointment ถ้ามี
        if (str_contains($date, ' ')) {
            $date = explode(' ', $date)[0];
        }

        $store = domainname('store');
        $file_path = $store . '/' . $hn . '/' . $date . '/';
        $vdo_name = $file_path . '/' . 'vdo' . '/' . $r->video_name;

        // ตรวจสอบว่าไฟล์มีอยู่จริง
        $physical_path = htdocs("store") . '/' . $hn . '/' . $date . '/vdo/' . $r->video_name;
        if (!file_exists($physical_path)) {
            $arr = array();
            $arr['url'] = '';
            $arr['status'] = false;
            $arr['message'] = 'ไม่พบไฟล์วิดีโอ: ' . $r->video_name;
            printJSON($arr);
            return;
        }

        $arr = array();
        $arr['url'] = $vdo_name;
        $arr['status'] = true;
        $arr['message'] = 'ดาวน์โหลดวิดีโอสำเร็จ';
        // dd($arr);
        printJSON($arr);
    }




    public function download_file($r)
    {
        // dd($r->all());
        $tb_case = Mongo::table('tb_case')->find($r->cid);

        // ตรวจสอบและใช้ case_hn หรือ hn
        $hn = $tb_case->case_hn ?? $tb_case->hn ?? '';
        $date = $tb_case->appointment_date ?? $tb_case->appointment ?? '';

        // แยกวันที่ออกจาก appointment ถ้ามี
        if (str_contains($date, ' ')) {
            $date = explode(' ', $date)[0];
        }

        $storeurl = domainname('store');
        $store = htdocs("store");
        $file_path = $store . '/' . $hn . '/' . $date . '/';

        // สร้างโฟลเดอร์ temp ถ้ายังไม่มี
        $temp_path = $file_path . 'temp/';
        if (!file_exists($temp_path)) {
            mkdir($temp_path, 0777, true);
        }

        $photoname = array();

        // เพิ่มรูปภาพ
        $photo = $tb_case->photo ?? [];
        if (!empty($photo) && is_array($photo)) {
            foreach ($photo as $key => $value) {
                if (is_array($value) && isset($value['na'])) {
                    $photo_file = $file_path . $value['na'];
                    if (file_exists($photo_file)) {
                        $photoname[] = $photo_file;
                    }
                } elseif (is_string($value)) {
                    $photo_file = $file_path . $value;
                    if (file_exists($photo_file)) {
                        $photoname[] = $photo_file;
                    }
                }
            }
        }

        // เพิ่ม PDF
        $pdflastversion = $tb_case->case_pdfversion ?? [];
        if (!empty($pdflastversion) && is_array($pdflastversion)) {
            $pdf_end = end($pdflastversion);
            if (is_array($pdf_end) && isset($pdf_end['pdf'])) {
                $pdf_file = $file_path . 'pdf/' . $pdf_end['pdf'];
                if (file_exists($pdf_file)) {
                    $photoname[] = $pdf_file;
                }
            }
        }

        // ถ้าไม่มีไฟล์ใดๆ
        if (empty($photoname)) {
            $arr = array();
            $arr['url'] = '';
            $arr['status'] = false;
            $arr['message'] = 'ไม่พบไฟล์รูปภาพหรือ PDF';
            printJSON($arr);
            return;
        }

        // สร้างไฟล์ ZIP
        $zip = new \ZipArchive();
        $zipFilePath = $temp_path . "photo_report.zip";
        $file_url = $storeurl . '/' . $hn . '/' . $date . '/temp/photo_report.zip';

        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === TRUE) {
            foreach ($photoname as $file) {
                if (file_exists($file)) {
                    $fileContent = file_get_contents($file);
                    $zip->addFromString(basename($file), $fileContent);
                }
            }
            $zip->close();

            $arr = array();
            $arr['url'] = $file_url;
            $arr['status'] = true;
            $arr['message'] = 'ดาวน์โหลดสำเร็จ';
            printJSON($arr);
        } else {
            $arr = array();
            $arr['url'] = '';
            $arr['status'] = false;
            $arr['message'] = 'ไม่สามารถสร้างไฟล์ ZIP ได้';
            printJSON($arr);
        }
    }


    public function photo($r)
    {
        $view['cid'] = $r->cid;
        $tb_case = Mongo::table('tb_case')->find($r->cid);

        // ตรวจสอบและใช้ case_hn หรือ hn
        $hn = $tb_case->case_hn ?? $tb_case->hn ?? '';
        $date = $tb_case->appointment_date ?? $tb_case->appointment ?? '';

        // แยกวันที่ออกจาก appointment ถ้ามี
        if (str_contains($date, ' ')) {
            $date = explode(' ', $date)[0];
        }

        $view['tb_case'] = $tb_case;
        $view['date'] = $date;
        $view['hn'] = $hn;
        $view['store'] = domainname('store');
        return view("capture.casehistory.photo", $view);
    }

    public function video($r)
    {
        $view['cid'] = $r->cid;
        $tb_case = Mongo::table('tb_case')->find($r->cid);

        // ตรวจสอบและใช้ case_hn หรือ hn
        $hn = $tb_case->case_hn ?? $tb_case->hn ?? '';
        $date = $tb_case->appointment_date ?? $tb_case->appointment ?? '';

        // แยกวันที่ออกจาก appointment ถ้ามี
        if (str_contains($date, ' ')) {
            $date = explode(' ', $date)[0];
        }

        $view['tb_case'] = $tb_case;
        $view['date'] = $date;
        $view['hn'] = $hn;
        $view['store'] = domainname('store');
        return view("capture.casehistory.video", $view);
    }









    public function download($r)
    {
        // dd($r->all());
        $view['cid'] = $r->cid;
        $tb_case = Mongo::table('tb_case')->find($r->cid);

        // Debug: ตรวจสอบข้อมูลที่ได้จาก MongoDB
        // dd($tb_case);

        // ตรวจสอบและใช้ case_hn หรือ hn
        $hn = $tb_case->case_hn ?? $tb_case->hn ?? '';
        $date = $tb_case->appointment_date ?? $tb_case->appointment ?? '';

        // แยกวันที่ออกจาก appointment ถ้ามี
        if (str_contains($date, ' ')) {
            $date = explode(' ', $date)[0];
        }

        // ตรวจสอบวิดีโอในโครงสร้างข้อมูลต่างๆ
        $vdo_name = [];
        $vdo_file = $tb_case->video ?? null;

        if (!empty($vdo_file) && (is_array($vdo_file) || is_object($vdo_file))) {
            foreach ($vdo_file as $value) {
                if (is_string($value)) {
                    $vdo_name[] = $value;
                } elseif (is_array($value) && isset($value['na'])) {
                    $vdo_name[] = $value['na'];
                } elseif (is_object($value) && isset($value->na)) {
                    $vdo_name[] = $value->na;
                }
            }
        }

        $view['vdo_name'] = $vdo_name;
        $view['date'] = $date;
        $view['hn'] = $hn;
        $view['store_htdocs'] = htdocs('store');
        $view['tb_case'] = $tb_case;

        // Debug: ตรวจสอบข้อมูลที่จะส่งไป view
        // dd([
        //     'cid' => $view['cid'],
        //     'hn' => $view['hn'],
        //     'date' => $view['date'],
        //     'vdo_name' => $view['vdo_name']
        // ]);

        return view("capture.casehistory.download", $view);
    }


    public function search_history(Request $r)
    {
        // dd($r->all());+

        $tb_case = Mongo::table("tb_case");
        if (checkNULL(@$r->search_keyword)) {
            $tb_case = $tb_case->where('case_status', '!=', 90);
            $tb_case->where(function ($query) use ($r) {
                $query->where('case_hn', "like", "%" . $r->search_keyword . "%")
                    ->orWhere('patientname', "like", "%" . $r->search_keyword . "%")
                    ->orWhere('doctorname', "like", "%" . $r->search_keyword . "%")
                    ->orWhere("department", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("statusjob", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("procedurename", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("treatment_coverage", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("case_history", "like", "%" . $r->search_keyword . "%")

                    ->orWhere("medication_unit", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("medi_other", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("indication", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("indication_other", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("anesthesia", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("anesthesiaother", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("finding", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("overall_finding", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("diagnostic_text", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("overall_diagnosis", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("procedure_subtext", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("bowel_other", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("bowelpreparation", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("gastriccontent", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("specimen1", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("specimen2", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("specimen3", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("specimen4", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("box_rapid_pending", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("rapid_other", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("complication", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("prediagnostic_other", "like", "%" . $r->search_keyword . "%")

                    ->orWhere("complication_other", "like", "%" . $r->search_keyword . "%")

                    ->orWhere("technique_other", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("case_comment", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("assistant", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("urgent", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("overall_procedure", "like", "%" . $r->search_keyword . "%")
                    ->orWhere("urgent", "like", "%" . $r->search_keyword . "%")
                    ->orWhere('photo.tx', 'regexp', new Regex(preg_quote($r->search_keyword), 'i'));
                    

            });
        }
        $tb_case->where(function ($query) use ($r) {
            if (isset($r->sel_procedure)) {
                $query->where('case_procedurecode', $r->sel_procedure ?? "");
            }

            if (isset($r->sel_physician)) {

                $query->where('case_physicians01', intval($r->sel_physician ?? ""));
            }

            if (isset($r->date_start)) {
                $query->where('appointment_date', '>=', $r->date_start);
            }

            if (isset($r->date_end)) {
                $query->where('appointment_date', '<=', $r->date_end);
            }
            if (isset($r->search_hn)) {
                $query->where('case_hn', "like", "%" . $r->search_hn ?? "");
            }
        });

        $tb_case = $tb_case->orderBy('appointment_date', 'desc')->paginate(50);


        return $tb_case;
    }
}
