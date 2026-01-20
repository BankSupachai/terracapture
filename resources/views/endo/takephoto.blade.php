@extends('layouts.app')
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
        <div class="card">
            <div class="card-body">
            <label id="discharge_toggle"><font size ='4'><b>Page Detail</b></font></label>
                <div class="row">
                <div class="col-12">
                    Controller : <a href="autoit?run=visualcode_open\\endo.exe&path=TakePhotoController">TakePhotoController</a>
                </div>
                <div class="col-12">
                    View : <a href="autoit?run=visualcode_open\\endo.exe&path=takephoto">takephoto</a>
                </div>
            </div>
            </div>
        </div>

    </div>

</div>
<!-- end row -->


<div class="clearfix"></div>

<div class="row" style="margin: 0">
	<div class="col-12" style="margin: 1em 0em;">
        <div class="card">
            <div class="card-body" style="padding: 5px;">
                <div class="page-title-box">
                    <h4 class="page-title float-left" style="margin: 0;">Capture
                </h4>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

	</div>


	<div class="col-12">
        <div class="card">
		<div class="card-body">
			<div class="table-rep-plugin">



            <div class="col-md-12"><label class="col-form-label"><b>CASE ID :</b> {{$id}}&nbsp;&nbsp;&nbsp;&nbsp;</label></div>

            @php
            $patient = DB::table('tb_case')
            ->join('patient','patient.hn','=','tb_case.case_hn')
            ->where('case_id','=',$id)
            ->first();


            @endphp

            <div class="col-md-12"><label class="col-form-label"><b>HN           :</b> {{@$patient->hn }}</label></div>
            <div class="col-md-12"><label class="col-form-label"><b>Patient name :</b> {{@$patient->firstname }}&nbsp;&nbsp;{{$patient->lastname }}</label></div>
            <div class="col-md-12"><label class="col-form-label"><b>Age 		 :</b> {{@$patient->aaa}}</label></div>
            <div class="col-md-12"><label class="col-form-label"><b>Gender 		 :</b> {{@$patient->aaa}}</label></div>
            <div class="col-md-12"><label class="col-form-label"><b>Physician 	 :</b> {{@$patient->aa}}</label></div>
			<div class="col-md-12"><label class="col-form-label"><b>Procedure    :</b> {{@$patient->aaa}}</label></div>
			<div class="form-group col-md-3">
				@php
					$nurse    	= DB::table('users')->where('user_type', '=', 'nurse')->get();
					$register   = DB::table('users')->where('user_type', '=', 'register')->get();
					$room    	= DB::table('tb_room')->get();
					$anes     	= DB::table('users')->where('user_type', '=', 'anesthesia')->get();
					$casedata 	= DB::table('tb_case')->where('case_id', '=', $id)->first();
				@endphp
			</div>


            <br>


            <form action="takephoto" method="post" style="width: 100%;">
                @csrf

				<div class="col-12">
					<div class="row">

						<div class="col-12">

						<label>ห้อง</label>
							<br><label>#1</label>
							{!! Form::select('case_room',array(''=>'เลือกห้อง')+array_pluck($room,'name','id'),@$casedata->case_room,['class'=>'form-control','id'=>'']) !!}
						</div>




						<div class="col-3">
							<input type="hidden" name="id" value={{$id}}>

							<br><label>Nurse #1</label>
							{!! Form::select('case_nurse01',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$casedata->case_nurse01,['class'=>'form-control','id'=>'']) !!}
						</div>
						<div class="col-3">
							<label>&nbsp;</label>
							<br><label>Nurse #2</label>
							{!! Form::select('case_nurse02',array(''=>'เลือกพยาบาล')+array_pluck($nurse,'name','id'),@$casedata->case_nurse02,['class'=>'form-control','id'=>'']) !!}
						</div>
						<div class="col-3">
							<label>&nbsp;</label>
							<br><label>Practical nurse #1</label>
							{!! Form::select('case_nurse03',array(''=>'เลือกผู้ช่วยพยาบาล')+array_pluck($register,'name','id'),@$casedata->case_nurse03,['class'=>'form-control','id'=>'']) !!}
						</div>

						<div class="col-3">
							<label>&nbsp;</label>
							<br><label>Practical nurse #2</label>
							{!! Form::select('case_nurse04',array(''=>'เลือกผู้ช่วยพยาบาล')+array_pluck($register,'name','id'),@$casedata->case_nurse04,['class'=>'form-control','id'=>'']) !!}
						</div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-4">
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4 text-right"><a href="{{url("camera/$id")}}" class="btn btn-info">Web Capture</a></div>
                    </div>
				</div>




        {{ Form::close()}}


			</div>
		</div>
	</div>


@endsection
