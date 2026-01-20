<script src="http://localhost:3000/socket.io/socket.io.js"></script>
<script>
    var socket = io.connect('http://localhost:3000');

    async function function_confirm() {
        try {
            // ใช้ config ที่โหลดไว้แล้วตอนเข้าหน้าเว็บ
            const config = window.appConfig;
            socket.emit('endonode', (config && config.com_name) || '');
            $("#liveconsult_modal").modal("hide");
        } catch (error) {
            console.error('Error getting config:', error);
            socket.emit('endonode', '');
            $("#liveconsult_modal").modal("hide");
        }
    }

    socket.on('endonode', function(msg) {
        if (msg == "liveconsult") {
            audio_casetest.play();
            $('#liveconsult_modal').modal('show');
        }
    });
</script>
<script>
    // socket.emit('endonode', 'open_other');


    socket.on('endonode', function(msg) {
        if (msg != '' && msg != undefined) {
            if (msg == 1 || msg == '1') {
                var source_num = $('#camera_2').val()
                if (source_num == 1 || source_num == '1' || source_num == undefined) {
                    $("#btn-capture").trigger("click");
                } else if (source_num == 2 || source_num == '2') {
                    $("#btn-capture").trigger("click");
                    $("#btn-capture2").trigger("click");
                }
            }

            if (msg == 2 || msg == '2') {
                socket.emit('endonode', `{"event":"burst_mode"}`);
                // {"event":"burst_mode","cid":"690dd06615a8fe9a6706dd86","hn":"TEST20251107","department":"GI","scope":"0","obs_source":"capture1"}
                // if(timer1Seconds > 0){
                //     $("#vdo_stop").trigger("click");
                // }else{
                //     $("#vdo_start").trigger("click");
                // }
            }
        }
    })

    socket.on('endonode', function(msg) {
        try {
            let obj = JSON.parse(msg);
            if (obj.event == 'check_open_other') {
                socket.emit('endonode', `{"event":"reponse_open_other","time":"${timefix}"}`);
            }

            if (obj.event == 'obs_connected') {
                $("#modal_socket5restart").modal("hide");
            }


            if (obj.event == 'device_lost') {
                alert('Device lost');
            }
        } catch (error) {

        }

    });
</script>


<script>
    function liveconsult(msg) {
        var path = msg
        var img_url = `${path}`
        var server = url.replace('endoindex', '');
        var img_path = img_url.replace(server, '');
        img_path = img_path.replace('ScreenRecord/', '');

        const cid = document.body.dataset.cid || '';
        $.post('{{ url('api/sendto') }}', {
            event: 'camera_sendto',
            cid: cid,
            imgname: img_path
        }, function(data, status) {
            if (typeof socketserver !== 'undefined') {
                socketserver.emit('endonode', `{'case_id':'${cid}', 'img_name':'${img_path}'}`);
            }
            socket.emit('endonode', `{'case_id':'${cid}','img_name':'${img_path}'}`);
        });

    }



    socket.on('filename', function(msg) {
        const cid = document.body.dataset.cid || '';
        const caseuniq = document.body.dataset.caseuniq || '';

        // ใช้ config ที่โหลดไว้แล้วตอนเข้าหน้าเว็บ
        try {
            const config = window.appConfig;
            var is_photocaseuniq = config && config.feature && config.feature.photocaseuniq;
            var check_img = is_photocaseuniq ? msg.includes(caseuniq) : msg.includes(cid);

            if (check_img && msg.includes('.jpg')) {
                if (typeof sound_capture !== 'undefined') {
                    sound_capture.play();
                }
                console.log(msg);
                imageSHOW(msg);

                if (config && config.feature && config.feature.liveconsult) {
                    liveconsult(msg);
                }
            }
        } catch (error) {
            console.error('Error getting config for filename:', error);
            // Fallback: check with cid only
            if (msg.includes(cid) && msg.includes('.jpg')) {
                if (typeof sound_capture !== 'undefined') {
                    sound_capture.play();
                }
                console.log(msg);
                imageSHOW(msg);
            }
        }
    })
</script>
