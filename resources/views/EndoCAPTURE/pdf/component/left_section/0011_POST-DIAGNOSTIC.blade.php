
<tr style="line-height: 8px;">
    <td colspan="2">
        <span class="casetitle">POST-DIAGNOSTIC (ICD-10)</span>
        <br>
        <label class="icd10text">
            @php
                $nonepost = 0;

                $arr = array();
                $temp0 = $procedure->icd10 ?? [];
                foreach($temp0 as $k0=>$v0){
                    foreach ($v0 as $k1 => $v1) {
                        $arr[$v1['name']] = $v1['code'];
                    }
                }
            @endphp



            @foreach (isset($casedata->diagnostic_text)?$casedata->diagnostic_text:[] as $data)
                @isset($data)
                    @if (array_key_exists($data,$arr))
                        {{@$arr[$data]}} {{$data}}<br>
                    @else
                        {{$data}}<br>
                    @endif



                    @php
                        $nonepost++;
                    @endphp
                @endisset
            @endforeach

            @isset($casedata->overall_diagnosis)
                @if(gettype($casedata->overall_diagnosis) == 'string')
                    <span class="icd10textdark">{!!nl2br($casedata->overall_diagnosis)!!}</span>
                @endif
            @else

                {{-- N/A --}}
            @endisset

        </label>
    </td>
</tr>







