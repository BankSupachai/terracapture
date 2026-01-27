<div class="card p-3">
    <div class="row">
        <div class="col-xl-6">
            <div class="row">
                <div class="col-auto">
                    <h4>Pre-Diagnosis &ensp; &ensp; &ensp;&ensp; &ensp;<i class="ri-equalizer-line"></i></h4>
                    <span class="text-gray">Please fill in the field then click “Create Report” fsafasfasfas</span>
                </div>
            </div>
            <div class="col-auto mt-4">
                <h5>Brief History1 </h4>
            </div>
            <div class="col-10">
                {{-- <textarea class="form-control autotext savejson" placeholder="Free text"
                     id="case_history">{{ @$case->case_history }}</textarea> --}}
                <textarea class="form-control autotext savejson" id="case_history" rows="3" placeholder="History">
                    {{ @$case->case_history }}
                </textarea>
            </div>
            <div class="row mt-4 ">
                <div class="col-3 d-flex align-items-center">
                    <h5>Pre-Diagnosis</h4>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <button type="button" class="btn btn-checkbox  waves-effect waves-light btn-sm fs-14"
                        id="btn_prediagnostic">
                        <i class="mdi mdi-checkbox-outline   align-middle  me-2 text-light fs-16"></i>
                        None Pre-Diagnosis
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck1">
                            <label class="form-check-label ms-4" for="formCheck1">
                                UGIB
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck2">
                            <label class="form-check-label ms-4" for="formCheck2">
                                Anemia
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck3">
                            <label class="form-check-label ms-4" for="formCheck3">
                                Abdominal Pain
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck4">
                            <label class="form-check-label ms-4" for="formCheck4">
                                Gastritis
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck5">
                            <label class="form-check-label ms-4" for="formCheck5">
                                Achalasia
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck6">
                            <label class="form-check-label ms-4" for="formCheck6">
                                Chronic
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <input type="text" class="form-control" placeholder="Other Diagnosis">
            </div>


            <div class="row mt-4 ">
                <div class="col-3 d-flex align-items-center">
                    <h5>Anesthesia</h4>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <button type="button" class="btn btn-checkbox  waves-effect waves-light btn-sm fs-14"
                        id="btn_prediagnostic1">
                        <i class="mdi mdi-checkbox-outline   align-middle  me-2 text-light fs-16"></i>
                        None Anesthesia
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck7">
                            <label class="form-check-label ms-4" for="formCheck7">
                                Topical
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck8">
                            <label class="form-check-label ms-4" for="formCheck8">
                                Tracheostomy
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck9">
                            <label class="form-check-label ms-4" for="formCheck9">
                                IV Sedation
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck10">
                            <label class="form-check-label ms-4" for="formCheck10">
                                TIVA
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck11">
                            <label class="form-check-label ms-4" for="formCheck11">
                                ET Intubation
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-auto">
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="formCheck12">
                            <label class="form-check-label ms-4" for="formCheck12">
                                MAC
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <input type="text" class="form-control" placeholder="Other Anesthesia">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="row text-pos d-flex align-items-center">
                <div class="col-2">
                    <h5 class="">Medication</h5>
                </div>
                <div class="col-auto d-flex align-items-center">
                    <button type="button" class="btn btn-checkbox  waves-effect waves-light btn-sm fs-14"
                        id="btn_prediagnostic">
                        <i class="mdi mdi-checkbox-outline   align-middle  me-2 text-light fs-16"></i>
                        None Medication
tton>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="row  mt-2">
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck13">
                                        <label class="form-check-label ms-4" for="formCheck13">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck14">
                                        <label class="form-check-label ms-4" for="formCheck14">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck15">
                                        <label class="form-check-label ms-4" for="formCheck15">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck16">
                                        <label class="form-check-label ms-4" for="formCheck16">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck17">
                                        <label class="form-check-label ms-4" for="formCheck17">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck18">
                                        <label class="form-check-label ms-4" for="formCheck18">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck19">
                                        <label class="form-check-label ms-4" for="formCheck19">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck20">
                                        <label class="form-check-label ms-4" for="formCheck20">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck21">
                                        <label class="form-check-label ms-4" for="formCheck1">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck22">
                                        <label class="form-check-label ms-4" for="formCheck22">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck23">
                                        <label class="form-check-label ms-4" for="formCheck23">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck24">
                                        <label class="form-check-label ms-4" for="formCheck24">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck25">
                                        <label class="form-check-label ms-4" for="formCheck25">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck26">
                                        <label class="form-check-label ms-4" for="formCheck26">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck27">
                                        <label class="form-check-label ms-4" for="formCheck27">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row d-flex align-items-center">
                                <div class="col-auto ">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck28">
                                        <label class="form-check-label ms-4" for="formCheck28">
                                            10% Xylocain spray
                                        </label>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="Dose">
                                </div>
                                <div class="col">mg.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row margin-pos">
                    <div class="col-6 ">
                        <input type="text" class="form-control" placeholder="Other Medication">
                    </div>
                    <div class="col-3 ">
                        <input type="text" class="form-control" placeholder="Dose">
                    </div>
                    <div class="col-2 ">
                        <input type="text" class="form-control" placeholder="mg.">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
