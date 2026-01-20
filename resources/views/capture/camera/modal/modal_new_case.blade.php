<style>
    #new_case .modal-body {
        background: #222529;
    }

    @media (min-width: 992px) {
        .modal-lg {
            width: unset !important;
            max-width: unset !important;
            width: 1400px !important;
            height: 600px !important;
        }
    }
    #new_case .modal-dialog .modal-content {
        min-width: unset !important;
        max-width: unset !important;
        width: 1400px !important;
        height: 600px !important;
        /* box-shadow: 0 0 15px #8a8888; */
    }
    #new_case .modal-content {
        border: none;
    }
    .box-data {
        background: #222529;
        padding: 1em;
    }
    #new_case .form-control {
        border: none;
        background: black;
        color: #fff;
    }
    #new_case .btn-sm {
        padding: 0.2em;
    }

    #new_case .border-right {
        border-right: 1px solid #fff;
    }
    .menu-list-scroll {
        width: 100%;
        height: 600px;
        overflow-y: auto;
    }
    .text-dark-camera {
        color: #BBBBBB;
    }
</style>
<div class="modal fade" id="modal_new_case" tabindex="-1" role="dialog" aria-labelledby="New_case_Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0 " style="    background: #222529;">
                <h5 class=" text-dark-camera mt-4 ms-4">Case List</h5>
                <div class="mb-2" style="border: 1px solid #353535"></div>
                <div class="row m-0 ">
                    <span class="ms-3 mt-2 h5 text-dark-camera">Current Patient</span>
                    <div class="col-4 border-right" style="max-height: 100px; ">
                        <div class="box-data row m-0" id="current_patient_info">
                            <div class="row p-0 m-0" style="max-height:20px">
                                <div class="col-5 text-light">HN :</div>
                                <div class="col-7 text-light text-end" id="current_hn">-</div>
                            </div>
                            <div class="col-5 text-light ">Name :</div>
                            <div class="col-7 text-light text-end" id="current_patientname">-</div>
                            <div class="col-5 text-light ">Current :</div>
                            <div class="col-7 light text-end text-danger" id="current_procedurename">-</div>
                            <div class="col-5 text-light">Endoscopist :</div>
                            <div class="col-7 text-light text-end" id="current_doctorname">-</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-8">
                                <select name="procedure_code" id="select_procedure_code" class="form-control selectpicker" data-live-search="true" placeholder="Procedure">
                                </select>
                            </div>
                            <div class="col-4">
                                <button id="submit_newprocedure" class="btn btn-sm btn-addprocedure w-100"
                                    style="background-color: #245788; color: #fff;">Add Procedure</button>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <table class="table table-borderless w-100 list-this-cases">
                                    <tr>
                                        <td><u>Procedure</u></td>
                                        <td><u>Endoscopist</u></td>
                                        <td></td>
                                    </tr>
                                    <tbody id="current_patient_cases">
                                        <tr>
                                            <td colspan="3" class="text-light text-center">- Loading... -</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row m-0">
                            <div class="col-6"></div>
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="input-icon">
                                        <input type="text" class="form-control" placeholder="Search..."
                                            id="search_case" />
                                        <span><i class="flaticon2-search-1 icon-md"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="menu-list-scroll mt-2">
                                <div class="row m-0 p-3 " style="background: #121212;">
                                    <div class="col-2 text-light">HN</div>
                                    <div class="col-2 text-light">Name</div>
                                    <div class="col-3 text-light">Endoscopist</div>
                                    <div class="col-3 text-light">Procedure</div>
                                    <div class="col-2 text-light text-end">Action</div>
                                </div>
                                <div id="case_today_list">
                                    <div class="row m-0 cn py-3">
                                        <div class="col-12 text-light text-center">- Loading... -</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<markdown style="display: none;">
    - ก่อนสร้างรายการใหม่ ต้องกดปุ่ม Stop Recording ก่อน
    - ก่อนสร้างรายการใหม่ ต้องกดปุ่ม Add Procedure ก่อน
    - ก่อนสร้างรายการใหม่ ต้องกดปุ่ม Load Icon ก่อน
</markdown>


