{{-- Modal Confirm Ipad ล่าสุด 2024/08/06 --}}
<style>
    span {
        text-transform: capitalize;
    }
</style>
<div id="confirm_booking" class="modal fade " tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl ">
        <div class="modal-content card-ipad ">
            <div class="modal-header p-3" style="border-bottom: 1px solid #707070;">
                <div class="font-gray fs-14">




                    <input type="hidden" class="modal_book_id">

                    <input id="confirm_department" hidden> </input>
                    <span>HN :</span>
                    <span id="confirm_booking_hn" value=""></span>
                    <span id="confirm_booking_title01" value="">
                        {{-- HN : 1243534 Suratchanut Chitrat (29 y 2 m) <br>
                            Contact : 091-232-3452 --}}
                    </span>
                    <div class="mt-2">
                        <span id="confirm_booking_title02"></span>
                    </div>
                </div>
                <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body font-gray p-3">
                <span class="fs-15 fw-bold">
                    Booking Detail
                </span>
                <div class="row font-gray mt-2">
                    <div class="col-2">
                        Date :
                    </div>
                    <div class="col-4">
                        <span id="modal_date" style="display:none;"></span>
                        <span class="text-white bg-orange p-1 "id="modal_dateformat" style="border-radius: 4px;"></span>
                    </div>
                    <div class="col-3">
                        Physician :
                    </div>
                    <div class="col-3">
                        <span id="modal_physician"></span>

                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-2">
                        Period :
                    </div>
                    <div class="col-4">
                        <span id="modal_period"> </span>
                    </div>
                    <div class="col-3">
                        Procedure :
                    </div>
                    <div class="col-3">
                        <span id="modal_procedure"></span>
                    </div>

                </div>
                <div class="row mt-2">
                    <div class="col-2">
                        Anesthesia :
                    </div>
                    <div class="col-4">
                        <span id="modal_anesthesia"></span>
                    </div>
                    <div class="col-3">
                        Special :
                    </div>
                    <div class="col-3">
                        <span id="modal_special"></span>
                    </div>
                </div>
                <div class="row mt-2" style="border-bottom: 1px solid #707070;">
                    <div class="col-2">
                        Urgent :
                    </div>
                    <div class="col-4">
                        <span id="modal_urgent"></span>
                    </div>

                    <div class="col-3 mb-3">
                         Type of Patient Care :
                    </div>
                    <div class="col-3">
                        <span id="modal_patient_type"></span>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-2 align-self-center">
                        Description :
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" id="book_description" name="book_description"
                            placeholder="Free text" value="">
                    </div>
                    <div class="col-2 align-self-center">
                        Confirm by :
                    </div>
                    <div class="col-4">
                        <select class="form-select" id="select-confirm-nurse ">
                            <option value="Nurse">Nurse</option>
                            @foreach ($nurse ?? [] as $data2)
                                @php
                                    $data2 = (object) $data2;
                                @endphp
                                <option value="{{ @$data2->id }}">{{ @$data2->user_prefix }}
                                    {{ @$data2->user_firstname }} {{ @$data2->user_lastname }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>


                <div class="row mt-2 content-hide" style="display: none;">
                    <div class="col-2 pt-2 align-self-center">
                        Cancel Booking :
                    </div>
                    <div class="col-4 ">
                        <select class="form-select select2" id="select-cancel">

                            <option value="ผู้ป่วยแจ้งยกเลิก">ผู้ป่วยแจ้งยกเลิก</option>
                            <option value="ผู้ป่วยไม่มาตามนัด">ผู้ป่วยไม่มาตามนัด</option>
                            <option value="แพทย์ผู้นัดยกเลิกนัด">แพทย์ผู้นัดยกเลิกนัด</option>
                            <option value="นัดผู้ป่วยผิดคน">นัดผู้ป่วยผิดคน</option>
                            <option value="บันทึกข้อมูลนัดไม่ถูกต้องหรือครบถ้วน">บันทึกข้อมูลนัดไม่ถูกต้องหรือครบถ้วน
                            </option>
                            <option value="ผู้ป่วยโทรมาเลื่อนนัด">ผู้ป่วยโทรมาเลื่อนนัด</option>


                        </select>
                    </div>
                    <div class="col-2 align-self-center">
                        หมายเหตุ :
                    </div>
                    <div class="col-4">
                        <input type="text" class="form-control" placeholder="Freetext" id="book_cancel_reason">
                    </div>

                </div>






                {{-- <div class="row align-items-center mt-5">
                <div class="col-4"></div>
                <div class="col-4 text-end">
                    Confirm by
                </div>

                <div class="col-4 ">
                    <select class="form-select" id="select-nurse">
                        <option value="Nurse" selected>Nurse</option>
                        @foreach ($nurse as $data2)
                            @php
                                $data2 = (object) $data2;
                            @endphp
                            <option value="{{ @$data2->user_firstname }}">{{ @$data2->user_prefix }}
                                {{ @$data2->user_firstname }} {{ @$data2->user_lastname }}</option>
                        @endforeach
                    </select>
                </div>

            </div> --}}

            </div>
            <div class="row p-3 pt-3">
                <div class="col-6">
                    <a type="button" id="appointment_card" class="btn btn-primary w-md "><i
                        class="ri-printer-fill"></i>
                    Print
                </a>


                </div>

                <div class="col-6 text-end">
                    <button type="button" class="btn btn-danger w-md book_toggle " id="btn_cancelbook">
                        ไม่มาตามนัด
                    </button>
                    <button type="button" class="btn btn-danger w-md  btn-cancel-hide" id="book-cancel"
                        style="display: none;">
                        ยกเลิกนัดหมาย
                    </button>
                    &ensp;
                    <button type="submit" class="btn btn-success w-md book-confirm" data-bs-dismiss="modal"
                        aria-label="Close">
                        มาตามนัด
                    </button>

                </div>
                {{-- <div class="col-6 text-end">
        <button type="button" class="btn btn-primary btn-label waves-effect fw-normal right waves-light w-lg"><i
                class="ri-check-double-line label-icon align-middle fs-16  ms-2"></i> Mark as patient
            confirm booking</button>
    </div> --}}
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#select-cancel').select2({
            placeholder: "Select",
            allowClear: true,
            width: '100%',
            dropdownParent: $('#confirm_booking')
        });

        $('#select-cancel').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                $('.select2-dropdown').slideDown(300);
            });
        });
    });
</script>

<script>
    $(".book_toggle").click(function() {
        $(this).hide();
        $(".content-hide").toggle(200);
        $(".btn-cancel-hide").toggle(200);


    })

</script>
<script>
    $(document).ready(function() {
        $('#select-cancel-nurse, #select-confirm-nurse').select2({
            placeholder: "Select",
            allowClear: true,
            dropdownParent: $('#confirm_booking')
        });

        $('#select-cancel-nurse, #select-confirm-nurse').on('select2:open', function(e) {
            $('.select2-dropdown').hide();
            setTimeout(function() {
                $('.select2-dropdown').slideDown(300);
            });
        });
    });
</script>
