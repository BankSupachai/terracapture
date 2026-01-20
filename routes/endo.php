<?php

use Illuminate\Support\Facades\Route;

Route::resource("crop"                      ,App\Http\Controllers\Endocapture\CropController::class);
Route::resource("export"                    ,App\Http\Controllers\Endocapture\ExportController::class);
Route::resource("camera"                    ,App\Http\Controllers\Endocapture\CameraController::class);
Route::resource("loadpic"                   ,App\Http\Controllers\Endocapture\LoadPicController::class);
Route::resource("patient"                   ,App\Http\Controllers\Endocapture\PatientController::class);
Route::resource("/"                         ,App\Http\Controllers\Endocapture\CaselistController::class);
Route::resource("photomove"                 ,App\Http\Controllers\Endocapture\PhotomoveController::class);
Route::resource("imagesort"                 ,App\Http\Controllers\Endocapture\ImageSortController::class);
Route::resource("procedure"                 ,App\Http\Controllers\Endocapture\ProcedureController::class);
Route::resource("selfupload"                ,App\Http\Controllers\Endocapture\SelfuploadController::class);
Route::resource("registration"              ,App\Http\Controllers\Endocapture\RegistrationController::class);
Route::resource("procedure-setting"         ,App\Http\Controllers\Endocapture\ProceduresettingController::class);
Route::resource("report"                    ,App\Http\Controllers\Endocapture\ReportEndoCaptureController::class);
