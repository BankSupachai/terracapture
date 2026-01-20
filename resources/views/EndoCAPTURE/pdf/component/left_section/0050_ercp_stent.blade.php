

<tr style="line-height:5px;">
    <td width="20%">
        <span class="casetitle-small text-nowrap">STENTING : </span>
    </td>
    {{-- @if (checknullblank($casedata, ['plasticstent'])) --}}
    {{-- @if (isset($casedata->CBDCannulation)) --}}
   {{-- @dd($casedata) --}}

    @if (isset($casedata->plasticstent))
<tr style="line-height:10px; ">
    @if(checknullblank($casedata, 'plasticstent')  || (checknullblank($casedata,'plasticstentunit_other')))
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Biliary Stenting (Plastic) :</span>
        </td>
    @endif
    <td>
        @if (checknullblank($casedata, 'plasticstent'))
            @foreach ($casedata->plasticstent as $key => $value)
                @if ($value['fr'] != '' || $value['cm'] != '' || $value['pos'] != '' || $value['with'] != '')
                    <span class="casetext-small">
                     {{ @$value['type'] }} {{ @$value['fr'] }} @if(@$value['fr'] != "") Fr @endif {{ @$value['cm'] }} @if(@$value['cm'] != "") cm. @endif @if(@$value['pos'] != "") at @endif
                        {{ @$value['pos'] }}<br>
                @endif
            @endforeach
        @endif

        @if (checknullblank($casedata,'plasticstentunit_other'))
        <span class="casetext-small">
            {{ @$casedata->plasticstentunit_other }}  {{ @$casedata->plasticstentdm_other    }} @if(@$casedata->plasticstentdm_other != "") Fr @endif
            {{ @$casedata->plasticstentcm_other   }} @if(@$casedata->plasticstentcm_other != "") cm. @endif @if(@$casedata->plasticstentpos_other != "") at @endif {{ @$casedata->plasticstentpos_other     }}
        </span>

        @endif


    </td>
</tr>
@endif
@if (isset($casedata->metallicstent))
    <tr style="line-height:10px; ">

        @if(checknullblank($casedata, 'metallicstent') || (checknullblank($casedata,'metallicstentunit_other')))
            <td width="45%">
                <span style="padding-left: 1em;" class="casetext-fiding-small"> Biliary Stenting (Metalic) :</span>
            </td>
        @endif
        <td>

            @if (checknullblank($casedata, 'metallicstent') )
                @foreach ($casedata->metallicstent as $key => $value)
                    @if ($value['fr'] != '' || $value['cm'] != '' || $value['pos'] != '' || $value['with'] != '')
                        <span class="casetext-small">

                         {{ @$value['type'] }} {{ @$value['fr'] }} @if(@$value['fr'] != "") Fr @endif {{ @$value['cm'] }} @if(@$value['cm'] != "") mm. @endif @if(@$value['pos'] != "") at @endif {{ @$value['pos'] }} @if(@$value['with'] != "") with @endif {{ @$value['with'] }}</span> <br>
                    @endif
                @endforeach
            @endif

            @if (checknullblank($casedata,'metallicstentunit_other'))
               <span class="casetext-small">
                   {{ @$casedata->metallicstentunit_other  }}  {{ @$casedata->metallicstentdm_other  }} @if(@$casedata->metallicstentdm_other != "") Fr @endif
                    {{ @$casedata->metallicstentcm_other  }} @if(@$casedata->metallicstentcm_other != "") mm. @endif @if(@$casedata->metallicstentpos_other != "") at @endif {{ @$casedata->metallicstentpos_other   }} @if(@$casedata->metallicstent_select != "") with @endif {{ @$casedata->metallicstent_select }}
                </span>
            @endif
        </td>
    </tr>
@endif


@if (isset($casedata->pancreaticstent))

    <tr style="line-height:10px; ">
        <td width="45%">
            <span style="padding-left: 1em;" class="casetext-fiding-small"> Pancreatic Stenting :</span>
        </td>
        <td>
            {{-- @dd($casedata); --}}
            @if (checknullblank($casedata, 'pancreaticstent'))
                {{-- @foreach ($casedata->pancreaticstent as $key => $value)
            @endforeach --}}
                <span class="casetext-small">

                    @if (@$casedata->prophylactic_select . '' != '')
                        Prophylactic at {{ @$casedata->prophylactic_select }} <br>
                    @endif
                    @if (@$casedata->therapeutic_select . '' != '')
                        Therapeutic at {{ @$casedata->therapeutic_select }} <br>
                    @endif
                    @if (@$casedata->unflanged_select . '' != '')
                    {{-- @if (@$casedata->pancreaticste == 'Unflanged type') --}}
                        Unflanged type at {{ @$casedata->unflanged_select }} <br>
                    @endif
                    @if (@$casedata->flanged_select . '' != '')
                        Flanged type at {{ @$casedata->flanged_select }} <br>
                    @endif


                    @if (isset($casedata->singlepigtail[0]))
                        {{-- @dd($casedata); --}}
                        Single pigtail {{ @$casedata->singlepigtail[0]['fr'] }} @if(@$casedata->singlepigtail[0]['fr'] != "") Fr @endif
                        {{ @$casedata->singlepigtail[0]['cm'] }} @if(@$casedata->singlepigtail[0]['cm'] != "") cm @endif @if(@$casedata->singlepigtail[0]['pos'] != "") at @endif {{ @$casedata->singlepigtail[0]['pos'] }} <br>
                    @endif
                    @if (isset($casedata->straightstent[0]))
                        Straight stent {{ @$casedata->straightstent[0]['fr'] }} @if(@$casedata->straightstent[0]['fr'] != "") Fr @endif
                        {{ @$casedata->straightstent[0]['cm'] }} @if(@$casedata->straightstent[0]['cm'] != "") cm @endif @if(@$casedata->straightstent[0]['pos'] != "") at @endif {{ @$casedata->straightstent[0]['pos'] }} <br>
                    @endif
                    @if (isset($casedata->doublepigtail[0]))
                        Double pigtail {{ @$casedata->doublepigtail[0]['fr'] }} @if(@$casedata->doublepigtail[0]['fr'] != "") Fr @endif
                        {{ @$casedata->doublepigtail[0]['cm'] }} @if(@$casedata->doublepigtail[0]['cm'] != "") cm @endif @if(@$casedata->doublepigtail[0]['pos'] != "") at @endif {{ @$casedata->doublepigtail[0]['pos'] }} <br>
                    @endif
                    @if (isset($casedata->pancreaticstentunit_other))
                        {{@$casedata->pancreaticstentunit_other}} {{@$casedata->pancreaticstentdm_other}} @if(@$casedata->pancreaticstentdm_other != "") Fr @endif {{@$casedata->pancreaticstentcm_other}} @if(@$casedata->pancreaticstentcm_other != "") cm @endif @if(@$casedata->pancreaticstentpos_other != "") at @endif  {{@$casedata->pancreaticstentpos_other}}
                    @endif
                </span>

            @endif




        </td>
    </tr>

@endif






</tr>
