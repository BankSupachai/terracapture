<div class="col-4">
    Selective guidewire manipulation into&nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-6">
        <input type="radio" {{ checkradio($case, 'canlulaguideinfo_other', 'Rt.IHD') }}
            name="box_cannula_guidewireinfo"
            class="form-check-input radiosave ck-no radioother" other="canlulaguideinfo_other"
            subgroup="cannula_guidewireinfo"
            datagroup="Selectiveguidewiremanipulationint"id="{{ md5('Selective guide wire manipulation into Rt.IHD') }}"
            value="Rt.IHD">
        <label class="ms-4" for="{{ md5('Selective guide wire manipulation into Rt.IHD') }}">&nbsp;Rt.IHD</label>
    </div>
    <div class="col-6">
        <input type="radio" {{ checkradio($case, 'canlulaguideinfo_other', 'Lt.IHD') }}
            name="box_cannula_guidewireinfo" class="form-check-input radiosave ck-no radioother" other="canlulaguideinfo_other"
            subgroup="cannula_guidewireinfo"
            datagroup="Selectiveguidewiremanipulationint"id="{{ md5('Selective guide wire manipulation into Lt.IHD') }}"
            value="Lt.IHD">
        <label class="ms-4" for="{{ md5('Selective guide wire manipulation into Lt.IHD') }}">&nbsp;Lt.IHD</label>
    </div>

    <div class="col-6">
        <div class="row">
            <div class="col-3">
                <input type="radio"
                {{-- {{ checkradio($case, 'canlulaguideinfo_other', 'B') }} --}}
                @if(str_contains(@$case->canlulaguideinfo_other, 'Segment')) checked @endif
                    name="box_cannula_guidewireinfo" class="form-check-input radiosave ck-cannula_guidewireinfo radioother"
                    other="canlulaguideinfo_other"
                    subgroup="cannula_guidewireinfo"
                    datagroup="Selectiveguidewiremanipulationint"
                    id="{{ md5('Selective guide wire manipulation into B') }}" value="B">
                <label class="ms-4" for="{{ md5('Selective guide wire manipulation into B') }}">&nbsp;B</label>
            </div>
            <div class="col-3">
                @php
                    $haveguidewire = '';
                    if(isset($case->canlulaguideinfo_other)){
                        try{
                            $haveguidewire = trim(str_replace('B', '', $case->canlulaguideinfo_other));
                            $haveguidewire = trim(str_replace('Segment', '', $haveguidewire ));
                        } catch(\Exception $e) {}
                    }
                @endphp
                <input name="guidewireinfo_other"
                type="text"
                subgroup="cannula_guidewireinfo"
                class="form-control savejson_edit ck-radio ck-cannula_guidewireinfo-input"
                value="{{@$haveguidewire}}"
                radiootherval="{{ md5('Selective guide wire manipulation into B') }}">
            </div>
            <div class="col-3"  radioothervalend="{{ md5('Selective guide wire manipulation into B') }}">Segment</div>
        </div>
    </div>
    <div class="col-6">
        <input type="radio"
            {{ checkradio($case, 'canlulaguideinfo_other', 'Cystic duct through gallbladder') }}
            name="box_cannula_guidewireinfo" class="form-check-input radiosave ck-no radioother" other="canlulaguideinfo_other"
            subgroup="cannula_guidewireinfo"
            datagroup="Selectiveguidewiremanipulationint"id="{{ md5('Selective guide wire manipulation into Cystic duct through gallbladder') }}"
            value="Cystic duct through gallbladder">
        <label class="ms-4"
            for="{{ md5('Selective guide wire manipulation into Cystic duct through gallbladder') }}">&nbsp;Cystic duct
            through gallbladder</label>
    </div>


    <div class="col-12 mt-2">
        <input class="form-control autotext savejson" id="canlulaguideinfo_other" placeholder="Other" type="text"
            autocomplete="off" value="{{ @$case->canlulaguideinfo_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>
