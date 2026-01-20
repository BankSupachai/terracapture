<!DOCTYPE html>
<html lang="en">
<head>
    <title>Monitor</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('public/url_monitor/popmenu.css')}}">
    <link rel="stylesheet" href="{{url('public/url_monitor/bootstrap-switch-button.min.css')}}">
    <link rel="stylesheet" href="{{url('public/url_monitor/bootstrap.min.css')}}">
    <link href="{{url("public/css/monitor/monitor.css")}}" rel="stylesheet" type="text/css"/>
    <script src="{{url("public/js/jquery.js")}}"></script>

</head>
<body>
    <div class="cardcode col-12" style="padding: 0;display:none">
        <div class="card-box">
           <label id="discharge_toggle"><font size ='4'><b>Page Detail</b></font></label>
            <div class="row">
              <div class="col-12">
                Controller : <a href="autoit?run=visualcode_open\\endo.exe&path=MonitorController">MonitorController</a>
              </div>
              <div class="col-12">
                View : <a href="autoit?run=visualcode_open\\endo.exe&path=monitor">monitor</a>
              </div>
           </div>
        </div>
    </div>


<table border="1" width="100%">
<tr>
<td colspan="5" bgcolor="#000000">

<div class="row">
<div class="col-6">
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<img src="{{url('public/url_monitor/endo.png')}}" width="200">
<br><br>
</div>

<div class="col-6" align="right">
<h4> {{@$datenow}}
<br><d id="time"></d>&nbsp;&nbsp;&nbsp;&nbsp;</h4>


</div>
</div>
</td>
</tr>






