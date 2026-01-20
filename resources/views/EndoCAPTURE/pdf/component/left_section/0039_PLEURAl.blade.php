
<tr style="line-height:{{$body_line}};" >
    <td >

        <span class="casetitle"> Pleural Fluid  Volume : </span>
        <span class="casetext">
            @if (@$casedata->pleuro_volume_text != '')
                {{@$casedata->pleuro_volume_text}} ML
            @endif
        </span>
    </td>
</tr>
<tr style="line-height:{{$body_line}};">
        <td>
            <span class="casetitle"> Color : </span>
            <span class="casetext">
                {{-- @dd($casedata) --}}
                {{-- ebus --}}
                @if (@$casedata->pleuro_color_yellowBox == 'true')
                yellow
                @endif
                @if (@$casedata->pleuro_color_redBox == 'true')
                red
                @endif
                @if (@$casedata->pleuro_color_blackBox == 'true')
                black
                @endif
                @if (@$casedata->pleru_color_othertext != '')
                    {{@$casedata->pleru_color_othertext}}
                @endif
            </span>
                {{--   EBUS guide-sheath--}}
            </td>

</tr>


<tr style="line-height:{{$body_line}};">
    <td>
        <span class="icd10textpluero">
            <span class="casetitle">FOR :</span>
            {{-- ebus --}}
            @if (@$casedata->pleuro_Cell_countBox == 'true')
            Cell count/Cell Differentiation
            @endif
            @if (@$casedata->pleuro_proteinBox == 'true')
            Protein
            @endif
            @if (@$casedata->pleuro_ldhBox == 'true')
            LDH
            @endif
            @if (@$casedata->pleuro_glucoseBox == 'true')
            Glucose
            @endif
            @if (@$casedata->pleuro_phBox == 'true')
            ph
            @endif
            @if (@$casedata->pleuro_cholesterolBox == 'true')
            Cholesterol
            @endif
            @if (@$casedata->pleuro_adaBox == 'true')
            ADA
            @endif

            @if (@$casedata->pleuro_genextpertBox == 'true')
            Genextpert
            @endif

            @if (@$casedata->pleuro_pcrfortbBox == 'true')
            PCR For TB
            @endif

            @if (@$casedata->pleuro_TriglycerideBox == 'true')
            Triglyceride
            @endif
            @if (@$casedata->pleuro_culturebacteriaBox == 'true')
            Culture Bacteria
            @endif

            @if (@$casedata->pleuro_culturefungusBox == 'true')
            Culture Fungus
            @endif

            @if (@$casedata->pleuro_culturetbBox == 'true')
            Culture TB
            @endif
            @if (@$casedata->pleuro_gramstrainBox == 'true')
            Gram STrain
            @endif
            @if (@$casedata->pleuro_wrightstrainBox == 'true')
            Wright STrain
            @endif
            @if (@$casedata->pleuro_MafbdataBox == 'true')
            Mafb DATB
            @endif
        </span>
    </td>
</tr>



{{-- @dd($casedata) --}}
<tr style="line-height:{{$body_line}};">
    <td>
        @if (@$casedata->pleurofiding_other != '')
            {{@$casedata->pleurofiding_other}}
        @endif
    </td>
</tr>
