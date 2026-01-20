
{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .table-w tr td:nth-child(1){width: 20%;}
    .table-w tr td:nth-child(2){width: 15%;}
    .table-w tr td:nth-child(3){width: 20%;}
    .table-w tr td:nth-child(4){width: 15%;}
    .table-w tr td:nth-child(5){width: 10%;}
    .table-w tr td:nth-child(6){width: 10%;}

    ::-webkit-scrollbar {
        width: 3px !important;
        height: 3px !important;
    }
    ::-webkit-scrollbar-track {
        background: #f1f1f1 !important;
    }
    ::-webkit-scrollbar-thumb {
        background: #888 !important;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: #555 !important;
    }
</style>


@endsection
@section('title-left')
    {{-- <h4 class="mb-sm-0">USER SETTING</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">User Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
@endsection
@section('modal')
<div id="modal_Userdownload" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="myModalLabel">Import List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <form action="{{url('importexcel')}}"  method="POST" enctype="multipart/form-data" class="w-100">
                    @method('POST')
                    @csrf
                    {{-- <div class='file-input w-100'>
                        <input type='file' name="fileicd10">
                        <span class='button'>ICD-10 Excel</span>
                        <span class='label' data-js-label>No file selected</label>
                    </div> --}}
                    <div class="dropzone">
                        <div class="fallback">
                            <input type="file" name="fileuser" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                        </div>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                            </div>

                            <h4>Drop files here or click to upload.</h4>
                        </div>
                    </div>
                    {{-- <button class="btn btn-primary rounded-0" name="icd10" value="1"  type="submit">Start Import</button> --}}

            </div>
            <div class="modal-footer">
                <div class="col-12 d-flex justify-content-between">
                    {{-- <button type="button" class="btn btn-warning " data-bs-dismiss="modal">Download template </button> --}}
                    <a href="{{url("public/user/user.xlsx")}}" class="btn btn-warning">Download template</a>
                    <button name="user" type="submit" value="1" class="btn btn-primary">Confirm </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

{{-- @dd(1) --}}
<div class="card">
    <div class="card-body">
        <div class="row m-3">
            @if(Session::has('status'))
                @if (Session::get('status') == 'success')
                    <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                        ทำการดึงข้อมูลจาก server เสร็จสิ้น
                        <button type="button" id="alert_btn" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                    <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                        เกิดข้อผิดพลาด กรุณาตรวจสอบอีกครั้ง
                        <button type="button" id="alert_btn" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endif
        </div>
        <div class="row m-0">
            <div class="col">
                {{-- <a href="{{url("admin/role")}}" id="" type="button" class="btn btn-info waves-effect waves-light">  Role</a> --}}
            </div>
            <div class="col-auto">
                <a href="{{url("admin/user/create")}}" type="button" class="btn btn-secondary waves-effect waves-light"> <i class="ri ri-add-line "></i> Add</a>
            @if (@uget("user_type") == 'admin')

                <button type="button" class="btn btn-danger btn-label waves-effect waves-light ms-3" data-bs-toggle="modal" data-bs-target="#modal_Userdownload">
                <i class="ri-download-2-line label-icon align-middle fs-16 me-2"></i> Import List</button>
            @endif
            </div>

            @if (@uget("user_type") == 'admin')
            <div class="col-auto">
                <button id="server_btn_user" type="button" class="btn btn-info waves-effect waves-light"> <i class="ri ri-download-line"></i> Server User</button>
            </div>
            <div class="col-auto">
                <button id="server_btn_patient" type="button" class="btn btn-info waves-effect waves-light"> <i class="ri ri-download-line"></i> Server Patient</button>
            </div>
            @endif
        </div>
        <div class="row mt-3"><hr></div>
        <div class="row m-0">
            <div class="col-3">
                <div>
                    <input type="text" class="form-control bg-light" id="search_name" placeholder="Search …" oninput="function_search()">
                </div>
            </div>
            <div class="col-2">
                <select class="form-select mb-3 js-example-basic-single" aria-label="Default select example" id="search_type" onchange="function_search()">
                    <option value="">Please choose user type</option>
                    {{-- <option @isset($user['user_type']) @if($user['user_type'] == 'admin') selected  @endif @endisset value="admin">Admin</option> --}}
                    <option value="anesthesia">Anesthesia</option>
                    <option value="doctor">Doctor</option>
                    {{-- <option @isset($user['user_type']) @if($user['user_type'] == 'endo') selected  @endif @endisset value="endo">Endo</option> --}}
                    <option value="nurse">Nurse</option>
                    <option value="nurse_anes">Nurse Anes</option>
                    <option value="viewer">Viewer</option>
                    <option value="register">Register</option>
                    <option value="scientific">Scientific Officer </option>
                    <option value="nurse_assistant">Nurse Assistant</option>
                </select>
            </div>
            <div class="col-2">
                <select class="form-select mb-3 js-example-basic-single" id="search_department" aria-label="Default select example" onchange="function_search()">
                    <option value="">Please choose department</option>
                    @isset($departments)
                        @foreach ($departments as $d)
                            <option value="{{@$d->department_name}}">{{@$d->department_name}}</option>
                        @endforeach
                    @endisset
                </select>

            </div>
            <div class="col-2">
                <select class="form-select mb-3 js-example-basic-single" id="search_status" aria-label="Default select example" onchange="function_search()">
                    <option value="">Please choose status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div style="overflow-y: scroll; max-height: 590px;">
        <div class="table-responsive table-card table-w m-1">
            <table class="table table-nowrap mb-0" id="table-search">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Code</th>
                        <th scope="col">Depatment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">

                    @isset($users)
                        @foreach($users as $u)
                        {{-- @dd($users); --}}
                            @isset($u->uid)
                                @php
                                    $name  = $u->user_type == 'endo' && isset($u->user_firstname) == false ? $u->name : $u->user_firstname.' '.@$u->user_lastname;
                                @endphp
                                <tr>
                                    <td><a href="{{url("admin/user/".@$u->uid."/edit")}}" class="fw-semibold">{{@$name}}</a></td>
                                    <td>{{@$u->user_type}}</td>
                                    <td>{{@$u->user_code}}</td>
                                    <td>{{@$u->department ?? $u->user_department[0]}}</td>
                                    <td>
                                        <span style="color: white; display:none">{{@$u->user_status}}</span>
                                        <div class="form-check form-switch form-switch-success">
                                            <input class="form-check-input" type="checkbox" role="switch" id="radio_{{$u->uid}}" onchange="change_user_status('{{@$u->uid}}')" @isset($u->user_status) @if($u->user_status == 'active') checked @endif  @endisset>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{url("admin/user/".@$u->uid."/edit")}}" class="btn btn-sm btn-success">edit</a>
                                    </td>
                                </tr>
                            @endisset

                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="{{url('admin')}}/user" method="post" id="submit_form" hidden>
    @csrf
    <input type="hidden" name="event" value="get_masterdata">
    <input type="hidden" id="tb_name" name="tb_name" value="">
</form>
@endsection




@section('script')
<script>
    function function_search() {

        let name   = $(`#search_name`).val().toLowerCase()
        let type   = $('#search_type').val().toLowerCase()
        let status   = $('#search_status :selected').val().toLowerCase()
        let department   = $('#search_department :selected').val().toLowerCase()

        console.log(name, department, status);

        var tbody_id = `tbody`
        var rows = $(`#${tbody_id} tr`);
        $(`#${tbody_id} tr`).show()

        $(`#${tbody_id} tr`).each(function (index, element) {
            // store each td for each iterated rows
            var tds = $( this ).find( 'td' );
            var name_td = $(tds[0]).text().toLowerCase()
            var type_td = $(tds[1]).text().toLowerCase()
            var code_td = $(tds[2]).text().toLowerCase()
            var department_td = $(tds[3]).text().toLowerCase()
            var status_td = $(tds[4]).find('input').is(':checked')
            status_td = (status_td != undefined && status_td != '') ? 'active' : 'inactive'
            console.log(status_td);

            if(name != '' && name != undefined){
                if((name_td.includes(name) || code_td.includes(name)) ){
                } else {
                    $(this).hide()
                }
            }

            if(type != '' && type != undefined){
                if((type_td.includes(type) || type_td.includes(type)) ){
                } else {
                    $(this).hide()
                }
            }

            if(department != '' && department != undefined){
                if((department_td.includes(department)) ){
                } else {
                    $(this).hide()
                }
            }

            if(status != '' && status != undefined){
                if((status_td == status) ){
                } else {
                    $(this).hide()
                }
            }

        });


    }

    function change_user_status(user_id) {
            var is_checked = $(`#radio_${user_id}`).is(':checked')
            var status = is_checked == true ? 'active' : 'inactive'
            $.post('{{ url("api") }}/jquery', {
                event               : 'change_user_status',
                user_id             : user_id,
                status              : status
            }, function(data, status){
            });
        }

    $('#server_btn_user').on('click', function () {
        $('#tb_name').val('users')
        $('#submit_form').submit()
    })

    $('#server_btn_patient').on('click', function () {
        $('#tb_name').val('tb_patient')
        $('#submit_form').submit()
    })

    @if(Session::has('status'))
        setTimeout(() => {
            $('#alert_btn').trigger('click')
        }, 3 * 1000);
    @endif
</script>

@endsection
