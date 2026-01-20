<style>
    body::-webkit-scrollbar {
        width: 20px !important;
    }

    body::-webkit-scrollbar-track {
        border-radius: 0px;
    }

    body::-webkit-scrollbar-thumb {
        border-radius: 0px;
        background: #878a99;


    }

    body::-webkit-scrollbar-thumb:hover {
        border-radius: 0px;
        background: #245788;
    }

    .font-hn {
        font-size: 16px;
    }
    .btn-setting-icon{
        background-color: #405189;
    }
</style>
@php
    $otherprocedure = isset($otherprocedure) ? $otherprocedure : [];

@endphp
<div class="row" style="padding-right: 0">
    <div class="col-xl-3 card bg-report mb-2 ">
        {{-- <div class="btn-group" role="group">
            <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-settings-2-line"></i>
            </button>
            <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <li><a class="dropdown-item active_case" href="#">Active case</a></li>

            </ul>
        </div> --}}

        {{-- <button class="btn btn-primary active_case btn-icon"><i class="ri-settings-2-line"></i></button> --}}
        <div class="row p-4">
            <div class="col-4 img-with-btn-res text-center">
                @if (isset($case->pic))
                    <img id="imgnew" src="{{ url("public/pic_patient/$case->pic?a=") }}{{ date('Y-m-dH:i:s') }}"
                        width="100px" />
                @else
                    <img id="imgnew" src="{{ url('public/images/usericon1.jpg') }}" class="img-report" />
                @endif
                <a href="{{ url('patient/' . @$patient->id . '/edit?type=procedure&cid=' . @$case->id) }}"
                    {{-- <a href="{{ url('patient/' . @$patient->_id . '/edit?prepage=') }}{{ url()->full() }}" --}} {{-- <a href="{{ url('patient/create') }}" --}} class="btn btn-editp btn-load btn-sm mt-3">Edit Profile</a>
            </div>
            <div class="col-8">
                <span class="text-light h4">
                    <b id="testapi">HN: {{ @$case->hn }}</b>
                </span>
                <div class="mt-4">

                    @php
                        // dd($patient->gender);
                        if (@$patient->gender == '1') {
                            $gender = 'M';
                        }
                        if (@$patient->gender == '2') {
                            $gender = 'F';
                        }
                        if (@$patient->gender == '3') {
                            $gender = '-';
                        }
                        $phone = @$patient->phone . ' - ';
                    @endphp
                    <span
                        class="text-light h5">{{ @$patient->firstname . ' ' . @$patient->middlename . ' ' . @$patient->lastname }}
                        ({{ @$gender }})
                    </span>
                </div>
                <div class="">

                    <span class="text-light font-hn">

                        @php
                            $birthdate = format_date(@$patient->birthdate, 'd-M-Y');
                        @endphp
                        {{ $birthdate }} / {{ age(@$patient->birthdate) }} Years

                    </span>
                </div>
                <div class="mt-2">
                    <span class="text-light h5">Contact : </span>
                    <span class="text-light h5">{{ $phone }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-9" style="padding-right: 0">
        <div class="card p-2 mb-2">
            @if (@uget('user_type') == 'admin')
                <button type="button" id="move_case_btn" class="btn btn-primary " data-bs-toggle="modal"
                    data-bs-target="#move_case_modal" hidden>Standard Modal</button>
                <div style="">
                    <button type="button" id="dummy_move_case"
                        class="btn btn-primary btn-sm btn-label waves-effect waves-light">
                        <i class="ri-logout-box-r-line ri-1x label-icon align-middle fs-16 me-2"></i>
                        Move Case
                    </button>
                </div>
            @endif


        <div class="row">
            <div class="{{ count($otherprocedure) > 0 ? 'col-4' : 'col-6' }}">
                <div class="row p-3">
                    <div class="col-12">
                        <div class="row d-flex align-items-center">
                            <div class="col-4">
                                Date/Time:
                            </div>
                            <div class="col-8">
                                @php
                                    $datetime = isset($case->appointment)
                                        ? format_date($case->appointment, 'd/m/Y h:i')
                                        : '';
                                @endphp
                                <input type="text" name="date" id="date" class="form-control savejson"
                                    value="{{ @$datetime }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row d-flex align-items-center">
                            <div class="col-4 text-nowrap">
                                Treatment Coverage :
                            </div>
                            <div class="col-8">
                                <select id="treatment_coverage" name="treatment_coverage" class="form-select savejson">
                                    <option value=""></option>
                                    @foreach (isset($tb_treatmentcoverage) ? $tb_treatmentcoverage : [] as $data)
                                        <option value="{{ $data->name }}" @selected($data->name == @$case->treatment_coverage)>{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        <div class="row d-flex align-items-center">
                            <div class="col-4 text-nowrap">
                                Location :
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control savejson autotext" placeholder="OPD"
                                    id="opd" name="opd" value="{{ $case->opd }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row p-3">
                    <div class="col-12">
                        <div class="row d-flex align-items-center">
                            <div class="col-4">
                                Operation Room:
                            </div>
                            <div class="col-8 m-0">
                                <select name="room" id="room" class="savejson editroom form-select">
                                    <option value=""></option>
                                    @isset($room)
                                        @foreach ($room as $r)
                                            @php
                                                $r = (object) $r;
                                            @endphp
                                            <option value="{{ $r->room_id }}"
                                                @if ($r->room_id == $case->room) selected @endif>{{ $r->room_name }}
                                            </option>
                                            {{-- <option value="{{$r->room_id}}" @if ($r->room_name == @$case->room) selected @endif >{{$r->room_name}}</option> --}}
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="col-4 text-nowrap mt-2">
                                Current Procedure :
                            </div>
                            <div class="col-8 m-0 mt-2">
                                <input type="text" class="form-control" id="select_case_procedure"
                                    value="{{ @$procedure->name }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="row d-flex align-items-center">
                            <div class="col-6 text-nowrap">
                                <input type="text" class="form-control savejson autotext" placeholder="Ward"
                                    id="ward" name="ward" value="{{ $case->ward }}" autocomplete="off">

                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control savejson autotext" placeholder="Refer"
                                    id="refer" name="refer" value="{{ $case->refer }}" autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (count(@$otherprocedure) > 0)
                <div class="col-2 mt-4" style="height: 118px; overflow-y: auto;">
                    <div class="col-12">
                        Another Procedure :
                    </div>
                    @foreach (isset($otherprocedure) ? $otherprocedure : [] as $data)
                        @php
                            $data = (object) $data;
                        @endphp
                        <div class="col-12">
                            <a href="{{ url("loadpic/$data->id") }}"
                                class="btn btn-procedure mt-2 ">{{ $data->procedurename }}</a>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="col-2 p-0 " style="text-align: -webkit-center;">
                <a href="#" class="btn btn-soft-danger  w-75 text-nowrap" data-bs-toggle="modal"
                    data-bs-target="#modal_confirm_delete">
                    <span class="svg-icon svg-icon-danger d-block ">
                        <i class="ri-forbid-line ri-2x"></i>
                    </span>Cancel
                </a>
                <a class="btn btn-soft-success btn-load  w-75 mt-2 text-nowrap d-block" href="{{ url("camera/$case->id") }}">
                    <span class="svg-icon svg-icon-success d-block ">
                        <i class=" ri-camera-fill ri-2x"></i>
                    </span>
                    Take Photo
                </a>
            </div>
        </div>
    </div>
</div>
</div>




<div class="modal fade" id="modal_procedure_change" class="modal fade" tabindex="-1"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-xl">
        <div class="modal-content">
            <div class="modal-header p-0" style="border:none; height:1em;">
                <h5 class="modal-title">&emsp;</h5>
                <button type="button" class="btn btn-outline-danger btn-sm p-2"
                    style="margin-top: 2.2em;margin-right:1em;z-index: 1;" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="fas fa-times p-0"></i>
                </button>
            </div>

            <form id="form_procedure_change" action="{{ url('procedure') }}" method="post">
                @csrf
                <input type="hidden" name="cid" value="{{ $case->id }}">
                <input type="hidden" name="uid" value="{{ @uid() }}">
                <input type="hidden" name="event" value="procedure_change">
                <div class="modal-body row" style="align-items: center;">
                    <div class="col-12">Procedure Change</div>
                    <div class="col-12 mt-3" style="color:red;">*ข้อมูลที่กรอกจะถูกล้างทั้งหมดหลังเปลี่ยน Procedure
                    </div>
                    <div class="col-12 mt-5">
                        ผู้เปลี่ยน : {{ @uget('name') }}
                    </div>
                    <div class="col-12 mb-3">
                        <textarea name="edit_remark" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-7">
                        <select class="form-control" id="case_procedurecode" name="case_procedurecode">
                            <option value="">เลือกการตรวจ</option>
                            @foreach ($tb_procedure as $data)
                                @if ($case->case_procedurecode != $data->code)
                                    <option value="{{ $data->code }}">{{ $data->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @php
                        $otp = rand(1000, 9999);
                    @endphp
                    <div class="col-2 text-right" style="align-content: right">
                        <h3 class="m-0">OTP : {{ $otp }}</h3>
                    </div>
                    <div class="col-2"><input id="otp_procedure_change" class="form-control" placeholder="OTP"
                            autocomplete="off"></div>
                    <div class="col-1"><a id="btn_procedure_change" class="btn btn-success">ยืนยัน</a></div>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
    $('#select_case_procedure').click(function() {
        $('#modal_procedure_change').modal('show');
    });

    var procedure_submit = true
    $('#btn_procedure_change').click(function() {
        var otp = '{{ $otp }}';
        var txt_otp = $('#otp_procedure_change').val();
        var case_procedure = $('#case_procedure').val();

        if (otp == txt_otp && procedure_submit == true) {
            if (case_procedure != "") {
                $('#form_procedure_change').submit();
                procedure_submit = false
            } else {
                alert('กรุณาเลือกหัตถการ');
            }
        } else if (otp != txt_otp) {
            alert('OTP ไม่ตรงกัน');
        }
    });
</script>


<script>
    var movecase_status = true
    $('#dummy_move_case').on('click', function() {
        $('#move_case_btn').click()
        $('#move_to_div').css('display', 'none')
        $('#have_patient_div').css('display', 'none')
        $('#no_patient_div').css('display', 'none')
        $('#move_to_case').css('display', 'none')
        $('#move_to_patient').css('display', 'none')
        $('#move_case_hn').val('')
    })

    $('#move_case_hn').on('input', function() {
        var hn_inp = $('#move_case_hn').val()
        if (hn_inp != '' && hn_inp != undefined) {
            $.post("{{ url('api') }}/jquery", {
                event: 'check_hn_move_case',
                hn: hn_inp,
            }, function(data, status) {
                $('#move_to_div').css('display', 'block')
                if (data != "") {
                    $('#have_patient_div').css('display', 'block')
                    $('#no_patient_div').css('display', 'none')
                    $('#move_to_case').css('display', 'block')
                    $('#move_to_patient').css('display', 'none')
                    $('#move_to_hn').text(hn_inp)
                    $('#move_to_name').text(data)
                } else {
                    $('#no_patient_div').css('display', 'block')
                    $('#have_patient_div').css('display', 'none')
                    $('#move_to_case').css('display', 'none')
                    $('#move_to_patient').css('display', 'block')
                }
            })
        } else {
            $('#move_to_div').css('display', 'none')
        }
    })

    $('#movecase_submit_btn').on('click', function() {
        if (movecase_status) {
            $('#movecase_form').submit()
            movecase_status = false
        }
    })

    function clear_input(input_id) {
        $(`#${input_id}`).val('')
        $('#move_to_div').css('display', 'none')
    }
</script>
