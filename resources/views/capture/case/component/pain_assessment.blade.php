<div class="col-12">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row cn">
                <div class="col-lg-3">Difficulty</div>
                <div class="col-lg-9"><input type="text" name="findings_difficulty" id="findings_difficulty"
                        class="form-control savejson" value="{{ @$case->findings_difficulty }}"></div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-3"></div>
                <div class="col-lg">
                    <div class="row">
                        <div class="col-lg-12 text-center">at rest</div>
                    </div>
                </div>
                <div class="col-lg">
                    <div class="row cn">
                        <div class="col-auto">on movement</div>
                        <div class="col"><input type="text" name="pain_on_movement" id="pain_on_movement"
                                class="form-control savejson" value="{{ @$case->pain_on_movement }}"></div>
                    </div>
                </div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-3">pre</div>
                <div class="col-lg"><input type="text" name="pain_rest_pre" id="pain_rest_pre"
                        class="form-control kt_touchspin_1 savejson" value="{{ @$case->pain_rest_pre }}" readonly></div>
                <div class="col-lg"><input type="text" name="pain_movement_pre" id="pain_movement_pre"
                        class="form-control kt_touchspin_1 savejson" value="{{ @$case->pain_movement_pre }}" readonly>
                </div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-3">immediate post</div>
                <div class="col-lg"><input type="text" name="pain_rest_immediate" id="pain_rest_immediate"
                        class="form-control kt_touchspin_1 savejson" value="{{ @$case->pain_rest_immediate }}" readonly>
                </div>
                <div class="col-lg"><input type="text" name="pain_movement_immediate" id="pain_movement_immediate"
                        class="form-control kt_touchspin_1 savejson" value="{{ @$case->pain_movement_immediate }}"
                        readonly></div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-3">1 h post</div>
                <div class="col-lg"><input type="text" name="pain_rest_post" id="pain_rest_post"
                        class="form-control kt_touchspin_1 savejson" value="{{ @$case->pain_rest_post }}" readonly>
                </div>
                <div class="col-lg"><input type="text" name="pain_movement_post" id="pain_movement_post"
                        class="form-control kt_touchspin_1 savejson" value="{{ @$case->pain_movement_post }}" readonly>
                </div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-3">before D/C</div>
                <div class="col-lg"><input type="text" name="pain_rest_before" id="pain_rest_before"
                        class="form-control kt_touchspin_1 savejson" value="{{ @$case->pain_rest_before }}" readonly>
                </div>
                <div class="col-lg"><input type="text" name="pain_movement_before" id="pain_movement_before"
                        class="form-control kt_touchspin_1 savejson" value="{{ @$case->pain_movement_before }}"
                        readonly></div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-auto">Plan of management</div>
                <div class="col-lg"><input type="text" name="plan_og_management" id="plan_og_management"
                        class="form-control savejson" value="{{ @$case->plan_og_management }}"></div>
            </div>
            <div class="row mt-2 cn">
                <div class="col-lg-auto">Home Medication</div>
                <div class="col-lg"><input type="text" name="home_medication" id="home_medication"
                        class="form-control savejson" value="{{ @$case->home_medication }}"></div>
                <div class="col-lg-auto">
                    <label class="checkbox">
                        <input type="checkbox" name="ck_pain_rm_to" id="ck_pain_rm_to" class="savejson_checkbox"
                            value="RM to" {{ checkselect('RM to', @$case->ck_pain_rm_to) }} />
                        <span></span>
                        &nbsp;RM to
                    </label>
                </div>
                <div class="col-lg"><input type="text" name="pain_rm_to" id="pain_rm_to"
                        class="form-control savejson" value="{{ @$case->pain_rm_to }}"></div>
                <div class="col-lg-auto">
                    <label class="checkbox">
                        <input type="checkbox" name="ck_pain_drug" id="ck_pain_drug" class="savejson_checkbox"
                            value="Drug" {{ checkselect('Drug', @$case->ck_pain_drug) }} />
                        <span></span>
                        &nbsp;Drug
                    </label>
                </div>
                <div class="col-lg"><input type="text" name="pain_drug" id="pain_drug"
                        class="form-control savejson" value="{{ @$case->pain_drug }}"></div>
            </div>
        </div>
    </div>
</div>
<script>
    "use strict";
    var KTKBootstrapTouchspin = function() {
        var demos = function() {
            $('.kt_touchspin_1').TouchSpin({
                buttondown_class: 'btn btn-secondary',
                buttonup_class: 'btn btn-secondary',
                min: 0,
                max: 10,
            });
        }
        return {
            init: function() {
                demos();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTKBootstrapTouchspin.init();
    });
    $('.kt_touchspin_1').on('change', function() {
        $(this).focusout()

    })
</script>
