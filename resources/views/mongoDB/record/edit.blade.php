@extends('layouts.layouts_empty')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .card-data{
        height: 80vh;
        overflow-y: auto;
    }
    .card-list{
        height: 85vh;
        overflow-y: auto;
    }
    td{
        white-space: nowrap;
    }
    .menu-search{
        display: none;
    }
    .menu-search.active{
        display: block;
    }
    /* .list-head:nth-child(1){
        border-bottom: 1px solid gray;
    }
    .list-head:nth-child(2){
        border-bottom: 1px solid gray;
        border-left: 1px solid gray;
    }
    .list-head:nth-child(3){

    } */
    .ri-arrow-right-up-line{
        position: absolute;
        right: -10px;
        font-size: 3em;
        /* top: 5px; */
    }
    .page-center nav{
        width: fit-content;
        margin: auto;
    }

.progress-container {
  display: flex;
  justify-content: space-between;
  position: relative;
  margin-bottom: 30px;
  max-width: 100%;
  width: 350px;
}

.progress-container::before {
  content: ''; /*your have to write this to be able to see it*/
  background-color: lightgrey;
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  height: 4px;
  width: 100%; /*it represents the empty line*/
  z-index: -1;
}

.progress {
  background-color: blue;
  position: absolute;
  top: 50%;
  left: 0;
  transform: translateY(-50%);
  height: 4px;
  width: 0%;
  z-index: -1;
  transition: 0.4s ease;
}

.circles {
  background-color: white;
  color: #999;
  border-radius: 50%;
  height: 30px;
  width: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  border: 3px solid lightgray;
  transition: 0.4s ease;
}

