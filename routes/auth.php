<?php
use Illuminate\Support\Facades\Route;


Route::resource("google"          ,App\Http\Controllers\Auth\LoginGoogleController::class);
Route::resource("verify"          ,App\Http\Controllers\Auth\VerifiedController::class);
