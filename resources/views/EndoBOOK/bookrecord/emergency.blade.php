@extends('layouts.app')
@section('title', 'EndoBook')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{url('public/css/booking/index.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquery.datetimepicker.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquerysctipttop.css')}}">

    <style>
        body{
            background: #F7F7F7;
        }
        .bg-gray{
            background: #EBEBEB;
            width: 100%;
        }
        .bg-head-book{
            background: #D6D6D6;
        }
        .bg-head-book .col-8,.bg-head-book .col-4{
            font-weight: 600;
            font-size: 1.4em;
        }
        .table-bordered td{
            text-align: center;
            background: #F2F2F2;
        }
        .btn-book{
            font-size: 1.3em;
            padding: 0.8em;
        }
        .table-dark th{
            border: none !important;
        }
        .box{
            width: 1.2em;
            height: 1.2em;
        }
        .w-2{
            width: 2em;
        }
        .w-f{
            width: 15em;
        }
        .border-gray td{
            border-color: #c2c0c0;
        }
        .btn-book-mini{
            font-size: 1.2em;
            background: #9DA8CB;
            width: 100%;
            color: #fff !important;
            box-shadow: 0 5px 7px #d6d0d0;
        }
        .btn-book:hover,.btn-book-mini:hover{
            background: #7f89aa;
        }
        /* #kt_header{
            background: #6D7DB1;
        } */
        .btn-book-edit{
            width: 100%;
            background: #FDBB2D;
            border-radius: 0;
            font-weight: 700;
        }
        .btn-book-edit:hover{
            background: #c28d1c;
        }
        .radio.radio-outline.radio-info > span {
            background-color: #fff;
        }
    </style>
@endsection

@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
       <div class="modal-content">

            <div align="center">

            <br><h1 class="modal-title" id="myModalLabel"> คุณ <div id="patient_name"></div> ได้ทำการลงทะเบียนแล้ว</h1>
            <br><h1 class="modal-title" id="myModalLabel">HN.<div id="patient_hn"></div></h1>

            </div>
            <div class="modal-footer">
                <div class="row" style="    width: 100%;">
                    <div class="col-6"><button type="button" class="btn btn-danger" id="close_modal" data-dismiss="modal" style="width: 100%;padding:2em;"><h2 class="mb-0">ไม่ใช่</h2></button></div>
                    <div class="col-6"><button id="opencase" type="button" class="btn btn-primary" data-dismiss="modal" style="width: 100%;padding:2em;"><h2 class="mb-0">เลือกคนไข้รายนี้</h2></button></div>
                </div>
            </div>

       </div>
    </div>
</div>
@endsection

@section('content')

