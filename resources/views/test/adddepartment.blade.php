
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    /* .table-w tr td:nth-child(1){width: 20%;}
    .table-w tr td:nth-child(2){width: 15%;}
    .table-w tr td:nth-child(3){width: 20%;}
    .table-w tr td:nth-child(4){width: 15%;}
    .table-w tr td:nth-child(5){width: 10%;}
    .table-w tr td:nth-child(6){width: 10%;} */
    .w-20
    {
        width: 20%;
    }
    .m-input
    {
        width: 72%;
        margin-left: 68px;
    }
</style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">{{@$type}} DEPARTMENT  </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Department Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')

<form action="{{url("admin/department")}}" method="post">
    @csrf
    <input type="hidden" name="event" value="add_edit_department">
    <input type="hidden" name="type" value="{{@$type}}">
    @if($type == 'EDIT')
        <input type="hidden" name="department_id" value="{{@$department['$department_id']}}">
    @endif
    <div class="card">
        <h5 class="p-3">DEPARTMENT</h5>
        <div class="row ">
            <div class="col-4 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Name</label>
                <input type="text" class="form-control bg-light m-input" id="basiInput" name="department_name" value="{{@$department['department_name']}}" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Status</label>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input ms-1" type="radio" name="department_status" value="active" id="flexRadioDefault1" required>
                    <label class="form-check-label ms-3" for="flexRadioDefault1">
                        Active
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="department_status" value="inactive" id="flexRadioDefault1">
                    <label class="form-check-label ms-3" for="flexRadioDefault1">
                        Inactive
                    </label>
                </div>
            </div>
        </div>
        <div class="row mb-3 me-5">
            <div class="col text-end">
                <a href="{{url("admin/department")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                <button type="submit" class="btn btn-primary btn-label waves-effect right waves-light" style="width: 10em;"><i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
            </div>
        </div>
    </div>
</form>


@endsection




@section('script')


@endsection
