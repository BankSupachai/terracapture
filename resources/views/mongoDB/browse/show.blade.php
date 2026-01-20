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

.tab {
    display: inline-block;
    padding-left: 50%;
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
<div class="modal fade" id="edit_data" tabindex="-1" aria-labelledby="edit_data_text" aria-hidden="true">
    <div class="modal-dialog">
        {{-- <form action="{{url('mongodb/browse')}}" method="POST" class="modal-content"> --}}
        <form action="{{url('mongodb/record')}}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="edit_data_text">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="event"  value="edit_record">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="table" id="table">
                <input type="hidden" name="column" id="column">
                <input type="hidden" name="var_type" id="var_type">
                <input type="text" name="text" id="text" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-soft-dark waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>


<!-- Import -->
<div class="modal fade" id="modal_import" tabindex="-1" aria-labelledby="modal_import_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_import_label">Import
                    <b id="import_table">{{$tablename}}</b>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('mongo')}}"  method="POST" enctype="multipart/form-data" class="modal-body">
                @method('POST')
                @csrf
                <input type="hidden" name="collection" value="{{$tablename}}">
                <input type="hidden" name="event" value="import">
                <div class="row m-0">
                    <div class="col-12">
                        <input type="file" name="file" id="" class="form-control" accept=".json">
                    </div>
                </div>
                <div class="row m-0 mt-3">
                    <div class="col-auto">
                        <button type="button" class="btn btn-soft-dark waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-info w-100">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Export -->
<div class="modal fade" id="modal_export" tabindex="-1" aria-labelledby="modal_export_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_export_label">Export <b id="export_table">{{$tablename}}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('mongo')}}"  method="POST" enctype="multipart/form-data" class="modal-body">
                @method('POST')
                @csrf
                <input type="hidden" name="collection" value="{{$tablename}}">
                <input type="hidden" name="event" value="export">
                <div class="row m-0">
                    <div class="col-auto">
                        <button type="button" class="btn btn-soft-dark waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-info w-100">Export</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Clear -->
<div class="modal fade" id="modal_clear" tabindex="-1" aria-labelledby="modal_clear_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_clear_label">Clear <b id="clear_table">{{$tablename}}</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('mongo')}}"  method="POST" enctype="multipart/form-data" class="modal-body">
                @method('POST')
                @csrf
                <input type="hidden" name="event" value="clear">
                <input type="hidden" name="collection" value="{{$tablename}}">
                <div class="row m-0">
                    <div class="col-auto">
                        <button type="button" class="btn btn-soft-dark waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-warning w-100">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_clear_all" tabindex="-1" aria-labelledby="modal_clear_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_clear_label">Clear all data in <b id="clear_table">{{$tablename}}</b>?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('mongo')}}"  method="post" enctype="multipart/form-data" class="modal-body">
                @csrf
                <input type="hidden" name="event" value="clear_all">
                <input type="hidden" name="collection" value="{{$tablename}}">
                <div class="row m-0">
                    <div class="col-auto">
                        <button type="button" class="btn btn-soft-dark waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-warning w-100">Confirm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Loading -->
<div class="modal fade" id="modal_load" tabindex="-1" aria-labelledby="modal_load_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row m-0">
                    @for($i=0;$i<3;$i++)
                    <div class="col-4 text-center">
                        <div class="box-load">
                            <i class="ri-error-warning-fill text-danger"></i>
                            <i class="ri-checkbox-circle-fill text-success"></i>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

{{-- delete record --}}
<div class="modal fade" id="delete_record_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Record</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            _id : <span id="del_id"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="" id="delete_href" type="button" class="btn btn-primary">Confirm</a>
        </div>
      </div>
    </div>
</div>

{{-- show array data --}}
<div id="show_array_data_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="array_head">Head</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body" id="array_body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary ">Save Changes</button> --}}
            </div>

        </div>
    </div>
</div>

