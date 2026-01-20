@php
use App\models\Mongo;
use MongoDB\BSON\ObjectID;
@endphp
<tr class="" style="line-height:2px;">
    <td colspan="2">
        <span class="casetitle-small">MEDICATION :</span>
        <label class="casetext-small">
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
                            {{@$step01}},
                        @endif
                    @endforeach
                @elseif(!isset($tb_casemedication->medication_unit))
                    @if(isset($select))
                        @foreach ($select as $sel)
                            {{@$sel}},
                        @endforeach
                    @endif
                @endif



                {{@$tb_casemedication->medi_other}}&nbsp;&nbsp;
                {{@$tb_casemedication->medi_otherdose}}
                {{@$tb_casemedication->medi_otherunit}}
            @endif


        </label>

    </td>
</tr>

