<style>

</style>
<!-- Default Modals -->
<div id="modal_adddoctor" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add New - Endoscopist</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="col-12 mt-2" style="border-bottom: 1px solid #E9EBEC;"></div>

            <div class="modal-body ">
                <form action="{{url('admin/user')}}" method="POST" id="addDoctorForm">
                    @csrf
                    <span class="fs-13 text-muted"> Please fill the field  </span>
                    <div class="row mt-3">
                        <input type="hidden" name="event" value="doctor_create">

                        <input type="hidden" name="id" value="{{ $patient_id}}">

                        <input type="hidden" name="prepage" value="{{@$page}}">
                        <div class="col-3 text-soft-gray">Prefix <span class="text-danger">*</span></div>
                        <div class="col-3 text-soft-gray">First name <span class="text-danger">*</span></div>
                        <div class="col-3 text-soft-gray">Last name <span class="text-danger">*</span></div>
                        <div class="col-3 text-soft-gray">Physician ID</div>

                        <div class="col-3">
                            <input type="text" class="form-control required-field" name="user_prefix" autocomplete="off" required>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control required-field" name="user_firstname" autocomplete="off" required>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control required-field" name="user_lastname" autocomplete="off" required>
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control " name="user_code" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row text-center mb-3">
                    <div class="col-12">
                        <button type="button" id="submitDoctorBtn" class="btn btn-primary w-75">+ Create Endoscopist</button>
                    </div>
                </div>
            </form>

            <script>
                $(document).ready(function() {
                    $('#submitDoctorBtn').click(function(e) {
                        e.preventDefault();

                        let missingFields = [];
                        $('.required-field').each(function() {
                            if (!$(this).val().trim()) {
                                missingFields.push($(this).closest('.col-3').prev('.col-3').text().trim());
                                $(this).addClass('border-danger');
                            } else {
                                $(this).removeClass('border-danger');
                            }
                        });

                        if (missingFields.length > 0) {
                            let warningText = 'กรุณากรอกข้อมูลในช่อง: ' + missingFields.join(', ');
                            $('#warning_div').attr('data-toast-text', warningText);
                            $('#warning_div').click();
                            return false;
                        }

                        // Check for duplicate user_code if it's filled
                        let userCode = $('input[name="user_code"]').val().trim();
                        if (userCode) {
                            $.ajax({
                                url: '{{ url("api/check-doctor-code") }}',
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    user_code: userCode
                                },
                                success: function(response) {
                                    if (response.exists) {
                                        let warningText = 'รหัสแพทย์นี้มีอยู่ในระบบแล้ว กรุณาตรวจสอบ';
                                        $('#warning_div').attr('data-toast-text', warningText);
                                        $('#warning_div').click();
                                        $('input[name="user_code"]').addClass('border-danger');
                                    } else {
                                        $('#addDoctorForm').submit();
                                    }
                                },
                                error: function() {
                                    let warningText = 'เกิดข้อผิดพลาดในการตรวจสอบรหัสแพทย์';
                                    $('#warning_div').attr('data-toast-text', warningText);
                                    $('#warning_div').click();
                                }
                            });
                        } else {
                            $('#addDoctorForm').submit();
                        }
                    });

                    // Remove red border when user starts typing
                    $('.required-field, input[name="user_code"]').on('input', function() {
                        if ($(this).val().trim()) {
                            $(this).removeClass('border-danger');
                        }
                    });
                });
            </script>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
