

{{-- @dd($casedata->anesthesiaother); --}}
<tr style="line-height:{{ $body_line }};" class="set-font-family">
    <td>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>

                @php
                    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                    $isERCP = (isset($procedure) && $procedure->name == 'ERCP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERCP');
                    $isEGD = (isset($procedure) && $procedure->name == 'EGD') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
                    $isEUS = (isset($procedure) && $procedure->name == 'EUS') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EUS');
                    $isBronchoscopy = (isset($procedure) && $procedure->name == 'Bronchoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Bronchoscopy');
                    $liverBiopsyName = isset($procedure) && isset($procedure->name) ? trim($procedure->name) : (isset($casedata->procedure_name) ? trim($casedata->procedure_name) : '');
                    $isLiverBiopsy = !empty($liverBiopsyName) && strtolower(str_replace([' ', '_', '-'], '', $liverBiopsyName)) === 'liverbiopsy';
                @endphp
                @endphp
                @if($isLongWriting && $isERCP)
                <td style="width: 20%; vertical-align: top; white-space: nowrap;  padding-right: 3px; ">
                    <span class="casetitle">ANESTHESIA :</span>
                </td>
                @elseif($isLongWriting && $isEGD)
                <td style="width: 20%; vertical-align: top; white-space: nowrap;">
                    <span class="casetitle">ANESTHESIA :</span>
                </td>
                @elseif($isLongWriting)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; ">
                    <span class="casetitle">ANESTHESIA :</span>
                </td>
                  @elseif($isLiverBiopsy)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; margin-right: 5px;">
                    <span class="casetitle">ANESTHESIA :</span>
                </td>
                @elseif($isEGD)
                <td style="width: 36%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ANESTHESIA :</span>
                </td>
                @elseif($isERCP)
                <td style="width: 36%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ANESTHESIA :</span>
                </td>
                 @elseif($isBronchoscopy)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ANESTHESIA :</span>
                </td>
                @else
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ANESTHESIA :</span>
                </td>
                @endif
                <td style="width: 60%; vertical-align: top;">
                    @php
                        $isEGD = (isset($procedure) && $procedure->name == 'EGD') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
                        $isColonoscopy = (isset($procedure) && $procedure->name == 'Colonoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonoscopy');
                        $isERCP = (isset($procedure) && $procedure->name == 'ERCP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERCP');
                        $marginTop = ($isEGD || $isColonoscopy) ? '-8px' : '-8px';
                        $divMarginTop = $isERCP ? '-8px' : $marginTop;
                    @endphp
                    <div style="margin-top: {{ $divMarginTop }};">
                        <span class="casetext">
                            @php
                                $noneval=0;
                            @endphp

                            @foreach(isset($casedata->anesthesia)?$casedata->anesthesia:[] as $data)
                                {{$data}}<br>
                                @php
                                    $noneval++;
                                @endphp
                            @endforeach

                            @isset($casedata->anesthesiaother)
                            {{$casedata->anesthesiaother}}<br>
                            @endisset

                            @if(@$casedata->anesthesiaother.""  == "" && $noneval==0)
                                    N/A
                            @endif
                        </span>
                    </div>
                </td>

            </tr>
        </table>
    </td>
</tr>

