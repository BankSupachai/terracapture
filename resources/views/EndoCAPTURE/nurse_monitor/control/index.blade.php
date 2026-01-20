@extends('layouts.layouts_index.main')
@section('title', 'Nurse Monitor')
@section('style')
    <style>
        .text-under {
            -webkit-text-decoration-line: underline;
            /* Safari */
            text-decoration-line: underline;
        }
        .form-select , .form-control{
            --vz-input-bg: #F3F6F9;
            border: 0;
        }

        td {
            vertical-align: middle;
        }

        .font-blue {
            color: #245788
        }

        .btn-dark-primary:hover {
            background: #103d68;
            color: #fff;
        }

        .badge-outline-case {
            border: 1px solid #CED4DA;
            background: transparent;
            color: #707070;
        }

        .fw-head-dark {
            color: #535353;
            font-weight: 600;
        }

        .btn-icon {
            border-radius: 5px;#
        }

        .btn-orange {
            background: #DF6E51;
            color: #FFFFFF;
        }

        .booking tr td:nth-child(1){width: 5%;}
        .booking tr td:nth-child(2) {width: 5%;}
        .booking tr td:nth-child(3) {width: 5%;}
        .booking tr td:nth-child(4) {width: 10%;}
        .booking tr td:nth-child(5) {width: 10%;}
        .booking tr td:nth-child(6) {width: 10%;}
        .booking tr td:nth-child(7) {width: 10%;}
        .booking tr td:nth-child(8) {width: 10%;}
        .booking tr td:nth-child(9) {width: 15%;}
        .booking tr td:nth-child(10) {width: 10%;}

        .register tr td:nth-child(1){width: 5%;}
        .register tr td:nth-child(2) {width: 5%;}
        .register tr td:nth-child(3) {width: 5%;}
        .register tr td:nth-child(4) {width: 10%;}
        .register tr td:nth-child(5) {width: 10%;}
        .register tr td:nth-child(6) {width: 10%;}
        .register tr td:nth-child(7) {width: 10%;}
        .register tr td:nth-child(8) {width: 10%;}
        .register tr td:nth-child(9) {width: 15%;}
        .register tr td:nth-child(10) {width: 10%;}




        .holding tr td:nth-child(1) {width: 5%;}
        .holding tr td:nth-child(2) {width: 5%;}
        .holding tr td:nth-child(3) {width: 5%;}
        .holding tr td:nth-child(4) {width: 10%;}
        .holding tr td:nth-child(5) {width: 10%;}
        .holding tr td:nth-child(6) {width: 10%;}
        .holding tr td:nth-child(7) {width: 10%;}
        .holding tr td:nth-child(8) {width: 10%;}
        .holding tr td:nth-child(9) {width: 15%;}
        .holding tr td:nth-child(10) {width: 10%;}

        .operation tr td:nth-child(1) {width: 5%;}
        .operation tr td:nth-child(2) {width: 5%;}
        .operation tr td:nth-child(3) {width: 5%;}
        .operation tr td:nth-child(4) {width: 10%;}
        .operation tr td:nth-child(5) {width: 10%;}
        .operation tr td:nth-child(6) {width: 10%;}
        .operation tr td:nth-child(7) {width: 10%;}
        .operation tr td:nth-child(8) {width: 10%;}
        .operation tr td:nth-child(9) {width: 15%;}
        .operation tr td:nth-child(10) {width: 10%;}




        .recovery tr td:nth-child(1) {width: 5%;}
        .recovery tr td:nth-child(2) {width: 5%;}
        .recovery tr td:nth-child(3) {width: 5%;}
        .recovery tr td:nth-child(4) {width: 10%;}
        .recovery tr td:nth-child(5) {width: 10%;}
        .recovery tr td:nth-child(6) {width: 10%;}
        .recovery tr td:nth-child(7) {width: 10%;}
        .recovery tr td:nth-child(8) {width: 10%;}
        .recovery tr td:nth-child(9) {width: 15%;}
        .recovery tr td:nth-child(10) {width: 10%;}





        .highlight {
            background-color: yellow;
        }

        .current {
            background-color: orange;
        }

        /* .page-title-box {
            margin-top: -60px !important;
        } */
    </style>
@endsection

@section('title-left')
    <h4 class="mb-sm-0">CASE Control</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Case Control</a></li>
        <li class="breadcrumb-item active">Control</li>
    </ol>
@endsection

