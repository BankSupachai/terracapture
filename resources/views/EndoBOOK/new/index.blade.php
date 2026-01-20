@php
$view['dateapp'] = $dateapp;
@endphp


@extends('layouts.book')
@section('title', 'EndoBook')
@section('style')
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/index.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquery.datetimepicker.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('public/css/booking/jquerysctipttop.css')}}">

<style>
    .datepicker {
      z-index: 9999 !important; /* has to be larger than 1050 */
    }

    .xdsoft_datepicker {
      z-index: 9999 !important; /* has to be larger than 1050 */
    }
    .text-yellow{
        color:yellow;
    }
    .fas.fa-circle.text-yellow{
        color: yellow !important;
    }
    /* .fc-header-toolbar{
        display: none;
    } */
    .fc-unthemed .fc-event .fc-time{
        display: none;
    }
    #myTab1 .nav-item{
        width: 40%;
        text-align: center;
    }
    #myTab1{
        justify-content: right;
    }
    /* .fc-fri { color:blue; } */

    .fc-today {
        background: #E5E8E8 !important;
    }


    .fc-sat { color:white;background: #F0F3F4;  }
    .fc-sun { color:white;background: #F0F3F4;  }
    .fc-view-container,.fc-right{

        display: block !important;
    }
    .fc-left{
        display: none;
    }
    .fc-toolbar.fc-header-toolbar {
        justify-content: end !important;
    }
    #menu_header_select{
        position: absolute;
        width: 40%;
    }
    .fc-button-group .fc-button-active{
        background: rgb(92, 86, 143) !important;
        border: none !important;
    }
    .select2-selection .select2-selection--multiple,.select2-container{
        width: 100% !important;
    }
    .fc-event-solid-text-yellow{
        background: yellow !important;
    }
    .fc-event-solid-text-primary{
        background: #3699FF !important;
        color: #fff !important;
    }
    .fc-event-solid-text-primary .fc-title{
        /* color: #fff !important; */
    }

</style>


    @component("EndoBOOK.new.countjob",$view)@endcomponent


@endsection

@section('modal')
<div id="modal_capture" class="modal fade" id="isday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header p-0">
            <h2 class="pt-2 pl-3" id="exampleModalLabel">Appointment System Detail</h2>
            <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal" aria-label="Close">
                X
            </button>
            </div>
        <div class="modal-body">
            <table id="table_capture" class="table table-striped">


            </table>
        </div>
        <div class="modal-footer p-0">
          <button type="button" class="btn btn-primary w-100 btn-border">Save changes</button>
        </div>
      </div>
    </div>
</div>

<div id="modal_eventdetail" class="modal fade" id="isday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{url('booknew')}}" method="post">
            @csrf
            <input type="hidden" name="event" value="update_event">

            <div class="modal-content">
                <div class="modal-header p-0">
                <h2 class="pt-2 pl-3" id="exampleModalLabel">Booking Detail</h2>
                <button type="button" class="btn btn-danger btn-lg btn-close p-1" data-dismiss="modal" aria-label="Close">
                <i class="flaticon2-delete icon-md"></i>
                </button>
                </div>
                <div class="modal-body">
                    <div id="event_detail" class="row ct">
                        <div class="col-6">Book ID :</div>    <div class="col-6"><input id="modal_book_id"          name="book_id"          class="form-control mt-2 text-id" readonly></div>
                        <div class="col-6">Topic :</div>      <div class="col-6"><input id="modal_book_topic"       name="book_topic"       class="form-control mt-2 text-id" readonly></div>
                        <div class="col-6">Title :</div>      <div class="col-6"><input id="modal_book_title"       name="book_title"       class="form-control mt-2" ></div>
                        <div class="col-6">Start Date :</div> <div class="col-6"><input id="modal_book_date_start"  name="book_date_start"  class="form-control mt-2" ></div>
                        <div class="col-6">End Date :</div>   <div class="col-6"><input id="modal_book_date_end"    name="book_date_end"    class="form-control mt-2" ></div>
                        <div class="col-6">Note :</div>       <div class="col-6"><input id="modal_book_comment"     name="book_comment"     class="form-control mt-2" ></div>
                    </div>
                </div>
                <div class="modal-footer p-0">
                    <div class="row m-0 w-100">
                        <div class="col-lg-6 p-0"><button name="btn_submit"   value="cancel"  type="submit" class="btn btn-light-danger font-weight-bold mr-2 w-100 btn-border"><i class="flaticon-delete icon-md"></i>Cancel Book</button></div>
                        <div class="col-lg-6 p-0"><button name="btn_submit"   value="save"    type="submit" class="btn btn-light-warning font-weight-bold mr-2 w-100 btn-border"><i class="flaticon-edit icon-md"></i>Edit Book</button></div>
                    </div>
                </div>
            </div>

        </form>

    </div>
</div>

<div id="mi_modal" class="modal fade" id="isday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <input type="hidden" name="event" value="update_event">

        <div class="modal-content">
            <div class="modal-header p-0 bg-success text-light">
            <h2 class="pt-2 pl-3" id="exampleModalLabel">Patient</h2>
            </div>
            <div class="modal-body">
                <h1 class="text-center">ผู้ป่วยนี้มีในระบบแล้ว</h1>
                <h1 id="patient_name"></h1>
                <h1 id="patient_hn"></h1>
            </div>
            <div class="modal-footer p-0">
                <div class="row m-0 w-100">
                    <div class="col-lg-8 p-0"><button id="btn_yes_hn" name="btn_submit" value="save" type="button" class="btn btn-success w-100 btn-border" data-dismiss="modal">เลือกผู้ป่วยรายนี้</button></div>
                    <div class="col-lg-4 p-0"><button id="btn_no_hn" class="btn btn-secondary w-100 btn-border" data-dismiss="modal">ไม่ใช่</button></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="create_case" class="modal fade" id="isday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
            <div class="modal-header p-0 row m-0">
                <div class="col-12">
                    <h2 class="pt-2 pl-3 w-100">Create Case</h2>
                    <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <div class="col-12 p-0 mt-3">
                    <ul class="nav nav-pills nav-fill nav-light-success">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab-4" data-toggle="tab" href="#home-4">
                                <span class="nav-icon">
                                    <i class="fas fa-id-badge"></i>
                                </span>
                                <span class="nav-text">Patient</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-4" data-toggle="tab" href="#profile-4" aria-controls="profile">
                                <span class="nav-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </span>
                                <span class="nav-text">Procedure</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="modal-body">
                <div class="tab-content mt-5" id="myTabContent4">
                    <div class="tab-pane fade show active" id="home-4" role="tabpanel" aria-labelledby="home-tab-4">
                        {{--  --}}
                        <form action="{{url('book')}}" method="post">
                            @csrf
                            <input name="event" type="hidden" value="job_case">
                            <div class="col-lg-12">
                                <a id="readcitizencard"
                                class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success"
                                data-toggle="tooltip" title="Read Citizencard"
                                >
                                    <i class="fas fa-address-card"></i>
                                </a>
                            </div>
                            <div class="col-lg-12" style="height: 100%;padding:4px;">
                                        <div class="row" style="align-items: flex-end;">
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
                                        <div class="form-row">
                                            <div class="form-group col-lg-2">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">คำนำหน้า</font><font size="3" color="red"></font></label>
                                                <input name="prefix" id="prefix" type="text" class="form-control savejson autotext" autocomplete="off">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อ</font><font size="3" color="red">*</font></label>
                                                <input name="firstname" type="text" class="form-control" id="first_name" required>
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อสกุล</font><font size="3" color="red">*</font></label>
                                                <input name="lastname" type="text" class="form-control" id="last_name" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-3">
                                                <label for="inputEmail4" class="col-form-label"><font size="2">เพศ</font><font color="red">*</font></label>
                                                <select class='form-control' name="gender" required>
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
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
                        <input name="useropen"  type="hidden" value="{{ Auth::id() }}">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label><font size="2">นัดหมาย</font></label>
                                        <input name="meet_date" type="text" class="form-control" readonly id="date_appoint" autocomplete="off">
                                    </div>

                                    <div class="form-group col-4">
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
                                    <div class="form-group col-4">
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
                                    @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <div class="form-group col-6">
                                        <label><font size="2">Procedure</font></label>
                                        {{-- <input type="text" name="case_procedure" class="form-control" id="case_procedure"> --}}
                                        <select class="form-control select2 w-100" id="kt_select2_11" multiple name="procedure[]" required>
                                            @foreach ($tb_procedure as $data)
                                                <option value="{{$data->procedure_name}}">{{$data->procedure_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
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
                                    <div class="form-group col-md-12"><label><font size="2">Pre-diagnosis</font></label>
                                        <input id="prediagnosis" name="prediagnosis" class="form-control savejson autotext" type="text" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12"><label><font size="2">หมายเหตุ</font></label>
                                        <textarea name="remark" id="" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>





            <div class="card-footer">
                <div class="row w-100 m-0">
                    {{-- <div class="col-lg-6" id="pt_status" status="1">
                        <div class="alert alert-custom alert-light-danger fade show" role="alert" id="pt_none">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-text">ยังไม่ได้สร้างผู้ป่วย</div>
                        </div>
                        <div class="alert alert-custom alert-light-success fade hide" role="alert" id="pt_success">
                            <div class="alert-icon"><i class="fas fa-check"></i></div>
                            <div class="alert-text">สร้างผู้ป่วย</div>
                        </div>
                    </div>
                    <div class="col-lg-6" id="pcd_status" status="1">
                        <div class="alert alert-custom alert-light-danger fade show" role="alert" id="pcd_none">
                            <div class="alert-icon"><i class="fas fa-info-circle"></i></div>
                            <div class="alert-text">ยังไม่ได้สร้าง Procedure</div>
                        </div>
                        <div class="alert alert-custom alert-light-success fade hide" role="alert" id="pcd_success">
                            <div class="alert-icon"><i class="fas fa-check"></i></div>
                            <div class="alert-text">สร้าง Procedure</div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-success w-100">ยืนยันการเพิ่ม</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    </div>
</div>
@endsection

@section('content')
@php
    function gen_month($m){
        if($m==1){
            return "January";
        }
        elseif($m==2){
            return "February";
        }
        elseif($m==3){
            return "March";
        }
        elseif($m==4){
            return "April";
        }
        elseif($m==5){
            return "May";
        }
        elseif($m==6){
            return "June";
        }
        elseif($m==7){
            return "July";
        }
        elseif($m==8){
            return "August";
        }
        elseif($m==9){
            return "September";
        }
        elseif($m==10){
            return "October";
        }
        elseif($m==11){
            return "November";
        }
        elseif($m==12){
            return "December";
        }
    }
@endphp
<div class="row m-0">
    <div class="col-lg-9">
        <div class="card card-custom h-100">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row m-0" id="menu_header_select">
                            <div class="col-lg-5">
                                <select name="" id="change_month" class="form-control form-control-sm">
                                    @for($i=1;$i<=12;$i++)
                                        <option value="{{$i}}" @if($i==date('m')) selected @endif>{{gen_month($i)}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select name="" id="change_year" class="form-control form-control-sm">
                                    @for($i=0;$i<=3;$i++)
                                        <option value="{{date('Y')-$i}}" @if((date('Y')-$i)==date('Y')) selected @endif)>{{date('Y')-$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div id="kt_calendar"></div>

                        {{-- <div class="row m-0">
                            <div class="col-lg-3">
                                <select name="" id="change_month" class="form-control form-control-sm">
                                    @for($i=1;$i<=12;$i++)
                                        <option value="{{$i}}" @if($i==date('m')) selected @endif>{{gen_month($i)}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <select name="" id="change_year" class="form-control form-control-sm">
                                    @for($i=0;$i<=3;$i++)
                                        <option value="{{date('Y')-$i}}" @if((date('Y')-$i)==date('Y')) selected @endif)>{{date('Y')-$i}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-3">
                                <ul class="nav nav-pills nav-info" id="myTab1" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active rounded-0" id="home-tab-1" data-toggle="tab" href="#home-1">
                                            <span class="nav-text">Calendar</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link rounded-0" id="profile-tab-1" data-toggle="tab" href="#profile-1" aria-controls="profile">
                                            <span class="nav-text">List</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                        {{-- <div class="tab-content mt-5" id="myTabContent1">
                            <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
                                <div id="kt_calendar"></div>
                            </div>
                            <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr class="border-top border-bottom">
                                            <td colspan="5">Tue, 7 Dec 2021</td>
                                        </tr>
                                        @for($i=1;$i<=7;$i++)
                                        <tr>
                                            <td>Appointment System case</td>
                                            <td><i class='fas fa-circle text-warning'></i> Endoscopy</td>
                                            <td>นพ.สดายุทอง ทองลอย</td>
                                            <td>EGD and Colono</td>
                                            <td><i class="fas fa-edit"></i></td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                    @for($i=8;$i<=10;$i++)
                                    <tbody>
                                        <tr colspan="5" class="border-top border-bottom">
                                            <td>Wed, {{$i}} Dec 2021</td>
                                        </tr>
                                        <tr>
                                            <td>ลา</td>
                                            <td><i class='fas fa-circle text-danger'></i> ลาหยุด</td>
                                            <td>นพ.สดายุทอง ทองลอย</td>
                                            <td></td>
                                            <td><i class="fas fa-edit"></i></td>
                                        </tr>
                                    </tbody>
                                    @endfor
                                    <tbody>
                                        <tr colspan="5" class="border-top border-bottom">
                                            <td>Sat, 11 Dec 2021</td>
                                        </tr>
                                        @for($i=1;$i<=7;$i++)
                                        <tr>
                                            <td>Appointment System case</td>
                                            <td><i class='fas fa-circle text-warning'></i> Endoscopy</td>
                                            <td>นพ.สดายุทอง ทองลอย</td>
                                            <td>EGD and Colono</td>
                                            <td><i class="fas fa-edit"></i></td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 m-0 p-0">
        <div class="row m-0 h-100">
            <div class="col-lg-12 p-0">

                    <div class="card-header p-3">
                        <div class="row m-0 ct border-bottom pb-3">
                            <div class="col-lg-6"><h4 class="m-0">Filter</h4></div>
                            <div class="col-lg-6 text-right"><a href="{{url('book')}}" class="btn btn-secondary btn-sm"><i class='flaticon2-cancel icon-nm'></i>Clear</a></div>
                        </div>

                    <form action="{{url('booknew')}}" method="get" class="card-body p-1 pt-4 pb-4">
                        <div class="row m-0 ct">
                            <div class="col-lg-12">
                                <select class="form-control selectpicker" data-size="7" id="s_book_doctor" name="s_book_doctor" data-live-search="true">
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
                            </div>
                        </div>
                        <div class="row m-0 mt-3 ct">
                            <div class="col-lg-12">
                                <select name="" class="form-control selectpicker" id="select_topic">
                                    <option value="-" data-content="<i class='fas fa-circle text-light'></i>&emsp; Select Topic">Select topic</option>
                                    <option @if(@$_GET['topic']=='Endoscopy') selected @endif value="Endoscopy" data-content="<i class='fas fa-circle text-warning'></i>&emsp; Endoscopy">Endoscopy</option>
                                    <option @if(@$_GET['topic']=='OPD') selected @endif value="OPD" data-content="<i class='fas fa-circle text-primary'></i>&emsp; OPD">OPD</option>
                                    <option @if(@$_GET['topic']=='ประชุม') selected @endif value="ประชุม" data-content="<i class='fas fa-circle text-yellow'></i>&emsp; ประชุม">ประชุม</option>
                                    <option @if(@$_GET['topic']=='ลาหยุด') selected @endif value="ลาหยุด" data-content="<i class='fas fa-circle text-danger'></i>&emsp; ลาหยุด">ลาหยุด</option>
                                    <option @if(@$_GET['topic']=='อื่นๆ') selected @endif value="อื่นๆ" data-content="<i class='fas fa-circle text-success'></i>&emsp; อื่นๆ">อื่นๆ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    </form>

                    <!-- <div class="card">

                    <button class="btn btn-primary btn-lg" type="botton" data-toggle="modal" data-target="#create_case">Create Case Capture</button>

                    </div> -->


                    <div class="card" style="display:none">
                    <form action="{{url('booknew')}}" method="POST" class="card-body p-0 pt-5">
                        @csrf
                        <input name="event" value="job_create" type="hidden">
                        <div class="row m-0 ct border-bottom pb-3">
                            <div class="col-8 h4">Book Detail</div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-sm w-100"><i class='flaticon2-plus icon-nm' icon></i>Book</button>
                            </div>
                        </div>
                        <div class="row m-0 mt-3">
                            <div class="col-lg-12">
                                <input name="book_title" class="form-control autotext savejson" id="title_book"
                                        placeholder="Title" type="text" autocomplete="off"
                                        value="{{ @$json->title_book }}" />
                            </div>
                        </div>
                        <div class="row m-0 ct mt-3">
                        <div class="col-lg-12">
                                <select name="book_topic" class="form-control selectpicker" id="myselect" onchange="callmodal(this.value)">
                                    <option value="-" data-content="<i class='fas fa-circle text-light'></i>&emsp; Select Topic">Select topic</option>
                                    <option value="Endoscopy" data-content="<i class='fas fa-circle text-warning'></i>&emsp; Endoscopy">Endoscopy</option>
                                    <option value="OPD" data-content="<i class='fas fa-circle text-primary'></i>&emsp; OPD">OPD</option>
                                    <option value="ประชุม" data-content="<i class='fas fa-circle text-yellow'></i>&emsp; ประชุม">ประชุม</option>
                                    <option value="ลาหยุด" data-content="<i class='fas fa-circle text-danger'></i>&emsp; ลาหยุด">ลาหยุด</option>
                                    <option value="อื่นๆ" data-content="<i class='fas fa-circle text-success'></i>&emsp; อื่นๆ">อื่นๆ</option>
                                </select>
                            </div>
                        </div>

                        <div class="row m-0 mt-3 ct">

                            <div class="col-lg-12">
                                <select class="form-control selectpicker" data-size="7" id="insert_dc" name="book_doctor" data-live-search="true" required>
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
                            </div>
                        </div>

                        <div class="row m-0 mt-3 ct">
                            <div class="col-lg-12">
                                <input
                                type            = "text"
                                name            = "book_date_start"
                                id              = "book_date_start"
                                class           = "form-control form-control-sm"
                                autocomplete    = "off"
                                placeholder     = "Start Date"
                                required
                                ></div>
                            <div class="col-lg-12 mt-3">
                                <input
                                type            ="text"
                                name            ="book_date_end"
                                id              ="book_date_end"
                                class           ="form-control form-control-sm"
                                autocomplete    ="off"
                                placeholder     = "End Date"
                            ></div>
                        </div>

                        <div class="row m-0 mt-3">
                            <div class="col-lg-12">
                                <textarea name="book_comment" rows="10" placeholder="Note" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                        <div class="row m-0 mt-3">
                            <div class="col-lg-8"></div>
                            <div class="col-lg-4">
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

{{--
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{asset('public/js/book/jquery.datetimepicker.js')}}"></script>
--}}




<script>
    function click_next(){
        $(".datepicker-days table thead tr .next,.datepicker-days .prev").click(function(){
            var check_month = $('.datepicker-days .datepicker-switch').text()
            // alert(check_month)
        })
    }

    $("#kt_datepicker_1_modal").click(function(){
    var check_month = $('.datepicker-days .datepicker-switch').text()
    setTimeout(click_next, 1000);
    // alert(check_month)
        $('.datepicker-days td:contains("16")').css('background','red')
    })
function callmodal(data){
    if(data=='Endoscopy'){
        $('#create_case').modal("show");
    }
}


$("#book_date_start").focusout(function(){
    console.log($("#book_date_start").val())
    if($("#book_date_end").val()==''){
        $("#book_date_end").val($(this).val())
    }
})

$('#create_case').on('hidden.bs.modal', function () {
  $("#myselect").val('-').change()
})
</script>



<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


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



    $('#modal_book_date_start,#modal_book_date_end').datetimepicker({
        timePicker: true,
        timePickerIncrement: 30,
        formatTime:'H:i',
        locale: {
            format: 'YYYY-MM-DD h:mm A'
        }
    });
    $("#book_date_start,#book_date_end").datetimepicker({
        datepicker:true,
        format:'Y-m-d H:i'
    });

    $('#kt_datepicker_1_modal,#book_date_start,#book_date_end').datetimepicker({

        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        templates: arrows,
        dateFormat: 'dd-mm-yy',
    });


    $(".card-scroll").hide();
    function date_select(){
        $(".fc-event-container").click(function(){
            $("#isday").modal('toggle')
        })
        $(".fc-day-top").click(function(){
            alert()
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var calendar_date = $(this).attr('data-date')+' '+time;
            $('#kt_daterangepicker_4 .form-control').val( '['+calendar_date + '],[' + calendar_date+']');
            $('#date_start').val(calendar_date);
            $('#date_end').val(calendar_date);
            $("#insert_dc").val('').change();
            $("#insert_procedure").val('').change();
            $("#insert_room").val('').change();
            $("#insert_comment").val();
            $("#date_start").val(calendar_date);
            $("#date_end").val(calendar_date);
            $("#btn_submit").val('insert').text('Create').attr('class','btn btn-primary');
        });
    }
    $("#search_doctor, #search_procedure, #search_room").change(function(){
        var doctor_val = $('#search_doctor').val();
        var procedure_val = $('#search_procedure').val();
        var room_val = $('#search_room').val();
        $.post('{{url('jquery')}}',{
            event           : 'search_calendar',
            doctor_val      : doctor_val,
            procedure_val   : procedure_val,
            room_val        : room_val,
            },function(data,status){
                var show_data = JSON.parse(data);
                var fruits = [];
                show_data.forEach(show_event);
                function show_event(item, index) {
                    event_is={'title':item.bookdoctor_name,
                    'start':item.ap_date_start,
                    'end:':item.ap_date_end,
                    'description':item.ap_id,
                    'appointment_id' : item.ap_id,
                    'className':"fc-event"+item.bookroom_id,
                    };
                    fruits.push(event_is);
                }
                calendar(fruits);
                date_select();
                save_point();
            });
    });

    $("#show_doctor_list").click(function(){
        start_page();
        $('#search_doctor').val('').change();
        $('#search_procedure').val('').change();
        $('#search_room').val('').change();

        $('#kt_daterangepicker_4 .form-control').val('');
            $('#date_start').val();
            $('#date_end').val();
            $("#insert_dc").val('').change();
            $("#insert_procedure").val('').change();
            $("#insert_room").val('').change();
            $("#insert_comment").val();
            $("#date_start").val();
            $("#date_end").val();
            $("#btn_submit").val('insert').text('Create').attr('class','btn btn-primary');
        save_point();
    });

            // $(document).ready(function(){ //Make script DOM ready
            //     $('#myselect').change(function() { //jQuery Change Function
            //         var title = $(this).val(); //Get value from select element
            //         if(title=="Endoscopy"){ //Compare it and if true
            //             $('#create_case').modal("show"); //Open Modal
            //         }
            //     });
            // });
</script>


<script>
    var KTCalendarBasic = function() {

    return {
        //main function to initiate the module
        init: function(m,y,datax) {
            var todayDate = moment().startOf('day');
            var YM = y+'-'+m;
            var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
            var TODAY = y+'-'+m+'-'+(todayDate.format('DD'));
            var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
            console.log('TODAY'+TODAY)
            var calendarEl = document.getElementById('kt_calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                themeSystem: 'bootstrap',

                isRTL: KTUtil.isRTL(),

                header: {

                    right: 'dayGridMonth,listWeek'
                },

                height: 800,
                contentHeight: 780,
                aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                nowIndicator: true,
                now: TODAY, // just for demo

                views: {
                    dayGridMonth: { buttonText: 'month' },
                    timeGridWeek: { buttonText: 'week' },
                    timeGridDay: { buttonText: 'day' }
                },

                dateClick: function(info) {
                    console.log(info.dateStr)
                    $('#create_case').modal("show");
                    $('#date_appoint').val(info.dateStr);
                    // $('#book_date_start').val(info.dateStr+' 00:00').change();
                    // $('#book_date_end').val(info.dateStr+' 00:00').change();
                },

                defaultView: 'dayGridMonth',
                defaultDate: TODAY,
                editable: true,
                eventLimit: true,
                navLinks: true,
                events: [


                    @foreach ($job_capture as $key=>$val)
                    {
                        id          : '{{$val['book_id']}}',
                        title       : '{{$val['book_title']}}',
                        start       : "{{$val['book_date_start']}}",
                        description : "{{$val['book_comment']}}",
                        className   :
                        @if ($val['book_topic'] == 'endoscopy')
                            "fc-event-solid-warning"
                        @elseif ($val['book_topic'] == 'OPD')
                            "fc-event-solid-text-primary"
                        @elseif ($val['book_topic'] == 'ประชุม')
                            "fc-event-solid-text-yellow"
                        @elseif ($val['book_topic'] == 'ลาหยุด')
                            "fc-event-solid-danger"
                        @else
                            "fc-event-solid-success"
                        @endif
                        ,
                        groupId     : '{{$val['book_topic']}}',
                    },
                    @endforeach

                ],
                eventClick: function(event) {
                    if (event.event.groupId=="endoscopy"){
                        get_jobcapture(event.event.id);
                    }else{
                        get_doctorevent(event.event.id);
                    }
                    // if (event.event.groupId=="doctorevent") {get_doctorevent(event.event.id);}
                },


                eventRender: function(info) {
                    var element = $(info.el);
                    if (info.event.extendedProps && info.event.extendedProps.description) {
                        if (element.hasClass('fc-day-grid-event')) {
                            element.data('content', info.event.extendedProps.description);
                            element.data('placement', 'top');
                            KTApp.initPopover(element);
                        } else if (element.hasClass('fc-time-grid-event')) {
                            element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        } else if (element.find('.fc-list-item-title').lenght !== 0) {
                            element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                        }
                    }
                }



            });

            calendar.render();
        }
    };
    }();

    jQuery(document).ready(function() {
        KTCalendarBasic.init("{{date('m')}}","{{date('Y')}}",'none');
    });



    function get_jobcapture(date){
        $.post('{{url('book')}}',{
            event       : 'get_jobcapture',
            date        : date,
        },function(data,status){
            $('#table_capture').html('');
            var show_data   = jQuery.parseJSON( data );
            var book        = show_data.book;
            var txt         = '';
            txt += '<tr>';
            txt += '<td>Doctor</td>';
            txt += '<td>Procedure</td>';
            txt += '<td>Date</td>';
            txt += '</tr>';
            $.each( book, function( key, value ) {
                txt += '<tr>';
                txt += '<td>'+book[key]['book_doctor']+'</td>';
                txt += '<td>'+book[key]['book_procedure']+'</td>';
                txt += '<td>'+book[key]['book_date_start']+'</td>';
                txt += '</tr>';
            });
            $('#table_capture').html(txt);
            $('#modal_capture').modal('show');
        });
    }



    function get_doctorevent(id){
        var val         = {};
        val['event']    = 'get_doctorevent';
        val['id']       = id;
        $.post('{{url('book')}}',jsonSTR(val),function(d,s){set_modaldoctorevent(d,s)});
    }

    function set_modaldoctorevent(data,status){
        var show_data               = jQuery.parseJSON(data);
        var book                    = show_data.book;
        $('#modal_book_id')         .val(book.book_id);
        $('#modal_book_topic')      .val(book.book_topic);
        $('#modal_book_title')      .val(book.book_title);
        $('#modal_book_comment')    .val(book.book_comment);
        $('#modal_book_date_start') .val(book.book_date_start);
        $('#modal_book_date_end')   .val(book.book_date_end);
        $('#modal_eventdetail')     .modal('show');
    }

    function jsonSTR(arr){
        text    = JSON.stringify(arr);
        json    = JSON.parse(text);
        return json;
    }


</script>

<script>
    $("#birthyear,#birthmonth,#birthday").on('keyup keypress blur change focusout',function(e){
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
        if($(this).val() >120){$(this).val(120);}
        var date   = {{date('Y')}}+543;
        var year   = date-$(this).val();
        $("#birthyear").val(year);
    });


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

    $("#btn_no_hn").click(function(){
        $("#hn").val('');
        $("#prefix").val('');
        $("#first_name").val('');
        $("#last_name").val('');
        $("select[name=gender]").val(1).change();
        $("#birthday").val('01').change();
        $("#birthmonth").val('01').change();
        $("#birthyear").val('2564').change();
        $("#agenew").val(null);
    })
    $("#btn_yes_hn").click(function(){
        $("#last_name").change()
    })
    $("#test_pt").click(function(){
        var this_age= Math.floor(Math.random() * 60);
        var m = new Date();
        var dateString = m.getUTCFullYear() +""+ ("0"+(m.getUTCMonth()+1)).slice(-2) +""+ ("0"+m.getUTCDate()).slice(-2);
        if($(this).prop("checked") == true){
            // $(".s"+id).addClass('active')
            $("#hn").val('TEST'+dateString);
            $("#hn").focusout()
            if($("#first_name").val()!='test'){
                $("#prefix").val('นาย')
                $("#first_name").val('test')
                $("#last_name").val('test')
                $("#agenew").val(this_age)
                $("[name='gender']").val(1).change()
                $("#agenew").keyup()
            }
        }
        else if($(this).prop("checked") == false){
        }
    })



    $("#hn, #first_name, #last_name, #agenew").on('change keyup',function(){
        checkdata_patient()
    })
    $("#kt_select2_11, #case_physicians01").on('change keyup',function(){
        checkdata_procedure()
    })
    function checkdata_patient(){
        var hn = $("#hn").val().length
        var first_name = $("#first_name").val().length
        var last_name = $("#last_name").val().length
        var agenew = $("#agenew").val().length
        var pt_status = $("#pt_status").attr('status');

        if((hn>0) && (first_name>0) && (last_name>0) && (agenew>0)){
            if(pt_status==1){
                $("#pt_none").removeClass('show')
                $("#pt_none").addClass('hide')
                $("#pt_success").removeClass('hide')
                $("#pt_success").addClass('show')
            }
            $("#pt_status").attr('status',2)
        }else{
            if(pt_status==2){
                $("#pt_none").removeClass('hide')
                $("#pt_none").addClass('show')
                $("#pt_success").removeClass('show')
                $("#pt_success").addClass('hide')
            }
            $("#pt_status").attr('status',1)
        }
    }

    function checkdata_procedure(){
        // $('#first :selected').text();
        var case_procedure = $("#kt_select2_11:selected").text()
        console.log(case_procedure);
        // var case_physicians01 = $("#case_physicians01").val()
        var pcd_status = $("#pcd_status").attr('status');
        if(case_procedure>0){
            if(pcd_status==1){
                $("#pcd_none").removeClass('show')
                $("#pcd_none").addClass('hide')
                $("#pcd_success").removeClass('hide')
                $("#pcd_success").addClass('show')
            }
            $("#pcd_status").attr('status',2)
        }else{
            if(pcd_status==2){
                $("#pcd_none").removeClass('hide')
                $("#pcd_none").addClass('show')
                $("#pcd_success").removeClass('show')
                $("#pcd_success").addClass('hide')
            }
            $("#pcd_status").attr('status',1)
        }
    }



    $("#datepicker").datepicker({format: 'yyyy-mm-dd'});
    $("#datepicker").on("change", function(){var fromdate = $(this).val();});
</script>

<script>
    $("#change_month,#change_year").change(function(){
        $("#kt_calendar").html('');
        var num = '';
        if($("#change_month").val()<10){
            num = '0';
        }
        var month = num+$("#change_month").val()
        var year = $("#change_year").val()
        setTimeout(function(){
            KTCalendarBasic.init(month,year);
         }, 500);
    })


    $("#s_book_doctor").change(function(){
        var this_val = $("#s_book_doctor").val()
        var this_topic = $("#select_topic").val()
        window.location.href = "{{url('')}}/book?doctor="+this_val+"&topic="+this_topic;
    })
    $("#select_topic").change(function(){
        var this_val = $("#s_book_doctor").val()
        var this_topic = $("#select_topic").val()
        window.location.href = "{{url('')}}/book?doctor="+this_val+"&topic="+this_topic;
    })


    // $(".day").indexOf(6).css('background','red')
</script>


    <script>

    $("#readcitizencard").click(function(){
        $('#modal_progress').modal('show');
        $.get('http://localhost/Appointment System5.0/api/readcitizencard',{},function(data,status){
            $('#modal_progress').modal('hide');

            var res = JSON.parse(data);
            console.log(res);

            $("#prefix").val(res.prefix)
            $("#first_name").val(res.firstname)
            $("#last_name").val(res.lastname)

            $("#citizen").val(res.cid)
            if(res.gender=="ชาย"){
                $("[name='gender']").val(1).change()
            }else{
                $("[name='gender']").val(2).change()
            }

            $("#birthday").val(res.day).change();
            $("#birthmonth").val(res.month).change();
            $("#birthyear").val(res.year).change();

            setTimeout(() => {
                $("#agenew").val(res.age);
            }, 1000);
        });
    });

    </script>












@php
    /*
<script>
    var KTBootstrapDaterangepicker = function () {

// Private functions
var demos = function () {
 // minimum setup
 $('#kt_daterangepicker_1, #kt_daterangepicker_1_modal').daterangepicker({
  buttonClasses: ' btn',
  applyClass: 'btn-primary',
  cancelClass: 'btn-secondary'
 });

 // input group and left alignment setup
 $('#kt_daterangepicker_2').daterangepicker({
  buttonClasses: ' btn',
  applyClass: 'btn-primary',
  cancelClass: 'btn-secondary'
 }, function(start, end, label) {
  $('#kt_daterangepicker_2 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
 });

 $('#kt_daterangepicker_2_modal').daterangepicker({
  buttonClasses: ' btn',
  applyClass: 'btn-primary',
  cancelClass: 'btn-secondary'
 }, function(start, end, label) {
  $('#kt_daterangepicker_2 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
 });

 // left alignment setup
 $('#kt_daterangepicker_3').daterangepicker({
  buttonClasses: ' btn',
  applyClass: 'btn-primary',
  cancelClass: 'btn-secondary'
 }, function(start, end, label) {
  $('#kt_daterangepicker_3 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
 });

 $('#kt_daterangepicker_3_modal').daterangepicker({
  buttonClasses: ' btn',
  applyClass: 'btn-primary',
  cancelClass: 'btn-secondary'
 }, function(start, end, label) {
  $('#kt_daterangepicker_3 .form-control').val( start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
 });


 // date & time
 $('#kt_daterangepicker_4').daterangepicker({
  buttonClasses: ' btn',
  applyClass: 'btn-primary',
  cancelClass: 'btn-secondary',

  timePicker: true,
  timePickerIncrement: 30,
  locale: {
   format: 'MM/DD/YYYY h:mm A'
  }
 }, function(start, end, label) {
  $('#kt_daterangepicker_4 .form-control').val( start.format('MM/DD/YYYY h:mm A') + ' / ' + end.format('MM/DD/YYYY h:mm A'));
 });

 // date picker
 $('#kt_daterangepicker_5').daterangepicker({
  buttonClasses: ' btn',
  applyClass: 'btn-primary',
  cancelClass: 'btn-secondary',

  singleDatePicker: true,
  showDropdowns: true,
  locale: {
   format: 'MM/DD/YYYY'
  }
 }, function(start, end, label) {
  $('#kt_daterangepicker_5 .form-control').val( start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
 });

 // predefined ranges
 var start = moment().subtract(29, 'days');
 var end = moment();

 $('#kt_daterangepicker_6').daterangepicker({
  buttonClasses: ' btn',
  applyClass: 'btn-primary',
  cancelClass: 'btn-secondary',

  startDate: start,
  endDate: end,
  ranges: {
  'Today': [moment(), moment()],
  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
  'Last 30 Days': [moment().subtract(29, 'days'), moment()],
  'This Month': [moment().startOf('month'), moment().endOf('month')],
  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }
 }, function(start, end, label) {
  $('#kt_daterangepicker_6 .form-control').val( start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
 });
}

return {
 // public functions
 init: function() {
  demos();
 }
};
}();

jQuery(document).ready(function() {
KTBootstrapDaterangepicker.init();
});
</script>






    */

@endphp


@endsection
