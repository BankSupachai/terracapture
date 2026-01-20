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
.btn-white{
    background-color: white;
}
</style>

 <div class="row">

        <div class="card" style="height: 130px; margin:10px; width: 1838px; margin-left: 45px; background-color: #FEF2DF;">
            <div class="card-body ms-5" >
                <div class="row m-0">
                    <input name="patientid" type="hidden" value="">
                    <input name="useropen" type="hidden" value="{{ @uid() }}">
                    <input name="hn" type="hidden" value="">
                    <div class="col-1">
                        <img id="imgnew" src="../public/images/usericon.png" width="100px" />
                    </div>
                    <div class="col-9 mt-3">
                        <span class="h3 "> </span>
                        <span
                            class="h3"> TEST20250821 test test (48)</span>
                        <div class="d-block mt-3 ">
                            <span class=" text-register">Gender : </span>
                            &ensp;
                            <span class=" text-register fw-normal">Date of Birth:  &ensp; │
                                &ensp;</span>
                            <span class=" text-register fw-normal">Tel:  &ensp; │
                                &ensp;</span>
                            <span class=" text-register fw-normal">E-mail:  &ensp;
                                &ensp;</span>
                        </div>
                    </div>
                    <div class="col-2 mt-4 text-end">
                        <a class="btn btn-primary btn-load"
                            href="edit.php">Edit
                            Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin: 40px; margin-top: 49px;">

        <div class="card " style="margin-top: -4.5em; margin-left: 4px;">
            <div class="card-body">
                <form action="" method="post" id="regis_form" autocomplete="off">

                    <input name="hn" type="hidden" value="">
                    <input name="useropen" type="hidden" value="{{ @uid() }}">
                    <input name="capture" type="hidden" value="true">
                    <span class="text-register3" >Appointment Form </span>
                    <div class="row mt-5 mb-0">
                        <div class="col-2 ">
                            <span class="text-register2">Operation Date/Time</span> <span class="text-danger fs-19">*</span>
                        </div>

                        <div class="col-2 mb-0">

                                <input name="book" type="hidden" value="true">
                                <input id="meet_date" name="meet_date" type="text" class="form-control flatpickr-input "
                                    data-provider="flatpickr" data-date-format="Y-m-d" readonly="readonly" value=""
                                    required>


                        </div>
                        <div class="col-1">
                            <select name='meet_hour' class='form-control text' style='width:100%' id='meet_hour'>

                            </select>
                        </div>
                        <div class="col-1">
                            <select name='meet_minute' class='form-control text' style='width:100%' id='meet_minute'>

                                    <option value='{{ $num }}' @if ($num == '00') selected @endif>
                                       </option>

                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2 ">
                            <span class="text-register2">Urgent </span>
                        </div>
                        <div class="col-6">
                            <select name="case_urgent" id="sel_urgent" class="select2 form-control">
                                <option value="" selected>N/A</option>
                                <option value="elective">Elective</option>
                                <option value="urgency">Urgency</option>
                                <option value="emergency">Emergency</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2 ">
                            <span class="text-register2">Procedure</span> <span class="text-danger fs-19">*</span>
                        </div>
                        <div class="col-6" >
                            <select class="form-control select2"  name="case_procedurecode[]" id="sel_procedure"required >
                                    <option value=""></option>
                            </select>
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-2 ">
                            <span class="text-register2">Physician</span> <span class="text-danger fs-19">*</span>
                        </div>
                        <div class="col-6">

                            <select class="form-control select2" id="sel_endoscopist" name="case_physicians01" required>
                                <option></option>

                            </select>
                        </div>
                        <div class="col-1 ps-0" style="margin-left: -12px;">
                            <button type="button"
                                class="btn btn-primary btn-icon waves-effect waves-light" style="border-radius: 0 8px 8px 0"
                                data-bs-toggle="modal" data-bs-target="#modal_adddoctor">
                                <i class="ri-user-add-line"></i>
                            </button>
                        </div>

                    </div>
                    <div class="row m-0">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <span id="alert_physician" class="text-danger" style="display: none;">&ensp;
                                โปรดเลือกแพทย์</span>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2 ">
                            <span class="text-register2">Attendant</span>
                        </div>
                        <div class="col-6">
                            <select class="form-control select2"  name="user_in_case[]" id="sel_users">


                                        <option value="">

                                        </option>
                            </select>
                        </div>
                    </div>

                    <div class="row m-0">
                        <div class="col-2"></div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2 ">
                            <span class="text-register2">Treatment coverage</span>
                        </div>
                        <div class="col-6">
                            <select class="select2 form-control" id="sel_treatmentcoverage" name="treatment_coverage">
                                <option value=""></option>

                            </select>
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-2 ">
                            <span class="text-register2">Location</span>
                        </div>
                        <div class="col-2">
                            <input type="text" placeholder="Ward" class="form-control bg-gray-input autotext savejson" name="ward"
                                id="ward">
                        </div>
                        <div class="col-2">
                            <input type="text" placeholder="OPD" class="form-control bg-gray-input autotext savejson" name="opd"
                                id="opd">
                        </div>
                        <div class="col-2">
                            <input type="text" placeholder="Refer" class="form-control bg-gray-input autotext savejson" name="refer"
                                id="refer">
                        </div>

                    </div>

                    <div class="row mt-4">
                        <div class="col-2 ">
                            <span class="text-register2">Pre-Diagnosis</span>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control bg-gray-input autotext savejson" name="prediagnosis_other"
                                id="prediagnosis_other">
                        </div>
                    </div>
                    <div class="col-auto d-flex justify-content-end mt-4">
                        <a href="javascript:;" id="submit_btn" name="next" value="1"
                            class="btn btn-primary btn-loading btn-label waves-effect right waves-light">
                            <i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i>
                            Confirm
                        </a>
                    </div>

                    <button style="display:none" id="warning_div" type="button" data-toast data-toast-text=""
                        data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000"
                        data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs">Bottom
                        Right</button>

                </form>
            </div>
        </div>
    </div>
</body>

<?php include("footer.php"); ?>

</html>
