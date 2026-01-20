<tr class="lh-6 set-font-family">
    <td colspan="2">
        <span class="casetitle">Comment :</span>
        <span class="casetext">
            @if(mevalue($json,['case_comment']))
            {!!nl2br($json->case_comment)!!}
            @else
                N/A
            @endif
        </span>
    </td>
</tr>
<tr class="lh-6 set-font-family">
    <td colspan="2">
        <span class="casetitle">Impression :</span>
        <span class="casetext">
            @if(mevalue($json,['case_impression']))
            {!!nl2br($json->case_impression)!!}
            @else
                N/A
            @endif
        </span>
    </td>
</tr>
<tr class="lh-6 set-font-family">
    <td colspan="2">
        <span class="casetitle">Plan :</span>
        <span class="casetext">
            @if(mevalue($json,['case_plan']))
            {!!nl2br($json->case_plan)!!}
            @else
                N/A
            @endif
        </span>
    </td>
</tr>
