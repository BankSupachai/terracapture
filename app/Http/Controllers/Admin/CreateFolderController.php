<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;

class CreateFolderController extends Controller
{

    public function index(){}

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }


function createFolderIfNotExists($path) {

    if (!file_exists($path)) {

        return mkdir($path, 0777, true) ? 1 : 0;
    } else {
        return 2;
    }
}







    public function checkfolder($r){

        $dicom = "D:/$r->dicom";
        $screenrecord = "D:/laragon/htdocs/$r->screenrecord";
        $store = "D:/laragon/htdocs/$r->store";
        $capture = "D:/$r->capture";



        $createfolder_dicom = $this->createFolderIfNotExists($dicom);
        $createfolder_screenrecord = $this->createFolderIfNotExists($screenrecord);
        $createfolder_store = $this->createFolderIfNotExists($store);
        $createfolder_capture = $this->createFolderIfNotExists($capture);



    }


}
