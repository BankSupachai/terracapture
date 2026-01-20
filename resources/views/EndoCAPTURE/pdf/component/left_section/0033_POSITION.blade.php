<tr class="set-font-family">
    <td>
        <span class="casetitle">POSITION :</span>
        @if(isset($json->position))
            <span class="casetext">{{@$json->position}}</span>
        @else
            &nbsp;<span class="casetext">-</span>
        @endif
    </td>
</tr>
