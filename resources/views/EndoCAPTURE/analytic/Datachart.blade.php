<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">

    <!-- One of the following themes -->
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>

    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" rel="stylesheet" />
    <!-- 'classic' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" rel="stylesheet" />
    <!-- 'monolith' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet" /> <!-- 'nano' theme -->
    <link href="{{ url('assets/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/select2.init.js') }}"></script>
    <link href="{{ url('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
         @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 100;
            src: url("{{url('public/fonts/Anuphan-Thin.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 200;
            src: url("{{url('public/fonts/Anuphan-ExtraLight.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 300;
            src: url("{{url('public/fonts/Anuphan-Light.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 400;
            src: url("{{url('public/fonts/Anuphan-Regular.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 500;
            src: url("{{url('public/fonts/Anuphan-Medium.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 600;
            src: url("{{url('public/fonts/Anuphan-SemiBold.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: italic;
            font-weight: 700;
            src: url("{{url('public/fonts/Anuphan-Bold.ttf')}}") format("truetype");
        }
        *{
            font-family: 'Anuphan' !important;
        }
        .mw-60 {
            max-width: 60%;
        }

        #chart_Year {
            max-width: 80%;
            height: auto;
        }

        #chart_month,
        #chart_age,
        #chart_gender {
            max-width: 100%;
            height: 100%;
        }

        #icd10,
        #icd09,
        #medication,
        #fiding,#chart
        #scope {
            width: 100%;
            height: 300px;
        }

        g[opacity="0.4"],
        g[opacity="0.3"] {
            display: none;
        }

        .card {
            height: 100%;
        }

        #chart_scope_all,
        #chart_icd10_modal,
        #chart_icd9_modal {
            width: 100%;
            height: 39em;
        }

        .row {
            --vz-gutter-x: 1rem !important;
            margin: 0px !important;

        }

        .circle {
            height: 20px;
            width: 20px;
            background: #245788;
            border-radius: 50%;
        }
        .h-charts{
            height: 20em;
        }
    </style>
</head>

<body>

    <div class="row m-0 pt-2">
        <div class="col-lg-2">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body text-center p-3">
                            <img src="{{ url('assets/images/charts/image26.png') }}" class="img-fluid ">
                            <h3 class="mt-4">Total Case </h3>
                            <h1 class="text-center">500</h1>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-3 ">
                    <div class="card ">
                        <div class="card-body text-center mb-5">
                            <h4 class="mt-2 text-center">รพ.พระจอมเกล้า</h4>
                            <div class="row text-muted mt-3 pb-4">
                                <div class="col-6 text-start">
                                    <span>Physician</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>30</span>
                                </div>
                                <div class="col-6 text-start ">
                                    <span>Stations</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>6</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-3 mb-2">
                    <div class="card">
                        <div class="card-body text-center mb-5">
                            <h4 class="mt-2 text-center">รพ.ท่ายาง</h4>
                            <div class="row text-muted mt-3 pb-4">
                                <div class="col-6 text-start">
                                    <span>Physician</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>30</span>
                                </div>
                                <div class="col-6 text-start ">
                                    <span>Stations</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>6</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-3 mb-2">
                    <div class="card">
                        <div class="card-body text-center mb-5">
                            <h4 class="mt-2 text-center">รพ.ชะอำ</h4>
                            <div class="row text-muted mt-3 pb-4">
                                <div class="col-6 text-start">
                                    <span>Physician</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>30</span>
                                </div>
                                <div class="col-6 text-start ">
                                    <span>Stations</span>
                                </div>
                                <div class="col-6 text-end">
                                    <span>6</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-10 p-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="mt-3">
                            <div class="row d-flex align-items-center p-0 m-0">
                                <div class="col-1 text-center">
                                    <h5>Date</h5>
                                </div>
                                <div class="col-2">
                                    <div>
                                        <input type="date" class="form-control bg-light" id="exampleInputdate">
                                    </div>
                                </div>
                                <div class="col-1 text-center">
                                    <h5>Hospital</h5>
                                </div>
                                <div class="col-3">
                                    <div>
                                        <select class="form-select bg-light" aria-label="Default select example">
                                            <option selected>All</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1 text-center">
                                    <h5>Physician</h5>
                                </div>
                                <div class="col-3">
                                    <div>
                                        <select class="form-select bg-light" aria-label="Default select example">
                                            <option selected>All</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1 text-center">
                                    <button class="btn btn-primary">Fillter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-4">
                    <div class="card h-charts mt-2">
                        <div class="card-header">
                            <h5>จำนวนคนไข้</h5>
                        </div>
                        <div class="card-body p-0 m-0 ">
                            <div id="count-procedure" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr">

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-charts mt-2">
                        <div class="card-header">
                            <h5>Status</h5>
                        </div>
                        <div class="card-body p-0 m-0">
                            <div id="chart" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-charts mt-2">
                        <div class="card-header">
                            <h5>Age / Gender</h5>
                        </div>
                        <div class="card-body p-0 m-0">
                            <div id="column_age" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-charts mt-2">
                        <div class="card-header">
                            <h5>Bowel Preparation</h5>
                        </div>

                        <div class="card-body p-0 m-0">
                            <div id="bar_bowel" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                        </div><!-- end card-body -->
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-charts mt-2">
                        <div class="card-header">
                            <h5>Diagnosis</h5>
                        </div>
                        {{-- <div class="card-body">
                            <div class="col-6">
                                <canvas id="pieChart" class="chartjs-chart"
                                    data-colors='["--vz-success", "--vz-light"]'></canvas>
                            </div>


                            <div class="col-6">
                                <div class="">

                                </div>
                            </div>
                        </div> --}}
                        <div class="card-body p-0 m-0">
                            <div id="bar_diagnosis" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-charts mt-2">
                        <div class="card-header">
                            <h5>Intervention</h5>
                        </div>
                        <div class="card-body p-0 m-0">
                            <div id="bar_intervention" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div>

                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-charts ">
                        <div class="card-header">
                            <h5>Physician</h5>
                        </div>
                        {{-- <div class="card-body ">
                            <div class="col-6">
                                <canvas id="pieChart" class="chartjs-chart"
                                    data-colors='["--vz-success", "--vz-light"]'></canvas>
                            </div>
                            <div class="col-6">
                                <div class="">

                                </div>
                            </div>
                        </div> --}}
                        <div class="card-body p-0">
                            <div id="bar_Physician" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-charts">
                        <div class="card-header">
                            <h5>Treatment Coverage</h5>
                        </div>

                        <div class="card-body p-0 m-0">
                            <div id="bar_TreatmentCoverage" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card h-charts">
                        <div class="card-body align-items-center d-flex justify-content-center ">
                            <div class="row text-center">
                                <div class="col-12">
                                    <h2>Colorectal Cancer </h2>
                                </div>
                                <div class="col-12 text-nowrap">
                                    <span class="text-danger h2">40 /</span>
                                    <span class="text-muted h2">500</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card m-0" style="padding: 1.5em;">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-6">
                    ©   <script>document.write(new Date().getFullYear())</script>  EndoINDEX 6.0
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Design & Develop by Medica Healthcare Co.,Ltd.
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
{{-- <script src="{{url("assets/js/plugins.js")}}"></script> --}}
@include('layouts.layouts_index.plugins')
<script src="{{ url('assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>
<script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ url('assets/js/select2.min.js') }}"></script>
<script src="{{ url('assets/js/pages/select2.init.js') }}"></script>
<script src="{{ url('assets/libs/fullcalendar/main.min.js') }}"></script>
<script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>

