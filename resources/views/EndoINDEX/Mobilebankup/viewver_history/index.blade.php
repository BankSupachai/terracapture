@extends('EndoINDEX.Mobile.layouts_mobile')

@section('style')
<style>
    body{
        background: #245788 !important;

    }
    .form-select , .form-control{
        background: #193D61;
        color: #ffffff;
        border: 0px ;
    }
    .btn-success{
        box-shadow: 0px 3px 3px #404040;
    }
</style>
@endsection
@section('modal')
@endsection


@section('content')
<div class="row" style="padding-top: 50%">
    <div class="col-12 text-center">
        <img src="{{url("public/image/EndoINDEX white logo.png")}}"  alt="" style="width: 190px;">
    </div>

</div>
<div class="row p-4">
    <div class="col-12 mt-5">
        <select name="" id="" class="form-select">
            <option value="">Hospital</option>
        </select>
    </div>
    <div class="col-12 mt-2">
        <input type="text" class="form-control" placeholder="Patient ID">
    </div>

    <div class="row mt-2 text-white">
        <div class="col-5 ">
            <hr>
        </div>
        <div class="col-2 text-center">
            or
        </div>
        <div class="col-5 "><hr></div>
    </div>
    <div class="col-12 mt-3">
        <input type="text" class="form-control" placeholder="National ID">
    </div>

    <div class="col-12 mt-5">
        <button class="btn btn-success w-100 fs-16">Search</button>
    </div>
</div>
@endsection






@section('script')

@endsection
