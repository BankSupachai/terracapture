{{--
<tr class="lh-6 set-font-family" style="line-height: {{$body_line}};">
    <td colspan="2">
        <span class="casetitle">Follow Up :1</span>
        <span class="casetext">
            @if (checknullblank($casedata, 'followup_detail') || checknullblank($casedata, 'followup_date'))
            {{ @$casedata->followup_detail }} {{ @$casedata->followup_date }} Days
        @else
            N/A
        @endif
        </span>
    </td>
</tr> --}}

<tr class="lh-6 set-font-family" style="line-height: {{$body_line}};">
    <td colspan="2">
        <span class="casetitle">PLAN :</span>
        <span class="casetext" style="margin-left: 103px;">
            @if(mevalue($casedata,['case_comment']))
            {!!nl2br(htmlspecialchars($casedata->case_comment))!!}
            @else
                N/A
            @endif
        </span>
    </td>
</tr>
