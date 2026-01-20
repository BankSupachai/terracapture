<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-layout-mode="dark" data-layout-width="fluid" data-layout-position="fixed"
    data-layout-style="default">

<head>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8" />
    <title>Lumina Capture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{ asset('public/recorder/luminaicon.png') }}" rel="shortcut icon">
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/recorder/small-scale.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/dark.css') }}" rel="stylesheet" type="text/css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" href="@sweetalert2/themes/dark/dark.css"> --}}

    @yield('style')
    <style>

        .time-pos{
            position: absolute;
            font-size: 22px;
            padding-right: 4em;
            text-align: end;
            margin-top: 1em;
        }
        * {
            font-family: 'Anuphan', sans-serif !important;
        }

        .btn-refresh {
            color: black;
            background: #fff;
            border-radius: 50%;
        }
        .fs-thai{
            font-family: 'Anuphan'!important;
            unicode-range: U+0E00-U+0E7F;
        }

        @font-face{
            font-family: 'kanit';
            font-style: normal;
            font-weight: normal;
            src: url("{{url('public/fonts/Kanit-Regular.ttf')}}") format("truetype");
            /* /* unicode-range: U+41-5A, U+61-7A, U+C0-FF; */ */
        }
        @font-face{
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{url('public/fonts/Kanit-Bold.ttf')}}") format("truetype");
            /* unicode-range: U+41-5A, U+61-7A, U+C0-FF; */
        }
        @font-face{
            font-family: 'kanit';
            font-style: italic;
            font-weight: normal;
            src: url("{{url('public/fonts/Kanit-Italic.ttf')}}") format("truetype");
            /* unicode-range: U+41-5A, U+61-7A, U+C0-FF; */
        }
        @font-face{
            font-family: 'kanit';
            font-style: italic;
            font-weight: bold;
            src: url("{{url('public/fonts/Kanit-ExtraBoldItalic.ttf')}}") format("truetype");
            /* unicode-range: U+41-5A, U+61-7A, U+C0-FF; */
        }

        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 100;
            src: url("{{url('public/fonts/Anuphan-Thin.ttf')}}") format("truetype");
            unicode-range: U+0E00-U+0E7F;
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 200;
            src: url("{{url('public/fonts/Anuphan-ExtraLight.ttf')}}") format("truetype");
            unicode-range: U+0E00-U+0E7F;
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 300;
            src: url("{{url('public/fonts/Anuphan-Light.ttf')}}") format("truetype");
            unicode-range: U+0E00-U+0E7F;
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 400;
            src: url("{{url('public/fonts/Anuphan-Regular.ttf')}}") format("truetype");
            unicode-range: U+0E00-U+0E7F;
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 500;
            src: url("{{url('public/fonts/Anuphan-Medium.ttf')}}") format("truetype");
            unicode-range: U+0E00-U+0E7F;
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 600;
            src: url("{{url('public/fonts/Anuphan-SemiBold.ttf')}}") format("truetype");
            unicode-range: U+0E00-U+0E7F;
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: italic;
            font-weight: 700;
            src: url("{{url('public/fonts/Anuphan-Bold.ttf')}}") format("truetype");
            unicode-range: U+0E00-U+0E7F;
        }
    </style>
</head>

