{{-- @dd($case) --}}

<div class="col-4">
    Periampullary mass &nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row mt-2">
    <div class="col-12">
        <input type="radio" {{ checkradio($case, 'Periampullary mass', 'No') }} name="Periampullary mass"
            class="form-check-input radiosave ck-no" datagroup="Periampullary mass" subgroup="Periampullary"
            id="{{ md5('Periampullarymass No') }}" value="No">
        <label class="ms-4" for="{{ md5('Periampullarymass No') }}">&nbsp;No</label>
    </div>
    <div class="col-12">
        <input type="radio" {{ checkradio($case, 'Periampullary mass', 'Yes') }} name="Periampullary mass"
            class="form-check-input radiosave" subgroup="Periampullary"
            datagroup="Periampullary mass"id="{{ md5('Periampullary mass') }}" value="Yes">
        <label class="ms-4" for="{{ md5('Periampullary mass') }}">&nbsp;Yes</label>
    </div>
    <div class="row px-5">
        <div class="col-4">
            <input type="checkbox" {{ checkinarray($case, 'Periampullarymassyes', 'Biopsy was done') }} name=""
                class="form-check-input checkboxgroupsave periampullary  ck-Periampullary" position="0" datagroup="Periampullarymassyes"  id="{{ md5('Biopsy was done') }}"
                subgroup="Periampullarymassyes" name="Periampullarymassyes" value="Biopsy was done">
            <label class="ms-4" for="{{ md5('Biopsy was done') }}">&nbsp;Biopsy was done</label>
        </div>
        <div class="col-2">
            <input type="number" class="form-control ck-Periampullary-input ck-radio savejson_edit" datagroup="Periampullarymassyes" subgroup="Periampullary" name="periampullary_biopsy" position="0" value="{{check_is_str(@$case->periampullary_biopsy)}}" min="0" oninput="validity.valid||(value='');">
        </div>
        <div class="col-2">
            Pieces
        </div>
        <div class="col-12 mt-2">
            {{-- @dd($case->Periampullarymassyes) --}}
            <input type="checkbox"
                {{ checkinarray($case, 'Periampullarymassyes', 'Ampullectomy by Snare en bloc resection') }} name=""
                class="form-check-input checkboxgroupsave periampullary" datagroup="Periampullarymassyes"
                id="{{ md5('Periampullary mass Ampullectomy by Snare en bloc resection') }}"
                value="Ampullectomy by Snare en bloc resection">
            <label class="ms-4"
                for="{{ md5('Periampullary mass Ampullectomy by Snare en bloc resection') }}">&nbsp;Ampullectomy by
                Snare en bloc resection</label>
        </div>
        <div class="col-12">
            <input type="checkbox"
                {{ checkinarray($case, 'Periampullarymassyes', 'Ampullectomy by Snare piecemeal resection') }}
                name="" class="form-check-input checkboxgroupsave periampullary" datagroup="Periampullarymassyes"
                id="{{ md5('Periampullary mass Ampullectomy by Snare piecemeal resection') }}"
                value="Ampullectomy by Snare piecemeals resection">
            <label class="ms-4"
                for="{{ md5('Periampullary mass Ampullectomy by Snare piecemeal resection') }}">&nbsp;Ampullectomy by
                Snare piecemeal resection</label>
        </div>
        <div class="col-4">
            <input type="checkbox" {{ checkinarray($case, 'Periampullarymassyes', 'Defect closure by metallic clips') }}
                name="" class="form-check-input checkboxgroupsave periampullary ck-Periampullary" datagroup="Periampullarymassyes"
                id="{{ md5('Periampullary mass Defect closure by metallic clips') }}" position="1"
                value="Defect closure by metallic clips">
            <label class="ms-4" for="{{ md5('Periampullary mass Defect closure by metallic clips') }}">&nbsp;Defect
                closure by metallic clips</label>
        </div>
        <div class="col-2">
            <input type="number" class="form-control ck-Periampullary-input savejson_edit ck-radio" datagroup="Periampullarymassyes" subgroup="Periampullary" name="periampullary_defect" position="1" value="{{check_is_str(@$case->periampullary_defect)}}" min="0" oninput="validity.valid||(value='');">
        </div>
        <div class="col-12">
            <input type="checkbox" {{ checkinarray($case, 'Periampullarymassyes', 'Apply hemospray') }} name=""
                class="form-check-input checkboxgroupsave periampullary" datagroup="Periampullarymassyes"
                id="{{ md5('Periampullarymass Apply hemospray') }}" value="Apply hemospray">
            <label class="ms-4" for="{{ md5('Periampullarymass Apply hemospray') }}">&nbsp;Apply hemospray</label>
        </div>
    </div>

    <div class="col-12 mt-1">
        <input class="form-control autotext savejson" id="fidingperivaterian_other" placeholder="Detail" type="text"
            autocomplete="off" value="{{ @$case->fidingperivaterian_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>

<script>
    // periampullary //
    $('.periampullary').on('change', function (e) {
        let total_ck = 0
        for (let i = 0; i < $('.periampullary').length; i++) {
           let is_checked = $($('.periampullary')[i]).is(':checked')
           if(is_checked){
                total_ck += 1
           }
        }

        if(total_ck > 0){
            $('.radiosave[datagroup="Periampullary mass"][value="Yes"]').click()
        }

        if(!$(e.target).is(':checked')){
            let position = $(e.target).attr('position')
            $(`.ck-Periampullary-input[position="${position}"]`).val('')
            let name = position == '0' ? 'periampullary_biopsy' : 'periampullary_defect'
            save_otherck('Periampullarymassyes', 'Periampullarymassyes', name, '')
        }
    })
</script>
