<div class="col-4">
    Type of Guidewire&nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
@php
    $guidewires = isset($case->cannuguidewire) ? $case->cannuguidewire : [];
@endphp
<div class="row mt-2 guidewire-div">
    <div class="col-9">
        <select datagroup="cannuguidewire" name="guidewire_type" class="form-select guidewire guidewire-type"  id="{{md5("")}}">
            <option value="">Select Guidewire</option>
            <option value="Visiglide angled tip"    @if(@$guidewires[0]['type']."" == "Visiglide angled tip") selected @endif>Visiglide angled tip</option>
            <option value="Visiglide straight tip"  @if(@$guidewires[0]['type']."" == "Visiglide straight tip") selected @endif>Visiglide straight tip</option>
            <option value="Revowave"            @if(@$guidewires[0]['type']."" == "Revowave") selected @endif>Revowave</option>
            <option value="Revolution"          @if(@$guidewires[0]['type']."" == "Revolution") selected @endif>Revolution</option>
            <option value="Radifocus"           @if(@$guidewires[0]['type']."" == "Radifocus") selected @endif>Radifocus</option>
            <option value="Terumo"              @if(@$guidewires[0]['type']."" == "Terumo") selected @endif>Terumo</option>
            <option value="Acrobat"             @if(@$guidewires[0]['type']."" == "Acrobat") selected @endif>Acrobat</option>
            <option value="Endoselector"        @if(@$guidewires[0]['type']."" == "Endoselector") selected @endif>Endoselector</option>
            <option value="jagwire"            @if(@$guidewires[0]['type']."" == "jagwire") selected @endif>jagwire</option>
        </select>
    </div>
    <div class="col-3">
        <select datagroup="cannuguidewire" name="guidewire_size" class="form-select guidewire guidewire-size"  id="{{md5("")}}">
            <option value="">Diameter</option>
            <option value="0.035 GW" @if(@$guidewires[0]['size']."" == "0.035 GW") selected @endif>0.035 GW</option>
            <option value="0.032 GW" @if(@$guidewires[0]['size']."" == "0.032 GW") selected @endif>0.032 GW</option>
            <option value="0.025 GW" @if(@$guidewires[0]['size']."" == "0.025 GW") selected @endif>0.025 GW</option>
            <option value="0.018 GW" @if(@$guidewires[0]['size']."" == "0.018 GW") selected @endif>0.018 GW</option>
         </select>
    </div>

    <div class="col-9 mt-2">
        <select datagroup="cannuguidewire" name="guidewire_type" class="form-select guidewire guidewire-type"  id="{{md5("")}}">
            <option value="">Select Guidewire</option>
            <option value="Visiglide angled tip"    @if(@$guidewires[1]['type']."" == "Visiglide angled tip") selected @endif>Visiglide angled tip</option>
            <option value="Visiglide straight tip"  @if(@$guidewires[1]['type']."" == "Visiglide straight tip") selected @endif>Visiglide straight tip</option>
            <option value="Revowave"            @if(@$guidewires[1]['type']."" == "Revowave") selected @endif>Revowave</option>
            <option value="Revolution"          @if(@$guidewires[1]['type']."" == "Revolution") selected @endif>Revolution</option>
            <option value="Radifocus"           @if(@$guidewires[1]['type']."" == "Radifocus") selected @endif>Radifocus</option>
            <option value="Terumo"              @if(@$guidewires[1]['type']."" == "Terumo") selected @endif>Terumo</option>
            <option value="Acrobat"             @if(@$guidewires[1]['type']."" == "Acrobat") selected @endif>Acrobat</option>
            <option value="Endoselector"        @if(@$guidewires[1]['type']."" == "Endoselector") selected @endif>Endoselector</option>
            <option value="Jagwire"            @if(@$guidewires[1]['type']."" == "Jagwire") selected @endif>jagwire</option>
        </select>
    </div>
    <div class="col-3 mt-2">
        <select datagroup="cannuguidewire" name="guidewire_size" class="form-select guidewire guidewire-size"  id="{{md5("")}}">
            <option value="">Diameter</option>
            <option value="0.035 GW" @if(@$guidewires[1]['size']."" == "0.035 GW") selected @endif>0.035 GW</option>
            <option value="0.032 GW" @if(@$guidewires[1]['size']."" == "0.032 GW") selected @endif>0.032 GW</option>
            <option value="0.025 GW" @if(@$guidewires[1]['size']."" == "0.025 GW") selected @endif>0.025 GW</option>
            <option value="0.018 GW" @if(@$guidewires[1]['size']."" == "0.018 GW") selected @endif>0.018 GW</option>
         </select>
    </div>
    @php
        $add_cannu = [];
        try{
            $add_cannu = array_slice($case->cannuguidewire, 2);
        } catch(\Exception $e) {}
    @endphp
    @foreach (isset($add_cannu)?$add_cannu:[] as $key => $val)
        @php
            $guide_type = @$val['type']."";
            $guide_size = @$val['size']."";
        @endphp
        <div class="col-9 mt-2">
            <select datagroup="cannuguidewire" name="guidewire_type" class="form-select guidewire guidewire-type"  id="{{md5("")}}">
                <option value="">Select Guidewire</option>
                <option value="Visiglide angled tip"    @if(@$guide_type."" == "Visiglide angled tip") selected @endif>Visiglide angled tip</option>
                <option value="Visiglide straight tip"  @if(@$guide_type."" == "Visiglide straight tip") selected @endif>Visiglide straight tip</option>
                <option value="Revowave"                @if(@$guide_type."" == "Revowave") selected @endif>Revowave</option>
                <option value="Revolution"              @if(@$guide_type."" == "Revolution") selected @endif>Revolution</option>
                <option value="Radifocus"               @if(@$guide_type."" == "Radifocus") selected @endif>Radifocus</option>
                <option value="Terumo"                  @if(@$guide_type."" == "Terumo") selected @endif>Terumo</option>
                <option value="Acrobat"                 @if(@$guide_type."" == "Acrobat") selected @endif>Acrobat</option>
                <option value="Endoselector"            @if(@$guide_type."" == "Endoselector") selected @endif>Endoselector</option>
                <option value="jagwire"                @if(@$guide_type."" == "jagwire") selected @endif>jagwire</option>
            </select>
        </div>
        <div class="col-3 mt-2">
            <select datagroup="cannuguidewire" name="guidewire_size" class="form-select guidewire guidewire-size"  id="{{md5("")}}">
                <option value="">Diameter</option>
                <option value="0.035 GW" @if(@$guide_size."" == "0.035 GW") selected @endif>0.035 GW</option>
                <option value="0.032 GW" @if(@$guide_size."" == "0.032 GW") selected @endif>0.032 GW</option>
                <option value="0.025 GW" @if(@$guide_size."" == "0.025 GW") selected @endif>0.025 GW</option>
                <option value="0.018 GW" @if(@$guide_size."" == "0.018 GW") selected @endif>0.018 GW</option>
            </select>
        </div>
    @endforeach
    <div class="col-2 mb-2 mt-2 guidewire-add-btn">
        <button type="button" class="btn btn-soft-secondary add-guidewire">+ Add</button>
    </div>
    <div class="col-10 "></div>
    <div class="col-9 mb-2">
        <input type="text" datagroup="cannulation"  id="guidewire_typeother" placeholder="other" class="form-control savejson" value="{{@$case->guidewire_typeother}}">
    </div>
    <div class="col-3">
        <select datagroup="cannulation"  id="guidewire_sizeother" class="form-select savejson" id="{{md5("")}}">
            <option value="">Diameter</option>
            <option value="0.035 GW" @if(@$case->guidewire_sizeother."" == "0.035 GW") selected @endif>0.035 GW</option>
            <option value="0.032 GW" @if(@$case->guidewire_sizeother."" == "0.032 GW") selected @endif>0.032 GW</option>
            <option value="0.025 GW" @if(@$case->guidewire_sizeother."" == "0.025 GW") selected @endif>0.025 GW</option>
            <option value="0.018 GW" @if(@$case->guidewire_sizeother."" == "0.018 GW") selected @endif>0.018 GW</option>
        </select>
    </div>

