
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
    {{-- <h4 class="mb-sm-0">WORKLIST PROCEDURE SETTING</h4> --}}
@endsection
@section('title-right')
    {{-- <ol class="breadcrumb m-0">
        <li id="top" class="breadcrumb-item"><a href="javascript: void(0);">Case Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol> --}}
@endsection

@section('modal')
 <!-- Default Modals -->
<div id="add_text_modal" data-bs-backdrop="static" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{url('admin/worklist')}}" method="post" id="add_text_form">
                @csrf
                @method('POST')
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Add Text</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row m-2">
                    <table class="table table-nowrap mb-0" id="table-search">
                        <thead class="">
                            <tr>
                                <th class="text-center">Text</th>
                                <th class="text-center">Matched Procedure</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                            <input type="hidden" name="event" value="add_worklist_findtext">
                            <input type="hidden" name="total_row" id="total_row">
                            <tbody id="tbody_worklist">
                                <tr class="tr-row-modal"  style="cursor: pointer" id="row0">
                                    <td class="sort-text tr-ck" style="width: 40%">
                                        <input type="text" class="form-control add-text" index="0" name="text0" required>
                                        <div class="text-missing text-center mt-0" style="color: red; font-size: 0.8em;display:none">Missing value</div>
                                    </td>
                                    <td class="sort-name tr-ck" style="width: 40%">
                                        <select class="form-select mb-0 add-procedure" index="0" name="procedure0" aria-label="Default select example" required>
                                            <option value=""></option>
                                            @foreach (isset($procedures)?$procedures:[] as $p)
                                                @php
                                                    $p = (object) $p;
                                                @endphp
                                                <option value="{{@$p->name}}">{{@$p->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="procedure-missing text-center mt-0" style="color: red; font-size: 0.8em;display:none">Missing value</div>
                                    </td>


                                    <td class="text-center" style="width: 40%;">
                                        <button class="btn btn-danger ms-2 delete-row" index="0" type="button" ><i class="ri-delete-bin-6-line"></i></button>
                                    </td>

                                </tr>
                            </tbody>
                    </table>
                </div>
                <div class="row m-2">
                    <button class="btn btn-primary mt-2 add-table-row" type="button" >+Add</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success submit">Update</button>

            </div>
        </form>

        </div>
    </div>
</div>

<div id="confirm_delete_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Do you really want to delete this text?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirm-delete">Confirm</button>
            </div>
            <input type="hidden" id="delete_id">
        </div>
    </div>
</div>
@endsection
@section('content')
{{-- @dd($department) --}}
<div class="card">
    <div class="card-body">
        <div class="row m-3">

        </div>
        <div class="row m-0">
        </div>
        <div class="row mt-3"><hr></div>
        <div class="row m-0">

            <form action="{{url('admin/worklist')}}" method="put">
                @method('PUT')
                @csrf
                <input type="hidden" name="event" value="search_textmatch">
                <input type="hidden" name="search" value="search">
                <div class="row">
                    <div class="col-3">
                        <div>
                            <input type="text" class="form-control"  id="search_name" name="search_text" placeholder="Search text…" value="{{@$filter['text']}}">
                        </div>
                    </div>
                    <div class="col-3">
                        <select _id="{{@$c->_id}}" class="form-select mb-3" name="search_procedure" aria-label="Default select example">
                            <option value="">Search procedure...</option>
                            @foreach (isset($procedures)?$procedures:[] as $p)
                                @php
                                    $p = (object) $p;
                                @endphp
                                <option value="{{@$p->name}}" @isset($filter['procedure']) @if(@$p->name == @$filter['procedure']) selected @endif @endisset>{{@$p->name}}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="col-3">
                        <select class="form-select add-department" index="${index}" name="search_department" required>
                            <option value=""></option>
                            @foreach ($department as $data_department)
                            <option value="">{{ $data_department->department_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary bg-gradient waves-effect waves-light">Search</button>
                        <a href="{{url('admin/worklist')}}" type="button" class="btn btn-primary bg-gradient waves-effect waves-light">Clear</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="card">
    <form action="{{url('admin/worklist')}}" method="post" id="updatetextfind_form">
        @csrf
        <input type="hidden" name="event" value="update_textfind">
    </form>
        <div class="row">
            <div class="col-lg-8">
                <div class="row">

                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-11 my-2">
                        <button class="btn btn-primary ms-2 me-2" style="float:right" type="button" onclick="call_modal(this, 'add_text_modal')"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="เปิด modal สำหรับการเพิ่ม text และ procedure">
                            +Add
                        </button>
                        <button class="btn btn-primary ms-2 me-2 update" style="float:right" type="button"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="ทำการค้นหาคำใน tb_caseworklist แล้ว match กับ procedure (เฉพาะคำที่มีส่วนคำที่เหมือนกับ procedure name ใน tb_procedure เท่านั้น)">
                            Update Text
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive table-card table-w m-1" >
            <table class="table table-nowrap mb-0" id="table-search">
                <thead class="">
                    <tr>
                        <th class="text-center">Text</th>
                        <th class="text-center">Matched Procedure</th>
                        <th class="text-center">Department</th>

                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="tbody_worklist">
                    @isset($wk_findtext)
                        @foreach ($wk_findtext as $index=>$c)
                            @php
                                $c = (object) $c;
                            @endphp
                            <tr class="tr-row" >
                                <td class="sort-text tr-ck" style="width: 30%">{{@$c->text_find}}</td>
                                <td class="sort-name tr-ck" style="width: 30%">
                                    {{-- {{@$c->text_match}} --}}
                                    <select _id="{{@$c->_id}}" class="form-select mb-3 textfind" aria-label="Default select example">
                                        <option value=""></option>
                                        @foreach (isset($procedures)?$procedures:[] as $p)
                                            @php
                                                $p = (object) $p;
                                            @endphp
                                            <option value="{{@$p->name}}" @if(@$p->name == @$c->text_match) selected @endif>{{@$p->name}}</option>
                                        @endforeach
                                    </select>


                                </td>
                                <td>
                                    <select class="sort-department tr-ck form-select add-department" index="${index}" name="search_department" required>
                                        @foreach ($department as $data_department)
                                            {{-- @dd($data_department); --}}
                                        <option value="{{@$data_department->department_name}}"@if( @$data_department->department_name == @$c->text_department ) selected @endif>
                                            {{@$data_department->department_name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger ms-2" index="0" type="button" _id="{{@$c->_id}}" onclick="call_modal(this, 'confirm_delete_modal')">
                                        <i class="ri-delete-bin-6-line"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @endisset

                </tbody>
            </table>

        </div>
    {{-- </form> --}}

    <div class="row my-2">
        <div class="col-lg-9"></div>
        <div class="col-lg-2" >
            <button type="button" style="float: right"  class="btn btn-primary btn-label waves-effect waves-light" onclick="to_top()">
                <i class="ri-arrow-up-line label-icon align-middle fs-16 me-2"></i>
                Back to top
            </button>
        </div>
    </div>
</div>

@endsection




@section('script')

<script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function to_top(){
        document.getElementById("top").scrollIntoView()
    }

    function call_modal(e, id){
        let this_modal = new bootstrap.Modal(document.getElementById(id), {})
        this_modal.show()
        if(id.includes('delete')) $('#delete_id').val($(e).attr('_id'))
    }

    $('.add-table-row').on('click', () => {
        let total_row = $('.tr-row-modal').length
        $('#tbody_worklist').append(tbody_html(total_row))
        $('.delete-row').on('click', delete_row)
        $('.add-text').on('change', (e) => { toggle_warning(e, 'text')})
        $('.add-procedure').on('change', (e) => { toggle_warning(e, 'procedure')})
        $('.add-department').on('change', (e) => { toggle_warning(e, 'department')})



    })

    $('.delete-row').on('click', delete_row)

    function delete_row(e){
        let index = $(e.target).attr('index')
        $(`#row${index}`).remove()
    }

    $('.update').on('click', (e) => {
        $(e.target).prop('disabled', true)
        $('#updatetextfind_form').submit()
    })

    $('.submit').on('click', function () {
        let can_submit = true
        let total_row = $('.tr-row-modal').length
        for (let i = 0; i < total_row; i++) {
            let text = $($(`.add-text`)[i]).val()
            let proc = $($(`.add-procedure`)[i]).val()
            if(text != undefined){
                if(text.trim() == '') {
                    can_submit = false;
                    $($('.text-missing')[i]).css('display', 'block');
                }
            }

            if(proc != undefined){
                if(proc.trim() == ''){
                    can_submit = false;
                    $($('.procedure-missing')[i]).css('display', 'block');
                }
            }
        }

        if(can_submit){
            $('#total_row').val(total_row)
            $('#add_text_form').submit()
        }
    })

    $('.add-text').on('change', (e) => { toggle_warning(e, 'text')})
    $('.add-procedure').on('change', (e) => { toggle_warning(e, 'procedure')})

    function toggle_warning(e, type){
        let index = $(e.target).attr('index')
        let val = $(e.target).val()
        if(val != ''){
            $($(`.${type}-missing`)[index]).css('display', 'none')
        } else {
            $($(`.${type}-missing`)[index]).css('display', 'block')
        }
    }

    $('.textfind').on('change', (e) => {
        let id = $(e.target).attr('_id')
        let val = $(e.target).val()
        $.post("{{url('api/worklist')}}", {
            event: "save_findtext",
            id: id,
            match: val
        }, function(data, status){})
    })

    $('.confirm-delete').on('click', (e) => {
        let id = $('#delete_id').val()
        if(id != '' && id != undefined) {
            $.post("{{url('api/worklist')}}", {
                event: "delete_findtext",
                id: id,
            }, function(data, status){
                location.reload()
            })
        }
    })

    $('#add_text_modal').on('show.bs.modal', () => {
        $('#tbody_worklist').empty()
        $('#tbody_worklist').append(tbody_html(0))
    })

    function tbody_html(index){
        return `
            <tr class="tr-row-modal"  style="cursor: pointer" id="row${index}">
                <td class="sort-text tr-ck" style="width: 40%">
                    <input type="text" class="form-control add-text" index="${index}" name="text${index}" required>
                    <div class="text-missing text-center mt-0" style="color: red; font-size: 0.8em;display:none">Missing value</div>
                </td>
                <td class="sort-name tr-ck" style="width: 40%">
                    <select class="form-select mb-0 add-procedure" index="${index}" name="procedure${index}" aria-label="Default select example" required>
                        <option value=""></option>
                        @foreach (isset($procedures)?$procedures:[] as $p)
                            @php
                                $p = (object) $p;
                            @endphp
                            <option value="{{@$p->name}}">{{@$p->name}}</option>
                        @endforeach
                    </select>
                    <div class="procedure-missing text-center mt-0" style="color: red; font-size: 0.8em;display:none">Missing value</div>
                </td>
                <td class="sort-department tr-ck" style="width: 40%;">
                    <select class="form-select add-department" index="${index}" name="department${index}" required>
                        <option value=""></option>

                        @foreach ($department as $data_department)

                        <option value="{{ $data_department->department_name }}">{{ $data_department->department_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td class="text-center">
                    <button class="btn btn-danger ms-2 delete-row" index="${index}" type="button" ><i class="ri-delete-bin-6-line delete-row"  index="${index}"></i></button>
                </td>
            </tr>
        `
    }


</script>

@endsection
