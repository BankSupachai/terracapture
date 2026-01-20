<tr class="set-span-family">
    <td>
        @if(isset($casedata->effusion_profile))
            <span class="casetitle">PLEUAL EFFUSION PROFILE :</span>
            <span class="casetext">{{$casedata->effusion_profile}}</span><br>
        @endif
        @if(isset($casedata->patient_position))
            <span class="casetitle">PATIENT POSITION :</span>
            <span class="casetext">{{$casedata->patient_position}}</span><br>
        @endif
        @if(isset($casedata->asa_class))
        <span class="casetitle">ASA_CLASS :</span>
        <span class="casetext">{{$casedata->asa_class}}</span><br>
    @endif
    @if(isset($casedata->date_of))
        <span class="casetitle">DATE OF INTUBATION :</span>
        <span class="casetext">{{$casedata->date_of}}</span><br>
    @endif
        @if(isset($casedata->port_of_entry))
            <span class="casetitle">PORT OF ENTRY :</span>
            <span class="casetext">{{$casedata->port_of_entry}}</span> &nbsp;&nbsp;
        @endif
        @if(isset($casedata->entry_at))
            <span class="casetitle">At :</span>
            <span class="casetext">{{$casedata->entry_at}}</span> &nbsp;&nbsp;
        @endif
        @if(isset($casedata->entry_at_ics))
            <span class="casetitle">ICS :</span>
            <span class="casetext">{{$casedata->entry_at_ics}} axillary line</span> &nbsp;&nbsp;<br>
        @endif


    </td>
</tr>

