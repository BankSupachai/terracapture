<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                @php
                    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                    $isColonoscopy = (isset($procedure) && $procedure->name == 'Colonoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonoscopy');
                    $isEGD = (isset($procedure) && $procedure->name == 'EGD') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
                    $isEnteroscopy = (isset($procedure) && $procedure->name == 'Enteroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Enteroscopy');
                    $isAnterogradeDBE = (isset($procedure) && $procedure->name == 'Anterograde DBE') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Anterograde DBE');
                    $isColonicStent = (isset($procedure) && $procedure->name == 'Colonic Stent') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonic Stent');
                    $isRetrogradeDBE = (isset($procedure) && $procedure->name == 'Retrograde DBE') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Retrograde DBE');
                    $isDoubleBalloonEnteroscopy = (isset($procedure) && $procedure->name == 'Double Balloon Enteroscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Double Balloon Enteroscopy');
                @endphp
                @if($isLongWriting && $isColonoscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:5px; padding-right: 9px!important;">
                    <span class="casetitle" style="padding-right: 15px; ">INSERTION TIME :</span>
                </td>
                @elseif($isLongWriting && $isEGD)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:1px; padding-right: 5px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @elseif($isLongWriting && $isEnteroscopy)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-top:1px; padding-right: 5px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @elseif($isLongWriting && $isAnterogradeDBE)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:1px; padding-right: 15px;">
                    <span class="casetitle" style="padding-right: 9px;">INSERTION TIME :</span>
                </td>
                @elseif($isLongWriting && $isRetrogradeDBE)
                <td style="width: 24%; vertical-align: top; white-space: nowrap; padding-top:11px; padding-right: 15px;">
                    <span class="casetitle" style="padding-right: 9px;">INSERTION TIME :</span>
                </td>
                 @elseif($isLongWriting && $isColonicStent)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:1px; padding-right: 15px;">
                    <span class="casetitle" style="padding-right: 9px;">INSERTION TIME :</span>
                </td>
                @elseif($isLongWriting && $isDoubleBalloonEnteroscopy)
                <td style="width: 23%; vertical-align: top; white-space: nowrap; padding-top:11px; padding-right: 15px;">
                    <span class="casetitle" style="padding-right: 9px;">INSERTION TIME :</span>
                </td>
                @elseif($isColonoscopy)
                <td style="width: 44%; vertical-align: top; white-space: nowrap; padding-top:5px; padding-right: 10px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @elseif($isDoubleBalloonEnteroscopy)
                <td style="width: 44%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right:px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @elseif($isEGD)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-top:2px; padding-right: 5px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @elseif($isRetrogradeDBE)
                <td style="width: 44%; vertical-align: top; white-space: nowrap; padding-top:10px; padding-right: 25px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @elseif($isEnteroscopy)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-top:2px; padding-right: 5px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @elseif($isAnterogradeDBE)
                <td style="width: 44%; vertical-align: top; white-space: nowrap; padding-top:2px; padding-right: 5px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @else
                <td style="width: 35%; vertical-align: top; white-space: nowrap; padding-top:9px; padding-right: 5px;">
                    <span class="casetitle">INSERTION TIME :</span>
                </td>
                @endif
                    <td style="width: 65%; vertical-align: top;">
                          <div style="{{ $isColonoscopy || $isColonicStent  ? 'margin-top: -6px;' : ($isAnterogradeDBE ? 'margin-top: -9px;' : ($isEGD ? 'margin-top: 2px;' : '')) }}">
                        @if(isset($casedata->time_start) && isset($casedata->time_withdrawal))
                            @php
                                $t_start    = str_pad($casedata->time_start,8,"0");
                                $t_end      = str_pad($casedata->time_withdrawal,8,"0");
                                $start_date = new DateTime($t_start);
                                $end_date   = new DateTime($t_end);
                                $since_start = $start_date->diff($end_date);
                                $h = $since_start->h*60;
                                $i = $since_start->i;
                                $min = $h+$i;
                            @endphp
                            <span class="casetext">{{$t_start}} - {{$t_end}} ( {{$min }} Minutes ) </span>
                        @else
                            <span class="casetext">-</span>
                        @endif
                    </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
