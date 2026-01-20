<!-- Full Screen Modal -->
<div id="indexManualModal" class="modal fade" tabindex="-1" aria-labelledby="indexManualLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="indexManualLabel">INDEX Manual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <h2 class="text-center">INDEX Manual</h2>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('assets/extra/shortcuts/shortcut.js') }}"></script>
<script>
    let captureModal;
    let bladename = true;
    document.addEventListener('DOMContentLoaded', function() {
        captureModal = new bootstrap.Modal(document.getElementById('indexManualModal'));
    });

    shortcut.add("F1", function() {
        if (document.getElementById('indexManualModal').classList.contains('show')) {
            captureModal.hide();
        } else {
            captureModal.show();
        }
    });
    shortcut.add("F2", function() {
        if(bladename){
            bladename = false;
            $(".bladename").show();
        }else{
            bladename = true;
            $(".bladename").hide();
        }
    });
    shortcut.add("F3", function() {
        $("#btn_time_3").trigger("click")
    });
    shortcut.add("F4", function() {
        $("#btn_time_4").trigger("click")
    });

    shortcut.add("F7", function() {
        // alert("Capture manual");
        socket.emit('endonode', `{"event":"device_check"}`);
    });
</script>
