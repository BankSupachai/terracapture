@extends('layouts.layout_booking_mobile')
@section('title', 'EndoBook')
@section('style')
    <link href="{{url('')}}/public/css/book/home_mobile.css" rel="stylesheet" type="text/css" />
@endsection

@section('modal')
@endsection

@section('content')


{{--  --}}

<div class="row m-0 mt-5">
    <div class="col-12">
        <h4 class="mb-0">
            CREATE BOOKING
        </h4>
    </div>
    <div class="col-lg-12 mt-5">
        <div class="card card-calendar-detail">
            <div class="card-body pl-0 pr-0 text-light">
                <div class="row m-0">
                    <div class="col-12 h4">
                        CREATE BOOKING
                    </div>
                </div>
                <div class="row m-0 mt-2">
                    <div class="col-4">Doctor</div>
                    <div class="col-8">นาย ทดสอบ งิงิ</div>
                </div>
                <div class="row m-0 mt-2">
                    <div class="col-4">Doctor</div>
                    <div class="col-8">
                        <select name="" id="" class="form-control form-control-sm"></select>
                    </div>
                </div>
                <div class="row m-0 mt-2">
                    <div class="col-4">Date Time</div>
                    <div class="col-4"><input type="datetime-local" class="form-control form-control-sm" /></div>
                    <div class="col-4"><input type="datetime-local" class="form-control form-control-sm"></div>
                </div>
                <div class="row m-0 mt-2">
                    <div class="col-4">Comment</div>
                    <div class="col-8">
                        <textarea name="" id="" rows="10" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
                <div class="row m-0 mt-4">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <button class="btn btn-primary btn-sm w-100">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br>
{{--  --}}
@endsection

@section('script')
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

@endsection
