@extends('layouts.book')
@section('title', 'EndoBook')
@section('style')
<style>
    .bg-calendar{
        background: #F2F2F2;
    }
</style>
@endsection

@section('modal')



@endsection

@section('content')
<div class="row m-0">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h3>Dairy work</h3>
                @foreach ($day as $item)
                <div class="row m-0">
                    <div class="col-2 border-right pt-2">
                        <div class="checkbox-list">
                            <label class="checkbox mt-3 jc checkbox-info">
                                <input type="checkbox" name="Checkboxes1"/>
                                <span></span>
                                {{$item}}
                            </label>
                        </div>
                    </div>
                    <div class="col-4 pt-2">
                        <select name="" id="" class="form-control form-control-sm">
                            <option value="">ทั้งวัน</option>
                            <option value="">ในเวลา (เช้าบ่าย)</option>
                            <option value="">ในเวลา (เช้า)</option>
                            <option value="">ในเวลา (บ่าย)</option>
                            <option value="">นอกเวลา (บ่าย)</option>
                        </select>
                    </div>
                    <div class="col-6 pt-2">
                        <select name="" id="" class="form-control selectpicker" multiple>
                            <option value="">EGD</option>
                            <option value="">Colonoscopy</option>
                            <option value="">ERCP</option>
                            <option value="">EUS</option>
                            <option value="">EBUS</option>
                            <option value="">ESD</option>
                            <option value="">POEM</option>
                        </select>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-lg-7">
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
        <div class="row m-0">
            <div class="col-8 m-auto bg-calendar p-0">
                <div class="bg-head-book text-dark row m-0 py-2">
                    <div class="col-2 h4"><i class="fas fa-angle-left text-dark"></i></div>
                    <div class="col text-center h4">{{date_format($date,"F")}}</div>
                    <div class="col-2 text-right h4"><i class="fas fa-angle-right text-dark"></i></div>
                </div>
                <table class="table table-bordered">
                    <tr class="table-dark">
                        <th class="text-center">{!!implode('</th><th class="text-center">', $weekdays)!!}</th>
                    </tr>
                    @foreach($weeks as $week => $days)
                    <tr>
                        @foreach($weekdays as $day)
                            @isset($days[$day])
                                @php
                                    $fixdate="$year_fix-$month-$days[$day]";
                                @endphp
                                <td>
                                    <h3 class="text-center">{{$days[$day]}}</h3>
                                </td>
                            @else
                                <td></td>
                            @endisset
                        @endforeach
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<div class="row m-0 mt-2">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h3>รายการวันหยุด</h3>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection
