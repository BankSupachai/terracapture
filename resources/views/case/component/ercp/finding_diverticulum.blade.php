<div class="col-4">
    Diverticulum&nbsp;&nbsp; <i class="ri-equalizer-line"></i>
</div>
<div class="row">
    <div class="col-7">
        <input type="radio" {{ checkradio($case, 'fidingdiver_other', 'No paravaterian diverticulum') }}
        name="Diverticulum" class="form-check-input radiosave ck-no  radioother" other="fidingdiver_other" datagroup="Diverticulum" subgroup="Diverticulum"
        id="{{ md5('Diverticulum No paravaterian diverticulum') }}"
        value="No paravaterian diverticulum">
    <label class="ms-4" for="{{ md5('Diverticulum No paravaterian diverticulum') }}">&nbsp;No Perivaterian
        diverticulum Small/Huge</label>
    </div>
</div>
<div class="row">
    <div class="col-7">
        <input type="radio" {{ checkradio($case, 'fidingdiver_other', 'Perivaterian diverticulum Small/Huge') }}
            name="Diverticulum" class="form-check-input radiosave ck-no  radioother" other="fidingdiver_other" datagroup="Diverticulum" subgroup="Diverticulum"
            id="{{ md5('Diverticulum Perivaterian diverticulum Small/Huge') }}"
            value=" Perivaterian diverticulum Small/Huge">
        <label class="ms-4" for="{{ md5('Diverticulum Perivaterian diverticulum Small/Huge') }}">&nbsp;Perivaterian
            diverticulum Small/Huge</label>
    </div>
    <div class="col-5">
        <input type="radio" {{ checkradio($case, 'fidingdiver_other', 'Perivaterian diverticulum') }} name="Diverticulum"
            class="form-check-input radiosave ck-no  radioother" other="fidingdiver_other" datagroup="Diverticulum" subgroup="Diverticulum"
            id="{{ md5('Diverticulum Perivaterian diverticulum') }}" value="Perivaterian diverticulum">
        <label class="ms-4" for="{{ md5('Diverticulum Perivaterian diverticulum') }}">&nbsp;Perivaterian
            diverticulum</label>
    </div>
    <div class="col-7">



        <div class="row">

            <div class="col-5">
                <input
                    {{-- {{ checkradio($case, 'fidingdiver_other', 'Ampulla located at') }} --}}
                    @if(str_contains(@$case->fidingdiver_other."",  'Ampulla located at')) checked @endif
                    id          =   "{{ md5('Diverticulum Ampulla located at') }}"
                    class       =   "form-check-input radiosave ck-Diverticulum  radioother"
                    type        =   "radio"
                    name        =   "Diverticulum"
                    other       =   "fidingdiver_other"
                    textend     =   "O'clock of diverticulum edge"
                    datagroup   =   "Diverticulum"
                    subgroup    =   "Diverticulum"
                    value       =   "Ampulla located at"
                >
                <label
                    class       =   "ms-4 d-inline "
                    for         =   "{{ md5('Diverticulum Ampulla located at') }}"
                >
                    &nbsp;Ampulla located at
                </label>
            </div>

            <div class="col-2">
                @php
                    $havefidingdiver_other = '';
                    if(isset($case->fidingdiver_other)){
                        try{
                            if (preg_match('/\b(\d+)\b/', $case->fidingdiver_other, $matches)) {
                                $havefidingdiver_other = $matches[1];
                            }
                        } catch(\Exception $e) {}
                    }
                @endphp
                <input
                    radiootherval   =   "{{ md5('Diverticulum Ampulla located at') }}"
                    name            =   "Diverticulum_other"
                    class           =   "form-control ck-radio savejson_edit"
                    other           =   "fidingdiver_other"
                    type            =   "number"
                    datagroup       =   "Diverticulum"
                    subgroup        =   "Diverticulum"
                    value           =   "{{@$havefidingdiver_other}}"
                    min             =   "0"
                    oninput         =   "validity.valid||(value='');"
                >
            </div>

            <div class="col-5 " radioothervalend ="{{ md5('Diverticulum Ampulla located at') }}">O'clock of diverticulum edge</div>
        </div>




    </div>
    <div class="col-5">
        <input type="radio" {{ checkradio($case, 'fidingdiver_other', 'Ampulla located inside diverticulum') }}
            name="Diverticulum" class="form-check-input radiosave ck-no  radioother" other="fidingdiver_other" datagroup="Diverticulum" subgroup="Diverticulum"
            id="{{ md5('Diverticulum Ampulla located inside diverticulum') }}"
            value="Ampulla located inside diverticulum">
        <label class="ms-4" for="{{ md5('Diverticulum Ampulla located inside diverticulum') }}">&nbsp;Ampulla located
            inside diverticulum</label>
    </div>

    <div class="col-12 mt-1">
        <input class="form-control autotext savejson" id="fidingdiver_other" placeholder="Detail" type="text"
            autocomplete="off" value="{{ @$case->fidingdiver_other }}" />
    </div>
    <div class="col-12">&nbsp;</div>
</div>
