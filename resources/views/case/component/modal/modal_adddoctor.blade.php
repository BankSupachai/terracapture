<style>

</style>
<!-- Default Modals -->
<div id="modal_adddoctor" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add New - Endoscopist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="col-12 mt-2" style="border-bottom: 1px solid #E9EBEC;"></div>

            <div class="modal-body ">
                <form action="{{url('procedure')}}" method="POST">
                    @csrf
                    <span class="fs-13 text-muted"> Please fill the field </span>
                    <div class="row mt-3">
                        <input type="hidden" name="event" value="add_doctor">
                        <input type="hidden" name="cid" value="{{$cid}}">
                        <div class="col-3 text-soft-gray">Prefix</div>
                        <div class="col-3 text-soft-gray">First name</div>
                        <div class="col-3 text-soft-gray">Last name</div>
                        <div class="col-3 text-soft-gray">Physician ID</div>



                        <div class="col-3">
                            <input type="text" class="form-control " name="user_prefix" autocomplete="off">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" name="user_firstname" autocomplete="off">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" name="user_lastname" autocomplete="off">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control " name="user_code" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row text-center mb-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-75">+ Create Endoscopist</button>
                    </div>
                </div>
            </form>


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
