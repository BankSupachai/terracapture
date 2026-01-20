@extends('layouts.layouts_index.main')

@section('title', 'EndoINDEX')
@section('style')
    <style>
        /* .btn-group>.btn-group:not(:last-child)>.btn, .btn-group>.btn.dropdown-toggle-split:first-child, .btn-group>.btn:not(:last-child):not(.dropdown-toggle) {
                                    background: #F3F6F9 !important;
                                    color: #4a5056 !important;
                                } */

        .rectangle_holding {
            width: 10px;
            height: 10px;
            background: #F7B84B
        }

        .rectangle_operation {
            width: 10px;
            height: 10px;
            background: #F06548
        }

        .rectangle_recovery {
            width: 10px;
            height: 10px;
            background: #3577F1;
        }

        .rectangle_discharged {
            width: 10px;
            height: 10px;
            background: #0AB39C
        }

        .fw-21 {
            font-size: 21px;
        }

        .progress {
            border-radius: 0px;
            height: 20px;
        }

        /* .btn-check:checked+.btn,
                .btn.active,
                .btn.show,
                .btn:first-child:active,
                :not(.btn-check)+.btn:active {
                    background: #f3f6f9 !important;
                    color: #4A5056 !important;
                    border: 1px solid #ffffff !important;
                } */

        .btn-group {
            background: #ffffff;
        }

        .scroll-content {
            height: 24vh;
            overflow: auto;
        }

        ::-webkit-scrollbar {
            width: 0px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .select2-container--default .select2-selection--single {
            background: #ffffff !important;
        }

        .mid {
            margin: 0 auto;
            /* 0px ที่ด้านบน/ด้านล่าง, auto ที่ด้านซ้าย/ขวา */
            width: 98%;
        }

        .center {
            text-align: center;
        }
    </style>
@endsection
@section('title-left')
    <h4 class="mb-sm-0">IN-CHARGE MONITOR</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Cases list</a></li>
        <li class="breadcrumb-item active">Health Record</li>
    </ol>
@endsection
@section('content')
    @php
        use App\Models\Server;
        use App\Models\Patient;
    @endphp

    <form action="{{ url('casemonitor') }}" method="POST">
        @csrf
        <input type="hidden" name="event" value="search_inchargemonitor">

        <div class="row ">
            <div class="col-3">
                <div class="row">
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Hn" name="search_hn"
                            value="{{ @$search_hn . '' }}">
                    </div>
                    <div class="col-6">
                        <input type="text" class="form-control" placeholder="Name" name="search_name"
                            value="{{ @$search_name . '' }}">
                    </div>
                </div>


            </div>

            <div class="col-3">
                <div class="row">
                    <div class="col-6">
                        <select name="search_procedure" id="select2_procedure" class="form-select">
                            <option value="">Procedure</option>
                            @foreach ($procedure ?? [] as $proc)
                                    <option value="{{ $proc->name }}" @if (@$search_procedure == $proc->name) selected @endif>
                                    {{ $proc->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select name="search_doctor" id="select2_physician" class="form-select">
                            <option value="">Physician</option>
                            @foreach ($doctor ?? [] as $data2)
                                <option value="{{ @$data2 }}" @if (@$seach_doctor == $data2) selected @endif>
                                    {{ @$data2 }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>


            <div class="col-6">
                <div class="row">
                    <div class="col-auto">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check  check" name="btnradio" id="btnradio1" value="doctorview"
                                autocomplete="off" checked="">
                            <label class="btn btn-outline-primary m-0" for="btnradio1">Doctor View</label>

                            <input type="radio" class="btn-check check" name="btnradio" id="btnradio2"
                                value="departmentview" autocomplete="off">
                            <label class="btn btn-outline-primary m-0" for="btnradio2">Department View</label>


                        </div>
                        {{-- <select name="display_cardview" id="display_cardview" class="form-select">
                            <option value="DoctorView">Doctor View</option>
                            <option value="DepartmentView">Department View</option>
                        </select> --}}
                    </div>
                    <div class="col-lg-2">
                        <input type="text" class="form-control search_start_date textbox-n" name="search"
                            placeholder="Start date" onchange="search_data()" value="{{ @$search }}"
                            onfocus="(this.type='date')" onblur="(this.type='text')" id="date" />
                    </div>
                    <div class="col-lg-2">
                        <input type="text" class="form-control search_end_date textbox-n" placeholder="End Date"
                            onchange="search_data()" value="{{ @$search }}" onfocus="(this.type='date')"
                            onblur="(this.type='text')"id="date" />
                    </div>

                    <div class="col-4">
                        <button type="submit" class="btn btn-secondary btn-label waves-effect waves-light"><i
                                class="ri-search-line label-icon align-middle fs-16 me-2"></i> Search
                        </button>
                        <a class="btn btn-warning w-25" href="{{ url('casemonitor/inchargemonitor') }}">Clear</a>
                        <button type="button" class="btn btn-success btn-icon waves-effect waves-light"><i
                                class="ri-printer-line"></i>
                        </button>
                    </div>
                </div>


            </div>

        </div>

    </form>


    <div class="branch_view" style="display:none;">
        @include('EndoCAPTURE.nurse_monitor.inchargeMonitor.incharge_branch')
    </div>
    <div class="doctor_view" @if(!isset($tb_casemonitor) || count($tb_casemonitor) == 0) style="display:none;" @endif>
        @include('EndoCAPTURE.nurse_monitor.inchargeMonitor.incharge_doctor')
    </div>

    <div class="card mt-3">
        <div class="card-body m-0 p-0">
            <table class="table table-borderless">
                <tr style="color: #9599AD; border-bottom: 1px solid #E9EBEC">
                    <td>Patient Sta.</td>
                    <td>Report Sta.</td>
                    <td>VNA</td>
                    <td>HN</td>
                    <td>Name</td>
                    <td>Procedure</td>
                    <td>Check in</td>
                    <td>Room</td>
                    <td>Start</td>
                    <td>End</td>
                    <td>Discharge</td>
                    <td>Discharge to</td>
                    <td>Endoscopist</td>
                </tr>
                {{-- @dd($tb_casemonitor); --}}


                @isset($tb_casemonitor)
                    @forelse ($tb_casemonitor as $case)
                        <tr style="border-bottom: 1px solid #E9EBEC">
                            {{-- @dd($case) --}}
                            <td>
                                @if (@$case['monitor_status'] == 'Register')
                                    <span class="badge badge-soft-warning">REGISTER</span>
                                @endif

                                @if (@$case['monitor_status'] == 'Holding')
                                    <span class="badge badge-soft-warning">HOLDING</span>
                                @endif

                                @if (@$case['monitor_status'] == 'Operation')
                                    <span class="badge  badge-soft-danger">OPERATION</span>
                                @endif
                                @if (@$case['monitor_status'] == 'Recovery')
                                    <span class="badge  badge-soft-secondary fs-12">RECOVERY</span>
                                @endif

                                @if (@$case['monitor_status'] == 'Discharged')
                                    <span class="badge  badge-soft-success">DISCHARGED</span>
                                @endif
                            </td>
                            <td>
                                {{-- @dd($case) --}}
                                @if (@$case['monitor_reportstatus'] == 'draft')
                                    <span class="badge badge-soft-warning">DRAFT</span>
                                @endif


                                @if (@$case['monitor_reportstatus'] == 'final')
                                    <span class="badge badge-soft-success">FINAL</span>
                                @endif
                            </td>
                            <td>
                                {{-- <i class="ri-checkbox-circle-fill ri-lg text-success"></i> --}}
                            </td>
                            <td>
                                <a href="" class="text-color-index">{{ @$case['monitor_hn'] }}</a>
                            </td>
                            <td>
                                <a href="" class="text-color-index">
                                    {{ Patient::fullname_patient($case['monitor_hn']) ?? $case['monitor_patientname'] }}
                                </a>
                            </td>
                            <td>{{ @$case['monitor_procedure'] }}</td>
                            <td>{{ @$case['monitor_timevisit'] }}</td>
                            <td>
                                @php
                                    $tb_room = Server::table('tb_room')
                                        ->where('room_id', $case['monitor_room'])
                                        ->first();
                                    // dd($tb_room);
                                @endphp

                                @if (empty(@$tb_room['room_name']))
                                    -
                                @else
                                    {{ @$tb_room['room_name'] }}
                                @endif




                            </td>
                            @php
                                $tb_case = Server::table('tb_case')
                                    ->where('case_hn', $case['monitor_hn'])
                                    ->where('appointment_date', date('Y-m-d'))
                                    ->get();

                                $time_start = empty($tb_case[0]['time_start']) ? '-' : $tb_case[0]['time_start'];
                                $time_end = empty($tb_case[0]['time_end']) ? '-' : $tb_case[0]['time_end'];

                            @endphp
                            <td>{{ @$time_start }}</td>
                            <td>{{ @$time_end }}</td>
                            <td>
                                @if (empty($case['monitor_discharge_time']))
                                    -
                                @else
                                    {{ @$case['monitor_discharge_time'] }}
                                @endif
                            </td>
                            <td>
                                @if (empty($case['monitor_discharge_to']))
                                    -
                                @else
                                    {{ @$case['monitor_discharge_to'] }}
                                @endif
                            </td>
                            <td>{{ @$case['monitor_doctorname'] }}</td>
                        </tr>
                    @empty

                        <tr>
                            <td colspan="13" style=" height: 39vh;">
                                <div class="row">
                                    <div class="col-12 center" style="margin-top: 130px;">
                                        <h3>No Data Found !</h3>
                                    </div>
                                    <div class="col-4"></div>
                                    <div class="col-4 mt-3" style="border-bottom: 1px solid #70707050;"></div>
                                    <div class="col-12 center mt-4">
                                        <h3 style="color: #F06548B2">Please verify the status before proceeding</h3>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                @endisset
            </table>
        </div>
    </div>
@endsection


@section('script')


    <script>
        $(".check").change(function() {
            var display_card = $(this).val()
            if (display_card == "departmentview") {
                $(".doctor_view").hide("slow");
                $(".branch_view").show("slow");
            }
            if (display_card == "doctorview") {
                $(".doctor_view").show("slow");
                $(".branch_view").hide("slow");
            }
        });


        // $("input[name['btnradio']]").change(function() {
        //     alert(1)
        //     var display_card =  $("input[name='btnradio']:checked").val();;

        //     if (display_card == "departmentview") {
        //         $(".doctor_view").hide("slow");
        //         $(".branch_view").show("slow");
        //     }
        //     if (display_card == "doctorview") {
        //         $(".doctor_view").show("slow");
        //         $(".branch_view").hide("slow");
        //     }
        // })
    </script>




















    <script>
        $(document).ready(function() {
            $('#select2_procedure').select2({
                placeholder: "Select Procedure",
                allowClear: true
            });

            $('#select2_procedure').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(200);
                });
            });

            $('#select2_physician').select2({
                placeholder: "Select physician",
                allowClear: true
            });

            $('#select2_physician').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(200);
                });
            });

        });
    </script>

@endsection
