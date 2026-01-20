<!DOCTYPE html>
<html lang="en" data-layout-mode="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">

    <!-- One of the following themes -->
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>

    <link rel="stylesheet" href="{{ url('assets/libs/dropzone/dropzone.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet"
        href="{{ url('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" rel="stylesheet" />
    <!-- 'classic' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" rel="stylesheet" />
    <!-- 'monolith' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet" /> <!-- 'nano' theme -->
    <link href="{{ url('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    {{-- <script src="{{ url('assets/js/pages/select2.init.js') }}"></script> --}}
    <link href="{{ url('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
            color: #fff;
            border: 0;
        }

        .btn-dark-primary {
            background: #245788;
            color: #fff;

        }

        .bd-white {
            border: 1px solid #707070;
        }

        .btn-red {
            background: red;
            color: #fff;

        }

        .btn-red:hover {
            background: rgb(208, 39, 39);
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
            font-size: 14px;
            overflow: hidden;
            font-family: 'kanit';
            font-weight: 500;
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
            background: rgb(245, 245, 245);
        }

        ::-webkit-scrollbar-thumb:hover {
            transition: 0.3s;
            background: rgb(220, 220, 220);
        }

        .box-capture-image {
            position: relative;
            margin-top: 1em;
        }

        .box-capture-image:first-child {
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
            height: 35vh;
            overflow-y: auto;
        }

        .point-top1 {
            transform: rotate(0deg);
            position: absolute;
            /* กล้อง 1 ตัว  */
            top: 0rem;
            /* กล้อง 2 ตัว  */
            /* top: 14rem; */
            left: -0.5rem;
            z-index: 9;
            height: 4vh;
        }

        .point-bottom1 {
            transform: rotate(0deg);
            position: absolute;
            /* กรณีมีกล้องตัวเดียว */
            top: 80vh;
            /* กรณีมีกล้องสองตัว */

            /* top: 64vh; */
            right: 0rem;
            z-index: 9;
            height: 4vh;
        }

        .text-white-camera {
            color: #CFD4D9;
        }

        .scroll {
            height: 7.5em;
            overflow: auto;
        }

        .btn-dark-camera {
            background: transparent;
            border: 1px solid #2B2F34;
            color: #CED4DA;
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
            border: 1px solid #fff;
        }

        .choices__list--dropdown {
            bottom: 100% !important;
            top: auto;
        }

        .h-button {
            height: 45px;
        }

        .col-7 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: 57.333333%;
            padding-right: 2em;
        }

        /* [data-layout-mode=dark] .form-select {
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23ced4da' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e);

        } */

        /* #parallelogram {
      width: 150px;
      height: 100px;
      transform: skew(20deg);
      background: red;
      color: white;
    }
    #parallelogram::before {
        content: "";
    position: absolute;
    width: 82px;
    height: 100px;
    background: red;
    margin-left: 83px;
    transform: skew(-17deg);
    } */
    </style>
</head>
@include('endocapture.camera.mockup.attendant')
@include('endocapture.camera.mockup.liveconsult_modal')
@include('endocapture.camera.mockup.livestream_modal')
@include('endocapture.camera.mockup.medi_modal')




