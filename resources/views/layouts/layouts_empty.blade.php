<!doctype html>
    <html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>MongoDB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{asset('public/recorder/luminaicon.png')}}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{url("public/assets5/js/layout.js")}}"></script>
    <link href="{{url("public/assets5/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/app.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{url("public/recorder/small-scale.css")}}" rel="stylesheet" type="text/css" /> --}}
    @yield('style')
</head>

<body id="body">
    @yield('modal')
    {{-- <div class="col-4 mb-2" style="">
        <input class="ck-image" type="checkbox" name="ck_image" id="myCheckbox{{$index+1}}" value="{{$data->na}}">
        <div style="background: rgb(68, 68, 68);">
            <label for="myCheckbox{{$index+1}}" class="w-100" style=" height: 36vh; ">
                <img src="http://localhost/store/{{$case->hn}}/{{$app_date}}/{{$data->na}}" alt="" class="img-recorder"
                style="position: absolute;top: 50%;
                transform: translateY(-50%);">
            </label>
        </div>
        <div class="number-image">{{$index+1}}</div>
    </div> --}}

    @yield('content')


<script src="{{url("public/recorder/assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{url("public/recorder/assets/libs/simplebar/simplebar.min.js")}}"></script>
<script src="{{url("public/recorder/assets/libs/node-waves/waves.min.js")}}"></script>
<script src="{{url("public/recorder/assets/libs/feather-icons/feather.min.js")}}"></script>
<script src="{{url("public/recorder/assets/js/pages/plugins/lord-icon-2.1.0.js")}}"></script>
<script src="{{url("public/recorder/assets/js/choices.min.js")}}"></script>
<script src="{{url("public/recorder/jquery.min.js")}}"></script>
@yield('script')

</body>

</html>
