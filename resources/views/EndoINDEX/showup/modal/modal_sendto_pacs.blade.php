<!-- Default Modals -->
<style>
    .ri-4x{
       font-size: 50px;
    }
    .modal-body .custom{
        margin-top: -0.8em;
        margin-left: -0.8em;
    }
    .btn-gray {
        background-color: gray;
        border-color: gray;
        color: white;
    }
</style>

<div id="modal_sendto_pacs" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #E9EBEC">
                <h5 class="modal-title" id="myModalLabel">Send to</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                @php
                $command = 'wmic logicaldisk get caption';
                exec($command, $output);
                if (($key = array_search('Caption', $output)) !== false) {
                    unset($output[$key]);

                }

            @endphp
                <div class="col-12 text-color-b">PACs Server ({{@$pacs->pacsserver}})</div>
                <div class="col-12 patient-data"></div>
                <div class="row mt-4">
                    <div class="col-3">
                        Select your file
                    </div>
                    <div class="col-3">
                        <div class="form-check mb-2">
                            <input class="form-check-input allphoto" type="checkbox" id="allphoto">
                            <label class="form-check-label" for="allphoto">
                                All Photo
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 ms-5">
                        <div class="form-check mb-2 text-center p-3" style="border: 2px solid #245788">
                            <input class="form-check-input custom ck_type" data-type="pdf" type="checkbox" id="{{md5("report")}}">
                            <label class="form-check-label text-primary" for="{{md5("report")}}">
                                <i class="ri-dossier-fill ri-4x"></i>
                            </label>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-check mb-2 text-center p-3" style="border: 2px solid #245788">
                            <input class="form-check-input custom ck_type" data-type="photo" type="checkbox" id="{{md5("photo")}}">
                            <label class="form-check-label text-primary" for="{{md5("photo")}}">
                                <i class="ri-image-2-fill ri-4x"></i>
                            </label>
                        </div>
                    </div>
                    {{-- <div class="col-4">
                        <div class="form-check mb-2 text-center p-3" style="border: 2px solid #245788">
                            <input class="form-check-input custom ck_type" data-type="video" type="checkbox" id="{{md5("video")}}" disabled>
                            <label class="form-check-label text-primary" for="{{md5("video")}}">
                                <i class="ri-video-fill ri-4x"></i>
                            </label>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="col-12 text-center mb-3">
                <button type="button" class="btn btn-primary w-75 confirm_sending" id="">Confirm Sending</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

document.addEventListener('DOMContentLoaded', function () {
            const button = document.querySelector('.confirm_sending');
            button.addEventListener('click', function () {
                if (!this.classList.contains('btn-gray')) {
                    this.classList.add('btn-gray');
                    this.classList.remove('btn-primary');
                    this.disabled = true;
                }
            });
        });


</script>