<body>
    <div class="navbar-menu d-none">
    </div>


    <input id="removeNotificationModal" style="display:none">
    <div class="row p-2 m-0">
        <div class="col-xl-3 box-detail">
            <div class="row">
                <div class="col-12 p-0 m-0">
                    <div class="box-procedure py-2 px-3 d-flex justify-content-between  "
                        style="background: #0D7810; border-radius: 4px">
                        {{-- <div id="parallelogram"><span>ABC</span></div> --}}
                        <span class=" h3 text-white">EGD</span>
                        <span class="align-self-center fs-14 fw-light text-white">Case ID : 1231412</span>
                    </div>
                </div>
                <div class="col-12 m-0">
                    <div class="col-12">
                        <div class="d-flex justify-content-between mt-1">
                            <span class="text-white">Operation Detail</span>
                            <i class="ri ri-arrow-down-s-line"></i>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <span class="text-white">HN :</span>
                            <span class="text-white-camera">1234567890</span>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <span class="text-white">Name :</span>
                            <span class="text-white-camera">สดายุ ทองลอย</span>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <span class="text-white">Gender / Age :</span>
                            <span class="text-white-camera">Male / 40</span>
                        </div>

                        <div class="d-flex justify-content-between mt-1">
                            <span class="text-white">Endoscopist :</span>
                            <select class="form-select " data-choices>
                                <option value="">นพ.สุรัชณัฏฐ์ จิตรัตน์</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <span class="text-white">Room :</span>
                            <select class="form-select form-select-sm w-50">
                                <option value="">Room</option>
                            </select>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-between mt-1">
                                <span class="text-white">Attendant :</span>
                                <button class="btn btn-dark-primary btn-sm " data-bs-toggle="modal"
                                    data-bs-target="#attendant_modal">Select Attendant</button>
                            </div>
                            <div class="col-12 text-white-camera">
                                <div class="scroll p-3 ">
                                    <div class="d-flex justify-content-between mt-0">
                                        <span>นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                                        <span>Physician</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                                        <span>Physician</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                                        <span>Physician</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                                        <span>Physician</span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-2">
                                        <span>นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                                        <span>Physician</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-2"></div>
                                <div class="col-8 " style="border-bottom: 1px solid #707070"></div>
                                <div class="col-2"></div>
                            </div>
                            <div class="col-12 mt-2 ">
                                <div class="d-flex justify-content-between">
                                    <span class="text-white text-nowrap">Patient in time :</span>
                                    <div class="input-group w-50 ">
                                        <input type="text" class="form-control  form-control-sm"
                                            placeholder="hh:mm:ss" aria-label="Example text with button addon"
                                            aria-describedby="button-addon1">
                                        <button class="btn btn-outline-light btn-sm" type="button"
                                            id="button-addon1">
                                            <i class="ri-timer-fill"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="text-white text-nowrap">Start time :</span>
                                    <div class="input-group w-50 ">
                                        <input type="text" class="form-control  form-control-sm"
                                            placeholder="hh:mm:ss" aria-label="Example text with button addon"
                                            aria-describedby="button-addon1">
                                        <button class="btn btn-outline-light btn-sm" type="button"
                                            id="button-addon1">
                                            <i class="ri-timer-fill"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="text-white text-nowrap">Withdrawal time :</span>
                                    <div class="input-group w-50 ">
                                        <input type="text" class="form-control  form-control-sm"
                                            placeholder="hh:mm:ss" aria-label="Example text with button addon"
                                            aria-describedby="button-addon1">
                                        <button class="btn btn-outline-light btn-sm" type="button"
                                            id="button-addon1">
                                            <i class="ri-timer-fill"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="text-white text-nowrap">End time :</span>
                                    <div class="input-group w-50 ">
                                        <input type="text" class="form-control  form-control-sm"
                                            placeholder="hh:mm:ss" aria-label="Example text with button addon"
                                            aria-describedby="button-addon1">
                                        <button class="btn btn-outline-light btn-sm" type="button"
                                            id="button-addon1">
                                            <i class="ri-timer-fill"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-2"><button class="btn btn-dark-primary btn-sm  "
                                        data-bs-toggle="modal" data-bs-target="#medi_modal">Nurse Record
                                        (Interoperation)</button></div>

                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="text-white h5">Images (8)</span>
                    </div>
                    <div class="box-capture mt-2">
                        <div class="box-capture-image mt-2">
                            <img src="{{ url('public/image/@fortest/backup/1.1.jpg') }}" class="w-100"
                                alt="">
                            <span class='number-cap'>4</span>
                        </div>
                        <div class="box-capture-image mt-2">
                            <img src="{{ url('public/image/@fortest/backup/1.2.jpg') }}" class="w-100"
                                alt="">
                            <span class='number-cap'>3</span>
                        </div>
                        <div class="box-capture-image mt-2">
                            <img src="{{ url('public/image/@fortest/3.jpg') }}" class="w-100" alt="">
                            <span class='number-cap'>2</span>
                        </div>
                        <div class="box-capture-image mt-2">
                            <img src="{{ url('public/image/@fortest/4.jpg') }}" class="w-100" alt="">
                            <span class='number-cap'>1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="row">
                {{-- ถ้ามีกล้องเดียว --}}
                <div class="col-12" style="height: 85vh;">
                    <div class="w-100 pb-2 px-2 position-relative vdo-shows active" id="full_screen1">
                        <img src="{{ url('public/images/point/point003.bmp') }}" class="point-top1" id="cick-hide">
                        <div class="w-100 h-100 bg-black" id="full_screen2"></div>
                        <img src="{{ url('public/images/point/point004.bmp') }}" class="point-bottom1">
                    </div>
                </div>
                {{-- <div class="col-6" style="height: 82vh;">
                    <div class="w-100 pb-2 px-2 position-relative vdo-shows active" id="full_screen1">
                        <img src="{{ url('public/images/point/point003.bmp') }}" class="point-top1" id="cick-hide">
                        <div class="w-100 h-100 bg-black" id="full_screen2"></div>
                        <img src="{{ url('public/images/point/point004.bmp') }}" class="point-bottom1">
                    </div>
                </div>
                <div class="col-6" style="height: 82vh;">
                    <div class="w-100 pb-2 px-2 position-relative vdo-shows active" id="full_screen1">
                        <img src="{{ url('public/images/point/point003.bmp') }}" class="point-top1" id="cick-hide">
                        <div class="w-100 h-100 bg-black" id="full_screen2"></div>
                        <img src="{{ url('public/images/point/point004.bmp') }}" class="point-bottom1">
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-4 ">
                        <div class="row ms-1 box-detail p-3 ">
                            <div class="col-5 text-nowrap ">
                                Switch Status
                            </div>
                            <div class="col-7 text-success m-0 p-0">
                                Connected
                            </div>
                            <div class="row  text-nowrap">
                                <div class="col-5 align-self-center">
                                    Live Solution
                                </div>
                                <div class="col-7">
                                    <button class="btn btn-dark-camera btn-sm w-lg   " data-bs-toggle="modal"
                                        data-bs-target="#livestream_modal">
                                        <i class="ri-live-fill fs-14 me-3"></i>
                                        Live Stream</button>
                                </div>
                                <div class="col-5 align-self-center">

                                </div>
                                <div class="col-7">
                                    <button class="btn btn-dark-camera  btn-sm mt-2 w-lg" data-bs-toggle="modal"
                                        data-bs-target="#liveconsult_modal"><i class="ri-group-2-fill fs-14 me-3"></i> Live
                                        Consult</button>
                                </div>
                            </div>
                            <div class="row align-self-center">
                                <div class="col-5 ">
                                    Storage
                                </div>
                                <div class="col-7">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-nowrap">1.5 tb / 2 tb (80%)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-7 ">
                        <div class="row ms-1 box-detail p-3">
                            <div class="row mt-1">
                                <div class="col-2 align-self-center">
                                    Camera Source
                                </div>
                                <div class="col-2">
                                    <select name="" class="form-select form-select-sm " id="" style="border: 1px solid #707070">
                                        <option value="" selected>1</option>
                                        <option value="">2</option>

                                    </select>
                                </div>
                                <div class="col-5">
                                    <button type="button" class="btn btn-danger btn-sm  waves-effect waves-light">
                                        <i class="ri-refresh-line label-icon align-middle  me-2"></i> Reload
                                        Source</button>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="row mt-2" style="border-right: 1px solid #707070;">
                                        <div class="col-3 text-nowrap">
                                            Source 1
                                        </div>
                                        <div class="col-9">

                                            <select class="form-select" data-choices>
                                                <option value="">This is a placeholder</option>
                                                <option value="Choice 1">Choice 1</option>
                                                <option value="Choice 2">Choice 2</option>
                                                <option value="Choice 3">Choice 3</option>
                                            </select>
                                        </div>
                                        <div class="col-3"> </div>
                                        <div class="col-9 mt-2 d-flex justify-content-between">
                                            <div>
                                                <button type="button"
                                                    class="btn btn-icon btn-white-camera btn-sm waves-effect waves-light"><i
                                                        class="ri-camera-fill ri-lg"></i></button>
                                                <button type="button"
                                                    class="btn btn-icon btn-red btn-sm waves-effect waves-light"><i
                                                        class="ri-record-circle-line ri-lg"></i></button>
                                                <span class="text-danger ">00:00:00</span>
                                            </div>
                                            <div>
                                                <span class="text-white text-nowrap  " style="font-size: 7px;">Size
                                                    54.3 mb.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row mt-2">
                                        <div class="col-3 text-nowrap">
                                            Source 2
                                        </div>
                                        <div class="col-9">
                                            <select class="form-select form-select-sm w-100" data-choices>
                                                <option value="">This is a placeholder</option>
                                                <option value="Choice 1">Choice 1</option>
                                                <option value="Choice 2">Choice 2</option>
                                                <option value="Choice 3">Choice 3</option>
                                            </select>
                                        </div>
                                        <div class="col-3"> </div>
                                        <div class="col-9 mt-2 d-flex justify-content-between">
                                            <div>
                                                <button type="button"
                                                    class="btn btn-icon btn-white-camera btn-sm waves-effect waves-light"><i
                                                        class="ri-camera-fill ri-lg"></i></button>
                                                <button type="button"
                                                    class="btn btn-icon btn-red btn-sm waves-effect waves-light"><i
                                                        class="ri-record-circle-line ri-lg"></i></button>
                                                <span class="text-danger ">00:00:00</span>
                                            </div>
                                            <div>
                                                <span class="text-white text-nowrap  " style="font-size: 7px;">Size
                                                    54.3 mb.</span>
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
                                class="btn btn-success btn-label waves-effect waves-light make_report w-lg h-button fs-12"><i
                                    class="ri-file-text-line label-icon align-middle fs-14 me-2"></i>MAKE
                                REPORT</button>
                        </div>
                        <div class="col-12 ">
                            <button id="case_btn"
                                class="btn mt-2 btn-primary btn-label waves-effect waves-light w-lg h-button fs-12"><i
                                    class="ri-list-unordered label-icon align-middle fs-14 me-2"></i> CASE
                                LIST</button>
                        </div>
                        <div class="col-12 ">
                            <button type="button" id="back_btn"
                                class="btn mt-2 btn-danger btn-label waves-effect waves-light w-lg h-button fs-12"><i
                                    class="ri-arrow-go-back-line label-icon align-middle fs-14 me-2"></i> BACK</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

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



    {{-- <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script> --}}

</body>

</html>
