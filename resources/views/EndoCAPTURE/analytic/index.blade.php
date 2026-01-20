@extends('layouts.layouts_index.main')
@php
    $view['filter_procedure']       = $filter_procedure;
    $view['filter_room']            = $filter_room;
    $view['filter_scope']           = $filter_scope;
    $view['filter_prediagnostic']   = $filter_prediagnostic;
    $view['filter_medication']      = $filter_medication;
    $view['month_all']              = $month_all;

    $view['hospital']               = $hospital;
    // $view['allcase']        = $allcase;
    // $view['allpatient']     = $allpatient;
    // $view['gender']         = $gender;
    // $view['roomall']        = $roomall;
    // $view['nurseall']       = $nurseall;
    // $view['endoscopistall'] = $endoscopistall;
    // $view['userall']        = $userall;
    // $view['procedure_all']  = $procedure_all;
@endphp

@section('style')
    <style>
        .mw-60{
            max-width: 60%;
        }
        #chart_Year {
            max-width: 80%;
            height: auto;
        }
        #chart_month,#chart_age,#chart_gender{
            max-width: 100%;
            height: 100%;
        }
        #icd10,#icd09,#medication,#fiding,#scope {
            width: 100%;
            height: 300px;
        }
        g[opacity="0.4"],g[opacity="0.3"]{
            display: none;
        }
        .card{
            height: 100%;
        }
        #chart_scope_all,#chart_icd10_modal,#chart_icd9_modal{
            width: 100%;
            height: 39em;
        }
        .row {
            --vz-gutter-x: 1rem !important;
        }
    </style>
@endsection

@section('modal')
    <script src="{{url('public/js/core.js')}}"></script>
    <script src="{{url('public/js/charts.js')}}"></script>
    <script src="{{url('public/js/animated.js')}}"></script>
    @component('endocapture.analytic.modal.icd9_modal')@endcomponent
    @component('endocapture.analytic.modal.icd10_modal')@endcomponent
    @component('endocapture.analytic.modal.scope_modal')@endcomponent
@endsection


@section('title-left')
    <h4 class="mb-sm-0">DATA ANALYZE</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
        <li class="breadcrumb-item active">Data Analyze</li>
    </ol>
@endsection
@section('content')
<div class="row m-0">


    <div class="col-lg-2">
        <div class="row h-100">
            @component('endocapture.analytic.card.001_totalcase',$view)@endcomponent
            @component('endocapture.analytic.card.002_totalpatient')@endcomponent
            @component('endocapture.analytic.card.003_totaldoctor')@endcomponent
            @component('endocapture.analytic.card.004_totalnurse')@endcomponent
            @component('endocapture.analytic.card.005_totalstation')@endcomponent
        </div>
    </div>

    <div class="col-lg-10 p-0">
        <div class="row m-0">
            @component('endocapture.analytic.card.000_toolbar',$view)@endcomponent

            <div class="col-lg-7 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @component('endocapture.analytic.card.006_year')@endcomponent
                            @component('endocapture.analytic.card.007_month')@endcomponent
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 mt-2">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row">
                            @component('endocapture.analytic.card.008_age')@endcomponent
                            @component('endocapture.analytic.card.009_gender')@endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-0 mt-2 ">
            <div class="col-lg-4">
                <div class="row m-0 h-100">
                    {{-- @component('analytic.card.010_user',$view)@endcomponent --}}
                    @component('endocapture.analytic.card.011_procedure',$view)@endcomponent
                </div>
            </div>
            <div class="col-lg-8 p-0">
                <div class="row m-0">
                    @component('endocapture.analytic.card.012_icd10')@endcomponent
                    @component('endocapture.analytic.card.013_icd9')@endcomponent
                    @component('endocapture.analytic.card.014_medication')@endcomponent
                    @component('endocapture.analytic.card.015_finding')@endcomponent
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row m-0">
    @component('endocapture.analytic.card.016_room',$view)@endcomponent
    @component('endocapture.analytic.card.017_scope')@endcomponent
</div>
<br><br>
@endsection



@section('script')


