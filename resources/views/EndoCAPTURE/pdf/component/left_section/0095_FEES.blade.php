<tr style="line-height: 8px;" class="set-font-family">
    <td style="vertical-align:top" colspan="2">
        <span class="casetitle">Finding :</span>
    </td>
</tr>

@php
    $pooling_text = [];

    // Check for "no" option
    if(isset($casedata->pooling_saliva_no) && $casedata->pooling_saliva_no) {
                    $pooling_text[] = 'no';
    }

    // Check for severity at vallecula
    if(isset($casedata->pooling_saliva_severity) && $casedata->pooling_saliva_severity) {
        $severity = is_array($casedata->pooling_saliva_severity) ? implode(', ', $casedata->pooling_saliva_severity) : $casedata->pooling_saliva_severity;
        if(isset($casedata->pooling_saliva_vallecula) && $casedata->pooling_saliva_vallecula) {
            $pooling_text[] = $severity . ' at vallecula';
        } else {
            $pooling_text[] = $severity . ' at';
        }
    }

    // Check for position and pyriform sinus together
    $position_text = '';
    if(isset($casedata->pooling_saliva_position) && $casedata->pooling_saliva_position) {
        $position = is_array($casedata->pooling_saliva_position) ? implode(', ', $casedata->pooling_saliva_position) : $casedata->pooling_saliva_position;
        $position_text = $position;
    }
    if(isset($casedata->pooling_saliva_position_enable) && $casedata->pooling_saliva_position_enable) {
        $position_text .= ($position_text ? ' ' : '') . 'pyriform sinus';
    }
    if($position_text) {
        $pooling_text[] = $position_text;
    }

    // Check for penetration
    if(isset($casedata->pooling_saliva_penetration) && $casedata->pooling_saliva_penetration) {
                        $pooling_text[] = 'penetration';
    }

    // Check for aspiration
    if(isset($casedata->pooling_saliva_aspiration) && $casedata->pooling_saliva_aspiration) {
                        $pooling_text[] = 'aspiration';
            }
@endphp
@if(!empty($casedata->finding_freetext))
<tr style="line-height: 8px;">
  <td>
    <span class="casetitle" style="font-size: 10px; color: #0AB39C;"></span>
    <span class="casetext">{{ is_array($casedata->finding_freetext) ? implode(', ', $casedata->finding_freetext) : $casedata->finding_freetext }}</span>
  </td>
</tr>
@endif
@if(!empty($pooling_text))
<tr style="line-height: 8px;">
    <td >
        <span class="casetitle" style="font-size: 10px; color: #0AB39C;">POOLING SALIVA :</span>
        <span class="casetext">{{ implode(', ', $pooling_text) }}</span>
    </td>
</tr>
@endif

@php
    $tvc_text = [];

    // Check for "good" option
    if(isset($casedata->tvc_movement_good) && $casedata->tvc_movement_good) {
        $tvc_text[] = 'good';
    }

    // Check for paresis (no checkbox needed)
    if(isset($casedata->tvc_movement_side) && $casedata->tvc_movement_side) {
        $side = is_array($casedata->tvc_movement_side) ? implode(', ', $casedata->tvc_movement_side) : $casedata->tvc_movement_side;
        $tvc_text[] = $side . ' side paresis';
    }

    // Check for paralysis (no checkbox needed)
    if(isset($casedata->tvc_movement_paralysis_side) && $casedata->tvc_movement_paralysis_side) {
        $side = is_array($casedata->tvc_movement_paralysis_side) ? implode(', ', $casedata->tvc_movement_paralysis_side) : $casedata->tvc_movement_paralysis_side;
        $tvc_text[] = $side . ' paralysis';
    }
@endphp
@if(!empty($tvc_text))
<tr style="line-height: 8px;">
    <td >
        <span class="casetitle" style="font-size: 10px; color: #0AB39C;">TVC MOVEMENT :</span>
        <span class="casetext">{{ implode(', ', $tvc_text) }}</span>
    </td>
</tr>
@endif

