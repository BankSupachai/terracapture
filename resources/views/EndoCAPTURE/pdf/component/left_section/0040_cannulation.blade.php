<tr class="set-font-family">
    <td>
        <span class="casetitle">Cannulation :</span>
        {{-- @dd($casedata); --}}
        @if(isset($casedata->CBDCannulation))
            <span class="casetext">{{@$casedata->CBDCannulation}}</span>
        @endif
    </td>
</tr>
