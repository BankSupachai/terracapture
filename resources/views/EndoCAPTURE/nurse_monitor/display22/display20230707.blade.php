@php

    use App\Models\Mongo;

@endphp

@extends('layouts.layout_nurse')

@section('style')
    <link href="{{ url('public/css/style_monitor.css') }}" rel="stylesheet" />
    <style>
        .content {
            padding: 0;
        }

        body {
            height: 100vh;
        }
        .bg-dark-tv{
            background: #212020;
            color: #fff;
        }
        textarea.form-control:focus {
            background: #212020;
            color: #fff
        }
    </style>
@endsection

@section('content')
    <div class="d-flex flex-column flex-root full-height">
        <div class="d-flex flex-row flex-column-fluid page use-vue full-height">
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <div id="kt_header" class="header header-fixed">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper"
                            style="align-self: center;">

                        </div>
                        <div class="topbar">
                            <div class="dropdown" id="kt_quick_search_toggle">
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content d-flex flex-column flex-column-fluid mt-0 pt-0  full-height" id="kt_content">
                    <div class="row p-1 m-0 w-100 full-height">
                        <div class="col-9 full-height mide-menu pr-0">
                            <div class="row h-49 w-100 m-0 p-0" v-for="h in 3">

                                @foreach ($room_all as $room)
                                    <div class="col-4 h-100 p-1 pt-3" v-for="m in 4">
                                        <div class="box-data">
                                            <div class="row m-0">
                                                <div class="col-12 text-right mt-2"><b>{{ $room['room_name'] }}</b></div>

                                                <div class="col-2">H.N.</div>
                                                <div class="col-4">Name</div>
                                                <div class="col-4">Procedure</div>


                                                <div class="col-12 registered">
                                                    <div>
                                                        &nbsp;
                                                    </div>


                                                    @php
                                                        // dd($room);

                                                    @endphp

                                                    @forelse ($arr as $a)
                                                        <div class="row">
                                                            <div class="col-2">
                                                                {{ $a['hn'] }}
                                                            </div>
                                                            <div class="col-4">
                                                                {{ $a['patientname'] }}
                                                            </div>
                                                            <div class="col-4   ">
                                                                @foreach ($a['procedure'] as $key => $value)
                                                                    <a
                                                                        class="btn btn-{{ @$a['color'][$key] }} btn-sm p-1">{{ $value }}</a>
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                    @empty
                                                        <div class="row">
                                                            <div class="col-12" style="text-align: center;">
                                                                No Operation !!
                                                            </div>
                                                        </div>
                                                    @endforelse


                                                </div>

                                                <div class="col-12">
                                                    <br>
                                                    <hr class="hr-table" style="">
                                                </div>


                                                <div class="col-12 roomall registered connectedSortable"
                                                    room="{{ $room['room_id'] }}">
                                                    <div class="row  ui-state-default" divname="mmsljl">
                                                        &nbsp;
                                                    </div>

                                                    @php
                                                        $room_new = (int) $room['room_id'];

                                                        $job = Mongo::table('tb_casemonitor')
                                                            ->wherein('monitor_procedure', $procedure_in)
                                                            ->where('monitor_room', $room_new)
                                                            ->where('monitor_status', '!=', 'Success')
                                                            ->where('monitor_status', '!=', 'Cancel')
                                                            ->where('monitor_status', '!=', 'Recovery')
                                                            ->where('monitor_status', '!=', 'Operation')
                                                            ->where('monitor_status', '!=', 'Reporting')
                                                            ->orderby('monitor_status', 'desc')
                                                            ->orderby('monitor_order')
                                                            ->get();
                                                        unset($arr);
                                                        $arr = [];
                                                        foreach ($job as $book) {
                                                            $book = (object) $book;
                                                            $arr[$book->monitor_hn]['hn']               = '' . @$book->monitor_hn;
                                                            $arr[$book->monitor_hn]['caseuniq']         = '' . @$book->caseuniq;
                                                            $arr[$book->monitor_hn]['timevisit']        = '' . @$book->monitor_timevisit;
                                                            $arr[$book->monitor_hn]['room']             = '' . @$book->monitor_room;
                                                            $arr[$book->monitor_hn]['location']         = '' . @$book->monitor_location;
                                                            $arr[$book->monitor_hn]['procedure'][]      = '' . @$book->monitor_procedure;
                                                            $arr[$book->monitor_hn]['patientname']      = '' . @$book->monitor_patientname;
                                                            $arr[$book->monitor_hn]['prediagnostic']    = '' . @$book->monitor_prediagnostic;
                                                            $arr[$book->monitor_hn]['doctorname']       = '' . @$book->monitor_doctorname;
                                                            $arr[$book->monitor_hn]['remark']           = '' . @$book->monitor_remark;
                                                        }
                                                        $ii = 1;
                                                    @endphp

                                                    @foreach ($arr as $a)
                                                        <div id="{{ $a['caseuniq'] }}" class="row  ui-state-default"
                                                            divname="mmsljl"
                                                            style="border-bottom:1px solid gray;margin-top:5px">

                                                            <div id="order{{ $a['caseuniq'] }}" class="col-1"
                                                                style="display: none">
                                                                {{ $ii }}
                                                                @php
                                                                    $ii++;
                                                                @endphp
                                                            </div>
                                                            <div class="row">

                                                                {{-- <div id="div{{ $a['caseuniq'] }}" class="col-2 time"
                                                                    caseuniq="{{ $a['caseuniq'] }}">

                                                                    @if ($a['timevisit'] == 0)
                                                                        <a class="btn btn-primary btn-sm    ">Check in</a>
                                                                    @else
                                                                        <a class="btn btn-default btn-sm p-1"
                                                                            style="color: black">
                                                                            {{ $a['timevisit'] }}
                                                                        </a>
                                                                    @endif
                                                                </div> --}}
                                                                <div class="col-2">
                                                                    {{ $a['hn'] }}
                                                                </div>
                                                                <div class="col-4">
                                                                    {{ $a['patientname'] }}
                                                                </div>
                                                                <div class="col-6">

                                                                    @foreach ($a['procedure'] as $key => $value)
                                                                        <mark>{{ $value }}</mark>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                            <div class="col-2">&nbsp;</div>
                                                            <div class="col-10">
                                                                {{ $a['doctorname'] }}
                                                            </div>

                                                            <div class="col-2">
                                                                {{ $a['location'] }}
                                                            </div>
                                                            <div class="col-10 text-danger">
                                                                @if ($a['prediagnostic'] != '')
                                                                    {{ $a['prediagnostic'] }}
                                                                    @if ($a['remark'] != '')
                                                                        <br>
                                                                    @endif
                                                                @endif
                                                                {{ $a['remark'] }}
                                                            </div>

                                                        </div>
                                                    @endforeach



                                                </div>


                                                <div class="col-12 set_footer p-0">
                                                    <div class="row m-0 w-100">
                                                        <div class="col-6 pl-2 pr-1">
                                                            Endoscopist &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="row m-0">
                                                                @php
                                                                    $doctor_room = Mongo::table('tb_room')
                                                                        ->where('room_id', $room['room_id'])
                                                                        ->first();
                                                                    $doctor_json = jsonDecode($doctor_room['room_doctor']);
                                                                @endphp
                                                                @foreach ($doctor_json as $d)
                                                                    <div class="col-6 p-1">
                                                                        @php
                                                                            $user = Mongo::table('users')
                                                                                ->where('id', $d)
                                                                                ->first();
                                                                        @endphp
                                                                        {{ @$user->user_prefix }}{{ @$user->user_firstname }}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-6 pl-1">
                                                            Nurse and Practical &nbsp;&nbsp;&nbsp;&nbsp;
                                                            <div class="row m-0">
                                                                @php
                                                                    $nurse_room = Mongo::table('tb_room')
                                                                        ->where('room_id', $room['room_id'])
                                                                        ->first();
                                                                    $nurse_json = jsonDecode($nurse_room['room_nurse']);
                                                                @endphp
                                                                @foreach ($nurse_json as $d)
                                                                    <div class="col-6 p-1">
                                                                        @php
                                                                            $user = Mongo::table('users')
                                                                                ->where('id', $d)
                                                                                ->first();
                                                                        @endphp
                                                                        {{ @$user['user_prefix'] }}{{ @$user['user_firstname'] }}
                                                                    </div>
                                                                @endforeach

                                                                @php
                                                                    $register_room = Mongo::table('tb_room')
                                                                        ->where('room_id', $room['room_id'])
                                                                        ->first();
                                                                    $register_json = jsonDecode($register_room['room_register']);
                                                                @endphp
                                                                @foreach ($register_json as $d)
                                                                    <div class="col-6">
                                                                        @php
                                                                            $user = Mongo::table('users')
                                                                                ->where('id', $d)
                                                                                ->first();
                                                                        @endphp
                                                                        {{ @$user['user_prefix'] }}{{ @$user['user_firstname'] }}
                                                                    </div>
                                                                @endforeach





                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-3 full-height">
                            <div class="row full-height" style="overflow: auto;">
                                <div class="col-12 pt-3" style="height: 14vh;">
                                    <div class="box-data row m-0">

                                        <div class="col-6 text-center">
                                            <h1>Remaining</h1>
                                            <h1 class="display-4">{{ $count_regis }}/{{ $count_all }}</h1>
                                        </div>
                                        <div class="col-6 text-center" style="background-color:#212020">
                                            <h2>
                                                {{ $date }}&nbsp;&nbsp;&nbsp;&nbsp;<m id="time">00:00:00</m>
                                            </h2>
                                            <h2>
                                                <m>{{ $full_date }}</m>
                                            </h2>
                                        </div>
                                    </div>

                                </div>


                                <div class="col-12 height-4" style="height: 55vh !important;">
                                    <div class="box-data row m-0">

                                        <div class="col-12 table-responsive" style="height: 55vh;">
                                            <div class="col-12 text-right m-0">

                                                <h2 class="mb-1 mt-1">No Room</h2>
                                            </div>

                                            <div class="row m-0">
                                                <div class="col-2"></div>
                                                <div class="col-2">H.N.</div>
                                                <div class="col-4">Name</div>
                                                <div class="col-4">Location</div>
                                            </div>
                                            <div class="col-12 roomall registered connectedSortable" room="0"
                                                style="max-height: 50em;">
                                                <div>
                                                    &nbsp;
                                                </div>

                                                <style>
                                                    data-content {
                                                        background-color: #ff00ff;
                                                    }
                                                </style>
                                                @foreach ($list_room_unselect as $job)
                                                    {{-- @dd($job) --}}
                                                    <div id="{{ @$job->caseuniq }}" class="row"
                                                        style="border-bottom:1px solid gray">
                                                        {{-- <div class="col-2">
                                                            @if ($job['timevisit'] == '0')
                                                                <a class="btn btn-primary btn-sm p-1"
                                                                    data-container="body" data-toggle="popover"
                                                                    data-placement="left"
                                                                    data-content="Register">Check</a>
                                                            @else
                                                                <a class="btn btn-default btn-sm p-1"
                                                                    data-container="body" data-toggle="popover"
                                                                    data-placement="left" data-content="Holding"
                                                                    style="color: black">
                                                                    {{ $job['timevisit'] }}
                                                                </a>
                                                            @endif
                                                        </div> --}}
                                                        <div class="col-2 p-1">
                                                            {{ $job['hn'] }}
                                                        </div>
                                                        <div class="col-3 p-1">
                                                            {{ $job['patientname'] }}
                                                        </div>
                                                        <div class="col-7 p-1">
                                                            @foreach ($job['procedure'] as $key => $value)
                                                                <mark>{{ $value }}</mark>
                                                            @endforeach
                                                        </div>

                                                        <div class="col-2">{{ $job['location'] }}</div>

                                                        <div class="col-10 text-danger">
                                                            {{ $job['remark'] }}
                                                        </div>
                                                        <div class="col-2">&nbsp;</div>
                                                        <div class="col-10">
                                                            {{ $job['doctorname'] }}
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 height-2 pt-0" style="display: none">
                                    <div class="box-data row m-0">
                                        <div class="col-12 text-right">
                                            <h2 class="mt-1 mb-1">Booked</h2>
                                        </div>

                                        <div class="col-12 table-responsive set-height-25">
                                            <div class="row m-0">
                                                <div class="col-2"></div>
                                                <div class="col-2">H.N.</div>
                                                <div class="col-4">Name</div>
                                                <div class="col-4">Procedure</div>
                                            </div>
                                            <div class="col-12 roomall registered connectedSortable" room="0">
                                                <div>
                                                    &nbsp;
                                                </div>


                                                @foreach ($list_booking as $job)
                                                    <div id="{{ @$job->caseuniq }}" class="row"
                                                        style="border-bottom:1px solid gray">
                                                        <div class="col-2"><a class="btn btn-primary btn-sm p-1">Check
                                                                in</a></div>
                                                        <div class="col-2">
                                                            {{ $job['hn'] }}
                                                        </div>
                                                        <div class="col-3">
                                                            {{ $job['patientname'] }}
                                                        </div>


                                                        <div class="col-5">
                                                            @foreach ($job['procedure'] as $key => $value)
                                                                <mark>{{ $value }}</mark>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-2"></div>
                                                        <div class="col-10 text-danger">
                                                            {{ $job['remark'] }}
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 m-0  height-3" style="height: 30vh;">
                                    <div class="box-data">
                                        <div class="row m-0 full-height">
                                            <div class="col-12 bg-dark-tv">
                                                <textarea id="nurse_monitor" placeholder="Freetext" name="" class="form-control bg-dark-tv" rows="8">{{ $writeboard }}</textarea>
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
    </div>


    <div class="modal fade" id="modal_doctor">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <h2 class="text-center text-dark">Select Doctor</h2>
                    <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal"
                        aria-label="Close">
                        X
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <form action="{{ url('casemonitor') }}" method="post">
                        @csrf
                        <input type="hidden" name="event" value="doctor_select">
                        <div class="row">
                            <div class="col-12">
                                <input id="room_inmodal" type="hidden" name="room">
                            </div>
                            @foreach ($doctor as $user)
                                <div class="col-4 text-dark mt-3">
                                    <input name="doctor[]" value="{{ $user['id'] }}" type="checkbox" class="doctor"
                                        id="doctor{{ $user['id'] }}">
                                    <label for="doctor{{ $user['id'] }}">&nbsp;
                                        {{ $user['user_prefix'] }}{{ $user['user_firstname'] }}
                                        {{ $user['user_lastname'] }}</label>
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
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header p-0">
                    <h2 class="text-center text-dark">Select Nurse</h2>
                    <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal"
                        aria-label="Close">
                        X
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('casemonitor') }}" method="post">
                        @csrf
                        <input type="hidden" name="event" value="nurse_select">
                        <div class="row">
                            <div class="col-12">
                                <input id="room_nurse" type="hidden" name="room">
                            </div>
                            <div class="col-12">
                                {!! userSELECT(
                                    'nurse01',
                                    'เลือกพยาบาล',
                                    $nurse,
                                    @$case->case_physicians01,
                                    'class="form-control autosave savedoctor" required',
                                ) !!}
                                {!! userSELECT(
                                    'nurse02',
                                    'เลือกพยาบาล',
                                    $nurse,
                                    @$case->case_physicians01,
                                    'class="form-control autosave savedoctor mt-2" required',
                                ) !!}
                                <button type="submit" class="btn btn-success btn-block mt-4 btn-save">บันทึก</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalcomment" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <label id="modal_label"></label>
                    <input id="modal_caseid" type="text" hidden>
                    <textarea id="modal_textarea" rows="4" cols="50" style="width: 100%;"></textarea>
                </div>
                <div class="modal-footer">
                    <button id="modal_submit" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ url('public/plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>



    <script>
        $('#nurse_monitor').focusout(function() {
            var text = $(this).val();
            $.post("{{ url('casemonitor') }}", {
                    event: 'update_nursemonitor',
                    text: text,
                },
                function(data, status) {});
        });

        $('.calldoctor').click(function() {
            var room = $(this).attr('room');
            $('#room_inmodal').val(room);
            $('#modal_doctor').modal('show');
            $.post("{{ url('casemonitor') }}", {
                    event: 'getdoctor',
                    room: room,
                },
                function(data, status) {
                    obj = JSON.parse(data);
                    $('.doctor').prop('checked', false);
                    obj.forEach(function(item) {
                        $('#doctor' + item).prop('checked', true);
                        console.log(item);
                    });
                });
        });

        $('.callnurse').click(function() {
            var room = $(this).attr('room');
            $('#room_nurse').val(room);
            $('#modal_nurse').modal('show');
            $.post("{{ url('casemonitor') }}", {
                    event: 'getnurse',
                    room: room,
                },
                function(data, status) {
                    var obj = JSON.parse(data);
                    $('#nurse01').val(obj[0]).change();
                    $('#nurse02').val(obj[1]).change();
                });
        });





        $(function() {
            $("#basket,#basket22").sortable({
                revert: true
            });

            $(".list-item").draggable({
                connectToSortable: "#basket,#basket22",
                helper: "clone",
                revert: "invalid"
            });

            $("ul, li").disableSelection();
        });


        $('.time').click(function() {
            var caseuniq = $(this).attr('caseuniq');
            console.log(caseuniq);
            $.post("{{ url('casemonitor') }}", {
                    event: 'timechange',
                    caseuniq: caseuniq,
                },
                function(data, status) {
                    $('#div' + caseuniq).html(data);
                    console.log(caseuniq, data);
                });
        })
    </script>





    <script type="text/javascript">
        var timestamp = '<?= time() ?>';

        function updateTime() {

            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            h = checkTime(h);
            var realtime = h + ":" + m + ":" + s;

            $('#time').html(realtime);
            timestamp++;
        }
        $(function() {
            setInterval(updateTime, 1000);
        });

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
    </script>

    <script>
        $('.room_status').click(function() {
            var ready_status = $(this).attr('ready_status');
            var case_id = $(this).attr('case_id');
            popmenu({
                items: {
                    rr: {
                        name: 'RR',
                        icon: '<i class="fa fa-home"></i>'
                    },
                    ready: {
                        name: 'พร้อม',
                        icon: '<i class="fa fa-facebook"></i>'
                    },
                },
                callback: function(item) {

                    var id = $(item).attr('id');
                    var val = 0;
                    if (id === "rr") {
                        val = 0;
                        $('#ready' + case_id).attr('src', 'public/url_monitor/clock.png');
                    }
                    if (id === "ready") {
                        val = 1;
                        $('#ready' + case_id).attr('src', 'public/url_monitor/user.png');
                    }
                    $.post("{{ url('api/photomove') }}", {
                            event: 'ready_status',
                            case_id: case_id,
                            ready_status: ready_status,
                            val: val,
                        },
                        function(data, status) {});
                }
            });
            return false;
        });

        $('.room_comment').click(function() {
            var title = $(this).attr('title');
            var patient_name = $(this).attr('patient_name');
            var case_id = $(this).attr('case_id');

            $('#modalcomment').modal('show');

            $('#modal_textarea').val('');
            $('#modal_label').html(patient_name);
            $('#modal_caseid').val(case_id);
            $('#modal_textarea').val(title);
            $('#callmodal').trigger('click');
        });


        $('#modal_submit').click(function() {
            var case_id = $('#modal_caseid').val();
            var val = $('#modal_textarea').val();
            $.post("{{ url('api/photomove') }}", {
                event: 'ready_comment',
                case_id: case_id,
                val: val
            }, function(data, status) {});
            $('#readycomment' + case_id).attr('title', val);
        });


        $(".nurse").change(function() {
            var room = $(this).attr('room');
            var nurse = $(this).attr('nurse');
            var val = $(this).val();
            $.post("{{ url('api/photomove') }}", {
                    event: 'nursechange',
                    room: room,
                    nurse: nurse,
                    val: val
                },
                function(data, status) {});
        });







        $('.readyall').click(function() {
            var room = $(this).attr('id');
            var ready = $(this).attr('ready');
            var val = 0;
            if (ready == 0) {
                val = 1;
            } else {
                val = 0;
            }
            $.post("{{ url('api/photomove') }}", {
                    event: 'room_setready',
                    room: room,
                    val: val
                },
                function(data, status) {});
            $(this).attr('ready', val);
        });
    </script>


    <script>
        $(".roomall").sortable({
            connectWith: ".connectedSortable",
            stop: function(event, ui) {
                $('.connectedSortable').each(function() {
                    result = "";
                    var room = $(this).attr('room');
                    var val = $(this).sortable("toArray");
                    var ii = 1;
                    val.forEach(function(item) {
                        if (item != "") {
                            $('#order' + item).html(ii);
                            ii++;
                        }
                    });

                    console.log(room, val);

                    $.post("{{ url('casemonitor') }}", {
                            event: 'roomchange',
                            room: room,
                            val: val
                        },
                        function(data, status) {});
                });
            }
        });
    </script>


    <script src="http://{{ $_SERVER['SERVER_NAME'] }}:3000/socket.io/socket.io.js"></script>
    <script>
        var socket = io.connect('http://{{ $_SERVER['SERVER_NAME'] }}:3000');
        socket.on('chat message', function(msg) {
            if (msg == "casemonitor") {
                location.reload();
            }
        });
    </script>
@endsection
