<div class="offcanvas offcanvas-start" tabindex="-1" id="livecase_offcanvas" aria-labelledby="offcanvasExampleLabel" style="z-index: 9999999">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title bold" id="offcanvasExampleLabel">Live Solution</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0" style="background: #1a1a1a; color: #fff;">

        <!-- Live Consult Section -->
        <div class="row p-3" style="background: #121212;">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <span class="text-white fw-bold">Live Consult</span>
                <div class="form-check form-switch form-switch-primary">
                    <input class="form-check-input" type="checkbox" role="switch" id="liveConsultSwitch" checked>
                </div>
            </div>
        </div>

        <div class="px-3 py-3">
            <!-- URL Field -->
            <div class="mb-3">
                <label class="form-label text-white-50 small">URL :</label>
                <div class="input-group">
                    <input type="text" id="livestream_url" name="livestream_url" class="form-control text-white border-secondary">

                    <button id="btn_copy_url" class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div

            <!-- Mobile Number Field -->
            <div class="mb-3">
                <label class="form-label text-white-50 small">Mobile number :</label>
                <input type="text" id="livestream_mobile" name="livestream_mobile" class="form-control text-white border-secondary"
                       placeholder="091 234 5678" value="091 234 5678">
            </div>

            <!-- Send SMS Button -->
            <div class="text-center mb-4">
                <button id="btn_send_sms" name="send_sms" class="btn btn-primary px-5">Send SMS</button>
            </div>
        </div>

        <!-- Live Case Section -->
        <div class="row p-3" style="background: #121212;">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <span class="text-white fw-bold">Live Case</span>
                <div class="form-check form-switch form-switch-primary">
                    <input class="form-check-input" type="checkbox" role="switch" id="liveCaseSwitch">
                </div>
            </div>
        </div>

        <div class="px-3 py-3">
            <!-- Description Field -->
            <div class="mb-3">
                <label class="form-label text-white-50 small">Description :</label>
                <div class="input-group">
                    <input type="text" id="livestream_description" name="livestream_description" class="form-control text-white border-secondary"
                           placeholder="Performing ESD" value="Performing ESD">
                    <button id="btn_copy_description" class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>

            <!-- URL Options -->
            <div class="mb-3">
                <label class="form-label text-white-50 small">URL :</label>
                <div class="row mb-2">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="urlType" id="localUrl" checked>
                            <label class="form-check-label text-white" for="localUrl">
                                Local
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="urlType" id="cloudUrl">
                            <label class="form-check-label text-white" for="cloudUrl">
                                Cloud
                            </label>
                        </div>
                    </div>
                </div>
                <div class="input-group">
                    <input type="text" id="livestream_case_url" name="livestream_case_url" class="form-control text-white border-secondary"
                           placeholder="http://192.168.111.111/ic/098aed14352043dc94730"
                           value="http://192.168.111.111/ic/098aed14352043dc94730">
                    <button id="btn_copy_case_url" class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <label class="form-label text-white-50 small">Password :</label>
                <input type="text" id="livestream_password" name="livestream_password" class="form-control text-white border-secondary"
                       placeholder="123456" value="123456">
            </div>

            <!-- Anonymous Checkbox -->
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="anonymousCheck">
                <label class="form-check-label text-white" for="anonymousCheck">
                    Anonymous
                </label>
            </div>

            <!-- Start Live Case Button -->
            <div class="text-center">
                <button id="btn_start_live_case" name="start_live_case" class="btn btn-primary px-5">Start Live Case</button>
            </div>
        </div>

    </div>
</div>

@if (@$feature->liveconsult)
    <script src='http://medicaendo.com:3000/socket.io/socket.io.js'></script>
    <script>
        var socketserver = io.connect('http://medicaendo.com:3000');
    </script>
@endif
