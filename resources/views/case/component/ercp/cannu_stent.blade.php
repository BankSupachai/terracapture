<div class="col-4">
    Previous stent removal&nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-12 ">
        <input type="radio" {{ checkradio($case, 'cannubile_other', 'No') }} name="Previous stent removal"
            class="form-check-input radiosave ck-no radioother" other="cannubile_other" subgroup="Previousstentremoval"
            datagroup="Previousstentremoval"id="{{ md5('Previous stent removal No') }}" value="No">
        <label class="ms-4" for="{{ md5('Previous stent removal No') }}">&nbsp;No</label>
    </div>
    <div class="col-12 ">
        <div class="row">
            <div class="col-2 align-self-center">
                <input type="radio" @if(str_contains(@$case->cannubile_other, 'Yes, by')) checked @endif
                    name="Previous stent removal" class="form-check-input radiosave ck-Previousstentremoval radioother" other="cannubile_other"
                    datagroup="Previousstentremoval" id="{{ md5('Previous stent removal Yes') }}" value="Yes, by">
                <label class="ms-4" for="{{ md5('Previous stent removal Yes') }}">&nbsp;Yes, by</label>
            </div>
            <div class="col-3">
                <select datagroup="Previousstentremoval"
                radiootherval="{{ md5('Previous stent removal Yes') }}"
                subgroup="Previousstentremoval"
                name="stent_removal_type_select"
                class="form-select savejson_edit ck-Previousstentremoval-input ck-radio"
                 >
                    <option value="">Select</option>
                    <option value="snare forcep" @if(str_contains(@$case->cannubile_other, 'snare forcep')) selected @endif>snare forcep</option>
                    <option value="rat tooth forcep" @if(str_contains(@$case->cannubile_other, 'rat tooth forcep')) selected @endif>rat tooth forcep</option>
                    <option value="withdraw with scope" @if(str_contains(@$case->cannubile_other, 'withdraw with scope')) selected @endif>withdraw with scope</option>


                </select>
            </div>
            <div class="col-auto align-self-center "  radioothervalend="{{ md5('Previous stent removal Yes') }}">under</div>
            <div class="col-3 ">
                <select datagroup="Previousstentremoval"
                radiootherval2="{{ md5('Previous stent removal Yes') }}"
                subgroup="Previousstentremoval"
                name="stent_removal_view_select"
                 class="form-select savejson_edit ck-Previousstentremoval-input ck-radio"
                >
                    <option value="">Select</option>
                    <option value="endoscopic view" @if(str_contains(@$case->cannubile_other, 'endoscopic view')) selected @endif>endoscopic view</option>
                    <option value="fluoroscopic view" @if(str_contains(@$case->cannubile_other, 'fluoroscopic view')) selected @endif>fluoroscopic view</option>

                </select>
            </div>
        </div>
    </div>


    <div class="col-12 mt-2">
        <input class="form-control autotext savejson" id="cannubile_other" placeholder="Other" type="text"
            autocomplete="off" value="{{ @$case->cannubile_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>
