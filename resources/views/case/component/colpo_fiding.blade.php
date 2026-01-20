@php
    if (isset($json->finding)) {
        $finding = (array) $json->finding;
    }
@endphp
<style>
    .margin-pos {
        margin-top: 6.5rem;
    }

    .margin-pos2 {
        margin-top: 5.5rem;
    }
</style>
<div class="card card card-custom gutter-b">
    <div class="card-body">
        <h3>Colposcopic Diagnosis</h3>
        <div class="row mt-3">
            @include('case.component.cervix')
        </div>

        <div class="row mt-3">
            @include('case.component.vagina')
        </div>
        <div class="row mt-3">
                @include('case.component.vulva')
        </div>
            <div class="col-4"></div>
            <div class="col-4" style="margin-top: 5em;">
                <hr>
            </div>
            <div class="col-4"></div>
            <div class="col-6">
                <p class="h5">Rx.</p>

            </div>
            <div class="col-12 ">
                <textarea type="text" rows="5" class="form-control autotext savejson" name="rx" id="rx"
                    placeholder="Freetext" type="text" autocomplete="off" value="">{{ @$case->rx }}</textarea>
            </div>


    </div>
</div>
