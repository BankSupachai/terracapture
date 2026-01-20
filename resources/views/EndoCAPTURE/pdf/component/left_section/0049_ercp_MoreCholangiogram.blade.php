{{-- @dd($casedata); --}}
{{-- @if (isset($casedata->dilator_balloon_select)) --}}
{{-- @if (isset($casedata->dilator_balloon_select))

@endif --}}
{{-- @if (isset($casedata->dilator_balloon_select)) --}}

    <tr style="line-height:10px; ">
        @if (isset($casedata->dilator_balloon_select) || checknullblank($casedata, 'dilator_other'))
            <td width="45%">
                <span style="padding-left: 1em;" class="casetext-fiding-small"> Dilator :</span>
            </td>
        @endif
        <td>
        @if (checknullblank($casedata, 'dilator_balloon_select'))
        @if(@$casedata->dilator_balloon_select."" != "0") <span class="casetext-small"> Balloon Dilator by   {{ @$casedata->dilator_balloon_select }}  </span> @endif
                @if (checknullblank($casedata, 'dilator_balloon_pos_text'))
                    <span class="casetext-small"> at {{ @$casedata->dilator_balloon_pos_text }}</span>
                @endif
                @if (checknullblank($casedata, 'dilator_balloon_pos_select'))
                    <span class="casetext-small"> size {{ @$casedata->dilator_balloon_pos_select }}</span>.
                @endif



        @endif


        @if (checknullblank($casedata, 'dilator_ihd_select'))
            @if(@$casedata->dilator_ihd_select."" != "0")  <span class="casetext-small"> IHD Dilator by  {{ @$casedata->dilator_ihd_select }} </span>@endif

            @if (checknullblank($casedata, 'dilator_ihd_pos'))
                <span class="casetext-small"> at {{ @$casedata->dilator_ihd_pos }}</span>
            @endif

            @if (checknullblank($casedata, 'dilator_ihd_pos_select'))
                <span class="casetext-small"> size {{ @$casedata->dilator_ihd_pos_select }}</span>.
            @endif

        @endif
        @if (checknullblank($casedata, 'dilator_other'))
            <span class="casetext-small"> {{ @$casedata->dilator_other }} </span>
        @endif
        </td>
    </tr>
{{-- @endif --}}

{{-- @if (isset($casedata->dilator_ihd_select))
    <tr style="line-height:{{ $body_line }}; ">
        <td width="50%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> </span>
        </td>
        <td>

        </td>
    </tr>
@endif --}}



{{-- @if (isset($casedata->balloon_extractor_select)) --}}
    <tr style="line-height:{{ $body_line }}; ">
        @if (isset($casedata->balloon_extractor_select)||checknullblank($casedata, 'extractor_other'))
            <td width="45%">
                <span style="padding-left: 1em;" class="casetext-fiding-small">Extractor :</span>
            </td>
        @endif
        <td>
            @if (checknullblank($casedata, 'balloon_extractor_select'))
            @if(@$casedata->balloon_extractor_select."" != "0")
            <span class="casetext-small">  {{ @$casedata->balloon_extractor_select }} </span>
            @endif
                @if (checknullblank($casedata, 'balloon_extractor_pos_select'))
                    <span class="casetext-small"> size {{ @$casedata->balloon_extractor_pos_select }}.</span>
                @endif
            @endif


    @if (checknullblank($casedata, 'spydswith_other'))
        @foreach ($casedata->extractor_ck as $data)
                @if ($data == 'spyDS')
                    <span class="casetext-small"> SpyDS with EHL {{ @$casedata->spydswith_other }} shots</span>
                @endif
        @endforeach
            @if (checknullblank($casedata, 'balloon_extractor_pos_select'))
                <span class="casetext-small"> size {{ @$casedata->balloon_extractor_pos_select }}</span>.
            @endif
    @endif


            @if (checknullblank($casedata, 'extractor_other'))
            <br> <span class="casetext-small"> {{ @$casedata->extractor_other }} </span>

            @endif


        </td>
    </tr>
{{-- @endif --}}

{{-- @if (isset($casedata->spydswith_other))
    <tr style="line-height:{{ $body_line }}; ">
        <td width="50%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"></span>
        </td>
        <td>
            @foreach ($casedata->extractor_ck as $data)
                @if ($data == 'spyDS')
                    <span class="casetext-small"> SpyDS with EHL {{ @$casedata->spydswith_other }} shots</span>
                @endif
            @endforeach




        </td>
    </tr>
@endif --}}

@if (isset($casedata->endobiliary))
    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Endobiliary RA :</span>
        </td>
        <td>
            <span class="casetext-small">
            @if (checknullblank($casedata, 'endobiliary'))
                @if ($casedata->endobiliary == 'Yes, at')
                {{ @$casedata->endobiliary }} {{@$casedata->endobiliary_pos}} {{@$casedata->endobiliary_watt}} Watt, {{@$casedata->endobiliary_mins}} Mins
                @else
                 No
                @endif
            @endif

            @if (checknullblank($casedata, 'endobiliaryRA_other'))
            <br> <span class="casetext-small"> {{ @$casedata->endobiliaryRA_other }} </span>

            @endif

        </span>
        </td>


    </tr>
@endif

{{-- @if (isset($casedata->CBDS)) --}}
    <tr style="line-height:{{ $body_line }}; ">
        @if (isset($casedata->CBDS) || checknullblank($casedata, 'CBDSClearance_other'))
            <td width="45%">
                <span style="padding-left: 1em;" class="casetext-fiding-small"> CBDS Clearance :</span>
            </td>
        @endif
        <td>
            <span class="casetext-small">
            @if (checknullblank($casedata, 'CBDS'))
                @if ($casedata->CBDS == 'Yes, at')
                {{ @$casedata->CBDS }} {{@$casedata->CBDSClearance_select}}

                @else
                 No
                @endif
            @endif


            @if (checknullblank($casedata, 'CBDSClearance_other'))
            <br> <span class="casetext-small"> {{ @$casedata->CBDSClearance_other }} </span>

            @endif
        </span>
        </td>


    </tr>
{{-- @endif --}}


@if (isset($casedata->complete_cholangiogram_other))
    <tr style="line-height:{{ $body_line }}; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Complete Cholangiogram :</span>
        </td>
        <td>
            @if (checknullblank($casedata, 'complete_cholangiogram_other'))
            <br> <span class="casetext-small"> {{ @$casedata->complete_cholangiogram_other }} </span>

            @endif

        </td>

    </tr>
@endif