@php
    $sensation_text = [];

    if(isset($casedata->sensation_good) && $casedata->sensation_good) {
        $sensation_text[] = 'good';
    }
    if(isset($casedata->sensation_fair) && $casedata->sensation_fair) {
        $sensation_text[] = 'fair';
    }
    if(isset($casedata->sensation_impair) && $casedata->sensation_impair) {
        $sensation_text[] = 'impair';
    }
@endphp
@if(!empty($sensation_text))
<tr style="line-height: 8px;">
    <td >
        <span class="casetitle" style="font-size: 10px; color: #0AB39C;">SENSATION :</span>
        <span class="casetext">{{ implode(', ', $sensation_text) }}</span>
    </td>
</tr>
@endif

@php
    // Get additional test-safety items from localStorage
    $additionalTestSafetyItems = [];
    if(isset($casedata->test_safety_additional_items) && $casedata->test_safety_additional_items) {
        $additionalTestSafetyItems = is_array($casedata->test_safety_additional_items) ? $casedata->test_safety_additional_items : [$casedata->test_safety_additional_items];
    }
@endphp

@php
    // Create grouped data structure for each test index
    $grouped_test_data = [];

    // Process main test data (index 0)
    $test_value = null;
    if(isset($casedata->test) && $casedata->test) {
        $test_value = is_array($casedata->test) ? implode(', ', $casedata->test) : $casedata->test;
    }

    // Always create test data for index 0 if there's any test-related data
    if($test_value || (isset($casedata->test_free_text) && $casedata->test_free_text)) {

        // Get compensation data for index 0
        $compensation_text = [];
        if(isset($casedata->compensation_small_volume) && $casedata->compensation_small_volume) {
            $compensation_text[] = 'small volume';
        }
        if(isset($casedata->compensation_slow_rate) && $casedata->compensation_slow_rate) {
            $compensation_text[] = 'slow rate';
        }
        if(isset($casedata->compensation_chin_tuck) && $casedata->compensation_chin_tuck) {
            $compensation_text[] = 'chin tuck';
        }
        if(isset($casedata->compensation_double_swallow) && $casedata->compensation_double_swallow) {
            $compensation_text[] = 'double swallow';
        }
        if(isset($casedata->compensation_multiple_swallow) && $casedata->compensation_multiple_swallow) {
            $compensation_text[] = 'multiple swallow';
        }
        if(isset($casedata->compensation_tilt_direction) && $casedata->compensation_tilt_direction) {
            $direction = is_array($casedata->compensation_tilt_direction) ? implode(', ', $casedata->compensation_tilt_direction) : $casedata->compensation_tilt_direction;
            $compensation_text[] = 'tilt ' . $direction;
        }
        if(isset($casedata->compensation_turn_to_direction) && $casedata->compensation_turn_to_direction) {
            $direction = is_array($casedata->compensation_turn_to_direction) ? implode(', ', $casedata->compensation_turn_to_direction) : $casedata->compensation_turn_to_direction;
            $compensation_text[] = 'turn to ' . $direction;
        }
        if(isset($casedata->compensation_recline_option) && $casedata->compensation_recline_option) {
            $compensation_text[] = 'recline';
        }
        if(isset($casedata->compensation_mendelsohn_maneuver) && $casedata->compensation_mendelsohn_maneuver) {
            $compensation_text[] = 'Mendelsohn maneuver';
        }
        if(isset($casedata->compensation_other) && $casedata->compensation_other) {
            $other_text = $casedata->compensation_other_text ?? '';
            if($other_text) {
                $other_text = is_array($other_text) ? implode(', ', $other_text) : $other_text;
                $compensation_text[] = $other_text;
            } else {
                $compensation_text[] = 'other';
            }
        }
        if(isset($casedata->compensation_other_enable) && $casedata->compensation_other_enable) {
            $other_text = $casedata->compensation_other_text ?? '';
            if($other_text) {
                $other_text = is_array($other_text) ? implode(', ', $other_text) : $other_text;
                $compensation_text[] = $other_text;
            } else {
                $compensation_text[] = 'other';
            }
        }

        // Get residual data for index 0
        $residual_text = [];
        if(isset($casedata->residual_no) && $casedata->residual_no) {
            $residual_text[] = 'no';
        }
        $residual_type_text = '';
        if(isset($casedata->residual_yes_type) && $casedata->residual_yes_type) {
            $type = is_array($casedata->residual_yes_type) ? implode(', ', $casedata->residual_yes_type) : $casedata->residual_yes_type;
            $residual_type_text = $type;
        }
        if(isset($casedata->residual_vallecula) && $casedata->residual_vallecula) {
            $residual_type_text .= ($residual_type_text ? ' at ' : '') . 'vallecula';
        }
        if(isset($casedata->residual_yes_check) && $casedata->residual_yes_check) {
            $residual_type_text .= ($residual_type_text ? ' at ' : '') . 'vallecula';
        }
        if($residual_type_text) {
            $residual_text[] = $residual_type_text;
        }
        if(isset($casedata->residual_pyriform_sinus_type) && $casedata->residual_pyriform_sinus_type) {
            $type = is_array($casedata->residual_pyriform_sinus_type) ? implode(', ', $casedata->residual_pyriform_sinus_type) : $casedata->residual_pyriform_sinus_type;
            $residual_text[] = $type . ' pyriform sinus';
        }

        // Get PAS data for index 0
        $pas_text = [];
        if(isset($casedata->pas_penetration) && $casedata->pas_penetration) {
            $pas_text[] = 'penetration';
        }
        if(isset($casedata->pas_aspiration) && $casedata->pas_aspiration) {
            $pas_text[] = 'aspiration';
        }
        if(isset($casedata->pas_level) && $casedata->pas_level) {
            $level = is_array($casedata->pas_level) ? implode(', ', $casedata->pas_level) : $casedata->pas_level;
            $pas_text[] = 'PAS ' . $level;
        }

        // Get Safety data for index 0
        $safety_text = [];
        if(isset($casedata->safety_safe) && $casedata->safety_safe) {
            $safety_text[] = 'safe';
        }
        if(isset($casedata->safety_not_safe) && $casedata->safety_not_safe) {
            $safety_text[] = 'not safe';
        }
        if(isset($casedata->safety_free_text) && $casedata->safety_free_text) {
            $free_text = is_array($casedata->safety_free_text) ? implode(', ', $casedata->safety_free_text) : $casedata->safety_free_text;
            $safety_text[] = $free_text;
        }

        // Get freetext data for index 0
        $freetext_value = null;
        if(isset($casedata->test_free_text) && $casedata->test_free_text) {
            $freetext_value = is_array($casedata->test_free_text) ? implode(', ', $casedata->test_free_text) : $casedata->test_free_text;
        }

        $grouped_test_data[0] = [
            'test' => $test_value,
            'freetext' => $freetext_value,
            'compensation' => !empty($compensation_text) ? implode(', ', $compensation_text) : null,
            'residual' => !empty($residual_text) ? implode(', ', $residual_text) : null,
            'pas' => !empty($pas_text) ? implode(', ', $pas_text) : null,
            'safety' => !empty($safety_text) ? implode(', ', $safety_text) : null

        ];
    }

    // Process additional test data
    foreach($additionalTestSafetyItems as $index) {
        $testField = 'test_' . $index;
        $test_value = null;
        if(isset($casedata->$testField) && $casedata->$testField) {
            $test_value = is_array($casedata->$testField) ? implode(', ', $casedata->$testField) : $casedata->$testField;
        }

        $freetextField = 'test_free_text_' . $index;
        $has_freetext = isset($casedata->$freetextField) && $casedata->$freetextField;

        // Always create test data for this index if there's any test-related data
        if($test_value || $has_freetext) {

            // Get compensation data for this index
            $compensation_text_additional = [];
            $fields = [
                'compensation_small_volume' => 'small volume',
                'compensation_slow_rate' => 'slow rate',
                'compensation_chin_tuck' => 'chin tuck',
                'compensation_double_swallow' => 'double swallow',
                'compensation_multiple_swallow' => 'multiple swallow',
                'compensation_recline_option' => 'recline',
                'compensation_mendelsohn_maneuver' => 'Mendelsohn maneuver'
            ];

            foreach($fields as $field => $label) {
                $fieldName = $field . '_' . $index;
                if(isset($casedata->$fieldName) && $casedata->$fieldName) {
                    $compensation_text_additional[] = $label;
                }
            }

            $tiltField = 'compensation_tilt_direction_' . $index;
            if(isset($casedata->$tiltField) && $casedata->$tiltField) {
                $direction = is_array($casedata->$tiltField) ? implode(', ', $casedata->$tiltField) : $casedata->$tiltField;
                $compensation_text_additional[] = 'tilt ' . $direction;
            }

            $turnToField = 'compensation_turn_to_direction_' . $index;
            if(isset($casedata->$turnToField) && $casedata->$turnToField) {
                $direction = is_array($casedata->$turnToField) ? implode(', ', $casedata->$turnToField) : $casedata->$turnToField;
                $compensation_text_additional[] = 'turn to ' . $direction;
            }

            $otherEnableField = 'compensation_other_enable_' . $index;
            $otherTextField = 'compensation_other_text_' . $index;
            if(isset($casedata->$otherEnableField) && $casedata->$otherEnableField) {
                $other_text = $casedata->$otherTextField ?? '';
                if($other_text) {
                    $other_text = is_array($other_text) ? implode(', ', $other_text) : $other_text;
                    $compensation_text_additional[] = $other_text;
                } else {
                    $compensation_text_additional[] = 'other';
                }
            }

            // Get residual data for this index
            $residual_text_additional = [];
            if(isset($casedata->{'residual_no_' . $index}) && $casedata->{'residual_no_' . $index}) {
                $residual_text_additional[] = 'no';
            }

            $residual_type_text_additional = '';
            $yesTypeField = 'residual_yes_type_' . $index;
            if(isset($casedata->$yesTypeField) && $casedata->$yesTypeField) {
                $type = is_array($casedata->$yesTypeField) ? implode(', ', $casedata->$yesTypeField) : $casedata->$yesTypeField;
                $residual_type_text_additional = $type;
            }
            $valleculaField = 'residual_yes_check_' . $index;
            if(isset($casedata->$valleculaField) && $casedata->$valleculaField) {
                $residual_type_text_additional .= ($residual_type_text_additional ? ' at ' : '') . 'vallecula';
            }
            if($residual_type_text_additional) {
                $residual_text_additional[] = $residual_type_text_additional;
            }

            $pyriformField = 'residual_pyriform_sinus_type_' . $index;
            if(isset($casedata->$pyriformField) && $casedata->$pyriformField) {
                $type = is_array($casedata->$pyriformField) ? implode(', ', $casedata->$pyriformField) : $casedata->$pyriformField;
                $residual_text_additional[] = $type . ' pyriform sinus';
            }

            // Get PAS data for this index
            $pas_text_additional = [];
            $penetrationField = 'pas_penetration_' . $index;
            if(isset($casedata->$penetrationField) && $casedata->$penetrationField) {
                $pas_text_additional[] = 'penetration';
            }

            $aspirationField = 'pas_aspiration_' . $index;
            if(isset($casedata->$aspirationField) && $casedata->$aspirationField) {
                $pas_text_additional[] = 'aspiration';
            }

            $levelField = 'pas_level_' . $index;
            if(isset($casedata->$levelField) && $casedata->$levelField) {
                $level = is_array($casedata->$levelField) ? implode(', ', $casedata->$levelField) : $casedata->$levelField;
                $pas_text_additional[] = 'PAS ' . $level;
            }

            // Get Safety data for this index
            $safety_text_additional = [];
            $safeField = 'safety_safe_' . $index;
            if(isset($casedata->$safeField) && $casedata->$safeField) {
                $safety_text_additional[] = 'safe';
            }

            $notSafeField = 'safety_not_safe_' . $index;
            if(isset($casedata->$notSafeField) && $casedata->$notSafeField) {
                $safety_text_additional[] = 'not safe';
            }

            $freeTextField = 'safety_free_text_' . $index;
            if(isset($casedata->$freeTextField) && $casedata->$freeTextField) {
                $free_text = is_array($casedata->$freeTextField) ? implode(', ', $casedata->$freeTextField) : $casedata->$freeTextField;
                $safety_text_additional[] = $free_text;
            }

            // Get freetext data for this index
            $freetextField = 'test_free_text_' . $index;
            $freetext_value = null;
            if(isset($casedata->$freetextField) && $casedata->$freetextField) {
                $freetext_value = is_array($casedata->$freetextField) ? implode(', ', $casedata->$freetextField) : $casedata->$freetextField;
            }

            $grouped_test_data[$index] = [
                'test' => $test_value,
                'freetext' => $freetext_value,
                'compensation' => !empty($compensation_text_additional) ? implode(', ', $compensation_text_additional) : null,
                'residual' => !empty($residual_text_additional) ? implode(', ', $residual_text_additional) : null,
                'pas' => !empty($pas_text_additional) ? implode(', ', $pas_text_additional) : null,
                'safety' => !empty($safety_text_additional) ? implode(', ', $safety_text_additional) : null,

            ];
        }
    }
