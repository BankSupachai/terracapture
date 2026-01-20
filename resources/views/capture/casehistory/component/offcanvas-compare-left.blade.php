<!-- Offcanvas จากทางซ้ายสำหรับการเปรียบเทียบ -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvascompare_left" aria-labelledby="offcanvasLeftLabel"
    style="width: 45%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLeftLabel">
           &ensp; <h3 id="case_hn_left"></h3>
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="col-12 p-0 m-0 border-under"></div>
    <div class="offcanvas-body">
        <div class="nav nav-pills nav-justified" id="nav-tab-left" role="tablist">
            <button class="nav-link active" id="nav-photo-tab-left" data-bs-toggle="tab" data-bs-target="#nav-photo-left"
                type="button" role="tab" aria-controls="nav-photo-left" aria-selected="true">
                <i class="ri-image-line"></i> Photo
            </button>
            <button class="nav-link" id="nav-video-tab-left" data-bs-toggle="tab" data-bs-target="#nav-video-left"
                type="button" role="tab" aria-controls="nav-video-left" aria-selected="false">
                <i class="ri-video-line"></i> Video
            </button>
            <button class="nav-link" id="nav-report-tab-left" data-bs-toggle="tab" data-bs-target="#nav-report-left"
                type="button" role="tab" aria-controls="nav-report-left" aria-selected="false">
                <i class="ri-file-text-line"></i> Report
            </button>
        </div>

        <div class="tab-content mt-3" id="nav-tabContent-left">
            <div class="tab-pane fade show active" id="nav-photo-left" role="tabpanel" aria-labelledby="nav-photo-tab-left">
                <div class="row g-2" id="case_photo_left">
                    <!-- Photos will be loaded here -->
                </div>
            </div>
            <div class="tab-pane fade" id="nav-video-left" role="tabpanel" aria-labelledby="nav-video-tab-left">
                <div class="row g-2" id="case_video_left">

                </div>
            </div>
            <div class="tab-pane fade" id="nav-report-left" role="tabpanel" aria-labelledby="nav-report-tab-left">
                <iframe id="iframe_report_left" frameborder="0" width="100%" height="775px;"></iframe>
            </div>
        </div>
    </div>
</div>
