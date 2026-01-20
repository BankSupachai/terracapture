<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
    <head><base href="">

		<meta charset="utf-8" />
		<title>@yield('title')</title>
		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
		<link href="{{url('public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('public/sample/assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css"  id="set_blade"/>
		<link href="{{url('public/sample/assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" id="set_menu" />
		<link href="{{url('public/sample/assets/css/themes/layout/brand/light.css')}}" rel="stylesheet" type="text/css" id="set_brand" />
        <link href="{{url('public/sample/assets/css/themes/layout/aside/light.css')}}" rel="stylesheet" type="text/css" id="set_aside" />
        <link href="{{url('public/css/capture/layout.css')}}" rel="stylesheet" type="text/css" />

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
        <script src="{{url('public/sample/assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{url('public/sample/assets/js/scripts.bundle.js')}}"></script>
        <script src="{{url("public/recorder/assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
        <script src="{{url('public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/features/calendar/external-events.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/widgets.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/form-repeater.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/autosize.js')}}"></script>
        <link href="{{url("public/assets5/css/icons.min.css")}}" rel="stylesheet" type="text/css" />

        @php
            $hidden = configTYPE("admin","hidden_select_user")
        @endphp
            @if($hidden)
            <style>
                .inner.show,.select2-results{
                    display: none;
                }
            </style>
            @endif
        <style>
        @font-face{
            font-family: 'kanit';
            font-style: normal;
            font-weight: normal;
            src: url("{{url('public/fonts/Kanit-Regular.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{url('public/fonts/Kanit-Bold.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'kanit';
            font-style: italic;
            font-weight: normal;
            src: url("{{url('public/fonts/Kanit-Italic.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'kanit';
            font-style: italic;
            font-weight: bold;
            src: url("{{url('public/fonts/Kanit-ExtraBoldItalic.ttf')}}") format("truetype");
        }
        *{
            font-family: 'kanit';
        }
        :root {
            --index-main: #245788;
            --index-text: #325684;
        }
        .card-main{
            background: var(--index-main);
        }
        #kt_aside_menu_wrapper, #kt_aside_menu{
            background: var(--index-main) !important;
        }
        .text-index{
            color: var(--index-text)
        }
        .text-gray{
            color: #9599AD;
        }
        .form-text-none .form-control{
            border: none !important;
            background: #F3F6F9
        }
        :root {
            --index-main: #245788;
            --index-text: #325684;
        }
        .aside-minimize .aside-menu .menu-nav > .menu-item.menu-item-here, .aside-minimize .aside-menu .menu-nav > .menu-item.active {
            background: var(--index-main) !important;
        }
        .aside-menu .menu-nav > .menu-item > .menu-link{
            background: var(--index-main) !important;
        }
        .aside-menu .menu-nav > .menu-item > .menu-link .menu-text
        ,.aside-menu .menu-nav > .menu-item > .menu-link i
        ,.menu-section .menu-text{
            color: #ffffff !important;
        }
        .aside-menu .menu-nav > .menu-item:hover > .menu-link .menu-text
        ,.aside-menu .menu-nav > .menu-item:hover > .menu-link i
        ,.aside-menu .menu-nav > .menu-item.active > .menu-link i
        ,.aside-menu .menu-nav > .menu-item.active > .menu-link .menu-text{
            color: white !important;
        }
        .aside-menu .menu-nav > .menu-section #logo_left_min
        ,.aside-minimize .aside-menu .menu-nav > .menu-section #logo_left_max{
            display: none;
        }
        .jcc{
            justify-content: center !important;
        }
        .aside-menu .menu-nav > .menu-section #logo_left_max
        ,.aside-minimize .aside-menu .menu-nav > .menu-section #logo_left_min{
            display: block;
        }
        input .check-color :checked{
            color: red !important;
            background: red !important;
        }

        </style>

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
        @php
            try {
                $ds             = ((disk_total_space("D:/")/1024)/1024)/1024;
                $ds             = intval($ds);
                $drive          = ((disk_free_space("D:/")/1024)/1024)/1024;
            } catch (\Throwable $th) {
                $ds             = ((disk_total_space("C:/")/1024)/1024)/1024;
                $ds             = intval($ds);
                $drive          = ((disk_free_space("C:/")/1024)/1024)/1024;
            }
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

        @yield('style')
	</head>

    @php
        if(getCONFIG('admin')->menu_left_big_small){
            $menuleft = "";
        }else{
            $menuleft = "aside-minimize";
        }
        if(getCONFIG('admin')->menu_left_auto){
            $aside = "aside-minimize-hoverable";
        }else{
            $aside = "";
        }
    @endphp
    <body id="kt_body" class="header-fixed header-mobile-fixed {{$menuleft}} subheader-enabled subheader-fixed aside-enabled aside-fixed  {{$aside}} body_light body_light" id="body_set">
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
				<img alt="Logo" src="{{url("public/image/EndoINDEX_white - Copy.png")}}" style="max-width: 115px;"/>
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

					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper" style="">
						<div id="kt_aside_menu" class="aside-menu" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
							<ul class="menu-nav">
                                <li class="menu-section mt-0 jcc">
                                    <a href="{{url("")}}">
                                        <img alt="Logo" src="{{url("public/image/EndoINDEX_white - Copy.png")}}" height="22" class="mt-2" id="logo_left_min"/>
                                        <img alt="Logo" src="{{url("public/image/EndoINDEX white logo.png")}}" height="50" id="logo_left_max"/>
                                    </a>
								</li>
                                <li class="menu-section">
									<h4 class="menu-text">OPERATION MENU</h4>
									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
								</li>
                                <li class="menu-item @if(Request::segment(1) == "book" && Request::segment(2) !="followup") menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{url("book")}}" class="menu-link">
                                        <i class="ri-calendar-check-fill icon-lg"></i>
                                        <span class="menu-text"> &emsp;Booking List</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(1) == "endo"||Request::segment(2) == "note") active @endif" aria-haspopup="true">
                                    <a href="{{url("")}}" class="menu-link">
                                        <i class="ri-list-check icon-lg"></i>
                                        <span class="menu-text"> &emsp;Cases List</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(2) == "followup") menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{url("book/followup")}}" class="menu-link">
                                        <i class="ri-task-line icon-lg"></i>
                                        <span class="menu-text"> &emsp;Follow Up</span>
                                    </a>
                                </li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="{{url("terra/w-viewer")}}" class="menu-link">
                                        <i class="ri-folder-history-line icon-lg"></i>
                                        <span class="menu-text"> &emsp;Viewer History</span>
                                    </a>
                                </li>
                                <li class="menu-section">
									<h4 class="menu-text">MANAGEMENT MENU</h4>
									<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
								</li>
                                <li class="menu-item" aria-haspopup="true">
                                    <a href="javascript:;" class="menu-link">
                                        <i class="ri-dashboard-line icon-lg"></i>
                                        <span class="menu-text"> &emsp;Overall</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(2) == "control") menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{url("casemonitor/control")}}" class="menu-link">
                                        <i class="ri-computer-line icon-lg"></i>
                                        <span class="menu-text"> &emsp;Case Control</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(1) == "display") menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{url("casemonitor")}}" class="menu-link">
                                        <i class="ri-honour-line icon-lg"></i>
                                        <span class="menu-text"> &emsp;Case Monitor</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(2) == "analytic") menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{url("analytic")}}" class="menu-link">
                                        <i class="ri-bar-chart-box-line icon-lg"></i>
                                        <span class="menu-text"> &emsp;Data Analyze</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(2) == "exportindex") menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{url("exportindex")}}" class="menu-link">
                                        <i class="ri-external-link-fill icon-lg"></i>
                                        <span class="menu-text"> &emsp;Export</span>
                                    </a>
                                </li>
							</ul>
						</div>
					</div>
				</div>
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<div id="kt_header" class="header header-fixed">
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                <div class="brand flex-column-auto" id="kt_brand">
                                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle" @if(@$set_page->menu_left_big_small=='true') sub_data="1" @else sub_data="2" @endif>
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
							</div>

							<!--เเสดงพื้นที่ hdd เริ่ม-->

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
                                    <i class="ri-cloud-fill fs-22 icon-xl text-success mr-5"></i>
                                </div>
                                <div class="topbar-item">
                                    <i class="ri-font-size-2 icon-xl text-dark mr-5"></i>
                                </div>
                                <div class="topbar-item">
                                    <i class="bx bx-fullscreen icon-xl text-dark mr-5"></i>
                                </div>
                                <div class="topbar-item">
                                    <i class="bx bx-moon icon-xl text-dark mr-5"></i>
                                </div>

								<div class="topbar-item">
									<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
										<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                                                {{uget("user_prefix")}} {{uget("user_firstname")}} {{uget("user_lastname")}}
                                        </span>
										<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
											<span class="symbol-label font-size-h5 font-weight-bold">
                                                    {{substr(uget("email"),0,1)}}
                                            </span>
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
                                        </svg></span>
								    	{{ __('Logout') }}
								    </a>
                                    <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{@uid()}}">
                                    </form>
                                </div>
							</div>
						</div>
					</div>
                    @if (Request::segment(1) != "photomove" && Request::segment(1) != "track" && Request::segment(1) != "esign")
                        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
                            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                                <div class="d-flex align-items-center flex-wrap mr-1">
                                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                                        {{-- <span class="h4">BOOKING CREATE</span> --}}
                                        @yield('title-left')
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    {{-- <span class="h5">Booking list</span> --}}
                                    @yield('title-right-1')
                                    &nbsp;  <i class="bx bx-chevron-right"></i> &nbsp;
                                    {{-- <span class="text-muted h5">Create</span> --}}
                                    @yield('title-right-2')
                                </div>
                            </div>
                        </div>
                    @endif
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @yield('content')
					</div>
				</div>
			</div>
		</div>

        {{-- <button type="button" onclick="call_right()" style="display">Call</button> --}}
        @yield('script')


        {{-- เมนู track ขวามือ --}}
        @include('components.right_track')


		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		{{-- <script src="assets/plugins/global/plugins.bundle.js"></script> --}}
		{{-- <script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script> --}}
		{{-- <script src="assets/js/scripts.bundle.js"></script> --}}
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		{{-- <script src="assets/js/pages/crud/forms/widgets/select2.js"></script> --}}
        {{-- <script src="{{url('public/sample/assets/js/scripts.bundle.js')}}"></script>
        <script src="{{url('public/sample/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
        <script src="{{url('public/sample/assets/plugins/global/plugins.bundle.js')}}"></script> --}}





	</body>
</html>
