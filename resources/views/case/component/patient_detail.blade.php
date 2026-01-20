@section('title-left')
PHYSICIAN  RECORD
@endsection
@section('title-right-1')
Cases list
@endsection
@section('title-right-2')
Physician Record
@endsection
@php
function check_null($val)
{
    if ($val == null || $val == '') {
        echo 'ไม่มีข้อมูล';
    } else {
        echo $val;
    }
}
function placeholder($data)
{
    if (!isset($data) || @$data == '') {
        echo "placeholder='ไม่มีข้อมูล'";
    }
}
@endphp
<style>
    .pdl {
        padding-left: 2em;
    }

    #move_case {
        position: absolute;
        border-radius: 0;
    }
</style>

<div class="col-lg-12 mt-13">
    {!! editcard('patient_detail', 'patient_detail.blade.php') !!}
    <div class="card card-custom gutter-b" style="height: 100%;">
        @if (uget("user_type") == 'admin')
            <button class="btn btn-danger" id="move_case" type="button" data-toggle="modal"
                data-target="#modal_move_case"><i class="fas fa-file-export"></i> ย้ายเคส</button>
        @endif
        <div class="card-body pb-0">
            <div class="row">
                @php
                    if (isset($case->patient_json)) {
                        $pt_json = json_decode($case->patient_json);
                    } else {
                        $pt_json = null;
                    }
                @endphp
                @if ($case->case_hn != 'VIP')
                    <div class="col-lg-6" style="border-right: 1px solid darkgrey;">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        @if (isset($case->pic))
                                            <img id="imgnew"
                                                src="{{ url("public/pic_patient/$case->pic?a=") }}{{ date('Y-m-dH:i:s') }}"
                                                width="100px" />
                                        @else
                                            <img id="imgnew" src="{{ asset('public/images/avatar.png') }}"
                                                width="100px" />
                                        @endif
                                    </div>
                                    <div class="col-lg-12 pdl text-center">
                                        <br><a
                                            href="{{ url("patient")}}/{{@$patient->_id}}/edit?prepage={{ url()->full() }}"
                                            class="btn btn-light" style="border: 1px solid gray"><b>Edit Patient
                                                profile</b></a>
                                    </div>
                                    <div class="col-lg-12 pdl mt-5">
                                        <h4 style="color: red;">HN : {{ $case->hn }}</h4>
                                    </div>
                                    <div class="col-lg-12 pdl">
                                        <br>
                                        <h4>AN : {{ check_null(@$case->an) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Name :</b>
                                            {{ @$patient->firstname . ' ' . @$patient->middlename . ' ' . @$patient->lastname }}</label>
                                        &emsp;
                                        <label class="col-form-label"><b>Age :</b>{{ age(@$patient->birthdate) }}</label>
                                        &emsp;
                                        @php
                                            $gender = isset($patient->gender) ? "Male" : 'Female';
                                        @endphp
                                        <label class="col-form-label"><b>Gender :</b>
                                            {{$gender}}</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>ID/Passport :</b>
                                            {{ check_null(@$patient->citizen) }}</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Allergic :</b>
                                            {{ check_null(@$patient->allergic) }}</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Contact :</b>
                                            {{ check_null(@$patient->email) . ' ' . @$patient->phone }}</label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Emergency Contact :</b>
                                            {{-- @if (isset($pt_json->emer_name) && isset($pt_json->emer_tel))
                                                {{ check_null(@$pt_json->emer_name) . ' ' . @$pt_json->emer_tel }}
                                            @elseif(isset($pt_json->emer_tel) && !isset($pt_json->emer_name))
                                                {{ @$pt_json->emer_tel }}
                                            @endif --}}
                                        </label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Congenital disease :</b>
                                            {{ check_null(@$patient->congenital_disease) }}</label>
                                    </div>

                                    <div class="col-lg-12 text-right">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-lg-6" style="border-right: 1px solid darkgrey;">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        @if (isset($case->pic))
                                            <img id="imgnew"
                                                src="{{ url("public/pic_patient/$case->pic?a=") }}{{ date('Y-m-dH:i:s') }}"
                                                width="100px" />
                                        @else
                                            <img id="imgnew" src="{{ asset('public/images/avatar.png') }}"
                                                width="100px" />
                                        @endif
                                    </div>
                                    <div class="col-lg-12 pdl">
                                        <br><a
                                            href="{{ url("patient/$patient->patient_id/edit?prepage=") }}{{ url()->full() }}"
                                            class="btn btn-light" style="border: 1px solid gray"><b>Edit Patient
                                                profile</b></a>
                                        <h4 style="color: red;">HN : {{ $patient->hn }}</h4>
                                    </div>
                                    <div class="col-lg-12 pdl">
                                        <br>
                                        <h4>AN : <input type="text" id="an" class="form-control"
                                                value="{{ check_null($patient->an) }}"></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Name :</b><input type="text" id="an"
                                                class="form-control" value="{{ $case->patientname }}"></label> &emsp;
                                        <label class="col-form-label"><b>Age :</b><input type="text" id="an"
                                                class="form-control" value="{{ $case->age }}"></label> &emsp;
                                        <label class="col-form-label"><b>Gender :</b><input type="text"
                                                id="an" class="form-control"
                                                value="{{ @$gender }}"></label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>ID/Passport :</b><input type="text"
                                                id="an" class="form-control"
                                                value="{{ @$patient->citizen }}"></label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Allergic :</b><input type="text"
                                                id="an" class="form-control"
                                                value="{{ @$patient->allergic }}"></label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Contact :</b><input type="text"
                                                id="an" class="form-control"
                                                value="{{ @$patient->contract }}"></label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Emergency Contact :</b><input type="text"
                                                id="an" class="form-control"
                                                value="{{ @$patient->emergency_contact }}"></label>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="col-form-label"><b>Congenital disease :</b><input type="text"
                                                id="an" class="form-control"
                                                value="{{ @$patient->congenital_disease }}"></label>
                                    </div>
                                    <div class="col-lg-12 text-right">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="row" style="    padding-left: 1em;">
                                <div class="col-12 mb-1">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="row" style="align-items: center;">
                                                <div class="col-5"><b>CASE ID :</b></div>
                                                <div class="col-7"><input type="text" name=""
                                                        value="{{ @$case->id }}"
                                                        class="form-control form-control-sm" id="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="row" style="align-items: center;">
                                                <div class="col-4 text-right"><b>Procedure :</b></div>
                                                <div class="col-8">
                                                    <input id="select_case_procedure"
                                                        value="{{ @$procedure->name }}" class="form-control"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-1">
                                    <div class="row" style="align-items: center;">
                                        <div class="col-4">
                                            <div class="row" style="align-items: center;">
                                                <div class="col-5"><b>Room :</b></div>
                                                <div class="col-7">
                                                    <select name="room" id="room_name" class="form-control form-control-sm savejson editroom">
                                                        <option value=""></option>
                                                        @isset($room)
                                                            @foreach ($room as $r)
                                                            @php
                                                                $r = (object) $r;
                                                            @endphp
                                                                <option value="{{$r->room_name}}" @if($r->room_id == @$case->room) selected @endif >{{$r->room_name}}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>

                                                    {{-- {{ select_users($room, @$case->room, 'room_name', ['room_name'], 'room', 'เลือกห้อง', 'editroom form-control form-control-sm savejson ') }} --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="row" style="align-items: center;">
                                                <div class="col-4 text-right"><b>Appointment :</b></div>
                                                <div class="col-8">
                                                    <input type="date" name=""
                                                        value="{{ @substr($case->appointment, 0, 10) }}"
                                                        class="form-control form-control-sm" id="case_dateappointment"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-1">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="row" style="align-items: center;">
                                                <div class="col-5"><b>Ward :</b></div>
                                                <div class="col-7">
                                                    <input type="text" name="" id="ward"
                                                        value="{{ @$case->ward }}" autocomplete="off"
                                                        class="form-control form-control-sm savejson"
                                                        {{ placeholder(@$case->ward) }}>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="row" style="align-items: center;">
                                                <div class="col-4 text-right"><b>OPD :</b></div>
                                                <div class="col-8">
                                                    <input type="text" name="" id="opd"
                                                        value="{{ @$case->opd }}" autocomplete="off"
                                                        class="form-control form-control-sm savejson"
                                                        {{ placeholder(@$case->opd) }}>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <b>Refer :</b><br>
                                            <input type="text" name="" id="refer"
                                                value="{{ @$case->refer }}" autocomplete="off"
                                                class="form-control form-control-sm savejson"
                                                {{ placeholder(@$case->refer) }}>
                                        </div>

                                        <div class="col-12">
                                            {{-- <b>Treatment Coverage (สิทธิการรักษา) : </b><br> --}}
                                            <div class="col-5 p-0 m-0"><b>Treatment Coverage (สิทธิการรักษา) : </b></div>
                                            <div class="col-7 p-0 m-0">
                                                <select name="treatment" id="treatment" class="form-control form-control-sm savejson edittreatment">
                                                    <option value=""></option>
                                                    @isset($tb_treatmentcoverage)
                                                        @foreach ($tb_treatmentcoverage as $t)
                                                        @php
                                                            $t = (object) $t;
                                                        @endphp
                                                            <option value="{{$t->code}}" @if(($t->code == @$treatment->treatment) || (isset($case->righttotreatment) && @$case->righttotreatment == $t->code)) selected @endif >{{$t->name}}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>

                                                {{-- {{ select_users($room, @$case->room, 'room_name', ['room_name'], 'room', 'เลือกห้อง', 'editroom form-control form-control-sm savejson ') }} --}}
                                            </div>
                                            {{-- {!! Form::select(
                                                'righttotreatment',
                                                ['' => 'ไม่มีข้อมูล'] + array_pluck(@$righttotreatment, 'name', 'name'),
                                                @$case->righttotreatment,
                                                ['class' => 'form-control form-control-sm savejson', 'id' => 'righttotreatment'],
                                            ) !!} --}}
                                        </div>
                                        <div class="col-3">
                                            <div class="row">
                                                <div class="col-lg-3"><label
                                                        class="col-form-label"><b>Status</b></label></div>
                                                <div class="col-lg-9" style="align-self: center;">
                                                    @php
                                                        $status="Registered";
                                                        if ($case->case_status == 0) {
                                                            $status="Registered";
                                                            $class="label label-warning label-pill label-inline";
                                                        }
                                                        if ($case->case_status == 1) {
                                                            $status="Operation";
                                                            $class="label label-info label-pill label-inline";
                                                        }
                                                        if ($case->case_status == 2) {
                                                            $status="Finished";
                                                            $class="label label-success label-pill label-inline";
                                                        }
                                                    @endphp
                                                    &emsp;<label
                                                        class="{{ @$class }}">{{ @$status }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="text-danger font-weight-bold font-size-h6"
                                        data-toggle="modal" data-target="#modal_confirm_delete">
                                        <div class="col bg-light-danger rounded-xl mr-7 mb-7 text-center"
                                            style="padding: 5px 3px;">
                                            <span class="svg-icon svg-icon-danger d-block my-2">
                                                <span class="svg-icon svg-icon-danger svg-icon-2x">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Stop.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24"
                                                                height="24" />
                                                            <path
                                                                d="M12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 Z M12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 Z M19.0710678,4.92893219 L19.0710678,4.92893219 C19.4615921,5.31945648 19.4615921,5.95262146 19.0710678,6.34314575 L6.34314575,19.0710678 C5.95262146,19.4615921 5.31945648,19.4615921 4.92893219,19.0710678 L4.92893219,19.0710678 C4.5384079,18.6805435 4.5384079,18.0473785 4.92893219,17.6568542 L17.6568542,4.92893219 C18.0473785,4.5384079 18.6805435,4.5384079 19.0710678,4.92893219 Z"
                                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>Cancel
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12">
                                    <a class="text-success font-weight-bold font-size-h6 mt-2"
                                        href="{{ url("camera/$case->id") }}">
                                        <div class="col bg-light-success rounded-xl text-center">
                                            <span class="svg-icon svg-icon-success d-block my-2"
                                                style="padding: 5px 3px;">
                                                <span class="svg-icon svg-icon-success">
                                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Picture.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24" />
                                                            <rect fill="#000000" opacity="0.3" x="2"
                                                                y="4" width="20" height="16"
                                                                rx="2" />
                                                            <polygon fill="#000000" opacity="0.3"
                                                                points="4 20 10.5 11 17 20" />
                                                            <polygon fill="#000000" points="11 20 15.5 14 20 20" />
                                                            <circle fill="#000000" opacity="0.3" cx="18.5"
                                                                cy="8.5" r="1.5" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                            Take Photo
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Default Modals -->

