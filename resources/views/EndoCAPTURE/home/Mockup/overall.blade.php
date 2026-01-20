@extends('layouts.layouts_ipad.layouts_Newipad')

@section('style')
    <style>
        .w-32 {
            width: 32%;
        }

        .w-342 {
            width: 343px !important;
        }

        .bg-disable {
            background: #9A9A9A;
        }

        .text-disable {
            color: #9A9A9A;
        }

        .nav-disable {
            background: transparent;
            color: #9A9A9A;

        }

        .nav-disable .nav-link.active {
            color: #000 !important;
            border-radius: 5px;
            background: #9A9A9A;

        }

        .nav-disable .nav-link.active span {
            background: #fff;
        }

        .nav-warning .nav-link.active {
            color: #000 !important;
            border-radius: 5px;
        }

        .nav-danger .nav-link.active {
            color: #fff !important;
            border-radius: 5px;

        }

        .nav-danger .nav-link.active span {
            background: #fff !important;
        }

        .nav-success .nav-link.active {
            color: #fff !important;
            border-radius: 5px;

        }

        .nav-success .nav-link.active span {
            background: #fff !important;
        }

        .nav-primary .nav-link.active {
            color: #fff !important;
            border-radius: 5px;

        }

        .nav-primary .nav-link.active span {
            background: #fff !important;
        }

        tbody,
        td,
        tfoot,
        th,
        thead,
        tr {
            border-style: none !important;
        }
    </style>
@endsection
@section('tophead')
    Overall
@endsection
@section('content')
    <div class="row p-3 ">
        <div class="col-md-4 p-0 ">
            <div class="card card-animate mb-1">
                <div class="card-body card-ipad ">
                    <div class="row h-100">
                        <div class="col-2">
                            <div class="avatar-sm flex-shrink-0 mt-3">
                                <span class="avatar-title bg-soft-info text-primary fs-2">
                                    <i class="ri-calendar-todo-fill"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-4 ms-5">
                            <p class="fw-medium font-gray mb-0 text-nowrap">BOOKING LIST</p>
                            <h2 class="mt-1 ff-secondary fw-semibold">
                                <span class="counter-value font-gray" data-target="825">0</span>
                            </h2>

                            <p class="mb-0 font-gray text-nowrap">
                                Cases this day
                            </p>
                        </div>
                        <div class="col text-end">
                            <span class="badge bg-soft-success text-success " style="margin-top: 3em;">
                                <i class="ri-arrow-up-line align-middle "></i> 16.24 %
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-animate mb-1">
                <div class="card-body card-ipad">
                    <div class="row h-100">
                        <div class="col-2">
                            <div class="avatar-sm flex-shrink-0 mt-3">
                                <span class="avatar-title bg-soft-warning  text-warning fs-2">
                                    <i class="ri-calendar-todo-fill"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-4 ms-5">
                            <p class="fw-medium font-gray mb-0 text-nowrap">TODAY LIST</p>
                            <h2 class="mt-1 ff-secondary fw-semibold">
                                <span class="counter-value font-gray" data-target="7522">0</span>
                            </h2>

                            <p class="mb-0 font-gray text-nowrap">
                                Cases this day
                            </p>
                        </div>
                        <div class="col text-end">
                            <span class="badge bg-soft-success text-success" style="margin-top: 3em;">
                                <i class="ri-arrow-up-line align-middle "></i> 3.58 %
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 p-0">
            <div class="card card-animate mb-1">
                <div class="card-body card-ipad">
                    <div class="row h-100">
                        <div class="col-2">
                            <div class="avatar-sm flex-shrink-0 mt-3">
                                <span class="avatar-title bg-soft-info text-info  fs-2">
                                    <i class="ri-calendar-todo-fill"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-4 ms-5">
                            <p class="fw-medium font-gray mb-0 text-nowrap">FOLLOW-UP LIST</p>
                            <h2 class="mt-1 ff-secondary fw-semibold">
                                <span class="counter-value font-gray" data-target="825">0</span>
                            </h2>

                            <p class="mb-0 font-gray text-nowrap">
                                Cases this day
                            </p>
                        </div>
                        <div class="col text-end">
                            <span class="badge  bg-soft-danger text-danger " style="margin-top: 3em;">
                                <i class="ri-arrow-down-line align-middle "></i> 10.35 %
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 p-0 m-0  mt-1 font-gray">
            <div class="card-ipad py-3 ">
                &ensp; &ensp; Patient Status
                <div class=" ps-3 mt-3" style="border-bottom: 1px solid #353535;"></div>
                <div class="col-12">
                    <div id="bar_overall"
                        data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                        class="apex-charts" dir="ltr"></div>
                </div>
            </div>
        </div>
        <div class="col-12 p-0 m-0  mt-2 font-gray">
            <div class="card-ipad py-3 ">
                <div class="d-flex justify-content-between">
                    &ensp; &ensp; Scope Status
                    <div class=" ps-3 mt-3" style="border-bottom: 1px solid #353535;"></div>
                    <ul class="nav   mb-3" role="tablist">
                        <li class="nav-item waves-effect nav-pills nav-warning  waves-light">
                            <a class="nav-link active align-middle " data-bs-toggle="tab" href="#home-1" role="tab">
                                Operation
                                <span class="badge bg-dark">2</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light nav-danger">
                            <a class="nav-link align-middle text-danger" data-bs-toggle="tab" href="#profile-1"
                                role="tab">Reprocess
                                <span class="badge bg-danger text-dark">2</span>
                            </a>

                        </li>
                        <li class="nav-item waves-effect waves-light nav-success">
                            <a class="nav-link text-success" data-bs-toggle="tab" href="#messages-1"
                                role="tab">Available
                                <span class="badge bg-success text-dark">2</span>

                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light nav-primary">
                            <a class="nav-link text-secondary" data-bs-toggle="tab" href="#settings-1" role="tab">Repair
                                <span class="badge bg-secondary text-dark">2</span>

                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light nav-disable">
                            <a class="nav-link text-disable" data-bs-toggle="tab" href="#settings-2" role="tab">Disable
                                <span class="badge bg-disable text-dark">2</span>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 p-0 m-0 table-responsive">
            <table class="table table-nowrap font-gray table-borderless">
                <thead>
                    <tr>
                        <td scope="col">Name / Type</td>
                        <td scope="col">Model / SN</td>
                        <td scope="col">Company</td>
                        <td scope="col">Location</td>
                        <td scope="col">User</td>
                        <td scope="col">Tag time (Elapsed)</td>

                    </tr>
                </thead>
                <tbody>
                    <tr style="background: #222529;">
                        <td>
                            <span> G01 <br>
                                Gastroscope
                            </span>
                        </td>
                        <td>
                            GIF-HQ190 <br>
                            1234567890
                        </td>
                        <td>Olympus</td>
                        <td>Scope 1</td>
                        <td>พว.สดายุ ทองลอย</td>
                        <td>12:02 (10 min.)</td>
                    </tr>
                    <tr style="background: #222529;">
                        <td>
                            <span> G01 <br>
                                Gastroscope
                            </span>
                        </td>
                        <td>
                            GIF-HQ190 <br>
                            1234567890
                        </td>
                        <td>Olympus</td>
                        <td>Scope 1</td>
                        <td>พว.สดายุ ทองลอย</td>
                        <td>12:02 (10 min.)</td>
                    </tr>

                </tbody>
            </table>
        </div>



    </div>

    {{-- <div id="chat-conversation">
        <div class="simplebar-content-wrapper">

        </div>
    </div> --}}
