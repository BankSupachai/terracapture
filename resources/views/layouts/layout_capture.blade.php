<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    @php
        $project = configTYPE("admin","project");
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8" />
    @if($project=='terralink')
    <title>Terralink</title>
    @else
    <title>EndoINDEX</title>
    @endif
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{asset('public/images/favicon.png')}}" rel="shortcut icon">
    <script src="{{url("public/assets5/js/layout.js")}}"></script>
    <link href="{{url("public/assets5/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/app.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/custom.min.css")}}" rel="stylesheet" type="text/css" />

    @if($project=='terralink')
        <style>
        :root {
            --vz-vertical-menu-bg-dark: #164e63;
        }
        </style>
    @else
        <style>
        :root {
            --vz-vertical-menu-bg-dark: #325684;
        }
        </style>
    @endif
    <style>

        [data-layout-mode=dark] {
            --vz-vertical-menu-bg-dark: #151529;
        }
        .menu-sitebar:hover{
            transition: 0.3s;
            /* background: #ffff; */
            color: white;
        }
        /* body{
            overflow: hidden;
        } */
        /* .app-menu.navbar-menu{
            background: rgb(0, 113, 187) !important;
        } */
        .menu-sitebar:hover i, .menu-sitebar:hover span {
            /* color: rgb(0, 113, 187); */
            color: white !important;
        }
        .navbar-menu .navbar-nav .nav-link i{
            color: #7f9daf !important;
        }
        .navbar-menu{
            border-right: none !important;
        }
        .none_hover{
            background: var(--vz-vertical-menu-bg-dark) !important;
        }
        .none_hover span{font-size: 8px;color: white !important;}
        .none_hover i{color: white !important;}
        .container-fluid{zoom: 1;}
        .nav-item.menu-sitebar.menu-item-active{
            color: white !important;
        }
        .nav-item.menu-sitebar i,.nav-item.menu-sitebar span{
            color: #D6DDE1;
        }
        .nav-item.menu-sitebar.menu-item-active i,.nav-item.menu-sitebar.menu-item-active span{
            color: white !important;
        }
        .shardow-none{box-shadow: none !important}
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--vz-vertical-menu-bg-dark);
        }
        .cn{
            align-items: center;
        }
        .logo-sm{
            margin-left: 1.7em;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: black;
        }

        .nav-item.menu-sitebar i, .nav-item.menu-sitebar span {
            color: rgb(127 157 168);
        }
        .navbar-menu{
            width: 180px;
        }
        .alt{
            align-items: flex-start !important;
        }
        .plb{
            padding-bottom: 5px;
        }
        @media (min-width: 768px){
            .main-content {
                margin-left: 180px;
            }
            #page-topbar {
                left: 180px;
            }
        }
        .footer {
            left: 180px;
        }
        /* .page-content *{ */
            *{
                font-size: 12px;
            }
            .page-content{
                padding-bottom: 0;
            }
        /* } */
        </style>
        @yield('style')
</head>

