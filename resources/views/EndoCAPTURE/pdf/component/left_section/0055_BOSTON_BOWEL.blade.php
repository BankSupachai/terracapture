{{-- @dd($casedata)  --}}

<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">BOSTON BOWEL PREPARATION :
        </span>
        <span class="casetext">
            @if(@$casedata->bowel_medi)
                <span class="casetext">
                    {{@$casedata->bowel_medi}}
                </span>
            @endif

            @if(@$casedata->bowel_rc )
                <span class="casetext">
                  Rc : {{@$casedata->bowel_rc}}
                </span>
            @endif
            @if(@$casedata->bowel_tc )
            <span class="casetext">
              Tc : {{@$casedata->bowel_tc}}
            </span>
        @endif
        @if(@$casedata->bowel_lc )
        <span class="casetext">
          Lc : {{@$casedata->bowel_lc}}
        </span>
    @endif

        </span>
    </td>
</tr>
