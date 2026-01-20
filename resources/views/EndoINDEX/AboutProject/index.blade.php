{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('style')


<style>

</style>
@endsection



@section('modal')

@endsection






@section('title-left')
    {{-- <h4 class="mb-sm-0">ABOUT</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">About</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
@endsection
@section('content')

<div class="card p-3">
    <div class="card-body">
        <div class="row">
            <div class="col-1">
                <img src="{{url("public/image/medica.png")}}" alt="">
            </div>
            <div class="col-3 align-self-center ms-5">
                   <p class="mt-1">© EndoINDEX by Medica Healthcare Co.,Ltd. </p>
                   <p class="mt-1">All rights reserved. </p>
                   <p class="mt-1">Product of Thailand </p>
                   <p class="mt-1"> Contact : official@medicahcth.com </p>

            </div>
            <div class="col-7 text-end align-self-center">
                <img src="{{url("public/image/logo_index.png")}}" width="200px" alt="">

            </div>
        </div>


        <div class="row mt-2">
            <div class="col-6">
                <input type="text" class="form-control bg-gray-input" placeholder="Product">
                <div class=" p-3">
                    <div class="row ">
                        <div class="col-6">
                            <span class="text-color-index">Name</span>
                        </div>
                        <div class="col-6 text-index-darkness">
                            Endoindex
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <span class="text-color-index">Version</span>
                        </div>
                        <div class="col-6 text-index-darkness">
                            {{$files[0]['version']}}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <span class="text-color-index">Release Date</span>
                        </div>
                        <div class="col-6 text-index-darkness">
                            {{$files[0]['date']}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <input type="text" class="form-control bg-gray-input" placeholder="Developer">
                <div class=" p-3">
                    <div class="row ">
                        <div class="col-6">
                            <span class="text-color-index">Name</span>
                        </div>
                        <div class="col-6 text-index-darkness">
                            Medica Healthcare
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <span class="text-color-index">Email</span>
                        </div>
                        <div class="col-6 text-index-darkness">
                            official@medicahcth.com
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <span class="text-color-index">Company Website</span>
                        </div>
                        <div class="col-6 text-index-darkness">
                            https://medicahealthcare.co
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">


                <input type="text" class="form-control bg-gray-input" placeholder="Release Notes">

                @foreach ($files as $data)


                <div class="col-12 px-3 mt-3 text-color-index">
                   <span class="text-color-index h5">{{@$data['version']}} ({{@$data['date']}})</span>

                    <span class="text-dark fw-bold">{!!@$data['about']!!}</span>
                </div>


                {{-- <div class="col-12 px-5  mt-2">
                   <span class="text-dark fw-bold">New features :</span>
                </div>
                <div class="col-12 px-5 ms-4">
                    <p class="mb-2">• &ensp; EndoINDEX is now available support on ADFS Authenticator (login/logout)</p>
                    <p class="mb-2">• &ensp; Log data is now available for admin menu</p>
                    <p class="mb-2">• &ensp; In-Charge Monitor is now available for management menu</p>
                </div>

                <div class="col-12 px-5  mt-3">
                    <span class="text-dark fw-bold">Improvements :</span>
                 </div>
                 <div class="col-12 px-5 ms-4">
                     <p class="mb-2">• &ensp; On Case list page, Remaining time to auto refresh was added</p>
                     <p class="mb-2">• &ensp; On Case list page, It will pull data from server to update to client for improve semi-decentralize system</p>
                     <p class="mb-2">• &ensp; On Camera page, When click on Make report, Case list, and Back button it will trigger for send photo to server that will increase a speed data transmission.</p>
                 </div>

                 <div class="col-12 px-5  mt-3">
                    <span class="text-dark fw-bold">Bug fixes :</span>
                 </div>
                 <div class="col-12 px-5 ms-4">
                     <p class="mb-2">• &ensp; Fixed a bug that sometimes photo not show when upload on Report physician page.</p>
                 </div>
                 <div class="col-12 px-3 mt-3 text-color-index">
                    V6.0.8 (02-01-2024)
                </div>
                <div class="col-12 px-5  mt-3">
                    <span class="text-dark fw-bold">Bug fixes :</span>
                 </div>
                 <div class="col-12 px-5 ms-4">
                     <p class="mb-2">• &ensp; Fixed a bug that send to status is wrong on Case list page. </p>
                 </div> --}}

                 @endforeach

            </div>


        </div>
    </div>
</div>




@endsection










@section('scripts')

@endsection