<tr>
    <td valign="top" width="20%" bgcolor="#000000">
        <div class="row">
            <div class="col-6">
        <br>
            <h3 style="color:white" align="right" >Room 1</h3>
            </div>
            <div class="col-1 readyall" id="readyroom1" ready="{{@$ready[0]->ready}}" align="right">
        <br>
            <input type="checkbox" data-toggle="switchbutton" {{@$ready[0]->ready==1 ? "checked":""}} data-onstyle="success" data-offstyle="danger" data-width="120">
            </div>
        </div>

        <p style="color:white"><b>Operating</b></p>
        <div class="operation">
        @foreach($tb_case as $case)
            @if($case->case_status==1&&$case->case_room==1)

            <div  id="{{$case->case_id}}" class="row ui-state-default">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>

        <br>
        <p style="color:white"><b>Registered</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;Note</p>
        <div id="scope1" class="registered connectedSortable">
            @foreach($tb_case as $case)
                @if($case->case_status==0&&$case->case_room==1)
                <div  id="{{$case->case_id}}" class="row ui-state-default">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                    <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                    <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                    <div class="col-1">
                        @php
                            $img = "clock.png";
                            if(@$case->ready_status==0){$img = "clock.png";}
                            if(@$case->ready_status==1){$img = "user.png";}
                        @endphp
                        <img    src         = "{{url("public/url_monitor/$img")}}"
                                width       = "20px"
                                class       = "room_status"
                                id          = "ready{{$case->case_id}}"
                                case_id     = "{{$case->case_id}}"
                                ready_status= "{{@$case->ready_status}}"
                        >
                    </div>
                    <div class="col-1">
                        <img    src         ="{{url('public/url_monitor/note.png')}}"
                                width       ="20px"
                                class       ="room_comment"
                                id          ="readycomment{{$case->case_id}}"
                                data-toggle ="tooltip"
                                case_id     ="{{$case->case_id}}"
                                patient_name="{{$case->firstname}} {{$case->lastname}}"
                                title       ="{{@$case->ready_comment}}"
                        >
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <br>
        <p style="color:white"><b>Finished</b></p>

        <div class="finished">
        @foreach($tb_case as $case)
            @if($case->case_status==2&&$case->case_room==1)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->case_id}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>
        <br>
        <div class="row">
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[0]->nurse1,['class'=>'form-control nurse','room'=>'Scope 1','nurse'=>'nurse1']) !!}
            </div>
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[0]->nurse2,['class'=>'form-control nurse','room'=>'Scope 1','nurse'=>'nurse2']) !!}
            </div>
        </div>
		<br>
    </td>
    <td valign="top" width="20%">
    <div class="row">
        <div class="col-6">
		<br>
            <h3 style="color:white" align="right" >Room 2</h3>
        </div>
        <div class="col-1 readyall" id="readyroom2" ready="{{@$ready[1]->ready}}" align="right">
		<br>
            <input type="checkbox" data-toggle="switchbutton" {{@$ready[1]->ready==1 ? "checked":""}} data-onstyle="success" data-offstyle="danger" data-width="120">
        </div>
    </div>
        <p style="color:white"><b>Operating</b></p>
        <div class="operation">
        @foreach($tb_case as $case)
            @if($case->case_status==1&&$case->case_room==2)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>

        <br>
		<p style="color:white"><b>Registered</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;Note</p>
        <div id="scope2" class="registered connectedSortable">
            @foreach($tb_case as $case)
                @if($case->case_status==0&&$case->case_room==2)
                <div  id="{{$case->case_id}}" class="row ui-state-default">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                    <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                    <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                    <div class="col-1">
                        @php
                            $img = "clock.png";
                            if($case->ready_status==0){$img = "clock.png";}
                            if($case->ready_status==1){$img = "user.png";}
                        @endphp
                        <img    src         = "{{url("public/url_monitor/$img")}}"
                                width       = "30px"
                                class       = "room_status"
                                id          = "ready{{$case->case_id}}"
                                case_id     = "{{$case->case_id}}"
                                ready_status= "{{$case->ready_status}}"
                        >
                    </div>
                    <div class="col-1">
                        <img    src         ="{{url('public/url_monitor/note.png')}}"
                                width       ="30px"
                                class       ="room_comment"
                                id          ="readycomment{{$case->case_id}}"
                                data-toggle ="tooltip"
                                case_id     ="{{$case->case_id}}"
                                patient_name="{{$case->firstname}} {{$case->lastname}}"
                                title       ="{{$case->ready_comment}}"
                        >
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <br>
		<p style="color:white"><b>Finished</b></p>
        <div class="finished">
        @foreach($tb_case as $case)
            @if($case->case_status==2&&$case->case_room==2)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->case_id}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>
        <br>
        <div class="row">
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[1]->nurse1,['class'=>'form-control nurse','room'=>'Scope 2','nurse'=>'nurse1']) !!}
            </div>
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[1]->nurse2,['class'=>'form-control nurse','room'=>'Scope 2','nurse'=>'nurse2']) !!}
            </div>
        </div>

    </td>
    <td valign="top" width="20%">
    <div class="row">
        <div class="col-6">
		<br>
            <h3 style="color:white" align="right" >Room ERCP</h3>
        </div>
        <div class="col-1 readyall" id="readyroom_ercp" ready="{{@$ready[2]->ready}}" align="right">
            <br>
			<input type="checkbox" data-toggle="switchbutton" {{@$ready[2]->ready==1 ? "checked":""}} data-onstyle="success" data-offstyle="danger" data-width="120">
        </div>
    </div>
        <p style="color:white"><b>Operating</b></p>
        <div class="operation">
        @foreach($tb_case as $case)
            @if($case->case_status==1&&$case->case_room==4)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>

        <br>
		<p style="color:white"><b>Registered</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;Note</p>
        <div id="scope_ercp" class="registered connectedSortable">
            @foreach($tb_case as $case)
                @if($case->case_status==0&&$case->case_room==4)
                <div  id="{{$case->case_id}}" class="row ui-state-default">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                    <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                    <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                    <div class="col-1">
                        @php
                            $img = "clock.png";
                            if($case->ready_status==0){$img = "clock.png";}
                            if($case->ready_status==1){$img = "user.png";}
                        @endphp
                        <img    src         = "{{url("public/url_monitor/$img")}}"
                                width       = "30px"
                                class       = "room_status"
                                id          = "ready{{$case->case_id}}"
                                case_id     = "{{$case->case_id}}"
                                ready_status= "{{$case->ready_status}}"
                        >
                    </div>
                    <div class="col-1">
                        <img    src         ="{{url('public/url_monitor/note.png')}}"
                                width       ="30px"
                                class       ="room_comment"
                                id          ="readycomment{{$case->case_id}}"
                                data-toggle ="tooltip"
                                case_id     ="{{$case->case_id}}"
                                patient_name="{{$case->firstname}} {{$case->lastname}}"
                                title       ="{{$case->ready_comment}}"
                        >
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <br>
		<p style="color:white"><b>Finished</b></p>

        <div class="finished">
        @foreach($tb_case as $case)
            @if($case->case_status==2&&$case->case_room==4)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->case_id}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>
        <br>
        <div class="row">
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[2]->nurse1,['class'=>'form-control nurse','room'=>'ห้อง ERCP','nurse'=>'nurse1']) !!}
            </div>
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[2]->nurse2,['class'=>'form-control nurse','room'=>'ห้อง ERCP','nurse'=>'nurse2']) !!}
            </div>
        </div>

    </td>
    <td valign="top" width="20%">
    <div class="row">
        <div class="col-6">
            <br><h3 style="color:white" align="right" >Room 3</h3>
        </div>
        <div class="col-1 readyall" id="readyroom3" ready="{{@$ready[3]->ready}}" align="right">
		<br>
            <input type="checkbox" data-toggle="switchbutton" {{@$ready[3]->ready==1 ? "checked":""}} data-onstyle="success" data-offstyle="danger" data-width="120">
        </div>
    </div>
        <p style="color:white"><b>Operating</b></p>
        <div class="operation">
        @foreach($tb_case as $case)
            @if($case->case_status==1&&$case->case_room==5)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>

        <br>
		<p style="color:white"><b>Registered</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;Note</p>
        <div id="scope3" class="registered connectedSortable">
            @foreach($tb_case as $case)
                @if($case->case_status==0&&$case->case_room==5)
                <div  id="{{$case->case_id}}" class="row ui-state-default">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                    <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                    <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                    <div class="col-1">
                        @php
                            $img = "clock.png";
                            if($case->ready_status==0){$img = "clock.png";}
                            if($case->ready_status==1){$img = "user.png";}
                        @endphp
                        <img    src         = "{{url("public/url_monitor/$img")}}"
                                width       = "30px"
                                class       = "room_status"
                                id          = "ready{{$case->case_id}}"
                                case_id     = "{{$case->case_id}}"
                                ready_status= "{{$case->ready_status}}"
                        >
                    </div>
                    <div class="col-1">
                        <img    src         ="{{url('public/url_monitor/note.png')}}"
                                width       ="30px"
                                class       ="room_comment"
                                id          ="readycomment{{$case->case_id}}"
                                data-toggle ="tooltip"
                                case_id     ="{{$case->case_id}}"
                                patient_name="{{$case->firstname}} {{$case->lastname}}"
                                title       ="{{$case->ready_comment}}"
                        >
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <br><p style="color:white"><b>Finished</b></p>

        <div class="finished">
        @foreach($tb_case as $case)
            @if($case->case_status==2&&$case->case_room==5)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->case_id}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>
        <br>
        <div class="row">
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[3]->nurse1,['class'=>'form-control nurse','room'=>'Scope 3','nurse'=>'nurse1']) !!}
            </div>
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[3]->nurse2,['class'=>'form-control nurse','room'=>'Scope 3','nurse'=>'nurse2']) !!}
            </div>
        </div>

    </td>
    <td valign="top" width="20%">
    <div class="row">
        <div class="col-6">
            <br><h3 style="color:white" align="right" >Room 4</h3>
        </div>
        <div class="col-1 readyall" id="readyroom4" ready="{{@$ready[4]->ready}}" align="right">
		<br>
            <input type="checkbox" data-toggle="switchbutton" {{@$ready[4]->ready==1 ? "checked":""}} data-onstyle="success" data-offstyle="danger" data-width="120">
        </div>
    </div>
        <p style="color:white"><b>Operating</b></p>
        <div class="operation">
        @foreach($tb_case as $case)
            @if($case->case_status==1&&$case->case_room==6)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>

        <br>
		<p style="color:white"><b>Registered</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;Note</p>
        <div id="scope4" class="registered connectedSortable">
            @foreach($tb_case as $case)
                @if($case->case_status==0&&$case->case_room==6)
                <div  id="{{$case->case_id}}" class="row ui-state-default">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                    <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                    <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                    <div class="col-1">
                        @php
                            $img = "clock.png";
                            if($case->ready_status==0){$img = "clock.png";}
                            if($case->ready_status==1){$img = "user.png";}
                        @endphp
                        <img    src         = "{{url("public/url_monitor/$img")}}"
                                width       = "30px"
                                class       = "room_status"
                                id          = "ready{{$case->case_id}}"
                                case_id     = "{{$case->case_id}}"
                                ready_status= "{{$case->ready_status}}"
                        >
                    </div>
                    <div class="col-1">
                        <img    src         ="{{url('public/url_monitor/note.png')}}"
                                width       ="30px"
                                class       ="room_comment"
                                id          ="readycomment{{$case->case_id}}"
                                data-toggle ="tooltip"
                                case_id     ="{{$case->case_id}}"
                                patient_name="{{$case->firstname}} {{$case->lastname}}"
                                title       ="{{$case->ready_comment}}"
                        >
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <br><p style="color:white"><b>Finished</b></p>

        <div class="finished">
        @foreach($tb_case as $case)
            @if($case->case_status==2&&$case->case_room==6)
            <div  id="{{$case->case_id}}" class="row ui-state-default">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->case_id}}</div>
                <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                <div class="col-1" style="background-color:{{$case->procedure_color}};"></div>
            </div>
            @endif
        @endforeach
        </div>
        <br>
        <div class="row">
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[4]->nurse1,['class'=>'form-control nurse','room'=>'Scope 4','nurse'=>'nurse1']) !!}
            </div>
            <div class="col-1">
                <img src="{{url('public/url_monitor/nurse.png')}}" width="40">
            </div>
            <div class="col-5">
                {!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$nurse_room[4]->nurse2,['class'=>'form-control nurse','room'=>'Scope 4','nurse'=>'nurse2']) !!}
            </div>
        </div>

    </td>
