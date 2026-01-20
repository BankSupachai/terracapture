<style>
    .cnt{align-self: center;}
</style>
@php
    if (!function_exists('bronchogroup')) {
        function bronchogroup($case, $group, $name, $text)
        {
            $box = box(@$case->$name);
            $html = "<div class='col-2 cnt'>
                        <input $box
                            id      = '$name'
                            name    = '$name'
                            type    = 'checkbox'
                            class   = 'form-check-input  savejson ebush'
                            subis   = '$group'>&emsp;
                        <label for='$name'><b for='ebus'>$text</b></label>
                    </div>";
            return $html;
        }
    }

    if (!function_exists('bronchotext')) {
        function bronchotext($case, $group, $before, $name, $text, $after, $col)
        {
            $text = @$case->$name;
            $html = "<div class='col-1 cnt $group' ><b>$before</b></div>

                    <div class='col-$col  cnt $group'>
                        <input
                            id      = '$name'
                            type    = 'text'
                            name    = '$name'
                            class   = 'form-control  savejson autotext mt-2'
                            value   = '$text'
                            autocomplete='off'
                        >
                    </div>

                    <div class='col-1 cnt $group'><b>$after</b></div>";
            return $html;
        }
    }

    if (!function_exists('bronchobox')) {
        function bronchobox($case, $group, $name, $text)
        {
            $box = box(@$case->$name);
            $html = "<div class='col-2 cnt text-nowrap $group'>
                        <input  type='checkbox' $box
                                class='form-check-input savejson'
                                id='$name'
                                name='$name'>
                        <label for='$name'>
                            <b for='$name'>&emsp;$text</b>
                        </label>
                    </div>";
            return $html;
        }
    }

    if (!function_exists('bronchoradiobox')) {
        function bronchoradiobox($case, $group, $name,  $text , $value)
        {
            $box = box(@$case->$name);
            $checked = '' ;
            if (@$case->$name == $value) {
                $checked    = 'checked';
            }

            $html = "<div class='col-2 cnt text-nowrap $group'>
                        <input  type='radio' $box
                                class='form-check-input saveradio'
                                id='$name$text'
                                name='$name'
                                value='$value'
                                $checked>

                        <label for='$name$text'>
                            <b for='$name'>&emsp;$value</b>
                        </label>
                    </div>";
            return $html;
        }
    }
