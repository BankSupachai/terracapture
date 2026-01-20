
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .table-w tr td:nth-child(1){width: 70%;}
    .table-w tr td:nth-child(2){width: 20%;}
    .table-w tr td:nth-child(3){width: 10%;}

    .text-h-table{
        color: #9599ad;
    }
</style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">DEPARTMENT SETTING </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Department Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row m-0">
            <div class="col"></div>
            <div class="col-auto">
                <a href="{{url("admin/department/create")}}" type="button" class="btn btn-secondary waves-effect waves-light"> <i class="ri ri-add-line "></i> Add</a>
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
                <select class="form-select mb-3 js-example-basic-single" id="search_status" aria-label="Default select example" onchange="function_search()">
                    <option value="">Please choose status</option>
                    <option value="0">Active</option>
                    <option value="1">Inactive</option>
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
                        <th scope="col" >Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @isset($departments)
                        @foreach ($departments as $d)
                            <tr>
                                <td><a href="#" class="fw-semibold">{{@$d['department_name']}}</a></td>
                                <td>
                                    <div class="form-check form-switch form-switch-success">
                                        <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck3" checked>
                                    </div>
                                </td>
                                <td>
                                    <a href="{{url("admin/department/".@$d['department_id']."/edit")}}" class="btn btn-sm btn-success">Edit </a>
                                </td>
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

        let name   = $(`#search_name`).val()
        let status   = $('#search_status :selected').val()

        var tbody_id = `tbody`

        var rows = $(`#${tbody_id} tr`);
        $(`#${tbody_id} tr`).show()

        $(`#${tbody_id} tr`).each(function (index, element) {
            // store each td for each iterated rows
            var tds = $( this ).find( 'td' );
            var name_td = $(tds[0]).text().toLowerCase()
            var status_td = $(tds[1]).find('input:checked')
            status_td = (status_td != undefined && status_td != '') ? 'active' : 'inactive'

            if(name != '' && name != undefined){
                if(name_td.includes(name)){
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
