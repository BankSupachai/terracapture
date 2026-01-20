@if(mevalue($casedata,['case_history','prediagnosis','prediagnostic_other']))
    <tr class=" set-font-family" style="line-height:{{$body_line}};">
        <td colspan="2">
            <span>
            <span class="casetitle">PRE-DIAGNOSTIC :</span>
                @isset($casedata->prediagnostic_other)
                    <span class="casetext">{{$casedata->prediagnostic_other}}</span>
                @else
                    <span class="casetext">None</span>
                @endisset
            </span>
        </td>
    </tr>
@endif





