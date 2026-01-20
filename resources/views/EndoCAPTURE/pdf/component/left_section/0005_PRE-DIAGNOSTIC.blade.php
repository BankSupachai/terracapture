@if (mevalue($casedata, ['case_history', 'prediagnosis', 'prediagnostic_other']))
    <tr class=" set-font-family" style="line-height:{{ $body_line }};">
        <td>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    @php
                        $isLongWriting =
                            (isset($type) && $type == 'long_writing') ||
                            (isset($pdftype) && $pdftype == 'long_writing') ||
                            (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                        $isColonoscopy =
                            (isset($procedure) && $procedure->name == 'Colonoscopy') ||
                            (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonoscopy');
                        $isERCP =
                            (isset($procedure) && $procedure->name == 'ERCP') ||
                            (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERCP');
                        $isEGD =
                            (isset($procedure) && $procedure->name == 'EGD') ||
                            (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
                        $isEUS =
                            (isset($procedure) && $procedure->name == 'EUS') ||
                            (isset($casedata->procedure_name) && $casedata->procedure_name == 'EUS');
                        $isBronchoscopy =
                            (isset($procedure) && $procedure->name == 'Bronchoscopy') ||
                            (isset($casedata->procedure_name) && $casedata->procedure_name == 'Bronchoscopy');
                        $isEnteroscopy =
                            (isset($procedure) && $procedure->name == 'Enteroscopy') ||
                            (isset($casedata->procedure_name) && $casedata->procedure_name == 'Enteroscopy');
                        $isManometry =
                            (isset($procedure) && $procedure->name == 'Manometry') ||
                            (isset($casedata->procedure_name) && $casedata->procedure_name == 'Manometry');
                    @endphp
                    @if ($isLongWriting && $isERCP)
                        <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @elseif($isLongWriting && $isEGD)
                        <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @elseif($isLongWriting && $isColonoscopy)
                        <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @elseif($isLongWriting)
                        <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @elseif($isEUS)
                        <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @elseif($isEnteroscopy)
                        <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @elseif($isColonoscopy)
                        <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @elseif($isERCP)
                        <td style="width: 36%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @elseif($isManometry)
                        <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-top:5px; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @else
                        <td style="width: 37%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                        </td>
                    @endif


                    <td style="width: 60%; vertical-align: top;">
                        @php
                            $marginTopValue = $isEUS ? '-5px' : '-5px';
                            $marginTopValue = $isBronchoscopy ? '-8px' : '-5px';
                        @endphp
                        <div style="margin-top: {{ $marginTopValue }};">
                            @isset($casedata->prediagnosis)
                                <span class="casetext">
                                    @if (is_array($casedata->prediagnosis))
                                        {!! implode('<br>', $casedata->prediagnosis) !!}
                                    @else
                                        {{ $casedata->prediagnosis }}
                                    @endif
                                    @if (isset($casedata->prediagnostic_other) && $casedata->prediagnostic_other != '')
                                        <br>{{ $casedata->prediagnostic_other }}
                                    @endif
                                </span>
                            @else
                                @isset($casedata->prediagnostic_other)
                                    <span class="casetext">{{ $casedata->prediagnostic_other }}</span>
                                @else
                                    <span class="casetext">None</span>
                                @endisset
                            @endisset
                        </div>
                    </td>

                </tr>
            </table>
        </td>
    </tr>
@endif
