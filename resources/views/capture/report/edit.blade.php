@extends('layouts.app')
@section('page_head')

    <style>
    .aa{
        position: relative;
    }
    .bb{
        position: absolute;
        right: 20px;
        top: 5px;
        width: 26px;
        background-color: #007bff;
        color:white;
    }
    </style>

    <style>
        .toolbar{
            opacity: 0;
        }
        .toolbar-row-left{
            opacity: 0;
        }
        .zoom-display,.action-buttons .button-group{
            opacity: 0;
            position: absolute;
        }
        iframe{
            width: 109% !important;
            height: 328px !important;
        }
        /* .modal-content{
            background: none !important;
        } */
    ul.jq-input-dropdown,
    ul.jq-input-dropdown li{
      margin: 0;
      padding: 0;
      border: 0;
      outline: 0;
      font-size: 100%;
      vertical-align: baseline;
      background: transparent;
    }

    ul.jq-input-dropdown {
      border: 1px solid #CCC;
      list-style: none;
      display: none;
      z-index: 200;
      min-width:10%;
    }

    ul.jq-input-dropdown li:hover {
      background-color: #C0C0C0;
      color: #fff;
      cursor: pointer;
    }
    .set-0{
        margin: 0 !important;
    }
    label{
        margin: 0;
        margin-top: 10px;
    }
  </style>

    <link href="{{url("pubile/css/zoomify.css")}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/extra/fileinput/fileinput.css')}}" rel="stylesheet" type="text/css">
    <input type="hidden" id="tabselect" value="0">

    @endsection

