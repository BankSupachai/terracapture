{{ bladelink('capture/camera/obs/captureandvdocontrol') }}
<div class="row ms-1 box-detail p-custom-2">
    <div class="col-12 mb-2">
        <select id="scope_source" class="selectpicker w-100" data-live-search="true" placeholder="Select Scope">
            <option value="">Select Scope</option>
            <!-- Options will be loaded via API -->
        </select>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center" style="height: 75px;">
                <div class="d-flex gap-2 mt-2">
                    <button type="button"
                        class="btn btn-icon btn-white-camera btn-capture waves-effect waves-light d-flex align-items-center justify-content-center"
                        id="btn-capture" style="width: 50px; height: 50px; padding: 0;">
                        <i class="ri-camera-fill ri-xl"></i>
                    </button>
                    <button type="button"
                        class="btn btn-icon btn-record waves-effect waves-light d-flex align-items-center justify-content-center"
                        id="vdo_start" style="width: 50px; height: 50px; padding: 0;">
                        <i class="ri-record-circle-line ri-xl"></i>
                    </button>
                </div>
                <div class="text-end">
                    <div class="text-danger" id="timer1">00:00:00</div>
                    <div>
                        <span>Size &nbsp;</span>
                        <span class="text-white text-nowrap size-text" id="size1">0</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<style>
    .btn-icon {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .btn-icon i {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<script>

    // Load scopes on page load
    async function loadScopes() {
        try {
            const scopes = await CameraAPI.getScopes();
            const select = document.getElementById('scope_source');
            const cid = document.body.dataset.cid || '';
            let selectedScopeId = null;

            // Get selected scope from case data if available
            // ใช้ case data ที่โหลดไว้แล้วตอนเข้าหน้าเว็บ
            if (cid) {
                try {
                    // รอให้ case data โหลดเสร็จก่อน
                    while (window.appCaseData === null) {
                        await new Promise(resolve => setTimeout(resolve, 50));
                    }
                    const caseData = window.appCaseData;
                    console.log(caseData.scope);
                    selectedScopeId = caseData.scope[caseData.scope.length - 1];
                    // Assume this_scope is stored somewhere or get from another source
                    // For now, we'll just populate the list
                } catch (e) {
                    console.error('Error getting case data for scope selection:', e);
                }
            }

            console.log(selectedScopeId);

            // Clear existing options except the first one
            const firstOption = select.querySelector('option[value="0"]');
            select.innerHTML = '';
            if (firstOption) {
                select.appendChild(firstOption);
            }

            // Add scope options
            scopes.forEach(function(scope) {
                const option = document.createElement('option');
                option.value = scope.scope_id;
                option.textContent = `${scope.scope_name} (${scope.scope_serial})`;
                option.setAttribute('data-id', scope.scope_id);
                if (scope.scope_id == selectedScopeId) {
                    option.selected = true;
                    console.log(scope.scope_id,selectedScopeId,"sssssssss",option);
                }
                select.appendChild(option);
            });
            $('#scope_source').selectpicker('render');
            $('#scope_source').val(selectedScopeId).selectpicker('refresh');

        } catch (error) {
            console.error('Error loading scopes:', error);
        }
    }


    $("#scope_source").change(function() {
        var scope_id = $(this).val();
        if (scope_id != "" && scope_id != null) {
            $.post('{{ url('api/capture') }}', {
                event: "update_scope",
                scope: scope_id,
                cid: document.body.dataset.cid || '',
            }, function(data) {
                $("#change_camera").val(data);
            });
        }
    });

    // Load scopes when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadScopes);
    } else {
        loadScopes();
    }
</script>

<script>
    let timer1Interval;
    let timer1Seconds = 0;
    let timerloopVDO = 0;
    let temp_vdo_size = 0;
    let temp_countsize = 0;
    let size1temp = "";
    let size2temp = "";
    let counttempsize = 0;

    function startTimer1() {
        timer1Interval = setInterval(() => {
            timer1Seconds++;
            const hours = String(Math.floor(timer1Seconds / 3600)).padStart(2, '0');
            const minutes = String(Math.floor((timer1Seconds % 3600) / 60)).padStart(2, '0');
            const seconds = String(timer1Seconds % 60).padStart(2, '0');
            document.getElementById('timer1').innerText = `${hours}:${minutes}:${seconds}`;
            temp_countsize++;
            if (temp_countsize == 10) {
                temp_countsize = 0;
                socket.emit('endonode', `{"event":"getsize"}`);
                timeplaybutsizefix(2);
            }
        }, 1000);
    }

    function vdo_check_stop() {
        if ($("#timer1").html() != '00:00:00') {
            $("#modal_waitingvideosave").modal('show');
            $("#vdo_start").removeClass('active');
            $("#size1").html("");
            size1temp = "";
            resetTimer1()
            localStorage.removeItem('vdostart');
            socket.emit('endonode', `{"event":"vdo_stop"}`);
        }
    }

    function timeplaybutsizefix(numloop) {
        if (size1temp == size2temp) {
            counttempsize++;
            if (counttempsize == numloop) {
                signal_lost();
                counttempsize = 0;
            }
        } else {
            counttempsize = 0;
        }
        size2temp = size1temp;
    }

    function resetTimer1() {
        clearInterval(timer1Interval);
        timer1Seconds = 0;
        document.getElementById('timer1').innerText = '00:00:00';
    }

    $('.btn-capture').click(function() {
        scope_force_select();
        const cid = document.body.dataset.cid || '';
        // ใช้ case data ที่โหลดไว้แล้วตอนเข้าหน้าเว็บ
        const caseData = window.appCaseData;
        if (caseData) {
            socket.emit('endonode', JSON.stringify({
                event: "capture",
                cid: cid,
                hn: caseData.case_hn || '',
                department: caseData.department || '',
                scope: scopecheck("source1"),
                obs_source: "capture1"
            }));
        } else {
            // Fallback to basic data
            socket.emit('endonode', JSON.stringify({
                event: "capture",
                cid: cid,
                hn: '',
                department: '',
                scope: scopecheck("source1"),
                obs_source: "capture1"
            }));
        }
    });


    $("#vdo_start").click(function() {
        if ($("#timer1").html() != '00:00:00') {
            vdo_check_stop();
        } else {
            $(this).addClass('active');
            const cid = document.body.dataset.cid || '';
            // ใช้ case data ที่โหลดไว้แล้วตอนเข้าหน้าเว็บ
            const caseData = window.appCaseData;
            socket.emit('endonode', JSON.stringify({
                event: "vdo_start",
                cid: cid,
                hn: (caseData && caseData.case_hn) || ''
            }));
            startTimer1();
            localStorage.setItem('vdostart', true);
        }
    });


    $('#btn_vdo_pause').click(function() {
        $('#btn_vdo_pause').hide()
        $('#btn_vdo_resume').show()
        socket.emit('endonode', `{"event":"vdo_pause"}`)
    });

    $('#btn_vdo_resume').click(function() {
        $('#btn_vdo_pause').show()
        $('#btn_vdo_resume').hide()
        socket.emit('endonode', `{"event":"vdo_resume"}`)
    });

    socket.on('endonode', function(msg) {
        let obj = JSON.parse(msg);
        if (obj.event == 'vdo_size') {
            // alert("test");
            // alert(obj.size);
            size1temp = obj.size;
            $("#size1").html(obj.unit);
        }
    });

    async function imageSHOW(msg) {
        let domain = 'http://localhost/ScreenRecord/';
        var img_exist = get_img_num();
        var img_url = domain + msg;
        var new_num = img_exist + 1;
        testImage(img_url);

        // Check if firstimg_starttime is enabled
        // ใช้ config ที่โหลดไว้แล้วตอนเข้าหน้าเว็บ
        try {
            const config = window.appConfig;
            if (config && config.camera && config.camera.firstimg_starttime && new_num == 1) {
                $('#btn_time_start').trigger('click');
            }
        } catch (error) {
            console.error('Error checking firstimg_starttime:', error);
        }

        $(".box-capture").prepend(
            `<div class="box-capture-list" data-checknum="0" id="imgbox${new_num}">
                <img src="${img_url}" class="w-100">
                <span class="number-cap">${new_num}</span>
            </div>`
        );
        $('#img_num').text(new_num);
    }

    function testImage(URL) {
        var tester = new Image();
        tester.onload = function() {};
        tester.onerror = function() {
            audio_signal_lost.play();
        };
        tester.style.visibility = 'hidden';
        tester.id = 'testimg';
        tester.src = URL;
    }
</script>
