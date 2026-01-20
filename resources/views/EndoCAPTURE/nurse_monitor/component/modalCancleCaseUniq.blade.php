
<div class="modal fade" id="modal_cancel_caseuniq">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header p-0">
                <h2 class="text-center text-dark">Cancel Case</h2>
                <button type="button" class="btn btn-danger btn-sm btn-close p-1" data-bs-dismiss="modal"
                    aria-label="Close">
                </button>
            </div>
            <div class="modal-body pb-0">
                <form action="{{ url('casemonitor') }}" method="post">
                    @csrf
                    <input type="hidden" name="event" value="cancel_caseuniq">
                    <div class="row">
                        <div class="col-12">
                            <input id="caseuniq_cancel" type="hidden" name="monitor_id">
                        </div>
                        <div class="col-12" style="align-content: center">
                            <h1>Procedure : </h1>
                            <h1 id="procedure_text"></h1>
                        </div>
                        <div class="col-12 p-0 mt-4">
                            <button type="submit" class="btn btn-primary btn-block btn-save">ยืนยัน</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
