<div class="offcanvas offcanvas-start" tabindex="-1" id="camera_offcanvas" aria-labelledby="offcanvasExampleLabel"
    style="z-index: 9999999">
    <div class="offcanvas-header">
        <h6 class="offcanvas-title bold" id="offcanvasExampleLabel">Camera Setting</h6>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="row p-2" style="background: #121212;">
            <div class="col-12 d-flex justify-content-between ">
                <span class="text-white">Source 1</span>
                <div class="form-check form-switch form-switch-primary">
                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck1" checked>

                </div>
            </div>
        </div>
        <div class="px-3 mt-2">
            <div class="row justify-content-center mt-3">
                <span class="text-white">Set video properties :</span>
                <div class="col-2"></div>
                <div class="col-8">
                    <hr>
                </div>
                <div class="col-2"></div>
            </div>

            <div class="row ">
                <span id="brightness_source" hidden></span>
                <div class="col-4">Brightness:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_brightness(this.value)" onchange="save_video_properties('brightness', this.value)"
                        id="brightness_range">
                </div>
                <div class="col-1 text-center"><output id="brightness_num">128</output></div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Contrast:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_contrast(this.value)" onchange="save_video_properties('contrast', this.value)"
                        id="contrast_range">
                </div>
                <div class="col-1 text-center"><output id="contrast_num">128</output></div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Hue:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_hue(this.value)" onchange="save_video_properties('hue', this.value)"
                        id="hue_range">
                </div>
                <div class="col-1 text-center"><output id="hue_num">128</output></div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Saturation:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_saturation(this.value)" onchange="save_video_properties('saturation', this.value)"
                        id="saturation_range">
                </div>
                <div class="col-1 text-center"><output id="saturation_num">128</output></div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Sharpness:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_sharpness(this.value)" onchange="save_video_properties('sharpness', this.value)"
                        id="sharpness_range">
                </div>
                <div class="col-1 text-center"><output id="sharpness_num">128</output></div>
            </div>
        </div>
        <div class="row p-2 mt-3" style="background: #121212;">
            <div class="col-12 d-flex justify-content-between ">
                <span class="text-white">Source 2</span>
                <div class="form-check form-switch form-switch-primary">
                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck2">

                </div>
            </div>
        </div>

        <div class="px-3 mt-2">
            <div class="row justify-content-center mt-3">
                <span class="text-white">Set video properties :</span>
                <div class="col-2"></div>
                <div class="col-8">
                    <hr>
                </div>
                <div class="col-2"></div>
            </div>

            <div class="row ">
                <span id="brightness_source" hidden></span>
                <div class="col-4">Brightness:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128"
                        step="1" oninput="set_brightness(this.value)"
                        onchange="save_video_properties('brightness', this.value)" id="brightness_range">
                </div>
                <div class="col-1 text-center"><output id="brightness_num">128</output></div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Contrast:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128"
                        step="1" oninput="set_contrast(this.value)"
                        onchange="save_video_properties('contrast', this.value)" id="contrast_range">
                </div>
                <div class="col-1 text-center"><output id="contrast_num">128</output></div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Hue:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128"
                        step="1" oninput="set_hue(this.value)"
                        onchange="save_video_properties('hue', this.value)" id="hue_range">
                </div>
                <div class="col-1 text-center"><output id="hue_num">128</output></div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Saturation:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128"
                        step="1" oninput="set_saturation(this.value)"
                        onchange="save_video_properties('saturation', this.value)" id="saturation_range">
                </div>
                <div class="col-1 text-center"><output id="saturation_num">128</output></div>
            </div>
            <div class="row mt-2">
                <div class="col-4">Sharpness:</div>
                <div class="col-5">
                    <input type="range" class="form-range" min="0" max="255" value="128"
                        step="1" oninput="set_sharpness(this.value)"
                        onchange="save_video_properties('sharpness', this.value)" id="sharpness_range">
                </div>
                <div class="col-1 text-center"><output id="sharpness_num">128</output></div>
            </div>
        </div>
        <div class="row  justify-content-center mt-5">
            <div class="col-12 text-center">
                <button class="btn btn-primary w-75" data-bs-toggle="offcanvas"
                    data-bs-target="#camera_offcanvas">Save and Close</button>
            </div>
        </div>

    </div>
</div>
