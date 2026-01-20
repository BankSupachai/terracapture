{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('') }}/public/css/patient/create.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('') }}/public/css/nurse/show.css" rel="stylesheet" type="text/css" />
    <style>
        .list-patient-detail {
            margin-top: -3em !important;
            background: var(--bg-cleam);
            padding-bottom: 3em;
        }

        .book-regis {
            margin-top: -3em;
        }

        .book-regis .card-body>.row.m-0:first-child {
            display: none;
        }

        #imgnew {
            height: 5em;
            width: 5em;
        }

        .form-control-sm {
            border-color: #CED4DA !important;
        }

        .choices__list--dropdown {
            bottom: 100% !important;
            top: auto;
        }
    </style>
@endsection
@section('title-left')
    <h4 class="mb-sm-0">HISTORY TAKING</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Booking list</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection

@section('content')
{{-- history talking 01  25/7/2567 --}}
    {{-- <div class="row list-patient-detail cn">
        <div class="col-lg-1 p-4 text-center">
            @if (@$patient->pic == '')
                <img id="imgnew" src="{{ asset('public/images/usericon.png') }}" />
            @else
                <img id="imgnew" src="{{ url("pic_patient/$patient->pic") }}?a={{ date('Y-m-dH:i:s') }}" />
            @endif
        </div>
        <div class="col-lg">
            @php

                $gender_str = '-';
                if (isset($gender)) {
                    $gen = $gender;
                    if ($gen == 1) {
                        $gender_str = 'Male';
                    } elseif ($gen == 2) {
                        $gender_str = 'Female';
                    }
                }
            @endphp
            <h4>{{ $hn }} &emsp; {{ $name }} &emsp; {{ $age }}</h4>
            <span class="text-gray-small">Gender : {{ @$gender_str }}
                &emsp;|&emsp; Date of birth : {{ $dob }} &emsp;|&emsp; Tel : {{ $phone }}
                &emsp;|&emsp; E-mail : {{ $email }}</span>
        </div>
        <div class="col-lg-1">
            <a href="{{ '' }}/endoindex/book/patient/create?hn={{ $hn }}&action=edit"
                class="btn btn-book text-nowrap">Edit Profile</a>
        </div>
    </div> --}}



    <form method="post" action="{{ url('book/createcase') }}">
        @csrf
        <input type="hidden" name="event" value="createcase">
        <input type="hidden" name="noteid" value="{{ $id }}">
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="hidden" name="hn" value="{{ $hn }}">
        <input type="hidden" name="physician" value="{{ @$tb_booking->physician }}">

        {{-- @if ($tb_booking->procedure == null) --}}
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-6">
                        {{-- <div class="row ">
                            <div class="col-4 align-self-center">
                                Treatment Coverage :
                            </div>
                            <div class="col-8">
                                <select class="form-select" id="sel_treatmentcoverage" name="treatment_coverage">
                                    <option value="">Select</option>
                                    @foreach ($tb_treatmentcoverage as $data)
                                        <option value="{{ $data['name'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="row mt-2">
                            <div class="col-4 align-self-center ">
                                <span class="text-register2">Procedure</span>
                            </div>
                            <div class="col-8">
                                <select class="form-select" id="sel_procedure" name="procedure[]" required>
                                    <option value="">Select</option>
                                    @foreach ($procedure as $data)
                                        <option value="{{ $data['code'] }}">{{ $data['name'] }}</option>
                                    @endforeach
                                </select>

                            </div>

                        </div> --}}
                    </div>
                    <div class="col-6 text-end align-self-center">
                        <a href="{{url("casemonitor/control")}}" class="btn btn-primary btn-label waves-effect right waves-light"
                        style="display: show">
                        <i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Confirm
                    </a>


                    </div>
                </div>
            </div>
        </div>
        {{-- @endif --}}
        <div class="col-12">
            {{-- @include("endonote.nursenote.component.$process") --}}

            @isset($cid)
            <iframe src="{{url("note/paper/$cid/edit")}}" id="zoom_content" style="overflow: hidden;"  width="100%" height="1200px" frameborder="0"></iframe>
            @else
            <iframe src="{{url("note/paper?nid=$nid")}}" style="overflow: hidden;"  width="100%" height="1270px" frameborder="0"></iframe>
            @endisset

        </div>


    </form>


