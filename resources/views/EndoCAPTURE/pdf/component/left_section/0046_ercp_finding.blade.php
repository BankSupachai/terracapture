<tr class="" style="line-height:{{ $body_line }};">
    <td>
        <span class="casetitle-small">FINDING :</span>
        {{-- @dd($casedata); --}}
    </td>

</tr>

@if (isset($casedata->{'Type of Major Ampulla'}))
    <tr style="line-height:10px; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Type of Major Ampulla:</span>
        </td>
        <td>
            @if (checknullblank($casedata, 'fidingmajor_other'))
                <span class="casetext-small"> {{ $casedata->fidingmajor_other }} </span>
            @endif
        </td>


    </tr>
@endif


@if (isset($casedata->Infundibulum))
    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Infundibulum : </span>
        </td>
        <td>


            @if (checknullblank($casedata, 'fidinginfund_other'))
                <span class="casetext-small"> {{ $casedata->fidinginfund_other }} </span>
            @endif
        </td>

    </tr>
@endif

@if (isset($casedata->{'Transverse duodenal hood'}))
    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Transverse duodenal hood : </span>
        </td>
        <td>
            @if (checknullblank($casedata, 'fidingtransverse_other'))
                <span class="casetext-small">{{ $casedata->fidingtransverse_other }} </span>
            @endif

        </td>


    </tr>
@endif

@if (isset($casedata->Diverticulum))
<tr style="line-height:{{ $body_line }}; ">
    <td width="45%">
        <span style="padding-left: 1em;" class="casetext-fiding-small"> Diverticulum: </span>
    </td>
        <td>
            {{-- @if (checknullblank($casedata, 'Diverticulum_other'))
                <span class="casetext-small">{{ @$casedata->Diverticulum_other }} O'clock of diverticulum edge</span>
            @endif --}}
            @if (checknullblank($casedata, 'fidingdiver_other'))
                <span class="casetext-small">{{ @$casedata->fidingdiver_other }} </span>
            @endif

        </td>

    </tr>
    @endif



@if (@$casedata->{'Periampullary mass'} == 'Yes')
<tr style="line-height:{{ $body_line }}; ">
    <td width="45%">
        <span style="padding-left: 1em;" class="casetext-fiding-small"> Periampullary: </span>
    </td>
        <td>
            <span class="casetext-small">
                @foreach (isset($casedata->Periampullarymassyes)? $casedata->Periampullarymassyes:[]  as $data)
                    @php
                        $print = true;

                    @endphp


                {{-- @dd($data) --}}
                    @if ($data == 'Biopsy was done')
                        Biopsy was done &ensp; {{ @$casedata->periampullary_biopsy }} Pieces
                        @php $print = false; @endphp
                    @endif

                    @if ($data == 'Defect closure by metallic clips')
                        Defect closure by metalic clips &ensp;{{ @$casedata->periampullary_defect }}
                        @php $print = false; @endphp
                    @endif

                    @if ($print)
                        {{ @$data }}
                    @endif
                    <br>
                @endforeach
                @if (isset($casedata->fidingperivaterian_other))
                <span class="casetext-small">{{@$casedata->fidingperivaterian_other}}</span>
            @endif
            </span>

        </td>

    </tr>

    @endif
