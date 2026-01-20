@php
    $menu = getCONFIG('menu');
    $feature = getCONFIG('feature');

@endphp
@php
    $admin = getCONFIG('admin');
    // @dd($admin->theme_fontsize);
    if (@$admin->menu_left_big_small) {
        $pagesize = 'lg';
    } else {
        $pagesize = 'sm';
    }

@endphp
<!DOCTYPE html>
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
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ url('assets/js/jsmain.js') }}"></script>
    <script src="{{ url('assets/extra/select2/select2.min.js') }}"></script>

    <link rel="stylesheet" href="{{ url('assets/extra/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/libs/dropzone/dropzone.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet"
        href="{{ url('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">

    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" rel="stylesheet" />
    <!-- 'classic' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" rel="stylesheet" />

    <!-- 'monolith' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet" /> <!-- 'nano' theme -->
    <link href="{{ url('public/css/photoviewer/photoviewer.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    {{-- <script src="{{ url('assets/js/pages/select2.init.js') }}"></script> --}}
    <link href="{{ url('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ url('public/css/select/select2.css') }}" rel="stylesheet" type="text/css"> --}}


    <link href="{{ url('assets/css/bootstrap-datepicker.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ url('assets/css/select2.min.css') }}" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.standalone.css"> --}}

    {{-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet"> --}}
    {{-- //  Include Select2 JS --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <style>
        @font-face {
            font-family: 'Noto Sans Thai';
            src: url("{{ url('public/fonts/notosan/static/NotoSansThai-Regular.ttf') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'Noto Sans Thai';
            src: url("{{ url('public/fonts/notosan/static/NotoSansThai-Bold.ttf') }}") format('truetype');
            font-weight: bold;
            font-style: bold;
        }

        /* ห้ามลบ */
        .main-content .page-content {
            /* padding-top: 5.7em; */
            border-top: 1px solid #f3f6f9;
        }

        html {
            min-height: 100% !important
        }


        * {
            font-family: "Noto Sans Thai", sans-serif !important;
            /* font-family: 'Kanit', sans-serif !important; */
            /* font-weight: normal !important; */
            --vz-body-color: #495057;
        }


        .badge-soft-danger,
        .badge-soft-success,
        .badge-soft-warning {
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





        .icon-wifi {
            color: var(--vz-vertical-menu-item-hover-color-dark);
        }

        .icon-wifi.active {
            color: var(--vz-green);
        }

        .cn {
            align-items: center;
        }


        .bg-is-white {
            background: var(--vz-input-bg);
        }






        [data-layout-mode=dark] {
            --bg-cleam: #292e32;
            --vz-vertical-menu-bg-dark: #212529;
        }


        .to-checkbox {
            border-radius: 0 !important;
        }



        .choices__inner {
            background: #F3F6F9 !important;
            border: 0 !important;
        }

        .choices__list--dropdown {
            z-index: 999 !important;
        }

        .to-checkbox.form-check-input:checked[type=radio] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e") !important;
        }

        .form-check-input:checked {
            background-color: #245788;
            border-color: #245788;
        }

        .cs-pointer {
            cursor: pointer;
        }


        .tableFixHead {
            overflow-y: auto;
            height: 515px;
        }

        .tableFixHead thead tr {
            position: sticky;
            top: 0px;
            z-index: 99;
            color: #9599AD;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .img-pos {
            text-align: left;
        }

        .mt3em {
            margin-top: 3em;
        }

        [data-layout=vertical][data-sidebar=dark][data-sidebar-size=sm] .navbar-brand-box {
            text-align: center;
        }



        .breadcrumb-item.active {
            color: #9599ad !important;
        }

        .hover-active {
            background: #245788;
            color: #ffffff;
            width: 100px;

        }

        /* left menu + footer */
        :is([data-layout=vertical], [data-layout=semibox])[data-sidebar-size=sm] .navbar-menu .simplebar-content-wrapper,
        :is([data-layout=vertical], [data-layout=semibox])[data-sidebar-size=sm] .navbar-menu .simplebar-mask {
            overflow: auto !important;
        }

        .btn-track {
            position: fixed;
            top: 76%;
            right: 1%;
            border-radius: 50%;

        }

        .select2-container .select2-selection--single .select2-selection__clear {
            /* display: none !important; */
            /* font-size: 1.5em;
            color: #ffffff;
            margin-right: 1.5em; */
        }
        .loading-spinner {
    border: 2px solid #ffffff;
    border-left-color: #000;
    border-radius: 50%;
    width: 16px;
    height: 16px;
    animation: spin 1s linear infinite;
    display: inline-block;
    vertical-align: middle;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
    </style>
    @include('EndoINDEX.Component.css_main')
    @include('case.component.css.css')
    @yield('style')


</head>
{{-- @include('EndoNOTE.nursenote.component.modal.modal_infomation') --}}

<body>
    <script src="{{ url('assets/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- @dd(1) --}}
    @php
        $list_doctor = App\Models\Mongo::table('users')->where('user_type', 'doctor')->get();
    @endphp



    <div class="modal fade" id="select_doctor_list" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select name="" class="form-select select2" id="select_doctor_id" data-placeholder="เลือกแพทย์">
                        <option></option>
                        @foreach ($list_doctor??[] as $data)
                            <option value="{{ @$data->uid }}">{{ $data->user_prefix }}
                                {{ $data->user_firstname }} {{ $data->user_lastname }}</option>
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

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo ">
                            <a href="{{ url('') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ url('public/image/EndoINDEX_white - Copy.png') }}" alt=""
                                        height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ url('public/image/EndoINDEX white logo.png') }}" alt=""
                                        height="50">
                                </span>
                            </a>

                            <a href="{{ url('') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ url('public/image/EndoINDEX_white - Copy.png') }}" alt=""
                                        height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ url('public/image/EndoINDEX white logo.png') }}" alt=""
                                        height="50">
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-xl px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon ">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <div id="preloader">
                            <div id="status">
                                <div class="spinner-border text-primary avatar-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>

                        <!-- App Search-->
                        <form class="app-search d-none d-md-block">
                            <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                                <div data-simplebar style="max-height: 320px;">
                                    <!-- item-->
                                    <div class="dropdown-header">
                                        <h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
                                    </div>

                                    <div class="dropdown-item bg-transparent text-wrap">
                                        <a href="index.html" class="btn btn-soft-secondary btn-sm btn-rounded">how to
                                            setup <i class="mdi mdi-magnify ms-1"></i></a>
                                        <a href="index.html" class="btn btn-soft-secondary btn-sm btn-rounded">buttons
                                            <i class="mdi mdi-magnify ms-1"></i></a>
                                    </div>
                                    <!-- item-->
                                    <div class="dropdown-header mt-2">
                                        <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Analytics Dashboard</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Help Center</span>
                                    </a>

                                    <!-- item-->
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                        <span>My account settings</span>
                                    </a>

                                    <!-- item-->
                                    <div class="dropdown-header mt-2">
                                        <h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
                                    </div>

                                    <div class="notification-list">
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="{{ url('assets/images/users/avatar-2.jpg') }}"
                                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <h6 class="m-0">Angela Bernier</h6>
                                                    <span class="fs-11 mb-0 text-muted">Manager</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="{{ url('assets/images/users/avatar-3.jpg') }}"
                                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <h6 class="m-0">David Grasso</h6>
                                                    <span class="fs-11 mb-0 text-muted">Web Designer</span>
                                                </div>
                                            </div>
                                        </a>
                                        <!-- item -->
                                        <a href="javascript:void(0);" class="dropdown-item notify-item py-2">
                                            <div class="d-flex">
                                                <img src="{{ url('assets/images/users/avatar-5.jpg') }}"
                                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                                <div class="flex-1">
                                                    <h6 class="m-0">Mike Bunch</h6>
                                                    <span class="fs-11 mb-0 text-muted">React Developer</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="text-center pt-3 pb-1">
                                    <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All
                                        Results <i class="ri-arrow-right-line ms-1"></i></a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input name="txt_search" type="text" class="form-control"
                                                placeholder="Search ..." aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="ms-1 header-item d-none d-sm-flex" style="cursor: pointer;">
                            <span id="countdown" style="display: none;"></span>
                        </div>
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <a href="{{ url('server') }}" type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle">
                                <i class=' ri-settings-2-fill fs-22'></i>
                            </a>
                        </div>


                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class='ri-font-size-2 fs-22'></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
                                <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0 fw-semibold fs-15">Page size</h6>
                                        </div>

                                    </div>
                                </div>

                                <div class="p-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item  theme_fontsize  @if (@$admin->theme_fontsize == '50') active @endif"
                                                size="50" href="#!">
                                                <i class="ri-font-size"></i>
                                                <span>50%</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item theme_fontsize  @if (@$admin->theme_fontsize == '75') active @endif"
                                                size="75" href="#!">
                                                <i class="ri-font-size"></i>
                                                <span>75%</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item theme_fontsize @if (@$admin->theme_fontsize == '100') active @endif"
                                                size="100" href="#!">
                                                <i class="ri-font-size"></i>
                                                <span>100%</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item theme_fontsize @if (@$admin->theme_fontsize == '125') active @endif "
                                                size="125" href="#!">
                                                <i class="ri-font-size"></i>
                                                <span>125%</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item theme_fontsize  @if (@$admin->theme_fontsize == '150') active @endif"
                                                size="150" href="#!">
                                                <i class="ri-font-size"></i>
                                                <span>150%</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item theme_fontsize  @if (@$admin->theme_fontsize == '175') active @endif"
                                                size="175" href="#!">
                                                <i class="ri-font-size"></i>
                                                <span>175%</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>



                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user"
                                        src="{{ url('public/images/account.png') }}" alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">
                                            {{-- @dd($_COOKIE); --}}
                                            {{ uget('user_prefix') }} {{ uget('user_firstname') }}
                                            {{ uget('user_lastname') }}

                                        </span>
                                        <span
                                            class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ uget('user_type') }}</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome

                                    {{ uget('user_prefix') }} {{ uget('user_firstname') }}
                                    {{ uget('user_lastname') }}
                                    !
                                </h6>

                                @if (@$feature->adfs)
                                    <a id="btn_logout" href="{{ url('api/adfs/logout/edit') }}"
                                        class="dropdown-item auto-logout" onclick="">
                                        <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                        <span class="align-middle" data-key="t-logout">Logout</span>
                                    </a>
                                @else
                                    <a class="dropdown-item auto-logout" href="{{ route('logout') }}"
                                        onclick="   event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                            class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                            class="align-middle" data-key="t-logout">Logout</span></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{ @uid() }}">
                                    </form>
                                @endif




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="app-menu navbar-menu ">
            <div class="navbar-brand-box img-pos">
                <a href="{{ url('track/index') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ url('public/image/EndoINDEX_white - Copy.png') }}" alt=""
                            height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url('public/image/EndoINDEX white logo.png') }}" alt="" height="50">
                    </span>
                </a>

                <a href="{{ url('') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ url('public/image/EndoINDEX_white - Copy.png') }}" alt=""
                            height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url('public/image/EndoINDEX white logo.png') }}" alt="" height="50">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            {{-- @if (isMobile()) --}}
            @include('layouts.layouts_index.leftmenu')
            {{-- @endif --}}
            <div class="sidebar-background"></div>
        </div>
        <div class="vertical-overlay"></div>
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid top-page">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        @yield('title-left')
                        <div class="page-title-right">
                            @yield('title-right')
                        </div>
                    </div>
                </div>
                @yield('content')

                @if (@$feature->track)
                    <a onclick="openWin()" class="btn btn-success btn-icon btn-track">
                        <i class="ri ri-camera-lens-fill"></i>
                    </a>
                @endif
                {{-- <div class="hover-active">
                    Cases List
                </div> --}}
            </div>
        </div>
    </div>

    @include('layouts.layouts_index.footer')



    <script src="{{ url('assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ url('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ url('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ url('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>

    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    {{-- <script src="{{url("assets/js/plugins.js")}}"></script> --}}
    {{-- @include('layouts.layouts_index.plugins') --}}
    <script src="{{ url('assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script>
    <script src="{{ url('assets/js/select2.min.js') }}"></script>

    {{-- <script src="{{ url('assets/js/pages/select2.init.js') }}"></script> --}}
    <script src="{{ url('assets/libs/fullcalendar/main.min.js') }}"></script>
    <script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script>
    <script src="{{ url('assets/js/toastify.js') }}"></script>
    <script src="{{ url('assets/js/jquery.countdown360.js') }}"></script>
    <script src="{{ url('assets/js/ckeditor.js') }}"></script>
    <script src="{{ asset('public/js/line.js') }}"></script>
    <script src="{{ domainnameport(':3000/socket.io/socket.io.js') }}"></script>

    <script>
