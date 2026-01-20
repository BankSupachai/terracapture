<div class="col-4">
    Infundibulum&nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Infundibulum','Flat') }}  name="Infundibulum" class="form-check-input saveradio radioother" other="fidinginfund_other" datagroup="Infundibulum" id="{{md5("Infundibulum Flat")}}" value="Flat">
        <label class="ms-4" for="{{md5("Infundibulum Flat")}}">&nbsp;Flat</label>
    </div>
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Infundibulum', 'Mild prominence') }}  name="Infundibulum" class="form-check-input saveradio radioother" other="fidinginfund_other" datagroup="Infundibulum"id="{{md5("Infundibulum Mild prominence")}}" value="Mild prominence">
        <label class="ms-4" for="{{md5("Infundibulum Mild prominence")}}">&nbsp;Mild prominence</label>
    </div>
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Infundibulum', 'Prominence') }}  name="Infundibulum" class="form-check-input saveradio radioother" other="fidinginfund_other" datagroup="Infundibulum"id="{{md5("Infundibulum Prominence")}}" value="Prominence">
        <label class="ms-4" for="{{md5("Infundibulum Prominence")}}">&nbsp;Prominence</label>
    </div>
    <div class="col-3">
        <input type="radio" {{ checkradio($case, 'Infundibulum', 'Bulging') }}  name="Infundibulum" class="form-check-input saveradio radioother" other="fidinginfund_other" datagroup="Infundibulum"id="{{md5("Infundibulum Bulging")}}" value="Bulging">
        <label class="ms-4" for="{{md5("Infundibulum Bulging")}}">&nbsp;Bulging</label>
    </div>

    <div class="col-12">
        <input class="form-control autotext savejson" id="fidinginfund_other"
            placeholder="Detail" type="text" autocomplete="off"
            value="{{ @$case->fidinginfund_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>

