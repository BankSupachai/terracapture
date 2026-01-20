@php
$case_all = $hos02_gender[0]['val']+$hos02_gender[1]['val'];
@endphp
<div class="col-lg-12 mt-3 mb-2">
    <div class="card h-right">
        <div class="card-body text-center">
            <span class="text-header-chart">รพ.ท่ายาง</span>
            <div class="row text-muted ">
                <div class="col-6 text-start mt-4">
                    <span>Endoscopist</span>
                </div>
                <div class="col-6 text-end mt-4">
                    <span>7</span>
                </div>
                <div class="col-6 text-start mt-3">
                    <span>Anesthesiologist</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span>4</span>
                </div>
                <div class="col-6 text-start mt-3">
                    <span>Stations</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span>4</span>
                </div>
            </div>
            <div class="row text-muted ">
                <div class="col-6 text-start mt-3">
                    <span>Cases</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span class="d-inline h3 text-danger">{{$hos02_gender[0]['val']}}/</span>
                    <span class="d-inline">{{$case_all}}</span>
                </div>
                <div class="col-6 text-start mt-3 ">
                    <span>Cancer</span>
                </div>
                <div class="col-6 text-end mt-3">
                    <span class="d-inline h3 text-danger">{{@$hos02_cancel}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
