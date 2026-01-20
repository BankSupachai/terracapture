<div id="multi_confirm_show_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom p-2">
                <h5 class="modal-title" id="myModalLabel">Confirm case show display</h5>
                <input type="hidden" id="muti_show_caseid">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body border-bottom p-">
                <p>Please select the case you want to hide on the monitor</p>
                <p>HN: <span id="show_hn"></span>, Patient Name: <span id="show_name"></span> </p>
                <div class="row">
                    <div>
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Physician</th>
                                    <th scope="col">Procedure</th>
                                </tr>
                            </thead>
                            <tbody id="show_detail_tbody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer p-2">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-orange w-75" id="multi_confirm_show_btn" data-bs-dismiss="modal">Confirm</button>
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

