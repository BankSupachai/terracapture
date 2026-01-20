
@extends('layouts.layouts_index.main')
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
    <h4 class="mb-sm-0">ROOM SETTING </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Room Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row m-0">
            <div class="col"></div>
            <div class="col-auto">
                <a href="{{url("admin/room/create")}}" type="button" class="btn btn-secondary waves-effect waves-light"> <i class="ri ri-add-line "></i> Add</a>
            </div>
        </div>
        <div class="row mt-3"><hr></div>
        <div class="row m-0">
            <div class="col-4">
                <div>
                    <input type="text" class="form-control bg-light" id="search_name" placeholder="Search …" onchange="function_search()">
                </div>
            </div>
            <div class="col-2">
                <select class="form-select mb-3 js-example-basic-single" id="search_department" aria-label="Default select example" onchange="function_search()">
                    <option value="">Please choose department</option>
                    @isset($departments)
                        @foreach ($departments as $d)
                            <option value="{{@$d['department_name']}}">{{@$d['department_name']}}</option>
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
                                // $room_department = get_department(intval($r['room_id']), 'department_room');
                                // $procs = count($room_department) > 0 ? implode(', ', $room_department) : '';
                            @endphp
                            <tr>
                                <td><a href="#" class="fw-semibold">{{@$r['room_name']}}</a></td>
                                {{-- <td>{{@$room_department}}</td> --}}
                                <td></td>
                                <td>
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck3" checked>
                                    </div>
                                </td>
                                <td><a href="{{url("admin/room/".$r['room_id']."/edit")}}" type="button" class="btn btn-sm btn-success">Edit </a></td>
                            </tr>
                        @endforeach
                    @endisset

                </tbody>
            </table>
        </div>
    </div>
</div>
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
            // store each td for each iterated rows
            var tds = $( this ).find( 'td' );
            var name_td = $(tds[0]).text().toLowerCase()
            var department_td = $(tds[1]).text().toLowerCase()
            // if find check not found == inactive (not checked)
            var status_td = $(tds[2]).find('input:checked')
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
                if((status_td.includes(status)) ){
                } else {
                    $(this).hide()
                }
            }

        });
    }
</script>

@endsection
