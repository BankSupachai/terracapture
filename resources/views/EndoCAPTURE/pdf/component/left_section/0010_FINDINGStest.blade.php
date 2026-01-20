
<tr style="line-height: 8px;" class="set-font-family">
    <td style="vertical-align:top" colspan="2">
        <span class="casetitle">FINDINGSdasdsss: </span>
    </td>
</tr>
<tr class="lh-6 ">
    <td colspan="2">
        <table border="0" width="50%" id="findding">
            @php
                $mainpart = $casedata->mainpart ?? [];
                if (is_string($mainpart)) {
                    $mainpart = [$mainpart];
                }
            @endphp

            @foreach($mainpart as $key => $value)
                @if($value != null && $value != '')
                    <tr style="line-height:8px;">
                        <td style="width: 15%;">
                            <span class="findtitle">{{$key}}:</span>
                        </td>
                        <td colspan="" style="padding-left: 5px;">
                            <span class="findtext">
                                {!!nl2br(htmlspecialchars($value))!!}
                            </span>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>

    </td>
</tr>


@if (@$casedata->overall_finding !='' && @$casedata->overall_finding !=null)
    <tr class=" set-font-family" style="line-height:{{ $body_line }};">
        <td colspan="2">
            {{-- <span class="casetitle">FINDING: &nbsp;</span> --}}
            <span class="findtext">{!!nl2br(htmlspecialchars(@$casedata->overall_finding))!!}</span>
        </td>
    </tr>
@endif





