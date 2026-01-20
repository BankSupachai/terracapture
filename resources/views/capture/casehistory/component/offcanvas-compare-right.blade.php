<!-- Offcanvas จากทางขวาสำหรับการเปรียบเทียบ -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvascompare_right" aria-labelledby="offcanvasRightLabel"
    style="width: 45%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">
            <i class="ri-sidebar-line"></i> &ensp; <h3 id="case_hn_right"></h3>
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="col-12 p-0 m-0 border-under"></div>
    <div class="offcanvas-body">
        <div class="nav nav-pills nav-justified" id="nav-tab-right" role="tablist">
            <button class="nav-link active" id="nav-photo-tab-right" data-bs-toggle="tab" data-bs-target="#nav-photo-right"
                type="button" role="tab" aria-controls="nav-photo-right" aria-selected="true">
                <i class="ri-image-line"></i> Photo
            </button>
            <button class="nav-link" id="nav-video-tab-right" data-bs-toggle="tab" data-bs-target="#nav-video-right"
                type="button" role="tab" aria-controls="nav-video-right" aria-selected="false">
                <i class="ri-video-line"></i> Video
            </button>
            <button class="nav-link" id="nav-report-tab-right" data-bs-toggle="tab" data-bs-target="#nav-report-right"
                type="button" role="tab" aria-controls="nav-report-right" aria-selected="false">
                <i class="ri-file-text-line"></i> Report
            </button>
        </div>

        <div class="tab-content mt-3" id="nav-tabContent-right">
            <div class="tab-pane fade show active" id="nav-photo-right" role="tabpanel" aria-labelledby="nav-photo-tab-right">
                <div class="row g-2" id="case_photo_right">
                    <!-- Photos will be loaded here -->
                </div>
            </div>
            <div class="tab-pane fade" id="nav-video-right" role="tabpanel" aria-labelledby="nav-video-tab-right">
                <div class="row g-2" id="case_video_right">
                    <!-- Videos will be loaded here -->
                </div>
            </div>
            <div class="tab-pane fade" id="nav-report-right" role="tabpanel" aria-labelledby="nav-report-tab-right">
                <iframe id="iframe_report_right" frameborder="0" width="100%" height="775px;"></iframe>
            </div>
        </div>
    </div>
</div>