@endsection
@section('script')
    <script>
        var options = {
            series: [{
                name: 'Booking',
                data: [24]
            }, {
                name: 'Holding',
                data: [37]
            }, {
                name: 'Operation',
                data: [23]
            }, {
                name: 'Recovery',
                data: [5]
            }, {
                name: 'Discharge',
                data: [11]
            }],
            chart: {
                type: 'bar',
                height: 120,
                stacked: true,
                stackType: '100%',
                foreColor: '#245788',
            },
            labels: [
                'รพ.พระจอมเกล้า ราย',
                'รพ.ท่ายาง ราย',
                'รพ.ชะอำ  ราย'
            ],
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
                width: 0,
                colors: ['#fff']
            },
            xaxis: {
                categories: [0],
                labels: {
                    formatter: function(val) {
                        return val + "K"
                    }
                }
            },
            yaxis: {
                title: {
                    text: undefined
                },
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + "K"
                    }
                }
            },
            fill: {
                opacity: 1,
                colors: ['#245788', '#F7B84B', '#F06548', '#0AB39C', '#299CDB'],
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


        var options = {
            series: [67],
            chart: {
                height: 250,
                type: 'radialBar',
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '16px',
                            color: undefined,
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '22px',
                            color: undefined,
                            formatter: function(val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            fill: {

                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
                colors: ['#0AB39C'],
            },
            stroke: {
                dashArray: 4
            },
            labels: ['Available Schedule'],
            colors: ['#0AB39C'],
        };

        var chart = new ApexCharts(document.querySelector("#department_radialbar"), options);
        chart.render();
    </script>
@endsection
