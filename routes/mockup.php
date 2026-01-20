<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Mockup\HomeController;


// $r['']          = HomeController::class;
// Route::resources($r);


Route::get('dashboard',                 function () {return view('mockup.dashboard');});
Route::get('mockup_add_patient',        function () {return view('EndoNOTE.mockup.add_patient');});
Route::get('mockup_detail_01',          function () {return view('EndoNOTE.mockup.detail_01');});
Route::get('mockup_detail_02',          function () {return view('EndoNOTE.mockup.detail_02');});
Route::get('mockup_detail_03',          function () {return view('EndoNOTE.mockup.detail_03');});
Route::get('mockup_detail_04',          function () {return view('EndoNOTE.mockup.detail_04');});
Route::get('mockup_detail_05',          function () {return view('EndoNOTE.mockup.detail_05');});
Route::get('mockup_mobile_01',          function () {return view('EndoNOTE.mockup.mobile_01');});
Route::get('mockup_mobile_02',          function () {return view('EndoNOTE.mockup.mobile_02');});
Route::get('mockup_queue4',             function () {return view('EndoQUEUE.mockup4');});
Route::get('mockup_queue5',             function () {return view('EndoQUEUE.mockup5');});
Route::get('Advance',                   function () {return view('mockup.Advance');});





Route::get('newdisplay',                 function () {return view('Endocapture.nurse_monitor.mockupnurse.display');});

Route::get('livecase',                 function () {return view('Endocapture.livecase.index');});
Route::get('livecase_camera',                 function () {return view('Endocapture.livecase.live_camera');});


Route::get('newcamera',                 function () {return view('Endocapture.camera.Mockup.camera');});
Route::get('miniselect2',               function () {return view('Endocapture.camera.Mockup.miniselect2');});
Route::get('casemonitorIpad',           function () {return view('Endocapture.nurse_monitor.mockupNurse.ipad.index');});
Route::get('casemonitorIpad2',          function () {return view('Endocapture.nurse_monitor.mockupNurse.ipad.show');});

// IPAD
Route::get('appointment',          function () {return view('Endocapture.home.mockup.appointment');});
Route::get('billing',              function () {return view('Endocapture.home.mockup.billing');});
Route::get('nurserecord',          function () {return view('Endocapture.home.mockup.nurse_record');});
Route::get('operation',            function () {return view('Endocapture.home.mockup.operation');});
Route::get('drawingipad',            function () {return view('Endocapture.home.mockup.drawing');});
Route::get('reportipad',          function () {return view('Endocapture.home.mockup.report');});



Route::get('endocapture',          function () {return view('Endocapture6.index');});
Route::get('endocapture6',          function () {return view('Endocapture6.home');});
Route::get('procedure',          function () {return view('Endocapture6.finding');});
Route::get('casehistory',          function () {return view('Endocapture6.casehistory');});
Route::get('analysis',          function () {return view('Endocapture6.analysis');});

//


// Route::get('bookingipad',          function () {return view('Endocapture.nurse_monitor.mockup.ipad.booking.index');});
// Route::get('calendaripad',          function () {return view('Endocapture.nurse_monitor.mockup.ipad.booking.show');});






Route::get('TvQueue',                   function () {return view('EndoNOTE.mockup.QueueTv.index');});
Route::get('MobileQueue',               function () {return view('EndoNOTE.mockup.QueueTv.mobile');});


// Mockup status server

// Route::get('server',                    function () {return view('Endocapture.errorserver.status');});
Route::get('connect',                    function () {return view('Endocapture.errorserver.connect');});
Route::get('nouser',                    function () {return view('Endocapture.errorserver.nouser');});





Route::get('drawing',                       function () {return view('Endocapture.drawing.index');});
Route::get('crop',                          function () {return view('Endocapture.drawing.crop');});



Route::get('NewUpload',                     function () {return view('Endocapture.selfupload.newindex');});
Route::get('NewMovephoto',                 function () {return view('Endocapture.photomove.newshow');});
Route::get('Newsortphoto',                 function () {return view('Endocapture.imagesort.newshow');});
Route::get('snapshot',                    function() {return view('EndoCAPTURE.snapshot.index');});
Route::get('test',                          function () {return view('Endocapture.testbank');});
Route::get('ComponantSetting',              function () {return view('componantsetting.index');});
Route::get('fullcalendar',              function () {return view('Endobook.home.fullcalendar');});





Route::get('incharge',              function () {return view('endocapture.nurse_monitor.incharge.index');});
