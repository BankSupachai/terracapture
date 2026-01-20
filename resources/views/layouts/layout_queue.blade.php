<!DOCTYPE html>
<html lang="en">
    <head><base href="">
        <meta http-equiv="Access-Control-Allow-Origin" content="*">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta charset="utf-8" />
		<title>EndoQUEUE</title>

		<meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
        <link href="{{asset('public/image/favicon_queue.png')}}"                                rel="shortcut icon">
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
        <style>
            *{
                margin: 0;
                padding: 0;
                font-size: 18px;
                font-family: 'kanit'
            }
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

            @media (min-width: 992px){
                .header-fixed.subheader-fixed.subheader-enabled .wrapper {
                    padding-top: 65px;
                    font-family: 'Kanit', sans-serif;
                }
            }
            .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link {
                background-color: #54b4a4;
            }
            .svg-icon-light:hover{
                background-color: #42ac9a;
            }
            .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item > .menu-link .menu-text {
                color: #ffffff;
            }
            .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-heading .menu-text, .aside-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-text {
                color: #fff;
            }
            .aside-menu .menu-nav > .menu-item > .menu-heading .menu-text:hover, .aside-menu .menu-nav > .menu-item > .menu-link .menu-text:hover{
                color: #197d6d !important;
            }
            @media (min-width: 992px){
                .aside-enabled .header.header-fixed {
                    left: 0;
                }
            }
            #kt_brand{
                background: none;
            }
            @media (min-width: 992px){
                .aside-fixed .aside {
                    background: none;
                }
            }

            .ipad-none{
                display: block;
            }
            .ipad-show{
                display: none;
            }
            .aside{
                transition: width 0.4s;
            }
            @media (max-width: 1140px) {
                .ipad-none{
                    display: none;
                }
                .ipad-show{
                    display: block;
                }
                .header-fixed.aside-minimize-hover .header, .header-fixed.aside-minimize .header {
                    left: 0;
                }
                .aside-fixed.aside-minimize .wrapper {
                    padding-left: 0px;
                }
                .aside-minimize .aside {
                    width: 0px;
                }
                .aside-fixed .wrapper {
                    padding-left: 0;
                }
                .symbol .symbol-label {
                    width: auto;
                }
                .bg-green-header h2,.bg-green-header-s h1{
                    font-size: large !important;
                }
            }
            .load-menu{
                position: fixed;
                z-index: 99999;
                width: 100%;
                height: 100vh;
                background: #197d6e62;
                animation: mymove 5s forwards;
                animation-delay: 1.5s;
                text-align-last: center;
            }
            .load-menu img{
                max-width: 30%;
                max-height: 30%;
                width: auto;
                height: auto;
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }
            @keyframes mymove {
                from {top: 0vh;opacity: 1;border-radius: 0%;}
                to {top: 100vh;opacity: 0;border-radius: 100%;}
            }
            @media (max-width: 1140px) {
                .ipad-none{
                    display: none;
                }
                .ipad-show{
                    display: block;
                }
                .header-fixed.aside-minimize-hover .header, .header-fixed.aside-minimize .header {
                    left: 0;
                }
                .aside-fixed.aside-minimize .wrapper {
                    padding-left: 0px;
                }
                .aside-minimize .aside {
                    width: 0px;
                }
                .aside-fixed .wrapper {
                    padding-left: 0;
                }
            }
            .menu-ipad{
                display: none !important;
            }
            .menu-pc{
                display: flex !important;
            }
            #logo_pc{
                display: block;
            }
            #logo_ipad{
                display: none;
            }
            @media (min-width: 1181px) {
            }
            @media (max-width: 1181px) {
                .menu-pc{
                    display: none !important;
                }
                .menu-ipad{
                    display: flex !important;
                }
                #kt_header{
                    background: rgb(25, 125, 109);
                }
                .topbar{
                    display: none;
                }
                #logo_pc{
                    display: none;
                }
                #logo_ipad{
                    display: block;
                }
                #btncallfirst,.card-header.bg-green-header h1,.card-header.bg-green-header-s h1,.card-header.bg-green-header h2,.card-header.bg-green-header-s h2{
                    font-size: large !important;
                }
                #btncallfirst i{
                    font-size: 2em !important;
                }
                .col-lg-4 b{
                    font-size: smaller !important;
                }
                .col-lg input{
                    font-size: xx-small !important;
                }
                .col-lg-9 .row{
                    padding-top: 5px;
                }
                .add_queue h2{
                    font-size: medium !important;
                    margin: 0;
                }
                .aside-minimize .aside {
                    width: 0px;
                }
                .aside-fixed.aside-minimize .wrapper {
                    padding-left: 0px;
                }
                .aside-fixed .wrapper {
                    padding-left: 0px;
                }
            }
            .menu-link i{
                color: #ffffff;
                margin-top: 4px;
                margin-left: 3px;
            }
            .menu-link i.fa-home{
                margin-left: 0;
            }
            .menu-item:hover .menu-link i{
                color:rgb(25, 125, 109);
            }
            .menu-item:hover .menu-link i.fa-database{
                color: #ffffff;
            }
            .menu-item-active:hover .menu-link i{
                color:#fff;
            }
            .menu-item-active i{
                color:#fff;
            }
        </style>
        @yield('style')
	</head>
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed body_light aside-minimize body_light" id="body_set">
        @yield('modal')
        {{-- <div class="load-menu"><img src="{{url('public/crop_logo/White/EndoQUEUE_white.png')}}"></div> --}}
		<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
			{{-- <a href="{{url("")}}">
                <img alt="Logo" src="{{url("")}}/public/image/logo_queue.png" style="max-width: 115px;"/>
			</a> --}}
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
						{{-- <a href="{{url("")}}" class="brand-logo">
							<img alt="Logo" src="{{url("")}}/public/image/logo_queue.png" style="max-width: 180px;"/>
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
					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper" style="background: #197d6d;">
						<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500" style="background: #197d6d;">
							<ul class="menu-nav">
                                <li class="menu-item menu-ipad @if(Request::segment(1) == "queue") menu-item-active @endif" aria-haspopup="queue">
                                    <a href="{{url('ipad_index')}}" class="menu-link">
                                        <span class="svg-icon svg-icon-2x svg-icon-light"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Home.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M3.95709826,8.41510662 L11.47855,3.81866389 C11.7986624,3.62303967 12.2013376,3.62303967 12.52145,3.81866389 L20.0429,8.41510557 C20.6374094,8.77841684 21,9.42493654 21,10.1216692 L21,19.0000642 C21,20.1046337 20.1045695,21.0000642 19,21.0000642 L4.99998155,21.0000673 C3.89541205,21.0000673 2.99998155,20.1046368 2.99998155,19.0000673 L2.99999828,10.1216672 C2.99999935,9.42493561 3.36258984,8.77841732 3.95709826,8.41510662 Z M10,13 C9.44771525,13 9,13.4477153 9,14 L9,17 C9,17.5522847 9.44771525,18 10,18 L14,18 C14.5522847,18 15,17.5522847 15,17 L15,14 C15,13.4477153 14.5522847,13 14,13 L10,13 Z" fill="#000000"/>
                                            </g>
                                        </svg><!--end::Svg Icon--></span>
										<span class="menu-text"> &emsp;Home</span>
                                    </a>
                                </li>
                                <li class="menu-item menu-pc @if(Request::segment(1) == "queue") menu-item-active @endif" aria-haspopup="queue">
                                    <a href="{{url('queue')}}" class="menu-link">
                                        <i class="fas fa-home icon-lg"></i>
										<span class="menu-text"> &emsp;Home</span>
                                    </a>
                                </li>
                                <li class="menu-item menu-pc @if(Request::segment(1) == "queuedisplay") menu-item-active @endif" aria-haspopup="true">
                                    <a href="{{url('queuedisplay')}}" class="menu-link">
                                        <i class="fas fa-tv icon-lg"></i>
										<span class="menu-text"> &emsp;Monitor</span>
                                    </a>
                                </li>

                                <li class="menu-item" aria-haspopup="true" id="menu_charts">
                                    <a href="{{ route('logout') }}" onclick="   event.preventDefault(); document.getElementById('logout-form').submit();" class="menu-link">
                                        <i class="fas fa-sign-in-alt icon-lg"></i>
										<span class="menu-text"> &emsp;Logout</span>
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
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<div id="kt_header" class="header header-fixed">
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                                <div class="row" style="padding-left: 3em;">
                                    <div class="col-12 pt-3" id="logo_pc">
                                        <a href="{{url('queue')}}">
                                            <img alt="Logo" src="{{url('public/image/logo_queue.png')}}" style="height:3.2em;"/>
                                        </a>
                                    </div>
                                    <div class="col-12 pt-4" id="logo_ipad">
                                        <a href="{{url('queue')}}">
                                            <img alt="Logo" src="{{url('public/image/EndoQUEUE_white.png')}}" style="height:2.23em;"/>
                                        </a>
                                    </div>
                                </div>
                            </div>
							<div class="topbar">
								<div class="dropdown" id="kt_quick_search_toggle">
									<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
										<div class="btn btn-icon btn-clean btn-lg btn-dropdown mr-1">
											<span class="svg-icon svg-icon-xl svg-icon-primary">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
													</g>
												</svg>
											</span>
										</div>
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
													<input type="text" class="form-control" placeholder="Search..." />
													<div class="input-group-append">
														<span class="input-group-text">
															<i class="quick-search-close ki ki-close icon-sm text-muted"></i>
														</span>
													</div>
												</div>
											</form>
											<div class="quick-search-wrapper scroll" data-scroll="true" data-height="325" data-mobile-height="200"></div>
										</div>
									</div>
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
                                        </svg><!--end::Svg Icon--></span>
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

		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>






		<script src="{{url("public/sample/assets/plugins/global/plugins.bundle.js")}}"></script>
		<script src="{{url("public/sample/assets/plugins/custom/prismjs/prismjs.bundle.js")}}"></script>
		<script src="{{url("public/sample/assets/js/scripts.bundle.js")}}"></script>
		<script src="{{url("public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/features/calendar/external-events.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/widgets.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/form-repeater.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/select2.js")}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/autosize.js")}}"></script>
        <script src="{{url("public/js/jquery-ui.js")}}"></script>

        @yield('script')

        <script>
            {!!viewmode()!!}
        </script>
	</body>
</html>