$(".btn-loading").click(function(){
    if ($(this).closest('form')[0].checkValidity()) {
        $(this).addClass('disabled');
        $(this).html('<span class="loading-spinner"></span> &ensp; Loading...');
        setTimeout(() => {
            $(this).removeClass('disabled');
        }, 3000);
    }
});
$(".btn-load").click(function(){
        $(this).addClass('disabled');
        $(this).html('<span class="loading-spinner"></span> &ensp; Loading...');
        setTimeout(() => {
            $(this).removeClass('disabled');
        }, 3000);
});
$(".btn-loadicon").click(function(){
        $(this).addClass('disabled');
        $(this).html('<span class="loading-spinner"></span>');
        setTimeout(() => {
            $(this).removeClass('disabled');
        }, 3000);
});


        $(".theme_fontsize").on("click", function() {
            var size = $(this).attr("size");
            $.post("{{ url('api/jquery') }}", {
                event: "theme_fontsize",
                size: size
            }, function(data, status) {
                location.reload();
            });

        })
    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    {{-- ใช้งานไม่ได้ --}}

    <script>
        function flatpickr() {
            return "";
        }
    </script>





    <script src="{{ url('assets/js/app.js') }}"></script>
    {{-- <script src="{{url("assets/js/pages/calendar.init.js")}}"></script> --}}


    <script>
        $('#link_doctor').click(function() {
            var doctor_id = $("#select_doctor_id").val()
            if (doctor_id != 'none') {
                window.location.href = "{{ url('book/setting_doctor') }}/" + doctor_id;
            }
        })
    </script>
    <script>
        $('.light-dark-mode').click(function() {
            var color = $("html").attr('data-layout-mode')
            $.post("{{ url('superadmin') }}", {
                event: "config_type",
                config_type: 'admin',
                id: 'color',
                value: color,
            }, function(data, status) {});
        })
    </script>

    @yield('script')

    <script>
        // เฉพาะวชิระอย่างเดียว
        $("#topnav-hamburger-icon").click(function() {
            $.post("{{ url('api/jquery') }}", {
                event: "hamburger",
                config_type: 'admin'
            }, function(data, status) {});
        });
    </script>
    <script>
        let open_trackmenu;


        function openWin() {
            open_trackmenu = window.open("{{ url('track/index') }}", "_blank", "width=786, height=786");
        }

        function closeWin() {
            open_trackmenu.close();
        }

    </script>

    <script>
        $(document).ready(function() {
            $("#select_doctor_id").select2({
                dropdownParent: $('#select_doctor_list'),
                width: '100%',
                allowClear: true
            });
        });
    </script>
</body>

</html>
