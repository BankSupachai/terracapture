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
    .box-data2{
        width: 1em;
        height: 1em;
        background-color: rgb(235, 222, 240);
    }
    .rt{
        float: right;
    }
    .aln{
        align-items: flex-end;
    }
    #kt_select2_11 span,.select2-container{width: 100% !important;}
    .datepicker tbody tr > td.day.today{
        background: #c0c0c0 !important;
        color: #ffffff !important;
    }
    .test{}
    .menu_form{
        display: none;
    }
    .menu_form.active{
        display: block;
    }
    .jc{
        justify-content: center;
    }
    .btn-book-submit{
        background: #9DA8CB;
        padding: 0.7em;
        color: #fff;
        font-size: large;
        width: 60%;
    }
    .btn-book-submit:hover{
        background: #7781a1;
        color: #fff;
    }
    .text-vio{
        background: #9da8cb7c;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        padding: 0.3rem 1rem;
    }
    .bs-placeholder{
        padding: 0.5em !important;
    }
    .hide-arrow::-ms-expand{
        display: none !important;
    }
    .jcn{
        justify-content: center;
    }
    .tab-printer{
        position: relative;
    }
    .tab-printer button{
        top: 0;
        position: absolute;
        left: 0.5em;
    }
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
                        <button type="button" class="btn btn-primary w-100" id="use_hn">ยืนยัน</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="showprint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <center><h1>เลือกแผนก</h1></center>
                    </div>
                    <div class="col-12">
                        <button
                        class="btn btn-text-dark btn-hover-light-dark font-weight-bold"
                        onclick="print_t('GIS')"
                        ><i class="fas fa-print"></i></button>
                        แผนกศัลยกรรม
                    </div>
                    <div class="col-8"></div>

                    <div class="col-12">
                        <button
                        class="btn btn-text-dark btn-hover-light-dark font-weight-bold"
                        onclick="print_t('GIP')"
                        ><i class="fas fa-print"></i></button>
                        แผนกศัลยกรรมเด็ก
                    </div>



                    <div class="col-12">
                        <button
                        class="btn btn-text-dark btn-hover-light-dark font-weight-bold"
                        onclick="print_t('GI')"
                        ><i class="fas fa-print"></i></button>
                        แผนกอายุรกรรม
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('content')

