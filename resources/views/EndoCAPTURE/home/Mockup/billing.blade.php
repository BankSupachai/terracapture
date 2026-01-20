@extends('layouts.layouts_ipad.layouts_Newipad')

@section('modal')
@endsection


@section('content')
    @include('EndoCAPTURE.home.Mockup.componentnurse.layoutsheader')



    <!-- Base Example -->
    <div class="accordion" id="default-accordion-example">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Procedure Billing (Additional)

                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#default-accordion-example">
                <div class="accordion-body">
                    <div class="row m-0">
                        <div class="card-ipad font-gray p-3">
                            {{-- <div class="col-12">
                                <span class="fs-14">Procedure Billing (Additional)</span>
                            </div> --}}
                            <div class="row">
                                <div class="col-lg-10 mt-3">
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" class="form-control form-control-dark"
                                                placeholder="Code or Description">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-icon btn-secondary"><i
                                                    class="ri-search-line"></i></button>
                                        </div>

                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            45.23
                                        </div>
                                        <div class="col-8">
                                            Colonoscopic with biopsy
                                        </div>
                                        <div class="col-2">
                                            <i class="ri-delete-bin-5-fill text-danger ms-1 ri-2x"></i>
                                        </div>
                                        <div class="col-2">
                                            45.23
                                        </div>
                                        <div class="col-8">
                                            Colonoscopic with polypectomy cancer
                                        </div>
                                        <div class="col-2">
                                            <i class="ri-delete-bin-5-fill text-danger ms-1 ri-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-end">
                                    <button class="btn btn-success w-100" style="height: 100px;">
                                        <i class="ri-dossier-fill ri-2x"></i>
                                        <span class="d-block fs-16">Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-12 m-0 p-0">
                                <table class="table table-nowrap text-white table-borderless mb-0 ">
                                    <thead>
                                        <tr class="bg-softless-dark font-gray ">
                                            <td>Procedure Code</td>
                                            <td style="width: 45%;">Procedure Detail (check box)</td>
                                            <td>Procedure Description</td>

                                        </tr>
                                    </thead>
                                    <tbody class="font-gray " style="background: #25292D;">
                                        <tr>
                                            <td>45.23</td>
                                            <td>Biopsy</td>
                                            <td>Colonoscopy with biopsy</td>
                                        </tr>
                                        <tr>
                                            <td>45.23</td>
                                            <td>Polypectomy (large intestine)</td>
                                            <td>Endoscopic polypectomy of large intestine</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Accessory Billing (Additional)
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#default-accordion-example">
                <div class="accordion-body">
                    <div class="row m-0  mt-3 ">
                        <div class="card-ipad font-gray p-3">
                            {{-- <div class="col-12">
                                <span class="fs-14">Accessory Billing (Additional)</span>
                            </div> --}}
                            <div class="row">
                                <div class="col-lg-10 mt-3">
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" class="form-control form-control-dark" placeholder="Code or Description">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-icon btn-secondary"><i class="ri-search-line"></i></button>
                                        </div>

                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            13532
                                        </div>
                                        <div class="col-8">
                                            Endoloop
                                        </div>
                                        <div class="col-2">
                                            <i class="ri-delete-bin-5-fill text-danger ms-1 ri-2x"></i>
                                        </div>
                                        <div class="col-2">
                                            5343
                                        </div>
                                        <div class="col-8">
                                            Distal Cap
                                        </div>
                                        <div class="col-2">
                                            <i class="ri-delete-bin-5-fill text-danger ms-1 ri-2x"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-end">
                                    <button class="btn btn-success w-100" style="height: 100px;">
                                        <i class="ri-dossier-fill ri-2x"></i>
                                        <span class="d-block fs-16">Save</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row m-0 bg-softless-dark ">
        <div class="col-12 m-0 p-0">
            <table class="table table-nowrap text-white table-borderless mb-0 ">
                <thead>
                    <tr class="bg-softless-dark font-gray ">
                        <td>Accessory Code</td>
                        <td style="width: 45%;">Accessory Description</td>
                        <td>Volume</td>

                    </tr>
                </thead>
                <tbody class="font-gray " style="background: #25292D;">
                    <tr>
                        <td>13532</td>
                        <td>Biopsy</td>
                        <td><input type="text" class="form-control form-control-superdark w-25"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <div class="row m-0 bg-softless-dark ">
        <div class="col-12 m-0 p-0">
            <table class="table table-nowrap text-white table-borderless mb-0 ">
                <thead>
                    <tr class="bg-softless-dark font-gray ">
                        <td>Accessory Code</td>
                        <td style="width: 45%;">Accessory Description</td>
                        <td>Volume</td>

                    </tr>
                </thead>
                <tbody class="font-gray " style="background: #25292D;">
                    <tr>
                        <td>13532</td>
                        <td>Biopsy</td>
                        <td><input type="text" class="form-control form-control-superdark w-25"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
@endsection


@section('script')
@endsection
