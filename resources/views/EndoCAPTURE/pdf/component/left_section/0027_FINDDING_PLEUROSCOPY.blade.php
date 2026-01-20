{{-- @dd($casedata); --}}

<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td>
        <span class="casetitle">PLEUROSCOPIC FINDING:</span>
        @if(@$casedata->effusion_profile!=null)
        <span class="icd10textpluero"> <br>Pleural effusion appearance : </span>
            {{@$casedata->effusion_profile}} &nbsp;
        @endif
        @if(@$casedata->patient_position!=null)
        <span class="icd10textpluero"> <br>Patient position : </span>
            {{@$casedata->patient_position}} &nbsp;
        @endif
        @if((@$casedata->pleural_effusion_amount)!=null)
        <span class="icd10textpluero">amount :
            {{@$casedata->pleural_effusion_amount}} ml.&nbsp; </span><br>
        @endif

        @if((@$casedata->loculation_pleural)!=null)
        <span class="icd10textpluero">loculation :</span>

        @endif

        @if((@$casedata->loculation_pleural_txt)!=null)
        <span class="">{{@$casedata->loculation_pleural_txt}}</span><br>
        @endif

        @if((@$casedata->adhesion_pleural)!=null)
        <span class="icd10textpluero">adhesion :</span>
             &nbsp;
        @endif

        @if((@$casedata->adhesion_pleural_txt)!=null)
        <span class="icd10textpluero">{{@$casedata->adhesion_pleural_txt}}</span> <br>
        @endif

        @if((@$casedata->anterior_part)!=null)
        <span class="icd10textpluero">Anterior part of parietal pleura :
            {{@$casedata->anterior_part}} &nbsp;</span> <br>
            @if((@$casedata->anterior_part_txt)!=null) @endif
        @endif

        {{-- @if((@$casedata->anterior_part_txt)!=null)
        <span class="icd10textpluero">at Location {{@$casedata->anterior_part_txt}}</span> <br>
        @endif --}}

        @if((@$casedata->posterior_part)!=null)
        <span class="icd10textpluero">Posterior part of parietal pleura :
            {{@$casedata->posterior_part}} &nbsp;</span> <br>
            @if((@$casedata->posterior_part_txt)!=null)  @endif
        @endif

        {{-- @if((@$casedata->posterior_part_txt)!=null)
        <span class="icd10textpluero">at location {{@$casedata->posterior_part_txt}}</span>
        @endif --}}

        @if((@$casedata->medial_part)!=null)
        <span class="icd10textpluero">Medial part of parietal pleura :
            {{@$casedata->medial_part}} &nbsp;</span> <br>
            @if((@$casedata->medial_part_txt)!=null)  @endif
        @endif

        {{-- @if((@$casedata->medial_part_txt)!=null)
        <span class="icd10textpluero">at location {{@$casedata->medial_part_txt}}</span>
        @endif --}}

        @if((@$casedata->lateral_part)!=null)
        <span class="icd10textpluero">Lateral part of parietal pleura :
            {{@$casedata->lateral_part}} &nbsp;</span>  <br>
            @if((@$casedata->lateral_part_txt)!=null)  @endif
        @endif

        {{-- @if((@$casedata->lateral_part_txt)!=null)
        <span class="icd10textpluero">at location {{@$casedata->lateral_part_txt}}</span>
        @endif --}}

        @if((@$casedata->diaphragmatic)!=null)
        <span class="icd10textpluero">Diaphragmatic parietal pleura :
            {{@$casedata->diaphragmatic}} &nbsp;</span> <br>
            @if((@$casedata->diaphragmatic_txt)!=null)  @endif
        @endif
{{--
        @if((@$casedata->diaphragmatic_txt)!=null)
        <span class="icd10textpluero">at location {{@$casedata->diaphragmatic_txt}}</span>

        @endif --}}
        @if((@$casedata->visceral)!=null)
        <span class="icd10textpluero">Visceral pleura :
            {{@$casedata->visceral}} &nbsp;</span> <br>
            @if((@$casedata->visceral_txt)!=null) @endif
        @endif

        {{-- @if((@$casedata->visceral_txt)!=null)
        <span class="icd10textpluero">at location {{@$casedata->visceral_txt}}</span>
        @endif --}}

        @if((@$casedata->duration_of)!=null)
        <span class="icd10textpluero">Duration of procedure :
            {{@$casedata->duration_of}} </span>
        @endif

    </td>
</tr>
