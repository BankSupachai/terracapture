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

<div class="row g-0 delete-h" id="step01" style="margin: 0; margin-top: 15px;">

        <div class="col-3" style="padding-left: 40px;">
            <div class="card mt-1 me-2">
                <div class="card-body" style="height: 575px; background-color: #192d4b; border-radius: 5px;">
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between align-items-start">
                            <button type="button" id="patient_test" class="btn btn-white btn-sm waves-effect waves-light"
                                data-toggle="tooltip" title="Create patient test" style="width: 40px; height: 40px; border-radius: 8px;">
                                <i class="ri-edit-2-fill" style="font-size: 18px; color: #000;"></i>
                            </button>
                        </div>

                        <div class="col-12 d-flex justify-content-center mt-4">
                            <div class="profile-placeholder" style="width: 120px; height: 120px; background-color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <img src="http://localhost/endocapture/public/images/usericon1.jpg" style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover;">
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <input type="hidden" name="patient_id" value="{{ @$patient_id }}">
                            <input type="hidden" name="type" value="{{ @$type }}">
                            <input type="hidden" name="cid" value="{{ @$cid }}">
                            <input type="hidden" name="myHiddenField">

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-4">
                                        <label class="text-white mb-2" style="font-size: 14px; font-weight: 500; margin-left: -15px;">
                                            Patient ID <span style="color: #ef4444;">*</span>
                                        </label>
                                        <input type="text" name="hn" id="hn"
                                            class="form-control" value=""
                                            placeholder="HN" required
                                            style="background-color: white; border: none; border-radius: 10px;  font-size: 14px; margin-left: -20px; width: 400px;"
                                            >
                                        <div id="show_lang_in_here"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="text-white mb-2" style="font-size: 14px; font-weight: 500; margin-left: -15px;">
                                            Admit ID
                                        </label>
                                        <input type="text" name="an" id="an"
                                            class="form-control" value=""
                                            placeholder="Admit ID" required
                                            style="background-color: white; border: none; border-radius: 10px;  font-size: 14px; margin-left: -20px; width: 400px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 mt-1" style="padding-right: 50px;">
            <div class="card">
                <div class="card-body">
                    <div class="">

                        <h4 class="ms-3 mb-5" style="color: #192D48;"> Registration Form</h4>
                    </div>

                    <div class="row m-0 cn">
                        <div class="col-2"><b class="text-blue h5 m-0">Name <span style="color: red;">*</span></b></div>
                        <div class="col-2">
                            <input name="prefix" id="prefix" type="text"
                                class="form-control bg-gray-input savejson autotext ck_gender"
                                value=""
                                pattern="[A-Za-zก-๙\s\.]+"
                                title="Please enter only letters and common title prefixes (e.g. นาย, นาง, น.ส.)"
                                onkeypress="return /[A-Za-zก-๙\s\.]/.test(event.key)">
                        </div>
                        <div class="col-2"
                            id="first_name_col">
                            <input name="firstname" type="text" class="form-control bg-gray-input"
                                id="first_name" value="" required>
                        </div>
                        <div
                            class="col-2">
                            <input name="middlename" type="text" class="form-control bg-gray-input"
                                id="middlename" value="">
                        </div>
                        <div class="col-2"
                            id="last_name_col">
                            <input name="lastname" type="text" class="form-control bg-gray-input"
                                value="" id="last_name" required>

                        </div>
                        <div class="col-1 text-nowrap">
                            <label class="checkbox text-muted">
                                <input type="checkbox" class="form-check-input" name="Checkboxes1" id="ck_middle"
                                    />
                                <span class="text-index-dark"> &ensp; Middle Name</span>

                            </label>
                        </div>
                        <div class="row m-0 text-muted">
                            <div class=" mt-1 col-2 hide-res"></div>
                            <div class=" mt-1 col-2  text-gray text-nowrap">Prefix</div>
                            <div class=" mt-1 col-2 text-gray"
                                id="first_name_cols">First Name</div>
                            <div
                                class=" mt-1 col-2  text-middle-col">
                                Middle Name</div>
                            <div class=" mt-1 col-2 text-gray"
                                id="last_name_cols">Last Name
                            </div>
                        </div>

                    </div>
                    <div class="row m-0 mt-5 pt-2 cn">
                        <div class="col-2">
                            <b class="text-blue h5 m-0">Date of birth <span style="color: red;">*</span></b>
                        </div>
                        <div class="col-4">

                            <div class="row m-0" id="set_date">
                                <div class="col-4 p-0">
                                    <select class='form-control' name='birthday' id="birthday">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class='form-control' name='birthmonth' id="birthmonth">
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div class="col-4 p-0">

                                    <select class='form-control' name='birthyear' id="birthyear">
                                        <option value="2025">2025</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                        <option value="2022">2022</option>
                                        <option value="2021">2021</option>
                                        <option value="2020">2020</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 width-res">
                            <input name="age" type="number" id="agenew"
                                class="form-control width-res bg-gray-input" value=""
                                style="width: 95%" style="height: auto;" required>
                        </div>
                    </div>
                    <div class="row m-0 mt-1">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <div class="row m-0 text-muted">
                                <div class="col-4 p-0 text-gray">Day</div>
                                <div class="col-4 text-gray">Month</div>
                                <div class="col-4 p-0 text-gray">Year</div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="text-muted">
                                <span class="text-gray">Age</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 mt-5 pt-2">
                        <div class="col-lg-2"><b class="text-blue h5 m-0">Gender <span style="color: red;">*</span></b></div>
                        <div class="col">
                            <div class="d-flex align-items-center">
                                <div class="me-4 d-flex align-items-center">
                                    <input type="radio" class="form-check-input gender auto_ckmale me-2" name="gender"
                                        id="male" value="1" required />
                                    <label class="form-check-label mb-0 text-index-dark" for="male">Male</label>
                                </div>
                                <div class="me-4 d-flex align-items-center">
                                    <input type="radio" class="form-check-input gender auto_ckfemale me-2"
                                        name="gender" id="female" value="2" />
                                    <label class="form-check-label mb-0 text-index-dark" for="female">Female</label>
                                </div>
                                <div class="d-flex align-items-center">
                                    <input type="radio" class="form-check-input gender me-2" name="gender"
                                        id="prefernottosay" value="3" />
                                    <label class="form-check-label mb-0 text-index-dark" for="prefernottosay">Prefer not to say</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 mt-5 pt-2">
                        <div class="col-2"><b class="text-blue h5 m-0">Contact</b></div>
                        <div class="col-3">
                            <input type="text" class="form-control bg-gray-input" name="phone" id="phone"
                                value="">
                        </div>
                        <div class="col-4">
                            <input type="text" class="form-control bg-gray-input" name="email" id="email"
                                value="">
                        </div>
                    </div>
                    <div class="row m-0 text-muted">
                        <div class="col-2"></div>
                        <div class="col-3 text-gray">Phone</div>
                        <div class="col-4 text-gray">Email</div>
                    </div>
                    <br><br>
                    <br>
                    <div class="" style="padding-bottom:13px;"></div>
                    <div class="form-row">
                        <div class="row">
                            <div class="col-auto">

                            </div>
                            <div class="col"></div>
                            <div class="col-auto ">

                                    <input type="hidden" name="next" value="1">
                                    <a id="submit_btn" href="registration.php"
                                        class="btn btn-primary btn-loading btn-label waves-effect right waves-light "><i
                                            class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i>
                                        Confirm Edit</a>

                            </div>
                            <button id="warning_div" type="button" data-toast data-toast-text=""
                                data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000"
                                data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs"
                                style="display:none">Bottom Right</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


</body>
<div style="margin-top: 220px;">
<?php include("footer.php"); ?>
</div>
</html>
