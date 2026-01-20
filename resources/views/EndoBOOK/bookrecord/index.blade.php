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
            background: #245788;
            width: 100%;
            color: #fff !important;
        }
        .btn-book:hover,.btn-book-mini:hover{
            background: #11314e;
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

            <h1 class="modal-title" id="myModalLabel"> คุณ <div id="patient_name"></div> ได้ทำการลงทะเบียนแล้ว</h1>
            <h1 class="modal-title" id="myModalLabel">HN.<div id="patient_hn"></div></h1>

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


<div class="modal fade" id="confirm_book" tabindex="-1" role="dialog" aria-labelledby="confirm_bookLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirm_bookLabel">Confirm book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-footer row m-0">
                <button type="button" class="btn btn-secondary col" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-book-mini btn-sm col-8" data-dismiss="modal" onclick="submit_form()">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row m-0 px-5">
    <div class="col-xl-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row cn mb-3">
                        <div class="col"><b class="h4">Booking Detail</b></div>
                        <div class="col-auto">
                            <a href="{{ url()->previous() }}" class="btn btn-book-edit btn-warning btn-sm">Edit booking</a>
                        </div>
                    </div>

                    <table class="table table-borderless m-0">

                        <tr>
                            <td>Date :</td>
                            <td class="text-primary">{{@$date}}</td>
                        </tr>
                        <tr>
                            <td>Procedure :</td>
                            <td class="text-primary">
                                {{-- @foreach ($procedure as $pcd)
                                    {{$pcd}} &nbsp;
                                @endforeach --}}
                            </td>
                        </tr>
                        <tr>
                            <td>Period :</td>
                            <td>{{@$period}}</td>
                        </tr>


                        <tr>
                            <td>Physician :</td>
                            <td>
                                {{-- @php
                                    $doctor = DB::table('users')->where('id',$form_doctor)->first();
                                @endphp

                                {{"$doctor->user_prefix$doctor->user_firstname $doctor->user_lastname"}} --}}


                            </td>
                        </tr>
                        <tr>
                            <td>Patient Type :</td>
                            <td>{{@$form_patient_type}}</td>
                        </tr>
                        <tr>
                            <td>Anesthesia :</td>
                            <td>{{@$form_anesthesia}}</td>
                        </tr>
                        <tr>
                            <td>Special :</td>
                            <td>{{@$form_special}}</td>
                        </tr>
                        <tr>
                            <td>Urgent :</td>
                            <td>{{@$form_urgent}}</td>
                        </tr>
                    </table>
                </div>
            </div>





    </div>




    <div class="col-xl-9">
        <div class="card">
            <div class="card-body">
                <form autocomplete="off" action="{{url("book/bookrecord")}}" method="post">
                    @csrf
                    <input type="hidden"    name="event"                value="addto_tb_booking">
                    <input type="hidden"    name="create_time"          value="{{@$create_time}}">
                    <input type="hidden"    name="form_doctor"          value="{{@$form_doctor}}">
                    <input type="hidden"    name="form_patient_type"    value="{{@$form_patient_type}}">
                    <input type="hidden"    name="form_urgent"          value="{{@$form_urgent}}">
                    <input type="hidden"    name="form_date"            value="{{@$form_date}}">
                    <input type="hidden"    name="period"               value="{{@$period}}">
                    @foreach($form_procedure as $data)
                        <input type="hidden"    name="procedure[]" value="{{$data}}">
                    @endforeach

                    <div class="col-12 mb-5">
                        <b class="h4">Patient Detail</b>
                    </div>
                    <div class="row m-0">
                        <div class="col-4">
                            <label for="">Patient ID <b class="text-danger">*</b></label>
                            <input id="hn" name="hn" type="text" class="form-control" value="{{@$patient->hn}}"
                            oninvalid="this.setCustomValidity('คุณลืมกรอก HN')"
                            oninput="setCustomValidity('')"
                            placeholder="H.N."
                            required
                            onpaste="return false"
                            autocomplete="off"
                            >
                        </div>
                        <div class="col-8">
                            <label for="">Citizen</label>
                            <input type="text" name="citizenid" id="citizen" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row m-0 mt-4">
                        <div class="col-2">
                            <label for="">Prefix</label>
                            <input type="text" name="prefixname" id="prefix" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label for="">First Name <b class="text-danger">*</b></label>
                            <input type="text" required name="firstname" id="firstname" class="form-control form-control-sm" autocomplete="off">
                        </div>
                        <div class="col">
                            <label for="">Middle Name</label>
                            <input type="text" name="middlename" id="middlename" class="form-control form-control-sm" autocomplete="off">
                        </div>
                        <div class="col-4">
                            <label for="">Last Name  <b class="text-danger">*</b></label>
                            <input type="text" required name="lastname" id="lastname" class="form-control form-control-sm" autocomplete="off">
                        </div>
                    </div>
                    <div class="row m-0 mt-4">
                        <div class="col-4">
                            <label for="">
                                DOB <b class="text-danger">*</b>
                                <div class="row m-0">
                                    <div class="col pl-0">
                                        <select class='form-control' name='birthday' id="birthday">
                                            @foreach($day_all as $day)
                                                <option value="{{$day}}">{{$day}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pl-0">
                                        <select class='form-control' name='birthmonth' id="birthmonth">
                                            @foreach($month_all as $month)
                                                <option value="{{$month}}">{{$month}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pl-0">
                                        <select class='form-control' name='birthyear' id="birthyear">
                                            @foreach($year_all as $year)
                                                <option value="{{$year}}">{{$year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pl-0">
                                        <input name="age" type="number" id="agenew" class="form-control" value="{{@$age}}" placeholder="อายุ" style="height: auto;" required>
                                    </div>
                                </div>
                            </label>
                        </div>
                        <div class="col-4">
                            <label>Gender  <b class="text-danger">*</b></label>
                            <div class="radio-inline">
                                <label class="radio radio-outline radio-info">
                                    <input type="radio" name="gender" id="gender_m" value="male" required />
                                    <span></span>
                                    Male
                                </label>
                                <label class="radio radio-outline radio-info">
                                    <input type="radio" name="gender" id="gender_f" value="female"/>
                                    <span></span>
                                    Female
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="">Phone Number</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-12 mt-3">
                            <hr>
                        </div>
                    </div>
                    {{-- <div class="row m-0 mt-4">
                        <div class="col-4">
                            <label for="">Patient Type <span class="text-danger">*</span></label>
                            <select name="jobtype" id="" class="form-control form-control-sm"></select>
                        </div>
                        <div class="col-4">
                            <label for="">Urgent <span class="text-danger">*</span></label>
                            <select name="urgent" id="" class="form-control form-control-sm"></select>
                        </div>
                    </div> --}}
                    <div class="row m-0 mt-4">
                        <div class="col">
                            <label for="">Pre-Diagnosis <span class="text-danger">*</span></label>
                            <input type="text" name="prediagnosis" id="" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="row m-0 mt-4">
                        <div class="col">
                            <label for="">comment</label>
                            <textarea name="comment" id=""  rows="4" class="form-control form-control-sm"></textarea>
                        </div>
                    </div>
                    <div class="row m-0 mt-5 pt-5">
                        <div class="col-lg"></div>
                        <div class="col-lg-4"><button type="button" class="btn btn-book-mini btn-sm" data-toggle="modal" data-target="#confirm_book">Confirm Book</button></div>
                        <div class="col-lg"><button type="submit" style="display: none;" id="form_submit"></button></div>
                    </div>
                </form>
            </div>
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






<script>
    function submit_form(){
        $("#form_submit").click();
    }
</script>



@endsection
