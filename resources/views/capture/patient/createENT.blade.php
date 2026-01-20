{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
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
        .fs-15 {
            font-size: 15px;
        }
        .fs-20 {
            font-size: 20px;
        }

        .modal-lg,
        .modal-xl {
            --vz-modal-width: 812px;
        }

        .col-2-5 {
            width: 20.8333%;
        }

        .col-0-5 {
            flex: 0 0 4.16667%;
            max-width: 4.16667%;
        }

        .col-1-5 {
            width: 12.5%;
        }

        .bg-dark-primary {
            background-color: #192d4b !important;
        }
        .icon-box-camera {
            background: #ffffff;
            width: 95px;
            height: 95px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2B67E9;
            border-radius: 50%;
            margin: 0 auto;
        }

        .border-bottom {
            border-bottom: 1px dashed #D9D9D9 !important;
        }

        /* ปรับระยะห่างแนวตั้งของ input และ row ให้เหมาะสม */
        #tb_create .row {
            margin-bottom: 1.2rem;
        }

        #tb_create .col-12,
        #tb_create .col-md-4,
        #tb_create .col-md-6,
        #tb_create .col-md-2 {
            margin-bottom: 1rem;
        }

        #tb_create input,
        #tb_create select {
            margin-bottom: 0.5rem;
        }

        /* เพิ่ม style สำหรับ radio button */
        .form-check-input:checked {
            background-color: #2B67E9;
            border-color: #2B67E9;
        }

        .form-check-input:focus {
            border-color: #2B67E9;

        }

        /* เพิ่ม media query สำหรับ responsive zoom 125% */
        @media (max-width: 1400px) {
            .fs-26 {
                font-size: 1.1rem !important;
            }

            .fs-18 {
                font-size: 0.95rem !important;
            }

            .form-control,
            .form-select {
                font-size: 1rem !important;
            }

            .btn-create-submit {
                font-size: 1rem !important;
            }

            .icon-box-camera {
                width: 55px;
                height: 55px;
            }

            #tb_create .col-4,
            #tb_create .col-6,
            #tb_create .col-3,
            #tb_create .col-2 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            #tb_create .row {
                flex-wrap: wrap;
                margin-bottom: 1.2rem;
            }
        }

        html, body {
            overflow: hidden !important;
            height: 100%;
        }

        .input-blur {
            background-color: rgb(210, 235, 246) !important;
            transition: background 0.2s;
        }
        .btn-create-submit{
        background: #2B67E9;
        width: 90%;
        height: 60%;
        color: white;
        margin-bottom: 1em;
        margin-top: 21px;

        border : none;
        border-radius: 5px !important;

    }
    .page-content{
        padding-top:2em !important;
    }

    .select2-container--default .select2-selection--multiple {
    background: #f3f6f9 !important;
    border: 0px !important;
}
.select2-container .select2-search--inline .select2-search__field {
    height: 29px !important;
}
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('public/css/patient/create.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('modal')

@endsection
@section('content')

@section('title-left')
    @php
        $action_txt = @$action . '' == 'edit' ? 'Edit' : 'Create';
        $action_txt2 = @$action . '' == 'edit' ? 'EDIT' : 'REGISTRATION';
    @endphp
    <h4 class="mb-sm-0">{{ @$action_cap }}</h4>
@endsection
@include('capture.case.component.modal.modal_adddoctor')

<div class="row page-record">
        <div class="col-lg-12 mt-4">
            <div class="card  card-record rounded-0  h-100">
                <div class="card-body px-0 ">
                    <div class="row ms-2">
                        <div class="col-6 " style="font-size: 22px;"><b>Registration Form</b> </div>
                        <div class="col-6 text-end fs-20 mt-2" id="current-date"></div>

                    </div>
                    <div class="row m-0 pb-2 ms-2 mt-3">
                        <div class="col-6 fs-16 text-muted">“Please fill in the required fields below to complete the registration process ..“</div>
                        <div class="col-6 text-end fs-20" id="current-time"></div>

                    </div>
                    <div class="border-bottom w-100 mt-3"></div>
                    <div class="ms-4">
                        <form action="{{ url('patientent') }}" method="post">
                            @csrf
                            <input type="hidden" name="event" value="patient_create">


                            <div class="row mt-2 m-0">
                                <div class="col">
                                    <table class="table table-borderless" id="tb_create">
                                        <div class="row row-gap mt-4">
                                            <div class="col-md-3 col-12 fs-19 tx-center" style="font-weight: 500;">
                                                Patient ID <span class="text-danger">*</span>
                                            </div>
                                            <div class="col-md-2 col-12 fs-19 tx-center" style="font-weight: 500;">
                                                Patient Name
                                            </div>
                                            <div class="col-md-3 col-12 fs-22 tx-center" style="font-weight: 500;">

                                            </div>
                                            <div class="col-md-3 col-12 fs-22 tx-center" style="font-weight: 500;">

                                            </div>
                                            <div class="row">
                                            <div class="col-3 mb-5">
                                                <input id="txt_hn" type="text" class="form-control fs-15" name="hn"
                                                placeholder="HN" autocomplete="off" autofocus onblur="check_hn()" oninput="validateHN(this)" required pattern="[0-9\-]+"
                                                title="กรุณากรอกเฉพาะตัวเลขหรือเครื่องหมายขีดกลาง">
                                            </div>


                                            <div class="col-md-2 col-12 mb-5">
                                                <input type="text" class="form-control fs-15" placeholder="Prefix"
                                                    autocomplete="off" name="prefix" id="prefix">
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <input type="text" class="form-control fs-15" placeholder="Firstname"
                                                    autocomplete="off" name="firstname">
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <input type="text" class="form-control fs-15" placeholder="Lastname"
                                                    autocomplete="off" name="lastname"
                                                    value="">
                                            </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-md-3 col-12 ms-1">
                                                    <div class="ps-0 fs-19" style="font-weight: 500;">
                                                        Gender
                                                    </div>
                                                    <div class="row mt-2 fs-15">
                                                        <div class="col-4">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="male" value="1">
                                                                <label class="form-check-label" for="male">
                                                                    Male
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="gender" id="female" value="2">
                                                                <label class="form-check-label" for="female">
                                                                    Female
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ps-0">
                                                    <div class="ps-0 fs-19" style="font-weight: 500;">
                                                        DOB
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 ps-0">
                                                            <select name="birthdate" class="form-control fs-15 input-blur">
                                                                <option value="01">01</option>
                                                                <option value="02">02</option>
                                                                <option value="03">03</option>
                                                                <option value="04">04</option>
                                                                <option value="05">05</option>
                                                                <option value="06">06</option>
                                                                <option value="07">07</option>
                                                                <option value="08">08</option>
                                                                <option value="09">09</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                                <option value="24">24</option>
                                                                <option value="25">25</option>
                                                                <option value="26">26</option>
                                                                <option value="27">27</option>
                                                                <option value="28">28</option>
                                                                <option value="29">29</option>
                                                                <option value="30">30</option>
                                                                <option value="31">31</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <select name="birthmonth" class="form-control fs-15 input-blur">
                                                                <option value="01">01</option>
                                                                <option value="02">02</option>
                                                                <option value="03">03</option>
                                                                <option value="04">04</option>
                                                                <option value="05">05</option>
                                                                <option value="06">06</option>
                                                                <option value="07">07</option>
                                                                <option value="08">08</option>
                                                                <option value="09">09</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-5">
                                                            <select name="birthyear" id="birthyear" class="form-control fs-15 input-blur" onchange="syncAgeFromYear()">
                                                                <?php
                                                                    $currentYear = date('Y');
                                                                    for ($y = 2025; $y >= 1950; $y--) {
                                                                        $selected = ($y == $currentYear) ? 'selected' : '';
                                                                        echo "<option value=\"$y\" $selected>$y</option>";
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-12">
                                                    <div class="fs-19" style="font-weight: 500;">
                                                        Age
                                                    </div>
                                                    <input type="text" class="form-control fs-15" placeholder="Age" name="age" id="age"
                                                        oninput="syncYearFromAge()" value="0">
                                                </div>
                                                <div class="col-2">
                                                    <div class="fs-19" style="font-weight: 500; margin-top: 40px;">
                                                        Year
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row mb-4 ms-2">
                                                <div class="col-md-3 col-12 me-2 ps-0 fs-19" style="font-weight: 500;">
                                                    Operation Date
                                                </div>
                                                <div class="col-md-6 col-12 ps-0 fs-19" style="font-weight: 500;">
                                                    Procedure
                                                </div>
                                                <div class="col-2"></div>
                                                <div class="col-md-3 col-12 me-2 ps-0 fs-19" wire:ignore>
                                                       <input type="date" class="form-control fs-15" name="meet_date" value="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="col-md-5 col-12 ps-0 fs-19" wire:ignore>
                                                    <select name="case_procedurecode" class="form-control fs-15">
                                                        <option value="gi073" selected>ENT</option>
                                                        @foreach ($procedure as $data)
                                                            <option value="{{ $data->code }}">{{ $data->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="row mb-4 ms-2 mt-3">
                                                <div class="col-2 ps-0 fs-19">
                                                    Physician :
                                                </div>
                                                <div class="col-7 ps-0 fs-19">
                                                    <select id="physician" name="case_physicians01" class="form-control fs-15">
                                                        <option value=""></option>
                                                        @foreach ($physician as $data)
                                                            <option value="{{ $data->uid }}">{{ $data->user_prefix }} {{ $data->user_firstname }} {{ $data->user_lastname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-2">
                                                    <button type="button" class="btn" style="background-color: #192D4B2D; color: #192D4B; border: none; border-radius: 5px; padding: 6px 10px; display: flex; align-items: center; gap: 8px;"
                                                    data-bs-toggle="modal" data-bs-target="#modal_adddoctor">
                                                        <i class="ri-user-add-line" style="font-size: 18px;"></i>
                                                        <span style="font-size: 16px; font-weight: 500;">+Add</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row mb-4 ms-2">
                                                <div class="col-2 ps-0 fs-19">
                                                    Attendant :
                                                </div>
                                                <div class="col-8 ps-0 fs-19">
                                                    <select id="attendant" name="user_in_case[]" class="form-select fs-15" multiple>
                                                        @foreach ($attendant as $data)
                                                            <option value="{{ $data->uid }}">{{ $data->user_prefix }} {{ $data->user_firstname }} {{ $data->user_lastname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </table>
                                </div>
                                <div class="col-3" style="font-size: 1.6rem;">
                                    <button type="submit"  class="btn-create-submit rounded-0"
                                    value="save_start"
                                    name="action"
                                      style="height: 400px;">
                                        <div class="icon-box-camera mb-4">
                                            <i class="ri-camera-fill ri-2x"></i>
                                        </div>
                                        Click
                                        <p class="m-0 fs-26">Start Procedure</p>

                                    </button>
                                    <button type="submit"
                                        name="action"
                                        value="save_and_back"
                                        class="btn btn-soft-success p-3 mt-1"
                                        style="border-radius: 5px; height: 60px; margin-top: -15px !important; font-size: 1.2rem; width: 90%;">
                                        Save & Back
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>




            <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
            <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
            <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
            <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
            <script src="{{ url('public/recorder/jquery.min.js') }}"></script>
            <script src="{{ url('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>


        </div>


@endsection



@section('script')

    <script src="{{ url('public/js/jquery.input-dropdown.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>

        <script>
                $("#btn_save_and_back").click(function() {
                    alert("save and back");
                    $.ajax({
                        url: "{{ url('patientent') }}",
                        type: "POST",
                        data: {
                            event: "patient_create"
                        },
                    });
                });
                $("#btn_startprocedure").click(function() {
                alert("start procedure");
                $.ajax({
                    url: "{{ url('patientent') }}",
                    type: "POST",
                    data: {
                        event: "patient_create"
                    },
                });
            });
        </script>



    <script>
        $(document).ready(function() {
            // Initialize Select2 for physician dropdown
            $('#physician').select2({
                placeholder: '-Select Physician-',
                allowClear: true,
                width: '100%'
            });

            // Optional: Add animation when opening dropdown
            $('#physician').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    $('.select2-dropdown').slideDown(300);
                }, 0);
            });

            // Initialize Select2 for attendant dropdown
            $('#attendant').select2({
                placeholder: '-Select Physician-',
                allowClear: true,
                width: '100%'
            });

            // Optional: Add animation when opening dropdown
            $('#attendant').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    $('.select2-dropdown').slideDown(300);
                }, 0);
            });
        });

        // ฟังก์ชันคำนวณอายุจากปีเกิด (เมื่อเปลี่ยน Year ใน DOB)
        function syncAgeFromYear() {
            const birthYear = parseInt($('[name="birthyear"]').val());
            const currentYear = new Date().getFullYear();

            if (birthYear && !isNaN(birthYear)) {
                const age = currentYear - birthYear;
                $('#age').val(age >= 0 ? age : 0);
            }
        }

        // ฟังก์ชันคำนวณปีเกิดจากอายุ (เมื่อเปลี่ยน Age)
        function syncYearFromAge() {
            const age = parseInt($('#age').val());
            const currentYear = new Date().getFullYear();

            if (age !== '' && !isNaN(age) && age >= 0) {
                const birthYear = currentYear - age;

                // ตรวจสอบว่าปีที่คำนวณได้อยู่ใน dropdown หรือไม่
                if (birthYear >= 1950 && birthYear <= 2025) {
                    $('[name="birthyear"]').val(birthYear);
                }
            }
        }

        function validateHN(input) {
            const cleaned = input.value.replace(/[^\d-]/g, '');
            if (cleaned !== input.value) {
                input.value = cleaned;
            }
        }

        // ฟังก์ชันเลือก Gender อัตโนมัติจาก Prefix
        function autoSelectGenderFromPrefix() {
            const prefix = $('#prefix').val().trim().toLowerCase();

            // คำนำหน้าสำหรับเพศชาย
            const malePrefixes = ['นาย', 'mr', 'mr.', 'mister'];

            // คำนำหน้าสำหรับเพศหญิง
            const femalePrefixes = ['นาง', 'นางสาว', 'น.ส.', 'mrs', 'mrs.', 'ms', 'ms.', 'miss'];

            if (malePrefixes.includes(prefix)) {
                $('#male').prop('checked', true);
            } else if (femalePrefixes.includes(prefix)) {
                $('#female').prop('checked', true);
            }
        }

        // เพิ่ม event listener ให้ช่อง prefix
        $(document).ready(function() {
            $('#prefix').on('input blur', function() {
                autoSelectGenderFromPrefix();
            });
        });
    </script>


@endsection
