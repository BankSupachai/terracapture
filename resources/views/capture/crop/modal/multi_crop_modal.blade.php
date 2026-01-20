<!-- Multi Crop Modal -->
<button id="multi_crop_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#multi_crop_modal" hidden>
    Launch Multi Crop Modal
</button>
<div class="modal fade" id="multi_crop_modal" tabindex="-1" aria-labelledby="multiCropModalLabel" aria-modal="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl" style="min-width: 1400px; max-width: 95vw;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-sort-blue" id="multiCropModalLabel">Crop All Photos Individually</h5>
                <button type="button" id="multi_crop_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-12">

                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <button type="button" id="sync_crop_size_btn" class="btn btn-warning btn-label waves-effect waves-light me-2">
                            <i class="ri-layout-grid-line label-icon align-middle fs-16 me-2"></i>
                            Sync All Crop Sizes
                        </button>
                        <button type="button" id="sync_movement_btn" class="btn btn-success btn-label waves-effect waves-light">
                            <i class="ri-drag-move-line label-icon align-middle fs-16 me-2"></i>
                            <span id="sync_movement_text">Disable Sync All</span>
                        </button>
                        <div class="spinner-border text-warning" id="sync_crop_sp" role="status" style="display: none; margin-left: 10px;">
                            <span class="visually-hidden">Syncing...</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="multi_crop_container" style="max-height: 70vh; overflow-y: auto;">
                            <!-- Photos will be dynamically loaded here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-dark-primary btn-label waves-effect right w-lg waves-light" id="confirm_multi_crop_btn">
                    <i class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Apply All Crops
                </button>
                <div class="spinner-border text-success" id="confirm_multi_crop_sp" role="status" style="display: none">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>
