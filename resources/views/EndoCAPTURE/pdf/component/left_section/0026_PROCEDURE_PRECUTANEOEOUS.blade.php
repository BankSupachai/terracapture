
<tr class="set-font-family">
    <td>
        @if((@$json->tracheal_position)!=null)<br>
            <span class="casetitle">TRACHEAL POSITION :</span>
            <span class="casetext">{{@$json->tracheal_position}}</span><br>
        @endif
        @if((@$json->et_tube)!=null)
            <span class="casetitle">SIZE OF ET TUBE :</span>
            <span class="casetext">{{@$json->et_tube}}<br>
        @endif
        @if((@$json->tracheostomy_tube)!=null)
            <span class="casetitle">SIZE OF TRACHEOSTOMY TUBE :</span>
            <span class="casetext">{{@$json->tracheostomy_tube}}<br>
        @endif
        @if((@$json->early_complication)!=null)
            <span class="casetitle">EARLY COMPLICATION (FIRST 72 HOURS) :</span>
            <span class="casetext">{{@$json->early_complication}}<br>
        @endif
        @if((@$json->procedure_time)!=null)
            <span class="casetitle">PROCEDURE TIME :</span>
            <span class="casetext">{{@$json->procedure_time}}<br>
        @endif
        @if((@$json->bleeding)!=null)
            <span class="casetitle">BLEEDING :</span>
            <span class="casetext">{{@$json->bleeding}}<br>
        @endif
        @if((@$json->intraoperative_complication)!=null)
            <span class="casetitle">INTRAOPERATIVE COMPLICATION :</span>
            <span class="casetext">{{@$json->intraoperative_complication}}<br>
        @endif
        @if((@$json->late_complcation)!=null)
        {{-- @dd($json->late_complcation) --}}
            <span class="casetitle">LATE COMPLCATION :</span>
            <span class="casetext">{{$json->late_complcation}}</span><br>
        @endif
    </td>
</tr>

