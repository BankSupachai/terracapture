<!-- Default Modals -->

<div id="liveconsult_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header mb-2">
                <h5 class="modal-title text-bbbb fw-light" id="myModalLabel">Live Consult</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div style="border-bottom: 1px solid #707070;"></div>
            <div class="modal-body mt-2">
                <div class="row">
                    <div class="col-auto align-self-center">
                        <label for="iconrightInput " class="form-label">URL : </label>
                    </div>
                    <div class="col-11">
                        <div class="form-icon right">
                            <input type="text" class="form-control form-control-icon" id="iconrightInput" placeholder="">
                            <i class="ri-file-copy-fill ri-lg"></i>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-2">

                        </div>
                        <div class="col-8">
                            <input type="text" id="phonenumber" class="form-control fs-16" placeholder="Mobile No:">
                        </div>
                        <div class="col-2"></div>
                    </div>
                </div>


            </div>

            <div class="col-12 text-center mb-3" style="border-top: 1px solid #707070;">
                <button type="button" id="confirm_btn" class="btn mt-3 w-75" style="background-color: #245788; color: #fff;">Confirm Sending</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


{{-- <div class="modal" tabindex="-1" id="modal_sms">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Telephone Number</p>
                <input type="text" id="phonenumber" class="form form-control" placeholder="">
            </div>
            <div class="modal-footer">
                <button type="button" id="confirm_btn" class="btn btn-primary">Confirm Sending</button>
            </div>
        </div>
    </div>
</div> --}}
