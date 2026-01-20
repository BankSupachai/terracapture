<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patient TV</title>
    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">
    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .swiper:not(.swiper-watch-progress) .swiper-lazy-preloader {
            animation: swiper-preloader-spin 10s infinite linear
        }



        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: Light;
            src: url("{{ url('public/fonts/Kanit-Light.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: Light;
            src: url("{{ url('public/fonts/Kanit-Light.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: Light;
            src: url("{{ url('public/fonts/Kanit-Light.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: Light;
            src: url("{{ url('public/fonts/Kanit-ExtraBoldItalic.ttf') }}") format("truetype");
        }

        * {
            font-family: 'Kanit', sans-serif !important;
        }

        body {
            background: #222529;
            /* overflow: hidden; */
            padding: 2rem;
        }

        .text-header-incharge {
            font-size: 40px;
        }

        span {
            color: #BBBBBB;
            font-size: 20px;
        }

        .text-header-incharge {
            font-size: 40px;
        }

        .card {
            background: #2B2F34;
            box-shadow: 0 4px 4px 0 #0000001a;

        }

        .badge {
            border-radius: 0px 4px 0 0 !important;
            padding: 15px 0 15px 0;
        }

        .text-time {
            color: #bbbbbb;
        }

        .border-bottom {
            border-bottom: 1px solid #BBBBBB;
        }

        .footer-incharge {
            position: absolute;
            color: #FFFFFF80;
            bottom: 0.5em;
        }
    </style>
</head>

<body>
    @php
        use App\Models\Mongo;

        $count_incharge = Mongo::table('tb_casemonitor')->where('monitor_status', '=', 'Holding')->count();

        $count_discharge = Mongo::table('tb_casemonitor')
            ->where(['monitor_status' => 'Holding'])
            ->count();
        $count_remain_inchage = $count_incharge + $count_discharge;
    @endphp
    <div class="row m-0">
        <div class="col-lg-7">
            <div class="row">
                <div class="col-6">
                    <span class="text-header-incharge">Remaining Case
                        {{ @$count_incharge }}/{{ @$count_remain_inchage }}</span>
                </div>
                @php
                    $datetime = DateTime::createFromFormat('YmdHi', date('YmdHi'));
                    $month = date('F');
                @endphp
                <div class="col-6 text-end">
                    <span class="text-time h6">{{ $datetime->format('D') }}, {{ $month }} &nbsp;
                        {{ date('d/m/Y') }}</span> <br>
                    <span id="time" class="text-header-incharge pt-0 "></span>
                </div>
            </div>
            @include('EndoCAPTURE.nurse_monitor.incharge.operation')
        </div>
        <div class="col-lg-5">
            @include('EndoCAPTURE.nurse_monitor.incharge.holding')
        </div>
    </div>
    <script src="{{ url('assets/js/app.js') }}"></script>
    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ url('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/swiper.init.js') }}"></script>
    <script src="{{ url('assets/libs/prismjs/prism.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @include('layouts.layouts_index.plugins')
    @include('layouts.layouts_index.plugins2')

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
            // console.log(realtime);
            document.getElementById("time").innerHTML = realtime;
            timestamp++;
        }
        setInterval(updateTime, 1000);

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }
        // $(".roomshow").click(function(){
        //     let room = $(this).attr('room')
        //     $(".roomholding").hide();
        //     $("#room_holding"+room).show();
        // })

        // $("#roomshow").change(function() {
        //     let room = $(this).find("option:selected").attr('room');
        //     $(".roomholding").hide();
        //     $("#room_holding" + room).show();
        // });

        // <script>
        $(document).ready(function() {
            $(".roomshow").click(function() {
                let room = $(this).attr('room');
                console.log(room);
                $(".tab-pane").removeClass('active');
                $("#room_holding" + room).addClass('active');
            });
        });
    </script>
</body>

</html>
