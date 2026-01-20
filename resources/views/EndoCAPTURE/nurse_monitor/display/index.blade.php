<!DOCTYPE html>
<html lang="en" data-sidebar="dark" data-topbar="light" data-layout-mode="dark">
{{-- @dd(1); --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Case monitor display</title>
    <link rel="shortcut icon" href="{{url("public/images/favicon.png")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<script src="http://localhost/endoindex/public/js/jquery-3.6.0.min.js"></script>
<link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ url('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" rel="stylesheet" />
<link href="{{ url('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" rel="stylesheet" />
<link href="{{ url('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet" /> <!-- 'nano' theme -->

<style>
    @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: Light;
            src: url("{{ url('public/fonts/Kanit-Light.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-Bold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Italic.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-ExtraBoldItalic.ttf') }}") format("truetype");
        }

        * {
            font-family: 'Kanit', sans-serif;
        }
    [data-layout-mode=dark] {
        /* --vz-input-bg: #90571a; */
        --vz-body-bg: #222529;
    }

    body {
        padding: 1rem;
        color: #ffffffb3;

    }

    .bg-darkness {
        background: #2B2F34;
    }

    .badge-dark {
        background: #000;
        color: #fff;
    }

    .bg-dark-tv {
        background: #25292D;
    }
    ::-webkit-scrollbar {
  width: 3px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #888;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #f1f1f1;
}
[data-layout-mode=dark] .card {
    --vz-card-bg: #212020;
    --vz-card-cap-bg: #212020;
}
.height-right{
    height: 209px;
    overflow: auto;
    overflow-x: hidden;
}
.height-right-room2{
    height: 80vh;
    overflow: auto;
    overflow-x: hidden;
}
.fs-20{
    font-size: 20px;
}
.fs-18{
    font-size: 18px;
}
.fs-16{
    font-size: 16px;
}

.fs-14{
    font-size: 14px;
}
.fs-12{
    font-size: 12px;
}
.fs-16{
    font-size: 16px;
}
.fs-10{
    font-size: 10px;
}
.fs-9{
    font-size: 9px;
}
.fs-8{
    font-size: 8px;
}
</style>

<body>
    @php
    $layout = getCONFIG('layout');
    if (@$layout->casemonitor == 1) {
    $column = 1;

    }if (@$layout->casemonitor == 2) {
        $column = 2;

    }if (@$layout->casemonitor == 3) {
        $column = 3;

    }if (@$layout->casemonitor == 4) {
        $column = 4;

    }if (@$layout->casemonitor == 5) {
        $column = 5;

    }
    if (@$layout->casemonitor == 6) {
        $column = 6;

    }


@endphp
    <div class="row m-0">
        <div class="col-9">
            <div class="row">
                @php
                    $room = array();
                    $room["room_id"] = 0;
                    @endphp
                @foreach ($room_display ?? [] as $room)

                    @include("EndoCAPTURE.nurse_monitor.display.room")
                @endforeach
            </div>
        </div>
        <div class="col-3 px-1">
            @include("EndoCAPTURE.nurse_monitor.display.remaining")
            @include("EndoCAPTURE.nurse_monitor.display.roomno")
            @include("EndoCAPTURE.nurse_monitor.display.room_recovery")
            @include("EndoCAPTURE.nurse_monitor.display.officer")
            {{-- @include("EndoCAPTURE.nurse_monitor.display.writeboard") --}}
        </div>
    </div>
    <footer class="fs-16" style="position: fixed; bottom: 0; ">
        © 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
    </footer>

    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    @include('layouts.layouts_index.plugins')
    <script src="{{ url('public/plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script>
        window.setTimeout( function() {
            window.location.reload();
            }, 60000);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $('#nurse_monitor').focusout(function() {
            var text = $(this).val();
            $.post("{{url("casemonitor")}}",{
                event   : 'update_nursemonitor',
                text    : text,
            },function(data, status) {});
        });

        $('.calldoctor').click(function() {
            var room = $(this).attr('room');
            $('#room_inmodal').val(room);
            $('#modal_doctor').modal('show');
            $.post("{{url("casemonitor")}}", {
                event   : 'getdoctor',
                room    : room,
            },function(data, status) {
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
            $.post("{{ url("casemonitor") }}", {
                event   : 'getnurse',
                room    : room,
            },function(data, status) {
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
            $.post("{{url("casemonitor")}}", {
                event   : 'timechange',
                caseuniq: caseuniq,
            },function(data, status) {
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
            if (i<10){i="0"+i}; // add zero in front of numbers < 10
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
                    $.post("{{url("api/photomove")}}",{
                        event       : 'ready_status',
                        case_id     : case_id,
                        ready_status: ready_status,
                        val         : val,
                    },function(data,status){});
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
            $.post("{{url("api/photomove")}}",{
                event: 'ready_comment',
                case_id: case_id,
                val: val
            },function(data,status){});
            $('#readycomment' + case_id).attr('title', val);
        });

        $(".nurse").change(function() {
            var room    = $(this).attr('room');
            var nurse   = $(this).attr('nurse');
            var val     = $(this).val();
            $.post("{{url("api/photomove")}}", {
                event   : 'nursechange',
                room    : room,
                nurse   : nurse,
                val     : val
            },function(data, status) {});
        });

        $('.readyall').click(function(){
            var room    = $(this).attr('id');
            var ready   = $(this).attr('ready');
            var val     = 0;
            if(ready==0){val=1;}else{val=0;}
            $.post("{{ url("api/photomove")}}", {
                event   : 'room_setready',
                room    : room,
                val     : val
            },function(data,status){});
            $(this).attr('ready', val);
        });
    </script>


    <script>
        $(".roomall").sortable({
            connectWith: ".connectedSortable",
            stop: function(event, ui) {
                $('.connectedSortable').each(function() {
                    result      = "";
                    var room    = $(this).attr('room');
                    var val     = $(this).sortable("toArray");
                    var ii      = 1;
                    val.forEach(function(item) {
                        if (item != "") {
                            $('#order' + item).html(ii);
                            ii++;
                        }
                    });
                    $.post("{{url("casemonitor")}}",{
                        event   : 'roomchange',
                        room    : room,
                        val     : val
                    },function(data, status) {});
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
</body>
</html>
