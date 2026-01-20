<tr style="line-height:{{$body_line}};vertical-align:top;" class="set-font-family">
    <td class="vat">
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                @php
                    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                    $isEGD = (isset($procedure) && $procedure->name == 'EGD') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
                @endphp
                @if($isLongWriting && $isEGD)
                <td style="width: 1%; vertical-align: top; white-space: nowrap; padding-right: 1px;">
                    <span class="casetitle">GASTRIC CONTENT :</span>
                </td>
                @elseif($isLongWriting)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">GASTRIC CONTENT :</span>
                </td>
                 @elseif($isEGD)
                <td style="width: %; vertical-align: top; white-space: nowrap; padding-right: 1px;">
                    <span class="casetitle">GASTRIC CONTENT :</span>
                </td>
                @else
                <td style="width: 35%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">GASTRIC CONTENT :</span>
                </td>
                @endif
                <td style="width: 65%; vertical-align: top;">
                    <div style="margin-top: -5px; margin-left:6px;">
                        <span class="casetext">
                            @if(@$casedata->gastriccontent!=null || @$casedata->gastriccontent_other!="")
                                @foreach(isset($casedata->gastriccontent)?$casedata->gastriccontent:[] as $data)
                                    {{$data}}<br>
                                @endforeach
                                {{@$casedata->gastriccontent_other}}
                            @else
                                Clear
                            @endif
                        </span>
                    </div>
                </td>

            </tr>
        </table>
    </td>
</tr>
