
<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        @if(
            @$casedata->specimen1 != "" || @$casedata->specimen2 != "" || @$casedata->specimen3 != "" || @$casedata->specimen4 != "" ||
            @$casedata->specimenbottle1 != "" || @$casedata->specimenbottle2 != "" || @$casedata->specimenbottle3 != "" || @$casedata->specimenbottle4 != ""
        )
            <span class="casetitle" style="display: inline-block; width: 22%;">SPECIMEN :</span>&nbsp;
        @endif
    <span class="casetext" style="display: inline-block; width: 78%;">
        @php
            $checkhistopathology =0;
        @endphp
        @if((isset($casedata->specimen_na)&& @$casedata->histopathology=="[]") || !isset($casedata->histopathology))
            @if(@$casedata->histopathology_volumn==0 && !isset($casedata->histopathology_volumn) && !isset($casedata->histopathology_other))
                {{-- N/A --}}
            @endif
        @endif

        @if(isset($casedata->histopathology_volumn) && @$json->histopathology!="[]")
            @if(isset($json->histopathology))
                @php
                    $casedata = jsonDecode($casedata->histopathology);
                @endphp
            @endif
        @endif
        @if(isset($casedata->histopathology_volumn))
            @if($casedata->histopathology_volumn>0)
                {{@$casedata->histopathology_volumn}} bottle
            @endif
        @endif

        @if(isset($json->specimen_wfp))
            @if(@$json->specimen_wfp!="[]")
                &nbsp;- Pending
            @endif
        @endif


        @if(@$json->histopathology_other!="")
            <br>
            {!!nl2br(@$json->histopathology_other)!!}
        @endif

        @if(isset($casedata->specimen1) || isset($casedata->specimenbottle1))
            {{@$casedata->specimen1}} {{@$casedata->specimenbottle1}} Bottle<br>
        @endif

        @if(isset($casedata->specimen2) || isset($casedata->specimenbottle2))
            {{@$casedata->specimen2}} {{@$casedata->specimenbottle2}} Bottle<br>
        @endif

        @if(isset($casedata->specimen3) || isset($casedata->specimenbottle3))
            {{@$casedata->specimen3}} {{@$casedata->specimenbottle3}} Bottle<br>
        @endif



        @if(isset($casedata->specimen4) || isset($casedata->specimenbottle4))
        {{@$casedata->specimen4}} {{@$casedata->specimenbottle4}} Bottle<br>
    @endif
    </span>

    </td>
</tr>
