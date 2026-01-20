<div class="col-4">
    CBD cannulation by&nbsp;&nbsp; &nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-6">
        <input type="radio" {{ checkradio($case, 'fidingcbdby_other', 'MTW catheter') }}
            name="cannulationcbd"
            class="form-check-input radiosave radioother" other="fidingcbdby_other"
            datagroup="CBDcannulationby"id="{{ md5('CBD cannulation by MTW catheter') }}"
            value="MTW catheter">
        <label class="ms-4" for="{{ md5('CBD cannulation by MTW catheter') }}">&nbsp;MTW catheter</label>
    </div>
    <div class="col-6">
        <input type="radio" {{ checkradio($case, 'fidingcbdby_other', 'Sphincterotome') }} name="cannulationcbd"
            class="form-check-input radiosave radioother" other="fidingcbdby_other"
            datagroup="CBDcannulationby"id="{{ md5('CBD cannulation by Sphincterotome') }}"
            value="Sphincterotome">
        <label class="ms-4" for="{{ md5('CBD cannulation by Sphincterotome') }}">&nbsp;Sphincterotome</label>
    </div>


    <div class="col-12 mt-2">
        <input class="form-control autotext savejson" id="fidingcbdby_other" placeholder="Other" type="text"
            autocomplete="off" value="{{ @$case->fidingcbdby_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>
