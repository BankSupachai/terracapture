<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;

class PatientgetController extends Controller
{
    public function index(){
        dd("mmmmd");
    }

    public function store(Request $r)
    {
        // switch($r->event){
        //     case "get_patient_form_db"  : $this->get_form_db($r);   break;
        //     case "get_patient_form_api" : $this->get_form_api($r);   break;
        // }

        $head           = configTYPE('pdf', 'pdf_folder_head');
        $docroot        = $_SERVER['DOCUMENT_ROOT'];
        $pathhispatient = "$docroot/config/views/his/$head/$r->event.blade.php";
        $view['hn']     = $r->hn;

        if(is_file($pathhispatient)){
            $data = view("his.$head.$r->event",$view)->render();
            echo $data;
        }
    }


    public function get_form_db($r){
        $head           = configTYPE('pdf', 'pdf_folder_head');
        $docroot        = $_SERVER['DOCUMENT_ROOT'];
        $pathhispatient = "$docroot/config/views/his/$head/patient_db.blade.php";
        $view['hn']     = $r->hn;

        if(is_file($pathhispatient)){
            $data = view("his.$head.patient_db",$view)->render();
            echo $data;
        }
    }







}
