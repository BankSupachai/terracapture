<div class="offcanvas offcanvas-start" tabindex="-1" id="attendant_offcanvas" aria-labelledby="offcanvasExampleLabel"
    style="background-color: #000;" wire:ignore>
    {{ bladelink('capture/camera/modal/attendant') }}
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Operation Detail</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body py-1">
        <div class="row ">
            <h6>Endoscopist</h6>
            <div class="col-12">
                <div wire:ignore>
                    <select id="select_physician" class="selectpicker w-100" data-live-search="true">
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <h6>Room : </h6>
            <div class="col-12">
                <select name="room" id="select_room" class="selectpicker w-100" data-live-search="true">
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-2"></div>
            <div class="col-8">
                <hr>
            </div>
            <div class="col-2"></div>
        </div>

        <div class="col-12 mb-3">
            <h5>Select Attendant</h5>
        </div>

        <div class="row mt-2">
            <h6>Physician attend :</h6>
            <div class="col-12">
                <select id="select_physician_attend" name="physician_attend"
                    class="selectpicker w-100 change-user-attendant" data-live-search="true" placeholder="Doctor"
                    data-user-type="doctor">
                    <option value="none" selected></option>
                </select>
            </div>

        </div>
        <div class="row mt-3">
            <h6>Nurse attend :</h6>
            <div class="col-12">
                <select id="select_nurse_attend" name="nurse_attend" class="selectpicker w-100 change-user-attendant"
                    data-live-search="true" placeholder="Nurse" data-user-type="nurse">
                    <option value="none" selected></option>
                </select>
            </div>

        </div>
        <div class="row mt-3">
            <h6>Nurse assistant :</h6>
            <div class="col-12">
                <select id="select_nurse_assistant_attend" name="nurse_assistant_attend"
                    class="selectpicker w-100 change-user-attendant" data-live-search="true"
                    placeholder="Nurse Assistant" data-user-type="nurse_assistant">
                    <option value="none" selected></option>
                </select>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-2"></div>
        <div class="col-8">
            <hr>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row" id="user_in_case_list">
        <!-- User in case list will be loaded via API -->
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-12 text-center">
            <a id="btnconfirm_attendant" class="btn w-75" data-bs-toggle="offcanvas"
                data-bs-target="#attendant_offcanvas" style="background-color: #245788; color: white;">Save and
                Close</a>
        </div>
    </div>
</div>