.circles.active {
  border-color: blue;
}
/* .box-load{width: 3em;height: 3em;border-radius: 50%;border: 1px solid gray;margin: auto;} */
.box-load i{display: none;font-size: xx-large;}
.box-load.success{border-color: #099885;}
.box-load.error{border-color: #f06548;}
.box-load.success .ri-checkbox-circle-fill{display: block;}
.box-load.error .ri-error-warning-fill{display: block;}
</style>
@endsection
@section('modal')
{{-- show array data --}}
<div id="show_array_data_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="array_head">Head</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <form action="{{url('mongodb')}}/record" method="post" id="update_array_form">
                @csrf
                @method('post')
                <input type="hidden" name="event" value="update_array_data">
                <input type="hidden" name="field">
                <div class="modal-body" >
                    <div id="array_body"></div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary" onclick="hide_modal('show_array_data_modal')">Save</button> --}}
                {{-- <button type="button" class="btn btn-primary ">Save Changes</button> --}}
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection

@section('content')



<div class="card m-0">
    <div class="card-body">
        <div class="row m-0">
            <div class="col-xl-9 p-0">
                @php
                    $action_str = $action=='edit' ? 'Edit Record' : 'Clone Record';     
                    $btn_str    = ucfirst($action);
                @endphp
                <h3 class="mb-2">
                    <a href="{{url('')}}/mongodb/browse/{{$table_name}}?page={{$page}}" class="btn btn-info" style=" width:auto">Back</a>
                    {{$action_str}} : {{$table_name}}</h3>
                {{-- @dd(url('').'/mongodb/record') --}}
                    <form action="{{url('')}}/mongodb/record" method="post" id="submit_record">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="event" value="{{$action}}_record">
                        <input type="hidden" name="record_id" value="{{@$_id}}">
                        <input type="hidden" name="table_name" value="{{@$table_name}}">
                        <input type="hidden" name="action" value="{{@$action}}">
                        @foreach ($record as $key=>$data)
                        <div class="row mb-2">
                            @php
                                $is_clone = ($action == 'clone') && ($key == '_id')  ? 'hidden disabled' : '';
                            @endphp
                            <div class="col-3">
                                <span class="fw-bol" {{$is_clone}}>{{$key}} :</span>
                            </div>
                            @if (isset($data))
                            @php
                                $type = gettype($data);
                                if(is_array($data)){
                                    $data = json_encode($data);
                                } else if($type=='boolean'){
                                    $data = $data==true ? 'true' : 'false';
                                } else {
                                    $data = $data;
                                }
                                $data = is_array($data) ?  : $data;
                                $is_id = ($key == '_id') || (gettype($data) == 'object') || $type == 'array' ? 'readonly' : '';
                                $is_array = 
                                $inp_type = '';
                                $is_bool  = ($type=='boolean') ? true  : false;
                                if($type == 'boolean'){
                                    $inp_type = '';
                                } elseif($type == 'integer'){
                                    $inp_type = 'number';
                                } else {
                                    $inp_type ='text';
                                }

                                // $is_array = (gettype($data) == 'array') ? 'this_array' : ''; 

                            @endphp
                                @if ($type == 'boolean')
                                    <div class="col-7">
                                        <select class="form-control form-control-sm" name="{{$key}}" id="">
                                            <option value="">choose value</option>
                                            <option value="true" @if($data=='true') selected @endif>true</option>
                                            <option value="false" @if($data=='false') selected @endif>false</option>
                                        </select>
                                    </div>
                                @else
                                    @php
                                        $arr_type = ($type=='array') ? 'is_array' : '';
                                    @endphp
                                    <div class="col-7">
                                        <button id="array_data_btn" type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#show_array_data_modal" hidden>Center Modal</button>
                                        <input type="{{$inp_type}}" name="{{$key}}" class="form-control form-control-sm {{@$arr_type}}" value="{{@$data}}" {{$is_id}} {{$is_clone}} @if($type == 'array') onclick="show_array_data('{{@$data}}', '{{@$key}}', '{{strval($_id)}}')" @endif>
                                    </div>
                                @endif
                            @else
                                <div class="col-7">
                                    @php
                                        $arr_empty = ($type=='array') ? '[]' : '';
                                    @endphp
                                    <input type="text" name="{{$key}}" class="form-control form-control-sm" value="{{$arr_empty}}" {{$is_id}}>
                                </div>
                            @endif
                            <div class="col-1">
                                <span  class="fw-bol" {{$is_clone}}>{{@$type}}</span>
                                <input type="hidden" name="{{$key}}_type" value="{{@$type}}" {{$is_clone}}>
                            </div>
                            @if ($key!='_id')
                                <div class="col-1">
                                    <button type="button" id="{{$key}}_del" class="btn btn-danger btn-sm" onclick="delete_data('{{$_id}}', '{{$table_name}}', '{{$key}}', '{{@$data}}', '{{$type}}')"><i class="las la-trash" style="font-size: 14px"></i></button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div class="row" id="more_field">
                        <input type="hidden" name="num_more_field" id="num_more_field" value="0">
                    </div>
                    <br>
                    <div class="row mb-3 m-3">
                        <button type="button" id="add_more_field" class="btn btn-info btn-sm">Add More Field</button>
                    </div>
                    <div class="row">
                        <div class="col-10"></div>
                        <div class="col-1">
                            {{-- <a href="{{url('')}}/mongodb/browse/{{$table_name}}?page={{$page}}" class="btn btn-info" style="float:right; width:auto">Back</a> --}}
                        </div>
                        <div class="col-1">
                            <button type="text" id="submit_btn" name="action" value="{{$action}}" class="btn btn-primary" style="float:right">{{@$btn_str}}</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-3 p-0">
                
                
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script src="{{asset('public/js/jquery-ui-1.12.1.min.js')}}"></script>

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $('#add_more_field').on('click', function () {
        var key_lg = $('.key-inp').length
        var value_lg = $('.value-inp').length
        $('#more_field').append(`
            <div class="col-3 mb-2">
                <span class="fw-bol">
                    <input type="text" class="form-control form-control-sm key-inp" name="${key_lg}_key" id="${key_lg}_key">
                </span>
            </div>
            <div class="col-7 mb-2">
                <input type="text" name="${value_lg}_value" id="${value_lg}_value" class="form-control form-control-sm value-inp" value="" >
            </div>
            <div class="col-1" >
                <select name="${value_lg}_type" id="${value_lg}_value" class="form-control form-control-sm">
                    <option value="">choose value</option>
                    <option value="string">string</option>
                    <option value="boolean">boolean</option>
                    <option value="array">array</option>
                    <option value="integer">integer</option>
                </select>
            </div>
            <div class="col-1">
                <button type="button" id="${value_lg}_del" class="btn btn-danger btn-sm" onclick="delete_row('${value_lg}')"><i class="las la-trash" style="font-size: 14px"></i></button>
            </div>
        `)
        var num_field = $('#num_more_field').val()
        var new_num_field = parseInt(num_field) + 1
        $('#num_more_field').val(new_num_field)
    })

    function delete_row(num_id) {
        $(`#${num_id}_key`).remove()
        $(`#${num_id}_value`).remove()
        $(`#${num_id}_type`).remove()
        $(`#del_${num_id}`).remove()
    }

    function delete_data(id, table_name, key, value, type) {
        Swal.fire({
            title: `ยืนยันการลบ ${key}`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'ยืนยัน',
            denyButtonText: `ยกเลิก`,
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.post("{{url('api/jquery')}}", {
                    event       : "delete_field_mongo",
                    key         : key,
                    tablename   : table_name,
                    id          : id,
                    value       : value,
                    type        : type
                },function(data, status) {
                    setTimeout(() => {
                        location.reload()
                    }, 1 * 500);
                });
        } else if (result.isDenied) {
            
        }
        })
    }

    // $('.is_array').on('click', function () {
    //     $('#array_data_btn').click()
    // })

    function show_array_data(array_data, head, _id) {
        // console.log(array_data, head, _id);
        $('#array_body').empty()

        $('#array_data_btn').click()
        $('#array_head').html(head)
        // $('#test_data').html(array_data)
        $('#field').val(head)

        var decode_data = JSON.parse(array_data)
        var keys = Object.keys(decode_data) 

        
        try {
            decode_data.forEach((data, i) => {
                create_data_div(data, i, keys, 'array_body', head, _id)
            });
        } catch {
            var key_lg   = keys.length
            for (let j = 0; j < key_lg; j++) {
                create_data_div(decode_data[keys[j]], j, keys, 'array_body', head, _id)
            }
        }

        $(".can-sort").parent().sortable({});

        $('#array_body').append(`
            <div id="more_field_modal"></div>
        `)

        $('#array_body').append(`
            <div class="row mt-2 mb-3">
                <button type="button" id="add_field_array_btn" class="btn btn-info btn-sm" onclick="add_more_field_array('${head}', 'add_field_array_btn')">Add More Field</button>
            </div>
        `)
    }

    function array_data(div_id, arrow_id, id) {
        var is_right_arrow = $(`#${arrow_id}`).hasClass('la-caret-right')
        var split     = arrow_id.split('-')
        var field     = split[0]
        var index     = split[1]
        var tablename = '{{$table_name}}'
        var _id       = id
        if(is_right_arrow){
            $.post('{{url("api/jquery")}}', {
                event       : 'get_array_data',
                tablename   : tablename,
                _id         : _id,
                field       : field,
                index       : index
            }, function(data, status) {
                var data_parse = JSON.parse(data)
                $(`#${arrow_id}`).removeClass('la-caret-right').addClass('la-caret-down')
                $(`#${div_id}`).after(`<div id="sub_${div_id}"></div>`)
                var sub_keys = Object.keys(data_parse) 
                var key_lg   = sub_keys.length
                for (let j = 0; j < key_lg; j++) {
                    create_data_div(data_parse[sub_keys[j]], j, sub_keys, `sub_${div_id}`, `sub_sub_${field}`, _id, index)
                    if(j ==  key_lg - 1){
                        $(`#sub_${div_id}`).append(`
                            <div id="${index}_${field}_div" class="row mt-2 mb-3"></div>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-8" style="display: block"><button type="button" id="${index}_${field}_btn" class="btn btn-info btn-sm" style="width: 100%" onclick="add_more_item('${index}', 'sub_sub_${field}', '${index}_${field}_div')">Add More Items</button></div>
                                <div class="col-3"></div>
                            </div>
                        `)
                    }
                }                
            });
        } else {
            $(`#${arrow_id}`).removeClass('la-caret-down').addClass('la-caret-right')
            $(`#sub_${field}_${index}`).remove()
            // or index is a number
            var keyname_lg = $('.key-name-div').length
            for (let i = 0; i < keyname_lg; i++) {
                var text = $($('.key-name-div')[i]).text()
                if(text.includes(index)){
                    $(`#sub_${field}_${i}`).remove()
                }
            }
        }

        
        
    }

    function create_data_div(data, i, keys, append_div_id, head, _id, main_key=""){
        var data_type    = (data != null) && (data != undefined) ? typeof(data) : 'null'
        var is_show      = 'none'
        var is_data_show = 'block'
        if(data_type == 'object'){
            is_show      = 'block'
            is_data_show = 'none'
        }
        i = parseInt(i)
        var key       = keys[i]
        var line_vertical = append_div_id == 'array_body' ? '<hr>' : ''
        $(`#${append_div_id}`).append(`
        <div class="can-sort" id="div${i}" style="cursor: move">
            <div class="row mt-2 mb-3" id="${head}_${i}">
                <div class="col-1">
                    <i id="${head}-${key}" class="las la-caret-right" style="font-size: 14px; display: ${is_show}; cursor: pointer" onclick="array_data('${head}_${i}', '${head}-${key}', '${_id}')"></i>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-3 key-name-div" style="word-wrap: break-word;">${key}: </div>

                        <div class="col-9" style="word-wrap: break-word;">
                            <span style="display: ${is_data_show}">
                                <input type="hidden" name="key_${main_key}_${key}" class="form form-control" value="${key}">
                                <input type="text" name="value_${main_key}_${key}" id="value_${main_key}_${key}" class="form form-control" value="${data}" >
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    ${data_type}
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-4"><button type="button" id="edit_data" class="btn btn-primary btn-sm" onclick="save_array_data('${main_key}', '${key}', 'value_${main_key}_${key}', '${head}', '${_id}')" style="display: ${is_data_show}"><i class="las la-save" style="font-size: 14px"></i></button></div>
                        <div class="col-4"><button type="button" id="key_value_mod_del" class="btn btn-danger btn-sm" onclick="delete_items_data('${main_key}', '${key}', 'value_${main_key}_${key}', '${head}')"><i class="las la-trash" style="font-size: 14px"></i></button></div>
                    </div>
                </div>
            </div>
            ${line_vertical}
        </div>
        `)        
        
    }

    function save_array_data(mainkey, key, inp_id, head, _id){
        $.post("{{url('api/jquery')}}", {
            event       : "edit_field_array_mongo",
            _id         : _id,
            tablename   : '{{$table_name}}',
            head        : head,
            main_key    : mainkey,
            key         : key,
            data        : $(`#${inp_id}`).val(),
        },function(data, status) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your data has been saved',
                showConfirmButton: false,
                timer: 1000
            })
        });
    }

    // close event modal
    $("#show_array_data_modal").on("hidden.bs.modal", function () {
        // send post request in case re-index items in array
        var all_indexdiv = []
        var indexdiv_num = $('.can-sort').length
        for (let i = 0; i < indexdiv_num; i++) {
            var div_id = $($('.can-sort')[i]).attr('id')
            div_id = div_id.replace('div', '')
            all_indexdiv.push(div_id)
        }

        $.post("{{url('api/jquery')}}", {
            event       : "reindex_items_mongo",
            _id         : '{{$_id}}',
            tablename   : '{{$table_name}}',
            field       : $('#array_head').text(),
            indexs      : all_indexdiv
        },function(data, status) {

        });

        setTimeout(() => {
            location.reload()
        }, 500);

    });

    function hide_modal(modal_id) {
        var this_modal = document.querySelector('#'+modal_id);
        var modal = bootstrap.Modal.getInstance(this_modal);    
        modal.hide();
    }

    function add_more_item(key, head, div_id){
        var index = key
        var field = head.replace('sub_sub_', '')
        var item_lg = $('.more-items').length
        create_add_field_array(index, field, item_lg, div_id, 'more-items')
    }

    function add_more_field_array(head, btn_id){
        var field_lg = $('.more-fields').length
        create_add_field_array('', head, field_lg, 'more_field_modal', 'more-fields')
    }

    function save_items_data(index, field, item_lg, is_main) {
        var item_key = $(`#${index}_${field}_${item_lg}_${is_main}key`).val()
        var item_val = $(`#${index}_${field}_${item_lg}_${is_main}value`).val()
        var item_type = $(`#${index}_${field}_${item_lg}_${is_main}type`).val()
        $.post("{{url('api/jquery')}}", {
            event       : "add_field_items_mongo",
            _id         : '{{$_id}}',
            tablename   : '{{$table_name}}',
            head        : field,
            index         : index,
            item_key    : item_key,
            item_val    : item_val,
            item_type   : item_type,
            is_main     : is_main
        },function(data, status) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your data has been saved',
                showConfirmButton: false,
                timer: 1000
            })
        });
    }

    function create_add_field_array(index, field, item_lg, div_id, classname){
        // console.log(index, field, item_lg, div_id, classname);
        var show_arrow = (div_id == 'more_field_modal') ? '' : '<div class="col-1"></div>' 
        var is_main    = (div_id == 'more_field_modal') ? 'main' : ''
        var to_create  = `
        <div class="row ${classname} mb-3" id="${index}_${field}_${item_lg}_${is_main}div">
            <div class="col-8">
                <div class="row">
                    <div class="col-3" style="word-wrap: break-word;">
                        <input type="text" id="${index}_${field}_${item_lg}_${is_main}key" class="form form-control">
                    </div>

                    <div class="col-9" style="word-wrap: break-word;">
                        <input type="text" id="${index}_${field}_${item_lg}_${is_main}value" class="form form-control">
                    </div>
                </div>
            </div>
            <div class="col-2">
                <select id="${index}_${field}_${item_lg}_${is_main}type" class="form form-control" style="width:100%">
                    <option value="">choose value</option>
                    <option value="string" selected>string</option>
                    <option value="boolean">boolean</option>
                    <option value="array">array</option>
                    <option value="integer">integer</option>
                </select>
            </div>
            <div class="col-1">
                <div class="row">
                    <div class="col-6 m-0 p-0">
                        <button type="button" class="btn btn-primary btn-sm" onclick="save_items_data('${index}', '${field}', '${item_lg}', '${is_main}')">
                            <i class="las la-save" style="font-size: 14px"></i>
                        </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-danger btn-sm" onclick="delete_items_row('${index}', '${field}', '${item_lg}', '${is_main}')">
                            <i class="las la-trash" style="font-size: 14px"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        `
        $(`#${div_id}`).append(to_create)
    }

    function delete_items_row(key, head, item_lg, is_main) {
        $(`#${key}_${head}_${item_lg}_${is_main}div`).remove()
    }

    function delete_items_data(mainkey, key, inp_id, head, _id) {
        Swal.fire({
            title: `ยืนยันการลบ ${key}`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: 'ยืนยัน',
            denyButtonText: `ยกเลิก`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.post("{{url('api/jquery')}}", {
                event       : "delete_field_items_mongo",
                _id         : '{{$_id}}',
                tablename   : '{{$table_name}}',
                head        : head,
                main_key    : mainkey,
                key         : key,
                data        : $(`#${inp_id}`).val(),
            },function(data, status) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your data has been deleted',
                    showConfirmButton: false,
                    timer: 1000
                })
            });
        } else if (result.isDenied) {
            
        }
        })

        
    }


</script>


@endsection
