
<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td colspan="2">
        <span class="casetitle">PROCEDURE :</span>

        @if(mevalue(@$casedata,['finding_as_above_cystonum','cystoscope_was_done_with_sheath_cysto','finding_as_above_cysto']))
        <br>
        Rigid cystoscopy
            <br>
            - Cystoscope was done with sheath
             <span class="findtitle">{{@@$casedata->cystoscope_was_done_with_sheath_cysto}}</span> length <span class="findtitle">{{@@$casedata->length_procedure_cysto}}</span> cm.
            <br>
           - Finding as above <span class="findtitle">{{@$casedata->finding_as_above_cysto}}</span>
            @if(@@$casedata->finding_as_above_cystonum!="")
            <span class="findtitle">{{@@$casedata->finding_as_above_cystonum}}</span> cm.
            @endif
        @endif


        {{-- @if(mevalue(@$casedata,['cystoscope_was_done_with_sheath_cysto']))
            <br>- Cystoscope was done with sheath <span class="findtitle">{{@@$casedata->cystoscope_was_done_with_sheath_cysto}}</span> length <span class="findtitle">{{@@$casedata->length_procedure_cysto}}</span> cm.
        @endif

        @if(mevalue(@$casedata,['cystoscope_was_done_with_sheath_cysto']))
            <br>- Cystoscope was done with sheath <span class="findtitle">{{@@$casedata->cystoscope_was_done_with_sheath_cysto}}</span>
        @endif --}}

        @if(mevalue(@$casedata,['cystolitholapraxy_cysto','length2_procedure_cysto']))
            <br>- Cystolitholapraxy was done with sheath <span class="findtitle">{{@$casedata->cystolitholapraxy_cysto}}</span> length <span class="findtitle">{{@@$casedata->length2_procedure_cysto}}</span> cm.
        @endif
        @if(mevalue(@$casedata,['cysto_serial','cysto_serial']))
        <br>Flexible cystoscopy (Serial no.)
        <span class="findtitle">{{@$casedata->cameraname}}</span>
        @endif
        {{-- @if(mevalue(@$casedata,['cystolitholapraxy_cysto','length2_procedure_cysto']))
            <br>- Cystolitholapraxy was done with sheath <span class="findtitle">{{@@$casedata->cystolitholapraxy_cysto}}</span>
        @endif --}}

        @if(mevalue(@$casedata,['urethra_was_dilated_cysto']))
            <br>- Urethra was dilated with sound dilator <span class="findtitle">{{@$casedata->urethra_was_dilated_cysto}}</span>
        @endif

        @if(mevalue(@$casedata,['forley_cath_cysto','forley_cath_cystonum']))
            <br>- Forley cath <span class="findtitle">{{@$casedata->forley_cath_cysto}}</span>
            @if(@@$casedata->forley_cath_cysto=="two way")
            <span class="findtitle">two way</span>
            @endif

            @if(@@$casedata->forley_cath_cysto=="three way")
            <span class="findtitle">three way {{@$casedata->forley_cath_cystonum}}</span> was replaced
            @endif

            @if(@@$casedata->forley_cath_cysto=="SPC")
            <span class="findtitle">SPC</span>
            @endif

            @if(@@$casedata->forley_cath_cysto=="Forley cath#")
            <span class="findtitle">Forley cath# {{@$casedata->forley_cath_cysto}}</span>
            @endif
        {{-- @dd($casedata) --}}
            @if(@@$casedata->forley_cath_cysto=="Four wiring#")
            <span class="findtitle">Four wiring# {{@$casedata->forley_cath_cystonum}}</span> was replaced
            @endif
        @endif

        <br>
            -
           <span >{!!without_tagP(@$casedata->case_freetext)!!}</span>

        @if(@@$casedata->cystoscope_was_done_with_sheath_cysto=="" && @@$casedata->length_procedure_cysto=="" && @@$casedata->finding_as_above_cysto==""
        && @@$casedata->finding_as_above_cystonum=="" && @@$casedata->cystolitholapraxy_cysto=="" && @@$casedata->length2_procedure_cysto==""
        && @@$casedata->urethra_was_dilated_cysto=="" && @@$casedata->forley_cath_cysto=="" && @@$casedata->forley_cath_cystonum==""
        && @@$casedata->case_freetext=="")
            <span class="casetext">None<br></span>
        @endif
    </td>
</tr>
