@php
use App\Models\Patient;
@endphp
@extends('layouts.layouts_index.main')
@section('style')
    <style>
        .text-gray {
            color: #9599AD;
        }
        tr,
        td {
            color: #495057;
        }
        .btn-primary:disabled {
            color: #878a99 !important;
            background: #F3F6F9 !important;
            border: 0;
        }
        .btn-soft-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        .btn-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        .btn-soft-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }
        .draft-row.selected {
            background-color: rgba(255, 0, 0, 0.1);
        }
    </style>
@endsection
@section('modal')
    @include('EndoINDEX.showup.modal.modal_sendto_download')
    @include('EndoINDEX.showup.modal.modal_sendto_pacs')
    @include('EndoCAPTURE.home.component.modal_rapid')
    @include('EndoCAPTURE.home.component.modal_urease')
@endsection
@section('title-left')
    <h4 class="mb-sm-0 ">SEND TO</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Operation</a></li>
        <li class="breadcrumb-item active">Cases list</li>
    </ol>
@endsection
@section('content')

    <div class="card mb-1">
        <div class="card-body">
            @csrf
            <input type="hidden" name="event" value="search">
            <form action="{{ url('sendto') }}" method="get">
                @csrf
                @method('GET')
                <input type="hidden" name="event" value="filter_case">
                <div class="row">
                    <div class="col-10">
                        <div class="row">
                            <div class="col-3">
                                <div class="input-icon">
                                    <input type="text" class="form-control bg-gray-input" id="search_hn1"
                                        name="search_hn" placeholder="HN... " value="{{ @$search_hn }}">
                                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-icon">
                                    <input type="text" name="search_name" id="search_name1"
                                        class="form-control search_name_holding bg-gray-input" placeholder="Name "
                                        autocomplete="off" value="{{ @$search_name }}">
                                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                                </div>
                            </div>
                            <div class="col-3">
                                <select id="search_sendto_doctor" name="search_doctor" class="form-control">
                                    <option value="">Physician</option>
                                    @foreach ($doctor as $d)
                                        <option value="{{ @$d->uid }}"
                                            @if (@$search_doctor . '' == @$d->uid) selected @endif>
                                            {{ @$d->user_prefix }} {{ @$d->user_firstname }} {{ @$d->user_lastname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                @php
                                    $date = $search_date ?? '';
                                @endphp
                                <input placeholder="Date" type="text" class="form-control bg-gray-input textbox-n"
                                    name="search_date" id="search_date" onfocus="(this.type='date')"
                                    onblur="(this.type='text')" id="date" value="{{ @$date }}">
                            </div>
                            <div class="col-3 mt-2">
                                <select id="search_sendto_procedure" name="search_procedure" class="form-control">
                                    <option value="">procedure</option>
                                    @foreach ($procedure as $p)
                                        <option value="{{ @$p->name }}"
                                            @if (@$search_procedure . '' == @$p->name) selected @endif>
                                            {{ @$p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-9 mt-2">
                                <input type="text" class="form-control bg-gray-input" name="search_keyword"
                                    value="{{ @$search_keyword }}" placeholder="keyword..." id="search_keyword">
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-1 ">
                        <button class="btn btn-success w-100 h-100 btn-filter">Filter</button>
                    </div>
                    <div class="col-1 p-1">
                        <a href="{{ url('sendto') }}" class="btn btn-warning w-100 h-100 btn-filter"
                            style="align-content:center;">Clear</a>
                    </div>
                    {{-- <div class="col-12">
                        <span class="text-danger"> ** หากต้องการค้นหาหัวข้อต่อไป กรุณากดปุ่ม Clear</span>
                    </div> --}}
            </form>
    </div>
    </div>
    <div class="card mt-2 mb-1">
        <div class="card-body">
            <div class="row py-1">
                <div class="col-6 d-flex justify-content-between">
                    <span class="text-danger align-self-center">*Please final report before send to pacs</span>
                    <button class="btn btn-primary w-25 btn-toggle" data-bs-toggle="modal"
                        data-bs-target="#modal_sendto_download">
                        Download
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary w-25 btn-toggle" data-bs-toggle="modal"
                        data-bs-target="#modal_sendto_pacs">
                        Send to PACs
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-nowrap">
                <thead>
                    <tr class="bg-light text-gray">
                        <td>

                        </td>
                        <td class="text-gray">Date</td>
                        <td class="text-gray">Patient ID</td>
                        <td class="text-gray">Name</td>
                        <td class="text-gray">Physician</td>
                        <td class="text-gray">Procedure</td>
                        <td class="text-gray">Urease Test</td>
                        <td class="text-gray">Report Status</td>
                        <td class="text-gray">Photo / Video</td>
                        <td class="text-gray">Download (Last)</td>
                        <td class="text-gray">Data (Last Send)</td>
                        <td class="text-gray">PACs (Last Send)</td>
                        <td class="text-gray">Action</td>



                    </tr>
                </thead>
                <tbody id="sendto_case">

                    @foreach (isset($casesendto) ? $casesendto : [] as $index => $data)
                        @php
                            $_id = strval(@$data->id . '');
                            $download = $data->download ?? [];
                            $pacs = $data->case_pacs ?? [];

                            $patientname = Patient::fullname_patient($data->case_hn);

                            try {
                                $last_download = get_lastitem($download);
                            } catch (\Exception $e) {
                                $last_download = '-';
                            }

                            try {
                                $last_pacs = get_lastitem($pacs);
                            } catch (\Exception $e) {
                                $last_pacs = '-';
                            }
                            // $_id = (object) $data;
                            // dd($_id);
                            $appointment_date = isset($data->appointment_date)
                                ? \Carbon\Carbon::parse($data->appointment_date)->format('Y-m-d')
                                : null;
                            $today_date = \Carbon\Carbon::now()->format('Y-m-d');
                            $urease = isset($data->rapid_urease_test) ? (is_array($data->rapid_urease_test) ? implode('', $data->rapid_urease_test) : $data->rapid_urease_test) : '-';
                            $urease_other = isset($data->rapid_other) ? (is_array($data->rapid_other) ? implode('', $data->rapid_other) : $data->rapid_other) : '';
                        @endphp
                        {{-- @dd($casetoday); --}}
                        <tr style="line-height: 3em;cursor: pointer;"
                            onclick="check_checkbox(this.event, '{{ @$index }}')"
                            class="@if($data->statusjob == 'operation' || $data->statusjob == 'holding') draft-row @endif">
                            <td>
                                <div class="form-check mb-2">

                                    <input class="form-check-input ck_selectcase" statusreport="final" type="checkbox"
                                        value="{{ @$data->id . '' }}">


                                    @php
                                        if (isset($data->case_pdfversion)) {
                                            $statusreport = '';
                                        } else {
                                            $statusreport = 'Draft';
                                        }

                                    @endphp
                                    <label class="form-check-label" for="case_select">

                                    </label>
                                </div>
                            </td>

                            <td>

                                @if ($appointment_date === $today_date)
                                    Today
                                @else
                                    {{ $appointment_date ?? '' }}
                                @endif
                            </td>
                            <td data-id="{{ @$data->id . '' }}" data-type="hn">{{ @$data->case_hn . '' }}</td>
                            <td data-id="{{ @$data->id . '' }}" data-type="patientname">
                                {{ $patientname }}
                            </td>

                            <td data-id="{{ @$data->id . '' }}" data-type="statusreport" style="display: none;">
                                <span class="text-danger"> {{ @$statusreport }}</span>
                            </td>

                            <td data-id="{{ @$data->id . '' }}" data-type="doctorname">
                                {{ @$data->doctorname . '' }}
                            </td>

                            <td data-id="{{ @$data->id . '' }}" data-type="procedurename">
                                {{ @$data->procedurename . '' }}</td>
                            {{-- @dd($data['rapid_other']); --}}
                            <td>
                                @if(isset($urease_other) && $urease_other != '')
                                    @if (strlen($urease_other) > 15 || $urease_other == 'Pending')
                                        <button class="btn modal_ureasetest btn-soft-warning btn-sm fs-14"
                                            sub-name="pending"
                                            cid="{{@$_id}}"
                                            hn="{{@$data->case_hn}}"
                                            patientname="{{@$data->patientname}}"
                                            contact="{{@$data->patient_tel}}"
                                            select="{{@$urease}}"
                                            other="{{@$urease_other}}"
                                            count="{{@count($procedure)}}">
                                            Pending
                                        </button>
                                    @endif
                                    @if ($urease_other == 'Positive (+)')
                                        <button class="btn modal_ureasetest btn-soft-danger btn-sm fs-14" sub-name="positive"
                                        cid="{{@$_id}}" hn="{{@$data->case_hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$urease}}" other="{{@$urease_other}}" count="{{@count($procedure)}}">Positive(+)</button>
                                    @endif
                                    @if ($urease_other == 'Negative (-)')
                                        <button class="btn modal_ureasetest btn-soft-success btn-sm fs-14"  sub-name="negative"
                                        cid="{{@$_id}}" hn="{{@$data->case_hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$urease}}" other="{{@$urease_other}}" count="{{@count($procedure)}}">Negative (-)</button>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($data->statusjob == 'operation' || $data->statusjob == 'holding')
                                    <span class="badge badge-soft-warning p-1">
                                        Draft
                                    </span>
                                @else
                                    <span class="badge badge-soft-success p-1">
                                        Final
                                    </span>
                                @endif

                            </td>
                            <td>


                                <span class="">&ensp;&ensp;&ensp;&nbsp;
                                    {{ count(isset($data->photo) ? $data->photo : []) }}
                                    / {{ count(isset($data->video) ? $data->video : []) }}</span>
                            </td>
                            <td>&ensp;&ensp;&ensp;&nbsp; {{ @$last_download . '' != '' ? $last_download : '-' }} </td>
                            <td>

                                <span class="text-gray ms-2">Today 16:35</span>
                            </td>
                            <td>
                                <span class="text-gray ms-2">{{ @$last_pacs . '' != '' ? $last_pacs : '-' }}</span>
                            </td>
                            <td>
                                <a href="{{ url("reportendocapture/$_id") }}" type="button"
                                    class="btn btn-blue waves-effect waves-light"><i class=" ri-file-text-line"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-12 page-center mt-4">
            @if ($casesendto->hasPages())
                @php
                    $this_page = isset($casesendto) ? count($casesendto) : 0;
                    $start = isset($page) ? (intval($page) - 1) * $paginate + 1 : 1;
                    $end = $start + intval($this_page) - 1;
                @endphp
                <p class="text-center">{{ @$start }} - {{ @$end }} row(s)</p>

                {!! $casesendto->appends(request()->input())->links() !!}
            @endif

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $(".btn-toggle").prop("disabled", true);
        });


        $(".ck_selectcase").click(function() {
            let btn_download = false;
            $(".ck_selectcase:checked").each(function() {
                btn_download = true;
            });

            if (btn_download) {
                $(".btn-toggle").prop("disabled", false);
            } else {
                $(".btn-toggle").prop("disabled", true);
            }
        });



        var download_modal = document.getElementById('modal_sendto_download')
        var pacs_modal = document.getElementById('modal_sendto_pacs')

        download_modal.addEventListener('show.bs.modal', function() {
            append_patient_data()
        })

        pacs_modal.addEventListener('show.bs.modal', function() {
            append_patient_data()
        })

        function append_patient_data(elem) {
            let ids = []
            $('.patient-data').empty();

            $(".ck_selectcase:checked").each(function() {
                ids.push($(this).val());
            });

            for (let i = 0; i < ids.length; i++) {
                let hn = $(`td[data-id="${ids[i]}"][data-type="hn"]`).html()
                let patientname = $(`td[data-id="${ids[i]}"][data-type="patientname"]`).html()
                let procedurename = $(`td[data-id="${ids[i]}"][data-type="procedurename"]`).html()
                let doctorname = $(`td[data-id="${ids[i]}"][data-type="doctorname"]`).html()
                let statusreport = $(`td[data-id="${ids[i]}"][data-type="statusreport"]`).html()

                $('.patient-data').append(`
                    <div class="row">
                        <div class="col-7 mb-4">
                            ${hn} ${patientname} (${procedurename}) <br>
                            <span class="text-color-b">
                                ${doctorname} <br>
                                ${statusreport}
                            </span>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-3 text-center">
                            <div class="spinner-border text-primary spinner-border-sm loading" role="status" data-id="${ids[i]}" style="display:none">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span class="badge badge-soft-success status" data-id="${ids[i]}"  style="display:none">Success</span>
                        </div>
                    </div>
                `)

                console.log(hn, patientname, procedurename, doctorname);
            }
            console.log(ids);
        }

        $('.action-btn').on('click', function() {
            let datatype = $(this).data('type')
            let type = datatype.split('+')
            let is_allphoto = $('.allphoto').is(':checked') ? 'true' : 'false'
            let ids = []
            $(".ck_selectcase:checked").each(function() {
                // ids.push($(this).val());
                let id = $(this).val()
                if (id != '') {
                    ids = [id]
                    post_zipdata(ids, type, is_allphoto)
                }
            });
        })

        function post_zipdata(ids, type, is_allphoto) {
            $.post("{{ url('api/sendto') }}", {
                event: "zip_file",
                ids: ids,
                type: type,
                allphoto: is_allphoto
            }, function(data, status) {
                console.log(data);
                let parse = JSON.parse(data)
                let type = parse.type
                let files = parse.files
                if (parse != 'error') {
                    if (type == 'photo' && parse.status) {
                        create_link(files)
                    } else {
                        files.forEach(path => {
                            create_link(path)
                        });
                    }
                    // setTimeout(() => {
                    //     $.post("{{ url('api/sendto') }}", {
                    //         event: "delete_file",
                    //         url:data,
                    //     }, function (data, status) {

                    //     })
                    // },  60 * 60 * 1000);
                }
            })
        }

        $('.confirm_sending').on('click', function() {
            let which_type = $('.ck_type').filter(':checked').map(function() {
                return $(this).data('type')
            }).get()
            let ids = $('.ck_selectcase').filter(':checked').map(function() {
                return $(this).val()
            }).get()
            let is_allphoto = $('.allphoto').is(':checked') ? 'true' : 'false'

            if (which_type.includes('pdf') && which_type.includes('photo')) {
                which_type = which_type.filter(type => type != 'photo' && type != 'pdf')
                which_type.push('photopdf')
            }

            if (which_type.length > 0) {
                $('.loading').css('display', 'block')
                $(`.status`).css('display', 'none')
                ids.forEach((id) => {
                    if (id != "") {
                        post_data("createpacs_sendto", which_type, [id], is_allphoto)
                            .done(function(data, status) {
                                post_data("createpacs_sendto", which_type, [id], 'send_pacs')
                                    .done(function(data, status) {
                                        handleResponse(data, status);
                                    })
                            });
                    }

                })
            }
        })

        function post_data(event, which_type, ids, is_allphoto) {
            return $.post("{{ url('api/sendto') }}", {
                event: event,
                type: which_type,
                ids: ids,
                allphoto: is_allphoto
            });
        }

        function handleResponse(data, status) {
            console.log('Response received');
            let regex = /\{"hn":"[^"]*","status":"[^"]*"\}/g;
            let clean_data = data.replace(regex, '').replace(/}{/g, '},{');
            let parse = JSON.parse(clean_data);
            parse = parse.filter(value => value !== 0);
            console.log(parse);
            parse.forEach(obj => {
                let id = obj['cid'] ?? '';
                let types = obj['type'] ?? [];
                let createStatus = obj['status'] ?? [];
                console.log(obj, id, types, createStatus);
                createStatus.forEach((s, i) => {
                    $(`.loading[data-id=${id}]`).css('display', 'none');
                    if (s == 'unsuccess') {
                        $(`.status[data-id=${id}]`).removeClass('badge-soft-success').addClass(
                            'badge-soft-danger').html('Unsuccess');
                    }
                    $(`.status[data-id=${id}]`).css('display', 'block');
                });
            });
        }

        function create_link(url) {
            let a = document.createElement('a');
            a.href = url;
            a.download = "";
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }



        // $("#confirm_download").on('click', function() {
        //     // ck_selectcase
        //     let checkedValues = []
        //     let select = $("#get_drive").val();
        //     let checkedtype = []
        //     $(".ck_type:checked").each(function() {

        //         checkedtype.push($(this).attr("data-type"));
        //     })


        //     $(".ck_selectcase:checked").each(function() {
        //         checkedValues.push($(this).val());
        //         // checkedselectval.push($("#get_drive option:selected").val())
        //     });


        //     $.post("{{ url('api/sendto') }}", {
        //         event: "download_photo",
        //         case_ids: checkedValues,
        //         case_drive: select,
        //         ck_get_type: checkedtype
        //     }, function(data, status) {
        //         console.log(data);
        //     })
        //     // alert(download_photo);
        // });

        function check_checkbox(event, index) {
            let e = event || window.event
            let target = e.target || e.srcElement
            if (!$(target).hasClass('ck_selectcase')) {
                let row = $(target).closest('tr')
                let cb = row.find('.ck_selectcase')
                cb.prop('checked', !cb.prop('checked'))

                // เพิ่ม/ลบ class selected เมื่อมีการเลือก/ยกเลิกการเลือก
                if (cb.prop('checked')) {
                    row.addClass('selected')
                } else {
                    row.removeClass('selected')
                }
            }
            $(".btn-toggle").prop("disabled", $('.ck_selectcase:checked').length === 0);
        }

        $(document).ready(function() {
            $("#search_sendto_doctor").select2({
                placeholder: "Search Physician",
                allowClear: true
            });

            $("#search_sendto_procedure").select2({
                placeholder: "Search Procedure",
                allowClear: true
            });

            $("#search_sendto_procedure").on('select2:open', function(e) {
                $(".select2-dropdown").hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            })

            $("#search_sendto_doctor").on('select2:open', function(e) {
                $(".select2-dropdown").hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $(".modal_ureasetest").click(function(e){
                e.preventDefault();
                $('#span_patientname').html('');
                $('#span_hn').html('');
                $('#span_contact').html('');

                let subname = $(this).attr('sub-name');
                let count = $(this).attr('count');
                let hn = $(this).attr('hn');
                let phone = $(this).attr('contact');

                $(`#urease_${subname}`).prop('checked', true);
                $("#ureasetest").modal('show');
                $('#span_ureahn').html(hn);
                $('#span_patientname').html($(this).attr('patientname'));
                $('#span_contact').html(phone);
                $('#urease_text').val($(this).attr('other'));
                $('#case_id').val($(this).attr('cid'));
            });
        });

        function change_urease_text(type) {
            let text = '';
            if(type.includes('positive')){
                text = 'Positive (+)';
            } else if (type.includes('negative')){
                text = 'Negative (-)';
            } else if (type.includes('pending')){
                text = ' Positive [   ]         Negative [   ]';
            }
            $('#urease_text').val(text);
        }
    </script>
@endsection

