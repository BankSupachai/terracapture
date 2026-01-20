
<!-- Default Modals -->
<div id="modal_m_caselist" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border: 0px;">
            <div class="modal-header text-white p-2" style="background: #245788;">
                <div>
                    <span class=" ms-3" id="Modal-addEvent-calendar"></span>
                    (<span class="label_date"></span> <span> - <span class="modal_countcase"></span> Cases</span>)
                </div>
                <div>
                    <button type="button" class="btn btn-ghost-light text-end" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
            </div>
            <div class="modal-body py-2 px-4">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <td>HN</td>
                            <td>Name</td>
                            <td>Endoscopist</td>
                            <td>Operation</td>
                        </tr>
                    </thead>
                    <tbody >
                        <tr id="render_caselist"></tr>
                    </tbody>
                </table>
            </div>


        </div><!-- /.modal-content -->
    </div>
</div><!-- /.modal -->
