{{ bladelink('capture/camera/obs/manage_camera') }}
<div class="row ms-1 box-detail p-custom" style="height: 172px;">
    {{-- <div class="col-5 mt-2 text-white text-nowrap">Switch Status</div> --}}
    {{-- <div class="col-4 mt-2 text-success m-0 p-0">Connected</div> --}}
    {{-- <div class="col-3">
        <button type="button" id="btn_signal_lost_modal" class="btn btn-soft-darkness" data-bs-toggle="modal"
            data-bs-target="#modal_signal_lost">
            <i class="ri-message-2-line"></i>
        </button>
    </div> --}}
    <div class="row text-nowrap mt-1">
        <div class="col-5 text-white align-self-center">Camera Signal</div>
        <div class="col-7">
            <button type="button" id="reload_btn"
                class="ac_reload_btn btn btn-danger btn-sm btn-label wave-effect waves-light w-lg">
                <i class="las la-undo-alt me-2 label-icon align-middle"></i> <span class="ms-4">Reset Camera</span>
            </button>
        </div>
        <div class="col-5 text-white align-self-center">Live Solution</div>
        <div class="col-7">
            <button data-bs-toggle="offcanvas" id="btn_modalliveconsult" role="button"
                aria-controls="offcanvasExample"
                class="btn btn-label wave-effect waves-light btn-sm mt-2 w-lg btn-live-solution">
                <i class="mdi mdi-cast-variant label-icon align-middle"></i> <span class="ms-4">Live
                Solution</span></button>
        </div>
    </div>
    <div class="row align-self-center mt-1">
        <div class="col-5 text-white">Storage</div>
        <div class="col-7 mt-2">
            <div class="progress">
                <div class="progress-bar bg-success" id="storage_progress" role="progressbar"
                    style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
            <span class="text-nowrap text-white" id="storage_text">Loading...</span>
        </div>
    </div>
</div>
<audio loop autoplay>
    <source src="http://localhost/config/sound/capture/silence32min.mp3" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>
<script>
    $('#btn_modalliveconsult').on('click', function() {
        $('#livecase_offcanvas').offcanvas('show');
    });

    // Load storage information
    async function loadStorageInfo() {
        try {
            const data = await CameraAPI.getStorage();

            // Update progress bar
            const progressBar = document.getElementById('storage_progress');
            if (progressBar) {
                progressBar.className = `progress-bar ${data.drive_color}`;
                progressBar.style.width = `${data.persen}%`;
                progressBar.setAttribute('aria-valuenow', data.persen);
            }

            // Update storage text
            const storageText = document.getElementById('storage_text');
            if (storageText) {
                const used = data.ds - data.drive;
                storageText.textContent = `${used} GB / ${data.ds} GB (${data.persen}%)`;
            }
        } catch (error) {
            console.error('Error loading storage info:', error);
            const storageText = document.getElementById('storage_text');
            if (storageText) {
                storageText.textContent = 'Error loading storage info';
            }
        }
    }

    // Load storage info when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadStorageInfo);
    } else {
        loadStorageInfo();
    }
</script>
