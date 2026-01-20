<div class="col-12">
    <div class="row mb-2">
        <div class="col-auto">
            <div class="form-check mb-2">
                <input class="form-check-input ck-stent-sub ck-biliary-toggle" datagroup="biliarystenting" subgroup="metallicstent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("Metallic Stent")}}"
                @if(isset($case->metallicstent)) @if(count($case->metallicstent) != 0) checked @endif @endif
                @if(isset($case->metallicstentunit_other) && @$case->metallicstentunit_other."" != '') checked @endif
                >
                <label class="form-check-label ms-2" for="{{md5("Metallic Stent")}}">
                    Metallic Stent
                </label>
            </div>

        </div>
        <div class="col-10 ">
            {{-- <select name="metallicstent_select" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm savejson_edit" id="" subgroup="metallicstent" >
                <option value="">Select</option>
                <option value="Unilateral" @if(@$case->metallicstent_select == 'Unilateral') selected @endif>Unilateral</option>
                <option value="Side by side technique(SBS)" @if(@$case->metallicstent_select == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                <option value="Stent in stent technique (SIS)" @if(@$case->metallicstent_select == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                <option value="Triple branched" @if(@$case->metallicstent_select == 'Triple branched') selected @endif>Triple branched</option>
            </select> --}}
        </div>
    </div>
</div>
<div class="row ps-5">
    @php
        $metalstent['FCSEMs'] = [];
        $metalstent['PCSEMs'] = [];
        $metalstent['UCSEMs'] = [];
        if(isset($case->metallicstent)){
            if(is_array($case->metallicstent)){
                foreach (isset($case->metallicstent)?$case->metallicstent:[] as $index => $val) {
                    $key_type = @$val['type'];
                    if(isset($key_type)){
                        $metalstent[$key_type][] = $val;
                    }
                }
            }
        }
    @endphp
    <div class="col-12 ps-4 " id="metalic_toggle" >
        <div class="row">
            <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="0" datagroup="biliarystenting" subgroup="metallicstent" class="form-check-input ck-metallicstent-0 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("FCSEMs0")}}"
                    @if(isset($metalstent['FCSEMs'][0])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("FCSEMs0")}}">
                        FCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="0" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['FCSEMs'][0]['fr'])) value="{{@$metalstent['FCSEMs'][0]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="0" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['FCSEMs'][0]['cm'])) value="{{@$metalstent['FCSEMs'][0]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">mm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-2 mb-1">
                <input type="text" dataindex="0" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                value="@if(isset($metalstent['FCSEMs'][0]['pos'])) {{@$metalstent['FCSEMs'][0]['pos']}} @endif">
            </div>
            <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="0" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['FCSEMs'][0]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['FCSEMs'][0]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['FCSEMs'][0]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['FCSEMs'][0]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="1" datagroup="biliarystenting" subgroup="metallicstent" class="form-check-input ck-metallicstent-1 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("FCSEMs1")}}"
                    @if(isset($metalstent['FCSEMs'][1])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("FCSEMs1")}}">
                        FCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="1" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['FCSEMs'][1]['fr'])) value="{{@$metalstent['FCSEMs'][1]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="1" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['FCSEMs'][1]['cm'])) value="{{@$metalstent['FCSEMs'][1]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">mm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-2 mb-1">
                <input type="text" dataindex="1" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                @if(isset($metalstent['FCSEMs'][1]['pos'])) value="{{@$metalstent['FCSEMs'][1]['pos']}}" @endif>
            </div>
            <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="1" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['FCSEMs'][1]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['FCSEMs'][1]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['FCSEMs'][1]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['FCSEMs'][1]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>

               {{-- ----------------------------------------------------- --}}
               <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="2" datagroup="biliarystenting" subgroup="metallicstent" class="form-check-input ck-metallicstent-2 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("FCSEMs2")}}"
                    @if(isset($metalstent['FCSEMs'][2])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("FCSEMs2")}}">
                        FCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="2" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['FCSEMs'][2]['fr'])) value="{{@$metalstent['FCSEMs'][2]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="2" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['FCSEMs'][2]['cm'])) value="{{@$metalstent['FCSEMs'][2]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">mm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-2 mb-1">
                <input type="text" dataindex="2" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                @if(isset($metalstent['FCSEMs'][2]['pos'])) value="{{@$metalstent['FCSEMs'][2]['pos']}}" @endif>
            </div>
            <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="2" datatype="FCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['FCSEMs'][2]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['FCSEMs'][2]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['FCSEMs'][2]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['FCSEMs'][2]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>


            {{-- ----------------------------------------------------- --}}
            <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="3" subgroup="metallicstent" datagroup="biliarystenting" class="form-check-input ck-metallicstent-3 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("PCSEMs0")}}"
                    @if(isset($metalstent['PCSEMs'][0])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("PCSEMs0")}}">
                        PCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="3" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['PCSEMs'][0]['fr'])) value="{{@$metalstent['PCSEMs'][0]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="3" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['PCSEMs'][0]['cm'])) value="{{@$metalstent['PCSEMs'][0]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">mm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-2 mb-1">
                <input type="text" dataindex="3" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                @if(isset($metalstent['PCSEMs'][0]['pos'])) value="{{@$metalstent['PCSEMs'][0]['pos']}}" @endif>
            </div>
            <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="3" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['PCSEMs'][0]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['PCSEMs'][0]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['PCSEMs'][0]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['PCSEMs'][0]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>

             {{-- ----------------------------------------------------- --}}
             <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="4" subgroup="metallicstent" datagroup="biliarystenting" class="form-check-input ck-metallicstent-4 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("PCSEMs1")}}"
                    @if(isset($metalstent['PCSEMs'][1])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("PCSEMs1")}}">
                        PCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="4" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['PCSEMs'][1]['fr'])) value="{{@$metalstent['PCSEMs'][1]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="4" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['PCSEMs'][1]['cm'])) value="{{@$metalstent['PCSEMs'][1]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">mm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-2 mb-1">
                <input type="text" dataindex="4" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                @if(isset($metalstent['PCSEMs'][1]['pos'])) value="{{@$metalstent['PCSEMs'][1]['pos']}}" @endif>
            </div>
            <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="4" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['PCSEMs'][1]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['PCSEMs'][1]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['PCSEMs'][1]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['PCSEMs'][1]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="5" subgroup="metallicstent" datagroup="biliarystenting" class="form-check-input ck-metallicstent-5 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("PCSEMs2")}}"
                    @if(isset($metalstent['PCSEMs'][2])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("PCSEMs2")}}">
                        PCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="5" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['PCSEMs'][2]['fr'])) value="{{@$metalstent['PCSEMs'][2]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="5" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['PCSEMs'][2]['cm'])) value="{{@$metalstent['PCSEMs'][2]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">mm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-2 mb-1">
                <input type="text" dataindex="5" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                @if(isset($metalstent['PCSEMs'][2]['pos'])) value="{{@$metalstent['PCSEMs'][2]['pos']}}" @endif>
            </div>
            <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="5" datatype="PCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['PCSEMs'][2]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['PCSEMs'][2]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['PCSEMs'][2]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['PCSEMs'][2]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>

             {{-- ----------------------------------------------------- --}}
             <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="6" subgroup="metallicstent" datagroup="biliarystenting" class="form-check-input ck-metallicstent-6 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("UCSEMs0")}}"
                    @if(isset($metalstent['UCSEMs'][0])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("UCSEMs0")}}">
                        UCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
               <input type="number" dataindex="6" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
               @if(isset($metalstent['UCSEMs'][0]['fr'])) value="{{@$metalstent['UCSEMs'][0]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="6" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['UCSEMs'][0]['cm'])) value="{{@$metalstent['UCSEMs'][0]['cm']}}" @endif>
             </div>
             <div class="col-auto p-0">mm</div>
             <div class="col-auto p-0">&ensp;at</div>
             <div class="col-2 mb-1">
                <input type="text" dataindex="6" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                @if(isset($metalstent['UCSEMs'][0]['pos'])) value="{{@$metalstent['UCSEMs'][0]['pos']}}" @endif>
             </div>
             <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="6" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['UCSEMs'][0]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['UCSEMs'][0]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['UCSEMs'][0]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['UCSEMs'][0]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>

               {{-- ----------------------------------------------------- --}}
               <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="7" subgroup="metallicstent" datagroup="biliarystenting" class="form-check-input ck-metallicstent-7 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("UCSEMs1")}}"
                    @if(isset($metalstent['UCSEMs'][1])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("UCSEMs1")}}">
                        UCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
               <input type="number" dataindex="7" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
               @if(isset($metalstent['UCSEMs'][1]['fr'])) value="{{@$metalstent['UCSEMs'][1]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="7" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['UCSEMs'][1]['cm'])) value="{{@$metalstent['UCSEMs'][1]['cm']}}" @endif>
             </div>
             <div class="col-auto p-0">mm</div>
             <div class="col-auto p-0">&ensp;at</div>
             <div class="col-2 mb-1">
                <input type="text" dataindex="7" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                @if(isset($metalstent['UCSEMs'][1]['pos'])) value="{{@$metalstent['UCSEMs'][1]['pos']}}" @endif>
             </div>
             <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="7" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['UCSEMs'][1]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['UCSEMs'][1]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['UCSEMs'][1]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['UCSEMs'][1]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>


              {{-- ----------------------------------------------------- --}}
              <div class="col-2">
                <div class="form-check mb-2">
                    <input dataindex="8" subgroup="metallicstent" datagroup="biliarystenting" class="form-check-input ck-metallicstent-8 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="{{md5("UCSEMs2")}}"
                    @if(isset($metalstent['UCSEMs'][2])) checked @endisset>
                    <label class="form-check-label ms-2" for="{{md5("UCSEMs2")}}">
                        UCSEMs
                    </label>
                </div>
            </div>

            <div class="col-2">
               <input type="number" dataindex="8" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-dm" min="0" oninput="validity.valid||(value='');"
               @if(isset($metalstent['UCSEMs'][2]['fr'])) value="{{@$metalstent['UCSEMs'][2]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="8" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-cm" min="0" oninput="validity.valid||(value='');"
                @if(isset($metalstent['UCSEMs'][2]['cm'])) value="{{@$metalstent['UCSEMs'][2]['cm']}}" @endif>
             </div>
             <div class="col-auto p-0">mm</div>
             <div class="col-auto p-0">&ensp;at</div>
             <div class="col-2 mb-1">
                <input type="text" dataindex="8" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-control form-control-sm stent metallicstent-pos"
                @if(isset($metalstent['UCSEMs'][2]['pos'])) value="{{@$metalstent['UCSEMs'][2]['pos']}}" @endif>
             </div>
             <div class="col-auto p-0">with</div>
            <div class="col-2 mb-1">
                <select dataindex="8" datatype="UCSEMs" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm stent metallicstent-type" id="" subgroup="metallicstent" >
                    <option value="">Select</option>
                    <option value="Unilateral" @if(@$metalstent['UCSEMs'][2]['with'] == 'Unilateral') selected @endif>Unilateral</option>
                    <option value="Side by side technique(SBS)" @if(@$metalstent['UCSEMs'][2]['with'] == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                    <option value="Stent in stent technique (SIS)" @if(@$metalstent['UCSEMs'][2]['with'] == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                    <option value="Triple branched" @if(@$metalstent['UCSEMs'][2]['with'] == 'Triple branched') selected @endif>Triple branched</option>
                </select>
            </div>


                 {{-- ----------------------------------------------------- --}}
                 <div class="col-2">
                    <div class="form-check mb-2">
                        <input dataindex="9" subgroup="metallicstent" datagroup="biliarystenting" name="metallic_ck" class="form-check-input ck-metallicstent-9 ck-stent" type="checkbox" {{ checkinarray($case, '', '') }}  id="box_stent3"
                        @if(isset($case->metallicstentunit_other) && trim(@$case->metallicstentunit_other."") != '') @if(trim($case->metallicstentunit_other) != '') checked @endif @endif>
                        <input type="text" dataindex="9" datagroup="biliarystenting" subgroup="metallicstent" name="metallicstentunit_other" class="form-control form-control-sm savejson_edit metallicstentunit_other stent-other"
                        value="@if(isset($case->metallicstentunit_other)) {{@$case->metallicstentunit_other}} @endif">
                    </div>
                </div>

                <div class="col-2">
                   <input type="number" dataindex="9" datagroup="biliarystenting" subgroup="metallicstent" name="metallicstentdm_other" class="form-control form-control-sm savejson_edit metallicstentunit_other stent-other" min="0" oninput="validity.valid||(value='');"
                   @if(isset($case->metallicstentdm_other)) value="{{@$case->metallicstentdm_other}}" @endif>
                </div>
                <div class="col-auto p-0">Fr</div>
                <div class="col-2">
                    <input type="number" dataindex="9" datagroup="biliarystenting" subgroup="metallicstent" name="metallicstentcm_other" class="form-control form-control-sm savejson_edit metallicstentunit_other stent-other" min="0" oninput="validity.valid||(value='');"
                    @if(isset($case->metallicstentcm_other)) value="{{@$case->metallicstentcm_other}}" @endif>
                 </div>
                 <div class="col-auto p-0">mm</div>
                 <div class="col-auto p-0">&ensp;at</div>
                 <div class="col-2 mb-1">
                    <input type="text" dataindex="9" datagroup="biliarystenting" subgroup="metallicstent" name="metallicstentpos_other" class="form-control form-control-sm savejson_edit metallicstentunit_other stent-other"
                    value="@if(isset($case->metallicstentpos_other)) {{@$case->metallicstentpos_other}} @endif">
                 </div>
                 <div class="col-auto p-0">with</div>
                <div class="col-2 mb-1">
                    <select dataindex="9" name="metallicstent_select" datagroup="biliarystenting" subgroup="metallicstent" class="form-select form-select-sm savejson_edit metallicstentunit_other" id="" subgroup="metallicstent" >
                        <option value="">Select</option>
                        <option value="Unilateral" @if(@$case->metallicstent_select == 'Unilateral') selected @endif>Unilateral</option>
                        <option value="Side by side technique(SBS)" @if(@$case->metallicstent_select == 'Side by side technique(SBS)') selected @endif>Side by side technique(SBS)</option>
                        <option value="Stent in stent technique (SIS)" @if(@$case->metallicstent_select == 'Side by side technique(SIS)') selected @endif>Stent in stent technique (SIS)</option>
                        <option value="Triple branched" @if(@$case->metallicstent_select == 'Triple branched') selected @endif>Triple branched</option>
                    </select>
                </div>


        </div>
    </div>

</div>
