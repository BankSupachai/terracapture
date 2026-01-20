<tr style="line-height:{{ $body_line }};" class="set-font-family">
    <td>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                {{-- DEBUG: type = {{ $type ?? 'NOT SET' }} --}}
                @php
                    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                    $procedureName = isset($procedure) && isset($procedure->name) ? trim($procedure->name) : (isset($casedata->procedure_name) ? trim($casedata->procedure_name) : '');
                    $isEGD = $procedureName == 'EGD';
                    $isColonoscopy = $procedureName == 'Colonoscopy';
                    $isEUS = $procedureName == 'EUS';
                @endphp
                @if($isLongWriting && $isEGD)
                <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">INDICATION :</span>
                </td>
                @elseif($isLongWriting && $isEUS)
                <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">INDICATION :</span>
                </td>
                @elseif($isLongWriting)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">INDICATION :</span>
                </td>
                @elseif($isEGD)
                <td style="width: 36%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">INDICATION :</span>
                </td>
             
                @elseif($isColonoscopy)
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">INDICATION :</span>
                </td>
                @else
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">INDICATION :</span>
                </td>
                @endif
                <td style="width: 60%; vertical-align: top;">
                    <div style="margin-top: -10px;">
                        {{-- @dd(@$casedata->indication)
                        @if (mevalue($json, ['case_indication']))
                            <span class="casetext">{{ @$json->indication }}</span>
                        @endif --}}
                        @isset($casedata->indication)
                            <span class="casetext">
                                @if(is_array($casedata->indication))
                                    {!! implode("<br>", $casedata->indication) !!}
                                @else
                                    {{ $casedata->indication }}
                                @endif
                                <br>{{ @$casedata->indication_other }}
                            </span>
                        @else
                            <span class="casetext">
                                {{@$casedata->indication_other}}
                            </span>
                        @endisset
                    </div>
                </td>

            </tr>
        </table>
    </td>
</tr>
