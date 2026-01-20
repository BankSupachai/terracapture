<tr class="set-span-family">
    <td>
        {{-- @dd($casedata); --}}
        @if(isset($casedata->asa_class))
            <span class="casetitle">ASA_CLASS :</span>
            <span class="casetext">{{$casedata->asa_class}}</span><br>
        @endif
        @if(isset($casedata->date_of))
            <span class="casetitle">DATE OF INTUBATION :</span>
            <span class="casetext">{{$casedata->date_of}}</span><br>
        @endif

    </td>
</tr>

