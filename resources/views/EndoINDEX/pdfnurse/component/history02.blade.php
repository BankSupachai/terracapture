@php
use App\Models\Mongo;
@endphp

<style>
    .tb-p2 tr td:nth-child(1),.tb-p2 tr td:nth-child(2),.tb-p2 tr td:nth-child(3),.tb-p2 tr td:nth-child(4),.tb-p2 tr td:nth-child(5),.tb-p2 tr td:nth-child(6),.tb-p2 tr td:nth-child(7){width: 3em;text-align: center;}
    .tb-p2 tbody tr td{line-height: 0.8em;}
    sub,sup{font-size: 8px;}
</style>

<div class="w-100 lh-1">
    <b>PROCEDURE : </b> &nbsp; <b>{!!implode(",",$procedurename)!!}</b>
</div>

{{-- <div class="w-100 m-0 lh-1">
    <b>MEDICATION : </b> &nbsp; Buscopan  50 mg. Dormicum 25 mg. Propofol 30 mg.
</div>
<div class="w-100 m-0 lh-1">
    <b>COMPLICATION : </b> &nbsp; None immediately complication
</div> --}}

<div class="w-100 m-0 lh-1">
    <b>DISCHARGED TO : </b> &nbsp;
        @isset($note['recovery']['history_home_ck'])
            {{-- {{$note['recovery']['history_home_ck']}}<br> --}}
        @endisset
        @isset($note['recovery']['history_admit_ck'])
            {{$note['recovery']['history_admit_ck']}}
            @isset($note['recovery']['history_admit_other'])
                {{-- : {{$note['recovery']['history_admit_other']}} --}}
            @endisset
            <br>
        @endisset
        @isset($note['recovery']['history_consult_ck'])
            {{$note['recovery']['history_consult_ck']}}
            @isset($note['recovery']['history_consult_other'])
                {{-- : {{$note['recovery']['history_consult_other']}} --}}
            @endisset
            <br>
        @endisset
        @isset($note['recovery']['history_other_text'])
            {{-- {{$note['recovery']['history_other_text']}} --}}
        @endisset
</div>

<br>


{{--

history_admit_ck
"Admit"
history_consult_ck
"Consult"
history_admit_other
"23"
history_consult_other
"44"
history_other_text
"55"
history_home_ck
"Home"


    --}}





@php
$nurse_record = "";
if(isset($note['operation']['nurse_record'])){
    $uid            = (int) $note['operation']['nurse_record'];
    $user           = (object) Mongo::table('users')->where('uid',$uid)->first();
    $nurse_record   = @$user->user_prefix.@$user->user_firstname." ".@$user->user_lastname;

    $appointment    = explode(" ",$note['appointment']);
}


if(isset($note['operation']['vital_sign'])){
    $temp = $note['operation']['vital_sign'];
    $json = get_vital_sign($temp);
}

function get_vital_sign($temp){
    $temp_data = [];
    $temp_type = gettype($temp);
    if($temp_type == 'string'){
        $temp_data = (array) jsonDecode($temp);
    } else if($temp_type == 'array' || $temp_type == 'object') {
        $temp_data = (array) $temp;
    }
    return $temp_data;
}

@endphp

<table class="w-100">
    <tr>
        <td class="w-50 lh-1 p-0">VITAL SIGNS MONITOR : <span class="text-danger">Operation</span></td>
        <td class="text-right lh-1 p-0">Noted by : <b class="text-danger">{{$nurse_record}}</b> &nbsp; <span class="text-danger">{{@$appointment[0]}} {{--@isset($json[0]->time) {{$json[0]->time}} @endisset--}}</span> </td>
    </tr>
</table>
<table class="table w-100 tb-p2">
    <thead class="border-bottom border-top border-gray">
        <tr>
            <td>Time</td>
            <td>BP</td>
            <td>PR</td>
            <td>RR</td>
            <td>SpO<sub>2</sub></td>
            <td>Temp</td>
            <td>LOC</td>
            <td class="text-center">อาการ</td>
            <td class="text-center">Remark</td>
        </tr>
    </thead>
    <tbody class="border-bottom border-gray">
        @isset($note['operation']['vital_sign'])
            @php
                $temp = $note['operation']['vital_sign'];
                $json = get_vital_sign($temp);
            @endphp
            @foreach ($json as $data)
                @php
                    $data = (object) $data;
                @endphp
                <tr>
                    <td>{{@$data->time}}</td>
                    <td>{{@$data->bp}}</td>
                    <td>{{@$data->pr}}</td>
                    <td>{{@$data->rr}}</td>
                    <td>{{@$data->spo}}</td>
                    <td>{{@$data->loc}}<sup> o </sup>C</td>
                    <td>{{@$data->otwo}}</td>
                    <td>{{@$data->detail}}</td>
                    <td>{{@$data->remark}}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        @endisset
    </tbody>
</table>


@php
$nurse_record = "";
if(isset($note['recovery']['nurse_record'])){
    $uid            = (int) $note['recovery']['nurse_record'];
    $user           = (object) Mongo::table('users')->where('uid',$uid)->first();
    $nurse_record   = @$user->user_prefix.@$user->user_firstname." ".@$user->user_lastname;
}

if(isset($note['recovery']['vital_sign'])){
    $temp = $note['recovery']['vital_sign'];
    $json = get_vital_sign($temp);
}
@endphp
<br>
<table class="w-100 mt-05">
    <tr>
        <td class="w-50 lh-1 p-0">VITAL SIGNS MONITOR : <span class="text-success">Recovery</span></td>
        <td class="text-right lh-1 p-0">Noted by : <b class="text-danger">{{$nurse_record}}</b> &nbsp; <span class="text-danger">{{@$appointment[0]}}  {{--@isset($json[0]->time) {{$json[0]->time}} @endisset--}}</span> </td>
    </tr>
</table>
<table class="table w-100 tb-p2">
    <thead class="border-bottom border-top border-gray">
        <tr>
            <td>Time</td>
            <td>BP</td>
            <td>PR</td>
            <td>RR</td>
            <td>SpO<sub>2</sub></td>
            <td>Temp</td>
            <td>LOC</td>
            <td class="text-center">อาการ</td>
            <td class="text-center">Remark</td>
        </tr>
    </thead>
    <tbody class="border-bottom border-gray">
        @isset($note['recovery']['vital_sign'])
            @php
                $temp = $note['recovery']['vital_sign'];
                $json = get_vital_sign($temp);
            @endphp
            @foreach ($json as $data)
                @php
                    $data = (object) $data;
                @endphp
                <tr>
                    <td>{{@$data->time}}</td>
                    <td>{{@$data->bp}}</td>
                    <td>{{@$data->pr}}</td>
                    <td>{{@$data->rr}}</td>
                    <td>{{@$data->spo}}</td>
                    <td>{{@$data->loc}}<sup> o </sup>C</td>
                    <td>{{@$data->otwo}}</td>
                    <td>{{@$data->detail}}</td>
                    <td>{{@$data->remark}}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
            </tr>
        @endisset
    </tbody>
</table>
