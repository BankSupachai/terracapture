<div id="modalQueue" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="h5" id="myModalLabel">Patient Monitor</span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="border-bottom mt-2"></div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-1" style="place-self: center;">
                        QR:
                    </div>
                    <div class="col-11">
                        <div class="row bg-gray-input   p-5">
                            <div class="col-6 align-self-center text-center ">
                                <h1 id="q_number_modal"></h1>
                            </div>
                            <div class="col-6" id="qrcode">
                                {{-- <img src="{{ url('public/image/qr black 1.png') }}" alt=""> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-1 mt-1" style="place-self: center;">
                        URL:
                    </div>
                    <div class="col-11  mt-2 p-0 m-0">
                        <div class="form-icon right">
                            <input type="text" class="form-control bg-gray-input form-control-icon " id="q_url_modal"
                            value="">
                                <i class="ri-file-copy-fill " onclick="Copytext()" style="cursor: pointer"></i>

                        </div>
                    </div>
                    <div class="col-1 mt-1" style="place-self: center;">
                        SMS:
                    </div>
                    <div class="col-11  mt-2 p-0 m-0">
                        <div class="form-icon right">
                            <input type="text" class="form-control bg-gray-input form-control-icon" id="phone_sms"
                            placeholder="Telephone Number">
                            <i class="ri-file-copy-fill"onclick="Copytext()" style="cursor: pointer" ></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row  mb-3">
                <div class="col-6 text-end">
                    <button type="button" class="btn btn-success w-lg refresh-page" > <i class=" ri-printer-line me-2"></i>Print QR Code</button>

                </div>
                <div class="col-6 ">
                    <button type="button" id="smsqueue" class="btn btn-danger w-lg refresh-page" > <i class="ri-send-plane-fill me-2"></i> Send message</button>

                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal" tabindex="-1" id="modal_smssuccess">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">SMS send success.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
                <button type="button" data-bs-dismiss="modal" class="btn btn-primary">OK</button>
            </div>
        </div>
    </div>
</div>

<script>


function Copytext(){
    var CopyText = document.getElementById("copy_text" )
    CopyText.select();
    navigator.clipboard.writeText(CopyText.value);

}

$(".refresh-page").click(function(){
    location.reload();
})


$("#smsqueue").click(function(){
    let url = $("#q_url_modal").val();
    let phone = $("#phone_sms").val();
    $.post("{{url("sms")}}",{
        event: "queue_sms",
        message : url,
        phone:phone
    },function(d,s){
        let json = JSON.parse(d);

        if (json.message=="Success") {
            $('#modalQueue').modal('hide');
            $("#modal_smssuccess").modal("show");
        }
    });
});




</script>


