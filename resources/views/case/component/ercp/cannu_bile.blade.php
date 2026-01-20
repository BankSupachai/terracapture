<div class="col-4">
    Bile aspiration&nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-6 align-self-center">
        <input type="radio" {{ checkradio($case, 'cannubileaspiration_other', 'No') }}  name="Bile aspiration"
        class="form-check-input radiosave ck-no  radioother" other="cannubileaspiration_other"
        datagroup="Bileaspiration"
        subgroup="Bileaspiration"
        id="{{md5("Bile aspiration No")}}" value="No">
        <label class="ms-4" for="{{md5("Bile aspiration No")}}">&nbsp;No</label>
    </div>
    <div class="col-6 align-self-center">
        <div class="row">
            <div class="col-4 align-self-center">
                <input type="radio" 
                @if(str_contains(@$case->cannubileaspiration_other, 'Yes')) checked @endif
                name="Bile aspiration"
                class="form-check-input radiosave ck-Bileaspiration  radioother" other="cannubileaspiration_other"
                datagroup="Bileaspiration"
                id="{{md5("Bile aspiration Yes")}}" value="Yes">
                <label class="ms-4"

                 for="{{md5("Bile aspiration Yes")}}" >&nbsp;Yes</label>
            </div>
            <div class="col-4">
                <select datagroup="Bileaspiration"
                radiootherval="{{md5("Bile aspiration Yes")}}"
                subgroup="Bileaspiration"
                name="bile_aspiration_select" class="form-select savejson_edit ck-Bileaspiration-input ck-radio" id="{{md5("")}}">
                    <option value="">Select</option>
                    <option value="Amber"           @if(str_contains(@$case->cannubileaspiration_other, 'Amber')) selected @endif>Amber</option>
                    <option value="Greenish"        @if(str_contains(@$case->cannubileaspiration_other, 'Greenish')) selected @endif>Greenish</option>
                    <option value="Dark greenish"   @if(str_contains(@$case->cannubileaspiration_other, 'Dark greenish')) selected @endif>Dark greenish</option>
                    <option value="Turbid"          @if(str_contains(@$case->cannubileaspiration_other, 'Turbid')) selected @endif>Turbid</option>
                    <option value="Mixed with pus"  @if(str_contains(@$case->cannubileaspiration_other, 'Mixed with pus')) selected @endif>Mixed with pus</option>
                </select>
            </div>
        </div>
    </div>


    <div class="col-12 mt-2">
        <input class="form-control autotext savejson" id="cannubileaspiration_other"
            placeholder="Other" type="text" autocomplete="off"
            value="{{ @$case->cannubileaspiration_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>

