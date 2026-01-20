<div class="col-4">
    CBD Cannulation&nbsp;&nbsp; &nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-12">
        <input type="radio" subgroup="cbdcannu" {{ checkradio($case, 'cannucbd_other', 'Failed CBD Cannulation') }} name="CBD Cannulation"
            class="form-check-input radiosave ck-no radioother" other="cannucbd_other" datagroup="CBDCannulation"
            id="{{ md5('CBD Cannulation Failed CBD Cannulation') }}" value="Failed CBD Cannulation">
        <label class="ms-4" for="{{ md5('CBD Cannulation Failed CBD Cannulation') }}">&nbsp;Failed CBD
            Cannulation</label>
    </div>
    <div class="col-12">
        <input type="radio" subgroup="cbdcannu" {{ checkradio($case, 'cannucbd_other', 'Conventional/Standard technique') }}
            name="CBD Cannulation" class="form-check-input radiosave ck-no radioother" other="cannucbd_other" datagroup="CBDCannulation"
            id="{{ md5('CBD Cannulation Conventional/Standard technique') }}" value="Conventional/Standard technique">
        <label class="ms-4"
            for="{{ md5('CBD Cannulation Conventional/Standard technique') }}">&nbsp;Conventional/Standard
            technique</label>
    </div>
    <div class="col-12">
        <input type="radio" subgroup="cbdcannu" {{ checkradio($case, 'cannucbd_other', 'Double guidewire cannulation (DGW)') }}
            name="CBD Cannulation" class="form-check-input radiosave ck-no radioother" other="cannucbd_other" datagroup="CBDCannulation"
            id="{{ md5('CBD Cannulation Double guidewire cannulation (DGW)') }}"
            value="Double guidewire cannulation (DGW)">
        <label class="ms-4" for="{{ md5('CBD Cannulation Double guidewire cannulation (DGW)') }}">&nbsp;Double
            guidewires cannulation (DGW)</label>
    </div>
    <div class="col-12">
        <input type="radio" subgroup="cbdcannu" {{ checkradio($case, 'cannucbd_other', 'Needle knife precut sphincterotomy (NKP)') }}
            name="CBD Cannulation" class="form-check-input radiosave ck-no radioother" other="cannucbd_other" datagroup="CBDCannulation"
            id="{{ md5('CBD Cannulation Needle knife precut sphincterotomy (NKP)') }}"
            value="Needle knife precut sphincterotomy (NKP)">
        <label class="ms-4" for="{{ md5('CBD Cannulation Needle knife precut sphincterotomy (NKP)') }}">&nbsp;Needle
            knife precut sphincterotomy (NKP)</label>
    </div>
    <div class="col-12">
        <input type="radio" subgroup="cbdcannu" {{ checkradio($case, 'cannucbd_other', 'Needle knife precut fistulotomy (NKF)') }}
            name="CBD Cannulation" class="form-check-input radiosave ck-no radioother" other="cannucbd_other" datagroup="CBDCannulation"
            id="{{ md5("CBD Cannulation', 'Needle knife precut fistulotomy (NKF)") }}"
            value="Needle knife precut fistulotomy (NKF)">
        <label class="ms-4" for="{{ md5("CBD Cannulation', 'Needle knife precut fistulotomy (NKF)") }}">&nbsp;Needle
            knife precut fistulotomy (NKF)</label>
    </div>
    <div class="col-12">
        <div class="row mb-2">
            <div class="col-auto  align-self-center">
                <input type="radio"
                @if(str_contains(@$case->cannucbd_other, 'EUS-rescue by RV(Rendezvous technique) via')) checked @endif
                    name="CBD Cannulation"
                    class="form-check-input radiosave ck-cbdcannu radioother"
                    other="cannucbd_other"
                    datagroup="CBDCannulation"
                    id="{{ md5('CBD Cannulation EUS-rescue by RV(Rendezvous technique) via') }}"
                    subgroup="cbdcannu"
                    value="EUS-rescue by RV(Rendezvous technique) via"
                    @if(@$case->CBDCannulation == 'HGS route(Lt.IHD)' || @$case->CBDCannulation == 'CDS route(distal CBD)') checked @endif
                    >
                <label class="ms-4"
                    for="{{ md5('CBD Cannulation EUS-rescue by RV(Rendezvous technique) via') }}">&nbsp;EUS-rescue by
                    RV(Rendezvous technique) via</label>
            </div>

            {{-- @php

                $selectarr['HGS route(Lt.IHD)']['text'] = 'HGS route(Lt.IHD)';
                $selectarr['CDS route(distal CBD)']['text'] = 'CDS route(distal CBD)';

            @endphp --}}
            {{-- @dd($case) --}}
            <div class="col-3">
                @php
                    $haveselect_cbd = '';
                    if(isset($case->cannucbd_other)){
                        try{
                            $haveselect_cbd = trim(str_replace('EUS-rescue by RV(Rendezvous technique) via', '', $case->cannucbd_other));
                        } catch(\Exception $e) {}
                    }
                @endphp
                <select subgroup="cbdcannu" name="select_cbd"
                class="form-select selectsave savejson_edit ck-radio ck-cbdcannu-input"
                radiootherval="{{ md5('CBD Cannulation EUS-rescue by RV(Rendezvous technique) via') }}"
                    datagroup="CBDCannulation">
                    <option value="">Select</option>
                    <option value="HGS route(Lt.IHD)" @if(@$haveselect_cbd == 'HGS route(Lt.IHD)') selected @endif>HGS route(Lt.IHD)</option>
                    <option value="CDS route(distal CBD)" @if(@$haveselect_cbd == 'CDS route(distal CBD)') selected @endif>CDS route(distal CBD)</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-12">
        <input type="radio" {{ checkradio($case, 'cannucbd_other', 'Transpancreatic sphincterotomy(EPST)/Septotomy') }}
            name="CBD Cannulation" class="form-check-input radiosave ck-no radioother" other="cannucbd_other" datagroup="CBDCannulation"
            id="{{ md5('CBD Cannulation Transpancreatic sphincterotomy(EPST)/Septotomy') }}"
            value="Transpancreatic sphincterotomy(EPST)/Septotomy">
        <label class="ms-4"
            for="{{ md5('CBD Cannulation Transpancreatic sphincterotomy(EPST)/Septotomy') }}">&nbsp;Traspancreatic
            sphicterotomy(EPST)/Septotomy</label>
    </div>
    <div class="col-12">
        <input type="radio" {{ checkradio($case, 'cannucbd_other', 'Precut fistulotomy over PD stent') }}
            name="CBD Cannulation" class="form-check-input radiosave ck-no radioother" other="cannucbd_other" datagroup="CBDCannulation"
            id="{{ md5('CBD Cannulation Precut fistulotomy over PD stent') }}"
            value="Precut fistulotomy over PD stent">
        <label class="ms-4" for="{{ md5('CBD Cannulation Precut fistulotomy over PD stent') }}">&nbsp;Precut
            fistulotomy over PD stent</label>
    </div>
    <div class="col-12">
        <input class="form-control autotext savejson" id="cannucbd_other" placeholder="Other" type="text"
            autocomplete="off" value="{{ @$case->cannucbd_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>


<script>
    $(".selectsave").change(function() {
        let datagroup = $(this).attr("datagroup");
        let name = $(this).attr("name");
        let value = $(this).val();
        $.post('{{ url('api/procedure') }}', {
            event: "selectsave",
            cid: "{{ $cid }}",
            datagroup: name,
            value: value
        }, function(d, s) {})
    });
</script>
