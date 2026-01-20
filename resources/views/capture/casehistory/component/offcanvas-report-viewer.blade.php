
<div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvas_report" aria-labelledby="offcanvasRightLabel"
    style="width: 100%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvas_report"> <i class="ri-macbook-fill"></i> &ensp; Viewer &ensp; <span
                id="case_date"></span> &ensp;
            <b id="testapi">HN: {{ @$case->case_hn }}</b> &ensp; {{ @$case->patientname }}
        </h5>
        <span class="h4">

        </span>
        <button type="button" class="btn-close text-end" data-bs-dismiss="offcanvas" aria-label="Close"></button>

    </div>
    <div class="col-12 p-0 m-0 border-under"></div>
    <div class="offcanvas-body">
        <div class="d-flex ms-3 mb-3">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-soft-secondary rounded me-2" style="" id="btnPhoto">Photo &
                    Video</button>
                <button type="button" class="btn btn-soft-secondary rounded me-2" style="" id="btnReport">Report</button>
                <button type="button" class="btn btn-soft-secondary rounded" style="" id="btnDownload">Download</button>
            </div>
        </div>
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="photo" role="tabpanel">
                <iframe id="iframe_photo" frameborder="0" width="100%" height="775px"></iframe>
            </div>
            <div class="tab-pane" id="pdf_report" role="tabpanel">
                <iframe id="iframe_pdf_report" frameborder="0" width="100%" height="775px"></iframe>
            </div>
            <div class="tab-pane" id="download" role="tabpanel">
                <iframe id="iframe_download" frameborder="0" width="100%" height="775px"></iframe>
            </div>

        </div>
    </div>
</div>
