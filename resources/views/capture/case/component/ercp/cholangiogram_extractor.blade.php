<div class="col-6">
    <div class="row">
        <h5>Extractor</h5>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="extractor" name="extractor_balloon" subgroup="extractor_balloon"
                    type="checkbox"{{ checkinarray($case, 'Extractor', 'Balloon Extractor by') }}
                    id="{{ md5('Extractor Balloon Extractor by') }}" value="Balloon Extractor by"
                    @if(check_in_array(@$case->extractor_ck, 'extractor_balloon')) checked @endif
                    >
                <label class="form-check-label ms-2 ms-2" for="{{ md5('Extractor Balloon Extractor by') }}">
                    Balloon Extractor by
                </label>
            </div>
        </div>
        <div class="col-3 p-0 mb-3">
            <div class="form-check mb-2">
                <select name="balloon_extractor_select" datagroup="extractor" subgroup="extractor_balloon" class="form-select form-select-sm w-100 savejson_edit ck-radio" id="{{ md5('') }}">
                    <option value="0">Select</option>
                    <option value="Basket" @if(@$case->balloon_extractor_select == 'Basket') selected @endif>Basket</option>
                    <option value="BML" @if(@$case->balloon_extractor_select == 'BML') selected @endif>BML</option>
                    <option value="Balloon" @if(@$case->balloon_extractor_select == 'Balloon') selected @endif>Balloon</option>
                </select>

            </div>
        </div>

    <div class="col-auto  align-self-center">size</div>
        <div class="col-3 p-0 ">
            <select name="balloon_extractor_pos_select" datagroup="extractor" subgroup="extractor_balloon" class="form-select form-select-sm w-100 savejson_edit ck-radio" id="{{ md5('') }}">
                <option value="0">Select</option>
                <option value="9-12 mm"  @if(@$case->balloon_extractor_pos_select == '9-12 mm') selected @endif>9-12 mm</option>
                <option value="12-15 mm" @if(@$case->balloon_extractor_pos_select == '12-15 mm') selected @endif>12-15 mm</option>
                <option value="12-15 mm" @if(@$case->balloon_extractor_pos_select == '12-15 mm') selected @endif>15-18 mm</option>
                <option value="18-20 mm" @if(@$case->balloon_extractor_pos_select == '18-20 mm') selected @endif>18-20 mm</option>
            </select>
        </div>

        {{-- ------------------------------------------------------------------------ --}}


        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" type="checkbox" datagroup="extractor" subgroup="spyDS" name="spyDS"
                    {{ checkinarray($case, 'Extractor', 'SpyDS with EHL') }}
                    id="{{ md5('Extractor SpyDS with EHL') }}"
                    @if(check_in_array(@$case->extractor_ck, 'spyDS')) checked @endif
                    >
                <label class="form-check-label ms-2 ms-2" for="{{ md5('Extractor SpyDS with EHL') }}">
                    SpyDS with EHL
                </label>
            </div>
        </div>
        <div class="col-3 p-0">
            <div class="form-check mb-2">
                <input type="number" name="spydswith_other" class="form-control form-control-sm autotext savejson_edit ck-radio" datagroup="extractor"  subgroup="spyDS"
                id="spydswith_other" value="{{@$case->spydswith_other}}" min="0" oninput="validity.valid||(value='');">

            </div>
        </div>
        <div class="col-auto">shots</div>

    </div>
</div>

<div class="col-6 mt-4">
    <textarea id="extractor_other" datagroup="extractor" name="extractor_other" class="form-control autotext savejson" name="extractor_other" rows="2" cols="50" placeholder="Free text">{{@$case->extractor_other}}</textarea>
</div>
