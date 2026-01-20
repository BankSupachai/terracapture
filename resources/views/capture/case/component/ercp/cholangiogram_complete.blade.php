<h5>Complete Cholangiogram</h5>
<h6>Please select to make a sentence</h6>

<div class="col-3 mb-3">
    <div class="form-check mb-2">
        <input class="form-check-input checkboxgroupsave_edit" type="checkbox" datagroup="complete_cholangiogram"
            value="Complete Cholangiogram from"  dataindex="0"name="complete_cholangiogram_ck" subgroup="complete_cholangiogram_from"
            {{ checkinarray($case, 'Complete Cholangiogram', 'Complete Cholangiogram from') }}
            id="{{ md5('Complete Cholangiogram Complete Cholangiogram from') }}"
            @if(check_in_array(@$case->complete_cholangiogram_ck, 'complete_cholangiogram_from')) checked @endif 
            >
        <label class="form-check-label ms-2" for="{{ md5('Complete Cholangiogram Complete Cholangiogram from') }}">
            Select
        </label>
    </div>
</div>
<div class="col-9">
    <div class="row">
        <div class="col-auto">
            Complete Cholangiogram from
        </div>
        <div class="col-4 mb-3"  >
            <input type="text"  dataindex="0" position="Complete Cholangiogram from {}" datagroup="complete_cholangiogram" subgroup="complete_cholangiogram_from" name="complete_cholangiogram_from_other"
            class="form-control form-control-sm autotext savejson savejson_edit ck-radio" id="complete_cholangiogram_from_other"
            value="{{@$case->complete_cholangiogram_from_other}}">
        </div>

    </div>
</div>

{{-- ----------------------------------------- --}}
<div class="col-3 mb-3">
    <div class="form-check mb-2">
        <input class="form-check-input checkboxgroupsave_edit" type="checkbox" datagroup="complete_cholangiogram"
            value="No residual filling defect" dataindex="1" name="complete_cholangiogram_ck" subgroup="complete_cholangiogram_no_residual"
            {{ checkinarray($case, 'Complete Cholangiogram', 'No residual filling defect') }} 
            id="{{ md5('Complete Cholangiogram No residual filling defect') }}"
            @if(check_in_array(@$case->complete_cholangiogram_ck, 'complete_cholangiogram_no_residual')) checked @endif 
            >
        <label class="form-check-label ms-2" for="{{ md5('Complete Cholangiogram No residual filling defect') }}">
            Select
        </label>
    </div>
</div>
<div class="col-9">
    <div class="col-auto">
        No residual filling defect
    </div>
</div>

{{-- ----------------------------------------- --}}

<div class="col-3">
    <div class="form-check mb-2">
        <input class="form-check-input checkboxgroupsave_edit" type="checkbox" datagroup="complete_cholangiogram"  subgroup="complete_cholangiogram_resist"
            {{ checkinarray($case, 'Complete Cholangiogram', 'resistance') }} name="complete_cholangiogram_ck"
            id="{{ md5('Complete Cholangiogram resistance') }}" dataindex="2"
            @if(check_in_array(@$case->complete_cholangiogram_ck, 'complete_cholangiogram_resist')) checked @endif 
            >
        <label class="form-check-label ms-2" for="{{ md5('Complete Cholangiogram resistance') }}">
            Select
        </label>
    </div>
</div>
<div class="col-9">
    <div class="col-auto">
        <input class="form-check-input radiosave_edit" type="radio" datagroup="complete_cholangiogram" name="complete_cholangiogram_resist" subgroup="complete_cholangiogram_resist"
            {{ checkinarray($case, 'Complete Cholangiogram', 'No resistance') }}  value="No resistance" position="{}"
            id="{{ md5('Complete Cholangiogram No resistance') }}" dataindex="2"
            @if(check_in_str('', 'No resistance', @$case->complete_cholangiogram['complete_cholangiogram_resist'])) checked @endif
            >
        <label class="form-check-label ms-2" for="{{ md5('Complete Cholangiogram No resistance') }}">
            No resistance
        </label>
    </div>
</div>

<div class="col-3">

