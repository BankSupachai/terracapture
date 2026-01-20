
@extends('capture.layoutv6')
@section('style')
<style>
    html{
        min-height: 0 !important;
    }
     * {
            font-family: 'kanit' !important;

        }

        .fs-12{font-size: 12px;}
        .text-header-chart{
            text-align: center;
            margin-top: 0.5rem;
            font-size: 16px !important;
            color: #707070;
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
            height: 275px;
        }

        .apexcharts-legend-text {
            font-family: 'Anuphan' !important;
        }



        .h-right {
            height: 224px;
        }
        .h-right2 {
            height: 198px;
        }

        .apexcharts-xaxis text, .apexcharts-yaxis text{
            fill: #4d4d4d !important;

        }
        .apexcharts-legend-text {
            color: #4d4d4d !important;
        }
        .t-chartprocedure{
            color: #878a99;
        }

        @media only screen and (max-width: 991px) {
            .respondsive_dashboard{
                display: none;
            }
            .w-16{width: 100%;}
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

@section('content')
@include('capture.camera.obs.js_hotkey')
<div class="row">
    @include('capture.dashboard02.05_fillter')
</div>
<div class="row m-0 pt-2 fs-12" style="">
    <div class="col-lg-auto w-16">
        <div class="row ">
            @include('capture.dashboard02.01_totalcase')
            {{-- @include('dashboard02.02_active') --}}
            {{-- @include('dashboard02.03_totalroom') --}}
            {{-- @include('dashboard02.04_totalscope') --}}

            {{-- @include('dashboard.03_hospital02') --}}
            {{-- @include('dashboard.04_hospital03') --}}
        </div>
    </div>
    <div class="col-lg-10 p-0" >

        <div class="row mb-2">
            @include('capture.dashboard02.06_procedure')
            @include('capture.dashboard02.07_treatment')
            @include('capture.dashboard02.08_agegender')
            @include('capture.dashboard02.09_diagnosis')
            @include('capture.dashboard02.10_intervention')
            {{-- @include('dashboard02.11_complication') --}}
            @include('capture.dashboard02.12_physician')
            {{-- @include('dashboard02.13_bowel') --}}
            {{-- @include('dashboard02.14_gastric') --}}
{{--
            @include('dashboard.07_status')
            @include('dashboard.09_bowel')
            @include('dashboard.10_diagnosis')
            @include('dashboard.11_intervention')
            @include('dashboard.13_treatmentcoverage')
             @include('dashboard.14_colorectalcancer') --}}

        </div>
    </div>
</div>
@endsection


@section('script')

<script>
    $(document).ready(function() {
        $('#physician').select2({
            placeholder: "Physician",
            allowClear: true
        });

        $('#physician').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });



        $('#procedure').select2({
            placeholder: "Procedure",
            allowClear: true
        });

        $('#procedure').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                jQuery('.select2-dropdown').slideDown(300);
            });
        });
    });
</script>
<script>
    function to_url(type) {
        let date_from = $('#date_from').val()
        let date_to   = $('#date_to').val()
        let physician = $('#physician').find(':selected').val()
        let procedure = $('#procedure').find(':selected').val()
        url           = `{{url('analysis')}}/${type}?date_from=${date_from}&date_to=${date_to}&physician=${physician}&procedure=${procedure}`
        location.href = url
    }
</script>
@endsection
