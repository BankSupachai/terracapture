@extends('layouts.layouts_index.main')

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
            background-color: #245788;
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
            /* border: 0px transparent !important;  */
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

        .export-scroll-table {
            height: 542px;
            overflow: auto;
        }

        .export-scroll-table thead tr {
            position: sticky;
            top: 0px;
            z-index: 1;
        }
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
                                <option value="{{ @$u->uid }}"
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
@section('title-left')
    <h4 class="mb-sm-0">EXPORT DATA </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
        <li class="breadcrumb-item active">Export</li>
    </ol>
@endsection


@section('content')

    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xxl-6">
                            <input type="hidden" id="export_type" value="operation">
                            {{-- btn-operation --}}
                            <a href="{{ url("exportdata") }}" id="operation" class="btn btn-type btn-operation w-res text-nowrap"
                                style="width:100%" >
                                <i class="ri ri-list-check-2 ri-3x"> </i>
                                <span class="iconupper ">Operation Data</span>
                            </a>
                        </div>
                        <div class="col-xxl-6">
                            {{-- btn-summary --}}
                            <button type="button" id="summary" class="btn btn-type btn-summary w-res text-nowrap"
                                style="width:100%" onclick="change_type('summary')">
                                <i class="ri ri-file-chart-fill ri-3x"> </i>
                                <span class="iconupper">Summary Data</span>
                            </button>
                        </div>
                    </div>
                    <form id="export_form" action="{{ url('exportindex') }}" method="post">
                        @csrf
                        <input type="hidden" name="event" value="query_data">
                        <input type="hidden" name="action" value="show">
                        <div class="col-12 mt-4" id="start_date_div">
                            <input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"
                                class="form-control search-input" name="start_date" id="start_date" placeholder="Start Date"
                                onchange="check_start_date(this.value)" value="{{ @$filter['start_date'] }}">
                        </div>
                        <div class="col-12 mt-3" id="end_date_div">
                            <input type="text" onfocus="(this.type='date')" onfocusout="(this.type='text')"
                                class="form-control search-input" name="end_date" id="end_date" placeholder="End Date"
                                value="{{ @$filter['end_date'] }}" disabled>
                        </div>
                        <div class="col-12 mt-3" id="user_type_div">
                            <select class="form-select search-input" name="user_type" id="user_type"
                                onchange="get_user(this.value)">
                                <option value="">User Department</option>
                                <option value="MED"
                                    @isset($filter['user_type']) @if ($filter['user_type'] == 'MED') selected @endif  @endisset>
                                    MED</option>
                                <option value="SUR"
                                    @isset($filter['user_type']) @if ($filter['user_type'] == 'SUR') selected @endif  @endisset>
                                    SUR</option>
                                <option value="ไม่ระบุ"
                                    @isset($filter['user_type']) @if ($filter['user_type'] == 'ไม่ระบุ') selected @endif  @endisset>
                                    ไม่ระบุ</option>
                            </select>
                        </div>
                        <div class="col-12 mt-3" id="month_div" style="display: none">
                            <select class="form-select search-input" name="month" id="month">
                                <option value=""></option>
                                <option value="01"
                                    @isset($filter['month']) @if ($filter['month'] == '01') selected @endif  @endisset>
                                    Jan.</option>
                                <option value="02"
                                    @isset($filter['month']) @if ($filter['month'] == '02') selected @endif  @endisset>
                                    Feb.</option>
                                <option value="03"
                                    @isset($filter['month']) @if ($filter['month'] == '03') selected @endif  @endisset>
                                    Mar.</option>
                                <option value="04"
                                    @isset($filter['month']) @if ($filter['month'] == '04') selected @endif  @endisset>
                                    Apr.</option>
                                <option value="05"
                                    @isset($filter['month']) @if ($filter['month'] == '05') selected @endif  @endisset>
                                    May</option>
                                <option value="06"
                                    @isset($filter['month']) @if ($filter['month'] == '06') selected @endif  @endisset>
                                    Jun.</option>
                                <option value="07"
                                    @isset($filter['month']) @if ($filter['month'] == '07') selected @endif  @endisset>
                                    Jul.</option>
                                <option value="08"
                                    @isset($filter['month']) @if ($filter['month'] == '08') selected @endif  @endisset>
                                    Aug.</option>
                                <option value="09"
                                    @isset($filter['month']) @if ($filter['month'] == '09') selected @endif  @endisset>
                                    Sept.</option>
                                <option value="10"
                                    @isset($filter['month']) @if ($filter['month'] == '10') selected @endif  @endisset>
                                    Oct.</option>
                                <option value="11"
                                    @isset($filter['month']) @if ($filter['month'] == '11') selected @endif  @endisset>
                                    Nov.</option>
                                <option value="12"
                                    @isset($filter['month']) @if ($filter['month'] == '12') selected @endif  @endisset>
                                    Dec.</option>
                            </select>
                        </div>
                        @php
                            $years = range(date('Y'), $year_install);
                        @endphp
                        <div class="col-12 mt-3" id="year_div" style="display: none">

                            <select class="form-select search-input" name="year" id="year">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}"
                                        @isset($filter['year']) @if ($filter['year'] == $year) selected @endif  @endisset>
                                        {{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-3" id="room_div" style="display: block">
                            @php
                                $years = range(date('Y'), 1900);
                            @endphp
                            <select class="form-select search-input" name="room" id="room">
                                <option value="">All Room</option>
                                @foreach ($allroom as $room)
                                    <option value="{{ $room->room_name }}"
                                        @isset($filter['ft_room']) @if ($filter['ft_room'] == $room->room_name) selected @endif  @endisset>
                                        {{ $room->room_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-3">
                            <select name="user[]" id="user" class="form-select mb-3 search-input"
                                multiple="multiple">
                                <option value="">&nbsp;User</option>
                                @isset($users)
                                    @foreach ($users as $u)
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
                                        <option value="{{ @$fullname }}"
                                            @isset($filter['ft_user']) @if (in_array($fullname, $filter['ft_user'])) selected @endif  @endisset>
                                            {{ @$fullname }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-12 mt-3" id="procedure_div">
                            <select name="procedure[]" id="procedure" class="form-select mb-3 search-input"
                                multiple="multiple" onchange="get_icd(this.value)">
                                <option value="">&nbsp;Procedure</option>
                                @isset($procedure)
                                    @foreach ($procedure as $p)
                                        <option value="{{ @$p->name }}"
                                            @isset($filter['procedure']) @if (in_array($p->name, $filter['procedure'])) selected @endif  @endisset>
                                            {{ @$p->name }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-12 mt-3" id="scope_div">
                            <select name="scope[]" id="scope" class="form-select mb-3 search-input"
                                multiple="multiple">
                                <option value="">&nbsp;Scope</option>
                                @isset($scope)
                                    @foreach ($scope as $s)
                                        <option value="{{ @$s->scope_id }}"
                                            @isset($filter['scope']) @if (in_array($s->scope_id, $filter['scope'])) selected @endif  @endisset>
                                            {{ @$s->scope_name }} SN: {{ @$s->scope_serial }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-12 mt-3" id="icd10_div">
                            <select name="icd10[]" id="icd10" class="form-select mb-3 search-input"
                                multiple="multiple">
                                <option value="">&nbsp;Diagnosis (ICD-10)</option>
                                @isset($icd10)
                                    @php
                                        if (is_array($icd10)) {
                                            $icd10 = array_unique($icd10);
                                        }
                                    @endphp
                                    @foreach ($icd10 as $i)
                                        @php
                                            $is_in = false;
                                            if (isset($filter['icd10'])) {
                                                if (in_array($i, $filter['icd10'])) {
                                                    $is_in = true;
                                                }
                                            }
                                        @endphp
                                        <option value="{{ @$i }}"
                                            @isset($filter['icd10']) @if ($is_in) selected @endif  @endisset>
                                                {{ @$i }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-12 mt-3" id="icd9_div">
                            <select name="icd9[]" id="icd9" class="form-select mb-3 search-input"
                                multiple="multiple">
                                <option value="">&nbsp;Procedure (ICD-9)</option>
                                @isset($icd9)
                                    @php
                                        if (is_array($icd9)) {
                                            $icd9 = array_unique($icd9);
                                        }
                                    @endphp
                                    @foreach ($icd9 as $i)
                                        @php
                                            $is_in = false;
                                            if (isset($filter['icd9'])) {
                                                if (in_array($i, $filter['icd9'])) {
                                                    $is_in = true;
                                                }
                                            }
                                        @endphp
                                        <option value="{{ @$i }}"
                                            @isset($filter['icd9']) @if ($is_in) selected @endif  @endisset>
                                            {{ @$i }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-12 mt-3" id="indication_div">
                            @php
                                $indication = [];
                                $indication[] = 'GI Bleeding';
                                $indication[] = 'GERD';
                                $indication[] = 'Dyspepsia';
                                $indication[] = 'Dysphagia';
                                $indication[] = 'IDA';
                                $indication[] = 'Iron Deficiency Anemia';
                                $indication[] = 'CRC screening';
                                $indication[] = 'Constipation';
                                $indication[] = 'Abdominal pain';
                                $indication[] = 'Fit Positive';
                                $indication[] = 'Rectal Bleeding';
                                $indication[] = 'IBD';
                                $indication[] = 'Bowel Habit Change';
                                $indication[] = 'LGIB';
                                $indication[] = 'Family Hx CRC';
                                $indication[] = 'Diarrhea';
                                $indication[] = 'Surveillance colonoscopy';
                                $indication[] = 'Iron Deficiency Anemia';
                            @endphp
                            <select name="indication[]" id="indication" class="form-select mb-3 search-input"
                                multiple="multiple">
                                <option value="">&nbsp;Indication</option>
                                @isset($indication)
                                    @php
                                        if (is_array($indication)) {
                                            $indication = array_unique($indication);
                                        }
                                    @endphp
                                    @foreach ($indication as $i)
                                        @php
                                            $is_in = false;
                                            if (isset($filter['indication'])) {
                                                if (in_array($i, $filter['indication'])) {
                                                    $is_in = true;
                                                }
                                            }
                                        @endphp
                                        <option value="{{ @$i }}"
                                            @isset($filter['indication']) @if ($is_in) selected @endif  @endisset>
                                            {{ @$i }}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-12 mt-3" id="summary_type_div" style="display: none">
                            <div class="normal-text mb-2">
                                Select summary report
                            </div>
                            <div class="form-check mb-2">
                                <input class="form-check-input" value="Total case (Department)" type="radio"
                                    name="report_type" id="rd_department" onclick="check_type(this.id)"
                                    @if (isset($summary_type)) @if (str_contains($summary_type, 'Department')) checked @endif
                                @else checked @endif>
                                <label class="form-check-label normal-text ms-1" for="rd_department">
                                    Total case (Department)
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" value="Total case (User)" type="radio"
                                    name="report_type" onclick="check_type(this.id)" id="rd_user"
                                    @if (isset($summary_type)) @if (str_contains($summary_type, 'User')) checked @endif
                                @else @endif>
                                <label class="form-check-label normal-text ms-1" for="rd_user">
                                    Total case (User)
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" value="Room usage" type="radio" name="report_type"
                                    id="rd_room" onclick="check_type(this.id)"
                                    @if (isset($summary_type)) @if (str_contains($summary_type, 'Room')) checked @endif
                                @else @endif>
                                <label class="form-check-label normal-text ms-1" for="rd_room">
                                    Room usage
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" value="Scope usage" type="radio" name="report_type"
                                    id="rd_scope" onclick="check_type(this.id)"
                                    @if (isset($summary_type)) @if (str_contains($summary_type, 'Scope')) checked @endif
                                @else @endif>
                                <label class="form-check-label normal-text ms-1" for="rd_scope">
                                    Scope usage
                                </label>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8 mt-5" style="padding-top: 30px">
                                <input type="hidden" id="type" name="type" value="operation">
                                <button id="query_btn" type="submit" class="btn btn-primary waves-effect waves-light"
                                    style="width:100%"><i class="ri-search-line label-icon align-middle fs-16 me-2"></i>
                                    Search</button>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8 mt-3">
                                <a id="clear_btn" href="{{ url('exportindex') }}"
                                    class="btn btn-danger waves-effect waves-light" style="width:100%"><i
                                        class="ri-search-line label-icon align-middle fs-16 me-2"
                                        style="display: none"></i> Clear</a>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="row mt-4">

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-header">
                    <div class="row m-0">
                        <div class="col-2">
                            <h4 class="text-summary mt-3" id="table_head">Operation Data</h4>
                        </div>
                        <div class="col-4 mt-2">
                            <input type="text" class="form-control" id="text_search" placeholder="Search Wording"
                                style="width:100%; background-color: #F3F3F9; color: #9599AD; border: 0px transparent; "
                                autofocus>
                        </div>
                        <div class="col-1 mt-2 p-0">
                            <button id="search_word" type="button"
                                class="btn btn-info btn-label waves-effect waves-light"
                                style="background-color: #245788;"><i
                                    class="ri-search-line label-icon align-middle fs-16"></i> Search</button>
                            {{-- <button type="button" id="save_file" class="btn btn-primary btn-label waves-effect w-lg waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Search</button> --}}
                        </div>
                        <div class="col-1 mt-2 ms-3 show-spinner" style="display: none">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        {{-- <div class="col-2 mt-2"><button id="open_select_btn" class="btn btn-info waves-effect waves-light btn-res" type="button">Select</button></div> --}}
                        <div class="col mt-2 ">
                            <div class="row">
                                <div class="col ms-3 me-0 pe-0">
                                    {{-- <button data-filetype="xlsx" type="button" class="btn btn-primary waves-effect waves-light btn-res" id="export_excel" @if ($is_phutshin) data-bs-toggle="modal" data-bs-target="#user_modal"  @else onclick="htmlTableToExcel('xlsx')" @endif >Excel (.xlsx)</button> --}}
                                    {{-- <button data-filetype="csv" type="button" class="btn btn-primary waves-effect waves-light" id="export_csv" @if ($is_phutshin) data-bs-toggle="modal" data-bs-target="#user_modal" @else onclick="htmlTableToExcel('xlsx')" @endif>CSV (.csv)</button> --}}
                                    @if (@$type . '' == 'operation')
                                        <button data-filetype="csv" type="button"
                                            class="btn btn-primary waves-effect waves-light" id="export_csv"
                                            @if ($is_phutshin) data-bs-toggle="modal" data-bs-target="#user_modal" @else onclick="operationExcel('xlsx', '{{ @$is_phutshin }}')" @endif>CSV
                                            (.csv)</button>
                                    @else
                                        <button data-filetype="csv" type="button"
                                            class="btn btn-primary waves-effect waves-light" id="export_csv"
                                            @if ($is_phutshin) data-bs-toggle="modal" data-bs-target="#user_modal" @else onclick="htmlTableToExcel('xlsx', '{{ @$is_phutshin }}')" @endif>CSV
                                            (.csv)</button>
                                    @endif
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
                    <div class="row m-0 mt-3">
                        <div class="col-2"></div>
                        <div class="col-auto">
                            <span class="text-danger text-search-warning">สามารถเพิ่มเงื่อนไขการค้นหา เช่น
                                'hemoclip+gastritis' หรือ 'hemoclip,gastritis' โดยที่ '+'' คือ 'และ' : ',' คือ 'หรือ'
                            </span>
                        </div>
                    </div>

                    <div class="row mt-1" style="display: block">
                        <div id="select_head" class="row m-0">

                        </div>

                    </div>
                </div>
                <div id="operation_data_div">
                    @isset($type)
                        @if (@$type . '' == 'operation')
                            <div class="card-body table-responsive export-scroll-table p-0 table-card m-0" id="operation_show"
                                style="display: block">
                                @include('endo.export.render_table', ['tbody_id' => 'table_show'])

                            </div>

                            {{-- for export excel --}}
                            <div class="card-body table-responsive  pt-0 export-scroll-table table-card m-0"
                                id="operation_export" style="display: none">
                                @include('endo.export.render_table', ['tbody_id' => 'table_export'])
                            </div>
                        @endif
                    @endisset
                </div>
                <div id="summary_data_div" class="p-3">
                    <input type="hidden" id="summary_type_id" value="rd_department">
                    {{-- <div id="summary_card" class="card export-scroll-table"> --}}
                    @isset($type)
                        @if ($type == 'summary')
                            <div id="summary_card" class="card export-scroll-table">
                                @if (str_contains($summary_type, 'Department'))
                                    @include('endo.export.render_summary_dep_table', $data)
                                @elseif(str_contains($summary_type, 'User'))
                                    @include('endo.export.render_summary_user_table', $data)
                                @elseif(str_contains($summary_type, 'Room'))
                                    @include('endo.export.render_summary_room_table', [
                                        'data' => $data,
                                        'count_case' => @$count_case,
                                        'hours' => @$hours,
                                    ])
                                @elseif(str_contains($summary_type, 'Scope'))
                                    @include('endo.export.render_summary_track_table', $data)
                                @endif
                        @endif
                    @endisset

                </div>
                {{-- <div class="card-body table-responsive  pt-0 export-scroll-table table-card m-0" id="summary_show" style="display: none">
                    @include('endo.export.render_summary_table', ['tbody_id'=>'table_summary_show'])
                </div> --}}

                {{-- for export excel --}}
                {{-- <div class="card-body table-responsive  table-card m-0" id="summary_export" style="display: none">
                    @include('endo.export.render_summary_table', ['tbody_id'=>'table_summary_export'])
                </div> --}}
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')

    <script src="{{ asset('public/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('public/js/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/dist_xlsx.full.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        setTimeout(() => {
            $("#summary").trigger('click');
        }, 500);
        // !!!!! need event detect ehen procedure is empty  !!!!!!
        $('#user').select2({
            placeholder: '   User',
            allowClear: false
        });
        $('#user_export').select2({
            placeholder: '   User',
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

        const month_map = {
            [0]: "",
            [1]: 'Jan.',
            [2]: 'Feb.',
            [3]: 'Mar.',
            [4]: 'Apr.',
            [5]: 'May',
            [6]: 'Jun.',
            [7]: 'Jul.',
            [8]: 'Aug.',
            [9]: 'Sept.',
            [10]: 'Oct.',
            [11]: 'Nov.',
            [12]: 'Dec.',
        }

        console.log(month_map.length);

        let start_date = $('#start_date').val()
        if (start_date != undefined && start_date != '') {
            $('#end_date').prop('disabled', false)
        }

        let type = "{{ @$type }}"
        if (type != undefined && type != '') {
            change_type(type, false)
        }

        $('#query_btn').on('click', function() {
            let type = $('#export_type').val()
            $('#type').val(type)
            setTimeout(() => {
                $('#export_form').submit()
            }, 2 * 1000);
        })

        function check_type(rd_id) {
            if (rd_id == 'rd_room' || rd_id == 'rd_department' || rd_id == 'rd_scope') {
                $('#user').prop('disabled', true)
            } else {
                $('#user').prop('disabled', false)
            }
        }

        function get_filter() {
            let filters = {
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                user_type: $('#user_type').val(),
                user: $('#user').val(),
                procedure: $('#procedure').val(),
                scope: $('#scope').val(),
                icd9: $('#icd9').val(),
                icd10: $('#icd10').val(),
                search: $('#text_search').val()
            }
            return filters
        }



        function get_operation_query(type) {
            let start_date = $('#start_date').val()
            let end_date = $('#end_date').val()
            let user_type = $('#user_type').val()
            let user = $('#user').val()
            let procedure = $('#procedure').val()
            let scope = $('#scope').val()
            let icd9 = $('#icd9').val()
            let icd10 = $('#icd10').val()
            $.post('{{ url('exportindex') }}', {
                event: "query_data",
                type,
                start_date,
                end_date,
                user_type,
                user,
                procedure,
                scope,
                icd9,
                icd10,
                init: 'query'
            }, function(data, status) {
                console.log(data);
                $('#operation_show').css('display', 'block')

                $('#table_show').empty()
                $('#table_export').empty()

                $('#table_show').append(data)
                $('#table_export').append(data)
            })
        }

        function get_summary_query(type) {
            let month = $('#month').val()
            let year = $('#year').val()
            let user = $('#user').val()
            let report_type = $('input[name="report_type"]:checked').val();

            $.post('{{ url('exportindex') }}', {
                event: "query_data",
                month,
                year,
                user,
                report_type,
            }, function(data, status) {
                $('#summary_show').empty()
                $('#summary_show').css('display', 'block')
                $('#summary_show').append(data)
            })

        }

        function check_start_date(value) {
            if (value != undefined && value != '') {
                $('#end_date').prop('disabled', false)
            }
        }

        function get_icd(this_element) {
            let proc_arr = $(this_element).val()
            $.post('{{ url('exportindex') }}', {
                event: 'get_icd',
                procedure: proc_arr,
                filter: 'true'
            }, function(data, status) {
                let parse = JSON.parse(data);
                let icd9 = parse['icd9'];
                let icd10 = parse['icd10'];
                $('#icd9').empty()
                $('#icd9').append('<option value="">&nbsp;Procedure (ICD-9)</option>')
                icd9.forEach((e, i) => {
                    $('#icd9').append(`
                    <option value="${e}">${e}</option>
                `)
                })

                $('#icd10').empty()
                $('#icd10').append('<option value="">&nbsp;Diagnosis (ICD-10)</option>')
                icd10.forEach((e, i) => {
                    $('#icd10').append(`
                    <option value="${e}">${e}</option>
                `)
                })
            })
        }

        function get_indication(this_element) {
            console.log('indication');
            let proc_arr = $(this_element).val()
            $.post('{{ url('exportindex') }}', {
                event: "get_indication",
                procedure: proc_arr,
                filter: 'true'
            }, function(data, status) {
                console.log('indi', data);
                let parse = JSON.parse(data);
                console.log(parse);
                $('#indication').empty()
                $('#indication').append('<option value="">&nbsp;Indication</option>')
                parse.forEach((e, i) => {
                    $('#indication').append(`
                    <option value="${e}">${e}</option>
                `)
                })
            })
        }


        function get_user(user_type) {
            $.post('{{ url('api') }}/jquery', {
                event: 'get_user_select',
                type: user_type
            }, function(data, status) {
                $('#user').empty()
                $('#user').append('<option value="">&nbsp;User</option>')

                let users = JSON.parse(data)
                users.forEach((e, i) => {
                    let prefix = e['user_prefix'] != '' && e['user_prefix'] != undefined ? e[
                        'user_prefix'] : ''
                    let firstname = e['user_firstname'] != '' && e['user_firstname'] != undefined ? e[
                        'user_firstname'] : ''
                    let lastname = e['user_lastname'] != '' && e['user_lastname'] != undefined ? e[
                        'user_lastname'] : ''
                    let code = e['user_code'] != '' && e['user_code'] != undefined ? e['user_code'] : ''

                    $('#user').append(`
                    <option value="${prefix}${firstname} ${lastname}">${prefix} ${firstname} ${lastname} ${code}</option>
                `)
                })
            })
        }

        function clear_procedure() {
            $.post('{{ url('api') }}/jquery', {
                event: 'get_procedure',
            }, function(data, status) {
                $('#procedure').empty()
                $('#procedure').append('<option value="">&nbsp;Procedure</option>')
                let procedure = JSON.parse(data)
                procedure.forEach((e, i) => {
                    let name = e != '' && e != undefined ? e : ''
                    $('#procedure').append(`
                    <option value="${name}">${name}</option>
                `)
                })
            })
        }

        function clear_scope() {
            $.post('{{ url('api') }}/jquery', {
                event: 'get_scope',
            }, function(data, status) {
                $('#scope').empty()
                $('#scope').append('<option value="">&nbsp;Procedure</option>')
                let scope = JSON.parse(data)
                scope.forEach((e, i) => {
                    let scope_id = e['scope_id'] != '' && e['scope_id'] != undefined ? e['scope_id'] : ''
                    let scope_name = e['scope_name'] != '' && e['scope_name'] != undefined ? e[
                        'scope_name'] : ''
                    let scope_serial = e['scope_serial'] != '' && e['scope_serial'] != undefined ? e[
                        'scope_serial'] : ''

                    $('#scope').append(`
                    <option value="${scope_id}">${scope_name} SN: ${scope_serial}</option>
                `)
                })
            })
        }

        function clear_icd10() {
            $.post('{{ url('api') }}/jquery', {
                event: 'get_icd10',
            }, function(data, status) {
                $('#icd10').empty()
                $('#icd10').append('<option value="">&nbsp;Diagnosis (ICD-10)</option>')
                let icd10 = JSON.parse(data)
                icd10.forEach((e, i) => {
                    let name = e != '' && e != undefined ? e : ''
                    $('#icd10').append(`
                    <option value="${name}">${name}</option>
                `)
                })
            })
        }

        function clear_icd9() {
            $.post('{{ url('api') }}/jquery', {
                event: 'get_icd9',
            }, function(data, status) {
                $('#icd9').empty()
                $('#icd9').append('<option value="">&nbsp;Procedure (ICD-9)</option>')
                let icd9 = JSON.parse(data)
                icd9.forEach((e, i) => {
                    let name = e != '' && e != undefined ? e : ''
                    $('#icd9').append(`
                    <option value="${name}">${name}</option>
                `)
                })
            })
        }

        function change_type(type, need_refresh = true) {
            $('#export_type').val(type)
            let type_text = type == 'operation' ? 'Operation' : 'Summary'
            let other_type = type == 'operation' ? 'summary' : 'operation'
            $('#table_head').html(`${type_text} Data`)
            if (need_refresh) {
                to_default()
                $(`#${other_type}_data_div`).empty()
            }

            let warning_status = type == 'operation' ? 'block' : 'none'
            $('.text-search-warning').css('display', warning_status)

            let status = ''
            let other_status = ''
            if (type == 'summary') {
                status = 'none'
                other_status = 'block'
                $('#summary').removeClass('btn-not-active').addClass('btn-summary-active')
                $('#operation').addClass('btn-not-active')
                $(`#operation_show`).css('display', 'none')

                let summary_type = $('input[name="report_type"]:checked').val()
                let radio = ''
                if (summary_type.includes('User')) {
                    radio = 'rd_user'
                } else if (summary_type.includes('Department')) {
                    radio = 'rd_department'
                } else if (summary_type.includes('Room')) {
                    radio = 'rd_room'
                } else if (summary_type.includes('Scope')) {
                    radio = 'rd_scope'
                }
                $('#summary_type_id').val(radio)

                if (radio == 'rd_user') {
                    $('#user').prop('disabled', false)
                } else {
                    $('#user').prop('disabled', true)
                }

            } else {
                status = 'block'
                other_status = 'none'
                $('#summary').removeClass('btn-summary-active').addClass('btn-not-active')
                $('#operation').removeClass('btn-not-active').addClass('btn-operation')
                $(`#summary_show`).css('display', 'none')
                $('#user').prop('disabled', false)
                $(`#total_count_export`).text('0 row(s)');
                $(`#estimated_time_export`).text('0 seconds(s)')
            }

            $('#summary_type_div').css('display', other_status)
            $('#month_div').css('display', other_status)
            $('#year_div').css('display', other_status)
            $('#start_date_div').css('display', status)
            $('#end_date_div').css('display', status)
            $('#user_type_div').css('display', status)
            $('#procedure_div').css('display', status)
            $('#scope_div').css('display', status)
            $('#icd10_div').css('display', status)
            $('#icd9_div').css('display', status)

        }

        function to_default() {
            $('#start_date').val('').change()
            $('#end_date').val('').change()
            $('#user_type').val('').change()
            get_user('')
            clear_procedure()
            clear_scope()
            clear_icd10()
            clear_icd9()
            $('#table_show').empty()
            $('#table_export').empty()
            $('#summary_show').empty()
            $("#text_search").val('')
        }

        var user_export = new bootstrap.Modal(document.getElementById("user_modal"), {})
        $('#user_modal').on('show.bs.modal', function(e) {
            let filetype = $(e.relatedTarget).data('filetype')
            $('.export-modal-btn').attr('onclick', `htmlTableToExcel('${filetype}', '{{ @$is_phutshin }}')`);
        });
    </script>

    <script>
        // export excel file
        function htmlTableToExcel(type, is_phutshin = false) {

            if (is_phutshin) {
                let user_select = $('.user_export')
                if (!user_select.val()) {
                    user_select.focus()
                    $(user_select).get(0).reportValidity()
                    return
                }
            }

            let export_type = $('#export_type').val()
            let summary_id = $('#summary_type_id').val()
            let to_export = export_type == 'summary' ? 'table_summary_show_div' : 'table_export_div'

            let filename = $('#export_type').val()
            var data = document.getElementById(to_export);

            let clone_table = data.cloneNode(true)
            Array.from(clone_table.querySelectorAll('tr')).forEach(row => {
                if (row.style.display === 'none') {
                    row.parentNode.removeChild(row)
                }
            })
            data = clone_table

            // log export
            $.post("{{ url('api/sendto') }}", {
                event: "log_export",
                userid: $('#user_export').val() != "" ? $('#user_export').val() : "{{ @uid() }}",
                export_type: export_type,
                filetype: type,
                summary_id: summary_id.replace("rd_", "") ?? ""
            }, function(data, status) {
                console.log(data, status);
            })

            if (export_type == 'summary') {
                if (summary_id == 'rd_user') {
                    multiple_tables(type)
                    return
                } else if (summary_id == 'rd_room') {
                    let count_case = @json(@$count_case);
                    let hours = @json(@$hours);
                    let casetime = @json(@$casetime);
                    let data = @json(@$data);
                    let this_col = @json(@$this_col);
                    let this_year = @json(@$this_year);
                    let this_month = "{{ @$this_month }}" ? "{{ @$this_month }}" : 'false';
                    let this_type = @json(@$this_type);
                    let have_month = "{{ @$have_month_str }}" ? 'false' : 'true';
                    let tbody_id = @json(@$tbody_id);
                    let rooms = @json(@$rooms);
                    let date_type = have_month == 'true' ? 'Month' : 'Year';

                    $.post("{{ url('exportindex') }}", {
                        event: "render_summary_graph",
                        count_case,
                        hours,
                        casetime,
                        data,
                        this_col,
                        this_year,
                        this_month,
                        this_type,
                        tbody_id,
                        have_month,
                        rooms,
                    }, function(data, status) {
                        $.post("{{ url('api/sendto') }}", {
                            event: "render_summary_graph",
                        }, function(data, status) {
                            if (data.pdfUrl) {
                                const link = document.createElement('a');
                                link.href = data.pdfUrl;
                                link.download = 'summary_report.pdf';
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);

                                setTimeout(() => {
                                    $.post("{{ url('api/sendto') }}", {
                                        event: "remove_summary_graph",
                                    }, function(data, status) {
                                        console.log(data);
                                    })
                                }, 1000);
                            }
                        })
                    })
                    return
                }
            }


            // var excelFile = XLSX.utils.table_to_book(data, {sheet: "sheet1"});
            // XLSX.write(excelFile, { bookType: `${type}`, bookSST: true, type: 'base64' });
            // XLSX.writeFile(excelFile, `${filename} data.${type}`);

            let first_ws = XLSX.utils.table_to_sheet(data)


            let json = XLSX.utils.sheet_to_json(first_ws, {
                header: 1,
                raw: false
            })
            if (export_type == 'summary') {
                json = show_month(json)
            } else {
                json = json.map((subjson, i) => {
                    if (i == 0) {
                        return subjson
                    }

                    if (subjson[5]) {
                        subjson[5] = format_datetime(subjson[5])
                    }

                    if (subjson[6]) {
                        subjson[6] = format_datetime(subjson[6])
                    }

                    return subjson
                })
            }
            let worksheet = XLSX.utils.json_to_sheet(json, {
                skipHeader: true
            })
            const new_workbook = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(new_workbook, worksheet, "worksheet")
            XLSX.writeFile(new_workbook, `${filename} data.${type}`)
        }

        function format_datetime(dateStr) {
            const parts = dateStr.split('/');
            if (parts[0].includes('-')) {
                parts = parts[0].split('-');
            }
            let year = parts[2];
            let month = parts[0].padStart(2, '0');
            let day = parts[1].padStart(2, '0');

            if (year.length === 2) {
                year = parseInt(year, 10) < 70 ? `20${year}` : `19${year}`;
            }

            return `${year}-${month}-${day}`;
        }

        function multiple_tables(type) {
            let first_tb = document.getElementById("table_summary_show_div_0")
            let first_ws = XLSX.utils.table_to_sheet(first_tb)
            let json = XLSX.utils.sheet_to_json(first_ws, {
                header: 1
            })

            if ($('.table-user').length > 0) {
                for (let i = 1; i < $('.table-user').length; i++) {
                    let other_tb = document.getElementById(`table_summary_show_div_${i}`)
                    let other_ws = XLSX.utils.table_to_sheet(other_tb)
                    let other_js = XLSX.utils.sheet_to_json(other_ws, {
                        header: 1
                    })
                    json = json.concat(['']).concat(other_js)
                }
            }

            json = show_month(json)
            let worksheet = XLSX.utils.json_to_sheet(json, {
                skipHeader: true
            })
            const new_workbook = XLSX.utils.book_new()
            XLSX.utils.book_append_sheet(new_workbook, worksheet, "worksheet")
            XLSX.writeFile(new_workbook, `users.${type}`)
        }

        function convert_num_to_month(data) {
            for (let i = 0; i < Object.keys(month_map).length; i++) {
                if (i != 0) {
                    data[i] = month_map[i]
                }
            }
            return data
        }

        function show_month(json) {
            let is_show_month = $('#month').val() == '' || $('#month').val() == undefined ? true : false
            if (is_show_month) {
                let is_head = true
                for (let index = 0; index < json.length; index++) {
                    if (is_head) {
                        console.log(json[index]);
                        json[index] = convert_num_to_month(json[index])
                        is_head = false
                    }

                    if (json[index] == "") {
                        is_head = true
                    }
                }
            }
            return json
        }

        function split_searchtext_condition(text) {
            let text_str = text ?? ''
            // let or_parts = text_str.split(' or ')
            let or_parts = text_str.split(',')
            let arr = {}
            arr['and_conditions'] = []
            arr['or_conditions'] = []
            or_parts.forEach(part => {
                // let and_parts = part.split(' and ')
                let and_parts = part.trim().split('+').map(s => s.trim());
                console.log(and_parts, part);
                if (and_parts.length > 1) {
                    arr['and_conditions'].push(...and_parts)
                } else {
                    arr['or_conditions'].push(part)
                }
            })
            return arr
        }
    </script>

    <script>
        var data_limit = parseInt("{{ @$data_limit . '' }}")

        function search_input() {
            let count = 0
            var value = $('#text_search').val().trim().replace(/[+,]\s*$/, '').toLowerCase();
            let export_type = $('#export_type').val()
            if (export_type == 'operation') {
                let id = export_type == 'summary' ? 'table_summary_show' : 'table_show'
                let conditions = split_searchtext_condition(value)
                let ands = conditions['and_conditions'] ?? []
                let ors = conditions['or_conditions'] ?? []
                $(`#${id} tr`).filter(function(index) {
                    // if(value.includes('and') || value.includes('or')){
                    let row = $(this)
                    let td_texts = row.find('td').map(function() {
                        return $(this).text().toLowerCase()
                    }).get()

                    // search status 'complete' : 'incomplete'
                    let is_complete_search = ands.includes('complete') || ors.includes('complete')
                    let is_incomplete_search = ands.includes('incomplete') || ors.includes('incomplete')
                    let contains_incomplete = td_texts.some(text => text.match(/\bincomplete\b/))
                    let contains_complete = td_texts.some(text => text.match(/\bcomplete\b/))
                    let is_or = ors.some(or => td_texts.some(text => text.includes(or)));
                    let is_and = ands.map(and => td_texts.some(text => text.includes(and)));
                    is_and = is_and.length > 0 ? is_and.every(element => element === true) : false;
                    let can_show = (is_or || is_and) &&
                        (!is_complete_search || (is_complete_search && contains_complete && !
                        is_incomplete_search)) &&
                        (!is_incomplete_search || (is_incomplete_search && contains_incomplete));

                    if (can_show) {
                        count += 1
                    }

                    if (value.includes('+') || value.includes(',')) {
                        row.toggle(can_show)
                    } else {
                        if (value === 'complete' || value === 'incomplete') {
                            let regex = new RegExp("\\b" + value + "\\b", "i");
                            let rowText = $(this).text().toLowerCase();
                            $(this).toggle(regex.test(rowText));
                        } else {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        }
                    }
                });

            } else {
                let search = window.find(value, false, false, true, false, false, false)
            }
        }

        $("#search_word").on("click", function() {
            let filters = get_filter()
            filters['event'] = 'get_tabledata'
            filters['action'] = 'show'
            let export_type = $('#export_type').val()
            if (export_type == 'summary') {
                search_input()
            } else {
                // $('#export_csv').prop('disabled', true)
                get_filterdata(filters, 'show')
            }

        });

        async function operationExcel(ext, is_phutshin) {
            let filters = get_filter()
            filters['event'] = 'get_tabledata'
            filters['action'] = 'export'
            try {
                await get_filterdata(filters, 'export')
                // htmlTableToExcel(type, is_phutshin)
            } catch (e) {
                console.log(e);
            }
        }

        function get_filterdata(filters, action) {
            $(`.${action}-spinner`).css('display', 'block')
            $('#export_csv').prop('disabled', true)
            console.log(`Start fetching data at: ${new Date().toLocaleString()}`);
            if (filters['action'] == 'export' && !$('#estimated_time_export').text().includes('calc') &&
                !$('#estimated_time_export').text().includes('0')) {
                count_down()
            }
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: "{{ url('exportindex') }}",
                    type: "POST",
                    data: filters,
                    xhrFields: {
                        // responseType: filters['action'] == 'export' ? 'blob' : 'text'
                        responseType: 'text'
                    },
                    success: function(data, status, xhr) {
                        if (status === 'success') {
                            if (filters['action'] == 'export') {
                                var fileUrl = data.fileUrl;
                                var link = document.createElement('a');
                                link.href = fileUrl;
                                link.download = fileUrl.split('/').pop();
                                document.body.appendChild(link);
                                link.click();
                                link.parentNode.removeChild(link);
                                $(`.${action}-spinner`).css('display', 'none');
                                $(`#total_count_export`).text(`${total_count} row(s)`);
                                $(`#estimated_time_export`).text(`${time_used} seconds(s)`)
                            } else {
                                setTimeout(() => {
                                    $(`#table_${action}`).append(data);
                                    search_input();
                                    resolve();
                                    get_count_rows(filters)
                                }, 200);
                            }
                            clearInterval(countdownInterval)
                            $('#export_csv').prop('disabled', false)
                            $(`.${action}-spinner`).css('display', 'none')
                            console.log('Data returned at:', new Date().toLocaleString());
                        } else {
                            $(`.${action}-spinner`).css('display', 'none')
                            console.error('Error fetching data');
                            $('#export_csv').prop('disabled', false)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        $('#export_csv').prop('disabled', false)
                    }
                })

            });


        }

        var countdownInterval;
        var total_count;
        var time_used;

        function count_down(data, action = 'export') {
            // let remainingTime = data.estimated_time;
            let remainingTime = $('#estimated_time_export').text()
            remainingTime = parseInt(remainingTime.match(/\d+/)[0], 10)
            console.log(remainingTime, 'a');
            countdownInterval = setInterval(() => {
                if (remainingTime > 0) {
                    remainingTime--;
                    $(`#estimated_time_${action}`).text(parseInt(remainingTime) + ' seconds');
                } else {
                    clearInterval(countdownInterval);
                }
            }, 1000);
            setTimeout(() => {
                $(`.${action}-spinner`).css('display', 'none')
            }, 3000);
        }

        function get_count_rows(filters) {
            $(`#total_count_export`).text('calculating...');
            $(`#estimated_time_export`).text('calculating...')
            filters['action'] = 'getrows'
            $.ajax({
                url: "{{ url('exportindex') }}",
                type: "POST",
                data: filters,
                xhrFields: {
                    responseType: 'text'
                },
                success: function(data, status, xhr) {
                    console.log(data);
                    total_count = data.counts
                    time_used = Math.ceil(parseInt(total_count) * 0.021)
                    $(`#total_count_export`).text(`${total_count} row(s)`);
                    $(`#estimated_time_export`).text(`${time_used} second(s)`);
                    if ($(`.export-spinner`).css('display') == 'block') {
                        count_down()
                    }
                },
            })
        }

        if ($('#table_show tr').length > 0) {
            let filters = get_filter()
            filters['event'] = 'get_tabledata'
            get_count_rows(filters)
        }

        $('body').keypress(function(e) {
            var key = e.which;
            if (key == 13) {
                $('#search_word').click();
            }
        });
    </script>

@endsection
