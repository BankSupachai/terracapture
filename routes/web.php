<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;


//EndoCapture
Route::resource("/"                     , App\Http\Controllers\Capture\HomeController::class);
Route::resource("home"                  , App\Http\Controllers\Capture\HomeController::class);
Route::resource("login"                 , App\Http\Controllers\Capture\LoginController::class);
Route::resource("capture"               , App\Http\Controllers\Capture\CaptureController::class);
Route::resource("procedure"             , App\Http\Controllers\Capture\ProcedureController::class);
Route::resource("report"                , App\Http\Controllers\Capture\ReportController::class);
Route::resource("history"               , App\Http\Controllers\Capture\HistoryController::class);
Route::resource("analysis"              , App\Http\Controllers\Capture\AnalysisController::class);
Route::resource("patient"               , App\Http\Controllers\Capture\PatientController::class);
Route::resource("exportdata"            , App\Http\Controllers\Capture\ExportdataController::class);
Route::resource("registration"          , App\Http\Controllers\Capture\RegistrationController::class);
Route::resource("loadpic"               , App\Http\Controllers\Capture\loadpicController::class);
Route::resource("upload"                , App\Http\Controllers\Capture\SelfuploadController::class);
Route::resource("imagesort"             , App\Http\Controllers\Capture\ImageSortController::class);
Route::resource("photomove"             , App\Http\Controllers\Capture\PhotomoveController::class);
Route::resource("crop"                  , App\Http\Controllers\Capture\CropController::class);
Route::resource("cameracapvdo"          , App\Http\Controllers\Capture\CameraCapVDOController::class);
Route::resource("esign"                 , App\Http\Controllers\Capture\EsignController::class);
Route::resource("casehistory"           , App\Http\Controllers\Capture\CasehistoryController::class);
Route::resource("loadpic2server" , App\Http\Controllers\Capture\LoadPic2ServerController::class);
Route::resource("casemonitor"           ,App\Http\Controllers\Capture\CaseMonitorController::class);
Route::resource("emr"                   ,App\Http\Controllers\Capture\EMRController::class);
Route::resource("storemanage"           ,App\Http\Controllers\Capture\StoremanageController::class);
Route::resource("store"                 ,App\Http\Controllers\Capture\StoreController::class);
Route::resource("patientent"                 ,App\Http\Controllers\Capture\PatientEntController::class);
Route::resource("superadmin"                 ,App\Http\Controllers\Capture\SuperadminController::class);


Route::post('/capture/getBalance', [App\Http\Controllers\Capture\StoremanageController::class, 'getBalance'])->name('capture.getBalance');
Route::get("bookexport",                      function () {return view('capture.historytaking');});

Route::post('logout',                   [CustomAuthController::class, 'logoutcapture'])->name('logoutcapture');

//EndoINDEX


use Livewire\Livewire;

Livewire::setUpdateRoute(function ($handle) {

    // if (file_exists('D:/laragon/htdocs/livewire.txt')) {
    //     $text   = file_get_contents('D:/laragon/htdocs/livewire.txt');
    //     $json   = json_decode($text);
    //     $location = $json->location;
    //     if($location == "local"){
    //         $project = "/".basename(base_path());
    //     }else{
    //         $project = "";
    //     }
    // }else{
    //     $project = "/".basename(base_path());
    // }
    $project = "/".basename(base_path());

    return Route::post("{$project}/livewire/update", $handle);
});
