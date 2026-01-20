
<tr style="line-height: 0px;" >
    <td colspan="2"><span class="casetitle-small">ANESTHESIA :</span>
        <span class="casetext-small">
            @php
                $noneval = 0;
                $nonevalother = 0;
            @endphp


            {{implode(' , ', isset($casedata->anesthesia)? $casedata->anesthesia:[])}};
            @php
                $noneval++;
            @endphp
            {{-- @foreach(isset($casedata->anesthesia)?$casedata->anesthesia:[] as $data)
                {{$data}}
                @php
                    $noneval++;
                @endphp
            @endforeach --}}

            @isset($casedata->anesthesiaother)
            {{$casedata->anesthesiaother}}
            @php
            $nonevalother++;
        @endphp
            @endisset

            @if($noneval==0 && $nonevalother == 0 )
                N/A
            @endif
        </span>
    </td>
</tr>

