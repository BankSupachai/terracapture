<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
    <head><base href="">

		<meta charset="utf-8" />
		<title>EndoINDEX</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
		<link href="{{url("public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/global/plugins.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/plugins/custom/prismjs/prismjs.bundle.css")}}" rel="stylesheet" type="text/css" />
		<link href="{{url("public/sample/assets/css/style.bundle.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/sample/assets/css/themes/layout/header/base/light.css")}}" rel="stylesheet" type="text/css"  id="set_blade"/>
		<link href="{{url("public/sample/assets/css/themes/layout/header/menu/light.css")}}" rel="stylesheet" type="text/css" id="set_menu" />
		<link href="{{url("public/sample/assets/css/themes/layout/brand/light.css")}}" rel="stylesheet" type="text/css" id="set_brand" />
        <link href="{{url("public/sample/assets/css/themes/layout/aside/light.css")}}" rel="stylesheet" type="text/css" id="set_aside" />
        <link href="{{url("public/css/capture/layout.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{url("public/css/layouts/appindex.css")}}" rel="stylesheet" type="text/css" />

        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <style>

                ::-webkit-scrollbar {
                    width: 5px;
                    height: 5px;
                }

                ::-webkit-scrollbar-track {
                    /* box-shadow: inset 0 0 5px grey; */
                    /* border-radius: 10px; */
                }

                ::-webkit-scrollbar-thumb {
                    background: #B5B5C3;
                    border-radius: 10px;
                }

                ::-webkit-scrollbar-thumb:hover {
                    background: skyblue;
                }
                #set_menu_config .row{
                    align-items: center;
                }
                .cn{
                    align-items: center;
                }
        </style>
        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 },
		"colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" },
		"light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" },
		"inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } },
		"gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } },
		"font-family": "Poppins" };</script>
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
@php
        $ds = ((disk_total_space("/")/1024)/1024)/1024;
        $ds = intval($ds);
        $drive = ((disk_free_space("/")/1024)/1024)/1024;
        $drive = intval($drive);
        $persen = ($drive*100)/$ds;
        $persen = 100-intval($persen);
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


        @yield('style')
	</head>

    @php
        if(getCONFIG('admin')->menu_left_big_small){
            $menuleft = "";
        }else{
            $menuleft = "aside-minimize";
        }
    @endphp
    <body id="kt_body" class="header-fixed header-mobile-fixed {{$menuleft}} subheader-enabled subheader-fixed aside-enabled aside-fixed body_light body_light" id="body_set">
        @yield('modal')


        <div class="modal fade" id="modal_progress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered" role="document">
              <div class="modal-content" style="box-shadow: none; border: none;">
                <div class="modal-body">
                    <div class="cssload-thecube mb-5">
                        <div class="cssload-cube cssload-c1"></div>
                        <div class="cssload-cube cssload-c2"></div>
                        <div class="cssload-cube cssload-c4"></div>
                        <div class="cssload-cube cssload-c3"></div>
                    </div>
                    <br>
                    <h2 style="text-align: -webkit-center;">กำลังบันทึกข้อมูล</h2>
                </div>
              </div>
            </div>
        </div>

		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
			<a href="{{url("")}}">
				<img alt="Logo" src="{{url('public/image/EndoINDEX.png')}}" style="max-width: 200px;"/>
			</a>
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
					<span></span>
				</button>
				<button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
					</span>
				</button>
			</div>
		</div>
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
				<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
					<div class="brand flex-column-auto" id="kt_brand">
						{{-- <a href="{{url("")}}" class="brand-logo" style="position: absolute;right:1em;">
							<img alt="Logo" src="{{url("public/image/EndoINDEX.png")}}" style="max-width: 180px;"/>
						</a> --}}
						<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
										<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
									</g>
								</svg>
							</span>
						</button>
					</div>
					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper" style="background: #4FB0D1;">
						<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="background: #4FB0D1;">
							<ul class="menu-nav">
                            {{-- @dd(configTYPE('menu','admin_home')) --}}
                            @php
                                $id_type = 'admin';
                                if(@uget("user_type")!="admin"){
                                    $id_type = 'endocapture';
                                }
                            @endphp

                                @if(configTYPE('menu',"$id_type"."_home"))
                                    <li class="menu-item @if(Request::segment(1) == "home") menu-item-active @endif" aria-haspopup="true" id="menu_homes">
                                        <a href="{{url("")}}" class="menu-link">
                                            <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "home") svg-icon-primary @else svg-icon-light @endif" id="menu_home"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Home.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                                                </g>
                                            </svg></span>
                                            <span class="menu-text"> &emsp;Home</span>
                                        </a>
                                    </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_patient"))
                                    <li class="menu-item @if(Request::segment(1) == "patient") menu-item-active @endif" aria-haspopup="true" id="menu_paients">
                                        <a href="{{url("patient")}}" class="menu-link">
                                            <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "patient") svg-icon-primary @else svg-icon-light @endif" id="menu_paient"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg></span>
                                            <span class="menu-text"> &emsp;Patient</span>
                                        </a>
                                    </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_search"))
                                <li class="menu-item @if(Request::segment(1) == "searchdetail") menu-item-active @endif" aria-haspopup="true" id="menu_searchs">
                                    <a href="{{url("searchdetail")}}" class="menu-link">
                                        <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "searchdetail") svg-icon-primary @else svg-icon-light @endif" id="menu_search"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Search.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg></span>
										<span class="menu-text"> &emsp;Search</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_pdf"))
                                <li class="menu-item @if(Request::segment(1) == "expdf") menu-item-active @endif" aria-haspopup="true" id="menu_pdfs">
                                    <a href="{{url("expdf")}}" class="menu-link">
                                        <span class="svg-icon svg-icon-2x  @if(Request::segment(1) == "expdf") svg-icon-primary @else svg-icon-light @endif" id="menu_pdf"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Clipboard-list.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                                                <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                                            </g>
                                        </svg></span>
										<span class="menu-text"> &emsp;PDF</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_analytic"))
                                <li class="menu-item @if(Request::segment(1) == "analytic") menu-item-active @endif" aria-haspopup="true" id="menu_charts">
                                    <a href="{{url("analytic")}}" class="menu-link">
                                        <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "analytic") svg-icon-primary @else svg-icon-light @endif" id="menu_chart"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-pie.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000"/>
                                            </g>
                                        </svg></span>
										<span class="menu-text"> &emsp;Analytic</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_export_data"))
                                <li class="menu-item @if(Request::segment(1) == "alldata") menu-item-active @endif" aria-haspopup="true" id="menu_exports">
                                    <a href="{{url("alldata")}}" class="menu-link">
                                    <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "alldata") svg-icon-primary @else svg-icon-light @endif" id="menu_export"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Share.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M10.9,2 C11.4522847,2 11.9,2.44771525 11.9,3 C11.9,3.55228475 11.4522847,4 10.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,16 C20,15.4477153 20.4477153,15 21,15 C21.5522847,15 22,15.4477153 22,16 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L10.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path d="M24.0690576,13.8973499 C24.0690576,13.1346331 24.2324969,10.1246259 21.8580869,7.73659596 C20.2600137,6.12944276 17.8683518,5.85068794 15.0081639,5.72356847 L15.0081639,1.83791555 C15.0081639,1.42370199 14.6723775,1.08791555 14.2581639,1.08791555 C14.0718537,1.08791555 13.892213,1.15726043 13.7542266,1.28244533 L7.24606818,7.18681951 C6.93929045,7.46513642 6.9162184,7.93944934 7.1945353,8.24622707 C7.20914339,8.26232899 7.22444472,8.27778811 7.24039592,8.29256062 L13.7485543,14.3198102 C14.0524605,14.6012598 14.5269852,14.5830551 14.8084348,14.2791489 C14.9368329,14.140506 15.0081639,13.9585047 15.0081639,13.7695393 L15.0081639,9.90761477 C16.8241562,9.95755456 18.1177196,10.0730665 19.2929978,10.4469645 C20.9778605,10.9829796 22.2816185,12.4994368 23.2042718,14.996336 L23.2043032,14.9963244 C23.313119,15.2908036 23.5938372,15.4863432 23.9077781,15.4863432 L24.0735976,15.4863432 C24.0735976,15.0278051 24.0690576,14.3014082 24.0690576,13.8973499 Z" fill="#000000" fill-rule="nonzero" transform="translate(15.536799, 8.287129) scale(-1, 1) translate(-15.536799, -8.287129) "/>
                                        </g>
                                    </svg></span>
										<span class="menu-text"> &emsp;Export Data</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_nurse_monitor"))
                                <li class="menu-item @if(Request::segment(1) == "casemonitor") menu-item-active @endif" aria-haspopup="true" id="menu_exports">
                                    <a href="{{url("casemonitor/board")}}" class="menu-link">
                                    <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "casemonitor") svg-icon-primary @else svg-icon-light @endif" id="menu_export"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Share.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <polygon fill="#000000" opacity="0.3" points="6 7 6 15 18 15 18 7"/>
                                            <path d="M11,19 L11,16 C11,15.4477153 11.4477153,15 12,15 C12.5522847,15 13,15.4477153 13,16 L13,19 L14.5,19 C14.7761424,19 15,19.2238576 15,19.5 C15,19.7761424 14.7761424,20 14.5,20 L9.5,20 C9.22385763,20 9,19.7761424 9,19.5 C9,19.2238576 9.22385763,19 9.5,19 L11,19 Z" fill="#000000" opacity="0.3"/>
                                            <path d="M6,7 L6,15 L18,15 L18,7 L6,7 Z M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,15 C20,16.1045695 19.1045695,17 18,17 L6,17 C4.8954305,17 4,16.1045695 4,15 L4,7 C4,5.8954305 4.8954305,5 6,5 Z" fill="#000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg></span>
										<span class="menu-text"> &emsp;Nurse Monitor</span>
                                    </a>
                                </li>
                                @endif


                                @if(configTYPE('menu',"$id_type"."_hospital_setting"))
                                <li class="menu-item @if(Request::segment(1) == "admin_hospital") menu-item-active @endif" aria-haspopup="true" id="menu_hospitals">
                                    <a href="{{url("admin_hospital/1/edit")}}" class="menu-link">
                                        <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "admin_hospital") svg-icon-primary @else svg-icon-light @endif" id="menu_hospital"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Building.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000"/>
                                                <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"/>
                                                <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg></span>
										<span class="menu-text"> &emsp;Hospital Setting</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_procedure_setting"))
                                <li class="menu-item @if(Request::segment(1) == "admin/procedure") menu-item-active @endif" aria-haspopup="true" id="menu_procedures">
                                    <a href="{{url("admin/procedure")}} " class="menu-link">
                                        <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "admin/procedure") svg-icon-primary @else svg-icon-light @endif"  id="menu_procedure"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Commode2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M5.5,2 L18.5,2 C19.3284271,2 20,2.67157288 20,3.5 L20,6.5 C20,7.32842712 19.3284271,8 18.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,3.5 C4,2.67157288 4.67157288,2 5.5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L13,6 C13.5522847,6 14,5.55228475 14,5 C14,4.44771525 13.5522847,4 13,4 L11,4 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M5.5,9 L18.5,9 C19.3284271,9 20,9.67157288 20,10.5 L20,13.5 C20,14.3284271 19.3284271,15 18.5,15 L5.5,15 C4.67157288,15 4,14.3284271 4,13.5 L4,10.5 C4,9.67157288 4.67157288,9 5.5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L13,13 C13.5522847,13 14,12.5522847 14,12 C14,11.4477153 13.5522847,11 13,11 L11,11 Z M5.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,20.5 C20,21.3284271 19.3284271,22 18.5,22 L5.5,22 C4.67157288,22 4,21.3284271 4,20.5 L4,17.5 C4,16.6715729 4.67157288,16 5.5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L13,20 C13.5522847,20 14,19.5522847 14,19 C14,18.4477153 13.5522847,18 13,18 L11,18 Z" fill="#000000"/>
                                            </g>
                                        </svg></span>
										<span class="menu-text"> &emsp;Procedure Setting</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_department_setting"))
                                <li class="menu-item @if(Request::segment(1) == "department") menu-item-active @endif" aria-haspopup="true" id="departments">
                                    <a href="{{url("department")}}" class="menu-link">
                                        <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "department") svg-icon-primary @else svg-icon-light @endif" id="department"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Building.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000" />
                                                <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"/>
                                                <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000"/>
                                            </g>
                                        </svg></span>
										<span class="menu-text"> &emsp;Department Setting</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_accessory"))
                                <li class="menu-item @if(Request::segment(1) == "accessory") menu-item-active @endif" aria-haspopup="true" id="accessorys">
                                    <a href="{{url("accessory")}}" class="menu-link">
                                        <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "accessory") svg-icon-primary @else svg-icon-light @endif" id="accessory"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Building.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M12.7442084,3.27882877 L19.2473374,6.9949025 C19.7146999,7.26196679 20.003129,7.75898194 20.003129,8.29726722 L20.003129,15.7027328 C20.003129,16.2410181 19.7146999,16.7380332 19.2473374,17.0050975 L12.7442084,20.7211712 C12.2830594,20.9846849 11.7169406,20.9846849 11.2557916,20.7211712 L4.75266256,17.0050975 C4.28530007,16.7380332 3.99687097,16.2410181 3.99687097,15.7027328 L3.99687097,8.29726722 C3.99687097,7.75898194 4.28530007,7.26196679 4.75266256,6.9949025 L11.2557916,3.27882877 C11.7169406,3.01531506 12.2830594,3.01531506 12.7442084,3.27882877 Z M12,14.5 C13.3807119,14.5 14.5,13.3807119 14.5,12 C14.5,10.6192881 13.3807119,9.5 12,9.5 C10.6192881,9.5 9.5,10.6192881 9.5,12 C9.5,13.3807119 10.6192881,14.5 12,14.5 Z" fill="#000000"/>
                                            </g>
                                        </svg></span>
										<span class="menu-text"> &emsp;Accessory</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_wording"))
                                <li class="menu-item @if(Request::segment(1) == "wording") menu-item-active @endif" aria-haspopup="true" id="wordings">
                                    <a href="{{url("wording")}}" class="menu-link">
                                        <span class="svg-icon svg-icon-2x @if(Request::segment(1) == "wording") svg-icon-primary @else svg-icon-light @endif" id="wording"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Building.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M0.18,19 L7.1,4.64 L14.02,19 L12.06,19 L10.3,15.28 L3.9,15.28 L2.14,19 L0.18,19 Z M7.1,8.52 L4.7,13.6 L9.5,13.6 L7.1,8.52 Z" fill="#000000"/>
                                                <path d="M21.34,19 L21.34,18 C20.5,18.76 19.38,19.16 18.16,19.16 C15.22,19.16 13.06,16.9 13.06,14 C13.06,11.1 15.22,8.84 18.16,8.84 C19.38,8.84 20.5,9.24 21.34,10 L21.34,9 L23.06,9 L23.06,19 L21.34,19 Z M18.2,17.54 C19.64,17.54 20.76,16.86 21.34,15.92 L21.34,12.08 C20.76,11.14 19.64,10.46 18.2,10.46 C16.24,10.46 14.84,12.02 14.84,14 C14.84,15.98 16.24,17.54 18.2,17.54 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg></span>
										<span class="menu-text"> &emsp;Wording</span>
                                    </a>
                                </li>

                                @endif

							</ul>
						</div>
					</div>
				</div>
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<div id="kt_header" class="header header-fixed">
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                <div class="row" style="padding-left: 3em;">
                                    <div class="col-12 pt-3">
                                        <a href="{{url("")}}">
                                            <img alt="Logo" src="{{url('public/image/EndoINDEX.png')}}" style="height:3.2em;"/>
                                        </a>
                                    </div>
                                </div>
							</div>

							<!--เเสดงพื้นที่ hdd หมด-->
							<div class="topbar">
								<div class="dropdown" id="kt_quick_search_toggle">
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
									</div>
									<div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
										<div class="quick-search quick-search-dropdown" id="kt_quick_search_dropdown">
											<form method="get" class="quick-search-form">
												<div class="input-group">
													<div class="input-group-prepend">
														<span class="input-group-text">
															<span class="svg-icon svg-icon-lg">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg>

															</span>
														</span>
													</div>
													<div class="input-group-append">
														<span class="input-group-text">
															<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
														</span>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
								<div class="topbar-item">
                                    <button class="btn btn-outline-dark btn-sm" id="plus_font" style="border:none;"><i class="far fas fa-plus-circle" style="padding: 0;"></i></button>
                                    @php
                                        $all_size = 0;
                                    @endphp

                                    @if(false)
                                        @php
                                            $json = json_decode(uget("user_config"));
                                            if(isset($json->font)){
                                                if ($json->font==8) {
                                                    $all_size = 'MAX';
                                                }elseif ($json->font==-8) {
                                                    $all_size = 'MIN';
                                                }else{
                                                    $all_size=$json->font;
                                                }
                                            }

                                        @endphp
                                    @endif
                                    <a href="#" class="btn btn-icon btn-light-warning pulse pulse-warning btn-sm">
                                        <font id="all_size">{{$all_size}}</font>
                                        <span class="pulse-ring"></span>
                                    </a>
                                    <button class="btn btn-outline-dark btn-sm" id="minus_font" style="border:none;"><i class="far fas fa-minus-circle" style="padding: 0;"></i></button>
                                </div>
								<div class="topbar-item">
									<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
										<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"> {{uget("name")}}</span>
										<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
											<span class="symbol-label font-size-h5 font-weight-bold">{{substr(uget("name"),0,1)}}</span>
										</span>
									</div>
                                </div>
                                <div class="topbar-item">
                                    <a  class="dropdown-item notify-item" href="{{ route('logout') }}" onclick="   event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Sign-in.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <rect fill="#000000" opacity="0.3" transform="translate(9.000000, 12.000000) rotate(-270.000000) translate(-9.000000, -12.000000) " x="8" y="6" width="2" height="12" rx="1"/>
                                                <path d="M20,7.00607258 C19.4477153,7.00607258 19,6.55855153 19,6.00650634 C19,5.45446114 19.4477153,5.00694009 20,5.00694009 L21,5.00694009 C23.209139,5.00694009 25,6.7970243 25,9.00520507 L25,15.001735 C25,17.2099158 23.209139,19 21,19 L9,19 C6.790861,19 5,17.2099158 5,15.001735 L5,8.99826498 C5,6.7900842 6.790861,5 9,5 L10.0000048,5 C10.5522896,5 11.0000048,5.44752105 11.0000048,5.99956624 C11.0000048,6.55161144 10.5522896,6.99913249 10.0000048,6.99913249 L9,6.99913249 C7.8954305,6.99913249 7,7.89417459 7,8.99826498 L7,15.001735 C7,16.1058254 7.8954305,17.0008675 9,17.0008675 L21,17.0008675 C22.1045695,17.0008675 23,16.1058254 23,15.001735 L23,9.00520507 C23,7.90111468 22.1045695,7.00607258 21,7.00607258 L20,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.000000, 12.000000) rotate(-90.000000) translate(-15.000000, -12.000000) "/>
                                                <path d="M16.7928932,9.79289322 C17.1834175,9.40236893 17.8165825,9.40236893 18.2071068,9.79289322 C18.5976311,10.1834175 18.5976311,10.8165825 18.2071068,11.2071068 L15.2071068,14.2071068 C14.8165825,14.5976311 14.1834175,14.5976311 13.7928932,14.2071068 L10.7928932,11.2071068 C10.4023689,10.8165825 10.4023689,10.1834175 10.7928932,9.79289322 C11.1834175,9.40236893 11.8165825,9.40236893 12.2071068,9.79289322 L14.5,12.0857864 L16.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.500000, 12.000000) rotate(-90.000000) translate(-14.500000, -12.000000) "/>
                                            </g>
                                        </svg>
                                         </span>
								    	{{ __('Logout') }}
								    </a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
							</div>
						</div>
					</div>

					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @yield('content')
					</div>
				</div>
			</div>
		</div>



        @yield('script')

        @if(false)
            @php
                $json = json_decode(uget("user_config"));
            @endphp
            @if(isset($json->font))
                <script>
                function set_size(type){
                    $(type).each(function( index ) {
                        var this_size = parseInt($( this ).css("font-size"));
                        this_size = this_size + {{$json->font}} + "px";
						if(type=='.row'){
							console.log(this_size);
						}
                        $(this).css({'font-size':this_size});
                    });
                }
                set_size('th');
                set_size('td');
                set_size('input[type=text]');
                set_size('input[type=number]');
				set_size('input[type=date]');
                set_size('select');
                set_size('label');
                set_size('h1');
                set_size('h2');
                set_size('h3');
                set_size('h4');
                set_size('h5');
                set_size('h6');
                set_size('b');
                set_size('font');
                set_size('textarea');
                </script>
            @endif
        @endif
        <script>

            $("#plus_font").click(function(){
                var x_size = $("#all_size").text();
                if(x_size=='MAX'){
                    a_size = 8;
                }else if(x_size=='MIN'){
                    a_size = -8;
                }else{
                    a_size = x_size;
                }
                var all_size = parseInt(a_size);
                if(all_size <= 6){
                    var size = all_size+2;
                    if(size == 6){
                        size = 'MAX';
                    }
                    $("#all_size").text(size);
                    function plus_set_size(type){
                        $(type).each(function( index ) {
                            var this_size = parseInt($( this ).css("font-size"));
                            this_size = this_size + 2 + "px";
                            $(this).css({'font-size':this_size});
                        });
                    }
                    plus_set_size('th');
                    plus_set_size('td');
                    plus_set_size('input[type=text]');
                    plus_set_size('input[type=number]');
					plus_set_size('input[type=date]');
                    plus_set_size('select');
                    plus_set_size('label');
                    plus_set_size('h1');
                    plus_set_size('h2');
                    plus_set_size('h3');
                    plus_set_size('h4');
                    plus_set_size('h5');
                    plus_set_size('h6');
                    plus_set_size('b');
                    plus_set_size('font');
                    plus_set_size('textarea');

                    $.post('{{url('jquery')}}',{
                        event   : 'plus_font',
                        uid     : '{{@uid()}}'
                    },function(data,status){
                        console.log(data);
                    });
                }
            });
            $("#minus_font").click(function(){
                var x_size = $("#all_size").text();
                if(x_size=='MAX'){
                    a_size = 8;
                }else if(x_size=='MIN'){
                    a_size = -8;
                }else{
                    a_size = x_size;
                }
                var all_size = parseInt(a_size);
                if(all_size >= -6){
                    var size = all_size-2;
                    if(size == -6){
                        size = 'MIN';
                    }
                    $("#all_size").text(size);
                    function minus_set_size(type){
                        $(type).each(function( index ) {
                            var this_size = parseInt($( this ).css("font-size"));
                            this_size = this_size + - 2 + "px";
                            $(this).css({'font-size':this_size});
                        });
                    }
                    minus_set_size('th');
                    minus_set_size('td');
                    minus_set_size('input[type=text]');
                    minus_set_size('input[type=number]');
					minus_set_size('input[type=date]');
                    minus_set_size('select');
                    minus_set_size('label');
                    minus_set_size('h1');
                    minus_set_size('h2');
                    minus_set_size('h3');
                    minus_set_size('h4');
                    minus_set_size('h5');
                    minus_set_size('h6');
                    minus_set_size('b');
                    minus_set_size('font');
                    minus_set_size('textarea');
                    $.post('{{url('jquery')}}',{
                        event   : 'minus_font',
                        uid     : '{{uid()}}'
                    },function(data,status){
                        console.log(data);
                    });
                }
            });
        </script>
        <script>
            function new_color(id_menu,id_icon){
                $(id_menu).mouseenter(function () {
                $(id_icon).removeClass('svg-icon-light').addClass('svg-icon-primary');
                });

                $(id_menu).mouseleave(function () {
                    $(id_icon).addClass('svg-icon-light').removeClass('svg-icon-primary');
                    }
                ).mouseleave();
            }
            @if(Request::segment(1) != "home") new_color('#menu_homes','#menu_home'); @endif
            @if(Request::segment(1) != "patient") new_color('#menu_paients','#menu_paient'); @endif
            @if(Request::segment(1) != "searchdetail") new_color('#menu_searchs','#menu_search'); @endif
            @if(Request::segment(1) != "analytic") new_color('#menu_charts','#menu_chart'); @endif
            @if(Request::segment(1) != "expdf") new_color('#menu_pdfs','#menu_pdf'); @endif
            @if(Request::segment(1) != "exportindex") new_color('#menu_exports','#menu_export'); @endif
            @if(Request::segment(1) != "queue_index") new_color('#menu_quests','#menu_quest'); @endif
            @if(Request::segment(1) != "user") new_color('#menu_users','#menu_user'); @endif
            @if(Request::segment(1) != "admin/procedure") new_color('#menu_procedures','#menu_procedure'); @endif
            @if(Request::segment(1) != "admin/room") new_color('#menu_rooms','#menu_room'); @endif
            @if(Request::segment(1) != "admin/scope") new_color('#menu_scopes','#menu_scope'); @endif
            @if(Request::segment(1) != "wording") new_color('#wordings','#wording'); @endif
            @if(Request::segment(1) != "department") new_color('#departments','#department'); @endif
            @if(Request::segment(1) != "accessory") new_color('#accessorys','#accessory'); @endif

            @if(Request::segment(1) != "department") new_color('#menu_hospitals','#menu_hospital'); @endif

            @if(Request::segment(1) != "admin_hospital") new_color('#menu_hospitals','#menu_hospital'); @endif
            @if(Request::segment(1) != "pacs") new_color('#menu_pacs','#menu_pac'); @endif
            @if(Request::segment(1) != "vdo_library") new_color('#menu_vdos','#menu_vdo'); @endif
        </script>

<script>
{!!viewmode()!!}
</script>



	</body>
</html>
