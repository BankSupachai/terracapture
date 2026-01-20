@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')

@endsection
@section('modal')

@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{url('patient_import')}}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <input type="file" name="file" id="" required class="form-control">
            <button type="submit" class="btn btn-success w-100 mt-3">submit</button>
        </form>
    </div>
</div>
@endsection
@section('script')


@endsection
