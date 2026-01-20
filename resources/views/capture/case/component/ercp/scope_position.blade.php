<div class="col-2">
    Scope Position&nbsp;&nbsp;
</div>
<div class="col-12"></div>
<div class="row">
    <div class="col-6">
        <input type="checkbox" {{ checkinarray($case, 'Scope Position', 'Short route') }} datagroup="Scope Position"  name="Scope Position" class="form-check-input checkboxgroupsave" id="{{md5("Scope Position Short Route")}}" value="Short route">
        <label class="ms-4" for="{{md5("Scope Position Short Route")}}">&nbsp;Short route</label>
    </div>
    <div class="col-6">
        <input type="checkbox" {{ checkinarray($case, 'Scope Position', 'Long route with difficult to stabilization') }} datagroup="Scope Position"  name="Scope Position" class="form-check-input checkboxgroupsave" id="{{md5("Scope Position Long route with difficult to stabilization")}}" value="Long route with difficult to stabilization">
        <label class="ms-4" for="{{md5("Scope Position Long route with difficult to stabilization")}}">&nbsp;Long route with difficult to stabilization</label>
    </div>
    <div class="col-6">
        <input type="checkbox" {{ checkinarray($case, 'Scope Position', 'Omega loop') }} datagroup="Scope Position"  name="Scope Position" class="form-check-input checkboxgroupsave" id="{{md5("Scope Position Omega loop")}}" value="Omega loop">
        <label class="ms-4" for="{{md5("Scope Position Omega loop")}}">&nbsp;Omega loop</label>
    </div>
    <div class="col-6">
        <input type="checkbox" {{ checkinarray($case, 'Scope Position', 'Change position for scope insertion') }} datagroup="Scope Position"  name="Scope Position" class="form-check-input checkboxgroupsave" id="{{md5("Scope Position Change position for scope insertion")}}" value="Change position for scope insertion">
        <label class="ms-4" for="{{md5("Scope Position Change position for scope insertion")}}">&nbsp;Change position for scope insertion</label>
    </div>
</div>







<div class="col-12">
    <input class="form-control autotext savejson" id="scope_positionother"
        placeholder="Detail" type="text" autocomplete="off"
        value="{{ @$case->scope_positionother }}" />
</div>
