{{-- @extends('capture.layout.main') --}}
@extends('capture.layoutv6')

@section('title', 'EndoINDEX')
@section('style')
    <style>
        html {
            min-height: 100% !important
        }

        .select2-container .select2-selection--multiple {
            background-color: var(--vz-input-bg);

        }

        /* body{overflow: hidden;} */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #192D4B;
            color: #eae7e7;
            border: none;
        }

        .btn-operation {
            height: 97px;
            width: 170px;
            background: #245788;
            color: #fff
        }

        .btn-operation:hover {
            color: #fff;
            background: #245788;
        }

        .btn-summary:hover {
            color: #fff;
            background: #22917a;
        }

        .btn-summary {
            height: 97px;
            width: 170px;
            /* background: #51B09D;
                                        color: #fff; */
            background: #F3F3F9;
            color: #5f5c5c
        }

        ::-webkit-scrollbar {
            width: 10px !important;
            height: 10px !important;
            -webkit-border-radius: 4px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1 !important;
        }

        ::-webkit-scrollbar-thumb {
            background: #888 !important;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555 !important;
        }

        .btn-summary-active {
            color: #fff;
            background: #22917a;
        }

        .btn-operation-active {
            color: #fff;
            background: #245788;
        }

        .btn-not-active {
            background: #dfe3e2;
            color: #5f5c5c
        }

        .btn:disabled,
        fieldset:disabled .btn {
            pointer-events: none;
            opacity: 1;
            color: #F3F3F9 !important;
            border: 0px transparent !important;
            background: #F4F6F9 !important;
        }

        .text-summary {
            position: absolute;
            vertical-align: middle;
        }

        .iconupper {
            display: block;
        }

        .choices__input {
            background-color: #F3F3F9;
        }

        .search-input {
            width: 100%;
            background-color: #F3F3F9;
            color: #9599AD;
            border: 0px transparent !important;
        }

        .search-input:focus {
            width: 100%;
            background-color: #F3F3F9;
            color: #9599AD;
            border: 0px transparent !important;
        }

        .select2-selection {
            background-color: #F3F3F9 !important;
            border-color: transparent !important;
        }

        .normal-text {
            color: #9599AD;
        }

        .t-summary tr td:nth-child(1) {
            width: 10%
        }

        .t-summary tr td:nth-child(2) {
            width: 25%
        }

        .t-summary tr td:nth-child(3) {
            width: 25%
        }

        .t-summary tr td:nth-child(4) {
            width: 20%
        }

        .t-summary tr td:nth-child(4) {
            width: 20%
        }

        #table_export {
            height: 400px;
            overflow: auto;
        }

        #table_export,
        tr,
        td {
            white-space: nowrap;
        }

        .pagination {
            flex-wrap: wrap;
        }

        .select2-container .select2-selection--multiple {
            height: 37px !important;
            overflow-y: auto !important;
            max-height: 37px !important;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .select2-container .select2-selection--multiple::-webkit-scrollbar {
            display: none;
        }

        .select2-container .select2-search--inline .select2-search__field {
            margin-top: 9px !important;
        }

        @media only screen and (max-width: 1814px) {
            .w-res {
                width: 150px;
            }
        }

        @media only screen and (max-width: 1650px) {
            .w-res {
                width: 120px;
            }
        }

        @media only screen and (max-width: 1400px) {
            .w-res {
                margin-top: 1em;
                width: 100%;
            }
        }

        .active>.page-link,
        .page-link.active {
            z-index: 3;
            color: #fff;
            background-color: #192D4B;
            border-color: #192D4B;
        }

        /* .export-scroll-table{
                                            height: 542px;
                                            overflow: auto;
                                        }
                                        .export-scroll-table  thead tr {
                                        position: sticky;
                                        top: 0px;
                                        z-index: 1;
                                        } */
    </style>

    <script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
    <script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
    <script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>

@endsection

@section('modal')
    <div id="user_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Export by</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <select name="user_export" id="user_export" class="form-select mb-3 search-input user_export" required>
                        <option value="">&nbsp;User</option>
                        @isset($users_modal)
                            @foreach ($users_modal as $u)
                                @php
                                    $fullname =
                                        @$u->user_prefix . '' . @$u->user_firstname . ' ' . @$u->user_lastname;
                                @endphp
                                <option value="{{ @$u->id }}"
                                    @isset($filter['ft_user']) @if (in_array($fullname, $filter['ft_user'])) selected @endif  @endisset>
                                    {{ @$fullname }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    @if (@$type . '' == 'operation')
                        <button type="button" class="btn btn-primary export-modal-btn"
                            onclick="operationExcel('xlsx', '{{ @$is_phutshin }}')">Export</button>
                    @else
                        <button type="button" class="btn btn-primary export-modal-btn"
                            onclick="htmlTableToExcel('xlsx', '{{ @$is_phutshin }}')">Export</button>
                    @endif
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
{{-- @section('title-left')
    <h4 class="mb-sm-0">EXPORT DATA </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
        <li class="breadcrumb-item active">Export</li>
    </ol>
@endsection --}}


@section('content')
@include('capture.camera.obs.js_hotkey')
    {{-- @dd($filter) --}}
    @php
        use App\Models\Mongo;
    @endphp
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ url('exportdata') }}" method="POST">
                        @csrf
                        <input type="hidden" name="event" value="query_data">
                        <input type="hidden" name="action" value="show">
                        <div class="row m-0">
                            <div class="col-2">
                                <input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"
                                    class="form-control search-input" name="start_date" id="start_date"
                                    placeholder="Start-Date" onchange="check_start_date(this.value)"
                                    value="{{ @$filter['start_date'] }}">
                            </div>
                            <div class="col-2">
                                <input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"
                                    class="form-control search-input" name="end_date" id="end_date" placeholder="End-Date"
                                    value="{{ @$filter['end_date'] }}">
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control search-input" name="keyword" id="keyword" placeholder="ค้นหา" value="{{ @$filter['keyword'] }}">
                            </div>

                            <div class="col-2">

                                <select name="user[]" id="user" class="form-select mb-3 search-input"
                                    multiple="multiple">
                                    <option value="">&nbsp;Physician</option>

                                    @isset($doctor)
                                        @foreach ($doctor as $u)
                                            @php
                                                $fullname =
                                                    @$u->user_prefix .
                                                    '' .
                                                    @$u->user_firstname .
                                                    ' ' .
                                                    @$u->user_lastname .
                                                    ' ' .
                                                    @$u->user_code;
                                            @endphp
                                            <option value="{{ @$u->uid }}"
                                                @isset($filter['ft_user']) @if (in_array($fullname, $filter['ft_user'])) selected @endif  @endisset>
                                                {{ @$fullname }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            {{-- @dd($procedure) --}}
                            <div class="col-2">

                                <select name="procedure[]" id="procedure" class="form-select mb-3 search-input"
                                    multiple="multiple" onchange="get_icd(this.value)">
                                    <option value="">&nbsp;Procedure</option>
                                    @isset($procedure)
                                        @foreach ($procedure as $p)
                                            <option value="{{ @$p->code }}"
                                                @isset($filter['procedure']) @if (in_array(@$p->name, $filter['procedure'])) selected @endif  @endisset>
                                                {{ @$p->name }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="col-auto ps-2 pe-2">
                                <input type="hidden" id="type" name="type" value="operation">
                                <button id="query_btn" type="submit" class="btn btn-primary waves-effect waves-light"
                                    style="width:100%">
                                    <i class="ri-search-line label-icon align-middle"></i>
                                    <span class="align-middle">Search</span></button>
                            </div>
                            <div class="col-auto ps-2 pe-2">
                                <a id="clear_btn" href="{{ url('exportdata') }}"
                                    class="btn btn-warning waves-effect waves-light" style="width:100%">
                                    <i class="ri-eraser-fill label-icon align-middle " style=""></i> <span
                                        class="align-middle"> Clear</span></a>
                            </div>
                            {{-- <div class="col-1 mt-2 ms-3 show-spinner" style="display: none">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="col-2"></div> --}}

                            <div class="col-auto">
                                <div class="row">
                                    <div class=" text-end">
                                        <a class="btn btn-success yourlink pt-3 "><i class="ri-download-line ri-lg"></i></a>
                                        <script>
                                            $(".yourlink").click(function() {
                                                var urls = [
                                                    @for ($i = 0; $i < $download; $i++)
                                                        "{{ url("exportdata/$i/edit") }}",
                                                    @endfor
                                                ]

                                                var interval = setInterval(download, 300, urls);


                                                function download(urls) {
                                                    var url = urls.pop();

                                                    var a = document.createElement("a");
                                                    a.setAttribute('href', url);
                                                    a.setAttribute('download', '');
                                                    a.setAttribute('target', '_blank');
                                                    a.click();

                                                    if (urls.length == 0) {
                                                        clearInterval(interval);
                                                    }
                                                }

                                            });
                                        </script>




                                        {{-- <button data-filetype="xlsx" type="button" class="btn btn-primary waves-effect waves-light btn-res" id="export_excel" @if ($is_phutshin) data-bs-toggle="modal" data-bs-target="#user_modal"  @else onclick="htmlTableToExcel('xlsx')" @endif >Excel (.xlsx)</button> --}}
                                        {{-- <button data-filetype="csv" type="button" class="btn btn-primary waves-effect waves-light" id="export_csv" @if ($is_phutshin) data-bs-toggle="modal" data-bs-target="#user_modal" @else onclick="htmlTableToExcel('xlsx')" @endif>CSV (.csv)</button> --}}
                                        {{-- @if (@$type . '' == 'operation')
                                        <button data-filetype="csv" type="button"
                                            class="btn btn-primary waves-effect waves-light" id="export_csv"
                                            @if ($is_phutshin) data-bs-toggle="modal" data-bs-target="#user_modal" @else onclick="operationExcel('xlsx', '{{ @$is_phutshin }}')" @endif>CSV
                                            (.csv)</button>
                                    @else
                                        <button data-filetype="csv" type="button"
                                            class="btn btn-primary waves-effect waves-light" id="export_csv"
                                            @if ($is_phutshin) data-bs-toggle="modal" data-bs-target="#user_modal" @else onclick="htmlTableToExcel('xlsx', '{{ @$is_phutshin }}')" @endif>CSV
                                            (.csv)</button>
                                    @endif --}}
                                    </div>
                                    @if (@$type . '' == 'operation')
                                        <div class="col ms-0 me-0 pe-0">
                                            <span id="total_count_export">0 row(s)</span> <br>
                                            <span id="estimated_time_export">0 second(s)</span>
                                        </div>
                                    @endif
                                    <div class="col-1 ms-0 export-spinner" style="display: none">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="row mt-1" style="display: block">
                        <div id="select_head" class="row m-0">

                        </div>

                    </div>
                </div>
                <div style="height: 886px; overflow:auto">
                    <table class="table table-bordered ">
                        <thead class="table-light">
                            <tr>
                                <td>HN</td>
                                <td>Name</td>
                                <td>Age</td>
                                <td>Gender</td>
                                <td>Appointment Date</td>
                                <td>Procedure</td>
                                <td>Physician</td>
                                <td>Consultant</td>
                                <td>Assistant</td>
                                <td>Nurse</td>
                                <td>Nurse Assistant</td>
                                <td>Anesthesia</td>
                                <td>Nurse Anesthesia</td>
                                {{-- <td>Scientific</td> --}}
                                <td>User Branch</td>
                                <td>Department</td>
                                <td>Scope</td>
                                <td>Room</td>
                                <td>Ward</td>
                                <td>OPD</td>
                                <td>Refer</td>
                                <td>Patient in time</td>
                                <td>Start time</td>
                                <td>Withdrawal time</td>
                                <td>End time</td>
                                <td>Followup</td>
                                <td>Brief history</td>
                                <td>Pre-diagnosis</td>
                                <td>Indication</td>
                                <td>Indication other</td>
                                <td>Medication</td>
                                <td>Medication other</td>
                                <td>Anesthesia</td>
                                <td>Finding</td>
                                <td>Overall Findding</td>
                                <td>Diagnostic (Icd 10)</td>
                                <td>Diagnostic other</td>
                                <td>Procedure (Icd 9)</td>
                                <td>Procedure other</td>
                                <td>Bowel Preparation</td>
                                <td>Bowel other</td>

                                <td>Gastic Content</td>
                                <td>ESTIMATED BLOOD LOSS    </td>
                                <td>BLOOD TRANSFUSION    </td>
                                <td>Specimen</td>
                                <td>Complication</td>
                                <td>Complication other</td>
                                <td>Rapid urease test</td>
                                <td>Plan/Comment</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        {{-- @dd($tb_case); --}}
                        @foreach ($tb_case ?? [] as $index => $case)

                            @php
                                $case = (object) $case;

                                // $medication = $case->medication_unit ?? [];
                                $indication = $case->indication ?? [];
                                $anesthesia_medi = $case->anesthesia ?? [];
                                $finding = $case->finding ?? [];
                                $diagnostic = $case->diagnostic_text ?? [];
                                $procedure_icd9 = $case->procedure_subtext ?? [];
                                $complication = $case->complication ?? [];
                                $medication = $case->medication_unit ?? [];
                                $gastric_content = $case->gastriccontent ?? [];
                                $status = $case->statusjob ?? "";
                                $scope = $case->scope ?? [];
                                $tb_room = Mongo::table('tb_room')
                                    ->where('room_id', intval(@$case->room))
                                    ->first();

                                $room = @$tb_room->room_name;
                                // dd($scope);
                                foreach (@$scope as $value) {
                                    // dd($value);
                                    $tb_scope = Mongo::table('tb_scope')->where('scope_id', intval($value))->get();
                                }
                                $scopename = [];

                                if ($status == 'recovery') {
                                    $status = 'Complete';
                                } else {
                                    $status = 'Incomplete';
                                }
                                $arr = [];
                                foreach ($case->user_in_case ?? [] as $data) {
                                    $arr[] = (int) $data;
                                }
                                $user_list = Mongo::table('users')->whereIn('uid', $arr)->get();

                                // $nurse = user_in_case($user_list , "nurse");
                                $nurse_assiss = [];
                                $n = [];
                                $anesthesia = [];
                                $nurse_anes = [];
                                $viewer = [];
                                $sci = [];
                                foreach ($user_list as $key => $data) {
                                    // dd($user_list);
                                    $data = (object) $data;
                                    if ($data->user_type == 'nurse') {
                                        $n[] =
                                            $data->user_prefix .
                                            $data->user_firstname .
                                            ' ' .
                                            $data->user_lastname;
                                    }
                                    // dd($n);
                                    // dd($data->user_type)
                                    if ($data->user_type == 'nurse_assistant') {
                                        $nurse_assiss[] =
                                            $data->user_prefix .
                                            $data->user_firstname .
                                            ' ' .
                                            $data->user_lastname;
                                        // dd($nurse_assiss);
                                    }
                                    if ($data->user_type == 'anesthesia') {
                                        $anesthesia[] =
                                            $data->user_prefix .
                                            $data->user_firstname .
                                            ' ' .
                                            $data->user_lastname;
                                    }

                                    if ($data->user_type == 'nurse_anes') {
                                        $nurse_anes[] =
                                            $data->user_prefix .
                                            $data->user_firstname .
                                            ' ' .
                                            $data->user_lastname;
                                        // dd($register);
                                    }

                                    // if ($data['user_type'] == 'scientific') {
                                    //     $sci[] =
                                    //         $data['user_prefix'] .
                                    //         $data['user_firstname'] .
                                    //         ' ' .
                                    //         $data['user_lastname'];
                                    // }
                                }
                                @$gender = $case->gender;

                                if ($gender == 1) {
                                    $gender = 'Male';
                                } elseif ($gender == 2) {
                                    $gender = 'Female';
                                } else {
                                    $gender = 'N/A';
                                }
                                // dd($data['user_type']);

                                // $overall_finding = $case->overall_finding;
                            @endphp
                            <tr>
                                <td>{{ @$case->case_hn }}</td>
                                <td>{{ @$case->patientname }}</td>
                                <td>{{ @$case->age }}</td>
                                <td>{{ @$gender }}</td>
                                <td>{{ @$case->appointment }}</td>
                                <td>{{ @$case->procedurename }}</td>
                                <td>{{ @$case->doctorname }}</td>
                                <td>{{ @$case->case_consultname }}</td>
                                <td>
                                    {{ @$case->assistant ?? '-' }}
                                </td>
                                <td>
                                    {{-- {{$n}} --}}
                                    {{ implode(',', $n ?? []) }}
                                </td>
                                <td>{{ implode(',', $nurse_assiss) }}
                                    {{-- {{implode(',', $assistant ??  []) }} --}}
                                    {{-- {{$register->implode(',')}} --}}
                                </td>
                                <td>{{ implode(',', $anesthesia ?? []) }}</td>
                                <td>{{ implode(',', $nurse_anes ?? []) }}</td>
                                {{-- <td>{{ implode(',', $sci ?? []) }}</td> --}}

                                <td>{{ @$case->branch ?? '-' }}</td>
                                <td>{{ @$case->department }}</td>
                                <td>


                                    @foreach ($tb_scope ?? [] as $scope)
                                        @php
                                            $scopename[] = $scope->scope_name;

                                        @endphp
                                    @endforeach
                                    {{ implode(',', $scopename) }}

                                </td>
                                <td>{{ @$room }}</td>
                                <td>{{ @$case->ward ?? '-' }}</td>
                                <td>{{ @$case->opd ?? '-' }}</td>
                                <td>{{ @$case->refer ?? '-' }}</td>
                                <td>{{ @$case->time_patientin }}</td>
                                <td>{{ @$case->time_start ?? '-' }}</td>
                                <td>{{ @$case->time_withdrawal }}</td>
                                <td>{{ @$case->time_end }}</td>
                                <td>{{ @$case->followup_date }}</td>
                                <td>{{ @$case->case_history }}</td>
                                <td>{{ @$case->prediagnostic_other }}</td>
                                <td>
                                    {{ implode(', ', $indication) }}

                                </td>
                                <td>
                                    {{ @$case->indication_other ?? '-' }}
                                </td>
                                <td>
                                    {{ json_encode($medication) }}
                                </td>
                                <td>
                                    {{ @$case->medi_other ?? ' - ' }}
                                </td>


                                <td>
                                    {{ implode(' , ', $anesthesia_medi) }}
                                    {{ @$case->anesthesiaother ?? '' }}

                                </td>
                                <td>
                                    {{ json_encode($finding) }}

                                </td>
                                <td>

                                    {{ @$case->overall_finding ?? '-' }}
                                </td>
                                <td>
                                    {{ implode(',', array_filter($diagnostic)) }}
                                </td>
                                <td>{{ @$case->overall_diagnosis ?? '-' }}</td>
                                <td>{{ implode(',', array_filter($procedure_icd9)) }}</td>
                                <td>{{ @$case->overall_procedure ?? '-' }}</td>
                                <td>{{ @$case->bowel ?? '-' }} </td>
                                <td>{{ @$case->bowel_other ?? '' }}</td>
                                <td>{{ implode(',', array_filter($gastric_content)) }}</td>
                                <td>{{ @$case->blood_loss ?? ' - ' }} {{ @$case->bowel_other }}   </td>
                                <td>{{ @$case->blood_transfusion ?? ' - ' }}</td>
                                <td>
                                    @for ($i = 1; $i <= 10; $i++)
                                        @php
                                            $specimen = 'specimen' . $i;
                                            $bottle = 'specimenbottle' . $i;
                                        @endphp
                                        @if (!empty($case->$specimen) || !empty($case->$bottle))
                                            {{ @$case->$specimen }} {{ @$case->$bottle }} |
                                        @endif
                                    @endfor
                                </td>
                                <td>complication</td>
                                <td>{{ @$case->complication_other ?? '-' }}</td>
                                <td>{{ @$case->box_rapid_pending ?? '-' }}</td>
                                <td>{{ @$case->case_comment ?? '-' }}</td>

                                <td>{{ @$status }}</td>
                            </tr>
                        @endforeach

                    </table>
                </div>


            </div>
        </div>
        {{-- {{ $tb_case->onEachSide(5)->appends(request()->input())->links() }} --}}



    </div>
    </div>
@endsection

@section('script')

    <script src="{{ asset('public/plugins/moment/moment.js') }}">
        < /scrip> <
        script src = "{{ asset('public/js/moment.min.js') }}" >
    </script>
    <script src="{{ asset('public/js/dist_xlsx.full.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        // !!!!! need event detect ehen procedure is empty  !!!!!!
        $('#user').select2({
            placeholder: '   Physician',
            allowClear: false
        });
        $('#user_export').select2({
            placeholder: '   Physician',
            allowClear: false,
            dropdownParent: $('#user_modal')
        });
        $('#procedure').select2({
            placeholder: '   Procedure',
            allowClear: false
        });
        $('#scope').select2({
            placeholder: '   Scope',
            allowClear: false
        });
        $('#icd10').select2({
            placeholder: '   Diagnosis (ICD-10)',
            allowClear: false
        });
        $('#icd9').select2({
            placeholder: '   Procedure (ICD-9)',
            allowClear: false
        });
        $('#indication').select2({
            placeholder: '   Indication',
            allowClear: false
        });

        $('#procedure').on('select2:select', function(e) {
            get_icd(this)
            get_indication(this)
        })

        $('#procedure').on('select2:unselect', function(e) {
            get_icd(this)
            get_indication(this)
        });
    </script>

@endsection
