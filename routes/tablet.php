<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource(""                      ,App\Http\Controllers\Tablet\HomeController::class);
Route::resource("home"                  ,App\Http\Controllers\Tablet\HomeController::class);
Route::resource("procedure"             ,App\Http\Controllers\Tablet\ProcedureController::class);
Route::resource("nursenote"             ,App\Http\Controllers\Tablet\NursenoteController::class);
Route::resource("viewerRegister"       ,App\Http\Controllers\Tablet\RegisViewerController::class);
Route::resource("viewer"                ,App\Http\Controllers\Tablet\ViewerController::class);
Route::resource("casemonitor"           ,App\Http\Controllers\Tablet\CaseMonitorController::class);
Route::resource("cal"                    ,App\Http\Controllers\Tablet\CalController::class);
Route::resource("book"                    ,App\Http\Controllers\Tablet\BookController::class);
Route::resource("bookingview"                    ,App\Http\Controllers\Tablet\BookingViewController::class);
Route::resource("prepare"                    ,App\Http\Controllers\Tablet\PrepareController::class);
Route::resource("chdashboard"                    ,App\Http\Controllers\Tablet\ChDashboardController::class);
Route::resource("scope"                    ,App\Http\Controllers\Tablet\ScopeController::class);

Route::get('editbooking',          function () {return view('EndoBOOK.bookingviewer.editbooking');});
Route::get('showscope',          function () {return view('Endocapture.home.mockup.scope.show');});


Route::get('calendar',          function () {return view('Endocapture.ipad.booking.showcalendar');});


