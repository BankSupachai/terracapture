<style>
    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: none !important;
        border-width: 0;
    }
</style>

    <div class="row m-0 p-0 table-list card">
        <div class="card">
            <div class="card-body">
                <table class="table table-nowrap table-borderless">
                    <thead>
                        <tr style="background: #E9EBEC; border: 0 px">
                            <td></td>
                            <td>Operation Date</td>
                            <td>Operation</td>
                            <td>Physician</td>
                            <td>Photo</td>
                            <td>Video</td>
                            <td>Patient in</td>
                            <td>Start time</td>
                            <td>End time</td>
                            <td>Patient out</td>
                            <td>Pre-Diagnosis</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody id="tasksTable" class="">
                        @foreach (isset($tb_case) ? $tb_case : [] as $index => $case)
                            @php
                                if (!isset($case)) {
                                    continue;
                                }
                            @endphp
                            @php
                                $data = (object) $case;
                                $_id = isset($data->id) ? $data->id : '';
                                $date_ori =
                                    isset($data->appointment) && $data->appointment != 0 ? $data->appointment : '';
                                $date =
                                    isset($data->appointment) && $data->appointment != 0
                                        ? format_date($data->appointment, 'd M, Y H:i')
                                        : '';
                                $hn = isset($data->case_hn) ? $data->case_hn : '';
                                $procedurename = isset($data->procedurename) ? $data->procedurename : '';
                                $physician = isset($data->doctorname) ? $data->doctorname : '';
                                $photo = isset($data->photo) ? $data->photo : [];
                                $video = isset($data->video) ? $data->video : [];
                                // $video = get_video_viewer($_id);
                                $patient_in = isset($data->time_patientin) ? $data->time_patientin : '';
                                $start_time = isset($data->time_start) ? $data->time_start : '';
                                $end_time = isset($data->time_end) ? $data->time_end : '';
                                $patient_out = isset($data->time_withdrawal) ? $data->time_withdrawal : '';
                                $prediag = isset($data->prediagnostic_other) ? $data->prediagnostic_other : '';
                                $date_only =
                                    isset($date_ori) && @$date_ori . '' != '' ? explode(' ', $date_ori)[0] : '';

                                $count_selected = 0;
                                for ($i = 0; $i < count($photo); $i++) {
                                    $ns = isset($photo[$i]['ns']) ? intval($photo[$i]['ns']) : 0;
                                    if ($ns > 0) {
                                        $count_selected += 1;
                                    }
                                }

                                $is_endosmart = 'false';
                                // if ($physician == '' && $patient_in == '' && $end_time == '' && $start_time == '' && $patient_out == '' ) {
                                if (@$data->endosmart . '' == 'true') {
                                    $is_endosmart = 'true';
                                    $count_selected = count($photo);
                                }

                            @endphp
                            <tr class="tr-row table_row" id="tr{{ @$_id }}" data-hn="{{ @$hn }}"
                                data-id="{{ @$_id }}" data-date="{{ @$date_only }}"
                                data-endosmart="{{ @$is_endosmart }}">
                                {{-- data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" --}}
                                {{-- onclick="open_detail('{{ @$hn }}', '{{ @$_id }}', '{{ @$date_only }}', '{{ @$is_endosmart }}')" --}}
                                <td>
                                    <div class="col-auto">
                                        <input class="form-check-input compare" type="checkbox"
                                            id="compare{{ $_id }}" data-id="{{ @$_id }}">
                                    </div>
                                </td>
                                <td class="open-offcanvas" data-id="{{ @$_id }}">{{ @$date }}</td>
                                <td class="sort-procedure open-offcanvas" data-id="{{ @$_id }}">
                                    {{ @$procedurename }}</td>
                                <td class="sort sort-physician open-offcanvas" data-id="{{ @$_id }}">
                                    {{ @$physician }}</td>
                                <td class="open-offcanvas" data-id="{{ @$_id }}">{{ @$count_selected }}</td>
                                <td class="open-offcanvas" data-id="{{ @$_id }}">
                                    @if (isset($video))
                                        {{ count($video) }}
                                    @endif
                                </td>
                                <td class="open-offcanvas" data-id="{{ @$_id }}">{{ @$patient_in }}</td>
                                <td class="open-offcanvas" data-id="{{ @$_id }}">{{ @$start_time }}</td>
                                <td class="open-offcanvas" data-id="{{ @$_id }}">{{ @$end_time }}</td>
                                <td class="open-offcanvas" data-id="{{ @$_id }}">{{ @$patient_out }}</td>
                                <td class="sort-prediag open-offcanvas" data-id="{{ @$_id }}">
                                    {{ @$prediag }}
                                </td>
                                <td class="sort-date" hidden>{{ @$date_only }}</td>
                                <td>
                                    @if (isset($data->endosmart))
                                        Endosmart
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                {{-- <div class="sort col-auto" data-sort="accession_n"></div>
    <div class="sort col" data-sort="accession_n"> &ensp; Operation Date</div>
    <div class="sort col" data-sort="modality">Operation</div>
    <div class="sort col-2" data-sort="operation">Physician</div>
    <div class="sort col" data-sort="report">Photo</div>
    <div class="sort col" data-sort="status">Video</div>
    <div class="sort col" data-sort="instances">Patient in</div>
    <div class="sort col" data-sort="complete">Start time</div>
    <div class="sort col" data-sort="study">End time</div>
    <div class="sort col" data-sort="appointment">Patient out</div>
    <div class="sort col" data-sort="description">Pre-Diagnosis</div> --}}
            </div>
        </div>
    </div>


{{-- data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-contro    ls="offcanvasRight" --}}
{{-- <div class="menu-data-list" id="tasksTable">
    @foreach (isset($tb_case) ? $tb_case : [] as $index => $case)
        @php
            $data = (object) $case;
            $_id = isset($data->id) ? $data->id : '';
            $date_ori = isset($data->appointment) && $data->appointment != 0 ? $data->appointment : '';
            $date = isset($data->appointment) && $data->appointment != 0 ? format_date($data->appointment, 'd M, Y H:i') : '';
            $hn = isset($data->case_hn) ? $data->case_hn : '';
            $procedure = isset($data->procedurename) ? $data->procedurename : '';
            $physician = isset($data->doctorname) ? $data->doctorname : '';
            $photo = isset($data->photo) ? $data->photo : [];
            $video = get_video_viewer($_id);
            $patient_in = isset($data->case_time[0]) ? $data->case_time[0] : '';
            $start_time = isset($data->case_time[1]) ? $data->case_time[1] : '';
            $end_time = isset($data->case_time[2]) ? $data->case_time[2] : '';
            $patient_out = isset($data->case_time[3]) ? $data->case_time[3] : '';
            $prediag = isset($data->prediagnostic_other) ? $data->prediagnostic_other : '';
            $date_only = isset($date_ori) && @$date_ori . '' != '' ? explode(' ', $date_ori)[0] : '';

            $count_selected = 0;
            for ($i = 0; $i < count($photo); $i++) {
                $ns = isset($photo[$i]['ns']) ? intval($photo[$i]['ns']) : 0;
                if ($ns > 0) {
                    $count_selected += 1;
                }
            }

            $is_endosmart = 'false';
            if ($physician == '' && $patient_in == '' && $end_time == '' && $start_time == '' && $patient_out == '') {
                $is_endosmart = 'true';
                $count_selected = count($photo);
            }

        @endphp
        <div class="row m-0 table_row "
            onclick="open_detail('{{ @$hn }}', '{{ @$_id }}', '{{ $date_only }}', '{{ $is_endosmart }}')"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-contro ls="offcanvasRight">
            <div class="sort col-auto">
                <input class="form-check-input" type="checkbox" id="formCheck1">

            </div>
            <div class="sort col">

                {{ @$date }}
            </div>
            <div class="sort col sort-procedure ">{{ @$procedure }}</div>
            <div class="sort col-2 sort-physician">{{ @$physician }}</div>
            <div class="sort col">{{ @$count_selected }}</div>
            <div class="sort col">{{ count($video) }}</div>
            <div class="sort col">{{ @$patient_in }}</div>
            <div class="sort col">{{ @$start_time }}</div>
            <div class="sort col">{{ @$end_time }}</div>
            <div class="sort col">{{ @$patient_out }}</div>
            <div class="sort col sort-prediag">{{ @$prediag }}</div>
            <div class="sort-date" hidden>{{ @$date_only }}</div>
        </div>
    @endforeach
</div> --}}


{{-- <div class="menu-img-list" style="height: 200px;z-index:999999">

</div> --}}


{{-- <div class="menu-img-list">
    @foreach ($img as $index => $data)
    <img src="{{"http://localhost/terra/patient/$hn/$studydate/$data"}}" class="image-list-img" style="display:none">
    <div data-src="{{"http://localhost/terra/patient/$hn/$studydate/$data"}}" id="dicom{{$index+1}}" class="w-100  position-relative" style="max-width: 100%;"></div>
    @endforeach
</div> --}}