@endphp

@if(!empty($grouped_test_data))
    @foreach($grouped_test_data as $index => $testGroup)
    <tr style="line-height: 8px;" class="set-font-family">
        <td style="vertical-align:top" colspan="2">
            <span class="casetitle">TEST :</span>
            @if($testGroup['test'])
                <span class="casetext">{{ $testGroup['test'] }}</span>
            @endif
            @if($testGroup['freetext'])
                <span class="casetext">{{ $testGroup['freetext'] }}</span>
            @endif
            @if(!$testGroup['test'] && !$testGroup['freetext'])
                <span class="casetext">-</span>
            @endif
        </td>
    </tr>



    @if($testGroup['compensation'])
    <tr style="line-height: 8px;">
        <td>
            <span class="casetitle" style="font-size: 10px; color: #0AB39C;">COMPENSATION :</span> <span class="casetext">{{ $testGroup['compensation'] }}</span>
        </td>
    </tr>
    @endif

    @php
        $test_details = [];
        if($testGroup['residual']) {
            $test_details[] = '<span class="casetitle" style="font-size: 10px; color: #0AB39C;">RESIDUAL :</span> <span class="casetext">' . $testGroup['residual'] . '</span>';
        }
        if($testGroup['pas']) {
            $test_details[] = '<span class="casetitle" style="font-size: 10px; color: #0AB39C;">PAS :</span> <span class="casetext">' . $testGroup['pas'] . '</span>';
        }
        if($testGroup['safety']) {
            $test_details[] = '<span class="casetitle" style="font-size: 10px; color: #0AB39C;">SAFETY :</span> <span class="casetext">' . $testGroup['safety'] . '</span>';
        }
    @endphp

    @if(!empty($test_details))
    <tr style="line-height: 8px;">
        <td>
            {!! implode(' ', $test_details) !!}
        </td>
    </tr>
    @endif

    @php
        // Get safety_freetext for this index
        $safety_freetext_value = null;
        if($index == 0) {
            // Main form
            if(isset($casedata->safety_freetext) && $casedata->safety_freetext) {
                $safety_freetext_value = is_array($casedata->safety_freetext) ? implode(', ', $casedata->safety_freetext) : $casedata->safety_freetext;
            }
        } else {
            // Additional items
            $safety_freetext_field = 'safety_freetext_' . $index;
            if(isset($casedata->$safety_freetext_field) && $casedata->$safety_freetext_field) {
                $safety_freetext_value = is_array($casedata->$safety_freetext_field) ? implode(', ', $casedata->$safety_freetext_field) : $casedata->$safety_freetext_field;
            }
        }
    @endphp

    @if($safety_freetext_value)
    <tr style="line-height: 8px;">
        <td>
            <span class="casetitle" style="font-size: 10px; color: #0AB39C;"></span>
            <span class="casetext">{!! nl2br(e(is_array($safety_freetext_value) ? implode(', ', $safety_freetext_value) : $safety_freetext_value)) !!}</span>
        </td>
    </tr>
    @endif

    {{-- @if(!$loop->last)
    <tr style="line-height: 4px;">
        <td colspan="2">&nbsp;</td>
    </tr>
    @endif --}}
    @endforeach
