
<div id="cf_imageModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title h5 fw-light text-dark " id="myModalLabel">Confirm to move photo</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <hr>
            <div class="modal-body pt-0">
                <div class="row m-0">

                    <div class="col-5">
                        <span class="text-muted">From</span>
                        <div class="card mt-2 p-2" style="background: #F3F6F9;">
                            <div class="row">
                                <div class="col-5">
                                    <span class="fw-bold">HN :</span>
                                </div>
                                <div class="col-7">
                                    <span>{{$case->case_hn}}</span>
                                </div>
                            </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        <span class="fw-bold">Name :</span>
                                    </div>
                                    <div class="col-7 text-nowrap">
                                        <span>{{$case->patientname}}</span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        <span class="fw-bold">Procedure :</span>
                                    </div>
                                    <div class="col-7">
                                        <span>{{$case->procedurename}}</span>
                                     </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        <span class="fw-bold">Endoscopist :</span>
                                    </div>
                                    <div class="col-7">
                                        <span>{{$case->doctorname}}</span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-2 align-self-center text-center">
                        <i class="bx bx-chevrons-right  bx-md"></i>
                    </div>
                    <div class="col-5">
                        <span class="text-muted">To</span>
                        <div class="card mt-2 p-2" style="background: #F3F6F9;">
                            <div class="row">
                                <div class="col-5">
                                    <span class="fw-bold">HN :</span>
                                </div>
                                <div class="col-7">
                                    <span id="new_hn"></span>
                                </div>
                            </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        <span class="fw-bold">Name :</span>
                                    </div>
                                    <div class="col-7 text-nowrap">
                                        <span id="new_patient"></span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        <span class="fw-bold">Procedure :</span>
                                    </div>
                                    <div class="col-7">
                                        <span id="new_procedure"></span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-5">
                                        <span class="fw-bold">Endoscopist :</span>
                                    </div>
                                    <div class="col-7">
                                        <span id="new_doctor"></span>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <span class="text-danger">เหตุผลการย้ายเศส**</span>
                         <textarea name="" id="edit_event" class="form-control" rows="2"></textarea>
                     </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row p-2">

                    <div class="col-4 align-self-center text-end">
                        <b>OTP : {{$otp}} </b>
                    </div>
                    <div class="col-5">
                        <input type="text" placeholder="Fill the OTP" id="otp_photo_move" autocomplete="off" class="form-control">
                    </div>
                    <div class="col-3 text-end">
                        <button type="button" id="btn_photo_move" class="btn btn-dark-primary btn-label waves-effect right w-lg waves-light"><i
                            class="ri-check-double-line label-icon align-middle fs-16 ms-2" ></i> Confirm</button>
                    </div>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
