<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::get('notallow',                          function () {return view('extra.notallow');});
Route::get('booknew2',                          function () {return view('EndoBOOK.new.new');});
Route::get('print',                             function () {return view('EndoBOOK.new.print');});
Route::get('testadmin',                         function () {return view('test.testadmin');});  //add admin
Route::get('testadmin02',                       function () {return view('test.testadmin02');}); // add all user
Route::get('testscope',                         function () {return view('test.testscope');}); // scope
Route::get('addscope',                          function () {return view('test.addscope');}); // add scope
Route::get('testroom',                          function () {return view('test.testroom');}); //  room
Route::get('addroom',                           function () {return view('test.addroom');}); //  addroom
Route::get('testdepartment',                    function () {return view('test.testdepartment');}); //  department
Route::get('adddepartment',                     function () {return view('test.adddepartment');}); //  add department
Route::get('addtreatment',                      function () {return view('test.addtreatment');}); //  add
Route::get('testui',                            function () {return view('test.testui');});
Route::get('book_test',                         function () {return view('EndoBOOK.new.setting');});
Route::get('booksearch',                        function () {return view('EndoBOOK.mobile.search');});
Route::get('book_mobile',                       function () {return view('EndoBOOK.mobile.mobile_home');});
Route::get('patientui',                         function () {return view('case.procedure_select_new');});




Route::resource("/"                             ,App\Http\Controllers\EndoBOOK\HomeController::class);
Route::resource("book"                          ,App\Http\Controllers\EndoBOOK\BookController::class);


Route::resource("cal"   ,App\Http\Controllers\EndoBOOK\CalController::class);
Route::resource("bookingview"   ,App\Http\Controllers\EndoBOOK\BookingViewController::class);



Route::resource("casemonitor"                   ,App\Http\Controllers\EndoBOOK\CasemonitorController::class);
Route::resource("home"                          ,App\Http\Controllers\EndoBOOK\HomeController::class);
Route::resource("doctor"                        ,App\Http\Controllers\EndoBOOK\DoctorController::class);
Route::resource("patient"                       ,App\Http\Controllers\EndoBOOK\PatientController::class);
Route::resource("booking"                       ,App\Http\Controllers\EndoBOOK\BookingController::class);
Route::resource("followup"                      ,App\Http\Controllers\EndoBOOK\FollowupController::class);
Route::resource("booknew"                       ,App\Http\Controllers\EndoBOOK\BooknewController::class);
Route::resource("prepare"                       ,App\Http\Controllers\EndoBOOK\PrepareController::class);
Route::resource("createcase"                    ,App\Http\Controllers\EndoBOOK\CreatecaseController::class);
Route::resource("department"                    ,App\Http\Controllers\EndoBOOK\DoctorController::class);
Route::resource("emergency"                     ,App\Http\Controllers\EndoBOOK\EmergencyController::class);
Route::resource("book_print"                    ,App\Http\Controllers\EndoBOOK\BookprintController::class);
Route::resource("book2cloud"                    ,App\Http\Controllers\EndoBOOK\Book2CloudController::class);
Route::resource("bookmobile"                    ,App\Http\Controllers\EndoBOOK\BookmobileController::class);
Route::resource("bookrecord"                    ,App\Http\Controllers\EndoBOOK\BookrecordController::class);
Route::resource("bookimport"                    ,App\Http\Controllers\EndoBOOK\BookimportController::class);
Route::resource("booksetting"                   ,App\Http\Controllers\EndoBOOK\BookSettingController::class);
Route::resource("registration"                  ,App\Http\Controllers\EndoBOOK\RegistrationController::class);
Route::resource("setting_doctor"                ,App\Http\Controllers\EndoBOOK\SettingDoctorController::class);
Route::resource("setting_procedure"             ,App\Http\Controllers\EndoBOOK\SettingProcedureController::class);
Route::resource("setting_department"            ,App\Http\Controllers\EndoBOOK\SettingDepartmentController::class);
Route::resource("patienthistory"            ,App\Http\Controllers\EndoBOOK\PatientHistoryController::class);

Route::resource("bookexport"            ,App\Http\Controllers\EndoBOOK\BookExportController::class);




Route::resource("setting_departmentcalendar"    ,App\Http\Controllers\EndoBOOK\SettingDepartmentCalendarController::class);