@else
<tr style="line-height: 8px;" class="set-font-family">
    <td style="vertical-align:top" colspan="2">
        <span class="casetitle">TEST :</span>
        <span class="casetext">-</span>
    </td>
</tr>
@endif

@if(isset($casedata->diagnostic_free_text) && $casedata->diagnostic_free_text)
<tr style="line-height: 8px;">
    <td >
        <span class="casetitle">DIAGNOSTIC :</span>
        <span class="casetext">{!! nl2br(e(is_array($casedata->diagnostic_free_text) ? implode(', ', $casedata->diagnostic_free_text) : $casedata->diagnostic_free_text)) !!}</span>
    </td>
</tr>
@endif

<tr style="line-height: 8px;">
    <td >
        <span class="casetitle">COMPLICATIONS :</span>
        @php
            $complications_text = [];

            if(isset($casedata->complications_no) && $casedata->complications_no) {
                $complications_text[] = 'no';
            }
            if(isset($casedata->complications_free_text) && $casedata->complications_free_text) {
                $free_text = is_array($casedata->complications_free_text) ? implode(', ', $casedata->complications_free_text) : $casedata->complications_free_text;
                $complications_text[] = $free_text;
            }
        @endphp
        @if(!empty($complications_text))
            <span class="casetext">{{ implode(', ', $complications_text) }}</span>
        @else
            <span class="casetext">-</span>
        @endif
    </td>
