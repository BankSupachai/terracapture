<style>
    .fw-regular{
        font-weight:normal;
    }
    .fw-500{
        font-weight: 500 !important;
    }
    .b-none{
        border: 0px;
    }
    .btn-orange-custom{
        color: #f7bb48;
        border: 1px solid #f7bb48;
        background: transparent;
    }
    .btn-orange-custom:hover{
        color: #f7bb48;
        border: 1px solid #f7bb48;
        background: transparent;
    }
</style>
<div class="modal fade" id="signed_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #E9EBEC">
                <span class="h5" id="myModalLabel">E-Signature</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body px-3 pt-2">
                <small class="text-muted">Please enter your E-Signature id</small>
                <div class="row h5">
                    <div class="col-12 mt-2">
                        <span id="doctorname_txt" class="fw-regular"></span>
                    </div>
                </div>
                <div class="row ">
                    <input type="hidden" id="btn_id">
                    <div class="col-8">
                        <input type="text" id="user_code_inp" class=" form-control bg-light b-none" autocomplete="off"></div>
                        <div class="col-4 ">
                            <a href="javascript:;" id="create_sign_btn" class="btn btn-load btn-orange-custom w-100">Edit</a>

                        </div>
                        {{-- <div class="col-4 align-self-center fw-bold"><span id="warning_msg" style="color: red;  "></span></div> --}}
                </div>


                <div class="row">

                    <div class="col-12">
                        <button type="button" id="confirm_signed_btn" id="confirm_signed"class="btn btn-load btn-primary mt-4 w-100" disabled>Confirm</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var signedModal = document.getElementById('signed_modal');
        var userCodeInput = document.getElementById('user_code_inp');

        signedModal.addEventListener('shown.bs.modal', function () {
            userCodeInput.focus();
        });
    });
</script>