</div>
<script>
    // Store users data globally for reuse
    let allUsersCache = {
        doctors: [],
        nurses: [],
        nurseAssistants: []
    };

    async function loadAttendantData() {
        const cid = document.body.dataset.cid || '';
        if (!cid) {
            console.error('CID not found');
            return;
        }

        try {
            // Load data in parallel
            const [doctors, rooms, nurses, nurseAssistants, caseData] = await Promise.all([
                CameraAPI.getUsers('doctor'),
                CameraAPI.getRooms(),
                CameraAPI.getUsers('nurse'),
                CameraAPI.getUsers('nurse_assistant'),
                CameraAPI.getCase(cid)
            ]);

            // Cache users data for later use
            allUsersCache.doctors = doctors;
            allUsersCache.nurses = nurses;
            allUsersCache.nurseAssistants = nurseAssistants;

            // Populate doctor select
            const physicianSelect = document.getElementById('select_physician');
            physicianSelect.innerHTML = '';
            doctors.forEach(function(doctor) {
                const option = document.createElement('option');
                option.value = doctor.uid;
                option.textContent = `${doctor.fullname} ${doctor.user_code || ''}`;
                if (caseData.case_physicians01 && doctor.uid == caseData.case_physicians01) {
                    option.selected = true;
                }
                physicianSelect.appendChild(option);
            });
            if (typeof $ !== 'undefined' && $.fn.selectpicker) {
                $(physicianSelect).selectpicker('refresh');
            }

            // Populate room select
            const roomSelect = document.getElementById('select_room');
            roomSelect.innerHTML = '<option value=""></option>';
            rooms.forEach(function(room) {
                const option = document.createElement('option');
                option.value = room.room_id;
                option.textContent = room.room_name;
                if (caseData.room_id && room.room_id == caseData.room_id) {
                    option.selected = true;
                }
                roomSelect.appendChild(option);
            });
            if (typeof $ !== 'undefined' && $.fn.selectpicker) {
                $(roomSelect).selectpicker('refresh');
            }

            // Populate user attendant selects
            populateUserSelect('[data-user-type="doctor"]', doctors, 'Doctor');
            populateUserSelect('[data-user-type="nurse"]', nurses, 'Nurse');
            populateUserSelect('[data-user-type="nurse_assistant"]', nurseAssistants, 'Nurse Assistant');

            // Load user in case list
            load_userincase();

        } catch (error) {
            console.error('Error loading attendant data:', error);
        }
    }

    function populateUserSelect(selector, users, defaultText) {
        const select = document.querySelector(selector);
        if (!select) return;

        select.innerHTML = `<option value="none" selected>${defaultText}</option>`;
        users.forEach(function(user) {
            const option = document.createElement('option');
            option.value = user.uid;
            option.textContent = `${user.fullname} ${user.user_code || ''}`;
            select.appendChild(option);
        });
        if (typeof $ !== 'undefined' && $.fn.selectpicker) {
            $(select).selectpicker('refresh');
        }
    }

    $("#select_physician").change(function() {
        var data_id = $(this).val();
        var doctorname = $(this).find('option:selected').text();
        $("#text_doctorname").html(doctorname);
        case_update('case_physicians01', data_id);
        case_update('doctorname', doctorname);
    });

    $("#select_room").change(function() {
        var data_id = $(this).val();
        var roomname = $(this).find('option:selected').text();
        $("#room_text").html(roomname);
        case_update('room_id', data_id);
        case_update('room_name', roomname);
    });

    $('.change-user-attendant').change(function() {
        var data_id = $(this).val();
        if (data_id && data_id !== 'none') {
            attendant_update(data_id);
        }
    });

    function attendant_update(data_id) {
        const cid = document.body.dataset.cid || '';
        if (cid) {
            CameraAPI.attendantUpdate(cid, data_id).then(function(data) {
                // Use the returned data directly instead of calling load_userincase which calls get_case
                updateUserInCaseList(data || []);
            }).catch(function(error) {
                console.error('Error updating attendant:', error);
            });
        }
    }

    $("#btnconfirm_attendant").click(function() {
        load_userincase();
    });

    async function load_userincase() {
        const cid = document.body.dataset.cid || '';
        if (!cid) return;

        try {
            const html = await CameraAPI.loadUserincase(cid);
            $("#load_userincase").html(html);

            // Also update user_in_case_list if it exists
            const caseData = await CameraAPI.getCase(cid);
            updateUserInCaseList(caseData.user_in_case || []);
        } catch (error) {
            console.error('Error loading userincase:', error);
        }
    }

    async function deleteUserFromCaseHandler(userId) {
        const cid = document.body.dataset.cid || '';
        if (!cid) {
            console.error('CID not found');
            alert('ไม่พบ Case ID');
            return;
        }

        // Optimistic UI update - ลบออกจาก UI ทันที
        const userRow = document.querySelector(`[data-user-id="${userId}"]`);
        if (userRow) {
            userRow.remove();
        }

        try {
            // Use CameraAPI if available, otherwise use fetch directly
            let result;
            if (typeof CameraAPI !== 'undefined' && typeof CameraAPI.deleteUserFromCase === 'function') {
                result = await CameraAPI.deleteUserFromCase(cid, userId);
            } else {
                // Fallback to direct fetch
                const response = await fetch('../api/capture', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        event: 'delete_user_in_case',
                        cid: cid,
                        id: userId
                    })
                });
                result = await response.json();
                if (!response.ok) {
                    const errorMessage = result.error || `HTTP error! status: ${response.status}`;
                    throw new Error(errorMessage);
                }
            }

            if (result.error) {
                alert('เกิดข้อผิดพลาด: ' + result.error);
                // Reload the list if error
                const caseData = typeof CameraAPI !== 'undefined' && typeof CameraAPI.getCase === 'function' ?
                    await CameraAPI.getCase(cid) :
                    await fetch('../api/capture', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify({
                            event: 'get_case',
                            cid: cid
                        })
                    }).then(r => r.json());
                updateUserInCaseList(caseData.user_in_case || []);
                return;
            }

            // result is already the updated user_in_case array, no need to call get_case
            updateUserInCaseList(result || []);
        } catch (error) {
            console.error('Error deleting user from case:', error);
            // Reload the list if error occurred
            try {
                const caseData = typeof CameraAPI !== 'undefined' && typeof CameraAPI.getCase === 'function' ?
                    await CameraAPI.getCase(cid) :
                    await fetch('../api/capture', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: JSON.stringify({
                            event: 'get_case',
                            cid: cid
                        })
                    }).then(r => r.json());
                updateUserInCaseList(caseData.user_in_case || []);
            } catch (reloadError) {
                console.error('Error reloading user list:', reloadError);
            }
            const errorMessage = error.message || 'เกิดข้อผิดพลาดในการลบผู้ใช้ออกจากรายการ';
            alert(errorMessage);
        }
    }

    async function updateUserInCaseList(userInCase) {
        const container = document.getElementById('user_in_case_list');
        if (!container) return;

        // Load users data if not cached yet (fallback)
        if (!allUsersCache.doctors || allUsersCache.doctors.length === 0) {
            try {
                const [doctors, nurses, nurseAssistants] = await Promise.all([
                    CameraAPI.getUsers('doctor'),
                    CameraAPI.getUsers('nurse'),
                    CameraAPI.getUsers('nurse_assistant')
                ]);
                allUsersCache.doctors = doctors;
                allUsersCache.nurses = nurses;
                allUsersCache.nurseAssistants = nurseAssistants;
            } catch (error) {
                console.error('Error loading users:', error);
            }
        }

        // Create a Map for O(1) lookup instead of O(n) find
        const allUsers = [
            ...allUsersCache.doctors,
            ...allUsersCache.nurses,
            ...allUsersCache.nurseAssistants
        ];
        const usersMap = new Map();
        allUsers.forEach(user => {
            usersMap.set(user.uid, user);
        });

        // Use DocumentFragment for better performance when rendering multiple elements
        const fragment = document.createDocumentFragment();

        // Create rows for each user in case
        for (const uid of userInCase) {
            const user = usersMap.get(uid) || usersMap.get(parseInt(uid));
            if (user) {
                const row = document.createElement('div');
                row.className = 'col-12 mb-2';
                row.setAttribute('data-user-id', user.uid);
                row.innerHTML = `
                    <div class="col-9 d-inline-block" style="color: white;">
                        ${user.fullname} ${user.user_code || ''}
                    </div>
                    <div class="col-3 text-end d-inline-block">
                        <i onclick="deleteUserFromCaseHandler(${user.uid})" class="ri-close-fill text-danger" style="cursor: pointer;"></i>
                    </div>
                `;
                fragment.appendChild(row);
            }
        }

        // Clear and append all at once for better performance
        container.innerHTML = '';
        container.appendChild(fragment);
    }

    // Load data when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadAttendantData);
    } else {
        loadAttendantData();
    }
</script>
