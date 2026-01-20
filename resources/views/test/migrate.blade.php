
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    /* .table-w tr td:nth-child(1){width: 20%;}
    .table-w tr td:nth-child(2){width: 15%;}
    .table-w tr td:nth-child(3){width: 20%;}
     */
     .border-right {
        border-right: 2px solid #000;
    }

    .center-cell {
        vertical-align: middle;
        text-align: center;
    }

</style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">CASE SETTING</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li id="top" class="breadcrumb-item"><a href="javascript: void(0);">Case Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection

@section('modal')
 <!-- Default Modals -->
<div id="confirm_delete_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <p class="text-muted">Do you want to delete these cases?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button id="confirm_modal_btn" type="button" class="btn btn-primary ">Confirm</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->   
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row m-3">
            
        </div>
        <div class="row m-0">
        </div>
        <div class="row mt-3"><hr></div>
        <div class="row m-0">
            <form action="{{url('migrate')}}" method="put">
                @method('PUT')
                @csrf
                <input type="hidden" name="event" value="search_table">
                <div class="row">
                    <div class="col-4">
                        <div>
                            <select name="tablename" id="" class="form-select " required>
                                <option value="patient"             @selected(@$tablename."" === 'tb_patient' )>patient</option>
                                @foreach ($tablenames??[] as $obj)
                                    @php
                                        $tbkey = "Tables_in_$databasename";
                                        $tbname = $obj->$tbkey ?? ''; 
                                        if($tbname == 'patient'){
                                            continue;
                                        }
                                    @endphp
                                    <option value="{{$tbname}}" @selected(@$tablename."" === $tbname)>{{$tbname}}</option>
                                @endforeach
                                {{-- <option value="tb_case"             @selected(@$tablename."" === 'tb_case' )>tb_case</option> --}}
                                {{-- <option value="tb_casemedication"   @selected(@$tablename."" === 'tb_casemedication' )>tb_casemedication</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary bg-gradient waves-effect waves-light">Search</button>
                        <a href="{{url('migrate')}}" type="button" class="btn btn-primary bg-gradient waves-effect waves-light">Clear</a>
                    </div>
                </div>
            </form>

            <div class="row">
                @if(@$tablename."" == 'tb_case')
                <form action="{{url('migrate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="event" value="convert_photos">
                    <button type="submit" class="btn btn-warning mt-3">Convert Mainpartsub Photo</button>
                </form>
    
                <form action="{{url('migrate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="event" value="convert_rooms">
                    <button type="submit" class="btn btn-warning mt-3">Convert Room</button>
                </form>
                @endif
            </div>

            
        </div>
    </div>
</div>
<div class="card">
    <form action="{{url('migrate')}}" class=" mb-3" method="post" id="migrate_data_form">
        @csrf
        <input type="hidden" name="event" value="migrate_data">
        <input type="hidden" name="tablename" value="{{@$tablename}}">

        <div class="row">
            <div class="col-8 border-right" >
                <div class="row p-0">
                    <div class="col-3"><h4 class="m-3">MYSQL</h4></div>
                    <div class="col-auto"><input type="text" onkeyup="search_key(this.value, 'data')" class="form-control ms-3 mt-3" placeholder="enter key name"></div>
                </div>
                <div class="row ms-3">
                    <span class="text-danger">หาก input เป็นค่าว่างหรือทำการ delete จะไม่นำ key นั้นเข้าไปในการ migrate</span>
                </div>
                <div class="table-responsive table-card table-w m-1 " style="max-width: 800px" >
                    <table class="table table-nowrap mb-0 " id="table-search">
                        <thead class="">
                            <tr>
                                <th></th>
                                <th scope="col">Original Key Name</th>
                                <th scope="col">Original Type</th>
                                <th scope="col">Example Data</th>
                                <th scope="col">New Key Name</th>
                                <th scope="col">New Type</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_data">
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($tabledata??[] as $keyname=>$keytype)
                                @php
                                    if($keyname == ""){
                                        continue;
                                    }

                                    $example_data = $exampledata[$keyname] ?? '';
                                    if ($example_data instanceof stdClass || is_array($example_data)) {
                                        $example_data = json_encode((array)$example_data);
                                    } else {
                                        $example_data = (string) $example_data;
                                    }

                                    $new_keyname = $default['table_data'][$keyname]['key']  ?? $keyname;
                                    $new_keytype = $default['table_data'][$keyname]['type'] ?? $keytype;

                                    // $new_keyname = '';
                                    // $new_keytype = '';
                                    // if(isset($default['table_data'][$keyname])){
                                    //     $new_keyname = $default['table_data'][$keyname]['key']  ?? $keyname;
                                    //     $new_keytype = $default['table_data'][$keyname]['type'] ?? $keytype;                                        
                                    //     dd($new_keyname, $new_keytype, $keyname, $default['table_data'][$keyname]['key']);
                                    // }
                                @endphp
                                <tr class="data{{$index}}">
                                    <td>{{$index}}</td>
                                    <td>{{@$keyname}} </td>
                                    <td>{{@$keytype}}</td>
                                    <td class="text-wrap" style="max-width: 150px">{{ strlen($example_data) > 80 ? substr($example_data, 0, 80) . '...' : $example_data }}</td>
                                    <td hidden><input type="text" class="form-control"  name="ori_key{{$keyname}}" value="{{@$keyname}}"></td>
                                    <td><input type="text" class="form-control newkey" data-original_key="{{@$keyname}}" data-type="key" name="new_key{{$keyname}}" value="{{@$new_keyname}}"></td>
                                    <td>
                                        <select class="form-select newtype" name="new_type{{$keyname}}" data-original_key="{{@$keyname}}" data-type="type">
                                            <option value=""></option>
                                            <option value="int" @if (strpos($new_keytype, 'int') !== false) selected @endif>int</option>
                                            <option value="string" @if (in_array($new_keytype, ['char', 'text', 'string', 'datetime', 'date', 'NULL'])) selected @endif>string</option>
                                            <option value="array" @if (strpos($new_keytype, 'array') !== false) selected @endif>array</option>
                                            <option value="bool" @if (strpos($new_keytype, 'bool') !== false) selected @endif>bool</option>
                                        </select>
                                    </td>
                                    <td><a href="javascript:void(0);" class="link-danger center-cell " onclick="remove_tr('{{$index}}', '{{@$keyname}}')">Delete</a></td>
                                </tr>
                                @php
                                    $index += 1;
                                @endphp
                            @endforeach
                            
            
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-10">
                        
                    </div>
                    <div class="col-2 d-flex justify-content-end mt-3">
                        <div class="d-flex align-items-left me-3 " >
                            <strong hidden>Loading...</strong>
                            <div class="spinner-border ms-auto spinner" role="status" aria-hidden="true" style="display: none"></div>
                        </div>
                        <button type="submit" class="btn btn-primary">Migrate</button>
                    </div>
                    
                </div>
            </div>
    </form>

            <div class="col-2 border-right">
                <div class="row p-0">
                    <div class="col-4"><h4 class="mt-3 ms-3">MONGODB</h4></div>
                    <div class="col-6"><input type="text" onkeyup="search_key(this.value, 'mongodata')" class="form-control ms-3 mt-3" placeholder="enter key name"></div>
                </div>
                
                <div class="table-responsive table-card table-w m-1 " style="max-width: 800px" >
                    <table class="table table-nowrap mb-0 " id="table-search">
                        <thead class="">
                            <tr>
                                <th></th>
                                <th scope="col">Key Name</th>
                                <th scope="col">Key Type</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_mongodata">
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($mongodata??[] as $keyname=>$keytype)
                                @php
                                    // 
                                @endphp
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>{{@$keyname}}</td>
                                    <td>{{@$keytype}}</td>
                                </tr>
                                @php
                                    $index += 1;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="col-2">
                <div class="row p-0">
                    <div class="col-auto"><h4 class="mt-3 ms-3">KEY DIFF</h4></div>
                </div>

                <div class="table-responsive table-card table-w m-1 " style="max-width: 800px" >
                    <table class="table table-nowrap mb-0 " id="table-search">
                        <thead class="">
                            <tr>
                                <th></th>
                                <th scope="col">Key Name</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_diff">
                            @foreach ($diffkeys??[] as $i=>$keyname)
                                <tr>
                                    <td>{{$i+1}}</td>
                                    <td>{{@$keyname}}</td>
                                </tr>
                            @endforeach
                            
            
                        </tbody>
                    </table>
            </div>
        </div>
    
    {{-- <div class="row my-2">
        <div class="col-lg-9"></div>
        <div class="col-lg-2" >
            <button type="button" style="float: right"  class="btn btn-primary btn-label waves-effect waves-light" onclick="to_top()">
                <i class="ri-arrow-up-line label-icon align-middle fs-16 me-2"></i> 
                Back to top
            </button>
        </div>
    </div> --}}
</div>

@endsection




@section('script')

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    function search_key(value, table){
        let search = value.toLowerCase()
        $(`#tbody_${table} tr`).filter(function () {
            $(this).toggle($(this).find('td:eq(1)').text().toLowerCase().indexOf(search) > -1)
        })
    }

    function remove_tr(index, original_key){
        $(`.data${index}`).remove()
        $.post('{{url("api/jquery")}}', {
            event:"remove_key_mysqlmigrate",
            original_key:original_key,
            tablename:"{{@$tablename}}",
        }, function (data, status) {console.log(data);})
    }

    $('.newkey, .newtype').on('focusout', function () {
        let original_key = $(this).data('original_key')
        let type = $(this).data('type')
        let value = $(this).val()
        $.post('{{url("api/jquery")}}', {
            event:"set_mysqlmigrate",
            original_key:original_key,
            type:type,
            tablename:"{{@$tablename}}",
            value:value
        }, function (data, status) {})
    })

    

    $('#migrate_data_form').on('submit', function (e) {
        // let is_key   = false
        // let is_type  = false
        // $('.newkey').each(function () {
        //     if($.trim($(this).val()) === ''){
        //         is_key = true
        //     }
        // })

        // $('.newtype').each(function () {
        //     if($.trim($(this).val()) === ''){
        //         is_type = true
        //     }
        // })

        // if(is_key || is_type){
        //     e.preventDefault()
        //     if(is_key){
        //         alert('Please fill in all required fields.');
        //     }

        //     if(is_type){
        //         alert('Please select types');
        //     }
        // } else {
        //     $('.spinner').css('display', 'block')
        // }
        $('.spinner').css('display', 'block')
    })


</script>

@endsection
