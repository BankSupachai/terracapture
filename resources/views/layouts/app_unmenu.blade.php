<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
    <head><base href="">

		<meta charset="utf-8" />
		<title>EndoINDEX</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		{{-- <link rel="canonical" href="https://keenthemes.com/metronic" /> --}}
        <link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
		{{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" /> --}}
		<link href="{{url("public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/custom/prismjs/prismjs.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/css/style.bundle.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/sample/assets/css/themes/layout/header/base/light.css")}}" rel="stylesheet" type="text/css"  id="set_blade"/>
		<link href="{{url("public/sample/assets/css/themes/layout/header/menu/light.css")}}" rel="stylesheet" type="text/css" id="set_menu" />
		<link href="{{url("public/sample/assets/css/themes/layout/brand/light.css")}}" rel="stylesheet" type="text/css" id="set_brand" />
        <link href="{{url("public/sample/assets/css/themes/layout/aside/light.css")}}" rel="stylesheet" type="text/css" id="set_aside" />
        {{--  --}}

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>
            *{
                margin: 0;
                padding: 0;
            }
            @media (min-width: 992px){
                .header-fixed.subheader-fixed.subheader-enabled .wrapper {
                    padding-top: 65px;
                    font-family: 'Kanit', sans-serif;
                }
            }
            .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link {
                background-color: #fff;
            }
            .svg-icon-light:hover{
                background-color: #4b95b6;
            }
            .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item > .menu-link .menu-text {
                color: #ffffff;
            }
            .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-text {
                color: rgb(0, 113, 187);
            }
            .far{
                padding: 0 !important;
            }
            #all_size{
                font-size: 16px !important;
            }
        </style>

<style>
    .cssload-thecube {
	width: 73px;
	height: 73px;
	margin: 0 auto;
	margin-top: 49px;
	position: relative;
	transform: rotateZ(45deg);
		-o-transform: rotateZ(45deg);
		-ms-transform: rotateZ(45deg);
		-webkit-transform: rotateZ(45deg);
		-moz-transform: rotateZ(45deg);
}
.cssload-thecube .cssload-cube {
	position: relative;
	transform: rotateZ(45deg);
		-o-transform: rotateZ(45deg);
		-ms-transform: rotateZ(45deg);
		-webkit-transform: rotateZ(45deg);
		-moz-transform: rotateZ(45deg);
}
.cssload-thecube .cssload-cube {
	float: left;
	width: 50%;
	height: 50%;
	position: relative;
	transform: scale(1.1);
		-o-transform: scale(1.1);
		-ms-transform: scale(1.1);
		-webkit-transform: scale(1.1);
		-moz-transform: scale(1.1);
}
.cssload-thecube .cssload-cube:before {
	content: "";
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgb(43,160,199);
	animation: cssload-fold-thecube 2.76s infinite linear both;
		-o-animation: cssload-fold-thecube 2.76s infinite linear both;
		-ms-animation: cssload-fold-thecube 2.76s infinite linear both;
		-webkit-animation: cssload-fold-thecube 2.76s infinite linear both;
		-moz-animation: cssload-fold-thecube 2.76s infinite linear both;
	transform-origin: 100% 100%;
		-o-transform-origin: 100% 100%;
		-ms-transform-origin: 100% 100%;
		-webkit-transform-origin: 100% 100%;
		-moz-transform-origin: 100% 100%;
}
.cssload-thecube .cssload-c2 {
	transform: scale(1.1) rotateZ(90deg);
		-o-transform: scale(1.1) rotateZ(90deg);
		-ms-transform: scale(1.1) rotateZ(90deg);
		-webkit-transform: scale(1.1) rotateZ(90deg);
		-moz-transform: scale(1.1) rotateZ(90deg);
}
.cssload-thecube .cssload-c3 {
	transform: scale(1.1) rotateZ(180deg);
		-o-transform: scale(1.1) rotateZ(180deg);
		-ms-transform: scale(1.1) rotateZ(180deg);
		-webkit-transform: scale(1.1) rotateZ(180deg);
		-moz-transform: scale(1.1) rotateZ(180deg);
}
.cssload-thecube .cssload-c4 {
	transform: scale(1.1) rotateZ(270deg);
		-o-transform: scale(1.1) rotateZ(270deg);
		-ms-transform: scale(1.1) rotateZ(270deg);
		-webkit-transform: scale(1.1) rotateZ(270deg);
		-moz-transform: scale(1.1) rotateZ(270deg);
}
.cssload-thecube .cssload-c2:before {
	animation-delay: 0.35s;
		-o-animation-delay: 0.35s;
		-ms-animation-delay: 0.35s;
		-webkit-animation-delay: 0.35s;
		-moz-animation-delay: 0.35s;
}
.cssload-thecube .cssload-c3:before {
	animation-delay: 0.69s;
		-o-animation-delay: 0.69s;
		-ms-animation-delay: 0.69s;
		-webkit-animation-delay: 0.69s;
		-moz-animation-delay: 0.69s;
}
.cssload-thecube .cssload-c4:before {
	animation-delay: 1.04s;
		-o-animation-delay: 1.04s;
		-ms-animation-delay: 1.04s;
		-webkit-animation-delay: 1.04s;
		-moz-animation-delay: 1.04s;
}
</style>


        {{-- <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script> --}}
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <script src="{{url("public/sample/assets/plugins/global/plugins.bundle.js")}}"></script>
        <script src="{{url("public/sample/assets/js/scripts.bundle.js")}}"></script>
        <script src="{{url("public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/features/calendar/external-events.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/widgets.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/form-repeater.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/select2.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/autosize.js")}}"></script>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @yield('style')
	</head>

    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable body_light body_light" id="body_set">
        @yield('modal')
        @yield('content')
        @yield('script')
        <script>
        </script>
	</body>
</html>
