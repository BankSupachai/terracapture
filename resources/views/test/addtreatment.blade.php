
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    /* .table-w tr td:nth-child(1){width: 20%;}
    .table-w tr td:nth-child(2){width: 15%;}
    .table-w tr td:nth-child(3){width: 20%;}
     */

</style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">ADD TREATMENT COVERAGE  SETTING HOSPITAL</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Procedure Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <h4>Treatment Coverage</h4>
        <div class="row m-0 p-3 ">
            <div class="col-auto " style="align-self: center;">
                <label for="exampleInputEmail1" class="form-label ">Name</label>
            </div>
            <div class="col-9">
                <input type="text" class="form-control" name="exampleInputEmail1" value="">
            </div>
        </div>
        <div class="col text-end">
            <button type="button" class="btn btn-primary btn-label waves-effect right waves-light "><i class=" ri-arrow-right-s-line label-icon align-middle fs-16 ms-2"></i> Save</button>
        </div>
    </div>
</div>
@endsection




@section('script')


@endsection
