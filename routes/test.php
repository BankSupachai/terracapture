<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Test\HomeController;


$r['']          = HomeController::class;
Route::resources($r);
