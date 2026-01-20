
{{-- @dd($casedata); --}}
<tr class="set-span-family">
    <td>
        @if(isset($json->cxr))
            <span class="casetitle">CXR date :</span>
            <span class="casetext">{{@$json->cxr}}</span> &nbsp;&nbsp;
        @endif
        {{-- @if(isset($json->finding_cxr))
            <span class="casetitle">Finding :</span>
            <span class="casetext">{{@$json->finding_cxr}}</span> &nbsp;&nbsp;
        @endif --}}
        @if(isset($json->finding_cxr_at))
            <span class="casetitle">at :</span>
            <span class="casetext">{{@$json->finding_cxr_at}}</span><br>
        @endif
        @if(isset($json->ct))
            <span class="casetitle">CT CHEST date :</span>
            <span class="casetext">{{@$json->ct}}</span> &nbsp;&nbsp;
        @endif
        @if(isset($json->ct_finding))
            <span class="casetitle">Finding :</span>
            <span class="casetext">{{@$json->ct_finding}}</span> &nbsp;&nbsp;
        @endif
        @if(isset($json->ct_finding_at))
            <span class="casetitle">at :</span>
            <span class="casetext">{{@$json->ct_finding_at}}</span><br>
        @endif

        @if(isset($json->effusion_profile))
            <span class="casetitle">PLEUAL EFFUSION PROFILE :</span>
            <span class="casetext">{{@$json->effusion_profile}}</span><br>
        @endif
        @if(isset($json->patient_position))
            <span class="casetitle">PATIENT POSITION :</span>
            <span class="casetext">{{@$json->patient_position}}</span><br>
        @endif
        @if(isset($json->port_of_entry))
            <span class="casetitle">PORT OF ENTRY :</span>
            <span class="casetext">{{@$json->port_of_entry}}</span> &nbsp;&nbsp;
        @endif
        @if(isset($json->entry_at))
            <span class="casetitle">At :</span>
            <span class="casetext">{{@$json->entry_at}}</span> &nbsp;&nbsp;
        @endif
    </td>
</tr>
