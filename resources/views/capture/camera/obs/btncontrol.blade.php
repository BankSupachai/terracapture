{{ bladelink('capture.camera.obs.btncontrol') }}
<div class="col-12">
    <button id="btn_makereport"
        class="btn btn-success btn-label waves-effect waves-light btn_makereport w-lg h-button fs-12">
        <i class="mdi mdi-clipboard-text-outline label-icon align-middle fs-14"></i>
        <span class="label-text ms-4">
            MAKE REPORT
        </span>
    </button>
</div>
<div class="col-12">
    <button id="btn_casenew" class="btn mt-1 btn-label waves-effect waves-light w-lg h-button fs-12 btn-case-list">
        <i class="ri-list-unordered label-icon align-middle fs-14 me-2"></i> CASE LIST</button>
</div>
<div class="col-12">
    <button type="button" id="btn_back"
        class="btn mt-1 btn-danger btn-label waves-effect waves-light w-lg h-button fs-12">
        <i class="ri-arrow-go-back-line label-icon align-middle fs-14 me-2"></i> BACK</button>
</div>

<form id="finish_record" action="{{ url('capture') }}" method="post" style="display: none;">
    @csrf
    <input name="event" value="finish_record" type="hidden">
    <input name="hn" id="finish_record_hn" type="hidden">
    <input name="cid" id="finish_record_cid" type="hidden">
    <input name="caseuniq" id="finish_record_caseuniq" type="hidden">
    <button type="submit" id="finish_record_submit" name="submit">save</button>
</form>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#btn_back').on('click', function() {
            vdo_check_stop();
            if ($("#time_end").val() == "") set_time('time_end');
            const cid = document.body.dataset.cid || '';
            const hn = document.body.dataset.hn || '';
            const caseuniq = document.body.dataset.caseuniq || '';

            CameraAPI.back2home(cid, hn, caseuniq).catch(function(error) {
                console.error('Error back2home:', error);
            });
            setTimeout(() => window.location.href = "{{ url('') }}", 1000);
        });

        $('#btn_casenew').on('click', function() {
            $("#modal_new_case").modal('show');
        });

        $('.btn_makereport').click(function() {
            vdo_check_stop();
            $(this).prop("disabled", true);
            $('#btn_time_4').click();
            make_report = true;

            // Set form values from data attributes
            const cid = document.body.dataset.cid || '';
            const hn = document.body.dataset.hn || '';
            const caseuniq = document.body.dataset.caseuniq || '';

            $('#finish_record_cid').val(cid);
            $('#finish_record_hn').val(hn);
            $('#finish_record_caseuniq').val(caseuniq);

            setTimeout(() => {
                $('#modal_progress_camera').modal('show');
                $('.btn_makereport').prop("disabled", true);
                $('#finish_record_submit').click();
            }, 800);
        });
    });
</script>
