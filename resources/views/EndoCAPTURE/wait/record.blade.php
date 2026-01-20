@extends('layouts.small-scale')

@section('style')
<style>
    body{
        background: black;
    }
    .top-nav{
        border-bottom: none;
    }
</style>
@endsection
@section('modal')

@endsection
@section('content')

<div class="row page-rocord">
    <div class="col-3 menu-left-record">
        <table class="table table-borderless text-white table-f mt-2 mb-0">
            <tr>
                <td>Patient ID :</td>
                <td>{{rand(11111,99999)}}</td>
            </tr>
            <tr>
                <td>Name :</td>
                <td>สดายุ ทองลอย</td>
            </tr>
            <tr>
                <td>Gender :</td>
                <td>Male</td>
            </tr>
            <tr>
                <td>Age :</td>
                <td>40</td>
            </tr>
            <tr>
                <td colspan="2">Description :</td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">Images (10)</td>
            </tr>
        </table>
        <div class="box-image">
            @for($i=10;$i>=1;$i--)
            <div class="box-img-list">
                <div class="number-img">{{$i}}</div>
                <img src="{{url('public/images/2462_1_2563_10_07_12_15_57.png')}}" alt="">
            </div>
            @endfor
        </div>
    </div>
    <div class="col">
        <img src="{{url('public/images/2462_1_2563_10_07_12_15_57.png')}}" class="w-100">
    </div>
    <div class="menu-right col-1">
        <div class="box capture"><i class="bx bxs-camera"></i></div>
        <div class="box record"><i class="bx bx-radio-circle-marked"></i><div class="f-14 text-white time-run"><span class="hour">00</span>:<span class="minute">00</span>:<span class="second">01</span></div></div>
        <div class="box finish"><b>Finish</b></div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(".record").on('click',function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active')
            timer.stop()
        }else{
            $(this).addClass('active')
            timer.mode(1)
            timer.start(1000)
        }
    })
</script>

<script>
    function _timer(callback){
        var time = 0;
        var mode = 1;
        var status = 0;
        var timer_id;

        this.start = function(interval)
        {
            interval = (typeof(interval) !== 'undefined') ? interval : 1000;

            if(status == 0)
            {
                status = 1;
                timer_id = setInterval(function()
                {
                    switch(mode)
                    {
                        default:
                        if(time)
                        {
                            time--;
                            generateTime();
                            if(typeof(callback) === 'function') callback(time);
                        }
                        break;

                        case 1:
                        if(time < 86400)
                        {
                            time++;
                            generateTime();
                            if(typeof(callback) === 'function') callback(time);
                        }
                        break;
                    }
                }, interval);
            }
        }

        this.stop =  function()
        {
            if(status == 1)
            {
                status = 0;
                clearInterval(timer_id);
            }
        }

        this.reset =  function(sec)
        {
            sec = (typeof(sec) !== 'undefined') ? sec : 0;
            time = sec;
            generateTime(time);
        }

        this.mode = function(tmode)
        {
            mode = tmode;
        }

        this.getTime = function()
        {
            return time;
        }

        this.getMode = function()
        {
            return mode;
        }

        this.getStatus
        {
            return status;
        }

        function generateTime()
        {
            var second = time % 60;
            var minute = Math.floor(time / 60) % 60;
            var hour = Math.floor(time / 3600) % 60;

            second = (second < 10) ? '0'+second : second;
            minute = (minute < 10) ? '0'+minute : minute;
            hour = (hour < 10) ? '0'+hour : hour;

            $('span.second').html(second);
            $('span.minute').html(minute);
            $('span.hour').html(hour);
        }
    }

    var timer;

    $(document).ready(function(e)
    {
        timer = new _timer
        (
            function(time)
            {
                if(time == 0)
                {
                    timer.stop();
                    alert('time out');
                }
            }
        );
        timer.reset(0);
        timer.mode(0);
    });
</script>
@endsection
