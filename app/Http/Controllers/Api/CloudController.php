<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Mongo;
use Illuminate\Http\Request;


class CloudController extends Controller
{

    public function index(){
        /* ส่งรูป PDF ของเคสขึ้นไปยัง cloud */
        $tb_logpdf = Mongo::table("tb_logpdf")
        // ปลดคอมเมนต์ออก เมื่อใช้งานจริง
        // ->where("cloud","!=","success")
        ->get();
        $arr = array();
        $rrr = array();
        foreach ($tb_logpdf as $logpdf){

            $file   = str_replace("/","\\",$logpdf['path']);
            $cid    = $logpdf['case_from'];
            $hn     = $logpdf['case_hn'];
            if(file_exists($file)){
                $arr['filein']  = $file;
                $arr['fileout'] = htdocs("cloud/case/$cid"."_".$hn."_");
                $arr['type']    = "jpg";
                $arr['zoom']    = 1.5;
                $jsonEN         = jsonEncode($arr);
                $base64         = base64_encode($jsonEN);
                shell_exec("D:\allindex\pdf2img\__pycache__\pdf.cpython-310.pyc $base64");
                $val['cloud'] = "success";
                Mongo::table("tb_logpdf")->where("_id",$logpdf['_id'])->update($val);

            }
        }


        printJSON($rrr);
    }


    public function create(){
        $hospital = getCONFIG("hospital");
        $url = "http://endoindex.com/api/case";
        $post['event']  = "pdfphoto";
        $post['hospitalcode'] = $hospital->hospital_code;
        $dir = exfolder("cloud\case");
        $files1 = scandir($dir);

        unset($files1[0]);
        unset($files1[1]);

        foreach ($files1 as $filename) {
            $exfile = explode("_", $filename);

            $tb_case = Mongo::table("tb_case")->where("_id",$exfile[0])->first();
            // $rrr[] = $tb_case;
            // dd($tb_case);
            $post['tb_case']    = jsonEncode($tb_case??[]);
            $post['hn']         = $exfile[1]??"nohn";
            $post['filename']   = $filename;
            $imagedata          = file_get_contents($dir."/".$filename);
            $post['base64']     = base64_encode($imagedata);
            connectwebPOST($url,$post);
            rename(exfolder("cloud\case\\$filename"), exfolder("cloud\backup\\$filename"));
            sleep(1);
        }

    }







    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $this->$event($r);
        }
    }


    public function iudb($r)
    {
        $json   = jsonDecode($r->json);

        // echo jsonEncode($json->value);


        $table  = $json->table;
        $value  = (array) $json->value;
        $check  = $json->check;
        $temp = Mongo::table($table)->where($check)->first();
        if($temp==null){
            Mongo::table($table)->insert($value);
            $arr['process'] = "insert";
        }else{
            Mongo::table($table)->where($check)->update($value);
            $arr['process'] = "update";
        }

        $arr['status'] = "success";
        printJSON($arr);
    }


}
