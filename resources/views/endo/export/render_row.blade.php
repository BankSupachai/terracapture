@foreach (isset($cases)?$cases:[] as $index=>$case)
    @php
    // dd($case)
        $case         = (object) $case;
        $gender           = get_patient_data($case->case_hn, 'gender') == 1 ? 'Male' : 'Female';
        $appointment      = format_date($case->appointment, 'Y-m-d');
        $rapid_urease     = isset($case->rapid_urease_test) && strlen($case->rapid_urease_test) > 30 ? 'Pending' : ($case->rapid_urease_test ?? '');
        $branch           = get_user_branch($case->case_physicians01);
        $department       = $case->department ?? '';

        $scopes           = format_scopes($case->scope ?? [])['scopes'];
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

    @endphp
    {{-- <tr @if(@$tbody_id.""=="table_show") data-display-ori="{{@$display_ori.""}}" data-display-new="{{@$display_new.""}}" style="display: {{@$display_new.""}};" @endif>
        <th @if(@$values['case_id']."" == 'hide') hidden @endif scope="row"><a href="javascript:;" class="fw-semibold">{{@$case->case_id}}</a></th>
        <td>{{@$case->case_hn}}</td>
        <td>{{@$case->patientname}}</td>
        <td>{{@$case->age}}</td>
        <td>{{@$gender}}</td>
        <td>{{@$appointment}}</td>
        <td>{{@$appointment}}</td>
        <td>{{@$case->procedurename}}</td>
        <td>{{@$case->doctorname}}</td>
        <td>{{@$branch}}</td>
        <td>{{@$department}}</td>
        <td>{{@$attendant}}</td>
        <td>{{@$nurse}}</td>
        <td>{{@$nurse_assist}}</td>
        <td>{{@$anesthesia}}</td>
        <td>{{@$scopes}}</td>
        <td>{{@$case->room_name}}</td>
        <td>{{@$case->ward}}</td>
        <td>{{@$case->opd}}</td>
        <td>{{@$case->refer}}</td>
        <td>{{@$case->time_patientin}}</td>
        <td>{{@$case->time_start}}</td>
        <td>{{@$case->time_end}}</td>
        <td>{{@$case->time_withdrawal}}</td>
        <td>{{@$scopes_only}}</td>
        <td>@if(isset($case->followup_date) && @$case->followup_date."" != "") {{@$case->followup_date}} days  @endif</td>
        <td>{{@format_array_to_string($case->gastriccontent)}} @if(!empty($case->gastriccontent_other)) ; {{@format_array_to_string(@$case->gastriccontent_other, false)}}  @endif</td>
        <td>{{check_is_array(@$case->bowel)}}</td>
        <td>{{check_is_array(@$case->case_history)}}</td>
        <td>{{check_is_array(@$case->prediagnostic_other)}}</td>
        <td>{{@format_array_to_string($case->anesthesia)}} @if(!empty($case->anesthesiaother)) ; {{@format_array_to_string(@$case->anesthesiaother, false)}}  @endif</td>
        <td>{{@$medication}} @if(!empty($medi_str)) ; {{@$medi_str}} @endif</td>
        <td>{{@$indication}} @if(!empty($case->indication_other)) ; {{@format_array_to_string(@$case->indication_other, false)}}  @endif</td>
        <td>{{@$mainpart}}</td>
        <td>{{check_is_array(@$case->overall_finding)}}</td>
        <td>{{@$postdiagnosis10}}</td>
        <td>{{check_is_array(@$case->overall_diagnosis)}}</td>
        <td>{{@$procedureicd9}}</td>
        <td>{{@$needcode_icd10}}</td>
        <td>{{@$needcode_icd9}}</td>
        <td>{{@$case->rapid_other}}</td>
        <td>{{@$complication}}</td>
        <td>{{check_is_array(@$case->blood_loss)}} @isset($case->blood_loss) ml @endisset</td>
        <td>{{check_is_array(@$case->blood_transfusion)}} @isset($case->blood_transfusion) ml @endisset</td>
        <td>{{@$specimen_str}}</td>
        <td>{{check_is_array(@$case->case_comment)}}</td>
        <td>{{@$status}}</td>
    </tr> --}}


    <tr @if(@$tbody_id.""=="table_show") data-display-ori="{{@$display_ori.""}}" data-display-new="{{@$display_new.""}}" style="display: {{@$display_new.""}};" @endif>
        <th @if(@$values['case_id']."" == 'hide') hidden @endif scope="row">
            <a href="javascript:;" class="fw-semibold">{{ @$case->case_id }}</a>
        </th>
        {{-- @dd($values); --}}
        <td @if(@$values['case_hn']."" == 'hide') hidden @endif>{{ @$case->case_hn }}</td>
        <td @if(@$values['patientname']."" == 'hide') hidden @endif>{{ @$case->patientname }}</td>
        <td @if(@$values['age']."" == 'hide') hidden @endif>{{ @$case->age }}</td>
        <td @if(@$values['gender']."" == 'hide') hidden @endif>{{ @$gender }}</td>
        <td @if(@$values['appointment']."" == 'hide') hidden @endif>{{ @$appointment }}</td>
        <td @if(@$values['appointment']."" == 'hide') hidden @endif>{{ @$appointment }}</td>
        <td @if(@$values['procedurename']."" == 'hide') hidden @endif>{{ @$case->procedurename }}</td>
        <td @if(@$values['doctorname']."" == 'hide') hidden @endif>{{ @$case->doctorname }}</td>
        <td @if(@$values['branch']."" == 'hide') hidden @endif>{{ @$branch }}</td>
        <td @if(@$values['department']."" == 'hide') hidden @endif>{{ @$department }}</td>
        <td @if(@$values['attendant']."" == 'hide') hidden @endif>{{ @$attendant }}</td>
        <td @if(@$values['nurse']."" == 'hide') hidden @endif>{{ @$nurse }}</td>
        <td @if(@$values['nurse_assist']."" == 'hide') hidden @endif>{{ @$nurse_assist }}</td>
        <td @if(@$values['anesthesia']."" == 'hide') hidden @endif>{{ @$anesthesia }}</td>
        <td @if(@$values['scopes']."" == 'hide') hidden @endif>{{ @$scopes }}</td>
        <td @if(@$values['room_name']."" == 'hide') hidden @endif>{{ @$case->room_name }}</td>
        <td @if(@$values['ward']."" == 'hide') hidden @endif>{{ @$case->ward }}</td>
        <td @if(@$values['opd']."" == 'hide') hidden @endif>{{ @$case->opd }}</td>
        <td @if(@$values['refer']."" == 'hide') hidden @endif>{{ @$case->refer }}</td>
        <td @if(@$values['time_patientin']."" == 'hide') hidden @endif>{{ @$case->time_patientin }}</td>
        <td @if(@$values['time_start']."" == 'hide') hidden @endif>{{ @$case->time_start }}</td>
        <td @if(@$values['time_end']."" == 'hide') hidden @endif>{{ @$case->time_end }}</td>
        <td @if(@$values['time_withdrawal']."" == 'hide') hidden @endif>{{ @$case->time_withdrawal }}</td>
        <td @if(@$values['scopes_only']."" == 'hide') hidden @endif>{{ @$scopes_only }}</td>
        <td @if(@$values['followup_date']."" == 'hide') hidden @endif>
            @if(isset($case->followup_date) && @$case->followup_date."" != "")
                {{ @$case->followup_date }} days
            @endif
        </td>
        <td @if(@$values['gastriccontent']."" == 'hide') hidden @endif>
            {{ @format_array_to_string($case->gastriccontent) }}
            @if(!empty($case->gastriccontent_other))
                ; {{ @format_array_to_string(@$case->gastriccontent_other, false) }}
            @endif
        </td>
        <td @if(@$values['bowel']."" == 'hide') hidden @endif>{{ check_is_array(@$case->bowel) }}</td>
        <td @if(@$values['case_history']."" == 'hide') hidden @endif>{{ check_is_array(@$case->case_history) }}</td>
        <td @if(@$values['prediagnostic_other']."" == 'hide') hidden @endif>{{ check_is_array(@$case->prediagnostic_other) }}</td>
        <td @if(@$values['anesthesia']."" == 'hide') hidden @endif>
            {{ @format_array_to_string($case->anesthesia) }}
            @if(!empty($case->anesthesiaother))
                ; {{ @format_array_to_string(@$case->anesthesiaother, false) }}
            @endif
        </td>
        <td @if(@$values['medication']."" == 'hide') hidden @endif>
            {{ @$medication }}
            @if(!empty($medi_str))
                ; {{ @$medi_str }}
            @endif
        </td>
        <td @if(@$values['indication']."" == 'hide') hidden @endif>
            {{ @$indication }}
            @if(!empty($case->indication_other))
                ; {{ @format_array_to_string(@$case->indication_other, false) }}
            @endif
        </td>
        <td @if(@$values['mainpart']."" == 'hide') hidden @endif>{{ @$mainpart }}</td>
        <td @if(@$values['overall_finding']."" == 'hide') hidden @endif>{{ check_is_array(@$case->overall_finding) }}</td>
        <td @if(@$values['postdiagnosis10']."" == 'hide') hidden @endif>{{ @$postdiagnosis10 }}</td>
        <td @if(@$values['overall_diagnosis']."" == 'hide') hidden @endif>{{ check_is_array(@$case->overall_diagnosis) }}</td>
        <td @if(@$values['procedureicd9']."" == 'hide') hidden @endif>{{ @$procedureicd9 }}</td>
        <td @if(@$values['needcode_icd10']."" == 'hide') hidden @endif>{{ @$needcode_icd10 }}</td>
        <td @if(@$values['needcode_icd9']."" == 'hide') hidden @endif>{{ @$needcode_icd9 }}</td>
        <td @if(@$values['rapid_other']."" == 'hide') hidden @endif>{{ @$case->rapid_other }}</td>
        <td @if(@$values['complication']."" == 'hide') hidden @endif>{{ @$complication }}</td>
        <td @if(@$values['blood_loss']."" == 'hide') hidden @endif>
            {{ check_is_array(@$case->blood_loss) }}
            @isset($case->blood_loss)
                ml
            @endisset
        </td>
        <td @if(@$values['blood_transfusion']."" == 'hide') hidden @endif>
            {{ check_is_array(@$case->blood_transfusion) }}
            @isset($case->blood_transfusion)
                ml
            @endisset
        </td>
        <td @if(@$values['specimen_str']."" == 'hide') hidden @endif>{{ @$specimen_str }}</td>
        <td @if(@$values['case_comment']."" == 'hide') hidden @endif>{{ check_is_array(@$case->case_comment) }}</td>
        <td @if(@$values['status']."" == 'hide') hidden @endif>{{ @$status }}</td>
    </tr>


@endforeach


