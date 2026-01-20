<div id="move_case_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Move Case</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{url('movecase')}}" id="movecase_form" method="post">

                    @csrf
                    <input type="hidden" name="project" value="capture">
                    <input type="hidden" name="event" value="move_case">
                    <input type="hidden" name="case_id" value="{{@$case->id}}">
                    <input type="hidden" name="folderdate" value="{{@$folderdate}}">
                    <div class="row">
                        <div class="col-2"><span class="form-label mt-2">HN:</span></div>
                        <div class="col-7 p-0 me-3">
                            <input type="text" name="move_hn" id="move_case_hn" class="form-control" id="placeholderInput" placeholder="HN">
                        </div>
                        <div class="col-2 p-0"><button type="button" class="btn btn-info waves-effect waves-light" onclick="clear_input('move_case_hn')" style="width:100%">Clear</button></div>
                    </div>
                    <div class="row" id="patient_detail_div">
                        <div id="move_to_div" style="display:none">
                            <div id="patient_check_div" style="display: block">
                                <hr class="mt-3">
                                    <div class="col-12 mb-2" id="no_patient_div" style="display: none">ไม่มี HN นี้ในระบบ</div>
                                    <div class="mb-2" id="have_patient_div" style="display: none">
                                        <div class="row">
                                            <div class="col-2"><p class="fs-4">HN: </p></div>
                                            <div class="col-10"><p class="fs-4" id="move_to_hn">TEST</p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-2"><p class="fs-4">Name: </p></div>
                                            <div class="col-10"><p class="fs-4" id="move_to_name">TEST</p></div>
                                        </div>
                                    </div>
                            </div>
                            <div id="move_to_case" style="display: none">
                                <div class="row">
                                    <div class="col-6"><button type="button" id="movecase_submit_btn" class="btn btn-success waves-effect waves-light" style="width: 100%; margin:0px">Move</button></div>
                                    <div class="col-6 m-0"><button type="button" class="btn btn-danger waves-effect waves-light" style="width: 100%" data-bs-dismiss="modal">Cancel</button></div>
                                </div>
                            </div>
                            <div id="move_to_patient" style="display: none">
                                <div class="row">
                                    <div class="col-6 m-0"><a href="{{url('patient/create')}}" class="btn btn-success waves-effect waves-light w-100" style="margin:0px">Create Patient</a></div>
                                    <div class="col-6 m-0"><button type="button" class="btn btn-danger waves-effect waves-light w-100" style="margin:0px" data-bs-dismiss="modal">Cancel</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
