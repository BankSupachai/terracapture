@extends('layouts.layoutsManagePhoto')
@section('Title')
    SnapShot Video
@endsection
@section('style')
    <style>
        .p-8 {
            padding: 4em;
        }

        .number-cap {
            color: white;
            position: absolute;
            font-size: 30px;
            top: 20%;
            left: 50%
        }

        .box-capture-list {
            height: 70vh;
            overflow: auto;
        }
    </style>
@endsection

@section('content')
    <div class="row  p-8 m-0">
        <div class="card">
            <div class="row p-3">
                <div class="col-12 mb-3 d-flex justify-content-between">
                    <span class="text-sort-blue h3">Snapshot</span>
                    <div class="">
                        <a href="" class="btn btn-danger btn-label waves-effect right w-lg waves-light"><i
                                class="ri-arrow-go-back-line label-icon align-middle fs-16 ms-2"></i> Cancel</a>
                        <button type="button" id="save_file"
                            class="btn btn-dark-primary btn-label waves-effect right w-lg waves-light"><i
                                class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-8">
                        <img src="{{ url('public/image/mockupcrop.png') }}" width="700px" alt="">
                        <div class="col-12 mt-3 mb-2">
                            <span class="h3" style="color: #212529;">Image Crop</span>
                        </div>
                        <div class="row ">
                            <div class="col-7">
                                <select class="form-select " style="border: 0px;" id="">
                                    <option value="">Autocrop</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-light">
                                    <span style="color: #707070"><i class=" ri-camera-fill"></i> Snapshot</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class='box-capture-list p-2'>
                            <img src="{{ url('public/image/mockupcrop.png') }}" class="w-100">
                            <span class='number-cap'>1</span> <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-12 text-center" style="position: absolute; bottom: 20px; color: #ffffff80;">
        © 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
    </div>
@endsection

@section('script')
@endsection