</div>

<script>
    $('.add-guidewire').on('click', function () {
        let lg = $('.cannulation-guidewire').length / 2
        let index = lg - 1
        $(`<div class="col-9 mt-2">
                <select datagroup="cannuguidewire" name="guidewire_type"  class="form-select guidewire guidewire-type" id="{{md5("")}}">
                    <option value="">Select Guidewire</option>
                    <option value="Visiglide angled tip">Visiglide angled tip</option>
                    <option value="Visiglide straight tip">Visiglide straight tip</option>
                    <option value="Revowave">Revowave</option>
                    <option value="Revolution">Revolution</option>
                    <option value="Radifocus">Radifocus</option>
                    <option value="Terumo">Terumo</option>
                    <option value="Acrobat">Acrobat</option>
                    <option value="Endoselector">Endoselector</option>
                    <option value="Jag wire">Jag wire</option>
                </select>
           </div>
           <div class="col-3 mt-2">
                <select datagroup="cannuguidewire" name="guidewire_size"  class="form-select guidewire guidewire-size" id="{{md5("")}}">
                    <option value="">Diameter</option>
                    <option value="0.035 GW">0.035 GW</option>
                    <option value="0.032 GW">0.032 GW</option>
                    <option value="0.025 GW">0.025 GW</option>
                    <option value="0.018 GW">0.018 GW</option>
                </select>
           </div>
        `).insertBefore(`.guidewire-add-btn`)

        $('.guidewire').on('change', save_guidewire)
    })

    $('.guidewire').on('change', function () {
        save_guidewire()
    })
</script>

