<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>




    <div class="p-1">
        <img name="hospital_pic" class="draggable" src="{{ urlConfig($hospital->hospital_pic) }}"
            style="{{ @$position['hospital_pic'] }} width: 100px;">
        <span name="hospital_name" class="draggable  "
            style="{{ @$position['hospital_name'] }} {{ @$txt_setting['hospital_name']['str'] }}">{{ $hospital->hospital_name }}</span>
        <span name="hospital_address" class="draggable "
            style="{{ @$position['hospital_address'] }} {{ @$txt_setting['hospital_address']['str'] }}">{{ @$hospital->hospital_address }}</span>
        <span name="hn" class="draggable  " style="{{ @$position['hn'] }} {{ @$txt_setting['patient_head_hn']['str'] }}">HN :
            <font style="{{ @$txt_setting['patient_hn']['str'] }}">9999999</font>
        </span>

        <span name="an" class="draggable  " style="{{ @$position['an'] }} {{ @$txt_setting['patient_head_an']['str'] }}">AN :
            <font style="{{ @$txt_setting['patient_an']['str']  }}">99999</font>
        </span>
        <span name="patientname" class="draggable  " style="{{ @$position['patientname'] }} {{ @$txt_setting['patient_head_name']['str'] }}">Patient
            Name : <font style="{{ @$txt_setting['patient_name']['str'] }}">{{ $casedata->patientname }}</font></span>
        <span name="gender" class="draggable  " style="{{ @$position['gender'] }} {{ @$txt_setting['patient_head_gender']['str'] }}">Gender :
            <font style="{{ @$txt_setting['patient_gender']['str'] }}">{{ $casedata->gender }}</font>
        </span>
        <span name="location" class="draggable  " style="{{ @$position['location'] }} {{ @$txt_setting['location_head']['str'] }}">
            Location : <font style="{{ @$txt_setting['location']['str'] }}">medica</font>
         </span>
        <span name="age" class="draggable  " style="{{ @$position['age'] }} {{ @$txt_setting['patient_head_age']['str'] }}">Age
            : <font style="{{ @$txt_setting['patient_age']['str'] }}">20</font></span>
        <span name="departmentTH" class="draggable  "
            style="{{ @$position['departmentTH'] }} {{ @$txt_setting['departmentTH']['str'] }}">{{ @$tb_procedure_header['departmentTH'] ?? 'หน่วยส่องกล้องทางเดินอาหาร' }}</span>
        <span name="departmentEN" class="draggable  "
            style="{{ @$position['departmentEN'] }} {{ @$txt_setting['departmentEN']['str'] }}">{{ @$tb_procedure_header['departmentEN'] ?? 'Digestive Endoscopy Department' }}</span>
        <span name="documentname" class="draggable  "
            style="{{ @$position['documentname'] }} {{ @$txt_setting['documentreport']['str'] }}">

            {{ @$tb_procedure_header['documentname'] ?? 'Digestive Endoscopy Report' }}</span>
        <span name="operationdate" class="draggable  "
         style="{{ @$position['operationdate'] }} {{ @$txt_setting['operation_head_date']['str'] }}">Operation
            Date : <font style="{{ @$txt_setting['operation_date']['str'] }}">11:00:00</font></span>
        <span
        name="treatmentcoverage"
        class="draggable  "
        style="{{ @$position['treatmentcoverage'] }}
        {{ @$txt_setting['treatment_head_coverage']['str'] }}">
        Treatment Coverage :
        <font style="{{ @$txt_setting['treatment_coverage']['str'] }}">
               สิทธิประกันสังคม</font></span>



    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" id="possition_x">
                </div>
                <div class="col-md-3">
                    <input type="text" id="possition_y">
                </div>
                <div class="col-md-3">
                    <input type="text" id="possition_name">
                </div>
            </div>
            <hr>
           <h3>ปรับขนาดตัวอักษรและสีของหัวกระดาษ</h3>
            <div class="row">
                <div class="col-6">
                    <h4>หัวข้อ</h4>
                </div>
                <div class="col-6">
                    <h4>ข้อมูล</h4>
                </div>
                <div class="col-6 mb-3">
                    <div class="row">
                        <div class="col-4 align-self-center">
                            HN หัวข้อ:
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_head_hn" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['patient_head_hn']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_head_hn" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['patient_head_hn']['color'] ?? '#000000' }}">
                        </div>



                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            Patient Name :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_head_name" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['patient_head_name']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_head_name" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['patient_head_name']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            Gender :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_head_gender" class="form-control fs_setting"
                                attr="size" placeholder="ขนาด"
                                value="{{ @$txt_setting['patient_head_gender']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_head_gender" class="form-control fs_setting"
                                attr="color" placeholder="สี"
                                value="{{ @$txt_setting['patient_head_gender']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            AGE :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_head_age" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['patient_head_age']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_head_age" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['patient_head_age']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            AN :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_head_an" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['patient_head_an']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_head_an" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['patient_head_an']['color'] }}">
                        </div>

                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="row">
                        <div class="col-4 align-self-center">
                         HN :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_hn" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['patient_hn']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_hn" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['patient_hn']['color'] ?? '#000000' }}">
                        </div>



                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            Patient Name :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_name" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['patient_name']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_name" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['patient_name']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            Gender :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_gender" class="form-control fs_setting"
                                attr="size" placeholder="ขนาด"
                                value="{{ @$txt_setting['patient_gender']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_gender" class="form-control fs_setting"
                                attr="color" placeholder="สี"
                                value="{{ @$txt_setting['patient_gender']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            AGE :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_age" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['patient_age']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_age" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['patient_age']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            AN :
                        </div>
                        <div class="col-4">
                            <input type="text" name="patient_an" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['patient_an']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="patient_an" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['patient_an']['color'] }}">
                        </div>

                    </div>
                </div>
                <hr>
                <div class="col-6 mb-3">
                    <div class="row">
                        <div class="col-4 align-self-center">
                            Location :
                        </div>
                        <div class="col-4">
                            <input type="text" name="location_head" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['location_head']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="location_head" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['location_head']['color'] ?? '#000000' }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            Operation Date :
                        </div>
                        <div class="col-4">
                            <input type="text" name="operation_head_date" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['operation_head_date']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="operation_head_date" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['operation_head_date']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            Treatment Coverage :
                        </div>
                        <div class="col-4">
                            <input type="text" name="treatment_head_coverage" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['treatment_head_coverage']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="treatment_head_coverage" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['treatment_head_coverage']['color'] }}">
                        </div>

                    </div>
                </div>
                <div class="col-6 mb-3">
                    <div class="row">
                        <div class="col-4 align-self-center">
                            Location :
                        </div>
                        <div class="col-4">
                            <input type="text" name="location" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['location']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="location" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['location']['color'] ?? '#000000' }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            Operation Date :
                        </div>
                        <div class="col-4">
                            <input type="text" name="operation_date" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['operation_date']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="operation_date" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['operation_date']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            Treatment Coverage :
                        </div>
                        <div class="col-4">
                            <input type="text" name="treatment_coverage" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['treatment_coverage']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="treatment_coverage" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['treatment_coverage']['color'] }}">
                        </div>

                    </div>
                </div>
                <hr>
                <div class="col-6 ">
                    <div class="row">
                        <div class="col-4 align-self-center">
                            ชื่อโรงพยาบาล
                        </div>
                        <div class="col-4">
                            <input type="text" name="hospital_name" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['hospital_name']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="hospital_name" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['hospital_name']['color'] ?? '#000000' }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            ที่อยู่ โรงพยาบาล
                        </div>
                        <div class="col-4">
                            <input type="text" name="hospital_address" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['hospital_address']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="hospital_address" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['hospital_address']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            ชื่อแผนก (ภาษาไทย)
                        </div>
                        <div class="col-4">
                            <input type="text" name="departmentTH" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['departmentTH']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="departmentTH" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['departmentTH']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            ชื่อแผนก (ภาษาอังกฤษ)
                        </div>
                        <div class="col-4">
                            <input type="text" name="departmentEN" class="form-control fs_setting" attr="size"
                                placeholder="ขนาด" value="{{ @$txt_setting['departmentEN']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="departmentEN" class="form-control fs_setting" attr="color"
                                placeholder="สี" value="{{ @$txt_setting['departmentEN']['color'] }}">
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-4 align-self-center">
                            ชื่อรายงาน Report
                        </div>
                        <div class="col-4">
                            <input type="text" name="documentreport" class="form-control fs_setting"
                                attr="size" placeholder="ขนาด"
                                value="{{ @$txt_setting['documentreport']['size'] }}">
                        </div>
                        <div class="col-4">
                            <input type="color" name="documentreport" class="form-control fs_setting"
                                attr="color" placeholder="สี"
                                value="{{ @$txt_setting['documentreport']['color'] }}">
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

</div>
