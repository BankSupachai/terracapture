<style>
    .cnt {
        align-self: center;
    }

    .form-select option.main-category {
        font-weight: bold;
    }

    /* Scrollbar styles for select elements */
    .form-select {
        max-height: 200px;
        overflow-y: auto;
    }

    /* Webkit browsers (Chrome, Safari) */
    .form-select::-webkit-scrollbar {
        width: 8px;
    }

    .form-select::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .form-select::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .form-select::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Firefox */
    .form-select {
        scrollbar-width: thin;
        scrollbar-color: #888 #f1f1f1;
    }

    .select-spacing {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .mt-row-spacing {
        margin-top: 18px;
    }

    .sqtna-result-row.sqtna-visible {
        margin-top: 18px;
    }
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

    if (!function_exists('bronchoselect')) {
        function bronchoselect($case, $group, $name, $options, $selected = null, $placeholder = null)
        {
            $html = "<div class='$group'>";
            $html .= "<select class='form-select savejson' id='$name' name='$name'>";
            $ph = $placeholder ?? '--Bronchoscopic Location--';
            $html .= "<option value=''>" . $ph . '</option>';

            foreach ($options as $value => $text) {
                $isSelected = $selected == $value ? 'selected' : '';
                $isMainCategory = strpos($text, 'lung') !== false;
                $class = $isMainCategory ? ' class=\"main-category\"' : '';
                $html .= "<option value='$value' $isSelected$class>$text</option>";
            }

            $html .= '</select>';
            $html .= '</div>';
            return $html;
        }
    }

    if (!function_exists('bronchotext')) {
        function bronchotext($case, $group, $before, $name, $text, $after, $col, $before_style = '')
        {
            $text = @$case->$name;
            if (is_array($text)) {
                $text = json_encode($text);
            }
            $text = htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
            $html = "<div class='col-auto cnt $group' style='$before_style'><b>$before</b></div>

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
            $html = "<div class='col-1 cnt text-nowrap $group'>
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
        function bronchoradiobox($case, $group, $name, $text, $value)
        {
            $box = box(@$case->$name);
            $checked = '';
            if (@$case->$name == $value) {
                $checked = 'checked';
            }

            $html = "<div class='col-2 cnt text-nowrap $group'>
                        <input  type='radio' $box
                                class='form-check-input saveradio'
                                id='$name$text'
                                name='$name'
                                value='$value'
                                $checked>

                        <label for='$name$text'>
                            <b for='$name'>$value</b>
                        </label>
                    </div>";
            return $html;
        }
    }

    if (!function_exists('bronchotextarea')) {
        function bronchotextarea($case, $group, $before, $name, $text, $after, $col)
        {
            $text = @$case->$name;
            if (is_array($text)) {
                $text = json_encode($text);
            }
            $text = htmlspecialchars($text ?? '', ENT_QUOTES, 'UTF-8');
            $html = "<div class='col-auto cnt $group'><b>$before</b></div>
                <div class='col-$col cnt $group'>
                    <textarea
                        id='$name'
                        name='$name'
                        class='form-control savejson autotext mt-2'
                        rows='8'
                        placeholder='Free text'
                        style='min-width: 100%; resize: vertical;'>$text</textarea>
                </div>
                <div class='col-1 cnt $group'><b>$after</b></div>";
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
                {!! bronchotext($case, 'ebuss', 'Distance (cm)', 'distance_ebus', '', '', 2) !!}
                {!! bronchotext($case, 'ebuss', 'Time(min)', 'time_ebus', '', 'min.', 2) !!}
                <hr class="ebuss mt-2">
            </div>



            <div class="row">
                {!! bronchogroup($case, 'ebusg', 'ebus_guide_sheath_box', 'EBUS guide-sheath') !!}
                {!! bronchotext($case, 'ebusg', '', 'ebus_guide_sheath', '', '', 3) !!}
                {!! bronchotext($case, 'ebusg', 'Time', 'time_ebus_guide_sheath', '', 'min.', 2) !!}
                <hr class="ebusg mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'flu', 'fluoroscopy_box', 'Fluoroscopy') !!}
                {!! bronchotext($case, 'flu', '', 'fluoroscopy', '', '', 3) !!}
                {!! bronchotext($case, 'flu', 'Time', 'time_fluoroscopy', '', 'min.', 2) !!}
                <hr class="flu mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'autof', 'autofluoresence_box', 'Autofluoresence') !!}
                <div class="col-10">
                    <div class="row">
                        <div class="col-2">
                            {!! bronchobox($case, 'autof', 'negative_autoflu_box', 'Negative') !!}
                        </div>
                        <div class="col-auto">
                            {!! bronchobox($case, 'autof', 'positive_autoflu_box', 'Positive at') !!}
                        </div>
                        <div class="col-3" style="margin-top: -5px;">
                            @php
                                $locations = [
                                    'Vocal cord' => 'Vocal cord',
                                    'Trachea' => 'Trachea',
                                    'Carina' => 'Carina',
                                    'Right main' => 'Right main',
                                    'R.Bronchointermediate' => 'R.Bronchointermediate',
                                    'RUL' => 'RUL',
                                    'RML' => 'RML',
                                    'RLL' => 'RLL',
                                    'Left main' => 'Left main',
                                    'LUL' => 'LUL',
                                    'Lingular' => 'Lingular',
                                    'LLL' => 'LLL',
                                ];

                                $bronchial_segments = [
                                    // Right lung segments
                                    'Right lung (Upper lobe)' => 'Right lung (Upper lobe)',
                                    'Right lung (Upper lobe) - Apical' => 'Apical',
                                    'Right lung (Upper lobe) - Posterior' => 'Posterior',
                                    'Right lung (Upper lobe) - Anterior' => 'Anterior',
                                    'Right lung (Middle lobe)' => 'Right lung (Middle lobe)',
                                    'Right lung (Middle lobe) - Lateral' => 'Lateral',
                                    'Right lung (Middle lobe) - Medial' => 'Medial',
                                    'Right lung (Lower lobe)' => 'Right lung (Lower lobe)',
                                    'Right lung (Lower lobe) - Superior' => 'Superior',
                                    'Right lung (Lower lobe) - Medial basal' => 'Medial basal',
                                    'Right lung (Lower lobe) - Anterior basal' => 'Anterior basal',
                                    'Right lung (Lower lobe) - Lateral basal' => 'Lateral basal',
                                    'Right lung (Lower lobe) - Posterior basal' => 'Posterior basal',
                                    // Left lung segments
                                    'Left lung (Upper lobe)' => 'Left lung (Upper lobe)',
                                    'Left lung (Upper lobe) - Apical' => 'Apical',
                                    'Left lung (Upper lobe) - Posterior' => 'Posterior',
                                    'Left lung (Upper lobe) - Anterior' => 'Anterior',
                                    'Left lung (Middle lobe)' => 'Left lung (Middle lobe)',
                                    'Left lung (Middle lobe) - Lateral' => 'Lateral',
                                    'Left lung (Middle lobe) - Medial' => 'Medial',
                                    'Left lung (Lower lobe)' => 'Left lung (Lower lobe)',
                                    'Left lung (Lower lobe) - Superior' => 'Superior',
                                    'Left lung (Lower lobe) - Lingula Superior' => 'Lingula Superior',
                                    'Left lung (Lower lobe) - Lingula Inferior' => 'Lingula Inferior',
                                    'Left lung (Lower lobe)' => 'Left lung (Lower lobe)',
                                    'Left lung (Lower lobe) - Superior' => 'Superior',
                                    'Left lung (Lower lobe) - Medial basal' => 'Medial basal',
                                    'Left lung (Lower lobe) - Anterior basal' => 'Anterior basal',
                                    'Left lung (Lower lobe) - Lateral basal' => 'Lateral basal',
                                    'Left lung (Lower lobe) - Posterior basal' => 'Posterior basal',
                                ];
                            @endphp
                            {!! bronchoselect($case, 'autof', 'anatomical_location', $locations, @$case->anatomical_location) !!}
                        </div>
                        <div class="col-5" style="margin-top: -12px;">
                            {!! bronchotext($case, 'autof', '', 'positive_autoflu', '', '', 11) !!}
                        </div>
                    </div>
                </div>
                <hr class="autof mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'vtlbr', 'virtual_bronchoscopy_box', 'Virtual bronchoscopy') !!}
                {!! bronchotext($case, 'vtlbr', 'Generation by CT navigation', 'Generation_by_CT_navigation', '', '', 2) !!}
                {!! bronchotext($case, 'vtlbr', 'Generation by CT bronchoscopy', 'Generation_by_bronchoscopy', '', '', 2) !!}
                <hr class="vtlbr mt-2">
            </div>

            <div class="row">
                <div class="row">
                    {!! bronchogroup($case, 'bcwa', 'Bronchial_Washing_site_box', 'Bronchial Washing at') !!}
                    <div class="col-2 select-spacing">
                        {!! bronchoselect($case, 'bcwa', 'Bronchial_Washing_select', $locations, @$case->Bronchial_Washing_select) !!}
                    </div>
                    <div class="col-3" style="">
                        {!! bronchotext($case, 'bcwa', '', 'Bronchial_Washing_site', '', '', 12) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-1 text-end bcwa">
                        <b>Segment</b>
                    </div>
                    <div class="col-2" style="margin-top: ">
                        {!! bronchoselect(
                            $case,
                            'bcwa',
                            'Bronchial_Washing_segment_box',
                            $bronchial_segments,
                            @$case->Bronchial_Washing_segment_box,
                            '--Anatomical Location--',
                        ) !!}
                    </div>

                </div>
                <hr class="bcwa mt-2">
            </div>

            <div class="row">
                {!! bronchogroup($case, 'bclvl', 'Bronchoalveolar_Lavage_site_box', 'Bronchoalveolar Lavage at') !!}
                <div class="col-2  select-spacing">
                    {!! bronchoselect(
                        $case,
                        'bclvl',
                        'Bronchoalveolar_Lavage_select',
                        $locations,
                        @$case->Bronchoalveolar_Lavage_select,
                    ) !!}
                </div>
                <div class="col-3" style="">
                    {!! bronchotext($case, 'bclvl', '', 'Bronchoalveolar_Lavage_site', '', '', 12) !!}
                </div>
                <div class="row align-items-center" style="margin-left: -8px;">

                    <div class="col-1"></div>
                    <div class="col-1 text-end bclvl">
                        <b>Segment</b>
                    </div>
                    <div class="col-2  " style=" ">
                        {!! bronchoselect(
                            $case,
                            'bclvl',
                            'Bronchoalveolar_Lavage_segment_box',
                            $bronchial_segments,
                            @$case->Bronchoalveolar_Lavage_segment_box,
                            '--Anatomical Location--',
                        ) !!}
                    </div>
                    <div class="row">
                        <div class="col-1" style="margin-left: 10px;"></div>
                        {!! bronchotext($case, 'bclvl', 'Instilled volume', 'Instilled_volume', '', 'ml.', 2) !!}
                        {!! bronchotext($case, 'bclvl', 'Retrived volume', 'Retrived_volume', '', 'ml.', 2) !!}
                        {!! bronchotext($case, 'bclvl', 'Appearance', 'Bronchoalveolar_appearance', '', '', 2) !!}
                    </div>
                    <div class="row mt-2">
                        <div class="col-2 " style="margin-left: 10px;"></div>
                        <div class="col-2">
                            {!! bronchobox($case, 'bclvl', 'Mycobacteria_Profile1_Bronchoalveolar_Lavage_box', 'Mycobacteria (Profile 1)') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'bclvl', 'Mycobacteria_Profile2_Bronchoalveolar_Lavage_box', 'Mycobacteria (Profile 2)') !!}
                        </div>
                        <div class="col-2" style="margin-left:1px;">
                            {!! bronchobox(
                                $case,
                                'bclvl',
                                'Tissue_culture_for_fungus_Bronchoalveolar_Lavage_box',
                                'Culture for fungus',
                            ) !!}

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-2 " style="margin-left: 10px;"></div>
                        <div class="col-2">
                            {!! bronchobox($case, 'bclvl', 'Gram_stain_Bronchoalveolar_Lavage_box', 'Gram stain') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'bclvl', 'Culture_for_bacteria_Bronchoalveolar_Lavage_box', 'Culture for bacteria') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'bclvl', 'Cytology_Bronchoalveolar_Lavage_box', 'Cytology') !!}
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-1" style="margin-left: 83px;"></div>
                        {!! bronchotext($case, 'bclvl', 'Other', 'Other_text', '', '', 5) !!}
                    </div>
                    {{-- <div class="col-3 ms-1" style="margin-top: -8px;">
                        {!! bronchotext($case, 'bclvl', '', 'Bronchoalveolar_Lavage_anatomy', '', '', 13) !!}
                    </div> --}}

                    {{-- <div class="col-3" style="margin-top: -8px;">
                        {!! bronchotext($case, 'bclvl', '', 'Bronchoalveolar_segment', '', '', 15) !!}
                    </div> --}}
                </div>
                <hr class="bclvl mt-2">
            </div>
            <div class="row">
                {!! bronchogroup($case, 'tblb', 'TBLB_box', 'TBLB at ') !!}

                <div class="col-2 select-spacing" style="">
                    {!! bronchoselect($case, 'tblb', 'TBLB_select', $locations, @$case->TBLB_select) !!}
                </div>
                <div class="col-3" style="">
                    {!! bronchotext($case, 'tblb', '', 'TBLB', '', '', 11) !!}
                </div>
                <div class="col-auto tblb" style="margin-top: 14px;">
                    <b>Segment</b>
                </div>
                <div class="col-2" style="margin-top: 7px;">
                    {!! bronchoselect(
                        $case,
                        'tblb',
                        'TBLB_segment_box',
                        $bronchial_segments,
                        @$case->TBLB_segment_box,
                        '--Anatomical Location--',
                    ) !!}
                </div>
                <div class="row align-items-center">
                    <div class="col-2"></div>

                    {{-- <div class="col-3 ms-1" style="margin-top: -8px;">
                        {!! bronchotext($case, 'tblb', '', 'TBLB_anatomy', '', '', 11) !!}
                    </div> --}}

                    {{-- <div class="col-3" style="">
                            {!! bronchotext($case, 'tblb', '', 'TBLB_segment', '', '', 15) !!}
                        </div> --}}
                    <div class="row">
                        <div class="col-2"></div>
                        {!! bronchotext($case, 'tblb', 'Specimen', 'TBLB_specimen', '', 'pieces', 1) !!}
                    </div>
                    <div class="row " style="place-content: center;">
                        <div class="col-2"></div>
                        <div class="col-2"style="margin-left: 8px;">
                            {!! bronchobox($case, 'tblb', 'Histopathology_TBLB_box', 'Histopathology') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'tblb', 'Tissue_culture_for_bacteria_TBLB_box', 'Tissue culture for bacteria') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'tblb', 'Tissue_culture_for_fungus_TBLB_box', 'Tissue culture for fungus') !!}
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-2">
                                {!! bronchobox($case, 'tblb', 'Mycobacteria_Profile1_TBLB_box', 'Mycobacteria (Profile 1)') !!}
                            </div>
                            <div class="col-2" style="margin-left: 4px;">
                                {!! bronchobox($case, 'tblb', 'Mycobacteria_Profile2_TBLB_box', 'Mycobacteria (Profile 2)') !!}
                            </div>

                            {!! bronchotext($case, 'tblb', 'Other', 'OtherTBLB_text', '', '', 2) !!}

                        </div>

                    </div>
                    <hr class="tblb mt-2">
                </div>
                <div class="row">
                    {!! bronchogroup($case, 'bcbp', 'Bronchial_biopsy_box', 'Bronchial biopsy') !!}
                    <div class="col-3 select-spacing">
                        {!! bronchotext($case, 'bcbp', '', 'Bronchial_biopsy', '', '', 12) !!}
                    </div>
                    <div class="row ">
                        <div class="col-2"></div>
                        <div class="col-2 " style="margin-left: 26px;">
                            {!! bronchobox($case, 'bcbp', 'Histopathology_Bronchial_biopsy_box', 'Histopathology') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'bcbp', 'Tissue_culture_for_bacteria_Bronchial_biopsy_box', 'Tissue culture for bacteria') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'bcbp', 'Mycobacteria_Profile1_Bronchial_biopsy_box', 'Mycobacteria (Profile 1)') !!}
                        </div>
                        <div class="row" style="">
                            <div class="col-2"></div>
                            <div class="col-2" style="margin-left: 30px;">
                                {!! bronchobox($case, 'bcbp', 'Mycobacteria_Profile2_Bronchial_biopsy_box', 'Mycobacteria (Profile 2)') !!}
                            </div>
                            <div class="col-2" style="margin-left: 5px;">
                                {!! bronchobox($case, 'bcbp', 'Tissue_culture_for_fungus_Bronchial_biopsy_box', 'Tissue culture for fungus') !!}
                            </div>
                            <hr class="bcbp mt-2">
                        </div>
                    </div>
                </div>


                <div class="row">
                    {!! bronchogroup($case, 'bcba', 'Bronchial_brush_box', 'Bronchial brush at ') !!}
                    <div class="col-2 select-spacing">
                        {!! bronchoselect($case, 'bcba', 'Bronchial_brush_select', $locations, @$case->Bronchial_brush_select) !!}
                    </div>
                    <div class="col-3 me-2" style="">
                        {!! bronchotext($case, 'bcba', '', 'Bronchial_brush', '', '', 12) !!}
                    </div>
                    {!! bronchobox($case, 'bcba', 'Cytology_Bronchial_brush_box', 'Cytology') !!}
                    <div class="row align-items-center ">
                        <div class="col-1"></div>
                        <div class="col-1 text-end bcba">
                            <b>Segment</b>
                        </div>
                        <div class="col-2" style=" margin-left: 4px;">
                            {!! bronchoselect(
                                $case,
                                'bcba',
                                'Bronchial_brush_segment_box',
                                $bronchial_segments,
                                @$case->Bronchial_brush_segment_box,
                                '--Anatomical Location--',
                            ) !!}
                        </div>
                        {{-- <div class="col-3" style="margin-left: 4px;">
                            {!! bronchotext($case, 'bcba', '', 'Bronchial_brush_anatomy', '', '', 12) !!}
                        </div> --}}

                        {{-- <div class="col-3" style="">
                            {!! bronchotext($case, 'bcba', '', 'Bronchial_brush_segment', '', '', 8) !!}
                        </div> --}}
                    </div>
                    <hr class="bcba mt-2">
                </div>



                {{--  --}}
                <div class="row">
                    {!! bronchogroup($case, 'tbnaa', 'TBNA_box', 'TBNA at ') !!}
                    <div class="col-2 select-spacing">
                        {!! bronchoselect($case, 'tbnaa', 'TBNA_select', $locations, @$case->TBNA_select) !!}
                    </div>
                    <div class="col-3 " style="margin-top: 2px;">
                        {!! bronchotext($case, 'tbnaa', '', 'TBNA', '', '', 14) !!}
                    </div>
                    <div class="row">
                        <div class="col-2" style="margin-left: 10px;"></div>
                        <div class="col-2">
                            {!! bronchobox($case, 'tbnaa', 'Histopathology_TBNA_box', 'Histopathology') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'tbnaa', 'Cytology_TBNA_box', 'Cytology') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'tbnaa', 'Tissue_culture_for_bacteria_TBNA_box', 'Tissue culture for bacteria') !!}
                        </div>
                    </div>

                    <hr class="tbnaa mt-2">
                </div>


                <div class="row">
                    <div class="col-5">
                        {!! bronchogroup($case, 'ebustbna', 'EBUS_TBNA_location', 'EBUS-TBNA') !!}


                        <div class="row">
                            {!! bronchotext($case, 'ebustbna', '2R', 'TBNA_2R', '{{ @$case->TBNA_2R }}', 'cm', 3, 'margin-right:5px;') !!}
                            {!! bronchotext($case, 'ebustbna', '2L', 'TBNA_2L', '{{ @$case->TBNA_2L }}', 'cm', 3, 'margin-right:6px;') !!}
                        </div>
                        <div class="row">
                            {!! bronchotext($case, 'ebustbna', '4R', 'TBNA_4R', '{{ @$case->TBNA_4R }}', 'cm', 3, 'margin-right:5px;') !!}
                            {!! bronchotext($case, 'ebustbna', '4L', 'TBNA_4L', '{{ @$case->TBNA_4L }}', 'cm', 3, 'margin-right:6px;') !!}
                        </div>
                        <div class="row ">
                            {!! bronchotext($case, 'ebustbna', '7&emsp;', 'TBNA_7', '{{ @$case->TBNA_7 }}', 'cm', 3) !!}
                        </div>
                        <div class="row">
                            {!! bronchotext($case, 'ebustbna', '10R', 'TBNA_10R', '{{ @$case->TBNA_10R }}', 'cm', 3) !!}
                            {!! bronchotext($case, 'ebustbna', '10L', 'TBNA_10L', '{{ @$case->TBNA_10L }}', 'cm', 3) !!}

                        </div>
                        <div class="row">
                            {!! bronchotext($case, 'ebustbna', '11L', 'TBNA_11L', '{{ @$case->TBNA_11L }}', 'cm', 3) !!}
                            {!! bronchotext($case, 'ebustbna', '11S', 'TBNA_11S', '{{ @$case->TBNA_11S }}', 'cm', 3) !!}
                        </div>


                    </div>
                    <div class="col-7">
                        <div class="row">
                            {!! bronchotextarea(
                                $case,
                                'ebustbna',
                                'Other Procedure',
                                'otherprocedure',
                                '{{ @$case->otherprocedure }}',
                                '',
                                12,
                            ) !!}
                        </div>
                    </div>
                </div>
                <hr class="ebustbna mt-2">
                <div class="row text-nowrap">
                    {!! bronchogroup($case, 'ebustatbna', 'EBUS_TBNA_lymphnode_station', 'EBUS-TBNA at Lymphnode station ') !!}
                    <div class="col-2 select-spacing">
                        {!! bronchoselect(
                            $case,
                            'ebustatbna',
                            'EBUS_TBNA_lymphnode_station_select',
                            $locations,
                            @$case->EBUS_TBNA_lymphnode_station_select,
                        ) !!}
                    </div>
                    <div class="col-3" style="margin-top: 2px;">
                        {!! bronchotext($case, 'ebustatbna', '', 'EBUS_TBNA_lymphnode_text', '', '', 11) !!}
                    </div>


                    <div class="row" style="">
                        <div class="col-1"></div>
                        <div class="col-auto" style="margin-left:33px;">
                            <span class="ebustatbna"><b>Specimen for</b></span>
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'ebustatbna', 'EBUS_TBNA_histopathology_box', 'Histopathology', '') !!}
                        </div>
                        <div class="col-2">
                            {!! bronchobox($case, 'ebustatbna', 'EBUS_TBNA_Cytology_box', 'Cytology') !!}
                        </div>
                        <div class="col-auto">
                            {!! bronchobox($case, 'ebustatbna', 'EBUS_TBNA_Other_box', 'Others') !!}
                        </div>
                        <div class="col-3" style="margin-top: -15px;">
                            {!! bronchotext($case, 'ebustatbna', '', 'EBUS_TBNA_Other_text', '', '', 10) !!}
                        </div>
                    </div>
                    <hr class="ebustatbna mt-2">
                </div>
                <div class="row">
                    {!! bronchogroup($case, 'sqtna', 'sqtna_box', 'Sequential BAL at ') !!}
                    <div class="col-2 select-spacing">
                        {!! bronchoselect($case, 'sqtna', 'sqtna_select', $locations, @$case->sqtna_select) !!}
                    </div>
                    <div class="col-3">
                        {!! bronchotext($case, 'sqtna', '', 'sequentia_text', '', '', 11) !!}
                    </div>
                </div>
                <div class="row align-items-center" style="margin-left: -8px;">
                    <div class="col-1"></div>
                    <div class="col-1 text-end sqtna" style="margin-left: -4px;">
                        <b>Segment</b>
                    </div>
                    <div class="col-2">
                        {!! bronchoselect(
                            $case,
                            'sqtna',
                            'sequentia_segment_box',
                            $bronchial_segments,
                            @$case->sequentia_segment_box,
                            '--Anatomical Location--',
                        ) !!}
                    </div>
                </div>
                <div class="row sqtna-result-row" style="display:none;">
                    <div class="col-2"></div>
                    <div class="col-auto">
                        <span class="sqtna"><b>Result</b></span>
                    </div>
                    <div class="col-auto">
                        {!! bronchoradiobox($case, 'sqtna', 'sequentialbalat_result', 'negative', 'Negative') !!}
                    </div>
                    <div class="col-2">
                        {!! bronchoradiobox($case, 'sqtna', 'sequentialbalat_result', 'positive', 'Positive') !!}
                    </div>
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
                </div>
                <div class="row mt-3">
                    <div class="col-2"></div>
                    <div class="col-auto">
                        <span class="wnasna ms-1"><b>Specimen for</b></span>
                    </div>
                    <div class="col-2">
                        {!! bronchobox($case, 'wnasna', 'wang_needlecyto_box', 'Cytology') !!}
                    </div>
                </div>

                <hr class="wnasna mt-2">

                </hr>
            </div>


            <script>
                $('.ebush').click(function() {
                    var is_class = $(this).attr('subis');
                    if ($(this).prop("checked") == true) {
                        $("." + is_class).show(500);
                        if (is_class === 'sqtna') $('.sqtna-result-row').show(500).addClass('sqtna-visible');
                    } else {
                        $("." + is_class).hide(500);
                        if (is_class === 'sqtna') $('.sqtna-result-row').hide(500).removeClass('sqtna-visible');
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
                check_on_show("{{ @$case->sqtna_box }}", ".sqtna-result-row");
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
                        $(classname).hide().removeClass('sqtna-visible');
                    } else {
                        $(classname).show().addClass('sqtna-visible');
                    }
                }
            </script>
