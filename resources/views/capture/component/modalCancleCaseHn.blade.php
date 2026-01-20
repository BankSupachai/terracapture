
<div class="modal fade" id="modal_cancel_hn">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
        <div class="modal-content p-3">
            <div class="modal-header p-0 border-bottom">
                <h5 class="text-center text-dark">Cancel this case </h5>
                <button type="button" class="btn btn-sm btn-close p-1" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-0">
                <form action="{{ url('casemonitor') }}" method="post" id="cancel_form">
                    @csrf
                    <input type="hidden" name="event" value="cancel_case">
                    <div class="row" id="delete_div">

                    </div>
                    <div class="row" id="close_modal_div">
                        <div class="col-12 p-0 mt-4 text-center">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="margin-right: 2rem; color: #878A99">No, I don’t want to Cancel</button>
                            <button id="submit_btn" name="one_case" value="1" type="submit" class="btn btn-danger btn-block btn-save">Yes, I want to Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
