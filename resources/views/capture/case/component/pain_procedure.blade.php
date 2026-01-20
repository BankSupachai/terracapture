<div class="col-12">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row cn">
                <div class="col-lg-3">Planed Procedure</div>
                <div class="col-lg-9">
                    <input type="text" name="planed_procedure" id="planed_procedure" class="form-control savejson"
                        value="{{ @$case->planed_procedure }}">
                </div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-3">Actual Procedure</div>
                <div class="col-lg-9">
                    <input type="text" name="actual_procedure" id="actual_procedure" class="form-control savejson"
                        value="{{ @$case->actual_procedure }}">
                </div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-auto">Side</div>
                <div class="col-lg">
                    <input type="text" name="pain_side" id="pain_side" class="form-control savejson"
                        value="{{ @$case->pain_side }}">
                </div>
                <div class="col-lg-auto">Level</div>
                <div class="col-lg">
                    <input type="text" name="pain_level" id="pain_level" class="form-control savejson"
                        value="{{ @$case->pain_level }}">
                </div>
            </div>
        </div>
    </div>
</div>