@endsection

@section('script')
    <script src="{{ url('assets/js/pages/form-wizard.init.js') }}"></script>
    <script src="{{ domainnameport(':3000/socket.io/socket.io.js') }}"></script>

    <script>
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        $(document).ready(function() {

            $('#sel_treatmentcoverage').select2({
                placeholder: "Treatmentcoverage",
                allowClear: true,

            });

            $('#sel_treatmentcoverage').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });

            $('#sel_procedure').select2({
                placeholder: "Procedure",
                allowClear: true,

            });

            $('#sel_procedure').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });
        });
    </script>








    <script>
        $(".noteradio").click(function() {
            let key = $(this).attr("name");
            let value = $(this).attr("value");
            $.post("{{ url('note/note') }}", {
                event: "noteradio",
                key: key,
                value: value,
                nid: "{{ $note->_id }}",
                process: "{{ $process }}",
            }, function(d, s) {});
        });

        $(".notebox").click(function() {
            let key = $(this).attr("name");
            let group = $(this).attr("group");
            if ($(this).is(':checked')) {
                value = 'checked';
            } else {
                value = '';
            }
            console.log(name, value);
            $.post("{{ url('note/note') }}", {
                event: "notebox",
                group: group,
                key: key,
                value: value,
                nid: "{{ $note->_id }}",
                process: "{{ $process }}",
            }, function(d, s) {});
        });

        $(".notetext").focusout(function() {
            let key = $(this).attr("id");
            let value = $(this).val();
            $.post("{{ url('note/note') }}", {
                event: "notetext",
                key: key,
                value: value,
                nid: "{{ $note->_id }}",
                process: "{{ $process }}",
            }, function(d, s) {});
        });
    </script>

    <script>
        function form_submit_to(id) {
            $('#' + id).submit()
        }
        var KTSelect2 = function() {
            var demos = function() {
                $('.select-nurse').select2({
                    placeholder: "Nurse",
                    allowClear: true
                });
                $('.select-physician').select2({
                    placeholder: "Physician",
                    allowClear: true
                });
            }
            return {
                init: function() {
                    demos();
                }
            };
        }();
        jQuery(document).ready(function() {
            KTSelect2.init();
        });
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.save-note').on('focusout change', function() {
            var this_id = $(this).attr('id');
            var this_type = $(this).attr('type');
            var value = $(this).val();
            if (this_type == 'checkbox') {
                if ($(this).is(':checked')) {} else {
                    value = 'false';
                }
            }
            $.post('{{ url('api/jquery') }}', {
                event: 'save_note',
                idhtml: this_id,
                value: value,
                step: "{{ $process }}",
                id: '{{ @$case->noteid }}',
            }, function(data, status) {
                console.log(data);
            });
        });

        function max_text(e, num) {
            var text = $(e).val()
            if (text.trim().length > num) {
                $(e).val('')
            }
        }

        function check_radio(e, key) {
            var text = $(e).val()
            console.log(text);
            if (text != '') {
                $(`#${key}_ck_2`).prop('checked', true)
            }

            if (text.length > 3) {
                $(e).val('')
            }

            if (text == '') {
                $(`#${key}_ck_1`).prop('checked', true)
                $(`#${key}_year`).val('')
                $(`#${key}_month`).val('')
                $(`#${key}_other`).val('')
            }

            if (key == 'endo' || key == 'surgery') {
                let year = $(`#${key}_year`).val()
                let month = $(`#${key}_month`).val()
                let other = $(`#${key}_other`).val()
                if (year == '' && month == '' && other == '') {
                    $(`#${key}_ck_1`).prop('checked', true)
                    $(`#${key}_year`).val('')
                    $(`#${key}_month`).val('')
                    $(`#${key}_other`).val('')
                }
            }
            let this_head = $(e).data('head')
            let this_key = $(e).data('key')
            let value = $(e).val()
            this_key = this_key.split('_')[0]
            if ($(`#${this_key}_ck_1`).is(':checked')) {
                value = $(`#${this_key}_ck_1`).val()
            }
            if ($(`#${this_key}_ck_2`).is(':checked')) {
                value = $(`#${this_key}_ck_2`).val()
            }
            save_note(this_head, this_key, value)
        }

        function save_note(this_head, this_key, data) {
            $.post('{{ url('api/jquery') }}', {
                event: 'save_note_sub',
                head: this_head,
                key: this_key,
                choice: data,
                id: '{{ @$case->noteid }}',
            }, function(data, status) {});
        }

        $('.ck-none').on('click', function() {
            var this_head = $(this).data('head')
            var this_key = $(this).data('key')
            $(`.${this_key}`).each((i, e) => {
                $(e).prop('checked', false)
            })
            $(this).prop('checked', true)
            save_note(this_head, this_key, [$(this).val()])
        })

        $('.radio-none').on('click', function() {

            var this_head = $(this).data('head')
            var this_key = $(this).data('key')
            var this_id = $(this).attr('id')
            if (this_key == 'alcohol' || this_key == 'cigarette' || this_key == 'pregnant' ||
                this_key.includes('allergy') || this_key.includes('food')
            ) {
                $(`#${this_key}_other`).val('')
                setTimeout(() => {
                    save_note(this_head, `${this_key}`, $(`#${this_id}`).val())
                }, 1 * 100);
                setTimeout(() => {
                    save_note(this_head, `${this_key}_other`, '')
                }, 1 * 300);
            } else {
                var arr = ['year', 'month']
                $(`#${this_key}_other`).val('')
                for (let i = 0; i < arr.length; i++) {
                    $(`#${this_key}_${arr[i]}`).val('')
                    var val = $(`#${this_key}_${arr[i]}`).val('')
                    if (val != undefined && val != '') {
                        setTimeout(() => {
                            save_note(this_head, `${this_key}`, $(`#${this_id}`).val())
                        }, 1 * 100);
                        setTimeout(() => {
                            save_note(this_head, `${this_key}_${arr[i]}`, '')
                        }, 1 * 300);
                        setTimeout(() => {
                            save_note(this_head, `${this_key}_other`, '')
                        }, 1 * 500);
                    }
                }
            }
        })

        $('.save-note-sub').on('focusout change', function() {
            var this_head = $(this).data('head')
            var this_key = $(this).data('key')
            var this_choice = []
            $(`#${this_key}_ck1`).prop('checked', false)
            $(`.${this_key}`).each((i, e) => {
                var is_checked = $(e).is(':checked')
                if (is_checked) {
                    this_choice.push($(e).val())
                }
            })

            save_note(this_head, this_key, this_choice)
        })

        $('.save-note-other').on('focusout input', function() {
            var this_head = $(this).data('head')
            var this_key = $(this).data('key')
            var this_value = $(this).val()
            save_note(this_head, this_key, this_value)
        })

        $('.save-note-radio').on('focusout change', function() {
            var this_head = $(this).data('head')
            var this_key = $(this).data('key')
            var this_radio = $(this).val()
            save_note(this_head, this_key, this_radio)
        })


        $(".select-physician").change(function() {
            var this_id = $(this).attr('id');
            var this_value = $(this).val()
            $.post('{{ url('api/jquery') }}', {
                event: 'save_note',
                idhtml: this_id,
                value: value,
                step: "{{ $process }}",
                id: '{{ @$case->noteid }}',
            }, function(data, status) {
                console.log(data);
            });
        })


        function checktime(num) {
            var currentdate = new Date();
            var time = currentdate.getHours() + ":" + currentdate.getMinutes();
            $("#time" + num).val(time)
            table_va()
        }

        function add_column() {
            var count = ($("#tb_add tr").length) + 1
            var htmli = `
                <tr>
                    <td><input type="text" id="time` + count +
                `" value="Check" class="btn btn-light btn-sm w-100 checktime" onclick="checktime(` + count + `)"></td>
                    <td><input type="text" class="form-control form-control-sm td-bp" oninput="max_text(this, 7)" onkeyup="table_va()"></td>
                    <td><input type="text" class="form-control form-control-sm td-pr" oninput="max_text(this, 3)" onkeyup="table_va()" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
                    <td><input type="text" class="form-control form-control-sm td-rr" oninput="max_text(this, 3)" onkeyup="table_va()" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
                    <td><input type="text" class="form-control form-control-sm td-spo" oninput="max_text(this, 3)" onkeyup="table_va()" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
                    <td><input type="text" class="form-control form-control-sm td-loc" oninput="max_text(this, 3)" onkeyup="table_va()" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
                    <td><input type="text" class="form-control form-control-sm td-otwo" oninput="max_text(this, 3)" onkeyup="table_va()" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>
                </tr>
            `
            $("#tb_add").append(htmli)
        }

        function table_va() {
            $.post('{{ url('note/note') }}', {
                event: 'vitalsign',
                notetype: '{{ $process }}',
                nid: '{{ $note->_id }}',
                time: $('.checktime').map((_, el) => el.value).get(),
                bp: $('.td-bp').map((_, el) => el.value).get(),
                pr: $('.td-pr').map((_, el) => el.value).get(),
                rr: $('.td-rr').map((_, el) => el.value).get(),
                spo: $('.td-spo').map((_, el) => el.value).get(),
                loc: $('.td-loc').map((_, el) => el.value).get(),
                otwo: $('.td-otwo').map((_, el) => el.value).get()
            }, function(d, s) {});
        }
    </script>

    <script>
        $('.savejson_checkbox').focusout(function() {
            var this_name = $(this).attr('name');
            var allVals = [];
            $('[name=' + this_name + ']:checked').each(function() {
                allVals.push($(this).val());
            });
            var val = JSON.stringify(allVals);
            $.post('{{ url('api/jquery') }}', {
                event: 'savejson_checkbox',
                idhtml: this_name,
                value: val,
                table: 'tb_case',
                idname: 'case_id',
                id: '{{ @$endo->_id }}',
                procedure: '{{ @$endo->case_procedure }}',
            }, function(data, status) {});
        });

        $('.savejson').bind('focusout', function() {
            var this_id = $(this).attr('id');
            var this_type = $(this).attr('type');
            var this_table = $(this).attr('table');
            if (typeof this_table === 'undefined') {
                this_table = "tb_case";
            }
            if (this_type == "checkbox") {
                $.post('{{ url('api/photomove') }}', {
                    event: 'savejson',
                    name: this_id,
                    value: $(this).prop('checked'),
                    table: this_table,
                    field: 'case_json',
                    id: '{{ @$endo->case_id }}',
                    comcreate: '{{ @$endo->comcreate }}',
                    procedure: '{{ @$endo->case_procedure }}',
                }, function(data, status) {});
            } else {
                $.post('{{ url('api/photomove') }}', {
                    event: 'savejson',
                    name: this_id,
                    value: $('#' + this_id).val(),
                    table: this_table,
                    field: 'case_json',
                    id: '{{ @$endo->case_id }}',
                    comcreate: '{{ @$endo->comcreate }}',
                    procedure: '{{ @$endo->case_procedure }}',
                }, function(data, status) {});
            }
        });
    </script>

    @include('admin.pagedetail')
@endsection
