@php
    use App\Models\mongo;
    use Carbon\Carbon;
@endphp
<br>
<div class="p-3">


 <div class="row">
    <div class="col-6">
        <div class="row">
            <div class="col-4 text-blue">Physician</div>
            <div class="col-4 text-dark">นพ.สุรัชณัฏฐ์ จิตรัตน์</div>
        </div>
    </div>
    <div class="col-6">

    </div>
 </div>








































    {{-- <table class="w-100 tb-detail">
        <tr>
            <td>Physician :</td>
            <td class="text-danger">
                @foreach ($physician as $data)
                    {{$data}}
                @endforeach
            </td>
            <td valign="top">Procedure :</td>
            <td valign="top" class="text-danger">
                @php
                    $casearr = array();
                    $patientin  = array();
                    $patientout = array();
                    $allcase = Mongo::table("tb_case")->where("noteid",$casedata->noteid)->get();
                    foreach($allcase as $data){
                        $data = (object) $data;
                        $casearr[$data->case_id]["procedurename"]   = @$data->procedurename."";
                        $casearr[$data->case_id]["time_start"]      = @$data->time_start."";
                        $casearr[$data->case_id]["time_end"]        = @$data->time_end."";

                        if(isset($data->time_patientin) && @$data->time_patientin."" != ""){
                            $patientin[] = @$data->time_patientin."";
                        }

                        if(isset($data->time_withdrawal) && @$data->time_withdrawal."" != ""){
                            $patientout[] = @$data->time_withdrawal."";
                        }
                    }

                    $min_patientin  = count($patientin) > 0 ? sort_times($patientin, 'min') : '';
                    $max_patientout = count($patientout) > 0 ? sort_times($patientout, 'max') : '';

                    function sort_times($arr, $type){
                        $time = '';
                        $unix = array_map('strtotime', $arr);
                        if($type == 'min'){
                            $time = min($unix);
                        } else {
                            $time = max($unix);
                        }

                        return date('H:i', $time);
                    }
                @endphp

                @foreach ($casearr as $key => $val)
                    @php
                        $diff = "";
                        if(@$val["time_start"]."" != "" && @$val["time_end"]."" != ""){
                            try {
                                $start = new Carbon($val["time_start"]);
                                $end   = new Carbon($val["time_end"]);
                                $diff  = $end->diffInMinutes($start);
                            } catch(\Exception $e) {}
                        }

                    @endphp
                    {{$val["procedurename"]}} {{$val["time_start"]}} @if(isset($val["time_end"]) && @$val["time_end"]."" != "") - {{$val["time_end"]}} ({{@$diff.""}})@endif<br>
                @endforeach


            </td>

        </tr>
        <tr>
            <td valign="top">Nurse :</td>
            <td class="text-danger" rowspan="2">
                {!!implode("<br>",$nurse_array)!!}
            </td>
            <td>Patient in :</td>
            <td class="text-danger">{{@$min_patientin}}</td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td valign="top">Nurse Assist :</td>
            <td valign="top" class="text-danger">{!!implode("<br>",$nurseanes_array)!!}</td>
            <td>Patient Out :</td>
            <td class="text-danger">{{@$max_patientout}}</td>

        </tr>
        <tr>
            <td></td>
            <td class="text-danger"></td>

        </tr>
    </table> --}}
</div>
