<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle" >BOWEL PREPARATION :</span>
        <span class="casetext" style="margin-left: 3px;">
            @if(@$casedata->bowel!="" && @$casedata->bowel_other!="")
                <span class="casetext">
                    {{@$casedata->bowel}}&nbsp;&nbsp;
                    {{@$casedata->bowelpreparation}}&nbsp;&nbsp;
                    {{@$casedata->bowelpreparation_cc}}&nbsp;&nbsp;
                    ({{@$casedata->bowel_other}})
                </span>
            @endif

            @if(@$casedata->bowel!="" && @$casedata->bowel_other=="")
                <span class="casetext">
                    {{@$casedata->bowel}}&nbsp;&nbsp;
                    {{@$casedata->bowelpreparation}}&nbsp;&nbsp;
                    {{@$casedata->bowelpreparation_cc}}&nbsp;&nbsp;
                </span>
            @endif

            @if (isset($casedata->bowel) == false || @$casedata->bowel=='')
                @isset($casedata->bowel_other)
                    {{$casedata->bowel_other}}
                @else
                    <span class="casetext">None</span>
                @endisset
            @endif
        </span>
    </td>
</tr>


<tr style="line-height:{{$body_line}};" class="set-font-family">
    <td class="vat" colspan="2">
        <span class="casetitle">TECHNIQUE :</span>
        <span class="casetext" style="margin-left: 48px;">
            @if(@$casedata->technique!="" && @$casedata->technique_other!="")
                <span class="casetext">
                    @foreach ($casedata->technique??[] as $data)
                        {{$data}}<br>
                    @endforeach
                    {{@$casedata->technique_other}}
                </span>
            @endif

            @if(@$casedata->technique!="" && @$casedata->bowel_other=="")
            <span class="casetext">
                <span class="casetext">
                    @foreach ($casedata->technique??[] as $data)
                        {{$data}}<br>
                    @endforeach
                </span>
            </span>
        @endif

        @if (isset($casedata->technique) == false || @$casedata->technique=='')
            @isset($casedata->technique_other)
                {{$casedata->technique_other}}
            @else
                <span class="casetext">None</span>
            @endisset
        @endif

        </span>
    </td>
</tr>
