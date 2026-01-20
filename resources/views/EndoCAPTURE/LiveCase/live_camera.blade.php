@extends('layouts.index_empty')

@section('style')
    <style>
        :root {
            --vz-body-bg: #000;

        }
        body{overflow: hidden;}

        .box-livecamera-left {
            background: #222529;
            height: 100vh;
        }
        .text-case-detail{
            color: #ffffff80;
        }
        .fs-14{font-size: 14px;}
        .fs-12{font-size: 12px;}

    </style>
@endsection

@section('content')
    <div class="row m-0 p-0">
        <div class="col-2 m-0 p-0">

            <div class="box-livecamera-left p-4 ">
                <div class="col-12 p-2">
                    <a href="{{ url('mockup/livecase') }}">
                        <i class="ri-arrow-go-back-fill ri-lg"></i>
                    </a>

                </div>
                <div class="col-12 mt-3">
                    <span class="h4">Performing new technique
                        ESD with needle knife </span>

                </div>
                <div class="col-12 mt-3" style="height: 30vh">
                    <span class="h5">MD.Suratchanut Chitrat  </span>
                </div>
                <div class="col-12 mt-3 mb-2">
                    <span class="text-case-detail fs-14 pb-3">Case Detail <br></span>
                </div>
                <div class="col-12" style="height: 41vh">
                    <span class="text-case-detail fs-12 ">
                        Patient ID : Anonymous <br>
                        Patient Name : Anonymous <br>
                        Gender : Anonymous <br>
                        Age : Anonymous <br>
                        Pre-Diagnosis : Abdominal Pain <br>
                        Procedure : EGD <br>
                        Start time : 09:00
                    </span>
                </div>
                <div class="col-12 m-0 p-0" >
                    <img src="{{url("public/image/endo_index.png")}}" width="100px"  alt="">
                </div>
            </div>
        </div>
        <div class="col-10 m-0 py-5">
            <img src="{{url("public/image/fortest01.png")}}" width="100%"  alt="">
        </div>
    </div>
@endsection

@section('scirpt')
@endsection
