<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EndoINDEX</title>
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

           @font-face {
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 100;
            src: url("{{ url('public/fonts/Anuphan-Thin.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 200;
            src: url("{{ url('public/fonts/Anuphan-ExtraLight.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 300;
            src: url("{{ url('public/fonts/Anuphan-Light.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 400;
            src: url("{{ url('public/fonts/Anuphan-Regular.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 500;
            src: url("{{ url('public/fonts/Anuphan-Medium.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 600;
            src: url("{{ url('public/fonts/Anuphan-SemiBold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'Anuphan';
            font-style: italic;
            font-weight: 700;
            src: url("{{ url('public/fonts/Anuphan-Bold.ttf') }}") format("truetype");
        }

        * {
            font-family: 'Anuphan' !important;
            font-size: 14px;

        }
        .text-header-chart{
            text-align: center;
            margin-top: 0.5rem;
            font-size: 18px !important;
        }
        .btn-showall{
            background: #F3F6F9;
        }
        .ms-15{
            margin-left: 12em;
        }
        .text-header-fullchart{
            font-size: 25px !important;
        }
    </style>
</head>
<script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
<script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
<script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>


<body>
    <div class="row m-0 p-0">
        <div class="col-lg-12 p-0">
            <div class="card m-0">
                <div class="card-header">
                    <div class="row p-0 m-0">
                        <div class="col-lg-4">
                            @php
                                $date_from = isset($filter['date_from']) ? $filter['date_from'] : null;
                                $date_to   = isset($filter['date_to'])   ? $filter['date_to'] : null;
                                $physician = isset($filter['physician']) ? $filter['physician'] : null;
                                $procedure = isset($filter['procedure']) ? $filter['procedure'] : null;

                                $text = '';
                                foreach (isset($filter)?$filter:[] as $key => $value) {
                                    if(isset($filter[$key])){
                                        $text = $text."$key=$value&";
                                    }
                                }
                            @endphp
                            {{-- <a href="{{url("dashboard")}}" class="btn btn-light ">ย้อนกลับ </a> --}}
                            <a href="{{url('chdashboard')}}?event=filter_search&{{$text}}"
                            class="btn btn-light">หน้าหลัก</a>
                        </div>
                        @php
                            $intervention_arr = isset($intervention_data) ? $intervention_data : [];
                            foreach ($intervention_arr as $key => $value) {
                                if($value == 0){
                                    unset($intervention_arr[$key]);
                                }
                            }
                        @endphp
                        <div class="col-lg-4 text-center">
                            <span class="text-header-fullchart">Intervention</span>
                        </div>
                        <div class="col-lg-4">

                        </div>
                    </div>
                </div>
                <div class="card-body p-0 ">
                    <div id="bar_intervention_all" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
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


{{-- <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script>


<script>

    var total = @json($intervention_arr);
    var key = Object.keys(total)
    var value = Object.values(total)
    var options = {
          series: [{
            name: 'จำนวน',
            data: value
          }],
          chart: {
          type: 'bar',
          height: 500,
          width: '80%',
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
        tooltip: {
         y: {
           formatter: function (val) {
             return val + " คน"
           }
         }
       },
        fill: {
            colors:['#245788'],
        },
        xaxis: {
          categories: key,
          min:0,
          tickAmount: 1,
        },
        };

    var chart = new ApexCharts(document.querySelector("#bar_intervention_all"), options);
    chart.render();
</script>

