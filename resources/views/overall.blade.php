@extends('layouts.layouts_index.main')
@section('title', 'EndoBook')
@section('style')

    <style>
        .card {
            margin-bottom: 0.5rem !important;
        }

        .h-right {
            height: 310px;
        }

        ::-webkit-scrollbar {
            width: 3px !important;
            height: 3px !important;
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
        .page-content {
            padding-right: 0 !important;
            padding-left: 0 !important;

        }

        .apexcharts-tooltip-title {
            display: none;
        }
    </style>

@endsection
@section('title-left')
    <h4 class="mb-sm-0">Overall</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
        <li class="breadcrumb-item active">Overall</li>
    </ol>
@endsection
@section('modal')

@endsection

@section('content')

    <div class="row m-0">
        <div class="col-8">
            <div class="row">
                <div class="col-md-4" hidden>
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="row h-100">
                                <div class="col-2">
                                    <div class="avatar-sm flex-shrink-0 mt-3">
                                        <span class="avatar-title bg-soft-info text-primary fs-2">
                                            <i class="ri-calendar-todo-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4 ms-5">
                                    <p class="fw-medium text-muted mb-0">BOOKING LIST</p>
                                    <h2 class="mt-1 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="825">0</span>
                                    </h2>

                                    <p class="mb-0 text-muted">
                                        Cases this day
                                    </p>
                                </div>
                                <div class="col text-end">
                                    <span class="badge bg-soft-danger text-danger " style="margin-top: 3em;">
                                        <i class="ri-arrow-up-line align-middle "></i> 16.24 %
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4" hidden>
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="row h-100">
                                <div class="col-2">
                                    <div class="avatar-sm flex-shrink-0 mt-3">
                                        <span class="avatar-title bg-soft-warning text-warning fs-2">
                                            <i class="ri-calendar-todo-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4 ms-5">
                                    <p class="fw-medium text-muted mb-0">TODAY LIST</p>
                                    <h2 class="mt-1 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="7522">0</span>
                                    </h2>

                                    <p class="mb-0 text-muted">
                                        Cases this day
                                    </p>
                                </div>
                                <div class="col text-end">
                                    <span class="badge bg-light text-success " style="margin-top: 3em;">
                                        <i class="ri-arrow-up-line align-middle "></i> 3.58 %
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" hidden>
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="row h-100">
                                <div class="col-2">
                                    <div class="avatar-sm flex-shrink-0 mt-3">
                                        <span class="avatar-title bg-soft-info text-info  fs-2">
                                            <i class="ri-calendar-todo-fill"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-4 ms-5">
                                    <p class="fw-medium text-muted mb-0 text-nowrap">FOLLOW-UP LIST</p>
                                    <h2 class="mt-1 ff-secondary fw-semibold">
                                        <span class="counter-value" data-target="825">0</span>
                                    </h2>

                                    <p class="mb-0 text-muted">
                                        Cases this day
                                    </p>
                                </div>
                                <div class="col text-end">
                                    <span class="badge  bg-soft-danger text-danger " style="margin-top: 3em;">
                                        <i class="ri-arrow-up-line align-middle "></i> 10.35 %
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header h5">
                            Patient Status
                        </div>
                        <div class="card-body">
                            <div id="bar_overall" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header h5">
                            Room Monitor
                        </div>
                        <div class="card-body" style="height: 203px; overflow-y:auto;">
                            @foreach (isset($rooms)?$rooms:[] as $r)
                                @php
                                    $r = (object) $r;
                                    $main = [];
                                    foreach (isset($r->room_doctor)&&is_array($r->room_doctor)?$r->room_doctor:[] as $doc) {
                                        if(isset($doc)){
                                            $main[] = intval($doc);
                                        }
                                    }

                                    foreach (isset($r->room_nurse)&&is_array($r->room_nurse)?$r->room_nurse:[] as $nurse) {
                                        if(isset($doc)){
                                            $main[] = intval($nurse);
                                        }
                                    }

                                    foreach (isset($r->room_nurse_assist)&&is_array($r->room_nurse_assist)?$r->room_nurse_assist:[] as $nurse_assist) {
                                        if(isset($doc)){
                                            $main[] = intval($nurse_assist);
                                        }
                                    }

                                    $user_txt = '';
                                    if (isset($main) && count($main) > 0) {
                                        $user_txt = append_user_name_server(json_encode($main), '');
                                        $user_txt = rtrim($user_txt, ', ');
                                    }
                                @endphp
                                <div class="row mt-1">
                                    <div class="col-2">
                                        <span class="text-muted">{{@$r->room_name}}</span>
                                    </div>
                                    <div class="col-2">
                                        <span hidden class="badge badge-soft-danger fs-14">Operation</span>
                                    </div>
                                    <div class="col-auto">
                                        <span>{{@$user_txt}}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-0 ">
                        <div class="card-header p-0 mt-3 ms-3">
                            <div class=" d-flex justify-content-between">
                                <h5> Scope Status</h5>

                                <ul class="nav   mb-3" role="tablist">
                                    <li class="nav-item waves-effect nav-pills nav-warning  waves-light">
                                        <a class="nav-link active align-middle" data-bs-toggle="tab" href="#operation"
                                            role="tab">
                                            Operation
                                            {{-- <span class="badge">2</span> --}}
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light nav-danger">
                                        <a class="nav-link align-middle" data-bs-toggle="tab" href="#reprocess"
                                            role="tab">Reprocess
                                            {{-- <span class="badge bg-danger">2</span> --}}
                                        </a>

                                    </li>
                                    <li class="nav-item waves-effect waves-light nav-success">
                                        <a class="nav-link" data-bs-toggle="tab" href="#available"
                                            role="tab">Available</a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light nav-primary">
                                        <a class="nav-link" data-bs-toggle="tab" href="#repair"
                                            role="tab">Repair</a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light nav-soft-dark">
                                        <a class="nav-link" data-bs-toggle="tab" href="#disable"
                                            role="tab">Disable</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-end">


                                    </div>
                                </div>
                                <!-- Tab panes -->
                                <div class="tab-content text-muted">
                                    <div class="tab-pane active" id="operation" role="tabpanel">
                                        <table class="table table-nowrap text-muted">
                                            <thead>
                                                <tr class="bg-light">
                                                    <td scope="col">Name / Type</td>
                                                    <td scope="col">Model / SN</td>
                                                    <td scope="col">Company</td>
                                                    <td scope="col">Location</td>
                                                    <td scope="col">User</td>
                                                    <td scope="col">Tag time (Elapsed)</td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (isset($scope_status)?$scope_status:[] as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        if((@$data->scope_status.""!="capture")){
                                                            continue;
                                                        }
                                                        if(!isset($data->track_rfid)){
                                                            continue;
                                                        }
                                                        $user = get_user_data_server($data->track_user);
                                                        $room = get_room_name_server($data->track_station);
                                                        $time = isset($data->track_time) ? date_format(date_create($data->track_time),"H:i") : '';
                                                    @endphp
                                                    <tr>
                                                        <td scope="row">{{@$data->scope_name}}</td>
                                                        <td>{{@$data->scope_serial}}</td>
                                                        <td>{{@$data->scope_band}}</td>
                                                        <td>{{@$room}}</td>
                                                        <td>{{@$user}}</td>
                                                        <td>{{@$time}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="reprocess" role="tabpanel">
                                        <table class="table table-nowrap text-muted">
                                            <thead>
                                                <tr class="bg-light">
                                                    <td scope="col">Name / Type</td>
                                                    <td scope="col">Model / SN</td>
                                                    <td scope="col">Company</td>
                                                    <td scope="col">Location</td>
                                                    <td scope="col">User</td>
                                                    <td scope="col">Reprocess time (Elapsed)</td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (isset($scope_status)?$scope_status:[] as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        if((!str_contains(@$data->scope_status."", 'wash'))){
                                                            continue;
                                                        }
                                                        if(!isset($data->track_rfid)){
                                                            continue;
                                                        }
                                                        $user = get_user_data_server($data->track_user);
                                                        $room = get_room_name_server($data->track_station);
                                                        $time = isset($data->track_time) ? date_format(date_create($data->track_time),"H:i") : '';
                                                    @endphp
                                                    <tr>
                                                        <td scope="row">{{@$data->scope_name}}</td>
                                                        <td>{{@$data->scope_serial}}</td>
                                                        <td>{{@$data->scope_band}}</td>
                                                        <td>{{@$room}}</td>
                                                        <td>{{@$user}}</td>
                                                        <td>{{@$time}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="available" role="tabpanel">
                                        <table class="table table-nowrap text-muted">
                                            <thead>
                                                <tr class="bg-light">
                                                    <td scope="col">Name / Type</td>
                                                    <td scope="col">Model / SN</td>
                                                    <td scope="col">Company</td>
                                                    <td scope="col">Location</td>
                                                    <td scope="col">User</td>
                                                    <td scope="col">Storage time</td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (isset($scope_status)?$scope_status:[] as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        if((!str_contains(@$data->scope_status."", 'available'))){
                                                            continue;
                                                        }
                                                        if(!isset($data->track_rfid)){
                                                            continue;
                                                        }
                                                        $user = get_user_data_server($data->track_user);
                                                        $room = get_room_name_server($data->track_station);
                                                        $time = isset($data->track_time) ? date_format(date_create($data->track_time),"H:i") : '';
                                                    @endphp
                                                    <tr>
                                                        <td scope="row">{{@$data->scope_name}}</td>
                                                        <td>{{@$data->scope_serial}}</td>
                                                        <td>{{@$data->scope_band}}</td>
                                                        <td>{{@$room}}</td>
                                                        <td>{{@$user}}</td>
                                                        <td>{{@$time}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="repair" role="tabpanel">
                                        <table class="table table-nowrap text-muted">
                                            <thead>
                                                <tr class="bg-light">
                                                    <td scope="col">Name / Type</td>
                                                    <td scope="col">Model / SN</td>
                                                    <td scope="col">Company</td>
                                                    <td scope="col">Location</td>
                                                    <td scope="col">User</td>
                                                    <td scope="col">Disable time (Elapsed)</td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (isset($scope_status)?$scope_status:[] as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        if((!str_contains(@$data->scope_status."", 'repair'))){
                                                            continue;
                                                        }
                                                        if(!isset($data->track_rfid)){
                                                            continue;
                                                        }
                                                        $user = get_user_data_server($data->track_user);
                                                        $room = get_room_name_server($data->track_station);
                                                        $time = isset($data->track_time) ? date_format(date_create($data->track_time),"H:i") : '';
                                                    @endphp
                                                    <tr>
                                                        <td scope="row">{{@$data->scope_name}}</td>
                                                        <td>{{@$data->scope_serial}}</td>
                                                        <td>{{@$data->scope_band}}</td>
                                                        <td>{{@$room}}</td>
                                                        <td>{{@$user}}</td>
                                                        <td>{{@$time}}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane" id="disable" role="tabpanel">
                                        <table class="table table-nowrap text-muted">
                                            <thead>
                                                <tr class="bg-light">
                                                    <td scope="col">Name / Type</td>
                                                    <td scope="col">Model / SN</td>
                                                    <td scope="col">Company</td>
                                                    <td scope="col">Location</td>
                                                    <td scope="col">User</td>
                                                    <td scope="col">Disable time (Elapsed)</td>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach (isset($scope_status)?$scope_status:[] as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        if((!str_contains(@$data->scope_status."", 'disable'))){
                                                            continue;
                                                        }
                                                        if(!isset($data->track_rfid)){
                                                            continue;
                                                        }
                                                        $user = get_user_data_server($data->track_user);
                                                        $room = get_room_name_server($data->track_station);
                                                        $time = isset($data->track_time) ? date_format(date_create($data->track_time),"H:i") : '';
                                                    @endphp
                                                    <tr>
                                                        <td scope="row">{{@$data->scope_name}}</td>
                                                        <td>{{@$data->scope_serial}}</td>
                                                        <td>{{@$data->scope_band}}</td>
                                                        <td>{{@$room}}</td>
                                                        <td>{{@$user}}</td>
                                                        <td>{{@$time}}</td>
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
        </div>
        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <div class="card h-right">
                        <div class="card-header h5">
                            Department Schedule Limitation
                        </div>
                        <div class="card-body p-1">
                            <div id="bar_scope" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>

                            {{-- <div id="department_radialbar" data-colors='["--vz-success"]' class="apex-charts"
                                dir="ltr"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col-12" hidden>
                    <div class="card" style="height: 570px;">
                        <div class="card-header h5">
                            Booking Schedule
                        </div>
                        <div class="card-body pt-0">
                            <div class="upcoming-scheduled">
                                <input type="text" class="form-control" data-provider="flatpickr"
                                    data-date-format="d M, Y" data-deafult-date="today" data-inline-date="true">
                            </div>

                            <h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted">Events:</h6>
                            <div class="mini-stats-wid d-flex align-items-center mt-3">
                                <div class="flex-shrink-0 avatar-sm">
                                    <span
                                        class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                        13
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">วันสงกรานต์</h6>
                                    <p class="text-muted mb-0">Day Off</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">All Day</p>
                                </div>
                            </div><!-- end -->
                            <div class="mini-stats-wid d-flex align-items-center mt-3">
                                <div class="flex-shrink-0 avatar-sm">
                                    <span
                                        class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                        14
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">วันสงกรานต์</h6>
                                    <p class="text-muted mb-0">Day Off</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">All Day</p>
                                </div>
                            </div><!-- end -->
                            <div class="mini-stats-wid d-flex align-items-center mt-3">
                                <div class="flex-shrink-0 avatar-sm">
                                    <span
                                        class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4">
                                        15
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">วันสงกรานต์</h6>
                                    <p class="text-muted mb-0">Day Off</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <p class="text-muted mb-0">All Day </p>
                                </div>
                            </div><!-- end -->


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
    <div class="col-xxl-6">
        <div class="d-flex flex-column">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Users</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="28.05">0</span>k</h2>
                                    <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"> <i class="ri-arrow-up-line align-middle"></i> 16.24 % </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i data-feather="users" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p class="fw-medium text-muted mb-0">Sessions</p>
                                    <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value" data-target="97.66">0</span>k</h2>
                                    <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"> <i class="ri-arrow-down-line align-middle"></i> 3.96 % </span> vs. previous month</p>
                                </div>
                                <div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-soft-info rounded-circle fs-2">
                                            <i data-feather="activity" class="text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> --}}

@php
    $patient = isset($patient) ? $patient : [];
    $scope_count = isset($scope_count) ? $scope_count : [];
@endphp


@endsection
@section('script')
    <script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
    <script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>
    <script>
        var patient     = @json($patient)
        var pkey        = Object.keys(patient)
        var pvalue      = Object.values(patient)
        var sum         = pvalue.reduce((partialSum, a) => partialSum + a, 0);
        var options = {
            series: [{
                name: 'Booking',
                data: [pvalue[0]]
            }, {
                name: 'Holding',
                data: [pvalue[1]]
            }, {
                name: 'Operation',
                data: [pvalue[2]]
            }, {
                name: 'Recovery',
                data: [pvalue[3]]
            }, {
                name: 'Discharge',
                data: [pvalue[4]]
            }
        ],
            chart: {
                type: 'bar',
                height: 120,
                stacked: true,
                stackType: '100%',
                foreColor: '#245788',
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    dataLabels: {
                        total: {
                            enabled: true,
                            offsetX: 0,
                            style: {
                                fontSize: '13px',
                                fontWeight: 900
                            }
                        }
                    }
                },
            },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            xaxis: {
                labels: {
                    show: false,
                },
            },
            yaxis: {
                labels: {
                    show: false,
                },
                title: {
                    text: undefined
                },
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return parseInt(val)
                    },
                    title: {
                        formatter: function (seriesName) {
                        return seriesName
                        }
                    }
                },
            },
            fill: {
                opacity: 1,
                colors: ['#245788', '#F7B84B', '#F06548', '#0AB39C', '#299CDB' ],
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'left',
                offsetX: 40,
            },
            markers: {
                width: 12,
                height: 12,
                strokeWidth: 0,
                strokeColor: '#fff',
                fillColors: '#245788',
                radius: 12,
                customHTML: undefined,
                onClick: undefined,
                offsetX: 0,
                offsetY: 0
                 },
          };

        var chart = new ApexCharts(document.querySelector("#bar_overall"), options);
        chart.render();

        var scope_count     = @json($scope_count)
        var skey       = Object.keys(scope_count)
        var svalue     = Object.values(scope_count)

        var options = {
            series: svalue,
            chart: {
            type: 'donut',
            height: 200,
            },
            labels: skey,
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return parseInt(val) + "%"
                }
            },
            legend: {
                show: true,
                offsetX: 10,
                horizontalAlign: 'center',
                itemMargin: {
                    vertical: 10
                },
                fontSize: '60px',
            },
            colors:['#245788', '#08AF9D', '#F0BB5D', '#F36349'],
            responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                width: 200
                },

                legend: {
                position: 'bottom'
                }
            }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#bar_scope"), options);
        chart.render();




        // var options = {
        //     series: [67],
        //     chart: {
        //         height: 250,
        //         type: 'radialBar',
        //         offsetY: -10
        //     },
        //     plotOptions: {
        //         radialBar: {
        //             startAngle: -135,
        //             endAngle: 135,
        //             dataLabels: {
        //                 name: {
        //                     fontSize: '16px',
        //                     color: undefined,
        //                     offsetY: 120
        //                 },
        //                 value: {
        //                     offsetY: 76,
        //                     fontSize: '22px',
        //                     color: undefined,
        //                     formatter: function(val) {
        //                         return val + "%";
        //                     }
        //                 }
        //             }
        //         }
        //     },
        //     fill: {

        //         type: 'gradient',
        //         gradient: {
        //             shade: 'dark',
        //             shadeIntensity: 0.15,
        //             inverseColors: false,
        //             opacityFrom: 1,
        //             opacityTo: 1,
        //             stops: [0, 50, 65, 91]
        //         },
        //         colors: ['#0AB39C'],
        //     },
        //     stroke: {
        //         dashArray: 4
        //     },
        //     labels: ['Available Schedule'],
        //     colors: ['#0AB39C'],
        // };

        // var chart = new ApexCharts(document.querySelector("#department_radialbar"), options);
        // chart.render();
    </script>

@endsection
