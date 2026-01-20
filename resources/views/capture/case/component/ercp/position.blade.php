<div class="col-2">
    Position&nbsp;&nbsp;
</div>
<div class="col-12"></div>
<div class="row">
    <div class="col-4">
        <input type="checkbox" {{ checkinarray($case, 'position', 'Supine') }} name="Position" class="form-check-input checkboxgroupsave" datagroup="position" id="{{md5("Position Supine")}}" value="Supine">
        <label class="ms-4" for="{{md5("Position Supine")}}">&nbsp;Supine</label>
    </div>
    <div class="col-4">
        <input type="checkbox" {{ checkinarray($case, 'position', 'Prone') }} name="Position" class="form-check-input checkboxgroupsave" datagroup="position" id="{{md5("Position Prone")}}" value="Prone">
        <label class="ms-4" for="{{md5("Position Prone")}}">&nbsp;Prone</label>
    </div>
    <div class="col-4">
        <input type="checkbox" {{ checkinarray($case, 'position', 'Lt.lateral decebitus') }} name="Position" class="form-check-input checkboxgroupsave" datagroup="position" id="{{md5("Position Lt.lateral decebitus")}}" value="Lt.lateral decebitus">
        <label class="ms-4" for="{{md5("Position Lt.lateral decebitus")}}">&nbsp;Lt.lateral decubitus</label>
    </div>
</div>

<div class="col-12">
    <input class="form-control autotext savejson" id="positionother"
        placeholder="Other Position" type="text" autocomplete="off"
        value="{{ checknotarray(@$case->positionother) }}" />
</div>
<div class="col-12">&nbsp;</div>
