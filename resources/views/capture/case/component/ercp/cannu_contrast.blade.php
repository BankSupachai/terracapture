<div class="col-4">
    Type of contrast&nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-4 ">
        <input type="radio" {{ checkradio($case, 'cannubiletype_other', 'Optiray') }} name="box_cannula_contrash"
            class="form-check-input radiosave  radioother" other="cannubiletype_other" datagroup="Typeofcontrast"
            id="{{ md5('Type of contrast Optiray') }}" value="Optiray">
        <label class="ms-4" for="{{ md5('Type of contrast Optiray') }}">&nbsp;Optiray</label>
    </div>
    <div class="col-4 ">
        <input type="radio" {{ checkradio($case, 'cannubiletype_other', 'Xenetic') }} name="box_cannula_contrash"
            class="form-check-input radiosave  radioother" other="cannubiletype_other" datagroup="Typeofcontrast"
            id="{{ md5('Type of contrast Xenetic') }}" value="Xenetic">
        <label class="ms-4" for="{{ md5('Type of contrast Xenetic') }}">&nbsp;Xenetic</label>
    </div>
    <div class="col-4 ">
        <input type="radio" {{ checkradio($case, 'cannubiletype_other', 'Ultravist') }} name="box_cannula_contrash"
            class="form-check-input radiosave  radioother" other="cannubiletype_other" datagroup="Typeofcontrast"
            id="{{ md5('Type of contrast Ultravist') }}" value="Ultravist">
        <label class="ms-4" for="{{ md5('Type of contrast Ultravist') }}">&nbsp;Ultravist</label>
    </div>
    <div class="col-4 ">
        <input type="radio" {{ checkradio($case, 'cannubiletype_other', 'Visipaque') }} name="box_cannula_contrash"
            class="form-check-input radiosave  radioother" other="cannubiletype_other" datagroup="Typeofcontrast"
            id="{{ md5('Type of contrast Visipaque') }}" value="Visipaque">
        <label class="ms-4" for="{{ md5('Type of contrast Visipaque') }}">&nbsp;Visipaque</label>
    </div>
    <div class="col-4 ">
        <input type="radio" {{ checkradio($case, 'cannubiletype_other', 'Omnipaque') }} name="box_cannula_contrash"
            class="form-check-input radiosave  radioother" other="cannubiletype_other" datagroup="Typeofcontrast"
            id="{{ md5('Type of contrast Omnipaque') }}" value="Omnipaque">
        <label class="ms-4" for="{{ md5('Type of contrast Omnipaque') }}">&nbsp;Omnipaque</label>
    </div>
    <div class="col-4 ">
        <input type="radio" {{ checkradio($case, 'cannubiletype_other', 'Urografin') }} name="box_cannula_contrash"
            class="form-check-input radiosave  radioother" other="cannubiletype_other" datagroup="Typeofcontrast"
            id="{{ md5('Type of contrast Urografin') }}" value="Urografin">
        <label class="ms-4" for="{{ md5('Type of contrast Urografin') }}">&nbsp;Urografin</label>
    </div>

    <div class="col-12 mt-2">
        <input class="form-control autotext savejson" id="cannubiletype_other" placeholder="Other" type="text"
            autocomplete="off" value="{{ @$case->cannubiletype_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>
