@extends('layouts.layout_viewer')


@section('title', 'Endocapture')

@section('style')
<link href="{{asset('public/css/lightpick.min.css')}}"                           rel="stylesheet" type="text/css" />



<style>
    .img-fluid {
        max-height: 300px;
        width: 100%
    }

    .vdo-div {
        max-height: 400px;
        width: 100%
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        background: #245788 !important;
    }
    .left-list{}
    [data-layout-mode=dark]{
        --vz-topbar-user-bg: #193D61;
        --vz-header-bg: #193D61;
    }
    .left-list{
        padding: 15px 0 !important;
        background: #333333;
    }

    .layoutChooser {
        border: 1px solid rgba(77,99,110,0.81);
        border-radius: 8px;
        padding: 5px 0;
        position: absolute;
        z-index: 5000;
    }
    .layoutChooser-dropdown-menu {
    top: 100%;
    left: 0;
    float: left;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    background-clip: padding-box;
    box-shadow: 0 6px 12px rgb(0 0 0 / 18%);
}
#preview_div > div{
}

.div-border {
  border-style: solid;
  border-color: #264C60;
}
.box-number{
    padding-top: 0.2em;
    text-align: center;
    width: 2em;
    height: 2em;
    position: absolute;
    bottom: 0;
    right: 0;
    z-index: 2;
    background: black;
    color: white;
    border: 1px solid #4C4F57;
}
.image-list-img{
    border: 1px solid #4C4F57;
}
.nav-link > i{
    font-size: 2em;
}
.nav-item{
    text-align-last: center;
    align-self: center;
}
.dropdown-toggle::after{
    display: none;
}
/* .navbar-header {
    display: inline-flex;
} */
.ml-35{
    margin-left: 35em;
}
#page-topbar {
    background-color: #2B2E32;
}
.topbar-user {
    background-color: #33373B;
}
.procedure-task{
    font-size: 1.3em;
    height: 2em;
    width: 100%;
    text-align: center;
    background: #4B4F58;
    margin-top: 1px;
    padding: 0.3em;
}
.menu-list-image > div{
    margin-top: 10px;
}
.d-toggle::after {
    position: absolute;
    display: inline-block;
    margin-left: .5em;
    content: "\f0140";
    font-family: "Material Design Icons";
    font-size: small;
    margin-top: 0.7em;
}
.b04{
    margin-bottom: 0.4em;
}
.bg-terralink{
    background: #193D61;
}
.form-terra{
    background: #245788;
    border: 0;
    color: #fff;
}
.border-under{
    border-bottom: 1px solid #fff;
    opacity: 20%;
}
.offcanvas.offcanvas-end {
    border: 0;
}
.w-40{
    width: 40% !important;
}
.x-forclose{
    color: #fff;
    cursor: pointer;
}
.menu-data-list .active {
    background: #000000;
    opacity: 30%;
    color: #fff;
}
.form-check-input {
    background: transparent;
}
.btn-compare
{
    background: #F06548;
    color: #ffffff;
    width: 121px;
    height: 37px;

}
.btn-compare:hover
{
    background: #636262;
    color: #ffffff;

}
.btn-compare:disabled{
    border: 1px solid #ffffff;
    color: #ffffff;
    background: transparent;

}
.form-select:disabled
{
    background: #4B4F58;
    color: #000000;
}
</style>



@endsection

@section('modal')

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

<div class="row m-0 ">
    <div class="col-12 my-2 ps-3">
        @php
            if(isset($birthdate)){
                $dob = date_format(date_create($birthdate),"d/m/Y");
                $age = date_diff(date_create($birthdate), date_create('now'))->y;
            } else {
                $dob = '';
                $age = '';
            }

            if(isset($patient->age)){
                $age = @$patient->age."";
            }
        @endphp
        <label class="text-terralink">Patient Detail :  </label>&emsp;
        @isset($patientname)
            @if($patientname!="")
                <label class="text-terralink">{{@$patientname}} ({{@$patient->hn}})</label>&emsp;
            @elseif($patientname==""&&isset($patient->dicomname))
                <label class="text-terralink">{{@$patient->dicomname}} ({{@$hn}})</label>&emsp;
            @else
                <label class="text-terralink">({{@$case_hn}})</label>&emsp;
            @endif
        @endisset
        <label class="text-terralink">@isset($gender) {{ ($gender == 1) ? 'Male' : 'Female'}}  @endisset</label>&emsp;
        <label class="text-terralink">{{@$dob}} ({{@$age}})</label>
        <label class="text-terralink">Number of Study : <span id="study_num">{{count($tb_case)}}</span></label>&emsp;
    </div>
