<!-- Default Modals -->
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#ModalVerify">Show Modal</button> --}}
<div id="ModalVerify" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <span class="fs-16" id="myModalLabel">Verify Data </span>
            </div>
            <div class="border-bottom mt-2"></div>
            <div class="text-center">
                <lord-icon
                src="https://cdn.lordicon.com/lupuorrc.json"
                trigger="loop"
                colors="primary:#121331,secondary:#08a88a"
                style="width:120px;height:120px">
            </lord-icon>
        </div>
        <div class="text-center"> Data Succesfull !</div>


            <div class="modal-body">
                <div class="row px-5 mt-2">
                    <div class="col-6">
                        <div class="">
                            <i class="ri-checkbox-blank-circle-fill ri-xxs"></i>
                            <span>Pre-Diagnosis</span>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                    </div>
                </div>
                <div class="row px-5 mt-2">
                    <div class="col-6">
                        <div class="">
                            <i class="ri-checkbox-blank-circle-fill ri-xxs"></i>
                            <span>Selected Photo (>6)</span>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                    </div>
                </div>
                <div class="row px-5 mt-2">
                    <div class="col-6">
                        <div class="">
                            <i class="ri-checkbox-blank-circle-fill ri-xxs"></i>
                            <span>Finding</span>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                    </div>
                </div>
                <div class="row px-5 mt-2">
                    <div class="col-6">
                        <div class="">
                            <i class="ri-checkbox-blank-circle-fill ri-xxs"></i>
                            <span>Post-Diagnosis</span>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <i class="ri-close-circle-fill ri-lg text-danger"></i>
                    </div>
                </div>
                <div class="row px-5 mt-2">
                    <div class="col-6">
                        <div class="">
                            <i class="ri-checkbox-blank-circle-fill ri-xxs"></i>
                            <span>Procedure</span>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                    </div>
                </div>
                <div class="row px-5 mt-2">
                    <div class="col-6">
                        <div class="">
                            <i class="ri-checkbox-blank-circle-fill ri-xxs"></i>
                            <span>Complication</span>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <i class="ri-indeterminate-circle-fill ri-lg text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center my-3">
                <button type="button" class="btn btn-danger w-lg" data-bs-dismiss="modal">Edit Report</button>
                <button type="button" class="btn btn-success w-lg ms-2">Confirm to generate report</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
