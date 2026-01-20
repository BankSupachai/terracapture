@extends('capture.layoutv6')

@section('style')
    <style>
        .card-body {
            padding: 1em;
        }

        .TextTable-header {
            color: #9599AD;
        }

        .border-under {
            border-bottom: 1px solid #49505733;
        }
    </style>
@endsection
@section('offcanvas')
        @include('capture.casehistory.component.offcanvas-compare-left')
        @include('capture.casehistory.component.offcanvas-report-viewer')
        @include('capture.casehistory.component.offcanvas-compare-right')
    {{-- <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvas_report" aria-labelledby="offcanvasRightLabel"
        style="width: 640px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvas_report"> <i class="ri-macbook-fill"></i> &ensp; Viewer &ensp; <span id="case_date"></span></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="col-12 p-0 m-0 border-under"></div>
        <div class="offcanvas-body">
            <ul class="nav nav-pills nav-success mb-3" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active" data-bs-toggle="tab" href="#pdf_report" role="tab">Report</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link photo_offcanvas" id="" data-bs-toggle="tab" href="#photo" role="tab">Photo</a>
                </li>


                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link video_offcanvas" data-bs-toggle="tab" href="#video" role="tab">Video</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                <a class="nav-link download_offcanvas" data-bs-toggle="tab" href="#download" role="tab">Download</a>
            </li>
            </ul>
            <input type="hidden" class="temp_id">

            <div class="tab-content text-muted">
                <div class="tab-pane active tap_change" id="pdf_report" role="tabpanel">
                    <iframe id="iframe_pdf_report" frameborder="0" width="600" height="1350"></iframe>
                </div>
                <div class="tab-pane" id="photo" role="tabpanel">
                    <iframe id="iframe_photo" frameborder="0" width="600" height="1350"></iframe>
                </div>

                <div class="tab-pane" id="video" role="tabpanel">
                    <iframe id="iframe_video" frameborder="0" width="600" height="1350"></iframe>

                </div>
                <div class="tab-pane p-3" id="download" role="tabpanel">
                    <iframe id="iframe_download" frameborder="0" width="600" height="1350"></iframe>

                </div>
            </div>
        </div>
    </div> --}}
    @include('capture.camera.obs.js_hotkey')
