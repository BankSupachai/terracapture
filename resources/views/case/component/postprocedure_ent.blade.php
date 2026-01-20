<div class="col-12">
    {!! editcard('histopathology', 'histopathology.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">

            <h3 class="card-label">
                <u>Post-PROCEDURE (Other)</u>
            </h3>
            <div class="row">
                <div class="col-12 set_col">
                    <div class="row">
                        <div class="col-12">
                            <b>Comment : </b>
                        </div>
                        <div class="col-12">
                            <textarea id='case_comment' name="case_comment" type="text" placeholder="Free text" class="savejson form-control autotext">{{ @$case->case_comment }}</textarea>
                        </div>
                        <div class="col-12">&nbsp;</div>
                        <div class="col-12">
                            <b>Impression : </b>
                        </div>
                        <div class="col-12">
                            <textarea id='case_impression' name="case_impression" type="text" placeholder="Free text" class="savejson form-control autotext">{{ @$case->case_impression }}</textarea>
                        </div>
                        <div class="col-12">&nbsp;</div>
                        <div class="col-12">
                            <b>Plan : </b>
                        </div>
                        <div class="col-12">
                            <textarea id='case_plan' name="case_plan" type="text" placeholder="Free text" class="savejson form-control autotext">{{ @$case->case_plan }}</textarea>
                        </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
