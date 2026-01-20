
<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">TECHNIQUES :
        </span>
        <span class="casetext">
            @if(@$casedata->ck_techbowel_co2 != [])
            {{implode(' , ', @$casedata->ck_techbowel_co2)}},
        @endif
        @if(@$casedata->other_tech != ' ')
        {{@$casedata->other_tech}}
    @endif

        </span>
    </td>
</tr>
