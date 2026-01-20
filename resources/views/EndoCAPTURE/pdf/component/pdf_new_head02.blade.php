<div class="cardcode col-12" style="padding: 0;display:none">
    View : <a style="color:red;" href="{{url("autoit?run=visualcode_open\\endo.exe&path=pdf_head01")}}">pdf_head01</a>
    <br><br>
</div>
<table width="100%" style="font-weight: bold;border-top:1px solid gray;font-size:14px;text-align:left;">
    <tr style="line-height: 12px !important">
        <td style="font-weight: bold;">Procedure</td>
        <td style="font-weight: bold;">HN</td>
        <td style="font-weight: bold;">Name</td>
        <td style="font-weight: bold;">Age</td>
        {{-- <td style="font-weight: bold;width:100px;text-align:center;">Date</td> --}}
        <td style="font-weight: bold;">Endoscopist</td>
    </tr>
    <tr style="line-height: 12px !important">
        @php
            $count_procedure = strlen($casedata->procedure_name);
        @endphp

        @if($count_procedure<20)
            <td style="color: {{$casedata->procedure_color}}">{{$casedata->procedure_name}}</td>
        @else
            <td style="color: {{$casedata->procedure_color}};font-size:9px">{{$casedata->procedure_name}}</td>
        @endif

        <td style="">{{ $casedata->hn }}</td>
        <td>{{$casedata->prefix.$casedata->firstname." ".$casedata->lastname}}</td>
        <td style="">{{age($casedata->birthdate)}}</td>
        {{-- <td style="text-align:center;">{{swapDATE($casedata->case_dateappointment)}}</td> --}}
        @php
            $count_doctor = strlen($doctor[1]);
        @endphp

        @if($count_doctor<50)
            <td style="">{{$doctor[1]}}</td>
        @else
            <td style="font-size:11px">{{$doctor[1]}}</td>
        @endif
    </tr>
</table>
<table width="100%" style="font-weight: bold;border-top:1px solid gray;font-size:14px;text-align:left;">
    <tr style="line-height: 12px !important">
        <td style="font-weight: bold;width:100px;"></td>
    </tr>
</table>
