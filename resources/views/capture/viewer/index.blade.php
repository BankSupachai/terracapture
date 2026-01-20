@extends('capture.viewer.layouts_Newipad')

@section('tophead')
    Viewer History
@endsection
@section('style')
    <style>
        .bd-radius {
            border-radius: 10px;
        }

        .btn-group-dark {
            background: #2B2F34;
            color: #BBBBBB;

        }

        .btn-group-dark:hover {
            background: #25272b;
            color: #fff;

        }

        .btn-group-blue {
            background: #225381;
            color: #BBBBBB;
        }

        .btn-group-blue:hover {
            background: #1b456d;
            color: #fff;
        }

        .nav-pills .nav-link {
            border: 0px;
        }

        .px-10 {
            padding-left: 15em;
            padding-right: 15em;

        }
        .img-viewer{
            height: auto;
            width: 100%;
        }
    </style>
@endsection

@section('offcanvas')
    <div class="offcanvas offcanvas-end w-100 bg-darkness" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header" style="border-bottom: 1px solid #ffffff3d;">
            <h3 id="offcanvasRightLabel" class="text-white">
                <i class="ri-macbook-fill ri-1x งmt-1"></i>
                &ensp;
                Viewer
            </h3>
            <button type="button" class="btn text-white" data-bs-dismiss="offcanvas" aria-label="Close">X</button>
        </div>
        <input type="hidden" id="caseid_inp">
        <div class="offcanvas-body">
            <div class="row mb-5">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <ul class="nav nav-pills nav-justified mb-3" role="tablist">
                                <li class="nav-item nav-primary waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#report_tab" id="btn_report"
                                        role="tab">
                                        Report
                                    </a>
                                </li>
                                <li class="nav-item  nav-primary waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#photo_tab" id="btn_photo" role="tab">
                                        Photo
                                    </a>
                                </li>
                                <li class="nav-item  nav-primary waves-effect waves-light">
                                    <a class="nav-link" data-bs-toggle="tab" href="#video_tab" id="btn_video" role="tab">
                                        Video
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
                <div class="col-2 text-end " id="pdf_type">
                    <select class="form-select  ">
                        <option value="physician">Physician</option>
                        <option value="nurse">Nurse</option>
                        <option value="followup">Follow Up</option>
                        <option value="billing">Billing</option>

                    </select>
                </div>
            </div>
            <!-- Tab panes -->
            <div class="tab-content text-muted">
                <div class="tab-pane active" id="report_tab" role="tabpanel">
                    <div class="row px-10" id="report_viewer">
                        <div class="col-12 ">
                            <iframe id="iframepdf" src="" width="100%"  style="display: none" ></iframe>
                            <div id="endosmart_report">
                                {{-- report img here --}}
                            </div>
                            {{-- <img class="w-100" src="{{ url('public/image/mockupPdf.png') }}" alt=""> --}}
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="photo_tab" role="tabpanel">
                    <div class="row" id="photo_div">

                        <div class="col-2"></div>
                        <div class="col-4 text-end">
                            <img class="img-viewer" src="{{ url('assets/images/@fortest/procedure5.jpg') }}"
                                 alt="">
                                <img class="img-viewer mt-3" src="{{ url('assets/images/@fortest/procedure2.jpg') }}"
                                 alt="">
                        </div>
                        <div class="col-4 ">
                            <img class="img-viewer" src="{{ url('assets/images/@fortest/procedure5.jpg') }}"
                                alt="">
                                <img class="img-viewer mt-3" src="{{ url('assets/images/@fortest/procedure2.jpg') }}"
                                 alt="">
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>
                <div class="tab-pane" id="video_tab" role="tabpanel">
                    <div class="row" id="video_div">
                        {{-- <div class="col-2"></div>
                        <div class="col-8">
                           <h1 class="text-white text-center">video Here</h1>
                            <img class="img-viewer" src="{{ url('assets/images/@fortest/procedure5.jpg') }}"
                            alt="">
                        </div>
                        <div class="col-2"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    @php
        $patient   = isset($patient)   ? (object) $patient : null;
        $procedure = isset($procedure) ? (object) $procedure : null;
        $tb_case   = isset($tb_case)   ? (object) $tb_case : null;

        $patientname  = '';
        if(isset($patient->firstname) && isset($patient->lastname)){
            $patientname = $patient->firstname.' '.$patient->lastname;
        } else if(isset($tb_case->patientname)){
            $patientname = $tb_case->patientname;
        }

        $case_hn      = isset($case_hn) ? $case_hn : $tb_case->hn;

        $birthdate    = '2023-01-01';
        if(isset($patient->birthdate)){
            $birthdate = $patient->birthdate;
        } else if(isset($tb_case->date)){
            $birthdate = $tb_case->date;
        }

        $gender    = 1;
        if(isset($patient->gender)){
            $gender = $patient->gender;
        } else if(isset($tb_case->date)){
            $gender = $tb_case->gender;
        }

    @endphp
    <div class="row px-4 mt-2">
        @php
            if(isset($birthdate)){
                $dob = date_format(date_create($birthdate),"d/m/Y");
                $age = date_diff(date_create($birthdate), date_create('now'))->y;
            } else {
                $dob = '';
                $age = '';
            }
        @endphp
        <div class="col-12">
            <span class="text-white">
                Patient Detail : &ensp; &ensp;
                {{@$case_hn}} &ensp; &ensp;
                {{@$patientname}} &ensp; &ensp;
                {{@$gender}} &ensp; &ensp;
                {{@$dob}} ({{@$age}})
            </span>
        </div>
        <div class="row mt-3">
            <div class="col-2">
                <select class="form-select" id="procedure" data-choices name="choices-single-default"
                    id="choices-single-default" onchange="function_search()">
                    <option value="">Procedure</option>
                    @foreach ($procedure as $pcd)
                        @php
                            $pcd = (object) $pcd;
                        @endphp
                        <option value="{{$pcd->name}}">{{$pcd->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-2">
                <select class="form-select " id="physician" data-choices name="choices-single-default"
                    id="choices-single-default" onchange="function_search()">
                    <option value="">Physician</option>
                    @foreach (isset($doctor)?$doctor:[] as $doc)
                        @php
                            $doc = (object) $doc;
                            $fullname = @$doc->user_prefix.@$doc->user_firstname." ".@$doc->user_lastname;
                        @endphp
                        <option value="{{@$fullname}}">{{@$fullname}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" id="all_btn" value="all" class="btn btn-group-blue btn-range" onclick="toggle_range('all')">ALL</button>
                    <button type="button" id="day_btn" value="day" class="btn btn-group-dark btn-range" onclick="toggle_range('day')">0D</button>
                    <button type="button" id="week_btn" value="week" class="btn btn-group-dark btn-range" onclick="toggle_range('week')">1W</button>
                </div>
            </div>
            <div class="col-12 mt-2">
                @include('capture.viewer.table')
            </div>
        </div>
    </div>
@endsection


@section('script')
<script src="{{asset('public/js/moment.min.js')}}"></script>
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>

<script>
    $('#btn_reprot').click(function(){
        $('#physician_select').show();
    });

    $('#btn_photo').click(function(){
        $('#physician_select').hide();
    });

    $('btn_video').click(function(){
        $('physician_select').hide();
    });
</script>
<script>

    var range_lg = $('.btn-range').length;

    function toggle_range(val){
        for (let i = 0; i < range_lg; i++) {
            $($('.btn-range')[i]).removeClass('btn-group-blue').addClass('btn-group-dark')
        }
        $(`#${val}_btn`).addClass('btn-group-blue')
        function_search()
    }

    function check_which_range(){
        let range = ''
        for (let i = 0; i < range_lg; i++) {
            let is_selected = $($('.btn-range')[i]).hasClass('btn-group-blue')
            if(is_selected){
                range = $($('.btn-range')[i]).val()
            }
        }
        return range;
    }

    function function_search(){
        var procedure = $('#procedure').val()
        var physician = $('#physician').val()
        var range     = check_which_range()
        console.log(procedure, physician, range);

        $('#tasksTable .table_row').show()

        $('#tasksTable .table_row').each((index, element) => {
            console.log(element, $(element).find('.sort-procedure').eq(0));
            var proc_div      = $(element).find('.sort-procedure').eq(0).html().trim()
            var doctor_div    = $(element).find('.sort-physician').eq(0).html().trim()
            var date_div      = $(element).find('.sort-date').eq(0).html().trim()
            var diag_div      = $(element).find('.sort-prediag').eq(0).html().trim().toLowerCase()
            console.log(proc_div, doctor_div, date_div, diag_div);

            if(procedure != '' && procedure != undefined){
                if((proc_div.includes(procedure) || proc_div.includes(procedure)) ){} else {
                    $(element).hide()
                }
            }

            if(physician != '' && physician != undefined){
                if((doctor_div.includes(physician) || doctor_div.includes(physician)) ){} else {
                    $(element).hide()
                }
            }

            if(range != '' && range != undefined){
                if(range == 'all'){
                    // $(element).show()
                } else if(range == 'day'){
                    var now = moment().format('YYYY-MM-DD')
                    console.log(now, date_div, now.includes(date_div));
                    if(now.includes(date_div)){} else {$(element).hide()}
                } else if(range == 'week') {
                    var week = get_current_week()
                    if(week.includes(date_div)) {} else {$(element).hide()}
                    console.log(week, week.includes(date_div), date_div);
                }
            }

        })

    }

    function get_current_week(){
        let current_date = moment()
        let week_start = current_date.clone().startOf('isoWeek')
        let week_end = current_date.clone().endOf('isoWeek')
        let this_week = []
        for (var i = 0; i <= 6; i++) {
            this_week.push(moment(week_start).add(i, 'days').format("YYYY-MM-DD").toLowerCase());
        }
        return this_week
    }

    function open_detail(hn, case_id, date, is_endosmart){
        console.log(hn, case_id, date, is_endosmart);
        // call_alert('load')
        set_default()
        $('#btn_report').click()
        $('#photo_div').empty()
        $('#video_div').empty()
        $('#endosmart_report').empty()
        $('#pdf_type').off('mousedown')
        $('#caseid_inp').val(case_id)
        $.post('{{url("api")}}/case', {
            event: 'get_caseviewer',
            hn   : hn,
            case_id : case_id,
            is_endosmart: is_endosmart
        }, function (data, status) {
            console.log('test',data);
            var photo = data['photo']
            var video = data['video']
            var pdf   = data['case_pdfversion']
            var is_endosmart = data['is_endosmart']
            console.log(photo, video, pdf, is_endosmart);
            console.log('pdf', pdf);
            if(is_endosmart == 'true'){
                $('#pdf_type').on('mousedown', unclickable)
            }

            if(photo != null && photo != undefined && is_endosmart == 'false'){
                photo.forEach(p => {
                    if(p['ns'] > 0){
                        var img_src = `{{@$store_url}}${hn}/${date}/${p['na']}`
                        $('#photo_div').append(`
                            <div class="col-6 mt-4">
                                <img src="${img_src}" class="img-fluid" alt="">
                            </div>
                        `)
                    }
                });
            } else if(photo != null && photo != undefined && is_endosmart == 'true'){
                photo.forEach(p => {
                    if(p.includes(hn) ){
                        $('#photo_div').append(`
                        <div class="col-6 mt-4">
                            <img src="${p}" class="img-fluid" alt="">
                        </div>
                        `)
                    }

                });
            }

            if(video != null && video != undefined){
                video.forEach(v => {
                var vdo_src = `${v['vdo_url']}`
                    $('#video_div').append(`
                        <div class="col-12 mt-4 text-center">
                            <video class="vdo-div text-center" style="width:80%"  controls>
                                <source src="${vdo_src}">
                            </video>
                        </div>
                    `)
                });
            }



            if(pdf != null && pdf != undefined && is_endosmart == 'false'){
                var pdf_lg = pdf.length
                var latest_pdf = pdf[pdf_lg - 1]
                var pdf_name   = latest_pdf['pdf']
                var pdf_src    = `{{@$store_url}}${hn}/${date}/pdf/${pdf_name}`
                $('#iframepdf').css('display', 'block').prop('src', pdf_src)
            } else if(pdf != null && pdf != undefined && is_endosmart == 'true'){
                // $('#iframepdf').css('display', 'block').prop('src', pdf[0])
                $('#iframepdf').css('display', 'none')
                pdf.forEach((e, i) => {
                    let split = e.split('/')
                    let max_count = split.length
                    let last_item = split[max_count-1]
                    let last_item_split = last_item.split('-')
                    if(last_item_split[1].includes(hn)){
                        $('#endosmart_report').append(`
                        <img class="mt-3" style="width:100%; height: 1000px" src="${e}">
                        `)
                    }
                })
            }

            swal.close()

            function unclickable(){
                return false
            }
        })
    }

    function change_pdf() {
        // alert('Please');
        var type = $('#pdf_type').val()
        var id = $('#caseid_inp').val()
        var type_str = ''

        // call_alert('load')

        var src_pdf = ``
        if (type == 'physician') {
            src_pdf = `{{url('api/pdf')}}?id=${id}&type=${type_str}`
        }
        if (type == 'nurse') {
            src_pdf = `{{url('api/pdfnurse')}}/${id}`
        }
        if (type == 'followup') {
            src_pdf = `{{url('api/pdfnurse')}}/${id}/edit`
        }

        $('#iframepdf').attr('src', src_pdf)

    }

    function set_default() {
        let names = ['report', 'photo', 'video']
        for (let i = 0; i < 3; i++) {
            $(`#btn_${names[i]}`).removeClass('active')
            $(`#${names[i]}_tab`).removeClass('active')
        }

        $(`#btn_report`).addClass('active')
        $(`#report_tab`).addClass('active')
    }



</script>
@endsection
