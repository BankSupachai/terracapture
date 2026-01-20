<div class="col-12 ">
    @php
        $plasticstent = isset($case->plasticstent) ? $case->plasticstent : [];
        $metalicstent = isset($case->metallicstent) ? $case->metallicstent : [];
    @endphp
    <div class="form-check mb-2">
        <input class="form-check-input ck-stent-head" datagroup="biliarystenting" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', 'Biliary Stenting') }} value="Biliary Stenting" id="{{md5("Biliary Stenting Biliary Stenting")}}"
        @if(count($plasticstent) != 0 || count($metalicstent) != 0) checked  @endif
        @if((isset($case->plasticstentunit_other) && trim(@$case->plasticstentunit_other."") != '') ||
        (isset($case->metallicstentunit_other) && trim(@$case->metallicstentunit_other."") != '')) checked @endif

        >
        {{-- @dd(count($plasticstent) != 0 || count($metalicstent) != 0) --}}
        <label class="form-check-label ms-2" for="{{md5("Biliary Stenting Biliary Stenting")}}">
            Biliary Stenting
        </label>
    </div>
</div>
<div class="row ps-5">
    <div class="col-12">
        @php
        $plasticstent['DPPS'] = [];
        $plasticstent['DBPS'] = [];
        if(isset($case->plasticstent)){
            if(is_array($case->plasticstent)){
                foreach (isset($case->plasticstent)?$case->plasticstent:[] as $index => $val) {
                    $key_type = @$val['type'];
                    if(isset($key_type)){
                        $plasticstent[$key_type][] = $val;
                    }
                }
            }
        }
    @endphp
        <div class="form-check mb-2">
            <input class="form-check-input ck-stent-sub " datagroup="biliarystenting" subgroup="plasticstent" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', 'Plastic Stent') }}
             id="{{md5("Biliary Stenting Plastic Stent")}}"
            @if(isset($case->plasticstent) ) @if(count($case->plasticstent) != 0 || @$case->plasticstentunit_other != '' ) checked @endif @endisset>
            <label class="form-check-label ms-2" for="{{md5("Biliary Stenting Plastic Stent")}}">
                Plastic Stent
            </label>
        </div>
    </div>

    <div class="col-12 ps-5" id="plastic_toggle">
        <div class="row">
            <div class="col-3">
                <div class="form-check mb-2">
                    <input dataindex="0" subgroup="plasticstent" datagroup="biliarystenting" class="form-check-input ck-plasticstent-0 ck-stent" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', 'DPPS01') }}  id="{{md5("Biliary Stenting DPPS01")}}"
                    @if(isset($plasticstent['DPPS'][0])) checked @endif>
                    <label class="form-check-label ms-2" for="{{md5("Biliary Stenting DPPS01")}}">
                        DPPS
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="0" datatype="DPPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-dm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DPPS'][0]['fr'])) value="{{@$plasticstent['DPPS'][0]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="0" datatype="DPPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-cm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DPPS'][0]['cm'])) value="{{@$plasticstent['DPPS'][0]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">cm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-3 mb-1">
                <input type="text" dataindex="0" datatype="DPPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-pos"
                value="@if(isset($plasticstent['DPPS'][0]['pos'])) {{@$plasticstent['DPPS'][0]['pos']}} @endif">
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="col-3">
                <div class="form-check mb-2">
                    <input dataindex="1" datagroup="biliarystenting" subgroup="plasticstent" class="form-check-input ck-plasticstent-1 ck-stent" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', '') }}  id="{{md5("Biliary Stenting DPPS02")}}"
                    @if(isset($plasticstent['DPPS'][1])) checked @endif>
                    <label class="form-check-label ms-2" for="{{md5("Biliary Stenting DPPS02")}}">
                        DPPS
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="1" datatype="DPPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-dm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DPPS'][1]['fr'])) value="{{@$plasticstent['DPPS'][1]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="1" datatype="DPPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-cm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DPPS'][1]['cm'])) value="{{@$plasticstent['DPPS'][1]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">cm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-3 mb-1">
                <input type="text" dataindex="1" datatype="DPPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-pos"
                value="@if(isset($plasticstent['DPPS'][1]['pos'])) {{@$plasticstent['DPPS'][1]['pos']}} @endif">
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="col-3">
                <div class="form-check mb-2">
                    <input dataindex="2" datagroup="biliarystenting" subgroup="plasticstent" class="form-check-input ck-plasticstent-2 ck-stent" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', '') }}  id="{{md5("Biliary Stenting DPPS03")}}"
                    @if(isset($plasticstent['DPPS'][2])) checked @endif>
                    <label class="form-check-label ms-2" for="{{md5("Biliary Stenting DPPS03")}}">
                        DPPS
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="2" datatype="DPPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-dm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DPPS'][2]['fr'])) value="{{@$plasticstent['DPPS'][2]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="2" datatype="DPPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-cm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DPPS'][2]['cm'])) value="{{@$plasticstent['DPPS'][2]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">cm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-3 mb-1">
                <input type="text" dataindex="2" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-pos"
                value="@if(isset($plasticstent['DPPS'][2]['pos'])) {{@$plasticstent['DPPS'][2]['pos']}} @endif">
            </div>

            {{-- ----------------------------------------------------- --}}
            <div class="col-3">
                <div class="form-check mb-2">
                    <input dataindex="3" datagroup="biliarystenting" subgroup="plasticstent" class="form-check-input ck-plasticstent-3 ck-stent" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', '') }}  id="{{md5("Biliary Stenting DPPS04")}}"
                    @if(isset($plasticstent['DBPS'][0])) checked @endif>
                    <label class="form-check-label ms-2" for="{{md5("Biliary Stenting DPPS04")}}">
                        DBPS
                    </label>
                </div>
            </div>

            <div class="col-2">
                <input type="number" dataindex="3" datatype="DBPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent  plasticstent-dm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DBPS'][0]['fr'])) value="{{@$plasticstent['DBPS'][0]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="3" datatype="DBPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent  plasticstent-cm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DBPS'][0]['cm'])) value="{{@$plasticstent['DBPS'][0]['cm']}}" @endif>
            </div>
            <div class="col-auto p-0">cm</div>
            <div class="col-auto p-0">&ensp;at</div>
            <div class="col-3 mb-1">
                <input type="text" dataindex="3" datatype="DBPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent  plasticstent-pos"
                value="@if(isset($plasticstent['DBPS'][0]['pos'])) {{@$plasticstent['DBPS'][0]['pos']}} @endif">
            </div>

             {{-- ----------------------------------------------------- --}}
             <div class="col-3">
                <div class="form-check mb-2">
                    <input dataindex="4" datagroup="biliarystenting" subgroup="plasticstent" class="form-check-input ck-plasticstent-4 ck-stent" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', '') }}  id="{{md5("Biliary Stenting DPPS05")}}"
                    @if(isset($plasticstent['DBPS'][1])) checked @endif>
                    <label class="form-check-label ms-2" for="{{md5("Biliary Stenting DPPS05")}}">
                        DBPS
                    </label>
                </div>
            </div>

            <div class="col-2">
               <input type="number" dataindex="4" datatype="DBPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-dm"
               min="0" oninput="validity.valid||(value='');"
               @if(isset($plasticstent['DBPS'][1]['fr'])) value="{{@$plasticstent['DBPS'][1]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="4" datatype="DBPS" datagroup="biliarystenting"  subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-cm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DBPS'][1]['cm'])) value="{{@$plasticstent['DBPS'][1]['cm']}}" @endif>
             </div>
             <div class="col-auto p-0">cm</div>
             <div class="col-auto p-0">&ensp;at</div>
             <div class="col-3 mb-1">
                <input type="text" dataindex="4" datatype="DBPS" datagroup="biliarystenting"  subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-pos"
                @if(isset($plasticstent['DBPS'][1]['pos'])) value="{{@$plasticstent['DBPS'][1]['pos']}}" @endif>
             </div>

              {{-- ----------------------------------------------------- --}}
              <div class="col-3">
                <div class="form-check mb-2">
                    <input dataindex="5" datagroup="biliarystenting" subgroup="plasticstent" class="form-check-input ck-plasticstent-5 ck-stent" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', '') }}  id="{{md5("Biliary Stenting DPPS06")}}"
                    @if(isset($plasticstent['DBPS'][2])) checked @endif>
                    <label class="form-check-label ms-2" for="{{md5("Biliary Stenting DPPS06")}}">
                        DBPS
                    </label>
                </div>
            </div>

            <div class="col-2">
               <input type="number" dataindex="5" datatype="DBPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-dm"
               min="0" oninput="validity.valid||(value='');"
               @if(isset($plasticstent['DBPS'][2]['fr'])) value="{{@$plasticstent['DBPS'][2]['fr']}}" @endif>
            </div>
            <div class="col-auto p-0">Fr</div>
            <div class="col-2">
                <input type="number" dataindex="5" datatype="DBPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-cm"
                min="0" oninput="validity.valid||(value='');"
                @if(isset($plasticstent['DBPS'][2]['cm'])) value="{{@$plasticstent['DBPS'][2]['cm']}}" @endif>
             </div>
             <div class="col-auto p-0">cm</div>
             <div class="col-auto p-0">&ensp;at</div>
             <div class="col-3 mb-1">
                <input type="text" dataindex="5" datatype="DBPS" datagroup="biliarystenting" subgroup="plasticstent" class="form-control form-control-sm stent plasticstent-pos"
                value="@if(isset($plasticstent['DBPS'][2]['pos'])) {{@$plasticstent['DBPS'][2]['pos']}} @endif">
             </div>


                 {{-- ----------------------------------------------------- --}}
                 <div class="col-3">
                    <div class="form-check mb-2">
                        <input dataindex="6" datagroup="biliarystenting" subgroup="plasticstent" class="form-check-input ck-plasticstent-6 ck-stent" type="checkbox" {{ checkinarray($case, 'BiliaryStenting', '') }}  id="box_stent3"
                        @if(isset($case->plasticstentunit_other) && trim(@$case->plasticstentunit_other."") != '') checked @endif>
                        <input type="text" datagroup="biliarystenting"  subgroup="plasticstent" dataindex="6"  name="plasticstentunit_other" class="form-control form-control-sm savejson_edit plasticstentunit_other stent-other"
                        value="@if(isset($case->plasticstentunit_other)){{@$case->plasticstentunit_other}}@endif">
                    </div>
                </div>

                <div class="col-2 ">
                   <input  type="number" datagroup="biliarystenting" subgroup="plasticstent" dataindex="6" name="plasticstentdm_other" class="form-control form-control-sm savejson_edit plasticstentunit_other stent-other"
                   min="0" oninput="validity.valid||(value='');"
                   @if(isset($case->plasticstentdm_other)) value="{{@$case->plasticstentdm_other}}" @endif>
                </div>
                <div class="col-auto p-0">Fr</div>
                <div class="col-2">
                    <input type="number" datagroup="biliarystenting" subgroup="plasticstent" dataindex="6" name="plasticstentcm_other" class="form-control form-control-sm savejson_edit plasticstentunit_other  stent-other"
                    min="0" oninput="validity.valid||(value='');"
                    @if(isset($case->plasticstentcm_other)) value="{{@$case->plasticstentcm_other}}" @endif>
                 </div>
                 <div class="col-auto p-0">cm</div>
                 <div class="col-auto p-0">&ensp;at</div>
                 <div class="col-3 mb-1">
                    <input type="text" datagroup="biliarystenting" subgroup="plasticstent" dataindex="6" name="plasticstentpos_other" class="form-control form-control-sm savejson_edit plasticstentunit_other stent-other"
                    value="@if(isset($case->plasticstentpos_other)) {{@$case->plasticstentpos_other}} @endif">
                 </div>
        </div>
    </div>

</div>


