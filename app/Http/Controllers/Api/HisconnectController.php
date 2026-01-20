<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;

class HisconnectController extends Controller
{
    public function index(){
        dd("mmmmd");
    }

    public function store(Request $r)
    {
        $head           = configTYPE('pdf', 'pdf_folder_head');
        $docroot        = $_SERVER['DOCUMENT_ROOT'];
        $pathhispatient = "$docroot/config/views/his/$head/$r->event.blade.php";
        $view['r']      = $r;
        if(is_file($pathhispatient)){
            $data = view("his.$head.$r->event",$view)->render();
            echo $data;
        }
    }




}
