<!doctype html>
<html lang="en" data-layout="horizontal" data-layout-style="" data-sidebar="dark" data-layout-position="fixed" data-topbar="dark">

<head>

    <meta charset="utf-8" />
    <title>EndoINDEX</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <script src="{{url("assets/js/layout.js")}}"></script>
    <script src="{{url("public/js/jquery-3.6.0.min.js")}}"></script>
    <link href="{{url("assets/css/bootstrap.min.css")}}"                        rel="stylesheet" type="text/css" />
    <link href="{{url("assets/css/icons.min.css")}}"                            rel="stylesheet" type="text/css" />
    <link href="{{url("assets/css/app.min.css")}}"                              rel="stylesheet" type="text/css" />
    <link href="{{url("assets/css/custom.min.css")}}"                           rel="stylesheet" type="text/css" />
    <link href="{{url("assets/libs/@simonwep/pickr/themes/classic.min.css")}}"  rel="stylesheet" /> <!-- 'classic' theme -->
    <link href="{{url("assets/libs/@simonwep/pickr/themes/monolith.min.css")}}" rel="stylesheet" /> <!-- 'monolith' theme -->
    <link href="{{url("assets/libs/@simonwep/pickr/themes/nano.min.css")}}"     rel="stylesheet" /> <!-- 'nano' theme -->
    <link href="{{url("assets/css/select2.min.css")}}"                          rel="stylesheet" />
    <script src="{{url("assets/js/select2.min.js")}}"></script>
    <script src="{{url("assets/js/pages/select2.init.js")}}"></script>
    <style>

        /* 1E4971 */

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
            font-family: 'Kanit', sans-serif !important;

        }
        :root {
            --vz-vertical-menu-bg-dark: #164e63;
            --vz-header-bg: #fff;
            --vz-header-bg-dark:#1E4971;
            --vz-topbar-user-bg-dark:#225381;
            --vz-footer-bg:#1E4971;
            --vz-body-bg: #193D61;
            --vz-text: white;
            --vz-form-bg:#3A5B73;


        }
        [data-layout-mode=dark] {
            --vz-vertical-menu-bg-dark: #264C60;
            --vz-input-bg: #225381 ;

        }
        [data-layout=horizontal] .container-fluid, [data-layout=horizontal] .layout-width {
            max-width: 100%;
        }
        .btn-terralink{
            background: #193D61;
            color: #fff;
        }
        .dropdown-menu-cart{
            background: var(--vz-body-bg);
        }
        .btn-terralink:hover{
            background: #162e3b;
            color: white;
        }
        .btn-terralink:disabled{
            background: #193D61;
            color: #ffffff;
            border: 0;
        }
        .text-terralink{
            color: var(--vz-text);
        }
        .form-control-dark::placeholder{
            color: var(--vz-text);
        }
        .card-body{
            background: var(--vz-topbar-user-bg-dark);
        }
        .form-control-dark{
            border:none;
            color: var(--vz-text);
            background: #225381;
        }
        .form-select{
            --vz-input-bg: #225381;
            --vz-body-color: #ffffff;
            border: 0px;
        }
        .form-control-dark:active, .form-control-dark:focus-visible{
            background: #08212e;
            color: var(--vz-text);
        }
        .form-control-dark2{
            border:none;
            color: var(--vz-text);
            background: #193d61;
        }
        .form-control-dark2:active, .form-control-dark2:focus-visible{
            background: #3A5B73;
            color: var(--vz-text);
        }
        [data-layout=horizontal] #page-topbar {
            border-bottom: none;
        }
        .page-content > .container-fluid{
            height: 90vh;
        }
        .ai-c{
            align-items: center;
        }
        .btn-check:active+.btn-dark-terra, .btn-check:checked+.btn-dark-terra, .btn-dark-terra.active, .btn-dark-terra.dropdown-toggle.show, .btn-dark-terra:active {
            color: #fff;
            background-color: #225381;
            border-color: #225381;
        }
        .lh25{line-height: 2.5em !important;}
        .btn-dark-terra {
            color: #3A5B73;
            border-color: #3A5B73;
        }
        .btn-dark-terra{
            background-color: white;
        }
        .btn-dark-terra:hover{
            background-color: #245788;
            color: #ffffff;
        }
        .table-list{
            padding: 10px;
            background: #193D61;
        }
        .table-list > div{
            color: var(--vz-text);
        }
        .menu-data-list > .row{
            padding: 10px;
            border-bottom: 1px solid var(--vz-topbar-user-bg-dark);
        }
        .menu-data-list > .row > div{
            color: var(--vz-text);
        }
        .menu-data-list{
            overflow-y: auto;
            height: 49vh;
        }
        .menu-img-list{
            border-top: 1px solid var(--vz-topbar-user-bg-dark);
            padding: 3px 0px;
            height: 14vh;
            display: flex;
            overflow-x: auto;
        }
        .menu-img-list > img{
            width: 8vh;
            margin-right: 5px;
        }
        .menu-img-list::-webkit-scrollbar {
            height: 5px;
        }
        .menu-img-list::-webkit-scrollbar-track {
            background: var(--vz-body-bg);
        }
        .menu-img-list::-webkit-scrollbar-thumb {
            background: black;
        }

        .menu-img-list::-webkit-scrollbar-thumb:hover {
            background: rgb(63, 58, 58);
        }
        .menu-data-list .active{
            background: #346883;
        }
        .input-terralink{
            background: #193D61;
            border: 0
        }
        .input-terralink:focus{
            background: #193D61;
            border: 0;
            color: #fff;
        }
        .search-terra{
            width: 25%;
            position: absolute;
            left: 14em;
        }
        .select2-container--default .select2-results__option--selected {
    background: transparent;

}
.btn-another{
    color: #ffffff;
    background: #193D61;
}
.btn-another:hover{
    color: #ffffff;
    background: #11263b;
}

