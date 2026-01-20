@extends('layouts.app')
@section('title', 'EndoCapture')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('') }}/public/css/patient/create.css" rel="stylesheet" type="text/css" />

    <style>

    </style>
@endsection
@section('content')

    <div class="clearfix"></div>


    <form action="{{ url('book/patient') }}" method="post" class="col-12">
        @csrf
        <input type="hidden" name="event" value="patient_add">
        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <a id="test_pt" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" title="Create patient test"><i class="fas fa-file-signature"></i></a>
                    <a id="readcitizencard" class="btn btn-sm btn-icon btn-bg-light btn-icon-success btn-hover-success" data-toggle="tooltip" title="Read Citizencard"><i class="fas fa-address-card"></i></a>
                </div>
                <div class="row m-0 border-bottom pb-5 mb-4">
                    <div class="col-lg"></div>
                    <div class="col-lg-3" align="center">
                        <div class="border rounded-circle" style="width: 240px;height:240px;padding:50px;">
                            @if (@$patient->pic == '')
                                <img id="imgnew" src="{{ asset('public/images/avatar.png') }}" class="img-fluid"/>
                            @else
                                <img id="imgnew" src="{{ url("pic_patient/$patient->pic") }}?a={{ date('Y-m-dH:i:s') }}" class="img-fluid" />
                            @endif
                        </div>
                    </div>
                    <div class="col-lg"></div>
                </div>
                <div class="row m-0">
                    <div class="col-12 mt-2"><b>Patient Detail</b></div>
                    <div class="col-12">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="myHiddenField">
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-lg mt-1">
                        <label for="inputEmail4" class="col-form-label">
                            <font size="2">Patient ID</font>
                            <font size="3" color="red">*</font>
                        </label>
                        <input id="hn" name="hn" type="text" class="form-control"
                            value="{{ @$patient->hn }}" oninvalid="this.setCustomValidity('คุณลืมกรอก HN')"
                            oninput="setCustomValidity('')" placeholder="H.N." required
                            onpaste="return false">
                        <div id="show_lang_in_here"></div>
                    </div>
                    <div class="col-lg mt-1">
                        <label for="inputPassword4" class="col-form-label">
                            <font size="2">Prefix</font>
                            <font size="3" color="red"></font>
                        </label>
                        <input name="prefix" id="prefix" type="text" class="form-control savejson autotext" autocomplete="off">
                    </div>
                    <div class="col-lg mt-1">
                        <label for="inputPassword4" class="col-form-label">
                            <font size="2">First Name</font>
                            <font size="3" color="red"> *</font>
                        </label>
                        <input name="firstname" type="text" class="form-control" id="first_name" required>
                    </div>
                    <div class="col-lg mt-1">
                        <label for="middlename" class="col-form-label">
                            <font size="2">Middle Name</font>
                            <font size="3" color="red">&nbsp;</font>
                        </label>
                        <input name="middlename" type="text" class="form-control" id="middlename">
                    </div>
                    <div class="col-lg mt-1">
                        <label for="inputPassword4" class="col-form-label">
                            <font size="2">Last Name*</font>
                            <font size="3" color="red"> *</font>
                        </label>
                        <input name="lastname" type="text" class="form-control" id="last_name" required>
                    </div>
                </div>
                <div class="row m-0">
                    <div class="col-lg mt-1">
                        <label for="inputEmail4" class="col-form-label">
                            <font size="2">Gender</font>
                            <font color="red"> *</font>
                        </label>
                        <select class='form-control' name="gender" required>
                            <option value="" selected disabled hidden>Select</option>
                            @forelse($gender as $l)
                                <option value='{{ $l->gender_id }}' @if ($l->gender_id == @$patient->gender) selected @endif>
                                    {{ $l->gender_name }}</option>
                            @empty
                                <option>none data</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-lg mt-1">
                        <label for='inputdate' class='col-form-label'>
                            <font size="2">DOB</font>
                            <font color="red"> *</font>
                        </label>
                        <div class="row" id="set_date">
                            <div class="col-lg-4">
                                <select class='form-control' name='birthday' id="birthday">
                                    @foreach ($day_all as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <select class='form-control' name='birthmonth' id="birthmonth">
                                    @foreach ($month_all as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <select class='form-control' name='birthyear' id="birthyear">
                                    @foreach ($year_all as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg mt-1">
                        <div class="row m-0">
                            <div class="col-lg p-0">
                                <label for='agenew' class='col-form-label'>
                                    <font size="2">Age</font>
                                    <font color="red"> *</font>
                                </label>
                                <div class="row" style="margin: 0;">
                                    <input name="age" type="number" id="agenew" class="form-control"
                                        value="{{ @$age }}" placeholder="อายุ" style="width: 95%"
                                        style="height: auto;" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 p-0"></div>
                    </div>
                    <div class="col-lg mt-1">
                        <label for="inputEmail4" class="col-form-label">
                            <font size="2">Phone Number</font>
                        </label>
                        @if (isset($patient->phone))
                            {{ Form::text('phone', $patient->phone, ['class' => 'form-control']) }}
                        @else
                            {{ Form::text('phone', '', ['class' => 'form-control']) }}
                        @endif
                    </div>
                    <div class="col-lg mt-1">
                        <label for="inputPassword4" class="col-form-label">
                            <font size="2">Email</font>
                        </label>
                        @if (isset($patient->email))
                            {{ Form::text('email', $patient->email, ['class' => 'form-control']) }}
                        @else
                            {{ Form::text('email', '', ['class' => 'form-control']) }}
                        @endif
                    </div>
                </div>
                <br>
                <div class="row m-0 mt-3 mb-4">
                    <div class="col-lg"></div>
                    <div class="col-lg-auto">
                        <button class="btn btn-book" name="next" value="1">&emsp; Next &emsp;</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <footer class="footer text-right">
        © Medica Healthcare.
    </footer>


    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"
        id="mi-modal">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div align="center">
                    <br>
                    <h1 class="modal-title" id="myModalLabel"> คุณ <div id="patient_name"></div> ได้ทำการลงทะเบียนแล้ว
                    </h1>
                    <br>
                    <h1 class="modal-title" id="myModalLabel">HN.<div id="patient_hn"></div>
                    </h1>
                </div>
                <div class="modal-footer">
                    <div class="row" style="    width: 100%;">
                        <div class="col-6"><button type="button" class="btn btn-danger" data-dismiss="modal"
                                style="width: 100%;padding:2em;">
                                <h2 class="mb-0">ไม่ใช่</h2>
                            </button></div>
                        <div class="col-6"><a id="opencase" type="button" class="btn btn-primary" href=""
                                style="width: 100%;padding:2em;">
                                <h2 class="mb-0">เลือกคนไข้รายนี้</h2>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ url('public/js/jquery.input-dropdown.js') }}"></script>
    <script src="{{ url('public/js/patient/create.js') }}"></script>
    <script type="text/javascript">
        $('.savejson').bind('focusout', function() {
            var this_id = $(this).attr('id');
            var this_type = $(this).attr('type');
            var procedure = 0;
            if (this_type == "checkbox") {
                $.post('{{ url('photomove') }}', {
                    event: 'savejson2',
                    name: this_id,
                    value: $(this).prop('checked'),
                    field: 'case_json',
                    procedure: procedure,
                }, function(data, status) {});
            } else {
                $.post('{{ url('photomove') }}', {
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
            $.post('{{ url('photomove') }}', {
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
                    $.post('{{ url('photomove') }}', {
                        event: 'delautotext',
                        text: text,
                        textid: this.id,
                        procedure: 0,
                    }, function(data, status) {});
                });
            }
        });

        $("#birthyear,#birthmonth,#birthday").change(function() {
            $.post("{{ url('jquery') }}", {
                    event: 'birth_change',
                    day: $("#birthday").val(),
                    month: $("#birthmonth").val(),
                    year: $("#birthyear").val()
                },
                function(data, status) {
                    var obj = JSON.parse(data);
                    $("#agenew").val(obj[0]);
                });
        });


        $("#agenew").on('keyup keypress blur change', function(e) {
            if ($(this).val() > 120) {
                $(this).val(120);
            }
            var date = {{ date('Y') }} + 543;
            var year = date - $(this).val();
            $("#birthyear").val(year);
        });


        $('#hn').focusout(function() {
            var hn = $("#hn").val();
            $.post("{{ url('photomove') }}", {
                    event: 'hn_check',
                    value: hn,
                },
                function(data, status) {
                    var n = data.search("#");
                    console.log(data);
                    if (n > 0) {
                        $('#hn').val('');
                        var res = data.split("#");
                        $('#patient_name').html(res[0]);
                        $('#patient_hn').html(res[1]);
                        $('#opencase').attr('href', '{{ url('') }}/book/registration/' + res[2]);
                        $('#mi-modal').modal('show');
                    } else {
                        hn_form_hisconnect(hn);
                    }
                });
        });










        $("#test_pt").click(function() {
            var this_age = Math.floor(Math.random() * 60);
            var m = new Date();
            var dateString = m.getUTCFullYear() + "" + ("0" + (m.getUTCMonth() + 1)).slice(-2) + "" + ("0" + m
                .getUTCDate()).slice(-2);
            $("#hn").val('TEST' + dateString);
            $("#hn").focusout()
            if ($("#first_name").val() != 'test') {
                $("#prefix").val('นาย')
                $("#first_name").val('test')
                $("#last_name").val('test')
                $("#agenew").val(this_age)
                $("[name='gender']").val(1).change()
                $("#agenew").keyup()
            }
        })

        $("#readcitizencard").click(function() {
            $('#modal_progress').modal('show');
            $.get('http://localhost/endocapture5.0/api/readcitizencard', {}, function(data, status) {
                $('#modal_progress').modal('hide');

                var res = JSON.parse(data);
                console.log(res);

                $("#prefix").val(res.prefix)
                $("#first_name").val(res.firstname)
                $("#last_name").val(res.lastname)

                $("#citizen").val(res.cid)
                if (res.gender == "ชาย") {
                    $("[name='gender']").val(1).change()
                } else {
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
        $pathhispatient = $_SERVER['DOCUMENT_ROOT'] . "/config/views/his/$head/patient_get_detail.blade.php";
    @endphp

    @if (is_file($pathhispatient))
        @include("his.$head.patient_get_detail")
    @else
        @include('endo.patient.his.00000')
    @endif


@endsection
