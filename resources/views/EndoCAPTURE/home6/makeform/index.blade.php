@extends('layouts.main')
@section('title', 'Make')

@section('style')
@endsection

@section('modal')
@endsection

@section('tab')
<b class="text-light ml-5">Make</b>
@endsection

@section('content')
<div class="row m-0">
    <div class="col-lg"></div>
    <div class="col-lg-9">
        <div class="card mt-5">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Select</th>
                    </tr>
                    @foreach ($form as $f)
                    <tr>
                        <td>{{$f->form_id}}</td>
                        <td>{{$f->form_file}}</td>
                        <td>
                            <div class="btn-group shadow" role="group" aria-label="Basic example">
                                <a href="{{url('makeform')}}/{{$f->form_id}}" class="btn btn-sm btn-primary waves-effect waves-light shadow-none"><i class="mdi mdi-magnify"></i></a>
                                <button type="button" class="btn btn-sm btn-warning waves-effect waves-light shadow-none"><i class="mdi mdi-pencil-box-multiple-outline"></i></button>
                                <button type="button" class="btn btn-sm btn-danger waves-effect waves-light shadow-none"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg"></div>
</div>
@endsection

@section('script')
@endsection
