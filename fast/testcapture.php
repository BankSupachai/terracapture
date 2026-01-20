<!DOCTYPE html>
<html lang="en" data-layout-mode="dark">

<head><meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>
    <link rel="stylesheet"
        href="{{ url('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" />
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <link href="{{ url('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ url('public/css/input/main.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/icons.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/custom.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/select2.min.css') }}" />
    <title>Camera</title>
    <?php include("css_00.blade.php"); ?>
    <!-- @include('EndoCAPTURE.camera.obs.css_00') -->
    <script>
        (function() {
            if (localStorage.getItem('cameraPageOpen')) {
                window.location.href = '{{ url('capture/'.$cid.'/edit') }}';
                return;
            }

            localStorage.setItem('cameraPageOpen', 'true');

            window.addEventListener('beforeunload', function() {
                localStorage.removeItem('cameraPageOpen');
            });
        })();
        </script>
</head>
<!-- <?php include("modal_scope_alert.blade.php"); ?> -->
<!-- <?php include("liveconsult_modal.blade.php"); ?> -->
<!-- @include('capture.camera.modal.modal_scope_alert') -->
<!-- @include('endocapture.camera.mockup.liveconsult_modal') -->
<!-- @include('endocapture.camera.mockup.livestream_modal') -->
<!-- @include('endocapture.camera.mockup.medi_modal') -->
<!-- @include('endocapture.camera.modal.modal_signal_lost') -->


