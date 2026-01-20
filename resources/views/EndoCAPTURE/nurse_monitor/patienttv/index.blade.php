<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Patient TV</title>
    <link rel="shortcut icon" href="{{url("public/images/favicon.png")}}">
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
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
            background: #F3FAFF;
            /* overflow: hidden; */
        }

        .text-blue {
            color: #245788;
        }

        .row {
            margin: 0;
        }

        .card {
            box-shadow: 4px 1px 2px rgba(127, 131, 135, 0.15);
        }

        .border-bottom {
            border-bottom: 1px solid #E9EBEC;
            margin-top: 1em;
        }

        footer {
            bottom: 0;
            position: absolute;
            width: 100%;
            background: #fff;
            padding-left: 0;
        }

        .w-8{
            width: 8em;
        }
        .fs-20{font-size: 20px;}
        /* .swiper-wrapper{
            transition-duration: 1000ms !important;
            transition-delay: 1000ms !important;

        } */

    </style>
</head>

<body>
    <div class="row">
        <div class="col-lg-7 p-3 ">
            <div class="row">
                <div class="col-6">
                    <h3 class="text-blue h2 fw-bold">ติดตามผู้ป่วย</h3>
                </div>
                @php
                    $datetime = DateTime::createFromFormat('YmdHi', date('YmdHi'));
                    $month = date('F');
                @endphp
                <div class="col-6 text-end">
                    <span class="text-blue h6">{{ $datetime->format('D') }}, {{$month}} &nbsp; {{ date('d/m/Y') }}</span> <br>
                    <span id="time" class="text-blue h3 fw-bold"></span>
                </div>
                <div class="row mt-3">
                    <div class="swiper pagination-dynamic-swiper rounded">
                        <div class="swiper-wrapper" >
                            @include("Endocapture.nurse_monitor.patienttv.operation")
                            @include("Endocapture.nurse_monitor.patienttv.recovery")
                        </div>
                        <div class="swiper-pagination dynamic-pagination"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-5">
            @include("Endocapture.nurse_monitor.patienttv.waiting_discharge")
        </div>
    </div>
    <div class="row m-0 p-0 w-100 bg-white" style="position: absolute; bottom: 0;">
        <div class="col-auto  m-0 p-0">
            <div class="anc-logo bg-secondary">
                <span class="badge w-8  fs-18" style="border-radius: 0px; ">ประกาศ</span>
            </div>
        </div>
        <div class="col mt-1">
            <span class=" fs-20 fw-bold">หากท่านมีข้อสอบถามเพิ่มเติม
                สำหรับอาการของคนไข้สามารถสอบถามได้ที่แผนกส่องกล้องทางเดินอาหาร</span>
        </div>
    </div>
    </div>

    @php
        $admin          = getConfig('admin');
        $server_name    = $admin->server_name;
    @endphp

    <script type="text/javascript">

        var timestamp = '<?=time();?>';
        function updateTime(){
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
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
        }
    </script>

    <script src="{{ url('assets/js/app.js') }}"></script>
    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ url('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/swiper.init.js') }}"></script>
    <script src="{{ url('assets/libs/prismjs/prism.js') }}"></script>
    @include('layouts.layouts_index.plugins')
    @include('layouts.layouts_index.plugins2')




    <script src="http://{{ getCONFIG('admin')->server_name }}:3000/socket.io/socket.io.js"></script>
    <script>
        var socket = io.connect('http://{{ getCONFIG('admin')->server_name }}:3000');
        socket.on('chat message', function(msg) {
            if (msg == "casemonitor") {
                setTimeout(() => {

                    location.reload();
                }, 2000);
            }
        });

        socket.on('queue', function(msg) {
            // refreshdata();
            var calling = msg.search("calling");
            if(calling>0){
                var ex = JSON.parse(msg);
                QueueCALL(ex.calling);
            }
        });
    </script>


    <script>
       var ขอเชิญหมายเลข = new Audio("{{domainname("")}}/config/sound/queue/th/เชิญหมายเลข.wav");
    var sound0          = new Audio("{{domainname("")}}/config/sound/queue/th/0.wav");
    var sound1          = new Audio("{{domainname("")}}/config/sound/queue/th/1.wav");
    var sound2          = new Audio("{{domainname("")}}/config/sound/queue/th/2.wav");
    var sound3          = new Audio("{{domainname("")}}/config/sound/queue/th/3.wav");
    var sound4          = new Audio("{{domainname("")}}/config/sound/queue/th/4.wav");
    var sound5          = new Audio("{{domainname("")}}/config/sound/queue/th/5.wav");
    var sound6          = new Audio("{{domainname("")}}/config/sound/queue/th/6.wav");
    var sound7          = new Audio("{{domainname("")}}/config/sound/queue/th/7.wav");
    var sound8          = new Audio("{{domainname("")}}/config/sound/queue/th/8.wav");
    var sound9          = new Audio("{{domainname("")}}/config/sound/queue/th/9.wav");
    var soundA          = new Audio("{{domainname("")}}/config/sound/queue/th/A.wav");
    var soundC          = new Audio("{{domainname("")}}/config/sound/queue/th/C.wav");




    function QueueCALL(number){
        const myArr = number.split("");
        ขอเชิญหมายเลข.play();
        setTimeout(() => {myArr.forEach(numberQUEUE);}, 1000);
    }

    function numberQUEUE(item, index) {
        var time = (1+index)*1000;
        setTimeout(() => {
            if(item=="A"){soundA.play()}
            if(item=="C"){soundC.play()}
            if(item=="0"){sound0.play()}
            if(item=="1"){sound1.play()}
            if(item=="2"){sound2.play()}
            if(item=="3"){sound3.play()}
            if(item=="4"){sound4.play()}
            if(item=="5"){sound5.play()}
            if(item=="6"){sound6.play()}
            if(item=="7"){sound7.play()}
            if(item=="8"){sound8.play()}
            if(item=="9"){sound9.play()}
        }, time);
    }
</script>
<script>
    setTimeout(() => {
        location.reload();
    }, 60000);
</script>

</body>
</html>
