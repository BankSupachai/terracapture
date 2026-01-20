<div class="col-12">
    {!!editcard('pre-diagnostic-rigid','pre-diagnostic-rigid.blade.php')!!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-12" style="padding: 0;margin-top: 5px;">
                    <div class="row">
                        <div class="col-4">CXR date</div>
                        <div class="col-4">Finding</div>
                        <div class="col-4">at</div>
                        <div class="col-4"><input type="text" name="" class="form-control savejson autotext" autocomplete="off" id="cxr" value="{{@$case->cxr}}"></div>
                        <div class="col-4"><input type="text" name="" class="form-control savejson autotext" autocomplete="off" id="finding_cxr" value="{{@$case->finding_cxr}}"></div>
                        <div class="col-4"><input type="text" name="" class="form-control savejson autotext" autocomplete="off" id="finding_cxr_at" value="{{@$case->finding_cxr_at}}"></div>
                    </div>
                </div>
                <div class="col-12" style="padding: 0;margin-top: 5px;">
                    <div class="row">
                        <div class="col-4">CT CHEST date</div>
                        <div class="col-4">Finding</div>
                        <div class="col-4">at</div>
                        <div class="col-4"><input type="text" name="" class="form-control savejson autotext" autocomplete="off" id="ct" value="{{@$case->ct}}"></div>
                        <div class="col-4"><input type="text" name="" class="form-control savejson autotext" autocomplete="off" id="ct_finding" value="{{@$case->ct_finding}}"></div>
                        <div class="col-4"><input type="text" name="" class="form-control savejson autotext" autocomplete="off" id="ct_finding_at" value="{{@$case->ct_finding_at}}"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
