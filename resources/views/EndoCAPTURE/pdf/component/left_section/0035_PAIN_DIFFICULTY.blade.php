
<style>
    .text-center{
        text-align: center;
    }
</style>
<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">DIFFICULTY :</span>
        <span class="casetext">{{@$json->findings_difficulty}}</span><br>
    </td>
</tr>
<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">PAIN ASSESS :</span>
        <span class="casetext">NRS (If 0 - No pain, 10 - Worst possible pain)</span><br>
    </td>
</tr>
<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td colspan="2">
        <table class="set-tab" style="width: 100%">
            <tr>
                <td></td>
                <td class="text-center"><span class="findtitle">At rest</span></td>
                <td class="text-center"><span class="findtitle">On movement {{ @$json->pain_on_movement }}</span></td>
            </tr>
            <tr>
                <td>Pre</td>
                <td class="text-center"><span class="casetext">{{@$json->pain_rest_pre}}</span></td>
                <td class="text-center"><span class="casetext">{{@$json->pain_movement_pre}}</span></td>
            </tr>
            <tr>
                <td>Immidiate Post</td>
                <td class="text-center"><span class="casetext">{{@$json->pain_rest_immediate}}</span></td>
                <td class="text-center"><span class="casetext">{{@$json->pain_movement_immediate}}</span></td>
            </tr>
            <tr>
                <td>1 hr. post</td>
                <td class="text-center"><span class="casetext">{{@$json->pain_rest_post}}</span></td>
                <td class="text-center"><span class="casetext">{{@$json->pain_movement_post}}</span></td>
            </tr>
            <tr>
                <td>Before D/C</td>
                <td class="text-center"><span class="casetext">{{@$json->pain_rest_before}}</span></td>
                <td class="text-center"><span class="casetext">{{@$json->pain_movement_before}}</span></td>
            </tr>
        </table>
    </td>
</tr>
<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">Plan of management :</span>
        <span class="casetext">{{@$json->plan_og_management}}</span><br>
    </td>
</tr>
<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">Home Medication :</span>
        <span class="casetext">
            {{@$json->home_medication}}
            @isset($json->ck_pain_rm_to)
                &nbsp;&nbsp;&nbsp;
                @isset($json->pain_rm_to)
                    <span class="casetitle">RM to</span> {{@$json->pain_rm_to}}
                @else
                    <span class="casetitle">RM to</b>Use</span>
                @endisset
            @else
                @isset($json->pain_rm_to)
                    <span class="casetitle">RM to</span> {{@$json->pain_rm_to}}
                @else
                @endisset

            @endisset



            @isset($json->ck_pain_drug)
                &nbsp;&nbsp;&nbsp;
                @isset($json->pain_rm_to)
                    <span class="casetitle">Drug</span> {{@$json->pain_drug}}
                @else
                    <span class="casetitle">Drug</b>Use</span>
                @endisset
            @else
                @isset($json->pain_rm_to)
                    <span class="casetitle">Drug</span> {{@$json->pain_drug}}
                @else
                @endisset
            @endisset

        </span>
    </td>
</tr>
