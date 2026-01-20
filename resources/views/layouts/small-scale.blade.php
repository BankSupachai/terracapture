<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8" />
    <title>EndoINDEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
    <script src="{{url("public/assets5/js/layout.js")}}"></script>
    <link href="{{url("public/assets5/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/app.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/css/capture/small-scale.css")}}" rel="stylesheet" type="text/css" />

    @yield('style')
</head>

<body id="body">

    @yield('modal')
    <div class="row top-nav">
        <div class="col-4">
            <div class="row cn">
                <div class="col-auto"><img src="{{url('/public/image/EndoINDEX white logo.png')}}" class="img-logo"></div>
                <div class="col pt-2 pr-5">
                    <label for="disk" class="text-white mt-1">60 tb / 100 tb (60%)</label>
                    <div class="progress mb-4">
                        <div class="progress-bar" id="disk" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8 p-0 dropdown">
            <div class="row cn">
                <a class="col @if(Request::segment(1) == "w-record") active-url @endif" href="{{url('w-record')}}"><i class="ri-camera-lens-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Record</span> </a>
                <a class="col @if(Request::segment(1) == "w-worklist") active-url @endif" href="{{url('w-worklist')}}"><i class="ri-todo-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Worklist</span></a>
                <a class="col @if(Request::segment(1) == "w-store") active-url @endif" href="{{url('w-store')}}"><i class="ri-server-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Store</span></a>
                <label class="dropdown-toggle col m-0 @if(Request::segment(1) == "w-setting") active-url @endif" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-cog text-white align-middle"></i>&nbsp; <span class="align-middle">Setting</span>
                </label>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item text-center" href="{{url('w-setting/video')}}"><i class="bx bx-video text-white align-middle"></i>&nbsp; <span class="align-middle">Video</span></a>
                    <a class="dropdown-item text-center" href="{{url('w-setting/sound')}}"><i class="bx bx-volume-full text-white align-middle"></i>&nbsp; <span class="align-middle">Sound</span></a>
                    <a class="dropdown-item text-center" href="{{url('w-setting/storage')}}"><i class="ri-server-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Storage</span></a>
                    <a class="dropdown-item text-center" href="{{url('w-setting/connection')}}"><i class="bx bx-broadcast text-white align-middle"></i>&nbsp; <span class="align-middle">Connection</span></a>
                    <a class="dropdown-item text-center" href="{{url('w-setting/about')}}"><i class="ri-error-warning-fill text-white align-middle"></i>&nbsp; <span class="align-middle">About</span></a>
                    <a class="dropdown-item text-center" href="{{url('w-setting/shutdown')}}"><i class="bx bx-power-off text-white align-middle"></i>&nbsp; <span class="align-middle">Shutdown</span></a>
                </div>
            </div>
        </div>

    </div>
    @yield('content')



    <script src="{{url("public/assets5/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/simplebar/simplebar.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/node-waves/waves.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/feather-icons/feather.min.js")}}"></script>
    <script src="{{url("public/assets5/js/pages/plugins/lord-icon-2.1.0.js")}}"></script>
    <script src="{{url("public/assets5/js/choices.min.js")}}"></script>
    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    @yield('script')

</body>

</html>
