<div class="cardcode col-12" style="padding: 0;display:none">
    View : <a style="color:red;" href="{{url("autoit?run=visualcode_open\\endo.exe&path=pdf_head01")}}">pdf_head01</a>
    <br><br>
</div>
<table align="center" width="100%" style="font-weight: bold;" border="0">
    <tr>
        <td colspan="5" align="right">
            @php
                $json = jsonDecode($casedata->procedure_json);
            @endphp
            <font color="red">{{@$json->pdfhead}}</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
    </tr>
    <tr style="line-height: 14px !important">
        <td width="10"></td>
        <td style="text-align:center">
            {{nbsp(40)}}<font style="font-size: 13px;">
                {{-- ห้องผ่าตัด<br> --}}
                {{$hospital->hospital_name}}<br>
            </font>
            <font style="font-size: 11px;">
                {{$hospital->hospital_address}}
            </font>
        </td>
        <td width="10"></td>
        <td align="right" width="90px" style="line-height:25px;padding-right:1em;">
        </td>
        <td align="center" width="90px" style="padding-left: 1em;">
            <img src="{{picurl("config/$hospital->hospital_pic")}}" height="60px" >
        </td>
    </tr>
</table>
