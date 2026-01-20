<tr class="" style="line-height:{{ $body_line }};">
    <td>
        <span class="casetitle-small">SCOPE POSITION :</span>
        {{-- @dd($casedata); --}}
        @if(isset($casedata->{'Scope Position'}))
            {{-- @foreach ($casedata->{'Scope Position'} as $data) --}}

            <span class="casetext-small">{{implode(" , ", @$casedata->{'Scope Position'})}}</span>
            {{-- @endforeach --}}
        @endif


        @if (isset($casedata->scope_positionother))
        <span class="casetext-small">{{@$casedata->scope_positionother}}</span>
        @endif

        @if (isset($casedata->{'Scope Position'}) == '' && @$casedata->scope_positionother == '')
         <span class="casetext-small">N/A</span>
        @endif
    </td>
</tr>
{{-- @dd($casedata); --}}
