@extends('layouts.layouts_ipad.layouts_Newipad')

@section('modal')

@endsection

@section('style')

    <style>
        .select2-container--default .select2-selection--single {
            background: #2B2F34 !important;
            border: none !important;
        }
    </style>
@endsection

@section('content')

@include('EndoCAPTURE.home.Mockup.componentnurse.layoutsheader')





<div class="row">
    <div class="col-4 py-0 font-gray">
        Date / Time
    </div>
    <div class="col-4 py-0 font-gray">
        Physician
    </div>
    <div class="col-4"></div>
    <div class="col-4  font-gray mt-2">
        @php
        $datetime = isset($case->appointment) ? format_date($case->appointment, 'd/m/Y h:i') : '';
    @endphp
      <input type="text" name="date" id="date" class="form-control savejson" value="{{ @$datetime }}">
    </div>
    <div class="col-4 font-gray mt-2">
        <select class="form-select savejson selectpicker c_physician " id="s_endoscopist" name="case_physicians01"
        data-live-search="true"
       required data-choices>
       <option value=""></option>
       @foreach (isset($doctor) ? $doctor:[] as $data)
       @php
           $doctorname = $data['user_prefix'].$data['user_firstname'].' '.$data['user_lastname'];
       @endphp
            <option value="{{ $data['id'] }}" @if($case->doctorname == $doctorname) selected @endif>
                {{ $data['user_prefix'] }}{{ $data['user_firstname'] }} {{ $data['user_lastname'] }}
            </option>
       @endforeach
   </select>
    </div>
    <div class="col-4"></div>
    <div class="col-4 mt-2 py-0 font-gray">
        Operation Room
    </div>
    <div class="col-4  mt-2 py-0 font-gray">
        Treatment Coverage
    </div>
    <div class="col-4"></div>


    <div class="col-4   font-gray mt-2">
        <select name="room" id="room" class="savejson editroom form-select" data-choices>

            <option value="">room</option>
        </select>
    </div>

    <div class="col-4 font-gray mt-2">
        <select id="treatment_coverage" name="treatment_coverage" class="form-select" data-choices>
            <option value=""></option>
            @foreach (isset($tb_treatmentcoverage) ? $tb_treatmentcoverage : [] as $data)
                @php
                    $data = (object) $data;
                @endphp
                @if ($data->name == @$case->treatment_coverage)
                    <option value="{{ $data->name }}" selected>{{ $data->name }}
                    </option>
                @else
                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                @endif
            @endforeach
        </select>
        <script>
            $("#treatment_coverage").select2();
            $('#treatment_coverage').on('select2:close', function(e) {
                var value = $('#treatment_coverage').val();
                $.post('{{ url('api/photomove') }}', {
                    event: 'savejson',
                    name: "treatment_coverage",
                    value: value,
                    table: "tb_case",
                    field: 'case_json',
                    id: '{{ @$cid }}',
                    comcreate: '{{ @$case->comcreate }}',
                    procedure: '{{ @$procedure->code }}',
                }, function(data, status) {});
            });
        </script>
    </div>
    <div class="col-4"></div>
    <div class="col-4 mt-2 py-0 font-gray">
        Procedure
    </div>
    <div class="col-4"></div>
    <div class="col-4"></div>
    <div class="col-4 mt-2 py-0 font-gray">
        {{-- @dd($caseall); --}}
        <input type="text" class="form-control form-control-dark"   value="{{ @$caseall[0]['procedurename']  }}">
    </div>
    <div class="col-4 mt-2 py-0">
        <input type="text" class="form-control form-control-dark" value="{{ @$caseall[1]['procedurename']  }}">

    </div>
    <div class="col-4 mt-2 py-0">
        <input type="text" class="form-control form-control-dark"  value="{{ @$caseall[2]['procedurename']  }}">
    </div>
    <div class="col-12 mt-2 py-0 font-gray">
        Pre-Diagnosis
    </div>

    <div class="col-12 mt-2 py-0">
        {{-- @dd(1); --}}
        <input type="text" class="form-control form-control-dark" placeholder="Gastritis" value="{{ @$caseall[0]['prediagnostic_other']  }} {{ @$caseall[1]['prediagnostic_other']  }} {{ @$caseall[2]['prediagnostic_other']  }} ">

    </div>
</div>
@endsection



@section('script')

@endsection


