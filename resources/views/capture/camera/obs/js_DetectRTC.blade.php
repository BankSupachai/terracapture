<script src="{{ url('public/camera/DetectRTC.js') }}"></script>
<script src="{{ url('public/camera/EBML.js') }}"></script>
<script>
    let camera_first = "";
    let deviceId = 0;
    let countobs = 0;
    let tempobs1 = 0;
    let tempobs2 = 0;
    let device_label = "";
    let windowsobs = false;
    let video1 = document.getElementById('video1');
    let heightvdo1 = $('#video1').height();
    let camera_source = 1;
    $('#camera_source').empty();

    DetectRTC.load(function() {
        DetectRTC.videoInputDevices.forEach(function(device, idx) {
            console.log(device);
            device_label = device.label;
            if (device_label.includes("OBS")) {
                device_label = "Capture Camera";
                deviceId = device.deviceId;
            }
            $('#camera_source').append('<option value="' + device.deviceId + '">' + device_label +
                '</option>');
        });
        setTimeout(function() {
            $('#camera_source').val(deviceId);
        }, 1000);
    });

    $('#camera_source').change(function() {
        get_device_id();
    });

    setTimeout(function() {
        get_device_id();
    }, 2000);

    function get_device_id() {
        temp_deviceId = $('#camera_source').val();
        // เปลี่ยนสัญญาณภาพที่แสดงที่ #video1
        navigator.mediaDevices.getUserMedia({
            video: {
                deviceId: {
                    exact: temp_deviceId
                },
                width: 1920,
                height: 1080
            },
            audio: false
        }).then(function(stream) {
            video1 = document.querySelector('#video1');
            // ปิด stream เดิมถ้ามี
            if (video1.srcObject) {
                video1.srcObject.getTracks().forEach(function(track) {
                    track.stop();
                });
            }
            video1.srcObject = stream;
            video1.onloadedmetadata = function(e) {
                video1.play();
            };
        }).catch(function(err) {
            console.log("เกิดข้อผิดพลาด: " + err.name);
        });
    }

    function clearMediaDevice(stream) {
        if (stream) {
            stream.getTracks().forEach(track => {
                track.stop(); // เรียกใช้เมธอด stop() บนแทร็กเพื่อหยุดการใช้งานและปล่อยทรัพยากร [17]
                console.log(`Track '${track.kind}' with ID '${track.id}' stopped.`);
            });
            console.log("All media tracks in the stream have been stopped.");
        } else {
            console.log("No media stream provided to clear.");
        }
    }
</script>
