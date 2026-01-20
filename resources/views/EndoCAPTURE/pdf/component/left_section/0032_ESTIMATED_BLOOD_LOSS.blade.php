<tr class="set-font-family" style="line-height:{{$body_line}};">
    <td>
        <span class="casetitle">ESTIMATED BLOOD LOSS :</span>
        @if(isset($casedata->blood_loss))
            <span class="casetext">{{@$casedata->blood_loss}} ml.</span>
        @else
            &nbsp;<span class="casetext">N/A</span>
        @endif




    </td>

</tr>


<tr class="set-font-family" style="line-height:{{$body_line}};">

    <td>
        <span class="casetitle">BLOOD TRANSFUSION :</span>
        @if(isset($casedata->blood_transfusion))
            <span class="casetext" style="margin-left:7px;">{{@$casedata->blood_transfusion}} ml.</span>
        @else
            <span class="casetext" style="margin-left:7px;">N/A</span>
        @endif
    </td>


</tr>

