@extends('layouts.app')

@php

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

    $s_procedure = array('case_procedure','like','%');
    if(isset($_GET['procedure'])){
        if($_GET['procedure']!="all"){
            $s_procedure = array('case_procedure','=',$_GET['procedure']);
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




    $year2020 = DB::table('tb_case')
    ->leftjoin('patient','patient.id','tb_case.case_patientid')
    ->where([['case_dateappointment','like','2020-'.$s_month."%"],$s_procedure,$s_gender,$s_doctor])
    ->count();

    $year2019 = DB::table('tb_case')
    ->leftjoin('patient','patient.id','tb_case.case_patientid')
    ->where([['case_dateappointment','like','2019-'.$s_month."%"],$s_procedure,$s_gender,$s_doctor])
    ->count();

    $numallcase = $year2019+$year2020;

    $m01    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-01%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m02    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-02%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m03    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-03%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m04    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-04%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m05    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-05%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m06    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-06%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m07    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-07%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m08    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-08%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m09    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-09%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m10    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-10%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m11    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-11%"],$s_procedure,$s_gender,$s_doctor])->count();
    $m12    = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where([['case_dateappointment','like',$s_year."-12%"],$s_procedure,$s_gender,$s_doctor])->count();

    $w[0]   = array('case_dateappointment','like',$s_year.'-'.$s_month.'%');
    $w[1]   = array('gender','1');
    $w[2]   = $s_procedure;
    $w[3]   = $s_doctor;
    $man00  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2543','01-01-2563'])->count();
    $man20  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2523','01-01-2543'])->count();
    $man40  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2503','01-01-2523'])->count();
    $man60  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2493','01-01-2503'])->count();
    $man80  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2400','01-01-2493'])->count();

    $w[1]   = array('gender','2');
    $woman00  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2543','01-01-2563'])->count();
    $woman20  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2523','01-01-2543'])->count();
    $woman40  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2503','01-01-2523'])->count();
    $woman60  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2493','01-01-2503'])->count();
    $woman80  = DB::table('tb_case')->leftjoin('patient','patient.id','tb_case.case_patientid')->where($w)->whereBetween('birthdate',['01-01-2400','01-01-2493'])->count();







@endphp























@section('title', 'EndoINDEX')
@section('content')

<style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
</style>






<!-- Start content -->
<div class="row">
    <div class="cardcode col-12" style="padding: 0;display:none">
        <div class="card-box">
           <label id="discharge_toggle"><font size ='4'><b>Page Detail</b></font></label>
            <div class="row">
              <div class="col-12">
                Controller : <a href="autoit?run=visualcode_open\\endo.exe&path=">IT IS VIEW</a>
              </div>
              <div class="col-12">
                View : <a href="autoit?run=visualcode_open\\endo.exe&path=graph2">graph2</a>
              </div>
           </div>
        </div>
    </div>
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title float-left">Analysis Dashboard
                <?php
                    if(isset($_GET['sdate'])){
                        $sdate = substr(@$_GET['sdate'],0,10);
                        $sdate = date("d-m-Y",$sdate);
                    }else{
                        $sdate = "";
                    }

                ?>
        </h4>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!-- end row -->


<div class="clearfix"></div>

<div class="row">


<style>
.select-new{
    border-radius: 25px !important;
    border-style: inset !important;
}
.card-box{
    background: none;
    box-shadow: none;
    border: none;
}
.border-x{
    box-shadow: 0 0 5px rgb(209, 203, 203);
    background: #fff;
    padding: 1%;
    border-radius: 15px;
}

</style>
<div class="col-12">
    <div class="card-box">
        <div class="table-rep-plugin">
            <div class="row">

                <div class="col-12">
                    <form action="" method="GET">
                        <div class="row border-x">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-2" style="align-self: center;"><b style="font-size: x-large;font-weight: inherit;color:black;">Dashboard Filter</b></div>
                                    <div class="col-1">
                                        <label class="font_by_mos">ปี</label>
                                        <select name="year" class="form-control form-control-sm select-new">
                                            <option value="all">all</option>
                                            <option value="2019" @if(@$_GET['year']=="2019") selected @endif>2019</option>
                                            <option value="2020" @if(@$_GET['year']=="2020") selected @endif>2020</option>
                                        </select>
                                    </div>

                                    <div class="col-1">
                                        <label class="font_by_mos">เดือน</label>
                                        <select name="month" class="form-control form-control-sm select-new">
                                            <option value="all">all</option>
                                            <option value="01" @if(@$_GET['month']=="01") selected @endif>มกราคม</option>
                                            <option value="02" @if(@$_GET['month']=="02") selected @endif>กุมภาพันธ์</option>
                                            <option value="03" @if(@$_GET['month']=="03") selected @endif>มีนาคม</option>
                                            <option value="04" @if(@$_GET['month']=="04") selected @endif>เมษายน</option>
                                            <option value="05" @if(@$_GET['month']=="05") selected @endif>พฤษภาคม</option>
                                            <option value="06" @if(@$_GET['month']=="06") selected @endif>มิถุนายน</option>
                                            <option value="07" @if(@$_GET['month']=="07") selected @endif>กรกฏาคม</option>
                                            <option value="08" @if(@$_GET['month']=="08") selected @endif>สิงหาคม</option>
                                            <option value="09" @if(@$_GET['month']=="09") selected @endif>กันยายน</option>
                                            <option value="10" @if(@$_GET['month']=="10") selected @endif>ตุลาคม</option>
                                            <option value="11" @if(@$_GET['month']=="11") selected @endif>พฤศจิกายน</option>
                                            <option value="12" @if(@$_GET['month']=="12") selected @endif>ธันวาคม</option>
                                        </select>
                                    </div>

                                    <div class="col-1">
                                        <label class="font_by_mos">เพศ</label>
                                        <select name="gender" class="form-control form-control-sm select-new">
                                            <option value="all">all</option>
                                            <option value="1" @if(@$_GET['gender']=="1") selected @endif>ชาย</option>
                                            <option value="2" @if(@$_GET['gender']=="2") selected @endif>หญิง</option>
                                        </select>


                                    </div>

                                    <div class="col-2">
                                        @php
                                            $doctor = DB::table('users')->where('user_type','doctor')->get();
                                        @endphp
                                            <label class="font_by_mos">Doctor</label>
                                            <select name="doctor" class="form-control form-control-sm select-new">
                                                <option value="all">all</option>
                                                @foreach($doctor as $doc)
                                                    <option value="{{$doc->id}}"  @if(@$_GET['doctor']==$doc->id) selected @endif>{{$doc->name}}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <div class="col-3">
                                        @php
                                            $procedure = DB::table('tb_procedure')->get();
                                        @endphp
                                        <label class="font_by_mos">Procedure</label>
                                        <select name="procedure" class="form-control form-control-sm select-new">
                                            <option value="all">all</option>
                                            @foreach($procedure as $pro)
                                                <option value="{{$pro->procedure_code}}" @if(@$_GET['procedure']==$pro->procedure_code) selected @endif>{{$pro->procedure_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-2" style="align-self: flex-end;text-align: center;">
                                        <button type="submit" class="btn btn-success" style="color: black !important;border-radius:13px !important;width:80%;">Start</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-12">&nbsp;</div>
                <div class="col-2">
                    <div class="col-12 border-x" style="background-color: #01b8aa;height:100%;text-align: center;">
                            <img src="{{url("images/logonis.png")}}" alt="" srcset="" style="margin-top: 13%;"><br>
                            <h1 style="margin-top: 15%;color:#005136;" >Total</h1>
                            <h1 style="margin-top: 10%;color:#fff;">{{$numallcase}}</h1>
                    </div>
                </div>
                <div class="col-4">
                        <div class="col-12 border-x" style="height: 100%;">
                            <div id="columnchart_values" style="text-align: -webkit-center;display:table;" class="col-12"></div>
                            <div id="columnchart_values2" style="text-align: -webkit-center;" class="col-12"></div>
                        </div>
                </div>
                <div class="col-6">
                    <div class="col-12 border-x">
                        <div id="columnchart_values3" style="text-align: -webkit-center;"  class="col-12"></div>
                    </div>
                </div>
                <div class="col-12" style="margin-top: 15px;">
                    <div class="row">
                        <div class="col-4">
                            <div class="col-12 border-x">
                                <div id="chart_div" class="col-12"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="col-12 border-x" style="">
                                <div class="col-12" style="position: absolute;z-index: 1;text-align: -webkit-right;">
                                    <button id="showicd10big" type="button" class="btn btn-info btn-sm" style="border-radius:0 !important;background-color: rgb(76, 77, 99) !important;border:1px solid #fff;" data-toggle="modal" data-target="#modalicd10">Show all ICD-10</button>
                                </div>
                                <div id="columnchart_values4" class="col-12"></div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="col-12 border-x">
                                <div class="col-12" style="position: absolute;z-index: 1;text-align: -webkit-right;">
                                    <button id="showicd9big" type="button" class="btn btn-info" style="border-radius:0 !important;background-color: rgb(76, 77, 99) !important;border:1px solid #fff;" data-toggle="modal" data-target="#modalicd9">Show all ICD-9</button>
                                </div>
                                <div id="columnchart_values5" class="col-12"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>

    @php

    $whe[0]     = array('case_dateappointment','like',$s_year.'-'.$s_month.'%');
    $whe[1]     = $s_gender;
    $whe[2]     = $s_procedure;
    $whe[3]     = $s_doctor;
    $diagnostic = DB::table('tb_case')
    ->leftjoin('patient','patient.id','tb_case.case_patientid')
    ->where($whe)
    ->select('diagnostic')
    ->get();
    $arrayall = array();
    foreach($diagnostic as $di){
        $json = jsonDecode($di->diagnostic);
        foreach($json as $j){
            if($j!=""){
                $arrayall[] = $j;
            }
        }
    }
    $sorticd10 = array_count_values($arrayall);
    arsort($sorticd10);



    $whe[0]     = array('case_dateappointment','like',$s_year.'-'.$s_month.'%');
    $proicd9    = DB::table('tb_case')
    ->leftjoin('patient','patient.id','tb_case.case_patientid')
    ->where($whe)
    ->select('proicd9')
    ->get();

    $icd9 = array();
    foreach($proicd9 as $di){
        $json = jsonDecode($di->proicd9);
        foreach($json as $j){
            if($j!=""){
                $type = gettype($j);
                if($type == "object"){
                    $key        = key((array)$j);
                }else{
                    $icd9[]     = $j;

                }
            }
        }
    }

    $sorticd9 = array_count_values($icd9);
    arsort($sorticd9);



    @endphp

<style>
.modal-dialog {
  background: green;
  position: absolute;
  float: left;
  left: 50%;
  top: 1%;
  transform: translate(-50%, -50%);
}

</style>

  <!-- Modal -->
  <div class="modal fade" id="modalicd9" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">

        <table border="1">
            <tr><td>
                <div id="chart_div3" style="height: 850px; width: 1600px;"></div>
            </td></tr>
        </table>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalicd10" role="dialog" align="center">
    <div class="modal-dialog">
      <div class="modal-content">
        <div id="chart_div2" style="height: 850px; width: 1600px;"></div>
      </div>
    </div>
  </div>


@endsection

@section('endscript')


<script type="text/javascript" src="{{url("js/loader.js")}}"></script>
<script src="{{url("js/canvasjs.min.js")}}"></script>

<script type="text/javascript">





//
$('#showicd10big').click(function(){

setTimeout(function(){
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic2);

function drawBasic2() {

      var data2 = google.visualization.arrayToDataTable([
        ['icd10', '',],
        @foreach($sorticd10 as $icd10 => $i10)
            ["{{$icd10}}", {{$i10}}],
        @endforeach
      ]);

      var options = {
        title: 'ICD-10 ALL',
        chartArea: {width: '65%'},
        hAxis: {
          title: 'Total',
          minValue: 0
        },
        vAxis: {
          title: ''
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div2'));

      chart.draw(data2, options);
    }

    $('.modal-dialog').css('left','10%');

}, 500);




});



$('#showicd9big').click(function(){

setTimeout(function(){
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic3);

function drawBasic3() {

      var data2 = google.visualization.arrayToDataTable([
        ['icd9', '',],


    @foreach($sorticd9 as $icd9 => $i9)
        @php
            $text = DB::table('tb_procedureicd9')->where('proicd9_id',$icd9)->first();
        @endphp

        @if(isset($text->proicd9_name))
            ["{{$text->proicd9_name}}", {{$i9}}],
        @else
            ["{{$icd9}}", {{$i9}}],
        @endif


    @endforeach
      ]);

      var options = {
        title: 'ICD-9 ALL',
        chartArea: {width: '65%'},
        hAxis: {
          title: 'Total',
          minValue: 0
        },
        vAxis: {
          title: ''
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div3'));

      chart.draw(data2, options);
    }

    $('.modal-dialog').css('left','10%');

}, 500);




});





google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Element", "Density", { role: "style" } ],
    @if(isset($_GET['year']))
        @if($_GET['year'] == "2019")
            ["2019", {{$year2019}}, "#01b8aa"],
        @endif
        @if($_GET['year'] == "2020")
            ["2020", {{$year2020}}, "#01b8aa"],
        @endif
        @if($_GET['year'] == "all")
            ["2019", {{$year2019}}, "#01b8aa"],
            ["2020", {{$year2020}}, "#01b8aa"],
        @endif
    @else
        ["2019", {{$year2019}}, "#01b8aa"],
        ["2020", {{$year2020}}, "#01b8aa"],
    @endif

  ]);

  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

  var options = {
    title: "YEAR",
    width: 460,
    height: 200,
    bar: {groupWidth: "80%"},
    legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
  chart.draw(view, options);
}



google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart2);
function drawChart2() {
  var data = google.visualization.arrayToDataTable([
    ["Element", "Density", { role: "style" } ],
    @if(isset($_GET['month']))

        @if($_GET['month'] == "01") ["01", {{$m01}}, "#456A76"],        @endif
        @if($_GET['month'] == "02") ["02", {{$m02}}, "#456A76"],         @endif
        @if($_GET['month'] == "03") ["03", {{$m03}}, "#456A76"],           @endif
        @if($_GET['month'] == "04") ["04", {{$m04}}, "#456A76"],           @endif
        @if($_GET['month'] == "05") ["05", {{$m05}}, "#456A76"],           @endif
        @if($_GET['month'] == "06") ["06", {{$m06}}, "#456A76"],           @endif
        @if($_GET['month'] == "07") ["07", {{$m07}}, "#456A76"],           @endif
        @if($_GET['month'] == "08") ["08", {{$m08}}, "#456A76"],           @endif
        @if($_GET['month'] == "09") ["09", {{$m09}}, "#456A76"],           @endif
        @if($_GET['month'] == "10") ["10", {{$m10}}, "#456A76"],           @endif
        @if($_GET['month'] == "11") ["11", {{$m11}}, "#456A76"],           @endif
        @if($_GET['month'] == "12") ["12", {{$m12}}, "color: #456A76"]  @endif
        @if($_GET['month'] == "all")
            ["01", {{$m01}}, "#456A76"],
            ["02", {{$m02}}, "#456A76"],
            ["03", {{$m03}}, "#456A76"],
            ["04", {{$m04}}, "#456A76"],
            ["05", {{$m05}}, "#456A76"],
            ["06", {{$m06}}, "#456A76"],
            ["07", {{$m07}}, "#456A76"],
            ["08", {{$m08}}, "#456A76"],
            ["09", {{$m09}}, "#456A76"],
            ["10", {{$m10}}, "#456A76"],
            ["11", {{$m11}}, "#456A76"],
            ["12", {{$m12}}, "color: #456A76"]
        @endif
    @else
        ["01", {{$m01}}, "#456A76"],
        ["02", {{$m02}}, "#456A76"],
        ["03", {{$m03}}, "#456A76"],
        ["04", {{$m04}}, "#456A76"],
        ["05", {{$m05}}, "#456A76"],
        ["06", {{$m06}}, "#456A76"],
        ["07", {{$m07}}, "#456A76"],
        ["08", {{$m08}}, "#456A76"],
        ["09", {{$m09}}, "#456A76"],
        ["10", {{$m10}}, "#456A76"],
        ["11", {{$m11}}, "#456A76"],
        ["12", {{$m12}}, "color: #456A76"]
    @endif
  ]);

  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

  var options = {
    title: "Month {{@$year}}",
    width: 460,
    height: 200,
    bar: {groupWidth: "80%"},
    legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
  chart.draw(view, options);
}




google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart3);
function drawChart3() {
  var data = google.visualization.arrayToDataTable([
    ["Element", "Density", { role: "style" } ],

    @php
        $procedure = DB::table('tb_procedure')->get();
    @endphp


    @foreach($procedure as $p)
        @php
            $wh[0]   = array('case_dateappointment','like',$s_year.'-'.$s_month.'%');
            $wh[1]   = array('case_procedurecode',$p->procedure_code);
            $wh[2]   = $s_doctor;
            $wh[3]   = $s_gender;
            $procount = DB::table('tb_case')
            ->leftjoin('patient','patient.id','tb_case.case_patientid')
            ->where($wh)
            ->count();
        @endphp

        @if(isset($_GET['procedure']))
            @if($_GET['procedure']==$p->procedure_code)
                ["{{$p->procedure_name}}", {{$procount}}, "{{$p->procedure_color}}"],
            @endif
            @if($_GET['procedure']=="all")
                ["{{$p->procedure_name}}", {{$procount}}, "{{$p->procedure_color}}"],
            @endif
        @else
            ["{{$p->procedure_name}}", {{$procount}}, "{{$p->procedure_color}}"],
        @endif

    @endforeach





  ]);

  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

  var options = {
    title: "PROCEDURE",
    width: 700,
    height: 410,
    bar: {groupWidth: "80%"},
    legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values3"));
  chart.draw(view, options);
}


google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart5);
function drawChart5() {
  var data = google.visualization.arrayToDataTable([
    ["Element", "Density", { role: "style" } ],
    @php
        $i=1;
    @endphp
    @foreach($sorticd9 as $icd9 => $i9)
        @php
            $text = DB::table('tb_procedureicd9')->where('proicd9_id',$icd9)->first();
        @endphp
        @if($i<6)
            @if(isset($text->proicd9_name))
                ["{{$text->proicd9_name}}", {{$i9}},'#be4a47'],
            @else
                ["{{$icd9}}", {{$i9}},'#8495a9'],
            @endif
        @endif
        @php
            $i++;
        @endphp
    @endforeach

  ]);
  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);
  var options = {
    title: "ICD-9",
    width: 460,
    height: 300,
    bar: {groupWidth: "80%"},
    legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values5"));
  chart.draw(view, options);
}




google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart4);
function drawChart4() {
  var data = google.visualization.arrayToDataTable([
    ["Element", "Density", { role: "style" } ],
    @php
        $i=1;
    @endphp
    @foreach($sorticd10 as $icd10 => $i10)
        @if($i<6)
            ["{{$icd10}}", {{$i10}}, "#01b8aa"],
        @endif
        @php
            $i++;
        @endphp
    @endforeach

  ]);
  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

  var options = {
    title: "ICD-10",
    width: 460,
    height: 300,
    bar: {groupWidth: "80%"},
    legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values4"));
  chart.draw(view, options);
}








google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart6);
function drawChart6() {
  var data = google.visualization.arrayToDataTable([
    ["Element", "Density", { role: "style" }],@php $i=1;@endphp
    @foreach($sorticd10 as $icd10 => $i10)
    ["{{@$icd10}}", {{$i10}}, "#B6960B"],@php $i++; @endphp
    @endforeach
  ]);

  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

  var options = {
    title: "ICD 10",
    width: 800,
    height: 400,
    bar: {groupWidth: "80%"},
    legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values6"));
  chart.draw(view, options);
}


google.charts.load("current", {packages:['corechart']});
google.charts.setOnLoadCallback(drawChart7);
function drawChart7() {
    var data = google.visualization.arrayToDataTable([
    ["Element", "Density", { role: "style" } ],
    @php
        $i=1;
    @endphp
    @foreach($sorticd9 as $icd9 => $i9)
        @php
            $text = DB::table('tb_procedureicd9')->where('proicd9_id',$icd9)->first();
        @endphp
            ["{{@$text->proicd9_name}}", {{$i9}}, "#b87333"],
        @php
            $i++;
        @endphp
    @endforeach

  ]);

  var view = new google.visualization.DataView(data);
  view.setColumns([0, 1,
                   { calc: "stringify",
                     sourceColumn: 1,
                     type: "string",
                     role: "annotation" },
                   2]);

  var options = {
    title: "ICD 9",
    width: 800,
    height: 400,
    bar: {groupWidth: "80%"},
    legend: { position: "none" },
  };
  var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values7"));
  chart.draw(view, options);
}


google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawVisualization);

  function drawVisualization() {
    var data = google.visualization.arrayToDataTable([

        @if(isset($_GET['gender']))

            @if($_GET['gender'] == "all")
                ['ช่วงอายุ', 'ชาย', 'หญิง'],
                ['00-20',  {{$man00}},      {{$woman00}}],
                ['20-40',  {{$man20}},      {{$woman20}}],
                ['40-60',  {{$man40}},      {{$woman40}}],
                ['60-80',  {{$man60}},      {{$woman60}}],
                ['80 up',  {{$man80}},      {{$woman80}}]
            @endif
            @if($_GET['gender'] == "1")
                ['ช่วงอายุ', 'ชาย'],
                ['00-20',  {{$man00}}],
                ['20-40',  {{$man20}}],
                ['40-60',  {{$man40}}],
                ['60-80',  {{$man60}}],
                ['80 up',  {{$man80}}]
            @endif
            @if($_GET['gender'] == "2")
                ['ช่วงอายุ', 'หญิง'],
                ['00-20',       {{$woman00}}],
                ['20-40',       {{$woman20}}],
                ['40-60',       {{$woman40}}],
                ['60-80',       {{$woman60}}],
                ['80 up',       {{$woman80}}]
            @endif

        @else
            ['ช่วงอายุ', 'ชาย', 'หญิง'],
            ['00-20',  {{$man00}},      {{$woman00}}],
            ['20-40',  {{$man20}},      {{$woman20}}],
            ['40-60',  {{$man40}},      {{$woman40}}],
            ['60-80',  {{$man60}},      {{$woman60}}],
            ['80 up',  {{$man80}},      {{$woman80}}]
        @endif



    ]);

    var options = {
      title : 'ช่วงอายุ และเพศ',
      vAxis: {title: ''},
      hAxis: {title: 'Month'},
      width: 460,
      height: 300,
      seriesType: 'bars',
      series: {5: {type: 'line'}}        };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  }


</script>

@endsection