@endphp
<link rel="stylesheet" href="{{ url('public/css/component/broncho.css') }}">
<div class="col-12">
    {!! editcard('broncho', 'broncho.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">

            <b>PROCEDURE (ICD-9)</b><br><br>
            <div class="row">
                {!! bronchogroup($case, 'ebuss', 'ebus_box', 'EBUS') !!}
                {!! bronchotext($case, 'ebuss', '', 'ebus', '', '', 3) !!}
                {!! bronchotext($case, 'ebuss', 'Distance (cm)', 'distance_ebus', '', '', 3) !!}
                {!! bronchotext($case, 'ebuss', 'Time(min)', 'time_ebus', '', '', 3) !!}
                <hr class="ebuss mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'ebusg', 'ebus_guide_sheath_box', 'EBUS guide-sheath') !!}
                {!! bronchotext($case, 'ebusg', '', 'ebus_guide_sheath', '', '', 3) !!}
                {!! bronchotext($case, 'ebusg', 'Time', 'time_ebus_guide_sheath', '', 'min.', 3) !!}
                <hr class="ebusg mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'flu', 'fluoroscopy_box', 'Fluoroscopy') !!}
                {!! bronchotext($case, 'flu', '', 'fluoroscopy', '', '', 3) !!}
                <hr class="flu mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'autof', 'autofluoresence_box', 'Autofluoresence') !!}
                {!! bronchobox($case, 'autof', 'negative_autoflu_box', 'Negative') !!}
                {!! bronchobox($case, 'autof', 'positive_autoflu_box', 'Positive at') !!}
                {!! bronchotext($case, 'autof', '', 'positive_autoflu', '', '', 3) !!}
                <hr class="autof mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'vtlbr', 'virtual_bronchoscopy_box', 'Virtual bronchoscopy') !!}
                {!! bronchotext($case, 'vtlbr', 'Generation by CT navigation', 'Generation_by_CT_navigation', '', '', 3) !!}
                {!! bronchotext($case, 'vtlbr', 'Generation by CT bronchoscopy', 'Generation_by_bronchoscopy', '', '', 3) !!}
                <hr class="vtlbr mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'bcwa', 'Bronchial_Washing_site_box', 'Bronchial Washing at') !!}
                {!! bronchotext($case, 'bcwa', '', 'Bronchial_Washing_site', '', '', 3) !!}
                <hr class="bcwa mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'bclvl', 'Bronchoalveolar_Lavage_site_box', 'Bronchoalveolar Lavage at') !!}
                {!! bronchotext($case, 'bclvl', '', 'Bronchoalveolar_Lavage_site', '', '', 3) !!}
                {!! bronchotext($case, 'bclvl', 'Segment', 'Bronchoalveolar_segment', '', '', 3) !!}
                {!! bronchotext($case, 'bclvl', 'Instilled volume', 'Instilled_volume', '', 'ml.', 2) !!}
                {!! bronchotext($case, 'bclvl', 'Retrived volume', 'Retrived_volume', '', 'ml.', 2) !!}
                {!! bronchotext($case, 'bclvl', 'Appearance', 'Bronchoalveolar_appearance', '', '', 2) !!}

                <div class="row">
                    {!! bronchobox($case, 'bclvl', 'cell_count_and_differential_count_box', 'Cell count and differential count') !!}
                    {!! bronchobox($case, 'bclvl', 'hemosiderin_score_box', 'Hemosiderin score') !!}
                    {!! bronchobox($case, 'bclvl', 'grams_stain_and_culture_for_bacteria_box', 'Grams stain',) !!}
                    {!! bronchobox($case, 'bclvl', 'wraight_stain', 'Wright stain',) !!}
                </div>
                <div class="row">
                    {!! bronchobox($case, 'bclvl', 'modified_afb_box', 'Modified AFB') !!}
                    {!! bronchobox($case, 'bclvl', 'afb_profile1_box', 'AFB') !!}
                    {!! bronchobox($case, 'bclvl', 'giemsa_stain_box', 'Giemsa stain') !!}
                    {!! bronchobox($case, 'bclvl', 'gms_stain_box', 'GMS stain') !!}
                </div>
                <div class="row">
                    {!! bronchobox($case, 'bclvl', 'fresh_smear_for_parasite', 'Fresh smear for parasite') !!}
                    {!! bronchobox($case, 'bclvl', 'culture_for_bacteria', 'Culture for bacteria') !!}
                    {!! bronchobox($case, 'bclvl', 'culture_for_fungus', 'Culture for fungus') !!}
                    {!! bronchobox($case, 'bclvl', 'culture_for_tb_box', 'Culture for TB') !!}
                </div>
                <div class="row">
                    {!! bronchobox($case, 'bclvl', 'ifa_for_pcp_box', 'IFA for PCP') !!}
                    {!! bronchobox($case, 'bclvl', 'pcr_for_pcp_box', 'PCR for PCP') !!}
                    {!! bronchobox($case, 'bclvl', 'PCR_TB_tb_box', 'PCR for TB') !!}
                    {!! bronchobox($case, 'bclvl', 'PCR_TB_ntm_box', 'PCR for NTM') !!}
                    {!! bronchobox($case, 'bclvl', 'gene_x_pert_box', 'Gene-Xpert') !!}

                </div>
                <div class="row">
                    {!! bronchobox($case, 'bclvl', 'PCR_TB_influenza_box', 'PCR for Influenza') !!}
                    {!! bronchobox($case, 'bclvl', 'galactomannan_box', 'Galactomannan') !!}
                    {!! bronchobox($case, 'bclvl', 'pcr_for_cmv_quantitative_box', 'PCR for CMV quantitative') !!}
                    {!! bronchobox($case, 'bclvl', 'pcr_for_hsv_box', 'PCR for HSV') !!}
                    {!! bronchobox($case, 'bclvl', 'Cytology_bcba_box', 'Cytology') !!}

                </div>
                {!! bronchobox($case, 'bclvl', 'Other_hsv_box', 'Other') !!}
                {!! bronchotext($case, 'bclvl', '', 'Other_hsv', '', '', 3) !!}
                <hr class="bclvl mt-2">
            </div>
            <div class="row">
                {!! bronchogroup($case, 'tblb', 'TBLB_box', 'TBLB at ') !!}
                {!! bronchotext($case, 'tblb', '', 'TBLB', '', '', 3) !!}
                {!! bronchotext($case, 'tblb', 'Segment', 'TBLB_segment', '', '', 3) !!}
                <div class="row">

                {!! bronchotext($case, 'tblb', 'Specimen', 'TBLB_specimen', '', 'pieces', 3) !!}

                </div>
                <div class="row  " style="place-content: center;">
                    {!! bronchobox($case, 'tblb', 'Histopathology_TBLB_box', 'Histopathology') !!}
                    {!! bronchobox($case, 'tblb', 'Tissue_culture_for_bacteria_TBLB_box', 'Tissue culture for bacteria') !!}
                    {!! bronchobox($case, 'tblb', 'Mycobacteria_Profile1_TBLB_box', 'Mycobacteria (Profile 1)') !!}
                    {!! bronchobox($case, 'tblb', 'Mycobacteria_Profile2_TBLB_box', 'Mycobacteria (Profile 2)') !!}
                    {!! bronchobox($case, 'tblb', 'Tissue_culture_for_fungus_TBLB_box', 'Tissue culture for fungus') !!}
                </div>
                <hr class="tblb mt-2">
            </div>
            <div class="row">
                {!! bronchogroup($case, 'bcbp', 'Bronchial_biopsy_box', 'Bronchial biopsy') !!}
                {!! bronchotext($case, 'bcbp', '', 'Bronchial_biopsy', '', '', 3) !!}

                <div class="row" style="place-content: center;">
                    {!! bronchobox($case, 'bcbp', 'Histopathology_Bronchial_biopsy_box', 'Histopathology') !!}
                    {!! bronchobox($case, 'bcbp', 'Tissue_culture_for_bacteria_Bronchial_biopsy_box', 'Tissue culture for bacteria') !!}
                    {!! bronchobox($case, 'bcbp', 'Mycobacteria_Profile1_Bronchial_biopsy_box', 'Mycobacteria (Profile 1)') !!}
                    {!! bronchobox($case, 'bcbp', 'Mycobacteria_Profile2_Bronchial_biopsy_box', 'Mycobacteria (Profile 2)') !!}
                    {!! bronchobox($case, 'bcbp', 'Tissue_culture_for_fungus_Bronchial_biopsy_box', 'Tissue culture for fungus') !!}
                    <hr class="bcbp mt-2">

                </div>
            </div>


            <div class="row">
                {!! bronchogroup($case, 'bcba', 'Bronchial_brush_box', 'Bronchial brush at ') !!}
                {!! bronchotext($case, 'bcba', '', 'Bronchial_brush', '', '', 1) !!}
                {!! bronchobox($case, 'bcba', 'Cytology_Bronchial_brush_box', 'Cytology') !!}
                {!! bronchotext($case, 'bcba', 'Segment', 'Bronchial_brush_segment', '', '', 1) !!}
                <hr class="bcba mt-2">
            </div>



            {{--  --}}
            <div class="row">
                {!! bronchogroup($case, 'tbnaa', 'TBNA_box', 'TBNA at ') !!}
                {!! bronchotext($case, 'tbnaa', '', 'TBNA', '', '', 3) !!}
                <div class="col-12"></div>
                {!! bronchobox($case, 'tbnaa', 'Histopathology_TBNA_box', 'Histopathology') !!}
                {!! bronchobox($case, 'tbnaa', 'Cytology_TBNA_box', 'Cytology') !!}
                <div class="col-12"> </div>
                {!! bronchobox($case, 'tbnaa', 'Tissue_culture_for_bacteria_TBNA_box', 'Tissue culture for bacteria') !!}
                {!! bronchobox($case, 'tbnaa', 'Mycobacteria_Profile1_TBNA_box', 'Mycobacteria (Profile 1)') !!}
                {!! bronchobox($case, 'tbnaa', 'Mycobacteria_Profile2_TBNA_box', 'Mycobacteria (Profile 2)') !!}
                {!! bronchobox($case, 'tbnaa', 'Tissue_culture_for_fungus_TBNA_box', 'Tissue culture for fungus') !!}
                <hr class="tbnaa mt-2">

            </div>


            <div class="row">
                <div class="col-12">
                    {!! bronchogroup($case, 'ebustbna', 'EBUS_TBNA_location', 'EBUS-TBNA') !!}


                    <div class="row">
                        {!! bronchotext($case, 'ebustbna', '2R', 'TBNA_2R', '{{ @$case->TBNA_2R }}', 'Cm', 1) !!}
                        {!! bronchotext($case, 'ebustbna', '2L', 'TBNA_2L', '{{ @$case->TBNA_2L }}', 'Cm', 1) !!}
                    </div>
                    <div class="row">
                        {!! bronchotext($case, 'ebustbna', '4R', 'TBNA_4R', '{{ @$case->TBNA_4R }}', 'Cm', 1) !!}
                        {!! bronchotext($case, 'ebustbna', '4L', 'TBNA_4L', '{{ @$case->TBNA_4L }}', 'Cm', 1) !!}
                    </div>
                    <div class="row">
                        {!! bronchotext($case, 'ebustbna', '7', 'TBNA_7', '{{ @$case->TBNA_7 }}', 'Cm', 1) !!}
                    </div>
                    <div class="row">
                        {!! bronchotext($case, 'ebustbna', '10R', 'TBNA_10R', '{{ @$case->TBNA_10R }}', 'Cm', 1) !!}
                        {!! bronchotext($case, 'ebustbna', '10L', 'TBNA_10L', '{{ @$case->TBNA_10L }}', 'Cm', 1) !!}

                    </div>
                    <div class="row">
                        {!! bronchotext($case, 'ebustbna', '11L', 'TBNA_11L', '{{ @$case->TBNA_11L }}', 'Cm', 1) !!}
                        {!! bronchotext($case, 'ebustbna', '11S', 'TBNA_11S', '{{ @$case->TBNA_11S }}', 'Cm', 1) !!}
                    </div>
                    <div class="row">
                        {!! bronchotext($case, 'ebustbna', 'Other Procedure', 'otherprocedure', '{{ @$case->otherprocedure }}', '', 10) !!}
                    </div>
                <hr class="ebustbna mt-2">
                </div>
            </div>
            <div class="row text-nowrap">
                {!! bronchogroup($case, 'ebustatbna', 'EBUS_TBNA_lymphnode_station', 'EBUS-TBNA at Lymphnode station ') !!}
                {!! bronchotext($case, 'ebustatbna', '', 'EBUS_TBNA_lymphnode_text', '', '', 2) !!}

                <span class="ebustatbna">Specimen for</span>
                {!! bronchobox($case, 'ebustatbna', 'EBUS_TBNA_histopathology_box', 'Histopathology') !!}
                {!! bronchobox($case, 'ebustatbna', 'EBUS_TBNA_Cytology_box', 'Cytology') !!}
                {!! bronchobox($case, 'ebustatbna', 'EBUS_TBNA_Other_box', 'Others') !!}
                {!! bronchotext($case, 'ebustatbna', '', 'EBUS_TBNA_Other_text', '', '', 2) !!}
                <hr class="ebustatbna mt-2">
            </div>
            <div class="row">
                {!! bronchogroup($case, 'sqtna', 'sqtna_box', 'Sequential BAL at ') !!}
                {!! bronchotext($case, 'sqtna', '', 'sequentia_text', '', '', 2) !!}
                {!! bronchotext($case, 'sqtna', 'Segment', 'sequentia_segment_text', '', '', 2) !!}

             <span class="sqtna">Result</span>

                {!! bronchoradiobox($case, 'sqtna', 'sequentialbalat_result','negative', 'Negative') !!}
                {!! bronchoradiobox($case, 'sqtna', 'sequentialbalat_result','positive', 'Positive') !!}

                <hr class="sqtna mt-2">
            </div>
            <div class="row">
                {!! bronchogroup($case, 'cryna', 'cryop_group', 'Cryoprobe ') !!}
                {!! bronchotext($case, 'cryna', '', 'cryop_text', '', '', 2) !!}
                <hr class="cryna mt-2">
            </div>
            <div class="row">
                {!! bronchogroup($case, 'wnasna', 'wang_needle_group', 'Wang Needle Aspiration ') !!}
                {!! bronchotext($case, 'wnasna', '', 'wang_needle_text', '', '', 2) !!}

                    <span class="wnasna">Specimen for</span>
                    {!! bronchobox($case, 'wnasna', 'wang_needlecyto_box', 'Cytology') !!}


                <hr class="cryna mt-2">
            </div>
        </div>
    </div>
</div>


<script>
    $('.ebush').click(function() {
        var is_class = $(this).attr('subis');
        if ($(this).prop("checked") == true) {
            $("." + is_class).show(500);
        } else {
            $("." + is_class).hide(500);
        }
    });

    check_on_show("{{ @$case->EBUS_TBNA_location }}", ".ebustbna");
    check_on_show("{{ @$case->ebus_box }}", ".ebuss");
    check_on_show("{{ @$case->ebus_guide_sheath_box }}", ".ebusg");
    check_on_show("{{ @$case->autofluoresence_box }}", ".autof");
    check_on_show("{{ @$case->virtual_bronchoscopy_box }}", ".vtlbr");
    check_on_show("{{ @$case->Bronchial_Washing_site_box }}", ".bcwa");
    check_on_show("{{ @$case->Bronchoalveolar_Lavage_site_box }}", ".bclvl");
    check_on_show("{{ @$case->TBLB_box }}", ".tblb");
    check_on_show("{{ @$case->Bronchial_biopsy_box }}", ".bcbp");
    check_on_show("{{ @$case->EBUS_TBNA_lymphnode_station }}", ".ebustatbna");
    check_on_show("{{ @$case->fluoroscopy_box }}", ".flu");
    check_on_show("{{ @$case->sqtna_box }}", ".sqtna");
    check_on_show("{{ @$case->cryop_group }}", ".cryna");
    check_on_show("{{ @$case->wang_needle_group }}", ".wnasna");




    check_on_show("{{ @$case->TBNA_box }}", ".tbnaa");
    check_on_show("{{ @$case->Bronchial_brush_box }}", ".bcba");
    check_on_show("{{ @$case->rigid_bronchoscope }}", ".rigid_b");
    check_on_show("{{ @$case->dilatation }}", ".dilatation");
    check_on_show("{{ @$case->dilatation_at }}", ".dilatation_at");
    check_on_show("{{ @$case->dilatation_at_02 }}", ".dilatation_at_02");
    check_on_show("{{ @$case->tumor_removal_at }}", ".tumor_removal_at");
    check_on_show("{{ @$case->body_removal_at }}", ".body_removal_at");
    check_on_show("{{ @$case->stent_placement }}", ".stent_placement");
    check_on_show("{{ @$case->endobronchial_block_at }}", ".endobronchial_block_at");
    check_on_show("{{ @$case->others_05 }}", ".others_05");

    function check_on_show(check, classname) {
        if (check == "false" || check == "" || check == null) {
            $(classname).hide();
        }
    }
</script>