@endsection
@section('content')
    <div class="row" style="margin: 0;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action ="{{ url('casehistory') }}" method="get">
                        @csrf
                        <input type="hidden" name="event" value="search_history">
                        <div class="row">
                            <div class="col-lg-2">

                                <div class="input-icon">
                                    <input name="search_hn" type="text" class="form-control bg-gray-input"
                                        placeholder="HN" autocomplete="off" value="{{ @$search_hn }}">

                                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row mt-res ">
                                    <div class="col-6 ">
                                        <select name="sel_physician" class="form-control search_today bg-gray-input "
                                            id="select_home_physician">
                                            <option value="">Physician</option>
                                            @foreach ($doctor ?? [] as $doc)
                                                <option value="{{ $doc->uid }}" @selected(@$search_physician == $doc->uid)>
                                                    {{ fullname($doc) }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-6">
                                        {{-- @dd($procedure) --}}
                                        <select name="sel_procedure" class="form-control search_today"
                                            id="select_home_procedure">
                                            <option value="">Procedure</option>
                                            @foreach ($procedure ?? [] as $proc)
                                                <option value="{{ $proc->code }}" @selected(@$search_procedure == $proc->code)>
                                                    {{ $proc->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="input-icon">
                                            <input type="text" name="search_keyword" class="form-control bg-gray-input"
                                                placeholder="Keyword" value="{{ @$search_keyword }}" />
                                            <span><i class="flaticon2-search-1 icon-md"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control"
                                            style=" border-color: #F3F6F9; background-color:#F3F6F9;" name="date_start"
                                            id="date_start" placeholder="Start-Date" value="{{ @$date_start }}">
                                    </div>
                                    <div class="col-2 ">
                                        <input type="text" class="form-control"
                                            style=" border-color: #F3F6F9; background-color:#F3F6F9;" name="date_end"
                                            id="date_end" placeholder="End-Date" value="{{ @$date_end }}">
                                    </div>
                                    <div class="col-3 ">
                                        <button type="submit" class=" btn btn-primary" style="width: 96px;height:40px;">
                                            <i class="ri-search-line icon-md"></i> &ensp;Search
                                        </button>
                                        <a href="{{ url('casehistory') }}" class="btn btn-warning"
                                            style="width: 94px; height:40px;"> <i class="ri-eraser-fill icon-md"></i>
                                            &ensp;Clear</a>
                                    </div>

                                    {{-- <button type="button" class="btn btn-info" id="leftMenuBtn" style="width: 96px;height:40px; margin-left: 5px;"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvascompare_left" aria-controls="offcanvascompare_left">
                                        <i class="ri-menu-line"></i> &ensp;เมนูซ้าย
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="rightMenuBtn" style="width: 96px;height:40px; margin-left: 5px;"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvascompare_right" aria-controls="offcanvascompare_right">
                                        <i class="ri-sidebar-line"></i> &ensp;เมนูขวา
                                    </button> --}}
                                </div>

                            </div>
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-primary mb-2 mt-2" id="compareBtn" style="width: 250px;height:40px;">
                                    &ensp;Compare
                                </button><br>
                                <span class="text-muted">*สำหรับการเปรียบเทียบเคส กรุณาเลือกเคสที่ต้องการเปรียบเทียบ (สามารถเปรียบเทียบได้ครั้งละ 2 เคส)</span>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="list-table pt-0 active" style="margin-left: 16px; margin-right: 16px;">
                    <div class="alltodaycase-header">
                        <table class="table table-today">
                            <thead class="table-light TextTable-header " id="scroll-bottom" style="overflow-x: scroll;">
                                <tr class="bg-light TextTable-header">
                                    <td>Action</td>
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
                            @forelse ($tb_case ?? [] as $case)
                                @php
                                    $case = (object) $case;
                                    $photo_db = $case->photo ?? [];
                                    // dd(@$case->video);
                                    $photo_names = [];
                                    foreach ($photo_db as $value) {
                                        if (isset($value['na'])) {
                                            $photo_names[] = $value['na'];
                                            $photo_name = json_encode($photo_names);
                                        }
                                    }

                                    $video_db = $case->video ?? [];
                                    // dd($video_db);
                                    $video_names = [];

                                    foreach ($video_db as $v) {
                                        if (isset($v)) {
                                            $video_names[] = $v;
                                            $video_name = json_encode($video_names);
                                        }
                                    }

                                    // dd($video_name)

                                @endphp
                                <tbody id="table_casetoday">
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input case-checkbox" value="{{ @$case->id }}" data-case-id="{{ @$case->id }}" hn="{{@$case->case_hn}}" appointment_date="{{@$case->appointment_date}}">
                                        </td>
                                        <td>{{ @$case->appointment_date }}</td>
                                        <td>{{ @$case->case_hn }}</td>
                                        <td>{{ @$case->patientname }}</td>
                                        <td>{{ @$case->procedurename }}</td>
                                        <td>{{ @$case->doctorname }}</td>
                                        <td>{{ @$case->room_name }}</td>
                                        <td>{{ @$case->scope_name }}</td>
                                        <td>
                                            @if (@$case->rapid_other == 'Positive (+)')
                                                <span class="badge badge-danger">Positive</span>
                                            @elseif(@$case->rapid_other == 'Negative (-)')
                                                <span class="badge badge-success">Negative</span>
                                            @elseif(@$case->rapid_other == 'Pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>{{ $case->prediagnostic_other ?? '' }}</td>
                                        {{-- @dd($case); --}}
                                        <td class="text-end">
                                            {{-- <a href="{{url("capture/procedure/$case->id")}}" class="btn btn-icon btn-secondary"><i class=" ri-file-fill"></i></a> --}}
                                            <button class="btn btn-icon btn-secondary offcanvas_pdf"
                                                onclick="refreshIframe()" case_id="{{ @$case->id }}"
                                                data-bs-toggle="offcanvas" data-bs-target="#offcanvas_report"
                                                aria-controls="offcanvas_report" case_hn = "{{ @$case->case_hn }}"
                                                appointment_date = "{{ @$case->appointment_date }}"
                                                patientname = "{{ @$case->patientname }}" id="btn_callfunction">
                                                <i class=" ri-file-text-fill"></i>
                                            </button>
                                            <!-- Debug: แสดงข้อมูลใน tooltip -->
                                            <small style="display: none; font-size: 10px; color: #666;">
                                                ID: {{ @$case->id }} | HN: {{ @$case->case_hn }}
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                            @empty
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
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @if (is_object($tb_case))
            {{ $tb_case->onEachSide(5)->appends(request()->input())->links() }}
        @endif

        {{-- @dd($store_url) --}}
    </div>
@endsection



@section('script')
    <script>
        // $(".photo_offcanvas").click(function(){
        //     var id = $(".temp_id").val();
        //     let url = `{{ url('casehistory/show?event=photo') }}&cid=`+id;
        //     $("#iframe_photo").attr("src", url);
        // })
        // $(".video_offcanvas").click(function(){
        //     var id = $(".temp_id").val();
        //     let url = `{{ url('casehistory/show?event=video') }}&cid=`+id;
        //     $("#iframe_video").attr("src", url);
        // })
        // $(".download_offcanvas").click(function(){

        //     var id = $(".temp_id").val();
        //     let url = `{{ url('casehistory/show?event=download') }}&cid=`+id;
        //     $("#iframe_download").attr("src", url);
        // })
    </script>
    <script>
        var currentCaseId = null; // ตัวแปรเก็บ case_id ปัจจุบัน

        $(".offcanvas_pdf").click(function() {
            var id = $(this).attr("case_id");
            var hn = $(this).attr("case_hn");
            var date = $(this).attr("appointment_date");
            var patientname = $(this).attr("patientname");

            // เก็บ case_id ปัจจุบัน
            currentCaseId = id;



            // Format the date
            const dateObj = new Date(date);
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const formattedDate = String(dateObj.getDate()).padStart(2, '0') + ' ' +
                months[dateObj.getMonth()] + ', ' +
                dateObj.getFullYear() + ' ' +
                String(dateObj.getHours()).padStart(2, '0') + ':' +
                String(dateObj.getMinutes()).padStart(2, '0');

            $("#case_date").html(formattedDate);
            $("#testapi").html("HN: " + hn + " &ensp; " + patientname);


            let photoUrl = `{{ url('casehistory/show?event=photo') }}&cid=` + id;
            let reportUrl = `{{ url('api/pdf') }}/${id}`;
            $("#iframe_photo").attr("src", photoUrl);
            $("#iframe_pdf_report").attr("src", reportUrl);


            $("#btnPhoto").addClass('active');
            $("#btnReport").removeClass('active');
            $("#btnDownload").removeClass('active');
            $("#photo").addClass('active');
            $("#pdf_report").removeClass('active');
            $("#download").removeClass('active');
        });


        $("#btnPhoto").click(function() {
            $(this).addClass('active');
            $("#btnReport").removeClass('active');
            $("#btnDownload").removeClass('active');
            $("#photo").addClass('active');
            $("#pdf_report").removeClass('active');
            $("#download").removeClass('active');
        });

        $("#btnReport").click(function() {
            $(this).addClass('active');
            $("#btnPhoto").removeClass('active');
            $("#btnDownload").removeClass('active');
            $("#pdf_report").addClass('active');
            $("#photo").removeClass('active');
            $("#download").removeClass('active');
        });

        $("#btnDownload").click(function() {
            $(this).addClass('active');
            $("#btnPhoto").removeClass('active');
            $("#btnReport").removeClass('active');
            $("#download").addClass('active');
            $("#photo").removeClass('active');
            $("#pdf_report").removeClass('active');

            // ใช้ case_id ที่เก็บไว้
            if (currentCaseId) {
                let url = `{{ url('casehistory/show?event=download') }}&cid=` + currentCaseId;
                console.log('Download URL:', url); // Debug log
                $("#iframe_download").attr("src", url);
            } else {
                console.error('No currentCaseId found!'); // Debug error
            }
        });
    </script>






    <script>
        document.getElementById("date_end").addEventListener("focus", function() {
            this.type = "date";
            this.placeholder = "";
        });

        document.getElementById("date_end").addEventListener("blur", function() {
            if (this.value === "") {
                this.type = "text";
                this.placeholder = "End-Date";
            }
        });
    </script>
    <script>
        document.getElementById("date_start").addEventListener("focus", function() {
            this.type = "date";
            this.placeholder = "";
        });

        document.getElementById("date_start").addEventListener("blur", function() {
            if (this.value === "") {
                this.type = "text";
                this.placeholder = "Start-Date";
            }
        });
    </script>
    <script>
        $(document).ready(function() {


            $("#select2_room").on("change", function() {
                var value = $(this).val().toLowerCase();
                // alert(value)
                $(".table-today tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            $('#select2_room').select2({
                placeholder: "Select Room",
                allowClear: true
            });

            $('#select2_room').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });


            $('#select_home_physician').select2({
                placeholder: "Select Physicain",
                allowClear: true
            });

            $('#select_home_physician').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });

        });


        $(document).ready(function() {
            $('#select_home_procedure').select2({
                placeholder: "Select Procedure",
                allowClear: true
            });

            $('#select_home_procedure').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {

            $(".slide").each(function() {
                var $slide = $(this),
                    $select = $slide.find('.js-example-basic-single'),
                    animationName = $slide.find('h6').text();

                $select.select2({
                    placeholder: "Select a state",
                    dropdownParent: $slide,
                    data: select2Data,
                    minimumResultsForSearch: -1,
                    dropdownPosition: 'below'
                }).on('select2:open', function(e) {
                    $slide.find('.select2-dropdown').addClass('animated ' + animationName);
                }).on('select2:closing', function(e) {
                    $slide.find('.select2-dropdown').removeClass('animated ' + animationName);
                });

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            // Add event listener for Compare button
            $("#compareBtn").on("click", function() {
                // Get all checked checkboxes
                var checkedCheckboxes = $(".case-checkbox:checked");

                if (checkedCheckboxes.length !== 2) {
                    alert("กรุณาเลือก case จำนวน 2 รายการเพื่อเปรียบเทียบ");
                    return;
                }
                var caseIds = [];
                checkedCheckboxes.each(function() {
                    var caseId = $(this).data("case-id");
                    caseIds.push(caseId);
                });


                $("#iframe_report_left").attr("src", `{{ url('api/pdf') }}/${caseIds[0]}`);
                $("#iframe_report_right").attr("src", `{{ url('api/pdf') }}/${caseIds[1]}`);

                // เปิด offcanvas ทั้งสองโดยใช้ Bootstrap Offcanvas API
                var offcanvasLeft = new bootstrap.Offcanvas(document.getElementById('offcanvascompare_left'));
                var offcanvasRight = new bootstrap.Offcanvas(document.getElementById('offcanvascompare_right'));



                get_photo(caseIds[0], caseIds[1]);
                get_video(caseIds[0], caseIds[1]);



                offcanvasLeft.show();
                offcanvasRight.show();
            });

            // จัดการ tab switching สำหรับ offcanvas ด้านซ้าย
            $("#nav-photo-tab-left").click(function() {
                $(this).addClass('active');
                $("#nav-video-tab-left, #nav-report-tab-left").removeClass('active');
                $("#nav-photo-left").addClass('show active');
                $("#nav-video-left, #nav-report-left").removeClass('show active');
            });

            $("#nav-video-tab-left").click(function() {
                $(this).addClass('active');
                $("#nav-photo-tab-left, #nav-report-tab-left").removeClass('active');
                $("#nav-video-left").addClass('show active');
                $("#nav-photo-left, #nav-report-left").removeClass('show active');
            });

            $("#nav-report-tab-left").click(function() {
                $(this).addClass('active');
                $("#nav-photo-tab-left, #nav-video-tab-left").removeClass('active');
                $("#nav-report-left").addClass('show active');
                $("#nav-photo-left, #nav-video-left").removeClass('show active');
            });

            // จัดการ tab switching สำหรับ offcanvas ด้านขวา
            $("#nav-photo-tab-right").click(function() {
                $(this).addClass('active');
                $("#nav-video-tab-right, #nav-report-tab-right").removeClass('active');
                $("#nav-photo-right").addClass('show active');
                $("#nav-video-right, #nav-report-right").removeClass('show active');
            });

            $("#nav-video-tab-right").click(function() {
                $(this).addClass('active');
                $("#nav-photo-tab-right, #nav-report-tab-right").removeClass('active');
                $("#nav-video-right").addClass('show active');
                $("#nav-photo-right, #nav-report-right").removeClass('show active');
            });

            $("#nav-report-tab-right").click(function() {
                $(this).addClass('active');
                $("#nav-photo-tab-right, #nav-video-tab-right").removeClass('active');
                $("#nav-report-right").addClass('show active');
                $("#nav-photo-right, #nav-video-right").removeClass('show active');
            });


            $(".case-checkbox").on("change", function() {
                var checkedCheckboxes = $(".case-checkbox:checked");

                if (checkedCheckboxes.length > 2) {

                    $(this).prop("checked", false);
                    alert("สามารถเลือกได้ไม่เกิน 2 รายการ");
                    return;
                }
                if (checkedCheckboxes.length === 2) {
                    $("#compareBtn").prop("disabled", false).removeClass("btn-secondary").addClass("btn-primary");
                } else {
                    $("#compareBtn").prop("disabled", true).removeClass("btn-primary").addClass("btn-secondary");
                }
            })
            $("#compareBtn").prop("disabled", true).removeClass("btn-primary").addClass("btn-secondary");
        });



        function get_photo(caseid_01, caseid_02) {
            // Clear previous content and show loading
            $("#case_photo_left").html(`<div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">กำลังโหลด...</span>
                </div>
                <p class="mt-2">กำลังโหลดรูปภาพ...</p>
            </div>`);
            $("#case_photo_right").html(`<div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">กำลังโหลด...</span>
                </div>
                <p class="mt-2">กำลังโหลดรูปภาพ...</p>
            </div>`);

            $.post("{{ url('api/case') }}", {
                cid: caseid_01,
                cid_02: caseid_02,
                event: "compare_photo"
            }, function(data, status) {

                var data = JSON.parse(data);
                let htmlLeft = '';
                let htmlRight = '';
                $("#case_hn_left").html(data.case01.hn);
                $("#case_hn_right").html(data.case02.hn);

                // วนลูปแสดงรูปภาพของ case01 (ด้านซ้าย)
                if (data.photoname01 && data.photoname01.length > 0) {
                    data.photoname01.forEach(function(photo, index) {
                        htmlLeft += `<div class="col-6 text-center mb-3">
                            <img class="img-fluid" src="{{ $store_url }}/${data.case01.hn}/${data.case01.appointment_date}/${photo}" alt="รูปภาพ ${index + 1}">
                        </div>`;
                    });
                } else {
                    htmlLeft = `<div class="col-12 text-center">
                        <p class="text-muted">ไม่มีรูปภาพ</p>
                    </div>`;
                }

                // วนลูปแสดงรูปภาพของ case02 (ด้านขวา)
                if (data.photoname02 && data.photoname02.length > 0) {
                    data.photoname02.forEach(function(photo, index) {
                        htmlRight += `<div class="col-6 text-center mb-3">
                            <img class="img-fluid" src="{{ $store_url }}/${data.case02.hn}/${data.case02.appointment_date}/${photo}" alt="รูปภาพ ${index + 1}">
                        </div>`;
                    });
                } else {
                    htmlRight = `<div class="col-12 text-center">
                        <p class="text-muted">ไม่มีรูปภาพ</p>
                    </div>`;
                }

                $("#case_photo_left").html(htmlLeft);
                $("#case_photo_right").html(htmlRight);

            });
        }

        function get_video(caseid_01, caseid_02) {
            // Clear previous content and show loading
            $("#case_video_left").html(`<div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">กำลังโหลด...</span>
                </div>
                <p class="mt-2">กำลังโหลดวิดีโอ...</p>
            </div>`);
            $("#case_video_right").html(`<div class="col-12 text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">กำลังโหลด...</span>
                </div>
                <p class="mt-2">กำลังโหลดวิดีโอ...</p>
            </div>`);

            $.post("{{ url('api/case') }}", {
                cid: caseid_01,
                cid_02: caseid_02,
                event: "compare_video"
            }, function(data, status) {

                var data = JSON.parse(data);
                console.log(data , "video");

                let htmlLeft = '';
                let htmlRight = '';

                // วนลูปแสดงวิดีโอของ case01 (ด้านซ้าย)
                if (data.videoname01 && data.videoname01.length > 0) {
                    data.videoname01.forEach(function(video, index) {
                        htmlLeft += `<div class="col-12 text-center mb-3">
                            <video class="img-fluid" controls>
                                <source src="{{ $store_url }}/${data.case01.hn}/${data.case01.appointment_date}/vdo/${video}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>`;
                    });
                } else {
                    htmlLeft = `<div class="col-12 text-center">
                        <p class="text-muted">ไม่มีวิดีโอ</p>
                    </div>`;
                }

                // วนลูปแสดงวิดีโอของ case02 (ด้านขวา)
                if (data.videoname02 && data.videoname02.length > 0) {
                    data.videoname02.forEach(function(video, index) {
                        htmlRight += `<div class="col-12 text-center mb-3">
                            <video class="img-fluid" controls>
                                <source src="{{ $store_url }}/${data.case02.hn}/${data.case02.appointment_date}/vdo/${video}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>`;
                    });
                } else {
                    htmlRight = `<div class="col-12 text-center">
                        <p class="text-muted">ไม่มีวิดีโอ</p>
                    </div>`;
                }

                $("#case_video_left").html(htmlLeft);
                $("#case_video_right").html(htmlRight);

            });
        }
    </script>
@endsection
