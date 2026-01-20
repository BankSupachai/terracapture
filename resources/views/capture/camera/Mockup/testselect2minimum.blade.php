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
    data-sidebar-image="none " data-preloader="enable" @php
$color = configTYPE('admin','color')=='dark' @endphp
    @if ($color == 'dark') data-layout-mode="dark"
    @else
        data-layout-mode="light" @endif>

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

    <link rel="stylesheet" href="{{ url("assets/libs/dropzone/dropzone.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ url("assets/libs/filepond/filepond.min.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ url("assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css")}}">

    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
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

        * {
            font-family: 'Kanit', sans-serif;
        }

        /* :is([data-layout=vertical],[data-layout=semibox])[data-sidebar-size=sm] {
        min-height: 0 !important;
        } */
        .text-color-index {
            color: #245788;
        }
        .badge-soft-danger , .badge-soft-success , .badge-soft-warning {
            font-size: 12px !important;
        }
        .dropdown-icon-item.active {
            background: var(--vz-link-hover-color);
        }

        .bg-gray-input {
            background: #F3F6F9;
            border: 1px transparent !important;
        }

        .bg-gray-input:focus {
            background: #F3F6F9;
            transition: 3s ease-in-out;

        }

        .btn-procedure{
            background: #fff;
            color: #000;
            border: 1px solid #000;
            width: 100%;

        }
        .btn-procedure:hover{
            border: 1px solid #00000088;
            background: #245788;
            color: #fff;
        }

        /* .page-title-box {
            margin-top: -42px !important;
        } */


        /* .footer{
                position: fixed;
            } */


        .icon-wifi {
            color: var(--vz-vertical-menu-item-hover-color-dark);
        }

        .icon-wifi.active {
            color: var(--vz-green);
        }

        .cn {
            align-items: center;
        }

        .text-status-today {
            color: #FF8A72
        }

        .text-status-nextday {
            color: #FF2C00;
        }

        .text-status-otherday {
            color: var(--vz-heading-color);
        }

        .bg-is-white {
            background: var(--vz-input-bg);
        }

        :root {
            --vz-vertical-menu-bg-dark: #245788;
            --bg-cleam: #FEF2DF;
        }







        /* .choices__inner {
            background: #F3F6F9 !important;
            border: 0 !important;
        } */

        .choices__list--dropdown {
            z-index: 999 !important;
        }


        * {
            font-family: 'Kanit', sans-serif !important;
        }


    </style>
    @yield('style')


</head>

<body>

    @php
        $list_doctor = App\Models\Mongo::table('users')
            ->where('user_type', 'doctor')
            ->get();
    @endphp



    <div class="modal fade" id="select_doctor_list" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Doctor </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select name="" class="form-control" id="select_doctor_id">
                        <option value="none">Select Doctor</option>
                        @foreach ($list_doctor as $data)
                            <option value="{{ $data['id'] }}">{{ @$data['user_prefix'] }}
                                {{ @$data['user_firstname'] }} {{ @$data['user_lastname'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="link_doctor">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <input id="removeNotificationModal" style="display:none">
    @yield('modal')

    <div id="layout-wrapper">



        <div class="app-menu navbar-menu ">
            <div class="navbar-brand-box img-pos">

                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>


                </div>
            </div>
            <ul class="navbar-nav" id="navbar-nav">
            </ul>
            <div class="sidebar-background"></div>
        </div>
        <div class="vertical-overlay"></div>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid top-page">
                    <div class="row m-0 p-0">
                        <div class="col-12 p-0 m-0">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                @yield('title-left')
                                <div class="page-title-right">
                                    @yield('title-right')
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: -1em;">
                    @yield('content')
                </div>
                <!--content-->
                <!--content-->
                <div class="col-9">
                    <select class="form-select " data-choices>
                        <option value="">This is a placeholder</option>
                        <option value="Choice 1">Choice 1</option>
                        <option value="Choice 2">Choice 2</option>
                        <option value="Choice 3">Choice 3</option>
                    </select>
                </div>

            </div>
        </div>
    </div>
    @include('layouts.layouts_index.footer')

    <script src="{{url("assets/libs/dropzone/dropzone-min.js")}}"></script>
    <script src="{{url("assets/libs/filepond/filepond.min.js")}}"></script>
    <script src="{{url("assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js")}}"></script>
    <script src="{{url("assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js")}}"></script>
    <script src="{{url("assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js")}}"></script>
    <script src="{{url("assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js")}}"></script>
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






    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    {{-- ใช้งานไม่ได้ --}}


    <script src="{{ url('assets/js/app.js') }}"></script>




</body>

</html>
