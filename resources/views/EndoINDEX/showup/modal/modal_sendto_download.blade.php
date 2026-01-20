<!-- Default Modals -->
<style>
    .ri-4x{
       font-size: 50px;
    }
    .modal-body .custom{
        margin-top: -0.8em;
        margin-left: -0.8em;
    }
</style>

<div id="modal_sendto_download" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #E9EBEC">
                <h5 class="modal-title" id="myModalLabel">Download</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                @php
                $command = 'wmic logicaldisk get caption';
                exec($command, $output);
                if (($key = array_search('Caption', $output)) !== false) {
                    unset($output[$key]);

                }
            @endphp
                <div class="col-12 patient-data"></div>
                <div class="row mt-2">
                    <div class="col-3">
                        Select your file
                    </div>
                    <div class="col-3">
                        <div class="form-check mb-2">
                            <input class="form-check-input allphoto" type="checkbox" id="allphoto">
                            <label class="form-check-label" for="allphoto">
                                All Photo
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center mb-3">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-5">

                        <button class="btn btn-primary w-100 action-btn" data-type="report+photo" ><i class="ri-download-2-fill"></i>&nbsp;&nbsp;Report & Photo</button>
                    </div>
                    <div class="col-5">
                        <button class="btn btn-primary w-100 action-btn" data-type="video"><i class="ri-download-2-fill"></i>&nbsp;&nbsp;Video</button>
                    </div>
                    <div class="col-1"></div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>




</script>
