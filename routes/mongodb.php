<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



// Route::resource('tb_case',  App\Http\Controllers\MongoDB\TbCaseController::class);
Route::resource('',         App\Http\Controllers\MongoDB\HomeController::class);
Route::resource('browse',   App\Http\Controllers\MongoDB\BrowseController::class);
Route::resource('dump',     App\Http\Controllers\MongoDB\DumpController::class);
Route::resource('record',   App\Http\Controllers\MongoDB\RecordController::class);
Route::resource('backup',   App\Http\Controllers\MongoDB\backupController::class);
