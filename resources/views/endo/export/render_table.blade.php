<table class="table table-nowrap align-middle" id="{{@$tbody_id}}_div" style="width: 80%">
    <thead class="table-light">
        <tr>
            {{-- <th scope="col">Case ID</th>
            <th scope="col">HN</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Gender</th>
            <th scope="col">Appointment Date</th>
            <th scope="col">Operation Date</th>
            <th scope="col">Procedure</th>
            <th scope="col">Endoscopist</th>
            <th scope="col">User Department</th>
            <th scope="col">Department (Case)</th>
            <th scope="col">Attendant</th>
            <th scope="col">Nurse</th>
            <th scope="col">Nurse Assistant</th>
            <th scope="col">Anesthesia</th>
            <th scope="col">Scope</th>
            <th scope="col">Room</th>
            <th scope="col">Ward</th>
            <th scope="col">OPD</th>
            <th scope="col">Refer</th>
            <th scope="col">Patient In</th>
            <th scope="col">Operation Start</th>
            <th scope="col">Operation End</th>
            <th scope="col">Withdrawal (min)</th>
            <th scope="col">Endoscope</th>
            <th scope="col">Followup</th>
            <th scope="col">Gastric Content</th>
            <th scope="col">Bowel Preparation</th>
            <th scope="col">Brief History</th>
            <th scope="col">Pre-Diagnosis</th>
            <th scope="col">Anesthesia</th>
            <th scope="col">Medication</th>
            <th scope="col">Indication</th>
            <th scope="col">Finding</th>
            <th scope="col">Overall Finding</th>
            <th scope="col">Post-Diagnosis</th>
            <th scope="col">Post-Diagnosis (other)</th>
            <th scope="col">Procedure</th>
            <th scope="col">ICD-10</th>
            <th scope="col">ICD-9</th>
            <th scope="col">Rapid Urease Test</th>
            <th scope="col">Complication</th>
            <th scope="col">Estimate blood loss</th>
            <th scope="col">Blood Transfusion</th>
            <th scope="col">Specimen</th>
            <th scope="col">Comment</th>
            <th scope="col">Status</th> --}}
            @foreach ($heads??[] as $head=>$display)
                @if ($display=='show')
                    <th scope="col">{{@$head.""}}</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody id="{{@$tbody_id}}">

        @if (@$tbody_id."" == 'table_show')
            @isset($cases)
            {{-- @dd($cases); --}}
                @php
                    $cases = isset($cases) ? $cases : [];
                @endphp
                @include('endo.export.render_row', ['cases'=>$cases, 'tbody_id'=>@$tbody_id.""])
            @endisset
        @endif
    </tbody>
</table>
