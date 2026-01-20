<!-- Default Modals -->
<div id="modal_prevideo" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Preview video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <video class="preview-video" width="100%" height="100%" controls autoplay>
                    <source src="{{url("public/video/Semivideo.mp4")}}" type="video/mp4">
                  </video>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary ">Save Changes</button> --}}
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
