<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">

    <!-- One of the following themes -->
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{url('assets/js/jsmain.js')}}"></script>
    <script src="{{url("assets/extra/select2/select2.min.js")}}"></script>

    <link rel="stylesheet" href="{{url("assets/extra/select2/select2.min.css")}}">
    <link rel="stylesheet" href="{{ url("assets/libs/dropzone/dropzone.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ url("assets/libs/filepond/filepond.min.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ url("assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css")}}">

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
    <link href="{{url('public/css/photoviewer/photoviewer.css')}}" rel="stylesheet" type="text/css">
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    {{-- <script src="{{ url('assets/js/pages/select2.init.js') }}"></script> --}}
    <link href="{{ url('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/css/select/select2.css') }}" rel="stylesheet" type="text/css">


    <link href="{{ url('assets/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">


    <style>
        body{
            background: #000000;
        }
        .bg-terra-mobile{
            background: #2B2E32;
            height: 200px;
        }
        .bg-tran{
            background: transparent;
        }
        .text-white60{
            color: #ffffff99
        }
        .terra_logo{
        width: 120px;

    }
    .btn-feature{
        color: #808080;
        font-size: 22px;
    }
    .text-terra{
        color: #808080;

    }
    </style>
</head>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        ...
    </div>
</div>



<div class="bg-terra-mobile">
    <div class="row px-2 p-0">
        <div class="col-6">
            <a class="btn btn-tran mt-2 text-white60" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <i class="ri-menu-2-line ri-2x"></i>
            </a>
        </div>
        <div class="col-6 text-end mt-2">
            <img src="{{url("public/images/TERRALINK1.PNG")}}" class="terra_logo"  alt="" >
        </div>
    </div>
    <div class="row text-center px-2 ">
        <div class="col-2 text-center text-terra">
            <button class="btn btn-feature">
                <i class="ri-zoom-in-line"></i>
            </button>
            <h5 >&ensp;Zoom</h5>
        </div>
        <div class="col-2" >
            <button class="btn btn-feature">
                <i class="ri-drag-move-2-fill"></i>
            </button>
            <h5 >&ensp;Pan</h5>
        </div>
        <div class="col-2 ">
            <button class="btn btn-feature">
                <i class="ri-layout-column-fill"></i>
            </button>
            <h5 >&ensp;Invert</h5>
        </div>
        <div class="col-2 ">
            <button class="btn btn-feature">
                <i class="ri-clockwise-fill"></i>
            </button>
            <h5 >&ensp;Rotate</h5>
        </div>
        <div class="col-2 ">
            <button class="btn btn-feature">
                <i class="ri-contrast-fill"></i>
            </button>
            <h5 >&ensp;Contrast</h5>
        </div>
        <div class="col-2">
            <button class="btn btn-feature">
                <i class=" ri-more-2-line"></i>
            </button>
            <h5 >&ensp;Other</h5>
        </div>

        <div class="col-2" >

        </div>
    </div>
    {{-- <div class="toggle-other">
        <div class="box-other">

            <div class="">
                <a href="#custom-hover-reviews" class="nav-link dropdown-toggle">
                    <i class="ri-file-edit-line nav-icon nav-tab-position d-toggle check-video"></i>
                    <h6 class="nav-titl nav-tab-position m-0 check-video">Anotate</h6>
                </a>
            </div>
            <div class="">
                <a href="#custom-hover-reviews"  class="nav-link dropdown-toggle">
                    <i class="ri-play-mini-fill nav-icon nav-tab-position d-toggle check-video"></i>
                    <h6 class="nav-titl nav-tab-position m-0 check-video">Cine</h6>
                </a>
            </div>
        </div>
    </div> --}}

</div>





<body>






    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
</body>



</html>
