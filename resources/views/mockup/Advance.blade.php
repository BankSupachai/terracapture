@extends('layouts.layouts_index.main')

@section('style')
    <style>
        .border-advance {
            border: 1px solid #CED4DA;
            border-radius: 5px;

        }

        .border-advances {
            border: 1px solid #245788;
            border-radius: 5px;

        }

        .t-center {
            align-items: center;
        }

        .fw-dark {
            color: #495057;
        }
    </style>
@endsection

@section('content')




    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-pills   mb-3" role="tablist">
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link " data-bs-toggle="tab" href="#pill-justified-home-1" role="tab">
                    Normal Finding
                </a>
            </li>
            <li class="nav-item waves-effect waves-light">
                <a class="nav-link active" data-bs-toggle="tab" href="#pill-justified-profile-1" role="tab">
                    Advance Finding
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane " id="pill-justified-home-1" role="tabpanel">
                <div class="d-flex">
                    <div class="flex-shrink-0">
                        <i class="ri-checkbox-circle-fill text-success"></i>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        Raw denim you probably haven't heard of them jean shorts Austin.
                        Nesciunt tofu stumptown aliqua, retro synth master cleanse.
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="flex-shrink-0">
                        <i class="ri-checkbox-circle-fill text-success"></i>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        Too much or too little spacing, as in the example below, can make things unpleasant for the reader. The goal is to make your text as comfortable to read as possible.
                    </div>
                </div>
            </div>
            <div class="tab-pane active" id="pill-justified-profile-1" role="tabpanel">
                <div class="card ">
                    <div class="card-body">
                        <div class="col-12 mb-2 ">
                            Finding
                        </div>
                        <div class="accordion" id="default-accordion-example">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <div class="col-12  border-advance">
                                        <div class="row p-2 fs-13">
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-1">
                                                        Oropharynx
                                                    </div>
                                                    <div class="col-2">
                                                        <input class="form-check-input" type="radio" id="formCheck10" name="moss">
                                                        <label class="form-check-label " for="formCheck10" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            &ensp;  Normal &ensp;&ensp;
                                                        </label>
                                                        <input class="form-check-input" type="radio" id="formCheck11" name="moss">
                                                        <label class="form-check-label " for="formCheck11" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            &ensp;  Abnormal &ensp;&ensp;
                                                        </label>
                                                    </div>
                                                    <div class="col-9">
                                                        <span class="text-danger">
                                                            Gastric polyp with O+Isp size 0.3 cm was done by polypectomy in NBI, Kudo II without complication
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div id="collapseOne" class="accordion-collapse fs-13 collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                <div class="col-12  border-advances">
                                                    <div class="row p-2 fw-dark">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <span>Lesion 1</span>
                                                            <span class="text-danger"><u>Cancel</u></span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Type</label>
                                                                    <input type="password" class="form-control" placeholder="Polyp"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-5 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Diagnosis</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Gastric Polyp" id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-3 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Morphology Type</label>
                                                                    <input type="password" class="form-control" placeholder="0+Isp"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Size (cm.)</label>
                                                                    <input type="password" class="form-control" placeholder="0.3"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Treatment</label>
                                                                    <input type="password" class="form-control" placeholder="Done"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">By</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Polypectomy" id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Clip</label>
                                                                    <input type="password" class="form-control" placeholder="Done"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Traction clip</label>
                                                                    <input type="password" class="form-control" placeholder="Not use"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Detect from</label>
                                                                    <input type="password" class="form-control" placeholder="Not use"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Chromo</label>
                                                                    <input type="password" class="form-control" placeholder="Select"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Kudo type</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Sano type</label>
                                                                    <input type="password" class="form-control" placeholder="||"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">NICE class</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">JNET class</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2" style="place-self: center;">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault" id="flexRadioDefault22">
                                                                    <label class="form-check-label" for="flexRadioDefault22">
                                                                        None
                                                                    </label>

                                                                </div>

                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Complication</label>
                                                                    <select class="form-select mb-3"
                                                                        aria-label="Default select example">
                                                                        <option selected>select</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Note</label>
                                                                    <input type="password" class="form-control" id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between px-4 pb-3">
                                                <button type="button" class="btn btn-soft-secondary waves-effect"> <i
                                                        class="ri-add-fill"></i> Add</button>
                                                <button type="button" class="btn btn-success waves-effect"> Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingtwo">
                                    <div class="col-12  border-advances">
                                        <div class="row p-2 fs-13">
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-1">
                                                        Esophagus
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-check-input" type="radio" id="formCheck12" name="bank">
                                                        <label class="form-check-label " for="formCheck12" data-bs-toggle="collapse"
                                                            data-bs-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                                            &ensp;  Normal &ensp;&ensp;
                                                        </label>
                                                        <input class="form-check-input" type="radio" id="formCheck13" name="bank">
                                                        <label class="form-check-label" for="formCheck13" data-bs-toggle="collapse"
                                                            data-bs-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                                                            &ensp;  Abnormal
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div id="collapsetwo" class="accordion-collapse fs-13 collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                <div class="col-12  border-advances">
                                                    <div class="row p-2 fw-dark">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <span>Lesion 2</span>
                                                            <span class="text-danger"><u>Cancel</u></span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Type</label>
                                                                    <input type="password" class="form-control" placeholder="Polyp"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-5 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Diagnosis</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Gastric Polyp" id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-3 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Morphology Type</label>
                                                                    <input type="password" class="form-control" placeholder="0+Isp"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Size (cm.)</label>
                                                                    <input type="password" class="form-control" placeholder="0.3"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Treatment</label>
                                                                    <input type="password" class="form-control" placeholder="Done"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">By</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Polypectomy" id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Clip</label>
                                                                    <input type="password" class="form-control" placeholder="Done"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Traction clip</label>
                                                                    <input type="password" class="form-control" placeholder="Not use"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Detect from</label>
                                                                    <input type="password" class="form-control" placeholder="Not use"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Chromo</label>
                                                                    <input type="password" class="form-control" placeholder="Select"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Kudo type</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Sano type</label>
                                                                    <input type="password" class="form-control" placeholder="||"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">NICE class</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">JNET class</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2" style="place-self: center;">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault" id="flexRadioDefault22">
                                                                    <label class="form-check-label" for="flexRadioDefault22">
                                                                        None
                                                                    </label>

                                                                </div>

                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Complication</label>
                                                                    <select class="form-select mb-3"
                                                                        aria-label="Default select example">
                                                                        <option selected>select</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Note</label>
                                                                    <input type="password" class="form-control" id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between px-4 pb-3">
                                                <button type="button" class="btn btn-soft-secondary waves-effect"> <i
                                                        class="ri-add-fill"></i> Add</button>
                                                <button type="button" class="btn btn-success waves-effect"> Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <div class="col-12  border-advances">
                                        <div class="row p-2 fs-13">
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-1">
                                                        EG Junction
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-check-input" type="radio" id="formCheck14" name="dent">
                                                        <label class="form-check-label " for="formCheck14" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                            &ensp;  Normal &ensp;&ensp;
                                                        </label>
                                                        <input class="form-check-input" type="radio" id="formCheck15" name="dent">
                                                        <label class="form-check-label" for="formCheck15" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                                            &ensp;  Abnormal
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div id="collapseThree" class="accordion-collapse fs-13 collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                <div class="col-12  border-advances">
                                                    <div class="row p-2 fw-dark">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <span>Lesion 6</span>
                                                            <span class="text-danger"><u>Cancel</u></span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Type</label>
                                                                    <input type="password" class="form-control" placeholder="Polyp"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-5 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Diagnosis</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Gastric Polyp" id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-3 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Morphology Type</label>
                                                                    <input type="password" class="form-control" placeholder="0+Isp"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Size (cm.)</label>
                                                                    <input type="password" class="form-control" placeholder="0.3"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Treatment</label>
                                                                    <input type="password" class="form-control" placeholder="Done"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">By</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Polypectomy" id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Clip</label>
                                                                    <input type="password" class="form-control" placeholder="Done"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Traction clip</label>
                                                                    <input type="password" class="form-control" placeholder="Not use"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Detect from</label>
                                                                    <input type="password" class="form-control" placeholder="Not use"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Chromo</label>
                                                                    <input type="password" class="form-control" placeholder="Select"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Kudo type</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Sano type</label>
                                                                    <input type="password" class="form-control" placeholder="||"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">NICE class</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">JNET class</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2" style="place-self: center;">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault" id="flexRadioDefault22">
                                                                    <label class="form-check-label" for="flexRadioDefault22">
                                                                        None
                                                                    </label>

                                                                </div>

                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Complication</label>
                                                                    <select class="form-select mb-3"
                                                                        aria-label="Default select example">
                                                                        <option selected>select</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Note</label>
                                                                    <input type="password" class="form-control" id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between px-4 pb-3">
                                                <button type="button" class="btn btn-soft-secondary waves-effect"> <i
                                                        class="ri-add-fill"></i> Add</button>
                                                <button type="button" class="btn btn-success waves-effect"> Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingfour">
                                    <div class="col-12  border-advances">
                                        <div class="row p-2 fs-13">
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-1">
                                                        Cardia
                                                    </div>
                                                    <div class="col-3">
                                                        <input class="form-check-input" type="radio" id="formCheck16" name="benz">
                                                        <label class="form-check-label " for="formCheck16" data-bs-toggle="collapse"
                                                            data-bs-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                                                            &ensp;  Normal &ensp;&ensp;
                                                        </label>
                                                        <input class="form-check-input" type="radio" id="formCheck17" name="benz">
                                                        <label class="form-check-label" for="formCheck17" data-bs-toggle="collapse"
                                                            data-bs-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                                                            &ensp;  Abnormal
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div id="collapsefour" class="accordion-collapse fs-13 collapse"
                                            aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
                                            <div class="accordion-body">
                                                <div class="col-12  border-advances">
                                                    <div class="row p-2 fw-dark">
                                                        <div class="col-12 d-flex justify-content-between">
                                                            <span>Lesion 2</span>
                                                            <span class="text-danger"><u>Cancel</u></span>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-3 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Type</label>
                                                                    <input type="password" class="form-control" placeholder="Polyp"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-5 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Diagnosis</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Gastric Polyp" id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-3 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Morphology Type</label>
                                                                    <input type="password" class="form-control" placeholder="0+Isp"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Size (cm.)</label>
                                                                    <input type="password" class="form-control" placeholder="0.3"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Treatment</label>
                                                                    <input type="password" class="form-control" placeholder="Done"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">By</label>
                                                                    <input type="password" class="form-control"
                                                                        placeholder="Polypectomy" id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Clip</label>
                                                                    <input type="password" class="form-control" placeholder="Done"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Traction clip</label>
                                                                    <input type="password" class="form-control" placeholder="Not use"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Detect from</label>
                                                                    <input type="password" class="form-control" placeholder="Not use"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Chromo</label>
                                                                    <input type="password" class="form-control" placeholder="Select"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Kudo type</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Sano type</label>
                                                                    <input type="password" class="form-control" placeholder="||"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">NICE class</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">JNET class</label>
                                                                    <input type="password" class="form-control" placeholder="|"
                                                                        id="basiInput">
                                                                </div>
                                                            </div>
                                                            <div class="col-1 mt-2" style="place-self: center;">
                                                                <div class="form-check mb-2">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="flexRadioDefault" id="flexRadioDefault22">
                                                                    <label class="form-check-label" for="flexRadioDefault22">
                                                                        None
                                                                    </label>

                                                                </div>

                                                            </div>
                                                            <div class="col-4 mt-2">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Complication</label>
                                                                    <select class="form-select mb-3"
                                                                        aria-label="Default select example">
                                                                        <option selected>select</option>
                                                                        <option value="1">One</option>
                                                                        <option value="2">Two</option>
                                                                        <option value="3">Three</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-9">
                                                                <div>
                                                                    <label for="basiInput" class="form-label">Note</label>
                                                                    <input type="password" class="form-control" id="basiInput">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between px-4 pb-3">
                                                <button type="button" class="btn btn-soft-secondary waves-effect"> <i
                                                        class="ri-add-fill"></i> Add</button>
                                                <button type="button" class="btn btn-success waves-effect"> Confirm</button>
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



    {{-- <div class="accordion" id="default-accordion-example">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    How to create a group booking ?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#default-accordion-example">
                <div class="accordion-body">
                    Although you probably won’t get into any legal trouble if you do it just once, why risk it? If you made
                    your subscribers a promise, you should honor that. If not, you run the risk of a drastic increase in opt
                    outs, which will only hurt you in the long run.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Why do we use it ?
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#default-accordion-example">
                <div class="accordion-body">
                    No charges are put in place by SlickText when subscribers join your text list. This does not mean
                    however that charges 100% will not occur. Charges that may occur fall under part of the compliance
                    statement stating "Message and Data rates may apply."
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Where does it come from ?
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#default-accordion-example">
                <div class="accordion-body">
                    Now that you have a general idea of the amount of texts you will need per month, simply find a plan size
                    that allows you to have this allotment, plus some extra for growth. Don't worry, there are no mistakes
                    to be made here. You can always upgrade and downgrade.
                </div>
            </div>
        </div>
    </div> --}}
@endsection
