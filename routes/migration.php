<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::resource('tb_case',      App\Http\Controllers\Migration\TbCaseController::class);
Route::resource('mongo',        App\Http\Controllers\Migration\MongoController::class);
Route::resource('procedure',    App\Http\Controllers\Migration\ProcedureController::class);
Route::resource('user',         App\Http\Controllers\Migration\UserController::class);
Route::resource('scope',        App\Http\Controllers\Migration\ScopeController::class);
Route::resource('date',         App\Http\Controllers\Migration\DateFormatController::class);
