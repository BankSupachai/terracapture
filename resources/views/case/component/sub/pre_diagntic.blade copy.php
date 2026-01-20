<div class="row mt-2 ">
    <div class="col-2 d-flex align-items-center text-nowrap">
       <b>Pre-Diagnosis</b>
    </div>
    @foreach (isset($prediagnosis) ? $prediagnosis : [] as $box)
        <div class="col-">
            <input type="checkbox" name="prediagnosis" class="savejson_checkbox check-color"
                id="prediagnosis{{ $box->prediagnostic_id }}" value="{{ $box->prediagnostic_name }}"
                {{ in_array($box->prediagnostic_name, $case_json->$box->prediagnostic_name) }}>
            <label for="prediagnosis{{ $box->prediagnostic_id }}">{{ $box->prediagnostic_name }}</label>
        </div>
    @endforeach
    <div class="col-auto d-flex align-items-center">
        <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm"
            id="btn_prediagnostic">
            <i class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
            None Pre-Diagnosis
        </button>
    </div>
</div>
<div class="col-12">
    <input class="form-control autotext savejson" name="prediagnostic_other" id="prediagnostic_other"
        placeholder="Other Diagnosis" type="text" autocomplete="off" value="{{ @$case->prediagnostic_other }}" />
</div>

<script>
    $("#btn_prediagnostic").click(function() {
        $("#prediagnostic_other").val("None Pre-Diagnosis");
        $("#prediagnostic_other").focus();
    });
</script>
