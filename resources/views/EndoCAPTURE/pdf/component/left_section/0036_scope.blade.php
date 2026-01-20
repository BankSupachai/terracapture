@php
use App\Models\mongo;
@endphp

<tr class="set-font-family" style="line-height:{{$body_line}};">
    <td>
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                @php
                    $isLongWriting = (isset($type) && $type == 'long_writing') || (isset($pdftype) && $pdftype == 'long_writing') || (isset($casedata->pdftype) && $casedata->pdftype == 'long_writing');
                    $isColonoscopy = (isset($procedure) && $procedure->name == 'Colonoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Colonoscopy');
                    $isEGD = (isset($procedure) && $procedure->name == 'EGD') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EGD');
                    $isERCP = (isset($procedure) && $procedure->name == 'ERCP') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'ERCP');
                    $isEUS = (isset($procedure) && $procedure->name == 'EUS') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'EUS');
                    $isBronchoscopy = (isset($procedure) && $procedure->name == 'Bronchoscopy') || (isset($casedata->procedure_name) && $casedata->procedure_name == 'Bronchoscopy');
                    $liverBiopsyName = isset($procedure) && isset($procedure->name) ? trim($procedure->name) : (isset($casedata->procedure_name) ? trim($casedata->procedure_name) : '');
                    $isLiverBiopsy = !empty($liverBiopsyName) && strtolower(str_replace([' ', '_', '-'], '', $liverBiopsyName)) === 'liverbiopsy';
                @endphp
                @if($isLongWriting && $isERCP)
                <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                @elseif($isLongWriting && $isColonoscopy)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                @elseif($isLongWriting && $isEGD)
                <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                @elseif($isLongWriting)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                   @elseif($isEUS)
                <td style="width: 39%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                @elseif($isBronchoscopy)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                @elseif($isColonoscopy)
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                 @elseif($isLiverBiopsy)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>

                @elseif($isEGD)
                <td style="width: 37%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                @elseif($isERCP)
                <td style="width: 37%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                @else
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">ENDOSCOPE USED :</span>
                </td>
                @endif
                <td style="width: 60%; vertical-align: top;">
                    <div style="margin-top: -8px;">
                        <span class="casetext">
                            @foreach(isset($casedata->scope)?$casedata->scope:[] as $scope)
                                @php
                                    $sc = "";
                                    $sc_u = (object) Mongo::table('tb_scope')->where('scope_id',(int) $scope)->first();
                                    if(isset($sc_u->scope_name)){
                                        $sc = @$sc_u->scope_name.' SN '.@$sc_u->scope_serial." [".@$sc_u->scope_model."]";
                                    }else{
                                        $sc = $scope;
                                    }
                                @endphp
                                {!!$sc."<br>"!!}
                            @endforeach
                        </span>
                    </div>
                </td>

            </tr>
        </table>
    </td>
</tr>
