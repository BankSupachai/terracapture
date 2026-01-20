<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::resource("pdf"       ,App\Http\Controllers\Terra\PDFController::class);
Route::resource(""          ,App\Http\Controllers\Terra\HomeController::class);
Route::resource("home"      ,App\Http\Controllers\Terra\HomeController::class);
Route::resource("case"      ,App\Http\Controllers\Terra\CaseController::class);
Route::resource("w-viewer"    ,App\Http\Controllers\Terra\ViewerController::class);
Route::resource("import"    ,App\Http\Controllers\Terra\ImportController::class);





Route::get('w-record',                  function () {return view('EndoCAPTURE.wait.record');});
Route::get('w-worklist',                function () {return view('EndoCAPTURE.wait.worklist');});
Route::get('w-store',                   function () {return view('EndoCAPTURE.wait.store');});
Route::get("w-setting",                 function () {return view('EndoCAPTURE.wait.setting.video');});
Route::get('w-setting/video',           function () {return view('EndoCAPTURE.wait.setting.video');});
Route::get('w-setting/sound',           function () {return view('EndoCAPTURE.wait.setting.sound');});
Route::get('w-setting/storage',         function () {return view('EndoCAPTURE.wait.setting.storage');});
Route::get('w-setting/connection',      function () {return view('EndoCAPTURE.wait.setting.connection');});
Route::get('w-setting/about',           function () {return view('EndoCAPTURE.wait.setting.about');});
Route::get('w-setting/shutdown',        function () {return view('EndoCAPTURE.wait.setting.shutdown');});
// Route::get('w-viewer',                  function () {return view('Terra.wait.viewer');});
Route::get('w-viewerphone',                  function () {return view('Terra.wait.verifyphone');});
Route::get('w-main',                    function () {return view('Terra.wait.main');});
Route::get('w-import',                  function () {return view('Terra.wait.import');});
Route::get('w-export',                  function () {return view('Terra.wait.export');});

Route::get('w-mobile',                  function () {return view('Terra.viewer.show-mobile');});


