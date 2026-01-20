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

    <!-- Bootstrap JavaScript -->
    <script src="http://localhost/lumina/assets/js/bootstrap.bundle.min.js"></script>

</head>

<body id="body">
    <?php include("head.php"); ?>
    <style>
.btn-white{
    background-color: white;
}
.border-under {
    border-bottom: 1px solid #dee2e6;
}

/* บังคับให้ offcanvas ขึ้นมาด้านขวา */
.offcanvas-end {
    top: 0 !important;
    right: 0 !important;
    left: auto !important;
    bottom: 0 !important;
    transform: translateX(100%) !important;
}

.offcanvas-end.show {
    transform: translateX(0) !important;
}

/* ปรับขนาด offcanvas */
#offcanvas_report {
    width: 100% !important;
    max-width: 100% !important;
}

/* แก้ไขปัญหา z-index และ positioning */
.offcanvas {
    z-index: 1045 !important;
    position: fixed !important;
}

/* ปรับ animation */
.offcanvas-end {
    transition: transform 0.3s ease-in-out !important;
}

/* ปรับ backdrop */
.offcanvas-backdrop {
    z-index: 1040 !important;
}

/* ปรับ header ของ offcanvas */
.offcanvas-header {
    border-bottom: 1px solid #dee2e6;
    padding: 1rem;
}

/* ปรับ body ของ offcanvas */
.offcanvas-body {
    padding: 1rem;
    overflow-y: auto;
}
    </style>

<div class="row" style="margin: 0;">
        <div class="col-lg-12">
            <div class="card m-3" >
                <div class="card-body">
                    <form action ="{{ url('casehistory') }}" method="get">

                        <input type="hidden" name="event" value="search_history">
                        <div class="row">
                            <div class="col-lg-2">

                                <div class="input-icon">
                                    <input name="search_hn" type="text" class="form-control bg-gray-input"
                                        placeholder="HN" autocomplete="off" value="">

                                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row mt-res ">
                                    <div class="col-6 ">
                                        <select name="sel_physician" class="form-control search_today bg-gray-input "
                                            id="select_home_physician">
                                            <option value="">Physician</option>


                                        </select>
                                    </div>
                                    <div class="col-6">

                                        <select name="sel_procedure" class="form-control search_today"
                                            id="select_home_procedure">
                                            <option value="">Procedure</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-icon">
                                            <input type="text" name="search_keyword" class="form-control bg-gray-input"
                                                placeholder="Keyword" value="" />
                                            <span><i class="flaticon2-search-1 icon-md"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control"
                                            style=" border-color: #F3F6F9; background-color:#F3F6F9;" name="date_start"
                                            id="date_start" placeholder="Start-Date" value="">
                                    </div>
                                    <div class="col-2 ">
                                        <input type="text" class="form-control"
                                            style=" border-color: #F3F6F9; background-color:#F3F6F9;" name="date_end"
                                            id="date_end" placeholder="End-Date" value="">
                                    </div>
                                    <div class="col-3 ">
                                        <button type="submit" class=" btn btn-primary" style="width: 96px;height:40px;">
                                            <i class="ri-search-line icon-md"></i> &ensp;Search
                                        </button>
                                        <a href="{{ url('casehistory') }}" class="btn btn-warning"
                                            style="width: 94px; height:40px;"> <i class="ri-eraser-fill icon-md"></i>
                                            &ensp;Clear</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="list-table pt-0 active" style="margin-left: 16px; margin-right: 16px;">
                    <div class="alltodaycase-header">
                        <table class="table table-today">
                            <thead class="table-light TextTable-header " id="scroll-bottom" style="overflow-x: scroll;">
                                <tr class="bg-light TextTable-header">
                                    <td> Date </td>
                                    <td>HN</td>
                                    <td>Name</td>
                                    <td>&ensp; Procedure</td>
                                    <td>Physician</td>
                                    <td>Room</td>
                                    <td>Scope</td>

                                    <td>Urease Test</td>
                                    <td>Pre - Diagnosis</td>
                                    <td class="text-end"> Action</td>
                                </tr>
                            </thead>







                                <tbody id="table_casetoday">
                                    <tr>
                                        <td>2025-08-21</td>
                                        <td>1234567890</td>
                                        <td>John Doe</td>
                                        <td>Endoscopy</td>
                                        <td>Dr. John Doe</td>
                                        <td>Room 101</td>
                                        <td>Endoscopy</td>
                                        <td>
                                            <span class="badge badge-danger">Positive</span>
                                        </td>
                                        <td>Endoscopy</td>
                                        <td class="text-end">
                                            <button class="btn btn-icon btn-secondary offcanvas_pdf"
                                                onclick="refreshIframe(event)" case_id="1"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvas_report"
                                                aria-controls="offcanvas_report" case_hn = "1234567890"
                                                appointment_date = "2025-08-21"
                                                patientname = "John Doe" id="btn_callfunction">
                                                <i class=" ri-file-text-fill"></i>
                                            </button>
                                            <!-- Debug: แสดงข้อมูลใน tooltip -->
                                            <small style="display: none; font-size: 10px; color: #666;">
                                                ID: 1 | HN: 1234567890
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                            <!-- @empty
                                <tbody id="table_casetoday">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Please filter to show data...</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            @endforelse -->
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <!-- Offcanvas Section -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas_report" aria-labelledby="offcanvasRightLabel"
        style="width: 100%;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvas_report"> <i class="ri-macbook-fill"></i> &ensp; Viewer &ensp; <span
                    id="case_date"></span> &ensp;
                <b id="testapi">HN: <span id="case_hn"></span></b> &ensp; <span id="patient_name"></span>
            </h5>
            <span class="h4">

            </span>
            <button type="button" class="btn-close text-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>

        </div>
        <div class="col-12 p-0 m-0 border-under"></div>
        <div class="offcanvas-body">
            <div class="d-flex ms-3 mb-3">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-soft-secondary me-2" style="" id="btnPhoto">Photo &
                        Video</button>
                    <button type="button" class="btn btn-soft-secondary me-2" style="" id="btnReport">Report</button>
                    <button type="button" class="btn btn-soft-secondary" style="" id="btnDownload">Download</button>
                </div>
            </div>
            <div class="tab-content text-muted">
                <div class="tab-pane active" id="photo" role="tabpanel">
                    <iframe id="iframe_photo" frameborder="0" width="100%" height="775px"></iframe>
                </div>
                <div class="tab-pane" id="pdf_report" role="tabpanel">
                    <iframe id="iframe_pdf_report" frameborder="0" width="100%" height="775px"></iframe>
                </div>
                <div class="tab-pane" id="download" role="tabpanel">
                    <iframe id="iframe_download" frameborder="0" width="100%" height="775px"></iframe>
                </div>

            </div>
        </div>
    </div>