</tr>

<tr>
    <td valign="top">
    <h3>Procedure</h3>
	<br>
        <div class="row">
            <div class="col-1"></div>
            <div class="col-11">


                <div class="row">
                    @foreach ($tb_procedure as $p)
                        <div class="col-6 row">
                            <div style="background-color:{{$p->procedure_color}};width: 25px;height: 25px;" ></div>
                                <div>
                                    <font size='3'>&nbsp;{{mb_substr($p->procedure_name,0,25,'UTF-8')}}</font>
                                </div>
                            <br><br>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </td>
    <td valign="top"><h3>Registered (ยังไม่ระบุห้อง)</h3>

	<p style="color:white">						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;Note</p>
        <div id="scope_noroom" class="registered connectedSortable">
            @foreach($tb_case as $case)
                @if($case->case_status==0&&$case->case_room==0)
                <div  id="{{$case->case_id}}" class="row ui-state-default">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                    <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                    <div class="col-3" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,13,'UTF-8')}}</div>
                    <div class="col-1">
                        @php
                            $img = "clock.png";
                            if($case->ready_status==0){$img = "clock.png";}
                            if($case->ready_status==1){$img = "user.png";}
                        @endphp
                        <img    src         = "{{url("public/url_monitor/$img")}}"
                                width       = "30px"
                                class       = "room_status"
                                id          = "ready{{$case->case_id}}"
                                case_id     = "{{$case->case_id}}"
                                ready_status= "{{$case->ready_status}}"
                        >
                    </div>
                    <div class="col-1">
                        <img    src         ="{{url('public/url_monitor/note.png')}}"
                                width       ="30px"
                                class       ="room_comment"
                                id          ="readycomment{{$case->case_id}}"
                                data-toggle ="tooltip"
                                case_id     ="{{$case->case_id}}"
                                patient_name="{{$case->firstname}} {{$case->lastname}}"
                                title       ="{{$case->ready_comment}}"
                        >
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    </td>
    <td valign="top"><h3>CASE VIP</h3>
        <div id="vip" class="registered">
            @foreach($tb_case as $case)
                @if($case->vip==1)
                <div  id="{{$case->case_id}}" class="row ui-state-default">
                    <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$case->hn}}</div>
                    <div class="col-4" style="background-color:{{$case->procedure_color}};">{{$case->firstname}} {{$case->lastname}}</div>
                    <div class="col-4" style="background-color:{{$case->procedure_color}};">{{mb_substr($case->name,0,15,'UTF-8')}}</div>
                    @php($room = DB::table('tb_room')->where('id',$case->case_room)->first())
                    <div class="col-2" style="background-color:{{$case->procedure_color}};">{{$room->name}}</div>
                </div>
                @endif
            @endforeach
        </div>

    </td>
    <td colspan="2" valign="top"><h3>Note</h3></td>