<div class="row m-0">

    <div class="col-12" style="display: none" >
        <input id="temp_doctor"   value="0"><br>
        <input id="temp_date"     value="{{date('Y-m-d')}}"><br>
        <input id="temp_month"    value=""><br>
    </div>


    <div class="col-lg-3">
        <div class="card">
            <div class="card-body p-0">
                <div class="row m-0">
                    {{-- <div class="col-12 mt-3 pb-3">
                        <select class="form-control form-control-lg selectpicker" id="seach_doctor" data-size="7" data-live-search="true">
                            <option value="0">All physician calendar</option>
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
                        </select>
                    </div> --}}
                </div>
                <div class id="kt_datepicker_6"></div>

                <div class="row m-0">
                    <div class="col-lg-12 pb-3">
                        <div class="row m-0 mt-5 rt">
                            <span class="box-data bg-info" style="display: none">&nbsp; Available &emsp;</span>
                            <span class="box-data2"></span> &nbsp; Booked
                            &emsp;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-9">
        <div class="card">
            <div class="card-body p-0">
                <div class="row m-0">
                    <div class="col-lg-11 h3 m-0 header-list">
                        <div class="row m-0">
                            <div class="col-lg-6 p-0" id="header_date">{{$header_date}}</div>
                            <div class="col-lg-6 p-0 text-right" style="display: none">Available &emsp; 7 / 10</div>
                        </div>

                    </div>
                    <div id="addjob" class="col-lg-1 text-center header-list add">
                        <i class="fas fa-plus text-dark icon-2x"></i>
                    </div>
                </div>

                <div class="row panel" style="display: none">
                    <div class="col-12" >
                        <div class="tab-pane fade show active" id="home-4" role="tabpanel" aria-labelledby="home-tab-4">
                            {{--  --}}
                            <div class="row m-0 p-2 pt-4 pb-4" style="display: none">
                                <div class="col"></div>
                                <div class="col-3">
                                    <label class="radio radio-outline radio-info">
                                        <input type="radio" checked name="radios15" class="open-form" id="ck_endoscopy"/>
                                        <span></span>
                                        &nbsp; Endoscopy
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="radio radio-outline radio-info">
                                        <input type="radio" name="radios15" class="open-form" id="ck_leave"/>
                                        <span></span>
                                        &nbsp; Leave
                                    </label>
                                </div>
                                <div class="col-3">
                                    <label class="radio radio-outline radio-info">
                                        <input type="radio" name="radios15" class="open-form" id="ck_other"/>
                                        <span></span>
                                        &nbsp; Other
                                    </label>
                                </div>
                                <div class="col"></div>
                            </div>
                            <form action="{{url('book')}}" method="post" class="menu_form mt-2 pl-2 pr-2 active" id="form_ck_endoscopy">
                                @csrf
                                <input id="event_endoscopy" name="event" type="hidden" value="endoscopy_create">
                                <input type="hidden" name="book_topic" value="endoscopy">
                                <input id="book_id_edit"    name="book_id_edit" type="hidden" value="">

                                    <div class="row m-0 aln">
                                        <div class="col-lg p-2">
                                            <div class="form-group m-0">
                                                <label for="inputEmail4" class="col-form-label">
                                                    <font size="2">HN</font>
                                                </label>
                                                <input id="hn" name="hn" type="text" class="form-control form-control-sm" value="{{@$patient->hn}}"
                                                oninvalid="this.setCustomValidity('คุณลืมกรอก HN')"
                                                oninput="setCustomValidity('')"
                                                placeholder="H.N." required onpaste="return false" autocomplete="off">
                                                <div id="show_lang_in_here"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg p-2">
                                            <label for="inputPassword4" class="col-form-label"><font size="2">เลขบัตรประชาชน</font><font size="3" color="red"></font></label>
                                            <input name="idcard" id="idcard" type="text" class="form-control form-control-sm savejson autotext " autocomplete="off">
                                        </div>
                                        <div class="col-lg-2 p-2">
                                            <label for="inputPassword4" class="col-form-label"><font size="2">คำนำหน้า</font><font size="3" color="red"></font></label>
                                            <input name="prefix" id="prefix" type="text" class="form-control form-control-sm savejson autotext" autocomplete="off">
                                        </div>
                                        <div class="col-lg p-2">
                                            <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อ</font><font size="3" color="red">*</font></label>
                                            <input name="firstname" type="text" class="form-control form-control-sm" id="first_name" required>
                                        </div>
                                        <div class="col-lg p-2">
                                            <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อสกุล</font><font size="3" color="red">*</font></label>
                                            <input name="lastname" type="text" class="form-control form-control-sm" id="last_name" required>
                                        </div>
                                    </div>

                                    <div class="row m-0 mt-3 pb-5 border-bottom">
                                        <div class="col-lg-6">
                                            <label for='inputdate' class='col-form-label'><font size="2">วัน/เดือน/ปี เกิด</font></label>
                                            <div class="row" id="set_date">
                                                <div class="col-lg p-2">
                                                    <select class='form-control form-control-sm' name='birthday' id="birthday">
                                                        @foreach($day_all as $day)
                                                            <option value="{{$day}}">{{$day}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg p-2">
                                                    <select class='form-control form-control-sm' name='birthmonth' id="birthmonth">

                                                        @foreach($month_all as $month)
                                                            <option value="{{$month}}">{{$month}}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                                <div class="col-lg p-2">
                                                    <select class='form-control form-control-sm' name='birthyear' id="birthyear">
                                                        @foreach ($year_all as $data)
                                                            <option value="{{$data}}">{{$data}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg p-2">
                                            <label for='agenew' class='col-form-label'><font size="2">อายุ</font></label>
                                            <input name="age" type="number" id="agenew" class="form-control form-control-sm" value="{{@$age}}" placeholder="อายุ" required>
                                        </div>
                                        <div class="col-lg p-2">
                                            <label for="inputEmail4" class="col-form-label"><font size="2">เพศ</font><font color="red">*</font></label>
                                            <select class='form-control form-control-sm' name="gender" id="gender" required>
                                                <option value="" selected disabled hidden>Select</option>

                                                @forelse($gender as $l)
                                                    <option value='{{ $l->gender_id }}'  @if($l->gender_id==@$patient->gender) selected @endif>{{ $l->gender_name }}</option>
                                                @empty
                                                    <option>ไม่มีข้อมูล</option>
                                                @endforelse

                                            </select>
                                        </div>
                                        <div class="col-lg p-2">
                                            <label for="inputPassword4" class="col-form-label"><font size="2">โทรศัพท์</font></label>
                                            <input name="phone" type="text" class="form-control form-control-sm" id="phone">
                                        </div>

                                    </div>

                                        <input name="useropen"  type="hidden" value="{{ Auth::id() }}">

                                    <div class="row m-0 mt-3">
                                        <div class="col-lg-2 p-2">
                                            <label><font size="2">นัดหมาย</font></label>
                                            <input name="meet_date" type="text" class="form-control form-control-sm" value="{{date('Y-m-d')}}" id="date_appoint" autocomplete="off">
                                        </div>
                                        <div class="col-lg-1 p-2">
                                            <label><font size="2">ชั่วโมง</font></label>
                                            <select id='meet_hour' name='meet_hour' class='form-control form-control-sm text ' style='width:100%; appearance: none;' >
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
                                        <div class="col-lg-1 p-2">
                                            <label><font size="2">นาที</font></label>
                                            <select name='meet_minute' class='form-control form-control-sm text' style='width:100%; appearance: none;' id='meet_minute'>
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
                                        <div class="col-lg-3 p-2">
                                            <label><font size="2">Physician</font></label>
                                            <select id="s_book_doctor" class="form-control selectpicker" data-size="7" name="s_book_doctor" data-live-search="true" required>


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
                                        <div class="col-lg p-2">
                                            <label><font size="2">Procedure</font></label>
                                            {{-- <input type="text" name="case_procedure" class="form-control" id="case_procedure"> --}}
                                            <select class="form-control form-control-sm select2 w-100" id="kt_select2_11" multiple name="procedure[]" required>

                                                @foreach ($tb_procedure as $data)
                                                    <option value="{{$data->procedure_name}}">{{$data->procedure_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row m-0 mt-3" style="display: none">
                                        <div class="col-lg-1 text-center">
                                            <label for="">Admit</label>
                                            <label class="checkbox mt-3 jc checkbox-info">
                                                <input type="checkbox" name="Checkboxes1"/>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-1 text-center">
                                            <label for="">Anes.</label>
                                            <label class="checkbox mt-3 jc checkbox-info">
                                                <input type="checkbox" name="Checkboxes1"/>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-lg-1 text-center">
                                            <label for="">Flu</label>
                                            <label class="checkbox mt-3 jc checkbox-info">
                                                <input type="checkbox" name="Checkboxes1"/>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="col-lg text-center p-2">
                                            <label for="">Use Point</label>
                                            <input type="text" name="" class="form-control form-control-sm text-success">
                                        </div>
                                        <div class="col-lg text-center p-2">
                                            <label for="">Available (Personal)</label>
                                            <input type="text" name="" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-lg text-center p-2">
                                            <label for="">Available (Dept)</label>
                                            <input type="text" name="" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                    <div class="row m-0 mt-3">
                                        <div class="col-lg-4 p-2"><label><font size="2">Pre-diagnosis</font></label>
                                            <input id="prediagnosis" name="prediagnosis" class="form-control form-control-sm savejson autotext" type="text" autocomplete="off">
                                        </div>

                                        <div class="col-lg-3 p-2"><label><font size="2">แพทย์เจ้าของไข้</font></label>
                                            <input id="doctorowner" name="doctorowner" class="form-control form-control-sm savejson autotext" type="text" autocomplete="off">
                                        </div>

                                        <div class="col-lg-5 p-2"><label><font size="2">สิทธิการรักษา</font></label>
                                        </div>
                                    </div>
                                    <div class="row m-0 mt-3 mb-5 aln">
                                        <div class="col-lg-7 p-2"><label><font size="2">Note</font></label>
                                            <textarea name="remark" id="remark" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-3 p-2 text-right">
                                            <button class="btn btn-book-submit mb-2 w-100">Confirm Book</button>
                                            <select id="appoint_user" name="appoint_user" class="form-control form-control-sm selectpicker" data-size="7" data-live-search="true" required>
                                                <option value="" selected>ผู้ทำนัด</option>

                                                @foreach ($userall as $d)
                                                    @php
                                                        $name = $d->user_prefix.$d->user_firstname." ".$d->user_lastname;
                                                    @endphp
                                                <option value="{{$name}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    </div>
                            </form>
                            <form action="{{url('book')}}" method="post" class="menu_form mt-2 pl-2 pr-2" id="form_ck_other">
                                @csrf
                                <div class="row m-0">
                                    <div class="col-lg">
                                        <label for="" class="col-form-label"><font size="2">Title</font></label>
                                        <input type="text" name="" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-lg">
                                        <label for="" class="col-form-label"><font size="2">Topic</font></label>
                                        <select name="" id="" class="form-control form-control-sm"></select>
                                    </div>
                                </div>
                                <div class="row m-0 mt-3">
                                    <div class="col-lg">
                                        <label for="" class="col-form-label"><font size="2">Start</font></label>
                                        <input type="time" name="" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-lg">
                                        <label for="" class="col-form-label"><font size="2">End</font></label>
                                        <input type="time" name="" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-lg text-center">
                                        <label for="" class="col-form-label"><font size="2">Point</font></label>
                                        <input type="text" name="" class="form-control form-control-sm text-success">
                                    </div>
                                    <div class="col-lg text-center">
                                        <label for="" class="col-form-label"><font size="2">Available</font></label>
                                        <input type="text" name="" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="row m-0 mt-3 mb-5 aln">
                                    <div class="col-lg-7"><label><font size="2">Note</font></label>
                                        <textarea name="remark" id="" class="form-control" rows="3"></textarea>
                                    </div>
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-3 text-right">
                                        <button class="btn btn-book-submit mb-2 w-100">Confirm Book</button>
                                        <select class="form-control form-control-sm selectpicker" data-size="7" data-live-search="true" required>
                                            <option value="" selected>ผู้ทำนัด</option>
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
                                        </select>
                                    </div>
                                </div>
                            </form>

                            <form action="{{url('book')}}" method="post" class="menu_form mt-4 pl-2 pr-2" id="form_ck_leave">
                                @csrf

                                <div class="row m-0 mt-3 aln">

                                    <div class="col-12" style="display: show">
                                        <input type="text" name="event" value="leave"><br>
                                        <input type="text" id="date_leave"  name="date_leave" value="{{date('Y-m-d')}}"><br>
                                    </div>



                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="radio radio-outline radio-info">
                                                    <input type="radio" name="period" value="break_full" checked/>
                                                    <span></span>
                                                    &nbsp;&nbsp;ทั้งวัน 08:00-16:00
                                                </label>
                                            </div>
                                            <div class="col-12">&nbsp;</div>
                                            <div class="col-12">
                                                <label class="radio radio-outline radio-info">
                                                    <input type="radio" name="period" value="break_first"/>
                                                    <span></span>
                                                    &nbsp;&nbsp;เช้า 08:00-12:00
                                                </label>
                                            </div>
                                            <div class="col-12">&nbsp;</div>
                                            <div class="col-12">
                                                <label class="radio radio-outline radio-info">
                                                    <input type="radio" name="period" value="break_second"/>
                                                    <span></span>
                                                    &nbsp;&nbsp;บ่าย 13:00-16:00
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <label></label>
                                        <textarea name="remark" class="form-control" rows="4" placeholder="Note..."></textarea>
                                    </div>

                                    <div class="col-lg-3 text-right">
                                        <button class="btn btn-book-submit mb-2 w-100">Confirm Book</button>
                                        <select
                                        name="appoint_user"
                                        class="form-control form-control-sm selectpicker"
                                        data-size="7"
                                        data-live-search="true"
                                        required>
                                            <option value="" selected>ผู้ทำนัด</option>
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
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        &nbsp;
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="row m-0">
                    <div class="col-lg-12 p-0">
                        <ul class="nav nav-pills row m-0" id="myTab1" role="tablist">
                            <li class="nav-item m-0 p-0 col-lg">
                                <a class="nav-link active text-center" id="home-tab-1" data-toggle="tab" href="#home-1">
                                    <span class="nav-text h4 m-0">Procedure Booked (<font id="count_booked">{{$book_count}}</font>)</span>
                                </a>
                            </li>
                            <li class="nav-item m-0 p-0 col-lg text-center" style="display: none">
                                <a class="nav-link" id="profile-tab-1" data-toggle="tab" href="#profile-1" aria-controls="profile">
                                    <span class="nav-text h4 m-0">Other Booked (0)</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mt-5" id="myTabContent1">
                            <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab-1">
                                <div class="row">
                                    <div class="col-8">&nbsp;</div>
                                    <div class="col-4" style="display: flex; justify-content: flex-end">
                                        <div class="row">
                                            <div class="col-5">
                                                <select id="search_doctor2" class="form-control selectpicker" data-size="7" data-live-search="true">
                                                    <option value="all">Select Doctor</option>
                                                    @foreach ($doctor as $d)
                                                        <option value="{{$d->user_email}}">{{$d->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-5">
                                                <select id="search_branch" class="form-control">
                                                    <option value="all">Select Department</option>
                                                    <option value="GIS">แผนกศัลยกรรม</option>
                                                    <option value="GI">แผนกอายุรกรรม</option>
                                                    <option value="GIP">แผนกศัลยกรรมเด็ก</option>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <button
                                                    type="button"
                                                    id="btnprint"
                                                    class="btn btn-text-dark btn-hover-light-dark font-weight-bold"
                                                    ><i class="fas fa-print"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <table class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Time</th>
                                            <th scope="col">Patient</th>
                                            <th scope="col">Physician</th>
                                            <th scope="col">Procedure / Pre-diagnosis</th>
                                            <th scope="col">ผู้ทำนัด / Note</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_pcd_booked">
                                        @foreach ($tb_casebooking as $tcd)
                                        @php
                                            $json = json_decode($tcd->book_appoint);
                                            $time = date("H:i", strtotime($tcd->book_date_end));
                                        @endphp
                                        <tr>
                                            <th scope="row">{{$time}}</th>
                                            <td>
                                                {{$json->PTNAME}}({{@$json->AGE}})<br>
                                                {{$json->HN}}
                                            </td>
                                            <td>
                                                <i class="fas fa-head-side-mask"></i> &nbsp;{{$json->SURGEON}}<br>
                                                @if($tcd->book_doctorowner!="")
                                                    <i class="fas fa-user-md"></i> &nbsp;{{$tcd->book_doctorowner}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$json->OPERATION}}<br>
                                                <span style="color: pink">{{$json->DIAG}}</span>
                                            </td>
                                            <td>
                                                {{$tcd->book_user}}<br>
                                                <span style="color: pink">{{$tcd->book_comment}}</span>
                                            </td>
                                            <td>
                                                <a class="btn_scopy_edit btn btn-link" bookid="{{$tcd->book_id}}">
                                                    Edit
                                                </a>
                                            </td>
                                            {{-- <td><button type="button" class="btn btn-secondary"><i class="fas fa-edit icon-nm"></i></button></td> --}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
                                <table class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Time</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Topic</th>
                                            <th scope="col">ผู้ทำนัด</th>
                                            <th scope="col">Note</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="data_pcd_other">

                                    </tbody>
                                </table>
                            </div>
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
<script src="{{url('')}}/public/js/print.min.js"></script>
<script src="{{url('')}}/public/js/pdfobject.min.js"></script>
<script CHARSET="UTF-8">PDFObject.embed("{{url('')}}/notepdf/1", "#example1");</script>


<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function btn_scopy_edit(bookid){
        $("#ck_endoscopy").trigger('click');
        $(".panel").show(1000);
        $("#event_endoscopy").val("endoscopy_edit");
        $("#book_id_edit").val(bookid);
        $.post("{{url('book')}}",{
            event   : "get_bookdata",
            bookid   : bookid,
        },function(data, status){
            var book = JSON.parse(data);
            $("#hn")                .val(book.HN);
            $("#prefix")            .val(book.PT_PREFIX);
            $("#first_name")        .val(book.PT_FIRSTNAME);
            $("#last_name")         .val(book.PT_LASTNAME);
            $("#agenew")            .val(book.AGE);
            $("#gender")            .val(book.gender).change();
            $("#s_book_doctor")     .val(book.doctorid).change();
            $("#prediagnosis")      .val(book.DIAG);
            $("#doctorowner")       .val(book.book_doctorowner);
            $("#righttotreatment")  .val(book.PTTYPE_NAME).change();
            $("#remark")            .val(book.book_comment);
            var procedure = book.OPERATION.split(" ");
            $('#kt_select2_11').val(null).trigger('change');
            jQuery.each(procedure, function(i, val2) {
                if(val2!=""){
                    var newOption = new Option(val2, val2, true, true);
                    $('#kt_select2_11').append(newOption).trigger('change');
                }
            });
        });
    }



    $(".btn_scopy_edit").click(function(){
        var bookid = $(this).attr('bookid');
        btn_scopy_edit(bookid);
    });











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
    create_start_page()









});




$("#addjob").click(function(){
    $(".panel").fadeToggle(1000);
});


</script>


<script>
    $("#hn").keyup(function(){
        var hn = $(this).val()
        $.post("{{url('api/jquery')}}",{
            event   : "check_hn",
            hn   : hn,
        },function(data, status){
            var check_hn = JSON.parse(data);
            if(check_hn.count==1){
                // $("#name_return_old").html(check_hn.firstname+' '+check_hn.lastname)
                // $('#change_hn_old').modal('show')
                $("#show_hn_modal").modal('show')
                $("#show_hn").html(hn)
                $("#show_name").html(check_hn.firstname+' '+check_hn.lastname)
            }
        });
    })

    $("#dont_use_hn").click(function(){
        $("#hn").val('')
    })
    $("#use_hn").click(function(){
        var hn = $("#hn").val()
        $.post("{{url('api/jquery')}}",{
            event   : "check_hn",
            hn      : hn,
        },function(data, status){
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
            $("#birthday").val(da).change()
            $("#birthmonth").val(mo).change()
            $("#birthyear").val(parseInt(ye)+543).change()
            $("#show_hn_modal").modal('hide')
        });
    })

        @php
            $ip_hisconnect = "192.168.124.242";
            if(webconfig('com_name')!="Appointment System"){
                $ip_hisconnect = "192.168.87.200";
            }
        @endphp

        $('#hn').focusout(function(){

        var hn = $("#hn").val();
        $.post("http://{{$ip_hisconnect}}/hisconnect/public/api/patient",{
            event   : "check_hn",
            hn      : $('#hn').val(),
        },function(data, status){
            var check_hn = JSON.parse(data);
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
                if(check_hn.sex=="ญ"){gender = 2;}
                $("select[name=gender]").val(gender).change();
                const m         = check_hn.birthdate.split("");
                birth_day       = m[6]+m[7];
                birth_year      = m[0]+m[1]+m[2]+m[3];
                birth_month     = m[4]+m[5];
                $("#birthday").val(birth_day).change();
                $("#birthmonth").val(birth_month).change();
                $("#birthyear").val(birth_year).change();
                $("#agenew").val(check_hn.age);
                setTimeout(() => {
                    $("#agenew").val(check_hn.age);
                }, 1000);
            }else{
                alert("ไม่พบ H.N. ในระบบ")
            }
            });
        });




</script>
<script>

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


    $("#btnprint").click(function(){
        $("#showprint").modal("show");
    });


    function print_t(dep){
        var temp_date   = $("#temp_date").val();
        var dep         = dep;
        printJS({printable:'{{url('')}}/book_print/'+dep+'?date='+temp_date, type:'pdf', showModal:true})
    }


    function return_color(count){

        return  "#F5EEF8";

        if(count==1){
            return  "#F5EEF8";
        }else if(count==2){
            return "#EBDEF0";
        }else if(count==3){
            return "#D7BDE2";
        }else if(count==4){
            return "#C39BD3";
        }else if(count==5){
            return "#AF7AC5";
        }else if(count==6){
            return "#9B59B6";
        }else if(count==7){
            return "#884EA0";
        }else if(count==8){
            return "#76448A";
        }else if(count==9){
            return "#633974";
        }else{
            return "#273746";
        }
    }

    function create_start_page(){
        check_month_year()
        day_data()
    }

    $("#date_appoint").datepicker({format: 'yyyy-mm-dd'});
    $("#date_appoint").on("change", function(){var fromdate = $(this).val();});


    function check_month_year(months,years,doctor){

        var doctor = $("#temp_doctor").val();
        if(months){
            var ye = years;
            var mo = months;
        }else{
            var check_month = $('.datepicker-days .datepicker-switch').text()
            const d = new Date(check_month)
            var ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
            var mo = new Intl.DateTimeFormat('en', { month: 'numeric' }).format(d);
        }

        $.post('{{url('api/jquery')}}',{
            event           : 'month_color',
            month_data      : parseInt(mo),
            year_data       : parseInt(ye),
            doctor_data     : doctor,
        },function(data,status){
            if(data!=0){
                var show_data = JSON.parse(data);
                jQuery.each(show_data, function(i, val) {
                    //$('.datepicker-days td:contains("'+i+'")').css('background',return_color(val))
                });
            }
        });
    }

    function click_date(){
        setTimeout(() => {
            var activeday   = $(".active.day").attr("data-date");
            var doctor      = $("#search_doctor2").val();
            var branch      = $("#search_branch").val();

            $.post('{{url('api/jquery')}}',{
                event       : 'data_book',
                activeday   : activeday,
                doctor      : doctor,
                branch      : branch
            },function(data,status){

                var ex_data = JSON.parse(data);

                    // console.log(data);
                    if(ex_data.status){
                    $("#date_appoint").val(ex_data.date);
                    $("#date_leave").val(ex_data.date);
                    $("#temp_date").val(ex_data.date);
                    $("#header_date").html(ex_data.datethai);
                    var tr = ''
                    $("#count_booked").html(ex_data.counts)
                    var this_data = ex_data.data_show;

                    console.log(this_data);
                    jQuery.each(this_data, function(i, val) {
                        var js_ex = JSON.parse(val.book_appoint);
                        var req = js_ex.REQDATE.split(" ");
                        var time = req[1].split(":");
                        tr += "<tr>"
                        tr +='<td scope="row">'+time[0]+':'+time[1]+'</td>'
                        tr +='<td>'+js_ex.PTNAME+'('+js_ex.AGE+')'
                        tr +='<br>'+js_ex.HN+'</td>'
                        tr +='<td><i class="fas fa-head-side-mask"></i> &nbsp;'
                        tr +=js_ex.SURGEON
                        tr +='<br>'
                        if(val.book_doctorowner!="" && val.book_doctorowner!=null){
                        tr +='<i class="fas fa-user-md"></i> &nbsp;'
                        tr +=val.book_doctorowner
                        }
                        tr +='</td>'
                        tr +='<td>'+js_ex.OPERATION+'<br><span style="color: pink">'+js_ex.DIAG+'</span></td>'
                        if(val.book_comment!="" && val.book_comment!=null){
                            tr +='<td>'+val.book_user+'<br><span style="color: pink">'+val.book_comment+'</span></td>'
                        }else{
                            tr +='<td>'+val.book_user+'<br></td>'
                        }
                        tr+='<td><a class="btn_scopy_edit btn btn-link" bookid="'+val.book_id+'">Edit</a></td>'
                        tr +='</tr>'
                        });
                    $("#data_pcd_booked").html(tr);
                }
                $(".btn_scopy_edit").click(function(){
                    var bookid = $(this).attr('bookid');
                    btn_scopy_edit(bookid);
                });

            });
        }, 1000);
    }
    $("#search_doctor2,#search_branch").change(function(){
        click_date();
    })

    $(document).on("click touchstart", "#kt_datepicker_6 .datepicker", function () {click_date();});

    function day_data(){
        $("#kt_datepicker_6 .datepicker").on("click touchstart", function() {click_date();});
    }

</script>
<script>
    $("#seach_doctor").change(function(){
        var doctor = $(this).val();
        $("#temp_doctor").val(doctor);
        $("#s_book_doctor").val(doctor).change();
        check_month_year();
    })

    $('.open-form').click(function() {
        if($(this).is(':checked')) {
            var this_id = $(this).attr('id');
            $(".menu_form").removeClass('active')
            $("#form_"+this_id).addClass('active')
        }
    });

    $(".form-control").keyup(function(){
        var check_text = $(this).val().length
        if(check_text>0){
            if($(this).hasClass('text-vio')){
            }else{
                $(this).addClass('text-vio')
            }
        }else{
            $(this).removeClass('text-vio')
        }
    });
    setTimeout(() => {
        var count_c = $(".day").length
        for(i=0;i<count_c;i++){
            var dates = $($(".day")[i]).attr('data-date')
            var nd = new Date(parseInt(dates));
            var new_d = nd.getDate()
            console.log(new_d);
            console.log(dates);
            if(new_d==1){
                $($(".day")[i]).css('background','red')
            }
            if(new_d==2){
                $($(".day")[i]).css('background','green')
            }
        }
    }, 1500);
</script>
@endsection
