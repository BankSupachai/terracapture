<div id="modal_Userdownload" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Import List</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{url('screening')}}"  method="POST" enctype="multipart/form-data" class="w-100">
                    @method('POST')
                    @csrf
                    <input type="hidden" name="event" value="create_booking">
                    {{-- <div class='file-input w-100'>
                        <input type='file' name="fileicd10">
                        <span class='button'>ICD-10 Excel</span>
                        <span class='label' data-js-label>No file selected</label>
                    </div> --}}
                    <div class="dropzone">
                        <div class="fallback">
                            <input type="file" name="fileuser" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                            </div>

                            <h4>Drop files here or click to upload.</h4>
                        </div>
                    </div>
                    {{-- <button class="btn btn-primary rounded-0" name="icd10" value="1"  type="submit">Start Import</button> --}}

            </div>
            <div class="modal-footer">
                <div class="col-12 d-flex justify-content-between">
                    {{-- <button type="button" class="btn btn-warning " data-bs-dismiss="modal">Download template </button> --}}
                    <a href="{{url("public/user/user.xlsx")}}" class="btn btn-warning">Download template</a>
                    <button name="user" type="submit" value="1" class="btn btn-primary">Confirm </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
