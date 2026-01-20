
    <span class="text-muted">Select your file &ensp;</span>
    <input class="form-check-input text-center " type="checkbox" id="chk_allphoto">
    <label class="form-check-label " for="chk_allphoto">
       &ensp; All Photo
    </label>
    <div class="row">
        <div class="col-4 mt-2 text-center p-2">
            <div class="form-check mb-2  " style="border: 1px solid #D9D9D9;">
                <input class="form-check-input text-center" name="pacs_type" value="photo" id="photo_report" type="checkbox" checked>
                <label class="form-check-label" for="photo_report">
                    <i class="ri-image-2-fill ms-4 ri-4x text-color-index "></i><br>
                </label>
            </div>
        <span class="text-muted">Photo</span>
        </div>
        <div class="col-4 mt-2 text-center p-2">
                <div class="form-check mb-2  " style="border: 1px solid #D9D9D9;">
                    <input class="form-check-input text-center" name="pacs_type" value="pdf" type="checkbox" id="report_sendto" checked>
                    <label class="form-check-label" for="report_sendto">
                        <i class="ri-todo-fill ms-4 ri-4x text-color-index "></i><br>
                    </label>
                </div>
            <span class="text-muted">Report</span>
        </div>


        {{-- <div class="col-4 mt-2 text-center p-2">
            <div class="form-check mb-2  " style="border: 1px solid #D9D9D9;">
                <input class="form-check-input text-center" name="pacs_type" value="nursereport" type="checkbox" id="nurse_report">
                <label class="form-check-label" for="nursereport">
                    <i class="ri-dossier-fill ms-4 ri-4x text-color-index "></i><br>
                </label>
            </div>
            <span class="text-muted">Nurse Report</span>
        </div> --}}


        @if($sendto_vdo)
            <div class="col-4 mt-2 text-center p-2">
                <div class="form-check mb-2  " style="border: 1px solid #D9D9D9;">
                    <input class="form-check-input text-center" name="video_type" value="video" type="checkbox" id="video_sendto" >
                    <label class="form-check-label" for="video_sendto">
                        <i class="ri-dossier-fill ms-4 ri-4x text-color-index "></i><br>
                    </label>
                </div>
                <span class="text-muted">Video</span>
            </div>
        @endif







    </div>
    <div class="col-12 text-center mt-1">
        <button id="confirm_sendto" type="button" class="btn btn-load btn-primary w-75 mb-4 dicom">Confirm Sending</button>
        <button id="show-finish" type="button" class="btn btn-success w-75 mb-4 " style="display: none;" >Return</button>
    </div>

    <script>
        $(document).ready(function(){
            $(".btn-loading").click(function(){
                if ($(this).closest('form')[0].checkValidity()) {
                    $(this).addClass('disabled');
                    $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &ensp; Loading...');
                    setTimeout(() => {
                        $(this).removeClass('disabled');
                    }, 3000);
                }
            });
            $(".btn-load").click(function(){
                var button = $(this);

                button.addClass('disabled');
                button.removeClass('btn-success').addClass('btn-primary');
                button.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &ensp; Loading...');

                setTimeout(() => {
                    button.removeClass('disabled');
                    button.removeClass('btn-primary').addClass('btn-success');
                    button.html('Resend');
                    // $('.modal').modal('hide');
                }, 3000);
            });
            $(".btn-loadicon").click(function(){
                $(this).addClass('disabled');
                $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
                setTimeout(() => {
                    $(this).removeClass('disabled');
                }, 3000);
            });
        });
    </script>