</div>
<div class="col-9">
    <div class="row">
        <div class="col-auto">
            <input class="form-check-input radiosave_edit ck-complete_cholangiogram_resist" datagroup="complete_cholangiogram" type="radio" subgroup="complete_cholangiogram_resist"
                {{ checkinarray($case, 'Complete Cholangiogram', 'Minimal resistance at') }}  dataindex="2" value="Minimal resistance at" position="{}"
                id="{{ md5('Complete Cholangiogram Minimal resistance at') }}" name="complete_cholangiogram_resist"
                @if(check_in_str('', 'No resistance', @$case->complete_cholangiogram['complete_cholangiogram_resist']) == false && @$case->complete_cholangiogram_resist_other."" != "") checked @endif
                >
            <label class="form-check-label ms-2" for="{{ md5('Complete Cholangiogram Minimal resistance at') }}">
                Minimal resistance at
            </label>
        </div>
        <div class="col-3">
            <input id="complete_cholangiogram_resist_other" type="text" class="form-control form-control-sm savejson savejson_edit ck-radio" dataindex="2" subgroup="complete_cholangiogram_resist"
            name="complete_cholangiogram_resist" datagroup="complete_cholangiogram" position="Minimal resistance at {}"
            value="{{@$case->complete_cholangiogram_resist_other}}"
            >
        </div>
    </div>
</div>

{{-- ----------------------------------------- --}}

<div class="col-3">
    <div class="form-check mb-2">
        <input class="form-check-input checkboxgroupsave_edit" datagroup="complete_cholangiogram" type="checkbox" dataindex="3" subgroup="complete_cholangiogram_delay"
            {{ checkinarray($case, 'Complete Cholangiogram', 'delay') }} name="complete_cholangiogram_ck" 
            id="{{ md5('Complete Cholangiogram delay') }}"
            @if(check_in_array(@$case->complete_cholangiogram_ck, 'complete_cholangiogram_delay')) checked @endif 
            >
        <label class="form-check-label ms-2" for="{{ md5('Complete Cholangiogram delay') }}">
            Select
        </label>
    </div>
</div>
<div class="col-9 mb-3">
    <div class="col-auto">
        <input class="form-check-input radiosave_edit" datagroup="complete_cholangiogram" subgroup="complete_cholangiogram_delay" name="complete_cholangiogram_delay" type="radio" dataindex="3"
            value="No delay of contrast" {{ checkinarray($case, 'Complete Cholangiogram', 'No delay of contrast') }} position="{}"
            id="{{ md5('Complete Cholangiogram No delay of contrast') }}"
            @if(check_in_str('', 'No delay of contrast', @$case->complete_cholangiogram['complete_cholangiogram_delay'])) checked @endif
            >
        <label class="form-check-label ms-2" for="{{ md5('Complete Cholangiogram No delay of contrast') }}">
            No delay of contrast
        </label>
    </div>
</div>

<div class="col-3">

</div>
<div class="col-9">
    <div class="row">
        <div class="col-auto">
            <input class="form-check-input radiosave_edit ck-complete_cholangiogram_delay" datagroup="complete_cholangiogram" subgroup="complete_cholangiogram_delay" name="complete_cholangiogram_delay" type="radio"
                value="Minimal delay of contrast in" dataindex="4" position="{}"
                {{ checkinarray($case, 'Complete Cholangiogram', 'Minimal delay of contrast in') }}
                id="{{ md5('Complete Cholangiogram Minimal delay of contrast in') }}"
                @if(check_in_str('', 'No delay of contrast', @$case->complete_cholangiogram['complete_cholangiogram_delay']) == false && @$case->complete_cholangiogram_delay_other."" != "") checked @endif
                >
            <label class="form-check-label ms-2"
                for="{{ md5('Complete Cholangiogram Minimal delay of contrast in') }}">
                Minimal delay of contrast in
            </label>
        </div>
        <div class="col-3">
            <input type="text" id="complete_cholangiogram_delay_other" class="form-control form-control-sm savejson savejson_edit ck-radio" name="complete_cholangiogram_delay" 
            subgroup="complete_cholangiogram_delay" datagroup="complete_cholangiogram" position="Minimal delay of contrast in {}"
            value="{{@$case->complete_cholangiogram_delay_other}}"
            >
        </div>
    </div>
</div>
