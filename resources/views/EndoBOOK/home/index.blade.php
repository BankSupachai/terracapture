@extends('layouts.app')
@section('title', 'EndoBook')
@section('style')
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquery.datetimepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquerysctipttop.css')}}">



<style>
    body{
        background: #F3F3F9;
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
        background: white;
        line-height: 1em;
    }
    /* .btn-book{
        font-size: 1.3em;
        padding: 0.8em;
    } */
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
    }
    .btn-book{background-color: #405189;color: white;padding-left: 15px;padding-right: 15px;}
    .btn-book:hover{background-color: #1e2c5a;}
    /* #kt_header{
        background: #6D7DB1;
    } */
    .cn{
        align-items: center;
    }
    .font-weight-normal {
        font-weight: 300 !important;
    }
    .list-book-procedure{
        height: 8em;
        overflow-y: auto;
    }
    .list-book-procedure tr{
        line-height: 1em;
    }
    .list-book-procedure tr td{
        padding: 0;
        line-height: 1em;
    }
    ::-webkit-scrollbar {
    width: 3px;
        }
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    ::-webkit-scrollbar-thumb {
        background: #888;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .list-date:hover{
        cursor: pointer;
        transition:  0.3s;
        border: 1px solid #79b1e9;
        background: #3699FF;
    }
    .list-month i:hover{
        cursor: pointer;
        color: #1e2c5a !important;
    }
    .no-warp{
        white-space: nowrap;
    }
    .aside-fixed.aside-minimize .menu-book-detail{
        height: 10.8em;
        overflow-y: auto;
    }
    .table tr td:last-child,.table tr th:last-child{
        width: 11em;
    }
    #head_menu > div{
        padding-right: 0;
    }
    #head_menu > div:last-child{
        padding-right: 12.5px;
    }
    /* .aside-fixed #head_menu > div .table td,.aside-fixed #head_menu > div .table th{
        padding: 0.5em;
    }
    .aside-fixed.aside-minimize #head_menu > div .table th,.aside-fixed.aside-minimize #head_menu > div .table td{
        padding: auto;
    } */
    .aside-fixed #head_menu > div .card-body .p-4{
        padding-bottom: 0.8rem !important;
        padding-top: 0.8rem !important;
    }
    .aside-fixed.aside-minimize #head_menu > div .card-body .p-4{
        padding-bottom: 1.5rem !important;
        padding-top: 1.6rem !important;
    }
    .aside-fixed #head_menu .col-6 .card-body{
        padding-top: 1em;
    }
    .aside-fixed.aside-minimize #head_menu .col-6 .card-body{
        padding-top: 1.5em;
    }
    .aside-fixed .menu-book-detail {
        height: 9.8em;
    }
    .aside-fixed #head_menu .col-2 .bg-endo .card-body{
        padding-top: 1.5em;
        padding-bottom: 1.5em;
    }
    .aside-fixed.aside-minimize #head_menu .col-2 .bg-endo .card-body{
        padding-top: 2em;
    }
    .d-grid{
        display: grid;
    }
    .d-grid a{
        align-self: center;
    }
    h3{
        white-space: nowrap;
    }
</style>
@endsection

@section('modal')
    @include("EndoBOOK.home.modal.modal_select_doctor")
<div class="modal fade" id="remove_book" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{url("book/doctor")}}/1" method="post" class="modal-content">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm remove</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body row m-0">
                <h4 id="modal_id" class="col-6"></h4>
                <h4 id="modal_hn" class="col-6"></h4>
                <h4 id="modal_name" class="col-6"></h4>
                <h4 id="modal_procedure" class="col-6"></h4>
                <input type="hidden" name="id" id="modal_text_id">
            </div>
            <div class="modal-footer row m-0">
                <button type="button" class="btn btn-secondary col" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger col-8">Confirm remove</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('content')
