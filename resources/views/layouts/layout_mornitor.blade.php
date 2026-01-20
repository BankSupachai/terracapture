
<!DOCTYPE html>
<html lang="en">
    <head><base href="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta charset="utf-8" />
		<title>EndoNOTE</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
        <link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{url("public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/custom/prismjs/prismjs.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/css/style.bundle.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/sample/assets/css/themes/layout/header/base/light.css")}}" rel="stylesheet" type="text/css"  id="set_blade"/>
		<link href="{{url("public/sample/assets/css/themes/layout/header/menu/light.css")}}" rel="stylesheet" type="text/css" id="set_menu" />
		<link href="{{url("public/sample/assets/css/themes/layout/brand/light.css")}}" rel="stylesheet" type="text/css" id="set_brand" />
        <link href="{{url("public/sample/assets/css/themes/layout/aside/light.css")}}" rel="stylesheet" type="text/css" id="set_aside" />

        <style>
            body{
                background-color: #000000;
            }
            .logo_show,.nav{
                height: 6em;
            }
            .nav.nav-bold .nav-item .nav-link {
                font-weight: 400;
                justify-content: center;
            }
            .nav.nav-pills .nav-item{
                align-self: center;
            }
            .under-line{
                text-decoration: underline;
                color:#fff;
                font-size: larger;
            }
            .text-switch{
                font-size: larger;
                color: #fff;
            }
            .broder-mornitor{
                border-color: #37393E;
            }
            .top-menu{
                box-shadow: 0 0 11px #494545;
                height: 6em;
                position: fixed;
                z-index: 2;
                background: black;
                width: 100%;
            }
            .menu-contents{
                margin: 0;
                margin-top: 7em;
            }
            .aside-minimize .aside .aside-menu .menu-nav > .menu-item > .menu-link .menu-text,.aside-minimize .aside .aside-menu .menu-nav > .menu-item > .menu-link i,.aside-minimize .aside .aside-menu .menu-nav > .menu-item  img{
                display: none;
            }
            .aside-minimize .aside {
                display: none;
                width: 0px;
                transition: width 0.3s;
            }

            .aside-minimize .aside.active .aside-menu .menu-nav > .menu-item > .menu-link .menu-text,.aside-minimize .aside.active .aside-menu .menu-nav > .menu-item > .menu-link i,.aside-minimize .aside.active .aside-menu .menu-nav > .menu-item img{
                display: block;
            }
            .aside-minimize .aside.active{
                display: flex;
                /* transition: width 0.3s; */

                width: 265px;
            }
            #kt_aside_menu .menu-nav{
                z-index: 9999;
            }
            .border-logo{
                text-align: center;
                border-bottom: 2px groove #5F6267;
            }
            .border-logo img{
                height: 6em;
                width: 11em;
            }
        </style>
        @yield('style')
	</head>

    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable body_light aside-minimize body_dark w-100" id="body_set">
        @yield('modal')
        {{--  --}}
				<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

                    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper" style="background: #2E2F33;">
                        <div id="kt_aside_menu" class="aside-menu my-4 mt-0" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="background: #2E2F33;">
                            <ul class="menu-nav pt-0">
                                <li class="menu-item border-logo">
                                    <img src="{{url("public/image/endo_index.png")}}">
                                </li>
                                <li class="menu-item @if(Request::segment(1) == "ipad_index") menu-item-active @endif mt-3" aria-haspopup="true" id="menu_homes">
                                    <a href="{{url("ipad_index")}}" class="menu-link">
                                        <i class="la la-home text-light icon-lg"></i>
                                        <span class="menu-text text-light"> &emsp;Home</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(1) == "home") menu-item-active @endif" aria-haspopup="true" id="menu_homes">
                                    <a  class="menu-link" href="{{ route('logout') }}" onclick="   event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="la la-sign-out-alt text-light icon-lg"></i>
                                        <span class="menu-text text-light"> &emsp;{{ __('Logout') }}</span>
								    </a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{@uid()}}">
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>





        {{--  --}}
        <div class="row m-0 top-menu">
            <div class="col-3">
                <div class="row m-0">
                    <div class="col-auto p-0 pt-3">
                        <i class="la la-bars text-light icon-3x pt-2"></i>
                    </div>
                    <div class="col p-0">
                        <img src="{{url("public/image/endo_index.png")}}" class="logo_show">
                    </div>
                </div>

            </div>
            <div class="col-9">
                <ul class="nav nav-light-light nav-bold nav-pills row m-0">
                    <li class="nav-item col">
                        <a class="nav-link @if(Request::segment(1) == "ipad_mornitor") active @endif" href="{{url('ipad_mornitor')}}">Overall</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link @if(Request::segment(1) == "ipad_checkin") active @endif" href="{{url('ipad_checkin')}}">Check-in</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link @if(Request::segment(1) == "ipad_operation") active @endif" href="{{url('ipad_operation')}}">Operation</a>
                    </li>
                    <li class="nav-item col">
                        <a class="nav-link @if(Request::segment(1) == "ipad_post") active @endif" href="{{url('ipad_post')}}">Post-Operation</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="row menu-contents">
            <div class="col-3">
                @yield('tab-left')

            </div>
            <div class="col-9">
                @yield('content')
            </div>
        </div>


		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>






		<script src="{{url("public/sample/assets/plugins/global/plugins.bundle.js")}}"></script>
		<script src="{{url("public/sample/assets/plugins/custom/prismjs/prismjs.bundle.js")}}"></script>
		<script src="{{url("public/sample/assets/js/scripts.bundle.js")}}"></script>

        @yield('script')
        <script>
            $(".la-bars").click(function(){
                $("#kt_aside").addClass('active')
            })
            $(".menu-contents").click(function(){
                $("#kt_aside").removeClass('active');
            })
        </script>
	</body>
</html>
