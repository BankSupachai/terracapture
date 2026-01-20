
<div class="row mt-2">
    <div class="col-12 mb-2" style="border-right: 1px solid #707070">
        <input type="hidden" id="vdoname">
        <input type="text" class="form-control" id="change_camera"
            placeholder="Select Camera" value="{{ @$scope_data }}">
            <div class="row">
                <div class="col-6 mt-3">
                    <button type="button"
                        class="btn btn-icon btn-white-camera  btn-capture waves-effect waves-light"
                        id="btn-capture"><i class="ri-camera-fill ri-xl"></i></button>
                    <button type="button"
                        class="btn btn-icon btn-record  waves-effect waves-light  btn-record"
                        id="record1" onclick="record(this.id)">
                        <i class="ri-record-circle-line ri-xl"></i></button>
                    <small class="text-danger" style="font-size: 14px">
                        <span id="pleasereload1" style="display: none;">การบันทึก VDO
                            ขัดข้องกรุณา Reload Source1</span></small>
                </div>
                <div class="col-6 mt-2 text-end">
                    <span class="text-danger timer1" id="">00:00:00</span><br>

                    Size &nbsp; <span class="text-white text-nowrap size1 "
                        style="font-size: 10px;">
                        0 </span> &nbsp; mb.
                </div>
            </div>
    </div>
</div>
