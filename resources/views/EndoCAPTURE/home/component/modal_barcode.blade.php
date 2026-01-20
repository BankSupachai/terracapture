<div class="modal fade bd-example-modal-lg" id="barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="align-self: center;">
                <h2 style="margin: 0;"> Scan Barcode</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="" id="barscan" class="form-control form-control-lg"
                    style="font-size: xxx-large;text-align: center;font-weight: 500;" autocomplete="off">
            </div>
            <div class="modal-footer" style="padding: 1em;">

                <table class='table table-hover  table-borderless'>
                    <thead>
                        <tr>
                            <th>HN</th>
                            <th>Name</th>
                            <th>Procedure</th>
                            <th>Select</th>
                        </tr>
                    </thead>
                    <tr>
                        <th colspan='8' class='label label-rounded label-success' style='width: auto;'>ToDay</th>
                    </tr>

                    <tbody class='border-top'>
                        <tr>
                            <th colspan='8' class='label label-rounded label-warning' style='width: auto;'>Other Day</th>
                        </tr>
                    </tbody>


                </table>

                <p id="showbarcode" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