</tr>

<tr style="line-height: 8px;">
    <td >
        <span class="casetitle">ADVICE :</span>
        @php
            $advice_text = [];

            if(isset($casedata->advice_liquid) && $casedata->advice_liquid) {
                $liquid = is_array($casedata->advice_liquid) ? implode(', ', $casedata->advice_liquid) : $casedata->advice_liquid;
                $advice_text[] = 'Liquid: ' . $liquid;
            }
            if(isset($casedata->advice_food) && $casedata->advice_food) {
                $food = is_array($casedata->advice_food) ? implode(', ', $casedata->advice_food) : $casedata->advice_food;
                $advice_text[] = 'Food IDDSI: ' . $food;
            }

            $purpose_text = [];
            if(isset($casedata->advice_purpose_eating) && $casedata->advice_purpose_eating) {
                $purpose_text[] = 'eating';
            }
            if(isset($casedata->advice_purpose_training) && $casedata->advice_purpose_training) {
                $purpose_text[] = 'training';
            }
            if(!empty($purpose_text)) {
                $advice_text[] = 'for ' . implode(', ', $purpose_text);
            }
        @endphp
        @if(!empty($advice_text))
            <span class="casetext">{{ implode(', ', $advice_text) }}</span>
        @else
            <span class="casetext">-</span>
        @endif
    </td>
