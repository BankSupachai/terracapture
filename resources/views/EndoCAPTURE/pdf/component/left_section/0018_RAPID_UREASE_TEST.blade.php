<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">RAPID UREASE TEST :</span>
        <span class="casetext">
            @if (@$casedata->rapid_other != '')
            {{@$casedata->rapid_other}}
            @else
            Not Done
            @endif
        </span>
    </td>
</tr>


{{-- <tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">RAPID UREASE TEST :</span>
        <span class="casetext">
            @isset($casedata->rapid_urease_test)
                @if($casedata->rapid_urease_test=="Not done")
                    Not done
                @else
                    @if($casedata->rapid_urease_test=="Pending")
                        {{$casedata->rapid_urease_test}}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;Positive
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[&nbsp;&nbsp;&nbsp;&nbsp;]&nbsp;&nbsp;Negative
                    @else
                        {{$casedata->rapid_urease_test}}
                    @endif
                    @if(@$casedata->rapid_other!='' && @$casedata->rapid_other!=null)
                        {{@$casedata->rapid_other}}
                    @endif
                @endif
            @else
                Not done
            @endisset
        </span>
    </td>
</tr> --}}


