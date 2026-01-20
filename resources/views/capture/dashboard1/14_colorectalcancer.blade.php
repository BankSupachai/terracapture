@php

$all = $hos01_cancel+$hos02_cancel+$hos03_cancel;
@endphp

<div class="col-4 mt-2">
    <div class="card h-charts">
        <div class="card-body align-items-center d-flex justify-content-center ">
            <div class="row text-center">
                <div class="col-12">
                    <span class="fs-50 text-nowrap">Colorectal Cancer </span>
                </div>
                <div class="col-12 text-nowrap">
                    <span class="text-danger h1 fs-50">{{$all}} /</span>
                    <span class="text-muted h1">{{$case_count}}</span>

                </div>
            </div>
        </div>
    </div>
</div>
