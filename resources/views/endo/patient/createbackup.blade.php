{{-- @extends('layouts.app') --}}
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{url("public/css/patient/create.css")}}" rel="stylesheet" type="text/css" />
<style>
    .form-control[readonly] {
        background-color: #d2ebf6;
    }
    .form-group {
    margin-bottom: 0 !important;
    }
    .btn-pos{
        margin-top: 4.5em;
        float: right;
    }
    .fs-22{
        font-size: 22px;
    }
</style>
@endsection
@section('content')

@section('title-left')
    <h4 class="mb-sm-0">CREATE NEW</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Cases List</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection

{{-- @section('title-left')
CREATE NEW
@endsection
@section('title-right-1')
Cases List
@endsection
@section('title-right-2')
Create
@endsection --}}
{{-- <br>
<br> --}}

<div class="col-12 cardcode" style="display: none">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <label id="discharge_toggle">
                <font size='4'><b>Page Detail</b></font>
            </label>
            <div class="row">
                <div class="col-12">
                    <a id="test123">PatientController -> Create</a>
                    <br>
                    Controller : <a
                        href="{{ url("autoit?run=visualcode_open\\endo.exe&path=PatientController") }}">PatientController</a>
                </div>
                <div class="col-12">
                    View : <a
                        href="{{ url("autoit?run=visualcode_open\\endo.exe&path=endo/patient/create.blade.php") }}">endo/patient/create.blade.php</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<form action="{{url('book/patient')}}" method="post" class="col-12">
    @csrf
    <input type="hidden" name="event" value="">
    <div class="row">
        <div class="col-lg-3">
            <div class="card h-100">

            </div>
        </div>
    </div>
