<div class="cardcode col-12" style="padding: 0;display:none">
    View : <a style="color:red;" href="{{url("autoit?run=visualcode_open\\endo.exe&path=pdf_head01")}}">pdf_head01</a>
    <br><br>
</div>
<table align="center" width="100%" style="font-weight: bold;" border="0">
    <tr style="line-height: 14px !important">
        <td align="center" width="90px" style="padding-left: 1em;">
            <img src="{{picurl("config/$hospital->hospital_pic")}}" height="60px" >
        </td>
        <td width="10"></td>
        <td>
            <center>
            <font size="12">
                {{$hospital->hospital_name}} <br>
                {{-- {{$hospital->hospital_address}} <br> --}}
                {{-- Tel :{{$hospital->hospital_tel}} --}}
                {{-- <b style="font-size:20px;">Procedure Report</b> --}}
            <b style="font-size:20px;color:{{$casedata->procedure_color}}">{{$casedata->procedure_name}}</b>

                @php
                    $json = jsonDecode($casedata->procedure_json);
                @endphp




            </font>
            </center>
        </td>
        <td width="10"></td>
        <td align="right" width="90px" style="line-height:25px;padding-right:1em;">
                <font color="red">{{@$json->pdfhead}}</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
    </tr>
</table>
