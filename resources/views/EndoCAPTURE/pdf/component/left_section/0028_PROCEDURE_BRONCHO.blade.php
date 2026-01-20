<tr class="set-font-family" style="line-height:{{$body_line}};">
    <td>
        {{-- @dd($casedata) --}}
        <span class="casetitle">PROCEDURE (ICD-9) :</span>
        <span class="casetext">
            {{-- ebus --}}
            @if (pdfcheckvalue($casedata,"ebus_box|ebus|distance_ebus"))
                <br>
                {!! box2text(@$casedata->ebus_box, 'EBUS') !!}
                {!! text2print('', @$casedata->ebus, '') !!}
                {!! text2print('&nbsp;Distance&nbsp;', @$casedata->distance_ebus, '&nbsp;cm.') !!}
                {!! text2print('&nbsp;Time&nbsp;', @$casedata->time_ebus, '&nbsp;min.') !!}
            @endif

            {{--   EBUS guide-sheath --}}
            @if (pdfcheckvalue($casedata,"ebus_guide_sheath_box|ebus_guide_sheath|time_ebus_guide_sheath"))
                <br>
                {!! box2text(@$casedata->ebus_guide_sheath_box, 'EBUS guide-sheath') !!}
                {!! text2print('', @$casedata->ebus_guide_sheath, '') !!}
                {!! text2print('&nbsp;Time&nbsp;&nbsp;', @$casedata->time_ebus_guide_sheath, '&nbsp;&nbsp;min.') !!}
            @endif

            {{--  Fluoroscopy --}}
            @if (pdfcheckvalue($casedata,"fluoroscopy_box"))
                <br>
                <font color="black" style="font-weight: normal !important;">
                {{ box2text(@$casedata->fluoroscopy_box, 'Fluoroscopy') }}
                {!! text2print('', @$casedata->fluoroscopy, '') !!}
                </font>
            @endif

            {{--  Autofluoresence --}}
            @if (pdfcheckvalue($casedata,"autofluoresence_box|negative_autoflu_box|positive_autoflu_box|positive_autoflu"))
                <br>
                {!! box2text(@$casedata->autofluoresence_box, 'Autofluoresence &nbsp;&nbsp;') !!}
                {!! box2text(@$casedata->negative_autoflu_box, '&nbsp;Negative &nbsp;&nbsp;') !!}
                {!! box2text(@$casedata->positive_autoflu_box, '&nbsp;Positive at &nbsp;') !!}
                {!! text2print('', @$casedata->positive_autoflu, '') !!}
                {!! text2print('', @$casedata->anatomical_location, '') !!}
            @endif


            {{--  Virtual bronchoscopy --}}
            @if (pdfcheckvalue($casedata,"virtual_bronchoscopy_box|Generation_by_CT_navigation|Generation_by_bronchoscopy"))
                <br>
                {!! box2text(@$casedata->virtual_bronchoscopy_box, 'Virtual bronchoscopy') !!}
                {!! text2print('&nbsp;Generation by CT navigation &nbsp;',@$casedata->Generation_by_CT_navigation,'&nbsp;&nbsp;',) !!}
                {!! text2print('&nbsp;Generation by CT bronchoscopy &nbsp;&nbsp;',@$casedata->Generation_by_bronchoscopy,'&nbsp;',) !!}
            @endif

            {{-- Bronchial Washing at --}}
            @if (pdfcheckvalue($casedata,"Bronchial_Washing_site_box|Bronchial_Washing_site"))
                <br>
                {!! box2text(@$casedata->Bronchial_Washing_site_box, 'Bronchial Washing at') !!}
                {!! text2print('', @$casedata->Bronchial_Washing_site, '') !!}
                {!! text2print('', @$casedata->Bronchial_Washing_select, '') !!}
            @endif


            {{-- Bronchoalveolar Lavage at --}}
            @if (pdfcheckvalue($casedata,"Bronchoalveolar_Lavage_site_box"))
                <br>
                {{-- @dd($casedata->Bronchoalveolar_Lavage_site); --}}
                {!! box2text(@$casedata->Bronchoalveolar_Lavage_site_box, 'Bronchoalveolar Lavage at') !!}
                {!! text2print('', @$casedata->Bronchoalveolar_Lavage_site, '') !!}
                {!! text2print('', @$casedata->Bronchoalveolar_Lavage_select, '') !!}
                @if(@$casedata->Bronchoalveolar_Lavage_segment_box)
                    {!! text2print('Segment &nbsp;', @$casedata->Bronchoalveolar_Lavage_segment_box, '') !!}
                    {!! text2print('', @$casedata->Bronchoalveolar_segment, '') !!}
                @else
                    {!! text2print('Segment &nbsp;', @$casedata->Bronchoalveolar_segment, '') !!}
                @endif


            @endif

            @if (pdfcheckvalue($casedata,"Instilled_volume|Retrived_volume|Bronchoalveolar_appearance"))
                <br>

                {!! text2print('&nbsp;Instilled volume&nbsp;&nbsp;', @$casedata->Instilled_volume, '&nbsp;ml.') !!}
                {!! text2print('&nbsp;Retrived volume&nbsp;&nbsp;', @$casedata->Retrived_volume, '&nbsp;ml.') !!}
                {!! text2print('&nbsp;Appearance&nbsp;&nbsp;', @$casedata->Bronchoalveolar_appearance, '') !!}
            @endif

            @if (pdfcheckvalue($casedata,"Mycobacteria_Profile1_Bronchoalveolar_Lavage_box|Mycobacteria_Profile2_Bronchoalveolar_Lavage_box|Tissue_culture_for_fungus_Bronchoalveolar_Lavage_box"))
                <br>
                {!! box2text(@$casedata->Mycobacteria_Profile1_Bronchoalveolar_Lavage_box, '&nbsp;Mycobacteria (Profile 1)') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile2_Bronchoalveolar_Lavage_box, '&nbsp;Mycobacteria (Profile 2)') !!}
                {!! box2text(@$casedata->Tissue_culture_for_fungus_Bronchoalveolar_Lavage_box, '&nbsp;Culture for fungus') !!}
                {!! box2text(@$casedata->Gram_stain_Bronchoalveolar_Lavage_box, '&nbsp;Gram stain') !!}
                {!! box2text(@$casedata->Cytology_Bronchoalveolar_Lavage_box, '&nbsp;Cytology') !!}
                {!! box2text(@$casedata->Culture_for_bacteria_Bronchoalveolar_Lavage_box, '&nbsp;Culture for bacteria') !!}
            @endif

            @if (pdfcheckvalue($casedata,"Other_text"))
                <br>
                {!! text2print('Other &nbsp;', @$casedata->Other_text, '') !!}
            @endif

            @if (pdfcheckvalue($casedata,"cell_count_and_differential_count_box|hemosiderin_score_box"))
                <br>
                {!! box2text(@$casedata->cell_count_and_differential_count_box, '&nbsp;Cell count and differential count') !!}
                {!! box2text(@$casedata->hemosiderin_score_box, '&nbsp;Hemosiderin score') !!}
            @endif


            @if (pdfcheckvalue($casedata,"grams_stain_and_culture_for_bacteria_box|wraight_stain|modified_afb_box|afb_profile1_box|giemsa_stain_box|gms_stain_box|fresh_smear_for_parasite|culture_for_bacteria|culture_for_fungus|culture_for_tb_box"))
                <br>
                {!! box2text(@$casedata->grams_stain_and_culture_for_bacteria_box, '&nbsp;Grams stain') !!}
                {!! box2text(@$casedata->wraight_stain, '&nbsp;Wraight stain') !!}
                {!! box2text(@$casedata->modified_afb_box, '&nbsp;Modified AFB') !!}
                {!! box2text(@$casedata->afb_profile1_box, '&nbsp;AFB ') !!}
                {!! box2text(@$casedata->giemsa_stain_box, '&nbsp;Giemsa stain') !!}
                {!! box2text(@$casedata->gms_stain_box, '&nbsp;GMS stain') !!}
                {!! box2text(@$casedata->fresh_smear_for_parasite, '&nbsp; Fresh Smear For Parasite ') !!}
                {!! box2text(@$casedata->culture_for_bacteria, '&nbsp;Culture for bacteria') !!}
                {!! box2text(@$casedata->culture_for_fungus, '&nbsp;Culture for fungus') !!}
                {!! box2text(@$casedata->culture_for_tb_box, '&nbsp;Culture for TB') !!}
            @endif

            @if (pdfcheckvalue($casedata,"stain_and_culture_for_fungus_box|ifa_for_pcp_box|pcr_for_pcp_box|PCR_TB_tb_box|PCR_TB_ntm_box|gene_x_pert_box"))
                <br>
                {!! box2text(@$casedata->stain_and_culture_for_fungus_box, '&nbsp;Stain and culture for fungus') !!}
                {!! box2text(@$casedata->ifa_for_pcp_box, '&nbsp;IFA for PCP') !!}
                {!! box2text(@$casedata->pcr_for_pcp_box, '&nbsp;PCR for PCP') !!}
                {!! box2text(@$casedata->PCR_TB_tb_box, '&nbsp;PCR for TB') !!}
                {!! box2text(@$casedata->PCR_TB_ntm_box, '&nbsp;PCR for NTM') !!}
                {!! box2text(@$casedata->gene_x_pert_box, '&nbsp;Gene-Xpert') !!}
            @endif

        @if (pdfcheckvalue($casedata,"PCR_TB_influenza_box|galactomannan_box|pcr_for_cmv_quantitative_box|pcr_for_hsv_box|Cytology_bcba_box|Other_hsv_box"))
            <br>
            {!! box2text(@$casedata->PCR_TB_influenza_box, '&nbsp;PCR for Influenza') !!}
            {!! box2text(@$casedata->galactomannan_box, '&nbsp;Galactomannan') !!}
            {!! box2text(@$casedata->pcr_for_cmv_quantitative_box, '&nbsp;PCR for CMV quantitative') !!}
            {!! box2text(@$casedata->pcr_for_hsv_box, '&nbsp;PCR for HSV') !!}
            {!! box2text(@$casedata->Cytology_bcba_box, '&nbsp;Cytology') !!}
            {!! box2text(@$casedata->Other_hsv_box, '&nbsp;Other') !!}
            {!! text2print('', @$casedata->Other_hsv, '') !!}
        @endif

            {{-- @if (pdfcheckvalue($casedata,"cmv_antigen_box|cmv_dna_detection_box|cmv_isolation_box|influenza_box"))
                <br>
                {!! box2text(@$casedata->cmv_antigen_box, '|&nbsp;CMV antigen') !!}
                {!! box2text(@$casedata->cmv_dna_detection_box, '|&nbsp;CMV DNA detection') !!}
                {!! box2text(@$casedata->cmv_isolation_box, '|&nbsp;CMV isolation') !!}
                {!! box2text(@$casedata->influenza_box, '|&nbsp;Influenza') !!}
            @endif

            @if (pdfcheckvalue($casedata,"HSV_box|Cytology_box|PCR_TB_box|Other_hsv_box|Other_hsv"))
                <br>
                {!! box2text(@$casedata->HSV_box, '|&nbsp;HSV') !!}
                {!! box2text(@$casedata->PCR_TB_box, '|&nbsp;PCR TB') !!}
                {!! box2text(@$casedata->Other_hsv_box, '&nbsp;Other') !!}
                {!! box2text(@$casedata->Cytology_box, '|&nbsp;Cytology') !!}
                {!! text2print('', @$casedata->Other_hsv, '') !!}
            @endif --}}


            {{-- TBNA --}}
            @if (pdfcheckvalue($casedata,"TBLB_box|TBLB|TBLB_segment"))
                <br>
                {!! box2text(@$casedata->TBLB_box, 'TBLB at') !!}
                {!! text2print('', @$casedata->TBLB_select, '') !!}
                {!! text2print('', @$casedata->TBLB, '') !!}
                @if(@$casedata->TBLB_segment_box)
                    {!! text2print('Segment &nbsp;', @$casedata->TBLB_segment_box, '') !!}
                    {!! text2print('', @$casedata->TBLB_segment, '') !!}
                @else
                    {!! text2print('Segment &nbsp;', @$casedata->TBLB_segment, '') !!}
                @endif
                {!! text2print('', @$casedata->TBLB_segment, '') !!}

                {!! text2print('&nbsp;Specimen &nbsp;', @$casedata->TBLB_specimen, '&nbsp; pieces') !!}<BR>
                {!! box2text(@$casedata->Histopathology_TBLB_box, '&nbsp;Histopathology') !!}
                {!! box2text(@$casedata->Tissue_culture_for_bacteria_TBLB_box, '&nbsp;Tissue culture for bacteria') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile1_TBLB_box, '&nbsp;Mycobacteria (Profile 1)') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile2_TBLB_box, '&nbsp;Mycobacteria (Profile 2)') !!}
                {!! box2text(@$casedata->Tissue_culture_for_fungus_TBLB_box, '&nbsp;Tissue culture for fungus)') !!}
            @endif
            @if (pdfcheckvalue($casedata,"OtherTBLB_text"))
            {!! text2print('Other &nbsp;', @$casedata->OtherTBLB_text, '') !!}
        @endif
            {{-- @if (pdfcheckvalue($casedata,"Histopathology_TBLB_box|Tissue_culture_for_bacteria_TBLB_box|Mycobacteria_Profile1_TBLB_box|Mycobacteria_Profile2_TBLB_box|Tissue_culture_for_fungus_TBLB_box"))
                <br>
                {!! box2text(@$casedata->Tissue_culture_for_bacteria_TBLB_box, '|&nbsp;Tissue culture for bacteria') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile1_TBLB_box, '|&nbsp;Mycobacteria (Profile 1)') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile2_TBLB_box, '|&nbsp;Mycobacteria (Profile 2)') !!}
                {!! box2text(@$casedata->Tissue_culture_for_fungus_TBLB_box, '|&nbsp;Tissue culture for fungus') !!}
            @endif --}}

            @if (pdfcheckvalue($casedata,"Bronchial_biopsy_box|Bronchial_biopsy"))
                <br>
                {!! box2text(@$casedata->Bronchial_biopsy_box, 'Bronchial biopsy at') !!}
                {!! text2print('', @$casedata->Bronchial_biopsy, '') !!}
            @endif

            @if (pdfcheckvalue($casedata,"Histopathology_Bronchial_biopsy_box|Tissue_culture_for_bacteria_Bronchial_biopsy_box|Mycobacteria_Profile1_Bronchial_biopsy_box|Mycobacteria_Profile2_Bronchial_biopsy_box|Tissue_culture_for_fungus_Bronchial_biopsy_box"))
                <br>
                {!! box2text(@$casedata->Histopathology_Bronchial_biopsy_box, '&nbsp;Histopathology') !!}
                {!! box2text(@$casedata->Tissue_culture_for_bacteria_Bronchial_biopsy_box, '&nbsp;Tissue culture for bacteria') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile1_Bronchial_biopsy_box, '&nbsp;Mycobacteria (Profile 1)') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile2_Bronchial_biopsy_box, '&nbsp;Mycobacteria (Profile 2)') !!}
                {!! box2text(@$casedata->Tissue_culture_for_fungus_Bronchial_biopsy_box, '&nbsp;Tissue culture for fungus') !!}
            @endif

            @if (pdfcheckvalue($casedata,"Bronchial_brush_box|Bronchial_brush|Bronchial_brush_segment|Cytology_Bronchial_brush_box"))
                <br>
                {!! box2text(@$casedata->Bronchial_brush_box, 'Bronchial brush at ') !!}
                {!! text2print('', @$casedata->Bronchial_brush_select, '') !!}
                {!! text2print('', @$casedata->Bronchial_brush, '') !!}
                {!! box2text(@$casedata->Cytology_Bronchial_brush_box, '&nbsp;Cytology') !!}

                @if(@$casedata->Bronchial_brush_segment_box)
                    {!! text2print('Segment&nbsp;&nbsp;', @$casedata->Bronchial_brush_segment_box, '') !!}
                    {!! text2print('', @$casedata->Bronchial_brush_segment, '') !!}
                @else
                    {!! text2print('Segment&nbsp;&nbsp;', @$casedata->Bronchial_brush_segment, '') !!}
                @endif
            @endif





            @if (pdfcheckvalue($casedata,"TBNA_box|TBNA"))
                <br>
                {!! box2text(@$casedata->TBNA_box, 'TBNA at') !!}
                {!! text2print('', @$casedata->TBNA_select, '') !!}
                {!! text2print('', @$casedata->TBNA, '') !!}
            @endif


            @if (pdfcheckvalue($casedata,"Histopathology_TBNA_box|Cytology_TBNA_box|Tissue_culture_for_bacteria_TBNA_box|Mycobacteria_Profile1_TBNA_box|Mycobacteria_Profile2_TBNA_box|Tissue_culture_for_fungus_TBNA_box"))
                <br>
                {!! box2text(@$casedata->Histopathology_TBNA_box, '&nbsp;Histopathology') !!}
                {!! box2text(@$casedata->Cytology_TBNA_box, '&nbsp;Cytology') !!}
                {!! box2text(@$casedata->Tissue_culture_for_bacteria_TBNA_box, '&nbsp;Tissue culture for bacteria') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile1_TBNA_box, '&nbsp;Mycobacteria (Profile 1)') !!}
                {!! box2text(@$casedata->Mycobacteria_Profile2_TBNA_box, '&nbsp;Mycobacteria (Profile 2)') !!}
                {!! box2text(@$casedata->Tissue_culture_for_fungus_TBNA_box, '&nbsp;Tissue culture for fungus') !!}
            @endif



            {{-- EBUS-TBNA --}}
            @if (pdfcheckvalue($casedata,"EBUS_TBNA_location"))
                    <br>
                    {!! box2text(@$casedata->EBUS_TBNA_location, 'EBUS-TBNA location') !!}
                    {!! text2print('', @$casedata->EBUS_TBNA_TEXT, '') !!}
                    @if (pdfcheckvalue($casedata,"TBNA_2R|TBNA_2L|TBNA_4R|TBNA_4L|TBNA_7|TBNA_10R|TBNA_10L|TBNA_11L|TBNA_11S|otherprocedure"))
                        <br>
                        {!! text2print('&nbsp;2R&nbsp;', @$casedata->TBNA_2R, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;2L&nbsp;', @$casedata->TBNA_2L, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;4R&nbsp;', @$casedata->TBNA_4R, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;4L&nbsp;', @$casedata->TBNA_4L, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;7&nbsp;', @$casedata->TBNA_7, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;10R&nbsp;', @$casedata->TBNA_10R, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;10L&nbsp;', @$casedata->TBNA_10L, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;11L&nbsp;', @$casedata->TBNA_11L, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;11S&nbsp;', @$casedata->TBNA_11S, '&nbsp;cm.') !!}
                        {!! text2print('&nbsp;other&nbsp;', @$casedata->otherprocedure, '&nbsp;') !!}
                            {{-- @if (@$casedata->otherprocedure != '')
                            <br>
                            {!! @$casedata->otherprocedure !!}
                        @endif --}}
                    @endif

            @endif

                @if (pdfcheckvalue($casedata,"sqtna_box"))
                    <br>
                    {!! box2text(@$casedata->sqtna_box, 'Sequential BAL at') !!}
                    {!! text2print('', @$casedata->sqtna_select, '') !!}
                    {!! text2print('', @$casedata->sequentia_text, '&nbsp;') !!}
                    @if(@$casedata->sequentia_segment_box)
                        {!! text2print('Segment &nbsp;', @$casedata->sequentia_segment_box, '') !!}
                        {!! text2print('', @$casedata->sequentia_segment_text, '') !!}
                    @else
                        {!! text2print('Segment &nbsp;', @$casedata->sequentia_segment_text, '') !!}
                    @endif
                    <br>

                    @if (@$casedata->sequentialbalat_result == 'Negative')
                        Result : Negative
                    @endif

                    @if (@$casedata->sequentialbalat_result == 'Positive')
                        Result : Positive
                    @endif
                @endif


                <br>
                @if (pdfcheckvalue($casedata,"EBUS_TBNA_lymphnode_station|EBUS_TBNA_Cytology_box|EBUS_TBNA_histopathology_box|EBUS_TBNA_Other_box"))
                {!! box2text(@$casedata->EBUS_TBNA_lymphnode_station, '&nbsp;EBUS TBNA lymphnode station') !!}
                {!! text2print('&nbsp; &nbsp;', @$casedata->EBUS_TBNA_lymphnode_station_select, '&nbsp;') !!}
                {!! text2print('&nbsp; &nbsp;', @$casedata->EBUS_TBNA_lymphnode_text, '&nbsp;') !!}

                    @if(@$casedata->EBUS_TBNA_histopathology_box || @$casedata->EBUS_TBNA_Cytology_box || @$casedata->EBUS_TBNA_Other_box)
                        Specimen for
                        {!! box2text(@$casedata->EBUS_TBNA_histopathology_box, '&nbsp;Histopathology') !!}
                        {!! box2text(@$casedata->EBUS_TBNA_Cytology_box, '&nbsp;Cytology') !!}
                        {!! box2text(@$casedata->EBUS_TBNA_Other_box, '&nbsp;Others') !!}
                        {!! text2print('&nbsp;', @$casedata->EBUS_TBNA_Other_text, '&nbsp;') !!}
                    @endif
                @endif


                {{--   Sequential BAL at --}}
                @if (pdfcheckvalue($casedata,"Histopathology_EBUS_TBNA_box|Cytology_EBUS_TBNA_box|Tissue_culture_for_bacteria_EBUS_TBNA_box|Mycobacteria_Profile1_EBUS_TBNA_box|Mycobacteria_Profile2_EBUS_TBNA_box|Tissue_culture_for_fungus_EBUS_TBNA_box"))
                    <br>
                    {!! box2text(@$casedata->Histopathology_EBUS_TBNA_box, '&nbsp;Histopathology') !!}
                    {!! box2text(@$casedata->Cytology_EBUS_TBNA_box, '&nbsp;Cytology') !!}
                    {!! box2text(@$casedata->Tissue_culture_for_bacteria_EBUS_TBNA_box, '&nbsp;Tissue culture for bacteria') !!}
                    {!! box2text(@$casedata->Mycobacteria_Profile1_EBUS_TBNA_box, '&nbsp;Mycobacteria (Profile 1)') !!}
                    {!! box2text(@$casedata->Mycobacteria_Profile2_EBUS_TBNA_box, '&nbsp;Mycobacteria (Profile 2)') !!}
                    {!! box2text(@$casedata->Tissue_culture_for_fungus_EBUS_TBNA_box, '&nbsp;Tissue culture for fungus') !!}
                @endif

                {{-- @dd($casedata->cryop_group); --}}
                @if (pdfcheckvalue($casedata,"cryop_group"))
                    <br>
                    {!! box2text(@$casedata->cryop_group, 'Cryoprobe &nbsp; ') !!}

                    {!! text2print(' &ensp;', @$casedata->cryop_text, '') !!}
                @endif

                @if (pdfcheckvalue($casedata,"wang_needle_group"))
                    <br>
                    {!! box2text(@$casedata->wang_needle_group, 'Wang Needle Aspiration &nbsp; ') !!}

                    {!! text2print('', @$casedata->wang_needle_text, '') !!}
                    {!! box2text(@$casedata->wang_needlecyto_box, ' &nbsp; Specimen for Cytology') !!}
                @endif

                @if (pdfcheckvalue($casedata,"RPEBUS_box"))
                    <br>
                    {!! box2text(@$casedata->RPEBUS_box, 'RP-EBUS location') !!}
                    {!! text2print('', @$casedata->RPEBUS_text, '') !!}
                @endif

                @if (pdfcheckvalue($casedata,"Histopathology_RPEBUS_box|Cytology_RPEBUS_box|Tissue_culture_for_bacteria_RPEBUS_box|Mycobacteria_Profile1_RPEBUS_box|Mycobacteria_Profile2_RPEBUS_box|Tissue_culture_for_fungus_RPEBUS_box"))
                    <br>
                    {!! box2text(@$casedata->Histopathology_RPEBUS_box, '&nbsp;Histopathology') !!}
                    {!! box2text(@$casedata->Cytology_RPEBUS_box, '&nbsp;Cytology') !!}
                    {!! box2text(@$casedata->Tissue_culture_for_bacteria_RPEBUS_box, '&nbsp;Tissue culture for bacteria') !!}
                    {!! box2text(@$casedata->Mycobacteria_Profile1_RPEBUS_box, '&nbsp;Mycobacteria (Profile 1)') !!}
                    {!! box2text(@$casedata->Mycobacteria_Profile2_RPEBUS_box, '&nbsp;Mycobacteria (Profile 2)') !!}
                    {!! box2text(@$casedata->Tissue_culture_for_fungus_RPEBUS_box, '&nbsp;Tissue culture for fungus') !!}
                @endif



        </span>
    </td>
</tr>
