@extends('layouts.layouts_index.main')
@php
    use App\models\Mongo;
@endphp



@section('title', 'Nurse Monitor')
@section('style')
<style>
    .text-under{
        -webkit-text-decoration-line: underline; /* Safari */
        text-decoration-line: underline;
    }
    td{
        vertical-align: middle;
    }
    .btn-dark-primary:hover{
        background: #103d68;
        color: #fff;
    }
</style>
@endsection

@section('title-left')
    <h4 class="mb-sm-0">CASE CONTROL</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
        <li class="breadcrumb-item active">Case Control</li>
    </ol>
@endsection

@section('modal')
    @include('EndoCAPTURE.nurse_monitor.component.modalDoctor')
    @include('EndoCAPTURE.nurse_monitor.component.modalNurse')
    @include('EndoCAPTURE.nurse_monitor.component.modalRegister')
    @include('EndoCAPTURE.nurse_monitor.component.modalCancleCaseHn')
    @include('EndoCAPTURE.nurse_monitor.component.modal_patient')


    @include('EndoCAPTURE.nurse_monitor.component.modalCancleCaseUniq')
@endsection

@section('content')

<div class="row m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row m-0">
                    <div class="col-lg-12">
                        <div class="row m-0">
                            <div class="col-lg-12 pl-3">
                                <div class="h5 ">Officer Setting</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        @foreach($room_all as $room)
                            <div class="row m-0 p-2 cn">
                                <div class="col-lg-2">
                                        <label  class="checkbox">
                                            @if($room['room_ready']==0)
                                                <input class="form-check-input room_ready" room_id="{{$room['room_id']}}" type="checkbox"/>
                                            @else
                                                <input class="form-check-input room_ready" room_id="{{$room['room_id']}}" type="checkbox" checked/>
                                            @endif
                                            <span></span>
                                            &emsp; {{$room['room_name']}}
                                        </label>

                                </div>
                                <div class="col-8">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <button class="btn btn-light btn-shadow-hover font-weight-bold mr-2 btn-block calldoctor" room_id="{{$room['room_id']}}">เลือกแพทย์</button>
                                        </div>
                                        <div class="col-lg-3">
                                            <button class="btn btn-light btn-shadow-hover font-weight-bold mr-2 btn-block callnurse" room_id="{{$room['room_id']}}">เลือกพยาบาล</button>
                                        </div>
                                        <div class="col-lg-3">
                                            <button class="btn btn-light btn-shadow-hover font-weight-bold mr-2 btn-block callregister" room_id="{{$room['room_id']}}">เลือกผู้ช่วยพยาบาล</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="col-lg-4">
                        <textarea name="" class="form-control" id="nurse_monitor_freetext" rows="10">{{$writeboard}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 mt-2">
        <div class="row m-0">
            <div class="col-lg-12 p-0">

                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row m-0">
                            <div class="col-lg-12">
                                <div class="row m-0">
                                    <div class="col-lg-12 pl-3">
                                        <div class="h3 text-under">Booking ({{isset($tb_booking) ? count($tb_booking) : 0}})</div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th>
                                                        <button type="button" class="btn btn-outline-dark btn-sm" id="check_in_all">Check in All</button>
                                                    </th>
                                                    <th>HN</th>
                                                    <th>Patient name</th>
                                                    <th>Endoscopist</th>
                                                    <th>Procedure</th>
                                                    <th>Description</th>
                                                    <th></th>
                                                </tr>

                                                @isset($tb_booking)
                                                    @foreach ($tb_booking as $data)
                                                        @php
                                                            $data           = (object) $data;
                                                            $_id            = $data->id;
                                                        @endphp
                                                    <tr>
                                                        <td>
                                                            <a href="{{url("book/registration/$data->noteid")}}" class="btn btn-success " hn="{{@$data->hn}}">Check in</a>
                                                        </td>
                                                        <td>{{@$data->hn}}</td>
                                                        <td>{{@$data->prefixname}}{{@$data->firstname}} {{@$data->lastname}}</td>
                                                        <td>{{@$data->physician_name}}</td>
                                                        <td>
                                                            @foreach($data->procedure as $val)
                                                                @php
                                                                    $tb_procedure  = (object) Mongo::table('tb_procedure')->where('code', $val)->first();
                                                                @endphp
                                                                {{@$tb_procedure->name}}
                                                                @if(count($data->procedure)>1)
                                                                    <br>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td></td>
                                                        <td class="text-right"><i class="fas fa-times text-danger cancel_by_hn" hn="{{@$data->noteid}}"></i></td>
                                                    </tr>
                                                    @endforeach
                                                @endisset
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 p-0">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row m-0">
                            <div class="col-lg-12">
                                <div class="row m-0">
                                    <div class="col-lg-12 pl-3">
                                        <div class="h3 text-under">Holding</div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th></th>
                                                    <th>HN</th>
                                                    <th>Patient name</th>
                                                    <th>Endoscopist</th>
                                                    <th>Room</th>
                                                    <th>Localtion</th>
                                                    <th>Procedure</th>
                                                    <th>Remark</th>
                                                    <th></th>
                                                </tr>

                                                @isset($tb_case['holding'])
                                                    @foreach ($tb_case['holding'] as $data)
                                                        @php
                                                            $data = (object) $data;
                                                            $count = count($data->procedure);
                                                        @endphp
                                                        <tr>
                                                            {{-- <td><span class="label label-inline mr-2 regis2book" hn="{{@$data->hn}}">{{$data['timevisit']}}</span></td> --}}
                                                            <td></td>
                                                            <td>{{@$data->hn}}</td>
                                                            <td>{{@$data->patientname}}</td>
                                                            <td>{{@$data->physician}}</td>
                                                            <td>
                                                                <select class="form-control form-control-sm room_select" hn="{{@$data->hn}}">
                                                                    <option value="0">เลือก</option>
                                                                    @foreach ($room_ready as $room)
                                                                        @php
                                                                            $room = (object) $room;
                                                                        @endphp
                                                                        @if(($room->room_id==$data->room) || ($room->room_name==$data->room))
                                                                            <option value="{{$room->room_id}}" selected>{{$room->room_name}}</option>
                                                                        @else
                                                                            <option value="{{$room->room_id}}">{{$room->room_name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control form-control-sm location_select" hn="{{@$data->hn}}">
                                                                    @php
                                                                        $location = isset($location) && is_array($location)?  $location : jsonDecode($location);
                                                                    @endphp
                                                                    @foreach($location as $loca)
                                                                        @if($loca==$data->location)
                                                                            <option value="{{$loca}}" selected>{{$loca}}</option>
                                                                        @else
                                                                            <option value="{{$loca}}">{{$loca}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                @isset($data->procedure)
                                                                    @foreach ($data->procedure as $data)
                                                                        {{@$data}}
                                                                        @if($count > 1)
                                                                            <br>
                                                                        @endif
                                                                    @endforeach
                                                                @endisset
                                                            </td>
                                                            <td>
                                                                <input type="text" class="remark form-control" hn="{{@$data->hn}}" value="{{@$data->remark}}">
                                                            </td>
                                                            <td class="text-right"><i class="fas fa-times text-danger cancel_by_hn" hn="{{@$data->hn}}"></i></td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 p-0">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row m-0">
                            <div class="col-lg-12">
                                <div class="row m-0">
                                    <div class="col-lg-12 pl-3">
                                        <div class="h3 text-under">Operation and Reporting</div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th>Patient in</th>
                                                    <th>HN</th>
                                                    <th>Patient name</th>
                                                    <th>Endoscopist</th>
                                                    <th>Room</th>
                                                    <th>
                                                        <table width="100%">
                                                            <tr>
                                                                <td class="p-0">Procedure</td>
                                                                <td class="p-0" align="right">Status</td>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                    <th>aaa
                                                    </th>
                                                </tr>
                                                    @foreach(isset($tb_case['operation'])?$tb_case['operation']:[] as $data)

                                                        @php
                                                            $data = (object) $data;
                                                            $count = count($data->procedure);
                                                        @endphp
                                                        <tr>
                                                            {{-- <td><span class="label label-inline mr-2">{{$data['timevisit']}}</span></td> --}}
                                                            <td><span class="label label-inline mr-2"></span></td>
                                                            <td>{{@$data->hn}}</td>
                                                            <td>{{@$data->patientname}}</td>
                                                            <td>{{@$data->physician}}</td>
                                                            <td>{{@$data->room}}</td>
                                                            <td>
                                                                <table width="100%">
                                                                @isset($data->procedure)
                                                                    @foreach($data->procedure as $key=>$value)
                                                                        @php
                                                                            $status = (isset($data->statusjob)) ? $data->statusjob : [];
                                                                        @endphp
                                                                        <tr>
                                                                        <td class="p-0">{{$value}}</td>
                                                                        <td class="p-0" align="right">
                                                                            <span class="label label-info label-inline mr-2">{{@$status[$key]}}</span>&nbsp;&nbsp;&nbsp;
                                                                            <i class="fas fa-times text-danger cancel_by_caseuniq" monitor_id="" procedure="{{$value}}"></i>
                                                                        </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endisset
                                                                </table>
                                                            </td>
                                                        </tr>

                                                    @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 p-0">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row m-0">
                            <div class="col-lg-12">
                                <div class="row m-0">
                                    <div class="col-lg-12 pl-3">
                                        <div class="h3 text-under">Recovery</div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th>Patient in</th>
                                                    <th>HN</th>
                                                    <th>Patient name</th>
                                                    <th>Endoscopist</th>
                                                    <th>Procedure</th>
                                                    <th class="text-center">Status</th>
                                                </tr>

                                                @isset($tb_case['recovery'])
                                                    @foreach($tb_case['recovery'] as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $count = count($data->procedure);
                                                        $statusjob = (isset($data->statusjob)) ? $data->statusjob : [];
                                                    @endphp
                                                    <tr>
                                                        {{-- <td><span class="label label-inline mr-2">{{$data['timevisit']}}</span></td> --}}
                                                        <td><span class="label label-inline mr-2"></span></td>
                                                        <td>{{@$data->hn}}</td>
                                                        <td>{{@$data->patientname}}</td>
                                                        <td>{{@$data->physician}}</td>
                                                        <td>
                                                            @isset($data->procedure)
                                                                @foreach ($data->procedure as $data)
                                                                    {{@$data}}
                                                                    @if($count > 1)
                                                                        <br>
                                                                    @endif
                                                                @endforeach
                                                            @endisset
                                                        </td>

                                                        <td>
                                                            @foreach ($statusjob as $data2)
                                                                {{@$data2}}
                                                                @if($count > 1)
                                                                    <br>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                    </tr>

                                                    @endforeach
                                                @endisset
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-12 p-0">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row m-0">
                            <div class="col-lg-12">
                                <div class="row m-0">
                                    <div class="col-lg-12 pl-3">
                                        <div class="h3 text-under">Discharge</div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <th>Patient in</th>
                                                    <th>HN</th>
                                                    <th>Patient name</th>
                                                    <th>Endoscopist</th>
                                                    <th>Procedure</th>
                                                </tr>

                                                @isset($tb_case['discharged'])
                                                    @foreach($tb_case['discharged'] as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $count = count($data->procedure);
                                                        $statusjob = (isset($data->statusjob)) ? $data->statusjob : [];
                                                    @endphp
                                                    <tr>
                                                        {{-- <td><span class="label label-inline mr-2">{{$data['timevisit']}}</span></td> --}}
                                                        <td><span class="label label-inline mr-2"></span></td>
                                                        <td>{{@$data->hn}}</td>
                                                        <td>{{@$data->patientname}}</td>
                                                        <td>{{@$data->physician}}</td>
                                                        <td>
                                                            @isset($data->procedure)
                                                                @foreach ($data->procedure as $data)
                                                                    {{@$data}}
                                                                    @if($count > 1)
                                                                        <br>
                                                                    @endif
                                                                @endforeach
                                                            @endisset
                                                        </td>
                                                    </tr>

                                                    @endforeach
                                                @endisset
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 pl-0 mt-2">
        <div class="row m-0 mt-2">
            <div class="col-lg-12 p-0">
                <button class="btn btn-dark-primary btn-lg w-100 p-5 btn_update_monitor">UPDATE TO MONITOR <i class="fas fa-redo"></i></button>
            </div>
        </div>
        <div class="row m-0 mt-2">
            <div class="col-lg-6 p-2 mt-2">
                <div class="card">
                    <div class="card-body">Booked case {{$count_book}}</div>
                </div>
            </div>
            <div class="col-lg-6 p-2 mt-2">
                <div class="card">
                    <div class="card-body">Registered case {{$count_regis}}</div>
                </div>
            </div>
            <div class="col-lg-6 p-2 mt-2">
                <div class="card">
                    <div class="card-body">Remaining case {{$count_remain}}</div>
                </div>
            </div>
        </div>

    </div>
</div>




@endsection

@section('script')


{{-- @dd("mmmmmm") --}}

<script src="{{url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-select.js')}}"></script>
<script src="{{url('public/plugins/jquery-ui-1.12.1/jquery-ui.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>




<script src="http://{{getCONFIG('admin')->server_name}}:3000/socket.io/socket.io.js"></script>
<script>
    var socket = io.connect('http://{{getCONFIG('admin')->server_name}}:3000');
    socket.on('chat message', function(msg) {
        if(msg=="casemonitor"){
            location.reload();
        }
    });
</script>


<script>

    $('.remark').focusout(function(){
        var value = $(this).val();
        var hn = $(this).attr('hn');
        $.post('{{url('casemonitor')}}',{
            event   : 'remark',
            hn      : hn,
            value   : value
        },function(data,status){
            socket.emit('chat message','casemonitor');
        });

    });



    $('.regis2book').click(function(){
        var hn = $(this).attr('hn');
        $.post('{{url('casemonitor')}}',{
            event   : 'regis2book',
            hn      : hn,
        },function(data,status){
            socket.emit('chat message','casemonitor');
        });
    });

    $('.btn_update_monitor').click(function(){
        socket.emit('chat message','casemonitor');
    });

    $('.cancel_by_hn').click(function(){
        var hn = $(this).attr('hn');
        $('#modal_cancel_hn').modal('show');
        $('#hn_cancel').val(hn);
        $('.hn_text').html(hn);
    });


    $('.cancel_by_caseuniq').click(function(){
        var monitor_id = $(this).attr('monitor_id');
        var procedure = $(this).attr('procedure');
        $('#modal_cancel_caseuniq').modal('show');
        $('#caseuniq_cancel').val(monitor_id);
        $('#procedure_text').html(procedure);
    });


    $('.room_select').focusout(function(){
        var hn      = $(this).attr('hn');
        var room_id = $(this).val();
        $.post('{{url('casemonitor')}}',{
            event   : 'room_select',
            room_id : room_id,
            hn      : hn,
        },function(data,status){
            socket.emit('chat message','casemonitor');
        });
    });

    $('.location_select').focusout(function(){
        var hn      = $(this).attr('hn');
        var location = $(this).val();
        $.post('{{url('casemonitor')}}',{
            event       : 'casemonitor',
            location    : location,
            hn          : hn,
        },function(data,status){
            socket.emit('chat message','casemonitor');
        });
    });


    $('.room_ready').click(function(){
        var room_id = $(this).attr('room_id');
        var checked = $(this).is(":checked");
        $.post('{{url('casemonitor')}}',{
            event : 'room_ready',
            room_id : room_id,
            checked : checked,
        },function(data,status){});
    });

    $('.calldoctor').click(function(){
            var room_id = $(this).attr('room_id');
            $('#room_inmodaldoctor').val(room_id);
            $('#modal_doctor').modal('show');
            $.post("{{url('casemonitor')}}",
                {
                    event   : 'getdoctor',
                    room    : room_id,
                },
            function(data,status){
                obj = JSON.parse(data);
                $('.doctor').prop('checked', false);
                obj.forEach(function(item){
                    $('#doctor'+item).prop('checked', true);
                    console.log(item);
            });
        });
    });

    $('.callnurse').click(function(){
            var room_id = $(this).attr('room_id');
            $('#room_inmodalnurse').val(room_id);
            $('#modal_nurse').modal('show');
            $.post("{{url('casemonitor')}}",
                {
                    event   : 'getnurse',
                    room    : room_id,
                },
            function(data,status){
                obj = JSON.parse(data);
                $('.nurse').prop('checked', false);
                obj.forEach(function(item){
                    $('#nurse'+item).prop('checked', true);
                    console.log(item);
            });
        });
    });

    $('.callregister').click(function(){
            var room_id = $(this).attr('room_id');
            $('#room_inmodalregister').val(room_id);
            $('#modal_register').modal('show');
            $.post("{{url('casemonitor')}}",
                {
                    event   : 'getregister',
                    room    : room_id,
                },
            function(data,status){
                console.log(data);
                obj = JSON.parse(data);
                $('.register').prop('checked', false);
                obj.forEach(function(item){
                    $('#register'+item).prop('checked', true);
                    console.log(item);
            });
        });
    });


    $('.btn-checkin').click(function(){
        var hn = $(this).attr('hn');
        $.post("{{url('casemonitor')}}",{
            event   : 'checkin',
            hn      : hn,
        },function(data,status){
            socket.emit('chat message','endocapture_home');
            socket.emit('chat message','casemonitor');
        });
    });


    $('.btn-discharge').click(function(){
        var hn = $(this).attr('hn');
        $.post("{{url('casemonitor')}}",{
            event   : 'discharge',
            hn      : hn,
        },function(data,status){
            socket.emit('chat message','casemonitor');
            socket.emit('queue','refreshdata');
        });
    });







    $('#check_in_all').click(function(){
        $.post("{{url('casemonitor')}}",{
            event   : 'check_in_all',
        },function(data,status){
            socket.emit('chat message','endocapture_home');
            socket.emit('chat message','casemonitor');
        });
    });

    $('#nurse_monitor_freetext').focusout(function(){
        var text = $(this).val();
        $.post("{{url('casemonitor')}}",{
                event   : 'update_nursemonitor',
                text    : text,
        },function(data,status){

        });
    });
</script>




@endsection
