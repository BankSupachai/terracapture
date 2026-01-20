<tr class="set-font-family" style="line-height:{{$body_line}};">
    <td>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                @php
                    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                    $isFlexibleSigmoidoscopy = (isset($procedure) && $procedure->name == 'Flexible Sigmoidoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Flexible Sigmoidoscopy');
                     $isRetrogradeDBE = (isset($procedure) && $procedure->name == 'Retrograde DBE') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Retrograde DBE');
                @endphp
                @if($isLongWriting && $isFlexibleSigmoidoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: px;">
                    <span class="casetitle">WITHDRAWAL TIME :</span>
                </td>
                 @elseif($isLongWriting && $isRetrogradeDBE)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 2px;">
                    <span class="casetitle">WITHDRAWAL TIME :</span>
                </td>
                @else
                <td style="width: 35%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 2px;">
                    <span class="casetitle">WITHDRAWAL TIME :</span>
                </td>
                @endif
                <td style="width: 65%; vertical-align: top;">
                    @isset($casedata->time_withdrawal)
                        <span class="casetext" style="padding-left: 1px;">
                            {{-- {{substr($casedata->time_withdrawal,0,-3)}} --}}
                             {{@$casedata->time_withdrawal}} - {{@$casedata->time_end}}
                            @isset($casedata->time_end )
                                @php
                                    $t_start    = str_pad($casedata->time_withdrawal,8,"0");
                                    $t_end      = str_pad($casedata->time_end,8,"0");
                                    $start_date = new DateTime($t_start);
                                    $since_start = $start_date->diff(new DateTime($t_end));
                                    $mins       = ($since_start->h * 60) + $since_start->i;
                                @endphp
                                ({{$mins}} Minutes)
                            @endisset
                        </span>
                    @else
                        &nbsp;<span class="casetext">-</span>
                    @endisset
                </td>
            </tr>
        </table>
    </td>
</tr>
