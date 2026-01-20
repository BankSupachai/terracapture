<div class="cardcode col-12" style="padding: 0;display:none">
    View : <a style="color:red;" href="{{url("autoit?run=visualcode_open\\endo.exe&path=pdf_head02")}}">pdf_head02</a>
    <br><br>
</div>

    @php
        $rightto = DB::table('patient')
        ->leftjoin('dd_righttotreatment','dd_righttotreatment.id','patient.righttotreatment')
        ->where('patient.hn',$casedata->case_hn)->first();
        $ward = "-";
        $refer= "-";
        if(isset($this_json->ward)){
            if($this_json->ward != ''){
                $ward = $this_json->ward;
            }
        }
        if(isset($this_json->refer)){
            if($this_json->refer != ''){
                $refer = $this_json->refer;
            }
        }
    @endphp

    <table width="100%" style="border-bottom: 1px solid gray;">
        <tr style="line-height: 7px !important">
            <td style="width: 50%;"><b>Treatment Coverage : </b>{{$json->righttotreatment}}</td>
            <td>
                <b>Date : {{swapDATE($casedata->case_dateappointment)}} &nbsp;&nbsp;&nbsp;
                <b>Ward : </b>{{$ward}}
            </td>
        </tr>
        <tr style="line-height: 7px !important">
            <td style="width: 50%;"><b>CONSULTANT : </b>{{$doctor[2]}}@if($doctor[3]!=""),{{$doctor[3]}}@endif</td>
            <td><b>Start - End(min) : </b>-</td>
        </tr>
        <tr style="line-height: 7px !important">
            <td style="width: 50%;"><b>NURSE, ASSIST : </b>
                {{$nurse[1]}}
                @if($nurse[2]!="")  ,{{$nurse[2]}}@endif
                @if($nurse[3]!="")  ,{{$nurse[3]}}@endif
                @if($nurse[4]!="")  <br>{{$nurse[4]}}@endif
            </td>
            <td><b>ENDOSCOPE : </b>
                @foreach($scopeall as $scope)
                    {{$scope}}
                @endforeach
            </td>
        </tr>
    </table>
