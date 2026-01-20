
{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('title', 'EndoINDEX')
@section('style')
<style>
    /* .table-w tr td:nth-child(1){width: 20%;}
    .table-w tr td:nth-child(2){width: 15%;}
    .table-w tr td:nth-child(3){width: 20%;}
     */

</style>


@endsection
@section('title-left')
    {{-- <h4 class="mb-sm-0">TREATMENT COVERAGE  SETTING</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Procedure Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
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
                <a href="{{url("admin/treatment/create")}}" type="button" class="btn btn-secondary waves-effect waves-light"> <i class="ri ri-add-line "></i> Add</a>
            </div>
            <div class="col-auto">
                <button id="server_btn" type="button" class="btn btn-info waves-effect waves-light"> <i class="ri ri-download-line"></i> Server</button>
            </div>
        </div>
        <div class="row mt-3"><hr></div>
        <div class="row m-0">
            <div class="col-4">
                <div>
                    <input type="text" class="form-control bg-light"  id="search_name" placeholder="Search …" oninput="function_search()">
                </div>
            </div>
            <div class="col-2">
                <select class="form-select mb-3 js-example-basic-single" id="search_status" aria-label="Default select example" onchange="function_search()">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="table-responsive table-card table-w m-1" >
        <table class="table table-nowrap mb-0" id="table-search">
            <thead class="">
                <tr>
                    <th scope="col">Name</th>
                    <th ></th>
                    <th ></th>
                    <th ></th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="tbody">
                @isset($treatment)
                    @foreach ($treatment as $t)
                        @php
                            $t = (object) $t;
                        @endphp
                        <tr >
                            <td>{{@$t->name}}</td>
                            <td> </td>
                            <td></td>
                            <td></td>
                            <td>
                                <span style="display:none">{{@$t->status}}</span>
                                <div class="form-check form-switch form-switch-success">
                                    <input class="form-check-input scope_status" type="checkbox" role="switch" id="treatment_{{@$t->code}}" onchange="change_status('{{@$t->code}}')" @isset($t->status) @if($t->status == 'active') checked @endif  @endisset>
                                </div>
                            </td>
                            <td>
                                <a href="{{url('')}}/admin/treatment/{{@$t->code}}/edit" class="btn btn-sm btn-success">Edit </a>
                            </td>
                        </tr>
                    @endforeach
                @endisset

            </tbody>
        </table>
    </div>
</div>

<form action="{{url('admin')}}/treatment" method="post" id="submit_form" hidden>
    @csrf
    <input type="hidden" name="event" value="get_masterdata">
    <input type="hidden" name="tb_name" value="tb_treatmentcoverage">
</form>
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
            var tds = $( this ).find( 'td' );
            var name_td = $(tds[0]).text().toLowerCase()
            var status_td = $(tds[4]).find('input').is(':checked')
            status_td = (status_td != undefined && status_td != '') ? 'active' : 'inactive'

            if(name != '' && name != undefined){
                if(name_td.includes(name)){
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

    function change_status(code) {
        var is_checked = $(`#treatment_${code}`).is(':checked')
        var status = is_checked == true ? 'active' : 'inactive'
        $.post('{{ url("api") }}/jquery', {
            event               : 'change_status',
            id                  : code,
            status              : status,
            tb_status_name      : 'status',
            tb_name             : 'tb_treatmentcoverage',
            tb_key              : 'code'
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
