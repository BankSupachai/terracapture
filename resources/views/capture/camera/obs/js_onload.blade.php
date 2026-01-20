<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    //ซ่อน Scroll bar ด้านข้าง
    document.addEventListener("wheel", function(event) {
        if (document.activeElement.type === "number" &&
            document.activeElement.classList.contains("noscroll")) {
            document.activeElement.blur();
        }
    });
</script>


<script>
    let cid = document.body.dataset.cid || '';
    var start_time
    var elasped_time = 0
    var interval_id
    var size_interval_id
    var curr_timer_id
    var is_video1 = false
    var is_video2 = false
    // socket is already declared in js_socket.blade.php
    var old_vdosize = 0
    var new_vdosize = 0
    var time_alert = 0
    var vdo_file_interval = ''
    var all_serial = [];
    // var img_storage = localStorage.getItem('imgname')

    // Global config variable - เรียก getConfig() ครั้งเดียวตอนโหลดหน้าเว็บ
    window.appConfig = null;
    // Global case data variable - เรียก getCase() ครั้งเดียวตอนโหลดหน้าเว็บ
    window.appCaseData = null;

    // Load config and case data once on page load
    (async function() {
        try {
            const cid = document.body.dataset.cid || '';
            // โหลด config และ case data พร้อมกัน
            const [config, caseData] = await Promise.all([
                CameraAPI.getConfig(),
                cid ? CameraAPI.getCase(cid) : Promise.resolve(null)
            ]);
            window.appConfig = config; // เก็บ config ไว้ในตัวแปร global
            window.appCaseData = caseData; // เก็บ case data ไว้ในตัวแปร global
            all_serial = config.scope_serial || [];

            // เรียก loadCaseData() หลังจากโหลด case data เสร็จแล้ว
            // ใช้ setTimeout เพื่อให้แน่ใจว่า div_left.blade.php ถูกโหลดและประกาศฟังก์ชันแล้ว
            setTimeout(function() {
                if (typeof loadCaseData === 'function') {
                    loadCaseData();
                } else {
                    // ถ้ายังไม่มีฟังก์ชัน ให้รออีกสักครู่
                    setTimeout(function() {
                        if (typeof loadCaseData === 'function') {
                            loadCaseData();
                        }
                    }, 200);
                }
            }, 100);
        } catch (error) {
            console.error('Error loading config/case data:', error);
            // ถ้าโหลดไม่สำเร็จ ให้ลองเรียก loadCaseData() อยู่ดี (จะใช้ fallback)
            setTimeout(function() {
                if (typeof loadCaseData === 'function') {
                    loadCaseData();
                }
            }, 100);
        }
    })();
</script>

<script>
    // Initialize audio and socket data
    (async function() {
        try {
            // รอให้ config โหลดเสร็จก่อน
            while (window.appConfig === null) {
                await new Promise(resolve => setTimeout(resolve, 50));
            }
            const config = window.appConfig;
            const url = window.location.origin;
            const baseUrl = url.replace(/\/endoindex.*$/, '');
            console.log(baseUrl);
            var audio_casetest = new Audio(`http://localhost/config/sound/capture/alert.mp3`);
            // ใช้ sound_capture.play() เพื่อเล่นเสียงชัตเตอร์
            var sound_capture = new Audio(`http://localhost/config/sound/capture/shutter.wav`);
            var audio_incorrect = new Audio(`http://localhost/config/sound/capture/incorrect.mp3`);

            // Make these available globally
            window.audio_casetest = audio_casetest;
            window.sound_capture = sound_capture;
            window.audio_incorrect = audio_incorrect;

            const cid = document.body.dataset.cid || '';
            const type = document.body.dataset.type || '';

            if (type == 'test') {
                setTimeout(function() {
                    audio_casetest.play();
                    setInterval(function() {
                        audio_casetest.play();
                    }, 13000);
                    $('#modal_casetest').modal('show');
                }, 60000);
            }

            // Get case data for socket messages
            // socket is already declared in js_socket.blade.php, so we can use it directly
            if (cid && typeof socket !== 'undefined' && socket) {
                try {
                    // รอให้ case data โหลดเสร็จก่อน
                    while (window.appCaseData === null) {
                        await new Promise(resolve => setTimeout(resolve, 50));
                    }
                    const caseData = window.appCaseData; // ใช้ case data ที่โหลดไว้แล้ว
                    const hn = document.body.dataset.hn || '';
                    const operation_date = (caseData.appointment || '').split(' ')[0].replace(' ', '_');

                    socket.emit('endonode',
                        `{"case":"true","cid":"${cid}","hn":"${hn}","procedure":"${caseData.procedurename || ''}","operationdate":"${operation_date}","caseuniq":"${caseData.caseuniq || ''}"}`
                    );
                } catch (error) {
                    console.error('Error getting case data for socket:', error);
                }
            }

            // Set global url and server variables
            window.url = url;
            const server = url.replace('endoindex', '');
            window.server = server;
        } catch (error) {
            console.error('Error initializing audio/socket data:', error);
        }
    })();
</script>


<script>
    $(window).focus(function() {
        console.log('welcome (back)');
    });

    $(window).blur(function() {
        console.log('bye bye');
    });
</script>

<script language="JavaScript" type="text/javascript">
    window.onbeforeunload = confirmExit;
    function confirmExit() {
        if (check_null('time_end')) {
            let img_num = $("#img_num").html();
            if (img_num > 0) {
                $('#btn_time_4').click()
            }
        }
    }
</script>

<script>
    setTimeout(() => {
        if (check_null('time_start')) {
            $('#btn_time_start').click()
        }
    }, 1 * 10000);

    setTimeout(() => {
        if (check_null('time_patientin')) {
            $('#btn_time_patientin').click()
        }
    }, 1 * 10000);
</script>
