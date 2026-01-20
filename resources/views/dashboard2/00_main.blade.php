<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>R5 Dashboard</title>
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
        .mw-60 {
            max-width: 60%;
        }

        .card {
            margin: 0;
        }

        #chart_scope_all,
        #chart_icd10_modal,
        #chart_icd9_modal {
            width: 100%;
            height: 39em;
        }
        .fs-50{
            font-size: 50px;
        }
        .row {
            --vz-gutter-x: 1rem !important;

        }

        .w-16 {
            width: 16%;
        }

        .circle {
            height: 20px;
            width: 20px;
            background: #245788;
            border-radius: 50%;
        }


        .h-charts {
            height: 307px;
        }

        .apexcharts-legend-text {
            font-family: 'Anuphan' !important;
        }

        .h-right {
            height: 240px;
        }
        .apexcharts-xaxis text, .apexcharts-yaxis text{
            fill: #4d4d4d !important;

        }
        .apexcharts-legend-text {
            color: #4d4d4d !important;
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
    <div class="row m-0 pt-2">
        <div class="col-lg-auto w-16">
            <div class="row ">
                @include('dashboard2.01_allcase')
                @include('dashboard2.02_hospital01')
                @include('dashboard2.03_hospital02')
                @include('dashboard2.04_hospital03')
            </div>
        </div>
        <div class="col-lg-10 p-0">
            <div class="row">
                @include('dashboard2.05_fillter')
            </div>
            <div class="row mb-2">
                @include('dashboard2.06_patientall')
                @include('dashboard2.07_status')
                @include('dashboard2.08_agegender')
                @include('dashboard2.09_bowel')
                @include('dashboard2.10_diagnosis')
                @include('dashboard2.11_intervention')
                @include('dashboard2.12_physician')
                @include('dashboard2.13_treatmentcoverage')
                @include('dashboard2.14_colorectalcancer')

            </div>
        </div>
    </div>
    <div class="card m-0" style="padding: 1.5em;">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-6">
                    ©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> EndoINDEX 6.0
                </div>
                <div class="col-sm-6">
                    <div class="text-end">
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


{{-- <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script>


<script>
    setTimeout(() => {
        window.location.reload();
    }, 60000);
</script>
