<div class="col-4">
    Transverse duodenal hood &nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Transverse duodenal hood', 'Redundant') }}
            name="Transverse duodenal hood" class="form-check-input radiosave radioother" other="fidingtransverse_other" datagroup="Transverse duodenal hood"
            id="{{ md5('Transverse duodenal hood Redundant') }}" value="Redundant">
        <label class="ms-4" for="{{ md5('Transverse duodenal hood Redundant') }}">&nbsp;Redundant</label>
    </div>
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Transverse duodenal hood', 'Normal') }}
            name="Transverse duodenal hood" class="form-check-input radiosave radioother" other="fidingtransverse_other" datagroup="Transverse duodenal hood"
            id="{{ md5('Transverse duodenal hood Normal') }}" value="Normal">
        <label class="ms-4" for="{{ md5('Transverse duodenal hood Normal') }}">&nbsp;Normal</label>
    </div>
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Transverse duodenal hood', 'None') }}
            name="Transverse duodenal hood" class="form-check-input radiosave radioother" other="fidingtransverse_other" datagroup="Transverse duodenal hood"
            id="{{ md5('Transverse duodenal hood None') }}" value="None">
        <label class="ms-4" for="{{ md5('Transverse duodenal hood None') }}">&nbsp;None</label>
    </div>
    <div class="col-12">
        <input class="form-control autotext savejson" id="fidingtransverse_other" placeholder="Detail" type="text"
            autocomplete="off" value="{{ @$case->fidingtransverse_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>
