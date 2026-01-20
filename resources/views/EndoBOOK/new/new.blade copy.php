@extends('layouts.book')
@section('title', 'EndoBook')
@section('style')
<style>
    .datepicker.datepicker-inline{
        width: 100%;
    }
    .header-list{
        background: #e9e8e8;
        border:1px solid #fff;
        padding: 0.75em;
        height: auto;
    }
    .header-list.add:hover{
        background: #b9b8b8;
    }
    .nav-item:hover .nav-link .nav-text{
        color: black !important;
    }
    .nav-item .nav-link{
        border-radius: 0;
        background: #e9e8e8;
        border: 1px solid #fff;
    }
    .nav-item .nav-link.active{
        background: #bdbcbc !important;
    }
    .box-data{
        width: 1em;
        height: 1em;
    }
    .rt{
        float: right;
    }
    .aln{
        align-items: flex-end;
    }
    #kt_select2_11 span,.select2-container{width: 100% !important;}
</style>
@endsection

@section('modal')
<div class="modal fade" id="show_hn_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h2>HN นี้มีในระบบแล้ว</h2>
                <hr>
                <div class="row m-0 h3">
                    <div class="col-auto">HN :</div>
                    <div class="col"><span id="show_hn"></span></div>
                </div>
                <div class="row m-0 h3">
                    <div class="col-auto">ชื่อ - นามสกุล :</div>
                    <div class="col"><span id="show_name"></span></div>
                </div>
                <hr>
                <div class="row m-0">
                    <div class="col-4">
                        <button type="button" class="btn btn-secondary w-100" id="dont_use_hn" data-dismiss="modal">ยกเลิก</button>
                    </div>
                    <div class="col-8">
                        <button type="button" class="btn btn-primary w-100" id="use_hn">ยันยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row m-0">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body p-0">
                <div class id="kt_datepicker_6"></div>

                <div class="row m-0">
                    <div class="col-lg-12">
                        <div class="row m-0 mt-5 rt">
                            <span class="box-data bg-success"></span> &nbsp; Available &emsp;
                            <span class="box-data bg-warning"></span> &nbsp; Some Booked &emsp;
                            <span class="box-data bg-danger"></span> &nbsp; All Booked
                            &emsp;
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row m-0 mt-5">
                            <div class="col-lg-8 h4">
                                Procedure available point
                            </div>
                            <div class="col-lg-4 h2 text-right">
                                7 / 10
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <table class="table table-borderless">
                            <tr>
                                <th colspan="2"><u>Procedure Point</u></th>
                            </tr>
                            @foreach ($count as $title => $number)
                                <tr>
                                    <td><h2>{{$title}}</h2></td>
                                    <td><h3>{{$number}}</h3></td>
                                </tr>
                            @endforeach
                            {{-- <tr>
                                <td><h2>Colonoscopy</h2></td>
                                <td><h3>2</h3></td>
                            </tr>
                            <tr>
                                <td><h2>ERCP</h2></td>
                                <td><h3>5</h3></td>
                            </tr>
                            <tr>
                                <td><h2>EUS</h2></td>
                                <td><h3>5</h3></td>
                            </tr> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-9">
        <div class="card">
            <div class="card-body p-0">
                <div class="row m-0">
                    <div class="col-lg-11 text-center h3 m-0 header-list">Task List (3rd January 2022)</div>
                    <div class="col-lg-1 text-center header-list add flip">
                        <i class="fas fa-plus text-dark icon-2x"></i>
                    </div>
                </div>

                <div class="row panel" style="display: none">
                    <div class="col-12">
                        <div class="tab-pane fade show active" id="home-4" role="tabpanel" aria-labelledby="home-tab-4">
                            {{--  --}}
                            <form action="{{url('booknew')}}" method="post">

                                @csrf
                                <input name="event" type="hidden" value="job_case">
                                    <div class="row m-0 aln">
                                        <div class="col-10">
                                            <div class="form-group m-0">
                                                <label for="inputEmail4" class="col-form-label">
                                                    <font size="2">HN</font>
                                                    <font size="3" color="red">*</font>
                                                    <font id="hn_alert" size="3" color="red">ห้ามพิมพ์เครื่องหมายพิเศษยกเว้นเครื่องหมาย -</font>
                                                </label>
                                                <input id="hn" name="hn" type="text" class="form-control" value="{{@$patient->hn}}"
                                                oninvalid="this.setCustomValidity('คุณลืมกรอก HN')"
                                                oninput="setCustomValidity('')"
                                                placeholder="H.N." required onpaste="return false" autocomplete="off">
                                                <div id="show_lang_in_here"></div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <a id="search_hn" class="btn btn-primary form-control">ค้นหา</a>
                                        </div>
                                    </div>

                                    <div class="row m-0 mt-3">
                                        <div class="col-lg-2">
                                            <label for="inputPassword4" class="col-form-label"><font size="2">คำนำหน้า</font><font size="3" color="red"></font></label>
                                            <input name="prefix" id="prefix" type="text" class="form-control savejson autotext" autocomplete="off">
                                        </div>
                                        <div class="col-lg-5">
                                            <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อ</font><font size="3" color="red">*</font></label>
                                            <input name="firstname" type="text" class="form-control" id="first_name" required>
                                        </div>
                                        <div class="col-lg-5">
                                            <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อสกุล</font><font size="3" color="red">*</font></label>
                                            <input name="lastname" type="text" class="form-control" id="last_name" required>
                                        </div>
                                    </div>

                                    <div class="row m-0 mt-3">
                                        <div class="col-lg-3">
                                            <label for="inputEmail4" class="col-form-label"><font size="2">เพศ</font><font color="red">*</font></label>
                                            <select class='form-control' name="gender" id="gender" required>
                                                <option value="" selected disabled hidden>Select</option>

                                                @forelse($gender as $l)
                                                    <option value='{{ $l->gender_id }}'  @if($l->gender_id==@$patient->gender) selected @endif>{{ $l->gender_name }}</option>
                                                @empty
                                                    <option>ไม่ข้อมูล</option>
                                                @endforelse

                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for='inputdate' class='col-form-label'><font size="2">วัน/เดือน/ปี เกิด</font></label>
                                            <div class="row" id="set_date">
                                                <div class="col-lg-4">
                                                    <select class='form-control' name='birthday' id="birthday">
                                                        @foreach($day_all as $day)
                                                            <option value="{{$day}}">{{$day}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <select class='form-control' name='birthmonth' id="birthmonth">

                                                        @foreach($month_all as $month)
                                                            <option value="{{$month}}">{{$month}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-lg-4">
                                                    <select class='form-control' name='birthyear' id="birthyear">

                                                        @foreach ($year_all as $data)
                                                            <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-3">
                                            <label for='agenew' class='col-form-label'>
                                                <font size="2">อายุ</font><font color="red">*</font>
                                            </label>
                                            <div class="row" style="margin: 0;">
                                                <input name="age" type="number" id="agenew" class="form-control" value="{{@$age}}" placeholder="อายุ" style="width: 95%" style="height: auto;" required>
                                            </div>
                                        </div>
                                        <input name="useropen"  type="hidden" value="{{Auth::id()}}">
                                    </div>

                                    <div class="row m-0 mt-3">
                                        <div class="col-4">
                                            <label><font size="2">นัดหมาย</font></label>
                                            <input name="meet_date" type="text" class="form-control" id="date_appoint" autocomplete="off">
                                        </div>
                                        <div class="col-4">
                                            <label><font size="2">เวลา (ชั่วโมง)</font></label>
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
                                        <div class="col-4">
                                            <label><font size="2">เวลา (นาที)</font></label>
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
                                    </div>
                                    <div class="row m-0 mt-3 mb-3">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="col-6">
                                            <label><font size="2">Procedure</font></label>
                                            {{-- <input type="text" name="case_procedure" class="form-control" id="case_procedure"> --}}
                                            <select class="form-control select2 w-100" id="kt_select2_11" multiple name="procedure[]" required>

                                                @foreach ($tb_procedure as $data)
                                                    <option value="{{$data->procedure_name}}">{{$data->procedure_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <label><font size="2">Endoscopist</font></label>
                                            <select class="form-control selectpicker" data-size="7" name="s_book_doctor" data-live-search="true" required>


                                                @if ($doctor != '')
                                                    <option value="">Select Doctor</option>
                                                    @foreach ($doctor as $d)
                                                    <option value="{{$d->id}}"
                                                        @if(isset($_GET['doctor']))
                                                            @if($_GET['doctor']==$d->id)
                                                                selected
                                                            @endif
                                                        @else
                                                            @if(Auth::id()==$d->id)
                                                                selected
                                                            @endif
                                                        @endif
                                                        >{{$d->name}}</option>
                                                    @endforeach
                                                @else
                                                <option>ไม่มีข้อมูล Doctor</option>
                                                @endif


                                            </select>
                                            {{-- {!!userSELECT('case_physicians01','เลือกแพทย์',$doctor_select,@$json->case_physicians01,'class="form-control savejson" required')!!} --}}
                                        </div>
                                    </div>
                                    <div class="col-md-12"><label><font size="2">Pre-diagnosis</font></label>
                                        <input id="prediagnosis" name="prediagnosis" class="form-control savejson autotext" type="text" autocomplete="off">
                                    </div>
                                    <div class="col-md-12 mb-3"><label><font size="2">หมายเหตุ</font></label>
                                        <textarea name="remark" id="" class="form-control" rows="3"></textarea>
                                    </div>

                                    <div class="col-12 mt-2 mb-3">
                                        <button class="btn btn-success btn-block">submit</button>
                                    </div>

                                </div>

                    </div>

                </div>


                <div class="row m-0">
                    <div class="col-lg-12 p-0">
                        {{--  --}}
                        <ul class="nav nav-pills row m-0" id="myTab1" role="tablist">
                            <li class="nav-item m-0 p-0 col-lg">
                                <a class="nav-link active text-center" id="home-tab-1" data-toggle="tab" href="#home-1">
                                    <span class="nav-text h4 m-0">Procedure Booked (5)</span>
                                </a>
                            </li>
                            <li class="nav-item m-0 p-0 col-lg text-center">
                                <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#profile-1" aria-controls="profile">
                                    <span class="nav-text h4 m-0">Other Booked (1)</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-5" id="myTabContent1">
                            <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
                                <table class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Time</th>
                                            <th scope="col">HN</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Physician</th>
                                            <th scope="col">Procedure</th>
                                            <th scope="col">Department</th>
                                            <th scope="col" colspan="2">ผู้ทำนัด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tb_casebooking as $tcd)
                                        @php
                                            $json = json_decode($tcd->book_appoint);
                                            $time = date("H:i", strtotime($tcd->book_date_start));
                                        @endphp
                                        <tr>
                                            <th scope="row">{{$time}}</th>
                                            <td>{{$json->HN}}</td>
                                            <td>{{$json->PTNAME}}</td>
                                            <td>{{$json->SURGEON}}</td>
                                            <td>{{$json->OPERATION}}</td>
                                            <td>MED</td>
                                            <td>-</td>
                                            <td><button  class="btn btn-outline-dark btn-sm"><i class="far fa-edit p-0"></i></button></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">Tab content 2</div>
                        </div>
                        {{--  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    var KTBootstrapDatepicker = function () {

var arrows;
if (KTUtil.isRTL()) {
 arrows = {
  leftArrow: '<i class="la la-angle-right"></i>',
  rightArrow: '<i class="la la-angle-left"></i>'
 }
} else {
 arrows = {
  leftArrow: '<i class="la la-angle-left"></i>',
  rightArrow: '<i class="la la-angle-right"></i>'
 }
}

var dpk = function () {
 $('#kt_datepicker_6').datepicker({
  rtl: KTUtil.isRTL(),
  todayHighlight: true,
  templates: arrows
 });
}

return {
 init: function() {
  dpk();
 }
};
}();

jQuery(document).ready(function() {
KTBootstrapDatepicker.init();
});




$(".flip").click(function(){
    $(".panel").fadeToggle(1000);
});


</script>


<script>
    $("#hn").keyup(function(){
        var hn = $(this).val()
        $.post("{{url('')}}/api/jquery",
            {
                event   : "check_hn",
                hn   : hn,
            },
            function(data, status)
            {
                var check_hn = JSON.parse(data);
                    if(check_hn.count==1){
                        // $("#name_return_old").html(check_hn.firstname+' '+check_hn.lastname)
                        // $('#change_hn_old').modal('show')
                        $("#show_hn_modal").modal('show')
                        $("#show_hn").html(hn)
                        $("#show_name").html(check_hn.firstname+' '+check_hn.lastname)
                    }else{

                    }

            });

    })

    $("#dont_use_hn").click(function(){
        $("#hn").val('')
    })
    $("#use_hn").click(function(){
        var hn = $("#hn").val()
        $.post("{{url('')}}/api/jquery",
            {
                event   : "check_hn",
                hn   : hn,
            },
            function(data, status)
            {
                var check_hn = JSON.parse(data);
                $("#first_name").val(check_hn.firstname)
                $("#last_name").val(check_hn.lastname)
                $("#prefix").val(check_hn.prefix)
                $("#prefix").val(check_hn.prefix)
                $("#gender").val(check_hn.gender).change()
                var bth = new Date(check_hn.birthdate)
                let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(bth);
                let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(bth);
                let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(bth);
                console.log("day :"+da)
                console.log("month :"+mo)
                console.log("year :"+parseInt(ye)+543)
                $("#birthday").val(da).change()
                $("#birthmonth").val(mo).change()
                $("#birthyear").val(parseInt(ye)+543).change()
                $("#show_hn_modal").modal('hide')
                        // $("#name_return_old").html(check_hn.firstname+' '+check_hn.lastname)
            });
    })

        $('#search_hn').click(function(){

        var hn = $("#hn").val();
        $.post("http://192.168.125.66/hisconnect/public/api/patient",
            {
                event   : "check_hn",
                hn   : $('#hn').val(),
            },
            function(data, status)
            {
                console.log(data);

                var check_hn = JSON.parse(data);

                console.log(data)
                console.log(check_hn)


                if(check_hn.status){
                    $("#hn_return").html(check_hn.hn)
                    $("#name_return").html(check_hn.firstname+' '+check_hn.lastname)
                    $('#patient_name').text('Name : '+check_hn.firstname+' '+check_hn.lastname);
                    $('#patient_hn').text('HN : '+check_hn.hn);
                    $('#mi_modal').modal('show');


                    $("#prefix").val(check_hn.prefix);
                    $("#first_name").val(check_hn.firstname);
                    $("#last_name").val(check_hn.lastname);
                    var gender = 1;
                    if(check_hn.sex=="ญ"){
                        gender = 2;
                    }

                    $("select[name=gender]").val(gender).change();

                    const m         = check_hn.birthdate.split("");
                    birth_day       = m[6]+m[7];
                    birth_year      = m[0]+m[1]+m[2]+m[3];
                    birth_month     = m[4]+m[5];

                    // alert(bd[0])
                    $("#birthday").val(birth_day).change();
                    $("#birthmonth").val(birth_month).change();
                    $("#birthyear").val(birth_year).change();
                    setTimeout(() => {
                        $("#birthyear").focus();
                    }, 2000);

                }else{
                    alert("ไม่พบ H.N. ในระบบ")
                }

            });
        });
</script>
@endsection
