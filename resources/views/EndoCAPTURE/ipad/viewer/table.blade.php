<style>
    #tasksTable tr:nth-child(odd){
        background: red;
    }
    #tasksTable  tr:nth-child(even){
        background: blue;
    }
</style>



<table  id="table_caseviewer" class="table table-nowrap table-borderless font-gray menu-data-list">
    <thead>
        <tr class="bg-softless-dark">
            <td>Operation Date</td>
            <td>Operation</td>
            <td>Physician</td>
            <td>Photo</td>
            <td>Video</td>
            <td>Pre-Diagnosis</td>
        </tr>
    </thead>

    <tbody id="tasksTable" style="background: #ffffffff;" >
        @foreach (isset($tb_case)?$tb_case:[] as $index=>$case)
            @php
                $data       = (object) $case;
                $_id        = isset($data->id)           ? $data->id           : '';
                $date_ori   = isset($data->appointment) && $data->appointment != 0 ? $data->appointment : '';
                $date       = isset($data->appointment) && $data->appointment != 0 ? format_date($data->appointment, 'd M, Y H:i') : '';
                $hn         = isset($data->case_hn)       ? $data->case_hn       : '';
                $procedure  = isset($data->procedurename) ? $data->procedurename : '';
                $physician  = isset($data->doctorname)    ? $data->doctorname    : '';
                $photo      = isset($data->photo)         ? $data->photo         : [];
                $video      = get_video_viewer($_id);
                $patient_in = isset($data->time_patientin)  ? $data->time_patientin  : '';
                $start_time = isset($data->time_start )  ? $data->time_start  : '';
                $end_time   = isset($data->time_end)  ? $data->time_end  : '';
                $patient_out = isset($data->time_withdrawal) ? $data->time_withdrawal  : '';
                $prediag    = isset($data->prediagnostic_other) ? $data->prediagnostic_other : '';
                $date_only  = isset($date_ori) && @$date_ori."" != ""   ? explode(" ", $date_ori)[0] : '';

                $count_selected = 0;
                for ($i=0; $i < count($photo); $i++) {
                    $ns = isset($photo[$i]['ns']) ? intval($photo[$i]['ns']) : 0;
                    if($ns > 0){
                        $count_selected += 1;
                    }
                }

                $is_endosmart = 'false';
                if($physician == '' && $patient_in == '' && $end_time == '' && $start_time == '' && $patient_out == ''){
                    $is_endosmart = 'true';
                    $count_selected = count($photo);
                }


            @endphp
            <tr class="font-gray table_row" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
            aria-controls="offcanvasRight" onclick="open_detail('{{@$hn}}', '{{@$_id}}', '{{$date_only}}', '{{$is_endosmart}}')">

                <td>{{@$date_ori}}</td>
                <td class="sort-procedure">{{@$procedure}}</td>
                <td class="sort-physician">{{@$physician}}</td>
                <td>{{@$count_selected}}</td>
                <td>{{count($video)}}</td>
                <td class="sort-prediag">{{@$prediag}}</td>
                <td class="sort-date" hidden>{{@$date_only}}</td>
            </tr>
    @endforeach
    </tbody>
</table>
