@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
    <style>
        .fs-30 {
            font-size: 30px;
            font-weight: 400;
        }

        .fs-19 {
            font-size: 19px;
        }

        .modal-lg,
        .modal-xl {
            --vz-modal-width: 812px;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('public/css/patient/create.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
        id="mi-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-3">

                <div align="center">
                    <br>
                    <span class="modal-title text-color-index  fs-30 mb-2 " id="myModalLabel">HN :
                        <div id="patient_hn" class="d-inline"></div>
                    </span>
                    <span class="modal-title fw-normal mb-2" id="myModalLabel">
                        <div id="patient_name" class="text-color-index  fs-30 "></div>
                    </span>

                    <span class="text-danger fs-19">
                        This name has already been registered in the system.
                    </span>
                    <br>


                </div>
                <div class="modal-footer">
                    <div class="row mt-3" style="    width: 100%;">
                        <div class="col-6 text-end">
                            <button type="button" class="btn btn-load btn-danger" data-bs-dismiss="modal"
                                style="width: 50%;">
                                <span class="text-modal">Cancel</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <a id="opencase" type="button" class="btn btn-load btn-primary" href=""
                                style="width: 50%;"><span class="text-modal">Confirm</span></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
        id="modal_noinfo_his">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 fs-19">

                <div align="center">
                    <div class="col-12 p-0 mb-3">
                        <span class="modal-title text-danger mb-2 " id="myModalLabel">Patient ID :
                            <div id="patient_hn_his" class="d-inline"></div>
                        </span> <br>
                        <span class="modal-title fw-normal mb-2" id="myModalLabel">
                            ไม่พบข้อมูลในระบบ
                        </span> <br>
                    </div>
                    <div style="border-top: 1px solid #E9EBEC">
                        <div class="mt-3">
                            <span class="text-color-index ">
                                *กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง
                            </span>
                        </div>

                    </div>
                    <br>


                </div>
                <div class="modal-footer">
                    <div class="row mt-3" style="    width: 100%;">
                        <div class="col-6 text-end">
                            <button type="button" class="btn  btn-danger w-lg" data-bs-dismiss="modal"
                                style="width: 50%;">
                                <span class="text-modal">Close</span>
                            </button>
                        </div>
                        <div class="col-6">
                            <button id="type_info" data-bs-dismiss="modal" type="button" class="btn btn-success w-lg"
                                style="width: 50%;"><span class="text-modal">Add Patient</span></button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('content')
@section('title-left')
    @php
        // dd($type);
        $action_cap = @$action . '' == 'edit' ? 'EDIT PATIENT' : strtoupper('create new');
        $action_txt = @$action . '' == 'edit' ? 'Edit' : 'Create';
        $action_txt2 = @$action . '' == 'edit' ? 'EDIT' : 'REGISTRATION';
    @endphp
    <h4 class="mb-sm-0">{{ @$action_cap }}</h4>
@endsection

@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Operation </a></li>
        <li class="breadcrumb-item active text-gray">{{ @$action_txt }}</li>
    </ol>
@endsection
{{-- <div class="col-12 cardcode" style="display: none">
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
                </form> --}}


<form id="patient_form" action="{{ url('patient') }}" method="post">
    @csrf
    <input type="hidden" name="event" value="patient_create">
    @isset($_GET['historytaking'])
        <input type="hidden" name="historytaking" value="true">
    @endisset



    <div class="row delete-h" id="step01" style="margin: 0;">
        <div class="col-lg-3" style="padding:4px; ">
            <div class="card">
                <div class="card-body bg-dark-primary h-60">
                    <div class="row">
                        <div class="col-12">

                            <a type="button" id="patient_test"
                                class="btn btn-white btn-icon waves-effect waves-light " data-toggle="tooltip"
                                title="Create patient test">
                                <i class="ri-edit-2-fill ri-xl m-0"></i>
                            </a>
                        </div>
                        <div class="col-12">
                            <div class="col" align="center">
                                @if (@$patient->pic == '')
                                    {{-- <svg width="93" height="93" viewBox="0 0 93 93" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.5 92.75C6.95625 92.75 4.77942 91.845 2.9695 90.0351C1.1565 88.2221 0.25 86.0437 0.25 83.5V65H9.5V83.5H28V92.75H9.5ZM0.25 28V9.5C0.25 6.95625 1.1565 4.77787 2.9695 2.96487C4.77942 1.15496 6.95625 0.25 9.5 0.25H28V9.5H9.5V28H0.25ZM65 92.75V83.5H83.5V65H92.75V83.5C92.75 86.0437 91.845 88.2221 90.0351 90.0351C88.2221 91.845 86.0437 92.75 83.5 92.75H65ZM83.5 28V9.5H65V0.25H83.5C86.0437 0.25 88.2221 1.15496 90.0351 2.96487C91.845 4.77787 92.75 6.95625 92.75 9.5V28H83.5ZM46.5 46.5C42.5687 46.5 39.2742 45.1695 36.6164 42.5086C33.9555 39.8508 32.625 36.5563 32.625 32.625C32.625 28.7708 33.9555 25.4948 36.6164 22.7969C39.2742 20.099 42.5687 18.75 46.5 18.75C50.3542 18.75 53.6302 20.099 56.3281 22.7969C59.026 25.4948 60.375 28.7708 60.375 32.625C60.375 36.5563 59.026 39.8508 56.3281 42.5086C53.6302 45.1695 50.3542 46.5 46.5 46.5ZM18.75 74.25V65.4625C18.75 63.8438 19.1555 62.3221 19.9664 60.8976C20.7742 59.47 21.8719 58.3323 23.2594 57.4844C26.8052 55.4031 30.5237 53.8229 34.4149 52.7438C38.3091 51.6646 42.3375 51.125 46.5 51.125C50.6625 51.125 54.6909 51.6646 58.5851 52.7438C62.4763 53.8229 66.1948 55.4031 69.7406 57.4844C71.1281 58.3323 72.2273 59.47 73.0383 60.8976C73.8461 62.3221 74.25 63.8438 74.25 65.4625V74.25H18.75Z"
                                        fill="white" />
                                </svg> --}}
                                    <img src="{{ url('public/images/usericon1.jpg') }}" width="93" height="93"
                                        style="border-radius: 50%" alt="">
                                @else
                                    <img id="imgnew"
                                        src="{{ url("pic_patient/$patient->pic") }}?a={{ date('Y-m-dH:i:s') }}"
                                        width="183px" />
                                @endif
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (@$action . '' == 'edit')
                                <input type="hidden" name="event" value="edit_patient">
                            @endif
                            <input type="hidden" name="patient_id" value="{{ @$patient_id }}">
                            <input type="hidden" name="type" value="{{ @$type }}">
                            <input type="hidden" name="cid" value="{{ @$cid }}">

                            <input type="hidden" name="myHiddenField">
                            <div class="row">
                                <div class="col-12">

                                    <div class="form-group">
                                        <span class="col-form-label">
                                            <font size="2">Patient ID*</font>
                                        </span>
                                        <input type="text" name="hn" id="hn"
                                            class="form-control bg-white" value="{{ @$patient->hn }}"
                                            placeholder="HN" required
                                            @if (@$action . '' == 'edit') disabled @endif>
                                        {{-- <input id="hn" name="hn" type="text" class="form-control bg-white"
                                        value="{{ @$patient->hn }}" oninvalid="this.setCustomValidity('กรุณากรอก HN')"
                                        oninput="setCustomValidity('')" placeholder="HN" required
                                        onpaste="return false" @if (@$action . '' == 'edit') disabled @endif> --}}
                                        <div id="show_lang_in_here"></div>
                                    </div>
                                    <div class="form-group mt-5">
                                        <span class="col-form-label">
                                            <font size="2">Admit ID</font>
                                        </span>
                                        @if (isset($patient->an))
                                            {{ Form::text('an', $patient->an, ['class' => 'form-control', 'readonly', 'autocomplete', 'bg-white' => 'off']) }}
                                        @else
                                            {{ Form::text('an', '', ['class' => 'form-control', 'autocomplete' => 'off']) }}
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 mt-1">
            <div class="card">
                <div class="card-body">
                    <div class="ms-3 mb-5">
                        <h4 class=" text-blue"> {{ @$action_txt2 }} FORM</h4>
                        <div class="patient_suggestion text-danger" style="display: none">
                            *Patient ID นี้ <b>มีในระบบแล้ว</b> กรุณาตรวจสอบข้อมูล ก่อนกด Confirm
                        </div>
                    </div>
                    <div class="row m-0 cn">
                        <div class="col-2"><b class="text-blue h5 m-0">Name *</b></div>
                        <div class="col-2">

                            <input name="prefix" id="prefix" type="text"
                                class="form-control bg-gray-input savejson autotext ck_gender his_readonly"
                                value="{{ @$patient->prefix }}">
                        </div>
                        <div class=" @if (isset($patient->middlename) && $patient->middlename != 'col-') {{ 'col-2' }} @else{{ 'col-3' }} @endif"
                            id="first_name_col">
                            <input name="firstname" type="text" class="form-control bg-gray-input his_readonly"
                                id="first_name" value="{{ @$patient->firstname }}" required>
                        </div>
                        <div
                            class="col-2 text-middle-col  @isset($patient->middlename) @if ($patient->middlename != '')  {{ 'active' }} @endif @endisset">
                            <input name="middlename" type="text" class="form-control bg-gray-input his_readonly"
                                id="middlename" value="{{ @$patient->middlename }}">
                        </div>
                        <div class="@if (isset($patient->middlename) && $patient->middlename != 'col-') {{ 'col-2' }} @else{{ 'col-3' }} @endif"
                            id="last_name_col">
                            <input name="lastname" type="text" class="form-control bg-gray-input his_readonly"
                                value="{{ @$patient->lastname }}" id="last_name" required>

                        </div>
                        <div class="col-1 text-nowrap">
                            <label class="checkbox text-muted">
                                <input type="checkbox" class="form-check-input his_readonly" name="Checkboxes1"
                                    id="ck_middle"
                                    @isset($patient->middlename)@if ($patient->middlename != '') {{ 'checked' }} @endif @endisset />
                                <span class="text-index-dark"> &ensp; Middle Name</span>

                            </label>
                        </div>
                        <div class="row m-0 text-muted">
                            <div class=" mt-1 col-2 hide-res"></div>
                            <div class=" mt-1 col-2  text-gray text-nowrap">Prefix</div>
                            <div class=" mt-1 @if (isset($patient->middlename) && $patient->middlename != 'col-') {{ 'col-2' }} @else{{ 'col-3' }} @endif text-gray"
                                id="first_name_cols">First Name</div>
                            <div
                                class=" mt-1 col-2  text-middle-col @if (isset($patient->middlename) && $patient->middlename != '') {{ 'active' }} @else{{ '' }} @endif">
                                Middle Name</div>
                            <div class=" mt-1 @if (isset($patient->middlename) && $patient->middlename != 'col-') {{ 'col-2' }} @else{{ 'col-3' }} @endif text-gray"
                                id="last_name_cols">Last Name
                            </div>
                        </div>

                    </div>
                    <div class="row m-0 mt-5 pt-2 cn">
                        <div class="col-2">
                            <b class="text-blue h5 m-0">Date of birth *</b>
                        </div>
                        <div class="col-4">
                            @php
                                $bd_day = '';
                                $bd_month = '';
                                $bd_year = '';
                                $age = '';
                                if (isset($patient->birthdate)) {
                                    $bd = $patient->birthdate;
                                    $exp = explode('-', $bd);
                                    $bd_year = isset($exp[0]) ? intval($exp[0]) + 543 : '';
                                    $bd_month = isset($exp[1]) ? intval($exp[1]) : '';
                                    $bd_day = isset($exp[2]) ? intval($exp[2]) : '';

                                    $dob = strtotime(str_replace('/', '-', $bd));
                                    $tdate = time();
                                    $age = date('Y', $tdate) - date('Y', $dob);
                                }
                            @endphp
                            <div class="row m-0" id="set_date">
                                <div class="col-4 p-0">
                                    <select class='form-control his_readonly' name='birthday' id="birthday">
                                        @foreach ($day_all as $day)
                                            <option @if ($bd_day == $day) selected @endif
                                                value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class='form-control his_readonly' name='birthmonth' id="birthmonth">
                                        @foreach ($month_all as $month)
                                            <option @if ($bd_month == $month) selected @endif
                                                value="{{ $month }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4 p-0">
                                    {{-- @dd(1); --}}
                                    <select class='form-control his_readonly' name='birthyear' id="birthyear">
                                        @foreach ($year_all as $year)
                                            @php
                                                if (@$feature->year_thai) {
                                                    $year_custom = $year;
                                                } else {
                                                    $year_custom = $year - 543;
                                                }
                                                // dd($year_eng)
                                            @endphp
                                            <option @if ($bd_year == $year) selected @endif
                                                value="{{ $year }}">{{ $year_custom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 width-res">
                            <input name="age" type="number" id="agenew"
                                class="form-control width-res bg-gray-input his_readonly" {{-- @if (isset($bd_year)) 0 @else {{ @$age }} @endif --}}
                                value="{{ @$age }}" style="width: 95%" style="height: auto;" required>
                        </div>
                    </div>
                    <div class="row m-0 mt-1">
                        <div class="col-2"></div>
                        <div class="col-4">
                            <div class="row m-0 text-muted">
                                <div class="col-4 p-0 text-gray">Day</div>
                                <div class="col-4 text-gray">Month</div>
                                <div class="col-4 p-0 text-gray">Year</div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="text-muted">
                                <span class="text-gray">Age</span>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 mt-5 pt-2">
                        <div class="col-lg-2"><b class="text-blue h5 m-0">Gender *</b></div>
                        <div class="col">
                            <div class="radio-inline">
                                <label class="radio text-index-dark">
                                    <input type="radio" class="form-check-input gender auto_ckmale his_readonly"
                                        name="gender" id="male"
                                        @isset($patient->gender) @if ($patient->gender == 1) {{ 'checked ' }}  @endif @endisset
                                        value="1" required />
                                    <span></span>
                                    &emsp;Male&emsp;&emsp;
                                </label>
                                <label class="radio text-index-dark">
                                    <input type="radio" class="form-check-input gender auto_ckfemale his_readonly"
                                        name="gender" id="female"
                                        @isset($patient->gender) @if ($patient->gender == 2) {{ 'checked ' }}  @endif @endisset
                                        value="2" />
                                    <span></span>
                                    &emsp;Female&emsp;&emsp;
                                </label>
                                <label class="radio text-index-dark">
                                    <input type="radio" class="form-check-input gender his_readonly" name="gender "
                                        id="prefernottosay"
                                        @isset($patient->gender) @if ($patient->gender == 3) {{ 'checked ' }}  @endif @endisset
                                        value="3" />
                                    <span></span>
                                    &emsp;Prefer not to say&emsp;&emsp;
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 mt-5 pt-2">
                        <div class="col-2"><b class="text-blue h5 m-0">Contact</b></div>
                        <div class="col-3">
                            @if (isset($patient->phone))
                                {{ Form::text('phone', $patient->phone, ['class' => 'form-control bg-gray-input his_readonly']) }}
                            @else
                                {{ Form::text('phone', '', ['class' => 'form-control bg-gray-input his_readonly']) }}
                            @endif
                        </div>
                        <div class="col-4">
                            @if (isset($patient->email))
                                {{ Form::text('email', $patient->email, ['class' => 'form-control bg-gray-input his_readonly']) }}
                            @else
                                {{ Form::text('email', '', ['class' => 'form-control bg-gray-input his_readonly']) }}
                            @endif
                        </div>
                    </div>
                    <div class="row m-0 text-muted">
                        <div class="col-2"></div>
                        <div class="col-3 text-gray">Phone</div>
                        <div class="col-4 text-gray">Email</div>
                    </div>


                    <div class="row m-0 mt-2 pt-1">
                        <div class="col-2 align-self-center"><b class="text-blue h5 m-0">Allergy</b></div>
                        <div class="col-7">
                            @if (isset($patient->allergic))
                                {{ Form::text('allergic', $patient->allergic, ['class' => 'form-control bg-gray-input his_readonly']) }}
                            @else
                                {{ Form::text('allergic', '', ['class' => 'form-control bg-gray-input his_readonly']) }}
                            @endif
                        </div>

                    </div>
                    <div class="row m-0 mt-1 text-muted">
                        <div class="col-2"></div>
                        <div class="col-3 text-gray">Allegy</div>

                    </div>

                    <div class="form-row">
                        <div class="row">
                            <div class="col-auto">
                                @if (@$feature->citizencard)
                                    <button type="button" id="read_card"
                                        class="btn btn-danger btn-label waves-effect waves-light"
                                        onclick="read_idcard()">
                                        <i class="bx bx-id-card label-icon align-middle fs-16"></i> Read ID
                                        Card</button>
                                @endif
                            </div>
                            <div class="col"></div>
                            <div class="col-auto ">
                                @if (isset($action))
                                    @if ($action == 'edit')
                                        <a id="submit_btn" href="javascript:;"
                                            class="btn btn-primary btn-label waves-effect btn-loading  right waves-light"><i
                                                class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i>
                                            Confirm Edit</a>
                                    @endif
                                @else
                                    <input type="hidden" name="next" value="1">
                                    <a id="submit_btn" href="javascript:;"
                                        class="btn btn-primary btn-label waves-effect right waves-light btn-loading"><i
                                            class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i>
                                        Confirm</a>
                                @endif
                            </div>
                            <button id="warning_div" type="button" data-toast data-toast-text=""
                                data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000"
                                data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs"
                                style="display:none">Bottom Right</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $head = configTYPE('pdf', 'pdf_folder_head');
            $pathhispatient = $_SERVER['DOCUMENT_ROOT'] . "/config/views/his/$head/patient_get_detail.blade.php";
        @endphp
        @if (is_file($pathhispatient))
            @include("his.$head.patient_get_detail")
        @else
            @include('endo.patient.his.00000')
        @endif
    </div>



@endsection
@section('script')
    <script src="{{ url('public/js/jquery.input-dropdown.js') }}"></script>
    <script src="{{ url('public/js/patient/create.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>


    @if (@$his->patient_form_his)
        <script>
            document.querySelectorAll('.his_readonly').forEach((element) => {
                element.setAttribute('readonly', true);
                element.setAttribute('disabled', true);
            });
        </script>
    @endif




    <script>
        $(".ck_gender").focusout(function() {
            var this_val = $(this).val();
            if (this_val == "นางสาว" || this_val == "น.ส." || this_val == "นาง" || this_val == "MRS." || this_val ==
                "mrs." || this_val == "ด.ญ." || this_val == "นส." || this_val == "น.ส") {
                $(".auto_ckfemale").prop('checked', true);
            }
            if (this_val == "นาย" || this_val == "Mr." || this_val == "mr." || this_val == "ด.ช.") {
                $(".auto_ckmale").prop('checked', true);
            }
        })
    </script>
    <script type="text/javascript">
        $('.savejson').bind('focusout', function() {
            var this_id = $(this).attr('id');
            var this_type = $(this).attr('type');
            var procedure = 0;
            if (this_type == "checkbox") {
                $.post('{{ url('api/photomove') }}', {
                    event: 'savejson2',
                    name: this_id,
                    value: $(this).prop('checked'),
                    field: 'case_json',
                    procedure: procedure,
                }, function(data, status) {});
            } else {
                $.post('{{ url('api/photomove') }}', {
                    event: 'savejson2',
                    name: this_id,
                    value: $('#' + this_id).val(),
                    field: 'case_json',
                    procedure: procedure,
                }, function(data, status) {});
            }
        });

        $('.autotext').on('click keyup', function() {
            var this_id = $(this).attr('id');
            var this_value = $(this).val();
            $.post("{{ url('api/photo') }}", {
                event: 'jqinputdropdown',
                textid: this_id,
                value: this_value,
                procedure: 0,
            }, function(data, status) {
                dataList = [];
                dataList = JSON.parse(data);
                $('#' + this_id).inputDropdown(dataList, {
                    formatter: data => {
                        return `<li language="${data.value}">` + data.name + '</li>'
                    },
                    valueKey: 'language'
                });
                var wi = $('#' + this_id).css('width');
                $('.jq-input-dropdown').css({
                    'min-width': wi
                });
                $('#jq-input-dropdown_' + this_id).show();
                var html_li = "";
                dataList.forEach(obj => {
                    html_li += '<li language="' + obj['value'] + '">' + obj['value'] + '</li>';
                });
                $('#jq-input-dropdown_' + this_id).html(html_li);

                $('li').on('click', function() {
                    $('#' + this_id).focus();
                    // $('#jq-input-dropdown_'+this_id).remove();
                });
            });
        });

        $('html').keyup(function(e) {
            if (e.keyCode == 46) {
                $(":focus").each(function() {
                    var text = $(this).val();
                    $(this).val('');
                    $.post('{{ url('api/photomove') }}', {
                        event: 'delautotext',
                        text: text,
                        textid: this.id,
                        procedure: 0,
                    }, function(data, status) {});
                });
            }
        });

        $("#birthyear,#birthmonth,#birthday").change(function() {
            var age = calculate_age($("#birthday").val(), $("#birthmonth").val(), $("#birthyear").val())
            $("#agenew").val(age)
        });

        function calculate_age(day, month, year) {
            var now_str = moment().format("YYYY-MM-DD")
            var now = moment(`${now_str}`)
            var inp = moment(`${parseInt(year)-543}-${month}-${day}`)
            var age = now.diff(inp, 'years')
            return age
        }


        $("#agenew").on('keyup keypress blur change', function(e) {
            if ($(this).val() > 120) {
                $(this).val(120);
            }
            var date = {{ date('Y') }} + 543;
            var year = date - $(this).val();
            $("#birthyear").val(year);
        });


        $('#hn').focusout(check_patient);
        $('#hn').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault()
                check_patient()
            }
        });

        function check_patient() {
            let hn = $("#hn").val();
            let url = new URL(window.location.href);
            let historytaking = url.searchParams.get("historytaking");

            if (hn != "") {
                $(this).css("background-color", "#000000")
                $.post("{{ url('api/patient') }}", {
                    event: 'patient_check',
                    hn: hn.toString()
                }, function(d, s) {

                    let patient = JSON.parse(d);


                    if (patient.status) {
                        $('#hn').val('');
                        $('#patient_name').html(patient.firstname + ' ' + patient.lastname);
                        $('#patient_hn').html(patient.hn);
                        $('#mi-modal').modal('show');
                        if (historytaking) {
                            $('#opencase').attr('href', '{{ url('') }}/book/registration?hn=' + patient.hn +
                                '&historytaking=true');
                        } else {
                            $('#opencase').attr('href', '{{ url('') }}/registration/' + patient.mongoid);
                        }
                    } else {
                        hn_form_hisconnect(hn);
                        let status_formhis = hn_form_hisconnect(hn);
                        @if (@$his->patient_form_his)
                            if (status_formhis) {
                                $(".patient_suggestion").show();
                            } else {
                                $("#patient_hn_his").html(hn);
                                $('#modal_noinfo_his').modal('show');
                            }
                        @endif
                    }
                });
            }
        }

        $("#type_info").click(function(){
            document.querySelectorAll('.his_readonly').forEach((element) => {
                element.removeAttribute('readonly');
                element.removeAttribute('disabled');
            });

        })



        $("#ck_middle").click(function() {
            if ($(this).is(':checked')) {
                console.log('fffss');
                $('#first_name_col').removeClass('col-lg-3').addClass('col-lg-2')
                $('#last_name_col').removeClass('col-lg-3').addClass('col-lg-2')
                $('#first_name_cols').removeClass('col-lg-3').addClass('col-lg-2')
                $('#last_name_cols').removeClass('col-lg-3').addClass('col-lg-2')
                $('.text-middle-col').addClass('active')
            } else {
                console.log('ddddd');
                $('#first_name_col').removeClass('col-lg-2').addClass('col-lg-3')
                $('#last_name_col').removeClass('col-lg-2').addClass('col-lg-3')
                $('#first_name_cols').removeClass('col-lg-2').addClass('col-lg-3')
                $('#last_name_cols').removeClass('col-lg-2').addClass('col-lg-3')
                $('.text-middle-col').removeClass('active')
            }
        })


        $("#patient_test").click(function() {
            var this_age = Math.floor(Math.random() * 60);
            var m = new Date();
            var dateString = m.getUTCFullYear() + "" + ("0" + (m.getUTCMonth() + 1)).slice(-2) + "" + ("0" + m
                .getUTCDate()).slice(-2);
            $("#hn").val('TEST' + dateString);
            if ($("#first_name").val() != 'test') {
                $("#prefix").val('นาย')
                $("#first_name").val('test')
                $("#last_name").val('test')
                $("#agenew").val(this_age)
                $("[name= 'gender'][value='1']").attr('checked', true)
                $("#agenew").keyup()
            }
            $("#hn").focusout()
        })


        // submit button - prevent click more than once
        var submit_status = true
        $('#submit_btn').on('click', function() {
            let hn = $('#hn').val()
            let firstname = $('#first_name').val()
            let lastname = $('#last_name').val()
            let age = $('#agenew').val()
            let gender = $('input[name="gender"]:checked').val()
            let missing_data = []

            if (hn == "") {
                missing_data.push('Patient ID')
            }
            if (firstname == "") {
                missing_data.push('First Name')
            }

            if (lastname == "") {
                missing_data.push('Last Name')
            }

            if (age == "") {
                missing_data.push('Age')
            }

            if (gender == undefined || gender == "") {
                missing_data.push('Gender')
            }

            let warning_txt = 'กรุณาตรวจสอบข้อมูลในช่อง '
            missing_data.forEach((e, i) => {
                if (i == 0) {
                    warning_txt += e
                }
            })

            if (hn != "" && firstname != "" && lastname != "" && gender != undefined && age != "") {
                if (submit_status == true) {
                    $('#patient_form').submit()
                    submit_status = false
                }
            } else {
                $('#warning_div').attr('data-toast-text', warning_txt)
                $('#warning_div').click()
            }
        })
    </script>




@endsection
