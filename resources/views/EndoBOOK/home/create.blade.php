@extends('layouts.book')
@section('title', 'EndoBook')
@section('style')
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquery.datetimepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquerysctipttop.css')}}">



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
    #kt_header{
        background: #6D7DB1;
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

@endsection

@section('content')
<div class="row m-0 px-5">
    <div class="col-lg-4 bg-gray">
        <div class="row m-0">
            <table class="table table-borderless mb-0" id="table_deader">
                <tr>
                    <td><b>Physician</b><b class="text-danger">*</b></td>
                    <td>
                        <div class="row m-0">
                            <div class="col px-0">
                                <select name="" id="" class="form-control form-control-sm"></select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>Department :</b></td>
                    <td>
                        <b>Department ของหมอ</b>
                    </td>
                </tr>
                <tr>
                    <td><b>Patient Type</b><b class="text-danger">*</b></td>
                    <td>
                        <div class="radio-inline">
                            <label class="radio radio-outline radio-info">
                                <input type="radio" name="radios2"/>
                                <span></span>
                                Service
                            </label>
                            <label class="radio radio-outline radio-info">
                                <input type="radio" name="radios2"/>
                                <span></span>
                                Special
                            </label>
                            <label class="radio radio-outline radio-info">
                                <input type="radio" name="radios2"/>
                                <span></span>
                                Premium
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>Type</b><b class="text-danger">*</b></td>
                    <td>
                        <div class="radio-inline">
                            <label class="radio radio-outline radio-info">
                                <input type="radio" name="radios2"/>
                                <span></span>
                                นอกเวลา
                            </label>
                            <label class="radio radio-outline radio-info">
                                <input type="radio" name="radios2"/>
                                <span></span>
                                ในเวลา
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>Period</b></td>
                    <td>
                        <div class="radio-inline">
                            <label class="radio radio-outline radio-info">
                                <input type="radio" name="radios2"/>
                                <span></span>
                                AM
                            </label>
                            <label class="radio radio-outline radio-info">
                                <input type="radio" name="radios2"/>
                                <span></span>
                                PM
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td><b>Procedure</b><b class="text-danger">*</b></td>
                    <td>
                        <div class="row m-0">
                            <div class="col-12 py-1">
                                <select name="" id="" class="form-control form-control-sm"></select>
                            </div>
                            <div class="col-12 py-1">
                                <select name="" id="" class="form-control form-control-sm"></select>
                            </div>
                            <div class="col-12 py-1">
                                <select name="" id="" class="form-control form-control-sm"></select>
                            </div>
                            <div class="col-12 py-1">
                                <select name="" id="" class="form-control form-control-sm"></select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>Anesth</b><b class="text-danger">*</b></td>
                    <td>
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" name="Checkboxes15"/>
                                <span></span>
                                GA
                            </label>
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" name="Checkboxes15"/>
                                <span></span>
                                Sedation
                            </label>
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" name="Checkboxes15"/>
                                <span></span>
                                LA
                            </label>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>Special Equipment</b><b class="text-danger">*</b></td>
                    <td>
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" name="Checkboxes15"/>
                                <span></span>
                                Flu
                            </label>
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" name="Checkboxes15"/>
                                <span></span>
                                Spyglass
                            </label>
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" name="Checkboxes15"/>
                                <span></span>
                                Laser
                            </label>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td><b>Urgent</b><b class="text-danger">*</b></td>
                    <td>
                        <div class="checkbox-inline">
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" name="Checkboxes15"/>
                                <span></span>
                                Elective
                            </label>
                            <label class="checkbox checkbox-outline checkbox-success">
                                <input type="checkbox" name="Checkboxes15"/>
                                <span></span>
                                Urgency
                            </label>


                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <button class="btn btn-book mt-5"><i class="fa fa-search icon-2x mr-2 text-light"></i>Search</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-lg-8 mt-2">
        <div class="row m-0">
            <div class="col-12 px-0">
                <div class="row m-0">
                    <div class="col-12 p-0">
                        @php

                        $tb_bookset_calendar_department = DB::table('tb_bookset_calendar_department')->get();
                        $date = array();
                        foreach($tb_bookset_calendar_department as $data){
                            $date[$data->calendar_date]['in']   = $data->calendar_roomin;
                            $date[$data->calendar_date]['out']  = $data->calendar_roomout;
                        }


                        $year_fix = date("Y");
                        $month_fix = date("m");
                        $dates = getDates($year_fix);
                        $weekdays = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
                        $date=date_create("$year_fix-$month_fix-01");
                        @endphp
                        @foreach($dates as $month => $weeks)
                        @if($month==$month_fix)
                        <div class="bg-fff">
                            <div class="bg-head-book text-dark row m-0 py-2">
                                <div class="col-2 h4"><i class="fas fa-angle-left text-dark"></i></div>
                                <div class="col text-center h4">{{date_format($date,"F")}}</div>
                                <div class="col-2 text-right h4"><i class="fas fa-angle-right text-dark"></i></div>
                            </div>
                            <table class="table table-bordered">
                                <tr class="table-dark">
                                    <th class="">{!!implode('</th><th>', $weekdays)!!}</th>
                                </tr>
                                @foreach($weeks as $week => $days)
                                <tr>
                                    @foreach($weekdays as $day)
                                        @isset($days[$day])
                                            @php
                                                $fixdate="$year_fix-$month-$days[$day]";
                                            @endphp
                                            <td>
                                                <h3>{{$days[$day]}}</h3>
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
                    <div class="col-12 my-4">
                        <div class="row m-0 text-right" style="float: right;">
                            <div class="col-auto p-0"><div class="box bg-success ml-4 mr-1"></div></div>
                            <div class="col-auto p-0">Available</div>
                            <div class="col-auto p-0"><div class="box bg-warning ml-4 mr-1"></div></div>
                            <div class="col-auto p-0">Some Booked</div>
                            <div class="col-auto p-0"><div class="box bg-danger ml-4 mr-1"></div></div>
                            <div class="col-auto p-0">All Booked</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 pr-0">
                <div class="row m-0 bg-head-book py-3">
                    <div class="col-8">Task List (Mon, 03 Jan 2022)</div>
                    <div class="col-4 text-right">Total : 10</div>
                </div>
                @for ($i=0;$i<=1;$i++)
                    <div class="row m-0 mt-1 bg-gray py-4 cn">
                        <div class="col"><b>09:00 - 12:00</b></div>
                        <div class="col-1"><a href="{{url('home/1')}}" class="btn btn-book-mini">Book</a></div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
















@endsection
