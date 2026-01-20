<!-- Default Modals -->
<style>
    .modal-custom-header{
        display: flex;
        justify-content: space-between;
        padding: 0.5em;
        margin: 0.5em 0 0.5em;
    }
    .form-check-input:checked {
    background-color: #DF6E51;
    border-color: #405189;
}
.form-check-input {
    border: 1px solid #BBBBBB;
}
.modal-width{
    width: 790px !important;
}
</style>
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Standard Modal</button> --}}
<div id="livecam_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog  modal-dialog-centered modal-width">
        <div class="modal-content">
            <div class="modal-custom-header" style="border-bottom: 1px solid #353535">
                <span class="h5" id="myModalLabel">Live Case</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col-12">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                              &ensp;  Local &ensp;&ensp; &ensp;&ensp;&ensp;&ensp;
                            </label>
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                &ensp; Cloud
                            </label>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3 align-self-center">
                        <span class="">Description : </span>
                    </div>
                    <div class="col-9">
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3 align-self-center">
                        <span class="">URL : </span>
                    </div>
                    <div class="col-9">
                        <div class="form-icon right">
                            <input type="text" class="form-control form-control-icon" id="iconrightInput">
                            <i class="ri-file-copy-fill"></i>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-3 align-self-center">
                        <span class="">Password : </span>
                    </div>
                    <div class="col-9">
                        <div class="form-icon right">
                            <input type="text" class="form-control form-control-icon" id="iconrightInput2" >
                            <i class="ri-file-copy-fill"></i>
                        </div>
                    </div>
                    <div class="col-12 mt-4 text-center ">
                        <input class="form-check-input" type="checkbox" id="formCheck3">
                        <label class="form-check-label" for="formCheck3">
                            Anonymous &ensp;
                        </label>
                        <input class="form-check-input" type="checkbox" id="formCheck4">
                        <label class="form-check-label" for="formCheck4">
                            Public Live (no password)
                        </label>
                </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Save Changes</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