</body>
<div style="margin-top: 605px;"><?php include("footer.php"); ?>
</div>

<script>
// Function to refresh iframe content
function refreshIframe(event) {
    // Get the button that was clicked
    const button = event.currentTarget;

    // Get case data from button attributes
    const caseId = button.getAttribute('case_id');
    const caseHn = button.getAttribute('case_hn');
    const appointmentDate = button.getAttribute('appointment_date');
    const patientName = button.getAttribute('patientname');

    // Update offcanvas header with case information
    document.getElementById('case_date').textContent = appointmentDate;
    document.getElementById('case_hn').textContent = caseHn;
    document.getElementById('patient_name').textContent = patientName;

    // Set iframe sources based on case ID
    document.getElementById('iframe_photo').src = `http://localhost/lumina/public/camera/index.php?case_id=${caseId}`;
    document.getElementById('iframe_pdf_report').src = `http://localhost/lumina/public/camera/report.php?case_id=${caseId}`;
    document.getElementById('iframe_download').src = `http://localhost/lumina/public/camera/download.php?case_id=${caseId}`;

    console.log('Case data loaded:', { caseId, caseHn, appointmentDate, patientName });
}

// Tab switching functionality
document.addEventListener('DOMContentLoaded', function() {
    const btnPhoto = document.getElementById('btnPhoto');
    const btnReport = document.getElementById('btnReport');
    const btnDownload = document.getElementById('btnDownload');

    const photoTab = document.getElementById('photo');
    const pdfReportTab = document.getElementById('pdf_report');
    const downloadTab = document.getElementById('download');

    btnPhoto.addEventListener('click', function() {
        // Remove active class from all tabs and buttons
        [photoTab, pdfReportTab, downloadTab].forEach(tab => tab.classList.remove('active'));
        [btnPhoto, btnReport, btnDownload].forEach(btn => btn.classList.remove('btn-secondary'));

        // Add active class to photo tab and button
        photoTab.classList.add('active');
        btnPhoto.classList.add('btn-secondary');
    });

    btnReport.addEventListener('click', function() {
        // Remove active class from all tabs and buttons
        [photoTab, pdfReportTab, downloadTab].forEach(tab => tab.classList.remove('active'));
        [btnPhoto, btnReport, btnDownload].forEach(btn => btn.classList.remove('btn-secondary'));

        // Add active class to report tab and button
        pdfReportTab.classList.add('active');
        btnReport.classList.add('btn-secondary');
    });

    btnDownload.addEventListener('click', function() {
        // Remove active class from all tabs and buttons
        [photoTab, pdfReportTab, downloadTab].forEach(tab => tab.classList.remove('active'));
        [btnPhoto, btnReport, btnDownload].forEach(btn => btn.classList.remove('btn-secondary'));

        // Add active class to download tab and button
        downloadTab.classList.add('active');
        btnDownload.classList.add('btn-secondary');
    });

    // Add event listener to offcanvas to refresh content when it opens
    const offcanvas = document.getElementById('offcanvas_report');
    offcanvas.addEventListener('show.bs.offcanvas', function () {
        console.log('Offcanvas is opening...');
    });
});
</script>

</html>