@section('content')

    <input name="patientid" type="hidden" value="{{ $patient->patient_id }}">
    <input name="useropen"  type="hidden" value="{{ uid() }}">
    <input name="hn" type="hidden" value="{{$patient->hn}}">
        <div class="col-md-12">

    <div class="row">
        <div class="col-4">
            <div class="card" style="height: 99%;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            @if($patient->pic=="")
                                <img  id="imgnew" src="{{asset('public/images/avatar.png')}}"  width="100px"/>
                            @else
                                <img  id="imgnew" src="{{url("")}}public/pic_patient/{{$patient->pic}}?a={{date("Y-m-dH:i:s")}}"  width="100px"/>
                            @endif
                        </div>
                        <div class="col-12 text-center" style="margin: 1em 0em;">
                            <a href="{{url('patient')}}/{{ $patient->patient_id }}"  class="btn btn-light" style="border: 1px solid gray"><b>Edit Patient profile</b></a>
                        </div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>HN :</b> {{ $patient->hn }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>AN :</b> {{ $patient->an }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Name :</b> {{ $patient->firstname." ".$patient->lastname }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>ID/Passport :</b> {{ $patient->citizen }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Age :</b>{{age(@$patient->birthdate)}}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Gender :</b> {{ $patient->gender_name }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Allergic :</b> {{ $patient->allergic }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Contact :</b> {{ $patient->email." ".$patient->phone }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Emergency Contact :</b> {{ $patient->emer_name." ".$patient->emer_tel }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Congenital disease :</b> {{ $patient->congenital_disease }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Treatment Coverage :</b></font>

                            @php
                            $rightto = DB::table('dd_righttotreatment')->where('id','=',$patient->righttotreatment)->first();
                            @endphp
                            {{ @$rightto->name }}
                        </label></div>

                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>CASE ID :</b> {{ @$casedata->case_id }}&nbsp;&nbsp;&nbsp;&nbsp;</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Appointment :</b> {{ @substr($casedata->case_dateappointment,0,10)}}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Procedure :</b> {{ @$casedata->procedure_name }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Room :</b> {{ @$casedata->case_room }}</label></font></div>

                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Ward :</b> {{ @$casedata->ward }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>OPD :</b> {{ @$casedata->opd }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Refer :</b> {{ @$casedata->refer }}</label></font></div>
                        <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Doctor :</b>
                            @php
                            $doctorname = DB::table('users')
                                ->where('id','=',@$casedata->case_physicians01)
                                ->first();
                            @endphp
                            {{ @$doctorname->name }}
                            </label></font>
                        </div>
                        <div class="col-md-6"><label class="col-form-label"><font size="2"><b>Nurse :</b> {{ @$casedata->refer }}</label></font></div>
                        <div class="col-md-6"><label class="col-form-label"><font size="2"><b>Assist :</b> {{ @$casedata->refer }}</label></font></div>
                        <div class="col-12"><a href="#" class="btn btn-sm btn-success" style="border: 1px solid gray;padding: 1px 10px;width:100%;">Edit</a></div>
                    </div>
                </div>
            </div>
        </div>

<div class="col-8">
    <div class="card" style="height: 99%;">
        <div class="card-body">
            <form action="{{url('registration/'.$tb_case->case_id)}}" method="post" style="width: 100%;">
                @method('put')
                @csrf
                <input name="patientid" type="hidden" value="{{ $patient->patient_id }}">
                <input name="useropen"  type="hidden" value="{{ uid() }}">
                @if(isset($_GET['case_id']))
                    <div id="registration_showhide" style="display:none;">
                @else
                    <div id="registration_showhide">
                @endif
               @if (count($errors) > 0)
                <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
               @endif
                <div class="form-row" style="margin: 0;">
                  <div class="form-group col-6" style="margin: 0;">
                      <label for="inputEmail4">Case Appointment</label>
                        @if(isset($date[0]))
                            <input name="meet_date" type="text" class="form-control" id="datepicker" placeholder="Appoint date" value="{{ $date[0] }}"   autocomplete="off" required>
                        @else
                            <input name="meet_date" type="text" class="form-control" id="datepicker" placeholder="Appoint date" value="{{ $today }}"   autocomplete="off" required>
                        @endif
                    </div>

                  <div class="form-group col-3" style="margin: 0;">
                      <label for="lblBase">Hour</label>
                      <select name='meet_hour' class='form-control textrrr' style='width:100%' id='meet_hor'>
                           @for ($i=0;$i<24;$i++)
                              @php
                                 $select="";
                                 $num=str_pad($i, 2, '0', STR_PAD_LEFT);
                                 if($num==@$time[0]){$select="selected";}
                              @endphp
                              <option value='{{$num}}' @if($num == '08') selected @endif>{{$num}}</option>
                          @endfor
                      </select>
                  </div>
                  <div class="form-group col-3">
                      <label for="lblBase">Minute</label>
                      <select name='meet_minute' class='form-control textrrr' style='width:100%' id='meet_minute'>
                           @for($i=0;$i<60;$i=$i+10)
                              @php
                                 $select="";
                                 $num=str_pad($i, 2, '0', STR_PAD_LEFT);
                                 if($num==@$time[1]){$select="selected";}
                              @endphp
                            <option value='{{$num}}' {{$select}}>{{$num}}</option>
                          @endfor
                      </select>
                  </div>
                <div class="form-group col-12" style="margin: 0;">
                    <label for="inputEmail4">Procedure</label>
                    {!! Form::select('case_procedure',array(''=>'เลือกการตรวจ')+array_pluck($procedure,'procedure_name','procedure_code'),@$casedata->case_procedurecode,['class'=>'form-control','required']) !!}
                </div>
                <div class="form-group col-12" style="margin: 0;">
                    <label for="inputEmail4">Procedure Room</label><br>
                    {!! Form::select('room',array(''=>'เลือกห้อง')+array_pluck($room,'name','id'),@$casedata->case_room,['class'=>'form-control']) !!}
                </div>
                <div class="form-group col-12" style="margin: 0;">
                    <label for="inputEmail4">Endoscopist</label>
                    {!! Form::select('case_physicians01',array(''=>'เลือกแพทย์')+array_pluck2($doctor_select,'name','id'),@$casedata->case_physicians01,['class'=>'form-control ','required']) !!}
                </div>
                <div class="form-group col-md-12" style="margin: 0;">
                    <label>OPD</label>
                    <input id="opd" name="opd" class="form-control " type="text">
                </div>
                <div class="form-group col-md-12" style="margin: 0;">
                    <label>Ward</label>
                    <input id="ward" name="ward" class="form-control " type="text">
                </div>
                <div class="form-group col-md-12" style="margin: 0;">
                    <label>Refer</label>
                    <input id="refer" name="refer" class="form-control " type="text">
                </div>

                <div class="form-group col-12">
                    <label>Nurse #1</label>
                    {!! Form::select('nurse01',array(''=>'เลือกพยาบาล')+array_pluck2($nurse_select,'name','id'),@$casedata->case_nurse01,['class'=>'form-control ','id'=>'case_nurse01']) !!}
                </div>
                <div class="form-group col-12">
                    <label>Nurse #2</label>
                    {!! Form::select('nurse02',array(''=>'เลือกพยาบาล')+array_pluck2($nurse_select,'name','id'),@$casedata->case_nurse02,['class'=>'form-control ','id'=>'case_nurse02']) !!}
                </div>
                <div class="form-group col-12">
                    <label>Practical nurse #1</label>
                    {!! Form::select('nurse03',array(''=>'เลือกผู้ช่วยพยาบาล')+array_pluck2($register_select,'name','id'),@$casedata->case_nurse03,['class'=>'form-control ','id'=>'case_nurse03']) !!}
                </div>
                <div class="form-group col-12">
                    <label>Practical nurse #2</label>
                    {!! Form::select('nurse04',array(''=>'เลือกผู้ช่วยพยาบาล')+array_pluck2($register_select,'name','id'),@$casedata->case_nurse04,['class'=>'form-control ','id'=>'case_nurse04']) !!}
                </div>
                <div class="form-group col-12">
                    <label>Pre-dianostic</label>
                    <input id="prediagnosis" name="prediagnosis" class="form-control  autotext" type="text">
                </div>
                <div class="col-12" style="bottom: 2em;position: absolute;">
                    <div class="form-row">
                        <div class="col-5">
                            <button id="savestep04" type="submit" class="btn-block btn-lg btn-info waves-effect waves-light">
                            <font size="3"> บันทึกเเละกลับหน้าหลัก&nbsp;</font><i class="fa  dripicons-document"></i></button>
                        </div>
                        <div class="col-2">
                        </div>
                        <div class="col-5" align="right">
                            <a class="btn btn-lg btn-danger" id="btn-confirm" style="width: 100%;"><font size="3">ลบข้อมูลการนัดหมาย&nbsp;</font><i class="fa  dripicons-trash"></i></a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



        </div>
     </div>
    </div>

</div>
    </div>
    </div>

    {{ Form::close()}}
    @endsection
