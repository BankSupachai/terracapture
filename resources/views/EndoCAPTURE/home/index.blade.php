@php
$view['doctor']         = $doctor;
$view['procedure']      = $procedure;
$view['config']         = $config;
@endphp
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .Registered{
        s_class = 'label label-warning label-pill label-inline mr-2';
    }
    if (el.case_status == ' Operation  ') {
        s_class = 'label label-info label-pill label-inline mr-2';
    }
    if (el.case_status == ' Reported ') {
        s_class = 'label label-success label-pill label-inline mr-2';
    }
</style>

<style>
    @media (min-width: 992px) {
        .header-fixed.subheader-fixed.subheader-enabled .wrapper {
            padding-top: 65px;
        }

        .table_mobile {
            display: none;
        }
    }
    :is([data-layout=vertical], [data-layout=semibox])[data-sidebar=dark] .navbar-nav .nav-link {
        color: #ffffff80 ;
    }

    .list-table.active{display: block;padding-bottom: 2em;}
    #AllCases tr td:nth-child(1),#AllCases tr td:nth-child(2){width: 8% !important;}
    #AllCases tr td:nth-child(3){width: 8% !important;}
    #AllCases tr td:nth-child(4){width: 10% !important;}
    #AllCases tr td:nth-child(5){width: 8% !important;}
    #AllCases tr td:nth-child(6){width: 8% !important;}
    #AllCases tr td:nth-child(7){width: 8% !important;}
    #AllCases tr td:nth-child(8){width: 12% !important;}
    #AllCases tr td:nth-child(9){width: 8% !important;}
    #AllCases tr td:nth-child(10){width: 8% !important;}
    #AllCases tr td:nth-child(11){width: 8% !important;}
    .table-today tr td:nth-child(1), .table-today tr td:nth-child(2){width: 8% !important;}
    .table-today tr td:nth-child(3){width: 8% !important;}
    .table-today tr td:nth-child(4){width: 10% !important;}
    .table-today tr td:nth-child(5){width: 8% !important;}
    .table-today tr td:nth-child(6){width: 8% !important;}
    .table-today tr td:nth-child(7){width: 8% !important;}
    .table-today tr td:nth-child(8){width: 12% !important;}
    .table-today tr td:nth-child(9){width: 8% !important;}
    .table-today tr td:nth-child(10){width: 8% !important;}
    .table-today tr td:nth-child(11){width: 8% !important;}
    .status{padding: 3px 7px;font-size: small;border-radius: 5px;}
    .status-success{background: #0ab39c49;color: #0AB39C;}
    .status-danger{background: #FBEFEC;color: #F06548;}

    .btn-dark-primary{
        background: #245788;
        color:white !important;
    }
    .btn-dark-primary i{
        color:white !important;
    }
    ::-webkit-scrollbar {
        width: 5px !important;
        height: 5px !important;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1 !important;
    }
    ::-webkit-scrollbar-thumb {
        background: #888 !important;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #a5a5a5 !important;
    }
    .btn-dark-primary:hover{
        background: #28345c;
    }

    table, th {
        color: #9599AD;
    }
    table, th tr{
        z-index: 1;
    }

    table tr {
        vertical-align: middle;
    }

    .alltodaycase-header{
            overflow: auto;
            height: 52.3vh;

         }
        .alltodaycase-header  thead tr {
            position: sticky;
            top: 0px;
            z-index: 1;
            }

            .allcase-header{
            overflow: auto;
            height: 51.8vh;
         }
        .allcase-header  thead tr {
            position: sticky;
            top: 0px;
            z-index: 1;
            }
         table {
            border-collapse: collapse;
            width: 100%;
            overflow-x: auto;
            white-space: nowrap;
         }

         .icon-text{
            color: #299cdb;
         }
         .TextTable-header{
            color: #9599AD;
         }

         span{
            border-radius: 5px;
         }
         .btn-calendar-icon{
            color: #00000080;
         }
         .select2-container .select2-selection--single .select2-selection__arrow-container::after {
            content: '\EA4E/' ;
            font-family: 'RemixIcons';
         }

         .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: #245788;
            color: #ffffff;
            border: 0px !important;
         }
         .select2-container--default .select2-selection--multiple {
            background: #193D61;
            border: 0px !important;
         }
         .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            background: #245788;
            color: #ffffff;
         }
         .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff;
            border: 0px !important;
         }

         .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {background: #245788 !important;}
         .select2-results__option {color: #000000}




         /* .width-scroll{overflow-x: scroll;} */
         /* tr , td{min-width: 150px !important;} */
    </style>
    <link href="{{url('public/css/capture/index.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('modal')
    @include('EndoCAPTURE.home.component.modal_autocase')
    @include('EndoCAPTURE.home.component.modal_hisdetail')
    @include('EndoCAPTURE.home.component.modal_barcode')
    @include('EndoCAPTURE.home.component.modal_holiday')
    @include('EndoCAPTURE.home.component.modal_rapid')
    @include('EndoCAPTURE.home.component.modal_worklist_wait')
    @include('EndoCAPTURE.home.component.modal_worklist')
    @include('EndoCAPTURE.home.component.modal_case')
    @include('EndoCAPTURE.home.component.modal_delete')
    @include('EndoCAPTURE.home.component.modal_importlist')
    @include('EndoCAPTURE.home.component.modal_multicase')
    @include('EndoCAPTURE.home.component.modal_urease')
    {{-- @include('EndoCAPTURE.home.component.offcanvas_importlist') --}}
    @include('EndoCAPTURE.home.component.offcanvas_importHospital')
@endsection

@section('title-left')
    <h4 class="mb-sm-0">CASES LIST</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Operation</a></li>
        <li class="breadcrumb-item active">Cases list</li>
    </ol>
@endsection

@section('content')




<div class="row" style="margin: 0;">
    @if (in_array(@uget('user_type'), ['admin']))
            <div class="col-lg-12" style="padding: 1em;">
                <div class="card card-custom" style="height: 100%;">
                    <div class="card-body">
                       <h1 align="center"><font color="red">ท่านกำลังอยู่ในโหมด admin</font></h1>
                    </div>
                </div>
            </div>
    @endif
</div>

    @include("endocapture.home.component.casecount")
    {{-- @livewire('home2') --}}
    {{-- @dd($room) --}}
    <div class="row" style="margin: 0;margin-top:-0.5em;">
        <div class="col-lg-12">

            {{-- @moss($configadmin) --}}
            <div class="w-100" style="width: 100%;">
                <div class="w-100 bg-is-white p-3">
                    <div class="row m-0 cn">
                        <div class="col-lg-auto ">

                            <input id="show_joball" class="form-check-input date-type select-status" type="radio" name="event_date" value="all" id="all">
                            <label class="form-check-label" for="show_joball">
                                All Cases
                            </label>
                        </div>
                        <div class="col-auto border-end border-dark">
                            <input id="show_jobtoday" class="form-check-input date-type select-status" status="" type="radio" name="event_date" value="today" id="todaycase" checked>
                            <label class="form-check-label" for="show_jobtoday">
                                Today Cases
                            </label>
                        </div>
                        <div class="col-lg">
                            <div class="radio-inline">
                                <div id="show_jobtodaygroup" class="row m-0">
                                    <div class="col-lg-auto">
                                        <input class="form-check-input select-status" status="" type="radio" name="form_select" value="Totaltoday" id="totaltoday" checked>
                                        <label class="form-check-label" for="totaltoday">
                                            All
                                        </label>
                                    </div>
                                    <div class="col-lg-auto">
                                        <input class="form-check-input select-status" status="holding" type="radio" name="form_select" value="Holding" id="holding">
                                        <label class="form-check-label" for="holding">
                                            Holding
                                        </label>
                                    </div>
                                    <div class="col-lg-auto">
                                        <input class="form-check-input select-status" status="operation" type="radio" name="form_select" value="Operation" id="operation">
                                        <label class="form-check-label" for="operation">
                                            Operation
                                        </label>
                                    </div>
                                    <div class="col-lg-auto">
                                        <input class="form-check-input select-status" status="recovery" type="radio" name="form_select" value="Recovery" id="recovery">
                                        <label class="form-check-label" for="recovery">
                                            Recovery & Discharged
                                        </label>
                                    </div>
                                    <div class="col-lg-auto">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Calandar ที่ไม่ได้ใช้เเล้ว
                            <div class="col-lg-auto">
                            <a href="{{url('calendarcase')}}" class="btn-calendar-icon">
                                <i class="ri-calendar-event-line ri-2x"></i>
                            </a>
                        </div> -->

                    @if($configadmin->com_type!="server")
                        <div class="col-lg-auto">
                            <a href="{{url('camera')}}" class="btn btn-warning btn-label h5 text-white btn-load">
                                <i class="ri-camera-fill text-white label-icon align-middle fs-16 me-2"></i>
                                &nbsp;Test Camera
                            </a>
                        </div>
                    @endif



                        <div class="col-lg-auto p-0">
                            <a data-container="body"  data-toggle="popover" data-placement="top" data-content="Create New Case"
                            href="patient/create"
                            class="btn btn-secondary btn-label h5 text-white btn-load">
                                <i class="ri-add-fill label-icon align-middle fs-16 me-2"></i>&nbsp;Create Case
                            </a>
                        </div>
                        <div class="col-lg-auto">

                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <button id="btnGroupDrop1" type="button" class="btn btn-danger btn-label h5 text-white dropdown-toggle btn-delaytime" value="false" data-bs-toggle="offcanvas" data-bs-target="#importlisthos" aria-expanded="false">
                                    <i class="ri-download-2-line label-icon align-middle fs-16 me-2"></i> Import List
                                </button>
                                {{-- <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-danger btn-label h5 text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-download-2-line label-icon align-middle fs-16 me-2"></i> Import List
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <li><button class="dropdown-item"  data-bs-toggle="offcanvas" data-bs-target="#importlist" aria-controls="offcanvasRight">Excel</button></li>
                                        <li><button class="dropdown-item"  data-bs-toggle="offcanvas" data-bs-target="#importlisthos" aria-controls="offcanvasRight">Hospital System</button></li></li>
                                    </ul>
                                </div> --}}
                            </div>
                            {{-- <button data-bs-toggle="offcanvas" data-bs-target="#importlist" aria-controls="offcanvasRight"
                             class="btn btn-danger btn-label h5 text-white">
                                <i class="ri-download-2-line label-icon align-middle fs-16 me-2"></i>
                                &nbsp;Import List
                        </button> --}}
                        </div>
                    </div>
                </div>

                <input type="hidden" name="" id="switch_on" value="today">
                {{-- @dd($doctor) --}}
                <div class="w-100 bg-is-white">
                    @include("EndoCAPTURE.home.list-table.today")
                    @include("EndoCAPTURE.home.list-table.allcases")
                </div>

                <button id="patient_warning" hidden type="button" data-toast data-toast-text="" data-toast-gravity="top" data-toast-position="right" data-toast-duration="3000" data-toast-close="" data-toast-className="warning" class="btn btn-light w-xs">Bottom Right</button>
            </div>
        </div>
    </div>
@endsection
@section('script')


<script>
    $('#search_allcasedate').datepicker({
       format: "yyyy-mm-dd",

   });



</script>



<script src="{{asset('public/plugins/moment/moment.js')}}"></script>
<script src="{{url('assets/js/bootstrap-switch.js')}}"></script>
<script src="{{domainnameport(":3000/socket.io/socket.io.js")}}"></script>


{{-- <script type="text/javascript">
    $(window).on('load', function() {
        $('#modal_autocase').modal('show');
    });
</script> --}}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    // $(document).ready(function () {
    //     $('#importlisthos').on('show.bs.offcanvas', function () {
    //         console.log('Offcanvas is opening');
    //         clearInterval("#countdown")
    //     });

    //     $('#importlisthos').on('hide.bs.offcanvas', function () {
    //         console.log('Offcanvas is closing');
    //         // ทำสิ่งที่คุณต้องการเมื่อ Offcanvas เริ่มปิด
    //     });
    // });

    /* --------------Call modal autocase ------------------*/
    let control = 0;
    window.addEventListener('keydown', function (e) {
        if (e.key=="Control"){control++;}
        if (control==10){$('#modal_autocase').modal('show');}
    }, false);



    $(document).ready(function() {
    // Initialize countdown
        $("#countdown").show();

    var countdown = $("#countdown").countdown360({
        radius: 20.5,
        seconds: 300,
        strokeWidth: 5,
        fillStyle: '#3577f11a',
        strokeStyle: '#3577f180',
        fontSize: 16,
        fontColor: '#495057',
        fontWeight: 'normal',
        fontFamily: 'kanit',
        autostart: false,
        label: false,
        smooth: true,
        onComplete: function () {
            location.reload(true);
            // $(".auto-logout").click()
            console.log('completed');
        }
    });
    countdown.start();

    $('#importlisthos').on('show.bs.offcanvas', function () {
        console.log(countdown);

        countdown.stop();
    });

    $('#importlisthos').on('hide.bs.offcanvas', function (e) {
        console.log('Offcanvas is closing');
        if(is_ajax){
            e.preventDefault()
        }
        countdown.start();
    });

    $('#importlisthos').on('hidden.bs.offcanvas', (e) => {
        let checked_icons = $('.ri-check-double-fill').filter(function() {
            return $(this).css('display') === 'block';
        });

        if(checked_icons.length > 1){
            window.location.reload()
        }
    })
});

function getcountdown() {
    let timecurrent = $("#countdown-text").html();
    return timecurrent;
}





//         $("#countdown").show();
//         $("#countdown").countdown360({
//     radius      : 20.5,
//     seconds     : 300,
//     strokeWidth : 5,
//     fillStyle   : '#3577f11a',
//     strokeStyle : '#3577f180',
//     fontSize    : 16,
//     fontColor   : '#495057',
//     fontWeight  : 'normal',
//     fontFamily:"kanit",

//     autostart: false,
//     label: false,
//     smooth:true,
//     onComplete  : function () {

//         location.reload(true);
//         console.log('completed') }
//   }).start()






    // window.setInterval( function() {
    //     if(refreshpage){
    //         window.location.reload();
    //     }else{
    //         refreshpage = true;
    //     }
    // }, 300000);
</script>

<script>


    $("#show_jobtoday").click(function(){
        $("#job_today").show();
        $("#job_all").hide();
        $("#show_jobtodaygroup").show();
    });

    $("#today_case").prop("checked", true);
    $('#search_date').on('change', function () {
        console.log( $(this).val());
        var date_str = $(this).val()
        if(date_str.includes('to')){
            var split = date_str.split('to')
            var from  = split[0].trim()
            var to    = split[1].trim()
            $('#date_from').val(from)
            $('#date_to').val(to)
        } else {
            $('#date_from').val(date_str)
            $('#date_to').val('')
        }
        // function_search('all', all=true)
    })

</script>

    @if(isset($system->worklist)?$system->worklist:false)
        <script>
            $.post("{{url('api/worklist')}}",{
                event   : "worklistGET"
            },function(data,status){
                $("#table_worklist").html(data);
            });
        </script>
    @endif





    <script>
        $("#btn_get_worklist").click(function(){
            $("#modal_worklist_wait").modal("show");
            $.post("{{url('api/worklist')}}",{
                event   : "json2DB"
            },function(data,status){
                $("#modal_worklist_wait").modal("hide");
                $.post("{{url('api/worklist')}}",{
                    event   : "worklistGET"
                },function(data,status){
                    $("#table_worklist").html(data);
                });
            });
        });

        $(".select-status").click(function(){
            let value = $(this).val();
            console.log(value);

        });


        function render_cases(id, case_type, case_status){
            $(`#${id}_tbody`).empty()
            $.post("{{url('api/home')}}",{
                event   : "render_cases",
                type    : id,
            },function(data,status){
                var upper_id = id
                upper_id_new = upper_id.charAt(0).toUpperCase() + upper_id.slice(1);
                $(`#${upper_id_new}`).addClass('active')
                $(`#${id}_tbody`).html(data)
                $('.need-hide').hide()
            });
        }



        function get_status_num(status){
            var num = 0
            if(status  == 'Holding'){
                num = 0
            } else if(status == 'Operation'){
                num = 1
            } else if(status == 'Recovery'){
                num = 2
            } else if(status == 'Discharged'){
                num = 3
            }
            return num
        }


        function open_same_hn(case_hn, case_id, more_cases, btn_type){

            var case_type   = $('input[name="event_date"]:checked').val();
            var status_name = $('input[name="form_select"]:checked').val();
            var case_status = get_status_num(status_name);
            console.log(case_hn);

            $.post("{{url('api/home')}}",{
                event   : "same_hn_cases",
                case_hn : case_hn,
                status_name : status_name,
                type    : status_name.toLowerCase(),
                date    : '',
                btn     : btn_type
            },function(data,status){
                $('#multicase_header').empty()
                $('#multicase_header').append(data)
                $('#multicase').modal('show')

            });
        }

        function close_case(case_hn, case_procedure, case_id){
            $('#modal_case').modal('hide')
            $('#modal_delete').modal('show')
            $('#span_hn').html(case_hn)
            $('#span_procedure').html(case_procedure)
            $('#del_caseid').val(case_id)
        }

        function set_search_empty(){
            $('.search_name').val('')
            $('.search_doctor').val('').change()
            $('.search_procedure').val('').change()
        }
    </script>






    <script>
    $("#datepickerrange").on("change", function() {
        var fromdate = $(this).val();
    });
    $("#btnbarcode").click(function() {
        $("#showbarcode").html('');
        setTimeout(function(){
            $("#barscan").focus();
        }, 1000);
    });

    if (typeof module !== 'undefined') {
        module.exports = KTLayoutStretchedCard;
    }

    $("#bt_search").hide();
    $("#no_bt_search").show();
    $(".ck_search").click(function() {
        $("#bt_search").toggle();
        $("#no_bt_search").toggle();
    });

    $('#his_submit').click(function(){
        var count_if    = 0;
        var surgeon     = $('#patient_surgeon').val();
        var his_id      = $('#patient_hisid').val();
        var allVals     = [];
        var operation   = $('[class=patient_operation]:checked').each(function() {allVals.push($(this).val());});
        var obj = JSON.stringify(allVals);

        if(obj=="[]"){
            alert('กรุณาเลือก Procedure');
            count_if++;
        }

        if(surgeon==null){
            alert('กรุณาเลือก แพทย์');
            count_if++;
        }

        if(count_if==0){
            $('#modal_hisdetail').modal('hide');
            $('#modal_progress').modal('show');
            $('#form_hisconnet').submit();
        }
    });
</script>

<script>


    $('.datasearch').on("focusout keyup change",function(){searchall();});
    $("#click_show_all").click(function(){
        $("#switch_on").val("allday");
        searchall();
    });
    $("#click_show_today").click(function(){
        $("#switch_on").val("today");
        searchall();
    });


    var date_now = "{{date('Y-m-d')}}";
    var this_url = "{{url("")}}";

    $('#click_show_his').click(function(){
        $.get("{{url('hisconnect/appoint')}}",{},
            function(data, status) {
                console.log(data);
                var json = JSON.parse(data);
                var table_his = '';
                $("#show_his").html("");
                json.forEach(el => {
                    var json2 = JSON.parse(el.his_json);
                    table_his+= "<tr>";
                    table_his+= "<td>"+el.his_id+"</td>";
                    table_his+= "<td>"+el.his_hn+"</td>";
                    table_his+= "<td>"+json2.PTNAME+"</td>";
                    table_his+= "<td>"+json2.MALE+"</td>";
                    table_his+= "<td>"+json2.AGE+"</td>";
                    table_his+= "<td>"+json2.OPERATION+"</td>";
                    table_his+= "<td>"+json2.SURGEON+"</td>";
                    table_his+= "<td class='text-center'>";
                    table_his+= "<button type='button' value='"+el.his_id+"' class='btn btn-success btn-sm modalHIS'>";
                    table_his+= "<i class='fas fa-folder-plus'></i> Create</button>";
                    table_his+= "</td></tr>";
                });
                $("#show_his").html(table_his);
                new_reload();
                $('.modalHIS').click(function(){
                    var his_id = $(this).val();
                    showdetail_patient(his_id);
                    $('#modal_hisdetail').modal('show');
                });
        });

    })


    $('.modalbook').click(function(){
        var bookid = $(this).attr('bookid');
        showdetail_patientbook(bookid);
        $('#modal_hisdetail').modal('show');
    });


    function showdetail_patient(his_id){
        $.post("{{ url('api/home') }}", {
            event   : "his_detail",
            his_id  : his_id,
        },function(data, status) {
            changemodal(data);
        });
    }


    function showdetail_patientbook(book_id){
        $.post("{{url('api/home')}}", {
            event   : "book_detail",
            book_id : book_id,
        },function(data, status) {
            changemodal(data);
        });
    }


    function changemodal(data){
        var json01 = JSON.parse(data);
        var json02 = JSON.parse(json01.his_json);
        var json03 = json01.operation;
        $('#patient_hn').html(json02.HN);
        $('#patient_name').html(json02.PTNAME);
        $('#patient_gender').html(json02.MALE);
        $('#patient_age').html(json02.AGE);
        $('#patient_righttotreatment').html(json02.PTTYPE_NAME);
        $('#righttotreatment').val(json02.PTTYPE_NAME);
        $('#patient_prediagnostic').html(json02.DIAG)
        $('#patient_surgeon').val(json01.doctorID);
        $('#patient_hisid').val(json01.his_id);

        $('.patient_operation').prop('checked', false);
        json03.forEach(el =>{$('#pro'+el).prop('checked',true);});
        $('#formtype').val(json01.formtype);
    }

    $(document).ajaxSuccess(function() {
        $('[data-toggle="popover"]').popover();
    });


function new_reload(){
    $(".btn_send_val").click(function(){
        $("#create_his_auto").val($(".btn_send_val").val());
        $("#create_his_auto").click();
    });
}
</script>

<script>
    @php
        $comname = getCONFIG('admin')->com_name;
    @endphp
</script>

<script>
    @if($comname!="endocapture")
        @if(configTYPE("admin","system_semi"))
        setInterval(function(){
            $.post("{{url('synchronize')}}",{},
            function(data,status){
                console.log(data);
                if(data=="true"){
                    location.reload();
                }
            });
            console.log("Connect server success!!!");
        }, 10000);
        @endif
    @else
        setInterval(() => {
            $.post('send2cloud',{
                event:"book"
            },function(data,stutus){
                console.log('send2cloud',data);
            });

            $.get('send2cloud',{cloud2book:"true"},function(data,stutus){});
        }, 10000);
    @endif
</script>



<script>
    var KTBootstrapSwitch = function() {
    var demos = function() {$('[data-switch=true]').bootstrapSwitch();};
    return {init: function() {demos();},};
    }();





    $("#btn_holiday").click(function(){
        var c_date_holiday = $(".date_holiday").length
        var holiday = "<tr id='tr_"+c_date_holiday+"'>"
            holiday+= "<td><input type=\"text\" name=\"holiday_day_off[]\" class=\"form-control date_holiday new_date_holiday\" required id='new_date_holiday"+c_date_holiday+"'></td>"
            holiday+= "<td><input type=\"text\" name=\"holiday_tittle[]\" class=\"form-control\" required></td>"
            holiday+= "<td><textarea class=\"form-control\" name=\"holiday_detail[]\" rows=\"1\"></textarea></td>"
            holiday+= "<td><button type=\"button\" class='btn btn-danger' onclick='del_tr("+c_date_holiday+")'><i class='far fa-trash-alt'></i></button></td>"
            holiday+= "</tr>"
            $("#add_holiday").append(holiday)
            KTBootstrapSwitch.init();
            $("#new_date_holiday"+c_date_holiday).datepicker({format: 'yyyy-mm-dd'});
    })
    function del_tr(data){
        $("#tr_"+data).remove()
    }



    $(".config_type").focusout(function(){
        var value       = $(this).val();
        var id          = $(this).attr('id');
        var config_type = $(this).attr('config_type');
        $.post("{{url('superadmin')}}",{
            event       : "config_type",
            config_type : config_type,
            id          : id,
            value       : value,
        },function(data, status){});
    });

    $(".configtext").focusout(function(){
        var value   = $(this).val();
        var id      = $(this).attr('id');
        $.post("{{url('jquery')}}",{
            event   : "configtext",
            id      : id,
            value   : value,
        },function(data, status){});
    });

    $('.config_option').click(function(){
        var id              = $(this).attr('id');
        var config_type     = $(this).attr('config_type');
        var value           = true;
        if($(this).prop("checked")==false){value='false';}
        $.post("{{url('jquery')}}",{
            event           : "configcheck",
            id              : id,
            config_type     : config_type,
            value           : value,
        },function(data, status){console.log(data);});
    });



var KTSelect2 = function() {
 var demos = function() {
  $('#doctor').select2({
   placeholder: "Select doctor",
   allowClear: true
  });
 }
 // Public functions
    return {
        init: function() {
            demos();
        }
    };
}();
KTSelect2.init();


</script>

@if(configTYPE("admin","api_token_update"))
<script>
    function createCookie(name,value,days) {
        if (days) {
                var date = new Date();
                date.setTime(date.getTime()+(days*24*60*60*1000));
                var expires = "; expires="+date.toGMTString();
        }
        else var expires = "";
            document.cookie = name+"="+value+expires+"; path=/";
        }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        createCookie(name,"",-1);
    }





</script>
@endif



<script>
    //Semi
    setInterval(() => {
        $.post("{{url("api/semi")}}",{event:"checktempin"},function(d,s){console.log(d);});
    }, 10000);
</script>




<script>
    var socket = io.connect("{{domainnameport(":3000")}}");
    var now = moment().format('YYYY-MM-DD')
</script>

@if($configadmin->com_type=="server")
<script>
    $('#update_worklist_btn').on('click', function () {
        get_worklist_warning()
        // $.post("{{url("api/worklist")}}",{
        //     event : "getworklistsiph"
        // },function(d,s){
        //     get_worklist()
        // });
    });
</script>
@else
<script>
    $('#update_worklist_btn').on('click', function () {
        // socket.emit('chat message','getworklist');
        get_worklist_warning()
    });
</script>
@endif

<script>

    function get_worklist_warning(){
        $('#loading_worklist').css('display', 'block')
        $('.wk-warning').css('display', 'none')

        $.post("{{ url('api/recorder') }}", {
            event: "checkport",
            comname: "{{ @$pacs->pacsserver }}",
            port: "{{ @$pacs->port }}",
        }, function(d, s) {
            const obj = JSON.parse(d);
            console.log('port', obj.status);
            if (obj.status) {
                // $("#"+id_prefix+comname).html('&ensp; &nbsp;<i class="ri-checkbox-circle-fill text-success"></i>')
                $.post("{{url("api/worklist")}}",{
                    event : "getworklistsiph"
                },function(d,s){
                    get_worklist()
                });
            } else {
                // alert("เชื่อมต่อไม่สำเร็จ");
                $('.wk-warning').css('display', 'block')
                $('#loading_worklist').css('display', 'none')

            }
        });
    }

    $("#btn_update_appoint").on('click', function () {
        // พุทธชิน
        $.post("{{url("appointment")}}",{
            event : "getappointment",
        },function (data,status) {
            get_worklist();
            // $("#table_appointment").html(data);
        });
    });

    socket.on('chat message', function (msg) {
        // console.log('msg', msg);
        if(msg.includes('finish_worklist')){
            get_worklist()
        }
    })

    function get_worklist(){
        let only_colpo = 'false'
        if($(`#only_colpo`) != undefined){
            only_colpo = $(`#only_colpo`).is(':checked') ? 'true' : 'false'
        }

        $('#worklist_tbody').empty()
        $.post("{{url('api')}}/siphconnect", {
            event: 'get_worklist',
            date : now,
            department: "{{@uget('department')}}",
            only_colpo: only_colpo,
        }, function (data, status) {
            console.log(data, status);
            // let parse = JSON.parse(data)
            let parse = JSON.parse(data)
            let html = parse['html']
            let count = parse['wl_count']
            // console.log(parse, parse['html']);
            $('#worklist_tbody').append(html)
            $('#loading_worklist').css('display', 'none')
            $('#action_btn_div').css('display', 'block')

        })
    }

    function edit_worklist(index, this_element) {
        // console.log(index, 'dd', $(this_element).attr('class'));
        let need_edit   = $(this_element).hasClass('btn-warning')
        let text_status = ''
        let sel_status  = ''
        if(need_edit){
            // select need to show -> text hide
            // text_status = 'none'
            text_status = 'block'
            sel_status  = 'block'
            $(this_element).removeClass('btn-warning').addClass('btn-success')
            // get text value to select
            let user_text = $(`#doctorname_${index}`).text()
            let procedure_text = $(`#procedure_${index}`).html()
            set_edit_select(user_text, procedure_text, index)
        } else {
            // select need to hide -> text show instead
            text_status = 'block'
            sel_status  = 'none'
            $(this_element).removeClass('btn-success').addClass('btn-warning')
            // get selected value then set that value to text span
            let user_select = $(`#user${index}`).find(':selected').val()
            let procedure_select = $(`#procedure${index}`).val()
            set_edit_text(user_select, procedure_select, index)
        }

        $(`#procedurestr_${index}`).css('display', 'none')
        $(`#doctorname_${index}`).css('display', text_status)
        $(`#userdiv${index}`).css('display', sel_status)
        $(`#procedure_${index}`).css('display', text_status)
        $(`#procedurediv${index}`).css('display', sel_status)

    }

    function set_edit_text(user_select, procedure_select, index){
        // console.log(user_select, procedure_select);
        if(user_select != ''){
            $(`#doctorname_${index}`).html(user_select)
        }

        if(procedure_select.length > 0){
            let proc_text = procedure_select.join("<br>")
            $(`#procedure_${index}`).html(proc_text)
        }
    }

    function set_edit_select(user_text, procedure_text, index) {
        // console.log(user_text, procedure_text, index);
        if(user_text != ''){
            if(user_text.includes('.')){
                user_text = user_text.split('.')[1]
            }
            user_text = user_text.trim()
            let find_option = $(`#user${index} option:contains('${user_text}')`).val()
            $(`#user${index}`).val(find_option).trigger('change')
        }

        let proc_sel = []
        if(procedure_text != ''){
            // let proc_sel = $(`#procedure_${index}`).data('procedurestr')
            if(procedure_text.indexOf('And') > -1){
                proc_sel = procedure_text.split('And').map(function(item) {return item.trim() });
            } else {
                proc_sel = procedure_text.split('<br>').map(function(item) {return item.trim()})
            }

            $(`#procedure${index}`).val(proc_sel).trigger('change')
        }

    }

    var is_ajax = false

    function import_case(index) {
        $('#upload_all_btn').prop('disabled', true)
        console.log(index);
        $(`#procwarning_${index}`).css('display', 'none')
        let this_tr = $(`#worklist${index}`)
        let hn      = this_tr.data('hn')
        let patientname  = this_tr.data('patientname')
        // let doctorname   = $(`#user${index}`).find(':selected').val()
        let doctorname   = $(`#user${index} option:selected`).data('doctorid')
        // let procedure    = $(`#procedure${index}`).val()
        // let procedure    = [$(`#procedure${index}`).find(':selected').data('procedure')]
        let procedure = []
        let procedure_arr  = $(`#procedure${index} option:selected`).each(function() {
                                procedure.push($(this).data('procedure'))
                            });
        let time = this_tr.data('time')

        let prediagnosis = this_tr.data('prediagnosis')
        let accessionnumber = this_tr.data('accessionnumber')
        let patienteng   = this_tr.data('patienteng')
        let visitno      = this_tr.data('visitno')
        let useropen = "{{@uid()}}";
        console.log(procedure, doctorname, hn, patientname);
        console.log((hn != "" && hn != undefined) , (patientname != "" && patientname != undefined) , (procedure != undefined && procedure != "") , (doctorname != undefined && doctorname != "")) ;
        if((hn != "" && hn != undefined) && (doctorname != "" && doctorname != "none" &&  doctorname != undefined) && (patientname != "" && patientname != undefined) && (procedure != undefined && procedure != "")){
            $(`#istart${index}`).hide();
            // $(`#isuccess${index}`).show();
            $(`#isloading${index}`).show();
            is_ajax = true

            $(`#importwk${index}`).css('background', 'transparent')
            $(`#importwk${index}`).css('border', 'transparent')
            console.log('rrrrr');
            $(`#importwk${index}`).prop('disabled', true)
            $.post('{{url("api")}}/siphconnect', {
                event: 'import_caseworklist',
                hn: hn,
                patientname: patientname,
                useropen:useropen,
                doctorname: doctorname,
                procedure: procedure,
                prediagnosis: prediagnosis,
                accessionnumber: accessionnumber,
                patienteng: patienteng,
                visitno: visitno,
                time: time,
                from:"worklist"
            }, function (data, status) {
                is_ajax = false
                $('#upload_all_btn').prop('disabled', false)

                let parse = JSON.parse(data)
                let text  = parse['text']
                if(text == 'success'){
                    $(`#isloading${index}`).hide();
                    $(`#isuccess${index}`).show();

                    // $(`#istart${index}`).hide();
                    // $(`#isuccess${index}`).show();
                    // $(`#importwk${index}`).css('background', 'transparent')
                    // $(`#importwk${index}`).css('border', 'transparent')

                } else if(text == 'error') {
                    $(`#patient_warning`).attr('data-toast-text', 'Import Error')
                    $('#patient_warning').click()
                    $(`#importwk${index}`).prop('disabled', false)
                }
            })
        } else if(procedure == undefined || procedure == "") {
            $(`#procwarning_${index}`).css('display', 'block')
        } else if(doctorname == undefined || doctorname == "" || doctorname == "none") {
            $(`#userwarning_${index}`).css('display', 'block')
        }

    }

    function change_proc(index){
        let proc_sel = $(`#procedure${index}`).val()
        if(proc_sel !=  undefined && proc_sel != ''){
            if(proc_sel.length == 0){
                $(`#procwarning_${index}`).css('display', 'block')
            } else if(proc_sel.length >= 1) {
                $(`#procwarning_${index}`).css('display', 'none')
            }
        }

    }

    function change_user(index){
        let user_sel = $(`#user${index}`).val()
        if(user_sel !=  undefined && user_sel != ''){
            if(user_sel.length == 0){
                $(`#userwarning_${index}`).css('display', 'block')
            } else if(user_sel.length >= 1) {
                $(`#userwarning_${index}`).css('display', 'none')
            }
        }

    }


</script>

<script>
    var count = "{{count($case_worklist)}}"
    for (let j = 0; j < parseInt(count); j++) {
        let index_id = `${j}A`
        $(`#user${index_id}`).select2({placeholder: '   User', dropdownParent: $(`#userdiv${index_id}`)});
        $(`#procedure${index_id}`).select2({placeholder: '   Procedure', dropdownParent: $(`#procedurediv${index_id}`)});
        $(`#userdiv${index_id}`).show()
    }
</script>


<script>
    /** Waiting Document **/
    //semi masterdata
    setTimeout(() => {
        $.post("{{url("api/semi")}}",{event:"comparemasterdata"},function(d,s){});
        $.get("{{url("mongodb/backup/export")}}",{},function(d,s){});
    }, 5000);
</script>





@endsection

@include("admin.pagedetail")
