<div id="modal_nursenote" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title h5" id="myModalLabel">Send to</span>
                <button type="button" id="sendto_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="border-bottom"></div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <span class="text-muted">Select your destination</span>
                    </div>
                    <div class="col-4 text-end " onclick="refresh_drive()">
                        <a href="javascript:;" class="p-1 fs-14 align-middle ">
                            <span class="text-spin-primary">Refresh</span>
                            <i id="refresh_drive" class="ri-refresh-line align-middle"></i></a>
                    </div>
                </div>
                <div class="row py-3">

                </div>
                <div class="">
                    <a id="btn_nursenote_send" class="btn btn-success btn-label waves-effect waves-light w-lg"
                        type="button">
                        <i class="bx bx-server label-icon align-middle fs-16 me-2"></i>
                        Send to nursenote
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#btn_nursenote_send").click(function() {
        $.post("{{ url('note/paper') }}", {
            event: "savepaper",
            _token: "{{ csrf_token() }}",
            id: "{{ $cid }}",
            type: "nursenote"
        }, function(res) {
            console.log(res);
        });
    });
</script>
