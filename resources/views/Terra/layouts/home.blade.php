<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
    <head><base href="">

		<meta charset="utf-8" />
		<title>Terralink</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="{{url("public/images/Medica Health Care logo white.png")}}" rel="shortcut icon">
		<link href="{{url("public/sample/assets/plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/custom/prismjs/prismjs.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/css/style.bundle.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/sample/assets/css/themes/layout/header/base/light.css")}}" rel="stylesheet" type="text/css"/>
		<link href="{{url("public/sample/assets/css/themes/layout/header/menu/light.css")}}" rel="stylesheet" type="text/css"/>
		<link href="{{url("public/sample/assets/css/themes/layout/brand/light.css")}}" rel="stylesheet" type="text/css"  />
        <link href="{{url("public/sample/assets/css/themes/layout/aside/light.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/new/assets/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/new/assets/css/app.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/new/assets/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/css/layout_home.css")}}" rel="stylesheet" type="text/css" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="{{url("public/assets5/css/css2.css")}}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        @yield('style')
	</head>
    <body class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading aside-minimize">
        @yield('modal')
        <nav class="nav-terralink">
            <div class="sub"></div>
            <div class="main">
                <div class="row m-0 cn">
                    <div class="col-2 this-border-l"><img alt="Midone - HTML Admin Template" class="logo__image" src="{{url("public/images/Group 230.png")}}"></div>
                    <div class="col-8">
                        @yield('tab')

                    </div>
                    <div class="col-2 this-border-r">
                        <div class="row m-0 float-end">
                            <div class="col-12">
                                <div class="dropdown">
                                    <label class="text-light h5 dropdown-toggle m-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{uget("name")}}
                                    </label>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li><a href="{{url('profile')}}" class="dropdown-item"><i class="mdi mdi-account"></i> Profile</a></li>
                                        <li><a href="{{url('dashboard')}}" class="dropdown-item"><i class="mdi mdi-chart-arc"></i> Dashboard</a></li>
                                        <li><a href="{{url('statistic')}}" class="dropdown-item"><i class="mdi mdi-chart-areaspline"></i> Statistic</a></li>
                                        <li><a href="{{url('shared')}}" class="dropdown-item"><i class="mdi mdi-share-variant"></i> Shared</a></li>
                                        <li class="logout">
                                            <a href="{{ route('logout') }}" onclick="   event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                                <i class="mdi mdi-logout"></i> Logout
                                            </a>
                                            </li>
                                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="userid" value="{{@uid()}}">
                                        </form>
                                    </ul>
                                </div>
                            </div>
                            {{-- <div class="col-auto text-light h3 m-0">{{uget("name")}}</div>
                            <div class="col-auto pt-1">
                                <div class="dropdown">
                                    <a href="javascript:;" class="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-list text-light"></i>
                                    </a>
                                    <div class="dropdown-menu bg-terralink" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item bg-terralink" href="{{url('profile')}}"><i class="far fa-user-circle text-light mr-2"></i> Profile</a>
                                        <a class="dropdown-item" href="{{url('dashboard')}}"><i class="fas fa-chart-pie text-light mr-2"></i>Dashboard</a>
                                        <a class="dropdown-item" href="{{url('statistic')}}"><i class="fas fa-sliders-h text-light mr-2"></i>Statistic</a>
                                        <a class="dropdown-item" href="{{url('shared')}}"><i class="fas fa-share-alt text-light mr-2"></i>Shared</a>
                                        <a class="dropdown-item border-top pt-3"  href="{{ route('logout') }}" onclick="   event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt text-light mr-2"></i>Logout</a>
                                        <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="userid" value="{{@uid()}}">
                                        </form>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </nav>


        <div class="content">
            @yield('menu-header')
        </div>
        @yield('content')



        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <script src="{{url("public/sample/assets/plugins/global/plugins.bundle.js")}}"></script>
        <script src="{{url("public/sample/assets/js/scripts.bundle.js")}}"></script>
        {{-- <script src="{{url("public/js/jquery-3.2.1.min.js")}}"></script> --}}

        @yield('script')

	</body>
</html>
