<?php
/*
<div class="cardcode col-12" style="padding: 0;display:none">
    <br><br>
    View : <a style="color:red;" href="{{url("autoit?run=visualcode_open\\endo.exe&path=0008_POST-DIAGNOSIS")}}">0008_POST-DIAGNOSIS</a>
</div>
<tr style="line-height: 10px;">
    <td colspan="2">
        <font color="#003591"><b>POST-DIAGNOSIS :</b></font>

        @if(@$json->prediagnostic!="" && @$json->postdiagnostic_cysto!="")
                    @php
                    $prediag = jsonDecode(@$json->prediagnostic);

                    @endphp

                    @foreach($prediag as $hv)
                        {{$hv}},
                    @endforeach
            <br>
            {{@$json->postdiagnostic_cysto}}<br>
        @endif

        @if(@$json->prediagnostic!="" && @$json->postdiagnostic_cysto=="")
                    @php
                    $prediag = jsonDecode(@$json->prediagnostic);

                    @endphp

                    @foreach($prediag as $hv)
                        {{$hv}},
                    @endforeach
        @endif

        @if(@$json->prediagnostic=="" && @$json->postdiagnostic_cysto!="")
            {{@$json->postdiagnostic_cysto}}
        @endif

        @if(@$json->prediagnostic=="" && @$json->postdiagnostic_cysto=="")
        <font>None </font>
        @endif
    </td>
</tr>
*/

?>
