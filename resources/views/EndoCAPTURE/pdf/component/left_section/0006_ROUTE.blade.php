
<tr style="line-height:{{ $body_line }};" class="set-font-family">
    <td colspan="2">
        <span class="casetitle">ENDOSCOPIC ROUTE :</span>
        @if (isset($casedata->route))

                <span class="casetext" style="text-transform: capitalize;">{{ @$casedata->route }}</span>

        @endif
    </td>
</tr>
