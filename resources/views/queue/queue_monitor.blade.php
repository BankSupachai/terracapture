<!DOCTYPE html>
<html lang="en">
<head>
    <title>Monitor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('public/url_monitor/popmenu.css')}}">
    <link rel="stylesheet" href="{{url('public/url_monitor/bootstrap-switch-button.min.css')}}">
    <link rel="stylesheet" href="{{url('public/url_monitor/bootstrap.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{url('public/url_monitor/w3.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('public/css/queue/monitor.css')}}">

</head>
    <body class="bg">

@php

    $today  = array('case_dateappointment','like',date("Y-m-d").'%');
    $status = array('case_status',0);

    $case   = DB::table('tb_case')
    ->join('users','users.id','tb_case.case_physicians01')
    ->join('patient','patient.hn','tb_case.case_hn')
    ->join('tb_procedure','tb_procedure.procedure_code', 'tb_case.case_procedurecode')
    ->where([$today,$status])
    ->orderBy('case_id', 'desc')
    ->get();


    $status         = array('case_status',1);
    $case_doing     = DB::table('tb_case')
    ->join('users','users.id','tb_case.case_physicians01')
    ->join('patient','patient.hn','tb_case.case_hn')
    ->join('tb_procedure','tb_procedure.procedure_code', 'tb_case.case_procedurecode')
    ->where([$today,$status])
    ->orderBy('case_id', 'desc')
    ->get();



    $status         = array('case_status',2);
    $case_complete  = DB::table('tb_case')
    ->join('users','users.id','tb_case.case_physicians01')
    ->join('patient','patient.hn','tb_case.case_hn')
    ->join('tb_procedure','tb_procedure.procedure_code', 'tb_case.case_procedurecode')
    ->where([$today,$status])
    ->orderBy('case_id', 'desc')
    ->get();





    $count_today = DB::table('tb_case')
    ->where([$today])
    ->count();



    $status = array('case_status',0);
    $count_regis = DB::table('tb_case')
    ->where([$today,$status])
    ->count();

    $status = array('case_status',1);
    $count_operation = DB::table('tb_case')
    ->where([$today,$status])
    ->count();

    $status = array('case_status',2);
    $count_finish = DB::table('tb_case')
    ->where([$today,$status])
    ->count();

@endphp

<div class="row" style="    width: 100%;margin: 0;">
    <div class="col-4"   style= "background-color: #fff;">
        <table style="width: 100%;height: 100%;">
            <tr>
                <td rowspan="2" style="width: 25%;"><img src="{{url("public/image/logo.png")}}"></td>
                <td style="vertical-align: bottom;font-size: xx-large;color: #ae06b1;text-shadow: 1px 0px black;">โรงพยาบาลมหาราชนครราชสีมา</td>
            </tr>
            <tr>
                <td style="    color: #b7b4b4;vertical-align: top;font-size: larger;">MAHARAT NAKHON RATCHASIMA HOSPITAL</td>
            </tr>
        </table>
    </div>
    <div class="col-8" style="background: linear-gradient(90deg, rgba(0,0,0,1) 28%, rgba(179,0,255,1) 100%);padding: 10px;"><h1 style="text-align: center;">ศูนย์ส่องกล้องระบบทางเดินอาหาร</h1></div>
</div>

@php
    $wait = count($case);
    $do   = count($case_doing);
    $pust = count($case_complete);
    $max = max($wait,$do,$pust);
    foreach($case as $c){
        $lastname = mb_substr($c->lastname,0,1,'UTF-8');
        $s_wait[] = $c->firstname." ".$lastname;
    }
    foreach($case_doing as $c){
        $lastname = mb_substr($c->lastname,0,1,'UTF-8');
        $s_do[] = $c->firstname." ".$lastname;
    }
    foreach($case_complete as $c){
        $lastname = mb_substr($c->lastname,0,1,'UTF-8');
        $s_pust[] = $c->firstname." ".$lastname;
    }
@endphp
<div class="clearfix"></div>
<div class="col-12" style="margin-top: 1%;">
    <table class="w3-table w3-striped newtable" border="0">
        <tr class="tr_th">
            <th>รอส่องกล้อง</th>
            <th>กำลังส่องกล้อง</th>
            <th>พักพื้น</th>
        </tr>

        @for($i=0;$i<$max;$i++)
        <tr>
            <td>{{@$s_wait[$i]}}</td>
            <td>{{@$s_do[$i]}}</td>
            <td>{{@$s_pust[$i]}}</td>
        </tr>
        @endfor

        @for($x=$max;$x<=10;$x++)
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        @endfor
        <tr>
            <td>จำนวน = {{$wait}}</td>
            <td>จำนวน = {{$do}}</td>
            <td>จำนวน = {{$pust}}</td>
        </tr>
    </table>
</div>

    </body>
</html>

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/popper.min.js')}}"> </script>
<script src="{{url('public/js/bootstrap.min.js')}}"> </script>
<script src="{{asset('public/js/waves.js')}}"></script>
<script src="{{asset('public/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/plugins/responsive-table/js/rwd-table.min.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/jquery.core.js')}}"></script>
<script src="{{asset('public/js/jquery.app.js')}}"></script>
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
