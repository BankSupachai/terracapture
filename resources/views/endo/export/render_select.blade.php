@foreach (isset($head)?$head:[] as $h)
    @php
        $default = ['_id', 'case_id', 'hn', 'procedurename', 'anesthesia', 'mainpart', 'medication', 'finding', 'diagnostic', 'procedure_sub'];
    @endphp
    <div class="col-3 mt-3" >
        <div class="form-check mb-2">
            <input class="form-check-input ck_select_head" type="checkbox" id="select_{{@$h}}" data-field="{{@$h}}" onchange="change_head('{{@$h}}')" @if(in_array($h, $default)) checked @endif>
            <label class="form-check-label" for="select_{{@$h}}">
                @php
                    if($h == 'procedurename'){
                        $h = 'procedure';
                    } else if($h == 'diagnostic') {
                        $h = 'icd10';
                    } else if($h == 'procedure_sub') {
                        $h = 'icd9';
                    }
                @endphp
                {{@$h}}
            </label>
        </div>                        
    </div>
@endforeach
    