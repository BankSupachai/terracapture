<!DOCTYPE html>
<html lang="en" data-layout-mode="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {{-- <meta name="viewport" content="width=device-width, maximum-scale=10"> --}}
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
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        let cid = "{{ $cid }}";
    </script>
    <title>Camera</title>
    <style>
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
            /* background: #ffffffff */
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
    </style>
</head>
{{-- New --}}
@include('capture.camera.modal.modal_scope_alert')
{{-- @include('endocapture.camera.mockup.attendant') --}}
@include('endocapture.camera.mockup.liveconsult_modal')
@include('endocapture.camera.mockup.livestream_modal')
@include('endocapture.camera.mockup.medi_modal')
{{-- Old --}}
@include('capture.camera.modal.modal_new_case')
@include('capture.camera.modal.modal_sms')
{{-- @include('endocapture.camera.modal.modal_attendant') --}}
@include('endocapture.camera.04controller')
@include('capture.camera.modal.modal_progress_camera')
@include('capture.camera.modal.modal_casetest')
@include('capture.camera.modal.modal_brightness')
@include('capture.camera.modal.modal_livecase')
@include('EndoCAPTURE.camera.component.modal_camera')
@include('capture.camera.component.offcanvas.attendant')
@include('EndoCAPTURE.camera.component.offcanvas.camerasetting')

