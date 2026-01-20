@extends('layouts.app')
@section('title', 'EndoBook')
@section('style')
{{-- <link rel="stylesheet" type="text/css" href="{{url('public/css/booking/index.css')}}"> --}}
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquery.datetimepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquerysctipttop.css')}}">
<link href="{{url('public/sample/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />

<style>
    body{
        background: #F7F7F7;
    }
    .bg-gray{
        background: #EBEBEB;
        width: 100%;
    }
    .bg-head-book{
        background: #D6D6D6;
    }
    .bg-head-book .col-8,.bg-head-book .col-4{
        font-weight: 600;
        font-size: 1.4em;
    }
    .table-bordered td{
        text-align: center;
        background: #F2F2F2;
    }
    .btn-book{
        font-size: 1.3em;
        padding: 0.8em;
    }
    .table-dark th{
        border: none !important;
    }
    .box{
        width: 1.2em;
        height: 1.2em;
    }
    .w-2{
        width: 2em;
    }
    .w-f{
        width: 15em;
    }
    .border-gray td{
        border-color: #c2c0c0;
        padding: 2px;
    }

    .btn-book{
        font-size: 1.2em;
        background: #9DA8CB;
        width: 100%;
        height: 3em;
        color: #fff !important;
        box-shadow: 0 5px 7px #d6d0d0;
    }
    .btn-book-mini{
        font-size: 1.2em;
        background: #9DA8CB;
        width: 100%;
        color: #fff !important;
        box-shadow: 0 5px 7px #d6d0d0;
    }
    .btn-book:hover,.btn-book-mini:hover{
        background: #7f89aa;
    }
    #table_deader td:nth-child(1){width: 25%;}
    /* #table_deader td:nth-child(3){width: 10%;} */


    .checkbox.checkbox-outline.checkbox-success > span {
        background-color: #fff;
    }
    .radio.radio-outline.radio-info > span {
        background-color: #fff;
    }
    .cn{
        align-items: center;
    }
</style>
@endsection

@section('modal')
    @include("EndoBOOK.booking.modal.modal_form_bookrecord")
@endsection

@section('content')

