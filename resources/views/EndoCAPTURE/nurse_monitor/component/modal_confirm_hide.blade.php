<style>
    #confirm_hide_modal .row .col-3 {
        color: red !important;
    }
    .modal-title{
        font-weight: 100 !important;
    }
</style>


<div id="confirm_hide_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom p-2">
                <h5 class="modal-title" id="myModalLabel">Cancel case display </h5>
                <input type="hidden" id="hide_caseid">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            {{-- @dd($patient) --}}
            <div class="modal-body">
                <div class="row ps-3">
                    <div class="col-3">
                        <span class="text-soft-gray">HN / Name</span>
                    </div>
                    <div class="col-9 text-index-dark">
                        <span id="modal_cancelcase_hn"> </span> &ensp; &ensp;
                        <span id="modal_cancelcase_fullname"></span>
                    </div>
                </div>

                <div class="row ps-3 mt-3">
                    <div class="col-3">
                        <span class="text-soft-gray">Physician</span>
                    </div>
                    <div class="col-9">
                        <span class="text-index-dark" id="modal_cancelcase_doctor"></span>
                    </div>
                </div>
                <div class="row ps-3 mt-3">
                    <div class="col-3">
                        <span class="text-soft-gray">Procedure</span>
                    </div>
                    <div class="col-9">
                        <span class="text-index-dark" id="modal_cancelcase_procedure"></span>
                    </div>
                </div>

                <div class="row ps-3 mt-3">
                    <div class="col-3">
                        <span style="color: #878A99">Reason</span>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control bg-light border-0 w-100">
                    </div>
                </div>
                {{-- <p>Do you want to show this case from showing on the monitor?</p> --}}
            </div>
            <div class="row ps-3 mb-3 mt-3">
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-light w-75" data-bs-dismiss="modal" style="color: #878A99">No, I don’t want to
                        Cancel</button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-danger w-75" id="confirm_hide_btn">Yes, I want to
                        Cancel</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