{{-- create table --}}
<div class="modal fade" id="create_table_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="array_head">Create Table</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body" id="">
                <form action="{{url('mongodb')}}/browse" method="post">
                    @csrf
                    <input type="hidden" name="event" value="create_table">
                    <div class="row">
                        <div class="col-12">
                            <label for="table_name" class="form-label">Table Name</label>
                            <input type="text" class="form-control" id="table_name" name="table_name" required>
                            <div id="table_name_alert" class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show mt-2" role="alert" style="display: none">
                                <i class="ri-error-warning-line label-icon"></i>
                                Table <span id="table_name_span"></span> already exists.
                                <button type="button" id="close_error" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        <button id="create_table_submit" type="submit" hidden></button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="create_table_btn">Create</button>
            </div>

        </div>
    </div>
</div>
@endsection

@section('content')

<div class="card m-0">
    <div class="card-body">
        <div class="row m-0">
            <div class="col-xl-4 p-0">
                <div class="w-100 btn-head">
                    <div class="row m-0">
                        <div class="col-6 p-0 list-head border-bottom border-dark text-center"><h3>Database</h3></div>
                        <div class="col-6 list-head">
                            <button type="button" class="btn btn-success btn-label waves-effect waves-light w-100" onclick="process_mongo('import')"><i class="ri-download-2-fill label-icon align-middle fs-16 me-2"></i> Import All</button>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="col-6 p-0 text-center">
                            <div class="row">
                                <div class="col-8"><h3 class="mt-2"><span class="tab">Table</span></h3></div>
                                <div class="col-4">
                                    <button type="button" style="float: right" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#create_table_modal">
                                        Create Table
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 list-head border-bottom border-start border-dark">
                            <button type="button" class="btn btn-primary btn-label waves-effect waves-light w-100 mt-2 mb-2" onclick="process_mongo('export')"><i class="ri-upload-2-fill label-icon align-middle fs-16 me-2"></i> Export All</button>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="input-group">
                        <input id="search_table" type="text" class="form-control" placeholder="Enter Table Name" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="quick_search()" hidden>Search</button>
                    </div>
                </div>
                <br>
                <div class="card-list">
                    <div class="list-group list-group-fill-success">
                        @foreach ($alltable as $data)
                            <a href="{{ url("mongodb/browse/$data") }}" class="list-group-item list-group-item-action @if(Request::segment(3)==$data) active @endif">{{ $data }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-8 p-0">
                <h3>{{$tablename}}</h3>
                <div class="row m-0 mb-2">
                    <div class="pt-1 col-lg-auto">
                        <button class="btn btn-success" id="import_json" data-bs-toggle="modal" data-bs-target="#modal_import">Import</button>
                    </div>
                    <div class="pt-1 col-lg-auto">
                        <button class="btn btn-info" id="export_json" data-bs-toggle="modal" data-bs-target="#modal_export">Export</button>
                    </div>
                    <div class="pt-1 col-lg-auto">
                        <button class="btn btn-warning" id="clear_json" data-bs-toggle="modal" data-bs-target="#modal_clear">Clear</button>
                    </div>
                    <div class="pt-1 col-lg-auto">
                        <button class="btn btn-warning" id="clear_all" data-bs-toggle="modal" data-bs-target="#modal_clear_all">Clear All</button>
                    </div>
                    <div class="pt-1 col-lg"></div>
                    <div class="pt-1 col-lg-auto">
                        <button class="btn btn-primary" onclick="menu_search()">Search</button>
                    </div>
                </div>
                <div class="row m-0 mt-2 menu-search" style="display: @isset($key) @if(count($key) > 0) block @endif  @endisset">
                    <div class="col-xl-12">
                        <div class="row m-0">
                            @foreach ($tableheader as $index=>$data)
                            <div class="col-3 mt-3">
                                @php
                                    $value = '';
                                    if(isset($key)){
                                        $value = isset($key[$data]) ? $key[$data] : '';
                                    }
                                @endphp
                                <form action="{{url('mongodb')}}/browse" method="post">
                                    @csrf
                                    <input type="hidden" name="tablename" value="{{@$tablename}}">
                                    <input type="hidden" name="event" value="search_data">
                                    <div class="form-floating">
                                        <input type="text" class="form-control form-control-sm" id="basiInput_{{$data}}" name="key_{{$data}}"
                                        {{-- onkeyup='myFunction({{$index+1}},"basiInput_{{$data}}")' --}}
                                        placeholder="{{$data}}"
                                        value="{{$value}}"
                                        >
                                        <label for="basiInput_{{$data}}" class="form-label mb-1">{{$data}}</label>
                                    </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row m-0 my-3">
                            <div class="col-xl-12">
                                <button type="submit" class="btn btn-success" style="width: 100%">Find</button>
                            </div>
                            <div class="col-xl-12 mt-3">
                                <a href="{{url('mongodb')}}/browse/{{@$tablename}}?page=1" class="btn btn-danger" style="width: 100%">Reset</a>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="card-data mt-2">
                    <div class="col-12">
                        <table class="table table-bordered" id="myTable">
                            <tr>
                                <th>Action</th>
                                @foreach ($tableheader as $data)
                                    <th class="data-key">{{ $data }}</th>
                                @endforeach
                            </tr>
                            @foreach ($table as $data)
                                    <tr id="tr{{$data->id}}" class="data-row">
                                    <td style="max-width:150px" >
                                        <div class="row" >
                                            <div class="col-1 me-3 mt-2" ><button type="button" class="btn btn-primary btn-sm" onclick="to_action('{{$data->id}}','copy')"><i class="las la-copy" style="font-size: 16px"></i></button></div>
                                            <div class="col-1 me-3 mt-2" ><button type="button" class="btn btn-info btn-sm" onclick="to_action('{{$data->id}}','clone')"><i class="las la-sticky-note" style="font-size: 16px"></i></button></div>
                                            <div class="col-1 me-3 mt-2" ><button type="button" class="btn btn-info btn-sm" onclick="to_action('{{$data->id}}','edit')"><i class="las la-edit" style="font-size: 16px"></i></button></div>
                                            <div class="col-1 me-3 mt-2" ><button type="button" class="btn btn-danger btn-sm" onclick="to_action('{{$data->id}}','delete')"><i class="las la-trash-alt" style="font-size: 16px"></i></button></div>
                                        </div>
                                    </td>
                                    @foreach ($tableheader as $data02)

                                        @isset($data->$data02)
                                            @if(gettype(@$data->$data02)=="string" || gettype(@$data->$data02)=="integer" || gettype($data->$data02)=='object' || gettype($data->$data02)=='boolean' )

                                                <td class="onecell data-value" fixid="{{$data->id}}" oldvalue="{{@$data->$data02}}" field="{{$data02}}" var_type="{{gettype(@$data->$data02)}}">
                                                    @if($data02=="id") {{@strval($data->id)}} @elseif(gettype($data->$data02)=='boolean') {{$data->$data02=='true'?'true':'false'}} @else {{@$data->$data02}} @endif
                                                </td>
                                            @elseif(gettype(@$data->$data02)=="array")
                                            @php
                                                $imp = is_array($data->$data02) ? json_encode($data->$data02) : $data->$data02;
                                            @endphp
                                                {{-- <td class="onecell data-value" fixid="{{$data['_id']}}" oldvalue="{{@$imp}}" field="{{$data02}}" var_type="{{gettype(@$data[$data02])}}">
                                                    {{@$imp}}
                                                </td>    --}}
                                                <td>
                                                    <p hidden>{{@$img}}</p>
                                                    <button id="array_data_btn" type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#show_array_data_modal" hidden>Center Modal</button>
                                                    <button type="button" class="btn rounded-pill btn-primary wave-effect waves-light" onclick="show_array_data('{{@$imp}}', '{{@$data02}}', '{{strval($data->id)}}')">Data</button>
                                                </td>

                                            @else
                                                @if(gettype(@$data->$data02)=="NULL")
                                                    <td var_type="">
                                                        NULL
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                            @endif
                                        @endisset

                                        @if(isset($data->$data02)==false)
                                            <td class="onecell data-value" fixid="{{$data->id}}" oldvalue="" field="{{$data02}}" var_type="">

                                            </td>
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                            <button type="button" id="del_rec_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#delete_record_modal" hidden>ppp</button>
                        </table>
                    </div>
                </div>
                <div class="col-12 page-center mt-4">
                    @if (is_array($table) == false)
                        @if( $table->hasPages() )
                            @php
                                $this_page = isset($table) ? count($table) : 0;
                                $start     = (isset($page)) ? ((intval($page) - 1) * $paginate) + 1 : 1;
                                $end       = ($start + intval($this_page)) - 1;
                            @endphp
                            <p class="text-center">{{@$start}} - {{@$end}} row(s)</p>
                            @if (isset($event))
                            @php
                                $arr['search']  = 'true';
                            @endphp
                                {!! $table->appends($arr)->links() !!}
                            @else
                                {!! $table->links() !!}
                            @endif
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>



@endsection


@section('script')
<script src="{{url("public/js/jquery-3.6.0.min.js")}}"></script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function menu_search() {
        if($('.menu-search').hasClass('active')){
            $('.menu-search').removeClass('active')
        }else{
            $('.menu-search').addClass('active')
        }

    }
    $(".onecell").click(function(){
        var id          = $(this).attr("fixid");
        var tablename   = "{{$tablename}}";
        var oldvalue    = $(this).attr("oldvalue");
        var field       = $(this).attr("field");
        var vartype     = $(this).attr('var_type');
        console.log(id,tablename,oldvalue,field, vartype);
        $("#id").val(id)
        $("#table").val(tablename)
        $("#text").val(oldvalue)
        $("#column").val(field)
        $('#var_type').val(vartype)
        $("#edit_data_text").text(field)
    });
</script>
<script>
    function myFunction(id,myid) {
        var input, filter, table, tr, td, i;
        input = document.getElementById(myid);
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        console.log(tr);
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[id];
            console.log(td, id,myid);
            if (td) {
                console.log(td.innerHTML.toUpperCase().indexOf(filter));
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }
        }


    }

    function quick_search() {
        var tablename = $('#search_table').val()
        location.href = `{{url('mongodb')}}/browse/${tablename}`
    }

    $('#search_table').keypress(function (e) {
        var key = e.which
        if(key == 13){
            quick_search()
            return false
        }
    })

    function process_mongo(process) {
        var myModal = new bootstrap.Modal(document.getElementById("modal_load"), {});
        document.onreadystatechange = function () {
            myModal.show();
        };
        $($(".box-load")[0]).addClass('success')
        $.get("{{url("mongodb/dump")}}/"+process,
        {
        // event       : ''
        },
        function(data, status) {
            $($(".box-load")[1]).addClass('success')
            if(data=='success'){
                setTimeout(() => {
                    $($(".box-load")[2]).addClass('error')

                    location.reload();
                }, 700);
            }
        })
    }

    function to_action(id, action){
        var url = "{{url('')}}/mongodb/record/"+id+"?event="+action+"&table={{@Request::segment(3)}}&page={{@$page}}"
        if(action == 'copy'){
            copy_data(id)
            alert('copy to clipboard')
        } else if(action == 'delete'){
            $('#del_rec_btn').click()
            $('#delete_href').attr('href', url)
            $('#del_id').html(id)
        } else {
            window.location.href = url
        }
    }

    function copy_data(id){
        var data_lg = $('.data-key').length
        var str = {}
        var substr = {}
        for (i = 0; i < data_lg; i++) {
            var key_text = $($('.data-key')[i]).html()
            var value_text = $($(`#tr${id}`).find('.data-value')[i]).html()
            value_text = (value_text!=''&&value_text!=undefined) ? value_text : ''
            console.log(value_text);
            if(key_text == '_id'){
                substr['oid'] = value_text.replace(/\s+/g, "")
                str[key_text] = substr
            } else {
                str[key_text] = value_text.replace(/\s+/g, "")
            }
        }

        var text = JSON.stringify(str, null, '\t')
                    .replaceAll(
                        "],\n\t\"",
                        "],\n\n\t\""
                    );
        navigator.clipboard.writeText(text)
    }

    function getKeyByValue(object, value) {
        return Object.keys(object).find(key => object[key] === value);
    }

    function show_array_data(array_data, head, _id) {
        $('#array_body').empty()

        $('#array_data_btn').click()
        $('#array_head').html(head)
        $('#test_data').html(array_data)

        var decode_data = JSON.parse(array_data)
        var keys = Object.keys(decode_data)

        try {
            decode_data.forEach((data, i) => {
                create_data_div(data, i, keys, 'array_body', head, _id)
            });
        } catch {
            // alert('error')
            var key_lg   = keys.length
            for (let j = 0; j < key_lg; j++) {
                create_data_div(decode_data[keys[j]], j, keys, 'array_body', head, _id)
            }
        }
    }

    function array_data(div_id, arrow_id, id) {
        var is_right_arrow = $(`#${arrow_id}`).hasClass('la-caret-right')
        var split     = arrow_id.split('-')
        var field     = split[0]
        var index     = split[1]
        var tablename = '{{$tablename}}'
        var _id       = id
        if(is_right_arrow){
            $.post('{{url("api/jquery")}}', {
                event       : 'get_array_data',
                tablename   : tablename,
                _id         : _id,
                field       : field,
                index       : index
            }, function(data, status) {
                // console.log(data);
                var data_parse = JSON.parse(data)
                $(`#${arrow_id}`).removeClass('la-caret-right').addClass('la-caret-down')
                $(`#${div_id}`).after(`<div id="sub_${div_id}"></div>`)
                var sub_keys = Object.keys(data_parse)
                var key_lg   = sub_keys.length
                for (let j = 0; j < key_lg; j++) {
                    create_data_div(data_parse[sub_keys[j]], j, sub_keys, `sub_${div_id}`, `sub_sub_${field}`, _id)
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

    function create_data_div(data, i, keys, append_div_id, head, _id){
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
            <div class="row mt-2 mb-3" id="${head}_${i}">
                <div class="col-1">
                    <i id="${head}-${key}" class="las la-caret-right" style="font-size: 14px; display: ${is_show}; cursor: pointer" onclick="array_data('${head}_${i}', '${head}-${key}', '${_id}')"></i>
                </div>
                <div class="col-9">
                    <div class="row">
                        <div class="col-3 key-name-div" style="word-wrap: break-word;">${key}: </div>
                        <div class="col-9" style="word-wrap: break-word;">
                            <span style="display: ${is_data_show}">${data}</span>
                        </div>
                    </div>
                </div>
                <div class="col-1">
                    ${data_type}
                </div>
            </div>
            ${line_vertical}
        `)
    }

    $("#create_table_modal").on("hidden.bs.modal", function () {
        $('#table_name').val('')
    });

    $('#create_table_btn').on('click', function () {
        $('#create_table_submit').click()
    })

    $('#table_name').on('input', function () {
        var tablename = $(this).val()
        $.post('{{url("api")}}/jquery', {
            event: 'check_tablename_mongo',
            name : tablename,
        }, function (data, status) {
            if(data == 'exist'){
                $('#table_name_alert').css('display', 'block')
                $('#table_name_span').html(tablename)
                $('#create_table_btn').prop('disabled', true)
            } else {
                $('#table_name_alert').css('display', 'none')
                $('#create_table_btn').prop('disabled', false)
            }
        })
    })

</script>

@endsection
