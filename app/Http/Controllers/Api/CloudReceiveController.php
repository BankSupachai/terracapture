<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Image;
use App\Models\Mongo;


class CloudReceiveController extends Controller
{



    public function index()
    {
        echo "aaaaaaa";
    }

    public function store(Request $r)
    {
        switch ($r->event) {
            case "camera_receive":
                $this->camera_receive($r);
                break;
            case "prepare_receive":
                $this->prepare_receive($r);
                break;
            case "caseoncloud_receive":
                $this->caseoncloud_receive($r);
                break;
            case "cloud_case":
                $this->cloud_case($r);
                break;
            case "file_exit":
                $this->file_exit($r);
                break;
            case "upload_file":
                $this->upload_file($r);
                break;

        }
    }

    public function upload_file($r){
        $folder2 = "D:\laragon\htdocs\medicaendo.com\cloud\\$r->hospitalcode\\$r->hn\\$r->appointment_date";
        makedirfull($folder2);
        $pic = jsonDecode($r->pic);
        foreach($pic as $item){
            file_put_contents($folder2."\\".$item->name, base64_decode($item->base64));
        }
    }



    public function show($id){
        //For TEST อ่านค่าไฟล์ที่หมดที่อยู่ใน Folder แล้วแปลงเป็น json
        $newid = str_replace("|", "\\", $id);
        // D:\laragon\htdocs\medicaendo.com\cloud\10000\TEST20230528\2023-05-28
        $basepath   = "D:\laragon\htdocs\medicaendo.com\cloud";
        $dir  = "$basepath\\$newid";
        $i      = 0;
        $arr    = array();
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if(filesize("$dir\\$file")>5000){
                        $arr[$i]['name'] = $file;
                        $arr[$i]['size'] = filesize("$dir\\$file");
                        $i++;
                    }
                }
                closedir($dh);
            }
        }
        printJSON($arr);
        // dd($arr);
    }



    public function cloud_case($r)
    {
        $json       = (array) jsonDecode($r->json);
        $json['noteid']     = $r->noteid;
        $json['caseuniq']   = $r->caseuniq;
        $w[0]       = array("caseuniq", $r->caseuniq);
        $w[1]       = array("hospitalcode", $json['hospitalcode']);
        $tb_case    = Mongo::table("tb_case")->where($w)->first();
        if (isset($tb_case['caseuniq'])) {
            Mongo::table("tb_case")->where($w)->update($json);
        } else {
            Mongo::table("tb_case")->insert($json);
        }
        echo "success";
    }




    public function caseoncloud_receive($r)
    {
        $val['noteid']         = $r->noteid;
        $val['hospital_code']  = "10672";
        Mongo::table("tb_caseoncloud")->insert($val);
    }



    public function camera_receive($r)
    {
        $folder = "D:\\laragon\\htdocs\\liveconsult\\$r->cid";
        makedirfull($folder);
        $filename = $folder . "/" . $r->filename . ".jpg";
        file_put_contents($filename, file_get_contents($r->pic));
        echo "camera_receive on cloud";
    }

    public function prepare_receive($r)
    {
        $hospital_code          = $r->hospital_code;
        $arr                    = (array) jsonDecode($r->json);
        $arr['hospital_code']   = $hospital_code;
        $arr['noteid']          = $r->noteid;
        $w[] = array("hospital_code", $hospital_code);
        $w[] = array("noteid", $r->noteid);
        $tb_casenote = Mongo::table("tb_casenote")->where($w)->first();
        if ($tb_casenote == null) {
            Mongo::table("tb_casenote")->insert($arr);
        } else {
            Mongo::table("tb_casenote")->where($w)->update($arr);
        }
    }
}
