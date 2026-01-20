{{ bladelink('capture/camera/obs/div_left') }}
<div class="row">
    <div class="col-12 p-0 m-0">
        <div id="multi_signal_div" class="bar-header" style="display: none">
            <div class="bar_test bg-danger text-center h3 p-2">กรุณากดปุ่ม Reload Source 1</div>
        </div>
    </div>
    <div class="col-12 p-0 m-0">
        <div class="box-procedure py-2 px-3 d-flex justify-content-between border-r" style="">
            <span class="h3 text-white" id="procedure_name">TEST SCOPE</span>

        </div>
    </div>
    <div class="col-12 m-0">
        <div class="col-12">
            <span class="text-white h5">Images (<span id="img_num">0</span>)</span>
        </div>
        <div class="box-capture mt-2" id="box_showcapture">
            <!-- Images will be loaded via API -->
        </div>
    </div>
</div>


<script>
    async function loadCaseData() {
        const cid = document.body.dataset.cid || '';
        if (!cid) {
            console.error('CID not found');
            return;
        }else{

        }

        try {
            // ใช้ case data ที่โหลดไว้แล้วตอนเข้าหน้าเว็บ
            // รอให้ case data โหลดเสร็จก่อน (มี timeout เพื่อป้องกัน infinite loop)
            let waitCount = 0;
            const maxWait = 100; // รอสูงสุด 5 วินาที (100 * 50ms)
            while (window.appCaseData === null && waitCount < maxWait) {
                await new Promise(resolve => setTimeout(resolve, 50));
                waitCount++;
            }

            // ถ้ายังไม่มี case data ให้เรียก getCase() ใหม่
            let caseData = window.appCaseData;
            if (!caseData && cid) {
                try {
                    caseData = await CameraAPI.getCase(cid);
                    window.appCaseData = caseData; // เก็บไว้เพื่อใช้ครั้งต่อไป
                } catch (e) {
                    console.error('Error getting case data:', e);
                    caseData = null;
                }
            }

            // Load patient data and images in parallel
            const [patientData, images] = await Promise.all([
                CameraAPI.getPatient(cid),
                CameraAPI.getImages(cid)
            ]);

            // Update procedure name and HN
            if (caseData) {
                document.getElementById('procedure_name').textContent = caseData.procedurename || 'TEST CAMERA';
                document.getElementById('patient_hn').textContent = patientData.hn || '';

                // กำหนดสีให้กับ box-procedure ตาม procedure_color
                const boxProcedure = document.querySelector('.box-procedure');
                console.log("procedure_color", caseData.procedure_color);
                if (boxProcedure && caseData.procedure_color) {
                    boxProcedure.style.backgroundColor = caseData.procedure_color;
                }
            } else {
                document.getElementById('procedure_name').textContent = 'TEST CAMERA';
                document.getElementById('patient_hn').textContent = patientData.hn || '';
            }

            // Update patient name
            const patientName = [
                patientData.firstname || '',
                patientData.middlename || '',
                patientData.lastname || ''
            ].filter(Boolean).join(' ');
            document.getElementById('patient_name').textContent = patientName || '-';

            // Update gender and age
            document.getElementById('patient_gender_age').textContent =
                `${patientData.gender || '-'} / ${patientData.age || '-'}`;

            console.log("caseData", caseData);
            // Update doctor name
            if (caseData) {
                document.getElementById('text_doctorname').textContent = caseData.doctorname || '';
                // Update room
                document.getElementById('room_text').textContent = caseData.room_name || '';

                console.log("caseData", caseData);

                // Update time fields
                updateTimeFields(caseData);
                // Check procedure code for withdrawal time
                checkProcedureCode(caseData);
            } else {
                document.getElementById('text_doctorname').textContent = '';
                document.getElementById('room_text').textContent = '';
            }

            // Update images
            updateImagesList(images);

        } catch (error) {
            console.error('Error loading case data:', error);
            // Show error messages
            document.getElementById('procedure_name').textContent = 'Error loading data';
            document.getElementById('patient_hn').textContent = 'Error';
            document.getElementById('patient_name').textContent = 'Error';
            document.getElementById('patient_gender_age').textContent = 'Error';
        }
    }

    function updateImagesList(images) {
        const imgContainer = document.getElementById('box_showcapture');
        const imgNumElement = document.getElementById('img_num');

        imgContainer.innerHTML = '';
        imgNumElement.textContent = images.length;

        images.forEach(function(img) {
            const imgDiv = document.createElement('div');
            imgDiv.className = 'box-capture-list mt-2';
            imgDiv.innerHTML = `
                <img src="http://localhost/ScreenRecord/${img.img}" class="w-100">
                <span class="number-cap">${img.num}</span>
            `;
            imgContainer.appendChild(imgDiv);
        });
    }

    function change_doctor(doctor_id) {
        const cid = document.body.dataset.cid || '';
        if (cid) {
            CameraAPI.setDoctorname(cid, doctor_id).then(function(doctorname) {
                document.getElementById('text_doctorname').textContent = doctorname;
            }).catch(function(error) {
                console.error('Error setting doctorname:', error);
            });
        }
    }

    function updateTimeFields(caseData) {
        // Update time input fields
        if (caseData.time_patientin) {
            document.getElementById('time_patientin').value = caseData.time_patientin;
        }
        if (caseData.time_start) {
            document.getElementById('time_start').value = caseData.time_start;
        }
        if (caseData.time_withdrawal) {
            document.getElementById('time_withdrawal').value = caseData.time_withdrawal;
        }
        if (caseData.time_end) {
            document.getElementById('time_end').value = caseData.time_end;
        }
    }

    function checkProcedureCode(caseData) {
        const withdrawalSection = document.getElementById('withdrawal_time_section');
        if (!withdrawalSection) {
            return;
        }
        if (caseData.case_procedurecode === 'gi002') {
            withdrawalSection.style.display = 'flex';
        }
    }

    function set_time(key) {
        var today = new Date();
        var time = ('0' + today.getHours()).slice(-2) + ":" + ('0' + today.getMinutes()).slice(-2) + ":" + ('0' + today.getSeconds()).slice(-2);
        $("#" + key).val(time).keyup();
        update_case_time(key, time);
    }

    function edit_time(value, id) {
        if (!value || value.trim() === '') {
            return;
        }
        update_case_time(id, value);
    }

    function update_case_time(key, value) {
        const cid = document.body.dataset.cid || '';
        if (!cid) {
            console.error('CID not found');
            return;
        }

        $.post('{{ url('api/capture') }}', {
            event: 'case_update',
            cid: cid,
            key: key,
            value: value
        }, function(data, status) {
            // Success callback
        }).fail(function(xhr, status, error) {
            console.error('Error updating case time:', error);
        });
    }

    function onlyNumbersWithColon(event) {
        const char = String.fromCharCode(event.which);
        if (!/[0-9:]/.test(char)) {
            event.preventDefault();
        }
    }

    // Load data when DOM is ready (แต่จะถูกเรียกจาก js_onload.blade.php หลังจากโหลด case data เสร็จแล้ว)
    // ถ้ายังไม่ถูกเรียก ให้เรียกเมื่อ DOM ready (fallback)
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            // รอสักครู่เพื่อให้ js_onload.blade.php โหลดเสร็จก่อน
            setTimeout(function() {
                // ตรวจสอบว่าถ้ายังไม่ถูกเรียกจาก js_onload.blade.php ให้เรียกเอง
                if (typeof loadCaseData === 'function' && document.getElementById('patient_name').textContent === 'Loading...') {
                    loadCaseData();
                }
            }, 1000);
        });
    } else {
        // รอสักครู่เพื่อให้ js_onload.blade.php โหลดเสร็จก่อน
        setTimeout(function() {
            // ตรวจสอบว่าถ้ายังไม่ถูกเรียกจาก js_onload.blade.php ให้เรียกเอง
            if (typeof loadCaseData === 'function' && document.getElementById('patient_name').textContent === 'Loading...') {
                loadCaseData();
            }
        }, 1000);
    }
</script>
