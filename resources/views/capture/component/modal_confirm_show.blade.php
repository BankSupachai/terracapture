<div id="confirm_show_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom p-2">
                <h5 class="modal-title" id="myModalLabel">Confirm show this case </h5>
                <input type="hidden" id="show_caseid">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row ps-3">
                    <div class="col-3">
                        <span class="text-soft-gray">HN / Name</span>
                    </div>
                    <div class="col-9 text-index-dark">
                        <span  id="modal_showcase_hn"> </span> &ensp; &ensp;
                        <span id="modal_showcase_fullname"></span>
                    </div>
                </div>
                <div class="row ps-3 mt-2">
                    <div class="col-3">
                        <span class="text-soft-gray">Procedure</span>
                    </div>
                    <div class="col-9">
                        <span class="text-index-dark" id="modal_showcase_procedure"></span>
                    </div>
                </div>
                <div class="row ps-3 mt-2">
                    <div class="col-3">
                        <span class="text-soft-gray">Endoscopist</span>
                    </div>
                    <div class="col-9">
                        <span class="text-index-dark" id="modal_showcase_doctor"></span>
                    </div>
                </div>
                <div class="row ps-3 mt-2">
                    <div class="col-3">
                        <span style="color: #878A99">Reason</span>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control bg-light border-0 w-100">
                    </div>
                </div>
                {{-- <p>Do you want to show this case from showing on the monitor?</p> --}}
            </div>
            <div class="modal-footer p-2">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-orange w-75" id="confirm_show_btn" data-bs-dismiss="modal">Confirm</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

