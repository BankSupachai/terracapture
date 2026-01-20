<?php

use App\Models\Server;


 function print_text_table($data, $str)
{
    try {
        if (isset($data)) {
            if (gettype($data) == 'string' || gettype($data) == 'integer') {
                $str = $data;
            }
        }
    } catch (\Throwable $th) {
    }
    return $str;
}




    function tbexcel($json,$name,$table,$where,$col){
        $str = "";
        if(isset($json->$name)){
            if($json->$name!=null||$json->$name!=0){
                $data = DB::table($table)->where($where,$json->$name)->first();
                $str .= $data->$col;
            }
        }
        return $str;
    }

    function format_medication($medication_units, $medi_select) {
        $medication = [];
        foreach ($medication_units as $key => $medi) {
            if (isset($medi['dose'])) {
                $medication[] = $key . " " . $medi['dose'] . " " . $medi['unit'];
            } elseif (in_array($key, $medi_select)) {
                $medication[] = $key;
            }
        }
        return format_array_to_string($medication);
    }

    function format_mainpart($mainparts) {
        $mainpart = [];
        foreach ($mainparts as $key => $main) {
            if ($main) {
                if(gettype($main) == 'array'){
                    $main = implode('', $main);
                }
                $mainpart[] = $key . "-" . $main;
            }
        }
        return format_array_to_string($mainpart);
    }

    function format_complication($case) {
        $complication = format_array_to_string($case->managecomplication0 ?? [], false);
        if (!empty($case->managecomplication1)) {
            $complication .= ' ; ' . format_array_to_string($case->managecomplication1, false);
        }
        if (!empty($case->complication_other)) {
            $complication .= ' ; ' . format_array_to_string($case->complication_other, false);
        }
        return $complication;
    }

    function format_specimen($case) {
        $specimen_str = '';
        for ($i = 1; $i < 20; $i++) {
            if (empty($case->{"specimen" . $i})) {
                continue;
            }
            $specimen = format_array_to_string($case->{"specimen" . $i}, false);
            if (!empty($case->{"specimenbottle" . $i})) {
                $specimen .= ' ' . format_array_to_string($case->{"specimenbottle" . $i}, false) . ' bottle';
            }
            $specimen_str .= $specimen . ' ; ';
        }
        return rtrim($specimen_str, ' ; ');
    }

    function format_needcode($data, $type, $procedurename) {
        $needcode = [];
        foreach ($data as $item) {
            $code = $type == 'icd10' ? get_icd10_code($item, $procedurename) : get_icd9_code($item, $procedurename);
            if (!empty($code)) {
                $needcode[] = $code;
            }
        }
        return format_array_to_string($needcode);
    }

    function format_user_data($user_in_case, $type) {
        $users = [];
        foreach ($user_in_case as $user_id) {
            $user = get_user_data(intval($user_id));
            $user_type = $user->user_type ?? '';
            $user_fullname = @$user->user_prefix."" . " " . @$user->user_firstname."" . " " . @$user->user_lastname."";

            switch ($type) {
                case 'nurse':
                    if ($user_type == 'nurse') {
                        $users[] = $user_fullname;
                    }
                    break;
                case 'nurse_assist':
                    if ($user_type == 'viewer' || strpos($user_type, 'assist') !== false || $user_type == 'register') {
                        $users[] = $user_fullname;
                    }
                    break;
                case 'anesthesia':
                    if (strpos($user_type, 'anes') !== false) {
                        $users[] = $user_fullname;
                    }
                    break;
                case 'attendant':
                    if ($user_type != 'nurse' && $user_type != 'viewer' && strpos($user_type, 'assist') === false && $user_type != 'register' && strpos($user_type, 'anes') === false) {
                        $users[] = $user_fullname;
                    }
                    break;
            }
        }
        return format_array_to_string($users);
    }

    function determine_status($statusjob) {
        $status = "Incomplete";
        try {
            if (strpos(strtolower($statusjob), 'recovery') !== false || strpos(strtolower($statusjob), 'discharge') !== false) {
                $status = "Complete";
            }
        } catch (\Exception $e) {
            // Handle exception if needed
        }
        return $status;
    }

    function format_scopes($scopes) {
        $result = ['scopes' => [], 'scopes_only' => []];
        foreach ($scopes as $scope_id) {
            $scope_id = intval($scope_id);
            $scope_data = get_scope_data($scope_id, 'scope_id');
            if ($scope_data) {
                if (isset($scope_data->scope_name)) {
                    $result['scopes'][] = $scope_data->scope_name;
                }
                $str = $scope_data->scope_name ?? '';
                if (isset($scope_data->scope_model)) {
                    $str .= ' (' . $scope_data->scope_model . ')';
                }
                $result['scopes_only'][] = $str;
            }
        }
        return ['scopes' => format_array_to_string($result['scopes']), 'scopes_only' => format_array_to_string($result['scopes_only'])];
    }

    function format_bowel($bowel) {
        if (is_int($bowel)) {
            switch ($bowel) {
                case 1:
                    return "Excellent";
                case 2:
                    return "Good";
                case 3:
                    return "Fair";
                case 4:
                    return "Poor";
                default:
                    return "";
            }
        } elseif (is_string($bowel)) {
            return $bowel;
        } else {
            return check_is_array($bowel);
        }
    }

    function format_cases($case, $values, $onlyprocedure=false) {
        $case             = (object) $case;
        $gender           = get_patient_data($case->case_hn, 'gender') == 1 ? 'Male' : 'Female';
        $appointment      = format_date($case->appointment, 'Y-m-d');
        $rapid_urease     = isset($case->rapid_urease_test) && strlen($case->rapid_urease_test) > 30 ? 'Pending' : ($case->rapid_urease_test ?? '');
        $branch           = get_user_branch($case->case_physicians01);
        $department       = $case->department ?? '';

        $scopes           = format_scopes($case->scope ?? []);
        $medication       = format_medication($case->medication_unit ?? [], $case->select ?? []);
        $mainpart         = format_mainpart($case->mainpart ?? []);
        $complication     = format_complication($case);
        $postdiagnosis10  = format_array_to_string($case->diagnostic_text ?? []);
        $procedureicd9    = format_array_to_string($case->procedure_subtext ?? []);
        $indication       = format_array_to_string($case->indication ?? []);
        $specimen_str     = format_specimen($case);
        $needcode_icd10   = format_needcode($case->diagnostic ?? [], 'icd10', $case->procedurename);
        $needcode_icd9    = format_needcode($case->procedure_sub ?? [], 'icd9', $case->procedurename);
        $attendant        = format_user_data($case->user_in_case ?? [], 'attendant');
        $nurse            = format_user_data($case->user_in_case ?? [], 'nurse');
        $nurse_assist     = format_user_data($case->user_in_case ?? [], 'nurse_assist');
        $anesthesia       = format_user_data($case->user_in_case ?? [], 'anesthesia');
        $status           = determine_status($case->statusjob ?? '');

        $medi_str = trim(
            format_array_to_string($case->medi_other ?? [], false) . ' ' .
            format_array_to_string($case->medi_otherdose ?? [], false) . ' ' .
            format_array_to_string($case->medi_otherunit ?? [], false)
        ) ?? '';

        if ($medi_str === ';') {
            $medi_str = '';
        }

        $bowel = format_bowel($case->bowel ?? '');

        $data = [
            'Case ID' => $case->case_id ?? '',
            'HN' => $case->case_hn ?? '',
            'Name' => $case->patientname ?? '',
            'Age' => $case->age ?? '',
            'Gender' => $gender,
            'Appointment Date' => $appointment,
            'Operation Date' => $appointment,
            'Procedure' => $case->procedurename ?? '',
            'Endoscopist' => $case->doctorname ?? '',
            'User Department' => $branch,
            'Department (Case)' => $department,
            'Attendant' => $attendant,
            'Nurse' => $nurse,
            'Nurse Assistant' => $nurse_assist,
            'Anesthesia' => $anesthesia,
            'Scope' => $scopes['scopes'],
            'Room' => $case->room_name ?? '',
            'Ward' => $case->ward ?? '',
            'OPD' => $case->opd ?? '',
            'Refer' => $case->refer ?? '',
            'Patient In' => $case->time_patientin ?? '',
            'Operation Start' => $case->time_start ?? '',
            'Operation End' => $case->time_end ?? '',
            'Withdrawal (min)' => $case->time_withdrawal ?? '',
            'Endoscope' => $scopes['scopes_only'],
            'Followup' => !empty($case->followup_date) ? $case->followup_date . ' days' : '',
            'Gastric Content' => format_array_to_string($case->gastriccontent ?? []) . (!empty($case->gastriccontent_other) ? ' ; ' . format_array_to_string($case->gastriccontent_other ?? [], false) : ''),
            'Bowel Preparation' => $bowel,
            'Brief History' => format_array_to_string($case->case_history ?? []),
            'Pre-Diagnosis' => format_array_to_string($case->prediagnostic_other ?? []),
            'Anesthesis' => format_array_to_string($case->anesthesia ?? []) . (!empty($case->anesthesiaother) ? ' ; ' . format_array_to_string($case->anesthesiaother ?? [], false) : ''),
            'Medication' => $medication . (!empty($medi_str) ? ' ; ' . $medi_str : ''),
            'Indication' => $indication . (!empty($case->indication_other) ? ' ; ' . format_array_to_string($case->indication_other ?? [], false) : ''),
            'Finding' => $mainpart,
            'Overall Finding' => format_array_to_string($case->overall_finding ?? []),
            'Post-Diagnosis' => $postdiagnosis10,
            'Post-Diagnosis (other)' => format_array_to_string($case->overall_diagnosis ?? []),
            'Procedures' => $procedureicd9,
            'ICD-10' => $needcode_icd10,
            'ICD-9' => $needcode_icd9,
            'Rapid Urease Test' => $case->rapid_other ?? '',
            'Complication' => $complication,
            'Estimate blood loss' => format_array_to_string($case->blood_loss ?? []) . (isset($case->blood_loss) ? ' ml' : ''),
            'Blood Transfusion' => format_array_to_string($case->blood_transfusion ?? []) . (isset($case->blood_transfusion) ? ' ml' : ''),
            'Specimen' => $specimen_str,
            'Comment' => format_array_to_string($case->case_comment ?? []),
            'Status' => $status,
        ];

        $result = [];
        foreach ($values as $key=>$val) {
            $result[$key] = $data[$key] ?? '';
        }

        return $onlyprocedure ? $result : $data;
    }


    function split_searchtext_condition($searchText){
        $ands = [];
        $ors = [];
        $parts = preg_split('/\s+/', $searchText);
        foreach ($parts as $part) {
            $sub_parts = preg_split('/([+,])/', $part, -1, PREG_SPLIT_DELIM_CAPTURE);
            $current_ands = [];
            $current_ors = [];
            $separator = '';

            foreach ($sub_parts as $sub_part) {
                if ($sub_part === '+') {
                    $separator = '+';
                } elseif ($sub_part === ',') {
                    $separator = ',';
                } else {
                    if ($separator === '+') {
                        $current_ands[] = trim($sub_part);
                    } elseif ($separator === ',') {
                        $current_ors[] = trim($sub_part);
                    } else {
                        $current_ands[] = trim($sub_part);
                    }
                    $separator = '';
                }
            }

            $ands = array_merge($ands, $current_ands);
            $ors = array_merge($ors, $current_ors);
        }
        return ['and_conditions' => $ands, 'or_conditions' => $ors];
      }

    function getDistinctKeys($procederename){
        $limit  = 1000;
        $cases  = Server::table('tb_case')->where('procedurename', $procederename)->orderBy('caseuniq', 'asc')->limit($limit)->get() ?? [];
        $allKeys = [];
        $requiredKeys = [];
        $minimumOccurrence = $limit * 0.1;

        foreach ($cases as $case) {
            foreach ($case as $key => $value) {
                if (!in_array($key, $allKeys)) {
                    $allKeys[] = $key;
                }
                if ($value !== null && $value !== '') {
                    $requiredKeys[$key] = isset($requiredKeys[$key]) ? $requiredKeys[$key] + 1 : 1;
                }
            }
        }

        $filteredKeys = array_filter($requiredKeys, function ($count) use ($minimumOccurrence) {
          return $count >= $minimumOccurrence;
        });
        $filteredKeys = array_keys($filteredKeys);

        $keys = (new \App\Exports\CasesExport(collect()))->keys();

        $filteredKeys = array_values(array_intersect($keys, $filteredKeys));
        if(!in_array('operationdate', $filteredKeys)){
            $filteredKeys[] = 'operationdate';
        }

        return $filteredKeys;
    }

    function get_head_row($procedure, $data){
        $casesexport = new \App\Exports\CasesExport(collect());
        $data['heads']  = [];
        $data['values'] = [];
        if(!empty($procedure)){
            $distinctkeys = getDistinctKeys($procedure);
            $data['values'] = $casesexport->getMatchingHeadings($distinctkeys);
            $mappedkey = array_flip(array_intersect_key($casesexport->match_key(), array_flip($distinctkeys)));
            foreach ($mappedkey as $heading => $key) {
                $data['heads'][$heading] = $data['values'][$key] ?? 'hide';
            }
        } else {
            $data['heads']  = array_fill_keys($casesexport->headings(), 'show');
            $data['values'] = array_fill_keys($casesexport->keys(), 'show');
        }

        $data['heads']['Status'] = 'show';
        $data['values']['status'] = 'show';

        return $data;
    }


