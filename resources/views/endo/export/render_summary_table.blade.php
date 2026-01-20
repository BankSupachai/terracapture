<p>Period : <span>{{@$time_start}}</span>@if(isset($time_end))-<span>{{@$time_end}}</span> @endif</p>
<p>Usertype: <span>{{@$user_type}}</span></p>
<table class="table table-nowrap align-middle" id="{{@$tbody_id}}_div" style="width: 80%">
    <thead class="table-light">
        <tr>
            <th scope="col">User</th>
            @foreach (isset($procedures)?$procedures:[] as $data)
                <th scope="col">{{@$data}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody id="{{@$tbody_id}}">
        @foreach (isset($physicians)?$physicians:[] as $doctorname => $case_proc)
            <tr>
                <td>{{@$doctorname}}</td>
                @foreach (isset($case_proc)?$case_proc:[] as $proc_name=>$count)
                    <td>{{@$count}}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>