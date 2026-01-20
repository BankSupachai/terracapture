@extends('layouts.small-scale')

@section('style')

@endsection
@section('modal')

@endsection
@section('content')
<br>
<div class="row cn mt-5">
    <div class="col-1"></div>
    <div class="col-2"><img src="{{url('public/images/Medica02_white.png')}}" class="w-50"></div>
    <div class="col">
        <label class="text-white f-15">
            © 2022 EndoINDEX by Medica Healthcare Co.,Ltd. <br>
            All rights reserved. <br>
            Product of Thailand <br>
            Contact : sales@medicahcth.com
        </label>
    </div>
    <div class="col-2 text-end"><img src="{{url('public/image/EndoINDEX white logo.png')}}" class="w-70"></div>
    <div class="col-1"></div>
</div>
<br>
<br>
<div class="row mt-5">
    <div class="col-1"></div>
    <div class="col-2">
        <u class="text-white f-15 font-weight-bold">Version</u>
    </div>
    <div class="col">
        <label class="text-white f-15 font-weight-light">6.0.5324</label>
    </div>
    <div class="col-1"></div>
</div>
<div class="row mt-3">
    <div class="col-1"></div>
    <div class="col-2">
        <u class="text-white f-15 font-weight-bold">Last Update</u>
    </div>
    <div class="col">
        <label class="text-white f-15 font-weight-light">{{date('M d, Y')}}</label>
    </div>
    <div class="col-1"></div>
</div>
<div class="row mt-3">
    <div class="col-1"></div>
    <div class="col-2">
        <u class="text-white f-15 font-weight-bold">Version Detail</u>
    </div>
    <div class="col">
        <div class="box-version">
            <div class="text-white f-15">- Fix bug</div>
            <div class="text-white f-15">- New UI Design</div>
            <div class="text-white f-15">- Update Bootstrap 5.0</div>
        </div>
    </div>
    <div class="col-1"></div>
</div>
@endsection
@section('script')

@endsection