<div class="row m-0 px-5">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body p-1">
                <table class="table table-borderless mb-0" id="table_deader">
                    <form action="{{url("book/booking")}}" method="post">
                        @method('GET')
                        @csrf
                        <input type="hidden" name="event" value="calculate">
                        <tr>
                            <td colspan="2">

                                <button type="submit" class="btn
                                @if(!isset($arrwork))
                                 btn-light
                                @else
                                 btn-primary
                                @endif
                                 w-100 p-3 h2" id="submit_search"><p class="m-0"><i class="fa fa-search icon-lg"></i></p>Search </button>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Physician</b><b class="text-danger">*</b></td>
                            <td>
                                <div class="row m-0">
                                    <div class="col px-0">
                                        @if(Auth::user()->user_type =='doctor')
                                            <b>{{@Auth::user()->user_prefix}} {{@Auth::user()->user_firstname}} {{@Auth::user()->user_lastname}}</b>
                                            <input type="hidden" name="physician" id="physician" value="{{@Auth::user()->id}}">
                                        @else
                                            <select name="physician" id="physician2" class="form-control select2" required
                                            oninvalid="this.setCustomValidity(this.willValidate?'':'กรุณาเลือกแพทย์')"
                                            onchange="check_select()">
                                                <option value="">เลือกแพทย์</option>
                                                @foreach($physician as $data)
                                                    <option value="{{$data->id}}" @if(@$form_doctor=="$data->id") selected @endif>
                                                        {{$data->user_prefix}}{{$data->user_firstname}} {{$data->user_lastname}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Department :</b></td>
                            <td>
                                <b>GI Scope</b>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Patient Type</b><b class="text-danger">*</b></td>
                            <td>
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="patient_type" value="service"
                                        @if(@$form_patient_type=='service'|| !isset($form_patient_type)) checked @endif  onchange="check_select()">
                                        <span></span>
                                        Service
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="patient_type" value="special"
                                        @if(@$form_patient_type=='special') checked @endif
                                        onchange="check_select()">
                                        <span></span>
                                        Special
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="patient_type" value="premium"
                                        @if(@$form_patient_type=='premium') checked @endif
                                        onchange="check_select()">
                                        <span></span>
                                        Premium
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><b>Period</b><b class="text-danger">*</b></td>
                            <td>
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="period" value="am"
                                        @if(@$form_period=='am'|| !isset($form_period)) checked @endif
                                        onchange="check_select()">
                                        <span></span>
                                        AM.
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="period" value="pm"
                                        @if(@$form_period=='pm') checked @endif
                                        onchange="check_select()">
                                        <span></span>
                                        PM.
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="period" value="ot"
                                        @if(@$form_period=='ot') checked @endif
                                        onchange="check_select()">
                                        <span></span>
                                        OT.
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Urgent </b><b class="text-danger">*</b></td>
                            <td>
                                <div class="radio-inline">
                                    <label class="radio">
                                        <input type="radio" name="urgent" value="elective"
                                        @if(@$form_urgent=='elective'|| !isset($urgent)) checked @endif
                                        onchange="check_select()">
                                        <span></span>
                                        Elective.
                                    </label>
                                    <label class="radio">
                                        <input type="radio" name="urgent" value="urgency"
                                        @if(@$form_urgent=='urgency') checked @endif
                                        onchange="check_select()">
                                        <span></span>
                                        Urgency.
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><b>Procedure</b><b class="text-danger">*</b></td>
                            <td>
                                <div class="row m-0">
                                    <div class="col-12 py-1">
                                        <select name="procedure[]" id="procedure01" class="form-control form-control-sm" required
                                        oninvalid="this.setCustomValidity(this.willValidate?'':'กรุณาเลือกหัตถการ')" onchange="check_select()">
                                            <option value="">Procedure 1</option>
                                            @foreach($procedure as $data)
                                                <option value="{{$data->procedure_code}}"
                                                    @if($data->procedure_code==@$form_procedure[0] ) selected @endif
                                                    >
                                                    {{$data->procedure_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 py-1">
                                        <select name="procedure[]" id="procedure02" class="form-control form-control-sm" onchange="check_select()">
                                            <option value="">Procedure 2</option>
                                            @foreach($procedure as $data)
                                                <option value="{{$data->procedure_code}}"
                                                    @if($data->procedure_code==@$form_procedure[1] ) selected @endif
                                                    >
                                                    {{$data->procedure_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 py-1">
                                        <select name="procedure[]" id="procedure03" class="form-control form-control-sm" onchange="check_select()">
                                            <option value="">Procedure 3</option>
                                            @foreach($procedure as $data)
                                                <option value="{{$data->procedure_code}}"
                                                    @if($data->procedure_code==@$form_procedure[2] ) selected @endif
                                                    >
                                                    {{$data->procedure_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 py-1">
                                        <select name="procedure[]" id="procedure04" class="form-control form-control-sm" onchange="check_select()">
                                            <option value="">Procedure 4</option>
                                            @foreach($procedure as $data)
                                                <option value="{{$data->procedure_code}}"
                                                    @if($data->procedure_code==@$form_procedure[3] ) selected @endif >
                                                    {{$data->procedure_name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Anesth</b></td>
                            <td>
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="procedure_ex[]" {{checkarr(@$procedure_ex_select,"anes01")}} value="anes01" id="ga"/>
                                        <span></span>
                                        GA
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="procedure_ex[]" {{checkarr(@$procedure_ex_select,"anes02")}} value="anes02" id="sedation"/>
                                        <span></span>
                                        Sedation
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="procedure_ex[]" {{checkarr(@$procedure_ex_select,"anes03")}} value="anes03" id="la"/>
                                        <span></span>
                                        LA
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Special</b></td>
                            <td>
                                <div class="checkbox-inline">
                                    <label class="checkbox">
                                        <input type="checkbox" name="procedure_ex[]" {{checkarr(@$procedure_ex_select,"equ01")}} value="equ01" id="flu"/>
                                        <span></span>
                                        Flu
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="procedure_ex[]" {{checkarr(@$procedure_ex_select,"equ02")}} value="equ02" id="spyglass"/>
                                        <span></span>
                                        Spyglass
                                    </label>
                                    <label class="checkbox">
                                        <input type="checkbox" name="procedure_ex[]" {{checkarr(@$procedure_ex_select,"equ03")}} value="equ03" id="laser"/>
                                        <span></span>
                                        Laser
                                    </label>
                                </div>
                            </td>
                        </tr>


                    </form>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-9 mt-2">
        <div class="row m-0">
            <div class="col-12 px-0">
                <div class="row m-0">

                </div>
            </div>
            <div class="col-12 pr-0">
                @php
                    use Carbon\Carbon;
                @endphp
                <div class="card">
                    <div class="card-body">
                        <div id="kt_calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function check_select(){
        var procedure1 = $("#procedure01").val()
        var procedure2 = $("#procedure02").val()
        var procedure3 = $("#procedure03").val()
        var procedure4 = $("#procedure04").val()
        var physician2 = $("#physician2").length
        if(physician2===1){
            var checking = false
            if($("#physician2").val()!=''){
                checking = true
            }
        }else{
            checking = true
        }
        if((procedure1!=''||procedure2!=''||procedure3!=''||procedure4!='') && checking){
            $('#submit_search').removeClass('btn-light').addClass('btn-primary')
        }else{
            $('#submit_search').removeClass('btn-primary').addClass('btn-light')
        }
    }
</script>
<script>

var KTSelect2 = function() {
 var demos = function() {
  $('#physician2').select2({
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
@if(@$alert=='alert')
<script>
    Swal.fire("แพทย์ท่านนี้ไม่ได้ set เวลาทำงานไว้", "", "info");
</script>
@elseif(@$alert=='redirect')
<script>
    Swal.fire({
        title: "แพทย์ท่านนี้ไม่ได้ set เวลาทำงานไว้",
        text: "",
        icon: "info",
        buttonsStyling: false,
        confirmButtonText: "<a href='{{url("book/setting_doctor")}}/{{$usid}}' class='text-white'><i class='far fa-calendar-plus'></i> กำหนดค่าวันทำงาน</a>",
        showCancelButton: true,
        cancelButtonText: "Close",
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-default"
        }
    });
</script>
@endif



@isset($arrwork)
{{-- @dd($arrwork); --}}
<script>
    var KTCalendarBasic = function() {

return {
    //main function to initiate the module
    init: function() {
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendarEl = document.getElementById('kt_calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            themeSystem: 'bootstrap',

            isRTL: KTUtil.isRTL(),

            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            height: 800,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
            now: TODAY + 'T09:25:00', // just for demo

            views: {
                dayGridMonth: { buttonText: 'month' },
                timeGridWeek: { buttonText: 'week' },
                timeGridDay: { buttonText: 'day' }
            },

            defaultView: 'dayGridMonth',
            defaultDate: TODAY,

            editable: true,
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            events: [
                @foreach ($arrwork as $data)
                    @php
                    $dt = Carbon::createMidnightDate(date("Y-m-d"));
                    @endphp

                    @if($data["canfill"])
                        {
                            title: 'Available',
                            start: "{{$data['calendar_date']}}",
                            description: "{{$dt->diffInDays($data['calendar_date'])}} วัน",
                            className: "fc-event-success fc-event-solid-success"
                        },
                    @endif
                @endforeach
            ],
            eventClick: function(info) {
                var eventDate= moment(info.event.start).format("YYYY-MM-DD");
                $("#form_date").val(eventDate);
                $("#modal_form_bookrecord").modal('show');
                $('#text_date').html(eventDate).addClass('bg-warning').addClass('text-white');
            },
            eventRender: function(info) {
                var element = $(info.el);

                if (info.event.extendedProps && info.event.extendedProps.description) {
                    if (element.hasClass('fc-day-grid-event')) {
                        element.data('content', info.event.extendedProps.description);
                        element.data('placement', 'top');
                        KTApp.initPopover(element);
                    } else if (element.hasClass('fc-time-grid-event')) {
                        element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    } else if (element.find('.fc-list-item-title').lenght !== 0) {
                        element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                    }
                }
            },




        });

        calendar.render();
    }
};
}();









jQuery(document).ready(function() {
    KTCalendarBasic.init();
});









</script>

@endisset





@endsection
