<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::resource("appointment", App\Http\Controllers\Api\AppointmentController::class);
Route::resource("book2cloud", App\Http\Controllers\Api\Book2CloudController::class);
Route::resource("procedure", App\Http\Controllers\Api\ProcedureController::class);
Route::resource("cloud", App\Http\Controllers\Api\CloudController::class);
Route::resource("jquery", App\Http\Controllers\Api\JqueryController::class);
Route::resource("convert", App\Http\Controllers\Api\ConvertController::class);
Route::resource("photo", App\Http\Controllers\Api\PhotoController::class);
Route::resource("photomove", App\Http\Controllers\Api\PhotomoveController::class);
Route::resource("mainpart", App\Http\Controllers\Api\MainpartController::class);
Route::resource("pdfnurse", App\Http\Controllers\Api\PdfnurseController::class);
Route::resource("queue", App\Http\Controllers\Api\QueueController::class);
Route::resource("track", App\Http\Controllers\Api\TrackController::class);
Route::resource("readcitizencard", App\Http\Controllers\Api\ReadCitizencardController::class);
Route::resource("billhomc", App\Http\Controllers\Api\BillingHOMCController::class);
Route::resource("registration", App\Http\Controllers\Api\RegistrationController::class);
Route::resource("case", App\Http\Controllers\Api\CaseController::class);
Route::resource("pdf", App\Http\Controllers\Api\PDFController::class);
Route::resource("image", App\Http\Controllers\Api\ImageController::class);
Route::resource("esign", App\Http\Controllers\Api\EsignController::class);
Route::resource("bookset", App\Http\Controllers\EndoBOOK\Api\BooksetController::class);
Route::resource("ordata", App\Http\Controllers\Api\OrdataController::class);
Route::resource("calbook", App\Http\Controllers\Api\CalbookController::class);
Route::resource("worklist", App\Http\Controllers\Api\WorklistController::class);
Route::resource("patient", App\Http\Controllers\Api\PatientController::class);
Route::resource("patientget", App\Http\Controllers\Api\PatientgetController::class);
Route::resource("livestream", App\Http\Controllers\Api\LiveStreamController::class);
Route::resource("his", App\Http\Controllers\Api\HisController::class);
Route::resource("emr", App\Http\Controllers\Api\EMRController::class);
Route::resource("pacspython", App\Http\Controllers\Api\PacsPythonController::class);
Route::resource("sony", App\Http\Controllers\Api\SonyController::class);
Route::resource("synchronize", App\Http\Controllers\Api\SynchronizeController::class);
Route::resource("home", App\Http\Controllers\Api\HomeController::class);
Route::resource("sendto", App\Http\Controllers\Api\SendtoController::class);
Route::resource("cloudreceive", App\Http\Controllers\Api\CloudReceiveController::class);
Route::resource("semi", App\Http\Controllers\Api\SemiController::class);
Route::resource("hisconnect", App\Http\Controllers\Api\HisconnectController::class);
Route::resource("endosmartdata", App\Http\Controllers\Api\EndosmartDATAController::class);
Route::resource("capture", App\Http\Controllers\Api\CaptureController::class);
Route::resource("recorder", App\Http\Controllers\Api\RecorderController::class);
Route::resource("lumina", App\Http\Controllers\Api\LuminaController::class);
Route::resource("casemonitor", App\Http\Controllers\Api\CasemonitorController::class);
Route::resource("nursereport", App\Http\Controllers\Api\NurseReportController::class);
Route::resource("adfs", App\Http\Controllers\Api\ADFSController::class);
Route::resource("icd10", App\Http\Controllers\Api\icd10Controller::class);
Route::resource("icd9", App\Http\Controllers\Api\icd9Controller::class);
Route::resource("seminew", App\Http\Controllers\Api\SemiNewController::class);
Route::resource("prepare", App\Http\Controllers\EndoBOOK\Api\PrepareController::class);



Route::resource("sms", App\Http\Controllers\Api\SMSController::class);


/*Custom Controller Hospital*/
Route::resource("ramaconnect", App\Http\Controllers\Api\RamaConnectController::class);
Route::resource("softcon", App\Http\Controllers\Api\SoftconController::class);
Route::resource("siphconnect", App\Http\Controllers\Api\SIPHConnectController::class);
Route::resource("lampangcancer", App\Http\Controllers\Api\LampangcancerController::class);


/* Usercode */
Route::resource("usercode", App\Http\Controllers\Api\UsercodeController::class);
Route::middleware('auth:api')->get('/user', function (Request $r) {
    return $r->user();
});
Route::post('/check-doctor-code', [App\Http\Controllers\Api\UsercodeController::class, 'checkDoctorCode']);
