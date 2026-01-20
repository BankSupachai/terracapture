<div class="card card-custom gutter-b">
    <div class="card-body">
        <h5>Indication</h5>
        <div class="row">
            <div class="col-xxl-7">

            </div>
            <div class="col-xxl-5">
                <div class="row pd_col">
                    <div class="col-12">&emsp;<br></div>
                    <div class="col-12">&emsp;<br></div>
                    <div class="col-12">
                        <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm"
                            id="btn_indication">
                            <i class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-light"></i>
                            None Indication
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="input-group">
                            <input type="text" class="form-control texticd10 autotext savejson"
                                placeholder="Principal Diagnosis" name="texticd10" txtnum="0"
                                value="{{ @$case->diagnostic_text[0] }}" aria-label="Recipient's username"
                                autocomplete="off"
                            aria-describedby="basic-addon2">
                            <span class="input-group-text" id="icd10text01" >Indication</span>
                        </div>
                        {{-- <input type="text" name="texticd10" txtnum="0" value="{{@$case->diagnostic_text[0]}}"
                            class="form-control texticd10 autotext" autocomplete="off"> --}}
                    </div>

                    <div class="col-12 mt-2">
                        <div class="input-group">
                            <input type="text" class="form-control texticd10 savejson" placeholder="Other Diagnosis"
                                name="texticd10" txtnum="1" value="{{ @$case->diagnostic_text[1] }}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off">
                            <span class="input-group-text" id="icd10text02">Indication</span>
                        </div>
                        {{-- <input type="text" name="texticd10" txtnum="1"  value="{{@$case->diagnostic_text[1]}}"
                        class="form-control texticd10 autotext" autocomplete="off"> --}}
                    </div>

                    <div class="col-12 mt-2">
                        <div class="input-group">
                            <input type="text" class="form-control texticd10 savejson" placeholder="Other Diagnosis"
                                name="texticd10" txtnum="2" value="{{ @$case->diagnostic_text[2] }}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off">
                            <span class="input-group-text" id="icd10text03">ICD-10</span>
                        </div>
                        {{-- <input type="text" name="texticd10" txtnum="2" value="{{@$case->diagnostic_text[2]}}"
                            class="form-control texticd10 autotext" autocomplete="off"> --}}
                    </div>

                    <div class="col-12 mt-2">
                        <div class="input-group">
                            <input type="text" class="form-control texticd10 savejson" placeholder="Other Diagnosis"
                                name="texticd10" txtnum="3" value="{{ @$case->diagnostic_text[3] }}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2 "autocomplete="off">
                            <span class="input-group-text" id="icd10text04">ICD-10</span>
                        </div>
                        {{-- <input type="text" name="texticd10" txtnum="3" value="{{@$case->diagnostic_text[3]}}"
                            class="form-control texticd10 autotext" autocomplete="off"> --}}
                    </div>

                    <div class="col-12 mt-2">
                        <div class="input-group">
                            <input type="text" class="form-control texticd10 savejson" placeholder="Other Diagnosis"
                                name="texticd10" txtnum="4" value="{{ @$case->diagnostic_text[4] }}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2"autocomplete="off">
                            <span class="input-group-text autotext" id="icd10text05">ICD-10</span>
                        </div>
                        {{-- <input type="text" name="texticd10" txtnum="4" value="{{@$case->diagnostic_text[4]}}"
                            class="form-control texticd10 autotext" autocomplete="off"> --}}
                    </div>

                    <div class="col-12 mt-2">
                        <div class="input-group">
                            <input type="text" class="form-control texticd10 savejson" placeholder="Other Diagnosis"
                                name="texticd10" txtnum="5" value="{{ @$case->diagnostic_text[5] }}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2"autocomplete="off">
                            <span class="input-group-text" id="icd10text06">ICD-10</span>
                        </div>
                        {{-- <input type="text" name="texticd10" txtnum="5" value="{{@$case->diagnostic_text[5]}}"
                            class="form-control texticd10 autotext" autocomplete="off"> --}}
                    </div>
                    <div class="col-12 mt-2">
                        <div class="input-group">
                            <input type="text" class="form-control texticd10 savejson" placeholder="Other Diagnosis"
                                name="texticd10" txtnum="6" value="{{ @$case->diagnostic_text[6] }}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2"autocomplete="off">
                            <span class="input-group-text" id="icd10text07">ICD-10</span>
                        </div>
                        {{-- <input type="text" name="texticd10" txtnum="6" value="{{@$case->diagnostic_text[6]}}"
                            class="form-control texticd10 autotext" autocomplete="off"> --}}
                    </div>
                    <div class="col-12 mt-2">
                        <div class="input-group">
                            <input type="text" class="form-control texticd10 savejson" placeholder="Other Diagnosis"
                                name="texticd10" txtnum="7" value="{{ @$case->diagnostic_text[7] }}"
                                aria-label="Recipient's username" aria-describedby="basic-addon2"autocomplete="off">
                            <span class="input-group-text" id="icd10text08">ICD-10</span>
                        </div>
                        {{-- <input type="text" name="texticd10" txtnum="7" value="{{@$case->diagnostic_text[7]}}"
                            class="form-control texticd10 autotext" autocomplete="off">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