</tr>

<tr style="line-height: 8px;">
    <td >
        <span class="casetitle">COMPENSATE TECHNIQUE :</span>
        @php
            $technique_text = [];

            if(isset($casedata->technique_small_volume_check) && $casedata->technique_small_volume_check) {
                $technique_text[] = 'small volume';
            }
            if(isset($casedata->technique_slow_rate_check) && $casedata->technique_slow_rate_check) {
                $technique_text[] = 'slow rate';
            }
            if(isset($casedata->technique_chin_tuck_check) && $casedata->technique_chin_tuck_check) {
                $technique_text[] = 'chin tuck';
            }
            if(isset($casedata->technique_double_swallow_check) && $casedata->technique_double_swallow_check) {
                $technique_text[] = 'double swallow';
            }
            if(isset($casedata->technique_multiple_swallow_check) && $casedata->technique_multiple_swallow_check) {
                $technique_text[] = 'multiple swallow';
            }
            // Check for technique tilt (no checkbox needed)
            if(isset($casedata->technique_tilt) && $casedata->technique_tilt) {
                $direction = is_array($casedata->technique_tilt) ? implode(', ', $casedata->technique_tilt) : $casedata->technique_tilt;
                $technique_text[] = 'tilt ' . $direction;
            }
            // Check for technique turn to (no checkbox needed)
            if(isset($casedata->technique_turn_to) && $casedata->technique_turn_to) {
                $direction = is_array($casedata->technique_turn_to) ? implode(', ', $casedata->technique_turn_to) : $casedata->technique_turn_to;
                $technique_text[] = 'turn to ' . $direction;
            }
            if(isset($casedata->technique_recline_check) && $casedata->technique_recline_check) {
                $technique_text[] = 'recline';
            }
            if(isset($casedata->technique_mendelsohn_maneuver_check) && $casedata->technique_mendelsohn_maneuver_check) {
                $technique_text[] = 'Mendelsohn maneuver';
            }
            if(isset($casedata->technique_cough_technique_free_text) && $casedata->technique_cough_technique_free_text) {
                $free_text = is_array($casedata->technique_cough_technique_free_text) ? implode(', ', $casedata->technique_cough_technique_free_text) : $casedata->technique_cough_technique_free_text;
                $technique_text[] = $free_text;
            }
        @endphp
        @if(!empty($technique_text))
            <span class="casetext">{{ implode(', ', $technique_text) }}</span>
        @else
            <span class="casetext">-</span>
            @endif
    </td>
