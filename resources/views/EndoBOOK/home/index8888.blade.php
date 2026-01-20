<head>
		<meta charset="utf-8" />
		<link href="{{url('public/sample/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('public/sample/assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
</head>
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-row flex-column-fluid page">
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<div class="d-flex flex-column-fluid">
							<div class="container">
								<div class="card card-custom gutter-b example example-compact">
									<div class="card-header">
										<h3 class="card-title">Bootstrap Date Picker Examples</h3>
										<div class="card-toolbar">
											<div class="example-tools justify-content-center">
												<span class="example-toggle" data-toggle="tooltip" title="View code"></span>
											</div>
										</div>
									</div>
									<!--begin::Form-->
									<form class="form">
										<div class="card-body">
											<!--begin::Code-->
											<div class="example-code mb-10">
												<ul class="example-nav nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-2x">
													<li class="nav-item">
														<a class="nav-link active" data-toggle="tab" href="#example_code_html">HTML</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" data-toggle="tab" href="#example_code_js">JS</a>
													</li>
												</ul>
												<span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
											</div>
											<!--end::Code-->
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Minimum Setup</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<input type="text" class="form-control" id="kt_datepicker_1" readonly="readonly" placeholder="Select date" />
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Input Group Setup</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="input-group date">
														<input type="text" class="form-control" id="kt_datepicker_2" readonly="readonly" placeholder="Select date" />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-calendar-check-o"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Enable Helper Buttons</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="input-group date">
														<input type="text" class="form-control" readonly="readonly" value="05/20/2017" id="kt_datepicker_3" />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-calendar"></i>
															</span>
														</div>
													</div>
													<span class="form-text text-muted">Enable clear and today helper buttons</span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Orientation</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="input-group date mb-2">
														<input type="text" class="form-control" placeholder="Top left" id="kt_datepicker_4_1" />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-bullhorn"></i>
															</span>
														</div>
													</div>
													<div class="input-group date mb-2">
														<input type="text" class="form-control" placeholder="Top right" id="kt_datepicker_4_2" />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-clock-o"></i>
															</span>
														</div>
													</div>
													<div class="input-group date mb-2">
														<input type="text" class="form-control" placeholder="Bottom left" id="kt_datepicker_4_3" />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-check"></i>
															</span>
														</div>
													</div>
													<div class="input-group date">
														<input type="text" class="form-control" placeholder="Bottom right" id="kt_datepicker_4_4" />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-check-circle-o"></i>
															</span>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Range Picker</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="input-daterange input-group" id="kt_datepicker_5">
														<input type="text" class="form-control" name="start" />
														<div class="input-group-append">
															<span class="input-group-text">
																<i class="la la-ellipsis-h"></i>
															</span>
														</div>
														<input type="text" class="form-control" name="end" />
													</div>
													<span class="form-text text-muted">Linked pickers for date range selection</span>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Inline Mode</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<div class="" id="kt_datepicker_6"></div>
												</div>
											</div>
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Modal Demos</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<a href="#" class="btn font-weight-bold btn-light-primary" data-toggle="modal" data-target="#kt_datepicker_modal">Launch modal datepickers</a>
												</div>
											</div>
										</div>
										<div class="card-footer">
											<div class="row">
												<div class="col-lg-9 ml-lg-auto">
													<button type="reset" class="btn btn-primary mr-2">Submit</button>
													<button type="reset" class="btn btn-secondary">Cancel</button>
												</div>
											</div>
										</div>
									</form>
									<!--end::Form-->
								</div>
								<!--end::Card-->
								<!--begin::Modal-->
								<div class="modal fade" id="kt_datepicker_modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel">Bootstrap Date Picker Examples</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<i aria-hidden="true" class="ki ki-close"></i>
												</button>
											</div>
											<form class="form">
												<div class="modal-body">
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Minimum Setup</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<input type="text" class="form-control" id="kt_datepicker_1_modal" readonly="readonly" placeholder="Select date" />
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Input Group Setup</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<div class="input-group date">
																<input type="text" class="form-control" readonly="readonly" placeholder="Select date" id="kt_datepicker_2_modal" />
																<div class="input-group-append">
																	<span class="input-group-text">
																		<i class="la la-calendar-check-o"></i>
																	</span>
																</div>
															</div>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Enable Helper Buttons</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
															<div class="input-group date">
																<input type="text" class="form-control" value="05/20/2017" id="kt_datepicker_3_modal" />
																<div class="input-group-append">
																	<span class="input-group-text">
																		<i class="la la-calendar"></i>
																	</span>
																</div>
															</div>
															<span class="form-text text-muted">Enable clear and today helper buttons</span>
														</div>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-primary mr-2" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-secondary">Submit</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--end::Modal-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="{{url('public/sample/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{url('public/sample/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
		<script src="{{url('public/sample/assets/js/scripts.bundle.js')}}"></script>
		<script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