.select2-container--default .select2-selection--single {
    background: #245788;
    border: 1px transparent solid !important;

}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background: #245788;
    color: #ffffff;
    border: 0px !important;
 }
 .select2-container--default .select2-selection--multiple {
    background: #193D61;
    border: 0px !important;
 }
 .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
    background: #245788;
    color: #ffffff;
 }
 .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #ffffff;
    border: 0px !important;
 }

 .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable
 {background: #245788 !important;}
 .select2-results__option {color: #000000}
 .select2-dropdown {border: 1px solid #d4d6d8;}


 .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 5px;
            color: #ffffff;
        }
          .select2-container--default .select2-selection--single {
            height: 38px;
            border: 0px solid var(--vz-input-border) !important;
        }


        .select2-results__options::-webkit-scrollbar {
  width: 8px;
  background-clip: padding-box;
}
.select2-results__options::-webkit-scrollbar-track {
  background-color: #f4f4f4;
  height: 8px;
  border-right: 5px solid rgba(0, 0, 0, 0);
  border-top: 5px solid rgba(0, 0, 0, 0);
  border-bottom: 5px solid rgba(0, 0, 0, 0);
}

.select2-results__options::-webkit-scrollbar-thumb {
  background-color: #9599ad;
  border-right: 5px solid rgba(0, 0, 0, 0);
  border-top: 5px solid rgba(0, 0, 0, 0);
  border-bottom: 5px solid rgba(0, 0, 0, 0);
  border-radius: 4px;
}

    </style>
     @yield('style');
</head>

<div class="navbar-menu d-none">
</div>


<input id="removeNotificationModal" style="display:none">
<body style="zoom: 1.0;" id="body">
    @yield('modal')


<div id="layout-wrapper">

<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{url("")}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{url("public/image/EndoINDEX_white - Copy.png")}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{url("public/image/EndoINDEX white logo.png")}}" alt="" height="50">
                        </span>
                    </a>

                    <a href="{{url("")}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{url("public/image/EndoINDEX_white - Copy.png")}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{url("public/image/EndoINDEX white logo.png")}}" alt="" height="50">
                        </span>
                    </a>
                </div>

                @if(str_contains(Request::path(), 'case'))
                    <div class="mt-3">
                        <a href="{{url('terra/w-viewer')}}" class="btn btn-another"> <i class="ri-arrow-left-circle-line ri-lg"></i> Another Patient</a>
                    </div>
                @endif

            </div>
                {{-- <input type="text" class="form-control input-terralink search-terra" placeholder="Search for ID, Name…" oninput="function_search()"> --}}


            <div class="d-flex align-items-center">
                {{-- <div class="ms-1 header-item d-none d-sm-flex">
                    <i class='ri-cloud-fill  fs-22 text-success'></i>&emsp;
                </div> --}}
                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <!-- <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shardow-none" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-font-size-2 fs-22"></i>
                    </button> -->
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 dropdown-menu-cart" aria-labelledby="page-header-cart-dropdown">
                        <div class="row m-0 p-3">
                            <div class="col">
                                <button type="button" class="btn btn-outline-primary btn-icon waves-effect waves-light w-100" onclick="set_size(-0.1)"><i class="ri-subtract-line"></i></button>
                            </div>
                                <div class="col text-center">
                                <button type="button" class="btn btn-outline-success btn-icon waves-effect waves-light w-100" zoom="1.0" id="new_size">1.0</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-outline-primary btn-icon waves-effect waves-light w-100" onclick="set_size(0.1)"><i class="ri-add-fill"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Full screen
                    <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary shardow-none rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div> -->

                <!-- Darkmode
                    <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shardow-none">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div> -->
                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    {{-- <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shardow-none" id="page-header-alert-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-notification-4-line fs-22"></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">5<span class="visually-hidden">unread messages</span></span>
                    </button> --}}
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0 dropdown-menu-cart" aria-labelledby="page-header-alert-dropdown">
                        @for ($i=1;$i<=3;$i++)

                        <div class="alert alert-primary alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                            <i class="ri-notification-4-fill label-icon"></i><strong>{{date('H:i')}}</strong> - แจ้งเตือนทดสอบที่ {{$i}}
                        </div>

                        @endfor
                        <div class="alert alert-success alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                            <i class="ri-checkbox-multiple-fill label-icon"></i><strong>{{date('H:i')}}</strong> - ไฟล์ Dicom ID : {{rand(111,999)}} ถูกส่งสำเร็จ
                        </div>
                        <div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert">
                            <i class="ri-delete-bin-7-fill label-icon"></i><strong>{{date('H:i')}}</strong> - ไฟล์ Dicom ID : {{rand(111,999)}} ถูกลบแล้ว
                        </div>
                    </div>
                </div>
                <div class="dropdown ms-sm-3 header-item topbar-user">

                    <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{url("public/images/avatar.png")}}" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{uget("name")}}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{@uget("user_type")}}</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Welcome {{uget("name")}}!</h6>

                        <a class="dropdown-item" href="{{url('login')}}">
                            <i class="mdi mdi-logout text-danger fs-16 align-middle me-1"></i>
                            <span class="align-middle" data-key="t-logout">Logout</span>
                        </a>
                    </div>

                </div>

        </div>
    </div>