<script>
    let currentCaseData = null;
    let currentCaseId = null;
    let proceduresData = [];
    let caseTodayData = [];

    // โหลดข้อมูลเมื่อ modal เปิด
    $('#modal_new_case').on('show.bs.modal', function() {
        loadModalData();
    });

    async function loadModalData() {
        try {
            const cid = document.body.dataset.cid || '';
            currentCaseId = cid;

            // โหลดข้อมูล case ปัจจุบัน
            if (cid) {
                const caseData = await CameraAPI.getCase(cid);
                currentCaseData = caseData;
                updateCurrentPatientInfo(caseData);
            }

            // โหลดข้อมูล procedures
            await updateProcedureSelect();

            // โหลดข้อมูล cases วันนี้
            caseTodayData = await CameraAPI.getCaseToday(cid);
            updateCaseTodayList(caseTodayData);
            updateCurrentPatientCases(caseTodayData, currentCaseData);

        } catch (error) {
            console.error('Error loading modal data:', error);
        }
    }

    function updateCurrentPatientInfo(caseData) {
        const hn = caseData.case_hn || caseData.hn || '-';
        $('#current_hn').text(hn);
        $('#current_patientname').text(caseData.patientname || '-');
        $('#current_procedurename').text(caseData.procedurename || '-');
        $('#current_doctorname').text(caseData.doctorname || '-');
    }

    async function updateProcedureSelect() {
        try {
            // ดึงข้อมูลจาก API
            const procedures = await CameraAPI.getProcedures();
            const select = $('#select_procedure_code');
            select.empty();
            select.append('<option value="0">select</option>');
            procedures.forEach(function(proc) {
                select.append(`<option value="${proc.code}" text_pcd="${proc.name}">${proc.name}</option>`);
            });
            proceduresData = procedures; // เก็บข้อมูลไว้ในตัวแปร global

            // Initialize หรือ Refresh selectpicker
            if (typeof $ !== 'undefined' && $.fn.selectpicker) {
                if (!select.data('selectpicker')) {
                    select.selectpicker();
                } else {
                    select.selectpicker('refresh');
                }
            }
        } catch (error) {
            console.error('Error loading procedures:', error);
            const select = $('#select_procedure_code');
            select.empty();
            select.append('<option value="0">Error loading procedures</option>');
            // Initialize หรือ Refresh selectpicker even on error
            if (typeof $ !== 'undefined' && $.fn.selectpicker) {
                if (!select.data('selectpicker')) {
                    select.selectpicker();
                } else {
                    select.selectpicker('refresh');
                }
            }
        }
    }

    function updateCaseTodayList(cases) {
        const container = $('#case_today_list');
        container.empty();

        if (cases.length === 0) {
            container.append('<div class="row m-0 cn py-3"><div class="col-12 text-light text-center">- No case!! -</div></div>');
            return;
        }

        cases.forEach(function(data) {
            console.log(data);
            const hn = data.hn || data.case_hn || '-';
            const patientname = data.patientname || '-';
            const doctorname = data.doctorname || '-';
            const procedurename = data.procedurename || '-';
            let caseId = '';
            if (typeof data.id === 'object' && data.id !== null && ('$oid' in data.id)) {
                caseId = data.id.$oid;
            } else if (typeof data.id !== 'undefined') {
                caseId = String(data.id);
            }
            const currentCid = currentCaseId || '';

            const row = $(`
                <div class="row m-0 cn py-3">
                    <div class="col-2 text-light">${hn}</div>
                    <div class="col-2 text-light">${patientname}</div>
                    <div class="col-3 text-light">${doctorname}</div>
                    <div class="col-3 text-light">${procedurename}</div>
                    <div class="col-2 text-end pr-1">
                        <a href="{{ url('loadpic2server') }}/${currentCid}?newcase=${caseId}"
                            class="btn btn-danger btn-loadicon checkend_time">
                            <i style="font-size: 16px" class="ri-camera-fill"></i>
                        </a>
                    </div>
                </div>
            `);
            container.append(row);
        });
    }

    function updateCurrentPatientCases(cases, currentCase) {
        const container = $('#current_patient_cases');
        container.empty();

        if (!currentCase) {
            container.append('<tr><td colspan="3" class="text-light text-center">- No case!! -</td></tr>');
            return;
        }

        const currentHn = currentCase.case_hn || currentCase.hn || '';
        const filteredCases = cases.filter(function(data) {
            const dataHn = data.hn || data.case_hn || '';
            return dataHn === currentHn;
        });

        if (filteredCases.length === 0) {
            container.append('<tr><td colspan="3" class="text-light text-center">- No case!! -</td></tr>');
            return;
        }

        filteredCases.forEach(function(data) {
            const procedurename = data.procedurename || '-';
            const patientname = data.patientname || '-';
            // Fix: Ensure we get the primitive id value as string, not an object
            let caseId = '';
            if (typeof data.id === 'object' && data.id !== null && ('$oid' in data.id)) {
                caseId = data.id.$oid;
            } else if (typeof data.id !== 'undefined') {
                caseId = String(data.id);
            }
            const currentCid = currentCaseId || '';

            const row = $(`
                <tr>
                    <td>${procedurename}</td>
                    <td>${patientname}</td>
                    <td>
                        <a href="{{ url('loadpic2server') }}/${currentCid}?newcase=${encodeURIComponent(caseId)}"
                            class="btn btn-success btn-loadicon checkend_time">
                            <i style="font-size: 20px" class="las la-camera"></i>
                        </a>
                    </td>
                </tr>
            `);
            container.append(row);
        });
    }

    // Search functionality
    $('#search_case').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();
        $('#case_today_list .cn').each(function() {
            const text = $(this).text().toLowerCase();
            if (text.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    $(".add_endtime").click(function() {
        alert(1);
    })

    $('#submit_newprocedure').on('click', function() {
        if (check_null('time_end')) $('#btn_time_4').click();
        var this_pcd_value = $("#select_procedure_code").val();
        vdo_check_stop();
        if (this_pcd_value != 0) {
            const cid = currentCaseId || document.body.dataset.cid || '';
            $.post('{{ url('api/capture') }}', {
                event: 'camera_copy_pcd',
                case_procedurecode: this_pcd_value,
                case_id: cid,
                this_url: "{{ url('') }}"
            }, function(data) {
                location.replace('{{ url('capture') }}/' + data);
                if (typeof ck_pcd !== 'undefined') {
                    ck_pcd();
                }
            });
        } else {
            alert("Please select procedure");
        }
    });
</script>