@section('modal')

    @include('EndoCAPTURE.nurse_monitor.component.modal_editstatus')
    @include('EndoCAPTURE.nurse_monitor.component.modalRegister')
    @include('EndoCAPTURE.nurse_monitor.component.modalCancleCaseHn')
    @include('EndoCAPTURE.nurse_monitor.component.modalroom')
    @include('EndoCAPTURE.nurse_monitor.component.modal_patient')
    @include('EndoCAPTURE.nurse_monitor.component.modal_discharge')
    @include('EndoCAPTURE.nurse_monitor.component.modal_confirm_hide')
    @include('EndoCAPTURE.nurse_monitor.component.modal_multi_confirm_hide')
    @include('EndoCAPTURE.nurse_monitor.component.modal_confirm_show')
    @include('EndoCAPTURE.nurse_monitor.component.modal_multi_confirm_show')

    {{-- @include('EndoCAPTURE.nurse_monitor.component.modal_ChangeLayoutTv') --}}



@endsection
@section('content')
{{-- @dd($room_location) --}}
    <div class="row m-0 mb-5">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-body">
                    @include('endocapture.nurse_monitor.control.officesetting')
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="mb-0">
                @include('endocapture.nurse_monitor.control.queue_note')
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card p-3 mb-0">
                @include('endocapture.nurse_monitor.control.search')
            </div>
        </div>
        @php
            $count_operation = get_case_count($tb_casemonitor['operation']);
            $count_recovery = get_case_count($tb_casemonitor['recovery']);
            $count_register = get_case_count($tb_casemonitor['register']);
            $j = 0;
        @endphp
   {{-- @dd($tb_casemonitor['register']); --}}
        <div class="col-lg-12" id="context">
            <div class="row m-0">
                {{-- ห้ามลบ จนกว่าจะทำ superadmin booking เสร็จ --}}
                @if (false)
                    @include('endocapture.nurse_monitor.control.booking_no_system')
                @else
                    {{-- @dd($tb_booking) --}}
                    @include('endocapture.nurse_monitor.control.booking')
                @endif

                {{-- ห้ามลบ จนกว่าจะทำ superadmin booking เสร็จ --}}
                @include('endocapture.nurse_monitor.control.register')
                @include('endocapture.nurse_monitor.control.holding')
                @include('endocapture.nurse_monitor.control.operation_and_reporting')
                @include('endocapture.nurse_monitor.control.recovery_and_discharge')
                @include('endocapture.nurse_monitor.control.hide_display')


                <button type="button" id="btn_notification" style="display: none" data-toast data-toast-text="Data updated"
                    data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000"
                    data-toast-close="close" class="btn btn-light w-xs"><span> Right</span>
                </button>

            </div>
        </div>
    </div>
    </div>
    </div>
@endsection

@php
    $admin = getConfig('admin');
    $server_name = @$admin->server_name;
@endphp


