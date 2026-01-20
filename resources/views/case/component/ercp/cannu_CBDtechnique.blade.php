<div class="col-4">
    Cannulation Technique&nbsp;&nbsp; &nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-6">
        <input type="radio" {{ checkradio($case, 'fidingcbdtech_other', 'GW assisted approach') }}
            name="Cannulation Technique"
            class="form-check-input radiosave radioother" other="fidingcbdtech_other"
            datagroup="CannulationTechnique"
            id="{{ md5('Cannulation Technique GW assisted approach') }}"
            value="GW assisted approach">
        <label class="ms-4" for="{{ md5('Cannulation Technique GW assisted approach') }}">&nbsp;GW assisted
            approach</label>
    </div>
    <div class="col-6">
        <input type="radio" {{ checkradio($case, 'fidingcbdtech_other', 'Contrast assisted approach') }}
            name="Cannulation Technique"
            class="form-check-input radiosave radioother" other="fidingcbdtech_other"
            datagroup="CannulationTechnique"
            id="{{ md5('Cannulation Technique Contrast assisted approach') }}"
            value="Contrast assisted approach">
        <label class="ms-4" for="{{ md5('Cannulation Technique Contrast assisted approach') }}">&nbsp;Contrast
            assisted approach</label>
    </div>
    <div class="col-6">
        <input type="radio" {{ checkradio($case, 'fidingcbdtech_other', 'EUS-RV') }} name="Cannulation Technique"
            class="form-check-input radiosave radioother" other="fidingcbdtech_other"
            datagroup="CannulationTechnique"id="{{ md5('Cannulation Technique EUS-RV') }}" value="EUS-RV">
        <label class="ms-4" for="{{ md5('Cannulation Technique EUS-RV') }}">&nbsp;EUS-RV</label>
    </div>
    <div class="col-6">
        <input type="radio" {{ checkradio($case, 'fidingcbdtech_other', 'Cannulation beside previous stent') }} name="Cannulation Technique"
            class="form-check-input radiosave radioother" other="fidingcbdtech_other"
            datagroup="CannulationTechnique"id="{{ md5('Cannulation Technique Cannulation beside previous stent') }}"
            value="Cannulation beside previous stent">
        <label class="ms-4"
            for="{{ md5('Cannulation Technique Cannulation beside previous stent') }}">&nbsp;Cannulation beside
            previous stent</label>
    </div>


    <div class="col-12">
        <input class="form-control autotext savejson" id="fidingcbdtech_other" placeholder="Other" type="text"
            autocomplete="off" value="{{ @$case->fidingcbdtech_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>
