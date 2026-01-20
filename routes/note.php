<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource("/"                 ,App\Http\Controllers\EndoNOTE\NoteController::class);
Route::resource("note"              ,App\Http\Controllers\EndoNOTE\NoteController::class);
Route::resource("notepdf"           ,App\Http\Controllers\EndoNOTE\NotepdfController::class);
Route::resource("generate"          ,App\Http\Controllers\EndoNOTE\GenerateController::class);
// Route::resource("notepatient"       ,App\Http\Controllers\EndoNOTE\NotepatientController::class);
Route::resource("record"            ,App\Http\Controllers\EndoNOTE\RecordController::class);
Route::resource("reportfollowup"    ,App\Http\Controllers\EndoNOTE\ReportFollowupController::class);
Route::resource("billing"           ,App\Http\Controllers\EndoNOTE\BillingController::class);
Route::resource("health"           ,App\Http\Controllers\EndoNOTE\HealthController::class);
Route::resource("patienthistory"    ,App\Http\Controllers\EndoNOTE\PatientHistoryController::class);


Route::resource("paper"    ,App\Http\Controllers\EndoNOTE\PaperController::class);




