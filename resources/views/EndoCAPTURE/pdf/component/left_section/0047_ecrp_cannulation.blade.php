<tr class="" style="line-height:{{ $body_line }};">
    <td>
        <span class="casetitle-small">CANNULATION :</span>
        {{-- @dd($casedata); --}}
    </td>

</tr>

@if (isset($casedata->CBDCannulation))
<tr style="line-height:10px; ">
    <td width="45%">
        <span style="padding-left: 1em;" class="casetext-fiding-small"> CBD Cannulation :</span>
    </td>
    <td>
            @if (checknullblank($casedata, 'cannucbd_other'))
                <span class="casetext-small"> {{ @$casedata->cannucbd_other }} </span>
            @endif
        </td>


    </tr>

    @endif
    @if (isset($casedata->SuccessCBDCannulation ))

    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Success CBD Cannulation : </span>
        </td>
        <td>
                @if (checknullblank($casedata, 'canusuccess_other'))
                    <span class="casetext-small"> {{ @$casedata->canusuccess_other }} </span>
                @endif
        </td>

    </tr>
    @endif

    @if (isset($casedata->CBDcannulationby))
<tr style="line-height:{{ $body_line }}; ">
    <td width="45%">
        <span style="padding-left: 1em;" class="casetext-fiding-small"> CBD cannulation by : </span>
    </td>
        <td>
                @if (checknullblank($casedata, 'fidingcbdby_other'))
                    <span class="casetext-small">{{ @$casedata->fidingcbdby_other }} </span>
                @endif

        </td>


</tr>
@endif

@if (isset($casedata->CannulationTechnique))
<tr style="line-height:{{ $body_line }}; ">
    <td width="45%">
        <span style="padding-left: 1em;" class="casetext-fiding-small"> Cannulation Technique : </span>
    </td>
        <td>

            @if (checknullblank($casedata, 'fidingcbdtech_other'))
                <span class="casetext-small">{{ @$casedata->fidingcbdtech_other }} </span>
            @endif

        </td>

    </tr>
    @endif

    @if (isset($casedata->cannuguidewire))

    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Type of Guidewire : </span>
        </td>
        <td>

                @foreach ($casedata->cannuguidewire as $data)
                <span class="casetext-small">{{ $data['type'] }} {{ $data['size'] }} <br></span>

                @endforeach

                @if (checknullblank($casedata,'guidewire_typeother'))
                <span class="casetext-small">{{$casedata->guidewire_typeother }} {{ $casedata->guidewire_sizeother }} <br></span>

                @endif

        </td>
    </tr>
    @endif


    @if (isset($casedata->canlulaguideinfo_other))
    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Selective guide wire manipulation into : </span>
        </td>
        <td>

            @if (checknullblank($casedata, 'canlulaguideinfo_other'))
            <span class="casetext-small">{{ @$casedata->canlulaguideinfo_other }} </span>
        @endif


        </td>

    </tr>
    @endif



    @if (isset($casedata->cannubileaspiration_other))
    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Bileaspiration : </span>
        </td>
        <td>

            @if (checknullblank($casedata, 'cannubileaspiration_other'))
            <span class="casetext-small">{{ @$casedata->cannubileaspiration_other }} </span>
        @endif


        </td>

    </tr>
    @endif

    @if (isset($casedata->cannubiletype_other))

    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Type of contrast : </span>
        </td>
        <td>

            @if (checknullblank($casedata, 'cannubiletype_other'))
            <span class="casetext-small">{{ @$casedata->cannubiletype_other }} </span>
        @endif


        </td>

    </tr>
    @endif
    {{-- @dd($casedata); --}}
    @if (isset($casedata->cannubile_other))

    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Previous stent removal : </span>
        </td>
        <td>

            @if (checknullblank($casedata, 'cannubile_other'))
            <span class="casetext-small">{{ @$casedata->cannubile_other }} </span>
        @endif


        </td>

    </tr>

    @endif
