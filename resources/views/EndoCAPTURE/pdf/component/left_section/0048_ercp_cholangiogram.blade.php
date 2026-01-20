

<tr  style="line-height:5px;">
    <td width="25%">
        <span class="casetitle-small">CHOLANGIOGRAM :</span>
    </td>
    @if (isset($casedata->cholangiogram_other))
        <td>
            @if (checknullblank($casedata, 'cholangiogram_other'))
                <span class="casetext-small"> {{ $casedata->cholangiogram_other }} </span>
            @endif
        </td>
        @endif
    </tr>

