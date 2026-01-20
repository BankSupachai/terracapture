<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::resource("/"         ,App\Http\Controllers\Recorder\RecordController::class);
Route::resource("patient"   ,App\Http\Controllers\Recorder\PatientController::class);
Route::resource("caselist"  ,App\Http\Controllers\Recorder\CaselistController::class);






