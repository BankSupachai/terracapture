
<tr style="line-height:5px;">
    <td >
        <span class="casetitle-small text-nowrap">PROCEDURE LIST : </span>
    </td>
    <td>
        <span class="casetext-red-small ">
            @if (checknullblank($casedata, 'procedure_subtext'))
            @php
            $prorcedure_subtext = array_filter($casedata->procedure_subtext);
        @endphp
            {!!implode("<br>" , $prorcedure_subtext)!!}
              @else
              N/A
        @endif

        @if (checknullblank($casedata, 'overall_procedure'))
               <br> {{$casedata->overall_procedure}}
        @endif
        </span>
    </td>


</tr>
