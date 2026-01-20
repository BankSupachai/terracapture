<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HisController extends Controller
{

    public function index(){
        $data = connectGETJSON("https://isuandok.med.cmu.ac.th/gateway/patient/hn/2803587",$this->header());
        echo jsonEncode(jsonDecode($data));
    }

    public function header(){
        $head = configTYPE('pdf', 'pdf_folder_head');
        $tokenlogin     = htdocs("config/views/his/$head/tokenlogin.txt");
        if(is_file($tokenlogin)){}else{$this->login();}
        $token          = file_get_contents($tokenlogin);
        $header[0]      = 'Authorization: Bearer '.$token;
        return $header;
    }


    public function store(Request $r){
        switch($r->event){
            case "get_patient_detail"   :   $this->get_patient_detail($r);      break;
            case "refreshTOKEN"         :   $this->refreshTOKEN($r);            break;
            case "use_config_his"       :   $this->use_config_his($r);            break;
        }
    }

    public function get_patient_detail($r){
        $data = connectGETJSON($r->url,$this->header());
        echo jsonEncode(jsonDecode($data));
    }

    public function use_config_his($r){
        $file   = $r->file;
        $head   = configTYPE('pdf', 'pdf_folder_head');
        include(htdocs("config/views/his/$head/$file.php"));
    }

    public function refreshTOKEN($r){
        $head   = configTYPE('pdf', 'pdf_folder_head');
        $uid    = htdocs("config/views/his/$head/appID.txt");
        $url    = $r->url.$uid;
        $data   = connectGETJSON($url,$this->header());
        $json   = jsonDecode($data);
        file_put_contents(htdocs("config/views/his/$head/tokenlogin.txt"), $json->v->token);
    }









}
