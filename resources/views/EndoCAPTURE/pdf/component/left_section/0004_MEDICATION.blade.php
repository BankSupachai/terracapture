@php
use App\models\Mongo;
use MongoDB\BSON\ObjectID;
@endphp
{{-- <tr class=" set-font-family" style="line-height:{{$body_line}};">
    <td colspan="2">
        <span class="casetitle">MEDICATION :</span>
        <label class="casetext">
            @php
                // $mediwhere[]        = array('caseuniq',$casedata->caseuniq);
                // $tb_casemedication  = (object) Mongo::table('tb_casemedication')->where($mediwhere)->first();
                $caseuniq_obj               = new ObjectID($casedata->caseuniq);
                $caseuniq_str               = (string) $casedata->caseuniq;
                $tb_casemedication          = (object) Mongo::table('tb_casemedication')->where('caseuniq', $caseuniq_str)->orWhere('caseuniq', $caseuniq_obj)->first();
                $num_dose           = 0;
                if(isset($tb_casemedication->medication_unit)){
                    foreach ($tb_casemedication->medication_unit as $step01=>$step02) {
                        if(isset($step02['dose'])){
                            $num_dose = intval($step02['dose']) > 0 ? $num_dose + 1 : $num_dose;
                        }
                    }
                }
                $medi_select  = isset($tb_casemedication->select) ?  $tb_casemedication->select : [];
                $select  = is_array($medi_select) ? $medi_select : [];
            @endphp

            @if (@$tb_casemedication->medi_other."" == "" && $num_dose == 0 && count($select) == 0)
                N/A
            @else

                @if(isset($tb_casemedication->medication_unit))
                    @foreach ($tb_casemedication->medication_unit as $step01=>$step02)
                        @if(isset($step02['dose']))
                            {{@$step01}} {{@$step02['dose']}}{{@$step02['unit']}}<br>
                        @elseif(!isset($step02['dose']) && in_array($step01, $select))
                            {{@$step01}}<br>
                        @endif
                    @endforeach
                @elseif(!isset($tb_casemedication->medication_unit))
                    @if(isset($select))
                        @foreach ($select as $sel)
                            {{@$sel}}<br>
                        @endforeach
                    @endif
                @endif



                {{@$tb_casemedication->medi_other}}&nbsp;&nbsp;
                {{@$tb_casemedication->medi_otherdose}}&nbsp;&nbsp;
                {{@$tb_casemedication->medi_otherunit}}
            @endif


        </label>

    </td>
</tr>
 --}}

 <tr class=" set-font-family" style="line-height:8px;">
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
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @elseif($isLongWriting && $isColonoscopy)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                   @elseif($isLongWriting && $isEGD)
                <td style="width: 20%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @elseif($isLongWriting && $isEUS)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @elseif($isLongWriting)
                <td style="width: 22%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                 @elseif($isLiverBiopsy)
               <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                 @elseif($isBronchoscopy)
                <td style="width: 38%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @elseif($isEGD)
                <td style="width: 37%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @elseif($isERCP)
                <td style="width: 36%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @elseif($isEUS)
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @elseif($isColonoscopy)
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 5px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @else
                <td style="width: 40%; vertical-align: top; white-space: nowrap; padding-right: 43px;">
                    <span class="casetitle">MEDICATION :</span>
                </td>
                @endif
                <td style="width: 60%; vertical-align: top;">
                    @php
                        $marginTopValue = ($isEUS) ? '-5px' : '-5px';
                        $marginTopValue = ($isBronchoscopy) ? '-10px' : '-5px';
                    @endphp
                    <div style="margin-top: {{ $marginTopValue }};">
                        <span class="casetext">
                            @php
                                $mediOther          = @$casedata->medi_other;
                                $mediOtherDose      = @$casedata->medi_otherdose;
                                $medications        = $casedata->medication_unit ?? [];
                                $selectedMedi       = $casedata->select ?? [];
                                $isEmptyMediOther   = $mediOther == "" || $mediOther == "None Medication";
                                $isEmptyMediOtherDose = $mediOtherDose == "0" || $mediOtherDose == "";
                                $hasNoMedications     = count($selectedMedi) == 0;

                                $filteredMeds   = collect($medications)->filter(function($value){
                                    return !empty($value['dose']) && @$value['dose']."" != "0";
                                })->keys();
                                $uniqueMeds     = $filteredMeds->merge($selectedMedi)->unique();
                            @endphp

                            @if ($isEmptyMediOther && $isEmptyMediOtherDose && $hasNoMedications)
                                N/A
                            @else
                                @foreach ($uniqueMeds as $key)
                                    @php
                                        $dose = $medications[$key]['dose'] ?? '';
                                        $unit = !empty($medications[$key]['unit']) && !empty($dose) ? $medications[$key]['unit'] : '';
                                        $medi_text = "$key $dose $unit";
                                    @endphp
                                    {{ $medi_text }}<br>
                                @endforeach

                                @if (!$isEmptyMediOther)
                                    {{ $mediOther }}&nbsp;&nbsp;
                                @endif

                                @if (!$isEmptyMediOtherDose)
                                    {{ $mediOtherDose }}&nbsp;&nbsp;
                                @endif

                                @if (!$isEmptyMediOther && !$isEmptyMediOtherDose)
                                    {{ @$casedata->medi_otherunit }}
                                @endif
                            @endif
                        </span>
                    </div>
                </td>

            </tr>
        </table>
    </td>
</tr>



