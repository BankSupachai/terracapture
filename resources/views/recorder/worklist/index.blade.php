@extends('layouts.layouts_lumina')
@section('title', 'EndoINDEX')
@section('style')
    <style>
        * {
            font-size: 22px !important;
        }

        /* Hide the clear button and up/down toggles for date input fields */
        input[type="date"]::-webkit-clear-button,
        input[type="date"]::-webkit-inner-spin-button {
            display: none;
        }

        .tableFixHead {
            overflow-y: auto;
            max-height: 200px;
        }

        .tableFixHead thead tr {
            position: sticky;
            top: 0px;
            z-index: 99;
            font-size: 18px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        .btn-select {
            background: #245788;
            color: #fff;
        }

        .height-custom {
            height: 100px;
            width: 250px;
        }

        #btn_showall {
            background: #245788;
            color: #FFFFFF;
            border: 1px solid #245788;
            white-space: nowrap;
        }

        #selectdate {
            z-index: 9999 !important;
        }

        /* table tr td:nth-child(1,2,3){width: 20% !important}; */
    </style>
@endsection
@section('modal')

    <div class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="mySmallModalLabel"
        aria-hidden="true" id="worklist_modal">
        <div class="modal-dialog modal-dialog-centered " style="max-width: 49%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title " id="staticBackdropLabel">Select Case</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="row ms-2 fs-5">
                    <span class="worklistid-modal" hidden></span>
                    <div class="text-white50">Patient Detail</div>

                    <div class="col-8 p-0">
                        <div class="row   text-white">
                            {{-- <div class="col-2"></div> --}}
                            <div class="col-3 mt-2">HN: &ensp;&ensp;</div>
                            <div class="col-9 mt-2">
                                <span class="hn-modal"></span>
                            </div>
                            <div class="col-3 mt-2">Date: &ensp;&ensp;</div>
                            <div class="col-9 mt-2">
                                <span class="date-modal"></span>
                            </div>
                            <div class="col-3 mt-2">Name: &ensp;&ensp;</div>
                            <div class="col-9 mt-2"><span class="name-modal"></span></div>



                            <div class="col-3 mt-2">Physician: &ensp;&ensp;</div>
                            <div class="col-9 mt-2" id="physician-modal">
                                <input type="text" class="form-control physician-modal">
                            </div>


                            <div class="col-3 mt-2  ">
                                Procedure:
                            </div>
                            <div class="col-9 mt-2">
                                <span class="procedure-modal"></span> <br>
                                <span class="text-danger">
                                    <span class="matchprocedure-modal" ></span>
                                </span>
                            </div>

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row  text-white text-nowrap">
                            <div class="col-12 mb-2">
                                <button type="button" class="btn btn-dark-primary height-custom  add-to-caselist"
                                    data-bs-dismiss="modal">
                                    <span class="text-modal ">Add to Case List</span>
                                </button>
                            </div>
                            <div class="col-12  mb-5">
                                <button type="button" class="btn btn-danger height-custom  to-camera">
                                    <i class="ri-camera-fill text-white align-middle"></i>&nbsp;
                                    <span class="text-modal">Go to Camera</span></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        &nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" data-bs-backdrop="static" aria-labelledby="mySmallModalLabel"
        aria-hidden="true" id="patient_modal">
        <div class="modal-dialog modal-dialog-centered " style="max-width: 49%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title " id="staticBackdropLabel">Select Case</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <hr>
                <div class="row fs-5 ms-2">
                    <div class="text-white50">Patient Detail</div>
                </div>
                <div class="row mb-5 me-3">
                    <div class="col-8 mt-3 text-white">
                        <div class="fs-5">
                            <div class="row ">
                                <span hidden  type="worklistid" class="patient-detail"></span>
                                <div class="col-3">
                                    HN:
                                </div>
                                <div class="col-9">
                                    <span type="hn" class="patient-detail">123456789</span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3">
                                    Date:
                                </div>
                                <div class="col-9">
                                    <span type="date" class="patient-detail">02-04-2022 09:00</span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3">
                                    Name:
                                </div>
                                <div class="col-9">
                                    <span type="name" class="patient-detail">jonathan Orlando</span>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3">
                                    Procedure:
                                </div>
                                <div class="col-9">
                                    <span type="procedure" class="patient-detail"></span> <br>
                                        <span class="text-danger">
                                            <span type="matchprocedure" class="patient-detail">(Laparoscopy)</span>
                                            {{-- <span>(Laparoscopy)</span> --}}

                                        </span>
                                </div>
                            </div>
                          </div>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-dark-primary move-case w-100 h-100 move-case"
                           >Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="record-physician" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Physician</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body " style="height:500px; overflow:auto;">
                    <input type="text" id="search-physician-recorder" style="font-size: 26px;" class="form-control mb-2 input-dark"
                        onkeyup="searchmodal('physician')" placeholder="Search Physician">
                    <table class="table text-center" id="table-physician-recorder">
                        @foreach ($doctor as $data)
                            <tr class="col-4 physician-select p-2 header " code="{{ @$data['id'] }}"
                                name="{{ $data['user_prefix'] }} {{ $data['user_firstname'] }} {{ $data['user_lastname'] }}">
                                <td style="cursor: pointer; font-size: 26px;">{{ $data['user_prefix'] }} {{ $data['user_firstname'] }}
                                    {{ $data['user_lastname'] }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection



@section('content')
    <input id="caseselectID" type="hidden">
    {{-- @dd("mmmm") --}}
    <div class="row">
        <div class="col-7 text-white f-24 mb-3 pb-3 pt-3 px-5">
            PACs Worklist
        </div>
        <div class="col-5 text-end">
            <div class="row text-end">
                <div class="col-4 ">
                    <button class="btn btn-primary" id="btn_showall">Show Filter Worklist </button>
                </div>
                <div class="col-4 ">
                    <div class="form-icon">
                        <input type="date" class="form-control form-control input-dark" id="selectdate1"
                            value="<?php echo date('Y-m-d'); ?>" hidden>
                        <input type="text" class="form-control form-control input-dark" placeholder="dd-mm-yyyy"
                            id="selectdate" value="<?php echo date('d-m-Y'); ?>" >
                    </div>
                </div>
                <div class="col-4 text-nowrap">
                    <button class="btn btn-danger w-100" id="import_worklist">
                        <i class="ri-refresh-line"></i> Update Worklist
                        <div id="wk_spinner" class="spinner-border spinner-border-sm ms-2" role="status"
                            style="visibility: hidden">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        {{-- <div class="col-2 p-0 mt-3 " hidden>
            <button class="btn btn-danger" id="import_worklist">
                <i class="ri ri-download-2-line"></i> Hospital Worklist
                <div id="wk_spinner" class="spinner-border spinner-border-sm ms-2" role="status"
                    style="visibility: hidden">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </button>
        </div> --}}
    </div>

    <div class="row bg-menu p-2">

        <div class="col-3 mb-3 ">
            <input type="text" class="form-control form-control-icon input-dark" id="search_hn" id="iconInput"
                placeholder="Patient ID">


        </div>
        <div class="col-3 ">
            <input type="text" class="form-control form-control-icon input-dark" id="search_name" id="iconInput"
                placeholder="Name">
        </div>
        <div class="col-6 text-end">
            {{-- <div class="row">
                <div class="col-5"></div>
                <div class="col-7 p-0">
                    <div class="row p-0">
                        <div class="col-6 p-0">
                            <div class="form-icon">
                                <input type="date" class="form-control form-control input-dark" id="selectdate" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <div class="col-6 p-0">
                            <button class="btn btn-danger" id="import_worklist">
                                <i class="ri ri-download-2-line"></i> Import Worklist
                                <div id="wk_spinner" class="spinner-border spinner-border-sm ms-2" role="status" style="visibility: hidden">
                                    <span class="visually-hidden">Loading...</span>
                                  </div>
                            </button>
                        </div>

                    </div>
                </div>
            </div> --}}
            {{-- <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#record_worklist"><i class="ri ri-download-2-line"></i> Import Worklist</button> --}}
        </div>
        <div class="col-12  mh-menu">
            <table class="table align-middle table-nowrap mb-0 tableFixHead" id="tasksTable">
                <thead>
                    <tr class="active-url text-muted fs-22">
                        <td class="text-white " style="width: 15%;">Date / Time</th>
                        <td class="text-white " style="width: 20%;">Patient ID</td>
                        <td class="text-white " style="width: 20%;">Name</td>
                        <td class="text-white " hidden>Physician</td>
                        <td class="text-white " style="width: 40%;">Procedure</th>
                        <td class="text-white" style="width: 5%;">Actions</td>
                    </tr>
                </thead>
                <tbody id="tbody_worklist" class="list form-check-all fs-20">
                    <input type="text" class="caseid-modal" hidden>
                    @forelse ($tb_caseworklist as $case)
                        @php
                            $case = (object) $case;
                            $formatted_date = '';
                            $formatted_time = '';
                            if (isset($case->date)) {
                                try {
                                    $date = new DateTime($case->date);
                                    $formatted_date = $date->format('d-m-Y');
                                } catch (\Throwable $th) {
                                }
                            }

                            if (isset($case->time)) {
                                try {
                                    $time = DateTime::createFromFormat('His', $case->time);
                                    $formatted_time = $time->format('H:i');
                                } catch (\Throwable $th) {
                                }
                            }
                            $json_case = json_encode($case);
                        @endphp
                        <tr id="tr{{ @$case->id }}" data-case="{{ @$json_case }}">
                            <td>{{ @$formatted_date }} / {{ @$formatted_time }}</td>
                            <td @if(@$case->accessionnumber == "") style="color:yellow;" @endif>{{ @$case->patientid }}</td>
                            <td @if(@$case->accessionnumber == "") style="color:yellow;" @endif>{{ @$case->patient_nameTH }}</td>
                            <td hidden>{{ @$case->physicianname }}</td>
                            <td>{{ @$case->proceduredescription }}</td>
                            <td class="priority p-0">
                                <button data-id={{ @$case->id }} type="button" class="btn btn-select call_wkmodal">
                                    <i class="ri-check-double-fill"></i>&nbsp; <span class="align-middle">Select</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No data !</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


@endsection




@section('script')
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="http://{{ $_SERVER['SERVER_NAME'] }}:3000/socket.io/socket.io.js"></script>
    <script src="{{asset('public/js/qwebchannel.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let caseselectID = "";

        var socket = io.connect('http://{{ $_SERVER['SERVER_NAME'] }}:3000');
        socket.emit("chat message", JSON.stringify("vdo_hide"));
        // add here
        socket.on('chat message', function(msg) {
            console.log(msg);
            if (msg != '' && msg != undefined) {
                let parse = JSON.parse(msg)
                console.log(parse.status);
                if (parse.event != '' && parse.event != undefined) {
                    if (parse.event == 'finish_getworklist') {
                        let date = $('#selectdate').val()
                        date = formatted_date(date)
                        $.post('{{ url('api/siphconnect') }}', {
                            event: "get_worklist",
                            date: date,
                            from: "recorder"
                        }, function(data, status) {
                            $('#wk_spinner').css('visibility', 'hidden')
                            $('#import_worklist').prop('disabled', false)
                            get_data_worklisttable()
                            console.log(data, status);
                        })
                    }
                }
            }
        })
    </script>
    <script>
        document.getElementById("ex-icon").style.cssText = 'font-size: 150px !important;';

        let showall = true;
        $('#btn_showall').click(function() {
            // alert(showall);
            if (showall) {
                $(this).text("Show All Worklist  ");
                $(this).css("background", "#000000");
                search_data(showall)
                showall = false;
            } else {
                $(this).text("Show Filter Worklist ");
                $(this).css("background", "#245788");
                search_data(showall)
                showall = true;
            }
        })




        $(".physician-modal").click(function() {
            $("#record-physician").modal("show");
        });


        $('.physician-select').click(function() {
            let name = $(this).attr('name');
            let code = $(this).attr('code');
            console.log(code);
            let caseselectID = $("#caseselectID").val();
            $.post("{{url("api/worklist")}}",{
                event:"changedoctorcode",
                wid:caseselectID,
                uid:code
            },function(d,s){});
            $(".physician-modal").val(name);
            $("#record-physician").modal("hide");
        })



        $('#search_hn').on('input', function() {
            let text = $('#btn_showall').text()
            let is_showall = text.includes('All') ? true : false
            search_data(is_showall)
        })

        $('#search_name').on('input', function() {
            let text = $('#btn_showall').text()
            let is_showall = text.includes('All') ? true : false
            search_data(is_showall)
        })


        function search_data(showall) {
            let patient_id = $('#search_hn').val()
            let patient_name = $('#search_name').val()
            $.post("{{ url('api/worklist') }}", {
                event: "filter_worklist",
                patient_id: patient_id,
                showall: showall,
                patient_name: patient_name
            }, function(data, status) {
                $('#tbody_worklist').empty()
                append_worklist(data)
            })

        }

        $('#selectdate').on('input', (e) => {
            var value = e.target.value;
            var formattedValue = value.replace(/[^0-9]/g, '')
                .replace(/(\d{2})(\d)/, '$1-$2')
                .replace(/(\d{2})-(\d{2})(\d)/, '$1-$2-$3');
            if (formattedValue.length > 10) {
                formattedValue = formattedValue.substring(0, 10);
            }

            if (formattedValue.length == 10) {
                let strSplit = formattedValue.split('-')
                let day = strSplit[0] > 31 ? 31 : strSplit[0]
                let month = strSplit[1] > 12 ? 12 : strSplit[1];
                let year = strSplit[2] > moment().year() + 100 ? parseInt(strSplit[2]) - 543 : strSplit[2]
                formattedValue = `${day}-${month}-${year}`
                $('#import_worklist').prop('disabled', false)
            } else if (formattedValue.length < 10) {
                $('#import_worklist').prop('disabled', true)
            }
            e.target.value = formattedValue;
        })


        $('#selectdate').on('change', (e) => {
            console.log('aaa', e.target.value);
            let date = $('#selectdate').val()
            date = formatted_date(date)
            console.log('bbb', date);
        })


        function formatted_date(datestr) {
            console.log(datestr);
            // Regular expression to match 'yyyy-mm-dd' format
            let yyyy_mm_dd_regex = /^\d{4}-\d{2}-\d{2}$/;

            // Check if the date string matches 'yyyy-mm-dd' format
            if (yyyy_mm_dd_regex.test(datestr)) {
                return datestr;
            }

            let dateParts = datestr.split('-');
            let formattedValue = moment().format('YYYY-MM-DD')
            if (dateParts.length === 3) {
                if(dateParts[2].length > 2){
                    formattedValue = datestr
                } else {
                    formattedValue = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
                }
            }
            return formattedValue
        }

        function to_record(cid) {
            let url = `{{ url('lumina/record') }}/${cid}`
            let is_python = "{{ @$scope_type }}"
            if (is_python == 1) {
                $.post("{{ url('api/capture') }}", {
                    "event": "set_lumina_config",
                    "_id": cid
                }, function(data, status) {
                    if (data != '') {
                        socket.emit('chat message', data)
                    }
                })
                $(`#to_record${cid}`).prop('disabled', true)
            } else {
                location.href = url
            }
        }

        var wk_modal = new bootstrap.Modal('#worklist_modal', {})
        var pt_modal = new bootstrap.Modal('#patient_modal', {})
        var wkstatus_modal = new bootstrap.Modal("#wkstatusModal",  {})
        // pt_modal.show()

        $('.call_wkmodal').on('click', function() {
            $('.caseid-modal').val($(this).data('id'))
            // $("#caseselectID").val($(this).data('id'));
            // console.log($(this).data('id'));
            // alert('Please');
            if ("{{ @$page_type }}" == "1") {
                pt_modal.show()
            } else {
                wk_modal.show()
            }
        })

        $('#worklist_modal').on('show.bs.modal', function() {
            set_worklist_data()
        })

        $('#patient_modal').on('show.bs.modal', function() {
            set_worklist_data("1")
        })

        function set_worklist_data(type = '') {
            let _id             = $('.caseid-modal').val()
            let casedata        = $(`#tr${_id}`).data('case')
            let patientname     = casedata.patient_nameTH != undefined ? casedata.patient_nameTH : casedata.patientname
            let dateformat      = casedata.date != '' ? moment(casedata.date).format("MM-DD-YYYY") : ''
            let hn              = casedata.patientid != '' ? casedata.patientid : ''
            let physicianname   = casedata.physicianname != '' ? casedata.physicianname : ''
            let procedurename   = casedata.proceduredescription != '' ? casedata.proceduredescription : ''
            let matchprocedure  = casedata.match_procedure != '' ? casedata.match_procedure : ''
            let worklistid      = _id

            type != "1" ? $('.hn-modal').html(hn) : $('.patient-detail[type="hn"]').html(hn)
            type != "1" ? $('.name-modal').html(patientname) : $('.patient-detail[type="name"]').html(patientname)
            type != "1" ? $('.date-modal').html(dateformat) : $('.patient-detail[type="date"]').html(dateformat)
            type != "1" ? $('.physician-modal').val(physicianname) : $('.physician-modal').val(physicianname)
            type != "1" ? $('.procedure-modal').html(procedurename) : $('.patient-detail[type="procedure"]').html(procedurename)
            type != "1" ? $('.matchprocedure-modal').html(`(${matchprocedure})`) : $('.patient-detail[type="matchprocedure"]').html(`(${matchprocedure})`)
            type != "1" ? $('.worklistid-modal').html(worklistid) : $('.patient-detail[type="worklistid"]').html(worklistid)
        }

        $('#import_worklist').on('click', function() {
            $('#wk_spinner').css('visibility', 'visible')
            $(this).prop('disabled', true)
            let date = $('#selectdate').val()
            date = formatted_date(date)
            if (date.includes('-')) {
                date = date.replace(/-/g, '')
            }

            // get_data_worklisttable()

            $.post("{{ url('api/recorder') }}", {
                event: "checkport",
                comname: "{{ @$pacs->pacsserver }}",
                port: "{{ @$pacs->port }}",
            }, function(d, s) {
                const obj = JSON.parse(d);
                console.log('port', obj.status);
                if (obj.status) {
                    // $("#"+id_prefix+comname).html('&ensp; &nbsp;<i class="ri-checkbox-circle-fill text-success"></i>')
                    $.post("{{ url('api/worklist') }}", {
                        event: "getworklistsiph"
                    }, function(d, s) {
                        get_data_worklisttable()
                    });
                } else {
                    // alert("เชื่อมต่อไม่สำเร็จ");
                    $('#wk_spinner').css('visibility', 'hidden')
                    $('#import_worklist').prop('disabled', false)

                    wkstatus_modal.show()
                }
            });
        })

        function get_data_worklisttable() {
            let date = $('#selectdate').val()
            date = formatted_date(date)
            $.post('{{ url('api/siphconnect') }}', {
                event: "get_worklist",
                date: date,
                from: "recorder"
            }, function(data, status) {
                $('#wk_spinner').css('visibility', 'hidden')
                $('#import_worklist').prop('disabled', false)
                $('#tbody_worklist').empty()
                append_worklist(data)


                if ('{{ @$scope_type }}' == 1 || '{{ @$scope_type }}' == 'true') {
                    let data = {
                        "event": "refresh_page",
                    }
                    let this_json = JSON.stringify(data)
                    // socket.emit("chat message", this_json)
                } else {
                    // location.reload()
                }

            })
        }

        function append_worklist(data) {
            let parse = JSON.parse(data)
            console.log('parse', parse);
            parse.forEach((e, i) => {
                let jsonenc = JSON.stringify(e)
                let _id = e._id.$oid
                let patientid = e.patientid != '' && e.patientid != undefined ? e.patientid : ''
                let patientname = e.patient_nameTH != '' && e.patient_nameTH != undefined ? e.patient_nameTH : e
                    .patientname
                let physicianname = e.physicianname != '' && e.physicianname != undefined ? e.physicianname : ''
                let procedure = e.proceduredescription != '' && e.proceduredescription != undefined ? e
                    .proceduredescription : ''
                let modality = e.modality != '' && e.modality != undefined ? e.modality : ''
                let date = e.date != '' && e.date != undefined ? moment(e.date).format("DD-MM-YYYY") : ''
                let time = e.time != '' && e.time != undefined ? e.time.replace(/.{2}/g, '$&:').slice(0, 5) : ''
                let accessionnumber = e.accessionnumber != '' && e.accessionnumber != undefined ? e
                    .accessionnumber : ''
                let visitno = e.visitno != '' && e.visitno != undefined ? e.visitno : ''
                let patienteng = e.patientname != '' && e.patientname != undefined ? e.patientname : ''
                if (patientname == undefined) {
                    patientname = ''
                }
                let no_accession = accessionnumber == '' ? 'style="color:yellow;"' : ''
                $('#tbody_worklist').append(`
                    <tr id="tr${_id}" data-case='${jsonenc}'>
                        <td>${date} / ${time}</td>
                        <td class="id" ${no_accession}>${patientid}</td>
                        <td class="project_name fs-thai" ${no_accession}>${patientname}</td>
                        <td hidden>${physicianname}</td>
                        <td>${procedure}</td>
                        <td class="priority p-0">
                            <button data-id="${_id}" type="button"
                                class="btn btn-select call_wkmodal">
                                <i class="ri-check-double-fill"></i>&nbsp; <span class="align-middle">Select</span>
                            </button>
                        </td>
                    </tr>
                `)

                $('.call_wkmodal').on('click', function() {
                    // console.log($(this).data('id'), 'aaa', $(`#tr${_id}`));
                    $('.caseid-modal').val($(this).data('id'))
                    $("#caseselectID").val($(this).data('id'));
                    console.log($("#caseselectID").val());
                    if ("{{ @$page_type }}" == "1") {
                        pt_modal.show()
                    } else {
                        wk_modal.show()
                    }
                })
            });
        }

        $('.move-case').on('click', function() {
            let wkid = $('.patient-detail[type="worklistid"]').html()
            let hn = $('.patient-detail[type="hn"]').html()
            let procedure = $('.patient-detail[type="matchprocedure"]').html().replace(/\(|\)/g, "")
            console.log(wkid, hn, procedure);
            $.post("{{ url('api/worklist') }}", {
                event: "wk_movecase",
                hn:hn,
                worklist_id:wkid,
                procedure:procedure,
                instant_cid: "{{@$instant_cid}}"
            }, function(data, status) {
                request_sendfile(hn, data)
            })

        })

        function request_sendfile(hn, cid) {
            $.post('{{url("api/worklist")}}', {
                event: "sendfile_server",
                hn: hn
            }, function (data, status) {
                location.href = `{{ url('lumina/storage') }}/${cid}`
            })
        }

        $('.add-to-caselist').on('click', function() {
            let _id = $('.caseid-modal').val()
            create_worklist(_id, 'caselist')
        })

        $('.to-camera').on('click', function() {
            callmodal()
            let _id = $('.caseid-modal').val()
            create_worklist(_id, 'camera')
        })

        var is_click = false

        function create_worklist(wk_id, type) {
            if (is_click == false) {
                $(`#create_wk${wk_id}`).prop('disabled', true)
                is_click = true
            }
            let casedata_enc = $(`#tr${wk_id}`).data('case')
            let hn = casedata_enc.patientid != '' && casedata_enc.patientid != undefined ? casedata_enc.patientid : ''
            let patientname = casedata_enc.patient_nameTH != '' && casedata_enc.patient_nameTH != undefined ? casedata_enc
                .patient_nameTH : casedata_enc.patientname
            let useropen = "{{ @uid() }}"
            // let doctorname = casedata_enc.physicianname != '' && casedata_enc.physicianname != undefined ? casedata_enc
            //     .physicianname : ''
            let doctorname = $('.physician-modal').val()
            // let procedure = casedata_enc.proceduredescription != '' && casedata_enc.proceduredescription != undefined ?
            //     casedata_enc.proceduredescription : ''
            let procedure = casedata_enc.match_procedure != '' && casedata_enc.match_procedure != undefined ?
                casedata_enc.match_procedure : casedata_enc.proceduredescription
            let prediagnosis = ''
            let accessionnumber = casedata_enc.accessionnumber != '' && casedata_enc.accessionnumber != undefined ?
                casedata_enc.accessionnumber : ''
            let patienteng = casedata_enc.patientname != '' && casedata_enc.patientname != undefined ? casedata_enc
                .patientname : ''
            let visitno = casedata_enc.visitno != '' && casedata_enc.visitno != undefined ? casedata_enc.visitno : ''
            let time = casedata_enc.time != '' && casedata_enc.time != undefined ? casedata_enc.time.replace(/.{2}/g, '$&:')
                .slice(0, 5) : ''
            $.post('{{ url('api/siphconnect') }}', {
                event: "import_caseworklist_recorder",
                hn: hn,
                patientname: patientname,
                useropen: useropen,
                doctorname: doctorname,
                procedure: procedure,
                prediagnosis: prediagnosis,
                accessionnumber: accessionnumber,
                patienteng: patienteng,
                visitno: visitno,
                time: time,
                from: 'recorder'
            }, function(data, status) {
                let parse = JSON.parse(data)
                callmodal()
                if (parse != '' && parse != undefined) {

                    if (type == 'caselist') {
                        url = '{{ url('recorder') }}/caselist'
                        window.location.href = url
                    } else {
                        let casedata = {
                            "event": "case_data",
                            "patientname": parse.patientname,
                            "doctorname": parse.doctorname,
                            "procedurename": parse.procedurename,
                            "appointment": parse.appointment,
                            "age": parse.age,
                            "hn": parse.case_hn,
                            "cid": parse.caseuniq,
                            "caseuniq": parse.caseuniq,
                            // "_id": parse.caseuniq,
                            "open": 'capture',
                            "python": "true"
                        }
                        console.log(casedata);
                        if (casedata['hn'] != '' && casedata['hn'] != undefined) {
                            $.post("{{ url('api/capture') }}", {
                                "event": "recorder_action",
                                "cid": $('#case_id').val(),
                                "type": 'record_start'
                            }, function(data, status) {})
                            // let this_json = JSON.stringify(data)
                            // socket.emit('chat message', this_json)
                        }

                        $.post('{{url("api/capture")}}', {
                            "event":"set_data_config",
                            "data" : casedata,
                        }, function (data, status) {
                            let this_json = data
                            if (window.backend) {
                                window.backend.update_patient_data(this_json);
                                window.backend.open_camera_window();
                            }
                        })


                        // $.post('{{ url('api/capture') }}', {
                        //     "event": "set_data_config",
                        //     "data": casedata,
                        // }, function(data, status) {
                        //     let this_json = JSON.stringify(casedata)
                        //     socket.emit('chat message', this_json)
                        // })
                    }


                }
            })
        }

        function callmodal(){
            var loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'), {
                keyboard: false,
                backdrop: 'static'
            });
            loadingModal.show();

            setTimeout(function() {
                loadingModal.hide();
            }, 500);
        }
    </script>
@endsection
