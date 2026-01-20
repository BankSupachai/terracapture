<tr class="lh-6 set-font-family">
    <td colspan="2">
        <span class="casetitle">MEDICATION :</span>
        <span class="casetext">
        @php
            $mediwhere[] = array('caseuniq',$casedata->caseuniq);
            $tb_casemedication  = Mongo::table('tb_casemedication')->where($mediwhere)->first();
        @endphp

        @foreach($anesthesis as $medi)
            @if(mediVALUE($medi->anesthesis_id,$tb_casemedication->medi_casejson) != '')
            {{$medi->anesthesis_name}} &nbsp; {{mediVALUE($medi->anesthesis_id,$tb_casemedication->medi_casejson)}} &nbsp; {{$medi->anesthesis_unit}}<br>
            @php
                $c_medi++;
            @endphp
            @endif
        @endforeach
        {{@$tb_casemedication->medi_other}} &nbsp;
        {{@$tb_casemedication->medi_otherdose}} &nbsp;
        {{@$tb_casemedication->medi_otherunit}}
        </span>
    </td>
</tr>