<div class="row m-0 px-5">


    <div class="col-2"></div>


    <div class="col-8">
        <div class="bg-gray py-5">

            <form action="{{url("book/bookrecord")}}" method="post">
                @csrf
                <input type="hidden" name="event" value="addto_tb_booking">

                <div class="col-12 mb-5">
                    <b>Patient Detail</b>
                </div>

            <div class="row m-0">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <label for="">HN(MRN) <b class="text-danger">*</b></label>
                            <input type="text" name="hn" id="hn" class="form-control form-control-sm"
                            value="{{@$patient->hn}}"
                            oninvalid="this.setCustomValidity('คุณลืมกรอก HN')"
                            oninput="setCustomValidity('')"
                            placeholder="H.N." required onpaste="return false"
                            >
                        </div>
                        <div class="col-6">
                            <label for="">เลขประจำตัวประชาชน</label>
                            <input type="text" name="citizenid" id="citizen" class="form-control form-control-sm">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-2">
                            <label for="">คำนำหน้า</label>
                            <input type="text" name="prefixname" id="prefix" class="form-control form-control-sm">
                        </div>
                        <div class="col-4">
                            <label for="">ชื่อ <b class="text-danger">*</b></label>
                            <input type="text" name="firstname" id="firstname" class="form-control form-control-sm">
                        </div>
                        <div class="col-2">
                            <label for="">ชื่อกลาง</label>
                            <input type="text" name="middlename" id="middlename" class="form-control form-control-sm">
                        </div>
                        <div class="col-4">
                            <label for="">ชื่อสกุล <b class="text-danger">*</b></label>
                            <input type="text" name="lastname" id="lastname" class="form-control form-control-sm">
                        </div>

                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-3">
                            <label>เพศ <b class="text-danger">*</b></label>
                            <div class="radio-inline">
                                <label class="radio radio-outline radio-info">
                                    <input type="radio" name="gender" id="gender_m" value="male"/>
                                    <span></span>
                                    ชาย
                                </label>
                                <label class="radio radio-outline radio-info">
                                    <input type="radio" name="gender" id="gender_f" value="female"/>
                                    <span></span>
                                    หญิง
                                </label>
                            </div>
                        </div>

                        <div class="col-9">
                            <label for="">วัน/เดือน/ปี เกิด <b class="text-danger">*</b></label>
                            <div class="row m-0">
                                <div class="col pl-0">
                                    <select name="day" id="birthday" class="form-control form-control-sm">
                                        @foreach($day_all as $day)
                                            <option value="{{$day}}">{{$day}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <select name="month" id="birthmonth" class="form-control form-control-sm">
                                        @foreach($month_all as $month)
                                            <option value="{{$month}}">{{$month}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <select name="year" id="birthyear" class="form-control form-control-sm">
                                        @foreach($year_all as $year)
                                            <option value="{{$year}}">{{$year}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col pl-0">
                                    <input type="text" name="age" id="agenew" class="form-control form-control-sm" placeholder="age">
                                </div>
                            </div>
                        </div>



                        <div class="col-12">
                            &nbsp;
                        </div>

                        <div class="col-5">
                            <label>Patient type</label>
                            <div class="radio-inline">
                                <label class="radio radio-outline radio-info">
                                    <input type="radio" name="form_patient_type" value="service" checked/>
                                    <span></span>
                                    Service
                                </label>
                                <label class="radio radio-outline radio-info">
                                    <input type="radio" name="form_patient_type" value="special"/>
                                    <span></span>
                                    Special
                                </label>
                                <label class="radio radio-outline radio-info">
                                    <input type="radio" name="form_patient_type" value="premium"/>
                                    <span></span>
                                    Premium
                                </label>
                            </div>
                        </div>

                        <div class="col-7">
                            <label for="">โทรศัพท์</label>
                            <input type="text" name="phone" id="" class="form-control form-control-sm">
                        </div>


                    </div>
                </div>

                <div class="col-6">
                    <div class="row m-0">



                        <div class="col-6">
                            <label>แพทย์</label>
                            @if(Auth::user()->user_type =='doctor')
                                <b>{{@Auth::user()->user_prefix}} {{@Auth::user()->user_firstname}} {{@Auth::user()->user_lastname}}</b>
                                <input type="hidden" name="form_doctor" id="form_doctor" value="{{@Auth::user()->id}}">
                            @else
                                <select name="form_doctor" id="form_doctor" class="form-control form-control-sm" required>
                                    <option value="">เลือกแพทย์</option>
                                    @foreach($physician as $data)
                                        <option value="{{$data->id}}">
                                            {{$data->user_prefix}}{{$data->user_firstname}} {{$data->user_lastname}}
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="col-6">
                            <label>ช่วงเวลา</label>
                            <select name="period" class="form-control" required>
                                <option value="">เลือกช่วงเวลา</option>
                                <option value="am">เช้า</option>
                                <option value="pm">บ่าย</option>
                                <option value="out">นอกเวลา</option>
                            </select>
                        </div>

                        <div class="col-4">
                                <input type="hidden"    name="event"                value="addto_tb_booking">
                                <input type="hidden"    name="create_time"          value="{{date("ymdhis")}}">
                                <input type="hidden"    name="form_date"            value="{{date("Y-m-d")}}">
                                <input type="hidden"    name="form_urgent"          value="urgency"/>
                                <input type="hidden"    name="form_time_type"       value="emergency">
                                <label>Procedure</label>
                                <select name="procedure[]" id="procedure01" class="form-control form-control-sm" required>
                                    <option value="">เลือกหัตถการ</option>
                                    @foreach($procedure as $data)
                                        <option value="{{$data->procedure_code}}">
                                            {{$data->procedure_name}}
                                        </option>
                                    @endforeach
                                </select>


                                <select name="procedure[]" id="procedure02" class="form-control form-control-sm">
                                    <option value="">เลือกหัตถการ</option>
                                    @foreach($procedure as $data)
                                        <option value="{{$data->procedure_code}}">
                                            {{$data->procedure_name}}
                                        </option>
                                    @endforeach
                                </select>


                                <select name="procedure[]" id="procedure03" class="form-control form-control-sm">
                                    <option value="">เลือกหัตถการ</option>
                                    @foreach($procedure as $data)
                                        <option value="{{$data->procedure_code}}">
                                            {{$data->procedure_name}}
                                        </option>
                                    @endforeach
                                </select>


                                <select name="procedure[]" id="procedure04" class="form-control form-control-sm">
                                    <option value="">เลือกหัตถการ</option>
                                    @foreach($procedure as $data)
                                        <option value="{{$data->procedure_code}}">
                                            {{$data->procedure_name}}
                                        </option>
                                    @endforeach
                                </select>

                        </div>
                        <div class="col-8">
                            <label for="">Pre-Diagnosis</label>
                            <input type="text" name="prediagnosis" id="" class="form-control form-control-sm">
                            <label for="">comment</label>
                            <textarea name="comment" id=""  rows="4" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>

                    <div class="col-12">
                        <br>
                        <button type="submit" class="btn btn-book-mini">Confirm Book</button>
                    </div>


                </div>


            </div>



            </form>
        </div>
    </div>
</div>


@endsection

@section('script')






<script>
        $('#hn').focusout(function(){
        var hn = $("#hn").val();
        $.post("{{url('api/bookset')}}",
        {
            event : 'hn_check',
            value : hn,
        },
        function(data,status){
            if(data.length>10){
                var obj = JSON.parse(data);
                console.log(obj);
                $("#prefix").val(obj.prefix);
                $("#firstname").val(obj.firstname);
                $("#middlename").val(obj.middlename);
                $("#lastname").val(obj.lastname);
                $("#phone").val(obj.phone);

                if(obj.gender==1){
                    $("#gender_m").val('male').prop("checked", true);
                }else{
                    $("#gender_f").val('male').prop("checked", true);
                }
                $("#mi_modal").modal('show');
                $("#patient_name").html(obj.prefix+' '+obj.firstname+' '+obj.middlename+' '+obj.lastname)
                $("#patient_hn").html(hn)
                setTimeout(() => {
                    $("#birthday").val(obj.birthdate_day).change();
                    $("#birthmonth").val(obj.birthdate_month).change();
                    $("#birthyear").val(obj.birthdate_year).change();
                }, 500);
            }
        });
    });

    $("#birthyear,#birthmonth,#birthday").change(function(){
        $.post("{{url('api/bookset')}}",
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
        if($(this).val() >120){$(this).val(120);}
        var date   = {{date('Y')}}+543;
        var year   = date-$(this).val();
        $("#birthyear").val(year);
    });
    $('#close_modal').on('click', function () {
        location.reload();
    })
</script>





@endsection
