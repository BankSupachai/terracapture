<?php
use Illuminate\Support\Facades\Route;
Route::get('logdata',               function () {return view('EndoCAPTURE.logdata');});
Route::get('logedit',               function () {return view('EndoCAPTURE.logedit');});
Route::resource("config"            ,App\Http\Controllers\Admin\ConfigController::class);
Route::resource("user"              ,App\Http\Controllers\Admin\UserSettingController::class);
Route::resource("department"        ,App\Http\Controllers\Admin\DepartmentSettingController::class);
Route::resource("scope"             ,App\Http\Controllers\Admin\ScopeSettingController::class);
Route::resource("room"              ,App\Http\Controllers\Admin\RoomSettingController::class);
Route::resource("hospital"          ,App\Http\Controllers\Admin\HospitalController::class);
Route::resource("procedure"         ,App\Http\Controllers\Admin\ProcedureController::class);
Route::resource("treatment"         ,App\Http\Controllers\Admin\TreatmentController::class);
Route::resource("log"               ,App\Http\Controllers\Admin\LogDataController::class);
Route::resource("case"              ,App\Http\Controllers\Admin\CaseSettingController::class);
Route::resource("role"              ,App\Http\Controllers\Admin\RoleController::class);
Route::resource("migrate"           ,App\Http\Controllers\Admin\MigrateDataController::class);
Route::resource("worklist"          ,App\Http\Controllers\Admin\WorklistSettingController::class);
Route::resource("procedureclone"    ,App\Http\Controllers\Admin\ProcedurecloneController::class);
Route::resource("mysql2mongo"       ,App\Http\Controllers\Admin\Mysql2mongoController::class);
Route::resource("createfolder"       ,App\Http\Controllers\Admin\CreateFolderController::class);

Route::resource("template"       ,App\Http\Controllers\Admin\TemplateController::class);


Route::resource("patient"       ,App\Http\Controllers\Admin\PatientController::class);


