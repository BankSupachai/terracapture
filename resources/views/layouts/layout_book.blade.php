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
        <script src="{{url('public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/features/calendar/external-events.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/widgets.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/form-repeater.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
        <script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/autosize.js')}}"></script>

        <style>
            .menu-link i{
                color: #ffffff;
                margin-top: 4px;
                margin-left: 3px;
            }
            .menu-link i.fa-home{
                margin-left: 0;
            }

            .menu-item:hover .menu-link i{
                color:rgb(0, 113, 187);
            }
            .menu-item:hover .menu-link i.fa-database{
                color: #ffffff;
            }
            .menu-item-active i{
                color:rgb(0, 113, 187);
            }
            .bg-endo{
                background: #0071bb;
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

        <style>
            #kt_aside_menu_wrapper,#kt_aside_menu{
                background: #0071bb;
            }
        </style>
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
				<img alt="Logo" src="{{url('public/image/logo_capture.png')}}" style="max-width: 115px;"/>
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
							<img alt="Logo" src="{{url("")}}/public/image/logo_capture.png" style="max-width: 180px;"/>
						</a> --}}

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
					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper" style="">
						<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
							<ul class="menu-nav">
                                @php
                                    $id_type = 'admin';
                                    if(@uget("user_type")!="admin"){
                                        $id_type = 'endocapture';
                                    }
                                @endphp

                                @if(configTYPE('menu',"$id_type"."_home"))
                                    <li class="menu-item @if(Request::segment(1) == "home") menu-item-active @endif" aria-haspopup="true" id="menu_homes">
                                        <a href="{{url("")}}" class="menu-link">
                                            <i class="fas fa-home icon-lg"></i>
                                            <span class="menu-text"> &emsp;Home</span>
                                        </a>
                                    </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_patient"))
                                    <li class="menu-item @if(Request::segment(1) == "patient") menu-item-active @endif" aria-haspopup="true" id="menu_paients">
                                        <a href="{{url("patient")}}" class="menu-link">
                                            <i class="far fa-user icon-lg"></i>
                                            <span class="menu-text"> &emsp;Patient</span>
                                        </a>
                                    </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_search"))
                                    <li class="menu-item @if(Request::segment(1) == "searchdetail") menu-item-active @endif" aria-haspopup="true" id="menu_searchs">
                                        <a href="{{url("searchdetail")}}" class="menu-link">
                                            <i class="fas fa-search icon-lg"></i>
                                            <span class="menu-text"> &emsp;Search</span>
                                        </a>
                                    </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_pdf"))
                                    <li class="menu-item @if(Request::segment(1) == "expdf") menu-item-active @endif" aria-haspopup="true" id="menu_pdfs">
                                        <a href="{{url("expdf")}}" class="menu-link">
                                            <i class="fas fa-receipt icon-lg"></i>
                                            <span class="menu-text"> &emsp;PDF</span>
                                        </a>
                                    </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_analytic"))
                                <li class="menu-item @if(Request::segment(1) == "analytic") menu-item-active @endif" aria-haspopup="true" id="menu_charts">
                                    <a href="{{url("analytic")}}" class="menu-link">
                                        <i class="fas fa-chart-pie icon-lg"></i>
										<span class="menu-text"> &emsp;Analytic</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_export_data"))
                                <li class="menu-item @if(Request::segment(1) == "exportindex") menu-item-active @endif" aria-haspopup="true" id="menu_exports">
                                    <a href="{{url("exportindex")}}" class="menu-link">
                                        <i class="far fa-share-square icon-lg"></i>
										<span class="menu-text"> &emsp;Export Data</span>
                                    </a>
                                </li>
                                @endif
                                @if (getCONFIG('feature')->system_nurse_monitor)
                                <li class="menu-item @if(Request::segment(1) == "casemonitor") menu-item-active @endif" aria-haspopup="true" id="menu_exports">
                                    <a href="{{url("casemonitor/control")}}" class="menu-link">
                                        <i class="fas fa-chalkboard-teacher icon-lg"></i>
										<span class="menu-text"> &emsp;Nurse Monitor</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_live"))
								<li class="menu-item @if(Request::segment(1) == "live") menu-item-active @endif" aria-haspopup="true" id="menu_lives">
                                    <a href="{{url("live")}}" class="menu-link">
                                        <i class="fas fa-video icon-lg"></i>
										<span class="menu-text"> &emsp;Live</span>
                                    </a>
                                </li>
                                @endif
                                @if(configTYPE('menu',"$id_type"."_billing"))
								<li class="menu-item @if(Request::segment(1) == "billhomc") menu-item-active @endif" aria-haspopup="true" id="menu_bills">
                                    <a href="{{url("billhomc")}}" class="menu-link">
                                        <i class="far fa-list-alt icon-lg"></i>
										<span class="menu-text"> &emsp;Billing</span>
                                    </a>
                                </li>
                                @endif

                                @if(configTYPE('menu',"$id_type"."_emr"))
                                <li class="menu-item @if(Request::segment(1) == "emr") menu-item-active @endif" aria-haspopup="true" id="menu_emrs">
                                    <a href="{{url('emr')}}" class="menu-link">
                                        <i class="fab fa-think-peaks icon-lg"></i>
										<span class="menu-text"> &emsp;emr</span>
                                    </a>
                                </li>
                                @endif

                            @if(@uget("user_type")=="admin")
                                <li class="menu-item @if(Request::segment(1) == "admin_hospital") menu-item-active @endif" aria-haspopup="true" id="menu_hospitals">
                                    <a href="{{url("admin_hospital/1/edit")}}" class="menu-link">
                                        <i class="far fa-hospital icon-lg"></i>
										<span class="menu-text"> &emsp;Hospital Setting</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(1) == "admin/procedure") menu-item-active @endif" aria-haspopup="true" id="menu_procedures">
                                    <a href="{{url("admin/procedure")}} " class="menu-link">
                                        <i class="fas fa-cogs icon-lg"></i>
										<span class="menu-text"> &emsp;Procedure Setting</span>
                                    </a>
                                </li>

                                <li class="menu-item @if(Request::segment(1) == "department") menu-item-active @endif" aria-haspopup="true" id="department">
                                    <a href="{{url("department")}}" class="menu-link">
                                        <i class="fas fa-hospital-user icon-lg"></i>
										<span class="menu-text"> &emsp;Department Setting</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(1) == "accessory") menu-item-active @endif" aria-haspopup="true" id="accessory">
                                    <a href="{{url("accessory")}}" class="menu-link">
                                        <i class="fas fa-box-open icon-lg"></i>
										<span class="menu-text"> &emsp;Accessory</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(1) == "logdata") menu-item-active @endif" aria-haspopup="true" id="logdata">
                                    <a href="{{url("logdata")}}" class="menu-link">
                                        <i class="fas fa-business-time icon-lg"></i>
										<span class="menu-text"> &emsp;Log Data</span>
                                    </a>
                                </li>
                                <li class="menu-item @if(Request::segment(1) == "logedit") menu-item-active @endif" aria-haspopup="true" id="logedit">
                                    <a href="{{url("logedit")}}" class="menu-link">
                                        <i class="fab fa-elementor icon-lg"></i>
										<span class="menu-text"> &emsp;Log Case</span>
                                    </a>
                                </li>
                                @endif


                                <li class="menu-item svg-icon-light border-top-f " aria-haspopup="" disabled>
                                    <a href="#" class="menu-link">
                                        <i class="fas fa-database icon-lg"></i>
										<span class="menu-text">
                                            <div class="row m-0">
                                                <div class="col-12 text-light">
                                                    Storage
                                                </div>
                                                <div class="col-12">
                                                    <div class="progress" style="width: 100%;font-size: 1rem;">
                                                        <div class="progress-bar {{$drive_color}}" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: {{$persen}}%"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 text-light">
                                                    <font>{{$drive}} GB  /  {{$ds}} GB &emsp;({{$persen}}%)</font>
                                                </div>
                                            </div>
                                        </span>
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
                                <div class="row" style="padding-left: 3em;">
                                    <div class="col-12 pt-3">
                                        <a href="{{url("")}}">
                                            <img alt="Logo" src="{{url('public/image/logo_capture.png')}}" style="height:3.2em;"/>
                                        </a>
                                    </div>
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


					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        @yield('content')
					</div>
				</div>
			</div>
		</div>

        {{-- <button type="button" onclick="call_right()" style="display">Call</button> --}}
        @yield('script')

        <x-right_track></x-right_track> {{-- เมนู track ขวามือ --}}


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
                        uid     : '{{@uid()}}'
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
            @if(Request::segment(1) != "department") new_color('#menu_hospitals','#menu_hospital'); @endif
            @if(Request::segment(1) != "admin_hospital") new_color('#menu_hospitals','#menu_hospital'); @endif
            @if(Request::segment(1) != "pacs") new_color('#menu_pacs','#menu_pac'); @endif
            @if(Request::segment(1) != "vdo_library") new_color('#menu_vdos','#menu_vdo'); @endif
            @if(Request::segment(1) != "emr") new_color('#menu_emrs','#menu_emr'); @endif
            @if(Request::segment(1) != "billhomc") new_color('#menu_bills','#menu_bill'); @endif
        </script>

<script>
{!!viewmode()!!}
</script>
<script>
    $('#kt_aside_toggle').click(function(){
        var value = true;
        if($(this).attr('sub_data') == '1'){
            value = 'false';
            $(this).attr('sub_data','2')
        }else{
            value = 'true';
            $(this).attr('sub_data','1')
        }
        var id = 'menu_left_big_small';
        $.post("{{url('jquery')}}",{
            event   : "configcheck",
            id      : id,
            value   : value,
        },function(data, status){
            console.log(data);
        });
    });
</script>


	</body>
</html>
