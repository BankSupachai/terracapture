@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .text-under{
        -webkit-text-decoration-line: underline; /* Safari */
        text-decoration-line: underline;
    }
    td{
        vertical-align: middle;
    }
</style>
@endsection


@section('content')

<div class="modal fade" id="modal_doctor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-0">
                <h2 class="text-center text-dark">Select Doctor</h2>
                <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal" aria-label="Close">
                    X
                </button>
              </div>
            <div class="modal-body pb-0">
                <form action="{{url('casemonitor')}}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="doctor_select">
                    <div class="row">
                        <div class="col-12">
                            <input id="room_inmodaldoctor" type="hidden" name="room">
                        </div>
                        @foreach ($doctor as $user)
                            <div class="col-4 text-dark mt-3">
                                <input  name="doctor[]"
                                        value="{{$user->id}}"
                                        type="checkbox"
                                        class="doctor"
                                        id="doctor{{$user->id}}">
                                <label for="doctor{{$user->id}}">&nbsp; {{$user->user_prefix}}{{$user->user_firstname}} {{$user->user_lastname}}</label>
                            </div>
                        @endforeach
                        <div class="col-12 p-0 mt-4">
                            <button type="submit" class="btn btn-success btn-block btn-save">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="modal_nurse">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-0">
                <h2 class="text-center text-dark">Select Nurse</h2>
                <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal" aria-label="Close">
                    X
                </button>
              </div>
            <div class="modal-body pb-0">
                <form action="{{url('casemonitor')}}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="nurse_select">
                    <div class="row">
                        <div class="col-12">
                            <input id="room_inmodalnurse" type="hidden" name="room">
                        </div>
                        @foreach ($nurse as $user)
                            <div class="col-4 text-dark mt-3">
                                <input  name="nurse[]"
                                        value="{{$user->id}}"
                                        type="checkbox"
                                        class="nurse"
                                        id="nurse{{$user->id}}">
                                <label for="nurse{{$user->id}}">&nbsp; {{$user->user_prefix}}{{$user->user_firstname}} {{$user->user_lastname}}</label>
                            </div>
                        @endforeach
                        <div class="col-12 p-0 mt-4">
                            <button type="submit" class="btn btn-success btn-block btn-save">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_register">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-0">
                <h2 class="text-center text-dark">Select Register</h2>
                <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal" aria-label="Close">
                    X
                </button>
              </div>
            <div class="modal-body pb-0">
                <form action="{{url('casemonitor')}}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="register_select">
                    <div class="row">
                        <div class="col-12">
                            <input id="room_inmodalregister" type="hidden" name="room">
                        </div>
                        @foreach ($register as $user)
                            <div class="col-4 text-dark mt-3">
                                <input  name="register[]"
                                        value="{{$user->id}}"
                                        type="checkbox"
                                        class="nurse"
                                        id="register{{$user->id}}">
                                <label for="register{{$user->id}}">&nbsp; {{$user->user_prefix}}{{$user->user_firstname}} {{$user->user_lastname}}</label>
                            </div>
                        @endforeach
                        <div class="col-12 p-0 mt-4">
                            <button type="submit" class="btn btn-success btn-block btn-save">บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_cancel_hn">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-0">
                <h2 class="text-center text-dark">Cancel Case</h2>
                <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal" aria-label="Close">
                    X
                </button>
              </div>
            <div class="modal-body pb-0">
                <form action="{{url('casemonitor')}}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="cancel_hn">
                    <div class="row">
                        <div class="col-12">
                            <input id="hn_cancel" type="hidden" name="hn">
                        </div>
                        <div class="col-12" style="align-content: center">
                            <h1>H.N.</h1>
                            <h1 class="hn_text"></h1>
                        </div>
                        <div class="col-12 p-0 mt-4">
                            <button type="submit" class="btn btn-primary btn-block btn-save">ยืนยัน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_cancel_caseuniq">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-0">
                <h2 class="text-center text-dark">Cancel Case</h2>
                <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal" aria-label="Close">
                    X
                </button>
              </div>
            <div class="modal-body pb-0">
                <form action="{{url('casemonitor')}}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="cancel_caseuniq">
                    <div class="row">
                        <div class="col-12">
                            <input id="caseuniq_cancel" type="hidden" name="monitor_id">
                        </div>
                        <div class="col-12" style="align-content: center">
                            <h1>Procedure : </h1>
                            <h1 id="procedure_text"></h1>
                        </div>
                        <div class="col-12 p-0 mt-4">
                            <button type="submit" class="btn btn-primary btn-block btn-save">ยืนยัน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="row m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row m-0">
                    <div class="col-lg-12">
                        <div class="row m-0">
                            <div class="col-lg-12 pl-3">
                                <div class="h3 text-under">Room</div>
                            </div>
                        </div>
                    </div>


                    @foreach($room_all as $room)
                    <div class="col-lg-6">
                        <div class="row m-0 p-2">
                            <div class="col-lg-2">
                                <span class="switch">
                                    <label>
                                        @if($room->room_ready==0)
                                            <input class="room_ready" room_id="{{$room->room_id}}" type="checkbox"/>
                                        @else
                                            <input class="room_ready" room_id="{{$room->room_id}}" type="checkbox" checked/>
                                        @endif
                                        <span></span>
                                    </label>
                                    {{$room->room_name}}
                                </span>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <button class="btn btn-light btn-shadow-hover font-weight-bold mr-2 btn-block calldoctor" room_id="{{$room->room_id}}">เลือกแพทย์</button>
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-light btn-shadow-hover font-weight-bold mr-2 btn-block callnurse" room_id="{{$room->room_id}}">เลือกพยาบาล</button>
                                    </div>
                                    <div class="col-lg-3">
                                        <button class="btn btn-light btn-shadow-hover font-weight-bold mr-2 btn-block callregister" room_id="{{$room->room_id}}">เลือกผู้ช่วยพยาบาล</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endforeach

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
                                        <div class="h3 text-under">Booked</div>
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
                                                    <th></th>
                                                </tr>

                                                @foreach($list_booking as $data)
                                                <tr>
                                                    <td>
                                                        <button class="btn btn-success btn-sm btn-checkin" hn="{{$data['hn']}}">Check in</button>
                                                    </td>
                                                    <td>{{$data['hn']}}</td>
                                                    <td>{{$data['patientname']}}</td>
                                                    <td>{{$data['doctorname']}}</td>
                                                    <td>
                                                        @foreach($data['procedure'] as $d)
                                                            [{{$d}}]
                                                        @endforeach
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-times text-danger cancel_by_hn" hn="{{$data['hn']}}"></i></td>
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
                                        <div class="h3 text-under">Registered</div>
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
                                                    <th></th>
                                                </tr>

                                                @foreach($list_regis as $data)
                                                <tr>
                                                    <td><span class="label label-inline mr-2">{{$data['timevisit']}}</span></td>
                                                    <td>{{$data['hn']}}</td>
                                                    <td>{{$data['patientname']}}</td>
                                                    <td>{{$data['doctorname']}}</td>
                                                    <td>
                                                        <select class="form-control form-control-sm room_select" hn="{{$data['hn']}}">
                                                            <option>เลือก</option>
                                                            @foreach ($room_ready as $room)
                                                                @if($room->room_id==$data['room'])
                                                                    <option value="{{$room->room_id}}" selected>{{$room->room_name}}</option>
                                                                @else
                                                                    <option value="{{$room->room_id}}">{{$room->room_name}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control form-control-sm location_select"hn="{{$data['hn']}}">
                                                            @foreach($location as $loca)
                                                                @if($loca==$data['location'])
                                                                    <option value="{{$loca}}" selected>{{$loca}}</option>
                                                                @else
                                                                    <option value="{{$loca}}">{{$loca}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        @foreach($data['procedure'] as $d)
                                                            [{{$d}}]
                                                        @endforeach
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-times text-danger cancel_by_hn" hn="{{$data['hn']}}"></i></td>
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
                                                                <td>Procedure</td>
                                                                <td align="right">Status</td>
                                                            </tr>
                                                        </table>
                                                    </th>
                                                </tr>

                                                @foreach($list_remain as $data)
                                                <tr>
                                                    <td><span class="label label-inline mr-2">{{$data['timevisit']}}</span></td>
                                                    <td>{{$data['hn']}}</td>
                                                    <td>{{$data['patientname']}}</td>
                                                    <td>{{$data['doctorname']}}</td>
                                                    <td>{{$data['room']}}</td>
                                                    <td>
                                                        <table width="100%">
                                                        @foreach($data['procedure'] as $key=>$value)
                                                            <tr>
                                                            <td>{{$value}}</td>
                                                            <td align="right">
                                                                <span class="label label-{{$data['color'][$key]}} label-inline mr-2">{{$data['status'][$key]}}</span>&nbsp;&nbsp;&nbsp;
                                                                <i class="fas fa-times text-danger cancel_by_caseuniq" monitor_id="{{$data['monitor_id'][$key]}}" procedure="{{$value}}"></i>
                                                            </td>
                                                            </tr>
                                                        @endforeach
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
        </div>
    </div>
    <div class="col-lg-4 pl-0 mt-2">
        <div class="row m-0 mt-2">
            <div class="col-lg-12 p-0">
                <button class="btn btn-primary btn-lg w-100 p-5 btn_update_monitor">UPDATE TO MONITOR <i class="fas fa-redo"></i></button>
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
        <div class="row m-0 mt-2">
            <div class="col-lg-12 p-0">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">Freetext</div>
                            <div class="col-lg-9">
                                <textarea name="" class="form-control" id="nurse_monitor_freetext" rows="10">{{$nurse_monitor->config_json}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('script')
<script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/bootstrap-select.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
            event       : 'location_select',
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
            console.log(data);
            if(data.search("true")){
                socket.emit('chat message','endocapture_home');
                location.reload();
            }
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
