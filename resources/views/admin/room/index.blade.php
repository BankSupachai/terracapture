
{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .table-w tr td:nth-child(1){width: 35%;}
    .table-w tr td:nth-child(2){width: 30%;}
    .table-w tr td:nth-child(3){width: 20%;}
    .table-w tr td:nth-child(4){width: 30%;}

    .text-h-table{
        color: #9599ad;
    }
</style>


@endsection
@section('title-left')
    {{-- <h4 class="mb-sm-0">ROOM SETTING </h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Room Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
@endsection
@section('modal')
<div id="modal_Roomdownload" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Import List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="dropzone">
                    <div class="fallback">
                        <input name="file" type="file" multiple="multiple">
                    </div>
                    <div class="dz-message needsclick">
                        <div class="mb-3">
                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                        </div>

                        <h4>Drop files here or click to upload.</h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-12 d-flex justify-content-between">
                    <button type="button" class="btn btn-warning " data-bs-dismiss="modal">Download template </button>
                    <button type="button" class="btn btn-primary">Confirm </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

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
            <div class="col"></div>
            <div class="col-auto">
                <a href="{{url("admin/room/create")}}" type="button" class="btn btn-secondary waves-effect waves-light"> <i class="ri ri-add-line "></i> Add</a>
                <button type="button" class="btn btn-danger btn-label waves-effect waves-light ms-3" data-bs-toggle="modal" data-bs-target="#modal_Roomdownload">
                    <i class="ri-download-2-line label-icon align-middle fs-16 me-2"></i> Import List</button>
            </div>
            <div class="col-auto">
                <button id="server_btn" type="button" class="btn btn-info waves-effect waves-light"> <i class="ri ri-download-line"></i> Server</button>
            </div>
        </div>
        <div class="row mt-3"><hr></div>
        <div class="row m-0">
            <div class="col-4">
                <div>
                    <input type="text" class="form-control bg-light" id="search_name" placeholder="Search …" oninput="function_search()">
                </div>
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
    <div style="overflow-y: scroll; max-height: 400px;">
        <div class="table-responsive table-card table-w m-1">
            <table class="table table-nowrap table-w mb-0" id="table-search">
                <thead class="table-light">
                    <tr class="text-h-table">
                        <th scope="col">Name</th>
                        <th scope="col">Depatment</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @isset($rooms)
                        @foreach($rooms as $r)
                            @php
                                // $procs = '';
                                // if(isset($r['room_id'])){
                                //     $room_department = gettype($r['room_id']) == 'string' ? json_decode($r['room_id'], true) : get_department(intval($r['room_id']), 'department_room');
                                //     $procs = count($room_department) > 0 ? implode(', ', $room_department) : '';
                                // }
                                // if(isset($r['room_id'])){
                                //     $room_department = get_department(intval($r['room_id']), 'department_room');
                                //     $procs = count($room_department) > 0 ? implode(', ', $room_department) : '';
                                // }

                            @endphp
                            <tr>
                                <td><a href="#" class="fw-semibold">{{@$r->room_name}}</a></td>
                                <td>{{@$procs}}</td>
                                <td>
                                    <span style="color: black; display:none;">{{@$r->room_ready}}</span>
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" role="switch" id="room_{{@$r->room_id}}" onchange="change_status('{{@$r->room_id}}')" @isset($r->room_ready) @if(@$r->room_ready == '0' || @$r->room_ready == 0) checked @endif  @endisset>
                                    </div>
                                </td>
                                <td><a href="{{url("admin/room/".@$r->room_id."/edit")}}" type="button" class="btn btn-sm btn-success">Edit </a></td>
                            </tr>
                        @endforeach
                    @endisset

                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="{{url('admin')}}/room" method="post" id="submit_form" hidden>
    @csrf
    <input type="hidden" name="event" value="get_masterdata">
    <input type="hidden" name="tb_name" value="tb_room">
</form>
@endsection




@section('script')
<script>

    function function_search() {

        let name   = $(`#search_name`).val().toLowerCase()
        let status   = $('#search_status :selected').val().toLowerCase()
        let department   = $('#search_department :selected').val().toLowerCase()

        console.log(name, department, status);

        var tbody_id = `tbody`

        var rows = $(`#${tbody_id} tr`);
        $(`#${tbody_id} tr`).show()

        $(`#${tbody_id} tr`).each(function (index, element) {
            var tds = $( this ).find( 'td' );
            var name_td = $(tds[0]).text().toLowerCase()
            var department_td = $(tds[1]).text().toLowerCase()
            var status_td = $(tds[2]).find('input').is(':checked')
            status_td = (status_td != undefined && status_td != '') ? 'active' : 'inactive'

            if(name != '' && name != undefined){
                if((name_td.includes(name)) ){
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

    function change_status(id) {
        var is_checked = $(`#room_${id}`).is(':checked')
        var status = is_checked == true ? 0 : 1
        $.post('{{ url("api") }}/jquery', {
            event               : 'change_status',
            id                  : id,
            status              : status,
            tb_status_name      : 'room_ready',
            tb_name             : 'tb_room',
            tb_key              : 'room_id'
        }, function(data, status){
        });
    }

    $('#server_btn').on('click', function () {
        $('#submit_form').submit()
    })

    @if(Session::has('status'))
        setTimeout(() => {
            $('#alert_btn').trigger('click')
        }, 3 * 1000);
    @endif
</script>

@endsection
