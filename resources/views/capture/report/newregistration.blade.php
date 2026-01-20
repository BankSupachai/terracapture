{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')




@section('style')
    <style>
        .bold {
            font-weight: bold;
        }

        body {
            overflow-x: hidden;
        }

        .img-pos {
            padding: 20px !important;
        }

        .bg-create {
            background: #FEF2DF;
            height: 12em;
            margin-left: -2em;
            margin-right: -2em;

        }

        .text-register {
            color: #878A99;
            font-size: 16.5px;
            font-weight: 400;
        }

        .text-register2 {
            color: #192D48;
            font-size: 16px;
            font-weight: 400;
        }

        .text-register3 {
            color: #192D48;
            font-size: 19px;
            font-weight: 400;
            font-weight: bold;
        }

        .select2-container--default .select2-selection--multiple {
            background: #f3f6f9 !important;
        }
        .ptop{
            padding-top: 30px !important;
        }
    </style>
@endsection

@section('modal')
    <div class="modal fade" id="warning_modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <span id="warning_msg"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary ">Save Changes</button> --}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('capture.case.component.modal.modal_adddoctorregis')
    @include('capture.camera.modal.modal_progress_camera')
@endsection



@section('content')
    @include('capture.camera.obs.js_hotkey')
    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">

    {{-- <link rel="stylesheet" href="{{ url('public/css/registration/registration.css') }}" rel="stylesheet" type="text/css"> --}}
    {{-- <link rel="stylesheet" href="{{ url('public/css/choice.base.min.css') }}" type="text/css"> --}}
    {{-- <link href="{{ url('public/css/zoomify.css') }}" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="{{ url('public/extra/fileinput/fileinput.css') }}" rel="stylesheet" type="text/css"> --}}

    <input type="hidden" id="tabselect" value="0">

    {{-- @dd(1) --}}
    {{-- @section('title-left')
    <h4 class="mb-sm-0">APPOINTMENT</h4>
@endsection --}}

    {{-- @section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Cases List</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection --}}



    @php
        $gender = '-';
        if (isset($patient->gender)) {
            $gen = $patient->gender;
            if ($gen == 1) {
                $gender = 'Male';
            } elseif ($gen == 2) {
                $gender = 'Female';
            }
        }
    @endphp
    {{-- @dd($patient) --}}

    <div class="row">

        <div class="card bg-create ms-1">
            <div class="card-body ms-5">
                <div class="row m-0">
                    <input name="patientid" type="hidden" value="{{ $id }}">
                    <input name="useropen" type="hidden" value="{{ @uid() }}">
                    <input name="hn" type="hidden" value="{{ $patient->hn }}">
                    <div class="col-1">
                        <img id="imgnew" src="{{ asset('public/images/usericon.png') }}" width="100px" />
                    </div>
                    <div class="col-9 mt-3">
                        <span class="h3 "> {{ $patient->hn }}</span>
                        <span
                            class="h3">{{ check_val($patient->firstname, 'ไม่มีข้อมูล') . ' ' . @$patient->middlename . ' ' . $patient->lastname }}
                            ({{ age(@$patient->birthdate, 'ไม่มีข้อมูล') }}) </span>
                        <div class="d-block mt-3 ">
                            <span class=" text-register">Gender : {{ check_val($gender, 'ไม่มีข้อมูล') }}&ensp; │</span>
                            &ensp;
                            <span class=" text-register fw-normal">Date of Birth: {{ @$patient->birthdate }} &ensp; │
                                &ensp;</span>
                            <span class=" text-register fw-normal">Tel: {{ check_val($patient->phone, '-') }} &ensp; │
                                &ensp;</span>
                            <span class=" text-register fw-normal">E-mail: {{ check_val($patient->email, '-') }} &ensp;
                                &ensp;</span>
                        </div>
                    </div>
                    <div class="col-2 mt-4 text-end">
                        <a class="btn btn-primary btn-load"
                            href="{{ url('patient/' . @$patient->id . '/edit?type=registration&cid=' . @$patient->id) }}">Edit
                            Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="card " style="margin-top: -4.5em; margin-left: 4px;">
            <div class="card-body">
                <form action="{{ url('api/registration') }}" method="post" id="regis_form" autocomplete="off">
                    @csrf
                    <input name="hn" type="hidden" value="{{ $patient->hn }}">
                    <input name="useropen" type="hidden" value="{{ @uid() }}">
                    <input name="capture" type="hidden" value="true">
                    <span class="text-register3">Appointment Form </span>
                    <div class="row mt-5 mb-0">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <span class="text-register2">Operation Date/Time</span> <span
                                        class="text-danger fs-19">*</span>
                                </div>

                                <div class="col-3 mb-0">
                                    @isset($_GET['book'])
                                        <input name="book" type="hidden" value="true">
                                        <input id="meet_date" name="meet_date" type="text"
                                            class="form-control flatpickr-input " data-provider="flatpickr"
                                            data-date-format="Y-m-d" readonly="readonly" value="" required>
                                    @else
                                        <input id="meet_date" name="meet_date" type="text"
                                            class="form-control flatpickr-input" data-provider="flatpickr"
                                            data-date-format="Y-m-d" readonly="readonly" value="{{ $today }}" required>
                                    @endisset
                                </div>
                                <div class="col-2">
                                    <select name='meet_hour' class='form-control text' style='width:100%'
                                        id='meet_hour'>
                                        @for ($i = 0; $i < 24; $i++)
                                            @php
                                                $select = '';
                                                $num = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                if ($num == @$time[0]) {
                                                    $select = 'selected';
                                                }
                                            @endphp
                                            <option value='{{ $num }}'
                                                @if ($num == '08') selected @endif>
                                                {{ $num }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-2">
                                    <select name='meet_minute' class='form-control text' style='width:100%'
                                        id='meet_minute'>
                                        @for ($i = 0; $i < 60; $i++)
                                            @php
                                                $select = '';
                                                $num = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                if ($num == @$time[0]) {
                                                    $select = 'selected';
                                                }
                                            @endphp
                                            <option value='{{ $num }}'
                                                @if ($num == '00') selected @endif>
                                                {{ $num }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row ptop">
                                <div class="col-3">
                                    <span class="text-register2">Urgent </span>
                                </div>
                                <div class="col-7">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="case_urgent" id="urgent_elective" value="elective">
                                        <label class="form-check-label" for="urgent_elective">
                                            Elective
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="case_urgent" id="urgent_urgency" value="urgency">
                                        <label class="form-check-label" for="urgent_urgency">
                                            Urgency
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="case_urgent" id="urgent_emergency" value="emergency">
                                        <label class="form-check-label" for="urgent_emergency">
                                            Emergency
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row ptop">
                                <div class="col-3">
                                    <span class="text-register2">Procedure</span> <span class="text-danger fs-19">*</span>
                                </div>
                                <div class="col-7">
                                    <select name="case_procedurecode[]" id="sel_procedure" multiple="multiple" required>
                                        @foreach ($procedure as $data)
                                            <option value="{{ $data->code }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="row ptop">
                                <div class="col-3">
                                    <span class="text-register2">Physician</span> <span class="text-danger fs-19">*</span>
                                </div>
                                <div class="col-7">
                                    <select class="form-control select2" id="sel_endoscopist" name="case_physicians01"
                                        required>
                                        <option></option>
                                        @foreach ($doctor_select as $data)
                                            <option value="{{ $data->uid }}">
                                                {{ $data->user_prefix }}{{ $data->user_firstname }}
                                                {{ $data->user_lastname }} {{ $data->user_code }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1 ps-0" style="margin-left: -48px;">
                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"
                                        style="border-radius: 0 8px 8px 0" data-bs-toggle="modal"
                                        data-bs-target="#modal_adddoctor">
                                        <i class="ri-user-add-line"></i>
                                    </button>
                                </div>

                            </div>
                            <div class="row m-0">
                                <div class="col-2"></div>
                                <div class="col-4">
                                    <span id="alert_physician" class="text-danger" style="display: none;">&ensp;
                                        โปรดเลือกแพทย์</span>
                                </div>
                            </div>
                            <div class="row ptop">
                                <div class="col-3">
                                    <span class="text-register2">Attendant</span>
                                </div>
                                <div class="col-7">
                                    <select name="user_in_case[]" id="sel_users" multiple="multiple">
                                        @php
                                            $lists = [];
                                            if (isset($case->user_in_case)) {
                                                $lists = $case->user_in_case;
                                                $user_list = Mongo::table('users')->whereIn('uid', $lists)->get();
                                            }
                                        @endphp

                                        {{-- Doctor Group --}}
                                        @if (isset($doctor_select) && count($doctor_select) > 0)
                                            <optgroup label="Doctor">
                                                @foreach ($doctor_select as $index => $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $is_attendant = in_array($data->uid, $lists) ? 'true' : 'false';
                                                    @endphp
                                                    <option value="{{ @$data->uid }}"
                                                        data-tokens="{{ @$data->uid }}"
                                                        data-name="{{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}"
                                                        data-type="{{ @$data->user_type }}"
                                                        data-tab="{{ @$data->uid }}"
                                                        data-index="{{ @$index }}"
                                                        {{ in_array($data->uid, $lists) ? 'selected' : '' }}>
                                                        {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{ @$data->user_code }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif

                                        {{-- Nurse Group --}}
                                        @if (isset($nurse_select) && count($nurse_select) > 0)
                                            <optgroup label="Nurse">
                                                @foreach ($nurse_select as $index => $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $is_attendant = in_array($data->uid, $lists) ? 'true' : 'false';
                                                    @endphp
                                                    <option value="{{ @$data->uid }}"
                                                        data-tokens="{{ @$data->uid }}"
                                                        data-name="{{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}"
                                                        data-type="{{ @$data->user_type }}"
                                                        data-tab="{{ @$data->uid }}"
                                                        data-index="{{ @$index }}"
                                                        {{ in_array($data->uid, $lists) ? 'selected' : '' }}>
                                                        {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{ @$data->user_code }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif

                                        {{-- Register Group --}}
                                        @if (isset($register_select) && count($register_select) > 0)
                                            <optgroup label="Register">
                                                @foreach ($register_select as $index => $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $is_attendant = in_array($data->uid, $lists) ? 'true' : 'false';
                                                    @endphp
                                                    <option value="{{ @$data->uid }}"
                                                        data-tokens="{{ @$data->uid }}"
                                                        data-name="{{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}"
                                                        data-type="{{ @$data->user_type }}"
                                                        data-tab="{{ @$data->uid }}"
                                                        data-index="{{ @$index }}"
                                                        {{ in_array($data->uid, $lists) ? 'selected' : '' }}>
                                                        {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{ @$data->user_code }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif

                                        {{-- Anesthesia Group --}}
                                        @if (isset($anes_select) && count($anes_select) > 0)
                                            <optgroup label="Anesthesia">
                                                @foreach ($anes_select as $index => $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $is_attendant = in_array($data->uid, $lists) ? 'true' : 'false';
                                                    @endphp
                                                    <option value="{{ @$data->uid }}"
                                                        data-tokens="{{ @$data->uid }}"
                                                        data-name="{{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}"
                                                        data-type="{{ @$data->user_type }}"
                                                        data-tab="{{ @$data->uid }}"
                                                        data-index="{{ @$index }}"
                                                        {{ in_array($data->uid, $lists) ? 'selected' : '' }}>
                                                        {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{ @$data->user_code }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif

                                        {{-- Nurse Anes Group --}}
                                        @if (isset($nurse_anes_select) && count($nurse_anes_select) > 0)
                                            <optgroup label="Nurse Anesthesia">
                                                @foreach ($nurse_anes_select as $index => $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $is_attendant = in_array($data->uid, $lists) ? 'true' : 'false';
                                                    @endphp
                                                    <option value="{{ @$data->uid }}"
                                                        data-tokens="{{ @$data->uid }}"
                                                        data-name="{{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}"
                                                        data-type="{{ @$data->user_type }}"
                                                        data-tab="{{ @$data->uid }}"
                                                        data-index="{{ @$index }}"
                                                        {{ in_array($data->uid, $lists) ? 'selected' : '' }}>
                                                        {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{ @$data->user_code }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif

                                        {{-- Nurse Assistant Group --}}
                                        @if (isset($nurse_assistant_select) && count($nurse_assistant_select) > 0)
                                            <optgroup label="Nurse Assistant">
                                                @foreach ($nurse_assistant_select as $index => $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $is_attendant = in_array($data->uid, $lists) ? 'true' : 'false';
                                                    @endphp
                                                    <option value="{{ @$data->uid }}"
                                                        data-tokens="{{ @$data->uid }}"
                                                        data-name="{{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}"
                                                        data-type="{{ @$data->user_type }}"
                                                        data-tab="{{ @$data->uid }}"
                                                        data-index="{{ @$index }}"
                                                        {{ in_array($data->uid, $lists) ? 'selected' : '' }}>
                                                        {{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }} {{ @$data->user_code }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-2"></div>
                            </div>





                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-3">
                                    <span class="text-register2">Location</span>
                                </div>
                                <div class="col-3">
                                    <input type="text" placeholder="Ward"
                                        class="form-control bg-gray-input autotext savejson" style="font-size: 14px;" name="ward"
                                        id="ward">
                                </div>
                                <div class="col-3">
                                    <input type="text" placeholder="OPD"
                                        class="form-control bg-gray-input autotext savejson" style="font-size: 14px;" name="opd"
                                        id="opd">
                                </div>
                                <div class="col-3">
                                    <input type="text" placeholder="Refer"
                                        class="form-control bg-gray-input autotext savejson" style="font-size: 14px;" name="refer"
                                        id="refer">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-3">
                                    <span class="text-register2">Treatment coverage</span>
                                </div>
                                <div class="col-9">
                                    <select class="select2" style="font-size: 14px; " id="sel_treatmentcoverage" name="treatment_coverage">
                                        <option></option>
                                        @foreach ($tb_treatmentcoverage as $data)
                                            <option value="{{ $data->name }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row mt-4">
                                <div class="col-3">
                                    <span class="text-register2">Anesthesia</span>
                                </div>

                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input savejson" type="checkbox"
                                                    name="anesthesia[]" id="anesthesia_topical" value="Topical">
                                                <label class="form-check-label" for="anesthesia_topical">
                                                    Topical
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input savejson" type="checkbox"
                                                    name="anesthesia[]" id="anesthesia_iv_sedation" value="IV Sedation">
                                                <label class="form-check-label" for="anesthesia_iv_sedation">
                                                    IV Sedation
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input savejson" type="checkbox"
                                                    name="anesthesia[]" id="anesthesia_tracheostomy" value="Tracheostomy">
                                                <label class="form-check-label" for="anesthesia_tracheostomy">
                                                    Tracheostomy
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input savejson" type="checkbox"
                                                    name="anesthesia[]" id="anesthesia_tiva" value="TIVA">
                                                <label class="form-check-label" for="anesthesia_tiva">
                                                    TIVA
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check">
                                                <input class="form-check-input savejson" type="checkbox"
                                                    name="anesthesia[]" id="anesthesia_mac" value="MAC">
                                                <label class="form-check-label " for="anesthesia_mac">
                                                    MAC
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input savejson" type="checkbox"
                                                    name="anesthesia[]" id="anesthesia_et_intubation" value="ET Intubation">
                                                <label class="form-check-label" for="anesthesia_et_intubation">
                                                    ET Intubation
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-3"></div>
                                <div class="col-9">
                                    <input type="text" class="form-control bg-gray-input autotext savejson" style="font-size: 14px;"
                                        name="anesthesiaother" id="anesthesiaother" placeholder="Other Anesthesia">
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-3">
                                    <span class="text-register2">Pre-Diagnosis</span>
                                </div>
                                <div class="col-9">
                                    <input type="text" class="form-control bg-gray-input autotext savejson" style="font-size: 14px;"
                                        name="prediagnosis_other" id="prediagnosis_other">
                                </div>
                            </div>

                        <div class="row mt-5 justify-content-end">
                            <div class="col-auto d-flex justify-content-end mt-5">
                                <a href="javascript:;" id="submit_btn" name="next" value="1"
                                    class="btn btn-primary btn-loading btn-label waves-effect right waves-light">
                                    <i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i>
                                    Confirm
                                </a>
                            </div>
                        </div>

                        <button style="display:none" id="warning_div" type="button" data-toast data-toast-text=""
                            data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000"
                            data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs">Bottom
                            Right</button>
                    </div>
                </form>
            </div>


        </div>

    </div>

@endsection

@section('script')
    @include('capture.alltest.esc_registration')
    <script>
        $(document).ready(function() {
            // Save form values to localStorage when they change
            function saveFormValues() {
                const formData = {
                    meet_date: $('#meet_date').val(),
                    meet_hour: $('#meet_hour').val(),
                    meet_minute: $('#meet_minute').val(),
                    case_urgent: $('input[name="case_urgent"]:checked').val() || '',
                    case_procedurecode: $('#sel_procedure').val(),
                    case_physicians01: $('#sel_endoscopist').val(),
                    user_in_case: $('#sel_users').val(),
                    treatment_coverage: $('#sel_treatmentcoverage').val(),
                    ward: $('#ward').val(),
                    opd: $('#opd').val(),
                    refer: $('#refer').val(),
                    prediagnosis_other: $('#prediagnosis_other').val()
                };
                localStorage.setItem('registrationFormData', JSON.stringify(formData));
            }

            // Restore form values from localStorage
            function restoreFormValues() {
                const savedData = localStorage.getItem('registrationFormData');
                if (savedData) {
                    const formData = JSON.parse(savedData);

                    // Restore values for each field
                    $('#meet_date').val(formData.meet_date);
                    $('#meet_hour').val(formData.meet_hour);
                    $('#meet_minute').val(formData.meet_minute);

                    // Restore urgent radio button
                    if (formData.case_urgent) {
                        $('input[name="case_urgent"][value="' + formData.case_urgent + '"]').prop('checked', true);
                    }

                    $('#sel_procedure').val(formData.case_procedurecode).trigger('change');
                    $('#sel_endoscopist').val(formData.case_physicians01).trigger('change');
                    $('#sel_users').val(formData.user_in_case).trigger('change');
                    $('#sel_treatmentcoverage').val(formData.treatment_coverage).trigger('change');
                    $('#ward').val(formData.ward);
                    $('#opd').val(formData.opd);
                    $('#refer').val(formData.refer);
                    $('#prediagnosis_other').val(formData.prediagnosis_other);

                    // Update background colors for filled fields
                    $('.form-control').each(function() {
                        if ($(this).val()) {
                            $(this).css('background', '#d2ebf6');
                        }
                    });
                }
            }

            // Save form values when any field changes
            $('select, input').on('change keyup', function() {
                saveFormValues();
            });

            // Restore values when page loads
            restoreFormValues();

            // Clear localStorage when form is successfully submitted
            $('#regis_form').on('submit', function() {
                localStorage.removeItem('registrationFormData');
            });

            $(".btn-loading").click(function() {
                if ($(this).closest('form')[0].checkValidity()) {
                    $(this).addClass('disabled');
                    $(this).html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &ensp; Loading...'
                    );
                }
            });
            $(".btn-load").click(function() {
                $(this).addClass('disabled');
                $(this).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &ensp; Loading...'
                );
                setTimeout(() => {
                    $(this).removeClass('disabled');
                }, 3000);
            });
            $(".btn-loadicon").click(function() {
                $(this).addClass('disabled');
                $(this).html(
                    '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                );
                setTimeout(() => {
                    $(this).removeClass('disabled');
                }, 3000);
            });
        });
    </script>
    <script>
        $('#meet_date').datepicker({
            format: "yyyy-mm-dd",

        });
    </script>


    <script src="{{ url('public/js/jquery.input-dropdown.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#sel_users").select2({
                placeholder: "Select Attendant",
                allowClear: true
            });

            $('#sel_users').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(200);
                });
            });
            $("#sel_treatmentcoverage").select2({
                placeholder: "Select a Treatment coverage",
                allowClear: true
            });
            $('#sel_treatmentcoverage').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(200);
                });
            });
            $("#sel_procedure").select2({
                placeholder: "Select Procedure",
                allowClear: true
            });

            $('#sel_procedure').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(200);
                });
            });

            $("#sel_endoscopist").select2({
                placeholder: "Select Physician",
                allowClear: true
            });
            $('#sel_endoscopist').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(200);
                });
            });
        });
    </script>
    <script>
        var submit_status = true
        $("#submit_btn").click(function() {

            var check_physician = $("#sel_endoscopist").val();
            var check_procedure = $("#sel_procedure").val();
            var meet_date = $('#meet_date').val()
            var meet_hour = $('#meet_hour').val()
            var missing_data = []

            if (meet_hour == "") {
                missing_data.push('Operation Date')
            }

            if (meet_date == "") {
                missing_data.push('Operation Time')
            }

            if (check_procedure.length == 0) {
                missing_data.push('Procedure')
            }

            if (check_physician == "") {
                missing_data.push('Physician')
            }

            let warning_txt = 'กรุณาตรวจสอบข้อมูลในช่อง '
            missing_data.forEach((e, i) => {
                if (i == 0) {
                    warning_txt += e
                }
            })

            if (check_physician != "" && check_procedure.length != 0 && meet_date != "" && meet_hour != "") {
                if (submit_status == true) {
                    $('#regis_form').submit()
                    submit_status = false
                }
            } else {
                $('#warning_div').attr('data-toast-text', warning_txt)
                $('#warning_div').click()
            }

        });


        $("#sel_endoscopist").change(function() {
            $(this).removeClass('border-danger')
        })
        $('#sel_procedure').change(function() {
            $(this).removeClass('border-danger')
        })

        $('.autotext').on('click keyup', function() {
            var procedure = 0;
            var this_id = $(this).attr('id');
            var this_value = $(this).val();
            $.post("{{ url('api/photo') }}", {
                event: 'jqinputdropdown',
                textid: this_id,
                value: this_value,
                procedure: procedure,
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
                });
            });
        });



        $('.savejson').bind('focusout', function() {
            var this_id = $(this).attr('id');
            var this_type = $(this).attr('type');
            var procedure = "";
            var check = $('#sel_procedure').val();
            if (check != "") {
                procedure = check;
            } else {
                procedure = 0;
            }

            if (this_type == "checkbox") {
                $.post('{{ url('api/photomove') }}', {
                    event: 'savejson2',
                    name: this_id,
                    value: $(this).prop('checked'),
                    field: 'case_json',
                    procedure: "0",
                }, function(data, status) {});
            } else {
                $.post('{{ url('api/photomove') }}', {
                    event: 'savejson2',
                    name: this_id,
                    value: $('#' + this_id).val(),
                    field: 'case_json',
                    procedure: "0",
                }, function(data, status) {});
            }
        });

        $('input[type=text]').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css('background', '#d2ebf6');
            } else {}
        });
        $('select').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css('background', '#d2ebf6');
            } else {}
        });
        $('input[type=number]').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css('background', '#d2ebf6');
            } else {}
        });
        $('textarea').each(function() {
            if ($(this).text() != '' && $(this).text() != null) {
                $(this).css('background', '#d2ebf6');
            } else {}
        });
        $('.form-control').focusout(function() {
            var text_val = $(this).val();
            if (text_val != null && text_val != '') {
                $(this).css('background', '#d2ebf6');
            } else {
                $(this).css('background', 'none');
            }
        })
    </script>
    <script>
        $("#sel_users").change(function() {
            var value = $(this).val()
            var select = $("#sel_users option[value='" + value + "']");
            var type = select.attr('data-type');
            var names = select.attr('data-name')
            var tab = select.attr('data-tab');
            var array_data = "";
            if (value != []) {
                list_user_save(value)
            }
        });

        function list_user_save(data_array) {
            var my_json = JSON.stringify(data_array)
            $("#user_in_case").val(my_json)
            $("#user_in_case").focusout();
        }

        function del_list(data) {
            $("div[sub-tab='" + data + "'").remove()
        }
    </script>

    @php
        $head = configTYPE('pdf', 'pdf_folder_head');
        $pathhispatient = $_SERVER['DOCUMENT_ROOT'] . "/config/views/his/$head/user_get_detail.blade.php";
    @endphp

    @if (is_file($pathhispatient))
        @include("his.$head.user_get_detail")
    @else
        @include('endo.patient.his.00000')
    @endif
@endsection


@include('admin.pagedetail')
