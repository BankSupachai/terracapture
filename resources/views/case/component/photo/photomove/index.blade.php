@extends('layouts.layoutsManagePhoto')
<link href="{{ url('public/css/home/photomove.css') }}" rel="stylesheet" type="text/css" />

@section('Title')
Move Photo
@endsection
@section('style')
<style>

    .text-sort-blue {
        color: #325684;
    }

    .bg-sortphoto {
        background: #ffffffa6;
        /* background-image:url({{ url('public/image/bg-sortphoto.png') }}) */
    }

    .tbl-width thead th:nth-child(1),
    .tbl-width thead th:nth-child(2) {
        width: 10%
    }

    .tbl-width thead th:nth-child(3),
    .tbl-width thead th:nth-child(4),
    .tbl-width thead th:nth-child(5) {
        width: 20%
    }

    .tbl-width thead th:nth-child(6) {
        width: 10%
    }

    .text-blue-table {
        color: #405189;
    }

    .btn-dark-primary {
        background: #245788;
        color: #ffffff;
    }

    .btn-dark-primary:hover {
        background: #1a3d5e;
        color: #ffffff;
    }
</style>
@endsection
@section('content')
{{-- @include('capture.imagesort.confirm_modal') --}}

@livewire('Photo.photomove', ['cid' => $cid])



@endsection

    {{-- <link rel="stylesheet" href="{{url('public/extra/photomove/bootstrap.min.css')}}"> --}}



