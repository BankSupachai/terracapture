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
    <link href="http://localhost/lumina/public/recorder/luminaicon.png" rel="shortcut icon">
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
        html {
            min-height: 100% !important
        }

        .select2-container .select2-selection--multiple {
            background-color: #F3F3F9;
        }

        .btn-operation {
            height: 97px;
            width: 170px;
            background: #245788;
            color: #fff
        }

        .btn-operation:hover {
            color: #fff;
            background: #245788;
        }

        .btn-summary:hover {
            color: #fff;
            background: #22917a;
        }

        .btn-summary {
            height: 97px;
            width: 170px;
            /* background: #51B09D;
                                        color: #fff; */
            background: #F3F3F9;
            color: #5f5c5c
        }



        .btn-summary-active {
            color: #fff;
            background: #22917a;
        }

        .btn-operation-active {
            color: #fff;
            background: #245788;
        }

        .btn-not-active {
            background: #dfe3e2;
            color: #5f5c5c
        }



        .text-summary {
            position: absolute;
            vertical-align: middle;
        }

        .iconupper {
            display: block;
        }

        .choices__input {
            background-color: #F3F3F9;
        }

        .search-input {
            width: 100%;
            background-color: #F3F3F9;
            color: #9599AD;
            border: 0px transparent !important;
        }

        .search-input:focus {
            width: 100%;
            background-color: #F3F3F9;
            color: #9599AD;
            border: 0px transparent !important;
        }

        .select2-selection {
            background-color: #F3F3F9 !important;
            border-color: transparent !important;
        }

        .normal-text {
            color: #9599AD;
        }

        #table_export {
            height: 400px;
            overflow: auto;
        }

        #table_export,
        tr,
        td {
            white-space: nowrap;
        }

        .pagination {
            flex-wrap: wrap;
        }

        .select2-container .select2-selection--multiple {
            height: 37px !important;
            overflow-y: auto !important;
            max-height: 37px !important;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .select2-container .select2-selection--multiple::-webkit-scrollbar {
            display: none;
        }

        .select2-container .select2-search--inline .select2-search__field {
            margin-top: 9px !important;
        }
    </style>

    <script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
    <script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
    <script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>
    <div id="user_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Export by</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <select name="user_export" id="user_export" class="form-select mb-3 search-input user_export" required>
                        <option value="">&nbsp;User</option>

                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- @include('capture.camera.obs.js_hotkey') -->

    <div class="row">
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-header">
                    <form action="{{ url('exportdata') }}" method="POST">

                        <input type="hidden" name="event" value="query_data">
                        <input type="hidden" name="action" value="show">
                        <div class="row m-0">
                            <div class="col-2">
                                <input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"
                                    class="form-control search-input" name="start_date" id="start_date"
                                    placeholder="Start-Date" onchange="check_start_date(this.value)"
                                    value="">
                            </div>
                            <div class="col-2">
                                <input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"
                                    class="form-control search-input" name="end_date" id="end_date" placeholder="End-Date"
                                    value="">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control search-input" name="keyword" id="keyword" placeholder="ค้นหา" value="">
                            </div>

                            <div class="col-2">
                                <select name="user[]" id="user" class="form-select mb-3 search-input">
                                    <option value="">&nbsp;Physician</option>
                                </select>
                            </div>

                            <div class="col-2">
                                <select name="procedure[]" id="procedure" class="form-select mb-3 search-input"
                                    onchange="get_icd(this.value)">
                                    <option value="">&nbsp;Procedure</option>
                                </select>
                            </div>
                            <div class="col-auto ps-2 pe-2">
                                <input type="hidden" id="type" name="type" value="operation">
                                <button id="query_btn" type="submit" class="btn btn-primary waves-effect waves-light"
                                    style="width:100%">
                                    <i class="ri-search-line label-icon align-middle"></i>
                                    <span class="align-middle">Search</span></button>
                            </div>
                            <div class="col-auto ps-2 pe-2">
                                <a id="clear_btn" href="{{ url('exportdata') }}"
                                    class="btn btn-warning waves-effect waves-light" style="width:100%">
                                    <i class="ri-eraser-fill label-icon align-middle " style=""></i> <span
                                        class="align-middle"> Clear</span></a>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class=" text-end">
                                        <a class="btn btn-success yourlink pt-3 "><i class="ri-download-line ri-lg"></i></a>
                                    </div>
                                    <div class="col-1 ms-0 export-spinner" style="display: none">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-1" style="display: block">
                        <div id="select_head" class="row m-0">
                        </div>
                    </div>
                </div>
                <div style="height: 886px; overflow:auto">
                    <table class="table table-bordered ">
                        <thead class="table-light">
                            <tr>
                                <td>HN</td>
                                <td>Name</td>
                                <td>Age</td>
                                <td>Gender</td>
                                <td>Appointment Date</td>
                                <td>Procedure</td>
                                <td>Physician</td>
                                <td>Consultant</td>
                                <td>Assistant</td>
                                <td>Nurse</td>
                                <td>Nurse Assistant</td>
                                <td>Anesthesia</td>
                                <td>Nurse Anesthesia</td>
                                <td>User Branch</td>
                                <td>Department</td>
                                <td>Scope</td>
                                <td>Room</td>
                                <td>Ward</td>
                                <td>OPD</td>
                                <td>Refer</td>
                                <td>Patient in time</td>
                                <td>Start time</td>
                                <td>Withdrawal time</td>
                                <td>End time</td>
                                <td>Followup</td>
                                <td>Brief history</td>
                                <td>Pre-diagnosis</td>
                                <td>Indication</td>
                                <td>Indication other</td>
                                <td>Medication</td>
                                <td>Medication other</td>
                                <td>Anesthesia</td>
                                <td>Finding</td>
                                <td>Overall Findding</td>
                                <td>Diagnostic (Icd 10)</td>
                                <td>Diagnostic other</td>
                                <td>Procedure (Icd 9)</td>
                                <td>Procedure other</td>
                                <td>Bowel Preparation</td>
                                <td>Bowel other</td>
                                <td>Gastic Content</td>
                                <td>ESTIMATED BLOOD LOSS    </td>
                                <td>BLOOD TRANSFUSION    </td>
                                <td>Specimen</td>
                                <td>Complication</td>
                                <td>Complication other</td>
                                <td>Rapid urease test</td>
                                <td>Plan/Comment</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tr>
                            <td>{{ @$case->case_hn }}</td>
                            <td>{{ @$case->patientname }}</td>
                            <td>{{ @$case->age }}</td>
                            <td>{{ @$gender }}</td>
                            <td>{{ @$case->appointment }}</td>
                            <td>{{ @$case->procedurename }}</td>
                            <td>{{ @$case->doctorname }}</td>
                            <td>{{ @$case->case_consultname }}</td>
                            <td>
                                {{ @$case->assistant ?? '-' }}
                            </td>
                            <td>
                                {{-- {{$n}} --}}
                                {{ implode(',', $n ?? []) }}
                            </td>
                            <td>{{ implode(',', $nurse_assiss) }}
                            </td>
                            <td>{{ implode(',', $anesthesia ?? []) }}</td>
                            <td>{{ implode(',', $nurse_anes ?? []) }}</td>
                            <td>{{ @$case->branch ?? '-' }}</td>
                            <td>{{ @$case->department }}</td>
                            <td>
                            </td>
                            <td>{{ @$room }}</td>
                            <td>{{ @$case->ward ?? '-' }}</td>
                            <td>{{ @$case->opd ?? '-' }}</td>
                            <td>{{ @$case->refer ?? '-' }}</td>
                            <td>{{ @$case->time_patientin }}</td>
                            <td>{{ @$case->time_start ?? '-' }}</td>
                            <td>{{ @$case->time_withdrawal }}</td>
                            <td>{{ @$case->time_end }}</td>
                            <td>{{ @$case->followup_date }}</td>
                            <td>{{ @$case->case_history }}</td>
                            <td>{{ @$case->prediagnostic_other }}</td>
                            <td>
                                {{ implode(', ', $indication) }}
                            </td>
                            <td>
                                {{ @$case->indication_other ?? '-' }}
                            </td>
                            <td>
                                {{ json_encode($medication) }}
                            </td>
                            <td>
                                {{ @$case->medi_other ?? ' - ' }}
                            </td>
                            <td>
                                {{ implode(' , ', $anesthesia_medi) }}
                                {{ @$case->anesthesiaother ?? '' }}

                            </td>
                            <td>
                                {{ json_encode($finding) }}
                            </td>
                            <td>
                                {{ @$case->overall_finding ?? '-' }}
                            </td>
                            <td>
                                {{ implode(',', array_filter($diagnostic)) }}
                            </td>
                            <td>{{ @$case->overall_diagnosis ?? '-' }}</td>
                            <td>{{ implode(',', array_filter($procedure_icd9)) }}</td>
                            <td>{{ @$case->overall_procedure ?? '-' }}</td>
                            <td>{{ @$case->bowel ?? '-' }} </td>
                            <td>{{ @$case->bowel_other ?? '' }}</td>
                            <td>{{ implode(',', array_filter($gastric_content)) }}</td>
                            <td>{{ @$case->blood_loss ?? ' - ' }} {{ @$case->bowel_other }}   </td>
                            <td>{{ @$case->blood_transfusion ?? ' - ' }}</td>
                            <td>
                            </td>
                            <td>{{ implode(',', array_filter($complication)) }}</td>
                            <td>{{ @$case->complication_other ?? '-' }}</td>
                            <td>{{ @$case->box_rapid_pending ?? '-' }}</td>
                            <td>{{ @$case->case_comment ?? '-' }}</td>
                            <td>{{ @$status }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
