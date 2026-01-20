<?php
use Illuminate\Support\Facades\Route;

Route::resource("viewer"    ,App\Http\Controllers\Mobile\ViewerController::class);
Route::resource("book"      ,App\Http\Controllers\Mobile\BookController::class);
Route::resource("statistic" ,App\Http\Controllers\Mobile\StatisticController::class);
Route::resource("line"      ,App\Http\Controllers\Mobile\LineController::class);

Route::get('cancel',                     function () {return view('mobile.book.cancel');});
Route::get('event',                      function () {return view('mobile.book.event');});