</header>
<div class="vertical-overlay"></div>
<div class="main-content">

    <div class="page-content p-1">
        <div class="container-fluid p-0">
            @yield('content')
        </div>
    </div>

{{--
    <footer class="footer">
        <div class="container-fluid">
            <div class="row text-light">
                <div class="col-sm-6">
                    © <script>document.write(new Date().getFullYear())</script>  EndoINDEX 6.0
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Medica Healthcare Co.,Ltd.
                    </div>
                </div>
            </div>
        </div>
    </footer> --}}

</div>

</div>




        {{-- <script src="{{url("public/assets5/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
        <script src="{{url("public/assets5/libs/simplebar/simplebar.min.js")}}"></script>
        <script src="{{url("public/assets5/libs/node-waves/waves.min.js")}}"></script>
        <script src="{{url("public/assets5/libs/feather-icons/feather.min.js")}}"></script>
        <script src="{{url("public/assets5/js/pages/plugins/lord-icon-2.1.0.js")}}"></script>
        <script src="{{url("public/assets5/js/choices.min.js")}}"></script>
        <script src="{{asset('public/js/jquery.min.js')}}"></script> --}}

        <script src="{{url("assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
        <script src="{{url("assets/libs/simplebar/simplebar.min.js")}}"></script>
        <script src="{{url("assets/libs/node-waves/waves.min.js")}}"></script>
        <script src="{{url("assets/libs/feather-icons/feather.min.js")}}"></script>
        <script src="{{url("assets/js/pages/plugins/lord-icon-2.1.0.js")}}"></script>
        {{-- <script src="{{url("assets/js/plugins.js")}}"></script> --}}
        @include('layouts.layouts_index.plugins')
        <script src="{{url("assets/libs/@simonwep/pickr/pickr.min.js")}}"></script>
        <script src="{{url("assets/js/pages/form-pickers.init.js")}}"></script>
        <script src="{{url("assets/js/select2.min.js")}}"></script>
        <script src="{{url("assets/js/pages/select2.init.js")}}"></script>
        <script src="{{url("assets/libs/fullcalendar/main.min.js")}}"></script>
        <script src="{{url("assets/js/app.js")}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            function set_size(size){
                var this_id = document.getElementById("new_size")
                var now_size = this_id.innerHTML
                var now_size_zoom = this_id.getAttribute('zoom')
                var new_zoom = parseFloat(now_size_zoom)+parseFloat(size)
                new_zoom = new_zoom.toFixed(1)
                if(new_zoom>0.5 && new_zoom<1.5){
                    this_id.innerHTML = new_zoom
                    this_id.setAttribute('zoom',new_zoom)
                    document.getElementById('body').style.zoom = new_zoom
                }
            }

            </script>
            @yield('script')
</body>

</html>
