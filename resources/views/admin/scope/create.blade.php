
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
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
    <form action="{{url("admin/scope")}}" method="post" id="scope_form">
        @method('post')
        @csrf
        <input type="hidden" name="event" value="@isset($type) @if($type == 'ADD') scope_create @else scope_edit  @endif @endisset">
        <input type="hidden"  name="type" value="{{@$type}}">
        @if ($type == 'EDIT')
            <input type="hidden" name="scope_id" value="{{@$scope->scope_id}}">
        @endif
        <div class="row ">
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Name</label>
                <input type="text" class="form-control bg-light m-input" id="scope_name" name="scope_name" value="{{@$scope->scope_name}}" required>
            </div>
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Brand</label>
                <input type="text" class="form-control bg-light ms-5" id="scope_brand" name="scope_brand" value="{{@$scope->scope_band}}" required>
            </div>
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Model</label>
                <input type="text" class="form-control bg-light m-input2" id="scope_model" name="scope_model" value="{{@$scope->scope_model}}" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label  text-nowrap">Serial number</label>
                <input type="text" class="form-control bg-light ms-3" id="scope_serial" name="scope_serial" value="{{@$scope->scope_serial}}" required>
            </div>

            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">RFID Code</label>
                <input type="text" class="form-control bg-light m-input1" id="scope_rfid" name="scope_rfid" value="{{@$scope->scope_rfid}}">
            </div>
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Installation date</label>
                <input type="date" class="form-control bg-light ms-3" id="scope_installdate" name="scope_installdate" required value="{{@$scope->scope_installdate}}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Status</label>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="scope_status" value="active" id="flexRadioDefault1"  @if($type == 'ADD') {{'checked'}}  @endif @isset($scope->scope_status) @if($scope->scope_status == 'available') {{'checked'}} @else {{''}} @endif @endisset required>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Active
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="scope_status" value="inactive" id="flexRadioDefault2" @isset($scope->scope_status) @if($scope->scope_status == 'disable' || $scope->scope_status == 'repair') {{'checked'}} @else {{''}} @endif @endisset>
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
                    <input class="form-check-input" type="radio" name="scope_setting" value="auto_crop" id="flexRadioDefault3" onchange="toggle_inp(this.value)" @if($type == 'ADD') {{'checked'}}  @endif @if(empty($scope->scope_top) && empty($scope->scope_bottom) && empty($scope->scope_left) && empty($scope->scope_right)) {{'checked'}} @else {{''}} @endif   required>
                    <label class="form-check-label text-nowrap" for="flexRadioDefault3">
                        Auto Crop
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="scope_setting" value="manual_crop" id="flexRadioDefault4" onchange="toggle_inp(this.value)" @if(!empty($scope->scope_top) || !empty($scope->scope_bottom) || !empty($scope->scope_left) || !empty($scope->scope_right)) {{'checked'}} @else {{''}} @endif>
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
                <input type="text" class="form-control bg-setting ms-3" name="scope_top" id="top_crop" value="{{@$scope->scope_top}}" @if(empty($scope->scope_top)) disabled @endif>
            </div>
            <div class="col-2">
                <input type="text" class="form-control bg-setting ms-3" name="scope_bottom" id="bt_crop" value="{{@$scope->scope_bottom}}"  @if(empty($scope->scope_bottom)) disabled @endif>
            </div>
            <div class="col-2">
                <input type="text" class="form-control bg-setting ms-3" name="scope_left" id="left_crop" value="{{@$scope->scope_left}}" @if(empty($scope->scope_left)) disabled @endif>
            </div>
            <div class="col-2">
                <input type="text" class="form-control bg-setting ms-3" name="scope_right" id="right_crop" value="{{@$scope->scope_right}}" @if(empty($scope->scope_right)) disabled @endif>
            </div>
        </div>
        <div class="row ms-5 mt-3 mb-5">
            <div class="col-9 border p-3">
                <h4>Department <span style="color: red">*</span></h4>
                <select class="form-control" name="department" id="department_select">
                    <option value="">Select Department</option>
                    @foreach ($departments as $i=>$data)
                        <option value="{{$data->department_name}}" @if(@$scope->scope_department==$data->department_name) selected @elseif($i == 0 && @$type."" != "EDIT") selected @endif >{{$data->department_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button style="display:none" id="warning_div" type="button" data-toast data-toast-text="" data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs">Bottom Right</button>
        <div class="row mb-3 me-5">
            <div class="col text-end">
                <a href="{{url("admin/scope")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                <a href="javascript:;" id="scope_submit_btn" class="btn btn-primary btn-label waves-effect right waves-light" style="width: 10em;"><i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script>
    var submit_status = true

    function toggle_inp(radio_id){
        var is_disabled = ''
        if(radio_id == 'manual_crop'){
            is_disabled = false
        } else {
            is_disabled = true
        }

        $('#top_crop').prop('disabled', is_disabled)
        $('#bt_crop').prop('disabled', is_disabled)
        $('#left_crop').prop('disabled', is_disabled)
        $('#right_crop').prop('disabled', is_disabled)

        $('#top_crop').val('')
        $('#bt_crop').val('')
        $('#left_crop').val('')
        $('#right_crop').val('')

    }

    $('#scope_submit_btn').on('click', function () {
        let scope_name           = $('#scope_name').val()
        let scope_brand          = $('#scope_brand').val()
        let scope_model          = $('#scope_model').val()
        let scope_serial         = $('#scope_serial').val()
        let scope_installdate    = $('#scope_installdate').val()
        let scope_status         = $('input[name="scope_status"]:checked').val()
        let scope_setting        = $('input[name="scope_setting"]:checked').val()
        let missing_data         = []

        if(scope_name == ''){
            missing_data.push('Name')
        }

        if(scope_brand == ''){
            missing_data.push('Brand')
        }

        if(scope_model == ''){
            missing_data.push('Model')
        }

        if(scope_serial == ''){
            missing_data.push('Serial Number')
        }

        if(scope_installdate == ''){
            missing_data.push('Installation date')
        }

        if(scope_status == '' || scope_status == undefined){
            missing_data.push('Status')
        }

        if(scope_setting == '' || scope_setting == undefined){
            missing_data.push('Setting')
        }



        let warning_txt = 'กรุณาตรวจสอบช้อมูลในช่อง '
        missing_data.forEach((e, i) => {
            if(i == 0){
                warning_txt += e
            }
        })

        if(scope_name != '' && scope_brand != '' && scope_model != "" && scope_serial != '' && scope_installdate != ""
        && (scope_status != '' && scope_status != undefined) &&  (scope_setting != '' && scope_setting != undefined) && submit_status == true){
            $('#scope_form').submit()
            submit_status = false
        } else {
            $('#warning_div').attr('data-toast-text', warning_txt)
            $('#warning_div').click()
        }
    })
</script>

@endsection
