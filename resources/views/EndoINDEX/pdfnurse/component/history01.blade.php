@php
use App\Models\Mongo;

$nurse_record = "";
if(isset($note['history1']['nurse_record'])){
    $uid            = (int) $note['history1']['nurse_record'];
    $user           = (object) Mongo::table('users')->where('uid',$uid)->first();
    $nurse_record   = @$user->user_prefix.@$user->user_firstname." ".@$user->user_lastname;
}
@endphp



<style>

    .tk-2>tbody>tr>td,
    .tk-2 tbody>tr>th {
        border: 1px solid #707070;
    }

    .tk-2 {
        width: 100%;
        border-collapse: collapse;
    }

    .tk-2 td {
        padding-left: 1em;
    }

    .border-top-none {
        border-top: none !important;
    }

    .border-bottom-none {
        border-bottom: none !important;
    }

    .t-vcenter tr td {
        padding-top: 0;
        line-height: 1em;
        padding-bottom: .2em;
        width: 50%;
        vertical-align: middle !important;
    }

    .t-mar tr td:nth-child(1) {
        width: 10%
    }

    .t-mar tr td:nth-child(2) {
        width: 20%
    }

    .t-mar tr td:nth-child(3) {
        width: 20%
    }

    .t-mar tr td:nth-child(4) {
        width: 25%
    }

    .t-mar tr td:nth-child(5) {
        width: 5%
    }
</style>
<div style="padding: 0.5em;">
    <span>HISTORY TAKING 1</span>
    <div style="float: right;">
        <span>Noted by :</span>
        <span class="text-danger">{{ $nurse_record }}</span>
        <span class="text-danger">{{ @$note['history1']['date_process'] }}</span>
    </div>
</div>

<table class="tk-2 w-100 m-0 t-vcenter">
    <tr>
        <th><span class="text-danger" style="margin-right:15em;">Provisional Diagnosis</span> </th>
        <th><span class="text-danger" style="margin-right:9em;">{{ @$note['history1']['provisional_other'] }}</span> </th>
    </tr>
    <tr>
        <td>อาการนำมาโรงพยาบาล</td>
        <td>
            @foreach (isset($note['history1']['symptom'])?$note['history1']['symptom']:[] as $data)
                {{@$data}} , &nbsp;
            @endforeach
            {{ @$note['history1']['symptom_other'] }}
        </td>
    </tr>
    <tr>
        <td>ประวัติการความเจ็บป่วย</td>
        <td>
            @foreach (isset($note['history1']['illness'])?$note['history1']['illness']:[] as $data)
                {{@$data}} , &nbsp;
            @endforeach
            {{ @$note['history1']['illness_other'] }}
        </td>
    </tr>
    <tr>
        <td>ประวัติการใช้ยา การเเพ้ยา เเละการเเพ้อาหาร</td>
        <td>
            @foreach (isset($note['history1']['medicine'])?$note['history1']['medicine']:[] as $data)
                {{@$data}} , &nbsp;
            @endforeach
            {{ @$note['history1']['medicine_other'] }}
        </td>
    </tr>
    <tr>
        <td>ประวัติการเเพ้ยา</td>
        <td>
            @if (@$note['history1']['allergy'] == 'เคย')
                {{ $note['history1']['allergy'] }} &nbsp; {{ @$note['history1']['allergy_other'] }}
            @else
                ไม่เคย
            @endif
        </td>
    </tr>
    <tr>
        <td>ประวัติการเเพ้อาหาร</td>
        <td>
            @if (@$note['history1']['food'] == 'เคย')
                {{ $note['history1']['food'] }} &nbsp; {{ @$note['history1']['food_other'] }}
            @else
                ไม่เคย
            @endif
        </td>
    </tr>
    <tr>
        <td>ประวัติการผ่าตัด</td>
        <td>
            @if (@$note['history1']['surgery'] == 'เคย')
                {{ $note['history1']['surgery'] }} &nbsp; {{ @$note['history1']['surgery_other'] }}
                @if(isset($note['history1']['surgery_month']) && @$note['history1']['surgery_month']."" != "") {{ @$note['history1']['surgery_month'] }} เดือน @endif
                @if(isset($note['history1']['surgery_year']) && @$note['history1']['surgery_year']."" != "") {{ @$note['history1']['surgery_year'] }} ปี @endif
            @else
                ไม่เคย
            @endif
        </td>
    </tr>
    <tr>
        <td>การตั้งครรภ์</td>
        <td>
            @if (@$note['history1']['pregnant'] == 'กำลังตั้งครรภ์')
                {{ $note['history1']['pregnant'] }} &nbsp; @if(isset($note['history1']['pregnant_other'])) {{ @$note['history1']['pregnant_other'] }} เดือน @endif
            @else
                -
            @endif
        </td>
    </tr>
    <tr>
        <td>ประวัติการส่องกล้อง</td>
        <td>
            @if (@$note['history1']['endo'] == 'เคย')
                {{ $note['history1']['endo'] }} &nbsp; {{ @$note['history1']['endo_other'] }} &nbsp;
                @if(isset($note['history1']['endo_month']) && @$note['history1']['endo_month']."" != "") {{ @$note['history1']['endo_month'] }} เดือน  @endif
                @if(isset($note['history1']['endo_year']) && @$note['history1']['endo_year']."" != "") {{ @$note['history1']['endo_year'] }} ปี @endif
            @else
                ไม่เคย
            @endif
        </td>
    </tr>
    <tr>
        <td>ประวัติการดื่มสุรา</td>
        <td>
            @if (@$note['history1']['alcohol'] == 'ดื่ม')
                {{ $note['history1']['alcohol'] }}&nbsp;
                {{ @$note['history1']['alcohol_other'] }} เเก้ว/วัน
            @else
                ไม่เคย
            @endif
        </td>
    </tr>
    <tr>
        <td>ประวัติการสูบบุหรี่</td>
        <td>
            @if (@$note['history1']['cigarette'] == 'สูบ')
                {{ $note['history1']['cigarette'] }}&nbsp;
                {{ @$note['history1']['cigarette_other'] }} มวน/วัน
            @else
                ไม่เคย
            @endif
        </td>
    </tr>

