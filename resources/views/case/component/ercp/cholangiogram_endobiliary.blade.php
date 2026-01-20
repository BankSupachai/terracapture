<div class="col-6">
    <div class="row">

        <h5>Endobiliary RA</h5>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit ck-no" type="radio" name="endobiliary"
                    datagroup="endobiliaryRA" {{ checkradio($case, 'EndobiliaryRA', 'No') }}
                    id="{{ md5('Endobiliary RA No') }}" subgroup="endobiliary"
                    value="No" @if(@$case->endobiliary."" == "No") checked @endif>
                <label class="form-check-label ms-2 ms-2" for="{{ md5('Endobiliary RA No') }}">
                    No
                </label>
            </div>
        </div>
        <div class="col-auto ">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit ck-endobiliary" type="radio" name="endobiliary"
                    datagroup="endobiliaryRA" {{ checkradio($case, 'EndobiliaryRA', 'Yes,at') }}
                    id="{{ md5('Endobiliary RA Yes,at') }}" subgroup="endobiliary"
                    value="Yes, at" @if(@$case->endobiliary."" == "Yes, at") checked @endif>
                <label class="form-check-label ms-2 ms-2" for="{{ md5('Endobiliary RA Yes,at') }}">
                    Yes,at
                </label>
            </div>
        </div>

        <div class="col-3 mb-3">
            <input type="text" class="form-control form-control-sm autotext savejson savejson_edit ck-radio ck-endobiliary-input"
            datagroup="endobiliaryRA" name="endobiliary_pos" subgroup="endobiliary"
            id="endobiliary_pos" value="{{@$case->endobiliary_pos}}">

        </div>
        <div class="col-1 p-0">
            <input type="number" class="form-control form-control-sm autotext savejson savejson_edit ck-radio ck-endobiliary-input" datagroup="endobiliaryRA" name="endobiliary_watt" subgroup="endobiliary"
            id="endobiliary_watt" value="{{@$case->endobiliary_watt}}" min="0" oninput="validity.valid||(value='');">
        </div>
        <div class="col-1 align-self-center">Watt,</div>

        <div class="col-1 p-0">
            <input type="number" class="form-control form-control-sm autotext savejson savejson_edit ck-radio ck-endobiliary-input" datagroup="endobiliaryRA" datagroup="endobiliaryRA" name="endobiliary_mins"
            subgroup="endobiliary" id="endobiliary_mins" value="{{@$case->endobiliary_mins}}" min="0" oninput="validity.valid||(value='');">
        </div>
        <div class="col-1 align-self-center">Mins</div>

    </div>
</div>
<div class="col-6 mt-4">
    <textarea id="endobiliaryRA_other" name="endobiliaryRA_other" datagroup="endobiliaryRA" class="form-control autotext savejson" name="w3review" rows="1" cols="50" placeholder="Free text">{{@$case->endobiliaryRA_other}}</textarea>

</div>
