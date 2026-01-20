
<tr style="line-height: 8px;">
   <td style="padding-left:px;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                {{-- DEBUG: type = {{ $type ?? 'NOT SET' }} --}}
                @php
                    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                    $isERCP = (isset($procedure) && $procedure->name == 'ERCP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERCP');
                    $isEGD = (isset($procedure) && $procedure->name == 'EGD') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
                    $isEUS = (isset($procedure) && $procedure->name == 'EUS') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EUS');
                    $isColonoscopy = (isset($procedure) && $procedure->name == 'Colonoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonoscopy');
                    $isBronchoscopy = (isset($procedure) && $procedure->name == 'Bronchoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Bronchoscopy');
                    $liverBiopsyName = isset($procedure) && isset($procedure->name) ? trim($procedure->name) : (isset($casedata->procedure_name) ? trim($casedata->procedure_name) : '');
                    $isLiverBiopsy = !empty($liverBiopsyName) && strtolower(str_replace([' ', '_', '-'], '', $liverBiopsyName)) === 'liverbiopsy';
                @endphp
                @if($isLongWriting && $isERCP)
                <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 11px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                @elseif($isLongWriting && $isEGD)
                <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                @elseif($isLongWriting)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                  @elseif($isBronchoscopy)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                  @elseif($isColonoscopy)
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                 @elseif($isEUS)
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                @elseif($isERCP)
                <td style="width: 36%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                 @elseif($isEGD)
                <td style="width: 36%; vertical-align: top; white-space: nowrap; padding-right: 5px; padding-top:1px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                  @elseif($isLiverBiopsy)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-right: 5px; padding-top:1px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td>
                 {{-- @elseif($isColonoscopy)
                <td style="width: 39%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                </td> --}}
                @else
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 35px;">
                    <span class="casetitle">BRIEF HISTORY:</span>
                    </td>
                @endif
                <td style="width: 60%; vertical-align: top;">
                     @php
                        $marginTopValue = ($isEUS) ? '-5px' : '-5px';
                         $marginTopValue = ($isBronchoscopy) ? '-10px' : '-5px';
                    @endphp
                    <div style="margin-top: {{ $marginTopValue }};">
                        @if(mevalue($casedata,['case_history']))
                        <span class="casetext">{!!without_tagP(htmlspecialchars(@$casedata->case_history))!!}</span>
                        @endif
                </div>
                </td>

            </tr>
        </table>
    </td>
</tr>