</table>



@php
$nurse_record = "";
if(isset($note['history2']['nurse_record'])){
    $uid            = (int) $note['history2']['nurse_record'];
    $user           = (object) Mongo::table('users')->where('uid',$uid)->first();
    $nurse_record   = @$user->user_prefix.@$user->user_firstname." ".@$user->user_lastname;
}
@endphp



<div style="margin-bottom: 0.5em;">
    <span>HISTORY TAKING 2 </span>
    <div style="float: right;">
        <span>Noted by :</span>
        <span class="text-danger">{{ $nurse_record }}</span>
    </div>
</div>

<table class="tk-2 w-100 m-0 t-vcenter border-bottom-none">
    <tbody>
        <tr>
            <td class="w-50">สภาพเเรกรับ </td>
            <td>
                {{ @$note['history2']['concious'] }} {{ @$note['history2']['concious_other'] }} @if(@$note['history2']['transport']),  @endif
                {{ @$note['history2']['transport'] }} {{ @$note['history2']['transport_other'] }} @if(@$note['history2']['condition']),  @endif
                @foreach (isset($note['history2']['condition'])?$note['history2']['condition']:[] as $data)
                    {{ @$data }}
                @endforeach
                {{ @$note['history2']['condition_other'] }}
            </td>
        </tr>
        <tr class="border-bottom-none">
            <td>การประเมินด้านจิตใจ</td>
            <td class="">
                @if (@$note['history2']['mentality'] == 'ปกติ')
                    ผ่าน
                    <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px">
                @else
                    {{ @$note['history2']['mentality'] }}
                @endif
            </td>
        </tr>

    </tbody>
</table>

<div class="w-100 border border-top-none">
    <table class="w-100 t-mar border-top-none" style="border-bottom: 1px solid #c1c1c1;">
        <tr class="border-top-none">
            <td colspan="5" class="border-top-none">การประเมินด้านร่างกาย</td>
        </tr>
        <tr>
            <td>น้ำหนัก (kg.)</td>
            <td>{{ @$note['history2']['weight_other'] }}</td>
            <td style="width: 10%">
                {{-- <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px"> --}}
            </td>
            <td>งดอาหารเเละน้ำ 6-8 ชม.</td>
            <td  style="">
                @if (@$note['history2']['weight'] == 'ผ่าน')
                    <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px">
                @elseif(@$note['history2']['weight'] == 'ไม่ผ่าน')
                    <img src="{{ url('public/images/not.png') }}" alt="" width="15px" height="15px">
                @else
                @endif
            </td>
        </tr>
        <tr>
            <td>ส่วนสูง (cm.)</td>
            <td>{{ @$note['history2']['height_other'] }}</td>
            <td>
                {{-- <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px"> --}}
            </td>
            <td>ไม่มีฟันปลอม</td>
            <td style="width: 10%;">
                @if (@$note['history2']['height'] == 'ผ่าน')
                    <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px">
                @elseif(@$note['history2']['height'] == 'ไม่ผ่าน')
                    <img src="{{ url('public/images/not.png') }}" alt="" width="15px" height="15px">
                @else
                @endif
            </td>
        </tr>
        <tr>
            <td>BP (mmHg)</td>
            <td>{{ @$note['history2']['pressure_other'] }} / 80</td>
            <td>
                {{-- <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px"> --}}
            </td>
            <td>งดยาสลายลิ่มเลือด</td>
            <td>
                @if (@$note['history2']['pressure'] == 'ผ่าน')
                    <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px">
                @elseif(@$note['history2']['pressure'] == 'ไม่ผ่าน')
                    <img src="{{ url('public/images/not.png') }}" alt="" width="15px" height="15px">
                @else
                @endif
            </td>
        </tr>
        <tr>
            <td>Pulse (bpm)</td>
            <td> {{ @$note['history2']['heartrate_other'] }} </td>
            <td>
                {{-- <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px"> --}}
            </td>
            <td>กินยาลดความดัน &nbsp; &nbsp; เวลา {{ @$note['history2']['heartrate_time'] }} </td>
            <td style="width: 10%;">
                @if (@$note['history2']['heartrate'] == 'ผ่าน')
                    <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px">
                @elseif(@$note['history2']['heartrate'] == 'ไม่ผ่าน')
                    <img src="{{ url('public/images/not.png') }}" alt="" width="15px" height="15px">
                @else

                @endif
            </td>
        </tr>
        <tr>
            <td>Pain Score</td>
            <td> {{ @$note['history2']['pain_other'] }} </td>
            <td>
                {{-- <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px"> --}}
            </td>
            <td>ยาอื่นๆ &nbsp; &nbsp; {{@$note['history2']['pain_medi_other']}} &nbsp; &nbsp; เวลา {{ @$note['history2']['pain_time'] }} </td>
            <td style="width: 10%;">
                @if (@$note['history2']['pain'] == 'ผ่าน')
                    <img src="{{ url('public/images/true.png') }}" alt="" width="15px" height="15px">
                @elseif(@$note['history2']['pain'] == 'ไม่ผ่าน')
                    <img src="{{ url('public/images/not.png') }}" alt="" width="15px" height="15px">
                @else
                @endif
            </td>
        </tr>
    </table>
</div>
