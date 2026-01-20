<tr style="line-height:10px;">
    <td>
        <span class="casetitle-small text-nowrap">COMPLICATION : </span>
    </td>
    <td>
        @php
            $nonecheck_complication = 0;
            $noneother_complication = 0;
        @endphp

        <span class="casetext-small ">
            @if (checknullblank($casedata, 'perforation_at_other'))
                @if (@$casedata->perforation_at_other != '')
                    Perforation at {{ @$casedata->perforation_at_other }} Manage With
                    {{ @$casedata->managecomplication0 }}
                    @php
                        $nonecheck_complication++;
                    @endphp
                @endif

            @endif
            {{-- @dd($casedata->bleeding_at_other , $casedata->managecomplication1) --}}
            @if (checknullblank($casedata, 'bleeding_at_other'))
                Bleeding at {{ @$casedata->bleeding_at_other }} Manage With
                {{ @$casedata->managecomplication1 }}
                @php
                    $nonecheck_complication++;
                @endphp
            @endif
            @if (checknullblank($casedata, 'complication_other'))
                {{ @$casedata->complication_other }}
                @php
                    $noneother_complication++;
                @endphp
            @endif

            @if ($nonecheck_complication == 0 && $noneother_complication == 0)
                N/A
            @endif
        </span>
    </td>

</tr>



<tr style="line-height:{{$body_line}};">
    <td width="30%">
        <span class="casetitle-small text-nowrap">ESTIMATE BLOOD LOSS : </span>
    </td>
    <td>
        <span class="casetext-small ">
            @if (checknullblank($casedata, 'blood_loss'))
                {{ @$casedata->blood_loss }} ml.
            @else
                N/A
            @endif
        </span>
    </td>

</tr>

<tr style="line-height:{{$body_line}};">
    <td width="30%">
        <span class="casetitle-small text-nowrap">BLOOD TRANSFUSION : </span>
    </td>
    <td>
        <span class="casetext-small ">
            @if (checknullblank($casedata, 'blood_transfusion'))
                {{ @$casedata->blood_transfusion }} ml.
            @else
                N/A
            @endif
        </span>
    </td>

</tr>
{{-- @dd($casedata) --}}

{{-- รอถามพี่มอสตอนกลับมา --}}
<tr style="line-height:10px;">
    <td width="30%">
        <span class="casetitle-small text-nowrap">SPECIMEN : </span>
    </td>
    <td>
        <span class="casetext-small ">

            @for ($i = 1; $i < 10; $i++)
                @php
                    if (!isset($casedata->{"specimen$i"})) {
                        continue;
                    }
                @endphp

                {{ @$casedata->{"specimen$i"} }} {{ @$casedata->{"specimenbottle$i"} }} Bottle <br>
            @endfor

        </span>
    </td>

</tr>


<tr style="line-height:10px;">
    <td width="30%">
        <span class="casetitle-small text-nowrap">FOLLOW UP : </span>
    </td>
    <td>
        <span class="casetext-small ">
            @if (checknullblank($casedata, 'followup_other'))
                {{ @$casedata->followup_other }} {{ @$casedata->followup_date }} Days
            @else
                N/A
            @endif
        </span>
    </td>

</tr>


<tr style="line-height:10px;">
    <td width="30%">
        <span class="casetitle-small text-nowrap">COMMENT: </span>
    </td>
    <td>
        <span class="casetext-small ">
            @if (checknullblank($casedata, 'case_comment'))
                {{ @$casedata->case_comment }}
            @else
                N/A
            @endif
        </span>
    </td>

</tr>
