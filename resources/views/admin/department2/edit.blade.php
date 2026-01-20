@extends('capture.layoutv6')
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

    /* เพิ่ม CSS สำหรับ checkbox section */
    .checkbox-section {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .checkbox-section h6 {
        margin-bottom: 10px;
        font-weight: 600;
        color: #495057;
    }

    .checkbox-container {
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #e9ecef;
        border-radius: 5px;
        padding: 10px;
        background-color: #f8f9fa;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        margin-bottom: 8px;
        padding: 5px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .checkbox-item:hover {
        background-color: #e9ecef;
    }

    .checkbox-item input[type="checkbox"] {
        margin-right: 8px;
        margin-bottom: 0;
    }

    .checkbox-item label {
        margin-bottom: 0;
        cursor: pointer;
        font-size: 14px;
        flex: 1;
    }

    .btn-group-checkbox {
        margin-bottom: 10px;
    }

    .btn-group-checkbox .btn {
        margin-right: 5px;
        font-size: 12px;
        padding: 4px 8px;
    }
</style>


@endsection

@section('content')

<form action="{{url("admin/department")}}" method="post">
    @csrf
    <input type="hidden" name="event" value="department_edit">
    <input type="hidden" name="type" value="{{@$type}}">
    @if($type == 'EDIT')
        <input type="hidden" name="department_id" value="{{@$department->department_id}}">
    @endif
    <div class="card">
        <h5 class="p-3">DEPARTMENT</h5>
        <div class="row ">
            <div class="col-4 d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label">Name</label>
                <input type="text" class="form-control bg-light m-input" id="basiInput" name="department_name" value="{{@$department->department_name}}" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Status</label>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input ms-1" type="radio" name="department_status" value="active" id="radio_active" required @isset($department->department_status) @if($department->department_status == 'active') checked @endif  @endisset>
                    <label class="form-check-label ms-3" for="radio_active">
                        Active
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="department_status" value="inactive" id="radio_inactive" @isset($department->department_status) @if($department->department_status == 'inactive') checked @endif  @endisset>
                    <label class="form-check-label ms-3" for="radio_inactive">
                        Inactive
                    </label>
                </div>
            </div>
        </div>
<hr>
        <div class="row">
            <div class="col-3">
                <div class="checkbox-section">
                    <h6>Room</h6>
                    <div class="btn-group-checkbox">
                        <a class="btn btn-primary btn-sm" id="btn_allrooms">ALL</a>
                        <a class="btn btn-danger btn-sm" id="btn_allroomsno">NO</a>
                    </div>
                    <div class="checkbox-container">
                        @foreach(isset($tb_room)?$tb_room:[] as $data)
                            @php
                                if(gettype(array_search(@$data->room_id,$department->department_room))=="integer"){
                                    $checked = "checked";
                                }else{
                                    $checked = "";
                                }
                            @endphp
                            <div class="checkbox-item">
                                <input class="rooms" name="room[]" {{$checked}} value="{{@$data->room_id}}" type="checkbox" id="room_{{@$data->room_id}}">
                                <label for="room_{{@$data->room_id}}">{{@$data->room_name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="checkbox-section">
                    <h6>Users</h6>
                    <div class="btn-group-checkbox">
                        <a class="btn btn-primary btn-sm" id="btn_allusers">ALL</a>
                        <a class="btn btn-danger btn-sm" id="btn_allusersno">NO</a>
                    </div>
                    <div class="checkbox-container">
                        @foreach(isset($tb_user)?$tb_user:[] as $data)
                            <div class="checkbox-item">
                                <input name="user[]" class="users" value="{{@$data->uid}}" type="checkbox" id="user_{{@$data->uid}}" @checked(@$data->uid == in_array(@$data->uid, @$department->department_user))>
                                <label for="user_{{@$data->uid}}">[{{@$data->department}}] {{@$data->user_prefix}}{{@$data->user_firstname}} {{@$data->user_lastname}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="checkbox-section">
                    <h6>Scope</h6>
                    <div class="btn-group-checkbox">
                        <a class="btn btn-primary btn-sm" id="btn_allscopes">ALL</a>
                        <a class="btn btn-danger btn-sm" id="btn_allscopesno">NO</a>
                    </div>
                    <div class="checkbox-container">
                        @foreach(isset($tb_scope)?$tb_scope:[] as $data)
                            <div class="checkbox-item">
                                <input class="scopes" name="scope[]" value="{{@$data->scope_id}}" type="checkbox" id="scope_{{@$data->scope_id}}" @if(in_array($data->scope_id, $department->department_scope)) checked @endif>
                                <label for="scope_{{@$data->scope_id}}">[ {{@$data->scope_serial}} ] {{@$data->scope_name}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-3">
                <div class="checkbox-section">
                    <h6>Procedure</h6>
                    <div class="btn-group-checkbox">
                        <a class="btn btn-primary btn-sm" id="btn_allprocedures">ALL</a>
                        <a class="btn btn-danger btn-sm" id="btn_allproceduresno">NO</a>
                    </div>
                    <div class="checkbox-container">
                        @foreach(isset($tb_procedure)?$tb_procedure:[] as $data)
                            @php
                                if(gettype(array_search(@$data->code,$department->department_procedure))=="integer"){
                                    $checked = "checked";
                                }else{
                                    $checked = "";
                                }
                            @endphp
                            <div class="checkbox-item">
                                <input class="procedures" name="procedure[]" {{$checked}} value="{{@$data->code}}" type="checkbox" id="procedure_{{@$data->code}}">
                                <label for="procedure_{{@$data->code}}">{{@$data->name}}</label>
                            </div>
                        @endforeach
                    </div>
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
<script>
    $("#btn_allrooms").click(function(){
        $('.rooms').prop('checked', true);
    });
    $("#btn_allroomsno").click(function(){
        $('.rooms').prop('checked', false);
    });
    $("#btn_allusers").click(function(){
        $('.users').prop('checked', true);
    });
    $("#btn_allusersno").click(function(){
        $('.users').prop('checked', false);
    });
    $("#btn_allscopes").click(function(){
        $('.scopes').prop('checked', true);
    });
    $("#btn_allscopesno").click(function(){
        $('.scopes').prop('checked', false);
    });
    $("#btn_allprocedures").click(function(){
        $('.procedures').prop('checked', true);
    });
    $("#btn_allproceduresno").click(function(){
        $('.procedures').prop('checked', false);
    });

</script>

@endsection
