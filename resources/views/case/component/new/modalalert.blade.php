<!-- Default Modals -->
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#ModalAlert">Show ModalAlert</button> --}}
<div id="ModalAlert" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog" style="max-width: 45%;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="fs-16 fw-normal" id="myModalLabel">You have another operation that haven’t report.</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="border-bottom mt-2"></div>
            <div class="modal-body">
                <span class="text-muted">Select your operation</span>

                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Operation</td>
                            <td class="text-end">Action</td>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Caseuniq</td>
                            <td>Suratchanut Chitrat</td>
                            <td>Colonoscopy</td>
                            <td class="text-end">
                                <button class="btn btn-primary btn-icon btn-sm">
                                    <i class="ri-folder-3-fill"></i>
                                </button>
                            </td>

                        </tr>
                        <tr>
                            <td>Caseuniq</td>
                            <td>Suratchanut Chitrat</td>
                            <td>Colonoscopy</td>
                            <td class="text-end">
                                <button class="btn btn-primary btn-icon btn-sm">
                                    <i class="ri-folder-3-fill"></i>
                                </button>
                            </td>

                        </tr>
                        <tr>
                            <td>Caseuniq</td>
                            <td>Suratchanut Chitrat</td>
                            <td>Colonoscopy</td>
                            <td class="text-end">
                                <button class="btn btn-primary btn-icon btn-sm">
                                    <i class="ri-folder-3-fill"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-12 text-center my-3">
                <button type="button" class="btn btn-danger w-75">Continue generate this report</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
