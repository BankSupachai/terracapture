<tr class="lh-6 set-font-family" style="line-height: {{$body_line}};">
    <td colspan="2">
        <span class="casetitle">PLAN :</span>
        <span class="casetext">
            @if(mevalue($casedata,['case_comment']))
            {!!nl2br(htmlspecialchars($casedata->case_comment))!!}
            @else
                N/A
            @endif
        </span>
    </td>
</tr>
