@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{url('public/css/registration/registration_edit.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/css/zoomify.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('public/extra/fileinput/fileinput.css')}}" rel="stylesheet" type="text/css">
    <input type="hidden" id="tabselect" value="0">
    @endsection
@section('content')

<div class="row" style="padding-top: 1em;margin:0;">
    <div class="col-4">
        <div class="card" style="height: 99%;">
            <div class="card-body">
                <input name="patientid" type="hidden" value="{{ $patient->patient_id }}">
                <input name="useropen"  type="hidden" value="{{ uid() }}">
                <input name="hn" type="hidden" value="{{$patient->hn}}">
                <div class="col-12 text-center">
                    @if($patient->pic=="")
                        <img id="imgnew" src="{{asset('public/images/avatar.png')}}" width="100px"/>
                    @else
                        <img id="imgnew" src="{{url("public/pic_patient/$patient->pic")}}?a={{date("Y-m-dH:i:s")}}" width="100px"/>
                    @endif
                </div>
                <div class="col-12 text-center">
                    <br>
                    <a href="{{url("patient/$patient->patient_id/edit?prepage=")}}{{url()->full()}}"  class="btn btn-light" style="border: 1px solid gray"><b>Edit Patient profile</b></a>
                </div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>HN :</b> {{ $patient->hn }}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>AN :</b> {{check_val($patient->an,'ไม่มีข้อมูล')}}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Name :</b> {{check_val($patient->firstname,'ไม่มีข้อมูล')." ".$patient->lastname }}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>ID/Passport :</b> {{check_val($patient->citizen,'ไม่มีข้อมูล') }}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Age :</b>{{age(@$patient->birthdate,'ไม่มีข้อมูล')}}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Gender :</b> {{check_val($patient->gender_name,'ไม่มีข้อมูล')}}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Allergic :</b> {{check_val($patient->allergic,'ไม่มีข้อมูล')}}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Contact :</b> {{check_val($patient->email,'ไม่มีข้อมูล')." ".$patient->phone}}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Emergency Contact :</b> {{check_val($patient->emer_name,'ไม่มีข้อมูล')." ".$patient->emer_tel}}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Congenital disease :</b> {{check_val($patient->congenital_disease,'ไม่มีข้อมูล')}}</label></font></div>
                <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Treatment Coverage :</b></font>

                @php
                $rightto = DB::table('dd_righttotreatment')->where('id','=',$patient->righttotreatment)->first();
                @endphp
                @if($rightto!=null || $rightto!="")
                    {{@$rightto->name}}
                @else
                    ไม่มีข้อมูล
                @endif
                </label>
            </div>
        </div>
    </div>
</div>

<div class="col-8">
        <div class="card" style="height: 99%;">
            <div class="card-body">
                <form action="../registration" method="post" style="width: 100%;">
                    @csrf
                    <input name="hn"        type="hidden" value="{{ $patient->hn }}">
                    <input name="useropen"  type="hidden" value="{{ uid() }}">
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Case Appointment</label>
                            @if(isset($date[0]))
                                <input name="meet_date" type="text" class="form-control" id="datepicker" placeholder="Appoint date" value="{{ $date[0] }}"   autocomplete="off" required>
                            @else
                                <input name="meet_date" type="text" class="form-control" id="datepicker" placeholder="Appoint date" value="{{ $today }}"   autocomplete="off" required>
                            @endif
                        </div>
                        <div class="form-group col-4">
                            <label>Hour</label>
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
                        <div class="form-group col-4">
                            <label>Minute</label>
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
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                          <ul>
                            @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                       @endif
                       <div class="form-group col-4">
                            <label>Procedure</label>
                            {!! Form::select('case_procedure',array(''=>'เลือกการตรวจ')+array_pluck($procedure,'procedure_name','procedure_code'),@$casedata->case_procedure,['class'=>'form-control','required']) !!}
                        </div>

                        <div class="form-group col-4">
                            <label>Procedure Room</label><br>
                            {!! Form::select('room',array(''=>'เลือกห้อง')+array_pluck($room,'name','id'),@$casedata->case_room,['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group col-4">
                            <label>Endoscopist</label>
                            {!! Form::select('case_physicians01',array(''=>'เลือกแพทย์')+array_pluck2($doctor_select,'name','id'),@$casedata->case_physicians01,['class'=>'form-control ','required']) !!}
                        </div>
                        <div class="form-group col-md-4">
                            <label>OPD</label>
                            <input id="opd" name="opd" class="form-control " type="text">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Ward</label>
                            <input id="ward" name="ward" class="form-control " type="text">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Refer</label>
                            <input id="refer" name="refer" class="form-control " type="text">
                        </div>
                        <div class="form-group col-md-6"><label>Nurse #1</label>
                            {!! Form::select('nurse01',array(''=>'เลือกพยาบาล')+array_pluck2($nurse_select,'name','id'),@$casedata->case_nurse01,['class'=>'form-control ','id'=>'case_nurse01']) !!}
                        </div>
                        <div class="form-group col-md-6"><label>Nurse #2</label>
                            {!! Form::select('nurse02',array(''=>'เลือกพยาบาล')+array_pluck2($nurse_select,'name','id'),@$casedata->case_nurse02,['class'=>'form-control ','id'=>'case_nurse02']) !!}
                        </div>
                        <div class="form-group col-md-6"><label>Practical nurse #1</label>
                            {!! Form::select('nurse03',array(''=>'เลือกผู้ช่วยพยาบาล')+array_pluck2($register_select,'name','id'),@$casedata->case_nurse03,['class'=>'form-control ','id'=>'case_nurse03']) !!}
                        </div>
                        <div class="form-group col-md-6"><label>Practical nurse #2</label>
                            {!! Form::select('nurse04',array(''=>'เลือกผู้ช่วยพยาบาล')+array_pluck2($register_select,'name','id'),@$casedata->case_nurse04,['class'=>'form-control ','id'=>'case_nurse04']) !!}
                        </div>
                        <div class="form-group col-md-12"><label>Pre-dianostic</label>
                              <input id="prediagnosis" name="prediagnosis" class="form-control  autotext" type="text">
                        </div>

                            <button id="savestep04" type="submit" class="btn btn-light-primary font-weight-bold mr-2 btn-lg">
                                <h3><i class="fas fa-save"></i>บันทึกเเละกลับไปยังหน้าทำหัตถการ</h3></button>
                            <a class="btn btn-light-danger font-weight-bold mr-2 btn-lg" href="{{url('home')}}" id="btn-confirm">
                                <h3><i class="flaticon2-delete"></i>ยกเลิกการนัดหมาย</h3></a>

                    </div>


                </form>
            </div>


    @endsection
    @section('script')
    <script>
        var KTBootstrapTimepicker = function () {
        var demos = function () {
            $('#kt_timepicker_1, #kt_timepicker_1_modal').timepicker();
        }
        return {
                init: function() {
                    demos();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTBootstrapTimepicker.init();
        });
        $("#datepicker").datepicker({format: 'yyyy-mm-dd'});
        $("#datepicker").on("change", function(){var fromdate = $(this).val();});
    </script>
    @endsection
