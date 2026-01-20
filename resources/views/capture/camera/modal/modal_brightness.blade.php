
<div class="modal brightness-modal" tabindex="-1" id="modal_brightness">
    <div class="modal-dialog" style="margin-left: 3em; max-width: 27em;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Video Properties (Source 1)</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
            </div>
            <div class="modal-body">
                <div class="row ">
                    <span id="brightness_source" hidden></span>
                    <div class="col-4">Brightness:</div>
                    <div class="col-5">
                        <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_brightness(this.value)"
                        onchange="save_video_properties('brightness', this.value)"
                        id="brightness_range">
                    </div>
                    <div class="col-1 text-center"><output id="brightness_num">128</output></div>
                </div>
                <div class="row">
                    <div class="col-4">Contrast:</div>
                    <div class="col-5">
                        <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_contrast(this.value)"
                        onchange="save_video_properties('contrast', this.value)"
                        id="contrast_range">
                    </div>
                    <div class="col-1 text-center"><output id="contrast_num">128</output></div>
                </div>
                <div class="row">
                    <div class="col-4">Hue:</div>
                    <div class="col-5">
                        <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_hue(this.value)"
                        onchange="save_video_properties('hue', this.value)"
                        id="hue_range">
                    </div>
                    <div class="col-1 text-center"><output id="hue_num">128</output></div>
                </div>
                <div class="row">
                    <div class="col-4">Saturation:</div>
                    <div class="col-5">
                        <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_saturation(this.value)"
                        onchange="save_video_properties('saturation', this.value)"
                        id="saturation_range">
                    </div>
                    <div class="col-1 text-center"><output id="saturation_num">128</output></div>
                </div>
                <div class="row">
                    <div class="col-4">Sharpness:</div>
                    <div class="col-5">
                        <input type="range" class="form-range" min="0" max="255" value="128" step="1"
                        oninput="set_sharpness(this.value)"
                        onchange="save_video_properties('sharpness', this.value)"
                        id="sharpness_range">
                    </div>
                    <div class="col-1 text-center"><output id="sharpness_num">128</output></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="save_property_btn" class="btn btn-primary">Save</button>
                <button type="button" id="reset_property_btn" class="btn btn-info">Reset</button>
                <button type="button" id="close_property_btn" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
