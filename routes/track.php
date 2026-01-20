<?php
use Illuminate\Support\Facades\Route;



// trackkkkkkkkk 202423
Route::resource("reprocessing" ,App\Http\Controllers\EndoTRACK\ReprocessingController::class);
Route::resource("storage"      ,App\Http\Controllers\EndoTRACK\StorageController::class);
Route::resource("waiting"      ,App\Http\Controllers\EndoTRACK\WaitingController::class);


Route::get('index',                       function () {return view('Endotrack.New.index');});
