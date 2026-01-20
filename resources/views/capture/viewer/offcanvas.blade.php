<div class="offcanvas-body">
    <div class="row justify-content-between">
        <div class="col-6">
            <ul class="nav nav-pills nav-success mb-3" role="tablist">
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link active " data-bs-toggle="tab" href="#report_viewer" id="btn_report" role="tab">Report</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link " data-bs-toggle="tab" href="#photo_viewer" id="btn_photo" role="tab">Photo</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link " data-bs-toggle="tab" href="#video_viewer" id="btn_video" role="tab">Video</a>
                </li>
                <li class="nav-item waves-effect waves-light">
                    <a class="nav-link " data-bs-toggle="tab" href="#video_viewer" id="" role="tab">Download</a>
                </li>
            </ul>
        </div>

        <input type="hidden" id="caseid_inp">

        <div class="col-4 " id="physician_select">
            <select id="pdf_type" class="form-select mb-3" aria-label="Default select example" onchange="change_pdf('')" style="background-color:#F3F6F9;">
                <option value="physician" selected>Physician</option>
                <option value="nurse">Nurse</option>
                <option value="followup">Follow Up</option>
                <option value="billing">Billing</option>
                <option value="billing">Test222</option>
            </select>
        </div>
        <div class="row m-0">
            <div class="col-12">
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="report_viewer" role="tabpanel">
                        <iframe id="iframepdf" src="" width="100%" height="1200" style="display: none" ></iframe>
                        <div id="endosmart_report">
                            {{-- report img here --}}
                        </div>
                    </div>
                    <div class="tab-pane" id="photo_viewer" role="tabpanel">
                        <div class="row" id="photo_div">

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
                    <div class="tab-pane" id="video_viewer" role="tabpanel">
                        <div class="row" id="video_div">

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