<body id="body">
    @yield('modal')
    @php
        $ds = disk_total_space('D:/') / 1024 / 1024 / 1024;
        $ds = intval($ds);
        $drive = disk_free_space('D:/') / 1024 / 1024 / 1024;
        $drive = intval($drive);
        $percent = ($drive * 100) / $ds;
        $percent = 100 - intval($percent);
        $drive_color = 'bg-success';
        if ($percent <= 24) {
            $drive_color = ' ';
        }
        if ($percent > 25 && $percent <= 49) {
            $drive_color = 'bg-success';
        }
        if ($percent >= 50 && $percent <= 74) {
            $drive_color = 'bg-info';
        }
        if ($percent >= 75 && $percent <= 84) {
            $drive_color = 'bg-warning';
        }
        if ($percent >= 85) {
            $drive_color = 'bg-danger';
        }
    @endphp
    <div class="row top-nav">

        <div class="col-4">
            <div class="row cn">
                <a href="" class="col-auto">
                    <img src="{{ url('public/recorder/luminalogo.png') }}" class="img-logo">
                </a>
                <div class="col pt-2 pr-5">
                    <label for="disk" class="text-white mt-1">{{ $drive }} / {{ $ds }} GB
                        ({{ $percent }}%)</label>
                    <div class="progress mb-4">
                        <div class="progress-bar {{ $drive_color }}" id="disk" role="progressbar"
                            style="width: {{ $percent }}%" aria-valuenow="{{ $percent }}" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="time-pos">
            <span id="currentTimeAndDate" class="text-nowrap"></span>
            <span id="clock" class="clock"></span>
            <button type="button" class="btn btn-refresh btn-icon waves-effect waves-light ms-3" style="z-index: 999999">
                <i class="ri-refresh-line ri-3x"></i>
            </button>
        </div>


        <div class="col-7 p-0 dropdown ms-5 ">
            {{-- <div id="currentTimeAndDate"></div>
            <div id="clock" class="clock" onload="currentTime()"></div> --}}
            {{-- <div id="MyClockDisplay" class="clock" onload="showTime()"></div> --}}
            <div class="row cn">
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    {{-- <a class="dropdown-item text-center" href="{{url('lumina/setting/video')}}"><i class="bx bx-video text-white align-middle"></i>&nbsp; <span class="align-middle">Video</span></a>
                    <a class="dropdown-item text-center" href="{{url('lumina/setting/sound')}}"><i class="bx bx-volume-full text-white align-middle"></i>&nbsp; <span class="align-middle">Sound</span></a>
                    <a class="dropdown-item text-center" href="{{url('lumina/setting/storage')}}"><i class="ri-server-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Storage</span></a>
                    <a class="dropdown-item text-center" href="{{url('lumina/setting/connection')}}"><i class="bx bx-broadcast text-white align-middle"></i>&nbsp; <span class="align-middle">Connection</span></a> --}}
                    <a class="dropdown-item text-center" href="{{ url('lumina/setting/about') }}"><i
                            class="ri-error-warning-fill text-white align-middle"></i>&nbsp; <span
                            class="align-middle">About</span></a>
                    <a class="dropdown-item text-center" href="{{ url('lumina/setting/shutdown') }}"><i
                            class="bx bx-power-off text-white align-middle"></i>&nbsp; <span
                            class="align-middle">Shutdown</span></a>
                </div>
            </div>
        </div>

    </div>
    @yield('content')


    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ url('public/recorder/jquery.min.js') }}"></script>

    {{-- <script src="sweetalert2/dist/sweetalert2.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script> --}}

    @yield('script')

    <script>
        var d = new Date();
        var weekday = new Array(7);
        weekday[0] = "Sun";
        weekday[1] = "Mon";
        weekday[2] = "Tue";
        weekday[3] = "Wed";
        weekday[4] = "Thu";
        weekday[5] = "Fri";
        weekday[6] = "Satur";

        var month = new Array(11);
        month[0] = "January";
        month[1] = "Febuary";
        month[2] = "March";
        month[3] = "April";
        month[4] = "May";
        month[5] = "June";
        month[6] = "July";
        month[7] = "August";
        month[8] = "September";
        month[9] = "October";
        month[10] = "November";
        month[11] = "December";

        //Monday, 6 April 2020 - example of how it will be displayed.
        var day =
            weekday[d.getDay()] +
            ", " +
            d.getDate() +
            " " +
            month[d.getMonth()] +
            ", " +
            d.getFullYear();
        document.getElementById("currentTimeAndDate").innerHTML = day;
    </script>

    <script>
        function currentTime() {
            let date = new Date();
            let hh = date.getHours();
            let mm = date.getMinutes();
            let ss = date.getSeconds();
            let session = "AM";


            if (hh > 12) {
                session = "PM";
            }
            hh = (hh < 10) ? "0" + hh : hh;
            mm = (mm < 10) ? "0" + mm : mm;
            ss = (ss < 10) ? "0" + ss : ss;

            let time = hh + ":" + mm + ":" + ss + " " + session;

            document.getElementById("clock").innerText = time;
            let t = setTimeout(function() {
                currentTime()
            }, 1000);

        }

        currentTime();
    </script>
</body>

</html>
