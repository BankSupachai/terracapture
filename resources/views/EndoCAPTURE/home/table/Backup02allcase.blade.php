
@php
    $i = 0;
@endphp

{{-- @dd($all_case) --}}
@foreach($all_case as $in=>$data)
    @php
        $data        = (object) $data;
        $hn          = isset($data->case_hn)       ? $data->case_hn            : $data->hn;
        $patientname = isset($data->patientname)   ? $data->patientname        : $data->firstname.' '.$data->lastname;
        $physician   = isset($data->doctorname)    ? $data->doctorname         : $data->physician;
        $procedure   = isset($data->procedurename) ? $data->procedurename      : $data->procedure;
        $statusjob   = isset($data->statusjob)     ? ucfirst($data->statusjob) : '';
        $_id         = $data->id;
        $room        = isset($data->room) && @$data->room!='' ? get_room_name(intval($data->room)) : '';
        $appointment = isset($data->appointment)   ? explode(' ', $data->appointment) : null;
        $date        = isset($appointment)        ?  format_date($appointment[0], 'd M Y') : '';
    @endphp
    <tr >

        <td class="index">
            {{@$date}}
        </td>
        <td>{{@$data->case_id}}</td>
        <td>{{@$hn}}</td>
        <td>{{@$patientname}}</td>
        @if (isset($physician))
            @if (gettype($physician) == 'array')
                <td>
                    @foreach ($physician as $p)
                    @php
                        $p_name = get_user_data($p);
                        $p_name = (object) $p_name;
                        $name   = @$p_name->user_prefix.".".@$p_name->user_firstname." ".@$p_name->user_lastname;
                    @endphp
                    {{@$name}} <br>
                    @endforeach
                </td>
            @else
                <td>{{@$physician}}</td>
            @endif
        @else
            <td></td>
        @endif
        <td>{{@$procedure}}</td>
        <td hidden>{{@date("Y-m-d", strtotime($data->appointment))}}</td>
        <td>Complication</td>
        <td>

            {{-- @dd($statusjob); --}}
            @if($statusjob == 'Discharged')
            <span class="badge-soft-success p-1">{{@$statusjob}}</span>
            @else
            <span class="badge-soft-danger p-1">{{@$statusjob}}</span>

            @endif
        </td>
        <td class="text-center">
            @if($statusjob == 'Discharged')
            <a href="{{url("reportendocapture/$_id")}}" class="btn btn-icon btn-blue" id="btn_dis">
                <i class="ri-file-text-line ri-1x"></i>
            </a>
            @else
            <button disabled class="btn btn-icon btn-blue" id="btn_dis">
                <i class="ri-file-text-line ri-1x"></i>
            </a>
            @endif

        </td>
    </tr>

@php
    $i = $i + 1;
@endphp
@endforeach

