@extends('capture.layoutv6')
@php
    $total = check_count_cases('', true, uget('department'));
    $operation =
        check_count_cases('operation', false, uget('department')) +
        check_count_cases('Operation', false, uget('department'));
    $pending =
        check_count_cases('holding', false, uget('department')) +
        check_count_cases('Holding', false, uget('department'));
    $completed =
        check_count_cases('recovery', false, uget('department')) +
        check_count_cases('discharged', false, uget('department')) +
        check_count_cases('Recovery', false, uget('department')) +
        check_count_cases('Discharged', false, uget('department'));
    $cancel = check_count_cases('delete', false, uget('department'));
@endphp

@section('style')
    <style>
        .operation-label {
            display: inline-block;
            padding: 3px 8px;
            font-size: 14px;
            color: #ff6f61;
            background-color: #f064482f;
            border-radius: 3px;
            text-align: center;
            font-weight: bold;
        }

        .operation-label2 {
            display: inline-block;
            padding: 3px 8px;
            font-size: 14px;
            color: #F7B84B;
            background-color: #f7b84b23;
            border-radius: 3px;
            text-align: center;
            font-weight: bold;
        }

        .TextTable-header {
            color: #9599AD;
        }
    </style>
@endsection

@section('modal')

@endsection
@section('content')
@include('capture.camera.obs.js_hotkey')
    <div class="row" style="margin: 0;">
        @if (in_array(@uget('user_type'), ['admin']))
            <div class="col-lg-12" style="padding: 1em;">
                <div class="card card-custom" style="height: 100%;">
                    <div class="card-body">
                        <h1 align="center">
                            <font color="red">ท่านกำลังอยู่ในโหมด admin</font>
                        </h1>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row" style="margin: 0;margin-top:-0.5em;">
        <div class="card">
            <div class="card-body">
                <div class="col-lg-12">
                    <!-- Search and Filter Section -->
                    <div class="search-filter-section pb-3">
                        <div class="row align-items-center g-3">
                            <!-- Search Input -->
                            <div class="col-lg-2 col-md-3">
                                <div class="search-input-wrapper">
                                    <i class="ri-search-line"></i>
                                    <input type="text" class="form-control" id="search_patient" placeholder="Search for Patient ID, Name">
                                </div>
                            </div>

                            <!-- Physician Dropdown -->
                            <div class="col-lg-2 col-md-3">
                                <select class="form-select select2" id="filter_physician">
                                    <option value="">Physician</option>
                                    @php
                                        $list_doctor = App\Models\Mongo::table('users')->where('user_type', 'doctor')->get();
                                    @endphp
                                    @foreach ($list_doctor as $data)
                                        @php
                                            $doctor_fullname = trim((@$data->user_prefix ? @$data->user_prefix . ' ' : '') . (@$data->user_firstname ?? '') . ' ' . (@$data->user_lastname ?? ''));
                                        @endphp
                                        <option value="{{ $doctor_fullname }}" data-uid="{{ @$data->uid }}">{{ $doctor_fullname }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Modality Dropdown -->
                            <div class="col-lg-2 col-md-3">
                                <select class="form-select select2" id="filter_modality">
                                    <option value="">Modality</option>
                                    @php
                                        $modalities = collect($tb_case ?? [])
                                            ->pluck('modality')
                                            ->filter(function ($v) {
                                                return !empty($v) && $v !== '-';
                                            })
                                            ->unique()
                                            ->sort()
                                            ->values();
                                    @endphp
                                    @foreach ($modalities as $m)
                                        <option value="{{ $m }}">{{ $m }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Range Selector -->
                            <div class="col-lg-3 col-md-6">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="date-range-segmented">
                                        <button type="button" class="date-option" data-range="0D">0D</button>
                                        <button type="button" class="date-option" data-range="1W">1W</button>
                                        <button type="button" class="date-option active" data-range="ALL">ALL</button>
                                    </div>
                                    <input type="text" class="form-control date-range-input" id="date_range_picker" placeholder="Select date range" style="flex: 1;">
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-lg-2 col-md-12">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-create-worklist flex-fill">
                                        <i class="ri-add-line"></i> Create Worklist
                                    </button>
                                    <button type="button" class="btn btn-import flex-fill">
                                        <i class="ri-download-line"></i> Import
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mb-0" style="background: #fff;">
                                    <thead style="background-color: #f5f8fa; color: #9599ad;">
                                        <tr>
                                            <th scope="col">HN/AN</th>
                                            <th scope="col">Patient Name</th>
                                            <th scope="col">Physician</th>
                                            <th scope="col">Operation</th>
                                            <th scope="col">Modality</th>
                                            <th scope="col">Date / Time</th>
                                            <th scope="col">Description</th>
                                            <th scope="col" class="text-end">Report</th>


                                            <th scope="col" class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background: #fff;">

                                        @foreach ($tb_case ?? [] as $data)
                                        <tr class="js-case-row">
                                            <td>{{ @$data->case_hn ?: '-' }}</td>
                                            <td>{{ @$data->patientname ?: '-' }}</td>
                                            <td>{{ @$data->doctorname ?: '-' }}</td>
                                            <td>{{ @$data->procedurename ?: '-' }}</td>
                                            <td>{{ @$data->modality ?: '-' }}</td>
                                            <td>{{ @$data->appointment_date ?: '-' }}</td>
                                            <td>{{ @$data->description ?: '-' }}</td>
                                            <td class="text-end">Final</td>

                                            <td class="text-end">
                                                <a href="{{url("procedure/$data->id")}}" class="btn btn-info">
                                                    <i class="ri-file-list-3-line"></i>

                                                </a>
                                                <a  href="{{@$admin->url_and_port}}/viewer?StudyInstanceUIDs={{ @$data->studyInstanceUID }}&id={{ @$data->id }}" class="btn btn-success ">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@include('capture.alltest.esc_home')

@section('script')
    <script>
        (function() {
            function normalizeText(v) {
                return (v || '').toString().trim().toLowerCase();
            }

            function parseDate(dateStr) {
                if (!dateStr || dateStr === '-') return null;
                // ลอง parse รูปแบบต่างๆ เช่น "2024-01-15", "2024-01-15 10:30:00"
                const cleaned = dateStr.trim().split(' ')[0]; // เอาเฉพาะส่วนวันที่
                const parts = cleaned.split('-');
                if (parts.length === 3) {
                    const year = parseInt(parts[0], 10);
                    const month = parseInt(parts[1], 10) - 1; // JS month is 0-indexed
                    const day = parseInt(parts[2], 10);
                    if (!isNaN(year) && !isNaN(month) && !isNaN(day)) {
                        return new Date(year, month, day);
                    }
                }
                return null;
            }

            function isToday(date) {
                if (!date) return false;
                const today = new Date();
                return date.getDate() === today.getDate() &&
                       date.getMonth() === today.getMonth() &&
                       date.getFullYear() === today.getFullYear();
            }

            function isYesterday(date) {
                if (!date) return false;
                const today = new Date();
                const yesterday = new Date(today);
                yesterday.setDate(today.getDate() - 1);
                const dateOnly = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                const yesterdayOnly = new Date(yesterday.getFullYear(), yesterday.getMonth(), yesterday.getDate());
                // วันที่เป็นเมื่อวาน (ย้อนไป 1 วัน)
                return dateOnly.getTime() === yesterdayOnly.getTime();
            }

            function applyFilters() {
                const q = normalizeText($('#search_patient').val());
                const physician = normalizeText($('#filter_physician').val());
                const modality = normalizeText($('#filter_modality').val());
                const dateRange = $('.date-option.active').data('range') || 'ALL';

                $('.js-case-row').each(function() {
                    const $tr = $(this);
                    const $tds = $tr.find('td');

                    const hn = normalizeText($tds.eq(0).text());
                    const patient = normalizeText($tds.eq(1).text());
                    const doctor = normalizeText($tds.eq(2).text());
                    const rowModality = normalizeText($tds.eq(4).text());
                    const appointmentDateStr = $tds.eq(5).text().trim();
                    const appointmentDate = parseDate(appointmentDateStr);

                    const matchQuery = !q || hn.includes(q) || patient.includes(q);
                    const matchPhysician = !physician || doctor.includes(physician);
                    const matchModality = !modality || rowModality.includes(modality);

                    let matchDate = true;
                    if (dateRange === '0D') {
                        // 0D = appointment_date ตรงกับวันปัจจุบัน
                        matchDate = isToday(appointmentDate);
                    } else if (dateRange === '1W') {
                        // 1W = ย้อนไป 1 วัน (เมื่อวาน)
                        matchDate = isYesterday(appointmentDate);
                    } else if (dateRange === 'ALL') {
                        // ALL = รวมทุกเคส
                        matchDate = true;
                    }

                    $tr.toggle(matchQuery && matchPhysician && matchModality && matchDate);
                });
            }

            function debounce(fn, wait) {
                let t;
                return function() {
                    clearTimeout(t);
                    t = setTimeout(fn, wait);
                };
            }

            $(document).ready(function() {
                // เปิดใช้ Select2 (layoutv6 include ไว้แล้ว)
                if ($.fn.select2) {
                    $('#filter_physician').select2({
                        width: '100%',
                        placeholder: 'Physician',
                        allowClear: true
                    });
                    $('#filter_modality').select2({
                        width: '100%',
                        placeholder: 'Modality',
                        allowClear: true
                    });
                }

                const applyFiltersDebounced = debounce(applyFilters, 150);

                // Event handlers
                $('#search_patient').on('input', applyFiltersDebounced);
                $('#filter_physician, #filter_modality').on('change', applyFilters);

                // Date range buttons
                $('.date-option').on('click', function() {
                    $('.date-option').removeClass('active');
                    $(this).addClass('active');
                    applyFilters();
                });

                // run ครั้งแรก
                applyFilters();
            });
        })();
    </script>
@endsection
