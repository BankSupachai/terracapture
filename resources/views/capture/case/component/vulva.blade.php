<div class="col-6">
    @php
    $arr [] = "Normal colposcopic finding";
    $arr [] = "Insignificant colposcopic finding";
    $arr [] = "Cervical polyp";
    $arr [] = "Condyloma accuminata";
    $arr [] = "HPV changes";

    $arr [] = "LSIL";
    $arr [] = "HSIL";
    $arr [] = "Microinvasive ca.";
    $arr [] = "Invasive Ca";
    $arr [] = "Indecisive colposcopy";

    $arr [] = "Squamous metaplasia";
    $arr [] = "Cervicitis";
    $arr [] = "SIL?";


    $arr [] = "Adenocarcinoma";
    $arr [] = "Inadequate colposcopy";

    $arr [] = "Early squamous metaplasia";
    $arr [] = "Nabothian cyst";
@endphp


        <b>Vulva</b>
            <div class="row">
                @foreach ($arr as $data )
                <div class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input checkboxfilltext savejson_checkbox" name="box_vulva" text="" type="checkbox" value="{{$data}}" id="vul_{{$data}}"
                             {{ checkselect($data, @$case->box_vulva) }}>
                        <label class="form-check-label" for="vul_{{$data}}">
                         &ensp; &ensp; {{$data}}
                        </label>
                      </div>
                </div>
                @endforeach
            </div>

</div>

<div class="col-6">
    <div class="input-group mt-3">
        <input type="text" class="form-control savejson" placeholder="Principle Diagonosis"
            aria-label="Recipient's username" id="text_vulva01" name="text_vulva01"
            aria-describedby="basic-addon2" value="{{ @$case->text_vulva01 }}">
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">ICD-10</span>
        </div>
    </div>
    <div class="input-group mt-2">
        <input type="text" class="form-control savejson" placeholder="Other Diagnosis"
            aria-label="Recipient's username" aria-describedby="basic-addon2" id="text_vulva02"
            name="text_vulva02" value="{{ @$case->text_vulva02 }}">
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">ICD-10</span>
        </div>
    </div>
</div>