</form>
    {{-- @if(isset($patient))
        {{Form::open(['method'=>'put','route'=>['patient.update',@$patient->id]])}}
    @else
        {{Form::open(['url'=>'patient'])}}
    @endif --}}

                         <div class="row" id="step01" style="margin: 0;">
                            <div class="col-lg-4" style="height: 100%;padding:4px;">
                                <div class="card">
                                    <div class="card-body bg-dark-primary">
                                        <div class="row">
                                            <div class="col-12">

                                                <a
                                                type="button"
                                                id="test_pt"
                                                class="btn btn-soft-success btn-icon waves-effect waves-light "
                                                data-toggle="tooltip" title="Create patient test"
                                                >
                                                    <i class="ri-edit-2-fill h3 m-0"></i>
                                                </a>

                                                <a id="readcitizencard"
                                                class="btn btn-soft-success btn-icon waves-effect waves-light "
                                                data-toggle="tooltip" title="Read Citizencard"
                                                >
                                                    <i class="ri-folder-user-fill ri-2x"></i>
                                                </a>
                                            </div>
                                            <div class="col-12">
                                                <div class="col" align="center">
                                                    @if(@$patient->pic=="")
                                                    <svg width="93" height="93" viewBox="0 0 93 93" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.5 92.75C6.95625 92.75 4.77942 91.845 2.9695 90.0351C1.1565 88.2221 0.25 86.0437 0.25 83.5V65H9.5V83.5H28V92.75H9.5ZM0.25 28V9.5C0.25 6.95625 1.1565 4.77787 2.9695 2.96487C4.77942 1.15496 6.95625 0.25 9.5 0.25H28V9.5H9.5V28H0.25ZM65 92.75V83.5H83.5V65H92.75V83.5C92.75 86.0437 91.845 88.2221 90.0351 90.0351C88.2221 91.845 86.0437 92.75 83.5 92.75H65ZM83.5 28V9.5H65V0.25H83.5C86.0437 0.25 88.2221 1.15496 90.0351 2.96487C91.845 4.77787 92.75 6.95625 92.75 9.5V28H83.5ZM46.5 46.5C42.5687 46.5 39.2742 45.1695 36.6164 42.5086C33.9555 39.8508 32.625 36.5563 32.625 32.625C32.625 28.7708 33.9555 25.4948 36.6164 22.7969C39.2742 20.099 42.5687 18.75 46.5 18.75C50.3542 18.75 53.6302 20.099 56.3281 22.7969C59.026 25.4948 60.375 28.7708 60.375 32.625C60.375 36.5563 59.026 39.8508 56.3281 42.5086C53.6302 45.1695 50.3542 46.5 46.5 46.5ZM18.75 74.25V65.4625C18.75 63.8438 19.1555 62.3221 19.9664 60.8976C20.7742 59.47 21.8719 58.3323 23.2594 57.4844C26.8052 55.4031 30.5237 53.8229 34.4149 52.7438C38.3091 51.6646 42.3375 51.125 46.5 51.125C50.6625 51.125 54.6909 51.6646 58.5851 52.7438C62.4763 53.8229 66.1948 55.4031 69.7406 57.4844C71.1281 58.3323 72.2273 59.47 73.0383 60.8976C73.8461 62.3221 74.25 63.8438 74.25 65.4625V74.25H18.75Z" fill="white"/>
                                                    </svg>
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

                                                <input type="hidden" name="myHiddenField">
                                                <div class="row">
                                                    <div class="col-12">

                                                        <div class="form-group">
                                                            <label for="inputEmail4" class="col-form-label">
                                                                <font size="2">HN</font>
                                                                <font size="3" color="red">*</font>
                                                                <font id="hn_alert" size="3" color="red">ห้ามพิมพ์เครื่องหมายพิเศษยกเว้นเครื่องหมาย -</font>
                                                            </label>
                                                            <input id="hn" name="hn" type="text" class="form-control" value="{{@$patient->hn}}"
                                                            oninvalid="this.setCustomValidity('คุณลืมกรอก HN')"
                                                            oninput="setCustomValidity('')"
                                                            placeholder="H.N." required onpaste="return false">
                                                            <div id="show_lang_in_here"></div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword4" class="col-form-label"><font size="2">AN</font></label>
                                                            @if(isset($patient->an))
                                                            {{ Form::text('an',$patient->an,['class'=>'form-control','readonly','autocomplete'=>"off"]) }}
                                                            @else
                                                            {{ Form::text('an','',['class'=>'form-control','autocomplete'=>"off"]) }}
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword4" class="col-form-label"><font size="2">เลขที่ประจำตัวประชาชน / เลขที่ PASSPORT </font></label>
                                                            <input id="citizen" value="{{@$patient->citizen}}" name="citizen" type="text" class="form-control" autocomplete="off">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword4" class="col-form-label"><font size="2">สัญชาติ</font></label>
                                                            {{select_users($nationality,1,'id',['namethai'],'nationality','เลือกสัญชาติ','form-control')}}

                                                            {{-- คอมเม้นไว้ตั้งแต่ตอนแรก --}}
                                                            {{-- <label for="inputEmail4" class="col-form-label"><font size="2">สิทธิการรักษา </font></label> --}}
                                                            <select class='form-control' name="righttotreatment">
                                                                <option value="" selected disabled hidden>Select</option>
                                                                @forelse($righttotreatment as $l)
                                                                <option value='{{ $l->id }}' @if(@$patient->righttotreatment==$l->id) selected @endif>{{ $l->name }}</option>
                                                                @empty
                                                                    <option>ไม่ข้อมูล</option>
                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 mt-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">คำนำหน้า</font><font size="3" color="red"></font></label>
                                                <input name="prefix" id="prefix" type="text" class="form-control savejson autotext" autocomplete="off">
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อ</font><font size="3" color="red"> *</font></label>
                                                <input name="firstname" type="text" class="form-control" id="first_name" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="middlename" class="col-form-label"><font size="2">ชื่อกลาง</font><font size="3" color="red">&nbsp;</font></label>
                                                <input name="middlename" type="text" class="form-control" id="middlename">
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อสกุล</font><font size="3" color="red"> *</font></label>
                                                <input name="lastname" type="text" class="form-control" id="last_name" required>
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="inputEmail4" class="col-form-label"><font size="2">เพศ</font><font color="red"> *</font></label>
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
                                                <label for='inputdate' class='col-form-label'><font size="2">วัน/เดือน/ปี เกิด</font><font color="red"> *</font></label>
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
                                                            @foreach($year_all as $year)
                                                                <option value="{{$year}}">{{$year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-3">
                                                <label for='agenew' class='col-form-label'>
                                                    <font size="2">อายุ</font><font color="red"> *</font>
                                                </label>
                                                <div class="row" style="margin: 0;">
                                                <input name="age" type="number" id="agenew" class="form-control" value="{{@$age}}" placeholder="อายุ" style="width: 95%" style="height: auto;" required>
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
                                                        <label for="inputEmail4" class="col-form-label">
                                                            <font size="2">ประวัติการแพ้ยา</font>
                                                            @if(configTYPE('required','allergy'))<font color="red">*</font>@endif
                                                        </label>
                                                        @if(configTYPE('required','allergy'))
                                                            <input type="text" name="allergic" value="{{@$patient->allergic}}" class="form-control" required>
                                                        @else
                                                            <input type="text" name="allergic" value="{{@$patient->allergic}}" class="form-control">
                                                        @endif

                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4" class="col-form-label"><font size="2">บุคคลติดต่อฉุกเฉิน</font></label>
                                                        @if(isset($patient->emer_name))
                                                        {{ Form::text('emer_name',$patient->emer_name,['class'=>'form-control']) }}
                                                        @else
                                                        {{ Form::text('emer_name','',['class'=>'form-control']) }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4" class="col-form-label"><font size="2">Email</font></label>
                                                    @if(isset($patient->email))
                                                    {{ Form::text('email',$patient->email,['class'=>'form-control']) }}
                                                    @else
                                                    {{ Form::text('email','',['class'=>'form-control']) }}
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4" class="col-form-label"><font size="2">ประวัติโรคประจำตัว</font></label>
                                                    @if(isset($patient->congenital_disease))
                                                    {{ Form::text('congenital_disease',$patient->congenital_disease,['class'=>'form-control']) }}
                                                    @else
                                                    {{ Form::text('congenital_disease','',['class'=>'form-control']) }}
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4" class="col-form-label"><font size="2">โทร</font></label>
                                                    @if(isset($patient->emer_tel))
                                                    {{ Form::text('emer_tel',$patient->emer_tel,['class'=>'form-control','']) }}
                                                    @else
                                                    {{ Form::text('emer_tel','',['class'=>'form-control']) }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row btn-pos" >
                                            <button id="savestep04" type="submit" class="btn btn-soft-secondary font-weight-bold btn-lg mr-2 " name="back_to" value="{{url()->previous()}}">
                                                <span class="fs-22">บันทึกและกลับ</span>
                                            </button>
                                                &emsp;
                                            <button class="btn btn-soft-success " name="next" value="1">
                                                <span class="fs-22">บันทึกและนัดหมาย</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            {{-- comment ไว้ตั้งแต่ตอนแรก --}}
                            <div class="col-lg-8" style="height: 100%;padding:4px;">
                                <div class="card" style="height: 100%;">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-lg-2">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">คำนำหน้า</font><font size="3" color="red"></font></label>
                                                <input name="prefix" id="prefix" type="text" class="form-control savejson autotext" autocomplete="off">
                                            </div>
                                            <div class="form-group col-lg">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อ</font><font size="3" color="red"> *</font></label>
                                                <input name="firstname" type="text" class="form-control" id="first_name" required>
                                            </div>
                                            <div class="form-group col-lg">
                                                <label for="middlename" class="col-form-label"><font size="2">ชื่อกลาง</font><font size="3" color="red">&nbsp;</font></label>
                                                <input name="middlename" type="text" class="form-control" id="middlename">
                                            </div>
                                            <div class="form-group col-lg">
                                                <label for="inputPassword4" class="col-form-label"><font size="2">ชื่อสกุล</font><font size="3" color="red"> *</font></label>
                                                <input name="lastname" type="text" class="form-control" id="last_name" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-3">
                                                <label for="inputEmail4" class="col-form-label"><font size="2">เพศ</font><font color="red"> *</font></label>
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
                                                <label for='inputdate' class='col-form-label'><font size="2">วัน/เดือน/ปี เกิด</font><font color="red"> *</font></label>
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
                                                            @foreach($year_all as $year)
                                                                <option value="{{$year}}">{{$year}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-lg-3">
                                                <label for='agenew' class='col-form-label'>
                                                    <font size="2">อายุ</font><font color="red"> *</font>
                                                </label>
                                                <div class="row" style="margin: 0;">
                                                <input name="age" type="number" id="agenew" class="form-control" value="{{@$age}}" placeholder="อายุ" style="width: 95%" style="height: auto;" required>
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
                                                        <label for="inputEmail4" class="col-form-label">
                                                            <font size="2">ประวัติการแพ้ยา</font>
                                                            @if(configTYPE('required','allergy'))<font color="red">*</font>@endif
                                                        </label>
                                                        @if(configTYPE('required','allergy'))
                                                            <input type="text" name="allergic" value="{{@$patient->allergic}}" class="form-control" required>
                                                        @else
                                                            <input type="text" name="allergic" value="{{@$patient->allergic}}" class="form-control">
                                                        @endif

                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="inputEmail4" class="col-form-label"><font size="2">บุคคลติดต่อฉุกเฉิน</font></label>
                                                        @if(isset($patient->emer_name))
                                                        {{ Form::text('emer_name',$patient->emer_name,['class'=>'form-control']) }}
                                                        @else
                                                        {{ Form::text('emer_name','',['class'=>'form-control']) }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4" class="col-form-label"><font size="2">Email</font></label>
                                                    @if(isset($patient->email))
                                                    {{ Form::text('email',$patient->email,['class'=>'form-control']) }}
                                                    @else
                                                    {{ Form::text('email','',['class'=>'form-control']) }}
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputEmail4" class="col-form-label"><font size="2">ประวัติโรคประจำตัว</font></label>
                                                    @if(isset($patient->congenital_disease))
                                                    {{ Form::text('congenital_disease',$patient->congenital_disease,['class'=>'form-control']) }}
                                                    @else
                                                    {{ Form::text('congenital_disease','',['class'=>'form-control']) }}
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="inputPassword4" class="col-form-label"><font size="2">โทร</font></label>
                                                    @if(isset($patient->emer_tel))
                                                    {{ Form::text('emer_tel',$patient->emer_tel,['class'=>'form-control','']) }}
                                                    @else
                                                    {{ Form::text('emer_tel','',['class'=>'form-control']) }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row btn-pos" >
                                            <button id="savestep04" type="submit" class="btn btn-light-primary font-weight-bold mr-2 btn-lg h3" name="back_to" value="{{url()->previous()}}">
                                            <h3 class="m-0">บันทึกและกลับ</h3></button>
                                                &emsp;
                                            <button class="btn btn-light-success h3" name="next" value="1"><h3 class="m-0">บันทึกและนัดหมาย</h3></button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <footer class="footer text-right">
                    © Medica Healthcare.
                </footer>


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
           <div class="modal-content">

                <div align="center">

                <br><h1 class="modal-title" id="myModalLabel"> คุณ <div id="patient_name"></div> ได้ทำการลงทะเบียนแล้ว</h1>
                <br><h1 class="modal-title" id="myModalLabel">HN.<div id="patient_hn"></div></h1>

                </div>
                <div class="modal-footer">
                    <div class="row" style="    width: 100%;">
                        <div class="col-6"><button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width: 100%;padding:2em;"><h2 class="mb-0">ไม่ใช่</h2></button></div>
                        <div class="col-6"><a id="opencase" type="button" class="btn btn-primary" href="" style="width: 100%;padding:2em;"><h2 class="mb-0">เลือกคนไข้รายนี้</h2></a></div>
                    </div>
                </div>

           </div>
        </div>
    </div>


@endsection


@section('script')
    <script src     ="{{url('public/js/jquery.input-dropdown.js')}}"></script>
    <script src     ="{{url('public/js/patient/create.js')}}"></script>
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

    $("#birthyear,#birthmonth,#birthday").change(function(){
        var age = calculate_age($("#birthday").val(), $("#birthmonth").val(), $("#birthyear").val())
        $("#agenew").val(age)
        // $.post("{{url('jquery')}}",
        // {
        //     event   : 'birth_change',
        //     day     : $("#birthday").val(),
        //     month   : $("#birthmonth").val(),
        //     year    : $("#birthyear").val()
        // },
        // function(data,status){
        //     var obj = JSON.parse(data);
        //     $("#agenew").val(obj[0]);
        // });
    });

    function calculate_age(day, month, year){
        var now_str = moment().format("YYYY-MM-DD")
        var now = moment(`${now_str}`)
        var inp = moment(`${parseInt(year)-543}-${month}-${day}`)
        var age = now.diff(inp, 'years')
        return age
    }


    $("#agenew").on('keyup keypress blur change',function(e){
        if($(this).val() >120){$(this).val(120);}
        var date   = {{date('Y')}}+543;
        var year   = date-$(this).val();
        $("#birthyear").val(year);
    });


    $('#hn').focusout(function(){
        var hn = $("#hn").val();
        $.post("{{url('')}}/api/photomove",
        {
            event : 'hn_check',
            value : hn.toString(),
        },
        function(data,status){
            var n = data.search("#");
            if(n>0){
                $('#hn').val('');
                var res = data.split("#");
                $('#patient_name').html(res[0]);
                $('#patient_hn').html(res[1]);
                $('#opencase').attr('href','{{url("")}}/registration/'+res[2]);
                $('#mi-modal').modal('show');
            }else{
                hn_form_hisconnect(hn);
            }
        });
    });










    $("#test_pt").click(function(){
        var this_age= Math.floor(Math.random() * 60);
        var m = new Date();
        var dateString = m.getUTCFullYear() +""+ ("0"+(m.getUTCMonth()+1)).slice(-2) +""+ ("0"+m.getUTCDate()).slice(-2);
        $("#hn").val('TEST'+dateString);
        if($("#first_name").val()!='test'){
            $("#prefix").val('นาย')
            $("#first_name").val('test')
            $("#last_name").val('test')
            $("#agenew").val(this_age)
            $("[name='gender']").val(1).change()
            $("#agenew").keyup()
        }
        $("#hn").focusout()

    })

    $("#readcitizencard").click(function(){
        $('#modal_progress').modal('show');
        $.get('http://localhost/endocapture5.0/api/readcitizencard',{},function(data,status){
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
        $head = configTYPE('pdf', 'pdf_folder_head');
        $pathhispatient = $_SERVER['DOCUMENT_ROOT']."/config/views/his/$head/patient_get_detail.blade.php";
    @endphp

    @if(is_file($pathhispatient))
        @include("his.$head.patient_get_detail")
    @else
        @include("endo.patient.his.00000")
    @endif


@endsection
