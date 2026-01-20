<td>
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            {{-- DEBUG: type = {{ $type ?? 'NOT SET' }} --}}
            @if(((isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing')) && ((isset($procedure) && $procedure->name == 'ERCP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERCP')))
            <td style="width: 10%; vertical-align: top; white-space: nowrap; padding-right: 42px;">
                <span class="casetitle">INDICATION :</span>
            </td>
            @elseif(isset($type) && $type == 'long_writing')
            <td style="width: 25%; vertical-align: top; white-space: nowrap; padding-right: 47px;">
                <span class="casetitle">INDICATION :</span>
            </td>
            @else
            <td style="width: 36%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                <span class="casetitle">INDICATION :</span>
            </td>
            @endif
            <td style="width: 60%; vertical-align: top;">
                <div style="margin-top: -9px;">
                    {{-- @dd(@$casedata->indication)
                    @if (mevalue($json, ['case_indication']))
                        <span class="casetext"> {!!implode("<br>", $indication_other)!!} </span>
                    @endif --}}
                    @if (checknullblank($casedata, 'indicationGroup_other'))
                    @php
                        $indication_other = array_filter($casedata->indicationGroup_other);
                    @endphp
                    <span class="casetext"> {!!implode("<br>", $indication_other)!!}  </span>
                    @else
                    <span class="casetext">  N/A </span>
                    @endif
                </div>
            </td>

        </tr>
    </table>
</td>
