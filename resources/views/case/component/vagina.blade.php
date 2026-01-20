    <div class="col-6">
        @php
            $arr[] = 'Normal colposcopic finding';
            $arr[] = 'Insignificant colposcopic finding';
            $arr[] = 'Cervical polyp';
            $arr[] = 'Condyloma accuminata';
            $arr[] = 'HPV changes';

            $arr[] = 'LSIL';
            $arr[] = 'HSIL';
            $arr[] = 'Microinvasive ca.';
            $arr[] = 'Invasive Ca';
            $arr[] = 'Indecisive colposcopy';

            $arr[] = 'Squamous metaplasia';
            $arr[] = 'Cervicitis';
            $arr[] = 'SIL?';

            $arr[] = 'Adenocarcinoma';
            $arr[] = 'Inadequate colposcopy';

            $arr[] = 'Early squamous metaplasia';
            $arr[] = 'Nabothian cyst';
        @endphp


        <b>Vagina</b>
        <div class="row">
            @foreach ($arr as $data)
                <div class="col-4">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input checkboxfilltext savejson_checkbox" name="box_vagina" text=""
                            type="checkbox" value="{{ $data }}" id="vag_{{ $data }}"
                            {{ checkselect($data, @$case->box_vagina) }}>
                        <label class="form-check-label" for="vag_{{ $data }}">
                            &ensp; &ensp; {{ $data }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <div class="col-6">
        <div class="input-group mt-3">
            <input type="text" class="form-control savejson" id="text_vagina01" name="text_vagina01"
                value="{{ @$case->text_vagina01 }}" placeholder="Principle Diagonosis" aria-label="Recipient's username"
                aria-describedby="basic-addon2">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">ICD-10</span>
            </div>
        </div>
        <div class="input-group mt-2">
            <input type="text" class="form-control savejson" id="text_vagina02" name="text_vagina02"
                value="{{ @$case->text_vagina02 }}" placeholder="Other Diagnosis" aria-label="Recipient's username"
                aria-describedby="basic-addon2">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">ICD-10</span>
            </div>
        </div>

    </div>


