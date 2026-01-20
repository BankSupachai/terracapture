<div class="modal" tabindex="-1" id="modal_signal_lost">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #212121; color: #fff; border-radius: 15px; height: 600px;">
            <div class="modal-header border-0">

                <div class="d-flex align-items-center justify-content-end w-100 mt-1">
                <button type="button" class="btn btn-link p-0 fs-18 me-2" id="toggleSound" style="color: #F06548;">
                    <i class="ri-volume-up-fill" id="soundIcon"></i>
                </button>
            </div>

                <div class="d-flex align-items-center justify-content-end ">
                    <button type="button" class="btn-close btn-close-white me-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


            </div>
            <div class="modal-body text-center p-4">
                <img src="{{ url('public/image/lost.png') }}" alt="Signal Lost Icon" style="width: 250px; margin-bottom: 20px;">
                <h4 style="color: #EA4335; margin-bottom: 15px;" class="mt-5">สัญญาณภาพขัดข้อง !</h4>
                <p style="color: #E57373; margin-bottom: 25px; font-size: 16px;">กรุณาตรวจสอบการเชื่อมต่อสัญญาณ</p>
                <button type="button" id="reload_btn" class="btn btn-danger ac_reload_btn w-100 fs-18 mt-4" style="background-color: #EA4335; border: none; padding: 10px; border-radius: 50px;" data-bs-dismiss="modal">
                    กดปุ่มนี้เพื่อรีโหลดกล้อง
                </button>
                <button type="button" class="btn btn-success btn_makereport w-100 fs-18 mt-4" style=" border: none; padding: 10px; border-radius: 50px;" data-bs-dismiss="modal">
                    Make Report
                </button>
            </div>

        </div>
    </div>
</div>

<script>
    let isMuted = false;
    document.getElementById('toggleSound').addEventListener('click', function() {
        signal_lost_sound = isMuted;
        isMuted = !isMuted;
        const icon = document.getElementById('soundIcon');
        icon.className = isMuted ? 'ri-volume-mute-fill' : 'ri-volume-up-fill';
    });
</script>
