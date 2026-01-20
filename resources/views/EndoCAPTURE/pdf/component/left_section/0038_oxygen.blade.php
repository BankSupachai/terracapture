@php
    $none_oxygen = true;
@endphp

<tr style="line-height:{{ $body_line }};" class="set-font-family">
    <td colspan="2"><span class="casetitle">Oxygen :</span>
        <span class="casetext">
            {{-- @dd($casedata) --}}
            @if (@$casedata->oxygen_nasaicannula_box == 'true')
                O2 Nasal Cannula : {{ @$casedata->oxygen_nasaicannula }}
                @php
                    $none_oxygen = false;
                @endphp
                @if (@$casedata->oxygen_nasaicannula != '')
                    LPM<br>
                @endif
            @endif
            @if (@$casedata->oxygen_maskwithbag_box == 'true')
                O2 Mask With Bag : {{ @$casedata->oxygen_maskwithbag }}
                @php
                    $none_oxygen = false;
                @endphp

                @if (@$casedata->oxygen_maskwithbag != '')
                    LPM<br>
                @endif
            @endif

            @if (@$casedata->oxygen_highflownasaicannula_box == 'true')
                High Flow Nasal Cannula : {{ $casedata->oxygen_highflownasaicannula }}
                @php
                    $none_oxygen = false;
                @endphp
                @if (@$casedata->oxygen_highflownasaicannula != '')
                    LPM <br>
                @endif
                @if (@$casedata->oxygen_andfio2 != '')
                    &ensp; And FiO2 : {{ $casedata->oxygen_andfio2 }}
                    @php
                        $none_oxygen = false;
                    @endphp
                @endif
            @endif




            @if (@$casedata->oxygen_thriveflow_box == 'true')
                THRIVE Flow : {{ @$casedata->oxygen_thriveflow }}
                @php
                    $none_oxygen = false;
                @endphp
                @if (@$casedata->oxygen_thriveflow != '')
                    LPM<br>
                @endif
            @endif
            @if (@$casedata->oxygen_ettube_box == 'true')
                ET-Tube <br>
                @php
                    $none_oxygen = false;
                @endphp
                @if (@$casedata->oxygen_tracheostomy_box == 'true')
                    Tracheostomy : <br>
                    @php
                        $none_oxygen = false;
                    @endphp
                @endif
            @endif
            @if (@$casedata->oxygen_other != '')
                {{ @$casedata->oxygen_other }}
                @php
                    $none_oxygen = false;
                @endphp
            @endif
            @if (@$none_oxygen)
                N/A
            @endif
        </span>
    </td>
</tr>
