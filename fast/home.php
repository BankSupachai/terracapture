<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-layout-mode="light" data-layout-width="fluid" data-layout-position="fixed"
    data-layout-style="default">

<head>
    <meta name="csrf-token" content="VyA002AcomMjMUK57FwZHKEhPJKntrw9ADXGG88X" />
    <meta charset="utf-8" />
    <title>EndoCapture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="http://localhost/endocapture/public/recorder/favicon.png" rel="shortcut icon">
    <script src="http://localhost/lumina/assets/js/layout.js"></script>
    <link href="http://localhost/lumina/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/lumina/public/recorder/small-scale.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="http://localhost/lumina/assets/css/sweetalert2.min.css">


</head>

<body id="body">
    <?php include("head.php"); ?>

    <style>

    </style>


    <div class="row" style="margin: 40px;margin-top:1em;">
        <div class="col-lg-12 card">


            <div class="w-100" style="width: 100%;">
                <div class="w-100 bg-is-white p-3">
                    <div class="row m-0 cn">
                        <div class="col-lg-auto d-flex align-items-center">
                            <input id="show_joball" class="form-check-input date-type select-status me-2" type="radio"
                                name="event_date" value="all" id="all">
                            <label class="form-check-label mb-0" for="show_joball">
                                All Cases
                            </label>
                        </div>
                        <div id="todayCaseCol" class="col-auto border-end border-dark d-flex align-items-center">
                            <input id="show_jobtoday" class="form-check-input date-type select-status me-2" status=""
                                type="radio" name="event_date" value="today" id="todaycase" checked>
                            <label class="form-check-label mb-0" for="show_jobtoday">
                                Today Cases
                            </label>
                        </div>
                        <div class="col-lg">
                            <div class="radio-inline">
                                <div id="show_jobtodaygroup" class="row m-0">
                                    <div class="col-lg-auto d-flex align-items-center">
                                        <input class="form-check-input select-status me-2" status="" type="radio"
                                            name="form_select" value="Totaltoday" id="totaltoday" checked>
                                        <label class="form-check-label mb-0" for="totaltoday">
                                            All <span style="color:#9599AD;"
                                                data-target="{{ @$total }}"></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-auto d-flex align-items-center">
                                        <input class="form-check-input select-status me-2" status="holding" type="radio"
                                            name="form_select" value="Holding" id="holding">
                                        <label class="form-check-label mb-0" for="holding">
                                            Holding <span style="color:#9599AD;"
                                                data-target="{{ @$pending }}"></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-auto d-flex align-items-center">
                                        <input class="form-check-input select-status me-2" status="operation" type="radio"
                                            name="form_select" value="Operation" id="operation">
                                        <label class="form-check-label mb-0" for="operation">
                                            Operation <span
                                                style="color:#9599AD; " data-target="{{ @$operation }}"></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-auto d-flex align-items-center">
                                        <input class="form-check-input select-status me-2" status="recovery" type="radio"
                                            name="form_select" value="Recovery" id="recovery">
                                        <label class="form-check-label mb-0" for="recovery">
                                            Recovery & Discharged <span
                                                style="color:#9599AD;" data-target="{{ @$completed }}"></span>
                                        </label>
                                    </div>
                                    <div class="col-lg-auto">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-auto">
                            <a href="{{ url('capture') }}"
                                class="btn btn-warning btn-load btn-label h5 text-white">
                                <i class="ri-camera-fill text-white label-icon align-middle fs-16 me-2"></i>
                                &nbsp;Test Camera
                            </a>
                        </div>


                        <div class="col-lg-auto p-0">
                            <a data-container="body" data-toggle="popover" data-placement="top"
                                data-content="Create New Case" href="create.php"
                                class="btn btn-primary btn-load btn-label h5 waves-effect text-white">
                                <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i>&nbsp;Create Case
                            </a>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="" id="switch_on" value="today">
                <div class=" m-0" style="padding-top:1px;">
                    <div class="pt-3" style="border-top: 1px solid rgb(235, 236, 240);">


                        <?php include("today.php"); ?>
                        <!-- @include('capture.home.list-table.today') -->
                        <!-- @include('capture.home.list-table.allcases') -->
                    </div>
                </div>
                <button id="patient_warning" hidden type="button" data-toast data-toast-text=""
                    data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close=""
                    data-toast-className="warning" class="btn btn-light w-xs">Bottom Right</button>
            </div>
        </div>
    </div>



</body>
<?php include("footer.php"); ?>

</html>

<!-- Loading Modal -->