<script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>

{{-- <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script> --}}
<script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
<script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
<script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script>

<script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>


<script>
    var options = {
            series: [187, 158, 155],
            chart: {
                height: 200,
                type: 'pie',
            },
            labels: [
                'รพ.พระจอมเกล้า 187 ราย',
                'รพ.ท่ายาง 158 ราย',
                'รพ.ชะอำ 155 ราย'
            ],
            legend: {
                show: true,
                offsetX: 10,
                horizontalAlign: 'center',
                itemMargin: {
                    vertical: 10
                },
                fontSize: '50px',
                fontFamily: 'Anuphan, sans-serif',
            },
            colors: ['#415089', '#08AF9D', '#F36349'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        // height: '10px'
                    },
                    fill: {
                        //  colors: ['#415089', '#F36349', '#08AF9D']
                    },
                    legend: {
                    // position: 'bottom'
                    }
                }
            }]
        };


        var chart = new ApexCharts(document.querySelector("#count-procedure"), options);
        chart.render();
</script>
<script>
    var options = {
          series: [
          {
            name: 'รพ.พระจอมเกล้า',
            group: 'budget',
            data: [44000, 55000, 41000]
          },
          {
            name: 'รพ.ท่ายาง',
            group: 'actual',
            data: [48000, 50000, 40000]
          },
          {
            name: 'รพ.ชะอำ',
            group: 'actual',
            data: []
          },

        ],
          chart: {
          type: 'bar',
          height: 190,
          stacked: true,
        },
        labels: [
            'รพ.พระจอมเกล้า',
            'รพ.ท่ายาง',
            'รพ.ชะอำ'
            ],
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        dataLabels: {
          formatter: (val) => {
            return val / 1000 + ''
          }
        },
        plotOptions: {
          bar: {
            horizontal: false
          }
        },
        xaxis: {
          categories: [
            'รพ.พระจอมเกล้า',
            'รพ.ท่ายาง',
            'รพ.ชะอำ'
          ]
        },
        fill: {
        },
        colors: ['#245788', '#0ab39c', '#245788'],
        yaxis: {
          labels: {
            formatter: (val) => {
              return val / 1000 + ''
            }
          }
        },
        legend: {
            show: true,
            position: 'right',
            horizontalAlign: 'left'
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
</script>

<script>
            var options = {
          series: [{
          data: [400, 430, 448, 470, 540]
        }],
          chart: {
          type: 'bar',
          height: 190
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['Rectal Polyp', 'CA Colon', 'Colonic Polyp', 'Polyp of colon', 'Normal']
        },
        fill: {
            colors:['#245788']
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_diagnosis"), options);
        chart.render();


</script>

<script>
     var options = {
          series: [{
          name: 'Male',
          data: [44, 55, 57, 56, 61]
        }, {
          name: 'Female',
          data: [76, 85, 101, 98, 87]
        }, ],
          chart: {
          type: 'bar',
          height: 190
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['0-20', '21-40', '41-60', '61-80', '80+'],
        },
        yaxis: {
          title: {
            text: 'Age'
          }
        },
        fill: {
          opacity: 1,
          colors:['#245788', '#0ab39c'],
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        },
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
        },
        colors: ['#245788', '#0ab39c'],
        };

        var chart = new ApexCharts(document.querySelector("#column_age"), options);
        chart.render();
</script>

<script>
    var options = {
          series: [{
          data: [400, 430, 448, 470, 540]
        }],
          chart: {
          type: 'bar',
          height: 190
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        fill: {
            colors:['#0ab39c'],
        },
        xaxis: {
          categories: ['Apc', 'Hemoclip', 'Biopsy', 'ESD', 'Polypectomy'
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_intervention"), options);
        chart.render();
</script>

<script>
    var options = {
          series: [{
          data: [400, 430, 448, 470, 540]
        }],
          chart: {
          type: 'bar',
          height: 190
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        fill: {
            colors:['#245788'],
        },
        xaxis: {
          categories: ['นพ.ทดสอบ ระบบ05', 'นพ.ทดสอบ ระบบ04', 'นพ.ทดสอบ ระบบ03', 'นพ.ทดสอบ ระบบ02', 'นพ.ทดสอบ ระบบ01'
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_Physician"), options);
        chart.render();
</script>

<script>
    var options = {
          series: [{
          data: [400, 430, 448, 470, 540]
        }],
          chart: {
          type: 'bar',
          height: 190
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        fill: {
            colors:['#245788'],
        },
        xaxis: {
          categories: ['-', 'กองทุนผู้ประกันตน', 'ข้าราชการ/ลูกจ้างประจำ', 'ประกันสุขภาพ', 'ประกันสังคม'
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_TreatmentCoverage"), options);
        chart.render();

</script>

<script>
    var options = {
          series: [187, 158, 155, 155],
          chart: {
          type: 'donut',
          height: 190
        },
        labels: [
            'Excellent     187 คน',
            'Good          158 คน',
            'Fair          155 คน',
            'Poor          155 คน'],
        colors:['#415089', '#08AF9D', '#F0BB5D', '#F36349'],
        legend: {
            show: true,
            offsetX: 10,

            horizontalAlign: 'center',
            itemMargin: {
                vertical: 10
            },
            fontSize: '60px',

        },
        dataLabels: {
            enabled: false,
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            fill: {
                // colors:['#245788', '#245788' ,'#245788', '#245788'],
            },
            legend: {
              position: 'bottom',
              showForSingleSeries: true,
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#bar_bowel"), options);
        chart.render();

</script>
