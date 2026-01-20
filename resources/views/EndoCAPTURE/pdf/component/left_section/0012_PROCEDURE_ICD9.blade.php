<tr style="line-height:{{$body_line}};" >
    <td class="vat" colspan="2">
        <span class="casetitle">PROCEDURE</span> <br>
        <label class="icd10text">
            @php
                $arr = array();
                $temp0 = $procedure->icd9 ?? [];
                foreach($temp0 as $k0=>$v0){
                    foreach ($v0 as $k1 => $v1) {
                        $arr[$v1['name']] = $v1['code'];
                    }
                }
            @endphp
                       @php
                $brCount = 0;
                $totalItems = count(isset($casedata->procedure_subtext) ? $casedata->procedure_subtext : []);
            @endphp
            @foreach (isset($casedata->procedure_subtext) ? $casedata->procedure_subtext : [] as $data)
                @if (!empty(trim($data)))
                    @if (array_key_exists($data, $arr))
                        {{ @$arr[$data] }} {{ $data }}
                        @if ($brCount < 5 && $totalItems > 1)
                            <br>
                        @endif
                        @php $brCount++; @endphp
                    @else
                        {{ $data }}
                        @if ($brCount < 5 && $totalItems > 1)
                            <br>
                        @endif
                        @php $brCount++; @endphp
                    @endif
                @endif
            @endforeach

            @isset($casedata->overall_procedure)
                <span class="icd10text">{!! nl2br(e($casedata->overall_procedure)) !!}</span>
            @else
                {{-- N/A --}}
            @endisset
        </label>
    </td>
</tr>
