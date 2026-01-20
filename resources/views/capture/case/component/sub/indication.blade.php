@php
    $indication = array();
    if($procedure->name=="EGD"){
        $indication[] = "GI Bleeding";
        $indication[] = "GERD";
        $indication[] = "Dyspepsia";
        $indication[] = "Dysphagia";
        $indication[] = "IDA";
        $indication[] = "Iron Deficiency Anemia";
    }





    if($procedure->name=="Colonoscopy"){
        $indication[] = "CRC screening";
        $indication[] = "Constipation";
        $indication[] = "Abdominal pain";
        $indication[] = "Fit Positive";
        $indication[] = "Rectal Bleeding";
        $indication[] = "IBD";
        $indication[] = "Bowel Habit Change";
        $indication[] = "LGIB";
        $indication[] = "Family Hx CRC";
        $indication[] = "Diarrhea";
        $indication[] = "Surveillance colonoscopy";
        $indication[] = "Iron Deficiency Anemia";
    }
@endphp

<div class="row mt-2 ">
    <div class="col-12 d-flex align-items-center text-nowrap">
        INDICATION
    </div>
    @foreach (isset($indication)?$indication:array() as $box)
        @php
            if(isset($case->indication)){
                $indicationbox = $case->indication;
            }else{
                $indicationbox = array();
            }

            $is_checked_indication = in_array($box,$indicationbox) ? 'checked' : '';
        @endphp

        <div class="col-4 text-nowrap">
            <input
                type="checkbox"
                id="indication{{ $box }}"
                name="indication"
                class="savejson_checkbox check-color form-check-input"
                value="{{ $box }}"
                {{ $is_checked_indication }}
                >

            <label  for="indication{{ $box }}">
               &ensp; {{ $box }}
            </label>
        </div>
    @endforeach
</div>


<div class="col-12">
    <input class="form-control autotext savejson" name="indication_other" id="indication_other"
        placeholder="Other Indication" type="text" autocomplete="off" value="{{ @$case->indication_other }}" />
</div>
