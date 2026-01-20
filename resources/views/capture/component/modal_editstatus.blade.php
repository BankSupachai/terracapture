<!-- Default Modals -->
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Standard Modal</button> --}}
<div id="modal_editstatus" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="col-12 my-2" style="border-bottom: 1px solid #E9EBEC"></div>
            <div class="modal-body">
                <form action="{{url("casemonitor")}}" method="POST">
                    @csrf
                    <input type="hidden" name="event" value="edit_status">
                    <input type="hidden" name="caseuniq" value="" id="modal_editstatus_caseuniq">
                <div class="row ps-3">
                    <div class="col-3">
                        <span class="text-soft-gray">HN / Name</span>
                    </div>
                    <div class="col-9 text-index-dark">
                        <span  id="modal_editcase_hn"> </span> &ensp; &ensp;
                        <span id="modal_editcase_fullname"></span>
                    </div>
                </div>
                <div class="row ps-3 mt-2">
                    <div class="col-3">
                        <span class="text-soft-gray">Physician</span>
                    </div>
                    <div class="col-9">
                        <span class="text-index-dark" id="modal_editcase_doctor"></span>
                    </div>
                </div>
                <div class="row ps-3 mt-2">
                    <div class="col-3">
                        <span class="text-soft-gray">Procedure</span>
                    </div>
                    <div class="col-9" >
                       <span type="text" id="sel_procedure">
                    </div>
                </div>
                {{-- <form action="{{url("casemonitor")}}" method="POST">
                    @csrf
                    <input type="hidden" name="event" value="edit_status">
                    <input type="hidden" name="caseuniq" value="" id="modal_editstatus_caseuniq"> --}}


                    <div class="row ps-3 mt-2">
                        <div class="col-3 ">
                            <span style="color: #878A99">Status</span>
                        </div>
                        <div class="col-9">
                            <select name="monitor_status" class="form-select" id="select_status">
                                {{-- <option value="">Booking</option> --}}
                                <option value="Register">Register</option>
                                <option value="Holding">Holding</option>
                                <option value="Operation">Operation</option>
                                {{-- <option value="">Reporting</option> --}}
                                <option value="Recovery">Recovery</option>
                                {{-- <option value="">Discharge</option> --}}


                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- Buttons with Label Right -->
                    <button type="submit" class="btn btn-primary btn-label waves-effect right waves-light"><i class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                </div>
            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
