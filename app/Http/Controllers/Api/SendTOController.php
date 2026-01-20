<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessFileCopy;
use App\Models\Datacase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Image;
use App\Models\Mongo;
use App\Models\Photo;
use App\Models\Config;
use App\Models\Server;
use App\Models\Qfile;
use App\Models\Allpath;
use Carbon\Carbon;
use Exception;
use ZipArchive;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class SendtoController extends Controller
{



    public function index()
    {
        echo "aaaaaaa";
    }

    public function emr2dir($r)
    {

        $arr = $this->emrpdf($r);
        if($arr['status'] != 'success'){
            $arr = $this->emrimg($r);
        }

        if(isset($r->group)){
            $group = $r->group;
            $emr = getCONFIG("emr");
            $vdo = "vdo$group";
            $vdo = $emr->$vdo;
            $path = "path$group";
            $path = $emr->$path;
            if($vdo){
                $arr = $this->vdo($r,$path);
            }
        }

        printJSON($arr);
    }

    public function vdo($r,$path)
    {
        $tb_case = Datacase::first($r->cid);
        $video = $tb_case->video;
        $pathvdo = Allpath::vdodir($tb_case);
        foreach($video as $item){
            $val['path_begin']  = "$pathvdo/$item";
            $val['path_end']    = $path;
            $val['status']      = 'waiting';
            Qfile::insert($val);
        }
        $arr['status'] = 'success';
        return $arr;
    }



    public function emrpdf($r)
    {
        $tb_case        = Datacase::first($r->cid);
        // $emr            = Config::obj('emr');
        $emr = (object) Mongo::table("tb_config")->where("config_type","emr")->first();
        $pathgroup      = "path$r->group";
        $pdfgroup       = "pdf$r->group";
        $arr            = array();
        $arr['status']  = 'unsuccess';
        if ($emr->$pdfgroup) {
            try {
                $folderdate     = date("Y-m-d");
                $hn             = $tb_case->case_hn;
                $name           = $tb_case->patientname;
                $procedure      = $tb_case->procedurename;
                $datetime       = date("YmdHis");
                $exfolder       = explode("\\", $emr->$pathgroup);
                $exfilename     = explode("_", end($exfolder));
                array_pop($exfolder);
                $tempfolder = array();
                foreach ($exfolder as $data) {
                    if ($data == '$folderdate') {
                        $tempfolder[] = $folderdate;
                    } else {
                        $tempfolder[] = $data;
                    }
                }
                $folder     = implode("\\", $tempfolder);
                makedirfull($folder);
                $tempname   = "";
                foreach ($exfilename as $data) {
                    $tempname .= ($data == '$hn') ? $hn . "_" : '';
                    $tempname .= ($data == '$name') ? $name . "_" : '';
                    $tempname .= ($data == '$procedure') ? $procedure . "_" : '';
                    $tempname .= ($data == '$datetime') ? $datetime . "_" : '';
                }
                $fullpath   = $folder . "\\" . $tempname . ".pdf";
                $pdf_file   = $fullpath;
                copy(htdocs("store/$hn/temp/temp.pdf"), $pdf_file);
                $arr['status']  = 'success';
            } catch (\Throwable $th) {}
        }
        return $arr;
    }


    public function emrimg($r)
    {
        $tb_case        = Datacase::first($r->cid);
        // $emr            = Config::obj('emr');
        $emr = (object) Mongo::table("tb_config")->where("config_type","emr")->first();
        $pathgroup      = "path$r->group";
        $imggroup       = "img$r->group";
        $arr            = array();
        $arr['status']  = 'unsuccess';
        if ($emr->$imggroup) {
            try {
            $folderdate     = $tb_case->appointment_date;
            $hn             = $tb_case->case_hn;
            $name           = $tb_case->patientname;
            $procedure      = $tb_case->procedurename;
            $datetime       = date("YmdHis");
            $exfolder       = explode("\\", $emr->$pathgroup);
            $exfilename     = explode("_", end($exfolder));
            array_pop($exfolder);
            $tempfolder = array();
            foreach ($exfolder as $data) {
                if ($data == '$folderdate') {
                    $tempfolder[] = $folderdate;
                } else {
                    $tempfolder[] = $data;
                }
            }
            $folder     = implode("\\", $tempfolder);
            makedirfull($folder);
            $tempname   = "";
            foreach ($exfilename as $data) {
                $tempname .= ($data == '$hn') ? $hn . "_" : '';
                $tempname .= ($data == '$name') ? $name . "_" : '';
                $tempname .= ($data == '$procedure') ? $procedure . "_" : '';
                $tempname .= ($data == '$datetime') ? $datetime . "_" : '';
            }
            $arr['filein']  = htdocs("store/$hn/temp/temp.pdf");
            $arr['fileout'] = $folder . "\\" . $tempname;
            $arr['type']    = "jpg";
            $arr['zoom']    = 2;
            $jsonEN         = jsonEncode($arr);
            $base64         = base64_encode($jsonEN);
            $status = shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");
            $arr['status'] = $status;
            } catch (\Throwable $th) {}
        }
        return $arr;
    }


    public function show($id)
    {
        if ($id == "cloud_case") {
            $this->cloud_case();
        }
        if ($id == "photo2cloud") {
            $this->photo2cloud();
        }
    }


    public function photo2cloud()
    {
        $data   = (object) Mongo::table("tb_cloudtempphoto")->first();
        $photo  = $data->photo;
        $path   = "D:/laragon/htdocs/store/$data->case_hn/$data->appointment_date";
        $arr    = array();
        $arrbase = array();
        $i      = 0;
        foreach ($photo as $item) {
            $item = (object) $item;
            if ($item->ns > 0) {
                // $arr[$i]['base64']  = $this->img_encode64("$path/$item->na");
                $arrbase[]          = $item->na;
                $arr[$i]['name']    = $item->na;
                $arr[$i]['size']    = filesize("$path/$item->na");
                $i++;
            }
        }

        $json = $this->cloud_fileexit("http://medicaendo.com/api/cloudreceive/10000|TEST20230528|2023-05-28");
        $cloudarr = jsonDecode($json);

        if (isset($cloudarr[0])) {
            $arrnew = $arrbase;
        } else {
            $arrnew = array();
            $file_ex = false;
            foreach ($arr as $step01 => $key01) {
                foreach ($cloudarr as $step02) {
                    if ($key01['name'] == $step02->name) {
                        if ($key01['size'] != $step02->size) {
                            $arrnew[] = $key01['name'];
                        }
                        $file_ex = true;
                    }
                }
                if (!$file_ex) {
                    $arrnew[] = $key01['name'];
                }
                $file_ex = false;
            }
        }
        $i      = 0;
        $arrimgname = array();
        $arrimgbase = array();
        foreach ($arrnew as $item) {
            $arrimg[$i]['base64']   = $this->img_encode64("$path/$item");
            $arrimg[$i]['name']     = $item;
            $i++;
        }


        $url                        = "http://medicaendo.com/api/cloudreceive";
        $post['hospitalcode']       = "10000";
        $post['hn']                 = $data->case_hn;
        $post['appointment_date']   = $data->appointment_date;
        $post["event"]              = "upload_file";
        $post["pic"]                = jsonEncode($arrimg);
        $mmm = connectwebPOST($url, $post);
        // echo $mmm;
        dd($arrnew, "mdfdskljfdsfl");
    }


    public function cloud_fileexit($path)
    {
        return connectweb($path);
    }

    public function download_photo($r)
    {
        $get_type = $r->ck_get_type;
        foreach (isset($r->case_ids) ? $r->case_ids : [] as $i => $case_id) {
            // dd($case_id);
            $tb_case = Mongo::table('tb_case')->where('_id', $case_id)->first();
            if (isset($tb_case)) {
                $tb_case = (object)$tb_case;
                $case_hn = $tb_case->case_hn;
                $datetime = $tb_case->appointment;
                $exp = explode(' ', $datetime);
                $folderdate = $exp[0];
                $photo = isset($tb_case->photo) ? $tb_case->photo : [];
                $casepdf = isset($tb_case->case_pdfversion) ? $tb_case->case_pdfversion : [];
                $video = isset($tb_case->video) ? $tb_case->video : [];
                // dd($video);
                // $video = isset($tb_case->video) ? $tb_case->video:[];

                $storepath    = "D:/laragon/htdocs/store/$case_hn/$folderdate/";

                $testpart       = "$r->case_drive/$case_hn";

                // dd($testpart);
                $zip = new ZipArchive;
                if (!file_exists($testpart . "/$folderdate")) {
                    mkdir($testpart . "/$folderdate", 0777, true);
                }

                $descpath = $testpart . "/$folderdate";

                if (in_array('report', $get_type)) {
                    zip_hn_pdf($case_hn, $storepath, $descpath, $casepdf, "pdf");
                }


                if (in_array('photo', $get_type)) {
                    zip_hn_photo($case_hn, $storepath, $descpath, $photo, "na");
                }

                if (in_array('video', $get_type)) {
                    load_hn_video($case_hn, $storepath, $descpath, $video, "video");
                }



                // dd($case_hn , $folderdate , $photo);
            }
        }
        // dd(1);
    }


    public function filter_sendto($r)
    {
        // dd($r->all());
        $w[] = array('case_status', '!=', 99);

        // $w[] = array('appointment', 'like', '%'.date("Y-m-d") . '%');


        if (isset($r->search_hn1)) {
            $w[] = array('case_hn', 'like', '%' . $r->search_hn1 . '%');
        }
        if (isset($r->search_name1)) {
            $w[] = array('patientname', 'like', '%' . $r->search_name1 . '%');
        }
        if (isset($r->search_sendto_doctor)) {
            $w[] = array('case_physicians01', 'like', '%' . $r->search_sendto_doctor . '%');
        }
        if (isset($r->search_date)) {
            $w[] = array('appointment_date', 'like', '%' . $r->search_date . '%');
        }

        $tb_case = Mongo::table('tb_case')->where($w)->get();

        // dd($r->all());

        // dd($tb_case, $w);

        return jsonEncode($tb_case);
    }

    public function img_encode64($path)
    {
        $type   = pathinfo($path, PATHINFO_EXTENSION);
        $data   = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }






    public function cloud_case()
    {
        $tb_cloudtemp = Mongo::table('tb_cloudtemp')->first();
        if (isset($tb_cloudtemp['case_hn'])) {
            $id = $tb_cloudtemp['_id'];
            unset($tb_cloudtemp['_id']);
            $json = jsonEncode($tb_cloudtemp);
            $url                = "http://110.171.123.140/endoindex/api/cloudreceive";
            $post["event"]      = "cloud_case";
            $post["json"]       = $json;
            $post["caseuniq"]   = $tb_cloudtemp['caseuniq'];
            $post["noteid"]     = $tb_cloudtemp['noteid'];
            $res = connectwebPOST($url, $post);
            echo $res;
            if ($res == "success") {
                Mongo::table('tb_cloudtemp')->where('_id', $id)->delete();
            }
        }
    }


    public function camera_sendto($r)
    {
        $url                = "http://medicaendo.com/api/cloudreceive";
        $post["event"]      = "camera_receive";
        $post["cid"]        = $r->cid;
        $post['filename']   = $r->imgname;
        $post["pic"]        = $this->encode64("D:\\laragon\\htdocs\\ScreenRecord", $post['filename']);
        $post['filename']   = str_replace('.jpg', '', $post['filename']);
        $res = connectwebPOST($url, $post);
    }


    public function check_capture_photo($r)
    {
        $imgname = $r->imgname;
        $path = htdocs('ScreenRecord') . "\\$imgname";
        $size = file_exists($path) ? filesize($path) : 0;
        $hn = $r->hn;
        $arr = [];
        try {
            $exp = explode('_', $imgname);
            $cid = $exp[0];
            $case = Datacase::first($cid);
            $arr['case_hn'] = @$case->case_hn . "";
            $arr['path'] = $path;
        } catch (\Exception $e) {
        }
        $arr['hn']   = $hn;

        Photo::logphoto($imgname, 'footswitch', $size, $arr);
    }

    public function encode64($temppath, $filename)
    {
        $path   = "$temppath/$filename";
        $type   = pathinfo($path, PATHINFO_EXTENSION);
        $data = "D:/laragon/htdocs/ScreenRecord/$filename";

        try {
            $data   = file_get_contents($data);
        } catch (Exception $e) {
        }
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }

    public function send_video($r)
    {
        $drives = $r->drive;
        $cid    = $r->cid;
        $case   = (object) Mongo::table('tb_case')->where('_id', $cid)->first();
        $videos = $case->video;
        $hn     = isset($case->case_hn) ? $case->case_hn : $case->hn;
        $folderdate = isset($case->appointment) ? explode(' ', $case->appointment)[0] : $case->appointment_date;

        // $lumina = getCONFIG("lumina");
        // $def_room = $lumina->default_room;
        $tb_lumina  = (object) Mongo::table('tb_lumina')->where('id', 1)->first();
        $def_room = $tb_lumina->default_room;

        $ori = storePATH("$hn/$folderdate/vdo");
        $result = '';
        foreach (isset($drives) ? $drives : [] as $drive) {

            if (!is_dir("$drive/$def_room/")) {
                try {
                    makedirfull("$drive/$def_room/");
                } catch (\Exception $e) {
                }
            }



            foreach (isset($videos) ? $videos : [] as $index => $videopath) {
                $filepath = "$ori/$videopath";
                $videopath = $this->rename_file($case, $videopath, $index + 1);
                $desc     = "$drive/$def_room/$videopath";
                // dd($filepath, $desc);
                try {
                    ProcessFileCopy::dispatch($filepath, $desc);
                    $result = true;
                } catch (\Exception $e) {
                }
            }
        }
        return $result;
    }

    public function rename_file($case, $filename, $index)
    {
        $exp = explode('.', $filename);
        $ext = $exp[1];

        $datetime = explode(' ', $case->appointment);
        $folderdate = isset($datetime[0]) ? str_replace('-', '', $datetime[0]) : '';
        $foldertime = isset($datetime[1]) ? str_replace(':', '', $datetime[1]) : '';
        $hn          = @$case->case_hn . "";
        $patientname = @$case->patientname . "";

        $newfilename = "$folderdate-$foldertime-$hn-$patientname-$index.$ext";

        return $newfilename;
    }

    public function render_summary_graph($r)
    {
        $scriptPath = htdocs('endoindex') . "\public\pdf\main.py";
        try {
            $process = new Process(['python', $scriptPath]);
            $process->run();
        } catch (\Throwable $th) {
            dd($th);
        }
        return response()->json(['pdfUrl' => configTYPE('admin', 'htdocs_base') . '/store/summary_report.pdf']);
    }

    public function remove_summary_graph($r)
    {
        $pdf_path = htdocs('store') . '/summary_report.pdf';
        if (file_exists($pdf_path)) {
            unlink($pdf_path);
        }
        echo '';
    }

    public function log_export($r)
    {
        $log['datetime'] = Carbon::now()->toDateTimeString();
        $user = (object) Server::table('users')->where('uid', intval($r->userid))->first();
        $log['user_name'] = fullName($user) ?? "";
        $log['filetype'] = @$r->filetype . "";
        if ($r->export_type == 'summary') {
            $log['summary_type'] = @$r->summary_id . "";
        }
        logdata('tb_logexport', $r->userid, "export " . $r->export_type, $log);
    }


    public function zip_file($r)
    {
        $get_type = $r->type ?? [];
        $ids  = $r->ids ?? [];
        $is_allphoto = $r->allphoto ?? 'false';

        $admin = getCONFIG('admin');
        $storeurl = $admin->store_url;

        foreach ($ids as $i => $case_id) {
            $tb_case = Mongo::table('tb_case')->where('_id', $case_id)->first();
            if (isset($tb_case)) {
                $tb_case        = (object)$tb_case;
                $case_hn        = @$tb_case->case_hn . "";
                $datetime       = @$tb_case->appointment . "";
                $procedurename  = @$tb_case->procedurename . "";
                $exp            = explode(' ', $datetime);
                $folderdate     = $exp[0];
                $photo          = isset($tb_case->photo) ? $tb_case->photo : [];
                $casepdf        = isset($tb_case->case_pdfversion) ? $tb_case->case_pdfversion : [];
                $video          = isset($tb_case->video) ? $tb_case->video : [];
                $date_only      = str_replace('-', '', @$folderdate . "");

                if ($is_allphoto == "false") {
                    $photo = array_filter($photo, function ($p) {
                        return $p['ns'] != '0' || $p['ns'] != 0;
                    });
                } else {
                    $photo = array_values($photo);
                }

                $storepath      = "D:/laragon/htdocs/store/$case_hn/$folderdate/";
                $temppath       = "D:/laragon/htdocs/store/temp";

                $descpath       = $temppath . "/$folderdate";
                $zipname        = $date_only . "_$case_hn" . "_$procedurename" . "_" . date('His') . '.zip';

                $log['case_hn']   = $case_hn;
                $log['type']      = 'download';

                $zip = new ZipArchive;
                if (!file_exists($temppath . "/$folderdate")) {
                    mkdir($temppath . "/$folderdate", 0777, true);
                }

                if ($zip->open("$descpath/$zipname", ZipArchive::CREATE) === true) {

                    if (in_array('photo', $get_type)) {
                        zip_file($zip, $storepath, $photo, 'photo');
                    }

                    if (in_array('report', $get_type)) {
                        $new_pdf = $casepdf;
                        usort($new_pdf, function ($a, $b) {
                            $a = $a['when'] ? strtotime($a['when']) : PHP_INT_MIN;
                            $b = $b['when'] ? strtotime($b['when']) : PHP_INT_MIN;
                            return $a - $b;
                        });
                        if (count($new_pdf) > 0) {
                            $new_pdf = gettype($new_pdf) == 'array' ? [end($new_pdf)] : [];
                            zip_file($zip, $storepath, $new_pdf, 'report');
                        }
                    }

                    if (in_array('video', $get_type)) {
                        $fullpath = array_map(function ($filename) use ($storeurl, $folderdate, $case_hn) {
                            return "$storeurl" . "$case_hn/$folderdate/vdo/$filename";
                        }, $video);

                        $arr['type']  = 'video';
                        $arr['files'] = $fullpath;

                        $log['path']      = jsonEncode($video);
                        logdata('tb_logsendto', uid(), "sendto", $log);

                        $u['user'] = @uget('user_firstname') . ' ' . @uget('user_lastname');
                        $u['when'] = Carbon::now()->toDateTimeString();
                        $u['file'] = $fullpath;
                        $prev = $tb_case->download ?? [];
                        $prev[] = $u;
                        $up['download'] = $prev;
                        Mongo::table('tb_case')->where('_id', $case_id)->update($up);

                        return jsonEncode($arr);
                    }

                    $zip->close();
                    $arr['type']  = 'photo';
                    $arr['files'] = "$storeurl" . "temp/$folderdate/$zipname";
                    $arr['status'] = file_exists($temppath . "/$folderdate/$zipname");
                    if ($arr['status']) {
                        $u['user'] = @uget('user_firstname') . ' ' . @uget('user_lastname');
                        $u['when'] = Carbon::now()->toDateTimeString();
                        $u['file'] = $zipname;
                        $prev = $tb_case->download ?? [];
                        $prev[] = $u;
                        $up['download'] = $prev;
                        Mongo::table('tb_case')->where('_id', $case_id)->update($up);
                    }

                    $log['path']      = $zipname;
                    logdata('tb_logsendto', uid(), "sendto", $log);

                    return jsonEncode($arr);
                } else {
                    echo "Cannot open the zip file";
                    return 'error';
                }
            }
        }
    }

    public function createpacs_sendto($r)
    {
        $ids                = $r->ids ?? [];
        $types              = $r->type ?? [];
        $is_allphoto        = $r->allphoto ?? 'false';
        $admin              = getCONFIG('admin');
        $storeurl           = $admin->store_url;

        $arr['is_allphoto'] = $is_allphoto;
        $arr['storeurl']    = $storeurl;
        $val                = [];

        foreach ($ids as $in => $id) {
            $arr['cid'] = $id;
            $val[$in]['cid'] = $id;
            foreach ($types as $type) {
                $arr['type'] = $type;
                $status     = $this->create_request($arr);
                if ($type == 'pdf') {
                    $val[$in]['type'][] = $type;
                    $val[$in]['status'][] = $status;
                }
            }
        }

        return jsonEncode($val);
    }

    // public function check_files_exist($hn, $folderdate){
    //     $files = scandir("D:\dicom\backup");
    //     foreach ($files as $file) {
    //         if ($file !== '.' && $file !== '..') {

    //         }
    //     }
    // }

    public function create_request($arr)
    {
        $pacspython     = new PacsPythonController();
        $case           = Datacase::first($arr['cid']);
        $case_pdf       = $case->case_pdfversion ?? [];
        $latest_pdf     = $case_pdf;

        $storeurl       = $arr['storeurl'] ?? '';
        $dicomtype      = $arr['type'] ?? '';
        $is_allphoto    = $arr['is_allphoto'] ?? 'false';

        $hn             = @$case->case_hn . "";
        $datetime       = @$case->appointment . "";
        $exp            = explode(' ', $datetime);
        $folderdate     = $exp[0];
        $status         = false;

        if ($dicomtype == 'pdf' && count($latest_pdf) == 0) {
            return $status;
        }

        if ($dicomtype == 'pdf') {
            usort($latest_pdf, function ($a, $b) {
                $a = $a['when'] ? strtotime($a['when']) : PHP_INT_MIN;
                $b = $b['when'] ? strtotime($b['when']) : PHP_INT_MIN;
                return $a - $b;
            });

            if (is_array($latest_pdf) && count($latest_pdf) > 0) {
                $latest_pdf = end($latest_pdf)['pdf'] ?? '';
            }
        } else {
            $latest_pdf = "";
        }

        $event = @$is_allphoto . "" == 'send_pacs' ? 'send_pacs' : "dicom_$dicomtype";

        $r    = Request::create('api/pacspython', 'POST', [
            "event" => $event,
            "url" => "$storeurl" . "$hn/$folderdate/pdf/$latest_pdf",
            "cid" => strval(@$case->id . ""),
            "hn" => $case->hn,
            "folderdate" => $folderdate,
            "pacs_caseuniq" => $case->caseuniq,
            "pacs_comcreate" => $case->comcreate,
            "is_photoall" => $is_allphoto,
        ]);

        switch ($r->event) {
            case "dicom_photo":
                $pacspython->dicom_photo($r);
                $status = $pacspython->create_dicom($r);
                break;
            case "dicom_pdf":
                $pacspython->dicom_pdf($r);
                $status = $pacspython->create_dicom($r);
                break;
            case "dicom_photopdf":
                $pacspython->dicom_photopdf($r);
                $status = $pacspython->create_dicom($r);
                break;
            case "send_pacs":
                $status = $pacspython->send_pacs($r);
                break;
        }

        return $status;
    }

    public function delete_file($r)
    {
        $temppath       = "D:/laragon/htdocs/store/temp";
        $zipurl         = $r->url ?? '';
        $exp            = explode('/', $zipurl);
        $zipname        = gettype($exp) == 'array' ? end($exp) : '';
        $filepath       = "$temppath/$zipname";
        if (file_exists($filepath)) {
            unlink($filepath);
            return 'success';
        }
    }
}
