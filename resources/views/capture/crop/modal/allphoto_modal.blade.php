<!-- Default Modals -->
<button id="allphoto_btn" type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#allphoto_modal" hidden>Standard Modal</button>
<div id="allphoto_modal" class="modal fade" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"  aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="fs-4" id="myModalLabel">Crop All Photo</h5>
                <button type="button" id="all_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close" hidden> </button>
            </div>
            <hr style="border: 1px solid #a5a7a8;">
            <div class="modal-body">

                <div class="text-center"><h5 class="fs-4" style="color:#878A99" > Are you sure to crop all photos?</h5></div>
                <br>
                <div class="row text-center">
                    <div class="col-2"></div>
                    <div class="col-4">
                        <button id="cancel_all_btn" class="btn btn-light" style="color: #878A99" data-bs-dismiss="modal" aria-label="Close">No, I don't want to crop</button>
                    </div>
                    <div class="col-3">
                        <button id="confirm_all_btn" class="btn btn-light" style="background-color: #DF6E51; color:#FFFFFF">Yes, I want to crop all</button>
                    </div>
                    <div class="spinner-border text-success" id="confirm_selectall_sp" role="status" style="display: none">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="col-2">

                    </div>
                </div>

            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Save Changes</button>
            </div> --}}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