<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $('.showdata').hide();

    $.post('{{ url('analytic') }}', {
        event: 'loaddata',
    }, function(data, status) {
        $('.loading').hide();
        $('.showdata').show();
        var json            = JSON.parse(data);
        var room            = json['room'];
        var procedure_all   = json['data_procedure'];
        chartYEAR.data      = json['year'];
        chartMONTH.data     = json['month'];
        chartSCOPE.data     = json['scope_show5'];
        chartMEDICATION.data= json['medication_show5'];
        chartICD10.data     = json['icd10_show5'];
        chartICD9.data      = json['icd9_show5'];
        chartAGE.data       = json['age'];
        chartGENDER.data    = json['gender'];
        chartFINDING.data   = json['finding'];

        $('#allcase')       .html(json['allcase']);
        $('#allpatient')    .html(json['allpatient']);
        $('#alldoctor')     .html(json['alldoctor']);
        $('#allnurse')      .html(json['allnurse']);
        $('#allroom')       .html(json['allroom']);
        data_room(room);
        data_procedure(procedure_all);
        console.log(chartMONTH.data);
        console.log(chartYEAR.data);
    });


    $('#filter').click(function(){
        $('.showdata').hide();
        $('.loading').show();
        $.post('{{ url('analytic') }}', {
            event               : 'loaddata',
            year                : $('#filter_year').val(),
            month               : $('#filter_month').val(),
            procedure           : $('#filter_procedure').val(),
            age                 : $('#filter_age').val(),
            room                : $('#filter_room').val(),
            icd10               : $('#filter_icd10').val(),
            icd9                : $('#filter_icd9').val(),
            scope               : $('#filter_scope').val(),
            prediagnostic       : $('#filter_prediagnostic').val(),
            medication          : $('#filter_medication').val(),
            finding             : $('#filter_finding').val()
        }, function(data, status) {
            $('.loading').hide();
            $('.showdata').show();
            var json            = JSON.parse(data);
            var room            = json['room'];
            var procedure_all   = json['data_procedure'];
            chartYEAR.data      = json['year'];
            chartMONTH.data     = json['month'];
            chartSCOPE.data     = json['scope_show5'];
            chartMEDICATION.data= json['medication_show5'];
            chartICD10.data     = json['icd10_show5'];
            chartICD9.data      = json['icd9_show5'];
            chartAGE.data       = json['age'];
            chartGENDER.data    = json['gender'];
            chartFINDING.data   = json['finding'];
            $('#allcase')       .html(json['allcase']);
            $('#allpatient')    .html(json['allpatient']);
            $('#alldoctor')     .html(json['alldoctor']);
            $('#allnurse')      .html(json['allnurse']);
            $('#allroom')       .html(json['allroom']);
            data_room(room);
            data_procedure(procedure_all);
            console.log(chartMONTH.data);
            console.log(chartYEAR.data);
        });
    });



    function data_room(room){
        $('#data_room').html('');
        const objectArray = Object.entries(room);
        objectArray.forEach(([key, value]) => {
            $('#data_room').append('<tr>');
            $('#data_room').append('<td>'+key+'</td>');
            $('#data_room').append('<td class="text-right" style="width: 4em;">'+value+'</td>');
            $('#data_room').append('<td style="width: 5em;">Times</td>');
            $('#data_room').append('</tr>');
        });
    }

    function data_procedure(procedure_all){
        $('#data_procedure').html('');
        const objectArray = Object.entries(procedure_all);
        objectArray.forEach(([key, value]) => {
            $('#data_procedure').append('<tr>');
            $('#data_procedure').append('<td>'+key+'</td>');
            $('#data_procedure').append('<td class="text-right" style="width: 4em;">'+value+'</td>');
            $('#data_procedure').append('</tr>');
        });
    }



</script>
<script>
  <script src="{{url("assets/libs/apexcharts/apexcharts.min.js")}}"></script>
  <script src="{{url("assets/js/pages/apexcharts-column.init.js")}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/dayjs.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.0/plugin/quarterOfYear.min.js"></script>
</script>
@endsection
