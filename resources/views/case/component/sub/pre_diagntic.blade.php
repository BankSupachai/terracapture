@php
    $prediagnosis_list = [];
    if ($procedure->name == 'EUS') {
        $prediagnosis_list[] = 'Pancreatic head mass';
        $prediagnosis_list[] = 'Duodenal lesion';
        $prediagnosis_list[] = 'Pancreatitis';
        $prediagnosis_list[] = 'Pancreatic mass';
        $prediagnosis_list[] = 'Ampullary lesion';
        $prediagnosis_list[] = 'Suspect CBD stone';
        $prediagnosis_list[] = 'Pancreatic lesion';
        $prediagnosis_list[] = 'CBD obstruction';
        $prediagnosis_list[] = 'Suspected rectal cancer';
    }
@endphp

<div class="row mt-2 ">
    <div class="col-12 d-flex align-items-center text-nowrap pb-3">
        <b>Pre-Diagnosis</b>
    </div>
    <div class="col-12">
        <div class="row">
            @foreach (isset($prediagnosis_list) ? $prediagnosis_list : [] as $box)
                @php
                    if (isset($case->prediagnosis)) {
                        $prediagnosisbox = $case->prediagnosis;
                    } else {
                        $prediagnosisbox = [];
                    }
                    $is_checked_prediagnosis = in_array($box, $prediagnosisbox) ? 'checked' : '';
                @endphp
                <div class="col-4 text-nowrap">
                    <input type="checkbox" id="prediagnosis{{ $box }}" name="prediagnosis"
                        class="savejson_checkbox check-color form-check-input" value="{{ $box }}"
                        {{ $is_checked_prediagnosis }}>

                    <label for="prediagnosis{{ $box }}">
                        &ensp; {{ $box }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="col-12">
    <input class="form-control autotext savejson" name="prediagnostic_other" id="prediagnostic_other"
        placeholder="Other Diagnosis" type="text" autocomplete="off" value="{{ @$case->prediagnostic_other }}" />
</div>
