<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EndoQUEUE</title>
    <link href="{{asset('public/bootstrap5/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{url('public/camera/jquery.min.js')}}"></script>
    <script src="{{url('public/bootstrap5/js/bootstrap.min.js')}}"></script>
    <script src="{{url('public/plugins/jquery-ui-1.12.1/jquery-ui.js')}}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        .content{
            width: 100%;
            height: 1065px;
            background: #197D6D;
            margin: 0;
            padding: 0;
        }
        .menu-top{
            width: 100%;
            height: 215px;
            background: #fff;
        }
        .img-logo{
            width: 300px;
        }
        .color-queue h5,.color-queue h1,.color-queue h6{
            color: #126658;
        }
        .menu-top .row{
            height: 100%;
            align-items: center;
        }
        @font-face {
            font-family: 'Kanit';
            src: url("{{ url('public/fonts/Kanit-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'Kanit_semibold';
            src: url("{{ url('public/fonts/Kanit-SemiBold.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        *{
            margin: 0;
            padding: 0;
            font-family: 'Kanit', sans-serif;
        }
    </style>
    @yield('style')
</head>
<body>
    <div class="menu-top">
        <div class="row m-0 py-4 px-0">
            <div class="col-4">
                <img src="{{hostname("config/putchin.png")}}" class="img-logo">
            </div>
            <div class="col-8 color-queue">
                <h3>แผนกส่องกล้อง</h3>
                <h1>โรงพยาบาลมหาราชนครราชสีมา</h1>
                <h5>ENDOSCOPY DEPARTMENT, MAHARAT NAKHON RATCHASIMA HOSPITAL</h5>
            </div>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>

    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/js/popper.min.js')}}"> </script>
    <script src="{{asset('public/js/bootstrap.min.js')}}"> </script>
    @yield('script')
</body>
</html>
