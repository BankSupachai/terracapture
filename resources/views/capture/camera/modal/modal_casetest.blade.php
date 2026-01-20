<div class="modal fade" id="modal_casetest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="box-shadow: none; border: none;background-color:red;">
            <div class="modal-body">
                <br><br><br><br>
                <h1 align="center">คำเตือน</h1>
                <br>
                <h1 style="text-align:center;color: white">ท่านกำลังอยู่ในหน้าทดลองถ่ายรูป
                    รูปที่ถ่ายจะไม่ถูกบันทึกอยู่ในระบบ</h1>
                <br><br><br>
                <div class="row">
                    <div class="col-6">
                        <button id="btn-refresh" class="btn btn-primary btn-block ">Refresh</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-success btn-block btn-back">HOME</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
    let sound_casetest = new Audio(`http://localhost/config/sound/capture/alert.mp3`);
    setTimeout(function() {
        $('#modal_casetest').modal('show');
        sound_casetest.play();
    }, 60000);

    $("#btn-refresh").click(function() {
        window.location.reload();
    });
</script>
