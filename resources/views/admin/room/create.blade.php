
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
    <form action="{{url("admin/room")}}" id="room_form" method="post">
        @csrf
        @method('POST')
        <input type="hidden" name="event" value="@isset($type) @if($type == 'ADD') room_create @else room_edit @endif  @endisset">
        <input type="hidden"  name="type" value="{{@$type}}">
        @if ($type == 'EDIT')
            <input type="hidden" id="room_id" name="room_id" value="{{@$room->room_id}}">
        @endif
        <h5 class="p-3">Room</h5>
        <div class="row ">
            <div class="col-lg d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Name</label>
            </div>
            <div class="col-4">
                <input type="text" class="form-control bg-light m-input" name="room_name" id="room_name" value="{{@$room->room_name}}">
            </div>
            <div class="col-7"></div>
        </div>
        <br>
        <div class="row ">
            <div class="col-lg d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Type</label>
            </div>
            <div class="col-4">
                <input type="text" class="form-control bg-light m-input" name="room_type" id="room_type" value="{{@$room->room_type}}">
            </div>
            <div class="col-7"></div>
        </div>
        <div class="row mt-3">
            <div class="col-lg d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Status</label>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input ms-1" type="radio" name="room_ready" value="0" id="room_active" @if($type == 'ADD') {{'checked'}}  @endif @isset($room->room_ready) @if($room->room_ready == '0' || $room->room_ready == 0) {{'checked'}} @else {{''}} @endif @endisset>
                    <label class="form-check-label ms-3 " for="room_active">
                        Active
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="room_ready" value="1" id="room_inactive" @isset($room->room_ready) @if($room->room_ready == '1' || $room->room_ready == 1) {{'checked'}} @else {{''}} @endif @endisset>
                    <label class="form-check-label ms-3" for="room_inactive">
                        Inactive
                    </label>
                </div>
            </div>
        </div>


        <div class="row ms-5 mt-3 mb-5">
            <div class="col-9 border p-3">
                <h4>Department <span style="color: red">*</span></h4>
                <select class="form-control" name="department" id="department_select">
                    <option value="">Select Department</option>
                    @foreach ($departments as $i=>$data)
                        <option value="{{$data->department_name}}" @if(@$room->room_department==$data->department_name) selected @elseif($i == 0 && @$type."" != "EDIT") selected @endif >{{$data->department_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button style="display:none" id="warning_div" type="button" data-toast data-toast-text="" data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs">Bottom Right</button>
        <div class="row mb-3 me-5">
            <div class="col text-end">
                <a href="{{url("admin/room")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                <button id="room_submit_btn" type="button" class="btn btn-primary btn-label waves-effect right waves-light" style="width: 10em;"><i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
            </div>
        </div>
    </form>
</div>
@endsection


@section('script')
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script>
    var submit_status = true
    $('#room_submit_btn').on('click', function () {
        // event.preventDefault();
        let room_name   = $('#room_name').val()
        let room_type   = $('#room_type').val()
        let room_status = $('input[name="room_ready"]:checked').val()
        let missing_data = []

        if(room_name == ''){
            missing_data.push('Name')
        }

        if(room_type == ''){
            missing_data.push('Type')
        }

        if(room_status == '' || room_status == undefined){
            missing_data.push('Status')
        }

        let warning_txt = 'กรุณาตรวจสอบข้อมูลในช่อง '
        missing_data.forEach((e, i) => {
            if(i == 0){
                warning_txt += e
            }
        })

        if(room_name != '' && room_type != '' && (room_status != '' && room_status != undefined) && submit_status == true){
            $('#room_form').submit()
            submit_status = false
        } else {
            // Swal.fire('โปรดเลือก Department')
            $('#warning_div').attr('data-toast-text', warning_txt)
            $('#warning_div').click()
        }
    })
</script>
@endsection