</tr>


</table>

    <button type="button"
            id="callmodal"
            class="btn btn-info btn-lg"
            data-toggle="modal"
            data-target="#modalcomment"
            hidden
            >
                Open Modal
    </button>


    <!-- Modal content-->
    <div class="modal fade" id="modalcomment" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body">
                    <label      id="modal_label"></label>
                    <input      id="modal_caseid" type="text" hidden>
                    <textarea   id="modal_textarea" rows="4" cols="50" style="width: 100%;"></textarea>
                </div>
                <div class="modal-footer">
                    <button     id="modal_submit" type="button" class="btn btn-success" data-dismiss="modal">ตกลง</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{url('public/url_monitor/popper.min.js')}}"></script>
    <script src="{{url('public/url_monitor/bootstrap.min.js')}}"></script>
    <script src="{{url('public/url_monitor/jquery-1.6.2.js')}}"></script>
    <script src="{{url('public/url_monitor/jquery-ui.js')}}"></script>
    <script src="{{url('public/url_monitor/bootstrap-switch-button.min.js')}}"></script>
    <script src="{{url('public/url_monitor/popmenu.min.js')}}"></script>

    <script>
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
           </script>

<script type="text/javascript">
var timestamp = '<?=time();?>';
function updateTime(){

  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  var realtime = h + ":" + m + ":" + s;

  $('#time').html(realtime);
  timestamp++;
}
$(function(){
  setInterval(updateTime, 1000);
});
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>


    <script>

    $('.room_status').click(function(){
        var ready_status= $(this).attr('ready_status');
        var case_id     = $(this).attr('case_id');
        popmenu({
    		items : {
    			rr      : {name : 'RR', icon : '<i class="fa fa-home"></i>'},
    			ready   : {name : 'พร้อม', icon : '<i class="fa fa-facebook"></i>'},
    		},
    		callback: function(item){

    			var id  = $(item).attr('id');
                var val = 0;
    			if(id === "rr")     {val=0;$('#ready'+case_id).attr('src','public/url_monitor/clock.png');}
                if(id === "ready")  {val=1;$('#ready'+case_id).attr('src','public/url_monitor/user.png');}
                $.post("{{url('public/photomove')}}",
                {
                    event       : 'ready_status',
                    case_id     : case_id,
                    ready_status: ready_status,
                    val         : val,
                },
                function(data,status){});
    		}
		});
      	return false;
    });

    $('.room_comment').click(function(){
        var title           = $(this).attr('title');
        var patient_name    = $(this).attr('patient_name');
        var case_id         = $(this).attr('case_id');
        $('#modal_textarea').val('');
        $('#modal_label').html(patient_name);
        $('#modal_caseid').val(case_id);
        $('#modal_textarea').val(title);
        $('#callmodal').trigger('click');
    });


    $('#modal_submit').click(function(){
        var case_id = $('#modal_caseid').val();
        var val     = $('#modal_textarea').val();
        $.post("{{url('public/photomove')}}",
        {
            event   : 'ready_comment',
            case_id : case_id,
            val     : val
        },
        function(data,status){});

        $('#readycomment'+case_id).attr('title',val);
    });


    $(".nurse").change(function(){
        var room    = $(this).attr('room');
        var nurse   = $(this).attr('nurse');
        var val     = $(this).val();
        $.post("{{url('public/photomove')}}",
        {
            event   : 'nursechange',
            room    : room,
            nurse   : nurse,
            val     : val
        },
        function(data,status){});
    });



    $("#scope1, #scope2,#scope3,#scope4,#scope_ercp,#scope_noroom").sortable({
        connectWith: ".connectedSortable",
        stop: function(event, ui) {
            $('.connectedSortable').each(function() {
                result      = "";
                var room    = $(this).attr('id');
                var val     = $(this).sortable("toArray");
                console.log(val);
                $.post("{{url('public/photomove')}}",
                {
                    event   : 'roomchange',
                    room    : room,
                    val     : val
                },
                function(data,status){});
                $(this).find("li").each(function(){
                    result += $(this).text() + ",";
                });
                $("."+$(this).attr("id")+".list").html(result);
            });
        }
    });


    $('.readyall').click(function(){
        var room    = $(this).attr('id');
        var ready   = $(this).attr('ready');
        var val     = 0;
        if(ready==0){val=1;}else{val=0;}
        $.post("{{url('public/photomove')}}",
        {
            event   : 'room_setready',
            room    : room,
            val     : val
        },
        function(data,status){});
        $(this).attr('ready',val);
    });

</script>

</body>
</html>
