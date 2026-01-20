
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
    <h4 class="mb-sm-0">{{@$type}} ROOM </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Room Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')


<div class="card">
    <form action="{{url("admin/room")}}" method="post">
        @csrf
        <input type="hidden"  name="type" value="{{@$type}}">
        @if ($type == 'EDIT')
            <input type="hidden" name="room_id" value="{{@$room['room_id']}}">
        @endif
        <h5 class="p-3">Room</h5>
        <div class="row ">
            <div class="col-lg-4 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Name</label>
                <input type="text" class="form-control bg-light m-input" name="room_name" id="basiInput" value="{{@$room['room_name']}}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Status</label>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input ms-1" type="radio" name="flexRadioDefault1" name="room_ready" value="0" id="flexRadioDefault1" @if($type == 'ADD') {{'checked'}}  @endif @isset($room['room_ready']) @if($room['room_ready'] == '0') {{'checked'}} @else {{''}} @endif @endisset>
                    <label class="form-check-label ms-3 " for="flexRadioDefault1">
                        Active
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="flexRadioDefault1" name="room_ready" value="1" id="flexRadioDefault1" @isset($room['room_ready']) @if($room['room_ready'] == '1') {{'checked'}} @else {{''}} @endif @endisset>
                    <label class="form-check-label ms-3" for="flexRadioDefault1">
                        Inactive
                    </label>
                </div>
            </div>
        </div>


        <div class="row ms-5 mt-5 mb-5">
            <div class="col-6 border p-5">
                @php
                    $room_department = ($type == 'EDIT') ? get_department(intval($room['room_id']), 'department_room') : [];
                @endphp
                <h4>Department</h4>
                @isset($departments)
                    @foreach ($departments as $d)
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="department_room[]" id="formCheck1" value="{{@$d['department_id']}}" @if(in_array($d['department_name'], $room_department)) {{'checked'}}  @endif>
                            <label class="form-check-label" for="formCheck1">
                                &nbsp; {{@$d['department_name']}}
                            </label>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
        <div class="row mb-3 me-5">
            <div class="col text-end">
                <a href="{{url("admin/room")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                <button type="submit" class="btn btn-primary btn-label waves-effect right waves-light" style="width: 10em;"><i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
            </div>
        </div>
    </form>
</div>
@endsection


@section('script')


@endsection
