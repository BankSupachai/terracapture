<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('edit',       function () {return view('lumina.patient.edit');});
Route::get('imgs',       function () {return view('lumina.store.imgslide');});
Route::resource("/"             ,App\Http\Controllers\Lumina\RecordController::class);
Route::resource("worklist"      ,App\Http\Controllers\Lumina\WorklistController::class);
Route::resource("setting"       ,App\Http\Controllers\Lumina\SettingController::class);
Route::resource("storage"       ,App\Http\Controllers\Lumina\StorageController::class);
Route::resource("record"        ,App\Http\Controllers\Lumina\RecordController::class);
Route::resource("print"         ,App\Http\Controllers\Lumina\PrintController::class);
Route::resource("patient"       ,App\Http\Controllers\Lumina\PatientController::class);
Route::resource("caselist"      ,App\Http\Controllers\Lumina\CaselistController::class);
Route::resource("server"        ,App\Http\Controllers\Lumina\ServerController::class);
Route::resource("video"        ,App\Http\Controllers\Lumina\VideoPreviewController::class);