@section('script')
    <script src="{{ url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
    <script src="{{ url('public/js/qrcode.min.js') }}"></script>
    <script src="{{ url('public/plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>















    <script src="http://{{ getconfig('admin')->server_name) }}:3000/socket.io/socket.io.js"></script>
    <script>
        var socket = io.connect('http://{{ getconfig('admin')->server_name }}:3000');
        socket.on('chat message', function(msg) {
            if (msg == "casemonitor") {
                location.reload();
                // $("#btn_notification").trigger('click');
            }
        });
    </script>


    <script>
       var ขอเชิญหมายเลข = new Audio("{{domainname("")}}/config/sound/queue/th/เชิญหมายเลข.wav");
    var sound0          = new Audio("{{domainname("")}}/config/sound/queue/th/0.wav");
    var sound1          = new Audio("{{domainname("")}}/config/sound/queue/th/1.wav");
    var sound2          = new Audio("{{domainname("")}}/config/sound/queue/th/2.wav");
    var sound3          = new Audio("{{domainname("")}}/config/sound/queue/th/3.wav");
    var sound4          = new Audio("{{domainname("")}}/config/sound/queue/th/4.wav");
    var sound5          = new Audio("{{domainname("")}}/config/sound/queue/th/5.wav");
    var sound6          = new Audio("{{domainname("")}}/config/sound/queue/th/6.wav");
    var sound7          = new Audio("{{domainname("")}}/config/sound/queue/th/7.wav");
    var sound8          = new Audio("{{domainname("")}}/config/sound/queue/th/8.wav");
    var sound9          = new Audio("{{domainname("")}}/config/sound/queue/th/9.wav");
    var soundA          = new Audio("{{domainname("")}}/config/sound/queue/th/A.wav");
    var soundC          = new Audio("{{domainname("")}}/config/sound/queue/th/C.wav");




        function QueueCALL(number) {
            const myArr = number.split("");
            ขอเชิญหมายเลข.play();
            setTimeout(() => {
                myArr.forEach(numberQUEUE);
            }, 1000);
        }

        function numberQUEUE(item, index) {
            var time = (1 + index) * 1000;
            setTimeout(() => {
                if (item == "A") {
                    soundA.play()
                }
                if (item == "C") {
                    soundC.play()
                }
                if (item == "0") {
                    sound0.play()
                }
                if (item == "1") {
                    sound1.play()
                }
                if (item == "2") {
                    sound2.play()
                }
                if (item == "3") {
                    sound3.play()
                }
                if (item == "4") {
                    sound4.play()
                }
                if (item == "5") {
                    sound5.play()
                }
                if (item == "6") {
                    sound6.play()
                }
                if (item == "7") {
                    sound7.play()
                }
                if (item == "8") {
                    sound8.play()
                }
                if (item == "9") {
                    sound9.play()
                }
            }, time);
        }


        $(".callQueue").click(function() {
            let queue = $(this).attr("queue");
            QueueCALL(queue);
            socket.emit('queue', '{"calling":"' + queue + '"}');
        });

        $(".qr_create").click(function() {
            let hn = $(this).attr('hn');
            let qtype_code = "009";
            let qtype_prefix = "9";
            let value = "none";
            if (value != null) {
                $.post("{{ url('casemonitor') }}", {
                    event: "queue_new",
                    hn: hn,
                    value: value,
                    qtype_code: qtype_code,
                    qtype_prefix: qtype_prefix,
                }, function(data, status) {
                    let json = JSON.parse(data);
                    let urlgen = "http://medicaendo.com/q/" + json.md5;
                    $("#q_number_modal").html(json.q_number);
                    $("#q_url_modal").val(urlgen);

                    // generate qrcode
                    generate_qrcode(urlgen)

                    console.log(json);
                    socket.emit('queue', 'refreshdata');
                    // setTimeout(() => {$('#exampleModal').modal('hide');}, 1500);
                    $.get("http://localhost:5000/?qcode=" + json.q_number, function(d, s) {});
                });
            }
        });

        function generate_qrcode(url) {
            $('#qrcode').empty()
            let qrcode_div = document.getElementById('qrcode')
            let qrcode = new QRCode(qrcode_div, {
                text: url,
                width: 128,
                height: 128,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            })
        }


        $(".checkin").click(function() {
            let hn = $(this).attr('hn');
            let qtype_code = "009";
            let qtype_prefix = "9";
            let value = "none";
            if (value != null) {
                $.post("{{ url('casemonitor') }}", {
                    event: "checkin",
                    hn: hn,
                    value: value,
                    qtype_code: qtype_code,
                    qtype_prefix: qtype_prefix,
                    department: "{{ $department }}",
                }, function(data, status) {
                    socket.emit('queue', 'refreshdata');
                    setTimeout(() => {
                        $('#exampleModal').modal('hide');
                    }, 1500);
                    $.get("http://localhost:5000/?qcode=" + data, function(data, status) {});
                    setTimeout(() => {
                        // window.location.reload();
                        // if(data != ''){
                        if (false) {
                            window.location.href =
                                `{{ url('book') }}/registration/${data}?from=casemonitor`
                        } else {
                            window.location.href = `{{ url('casemonitor/control') }}`
                        }
                    }, 1000);
                });
            } else {}
        });
    </script>



    <script>
        $('.remark').focusout(function() {
            var value = $(this).val();
            var hn = $(this).attr('hn');
            $.post('{{ url('casemonitor') }}', {
                event: 'remark',
                hn: hn,
                value: value,
                department: "{{ $department }}",
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });
        });



        $('.regis2book').click(function() {
            var hn = $(this).attr('hn');
            $.post('{{ url('casemonitor') }}', {
                event: 'regis2book',
                hn: hn,
                department: "{{ $department }}",
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });
        });

        $('.btn_update_monitor').click(function() {
            socket.emit('chat message', 'casemonitor');
        });


        function edit_case(id_json) {
            if (id_json != '' && id_json != undefined) {
                let ids = JSON.parse(id_json)
                ids = ids != undefined && ids != '' && Array.isArray(ids) ? ids : []



                $.post('{{ url('api/casemonitor') }}', {
                    event: 'get_case_detail',
                    caseuniq: id_json
                }, function(data, status) {
                    console.log(data);
                    let casemonitor_patient = JSON.parse(data)
                    let monitor_procedure = casemonitor_patient.monitor_procedure ?? []
                    let caseuniq = casemonitor_patient.caseuniq ?? []
                    $('#modal_editcase_hn').html(casemonitor_patient.monitor_hn);
                    $('#modal_editcase_fullname').html(casemonitor_patient.patient_name)
                    $("#select_status").val(casemonitor_patient.monitor_status).change();
                    let options = monitor_procedure.map((procedurename, i) => {
                        return {
                        id: procedurename,
                        text: procedurename,
                        caseuniq: caseuniq[i] || "",
                        };
                    });



                    $('#sel_procedure').on('select2:select', set_caseuniq)
                    $('#sel_procedure').on('select2:unselect', set_caseuniq)

                    function set_caseuniq(){
                        let selected = $('#sel_procedure').find(':selected')
                        let caseuniqs = []
                        for (let i = 0; i < selected.length; i++) {
                            let caseuniq = $(selected[i]).data('caseuniq') ?? ''
                            if(caseuniq && caseuniq != ''){
                                caseuniqs.push(caseuniq)
                            }
                        }
                        caseuniqs = JSON.stringify(caseuniqs)
                        $('#modal_editstatus_caseuniq').val(caseuniqs)
                    }

                    $('#sel_procedure').html(monitor_procedure)
                    $('#modal_editcase_doctor').html(casemonitor_patient.monitor_doctorname)
                    $("#modal_editstatus_caseuniq").val(id_json);

                });

                $('#modal_editstatus').modal('show')
                $('#hide_caseid').val(id_json)

            }
        }





        function hide_case(id_json) {
            // alert(id_json)
            if (id_json != '' && id_json != undefined) {
                let ids = JSON.parse(id_json)
                ids = ids != undefined && ids != '' && Array.isArray(ids) ? ids : []
                if (ids.length == 1) {

                    $.post('{{ url('api/casemonitor') }}', {
                        event: 'get_case_detail',
                        caseuniq: id_json
                    }, function(data, status) {
                        // console.log(data);
                       let casemonitor_patient = JSON.parse(data)
                            console.log(casemonitor_patient , "1111111111");
                            $('#modal_cancelcase_hn').html(casemonitor_patient.monitor_hn);
                            $('#modal_cancelcase_fullname').html(casemonitor_patient.patient_name)
                            $('#modal_cancelcase_procedure').html(casemonitor_patient.monitor_procedure)
                            $('#modal_cancelcase_doctor').html(casemonitor_patient.monitor_doctorname)
                            $("#select_status").val(casemonitor_patient.monitor_status)

                        // alert(id_json)
                        // socket.emit('chat message', 'casemonitor');
                    });



                    $('#confirm_hide_modal').modal('show')
                } else {


                    get_casemonitor_detail(id_json, 'hide')
                }
                $('#hide_caseid').val(id_json)


            }
        }

        $('#confirm_hide_btn').on('click', function() {
            let caseuniq = $('#hide_caseid').val()
            $.post('{{ url('casemonitor') }}', {
                event: 'hide_case',
                caseuniq: caseuniq
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });
        })

        $('#multi_confirm_hide_btn').on('click', function() {
            let caseuniq = $('#muti_hide_caseid').val()
            $.post('{{ url('casemonitor') }}', {
                event: 'hide_multicase',
                caseuniq: caseuniq
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });
        })

        function show_case(id_json) {
            if (id_json != '' && id_json != undefined) {
                let ids = JSON.parse(id_json)
                ids = ids != undefined && ids != '' && Array.isArray(ids) ? ids : []
                if (ids.length == 1) {

                    $.post('{{url('api/casemonitor')}}',{
                        event: 'get_case_detail',
                        caseuniq: id_json
                    }, function(data, status){
                        console.log(data);
                        let casemonitor_patient = JSON.parse(data)
                        console.log(casemonitor_patient);
                            $('#modal_showcase_hn').html(casemonitor_patient.monitor_hn);
                            $('#modal_showcase_fullname').html(casemonitor_patient.patient_name)
                            $('#modal_showcase_procedure').html(casemonitor_patient.monitor_procedure)
                            $('#modal_showcase_doctor').html(casemonitor_patient.monitor_doctorname)
                    })

                    $('#confirm_show_modal').modal('show')
                } else {
                    get_casemonitor_detail(id_json, 'show')
                }
                $('#show_caseid').val(id_json)

            }
        }

        $('#confirm_show_btn').on('click', function() {
            let caseuniq = $('#show_caseid').val()
            $.post('{{ url('casemonitor') }}', {
                event: 'show_case',
                caseuniq: caseuniq
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });
        })

        $('#multi_confirm_show_btn').on('click', function() {
            let caseuniq = $('#muti_show_caseid').val()
            $.post('{{ url('casemonitor') }}', {
                event: 'show_multicase',
                caseuniq: caseuniq
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });
        })

        function get_casemonitor_detail(caseuniq_json, type) {
            $.post('{{ url('casemonitor') }}', {
                event: 'get_casemonitor_detail',
                caseuniq: caseuniq_json
            }, function(data, status) {
                let parse = JSON.parse(data)
                $(`#${type}_detail_tbody`).empty()
                // console.log(parse);
                parse.forEach((e, i) => {
                    let physician_name = e.monitor_doctorname != undefined && e.monitor_doctorname != '' ? e
                        .monitor_doctorname : ''
                    let procedure = e.monitor_procedure != undefined && e.monitor_procedure != '' ? e
                        .monitor_procedure : ''
                    let patient_name = e.monitor_patientname != undefined && e.monitor_patientname != '' ? e
                        .monitor_patientname : ''
                    let hn = e.monitor_hn != undefined && e.monitor_hn != '' ? e.monitor_hn : ''
                    $(`#${type}_hn`).html(hn)
                    $(`#${type}_name`).html(patient_name)
                    $(`#case_cancel_doctor`).html(physician_name)
                    $(`#${type}_detail_tbody`).append(`
                        <tr>
                            <td width="10%">
                                <input type="checkbox" class="form-check-input ${type}-case-ck" data-caseuniq="${e.caseuniq}">
                            </td>

                            <td>${procedure}</td>
                        </tr>
                    `)
                })

                $(`#multi_confirm_${type}_modal`).modal('show')

                $(`.${type}-case-ck`).on('click', function() {
                    let main = []
                    for (let i = 0; i < $(`.${type}-case-ck`).length; i++) {
                        let is_checked = $($(`.${type}-case-ck`)[i]).is(':checked')
                        let this_caseuniq = $($(`.${type}-case-ck`)[i]).data('caseuniq')
                        if (is_checked) {
                            main.push(this_caseuniq)
                        }
                    }
                    $(`#muti_${type}_caseid`).val(main)
                })

            });
        }





        function cancel_case(hn, procs, _id, is_booking = false, type) {

            hn = $(`#${type}_${hn}`).val()
            procs = JSON.parse(procs)
            _id = JSON.parse(_id)
            var close_status = 'none'
            console.log(hn, procs, _id);

            $('#modal_cancel_hn').modal('show');

            $('#delete_div').empty()

            var procs_num = 0
            if (typeof(procs) == 'string' || is_booking == true) {
                procs_num = 1
            } else {
                procs_num = procs.length
            }

            var content = ''
            if (procs_num == 1) {
                close_status = 'block'
                proc_content = is_booking == true ? procs.join(', ') : procs[0]

                var temp_inp = ''
                if (is_booking) {
                    temp_inp = `<input type="text" name="tb_book" value="tb_book" hidden>`
                }
                // console.log(pro);
                content = `
                    ${temp_inp}
                    <input type="text" name="cancel_id" value="${_id[0]}" hidden>

                    <div class="row " style="color: #878A99">
                        <div class="col-3 ms-5">
                            <span  >HN / Name </span>
                        </div>
                        <div class="col-6">
                            <span style="">${hn} นายสดายุ ทองลอย</span>
                        </div>

                    </div>
                    <div class="row mt-2" style="color: #878A99">
                        <div class="col-3 ms-5">
                            <span >Procedure</span>
                        </div>
                        <div class="col-6">
                            <span >${proc_content}</span>
                        </div>
                    </div>
                    <div class="row mt-2" style="color: #878A99">
                        <div class="col-3 ms-5">
                            <span >Endoscopist</span>
                        </div>
                        <div class="col-6">
                            <span >นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                        </div>
                    </div>
                    <div class="row mt-2" style="color: #878A99">
                        <div class="col-3 ms-5">
                                <span style="" >Reason </span>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control w-100" style="background: #F3F6F9; border: 0px;"                            </div>
                    </div>
                `
            } else if (procs_num > 1) {
                temp = ''
                procs.forEach((p, i) => {
                    var is_firstrow = i == 0 ? `<td rowspan="${procs_num}">${hn}</td>` : ''
                    temp += `
                        <tr class="text-center">
                            ${is_firstrow}
                            <td>${p}</td>
                            <td><button type="button" name="multi_case" value="${i}" class="btn btn-danger btn-sm" onclick="form_submit('${_id[i]}')"><i class="ri ri-delete-bin-6-line"></i></button></td>
                        </tr>
                    `
                })
                content = `
                    <div class="row">
                        <table class="table table-striped">
                            <input type="text" id="multi_case" name="multi_case" hidden>
                            <thead>
                                <tr>
                                    <th class="text-center">HN</th>
                                    <th class="text-center" scope="col">Procedure</th>
                                    <th class="text-center" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>` + temp +
                    `
                            </tbody>
                        </table>
                    </div>`
            }
            $('#delete_div').append(content)
            $('#close_modal_div').css('display', close_status)
        }

        function form_submit(_id) {
            $('#multi_case').val(_id)
            $('#cancel_form').submit()
        }

        $('.cancel_by_caseuniq').click(function() {
            var monitor_id = $(this).attr('monitor_id');
            var procedure = $(this).attr('procedure');
            $('#modal_cancel_caseuniq').modal('show');
            $('#caseuniq_cancel').val(monitor_id);
            $('#procedure_text').html(procedure);
        });


        $('.room_select').focusout(function() {
            var hn = $(this).attr('hn');
            var room_id = $(this).val();

            let is_register = $(this).hasClass('room-register')
            if (is_register) {
                // room_register(this)
            }

            $.post('{{ url('casemonitor') }}', {
                event: 'room_select',
                room_id: room_id,
                hn: hn,
                department: "{{ $department }}",
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });
        });


        function room_register(this_element) {
            // let hn = $(this_element).attr('hn');
            // let ids = $(this_element).attr('ids')
            // let room_id = $(this_element).val()
            // ids = JSON.parse(ids)
            // let qtype_code      = "009";
            // let qtype_prefix    = "9";
            // let value = "none";
            // $.post('{{ url('casemonitor') }}', {
            //     event: 'room_register',
            //     hn              : hn,
            //     ids             : ids,
            //     room_id         : room_id,
            //     value           : value,
            //     qtype_code      : qtype_code,
            //     qtype_prefix    : qtype_prefix,
            //     department      : "{{ $department }}",
            // }, function (data, status) {
            //     socket.emit('queue','refreshdata');
            //     setTimeout(() => {
            //         $('#exampleModal').modal('hide');
            //     }, 1500);
            //     $.get("http://localhost:5000/?qcode="+data, function(data, status){});
            //     setTimeout(() => {
            //         window.location.reload();
            //     }, 2000);
            // })
        }

        $('.location_select').focusout(function() {
            var hn = $(this).attr('hn');
            var location = $(this).val();
            $.post('{{ url('casemonitor') }}', {
                event: 'location_select',
                location: location,
                hn: hn,
                department: "{{ $department }}",
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });
        });


        $('.room_ready').click(function() {
            var room_id = $(this).attr('room_id');
            var checked = $(this).is(":checked");
            $.post('{{ url('casemonitor') }}', {
                event: 'room_ready',
                room_id: room_id,
                checked: checked,
                department: "{{ $department }}",
            }, function(data, status) {});
        });

        $('.calldoctor').click(function() {
            var room_id = $(this).attr('room_id');
            $('#room_inmodaldoctor').val(room_id);
            $('#modal_doctor').modal('show');
            $.post("{{ url('casemonitor') }}", {
                    event: 'getdoctor',
                    room: room_id,
                    department: "{{ $department }}",
                },
                function(data, status) {
                    obj = JSON.parse(data);
                    $('.doctor').prop('checked', false);
                    obj.forEach(function(item) {
                        $('#doctor' + item).prop('checked', true);ห
                        console.log(item);
                    });
                });
        });

        $('.callnurse').click(function() {
            var room_id = $(this).attr('room_id');
            $('#room_inmodalnurse').val(room_id);
            $('#modal_nurse').modal('show');
            $.post("{{ url('casemonitor') }}", {
                    event: 'getnurse',
                    room: room_id,
                    department: "{{ $department }}",
                },
                function(data, status) {
                    obj = JSON.parse(data);
                    $('.nurse').prop('checked', false);
                    obj.forEach(function(item) {
                        $('#nurse' + item).prop('checked', true);
                        console.log(item);
                    });
                });
        });

        $('.callregister').click(function() {
            var room_id = $(this).attr('room_id');
            $('#room_inmodalregister').val(room_id);
            $('#modal_register').modal('show');
            $.post("{{ url('casemonitor') }}", {
                    event: 'getregister',
                    room: room_id,
                    department: "{{ $department }}",
                },
                function(data, status) {
                    console.log(data);
                    obj = JSON.parse(data);
                    $('.register').prop('checked', false);
                    obj.forEach(function(item) {
                        $('#register' + item).prop('checked', true);
                        console.log(item);
                    });
                });
        });


        $('.btn-checkin').click(function() {
            var hn = $(this).attr('hn');
            $.post("{{ url('casemonitor') }}", {
                event: 'checkin',
                hn: hn,
                department: "{{ $department }}",
            }, function(data, status) {
                socket.emit('chat message', 'endocapture_home');
                socket.emit('chat message', 'casemonitor');
            });
        });


        $('.btn-discharge').click(function() {
            var hn = $(this).attr('hn');
            var cid = $(this).attr('cid');
            console.log(cid , discharge_redirect , hn);

            $.post("{{ url('casemonitor') }}", {
                event: 'discharge',
                hn: hn,
                department: "{{ $department }}",
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
                socket.emit('queue', 'refreshdata');


            });

        });









        $('#check_in_all').click(function() {
            $.post("{{ url('casemonitor') }}", {
                event: 'check_in_all',
                department: "{{ $department }}",
            }, function(data, status) {
                socket.emit('chat message', 'endocapture_home');
                socket.emit('chat message', 'casemonitor');
            });
        });

        $('#nurse_monitor_freetext').focusout(function() {
            var text = $(this).val();
            $.post("{{ url('casemonitor') }}", {
                event: 'update_nursemonitor',
                text: text,
                department: "{{ $department }}",
            }, function(data, status) {

            });
        });

        function save_description(type, hn, text, date, _id = '') {
            hn = $(`#${type}_${hn}`).val()
            date = $(`#${type}_${date}app`).val()
            console.log(type, hn, text, _id , date);
            $.post("{{ url('api') }}/jquery", {
                event: "save_description",
                type: type,
                hn: hn,
                text: text,
                date: date,
                department: "{{ $department }}",
                _id: _id
            }, function(data, status) {

            })
        }

        var is_first_search = true
        var track_text = ''
        var track_arr = []

        $('#search_text').click(() => {
            var search_input = $('#search_input').val()
            track_text = search_input

            window.find(search_input, false, false, true, false, false, false)

            // $('#current_found').html('0')
            // $('#max_found').html('0')

            // if(search_input !== "" && search_input.length > 1){
            //     remove_highlight()
            //     highlight(search_input, true)
            //     $('#search_text').prop('disabled', true)
            // }
        })

        $('#next_text').click(() => {
            var current_found = parseInt($('#current_found').html())
            var max_found = parseInt($('#max_found').html())
            if (current_found == max_found) {
                $('#current_found').html(1)
                remove_highlight(false, 'yellow')
                $($('.text-found')[0]).css('background-color', 'orange')
                $(window).scrollTop($($('.text-found')[0]).offset().top);
                return
            }

            var next_num = current_found + 1
            $('#current_found').html(next_num)
            var current_index = next_num - 1
            for (let i = 0; i < max_found; i++) {
                if (i == current_index) {
                    $($('.text-found')[current_index]).css('background-color', 'orange')
                    $(window).scrollTop($($('.text-found')[current_index]).offset().top);
                } else {
                    $($('.text-found')[i]).css('background-color', 'yellow')
                }
            }



        })

        $('#prev_text').click(() => {
            var current_found = parseInt($('#current_found').html())
            var max_found = parseInt($('#max_found').html())

            if (current_found == 1) {
                $('#current_found').html(max_found)
                remove_highlight()
                $($('.text-found')[max_found - 1]).css('background-color', 'orange')
                $(window).scrollTop($($('.text-found')[max_found - 1]).offset().top);

                return
            }

            var prev_num = current_found - 1
            $('#current_found').html(prev_num)
            var current_index = prev_num - 1
            for (let i = 0; i < max_found; i++) {
                if (i == current_index) {
                    $($('.text-found')[current_index]).css('background-color', 'orange')
                    $(window).scrollTop($($('.text-found')[current_index]).offset().top);
                } else {
                    $($('.text-found')[i]).css('background-color', 'yellow')
                }
            }

        })

        $('#clear_text').click(() => {
            var text = track_text
            $('#search_input').val('')
            $('#next_text').prop('disabled', true)
            $('#prev_text').prop('disabled', true)
            $('#clear_text').prop('disabled', true)
            is_first_search = true
            remove_highlight(true)
            replace_span()
            track_arr = []
        })

        function remove_highlight(is_hide_count = false, color = 'white') {
            var current_found = parseInt($('#current_found').html())
            var max_found = parseInt($('#max_found').html())
            for (let i = 0; i < max_found; i++) {
                $($('.text-found')[i]).css('background-color', color)
            }
            $('#search_text').prop('disabled', false)

            if (is_hide_count) {
                $('#count_div').css('display', 'none')
            }
        }


        $('#search_input').keyup(function(e) {
            var input = $(this).val()
            if (e.which === 13 && is_first_search == true) {
                $('#search_text').trigger('click')
                window.find(input, false, false, true, false, false, false)
            } else if (e.which == 13 && is_first_search == false) {
                // $('#next_text').trigger('click')
                let is_last = window.find(input, false, false, true, false, false, false)
                if (is_last) {
                    window.find(input, false, false, true, false, false, false)
                }

            }
        })

        $('#search_input').on('paste', function(e) {
            hide_count()
            $('#next_text').prop('disabled', true)
            $('#prev_text').prop('disabled', true)
            $('#clear_text').prop('disabled', true)
            replace_span()
            is_first_search = true
            track_text == e.target.value
            track_arr = []
            $('#search_text').prop('disabled', false)
        })

        $('#search_input').on('input', function(e) {
            var input = $(this).val()
            if (input == '') {
                $('#next_text').prop('disabled', true)
                $('#prev_text').prop('disabled', true)
                $('#clear_text').prop('disabled', true)
                replace_span()
                hide_count()
                track_text = ''
                track_arr = []
                is_first_search = true


            } else {
                is_first_search = true
                replace_span()
                hide_count()
            }
            $('#search_text').prop('disabled', false)
        })

        function highlight(text, is_first = false) {
            var inputText = document.getElementById("context");
            var innerHTML = inputText.innerHTML;
            var index = innerHTML.indexOf(text.trim());
            var html = ''
            const regEscape = v => v.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
            if (index >= 0) {
                var num = innerHTML.split(new RegExp(regEscape(text), "ig")).length
                var arr = innerHTML.split(new RegExp(regEscape(text), "ig"))
                var ori_texts = [...innerHTML.matchAll(new RegExp(text, 'gi'))].map(a => a[0])
                track_arr = ori_texts
                for (let i = 0; i < num; i++) {
                    var span = ori_texts[i] !== undefined ? `<span class='text-found' style='background-color:yellow'>` +
                        ori_texts[i] + `</span>` : ''

                    html += arr[i] + span
                }
                inputText.innerHTML = html
                // inputText.innerHTML=innerHTML.split(new RegExp(regEscape(text), "ig")).join(`<span class='text-found' style='background-color:yellow'>`+text+`</span>`);
            }

            if (index < 0) {
                track_text = ''
                return
            }

            if (is_first) {
                if ($($('.text-found')[0]).html() === undefined) {
                    track_text = ''
                    return
                }

                var found_num = $('.text-found').length
                $('#count_div').css('display', 'block')
                // $('#search_input').prop('disabled', true)
                $('#max_found').html(found_num)
                $('#current_found').html(1)
                $($('.text-found')[0]).css('background-color', 'orange')
                is_first_search = false

                $(window).scrollTop($($('.text-found')[0]).offset().top);

                $('#next_text').prop('disabled', false)
                $('#prev_text').prop('disabled', false)
                $('#clear_text').prop('disabled', false)
            }

        }

        function hide_count() {
            $('#max_found').html(0)
            $('#current_found').html(0)
            $('#count_div').css('display', 'none')
        }

        function replace_span() {
            var inputText = document.getElementById("context");
            var i = 0
            do {
                var spanhtml = $($('.text-found')[0]).get(0).outerHTML
                inputText.innerHTML = inputText.innerHTML.replaceAll(spanhtml, track_arr[i])
                i++
            } while ($('.text-found').length > 0)
        }
    </script>


    <script>
        $(".modalqr").click(function() {
            $("#modalQueue").modal("show");
        });
    </script>

@endsection
