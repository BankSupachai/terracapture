<div class="offcanvas-body">
    <div class="row justify-content-between">
        <div class="col-6">
            <ul class="nav nav-pills nav-success mb-3" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active text-light report-btn" data-bs-toggle="tab" href="#report_viewer2" id="btn_report2" role="tab">Report</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-light photo-btn" data-bs-toggle="tab" href="#photo_viewer2" id="btn_photo2" role="tab">Photo</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link text-light video-btn" data-bs-toggle="tab" href="#video_viewer2" id="btn_video2" role="tab">Video</a>
                </li>
            </ul>
        </div>

        <input type="hidden" id="caseid_inp2">

        <div class="col-4 physician-select" id="physician_select2">
            <select id="pdf_type2" class="form-select mb-3 form-terra" aria-label="Default select example" onchange="change_pdf('2')">
                <option value="physician" selected>Physician</option>
                <option value="nurse">Nurse</option>
                <option value="followup">Follow Up</option>
                <option value="billing">Billing</option>

            </select>
        </div>
        <div class="row m-0">
            <div class="col-12">
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="report_viewer2" role="tabpanel">
                        <iframe id="iframepdf2" src="" width="100%" height="1200" style="display: none" ></iframe>
                        <div id="endosmart_report2">
                            {{-- report img here --}}
                        </div>
                    </div>
                    <div class="tab-pane" id="photo_viewer2" role="tabpanel">
                        <div class="row" id="photo_div2">

                            {{-- <div class="col-6">
                                <img src="{{url("assets/images/@fortest/procedure1.jpg")}}" class="img-fluid" alt="">
                            </div>
                            <div class="col-6">
                                <img src="{{url("assets/images/@fortest/procedure2.jpg")}}" class="img-fluid" alt="">
                            </div>
                            <div class="col-6 mt-4">
                                <img src="{{url("assets/images/@fortest/procedure1.jpg")}}" class="img-fluid" alt="">
                            </div>
                            <div class="col-6 mt-4">
                                <img src="{{url("assets/images/@fortest/procedure2.jpg")}}" class="img-fluid" alt="">
                            </div> --}}
                        </div>
                    </div>
                    <div class="tab-pane" id="video_viewer2" role="tabpanel">
                        <div class="row" id="video_div2">

                            {{-- <div class="col-12">

                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