<body onload="zoom()">
    <div class="navbar-menu d-none">
    </div>

    {{-- @dd($project) --}}

    <input id="removeNotificationModal" style="display:none">
    <div class="row pt-1 m-0">
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
                        @php
                            $this_segment = Request::segment(2);
                            $this_color = isset($this_procedure->color) ? $this_procedure->color : 'green';
                            $this_name = isset($case->procedurename) ? $case->procedurename : 'TEST CAMERA';
                            $this_id = isset($this_segment) ? Request::segment(2) : 'TEST CAMERA';
                        @endphp
                        <span class=" h3 text-white">{{ @$this_name }}</span>
                        <span class=" align-self-center fs-14 fw-light text-white"> Case ID : </span>

                    </div>
                </div>
                <div class="col-12 m-0">
                    <div class="col-12">
                        {{-- <div class="d-flex justify-content-between mt-1" >
                            <span class="text-white">Operation Detail</span>
                            <div id="change_icon">
                                <i class="ri-arrow-down-s-line hide-camera-detail " ></i>
                            </div>
                        </div> --}}

                        {{-- <div class="d-flex justify-content-between mt-1">
                            <span class="text-white">HN :</span>
                            <span class="text-white-camera">{{ @$patient['hn'] }}</span>
                        </div> --}}
                        <div class="d-flex justify-content-between mt-3">
                            <span class="align-self-center fs-14 fw-light text-white">HN : </span>
                            <span class="text-white-camera"> {{ @$patient->hn }}</span>
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-white">Name :</span>
                            <span
                                class="text-white-camera">{{ @$patient->firstname . ' ' }}{{ @$patient->middlename . ' ' }}{{ @$patient->lastname }}</span>
                        </div>
                        @php
                            $gender = '-';
                            if (isset($patient->gender)) {
                                $gen = $patient->gender;
                                if ($gen == '1') {
                                    $gender = 'Male';
                                } elseif ($gen == '2') {
                                    $gender = 'Female';
                                } else {
                                    $gender = $gen;
                                }
                            }
                        @endphp
                        <div class="d-flex justify-content-between mt-2">
                            <span class="text-white">Gender / Age :</span>
                            <span class="text-white-camera">{{ $gender }} /
                                {{ @$patient->birthdate != 'TEST CAMERA' ? age_form_bd(@$patient->birthdate) : $patient->birthdate }}</span>
                        </div>
                        <div class="toggle-detail mt-3">
                            <div class="row mb-3">
                                <div class="col-6 align-self-center">
                                    <span class="text-white">Physician :</span>
                                </div>
                                <div class="col-6">
                                    <select id="doctorname" class="form-select  physician-select  savejson "
                                        onchange="change_doctor(this.value)">
                                        @foreach ($doctor ?? [] as $d)
                                            @php
                                                $d = (object) $d;
                                                $fullname = fullname($d);
                                            @endphp
                                            <option value="{{ @$d->id }}"
                                                @if (@$case->doctorname == @$fullname) selected @endif>{{ @$fullname }}
                                                {{ @$d->user_code }}</option>
                                        @endforeach
                                    </select>
                                    {{-- @dd($case); --}}
                                    {{-- <span id="text_doctorname"> {{ $case->doctorname }}</span> --}}

                                    {{-- <select id="doctorname" class="form-select js-example-basic-single physician-select  savejson " onchange="change_doctor(this.value)">
                                        @foreach ($doctor ?? [] as $d)
                                            @php
                                                $d = (object) $d;
                                                $fullname = fullname($d).' '.@$d->user_code;
                                            @endphp
                                            <option value="{{@$fullname}}" @if (@$case->doctorname == @$fullname) selected @endif>{{@$fullname}}</option>
                                        @endforeach
                                    </select> --}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 align-self-center">
                                    <span class="text-white">Room :</span>
                                </div>

                                <div class="col-6 text-end">
                                    <select name="room" id="room_name" class=" form-select savejson editroom">
                                        <option value=""></option>
                                        @isset($room)
                                            @foreach ($room as $r)
                                                @php
                                                    $r = (object) $r;
                                                @endphp
                                                <option value="{{ $r->room_id }}" {{-- @if ($r->room_name == $this_room) selected @endif> --}}
                                                    @selected(@$case->room == @$r->room_id)>
                                                    {{ $r->room_name }}
                                                </option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    {{-- @dd($case) --}}
                                    {{-- @php
                                    use App\Models\Mongo;
                                        $tb_room = Mongo::table("tb_room")->where("room_id", @$case->room)->first();
                                    @endphp --}}
                                    {{-- <span id="room_text">{{ @$this_room }}</span> --}}

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
                                    <div class="scroll px-3  ">
                                        <div class="box-users-list">
                                            @if (isset($doctor_select))
                                                @foreach ($doctor_select as $data)
                                                    <div class=" mt-0" data-id="{{ @$data->uid }}">
                                                        <div class="row">
                                                            <div class="col-9">
                                                                {{ @$data->user_prefix }}
                                                                {{ @$data->user_firstname}}
                                                                {{ @$data->user_lastname }}
                                                            </div>


                                                            <div class="col-3 text-end">
                                                                <i onclick='del_selectuser("{{ $data->uid }}")'
                                                                    class="ri-close-fill text-danger close-hover"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif


                                        @if (isset($nurse_assis))
                                            @foreach ($nurse_assis as $data)

                                                <div class="row" data-id="{{ @$data->uid }}">
                                                    <div class="col-9">
                                                        {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}
                                                        {{ @$data->user_code }}
                                                    </div>

                                                    <div class="col-3 text-end">
                                                        <i onclick='del_selectuser("{{ $data->uid }}")'
                                                            class="ri-close-fill text-danger"></i>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        </div>
                                        <div class="box-append-user">

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
                                            <input type="text" {{-- onkeypress="return onlyNumbersWithColon(event);" --}} name="time_start"
                                                class="form-control form-control-sm py-1 text-center text-time savejson time_camera_format2 "
                                                onfocusout="edit_time(this.value, this.id)" time="1"
                                                id="time_start" value="{{ @$case->time_start }}">
                                            <button class="btn btn-sm btn-light time-btn" id="btn_time_start"
                                                onclick="set_time('time_start')"><i
                                                    class="ri-timer-fill"></i></button>
                                        </div>
                                    </div>
                                    {{-- @dd(@$this_procedure['withdrawaltime']); --}}

                                    {{-- @if (@$this_procedure['withdrawaltime']) --}}
                                    {{-- @if (@$this_procedure['code'] == 'gi002')
                                        <div class="d-flex justify-content-between mt-2">
                                            <span class="text-white text-nowrap">Withdrawal time :</span>
                                            <div class="input-group width-time-custom ">
                                                <input type="text" onkeypress="return onlyNumbersWithColon(event);" --}}
                                    {{-- onchange="validateHhMm(this);" --}}
                                    {{-- name="time_withdrawal"
                                                    onfocusout="edit_time(this.value, this.id)"
                                                    class="form-control form-control-sm py-1     time_camera_format3 text-center text-time savejson"
                                                    time="2" id="time_withdrawal"
                                                    value="{{ @$case->time_withdrawal }}">
                                                <button class="btn btn-sm btn-light time-btn" id="btn_time_3"
                                                    onclick="set_time('time_withdrawal')"><i
                                                        class="ri-timer-fill"></i></button>
                                            </div>
                                        </div>
                                    @endif --}}
                                    <div class="d-flex justify-content-between mt-2">
                                        <span class="text-white text-nowrap">Withdrawal time :</span>
                                        <div class="input-group width-time-custom ">
                                            <input type="text" {{-- onkeypress="return onlyNumbersWithColon(event);" --}} name="time_withdrawal"
                                                class="form-control form-control-sm py-1       text-center text-time savejson time_camera_format3 "
                                                onfocusout="edit_time(this.value, this.id)" time="2"
                                                id="time_withdrawal" value="{{ @$case->time_withdrawal }}">
                                            <button class="btn btn-sm btn-light time-btn" id="btn_time_3"
                                                onclick="set_time('time_withdrawal')"><i
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
                                    {{-- <div class="col-12 text-center mt-2"><button class="btn btn-dark-primary btn-sm  "
                                            data-bs-toggle="modal" data-bs-target="#medi_modal">Nurse Record
                                            (Interoperation)</button></div> --}}


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-4">
                        {{-- @dd(count($imgall)); --}}
                        <span class="text-white bold h5">Images (<span
                                id="img_num">{{ count($imgall) }}</span>)</span>
                    </div>
                    <div class="box-capture mt-2" id="box_showcapture" hide="true">
                        @foreach ($imgall as $key => $val)
                            <div class='box-capture-list mt-2'>

                                <img src="{{ domainname('') }}/ScreenRecord/{{ $val['img'] }}" class="w-100 ">
                                <span class='number-cap'>{{ $val['num'] }}</span>
                            </div><br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            @if ($type == 'test')
                <div class="col-12 p-0 m-0 ">
                    <div class="bar-header">
                        <div class="++ bg-danger text-center h3 p-2"
                            style="color:rgb(245, 245, 245); border-radius: 4px;"> ท่านกำลังทดสอบระบบกล้อง</div>
                    </div>
                </div>
            @endif
            <div class="col-12 p-0 m-0 ">
                <div id="no_signal_div" class="bar-header" style="display: none">
                    <div class="bar_test  bg-danger text-center h3 p-2" style="color:rgb(245, 245, 245)">
                        กรุณาตรวจสอบสายสัญญาณกล้อง</div>
                </div>
            </div>
            <div class="row">
                <div class="source1_toggle">
                    {{-- ถ้ามีกล้องเดียว --}}
                    <div class="col-12" style="height: 80vh;">
                        <div class="w-100 pb-2 px-2 position-relative vdo-shows active" id="full_screen1">
                            <img src="{{ url('public/images/point/marker01.bmp') }}" class="point-top1"
                                id="cick-hide">
                            <div class="w-100 h-100 bg-black" id="full_screen2"></div>
                            <img src="{{ url('public/images/point/marker02.bmp') }}" class="point-bottom1">
                        </div>
                    </div>

                </div>
                <div class="source2_toggle" style="display: none;">
                    <div class="row align-content-center" style="height: 54em;">
                        <div class="col-6" style="height: 40vh;">
                            <div class="w-100 pb-2 px-2 position-relative vdo-shows active" id="full_screen1">
                                <img src="{{ url('public/images/point/marker01.bmp') }}" class="point-top11"
                                    id="cick-hide">


                            </div>
                        </div>
                        <div class="col-6 " style="height: 40vh;">
                            <div class="w-100 pb-2 px-2 position-relative vdo-shows active" id="full_screen1">
                                <div class="w-100 h-100 bg-black" id="full_screen2"></div>
                                <img src="{{ url('public/images/point/marktop2.bmp') }}" class="point-top21"
                                    id="cick-hide">

                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <div class="w-100 pb-2 px-2 position-relative vdo-shows active">
                                <img src="{{ url('public/images/point/marker02.bmp') }}" class="point-bottom11">

                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <div class="w-100 pb-2 px-2 position-relative vdo-shows active">
                                <img src="{{ url('public/images/point/markbottom2.bmp') }}" class="point-bottom2">
                            </div>
                        </div>
                    </div>
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
                <div class="row">
                    <div class="col-4  ">
                        <div class="row ms-1 box-detail p-custom ">
                            {{-- <div class="col-3"></div> --}}
                            <div class="col-5 mt-2 bold text-nowrap ">
                                Switch Status
                            </div>
                            <div class="col-7 mt-2 text-success m-0 p-0">
                                Connected
                            </div>
                            <div class="row  text-nowrap mt-3" style="margin-top: 0.8rem;">
                                <div class="col-5 bold align-self-center">
                                    Camera Signal
                                </div>
                                <div class="col-7">
                                    {{-- @if (@$feature->livestream)
                                    <button class="btn btn-danger btn-sm w-lg" data-bs-toggle="modal"
                                        data-bs-target="#livestream_modal">
                                        <i class="ri-live-fill  me-3"></i>
                                        Live Stream</button>
                                    @endif --}}
                                    <button type="button" id="reload_btn1"onclick="refresh_scope(1)"
                                        class="btn btn-danger btn-sm btn-label wave-effect waves-light w-lg">
                                        <i class="las la-undo-alt  me-2  label-icon align-middle"></i> Reset Camera
                                    </button>
                                </div>
                                {{-- <div class="col-5 align-self-center">
                                    Live Solution
                                </div>
                                <div class="col-7">
                                    <button id="btn_liveconsult"
                                        class="btn btn-primary btn-label wave-effect waves-light  btn-sm mt-2 w-lg ">
                                        <i class="mdi mdi-cast-variant label-icon align-middle"></i>
                                        Live
                                        Solution</button>
                                    </div> --}}
                                {{-- <button class="btn btn-danger  btn-sm mt-2 w-lg" data-bs-toggle="modal"
                                        data-bs-target="#liveconsult_modal"><i class="ri-group-2-fill  me-3"></i>
                                        Live
                                        Solution</button> --}}

                            </div>
                            <div class="row align-self-center mt-3 mb-4">
                                <div class="col-5 bold ">
                                    Storage
                                </div>
                                <div class="col-7 mt-2">
                                    {{-- @dd($ds) --}}
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

                    <div class="col-7 ">
                        <div class="row ms-1 box-detail p-custom-2 ">
                            <div class="col-6 text-nowrap bold align-self-center">
                                Camera Setting
                                <button id="set_brightness_btn1 " class="btn text-white" data-bs-toggle="offcanvas"
                                    href="#camera_offcanvas" role="button" aria-controls="offcanvasExample"><i
                                        class="ri-settings-3-line"></i> </button>
                            </div>
                            <div class="col-6 text-nowrap align-self-center">
                                <button type="button" id="reload_btn2"onclick="refresh_scope(2)"
                                    class="btn btn-danger btn-sm btn-label wave-effect waves-light w-lg"
                                    style="display: none;">
                                    <i class="las la-undo-alt  me-2  label-icon align-middle"></i> Reset Camera
                                </button>

                            </div>
                            <div class="source1_toggle">
                                @include('capture.camera.source1')
                            </div>
                            <div class="source2_toggle" style="display:none;">
                                @include('EndoCAPTURE.camera.source2')
                            </div>
                            <script></script>
                            {{-- <div class="col-6" >
                                    <div class="row">
                                        <div class="col-3 text-nowrap align-self-center">
                                            Source 2
                                        </div>

                                        <div class="col-3"> </div>
                                        <div class="col-9 mt-2 d-flex justify-content-between">
                                            <div>
                                                <button type="button"
                                                    class="btn btn-icon btn-white-camera waves-effect waves-light" disabled><i
                                                        class="ri-camera-fill ri-xl"></i></button>
                                                <button type="button"
                                                    class="btn btn-icon btn-red  waves-effect waves-light"disabled><i
                                                        class="ri-record-circle-line ri-xl"></i></button>
                                                <span class="text-danger ">00:00:00</span>
                                            </div>
                                            <div class="mt-2">
                                                Size &nbsp; <span class="text-white text-nowrap  "id="size2"
                                                    style="font-size: 10px;">
                                                    0 </span> &nbsp; mb.
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                        </div>
                    </div>
                    <div class="col-1 m-0 ps-1">
                        @if ($type == 'camera')
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
                                    class="btn mt-2 btn-primary btn-label waves-effect waves-light w-lg h-button fs-12">
                                    <i class="ri-list-unordered label-icon align-middle fs-14 me-2"></i> CASE
                                    LIST</button>
                            </div>
                            <div class="col-12 ">
                                <button type="button" id="btn_back"
                                    class="btn mt-2 btn-danger btn-label btn-load waves-effect waves-light w-lg h-button fs-12">
                                    <i class="ri-arrow-go-back-line label-icon align-middle fs-14 me-2"></i> BACK</a>
                            </div>
                        @else
                            <div class="col-12">
                                <form action="{{ url('capture') }}" method="post" id="delete_photo_form">
                                    @csrf
                                    <input type="hidden" name="event" value="pictest_delete">
                                    <a type="button" href="{{ url('') }}"
                                        class="btn mt-1 btn-danger btn-loadicon btn-label waves-effect waves-light w-100"><i
                                            class="ri-arrow-go-back-line label-icon align-middle fs-16 me-2"></i>
                                        BACK </a>
                                </form>
                            </div>
                        @endif
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
            @csrf
            <input name="event" value="finish_record" type="hidden">
            <input name="hn" value="{{ $hn }}" type="hidden">
            <input name="cid" value="{{ $cid }}" type="hidden">
            <input name="caseuniq" value="{{ $case->caseuniq }}" type="hidden">
            <button type="submit">save</button>
        </form>
    </div>





    {{-- <div id="sitebar-color"></div> --}}

    <script src="{{ url('assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ url('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ url('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
    {{-- <script src="{{url("assets/js/pages/form-file-upload.init.js")}}"></script> --}}

    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    {{-- <script src="{{url("assets/js/plugins.js")}}"></script> --}}
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

</body>

</html>
