<tr class="set-font-family" style="line-height:{{$body_line}};">
    <td>
        <span class="casetitle">Boston Bowel Prep Score :</span>
        @php
            $show_score = isset($casedata->boston_score);
            $boston_status = '';
            if ($show_score) {
                $bowel_score = @$casedata->bowel_score;
                $total_score = $casedata->boston_score;

                // ตรวจสอบว่ามีส่วนไหนได้คะแนน 0 หรือ 1 หรือไม่
                $has_low_score = false;
                if (isset($bowel_score)) {
                    // รองรับทั้ง object และ array
                    $left_side = null;
                    $transverse_colon = null;
                    $right_side = null;

                    if (is_object($bowel_score)) {
                        $left_side = isset($bowel_score->left_side) ? (int)$bowel_score->left_side : null;
                        $transverse_colon = isset($bowel_score->transverse_colon) ? (int)$bowel_score->transverse_colon : null;
                        $right_side = isset($bowel_score->right_side) ? (int)$bowel_score->right_side : null;
                    } elseif (is_array($bowel_score)) {
                        $left_side = isset($bowel_score['left_side']) ? (int)$bowel_score['left_side'] : null;
                        $transverse_colon = isset($bowel_score['transverse_colon']) ? (int)$bowel_score['transverse_colon'] : null;
                        $right_side = isset($bowel_score['right_side']) ? (int)$bowel_score['right_side'] : null;
                    }

                    if (($left_side !== null && ($left_side == 0 || $left_side == 1)) ||
                        ($transverse_colon !== null && ($transverse_colon == 0 || $transverse_colon == 1)) ||
                        ($right_side !== null && ($right_side == 0 || $right_side == 1))) {
                        $has_low_score = true;
                    }
                }

                // ถ้ามีส่วนใดส่วนหนึ่งได้ 0 หรือ 1 → Inadequate
                // ถ้าผลรวม >= 6 และไม่มีส่วนใดได้ 0 หรือ 1 → Adequate
                // ถ้าผลรวม < 6 และไม่มีส่วนใดได้ 0 หรือ 1 → Inadequate
                if ($has_low_score) {
                    $boston_status = 'Inadequate';
                } elseif ($total_score >= 6 && !$has_low_score) {
                    $boston_status = 'Adequate';
                } else {
                    $boston_status = 'Inadequate';
                }

                // เตรียมข้อมูลสำหรับแสดงผล
                $bowel_score_display = '';
                if ($left_side !== null || $transverse_colon !== null || $right_side !== null) {
                    $score_values = array_filter([
                        $left_side,
                        $transverse_colon,
                        $right_side
                    ], function($val) { return $val !== null && $val !== ''; });
                    $bowel_score_display = !empty($score_values) ? implode(",", $score_values) : '';
                } elseif (isset($bowel_score) && is_string($bowel_score)) {
                    $bowel_score_display = $bowel_score;
                }
            }
        @endphp

        @if($show_score)
            <span class="casetext">
                ({{ $boston_status }})
            </span>
        @else
            <span class="casetext">-</span>
        @endif
    </td>
</tr>