</div>
<div class="row m-0">
    <div class="col-2">
        <select name="" class="form-select js-example-basic-single" id="procedure" onchange="function_search()">
            <option value="">Procedure</option>
            @foreach ($procedure as $pcd)
                @php
                    $pcd = (object) $pcd;
                @endphp
                <option value="{{@$pcd->name}}">{{@$pcd->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-2">
        <select id="physician" class="form-select js-example-basic-single" onchange="function_search()">
            <option value="">Physician</option>
            @foreach (isset($doctor)?$doctor:[] as $doc)
                @php
                    $doc = (object) $doc;
                    $fullname = @$doc->user_prefix.@$doc->user_firstname." ".@$doc->user_lastname;
                @endphp
                <option value="{{@$fullname}}">{{@$fullname}}</option>
            @endforeach
        </select>
        {{-- <div class="search-box">
            <input type="text" class="form-control search form-control-dark" oninput="function_search()" placeholder="Search for Accession Number" id="text_search">
            <i class="ri-search-line search-icon"></i>
        </div> --}}
    </div>
    {{-- <div class="col">
        <select name="" class="form-control form-control-dark" id="modality" onchange="function_search()">
            <option value="0">Modality</option>
            <option value="CR">CR</option>
            <option value="CT">CT</option>
            <option value="MR">MR</option>
            <option value="US">US</option>
            <option value="OT">OT</option>
            <option value="BI">BI</option>
            <option value="CD">CD</option>
            <option value="DD">DD</option>
            <option value="DG">DG</option>
            <option value="ES">ES</option>
            <option value="LS">LS</option>
            <option value="PT">PT</option>
            <option value="RG">RG</option>
            <option value="ST">ST</option>
            <option value="TG">TG</option>
            <option value="XA">XA</option>
            <option value="RF">RF</option>
            <option value="RTIMAGE">RTIMAGE</option>
            <option value="RTDOSE">RTDOSE</option>
            <option value="RTSTRUCT">RTSTRUCT</option>
            <option value="RTPLAN">RTPLAN</option>
            <option value="RTRECORD">RTRECORD</option>
            <option value="HC">HC</option>
            <option value="DX">DX</option>
            <option value="NM">NM</option>
            <option value="MG">MG</option>
            <option value="IO">IO</option>
            <option value="PX">PX</option>
            <option value="GM">GM</option>
            <option value="SM">SM</option>
            <option value="XC">XC</option>
            <option value="PR">PR</option>
            <option value="AU">AU</option>
            <option value="EPS">EPS</option>
            <option value="HD">HD</option>
            <option value="SR">SR</option>
            <option value="IVUS">IVUS</option>
            <option value="OP">OP</option>
            <option value="SMR">SMR</option>
        </select>
    </div> --}}

    {{-- <div class="col">
        <select name="" class="form-control form-control-dark" id="status" onchange="function_search()" style="width: 50%">
            <option value="">Status</option>
            <option value="holding">Holding</option>
            <option value="Operation">Operation</option>
            <option value="Recovery">Recovery</option>
            <option value="discharged">Discharged</option>
        </select>
    </div> --}}
    <div class="col-auto">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off" value="all" checked="" onchange="function_search()">
            <label class="btn btn-dark-terra waves-effect waves-light" for="btnradio3">ALL</label>
            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" value="day" onchange="function_search()">
            <label class="btn btn-dark-terra waves-effect waves-light" for="btnradio1">0D</label>

            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" value="week" onchange="function_search()">
            <label class="btn btn-dark-terra waves-effect waves-light" for="btnradio2">1W</label>

        </div>
    </div>
    <div class="col-2">
        @php
            $now = date('Y-m-d');
        @endphp
        <input type="text" placeholder="Select date range" class="form-control form-control-dark" id="datepicker" />
        {{-- <input id="search_date" type="text" name="daterange" value="{{$now}} - {{$now}}" /> --}}
        {{-- <input type="text" class="form-control flatpickr-input " id="search_date"
            data-provider="flatpickr" data-date-format="Y-m-d" data-range-date="true" readonly="readonly"
            placeholder="Date Select" value="{{$now}}"> --}}
        <input type="hidden" id="date_from" value="">
        <input type="hidden" id="date_to" value="">
        {{-- <input type="text" class="form-control search form-control-dark" placeholder="Select date range"> --}}
    </div>
    <div class="col">
        <button type="button" onclick="compare_detail()" class="btn btn-compare " disabled><i class="ri-file-copy-2-fill"></i> Compare</button>
    </div>
</div>
<div class="offcanvas offcanvas-end w-40 bg-terralink" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <div class="row">
            <div class="col text-light">
                <i class="ri-macbook-fill"></i> &ensp;
                <span class="h4 text-white" id="offcanvasRightLabel" >Viewer</span>
            </div>
        </div>
        {{-- <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas" >
            X
        </button> --}}
        <span class="x-forclose" data-bs-dismiss="offcanvas" >
            X
        </span>
    </div>
    <div class="col-12 p-0 m-0 border-under"></div>

@include('terra.wait.components.offcanvas')

<!-- left offcanvas -->
<div class="offcanvas offcanvas-start w-40 bg-terralink" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
    <div class="offcanvas-header">
        <div class="row">
            <div class="col text-light">
                <i class="ri-macbook-fill"></i> &ensp;
                <span class="h4 text-white" id="offcanvasRightLabel" >Viewer</span>
            </div>
        </div>
        {{-- <button type="button" class="btn btn-light" data-bs-dismiss="offcanvas" >
            X
        </button> --}}
        <span class="x-forclose" data-bs-dismiss="offcanvas" >
            X
        </span>
    </div>
    <div class="col-12 p-0 m-0 border-under"></div>

@include('terra.wait.components.offcanvasleft')

@include('terra.wait.components.table')


@endsection





@section('script')
{{-- <script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/cornerstone/hammer.js')}}"></script>
<script src="{{asset('public/js/cornerstone/dicomParser.min.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstone.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstoneMath.min.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstoneTools.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstoneWADOImageLoader.bundle.min.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstoneWebImageLoader.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script> --}}

<script src="{{url("public/assets5/js/plugins.js")}}"></script>
<script src="{{url("public/assets5/js/app.js")}}"></script>
<script src="{{asset('public/js/moment.min.js')}}"></script>
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script src="{{asset('public/js/lightpick.min.js')}}"></script>


<script>
    // physician_select

    $('.report-btn').click(function(){
        $('#physician-select').show();

    });
    $('.photo-btn').click(function(){
        $('#physician-select').hide();

    });
     $('.video-btn').click(function(){
        $('#physician-select').hide();

    });

    var picker = new Lightpick({
        field: document.getElementById('datepicker'),
        singleDate: false,
        onSelect: function(start, end){
            console.log(start, end);
            var start_format = start.format('YYYY-MM-DD')
            $('#date_from').val(start_format)
            if(end != null && end != undefined){
                var end_format = end.format('YYYY-MM-DD')
                $('#date_to').val(end_format)
            }
            function_search()
            $('#btnradio3').prop('checked', true);
        }
    });

</script>
<script>

    function function_search(){
        var procedure = $('#procedure').val()
        var physician = $('#physician').val()
        var range     = $('input[name="btnradio"]:checked').val()
        var date_from = $('#date_from').val()
        var date_to   = $('#date_to').val()
        // var name      = $('.input-terralink').eq(0).val().toLowerCase()
        console.log(procedure, physician, range, date_from, date_to, name);

        if(range != null && range != undefined){
            picker.setDate('')
            $('#date_from').val('')
            $('#date_to').val('')
        }

        // search date
        var daylist = []
        if(date_from != undefined && date_from != ''){
            var getDaysArray = function(s,e) {for(var a=[],d=new Date(s);d<=new Date(e);d.setDate(d.getDate()+1)){ a.push(new Date(d));}return a;};
            daylist = getDaysArray(new Date(date_from), new Date(date_to));
            daylist.map((v)=>v.toISOString().slice(0,10)).join("")
            daylist.forEach((e, i) => {
                daylist[i] = moment(e).format('YYYY-MM-DD')
            })
            if(daylist.length == 0){
                daylist = [date_from]
                date_to = date_from
            }
        }


        $('#tasksTable .tr-row').show()

        $('#tasksTable .tr-row').each((index, element) => {
            // console.log(element, $(element).find('.sort-procedure').eq(0));

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

            // if(name != '' && name != undefined){
            //     if((diag_div.includes(name) || diag_div.includes(name)) ){} else {
            //         $(element).hide()
            //     }
            // }

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
                    console.log(week);
                }
            }

            if(daylist.length != 0){
                if(daylist.includes(date_div)) {} else {$(element).hide()}
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

    function get_procedure(modality){
        let pcd = []
        pcd['es'] = ['EGD', 'colonoscopy', 'ERCP', 'Bronchoscope', 'Cystoscopy', 'Esophagoscopy',
                    'Enteroscopy', 'Nasal Endoscopy', 'Ear Endoscopy', 'Change PEG',
                    'Push Enteroscope', 'Rigid Bronchoscopy', 'Pleuroscopy', 'PEG insertion',
                    'Sigmoidscopy', 'Esophagoscopy', 'PM', 'Pain', 'Enteroscopy', 'Laparoscopic']
        pcd['us'] = ['EUS', 'Liver Biopsy', 'Kidney Biopsy', 'Cysto with DJ stent', 'Cystostomy',
                    'Ultrasound-Guided (TTNB/IPC)', 'ENT']
        pcd['ot'] = ['Percutaneous Dilatational Tracheostomy', 'Manometryม Trust with Bx.',
                    'BCG', 'Change DS stent, Change PCN', 'Cysto with RP', 'RP']
        pcd['ct'] = ['PCN', 'Cysto with DJ stent', 'ENT']
        pcd['mr'] = ['ENT']
        pcd['rf'] = ['Cystogram']
        pcd['0']  = 'all'
        return pcd[`${modality}`] ? pcd[`${modality}`]  : []
    }

    function set_procedure(pcd_array){
        let pcd_num = $('#procedure option').length
        for(i=0;i<pcd_num;i++){
            if(pcd_array == 'all'){
                $($('#procedure option')[i]).show()
            } else {
                let opt_text = $($('#procedure option')[i]).text()
                $($('#procedure option')[i]).show()
                if(pcd_array.indexOf(opt_text) < 0){
                    $($('#procedure option')[i]).hide()
                }
            }
        }
    }

    function change_pdf(num_id) {

        var type = $(`#pdf_type${num_id}`).val()
        var id = $(`#caseid_inp${num_id}`).val()
        var type_str = ''

        // console.log(id,num_id,type ,"bankkkkkkkkkkkkkkk");
        // call_alert('load')

        var src_pdf = ``
        if (type == 'physician') {
            src_pdf = `{{url('api/pdf')}}?id=${id}&type=${type_str}`
        }
        if (type == 'nurse') {
            src_pdf = `{{url('note/paper')}}/${id}`
        }
        if (type == 'followup') {
            src_pdf = `{{url('api/pdfnurse')}}/${id}/edit`
        }

        $(`#iframepdf${num_id}`).attr('src', src_pdf)



    }

    $('#iframepdf').on('load', function(){
        swal.close()
    });

    $('#iframepdf2').on('load', function(){
        swal.close()
    });
</script>
<script>
    function open_detail(hn, case_id, date, is_endosmart, num_id='', compare){

        // console.log(hn, case_id, date, is_endosmart);
        call_alert('load')
        set_default()
        if(compare == false){
            clear_ck()
        }
        $(`#compare${case_id}`).prop('checked', true)
        $(`#photo_div${num_id}`).empty()
        $(`#video_div${num_id}`).empty()
        $(`#endosmart_report${num_id}`).empty()
        $(`#iframepdf`).attr('src', '')
        $(`#iframepdf2`).attr('src', '')
        $(`#pdf_type${num_id}`).off('mousedown')
        $(`#caseid_inp${num_id}`).val(case_id)
        $.post('{{url("api")}}/case', {
            event: 'get_caseviewer',
            hn   : hn,
            case_id : case_id,
            is_endosmart: is_endosmart
        }, function (data, status) {
            console.log('test',data);
            var data = JSON.parse(data)
            var photo = data['photo']
            var video = data['video']
            var pdf   = data['case_pdfversion']
            var is_endosmart = data['is_endosmart']
            console.log('photo',photo, video, pdf, is_endosmart);
            if(is_endosmart == 'true'){
                $(`#pdf_type${num_id}`).on('mousedown', unclickable)
            }

            if(photo != null && photo != undefined && is_endosmart == 'false'){
                photo.forEach(p => {
                    if(p['ns'] > 0){
                        var img_src = is_endosmart=='true' ? `` : `{{@$store_url}}${hn}/${date}/${p['na']}`
                        $(`#photo_div${num_id}`).append(`
                            <div class="col-6 mt-4">
                                <img src="${img_src}" class="img-fluid" alt="">
                            </div>
                        `)
                    }
                });
            } else if(photo != null && photo != undefined && is_endosmart == 'true'){
                photo.forEach(p => {
                    if(p.includes(hn) ){
                        $(`#photo_div${num_id}`).append(`
                        <div class="col-6 mt-4">
                            <img src="${p}" class="img-fluid" alt="">
                        </div>
                        `)
                    }

                });
            }

            if(video != null && video != undefined){
                video.forEach(v => {
                var vdo_src = `{{@$store_url}}${hn}/${date}/vdo/${v}`
                    $(`#video_div${num_id}`).append(`
                        <div class="col-12 mt-4">
                            <video class="vdo-div"  controls>
                                <source src="${vdo_src}">
                            </video>
                        </div>
                    `)
                });
            }
            // เรียก pdf ตรงนี้
            if(pdf != null && pdf != undefined && is_endosmart == 'false'){

                $(`#pdf_type${num_id}`).prop('disabled', false)
                var pdf_lg = pdf.length
                var latest_pdf = pdf[pdf_lg - 1]
                var pdf_name   = latest_pdf['pdf']
                var pdf_src    = `{{@$store_url}}${hn}/${date}/pdf/${pdf_name}`
                console.log(pdf_src, "bankkkkkkkkkkkkkk");

                $(`#iframepdf${num_id}`).css('display', 'block').prop('src', pdf_src)
            } else if(pdf != null && pdf != undefined && is_endosmart == 'true'){
                // $('#iframepdf').css('display', 'block').prop('src', pdf[0])
                $(`#iframepdf${num_id}`).css('display', 'none')
                pdf.forEach((e, i) => {
                    let split = e.split('/')
                    let max_count = split.length
                    let last_item = split[max_count-1]
                    let last_item_split = last_item.split('-')
                    if(last_item_split[1].includes(hn)){
                        $(`#endosmart_report${num_id}`).append(`
                        <img class="mt-3" style="width:100%; height: 1000px" src="${e}">
                        `)
                    }
                })
            } else {
                $(`#pdf_type${num_id}`).prop('disabled', true)
            }

            swal.close()
            console.log($(`#compare${case_id}`));
            $(`#compare${case_id}`).prop('checked', true)

            function unclickable(){
                return false
            }
        })
    }

    // let closeCanvas = document.querySelector('[data-bs-dismiss="offcanvas"]');
    var firstcanvas = document.getElementById('offcanvasRight')
    var secondcanvas = document.getElementById('offcanvasLeft')
    var bs_firstcv  = new bootstrap.Offcanvas(firstcanvas)
    var bs_secondcv = new bootstrap.Offcanvas(secondcanvas)

    $('.open-offcanvas').on('click', function (e) {
        let _id = $(this).data('id')
        let hn = $(`#tr${_id}`).data('hn')
        let date_only = $(`#tr${_id}`).data('date')
        let endosmart = $(`#tr${_id}`).data('endosmart')
        open_detail(hn, _id, date_only, endosmart, '', false)
        bs_firstcv.show()
    })


    $('.compare').on('click', function (e) {
        let count = 0
        for (let i = 0; i < $('.compare').length; i++) {
            let is_checked = $($('.compare')[i]).is(':checked')
            if(is_checked){
                count += 1
            }
        }

        if(count >= 2){
            $('.btn-compare').prop('disabled', false)
        } else {
            $('.btn-compare').prop('disabled', true)
        }

        if(count > 2){
            e.preventDefault()
        }
    })

    function call_alert(type){
        options = []
        if(type == 'load'){
            options['text'] = 'Loading...'
            options['icon'] = 'info'
            options['allowOutsideClick'] = false
            options['allowEscapeKey'] = false
            options['showConfirmButton'] = false
        }
        Swal.fire(options)

    }

    function clear_ck(){
        for (let i = 0; i < $('.compare').length; i++) {
            $($('.compare')[i]).prop('checked', false)
        }
    }

    function set_default(num_id='') {
        let names = ['report', 'photo', 'video']
        for (let i = 0; i < 3; i++) {
            $(`#btn_${names[i]}${num_id}`).removeClass('active')
            $(`#${names[i]}_viewer${num_id}`).removeClass('active')
        }

        $(`#btn_report${num_id}`).addClass('active')
        $(`#report_viewer${num_id}`).addClass('active')
    }

    function compare_detail(){
        let count = 0
        let ck_arr = []
        for (let i = 0; i < $('.compare').length; i++) {
            let is_checked = $($('.compare')[i]).is(':checked')
            if(is_checked){
                let _id = $($('.compare')[i]).data('id')
                ck_arr.push(_id)
                let num_id;
                if(count == 0){
                    num_id = 2
                    count += 1
                } else {
                    num_id = ''
                }

                let hn = $(`#tr${_id}`).data('hn')
                let date = $(`#tr${_id}`).data('date')
                let endosmart = $(`#tr${_id}`).data('endosmart')
                console.log(hn, date, endosmart, num_id);
                open_detail(hn, _id, date, endosmart, num_id, true)
            }
        }

        bs_firstcv.show()
        bs_secondcv.show()
        // console.log('fff');
        // for (let i = 0; i < ck_arr.length; i++) {
        //     $(`#compare${ck_arr[i]}`).prop('checked', true)
        // }
        // console.log('ffffg');
    }

</script>

<script>

</script>


{{-- <script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    const getBase64StringFromDataURL = (dataURL) => dataURL.replace('data:', '').replace(/^.+,/, '');

    _initCornerstoneImageLoader()
    _initCornerstoneWADOImageLoader()


    // // Init cornerstone tools
    cornerstoneTools.init();

    var img_lg = $('.image-list-img').length
    for(i=0; i<img_lg;i++){
        let src = $($(".image-list-img")[i]).attr('src')
        // enable element
        let element = document.getElementById(`dicom${i}`)
        cornerstone.enable(element)
        cornerstone.loadImage(`wadouri:${src}`).then(function(image) {
            cornerstone.displayImage(element, image);
        });
    }

    function _initCornerstoneImageLoader() {
        cornerstoneWebImageLoader.external.cornerstone = cornerstone;
    }

    function _initCornerstoneWADOImageLoader() {
        let baseUrl = 'https://tools.cornerstonejs.org/examples/'

        cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
        cornerstoneWADOImageLoader.external.dicomParser = dicomParser;
        // Image Loader
        const config = {
            webWorkerPath: `${baseUrl}assets/image-loader/cornerstoneWADOImageLoaderWebWorker.js`,
            taskConfiguration: {
            decodeTask: {
                codecsPath: `${baseUrl}assets/image-loader/cornerstoneWADOImageLoaderCodecs.js`,
            },
            },
        };
        cornerstoneWADOImageLoader.webWorkerManager.initialize(config);
    }
</script> --}}


@endsection
