<div class="col-6">
    <h5>Dilator</h5>
    <div class="row">
        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" type="checkbox" datagroup="dilator" name="dilator_balloon"
                    {{ checkinarray($case, 'Dilator', 'Balloon Dilator by') }} subgroup="dilator_balloon"
                    id="{{ md5('Dilator Balloon Dilator by') }}" value="Balloon Dilator by"
                    @if(check_in_array(@$case->dilator_ck, 'dilator_balloon')) checked @endif
                    >
                <label class="form-check-label ms-2 ms-2" for="{{ md5('Dilator Balloon Dilator by') }}">
                    Balloon Dilator by
                </label>
            </div>
        </div>
        <div class="col-2 p-0">
            <div class="form-check mb-2">
                <select type="select" class="form-select form-select-sm w-100 savejson_edit ck-radio" id="{{ md5('') }}"
                datagroup="dilator" name="dilator_balloon_select" subgroup="dilator_balloon">
                    <option value="0">Select</option>
                    <option value="Balloon Dilator" @if(@$case->dilator_balloon_select == 'Balloon Dilator') selected @endif>Balloon Dilator</option>
                    <option value="CRE balloon" @if(@$case->dilator_balloon_select == 'CRE balloon') selected @endif>CRE balloon</option>
                    <option value="Hurricane balloon" @if(@$case->dilator_balloon_select == 'Hurricane balloon') selected @endif>Hurricane balloon</option>
                    <option value="Titan balloon" @if(@$case->dilator_balloon_select == 'Titan balloon') selected @endif>Titan balloon</option>


                </select>
            </div>
        </div>
        <div class="col-auto">at</div>
        <div class="col-2 p-0">
            <input type="text" class="form-control form-control-sm w-100 autotext savejson_edit ck-radio"
            datagroup="dilator" name="dilator_balloon_pos_text" subgroup="dilator_balloon"
            id="balloon_dilator_pos" value="{{@$case->dilator_balloon_pos_text}}">
        </div>

        <div class="col-auto">size</div>
        <div class="col-2 p-0">
            {{-- <select type="select" name="dilator_balloon_pos_select" subgroup="dilator_balloon" datagroup="dilator" class="form-select form-select-sm w-100 savejson_edit ck-radio" id="{{ md5('') }}">
                <option value="0"></option>
                <option value="10-12 mm" @if(@$case->dilator_balloon_pos_select == '10-12 mm') selected @endif>10-12 mm</option>
                <option value="12-15 mm" @if(@$case->dilator_balloon_pos_select == '12-15 mm') selected @endif>12-15 mm</option>
                <option value="15-18 mm" @if(@$case->dilator_balloon_pos_select == '15-18 mm') selected @endif>15-18 mm</option>
                <option value="18-20 mm" @if(@$case->dilator_balloon_pos_select == '18-20 mm') selected @endif>18-20 mm</option>
            </select> --}}
            <input type="text" name="dilator_balloon_pos_select" subgroup="dilator_balloon" datagroup="dilator" class="form-control form-control-sm w-100 savejson_edit" id="{{ md5('') }}" value="{{@$case->dilator_balloon_pos_select}}">
        </div>





        <div class="col-3">
            <div class="form-check mb-2">
                <input class="form-check-input checkboxgroupsave_edit" datagroup="dilator" type="checkbox"  name="dilator_ihd" subgroup="dilator_ihd"
                    {{ checkinarray($case, 'Dilator', 'IHD Dilator by') }}
                    id="{{ md5('Dilator IHD Dilator by IHD Dilator by') }}" value="IHD Dilator by"
                    @if(check_in_array(@$case->dilator_ck, 'dilator_ihd')) checked @endif
                    >
                <label class="form-check-label ms-2 ms-2" for="{{ md5('Dilator IHD Dilator by IHD Dilator by') }}">
                    IHD Dilator by
                </label>
            </div>
        </div>
        <div class="col-2 p-0 mb-3">
            <div class="form-check mb-2">
                <select datagroup="dilator" name="dilator_ihd_select" type="select" subgroup="dilator_ihd"
                class="form-select form-select-sm w-100 savejson_edit ck-radio" id="{{ md5('') }}">
                    <option value="0">Select</option>
                    <option value="Soehendra dilator"   @if(@$case->dilator_ihd_select == 'Soehendra dilator') selected @endif>Soehendra dilator</option>
                    <option value="ES dilator"          @if(@$case->dilator_ihd_select == 'ES dilator') selected @endif>ES dilator</option>
                    <option value="REN balloon dilator" @if(@$case->dilator_ihd_select == 'REN balloon dilator') selected @endif>REN balloon dilator</option>
                    <option value="Hurricane balloon dilator"   @if(@$case->dilator_ihd_select == 'Hurricane balloon dilator') selected @endif>Hurricane balloon dilator</option>
                    <option value="CRE dilator"                 @if(@$case->dilator_ihd_select == 'CRE dilator') selected @endif>CRE dilator</option>
                    <option value="Titan balloon dilator"       @if(@$case->dilator_ihd_select == 'Titan balloon dilator') selected @endif>Titan balloon dilator</option>


                </select>

            </div>
        </div>
        <div class="col-auto ">at</div>
        <div class="col-2 p-0">
            <input type="text" datagroup="dilator" name="dilator_ihd_pos"  subgroup="dilator_ihd"
            class="form-control form-control-sm w-100 autotext savejson_edit ck-radio "
            id="dilator_ihd_pos" value="{{@$case->dilator_ihd_pos}}">
        </div>

        <div class="col-auto">size</div>
        <div class="col-2 p-0">
            {{-- <select datagroup="dilator" name="dilator_ihd_pos_select" type="select"
            class="form-select form-select-sm w-100 savejson_edit ck-radio" id="{{ md5('') }}"
            subgroup="dilator_ihd">
                <option value="0"></option>
                <option value="10-12 mm" @if(@$case->dilator_ihd_pos_select == '10-12 mm') selected @endif>10-12 mm</option>
                <option value="12-15 mm" @if(@$case->dilator_ihd_pos_select == '12-15 mm') selected @endif>12-15 mm</option>
                <option value="15-18 mm" @if(@$case->dilator_ihd_pos_select == '15-18 mm') selected @endif>15-18 mm</option>
                <option value="18-20 mm" @if(@$case->dilator_ihd_pos_select == '18-20 mm') selected @endif>18-20 mm</option>

            </select> --}}
            <input type="text" datagroup="dilator" name="dilator_ihd_pos_select" subgroup="dilator_ihd" class="form-control form-control-sm w-100 savejson_edit " id="{{ md5('') }}" value="{{@$case->dilator_ihd_pos_select}}">
        </div>
        <div class="col-2"></div>
    </div>

</div>


<div class="col-6 mt-4">
    <textarea  class="form-control autotext savejson" id="dilator_other" datagroup="dilator" name="dilator_other" rows="2" cols="50" placeholder="Free text" value="{{@$case->dilator_other}}">{{@$case->dilator_other}}</textarea>
</div>
