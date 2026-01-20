<div class="col-12 mt-5">
    <div class="row">
        <div class="col-auto">
            <div class="form-check mb-2">
                @php
                    $singlestent = isset($case->straightstent) ? $case->straightstent : [];
                    $singlepigtail = isset($case->singlepigtail) ? $case->singlepigtail : [];
                    $doublepigtail = isset($case->doublepigtail) ? $case->doublepigtail : [];
                    $is_checked = count($singlestent) || count($singlepigtail) || count($doublepigtail);

                    $pancreaticstent = [];
                    if(isset($case->pancreaticstent)) {
                        $pancreaticstent = is_array($case->pancreaticstent) ? $case->pancreaticstent : [];
                    }
                @endphp
                <input class="form-check-input ck-stent-head ck-biliary-toggle" type="checkbox" {{ checkinarray($case, '', '') }}
                    id="box_stent1" datagroup="pancreaticstent" subgroup="pancreaticstent"
                    @if (isset($case->pancreaticstent)) @if (is_array($case->pancreaticstent)) @if (count($case->pancreaticstent) > 0) checked @endif
                    @endif @endisset
                @if (@$case->pancreaticstentunit_other != '' || $is_checked) checked @endif>
                <label class="form-check-label ms-2" for="box_stent1">
                    Pancreatic Stenting
                </label>
            </div>
        </div>

    </div>
