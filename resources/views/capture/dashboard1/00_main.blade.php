<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EndoCAPTURE</title>
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

        .row {
            font-family: 'Anuphan' !important;
            font-size: 12px;

        }
        .fs-16 {
            font-size: 16px !important;
        }

        .text-header-chart {
            text-align: center;
            margin-top: 0.5rem;
            font-size: 16px !important;
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

        .fs-50 {
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

        .apexcharts-xaxis text,
        .apexcharts-yaxis text {
            fill: #4d4d4d !important;

        }

        .apexcharts-legend-text {
            color: #4d4d4d !important;
        }

        .filter-section {
            position: relative;
            z-index: 1;
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
<script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>



@section('content')

    <body>



                @extends('capture.layoutv6')

        <div class="row pt-2">
            <div class="col-lg-12 fs-15">
                @include('capture.dashboard1.05_fillter')
            </div>
        </div>
        <div class="row m-0">
            <div class="col-lg-3">
                <div class="row">

                    @include('capture.dashboard1.01_allcase')
                    {{-- @include('capture.dashboard.02_hospital01') --}}
                    {{-- @include('capture.dashboard.03_hospital02') --}}
                    {{-- @include('capture.dashboard.04_hospital03') --}}
                </div>
            </div>
            <div class="col-lg-9 p-0 ">

                <div class="row mb-2" style="margin-top:-8px;">
                    @include('capture.dashboard1.06_procedure')
                    {{-- @include('capture.dashboard.07_status') --}}
                    @include('capture.dashboard1.13_treatmentcoverage')
                    @include('capture.dashboard1.08_agegender')
                    {{-- @include('capture.dashboard.09_bowel') --}}
                    @include('capture.dashboard1.10_diagnosis')
                    @include('capture.dashboard1.11_intervention')
                    @include('capture.dashboard1.12_physician')
                    {{-- @include('capture.dashboard.14_colorectalcancer') --}}

                </div>
            </div>
        </div>

        {{-- <div class="card m-0" style="padding: 1.5em;">
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
    </div> --}}
    </body>
@endsection

</html>


<script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
{{-- <script src="{{url("assets/js/plugins.js")}}"></script> --}}
@include('capture.plugins')
<script src="{{ url('assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>
<script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ url('assets/js/select2.min.js') }}"></script>
<script src="{{ url('assets/js/pages/select2.init.js') }}"></script>
<script src="{{ url('assets/libs/fullcalendar/main.min.js') }}"></script>
<script src="{{ url('assets/js/jquery.countdown360.js') }}"></script>

{{-- <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script>


<script>
    $(document).ready(function() {
        // Initialize countdown
        $("#countdown_dashboard").show();
    });
    var countdown = $("#countdown_dashboard").countdown360({
        radius: 20.5,
        seconds: 120,
        strokeWidth: 5,
        // fillStyle: '#3577f11a',
        // strokeStyle: '#3577f180',
        fillStyle: '#ffffff',
        strokeStyle: '#3577f180',
        fontSize: 16,
        fontColor: '#495057',
        fontWeight: 'normal',
        fontFamily: 'kanit',
        autostart: false,
        label: false,
        smooth: true,
        onComplete: function() {
            location.reload(true);
            // $(".auto-logout").click()
            console.log('completed');
        }
    });
    countdown.start();
</script>

{{-- <script>
    setTimeout(() => {
        window.location.reload();
    }, 60000);
</script> --}}
