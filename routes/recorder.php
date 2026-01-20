<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('edit',       function () {return view('lumina.patient.edit');});
Route::get('imgs',       function () {return view('lumina.store.imgslide');});
Route::resource("/"         ,App\Http\Controllers\Recorder\RecordController::class);
Route::resource("worklist"  ,App\Http\Controllers\Recorder\WorklistController::class);
Route::resource("setting"   ,App\Http\Controllers\Recorder\SettingController::class);
Route::resource("storage"   ,App\Http\Controllers\Recorder\StorageController::class);
Route::resource("record"    ,App\Http\Controllers\Recorder\RecordController::class);
Route::resource("print"     ,App\Http\Controllers\Recorder\PrintController::class);
Route::resource("patient"   ,App\Http\Controllers\Recorder\PatientController::class);
Route::resource("caselist"  ,App\Http\Controllers\Recorder\CaselistController::class);
Route::resource("server"    ,App\Http\Controllers\Recorder\ServerController::class);





