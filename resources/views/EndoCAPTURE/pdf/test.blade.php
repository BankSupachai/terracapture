@php

    if(isset($_GET['sdate'])){
            $sdate = substr(@$_GET['sdate'],0,10);
            $sdate = date("d-m-Y",$sdate);
        }else{
            $sdate = "";
        }

        $s_year = date('Y');
        if(isset($_GET['year'])){
            if($_GET['year']!="all"){
                $s_year = $_GET['year'];
            }
        }

        $s_month = '%';
        if(isset($_GET['month'])){
            if($_GET['month']!="all"){
                $s_month = $_GET['month'];
            }
        }

        $s_procedure = array('case_dateregister','like','%');
        if(isset($_GET['procedure'])){
            if($_GET['procedure']!="all"){
                $s_procedure = array('case_dateregister','=',$_GET['procedure']);
            }
        }

        $s_gender = array('gender','like','%');
        if(isset($_GET['gender'])){
            if($_GET['gender']!="all"){
                $s_gender = array('gender','=',$_GET['gender']);
            }
        }

        $s_doctor = array('case_physicians01','like','%');
        if(isset($_GET['doctor'])){
            if($_GET['doctor']!="all"){
                $s_doctor = array('case_physicians01','=',$_GET['doctor']);
            }
        }

        $s_finding = array('finding_comment','like','%');
        if(isset($_GET['finding'])){
            if($_GET['finding']!="all"){
                $s_finding = array('finding_comment','like','%'.$_GET['finding'].'%');
            }
        }
@endphp


@php
    $procedure = DB::table('tb_procedure')->get();
@endphp


@php

$whe[0]     = array('case_dateappointment','like',$s_year.'-'.$s_month.'%');
$whe[1]     = $s_gender;
$whe[2]     = $s_procedure;
$whe[3]     = $s_doctor;
$whe[4]     = array('case_status','!=',90);
$diagnostic = DB::table('tb_case')
->leftjoin('patient','patient.hn','tb_case.case_hn')
->where($whe)
->get();


            $arrayall = array();
        foreach($diagnostic as $di){
            $json = jsonDecode($di->case_json);
            foreach($json as $j){
                if($j!=""){
                    $arrayall[] = $j;
                }
            }
        }

        $sorticd10 = array_count_values($arrayall);
        arsort($sorticd10);
@endphp


@php
        $room = DB::table('tb_room')->get();
@endphp
@foreach($room as $p)
@php
    $wh[0]   = array('case_dateappointment','like',$s_year.'-'.$s_month.'%');
    $wh[1]   = $s_doctor;
    $wh[2]   = $s_gender;
    $wh[3]   = array('case_status','!=',90);
    $procount = DB::table('tb_case')
    ->leftjoin('patient','patient.hn','tb_case.case_hn')
    ->where($wh)
    ->count();
@endphp

@if(isset($_GET['room']))
    @if($_GET['room']==$p->id)
        [0, {{$procount}}, "{{$p->name}}"],
    @endif
    @if($_GET['room']=="all")
        [0, {{$procount}}, "{{$p->name}}"],
    @endif
@else
    [0, {{$procount}}, "{{$p->name}}"],
@endif
@endforeach
