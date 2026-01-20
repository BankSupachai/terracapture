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
    <table width="100%" border="0" style="border-bottom: 1px solid gray;border-top: 1px solid gray;">
        <tr  style="line-height: 7px !important">
            <td style="vertical-align: middle;height:12px;padding-left:2em;" width="400px"><b>PATIENT NAME :</b><font color="#48494b">{{$casedata->prefix.$casedata->firstname." ".$casedata->lastname}}</font></td>
            <td style="vertical-align: middle;height:12px;padding-left:2em;"><b>HN :</b> {{ $casedata->hn }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Ward :</b><font color="#48494b">{{$ward}}</font></td>
        </tr>
        <tr style="line-height: 7px !important">
            <td  style="vertical-align: middle;height:12px;padding-left:2em;" width="400px"><b>GENDER :</b> <font color="#48494b">{{@$casedata->gender_name }}&nbsp;&nbsp;&nbsp;<b>Age :</b> <font color="#48494b">{{age($casedata->birthdate)}}</font></td>
            <td  style="vertical-align: middle;height:12px;padding-left:2em;"><b>Treatment Coverage :</b><font color="#48494b">{{$json->righttotreatment}}</font></td>
        </tr>
        <tr style="line-height: 7px !important">
            <td style="vertical-align: middle;height:12px;padding-left:2em;" width="400px"><b>DATE OF PROCEDURE :</b> <font color="#48494b">{{swapDATE($casedata->case_dateappointment)}}</font></td>
            <td style="vertical-align: middle;height:12px;padding-left:2em;">
                <b>
                    TIME START :
                </b>
                <font color="#48494b">
                    {{$totaltime}}
                </font>
            </td>
        </tr>
        <tr style="line-height: 7px !important">
            <td style="vertical-align: middle;height:12px;padding-left:2em; margin-top: -2em;">
                <b>
                    ENDOSCOPIST : 
                </b>

                <font color="#48494b">
                    {{$doctor[1]}}
                </font>
            </td>
            <td  style="vertical-align: top;padding-left:2em;" rowspan="3" >
                <b>ENDOSCOPE :</b>
                <font color="#48494b">
                    @foreach($scopeall as $scope)
                        {{$scope}}
                    @endforeach
                </font>
            </td>
        </tr>
        <tr style="line-height: 7px !important" valign="top">
            <td style="vertical-align: middle;height:12px;padding-left:2em;"><b>CONSULTANT :</b>
                <font color="#48494b">
                    {{$doctor[2]}}
                    @if($doctor[3]!=""),{{$doctor[3]}}@endif
                </font>
            </td>
        </tr>
        <tr style="line-height: 7px !important;">
            <td style="vertical-align: middle;height:12px;padding-left:2em;"><b>NURSE, ASSIST :</b>
                <font color="#48494b">
                    {{$nurse[1]}}
                    @if($nurse[2]!="")  ,{{$nurse[2]}}@endif
                    @if($nurse[3]!="")  ,{{$nurse[3]}}@endif
                    @if($nurse[4]!="")  <br>{{$nurse[4]}}@endif
                </font>
            </td>
        </tr>
    </table>