<body style="zoom: 1;" id="body">

    @php
        $ds = ((disk_total_space("D:/")/1024)/1024)/1024;
        $ds = intval($ds);
        $drive = ((disk_free_space("D:/")/1024)/1024)/1024;
        $drive = intval($drive);
        $persen = ($drive*100)/$ds;
        $persen = 100-intval($persen);
        // $ds = 20;
        // $drive = "C:";
        // $persen =25;
        $drive_color = 'bg-success';
        if($persen<=24){
            $drive_color = ' ';
        }
        if($persen>25 && $persen<=49){
            $drive_color = 'bg-success';
        }
        if($persen>50 && $persen<=74){
            $drive_color = 'bg-info';
        }
        if($persen>75 && $persen<=89){
            $drive_color = 'bg-warning';
        }
        if($persen>=90){
            $drive_color = 'bg-danger';
        }

    @endphp



    @yield('modal')
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="{{url("")}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{url("public/assets5/images/logo-sm.png")}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{url("public/assets5/images/logo-dark.png")}}" alt="" height="17">
                                </span>
                            </a>

                            <a href="{{url("")}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{url("public/assets5/images/logo-sm.png")}}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{url("public/assets5/images/logo-light.png")}}" alt="" height="17">
                                </span>
                            </a>
                        </div>
                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                        <form class="app-search d-none d-md-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Page Search..." autocomplete="off"
                                    id="search-options" value="">
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                            </div>
                            <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                                <div data-simplebar style="max-height: 320px;">
                                    <div class="dropdown-header mt-2">
                                        <h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
                                    </div>

                                    <!-- item-->
                                    <a href="{{url("admin/hospital/self/edit")}}" class="dropdown-item notify-item">
                                        <i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Hospital Setting</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{url("admin/procedure")}}" class="dropdown-item notify-item">
                                        <i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Procedure Setting</span>
                                    </a>

                                    <!-- item-->
                                    <a href="{{url("department")}}" class="dropdown-item notify-item">
                                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Department Setting</span>
                                    </a>

                                    <a href="{{url("accessory")}}" class="dropdown-item notify-item">
                                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Accessory</span>
                                    </a>

                                    <a href="{{url("wording")}}" class="dropdown-item notify-item">
                                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Wording</span>
                                    </a>

                                    <a href="{{url("logdata")}}" class="dropdown-item notify-item">
                                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Log Data</span>
                                    </a>

                                    <a href="{{url("logedit")}}" class="dropdown-item notify-item">
                                        <i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
                                        <span>Log Case</span>
                                    </a>
                                </div>


                            </div>
                        </form>
                    </div>

                    <div class="d-flex align-items-center">
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <i class='ri-wifi-fill fs-22 text-success'></i>&emsp;
                        </div>
                        <div class="dropdown topbar-head-dropdown ms-1 header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shardow-none" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-font-size-2 fs-22"></i>
                            </button>
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
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shardow-none">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary shardow-none rounded-circle" data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>




                        <!-- เมนูบนขวาผู้ใช้งาน -->
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
                                    <!-- item-->
                                    <h6 class="dropdown-header">Welcome {{uget("name")}}!</h6>

                                    <a class="dropdown-item" href="{{url('login')}}">
                                        <i class="mdi mdi-logout text-danger fs-16 align-middle me-1"></i>
                                        <span class="align-middle" data-key="t-logout">Logout</span>
                                    </a>
                                </div>

                            </div>
                        <!-- เมนูบนขวาผู้ใช้งาน -->

                    </div>
                </div>
            </div>
        </header>

        <!-- เมนูช้าย -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box text-start">
                    @if($project=='terralink')
                    <!-- Dark Logo-->
                    <a href="{{url('/')}}" class="logo logo-dark ">
                        <span class="logo-sm">
                            <img src="{{url('public/images/TERRA_ small_white.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img alt="Logo" src="{{url('public/images/Group 9.png')}}" style="height:2.5em;"/>
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="{{url('/')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{url('public/images/TERRA_ small_white.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img alt="Logo" src="{{url('public/images/Group 9.png')}}" style="height:2.5em;"/>
                        </span>
                    </a>

                    @else
                    <a href="{{url('/')}}" class="logo logo-dark ">
                        <span class="logo-sm">
                            <img src="{{url("public/image/logo_load.png")}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img alt="Logo" src="{{url('public/image/EndoINDEX white logo.png')}}" style="height:3.2em;"/>
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="{{url('/')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{url("public/image/EndoINDEX_white - Copy.png")}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img alt="Logo" src="{{url('public/image/EndoINDEX white logo.png')}}" style="height:3.2em;"/>
                        </span>
                    </a>
                    @endif
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>

                <div id="scrollbar" style="">
                    <div class="container-fluid">

                        <div id="two-column-menu">
                        </div>
                        <ul class="navbar-nav" id="navbar-nav">

                            @if($project=='terralink')

                            <li class="nav-item menu-sitebar">
                                <a href="javascript:;" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                    <i class="mdi mdi-chart-donut-variant"></i> <span data-key="t-layouts">Dashboards</span>
                                </a>
                            </li>
                            <li class="nav-item menu-sitebar @if(Request::segment(1) == "terra") menu-item-active @endif">
                                <a href="{{url('terra')}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                    <i class="ri-list-check"></i> <span data-key="t-layouts">Cases List</span>
                                </a>
                            </li>
                            <li class="nav-item menu-sitebar @if(Request::segment(1) == "procedure" || Request::segment(1) == "reportendocapture" || Request::segment(2) == "w-viewer") menu-item-active @endif">
                                <a href="{{url('terra/w-viewer')}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                    <i class="ri-article-line"></i> <span data-key="t-layouts">Viewer</span>
                                </a>
                            </li>
                            <li class="nav-item menu-sitebar @if(Request::segment(1) == "exportindex") menu-item-active @endif">
                                <a href="{{url('exportindex')}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                    <i class="bx bx-export"></i> <span data-key="t-layouts">Export</span>
                                </a>
                            </li>
                            @else
                                @if(@uget("user_type")!="admin")
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "home6") menu-item-active @endif">
                                        <a href="{{url("")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-home"></i> <span data-key="t-layouts">Home</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "patient") menu-item-active @endif">
                                        <a href="{{url("patient")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-account-search-outline"></i> <span data-key="t-layouts">Patient</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "searchdetail") menu-item-active @endif">
                                        <a href="{{url("searchdetail")}}" class="nav-link  text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-clipboard-search-outline"></i> <span data-key="t-layouts">Search</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "expdf") menu-item-active @endif">
                                        <a href="{{url("expdf")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-clipboard-text-multiple-outline"></i> <span data-key="t-layouts">PDF</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "analytic") menu-item-active @endif">
                                        <a href="{{url("analytic")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-chart-pie"></i> <span data-key="t-layouts">Analytic</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "alldata") menu-item-active @endif">
                                        <a href="{{url("alldata")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-application-export"></i> <span data-key="t-layouts">Export Data</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "casemonitor") menu-item-active @endif">
                                        <a href="{{url("casemonitor/control")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-human-male-board"></i> <span data-key="t-layouts">Nurse Monitor</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "billhomc") menu-item-active @endif">
                                        <a href="{{url("billhomc")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-card-text-outline"></i> <span data-key="t-layouts">Billing</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "emr") menu-item-active @endif">
                                        <a href="{{url('emr')}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-pulse"></i> <span data-key="t-layouts">emr</span>
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item menu-sitebar @if(Request::segment(1) == "admin_hospital") menu-item-active @endif" aria-haspopup="true" id="menu_procedures">
                                        <a href="{{url("admin_hospital/1/edit")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class=" ri-hospital-line"></i> <span data-key="t-layouts">Hospital Setting</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if (Request::segment(1) == "admin/procedure" || Request::segment(1) == "manage-procedure")   menu-item-active @endif">
                                        <a href="{{url("admin/procedure")}} " class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="ri-archive-drawer-line"></i> <span data-key="t-layouts">Procedure Setting</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if (Request::segment(1) == "department") menu-item-active @endif">
                                        <a href="{{url("department")}}" class="nav-link  text-white fs-6"  data-key="t-horizontal">
                                            <i class="ri-hospital-fill"></i> <span data-key="t-layouts">Department Setting</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if (Request::segment(1) == "accessory") menu-item-active @endif">
                                        <a href="{{url("accessory")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="ri-settings-fill"></i> <span data-key="t-layouts">Accessory</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if (Request::segment(1) == "wording") menu-item-active @endif">
                                        <a href="{{url("wording")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="ri-font-size"></i> <span data-key="t-layouts">Wording</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if (Request::segment(1) == "logdata") menu-item-active @endif">
                                        <a href="{{url("logdata")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class="mdi mdi-briefcase-clock"></i> <span data-key="t-layouts">Log Data</span>
                                        </a>
                                    </li>
                                    <li class="nav-item menu-sitebar @if (Request::segment(1) == "logedit") menu-item-active @endif">
                                        <a href="{{url("logedit")}}" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                            <i class=" ri-file-list-2-line"></i> <span data-key="t-layouts">Log Case</span>
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item menu-sitebar none_hover">
                                    <a href="layouts-horizontal.html" class="nav-link text-white fs-6"  data-key="t-horizontal">
                                        <i class="mdi mdi-database text-light mt-1"></i>
                                        <div class="row w-100">
                                            <div class="col-12 p-0">
                                                <div class="row">
                                                    <div class="col">
                                                        <span data-key="t-layouts" class="text-light">Storage</span>
                                                    </div>
                                                    <div class="col text-right text-end">
                                                        <span data-key="t-layouts" class="text-light">{{$drive}}  GB / {{$ds}} GB</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 p-0">
                                                <div class="progress progress-sm ">
                                                    <div class="progress-bar {{$drive_color}}" role="progressbar" style="width: {{$persen}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>

                <div class="sidebar-background"></div>
            </div>
        <!-- เมนูช้าย -->
        <div class="vertical-overlay"></div>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

               <!-- เมนูหัวชื่อ URL -->
                     <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">@yield('lpage')</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item">@yield('rpage')<a href="javascript: void(0);"></a></li>
                                        <li class="breadcrumb-item active">@yield('rppage')</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                <!-- เมนูหัวชื่อ URL -->
                @yield('content')

                </div>
            </div>


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © @if($project=='terralink') TERRALINK @else EndoINDEX 6.0 @endif
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Medica Healthcare Co.,Ltd.
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

    </div>





    <!-- JAVASCRIPT -->
    <script src="{{url("public/assets5/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/simplebar/simplebar.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/node-waves/waves.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/feather-icons/feather.min.js")}}"></script>
    <script src="{{url("public/assets5/js/pages/plugins/lord-icon-2.1.0.js")}}"></script>
    <script src="{{url("public/assets5/js/choices.min.js")}}"></script>

    <script src="{{url("public/assets5/js/plugins.js")}}"></script>

    <!-- App js -->
    <script src="{{url("public/assets5/js/app.js")}}"></script>






    @yield('script')
    <script>
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
</body>

</html>
