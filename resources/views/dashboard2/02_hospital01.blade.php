@php
$case_all = $hos01_gender[0]['val']+$hos01_gender[1]['val'];
@endphp

<div class="col-lg-12 mt-2">
    <div class="card h-right">
        <div class="card-body text-center">
            <span class="text-header-chart">รพ.พระจอมเกล้า</span>
            <div class="row text-muted ">
                <div class="col-6 text-start mt-4">
                    <span>Physician</span>
                </div>
                <div class="col-6 text-end mt-4">
                    <span>25</span>
                </div>
                <div class="col-6 text-start  mt-3">
                    <span>Stations</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span>6</span>
                </div>
            </div>
            <div class="row text-muted ">
                <div class="col-6 text-start mt-3">
                    <span>Cases</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span class="d-inline h3 text-danger">{{$hos01_gender[0]['val']}}/</span>
                    <span class="d-inline">{{$case_all}}</span>
                </div>
                <div class="col-6 text-start mt-3 ">
                    <span>Cancer</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span class="d-inline h3 text-danger">{{@$hos01_cancel}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