</tr>

<tr style="line-height: 8px;">
    <td >
        <span class="casetitle">EXERCISE :</span>
        @php
            $exercise_text = [];

            if(isset($casedata->exercise_basic_oromotor_check) && $casedata->exercise_basic_oromotor_check) {
                $exercise_text[] = 'basic oromotor';
            }
            if(isset($casedata->exercise_lingual_check) && $casedata->exercise_lingual_check) {
                $exercise_text[] = 'lingual';
            }
            if(isset($casedata->exercise_base_of_tongue_check) && $casedata->exercise_base_of_tongue_check) {
                $exercise_text[] = 'base of tongue';
            }
            if(isset($casedata->exercise_ctar_check) && $casedata->exercise_ctar_check) {
                $exercise_text[] = 'CTAR';
            }
            if(isset($casedata->exercise_shaker_check) && $casedata->exercise_shaker_check) {
                $exercise_text[] = 'shaker';
            }
            if(isset($casedata->exercise_vocal_cord_exercise_check) && $casedata->exercise_vocal_cord_exercise_check) {
                $exercise_text[] = 'vocal cord exercise';
            }
            if(isset($casedata->exercise_mendelsohn_check) && $casedata->exercise_mendelsohn_check) {
                $exercise_text[] = 'Mendelsohn';
            }
            if(isset($casedata->exercise_neck_exercise_check) && $casedata->exercise_neck_exercise_check) {
                $exercise_text[] = 'neck exercise';
            }
            if(isset($casedata->exercise_breathing_exercise_check) && $casedata->exercise_breathing_exercise_check) {
                $exercise_text[] = 'breathing exercise';
            }
            if(isset($casedata->exercise_cough_technique_check) && $casedata->exercise_cough_technique_check) {
                $exercise_text[] = 'cough technique';
            }
        @endphp
        @if(!empty($exercise_text))
            <span class="casetext">{{ implode(', ', $exercise_text) }}</span>
        @else
            <span class="casetext">-</span>
        @endif
    </td>
</tr>

@if(isset($casedata->suggestion) && $casedata->suggestion)
<tr style="line-height: 8px;">
    <td >
        <span class="casetitle">SUGGESTION :</span>
        <span class="casetext">{!! nl2br(e(is_array($casedata->suggestion) ? implode(', ', $casedata->suggestion) : $casedata->suggestion)) !!}</span>
    </td>
</tr>
@endif
