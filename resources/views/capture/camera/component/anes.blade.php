<div class="row">
    <div class="col-auto"><b>Anesthesia</b></div>
    <div class="col">
        <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm btn btn-checkbox-camera" id="btn_anesthesia">
            <i class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-white"></i>
            None Anesthesia
        </button>
    </div>
</div>
<div class="row">
    @php
        $anesthesia = isset($case->anesthesia) ? $case->anesthesia : [];
    @endphp
    @foreach (isset($anes)?$anes:array() as $box)
    @php
        $is_checked_anes = in_array($box, $anesthesia) ? 'checked' : '';
    @endphp
        <div class="col-4">
            <input
            type    = "checkbox"
            name    = "anesthesia"
            class   = "form-check-input savejson_checkbox ck-val anes-ck"
            id      = "anesthesia{{$box}}"
            value   = "{{$box}}"
            {{$is_checked_anes}}
            >
            <span></span>
            <label class="ms-4" for="anesthesia{{$box}}">&nbsp;{{$box}}</label>

        </div>
    @endforeach
    <div class="col-12 mt-2">
        <input type="text" id="anesthesiaother" name="anesthesiaother" placeholder="Other Anesthesia" class="form-control anes-text save-text text-keypress" value="{{@$case->anesthesiaother}}">
    </div>
</div>


