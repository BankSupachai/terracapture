@php
    $admin = getCONFIG('admin');
    if ($admin->menu_left_big_small) {
        $pagesize = 'lg';
    } else {
        $pagesize = 'sm';
    }

@endphp
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="{{ $pagesize }}"
    data-sidebar-image="none " data-preloader="enable" data-layout-mode="dark">

<head>

    <meta charset="utf-8" />
    <title>EndoINDEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

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
    <script src="{{ url('assets/js/pages/select2.init.js') }}"></script>
    <link href="{{ url('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <style>
        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Regular.ttf') }}") format("truetype");
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

        html {
            min-height: 100% !important
        }

        * {
            font-family: 'kanit' !important;
            /* color: #ffffff; */
        }

        .btn-primary {
            --vz-btn-bg: #245788;
            color: #ffffff !important;
        }

        .btn-primary:hover {
            background: #245788 !important;
            color: #ffffff !important;
        }

        .form-select {
            --vz-input-bg: #2B2F34;
            color: #bbbbbb;
            border: 0;
        }

        .offcanvas.offcanvas-end {
            border-left: 0px !important;
        }

        [data-layout-mode=dark] {
            --vz-input-bg: #2B2F34;
            --vz-body-bg: #000;
            --vz-vertical-menu-item-active-color-dark: #fff;
            --vz-vertical-menu-item-color-dark: #ffffff80;
            --vz-offcanvas-color: #bbbbbb;
            --vz-primary: #245788;
        }

        .nav-pills .nav-link {
            background: #222529;

        }

        .nav-pills .nav-link.active {
            --vz-nav-pills-link-active-bg: #245788;
            --vz-nav-pills-link-active-color: #ffffff
        }

        .border-bottom {
            border-bottom: 1px solid #b3b3b3 !important;
        }

        .border-bottom-solid {
            border-bottom: 1px solid #353535 !important;
        }

        :root {
            --vz-vertical-menu-bg-dark: #000;
            --bg-cleam: #FEF2DF;
            color: #fff;
            --vz-primary: #245788;

        }

        #page-topbar {
            background: #000;
            color: #fff;
        }

        .card-ipad {
            background: #222529;
            border-radius: 5px;
        }

        .bg-table-dark {
            background: #22252980;
            color: #fff;
        }

        .text-detail {
            color: #BBBBBB;
        }

        .btn-soft-darkness {
            background: #2B2F34;
            color: #fff;
        }

        .btn-soft-darkness:hover {
            background: #1b1d20;
            color: #fff;
        }

        .btn-dark-primary:hover {
            background: #1d476e;
            color: #fff
        }

        /* .form-control-dark{
            background: #2B2F34;
            border: 0;
            color: #fff;

        } */
        .form-control-dark:focus {
            background: #2B2F34;
            color: #fff;
        }

        .bg-darkness {
            background: #000;
        }

        .bg-softless-dark {
            background: #121212;
        }

        .offcanvas.offcanvas-start {
            border-right: 0px !important;
        }

        .pd-leftmenu {
            padding: 0.8rem 1.5rem;
            font-size: 16px;
            align-items: center;
            -webkit-box-align: center;
            display: flex;
        }

        /* .text-gray-ipad{
        color: #b1b1b1 !important;
       } */
        .font-gray {
            color: #BBBBBB;
        }

        /* .footer-ipad{
        position: absolute;
        bottom: 0px;
        padding: 1rem;
       } */

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-style: unset !important;
        }

        .w-95 {
            width: 95%;
        }

        .form-check-input {
            background: #222529;
            border: 1px solid #bbbbbb;
        }

        ::placeholder {
            color: #707070 !important;
        }

        .text-modal {
            cursor: pointer;
            text-decoration: underline;
        }

        .badge-soft-dark {
            background: transparent;
            color: #9599AD;
        }

        .border-upload {
            border: 1px solid #ffffff80;
            border-style: dashed;
            padding: 2em;
            color: #ffffff
        }

        .text-white50 {
            color: #ffffff80
        }


        .select2-container--default .select2-results>.select2-results__options {
            background-color: #2b2f34;
            color: #ffffff;
            z-index: 9999;

        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #ffffff;
            background: #2b2f34;
            border: 0px;
            line-height: 38px;
            border-radius: 4px;

        }

        .select2-container--default .select2-selection--single .select2-selection__clear {
            color: #ffffff;
            margin-right: 30px;

        }

        .select2-container .select2-selection--single .select2-selection__clear {
            font-size: 1.5em;
        }

        .select2-container .select2-selection--single {
            height: 38px;
        }

        .select2-container--default .select2-selection--single {
            background-color: #2b2f34;
            border: 0px;
            border-radius: 4px;
        }

        .select2-dropdown {
            border: 0px !important
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #405189;
        }

        /* .form-select {
            display: block;
            width: 100%;
            padding: 0.5rem 2.7rem 0.5rem 0.9rem;
            -moz-padding-start: calc(.9rem - 3px);
            font-size: .8125rem;
            font-weight: 400;
            line-height: 1.5;
            color: var(--vz-body-color);
            background-color: #000;
            border: 0px;
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right 0.9rem center;
            background-size: 16px 12px;
            border: 1px solid var(--vz-input-border);
            border-radius: 0.25rem;
            -webkit-transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out,-webkit-box-shadow .15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
    } */
    </style>
    @yield('style')
    {{-- เอาไว้ข้างล่างแล้วมันไม่ขึ้นครับเลยเอาไว้ตรงนี้   --}}
    <script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
    <script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
    <script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>

