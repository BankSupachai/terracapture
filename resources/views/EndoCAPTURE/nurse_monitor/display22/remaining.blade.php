@php
    use App\Models\Mongo;
    $count_allcase      = Mongo::table("tb_casemonitor")
    ->where("monitor_status","!=","delete")
    ->where("monitor_status","!=","Cancel")
    ->count();
    $count_discharge    = Mongo::table("tb_casemonitor")->where(['monitor_status'=>"Discharged"])->count();
    $count_remain       = $count_allcase - $count_discharge;

@endphp

<div class="row mb-2">
    <div class="col-6 text-center">
        <div class="bg-darkness p-4">
            <span class="h3">Remaining</span>
            <div class="">
                <span class="h3 d-inline fw-bold">{{$count_remain}}/</span>
                <span class="h4 d-inline">{{$count_allcase}}</span>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row text-center">
            <div class="col-12 mt-2">
                <img src="{{ url('public/image/EndoINDEX white logo.png') }}" width="100px" alt=""
                    srcset="">
            </div>
            <div class="col-12 fs-18 mt-2 fw-bold">
                <span>{{ date('D') }} &ensp; <span id="time"></span> </span> <br>
                <span>{{ date('d/m/Y') }} </span>
            </div>
        </div>
    </div>
</div>


