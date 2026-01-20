
    {!! editcard('photo', 'photo.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h3 class="card-label">
                Procedure
            </h3>


            <div class="row p-2">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 p-0" style="margin-top: 10px;">
                            <b>Hormone, Contraception </b>
                            &ensp; &ensp; &ensp; &ensp; &ensp; &ensp;
                            {{-- <a class="btn btn-checkbox btn-sm text-white" style="">
                                    <i class="far fa-check-square text-white"></i> None (-)
                                </a> --}}
                        </div>
                        @php
                            $arr[] = 'OC';
                            $arr[] = 'DMPA';
                            $arr[] = 'IUD';
                            $arr[] = 'Condom';
                            $arr[] = 'Tubal resection';
                            $arr[] = 'HRT';
                            $arr[] = 'Vasectomy';
                            $arr[] = 'Mirena';
                            $arr[] = 'POPs';
                        @endphp



                        <div class="row">
                            @foreach ($arr as $data)
                                <div class="col-6 mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input savejson_checkbox"
                                            name="box_hormonecontraception" type="checkbox" value="{{ $data }}"
                                            id="hm_{{ $data }}"
                                            {{ checkselect($data, @$case->box_hormonecontraception) }}>
                                        <label class="form-check-label" for="hm_{{ $data }}">
                                            &ensp; &ensp; {{ $data }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-12 mt-2">
                                <input type="text" class="form-control autotext savejson" name="hormonecontraception"
                                    id="hormonecontraception" placeholder="Freetext" type="text" autocomplete="off"
                                    value="{{ @$case->hormonecontraception }}">
                            </div>
                        </div>
                        @php
                            $arr00[] = 'check up';
                            $arr00[] = 'Bleeding';
                            $arr00[] = 'Pelvic pain';
                            $arr00[] = 'Pelvic mass';
                            $arr00[] = 'Post menopausal bleeding';

                            $arr00[] = 'Abnormal discharge';
                            $arr00[] = 'Post coital bleeding';

                        @endphp



                        <div class="col-12 p-0" style="margin-top: 10px;">
                            <b>Symptom </b>
                            &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp;
                            &ensp; &ensp; &ensp;

                        </div>
                        <div class="row">
                            @foreach ($arr00 as $data)
                                <div class="col-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input savejson_checkbox" type="checkbox"
                                            value="{{ $data }}" id="sym_{{ $data }}" name="box_symptom"
                                            {{ checkselect($data, @$case->box_symptom) }}>
                                        <label class="form-check-label" for="sym_{{ $data }}">
                                            &ensp; &ensp; {{ $data }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach


                            <div class="col-12 mt-2">
                                <textarea type="text" rows="2" class="form-control autotext savejson" name="symptom" id="symptom"
                                    placeholder="Freetext" type="text" autocomplete="off" value="">{{ @$case->symptom }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12" style="margin-top: 10px;">
                        <b>Clinical Data </b>
                        <div class="col-12 mt-2 m-0 px-0">
                            <textarea type="text" rows="2" class="form-control autotext savejson" name="clinicaldata"
                                id="clinicaldata" placeholder="Freetext" type="text"
                                autocomplete="off">{{ @$case->clinicaldata }}</textarea>
                        </div>
                    </div>
                    <div class="col-12" style="margin-top: 10px;">
                        <b>LMP</b>
                        </div>

                        <div class="col-12 mt-2">
                            <input type="text" class="form-control autotext savejson " id="lmp" name="lmp"
                                 placeholder="Freetext" type="text"
                                autocomplete="off" value="{{ @$case->lmp }}">
                    </div>

                    <div class="col-12" style="margin-top: 10px;">
                        <b>PAP Number</b>

                    </div>
                    <div class="col-12 mt-2">
                        <input type="text" class="form-control autotext savejson" name="papnumber" id="papnumber"
                            placeholder="PAP Number" autocomplete="off" value="{{ @$case->papnumber }}">
                    </div>
                    <div class="col-12" style="margin-top: 10px;">

                        <b>PAP Report</b>

                    </div>
                    @php
                        $arr01[] = '1 Negative for intraepithelial or malignancy';
                        $arr01[] = '2 Reactive or infiammatory cellular changes';
                        $arr01[] = '10 Fungal organism morphologically consistent with Canida spp';
                        $arr01[] = '200 ASC-US';
                        $arr01[] = '201 ASC-H';
                        $arr01[] = '250 AGC. endocervical cell';
                        $arr01[] = '251 AGC, endometrial cell';
                        $arr01[] = '252 AGC, NOS';
                        $arr01[] = '260 AGC favor neoplastic.NOS';
                        $arr01[] = '261 AGC favor neoplastic.endocervical cell';
                        $arr01[] = '262 AGC favor neoplastic, endometrial cell';
                        $arr01[] = '300 LSIL';
                        $arr01[] = '301 LSIL(HPV)';
                        $arr01[] = '302 LSIL(CIN1)';
                        $arr01[] = '303 LSIL (CIN 1 +HPV)';
                        $arr01[] = '320 HSIL';
                        $arr01[] = '321 HSIL (CIN2)';
                        $arr01[] = '322 HSIL (CIN 2+HPV)';
                        $arr01[] = '331 HSIL(CIN3)';
                        $arr01[] = '332 HSIL(CIN3+HPV)';
                        $arr01[] = '333 HSIL (Suspecious for invasion)';
                        $arr01[] = '400 AIS (Endocervical cell)';
                        $arr01[] = '500 Invasive squamous cell ca.';
                        $arr01[] = '550 Adenosquamous cell ca.';
                        $arr01[] = '600 Adenocarcinoma. NOS';
                        $arr01[] = '601 Adenocarcinoma. endocervical cell';
                        $arr01[] = '602 Adenocarcinoma, endometrial cell';
                        $arr01[] = '700 Adenocarcinoma. extrauterine origin';
                        $arr01[] = '701?Adenocarcinoma. extrauterine origin';
                        $arr01[] = '800 Positive for malignant cells (Other malignant neoplasm)';
                    @endphp


                    <div class="row">
                        <div class="col-12 mt-2">
                            <select class="form-select savejson" name="papreport" id="papreport">
                                <option value="">Select</option>
                                @foreach ($arr01 as $data)
                                    @if ($data != @$case->papreport)
                                        <option value="{{ $data }}">{{ $data }}</option>
                                    @else
                                        <option value="{{ $data }}" selected>{{ $data }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
