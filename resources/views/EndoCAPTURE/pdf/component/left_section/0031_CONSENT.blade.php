<tr class="set-font-family">
    <td>
        <span class="casetitle">CONSENT :</span>
        @if(isset($json->consent))
            <span class="casetext lh-08">{{@$json->consent}}</span>
        @else
            &nbsp;-
        @endif
    </td>
</tr>
