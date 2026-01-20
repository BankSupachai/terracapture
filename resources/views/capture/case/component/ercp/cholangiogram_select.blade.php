<div class="col-6">
    <div class="row">
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram" subgroup="cholangiogram" type="checkbox" name="cholangiogram_ck"
                    {{ checkinarray($case, 'CholangiogramCBD', 'Select') }} value="cholangiogram" dataindex="0"
                    id="{{ md5('CholangiogramCBD Select') }}"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram')) checked @endif
                    >
                <label class="form-check-label ms-2 " for="{{ md5('CholangiogramCBD Select') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit" {{ checkradio($case, 'Cholangiogram', 'Distal CBD') }} dataindex="0"
                    datagroup="cholangiogram" type="radio" name="cholangiogram_radio" subgroup="cholangiogram" position="{}"
                    id="{{ md5('Cholangiogram Distal CBD') }}" value="Distal CBD"
                    @if(check_in_array(@$case->cholangiogram['cholangiogram'], 'Distal CBD')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogram Distal CBD') }}">
                    Distal CBD
                </label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit" datagroup="cholangiogram" type="radio" dataindex="0"
                    {{ checkradio($case, 'Cholangiogram', 'Mid CBD') }} name="cholangiogram_radio" subgroup="cholangiogram" position="{}"
                    id="{{ md5('Cholangiogram Mid CBD') }}" value="Mid CBD"
                    @if(check_in_array(@$case->cholangiogram['cholangiogram'], 'Mid CBD')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogram Mid CBD') }}">
                    Mid CBD
                </label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit" datagroup="cholangiogram" type="radio" dataindex="0"
                    {{ checkradio($case, 'Cholangiogram', 'Proximal CBD') }} name="cholangiogram_radio" subgroup="cholangiogram" position="{}"
                    id="{{ md5('Cholangiogram Proximal CBD') }}" value="Proximal CBD"
                    @if(check_in_array(@$case->cholangiogram['cholangiogram'], 'Proximal CBD')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogram Proximal CBD') }}">
                    Proximal CBD
                </label>
            </div>
        </div>
        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3"></div>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit" datagroup="cholangiogram" type="radio" dataindex="0"
                    {{ checkradio($case, 'Cholangiogram', 'Distal CHD') }} name="cholangiogram_radio" subgroup="cholangiogram" position="{}"
                    id="{{ md5('Cholangiogram Distal CHD') }}" value="Distal CHD"
                    @if(check_in_array(@$case->cholangiogram['cholangiogram'], 'Distal CHD')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogram Distal CHD') }}">
                    Distal CHD
                </label>
            </div>

        </div>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit" datagroup="cholangiogram" type="radio" dataindex="0"
                    {{ checkradio($case, 'Cholangiogram', 'Mid CHD') }} name="cholangiogram_radio" subgroup="cholangiogram" position="{}"
                    id="{{ md5('Cholangiogram Mid CHD') }}" value="Mid CHD"
                    @if(check_in_array(@$case->cholangiogram['cholangiogram'], 'Mid CHD')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogram Mid CHD') }}">
                    Mid CHD
                </label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit" datagroup="cholangiogram" type="radio" dataindex="0"
                    {{ checkradio($case, 'Cholangiogram', 'Proximal CHD') }} name="cholangiogram_radio" subgroup="cholangiogram" position="{}"
                    id="{{ md5('Cholangiogram Proximal CHD') }}" value="Proximal CHD"
                    @if(check_in_array(@$case->cholangiogram['cholangiogram'], 'Proximal CHD')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogram Proximal CHD') }}">
                    Proximal CHD
                </label>
            </div>
        </div>
        <div class="col-3"></div>
        <div class="col-8">
            <hr>
        </div>

        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3"></div>
        <div class="col-3 mb-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit" datagroup="cholangiogram" type="radio" dataindex="0" name="cholangiogram"
                    {{ checkradio($case, 'cholangiogram', 'upstream to Hilar region') }} name="cholangiogram_radio" subgroup="cholangiogram" position="{}"
                    id="{{ md5('Cholangiogram upstream to Hilar region') }}" value="upstream to Hilar region"
                    @if(check_in_array(@$case->cholangiogram['cholangiogram'], 'upstream to Hilar region')) checked @endif
                    >
                <label class="form-check-label ms-2  text-nowrap"
                    for="{{ md5('Cholangiogram upstream to Hilar region') }}">
                    upstream to Hilar region
                </label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input radiosave_edit" datagroup="cholangiogram" type="radio" dataindex="0"  name="cholangiogram" position="{}"
                    {{ checkradio($case, 'cholangiogram', 'distalother') }} name="cholangiogram_radio" subgroup="cholangiogram"
                    id="{{ md5('Cholangiogram Bilateral IHD') }}" value="Bilateral IHD"
                    @if(check_in_array(@$case->cholangiogram['cholangiogram'], 'Bilateral IHD')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogram Bilateral IHD') }}">
                    Bilateral IHD
                </label>
            </div>
        </div>

        <div class="col-3 mt-2"></div>

        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram" subgroup="cholangiogram_smooth" type="checkbox" dataindex="1" value="smooth tapering in short segment at"
                    {{ checkinarray($case, 'Cholangiogramsmooth', 'Select') }} name="cholangiogram_ck"
                    value="smooth tapering in short segment at" id="{{ md5('Cholangiogramsmooth Select') }}"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_smooth')) checked @endif
                    >
                <label class="form-check-label ms-2 " for="{{ md5('Cholangiogramsmooth Select') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-5">
            smooth tapering in short segment at
        </div>
        <div class="col-4"></div>
        {{-- ------------------------------------------------------------------ --}}
        <div class="col-3"></div>
        <div class="col-3">
            <div class="form-check mb-2">
                @php
                    $test = check_in_str('smooth tapering in short segment at', 'distal CBD', @$case->cholangiogram['cholangiogram_smooth']);
                    // dd($case->cholangiogram['cholangiogram_smooth'], $test);
                @endphp
                <input class="form-check-input radiosave_edit" datagroup="cholangiogram" subgroup="cholangiogram_smooth" type="radio" dataindex="1"
                    {{ checkradio($case, 'cholangiogramsmooth', 'distal CBD01') }} name="cholangiogram_smooth_radio" position="smooth tapering in short segment at {}"
                    id="{{ md5('Cholangiogramsmooth distal CBD') }}" value="distal CBD"
                    @if(check_in_str('smooth tapering in short segment at', 'distal CBD', @$case->cholangiogram['cholangiogram_smooth'])) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogramsmooth distal CBD') }}">
                    distal CBD
                </label>
            </div>
        </div>
        <div class="col-3 mb-3">
            <div class="form-check mb-2 align-self-center">
                <input class="form-check-input radiosave_edit ck-cholangiogram_smooth"
                    name="cholangiogram_smooth_radio" dataindex="1"
                    subgroup="cholangiogram_smooth" type="radio" datagroup="cholangiogram"
                    position="smooth tapering in short segment at {}"
                    {{ checkradio($case, 'cholangiogramsmooth', 'other_text') }}
                    id="{{ md5('Cholangiogramsmooth distal CBD') }}"
                    @if(check_in_str('smooth tapering in short segment at', 'distal CBD', @$case->cholangiogram['cholangiogram_smooth']) == false && @$case->othersmooth_other != "") checked @endif
                >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogramsmooth distal CBD') }}">
                    <input type="text" id="othersmooth_other" dataindex="1" datagroup="cholangiogram"  subgroup="cholangiogram_smooth" name="cholangiogram_smooth_text"
                     {{-- name="othersmooth_other" --}}
                        class="form-control form-control-sm autotext savejson savejson_edit ck-radio" position="smooth tapering in short segment at {}"
                        value="{{ check_is_str(@$case->othersmooth_other) }}">
                </label>
            </div>
        </div>
        <div class="col-3"></div>
        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram"  subgroup="cholangiogram_contrast" type="checkbox"
                    {{ checkinarray($case, 'CholangiogramContrast', 'Select') }} dataindex="2" name="cholangiogram_ck" value="Contrast abruptly disappear at"
                    value="Contrast abruptly disappear at" id="{{ md5('CholangiogramContrast Select') }}"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_contrast')) checked @endif
                    >
                <label class="form-check-label ms-2 " for="{{ md5('CholangiogramContrast Select') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-8 mb-3">
            <div class="row">
                <div class="col-auto">
                    Contrast abruptly disappear at &ensp;
                </div>
                <div class="col-6">
                    <input datagroup="cholangiogram"  subgroup="cholangiogram_contrast"  name="cholangiogram_contrast_text" type="text"
                    dataindex="2" id="contrast_other" class="form-control form-control-sm autotext savejson savejson_edit ck-radio" position="Contrast abruptly disappear at {}"
                    value="{{  checknotarray(@$case->contrast_other) }}">

                </div>
            </div>

        </div>

        <div class="col-1"></div>
        {{-- ------------------------------------------------------------------ --}}
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit " datagroup="cholangiogram"  subgroup="cholangiogram_filling" type="checkbox"
                    {{ checkinarray($case, 'Cholangiogramfilling', 'Select') }} dataindex="3" name="cholangiogram_ck"
                    id="{{ md5('Cholangiogramfilling Select') }}" value="Filling defect"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_filling') ) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogramfilling Select') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-9">
            <input class="form-check-input radiosave_edit" datagroup="cholangiogram"  subgroup="cholangiogram_filling" name="cholangiogram_filling_radio" name="cholangiogram_filling"
                type="radio" {{ checkradio($case, 'cholangiogramfilling', 'No filling defect') }} dataindex="3" position="{}"
                value="No filling defect" id="{{ md5('Cholangiogramfilling No filling defect') }}"
                @if(check_in_array(@$case->cholangiogram['cholangiogram_filling'], 'No filling defect')) checked @endif
                >
            <label class="form-check-label ms-2 " for="{{ md5('Cholangiogramfilling No filling defect') }}">
                No filling defect
            </label>
        </div>


        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3"></div>
        <div class="col-9">
            <div class="row">
                <div class="col-4 ">
                    <input class="form-check-input radiosave_edit ck-cholangiogram_filling" datagroup="cholangiogram"  subgroup="cholangiogram_filling"
                        value="Filling defect/defects in" name="cholangiogram_filling_radio" type="radio" dataindex="3" position="Filling defect/defects in Shape at"
                        {{ checkradio($case, 'Cholangiogramfilling', 'Filling defect/defects in') }}
                        id="{{ md5('Cholangiogramfilling Filling defect/defects in') }}"
                        @if(isset($case->cholangiogram['cholangiogram_filling'][0]) && check_in_array(@$case->cholangiogram['cholangiogram_filling'], 'No filling defect') == false
                        && @$case->cholangiogram['cholangiogram_filling'][0] != 'Filling defect/defects in '
                        && @$case->cholangiogram['cholangiogram_filling'][1] != 'Shape at ') checked @endif
                        >
                    <label class="form-check-label ms-2 "
                        for="{{ md5('Cholangiogramfilling Filling defect/defects in') }}">
                        Filling defect/defects in

                    </label>
                </div>
                <div class="col-3 mb-4">
                    <input type="text" class="form-control form-control-sm autotext savejson savejson_edit ck-radio ck-cholangiogram_filling-input" id="filling_other"
                    dataindex="3" datagroup="cholangiogram"  subgroup="cholangiogram_filling" name="cholangiogram_filling_text"  position="Filling defect/defects in {}"
                    value="{{check_is_str(@$case->filling_other)}}">

                </div>
                <div class="col-auto " datagroup="cholangiogram"  subgroup="cholangiogram_filling" name="cholangiogram_shapeat_div"
                value="Shape at" name="box_filling" type="radio" dataindex="3">
                    Shape at
                </div>
                <div class="col-3">
                    <input type="text" class="form-control form-control-sm autotext savejson savejson_edit ck-radio ck-cholangiogram_filling-input"
                    dataindex="3" datagroup="cholangiogram"  subgroup="cholangiogram_filling" name="cholangiogram_shapeat_text"
                    id="shapeat_other" value="{{check_is_str(@$case->shapeat_other)}}" position="Shape at {}">
                </div>
            </div>

        </div>



        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram" subgroup="cholangiogram_contrastat" type="checkbox" dataindex="4"
                    value="Contrast" {{ checkinarray($case, 'CholangiogramContrast02', 'Select') }} name="cholangiogram_ck" value="Contrast at"
                    id="{{ md5('CholangiogramContrast02 Select') }}"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_contrastat')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('CholangiogramContrast02 Select') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-auto">
                    Contrast
                </div>
                <div class="col-3 mb-3">
                    {{-- @php
                        $test = check_in_array($case->cholangiogram['cholangiogram_contrastat'][0], 'Contrast leakage', true);
                        dd($case->cholangiogram['cholangiogram_contrastat'][0]);
                    @endphp --}}
                    <select name="cholangiogram_contrastat_select" class="form-select form-select-sm savejson savejson_edit ck-radio"
                    datagroup="cholangiogram" subgroup="cholangiogram_contrastat" type="select" dataindex="4" position="Contrast {}"
                        id="cholangiogram_contrastat_sel">
                        <option value="" >Select</option>
                        <option value="leakage" @if(@$case->cholangiogram_contrastat_sel == 'leakage') selected @endif>leakage</option>
                        <option value="brushing" @if(@$case->cholangiogram_contrastat_sel == 'brushing') selected @endif>brushing</option>
                        <option value="pooling" @if(@$case->cholangiogram_contrastat_sel == 'pooling') selected @endif>pooling</option>

                    </select>
                </div>
                <div class="col-auto "  datagroup="cholangiogram" subgroup="cholangiogram_contrastat" type="checkbox" dataindex="4" position="prefix" value="at">
                    at
                </div>
                <div class="col-3">
                    <input type="text" class="form-control form-control-sm autotext savejson savejson_edit ck-radio"
                    datagroup="cholangiogram" subgroup="cholangiogram_contrastat"  dataindex="4" name="cholangiogram_contrastat_text" position="at {}"
                    id="contrast02_other" value="{{check_is_str(@$case->contrast02_other)}}">

                </div>
            </div>
        </div>
        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram" subgroup="cholangiogram_cystic" type="checkbox" dataindex="5"
                    {{ checkinarray($case, 'CholangiogramCystic', 'Select') }} name="cholangiogram_ck" value="Cystic duct low lying" value="{}"
                    id="{{ md5('CholangiogramCystic Select') }}"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_cystic')) checked @endif
                    >
                <label class="form-check-label ms-2 ms-2" for="{{ md5('CholangiogramCystic Select') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-5">
            Cystic duct low lying

        </div>
        <div class="col-4"></div>


        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3 mt-2">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram" subgroup="cholangiogram_cystic_duct" type="checkbox" dataindex="6"
                    {{ checkinarray($case, 'Cholangiogramcystic duct', 'Select') }} value="cystic duct" name="cholangiogram_ck"
                    id="{{ md5('Cholangiogramcystic duct Select') }}" value="cystic duct"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_cystic_duct')) checked @endif
                    >
                <label class="form-check-label ms-2 ms-2" for="{{ md5('Cholangiogramcystic duct Select') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-3">
            <select datagroup="cholangiogram" subgroup="cholangiogram_cystic_duct" name="cholangiogram_cystic_select" class="form-select form-select-sm savejson savejson_edit ck-radio"  id="cystic_other" dataindex="6" type="select"  datagroup="cholangiogram_cystic_duct" position="{} cystic duct">
                <option value="">Select</option>
                <option value="Long" @if(@$case->cystic_other == 'Long') selected @endif>Long</option>
                <option value="Short" @if(@$case->cystic_other == 'Short') selected @endif>Short</option>

            </select>
        </div>
        <div class="col-3">
            cystic duct
        </div>
        <div class="col-3"></div>


        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram" value="Gallbladder distension evidence of filling defect"
                subgroup="cholangiogram_gallbladder" type="checkbox" dataindex="7" name="cholangiogram_ck"
                    {{ checkinarray($case, 'CholangiogramGallbladder', 'Gallbladder distension') }}
                    id="{{ md5('CholangiogramGallbladder Gallbladder distension') }}"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_gallbladder')) checked @endif
                    >
                <label class="form-check-label ms-2"
                    for="{{ md5('CholangiogramGallbladder Gallbladder distension') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-auto">
                    Gallbladder distension
                </div>
                <div class="col-3 mb-3">
                    <select id="gallbladder_other" name="cholangiogram_gallbladder_select" class="form-select form-select-sm savejson savejson_edit ck-radio" id="{{ md5('') }}" position="Gallbladder distension {} evidence of filling defect"
                    datagroup="cholangiogram"  subgroup="cholangiogram_gallbladder"  type="select" dataindex="7" >
                        <option value="">Select</option>
                        <option value="with" @if(@$case->gallbladder_other == 'with') selected @endif>with</option>
                        <option value="without" @if(@$case->gallbladder_other == 'without') selected @endif>without</option>

                    </select>
                </div>
                <div class="col-auto" name="cholangiogram_gallbladder_div" datagroup="cholangiogram"  subgroup="cholangiogram_gallbladder" type="div" dataindex="7">
                    evidence of filling defect
                </div>
            </div>
        </div>


        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram" subgroup="cholangiogram_stricture" type="checkbox"  dataindex="8"  name="cholangiogram_ck"
                    {{ checkinarray($case, 'CholangiogramStricture', 'Stricture at bile duct segment') }} value="Stricture at bile duct segment"
                    id="{{ md5('Cholangiogram StrictureStricture at bile duct segment') }}"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_stricture')) checked @endif
                    >
                <label class="form-check-label ms-2"
                    for="{{ md5('Cholangiogram StrictureStricture at bile duct segment') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-auto">
                    Stricture at bile duct segment
                </div>
                <div class="col-4 mb-3">
                    <input type="text" class="form-control form-control-sm autotext savejson savejson_edit ck-radio" datagroup="cholangiogram" subgroup="cholangiogram_stricture"
                    name="cholangiogram_stricture_text" dataindex="8" position="Stricture at bile duct segment {}"
                    value="{{check_is_str(@$case->stricture_other)}}" id="stricture_other">
                </div>

            </div>
        </div>


        {{-- ------------------------------------------------------------------ --}}

        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="cholangiogram" subgroup="cholangiogram_hilar" type="checkbox" name="cholangiogram_ck"
                    {{ checkinarray($case, 'CholangiogramHilar', 'Hilar stricture at') }} dataindex="9"  value="Hilar stricture"
                    id="{{ md5('Cholangiogram Hilar stricture at') }}"
                    @if(check_in_array(@$case->cholangiogram_ck, 'cholangiogram_hilar')) checked @endif
                    >
                <label class="form-check-label ms-2" for="{{ md5('Cholangiogram Hilar stricture at') }}">
                    Select
                </label>
            </div>
        </div>
        <div class="col-9">
            <div class="row">
                <div class="col-auto">
                    Hilar stricture at
                </div>
                <div class="col-4 mb-3">
                    <input type="text" class="form-control form-control-sm autotext savejson savejson_edit ck-radio" datagroup="cholangiogram"
                    subgroup="cholangiogram_hilar" dataindex="9" name="cholangiogram_hilar_text" position="Hilar stricture at {}"
                    id="hilar_other" value="{{check_is_str(@$case->hilar_other)}}">
                </div>

            </div>
        </div>
    </div>
</div>
<div class="col-6 mt-4">
    @php
        // $text = get_total_str(@$case->cholangiogram_other);
        $text = @$case->cholangiogram_other;
        if(!isset($text) || @$text."" == ""){
            $text = "Free text";
        }
    @endphp
    <textarea id="cholangiogram_other" subgroup="" datagroup="cholangiogram" name="cholangiogram_other" class="form-control save_json savejson_edit" rows="25" cols="50" >{{@$text}}</textarea>
</div>

<script>

</script>