</div>
<div class="row ps-5 " id="pancreatic_toggle" >
    <div class="col-12 ps-5">
        <div class="row">
            <div class="col-4">
                <div class="form-check mb-2">
                    <input datagroup="pancreaticstent" subgroup="Prophylactic" class="form-check-input  ck-stent"
                        type="checkbox" {{ checkinarray($case, '', '') }} id="{{ md5('Prophylactic') }}"
                        value="Prophylactic" @if (@$case->prophylactic_select . '' != '' || in_array('Prophylactic', $pancreaticstent)) checked @endif>
                    <label class="form-check-label ms-2" for="{{ md5('Prophylactic') }}">
                        Prophylactic
                    </label>
                </div>
            </div>
            <div class="col-auto">at</div>
            <div class="col-4">
                <select datagroup="pancreaticstent" subgroup="Prophylactic" name="prophylactic_select"
                    class="form-select form-select-sm savejson_edit stent" id="{{ md5('') }}">
                    <option value="">Select</option>
                    <option value="Major papilla" @if (@$case->prophylactic_select == 'Major papilla') selected @endif>Major papilla
                    </option>
                    <option value="Minor papilla" @if (@$case->prophylactic_select == 'Minor papilla') selected @endif>Minor papilla
                    </option>
                </select>
            </div>

            {{-- checkboxgroupsave_edit --}}

            {{-- ----------------------------------------------------- --}}
            <div class="col-4">
                <div class="form-check mb-2">
                    <input datagroup="pancreaticstent" subgroup="Therapeutic" class="form-check-input  ck-stent"
                        type="checkbox" {{ checkinarray($case, '', '') }} id="{{ md5('Therapeutic') }}"
                        value="Therapeutic" @if (@$case->therapeutic_select . '' != '' || in_array('Therapeutic', $pancreaticstent)) checked @endif>
                    <label class="form-check-label ms-2" for="{{ md5('Therapeutic') }}">
                        Therapeutic
                    </label>
                </div>
            </div>
            <div class="col-auto">at</div>
            <div class="col-4">
                <select datagroup="pancreaticstent" subgroup="Therapeutic" name="therapeutic_select"
                    class="form-select form-select-sm savejson_edit stent" id="{{ md5('') }}">
                    <option value="">Select</option>
                    <option value="Major papilla" @if (@$case->therapeutic_select == 'Major papilla') selected @endif>Major papilla
                    </option>
                    <option value="Minor papilla" @if (@$case->therapeutic_select == 'Minor papilla') selected @endif>Minor papilla
                    </option>
                </select>
            </div>


            {{-- ----------------------------------------------------- --}}
            <div class="col-4">
                <div class="form-check mb-2">
                    <input datagroup="pancreaticstent" subgroup="Unflanged type" class="form-check-input  ck-stent"
                        type="checkbox" {{ checkinarray($case, '', '') }} id="{{ md5('Unflanged type') }}"
                        value="Unflanged type" @if (@$case->unflanged_select . '' != ''  || in_array('Unflanged type', $pancreaticstent)) checked @endif>
                    <label class="form-check-label ms-2" for="{{ md5('Unflanged type') }}">
                        Unflanged type
                    </label>
                </div>
            </div>
            <div class="col-auto">at</div>
            <div class="col-4">
                <select datagroup="pancreaticstent" subgroup="Unflanged type" name="unflanged_select"
                    class="form-select form-select-sm savejson_edit stent" id="{{ md5('') }}">
                    <option value="">Select</option>
                    <option value="Major papilla" @if (@$case->unflanged_select == 'Major papilla') selected @endif>Major papilla
                    </option>
                    <option value="Minor papilla" @if (@$case->unflanged_select == 'Minor papilla') selected @endif>Minor papilla
                    </option>
                </select>
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="col-4">
                <div class="form-check mb-2">
                    <input datagroup="pancreaticstent" subgroup="Flanged type" class="form-check-input  ck-stent"
                        type="checkbox" {{ checkinarray($case, '', '') }} id="{{ md5('Flanged type') }}"
                        value="Flanged type" @if (@$case->flanged_select . '' != '' || in_array('Flanged type', $pancreaticstent)) checked @endif>
                    <label class="form-check-label ms-2" for="{{ md5('Flanged type') }}">
                        Flanged type
                    </label>
                </div>
            </div>
            <div class="col-auto">at</div>
            <div class="col-4">
                <select datagroup="pancreaticstent" subgroup="Flanged type" name="flanged_select"
                    class="form-select form-select-sm savejson_edit stent " id="{{ md5('') }}">
                    <option value="">Select</option>
                    <option value="Major papilla" @if (@$case->flanged_select == 'Major papilla') selected @endif>Major papilla
                    </option>
                    <option value="Minor papilla" @if (@$case->flanged_select == 'Minor papilla') selected @endif>Minor papilla
                    </option>
                </select>
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="col-auto"></div>
            <div class="row">
                <div class="col-3">
                    <div class="form-check mb-2">
                        {{-- @dd(check_in_array(@$case->pancreaticstent, 'Single pigtail') , (isset($case->singlepigtail[0]) || isset($case->singlepigtail[1]) || isset($case->singlepigtail[2]))) --}}
                        <input dataindex="0" datagroup="pancreaticstent" subgroup="singlepigtail"
                            class="form-check-input ck-singlepigtail-0 ck-stent" type="checkbox"
                            {{ checkinarray($case, '', '') }} id="{{ md5('Single pigtail') }}"
                            value="Single pigtail" @if (check_in_array(@$case->pancreaticstent, 'Single pigtail') ||
                                    (isset($case->singlepigtail[0]) || isset($case->singlepigtail[1]) || isset($case->singlepigtail[2]))) checked @endif>
                        <label class="form-check-label ms-2" for="{{ md5('Single pigtail') }}">
                            Single pigtail
                        </label>
                    </div>
                </div>

                <div class="col-2">
                    <input type="number" datagroup="pancreaticstent" dataindex="0" subgroup="singlepigtail"
                        class="form-control form-control-sm stent singlepigtail-dm" min="0" oninput="validity.valid||(value='');"
                        @if (isset($case->singlepigtail[0]['fr'])) value="{{ @$case->singlepigtail[0]['fr'] }}" @endif>
                </div>
                <div class="col-auto p-0">Fr</div>
                <div class="col-2">
                    <input type="number" datagroup="pancreaticstent" dataindex="0" subgroup="singlepigtail"
                        class="form-control form-control-sm stent singlepigtail-cm" min="0" oninput="validity.valid||(value='');"
                        @if (isset($case->singlepigtail[0]['cm'])) value="{{ @$case->singlepigtail[0]['cm'] }}" @endif>
                </div>
                <div class="col-auto p-0">cm</div>
                <div class="col-auto p-0">&ensp;at</div>
                {{-- <div class="col-3 mb-1">
                    <input type="text" datagroup="pancreaticstent" dataindex="0" subgroup="singlepigtail" class="form-control form-control-sm stent singlepigtail-pos"
                    @if (isset($case->singlepigtail[0]['pos'])) value="{{@$case->singlepigtail[0]['pos']}}" @endif>
                 </div> --}}
                <div class="col-3 mb-1">
                    <select datagroup="pancreaticstent" dataindex="0" subgroup="singlepigtail"
                        class="form-select form-select-sm stent singlepigtail-pos" id="{{ md5('') }}">
                        <option value="">Select</option>
                        <option value="Major papilla" @if (@$case->singlepigtail[0]['pos'] == 'Major papilla') selected @endif>Major papilla
                        </option>
                        <option value="Minor papilla" @if (@$case->singlepigtail[0]['pos'] == 'Minor papilla') selected @endif>Minor papilla
                        </option>
                    </select>
                </div>
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="row">
                <div class="col-3">
                    <div class="form-check mb-2">
                        <input dataindex="0" datagroup="pancreaticstent" subgroup="straightstent"
                            class="form-check-input ck-straightstent-0 ck-stent" type="checkbox"
                            {{ checkinarray($case, '', '') }} id="{{ md5('Straight stent') }}"
                            value="Straight stent" @if (check_in_array(@$case->pancreaticstent, 'Straight stent') ||
                                    (isset($case->straightstent[0]) || isset($case->straightstent[1]) || isset($case->straightstent[2]))) checked @endif>
                        <label class="form-check-label ms-2" for="{{ md5('Straight stent') }}">
                            Straight stent
                        </label>
                    </div>
                </div>

                <div class="col-2">
                    <input type="number" datagroup="pancreaticstent" dataindex="0" subgroup="straightstent"
                        class="form-control form-control-sm stent straightstent-dm" min="0" oninput="validity.valid||(value='');"
                        @if (isset($case->straightstent[0]['fr'])) value="{{ @$case->straightstent[0]['fr'] }}" @endif>
                </div>
                <div class="col-auto p-0">Fr</div>
                <div class="col-2">
                    <input type="number" datagroup="pancreaticstent" dataindex="0" subgroup="straightstent"
                        class="form-control form-control-sm stent straightstent-cm" min="0" oninput="validity.valid||(value='');"
                        @if (isset($case->straightstent[0]['cm'])) value="{{ @$case->straightstent[0]['cm'] }}" @endif>
                </div>
                <div class="col-auto p-0">cm</div>
                <div class="col-auto p-0">&ensp;at</div>
                {{-- <div class="col-3 mb-1">
                    <input type="text" datagroup="pancreaticstent" dataindex="0" subgroup="straightstent" class="form-control form-control-sm stent straightstent-pos"
                    @if (isset($case->straightstent[0]['pos'])) value="{{@$case->straightstent[0]['pos']}}" @endif>
                 </div> --}}
                <div class="col-3 mb-1">
                    <select dataindex="0" datagroup="pancreaticstent" subgroup="straightstent"
                        class="form-select form-select-sm savejson_edit stent straightstent-pos"
                        id="{{ md5('') }}">
                        <option value="">Select</option>
                        <option value="Major papilla" @if (@$case->straightstent[0]['pos'] == 'Major papilla') selected @endif>Major papilla
                        </option>
                        <option value="Minor papilla" @if (@$case->straightstent[0]['pos'] == 'Minor papilla') selected @endif>Minor papilla
                        </option>
                    </select>
                </div>
            </div>


            {{-- ----------------------------------------------------- --}}
            <div class="row">
                <div class="col-3">
                    <div class="form-check mb-2">
                        <input datagroup="pancreaticstent" subgroup="doublepigtail" dataindex="0"
                            class="form-check-input ck-doublepigtail-0 ck-stent" type="checkbox"
                            {{ checkinarray($case, '', '') }} id="{{ md5('Double pigtail') }}"
                            value="Double pigtail" @if (check_in_array(@$case->pancreaticstent, 'Double pigtail') ||
                                    (isset($case->doublepigtail[0]) || isset($case->doublepigtail[1]) || isset($case->doublepigtail[2]))) checked @endif>
                        <label class="form-check-label ms-2" for="{{ md5('Double pigtail') }}">
                            Double pigtail
                        </label>
                    </div>
                </div>

                <div class="col-2">
                    <input type="number" datagroup="pancreaticstent" dataindex="0" subgroup="doublepigtail"
                        class="form-control stent form-control-sm doublepigtail-dm" min="0" oninput="validity.valid||(value='');"
                        @if (isset($case->doublepigtail[0]['fr'])) value="{{ @$case->doublepigtail[0]['fr'] }}" @endif>
                </div>
                <div class="col-auto p-0">Fr</div>
                <div class="col-2">
                    <input type="number" datagroup="pancreaticstent" dataindex="0" subgroup="doublepigtail"
                        class="form-control form-control-sm stent doublepigtail-cm" min="0" oninput="validity.valid||(value='');"
                        @if (isset($case->doublepigtail[0]['cm'])) value="{{ @$case->doublepigtail[0]['cm'] }}" @endif>
                </div>
                <div class="col-auto p-0">cm</div>
                <div class="col-auto p-0">&ensp;at</div>
                {{-- <div class="col-3 mb-1">
                        <input type="text" datagroup="pancreaticstent" dataindex="0" subgroup="doublepigtail" class="form-control form-control-sm stent doublepigtail-pos"
                        @if (isset($case->doublepigtail[0]['pos'])) value="{{@$case->doublepigtail[0]['pos']}}" @endif>
                     </div> --}}
                <div class="col-3 mb-1">
                    <select datagroup="pancreaticstent" dataindex="0" subgroup="doublepigtail"
                        class="form-select form-select-sm savejson_edit stent doublepigtail-pos"
                        id="{{ md5('') }}">
                        <option value="">Select</option>
                        <option value="Major papilla" @if (@$case->doublepigtail[0]['pos'] == 'Major papilla') selected @endif>Major papilla
                        </option>
                        <option value="Minor papilla" @if (@$case->doublepigtail[0]['pos'] == 'Minor papilla') selected @endif>Minor papilla
                        </option>
                    </select>
                </div>
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="row">
                <div class="col-3">
                    <div class="form-check mb-2">
                        <input dataindex="0" datagroup="pancreaticstent" subgroup="pancreaticstent"
                            class="form-check-input ck-pancreaticstent-0 ck-stent" type="checkbox"
                            {{ checkinarray($case, '', '') }} id="box_stent3"
                            @if (isset($case->pancreaticstentunit_other) && @$case->pancreaticstentunit_other != '') checked @endif>
                        <input type="text" dataindex="0" subgroup="pancreaticstent"
                            name="pancreaticstentunit_other"
                            class="form-control form-control-sm savejson_edit stent pancreaticstentunit_other stent-other"
                            value="@if (isset($case->pancreaticstentunit_other)) {{ @$case->pancreaticstentunit_other }} @endif">
                    </div>
                </div>

                <div class="col-2">
                    <input type="number" datagroup="pancreaticstent" dataindex="0" subgroup="pancreaticstent"
                        name="pancreaticstentdm_other" min="0" oninput="validity.valid||(value='');"
                        class="form-control form-control-sm savejson_edit stent pancreaticstent-dm"
                        @if (isset($case->pancreaticstentdm_other)) value="{{ @$case->pancreaticstentdm_other }}" @endif>
                </div>
                <div class="col-auto p-0">Fr</div>
                <div class="col-2">
                    <input type="number" datagroup="pancreaticstent" dataindex="0" subgroup="pancreaticstent"
                        name="pancreaticstentcm_other" min="0" oninput="validity.valid||(value='');"
                        class="form-control form-control-sm savejson_edit stent pancreaticstent-cm"
                        @if (isset($case->pancreaticstentcm_other)) value="{{ @$case->pancreaticstentcm_other }}" @endif>
                </div>
                <div class="col-auto p-0">cm</div>
                <div class="col-auto p-0">&ensp;at</div>
                {{-- <div class="col-3 mb-1">
        <input type="text" datagroup="pancreaticstent" dataindex="0" subgroup="pancreaticstent" name="pancreaticstentpos_other" class="form-control form-control-sm savejson_edit stent pancreaticstent-pos"
        value="@if (isset($case->pancreaticstentpos_other)) {{@$case->pancreaticstentpos_other}} @endif">
     </div> --}}
                <div class="col-3 mb-1">
                    <select datagroup="pancreaticstent" dataindex="0" subgroup="pancreaticstent"
                        name="pancreaticstentpos_other"
                        class="form-select form-select-sm savejson_edit stent pancreaticstent-pos"
                        id="{{ md5('') }}">
                        <option value="">Select</option>
                        <option value="Major papilla" @if (@$case->pancreaticstentpos_other == 'Major papilla') selected @endif>Major papilla
                        </option>
                        <option value="Minor papilla" @if (@$case->pancreaticstentpos_other == 'Minor papilla') selected @endif>Minor papilla
                        </option>
                    </select>
                </div>
            </div>


        </div>
    </div>

</div>