<div class="row m-0 px-2" id="head_menu">
    <div class="col-2" id="show_calendar">
        @php
            $date = array();
            foreach($tb_bookset_calendar_department as $data){
                $data = (object) $data;
                $date[$data->calendar_date]['in']   = @$data->calendar_roomin;
                $date[$data->calendar_date]['out']  = @$data->calendar_roomout;
            }

            if(isset($day)){
                $year_fix   = $s_year;
                $month_fix  = $s_month;
            }else{
                $year_fix   = date("Y");
                $month_fix  = date("m");
            }

            $dates      = getDates($year_fix);
            $weekdays   = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
            $date       = date_create("$year_fix-$month_fix-01");
        @endphp

        @foreach($dates as $month => $weeks)
        @if($month==$month_fix)
        <div class="bg-fff">

            <div class="bg-endo text-dark row m-0 py-2 list-month">
                <div class="col-2 h4 mb-0"><i class="fas fa-angle-left text-white" onclick='change_month("back","{{date_format($date,"m")}}","{{$year_fix}}")'></i></div>
                <div class="col text-center h4 text-white mb-0">{{date_format($date,"F")}}</div>
                <div class="col-2 text-right h4 mb-0"><i class="fas fa-angle-right text-white" onclick='change_month("next","{{date_format($date,"m")}}","{{$year_fix}}")'></i></div>
            </div>
            <table class="table table-bordered">
                <tr class="">
                    <th class="text-center">{!!implode('</th><th class="text-center">', $weekdays)!!}</th>
                </tr>
                @foreach($weeks as $week => $days)
                <tr>
                    @foreach($weekdays as $day)
                        @isset($days[$day])
                            @php
                                $fixdate="$year_fix-$month-$days[$day]";
                            @endphp
                            <td
                            @if(isset($s_day))
                            class="@if($days[$day]==$s_day) bg-primary text-white @else list-date @endif"

                            @else
                            class="@if($days[$day]==date('d')) bg-primary text-white @else list-date @endif"
                            @endif
                            onclick='select_day("{{$days[$day]}}","{{$month}}","{{$year_fix}}")'>
                                <span>{{$days[$day]}}</span>
                            </td>
                        @else
                            <td></td>
                        @endisset
                    @endforeach
                </tr>
                @endforeach
            </table>
        </div>
        @endif
        @endforeach
    </div>
    <div class="col-2">
        <div class="card card-custom mb-4">
            <div class="card-body p-1">
                <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap row">
                    <div class="col">
                        <a href="#" class=" text-dark-50 mb-4">Date Schedule</a>
                        <p class="text-dark h4 mb-2 no-warp">{{@$date_str}}</p>
                        <p class="text-success mb-0">Available Booking</p>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="btn btn-icon btn-light-success btn-circle btn-lg">
                            <i class="flaticon2-heart-rate-monitor"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom mb-2">
            <div class="card-body p-1">
                <div class="d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap row">
                    <div class="col">
                        <a href="#" class=" text-dark-50 mb-4">Available Time</a>
                        <p class="text-dark h3 mb-2"><span class="text-success">{{@$get_case['sum_min']}}</span>/ {{@$get_case['time_all']}} min.</p>
                        <p class="text-success mb-0">Available Booking&nbsp;</p>

                    </div>
                    <div class="col-auto">
                        <a href="#" class="btn btn-icon btn-light-success btn-circle btn-lg">
                            <i class="flaticon2-hourglass-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="col-6 pb-4">
        <div class="card card-custom h-100">
            <div class="card-body pb-1">
                <div class="row">

                    <div class="col-12 text-dark-50">
                        Booking Detail
                    </div>

                    <div class="col-4">
                        <div class="row align-items-end">
                            <div class="col-6 h3 mb-0">
                                A.M.
                            </div>
                            <div class="col-6 text-right">
                                @isset($get_case['am']['min'])
                                <span class="text-warning">
                                {{$get_case['am']['min']}}
                                </span>
                                @else
                                <span class="text-warning">
                                    0
                                </span>
                                @endisset / {{@$get_case['time_am']}} min.
                            </div>
                            <div class="col-12">
                                <div class="row menu-book-detail">
                                    <div class="col-12 text-dark-50 h6 m-0">
                                        @isset($get_case['am']['procedure'])
                                            @foreach($get_case['am']['procedure'] as $k=>$v)
                                                @if(!in_array($k,$procedure_ex))
                                                    @php
                                                        $procedure_temp = DB::table('tb_procedure')->where("procedure_code",$k)->first();
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-10">{{$procedure_temp->procedure_name}}</div>
                                                        <div class="col-2 text-right">{{$v}}</div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="row align-items-end">
                            <div class="col-6 h3 m-0">
                                P.M.
                            </div>
                            <div class="col-6 m-0 text-right">
                                @isset($get_case['pm']['min'])

                                    <span class="text-success">{{$get_case['pm']['min']}}</span>
                                @else
                                <span class="text-success">0</span>
                                @endisset / {{@$get_case['time_pm']}} min.
                            </div>
                            <div class="col-12">
                                <div class="row menu-book-detail">
                                    <div class="col-12 text-dark-50 h6 m-0">
                                        @isset($get_case['pm']['procedure'])
                                            @foreach($get_case['pm']['procedure'] as $k=>$v)
                                                @if(!in_array($k,$procedure_ex))
                                                    @php
                                                        $procedure_temp = DB::table('tb_procedure')->where("procedure_code",$k)->first();
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-10">{{$procedure_temp->procedure_name}}</div>
                                                        <div class="col-2 text-right">{{$v}}</div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="row align-items-end">
                            <div class="col-6 h3 mb-0">
                                OT
                            </div>
                            <div class="col-6  text-right">
                                @isset($get_case['ot']['min'])
                                <span class="text-warning">{{$get_case['ot']['min']}}</span>
                                @else
                                <span class="text-warning">0</span>
                                @endisset

                                / {{@$get_case['time_ot']}} min.
                            </div>
                            <div class="col-12">
                                <div class="row menu-book-detail">
                                    <div class="col-12 text-dark-50 h6 m-0">
                                        @isset($get_case['ot']['procedure'])
                                            @foreach($get_case['ot']['procedure'] as $k=>$v)
                                                @if(!in_array($k,$procedure_ex))
                                                    @php
                                                        $procedure_temp = DB::table('tb_procedure')->where("procedure_code",$k)->first();
                                                    @endphp
                                                    <div class="row">
                                                        <div class="col-10">{{$procedure_temp->procedure_name}}</div>
                                                        <div class="col-2 text-right">{{$v}}</div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 h5 m-0">
                        Total {{@$get_case['sum_case']}} Case
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-2 pb-4">
        <div class="card bg-endo h-100">
            <div class="card-body cn">
                <div class="h-100 d-grid">

                    @if($user_type=="doctor")
                        <a href="{{url("book/setting_doctor/$userID")}}" class="btn btn-light btn-hover-primary font-weight-bold w-100 btn-lg">
                            <i class='fas fa-chalkboard-teacher mb-2'></i>
                            <h3>Setting doctor</h3>
                        </a>
                    @else
                        <a id="call_modal_select_doctor" class="btn btn-light btn-hover-primary font-weight-bold w-100 btn-lg">
                            <i class='fas fa-chalkboard-teacher mb-2'></i>
                            <h3>Setting doctor</h3>
                        </a>
                    @endif


                    <a href="{{url("book/setting_department/$userID")}}" class="btn btn-light btn-hover-success font-weight-bold btn-lg w-100 mt-3">
                        <i class='fas fa-book mb-2'></i>
                        <h3>Setting department</h3>
                    </a>
                </div>

            </div>
        </div>
    </div>