</head>
@yield('modal')

@yield('offcanvas')

<body>
    <div class="navbar-menu d-none">
    </div>


    <input id="removeNotificationModal" style="display:none">
    <div class="row p-3 m-0">
        <div class="col-8">

            {{-- @if (Request::segment(2) == 'cal' || Request::segment(2) == 'home' || Request::segment(2) == 'casemonitor' || Request::segment(2) == 'viewerRegister' || Request::segment(2) == 'overall' || Request::segment(2) == 'chdashboard') --}}
            {{-- @isset($menu) --}}
                @if (@$menu == 'home')
                    <button class="btn btn-icon bg-darkness text-white" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft">
                        <i class="ri-menu-2-line ri-xl"></i>
                    </button>
                @elseif (@$menu == 'btnaction')
                    @yield('btn-action')
                @else
                    <a onclick="history.back()" class="w-100"><i class="ri-arrow-go-back-fill ri-lg"></i></a>
                @endif
            {{-- @endisset --}}
            <span class=" text-white fs-20"> &ensp; @yield('tophead')</span>

        </div>
        <div class="col-4 text-end">
            @php
                $datetime = DateTime::createFromFormat('YmdHi', date('YmdHi'));
            @endphp
            <span class="text-white h4">
                {{ $datetime->format('D d/m/Y') }} &nbsp;
            </span>
            <span id="time" class="h4 text-white"></span>

        </div>

    </div>
    {{-- <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div> --}}
    {{-- @dd(Request::segment(2)) --}}

    @include('layouts.layouts_ipad.leftmenu')
    <div class="container-fluid top-page mb-3">

        @yield('content')


    </div>
    {{-- <div class="col-12 footer-ipad text-white50">
            © 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
        </div> --}}
    <!--content-->
    <!--content-->
    </div>

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
    <script src="{{ url('assets/js/pages/nestable.init.js') }}"></script>
    {{-- <script src="{{ url('assets/js/pages/calendar.init.js') }}"></script> --}}
    <script src="{{ url('assets/libs/sortablejs/Sortable.min.js') }}"></script>



    <script src="{{ url('assets/js/app.js') }}"></script>




    @include('tablet.nursenote.wizard.scriptnoteipad')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>






    {{-- ใช้งานไม่ได้ --}}


    <script type="text/javascript">
        var timestamp = '<?= time() ?>';

        function updateTime() {

            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            h = checkTime(h);
            var realtime = h + ":" + m + ":" + s;

            $('#time').html(realtime);
            timestamp++;
        }
        $(function() {
            setInterval(updateTime, 1000);
        });

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
    </script>

    @yield('script')

    <script>
        $("#topnav-hamburger-icon").click(function() {
            $.post("{{ url('api/jquery') }}", {
                event: "hamburger",
                config_type: 'admin'
            }, function(data, status) {});
        });
    </script>
    <script src='{{ url('public/js/autosize.js') }}'></script>
    <script>
        autosize(document.querySelectorAll('textarea'));
    </script>
    {{-- <div id="removeNotificationModal" style="display: none"></div> --}}
</body>

</html>