<!-- @include('capture.camera.modal.modal_new_case') -->
<!-- @include('capture.camera.modal.modal_sms') -->
<!-- @include('endocapture.camera.04controller') -->
<!-- @include('capture.camera.modal.modal_progress_camera') -->
<!-- @include('capture.camera.modal.modal_casetest') -->
<!-- @include('capture.camera.modal.modal_brightness') -->
<!-- @include('capture.camera.modal.modal_livecase') -->
<!-- @include('EndoCAPTURE.camera.component.modal_camera') -->
<!-- @include('capture.camera.component.offcanvas.attendant') -->
<!-- @include('EndoCAPTURE.camera.component.offcanvas.camerasetting') -->
<style>
    #video1 {
        height: 75vh;
    }
    :root {
            --vz-input-bg {
                color: #00000;
            }

        }

        .form-select {
            --vz-input-bg: #2B2F34;
            color: #CFD4D9;
            border: 0;
        }

        .btn-dark-primary {
            background: #245788;
            color: #fff;

        }

        .bd-white {
            border: 1px solid #707070;
        }

        .btn-record {
            background: #ffffff;
            color: #000000;

        }

        .btn-record:hover {
            background: rgb(225, 224, 224);
            color: #fff;

        }

        .text-bbbb {
            color: #bbbbbb;
        }


        [data-layout-mode=dark] {
            --vz-input-bg: #2B2F34;
            --vz-body-bg: #000;
        }

        body {
            /* height: 100vh; */
            font-size: 14px;
            overflow-x: hidden;
            font-family: 'kanit';
            touch-action: none;
        }

        .p-custom {
            padding: 10px;
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: Light;
            src: url("{{ url('public/fonts/Kanit-Light.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-Bold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Italic.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-ExtraBoldItalic.ttf') }}") format("truetype");
        }

        .box-detail {
            background: #222529;
            border-radius: 4px;

        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px white;
            background: rgb(24, 23, 23);
        }

        ::-webkit-scrollbar-thumb {
            background: rgb(206, 206, 206);
        }

        ::-webkit-scrollbar-thumb:hover {
            transition: 0.3s;
            background: rgb(99, 98, 98);
        }

        .box-capture-image {
            position: relative;
            margin-top: 1em;
        }

        .box-capture-image:first-child {
            margin-top: 0;
        }

        .box-capture-list {
            position: relative;
            margin-top: 1em;
        }

        .box-capture-list:first-child {
            margin-top: 0;
        }

        .number-cap {
            position: absolute;
            font-size: x-large;
            color: white;
            left: 48%;
            top: 47%;
            text-shadow: 0px 0px 5px black;
        }

        .box-capture {
            height: 37vh;
            overflow-y: auto;
        }







        .point-top1 {
            transform: rotate(0deg);
            position: absolute;
            top: 0rem;
            left: -0.5rem;
            z-index: 9;
            height: {{ $camera->marker_height ?? 7.7 }}vh;
        }

        .point-bottom1 {
            transform: rotate(0deg);
            position: absolute;
            top: 71vh;
            right: 0rem;
            z-index: 9;
            height: {{ $camera->marker_height ?? 7.7 }}vh;
        }

        .point-top11 {
            transform: rotate(0deg);
            position: absolute;
            top: 0rem;
            left: -0.5rem;
            z-index: 9;
            height: {{ $camera->marker_height ?? 7.7 }}vh;
        }

        .point-bottom11 {
            transform: rotate(0deg);
            position: absolute;
            top: 0;
            /* left: 0rem; */
            z-index: 9;
            height: {{ $camera->marker_height ?? 7.7 }}vh;
        }

        .point-top21 {
            transform: rotate(0deg);
            position: absolute;
            top: 0rem;
            z-index: 9;
            height: 8vh;
        }

        .point-bottom2 {
            transform: rotate(0deg);
            position: absolute;
            right: 0rem;
            z-index: 9;
            height: 8vh;
        }





        .text-white-camera {
            color: #CFD4D9;
        }

        .scroll {
            height: 7.5em;
            overflow: auto;
        }

        .btn-dark-primary:hover {
            background: #173857;
            color: #fff;

        }

        .btn-white-camera {
            background: white;
            color: #000;
        }

        .btn-white-camera:hover {
            background: transparent;
            color: #ffff;
            border: 1px solid #bbbbbb;
        }

        .choices__list--dropdown {
            bottom: 100% !important;
            top: auto;
        }

        .h-button {
            height: 53px;
        }

        .cs {
            cursor: pointer;
        }

        .btn-record>i {
            color: red;
            background: transparent;
        }

        .btn-record.active {
            background: red !important;
            border: 0 !important;
        }

        .btn-record.active>i {
            animation-name: loop_record;
            animation-duration: 0.5s;
            animation-iteration-count: infinite;

        }

        .col-7 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 57.333333%;
            padding-right: 2em;
        }

        @keyframes slideInleft {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(0);
            }
        }

        .bar-header {
            animation: 1s ease-in-out 0s 1 slideInleft
        }

        .border-r {
            border-radius: 4px 4px 0px 0px;
            ;
        }

        @keyframes loop_record {
            from {
                color: rgb(253, 10, 10);
            }

            to {
                color: rgb(250, 159, 159);
            }
        }

        .close-hover:hover {
            cursor: pointer;
            font-weight: bold;
        }

        .choices__list--dropdown {
            height: 6.7em;
        }

        .position-warning-signal {
            position: absolute;
            top: 0%;
        }

        .select2-results__option {
            padding: 6px;
            user-select: none;
            -webkit-user-select: none;
            background: #222529;
            color: #c4cdca;
            z-index: 99999;
            border-radius: 3px;

        }

        .offcanvas-backdrop.show {
            opacity: 0 !important;
        }

        /* .select2-container--default .select2-results>.select2-results__options {
    max-height: 59px !important;
    overflow-y: auto;
} */
        .p-custom-2 {
            padding: 16px;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #245788;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #245788 !important;
            color: #c4cdca;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #c4cdca;
            background: #2b2f34;
            padding: 6px;
            line-height: 28px;
        }

        .input-group>:not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {

            margin-left: 0 !important;
        }

        .width-time-custom {
            width: 35% !important;
        }

        .select2-container--default .select2-selection--single {
            border: 0 !important;
        }

        .offcanvas {
            width: 25vw !important;
        }

        .offcanvas-body {
            overflow-x: hidden;
        }

        .select2-container--default .select2-selection--single {
            background: #2b2f34;
        }

        .select2-container .select2-selection--single .select2-selection__clear {
            display: none;
            /* font-size: 1.5em;
            color: #ffffff;
            margin-right: 1.5em; */
        }

        .bold {
            font-weight: bold;
        }
        .btn-danger
            {
                background : #f06548;
                color: #fff;
            }
</style>


