<tr class="" style="line-height:{{ $body_line }};">
    <td>
        <span class="casetitle-small">POSITION :</span>
        {{-- @dd($casedata); --}}

        @if(isset($casedata->position))




            <span class="casetext-small"> {{implode(" , " , $casedata->position)}} </span>

        @endif

        @if (isset($casedata->positionother) && gettype(@$casedata->positionother) == 'string')
        <span class="casetext-small">{{@$casedata->positionother}} </span>
        @endif


        @if (@$casedata->position == '' && @$casedata->positionother == '' || (@$casedata->positionother == [] ))
        <span class="casetext-small">N/A</span>
        @endif
    </td>
</tr>
