<button id="warning_btn" type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#warning_modal" hidden>Standard Modal</button>
{{-- <div id="warning_modal" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fs-4" id="myModalLabel">Rotate Confirmation</h5>
                <button type="button" id="all_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <hr style="border: 1px solid #a5a7a8;">
            <div class="modal-body">

                <div class="text-center"><h5 class="fs-4" style="color:#878A99" >หากทำการหมุนภาพ จะไม่สามารถทำการใช้ Crop All และ Crop Selected Photo ได้</h5></div>
                <br>
                <div class="row text-center">
                    <div class="col-2"></div>
                    <div class="col-4">
                        <button id="warning_close_btn"  class="btn btn-light" style="color: #878A99; width:100%" data-bs-dismiss="modal" aria-label="Close">ย้อนกลับ</button>
                    </div>
                    <div class="col-4">
                        <button id="warning_confirm_btn" class="btn btn-light" style="background-color: #DF6E51; color:#FFFFFF; width: 100%">ยืนยัน</button>
                    </div>
                    <div class="col-2"></div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --> --}}

<div id="warning_modal" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="fs-4" id="myModalLabel">Confirmation</h5> --}}
                <button type="button" id="all_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close" hidden> </button>
            </div>
            <hr style="border: 1px solid #a5a7a8;">
            <div class="modal-body">

                <div class="text-center"><h5 class="fs-4" style="color:#878A99" >ทำการบันทึกภาพ</h5></div>
                <br>
                <div class="row text-center">
                    <div class="col-2"></div>
                    <div class="col-4">
                        <button id="warning_close_btn"  class="btn btn-light" style="color: #878A99; width:100%" data-bs-dismiss="modal" aria-label="Close">ย้อนกลับ</button>
                    </div>
                    <div class="col-3">
                        <button id="warning_confirm_btn" class="btn btn-light" style="background-color: #DF6E51; color:#FFFFFF; width: 100%">ยืนยัน</button>
                    </div>
                    <div class="spinner-border text-success" id="warning_confirm_sp" role="status" style="display: none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="col-2"></div>
                </div>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
