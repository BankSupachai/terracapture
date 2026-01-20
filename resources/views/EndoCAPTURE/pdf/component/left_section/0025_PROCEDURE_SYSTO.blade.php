<tr class="set-font-family">
    <td>
        <span class="casetitle">PROCEDURE :</span>
        @if (
            @$json->cystoscope_was_done_with_sheath_cysto != '' &&
                @$json->length_procedure_cysto != '' &&
                @$json->finding_as_above_cysto != '')
            <br>- Cystoscope was done with sheath <span
                class="findtitle">{{ @$json->cystoscope_was_done_with_sheath_cysto }}</span> length <span
                class="findtitle">{{ @$json->length_procedure_cysto }}</span> cm.
            finding as above <span class="findtitle">{{ @$json->finding_as_above_cysto }}</span>
            @if (@$json->finding_as_above_cystonum != '')
                <span class="findtitle">{{ @$json->finding_as_above_cystonum }}</span> cm.
            @endif
        @endif


        @if (
            @$json->cystoscope_was_done_with_sheath_cysto != '' &&
                @$json->length_procedure_cysto != '' &&
                @$json->finding_as_above_cysto == '')
            <br>- Cystoscope was done with sheath <span
                class="findtitle">{{ @$json->cystoscope_was_done_with_sheath_cysto }}</span> length <span
                class="findtitle">{{ @$json->length_procedure_cysto }}</span> cm.
        @endif


        @if (
            @$json->cystoscope_was_done_with_sheath_cysto != '' &&
                @$json->length_procedure_cysto == '' &&
                @$json->finding_as_above_cysto == '')
            <br>- Cystoscope was done with sheath <span
                class="findtitle">{{ @$json->cystoscope_was_done_with_sheath_cysto }}</span>
        @endif


        @if (@$json->cystolitholapraxy_cysto != '' && @$json->length2_procedure_cysto != '')
            <br>- Cystolitholapraxy was done with sheath <span
                class="findtitle">{{ @$json->cystolitholapraxy_cysto }}</span> length <span
                class="findtitle">{{ @$json->length2_procedure_cysto }}</span> cm.
        @endif


        @if (@$json->cystolitholapraxy_cysto != '' && @$json->length2_procedure_cysto == '')
            <br>- Cystolitholapraxy was done with sheath <span
                class="findtitle">{{ @$json->cystolitholapraxy_cysto }}</span>
        @endif


        @if (@$json->urethra_was_dilated_cysto != '')
            <br>- Urethra was dilated with sound dilator <span
                class="findtitle">{{ @$json->urethra_was_dilated_cysto }}</span>
        @endif


        @if (@$json->forley_cath_cysto != '' || @$json->forley_cath_cystonum != '')
            <br>- Forley cath
            @if (@$json->forley_cath_cysto == 'two way')
                <span class="findtitle">two way</span>
            @endif

            @if (@$json->forley_cath_cysto == 'three way')
                <span class="findtitle">three way {{ @$json->forley_cath_cystonum }}</span> was replaced
            @endif

            @if (@$json->forley_cath_cysto == 'SPC')
                <span class="findtitle">SPC</span>
            @endif

            @if (@$json->forley_cath_cysto == 'Forley cath#')
                <span class="findtitle">Forley cath# {{ @$json->forley_cath_cystonum }}</span>
            @endif

            @if (@$json->forley_cath_cysto == 'Four wiring#')
                <span class="findtitle">Four wiring# {{ @$json->forley_cath_cystonum }}</span> was replaced
            @endif
            <br>
        @endif


        @if (@$json->overall_procedure != '' && @$json->overall_procedure != null)
            <span class="casetext">{!! @$json->overall_procedure !!}</span>
        @endif

        <br>
    </td>
</tr>
