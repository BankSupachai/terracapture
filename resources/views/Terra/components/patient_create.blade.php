<div class="row p-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="head-create">
                    <div class="row">
                        <div class="col"></div>
                        <div class="col p-0 psr">
                            <div class="row set-line-create">
                                <div class="col-12"><hr></div>
                            </div>
                            <div class="row">
                                <div class="col-auto p-0 text-center">
                                    <div class="box-num active" id="num_patient">1</div>
                                    Create New<br>
                                    Patient
                                </div>
                                <div class="col p-0"></div>
                                <div class="col-auto p-0 text-center">
                                    <div class="box-num" id="num_study">2</div>
                                    Create New <br>
                                    Study
                                </div>
                            </div>
                        </div>
                        <div class="col"></div>
                    </div>
                </div>
                <div class="body-create active" id="create_patient">
                    <div class="row mb-2">
                        <div class="col-lg-12"><b>Patient Detail</b></div>
                    </div>
                    <div class="row">
                        <div class="col-lg mt-2">
                            <label for="">Patient ID <b class="text-danger">*</b></label>
                            <input type="text" id="patient_id" name="" class="form-control" placeholder="HN" oninput="check_id(this.value)">
                        </div>
                        <div class="col-lg mt-2">
                            <label for="">Prefix</label>
                            <input type="text" id="patient_prefix" name="" class="form-control" placeholder="Mr., Mrs.">
                        </div>
                        <div class="col-lg mt-2">
                            <label for="">First Name <b class="text-danger">*</b></label>
                            <input type="text" id="patient_firstname" name="" class="form-control" placeholder="Name">
                        </div>
                        <div class="col-lg mt-2">
                            <label for="">Middle Name</label>
                            <input type="text" id="patient_middlename" name="" class="form-control" placeholder="Middle">
                        </div>
                        <div class="col-lg mt-2">
                            <label for="">Last Name <b class="text-danger">*</b></label>
                            <input type="text" id="patient_lastname" name="" class="form-control" placeholder="Last">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg mt-2">
                            <label for="">Gender <b class="text-danger">*</b></label>
                            <input type="text" id="patient_gender" name="" class="form-control" placeholder="Men/Women">
                        </div>
                        <div class="col-lg mt-2">
                            <label for="">DOB <b class="text-danger">*</b></label>
                            <input type="date" id="patient_dob" name="" class="form-control" placeholder="DD/MM/YYYY">
                        </div>
                        <div class="col-lg-1 mt-2">
                            <label for="">Age</label>
                            <input type="text" id="patient_age" name="" class="form-control" placeholder="20">
                        </div>
                        <div class="col-lg mt-2">
                            <label for="">Phone Number</label>
                            <input type="text" id="patient_phone" name="" class="form-control" placeholder="0912345678">
                        </div>
                        <div class="col-lg mt-2">
                            <label for="">E-mail</label>
                            <input type="text" id="patient_email" name="" class="form-control" placeholder="example@gmail.com">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-auto mt-2">
                            <label for="">Allergy history</label>
                            <div class="radio-inline mt-3">
                                <label class="radio">
                                    <input type="radio" id="patient_allergyno" name="patient_allergy" value="no"/>
                                    <span></span>
                                    No&emsp;
                                </label>
                                <label class="radio">
                                    <input type="radio" id="patient_allergyyes" name="patient_allergy" value="yes"/>
                                    <span></span>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="col-lg mt-2"><label for="">&emsp;</label><input type="text" name="" class="form-control" id="allergy_detail" placeholder="Detail"></div>
                        <div class="col-lg-auto mt-2">
                            <label for="">Congenital disease</label>
                            <div class="radio-inline mt-3">
                                <label class="radio">
                                    <input type="radio" id="patient_diseaseno" name="patient_disease" value="no"/>
                                    <span></span>
                                    No&emsp;
                                </label>
                                <label class="radio">
                                    <input type="radio" id="patient_deseaseyes" name="patient_disease" value="yes"/>
                                    <span></span>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="col-lg mt-2"><label for="">&emsp;</label><input type="text" name="" class="form-control" id="disease_detail" placeholder="Detail"></div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-sm btn-light mr-2" disabled>Previous</button>
                            <a href="{{url('registration/1')}}" id="next" class="btn btn-sm btn-terralink">&nbsp; Next &nbsp;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