</div>
<div class="row m-0 px-1">
    <div class="col-lg-12 mt-1">
        <div class="card">
            <div class="card-body p-0">
                <div class="row m-0 align-items-center p-3">
                    <div class="col-lg-auto border-right"><b>{{@$date_str}}</b></div>
                    <div class="col-lg"></div>
                    <div class="col-lg-auto">
                        <a href="{{url("book/patient/create")}}" class="btn btn-primary w-100 btn-book"><i class="fas fa-plus mr-2"></i> Create Booking</a>
                    </div>
                </div>
                <form action="{{url("book/doctor/$userID")}}" method="post" class="row m-0 border-top p-3" id="filters">
                    @method('GET')
                    @csrf
                    <input type="hidden" value="filters" name="event">
                    <div class="col-lg-3">
                        <div class="input-icon">
                            <input type="text" class="form-control bg-light" name="search" placeholder="Search for HN, Name…" value="{{@$search}}"/>
                            <span><i class="flaticon2-search-1 icon-md"></i></span>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-control bg-light select2" title="Physician" id="s_physician" name="search_physician">
                            <option value="">Physician</option>
                            @foreach($doctor as $data)
                                <option value="{{$data->id}}" @if(@$search_physician==$data->id) selected @endif>
                                    {{$data->user_prefix}}
                                    {{$data->user_firstname}}
                                    &nbsp;&nbsp;
                                    {{$data->user_lastname}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <select class="form-control bg-light" title="Procedure" name="search_procedure">
                            <option value="">Procedure</option>
                            @foreach ($procedure as $pcd)
                                <option value="{{$pcd->procedure_code}}" @if(@$search_procedure==$pcd->procedure_code) selected @endif>{{$pcd->procedure_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg">
                        <input type="hidden" id="date_select"   name="date_select">
                        <input type="hidden" id="search_day"    name="search_day" @if(isset($s_day)) value="{{@$s_day}}" @else value="{{date('d')}}" @endif>
                        <input type="hidden" id="search_month"  name="search_month" @if(isset($s_month)) value="{{@$s_month}}" @else value="{{date('m')}}" @endif>
                        <input type="hidden" id="search_year"   name="search_year" @if(isset($s_year)) value="{{@$s_year}}" @else value="{{date('Y')}}" @endif>
                    </div>
                    <div class="col-lg-auto">
                        <button type="submit" class="btn btn-book"><i class="flaticon-interface-7"></i> Filters</button>
                    </div>
                </form>
                <table class="table">

                    <thead>
                        <tr class="bg-light">
                            <th>#</th>
                            <th>HN</th>
                            <th>Name</th>
                            <th>Physician</th>
                            <th>Procedure</th>
                            <th>Pre-Diagnosis</th>
                            <th>Comment</th>
                            <th>Time</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($tb_booking))
                            @foreach($tb_booking as $key => $ddd)
                                @php
                                    $data       = (object) $ddd;
                                    $booker     = DB::table('users')->where('id',$data->bk_booker)->first();
                                    $procedure  = $data->procedure;
                                @endphp
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{@$data->hn}}</td>
                                    <td>{{@$data->prefixname}}{{@$data->firstname}} {{@$data->lastname}}</td>
                                    <td>{{$data->bk_doctor}}</td>
                                    <td>
                                        @foreach($procedure as $pdata)
                                            @php
                                                $tb_procedure = DB::table('tb_procedure')->where('procedure_code',$pdata)->first();
                                            @endphp
                                            <p>
                                                {{@$tb_procedure->procedure_name}}
                                            </p>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{@$data->prediagnosis}}
                                    </td>
                                    <td>
                                        {{@$data->comment}}
                                    </td>
                                    <td>
                                        {{@$data->bk_time}}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#remove_book"
                                        onclick='modal_detail("{{$data->create_time}}","{{$data->hn}}","{{@$data->prefixname}}{{@$data->firstname}} {{@$data->lastname}}","{{@$tb_procedure->procedure_name}}")'
                                        ><i class="fas fa-ban"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function select_day(day,month,year) {
        $("#search_day").val(day)
        $("#search_month").val(month)
        $("#search_year").val(year)

        $("#date_select").val(year+"-"+month+"-"+day);

        $("#filters").submit()
    }

    function change_month(status,month,year) {
        var s_day = $("#search_day").val()
        var s_month = $("#search_month").val()
        var s_year = $("#search_year").val()
        $.post("{{url('book/doctor')}}",
        {
            event       : 'gen_calendar',
            year        : year,
            month       : month,
            s_day       : s_day,
            s_month     : s_month,
            s_year      : s_year,
            status      : status,
        },
        function(data, status) {
            $("#show_calendar").html(data)
        })
    }

    $("#call_modal_select_doctor").click(function() {
        $("#modal_select_doctor").modal("show");
    });

</script>
<script>
        var KTSelect2 = function() {
 var demos = function() {
  $('#select_doctor').select2({
   placeholder: "Select doctor",
   width:"100%",
   allowClear: true
  });
  $('#s_physician').select2({
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

function modal_detail(id,hn,name,procedure){
    $("#modal_id").html('ID : '+id)
    $("#modal_hn").html('HN : '+hn)
    $("#modal_name").html('Name : '+name)
    $("#modal_procedure").html('Procedure : '+procedure)
    $("#modal_text_id").val(id)
}
</script>
@endsection
