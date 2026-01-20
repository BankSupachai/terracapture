<div id="multi_confirm_hide_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom p-2">
                <h5 class="modal-title" id="myModalLabel">Cancel this case</h5>
                <input type="hidden" id="muti_hide_caseid">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body px-5">
                <input type="hidden" name="event" value="cancel_case">

                <div class="row">
                    <div class="col-2">
                        <span style="color: #878a99;">HN / Name</span>
                    </div>
                    <div class="col-9">
                        <span id="hide_hn"></span> /&ensp; <span id="hide_name"></span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2" style="color: #878a99;">
                        Endoscopist
                    </div>
                    <div class="col-9">
                        <span id="case_cancel_doctor"></span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2" style="color: #878a99;">
                        Procedure
                    </div>
                    <div id="render_cancelcase" class="col-9">
                        <table class="table table-nowrap table-borderless">

                            <tbody id="hide_detail_tbody">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-2" style="color: #878a99;">
                        Reason
                    </div>
                    <div class="col-9">
                        <div>
                            <input type="text" class="form-control" id="basiInput">
                        </div>
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="col-12 mt-2 mb-4 text-center">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="color: #878a99;">No, I don’t want to Cancel</button>
                    <button type="button" id="multi_confirm_hide_btn" class="btn btn-danger ms-5">Yes, I want to Cancel</button>
                </div>
            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
