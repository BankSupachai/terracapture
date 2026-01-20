<script>
    let signal_lost_sound = true;
    var audio_signal_lost = new Audio("http://localhost/config/sound/capture/signal_lost.m4a");
    socket.on('endonode', function(msg) {
        let obj = JSON.parse(msg);
        if (obj.event == 'signal_lost') {
            signal_lost();
        }

        if (obj.event == 'signal_normal') {
            $('#modal_signal_lost').modal('hide');
        }
    });
    $(".ac_reload_btn").click(function() {
        $('#modal_signal_lost').modal('hide');
    })

    function signal_lost() {
        $('#modal_signal_lost').modal('show');
        if (signal_lost_sound) {
            audio_signal_lost.play();
        }
    }
</script>

@if (@$configscope->readocr)
    <script>
        setInterval(() => {
            socket.emit('endonode', `{"event":"serial_ocr"}`);
        }, 15000);
        socket.on('endonode', function(msg) {
            let obj = JSON.parse(msg);
            if (obj.event == 'ocr_result') {
                if (obj.status == 'success') {
                    let scope_options = $("#scope_source option");
                    let serialno = $("#scope_source").val();
                    scope_options.each(function() {
                        if ($(this).data('serialno') == obj.serial && $(this).data('id') != serialno) {
                            $("#scope_source").select2().val($(this).val()).trigger('change');
                        }
                    });
                }
            }
        });
    </script>
@endif
