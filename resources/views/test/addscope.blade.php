
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
    .m-input1{
        width: 76%;
        margin-left: 21px;
    }
    .m-input2{
        width: 77%;
        margin-left: 84px;
    }
    .bg-setting{
        /* background: #b3b3b3; */
    }

    .bg-setting:disabled{
        background: #b3b3b3;
    }
</style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">{{@$type}} SCOPE  </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Scope Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')


<div class="card">
    <h5 class="p-3">Scope</h5>
    <form action="{{url("admin/scope")}}" method="post">
        @csrf
        <input type="hidden"  name="type" value="{{@$type}}">
        @if ($type == 'EDIT')
            <input type="hidden" name="scope_id" value="{{@$scope['scope_id']}}">
        @endif
        <div class="row ">
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Name</label>
                <input type="text" class="form-control bg-light m-input" id="basiInput" name="scope_name" value="{{@$scope['scope_name']}}" required>
            </div>
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Brand</label>
                <input type="text" class="form-control bg-light ms-5" id="basiInput" name="scope_brand" value="{{@$scope['scope_band']}}" required>
            </div>
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Model</label>
                <input type="text" class="form-control bg-light m-input2" id="basiInput" name="scope_model" value="{{@$scope['scope_model']}}" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label  text-nowrap">Serial number</label>
                <input type="text" class="form-control bg-light ms-3" id="basiInput" name="scope_serial" value="{{@$scope['scope_serial']}}" required>
            </div>

            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">RFID Code</label>
                <input type="text" class="form-control bg-light m-input1" id="basiInput" name="scope_rfid" value="{{@$scope['scope_rfid']}}">
            </div>
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Installation date</label>
                <input type="date" class="form-control bg-light ms-3" name="scope_installdate" required value="{{@$scope['scope_installdate']}}">
                {{-- <input type="text" class="form-control bg-light ms-3" id="basiInput" name="scope_installdate"> --}}
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Status</label>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="scope_status" value="active" id="flexRadioDefault1"  @if($type == 'ADD') {{'checked'}}  @endif @isset($scope['scope_status']) @if($scope['scope_status'] == 'available') {{'checked'}} @else {{''}} @endif @endisset required>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Active
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="scope_status" value="inactive" id="flexRadioDefault2" @isset($scope['scope_status']) @if($scope['scope_status'] == 'disable' || $scope['scope_status'] == 'repair') {{'checked'}} @else {{''}} @endif @endisset>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Inactive
                    </label>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Setting</label>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="scope_setting" value="auto_crop" id="flexRadioDefault3" onchange="toggle_inp(this.value)" @if($type == 'ADD') {{'checked'}}  @endif @if(isset($scope['scope_top']) == false && isset($scope['scope_bottom']) == false && isset($scope['scope_left']) == false && isset($scope['scope_right']) == false) {{'checked'}} @else {{''}} @endif   required>
                    <label class="form-check-label text-nowrap" for="flexRadioDefault3">
                        Auto Crop
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="scope_setting" value="manual_crop" id="flexRadioDefault4" onchange="toggle_inp(this.value)" @if(isset($scope['scope_top']) || isset($scope['scope_bottom']) || isset($scope['scope_left']) || isset($scope['scope_right'])) {{'checked'}} @else {{''}} @endif>
                    <label class="form-check-label text-nowrap" for="flexRadioDefault4">
                        Manual Crop
                    </label>
                </div>
            </div>
        </div>
        <div class="row mt-3" style="margin-left: 10em;">
            <div class="col-2">
                <label for="basicInput" class="form-label text-nowrap ">Top</label>
            </div>
            <div class="col-2">
                <label for="basicInput" class="form-label text-nowrap ">Bottom</label>
            </div>
            <div class="col-2">
                <label for="basicInput" class="form-label text-nowrap ">Left</label>
            </div>
            <div class="col-2">
                <label for="basicInput" class="form-label text-nowrap ">Right</label>
            </div>
        </div>
        <div class="row" style="margin-left: 9em;">
            <div class="col-2">
                <input type="text" class="form-control bg-setting ms-3" name="scope_top" id="top_crop" value="{{@$scope->scope_top}}" disabled>
            </div>
            <div class="col-2">
                <input type="text" class="form-control bg-setting ms-3" name="scope_bottom" id="bt_crop" value="{{@$scope->scope_bottom}}"  disabled>
            </div>
            <div class="col-2">
                <input type="text" class="form-control bg-setting ms-3" name="scope_left" id="left_crop" value="{{@$scope->scope_left}}" disabled>
            </div>
            <div class="col-2">
                <input type="text" class="form-control bg-setting ms-3" name="scope_right" id="right_crop" value="{{@$scope->scope_right}}" disabled>
            </div>
        </div>
        <div class="row ms-5 mt-3 mb-5">
            <div class="col-9 border p-5">
                @php
                    $scope_department = ($type == 'EDIT') ? get_department(intval($scope['scope_id']), 'department_scope') : [];
                @endphp
                <h4>Department</h4>
                @isset($departments)
                    @foreach ($departments as $d)
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="department_scope[]" id="formCheck1" value="{{@$d['department_id']}}" @if(in_array($d['department_name'], $scope_department)) {{'checked'}}  @endif>
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
                <a href="{{url("admin/scope")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                <button type="submit" class="btn btn-primary btn-label waves-effect right waves-light" style="width: 10em;"><i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
            </div>
        </div>
    </form>
</div>
@endsection




@section('script')
<script>
    function toggle_inp(radio_id){
        var is_disabled = ''
        if(radio_id == 'manual_crop'){
            is_disabled = false
        } else {
            is_disabled = true
        }
        // console.log(radio_id, is_disabled);

        $('#top_crop').prop('disabled', is_disabled)
        $('#bt_crop').prop('disabled', is_disabled)
        $('#left_crop').prop('disabled', is_disabled)
        $('#right_crop').prop('disabled', is_disabled)

        $('#top_crop').val('')
        $('#bt_crop').val('')
        $('#left_crop').val('')
        $('#right_crop').val('')

    }
</script>

@endsection
