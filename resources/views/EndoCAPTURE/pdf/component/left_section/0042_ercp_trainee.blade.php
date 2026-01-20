

<tr style="line-height: 0px;" >
    <td colspan="2"><span class="casetitle-small">TRAINEE INVOLVEMENT :</span>

        <span class="casetext-small">
            @if (@$casedata->traineename)
            Yes -  {{@$casedata->traineename}}
            @endif

            @if (@$casedata->other_trainee )
                {{@$casedata->other_trainee}}
            @endif
            @if (@$casedata->traineeinvolvement == 'No' && @$casedata->other_trainee == '' )
                No
            @endif

        </span>

    </td>
</tr>

