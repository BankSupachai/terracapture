<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;

use App\Models\Datacase;

class PatientController extends Controller
{
    public function index(){
        dd("mmmmd");
    }

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $this->$event($r);
        }
    }

    public function patient_check($r){
        $tb_patient = Mongo::table("tb_patient")->where("hn",$r->hn)->first();
        if(isset($tb_patient->id)){
            $arr['firstname']   = $tb_patient->firstname;
            $arr['lastname']    = $tb_patient->lastname;
            $arr['hn']          = $tb_patient->hn;
            $arr['mongoid']     = (string) $tb_patient->id;
            $arr['status']      = true;
        }else{
            $arr['status']      = false;
        }
        printJSON($arr);
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
