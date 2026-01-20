<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use DB;
use Image;
use Illuminate\Http\Request;

class Send2CloudController extends Controller
{
    public function __construct()
    {
        checklogin();
    }

    public function index(Request $r){
        if(isset($r->cloud2book)){
            $this->cloud2book();
        }
    }


    public function show($id){
        $this->book($id);
    }

    public function book($id){

        $checkconnect = $this->checkconnect();
        if($checkconnect==false){
            echo "Can't connection to Cloud";
            return "Can't connection to Cloud";
        }

        $tb_send2cloud = DB::table('tb_send2cloud')->where('send2cloud_system',$id)->first();
        DB::table('tb_send2cloud')->where('send2cloud_date','!=',date('Y-m-d'))->delete();
        if($tb_send2cloud!=null){
            $post['json']   = $tb_send2cloud->send2cloud_json;
            $post['event']  = 'register_book';
            $url    = "http://medicaendo.com/endocloud/api/book";
            $res    = connectwebPOST($url,$post);
            $json   = jsonDecode($res);
            echo $res;
            if(isset($json->status)){
                if($json->status){
                    DB::table('tb_send2cloud')
                    ->where('send2cloud_id',$tb_send2cloud->send2cloud_id)
                    ->delete();
                }
            }
        }
    }




    public function checkconnect(){
        $file = 'http://medicaendo.com/endocloud/api/book';
        $file_headers = @get_headers($file);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            $exists = false;
        }
        else {
            $exists = true;
        }

        return $exists;

    }




    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=="book"){
                $this->book("book");
            }
        }
    }





}