<body>
    <div class="navbar-menu d-none">
    </div>
    <input id="removeNotificationModal" style="display:none">
    <div class="row p-1 m-0">
        <div class="col-xl-3 box-detail">
            <div class="row">
                <div class="col-12 p-0 m-0 ">
                    <div id="multi_signal_div" class="bar-header" style="display: none">
                        <div class="bar_test bg-danger text-center h3 p-2" style="color:rgb(245, 245, 245)"> กรุณากดปุ่ม
                            Reload Source 1</div>
                    </div>
                </div>
                <div class="col-12 p-0 m-0">
                    <div class="box-procedure py-2 px-3 d-flex justify-content-between border-r "
                        style="background-color: {{ @$this_procedure->color }}">

                        <span class=" h3 text-white"></span>
                        <span class=" align-self-center fs-14 fw-light text-white"> Case ID : </span>

                    </div>
                </div>
                <div class="col-12 m-0">
                    <div class="col-12">
                        <div class="d-flex justify-content-between mt-2">
                            <span class="align-self-center fs-14 fw-light text-white">HN : </span>
                            <span class="text-white-camera"> </span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-white">Name :</span>
                            <span
                                class="text-white-camera"></span>
                        </div>

                        <div class="toggle-detail mt-2">
                            <div class="row mb-3">
                                <div class="col-6 align-self-center">
                                    <span class="text-white">Physician :</span>
                                </div>
                                <div class="col-6">
                                    <select id="doctorname" class="form-select  physician-select  savejson "
                                        onchange="change_doctor(this.value)">

                                            <option value=""></option>

                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <span class="text-white">Room :</span>
                                </div>
                                <div class="col-6 text-end">
                                    <select name="room" id="room_name" class=" form-select savejson editroom">
                                        <option value=""></option>

                                                <option value=""></option>

                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 d-flex justify-content-between mt-2">
                                    <span class="text-white">Attendant :</span>
                                    <a class="btn w-md btn-primary " data-bs-toggle="offcanvas"
                                    href="#attendant_offcanvas" role="button" aria-controls="offcanvasExample">
                                    Select Attendant
                                </a>
                                </div>
                                <div class="col-12 text-white-camera">
                                    <div class="scroll p-3  ">
                                        <div class="box-users-list">

                                                <div class=" mt-0 user_physician_{{ @$data->uid }}"
                                                id="user_{{ @$data->uid }}">
                                                <div class="row">
                                                    <div class="col-9">

                                                    </div>


                                                    <div class="col-3 text-end">
                                                        <i onclick='del_selectuser(".{{ $class }}","assistant", "{{ $uid }}")'
                                                            class="ri-close-fill text-danger close-hover"></i>
                                                    </div>
                                                </div>
                                            </div>

                                                <div class=" mt-0 user_nurse_{{ @$data->uid }}"
                                                    id="user_{{ @$data->uid }}">
                                                    <div class="row">
                                                        <div class="col-9">

                                                        </div>



                                                        <div class="col-3 text-end">
                                                            <i onclick='del_selectuser(".{{ $class }}","assistant", "{{ $uid }}")'
                                                                class="ri-close-fill text-danger close-hover"></i>
                                                        </div>
                                                    </div>

                                                </div>

                                            <div class=" mt-0 user_assistant_{{ @$data->uid }}"
                                                id="user_{{ @$data->uid }}">
                                                <div class="row">
                                                    <div class="col-9">

                                                    </div>




                                                    <div class="col-3 text-end">
                                                        <i onclick='del_selectuser(".{{ $class }}","nurse_assistant", "{{ $uid }}")'
                                                            class="ri-close-fill text-danger ri-close-fill"></i>
                                                    </div>

                                                </div>

                                            </div>

                                        <div class=" mt-0 user_assistant_{{ @$data->uid }}"
                                            id="user_{{ @$data->uid }}">
                                            <div class="row">
                                                <div class="col-9">

                                                </div>




                                                <div class="col-3 text-end">
                                                    <i onclick='del_selectuser(".{{ $class }}","register", "{{ $uid }}")'
                                                        class="ri-close-fill text-danger ri-close-fill"></i>
                                                </div>

                                            </div>

                                        </div>

                                    <div class=" mt-0 user_assistant_{{ @$data->uid }}"
                                        id="user_{{ @$data->uid }}">
                                        <div class="row">
                                            <div class="col-9">

                                            </div>




                                            <div class="col-3 text-end">
                                                <i onclick='del_selectuser(".{{ $class }}","viewer", "{{ $uid }}")'
                                                    class="ri-close-fill text-danger ri-close-fill"></i>
                                            </div>

                                        </div>

                                    </div>

                                <div class=" mt-0 user_assistant_{{ @$data->uid }}"
                                    id="user_{{ @$data->uid }}">
                                    <div class="row">
                                        <div class="col-9">

                                        </div>

                                        <div class="col-3 text-end">
                                            <i onclick='del_selectuser(".{{ $class }}","viewer", "{{ $uid }}")'
                                                class="ri-close-fill text-danger ri-close-fill"></i>
                                        </div>
                                    </div>
                                </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-2"></div>
                                    <div class="col-8 " style="border-bottom: 1px solid #707070"></div>
                                    <div class="col-2"></div>
                                </div>
                                <div class="col-12 mt-2 ">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-white text-nowrap">Patient in time :</span>
                                        <div class="input-group width-time-custom ">
                                            <input type="text" onkeypress="return onlyNumbersWithColon(event);"
                                                name="time_patientin"
                                                class="form-control form-control-sm time_camera_format1 py-1 text-center text-time savejson"
                                                onfocusout="edit_time(this.value, this.id)" time="0"
                                                id="time_patientin" value="{{ @$case->time_patientin }}">
                                            <button class="btn btn-sm btn-light time-btn" id="btn_time_patientin"
                                                onclick="set_time('time_patientin')"><i
                                                    class="ri-timer-fill"></i></button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="text-white text-nowrap">Start time :</span>
                                        <div class="input-group width-time-custom ">
                                            <input type="text" onkeypress="return onlyNumbersWithColon(event);"
                                                name="time_start"
                                                class="form-control form-control-sm py-1 text-center text-time savejson time_camera_format2 "
                                                onfocusout="edit_time(this.value, this.id)" time="1"
                                                id="time_start" value="{{ @$case->time_start }}">
                                            <button class="btn btn-sm btn-light time-btn" id="btn_time_start"
                                                onclick="set_time('time_start')"><i
                                                    class="ri-timer-fill"></i></button>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="text-white text-nowrap">End time :</span>
                                        <div class="input-group width-time-custom ">
                                            <input type="text" onkeypress="return onlyNumbersWithColon(event);"
                                                name="time_end"
                                                class="form-control form-control-sm py-1 text-center time_camera_format4 text-time savejson"
                                                onfocusout="edit_time(this.value, this.id)" time="3"
                                                id="time_end" value="{{ @$case->time_end }}">
                                            <button class="btn btn-sm btn-light time-btn" id="btn_time_4"
                                                onclick="set_time('time_end')"><i class="ri-timer-fill"></i></button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="text-white h5">Images (<span id="img_num">{{ count($imgall) }}</span>)</span>
                    </div>
                    <div class="box-capture mt-2" id="box_showcapture" hide="true">

                            <div class='box-capture-list mt-2'>
                                <img src="http://localhost/ScreenRecord/{{ $val['img'] }}" class="w-100 ">
                                <span class='number-cap'>{{ $val['num'] }}</span>
                            </div><br>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9" >

                <div class="col-12 p-0 m-0 ">
                    <div class="bar-header">
                        <div class="++ bg-danger text-center h3 p-2"
                            style="color:rgb(245, 245, 245); border-radius: 4px;"> ท่านกำลังทดสอบระบบกล้อง</div>
                    </div>
                </div>

            <div class="col-12 p-0 m-0 ">
                <div id="no_signal_div" class="bar-header" style="display: none">
                    <div class="bar_test  bg-danger text-center h3 p-2" style="color:rgb(245, 245, 245)">
                        กรุณาตรวจสอบสายสัญญาณกล้อง</div>
                </div>
            </div>
            <div class="row">
                <div id="div_video" class="col-12" style="height: 75vh;">
                    <video id="video1"></video>
                </div>
                <div class="col-auto" style="display: none;">
                    <span id="video_source" hidden>1</span>
                    <span id="current_brightness1" hidden>128</span>
                    <span id="current_hue1" hidden>128</span>
                    <span id="current_saturation1" hidden>128</span>
                    <span id="current_sharpness1" hidden>128</span>
                    <span id="current_contrast1" hidden>128</span>
                    <button id="brighteness_modal_btn1" data-bs-toggle="modal" data-bs-target="#modal_brightness"
                        hidden></button>
                </div>
                <div class="row mt-2">
                    <div class="col-4  ">
                        <div class="row ms-1 box-detail p-custom ">
                            <div class="col-5 mt-2 text-nowrap ">
                                Switch Status
                            </div>
                            <div class="col-7 mt-2 text-success m-0 p-0">
                                Connected
                            </div>
                            <div class="row  text-nowrap" style="margin-top: 0.8rem;">
                                <div class="col-5 align-self-center">
                                    Camera Signal
                                </div>
                                <div class="col-7">
                                    <button type="button" id=""
                                        class="่btn btn-danger ac_reload_btn btn-sm btn-label wave-effect waves-light w-lg">
                                        <i class="las la-undo-alt  me-2  label-icon align-middle"></i> Reset Camera
                                    </button>
                                </div>
                                <div class="col-5 align-self-center">
                                    Live Solution
                                </div>
                                <div class="col-7">
                                    <button id="btn_liveconsult"
                                        class="btn btn-primary btn-label wave-effect waves-light  btn-sm mt-2 w-lg ">
                                        <i class="mdi mdi-cast-variant label-icon align-middle"></i>
                                        Live
                                        Solution</button>
                                </div>
                            </div>
                            <div class="row align-self-center mb-2">
                                <div class="col-5 ">
                                    Storage
                                </div>
                                <div class="col-7 mt-2">
                                    <div class="progress">
                                        <div class="progress-bar {{ $drive_color }}" role="progressbar"
                                            style="width: {{ $persen }}%" aria-valuenow="80" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-nowrap">{{ $ds - $drive }} GB / {{ $ds }} GB
                                        ({{ $persen }}%)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-7 " >
                        <div class="row ms-1 box-detail p-custom-2 " style="height: 169px;">
                            <div class="col-6 text-nowrap align-self-center">
                                Camera Setting
                                <button id="set_brightness_btn1 " class="btn text-white" data-bs-toggle="offcanvas"
                                    href="#camera_offcanvas" role="button" aria-controls="offcanvasExample"><i
                                        class="ri-settings-3-line"></i> </button>
                            </div>
                            <div class="col-12 mb-2">
                                <input type="hidden" id="vdoname">

                                    <select class="form-select sourcescope source1" onchange="change_scope('1')" id="scope_source">
                                        <option data-id="0" value="0">Endoscope</option>

                                            <option data-id="" value=""


                                                </option>

                                    </select>
                            </div>

                            <div class="col-2">
                            </div>
                            <div class="row">
                                <div class="col-8" style="border-right: 1px solid #707070">
                                    <div class="form-check mb-2" style="display: none">
                                        <input class="form-check-input" type="checkbox" id="ck_source1"
                                            value="1">
                                        <label class="form-check-label" for="ck_source1">
                                            Source 1
                                        </label>
                                    </div>
                                    <div class="form-check mb-2" id="cks2_div" style="display: none">
                                        <input class="form-check-input" type="checkbox" id="ck_source2"
                                            value="2">
                                        <label class="form-check-label" for="ck_source2">
                                            Source 2
                                        </label>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-12  d-flex justify-content-between  ">

                                            <div>
                                                <div class="fs-12" style="">
                                                    <span>SDI USB Card Capture, 1920 X 1080, 60fps</span>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-icon btn-white-camera  btn-capture waves-effect waves-light" style="margin-top: 3px;"
                                                    id="btn-capture"><i class="ri-camera-fill ri-xl"></i></button>
                                                <button type="button"
                                                    class="btn btn-icon btn-record  waves-effect waves-light  btn-record" style="margin-top: 3px;"
                                                    id="vdo_start"><i class="ri-record-circle-line ri-xl"></i></button>
                                                <button type="button"
                                                    class="btn btn-icon btn-record waves-effect waves-light btn-record active"
                                                    style="display: none; margin-top: 3px;" id="vdo_stop">



                                                    <i class="ri-record-circle-line ri-xl"></i></button>
                                                <small class="text-danger" style="font-size: 14px">
                                                    <span id="pleasereload1" style="display: none;">การบันทึก VDO
                                                        ขัดข้องกรุณา Reload Source1</span></small>
                                            </div>
                                            <div class="mt-2 text-end">
                                                <span class="text-danger " id="timer1">00:00:00</span>
                                                Size &nbsp; <span class="text-white text-nowrap  "id="size1"
                                                    style="font-size: 10px;">
                                                    0 </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 m-0 ps-1">

                            <div class="col-12 ">
                                <button
                                    class="btn btn-success btn-load btn-label waves-effect waves-light make_report w-lg h-button fs-12">
                                    <i
                                        class="mdi mdi-clipboard-text-outline
                                label-icon align-middle fs-14 me-2"></i>MAKE
                                    REPORT</button>
                            </div>
                            <div class="col-12 ">
                                <button id="case_btn"
                                    class="btn mt-1 btn-primary btn-label waves-effect waves-light w-lg h-button fs-12">
                                    <i class="ri-list-unordered label-icon align-middle fs-14 me-2"></i> CASE
                                    LIST</button>
                            </div>
                            <div class="col-12 ">
                                <button type="button" id="btn_back"
                                    class="btn mt-1 btn-danger btn-label btn-load waves-effect waves-light w-lg h-button fs-12">
                                    <i class="ri-arrow-go-back-line label-icon align-middle fs-14 me-2"></i> BACK</a>
                            </div>

                        <button hidden id="new_case_btn" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#modal_new_case">
                            Launch demo modal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="display: none">
        <form id="finish_record" action="{{ url('capture') }}" method="post">

            <input name="event" value="finish_record" type="hidden">
            <input name="hn" value="{{ $hn }}" type="hidden">
            <input name="cid" value="{{ $cid }}" type="hidden">
            <input name="caseuniq" value="{{ $case->caseuniq }}" type="hidden">
            <button type="submit">save</button>
        </form>
    </div>


    <div style="display:none">
        <canvas id="canvas_video" style="z-index:1;"></canvas>
    </div>

    @include('capture.camera.obs.js_onload')
    @include('capture.camera.obs.js_socket')
    @include('capture.camera.obs.js_hotkey')
    @include('capture.camera.obs.js_time')
    @include('capture.camera.obs.js_DetectRTC')
    @include('endocapture.camera.obs.js_checksignal')

    <script src="{{ url('assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ url('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ url('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>


    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

    @include('layouts.layouts_index.plugins')
    <script src="{{ url('assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script>
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/select2.init.js') }}"></script>
    <script src="{{ url('assets/libs/fullcalendar/main.min.js') }}"></script>
    <script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script>
    <script src="{{ url('assets/js/app.js') }}"></script>
     @include('EndoCAPTURE.camera.component.js')
    <script>
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $(document).ready(function() {

            $('#source1').select2({
                placeholder: "Select Camera",
                allowClear: true,
                dropdownParent: $('#modal_select_camera')
            });

            $('#source1').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });

            $('#doctorname').select2({
                placeholder: "Select Camera",
                allowClear: true,
            });

            $('#doctorname').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });

            $('#scope_source').select2({
                placeholder: "Select Camera",
                allowClear: true,
            });

            $('#scope_source').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });
        });
    </script>

    <script>
        $("#change_camera").click(function() {
            $("#modal_select_camera").modal("show");
        })
        let markerVH = Number({{ $camera->marker_height ?? 8 }});
        document.onkeydown = function(e) {
            if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.className.includes(
                    'select2-search__field')) {
                return;
            }
            return false;
        }
        // const set_marker_height = (height) => {
        //     $.post("{{ url('api/capture') }}", {
        //         event: "set_marker_height",
        //         height: height,
        //     }, function(data, status) {})
        // }

        $("#change_icon").click(function() {
            $(this).find($(".ri-arrow-down-s-line")).toggleClass("ri-arrow-up-s-line");
        })

        $(".physician-select").select2({
            placeholder: "Select Physician",
            allowClear: true
        });

        document.getElementById('attendant_offcanvas').addEventListener('shown.bs.offcanvas', function() {
            $("#select_camera_doctor").select2({
                placeholder: "Select Doctor",
                allowClear: true,
                dropdownParent: $('#attendant_offcanvas')
            });
            $("#source1").select2({
                placeholder: "Select Camera",
                allowClear: true,
                dropdownParent: $('#attendant_offcanvas')
            });
            $("#select_nurseassistant").select2({
                placeholder: "Select Nurse Assistant",
                allowClear: true,
                dropdownParent: $('#attendant_offcanvas')
            });
            $('#select_nurseassistant').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });
        });

        $("#select_camera_nurse").select2({
            placeholder: "Select Nurse",
            allowClear: true
        });

        $('#select_camera_nurse').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });
    </script>


        <script src='http://medicaendo.com:3000/socket.io/socket.io.js'></script>
        <script>
            var socketserver = io.connect('http://medicaendo.com:3000');
        </script>

    <script>
        $('input[type=text]').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css('border', '1px solid #bbbbbb80');
            }
        });

        $('input[type=number]').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css('color', '#CFD4D9', );
                $(this).css('border', '1px solid #bbbbbb80');
            }
        })
        $('.form-control').focusout(function() {
            var text_val = $(this).val();
            if (text_val != null && text_val != '') {
                $(this).css('color', '#CFD4D9', );
                $(this).css('border', '1px solid #bbbbbb80');
            } else {
                $(this).css('background', 'none');
            }
        });

        $("#cick-hide").click(function() {
            $('.box-data').hide()
            $('#full_screen1').css()
        });

        $("#cick-show").click(function() {
            $('#hide-screen').show()
            $('#fullscreen_card').hide()
            $('#bottom-bar').hide()
        });


    </script>

    <script>
        $('.video-link').on('click', function() {
            let source = $(this).data('source')
            $('#link1').css('display', 'none')
            $('#pleasereload1').css('display', 'none')
            $(`#record1`).removeClass('active')
            stop_timer(1)
            setTimeout(() => {
                socket.emit('chat message', 'to_page')
            }, 100);
            setTimeout(() => {
                socket.emit('chat message', 'camera_stop' + source)
            }, 300);
            setTimeout(() => {
                socket.emit('chat message', 'continue_scope' + source)
            }, 3 * 1000);
        })

        $("#source1").change(function() {
            var tempscopeselect_name = $(this).val();
            setTimeout(() => {
                if (tempscopeselect_name == $("#source1").val()) {
                    $.post("{{ url('api/capture') }}", {
                        "event": "scopetracking",
                        "val": tempscopeselect_name,
                        "uid": "{{ @uid() }}"
                    }, function(d, s) {})
                }
            }, 3000);
        });


        function change_doctor(doctor_id) {
            $.post("{{ url('api/capture') }}", {
                event: 'set_doctorname',
                key: 'doctorname',
                value: doctor_id,
                cid: '{{ $cid }}',
            }, function(data, status) {
                $("#text_doctorname").html(data);
            });
        }

        function change_scope(source) {
            let scope_id = $("#scope_source").val();
            if (scope_id != "" || scope_id != null) {
                socket.emit(`changecamera${parseInt(source)-1}`, scope_id);
                if (source == '1') {
                    cameraselect = true;
                }
                $.post('{{ url('api/jquery') }}', {
                    event: "update_scope",
                    scope: scope_id,
                    cid: "{{ @$cid }}",
                    source: source
                }, function(data, status) {
                    let scope = data.selected_scope;
                    $("#change_camera").val(data)
                })
            }
        }

        function imageSHOW(msg) {
            var domain = "{{ domainname('ScreenRecord') }}/"
            var img_exist = get_img_num()
            var path = domain + msg
            var img_url = `${path}`
            var new_num = img_exist + 1
            @if (@$camera->firstimg_starttime)
                if (new_num == 1) {
                    $('#btn_time_start').trigger('click')
                }
            @endif
            $(".box-capture").prepend(`
                    <div class="box-capture-list" data-checknum="0" id="imgbox${new_num}">
                        <img src="${img_url}" class="w-100">
                        <span class="number-cap">${new_num}</span>
                    </div>
                `);
            $('#img_num').text(new_num)
            // append_img_localstorage(new_num, img_url)
        }

        function get_img_num() {
            var img_num = $('.box-capture-list').length
            return img_num
        }



        $('.make_report').click(function() {
            $(this).prop("disabled", true);
            if (check_null('time_end')) {
                $('#btn_time_4').click()
            }
            make_report = true;
            var vdo_play = $('#vdo_play').val();
            setTimeout(() => {
                socket.emit('chat message', "case_finish");
                socket.emit('chat message', "to_page");
                socket.emit('chat message', "camera_stop1");
                $('#modal_progress_camera').modal('show');
                $('#make_report').prop("disabled", true);
                $("#finish_record").submit();
            }, 800);
        });

        var is_secondsource = localStorage.getItem("second_source")
        if (is_secondsource == 'open') {
            $('#camera_2').val('2').trigger('change')
            localStorage.setItem("second_source", 'close')
            $($('.vdo-source')[1]).addClass('active')
            $($('.vdo-shows')[1]).addClass('active')
            $('#full_screendiv2').css('display', 'block')
            $('#source2_div').css('display', 'block')
            $('#reload2_div').css('display', 'block')
        }
    </script>

    <script>
        $(".btn-record").click(function() {
            // $.post("{{ url('api/capture') }}", {
            //     event: "obs_record",
            //     cid: "{{ $cid }}",
            // }, function(d, s) {});
        });


        function clear_warning_alert(clear_interval = true) {
            if (clear_interval) {
                clearInterval(vdo_file_interval)
            }
            time_alert = 0
            new_vdosize = 0
            old_vdosize = 0
        }

        $("#search_case").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".list-cases").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('#back_btn').on('click', function() {
            let time_end = $("#time_end").val();
            if (time_end == "") {
                set_time('time_end');
            }
            $.post("{{ url('api/capture') }}", {
                event: "back2home",
                cid: "{{ $cid }}",
                hn: "{{ $hn }}",
            }, function(d, s) {});
            socket.emit('chat message', 'to_page')
            socket.emit('chat message', "camera_stop1");
            setTimeout(() => {
                window.location.href = "{{ url('') }}"
            }, 1 * 1000);
        })

        $('#case_btn').on('click', function() {
            $("#modal_new_case").modal('show');
        })


        $('.btn-capture').click(function() {
            let obj = {};
            obj.event = "capture";
            obj.cid = "{{ $cid }}";
            obj.hn = "{{ @$case->case_hn }}";
            obj.department = "{{ @$case->department }}";
            obj.scope = scopecheck("source1");
            obj.obs_source = "capture1";
            socket.emit('endonode', JSON.stringify(obj))
        })

        function scopecheck(source) {
            let scope = $("#scope_source").val();
            if (scope == null || scope == "") {
                scope = "0";
            }

            return scope;
        }


        $("#vdo_start").click(function() {
            $("#vdo_start").hide();
            $("#vdo_stop").show();
            socket.emit('endonode', `{"event":"vdo_start"}`)
            startTimer1();
        });

        let timer1Interval;
        let timer1Seconds = 0;
        let timerloopVDO = 0;
        let temp_vdo_size = 0;
        function startTimer1() {
            timer1Interval = setInterval(() => {
                timer1Seconds++;
                const hours = String(Math.floor(timer1Seconds / 3600)).padStart(2, '0');
                const minutes = String(Math.floor((timer1Seconds % 3600) / 60)).padStart(2, '0');
                const seconds = String(timer1Seconds % 60).padStart(2, '0');
                document.getElementById('timer1').innerText = `${hours}:${minutes}:${seconds}`;
            }, 1000);
        }

        function resetTimer1() {
            clearInterval(timer1Interval);
            timer1Seconds = 0;
            document.getElementById('timer1').innerText = '00:00:00';
        }


        $("#vdo_stop").click(function() {
            $("#vdo_start").show();
            $("#vdo_stop").hide();
            socket.emit('endonode', `{"event":"vdo_stop"}`)
            $("#size1").html("");
            resetTimer1()
        });


        function check_null(id) {
            var val = $(`#${id}`).val()
            var status = false
            if (val == '' || val == undefined) {
                status = true
            }
            return status
        }


        $(".ac_reload_btn").click(function() {
            // alert('ต้องมีการแจ้งเตือนว่าขณะนี้กำลังรีโหลดกล้อง')
            // socket.emit('endonode', `{"event":"vdo_stop"}`)
            socket.emit('endonode', `{"event":"reload"}`)
            // setTimeout(() => {
                // window.location.reload();
            // }, 3000);
        });

        $(".make_report").click(function() {
            socket.emit('endonode', `{"event":"vdo_stop"}`)
        });

        $("#back_btn").click(function() {
            socket.emit('endonode', `{"event":"vdo_stop"}`)
        });


        $('.checkend_time').click(function() {
            socket.emit('endonode', `{"event":"vdo_stop"}`)
            $(this).prop("disabled", true);
            if (check_null('time_end')) {
                $('#btn_time_4').click()
            }
        })


    </script>
</body>

</html>
