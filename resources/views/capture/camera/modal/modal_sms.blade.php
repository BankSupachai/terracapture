<div class="modal" tabindex="-1" id="modal_sms">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Send Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div id="live_qrcode"></div>
                    </div>
                    <div class="col-6">
                        <p>Telephone Number</p>
                        <input type="text" id="phonenumbersms" class="form form-control" placeholder=""
                            autocomplete="off"><br>
                        <button type="button" id="btn_confirm_sms" class="btn"
                            style="background-color: #245788; color: #fff;">Confirm Sending</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
            <script src="{{ url('assets/js/qrcode.min.js') }}"></script>
            <script>
                function generateQRCode(text) {
                    document.getElementById("live_qrcode").innerHTML = "";
                    new QRCode(document.getElementById("live_qrcode"), {
                        text: text,
                        width: 128,
                        height: 128,
                        colorDark: "#000000",
                        colorLight: "#ffffff",
                        correctLevel: QRCode.CorrectLevel.H
                    });
                }
                document.addEventListener("DOMContentLoaded", function() {
                    generateQRCode("http://medicaendo.com/c/{{ @$cid }}");
                });
            </script>
        </div>
    </div>
</div>
