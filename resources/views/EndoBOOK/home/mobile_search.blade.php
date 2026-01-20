@extends('layouts.book_mobile')
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
            SEARCH
        </h4>
    </div>
    <div class="col-lg-12 mt-5">
        <div class="card card-calendar-detail">
            <div class="card-body pl-0 pr-0 text-light">
                <div class="row m-0">
                    <div class="col-12 h2 text-center">
                        SEARCH
                    </div>
                </div>
                <div class="row m-0 mt-2">
                    <div class="col-12"><input type="text" name="" id="" class="form-control"></div>
                    <div class="col-12 mt-5 text-center"><button class="btn btn-primary">Enter</button></div>
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
