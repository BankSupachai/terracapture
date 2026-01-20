@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{url("public/css/patient/edit.css")}}" rel="stylesheet" type="text/css" />

@endsection
@section('content')

<div class="clearfix"></div>


    <form action="../../patient/{{$patient->_id}}" method="post" style="width: 100%;">
        @method('put')
        @csrf

                        <div class="row" id="step01" style="margin: 0;">
                            <div class="col-4" style="height: 100%;">
                                <div class="card">
                                <div class="card-body">
                                    <div class="row" style="margin: 0;">

                                        <div class="col-12">
                                            <div class="col" align="center">
                                                @if(@$patient->pic=="")
                                                    <img  id="imgnew" src="{{asset('public/images/avatar.png')}}" width="183px"/>
                                                @else
                                                    <img  id="imgnew" src="{{url("pic_patient/$patient->pic")}}?a={{date("Y-m-dH:i:s")}}" width="183px"/>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            @if (count($errors) > 0)
                                                <div class="alert alert-danger">
                                                <ul>
                                                    @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-12">
                                                    <input name="prepage" type="hidden" value="{{@$_GET['prepage']}}">
                                                    <div class="p-20" style="padding: 0 !important">
                                                                <div class="form-group">
                                                                    <label for="inputEmail4" class="col-form-label"><font size="2">HN<font size="3" color="red">*</font></font></label>
                                                                    <input id="hn" name="hn" type="text" class="form-control" value="{{@$patient->hn}}" placeholder="H.N." required onpaste="return false" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassword4" class="col-form-label"><font size="2">AN</font></label>
                                                                    <input id="an" name="an" type="text" class="form-control" value="{{@$patient->an}}" placeholder="AN">
                                                                    {{-- @if(isset($patient->an))
                                                                    {{ Form::text('an',$patient->an,['class'=>'form-control','readonly','autocomplete'=>"off"]) }}
                                                                    @else
                                                                    {{ Form::text('an','',['class'=>'form-control','autocomplete'=>"off"]) }}
                                                                    @endif --}}
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="inputPassword4" class="col-form-label"><font size="2">เลขที่ประจำตัวประชาชน / เลขที่ PASSPORT </font></label>
                                                                    <input id="citizen" name="citizen" type="text" class="form-control" value="{{@$patient->citizen}}" placeholder="ID / PASSPORT" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputPassword4" class="col-form-label"><font size="2">สัญชาติ</font></label>
                                                                    {{select_users($nationality,1,'id',['namethai'],'nationality','เลือกสัญชาติ','form-control')}}
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <div class="col-8">
                                <div class="card" style="height: 100%;">
                                    <div class="card-body">
                                                        <div class="form-row">
                                                            <div class="form-group col-lg-2">
                                                                <label for="inputPassword4" class="col-form-label"><font size="2">คำนำ</font><font size="3" color="red"></font></label>
                                                                <input name="prefix" id="prefix" type="text" value="{{$patient->prefix}}" class="form-control savejson autotext" autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-md">
                                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อ</font><font size="3" color="red">*</font></label>
                                                                <input name="firstname" type="text" class="form-control" value="{{$patient->firstname}}" required autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-md">
                                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อกลาง</font><font size="3" color="red">&nbsp;</font></label>
                                                                <input name="middlename" type="text" class="form-control" value="{{@$patient->middlename}}" autocomplete="off">
                                                            </div>
                                                            <div class="form-group col-md">
                                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อสกุล</font><font size="3" color="red">*</font></label>
                                                                <input name="lastname" type="text" class="form-control" value="{{$patient->lastname}}" required  autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <label for="inputEmail4" class="col-form-label"><font size="2">เพศ</font><font color="red">*</font></label>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <select class='form-control' name="gender" required>
                                                                        <option value="" selected disabled hidden>Select</option>
                                                                        <option value="1" @if("2"==@$patient->gender) selected @endif>Male</option>
                                                                        <option value="2" @if("1"==@$patient->gender) selected @endif>Female</option>

                                                                        {{-- @forelse($gender as $l)
                                                                            <option value='{{ $l->gender_id }}'  @if($l->gender_id==@$patient->gender) selected @endif>{{ $l->gender_name }}</option>
                                                                        @empty
                                                                            <option>ไม่พบข้อมูล</option>
                                                                        @endforelse --}}
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for='inputdate' class='col-form-label'><font size="2">วัน/เดือน/ปี เกิด</font><font color="red">*</font></label>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <select class='form-control' name='birthday' id="birthday">
                                                                            @foreach($day_all as $day)
                                                                                <option value="{{$day}}" @if($day==$birthday) selected @endif>{{$day}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <select class='form-control' name='birthmonth' id="birthmonth">
                                                                            @foreach($month_all as $month)
                                                                                <option value="{{$month}}" @if($month==$birthmonth) selected @endif>{{$month}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <select class='form-control' name='birthyear' id="birthyear">
                                                                            @foreach($year_all as $year)
                                                                                <option value="{{$year}}" @if($year==$birthyear) selected @endif>{{$year}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-3">
                                                                <label for='agenew' class='col-form-label'>
                                                                <font size="2">อายุ</font><font color="red">*</font>
                                                                </label>
                                                                <div class="row">
                                                                <input name="age" type="number" max="120" id="agenew" class="form-control" value="{{@$age}}" placeholder="อายุ" style="width: 95%" style="height: auto;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="inputEmail4" class="col-form-label"><font size="2">โทร</font> </label>
                                                                        @if(isset($patient->phone))
                                                                        {{ Form::text('phone',$patient->phone,['class'=>'form-control']) }}
                                                                        @else
                                                                        {{ Form::text('phone','',['class'=>'form-control']) }}
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="inputEmail4" class="col-form-label"><font size="2">ประวัติการแพ้ยา</font><font color="red">*</font> </label>
                                                                        @if(isset($patient->allergic))
                                                                        {{ Form::text('allergic',$patient->allergic,['class'=>'form-control']) }}
                                                                        @else
                                                                        {{ Form::text('allergic','',['class'=>'form-control']) }}
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-group col-md-12">
                                                                        <label for="inputEmail4" class="col-form-label">บุคคลติดต่อฉุกเฉิน</label>
                                                                        @if(isset($patient->emer_name))
                                                                        {{ Form::text('emer_name',$patient->emer_name,['class'=>'form-control']) }}
                                                                        @else
                                                                        {{ Form::text('emer_name','',['class'=>'form-control']) }}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="form-row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="inputPassword4" class="col-form-label"><font size="2">Email</font></label>
                                                                        @if(isset($patient->email))
                                                                        {{ Form::text('email',$patient->email,['class'=>'form-control']) }}
                                                                        @else
                                                                        {{ Form::text('email','',['class'=>'form-control']) }}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12" style="    padding: 0;">
                                                                    <label for="inputEmail4" class="col-form-label"><font size="2">ประวัติโรคประจำตัว</font> </label>
                                                                    @if(isset($patient->congenital_disease))
                                                                    {{ Form::text('congenital_disease',$patient->congenital_disease,['class'=>'form-control']) }}
                                                                    @else
                                                                    {{ Form::text('congenital_disease','',['class'=>'form-control']) }}
                                                                    @endif
                                                                </div>
                                                                <div class="form-group col-md-12" style="    padding: 0;">
                                                                    <label for="inputPassword4" class="col-form-label">โทร</label>
                                                                    @if(isset($patient->emer_tel))
                                                                    {{ Form::text('emer_tel',$patient->emer_tel,['class'=>'form-control','']) }}
                                                                    @else
                                                                    {{ Form::text('emer_tel','',['class'=>'form-control']) }}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-lg-6">
                                                            <button id="savestep04" type="submit" class="btn-block btn-lg btn-info waves-effect waves-light btn-radiuus">
                                                            <font size="4">บันทึก</font></button>
                                                        </div>


                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                        <!-- end row -->

                                    </div> <!-- end card-box -->
                                </div>
                            </div><!-- end col -->
                        </div>
                        <div class="clearfix"></div>
                        <br />



    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-sm">
           <div class="modal-content">

                <div align="center">

                <br><h6 class="modal-title" id="myModalLabel"> คุณ <div id="patient_name"></div> ได้ทำการลงทะเบียนแล้ว</h6>
                <br><h6 class="modal-title" id="myModalLabel">HN.<div id="patient_hn"></div></h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ไม่ใช่</button>
                    <a id="opencase" type="button" class="btn btn-primary" href="">เลือกคนไข้รายนี้</a>
                </div>

           </div>
        </div>
    </div>

    <footer class="footer text-right">
        © Medica Healthcare.
    </footer>

@endsection


@section('script')

<script src     ="{{url('public/js/jquery.input-dropdown.js')}}"></script>
<script src     ="{{url('public/js/patient/edit.js')}}"></script>
<script type="text/javascript">



$('.savejson').bind('focusout',function(){
    var this_id     = $(this).attr('id');
    var this_type   = $(this).attr('type');
    var procedure   = 0;
    if(this_type=="checkbox"){
        $.post('{{url('api/photomove')}}',{
            event       : 'savejson2',
            name        : this_id,
            value       : $(this).prop('checked'),
            field       : 'case_json',
            procedure   : procedure,
        },function(data,status){});
    }else{
        $.post('{{url('api/photomove')}}',{
            event       : 'savejson2',
            name        : this_id,
            value       : $('#'+this_id).val(),
            field       : 'case_json',
            procedure   : procedure,
        },function(data,status){});
    }
});

$('.autotext').on('click keyup',function(){
    var this_id     = $(this).attr('id');
    var this_value  = $(this).val();
    $.post("{{url('api/photo')}}",{
    event       : 'jqinputdropdown',
    textid      : this_id,
    value       : this_value,
    procedure   : 0,
    },function(data,status){
        dataList = [];
        dataList = JSON.parse(data);
        $('#'+this_id).inputDropdown(dataList, {
            formatter: data => {return `<li language="${data.value}">`+data.name+'</li>'},
            valueKey: 'language'
        });
        var wi = $('#'+this_id).css('width');
        $('.jq-input-dropdown').css({'min-width':wi});
        $('#jq-input-dropdown_'+this_id).show();
        var html_li = "";
        dataList.forEach(obj => {
            html_li += '<li language="'+obj['value']+'">'+obj['value']+'</li>';
        });
        $('#jq-input-dropdown_'+this_id).html(html_li);

        $('li').on('click',function(){
            $('#'+this_id).focus();
            // $('#jq-input-dropdown_'+this_id).remove();
        });
    });
});

$('html').keyup(function(e){
        if(e.keyCode == 46) {
            $(":focus").each(function() {
                var text = $(this).val();
                $(this).val('');
                $.post('{{url('api/photomove')}}',{
                event : 'delautotext',
                text : text,
                textid: this.id,
                procedure    : 0,
                },function(data,status){});
            });
        }
});

$('input').attr('autocomplete','off');

    $("#birthyear,#birthmonth,#birthday").change(function(){
        $.post("{{url('jquery')}}",
        {
            event   : 'birth_change',
            day     : $("#birthday").val(),
            month   : $("#birthmonth").val(),
            year    : $("#birthyear").val()
        },
        function(data,status){
            var obj = JSON.parse(data);
            $("#agenew").val(obj[0]);
        });
    });


    $("#agenew").on('keyup keypress blur change',function(e){
        if($(this).val() >120){
                $(this).val(120);
        }

        $.post("{{url('jquery')}}",
        {
            event   : 'age_change',
            age     : $("#agenew").val(),
        },
        function(data,status){
            var obj = JSON.parse(data);
            $("#birthyear").val(obj[0]);
        });
    });


  </script>




@endsection
