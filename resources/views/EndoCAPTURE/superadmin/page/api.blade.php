@extends('capture.layoutv6')

@section('title', 'EndoINDEX')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('public/css/superadmin/index.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/sample/assets/plugins/custom/jstree/jstree.bundle.css")}}" rel="stylesheet" type="text/css" />
    <style>
        .dropdown-toggle.nav-link:after, .dropdown-toggle.btn:after{
            content: "V";
        }
        .input-group.input-group-solid .input-group-prepend ~ .form-control{
            padding-left: 3em !important;
            font-size: larger;
        }
        .card{
            box-shadow: none !important;
        }
        tbody td{
            padding: 0 !important;
            vertical-align: middle !important;
        }
        td input[type='text']{
            border-radius: 0 !important;
            border: none !important;
        }
        #list_api tr td:first-child,#list_api tr td:last-child{width: 2em;}
        #add_list{
            border-radius: 0 0 15px 15px;
            padding: 2px 10px;
        }
        .api-post{color: blue;}
        .api-get{color: green;}
        .api-put{color: orange;}
        .api-token-post{color: darkturquoise;}
        .api-token-get{color: darkseagreen;}
        .api-token-put{color: orchid;}
        .menu-list-api{
            background: white;
        }
        .menu-list-api.active{
            background: #F3F6F9 ;
        }
        .menu-list-api:hover{
            background: #F3F6F9 ;
        }
        .menu-list-api > div{
            padding: 0.75em;
        }
        #token_api tr td:first-child{
            width: 20%;
            background: #F3F6F9;
        }
        #token_api{
            display: none;
        }
        #token_api.active{
            display: table;
        }
        .fa-trash-alt{
            color: red;
        }
        .fa-trash-alt:hover{
            color: rgb(170, 10, 10);
        }
        .bg-description{
            background: orange;
        }
        .fa-medapps{
            color: white;
        }
        .ribbon-target:hover .bg-description{
            transition: 0.5s;
            background: white;
        }
        .ribbon-target:hover  .fa-medapps{
            transition: 0.5s;
            color: orange;
        }
        #code-preview{
            background: rgb(50, 55, 59);
        }
        .text-skyblue{
            color: rgb(79, 169, 204);
        }
        .text-yellow{
            color: yellow;
        }
    </style>
@endsection
@section('modal')
<div class="modal fade" id="save_api" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Save API</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="radio-inline">
                    <label class="radio radio-outline radio-success" id="set_edit">
                        <input type="radio" name="radios18" value="edit" id="api_edit"/>
                        <span></span>
                        บันทึกทับที่เลือก
                    </label>
                    <label class="radio radio-outline radio-success">
                        <input type="radio" name="radios18" checked="checked" value="new" id="api_new"/>
                        <span></span>
                        บันทึกใหม่
                    </label>
                </div>
                <input type="text" name="" id="name_api" class="form-control mt-2" placeholder="ตั้งชื่อ API">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success font-weight-bold" onclick="set_txt()">Submit</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="modal_description" tabindex="-1" role="dialog" aria-labelledby="modal_descriptiontxt" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_descriptiontxt">Instruction manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="code-preview">
                <span class="text-skyblue">$data</span>
                <span class="text-primary">[</span>
                <span class="text-warning">'id'</span>
                <span class="text-primary">]</span>
                <span class="text-white">&emsp; = &nbsp;</span>
                <span class="text-warning">'gi001'</span>
                <span class="text-white">;</span>
                <span class="text-success">
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                     // ค่าที่ส่งมาเพื่อ ส่งค่าไป ! ตั้ง key ให้ตรงกับ key api ที่รับ</span>
                <br class="m-0">
                <span class="text-skyblue">$test</span>
                <span class="text-white">&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp; = &nbsp;</span>
                <span class="text-success">Api</span>
                <span class="text-white">::</span>
                <span class="text-yellow">name</span>
                <span class="text-primary">(</span>
                <span class="text-warning">'test'</span>
                <span class="text-white">,</span>
                <span class="text-skyblue">$data</span>
                <span class="text-primary">)</span>
                <span class="text-white">;</span>
                <span class="text-success">&emsp;&emsp;// 'test' คือชื่อไฟล์ text</span>

            </div>
            <div class="modal-footer row m-0">
                <button type="button" class="btn btn-light-primary font-weight-bold col-12" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="col-12">
    <div class="card card-custom">
        <div class="card-header ribbon ribbon-clip ribbon-right">
            <div class="ribbon-target" style="">
             <span class="ribbon-inner bg-description" data-toggle="modal" data-target="#modal_description"></span><i class="fab fa-medapps"></i>
            </div>
            <div class="col-12 mb-3">
                <h2 style="text-align: center;">การเปิดปิดการใช้งานระบบ API</h2>
            </div>
            @include('EndoCAPTURE.superadmin.component.menutopbar')

        </div>
        <div class="card-body">
            <div class="row m-0">
                <div class="col">
                    <input type="hidden" id="type_connect">
                    <div class="input-group input-group-solid">
                        <div class="input-group-prepend">
                            <button type="button" id="api_type" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:;" onclick="select_type(1)">POST</a>
                                <a class="dropdown-item" href="javascript:;" onclick="select_type(2)">GET</a>
                                <a class="dropdown-item" href="javascript:;" onclick="select_type(3)">PUT</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:;" onclick="select_type(4)">Token POST</a>
                                <a class="dropdown-item" href="javascript:;" onclick="select_type(5)">Token GET</a>
                                <a class="dropdown-item" href="javascript:;" onclick="select_type(6)">Token PUT</a>
                            </div>
                        </div>
                        <input type="text" id="url_api" class="form-control pl-5" aria-label="Text input with dropdown button" placeholder="URL API"/>
                    </div>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-primary" onclick="connect_api()">Send <i class="fas fa-long-arrow-alt-right"></i> </button>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#save_api" id="call_modal">Save <i class="fab fa-medrt"></i> </button>
                </div>
            </div>
            <div class="row m-0 mt-5">
                <div class="col-lg-3">
                    <div class="w-100 border">
                        <div class="row m-0">
                            <div class="col-12 text-center bg-gray-100">API LIST</div>
                        </div>
                        @for($i=0;$i<count($file);$i++)
                        <div class="row m-0 menu-list-api" data-file="{{$file[$i]['file']}}">
                            <div class="col-3 {{$file[$i]['type_color']}}">{{$file[$i]['type_name']}}</div>
                            <div class="col">{{$file[$i]['file']}}</div>
                            <div class="col-auto"><i class="fas fa-angle-right"></i></div>
                        </div>
                        @endfor
                    </div>
                </div>
                <div class="col-lg-9">
                    <table class="table table-bordered mb-0" id="list_api">
                        <thead>
                            <tr>
                                <td></td>
                                <td>KEY</td>
                                <td>Value</td>
                                <td>Description</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="list_view">
                            <tr>
                                <td>
                                    <label class="checkbox checkbox-success ml-1">
                                        <input type="checkbox" name="Checkboxes5" class="check-inputs"/>
                                        <span></span>
                                    </label>
                                </td>
                                <td><input type="text" class="form-control input-key"></td>
                                <td><input type="text" class="form-control input-value"></td>
                                <td><input type="text" class="form-control input-description"></td>
                                <td class="text-center"><i class="far fa-trash-alt" onclick="deleteRow(this)"></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row m-0 mb-5">
                        <div class="col"></div>
                        <div class="col-auto"><button class="btn btn-light-success font-weight-bol" id="add_list">Add List</button></div>
                        <div class="col"></div>
                    </div>
                    <table class="table table-bordered mb-4" id="token_api">
                        <tr>
                            <td class="pl-4">Token</td>
                            <td><input type="text" class="form-control input-token"></td>
                        </tr>
                    </table>
                    <div class="w-100 bg-gray-100 p-4">
                        Response
                        <div class="w-100" id="api_respon"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{url("public/sample/assets/plugins/custom/jstree/jstree.bundle.js")}}"></script>

<script>
    function select_type(type){
        var api_type = 'None';
        var color    = 'black'
        if(type==1){
            api_type = 'POST';
            color    = 'blue';
        }else if(type==2){
            api_type = 'GET';
            color    = 'green';
        }else if(type==3){
            api_type = 'PUT';
            color    = 'orange';
        }else if(type==4){
            api_type = 'Token POST';
            color    = 'darkturquoise';
        }else if(type==5){
            api_type = 'Token GET';
            color    = 'darkseagreen';
        }else if(type==6){
            api_type = 'Token PUT';
            color    = 'orchid';
        }
        $("#type_connect").val(type)
        if(type<4){
            $("#token_api").removeClass('active')
        }else{
            $("#token_api").addClass('active')
        }
        $("#api_type").text(api_type).css('color',color).css('border-color',color)
    }
    $("#add_list").click(function(){
        var html = `
        <tr>
                                <td>
                                    <label class="checkbox checkbox-success ml-1">
                                        <input type="checkbox" name="Checkboxes5" class="check-inputs"/>
                                        <span></span>
                                    </label>
                                </td>
                                <td><input type="text" class="form-control input-key"></td>
                                <td><input type="text" class="form-control input-value"></td>
                                <td><input type="text" class="form-control input-description"></td>
                                <td class="text-center"><i class="far fa-trash-alt" onclick="deleteRow(this)"></i></td>
                            </tr>
        `
                            $("#list_view").append(html)
    })

    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }

    $(".menu-list-api").click(function(){
        $('.menu-list-api').removeClass('active')
        $(this).addClass('active')
        var file = $(this).attr('data-file')
        $.post("{{url('api/jquery')}}",
        {
        event       : 'detail_api',
        file         : file,
        },
        function(data, status) {
            var list = JSON.parse(data)
            $("#url_api").val(list.url)
            select_type(parseInt(list.type_connect))
            list_data = JSON.parse(list.list_data)
            var html = '';
            for(i=0;i<list_data.key.length;i++){

                html += `
                <tr>
                    <td>
                        <label class="checkbox checkbox-success ml-1">
                            <input type="checkbox" name="Checkboxes5" class="check-inputs" ${list_data.checked[i]}/>
                            <span></span>
                        </label>
                    </td>
                    <td><input type="text" class="form-control input-key" value="${list_data.key[i]}"></td>
                    <td><input type="text" class="form-control input-value" value="${list_data.value[i]}"></td>
                    <td><input type="text" class="form-control input-description" value="${list_data.description[i]}"></td>
                    <td class="text-center"><i class="far fa-trash-alt" onclick="deleteRow(this)"></i></td>
                </tr>
                `
            }
            $("#list_view").html(html)
        })
    })


    function connect_api(){
        var url         = $("#url_api").val()
        var list_data   = get_setting('check')
        var type_connect= $("#type_connect").val()
        $.post("{{url('api/jquery')}}",
        {
        event       : 'connect_api',
        url         : url,
        list_data   : list_data,
        type_connect: type_connect
        },
        function(data, status) {
            if(data!='error'){
                $("#api_respon").html(data)
            }else{
                Swal.fire("Error", "ไม่สามารถเชื่อมต่อ API ได้", "error");
            }
        })
    }

    function get_setting(data){
        var count_key   = $('.input-key').length
        var key         = [];
        var value       = [];
        var checked     = [];
        var description = [];
        if(count_key>0){
            for(i=0;i<count_key;i++){
                if(data=='check'){
                    if($($('.check-inputs')[i]).is(':checked')){
                        key[i]           = $($(".input-key")[i]).val()
                        value[i]         = $($(".input-value")[i]).val()
                    }
                }else{
                    if($($('.check-inputs')[i]).is(':checked')){
                        checked[i]      = 'checked';
                    }else{
                        checked[i]      = '';
                    }
                    key[i]           = $($(".input-key")[i]).val()
                    value[i]         = $($(".input-value")[i]).val()
                    description[i]   = $($(".input-description")[i]).val()
                }
            }
            var obj = {'key':key,'value':value,'description':description,'checked':checked}
            if(key.length>0){
                myJSON = JSON.stringify(obj)
                return myJSON;
            }else{
                return null;
            }
        }
    }
    $("#api_edit").click(function(){$("#name_api").hide()})
    $("#api_new").click(function(){$("#name_api").show()})
    $("#call_modal").click(function(){
        if($(".menu-list-api.active").length==0){
            $("#set_edit").hide()
        }else{
            $("#set_edit").show()
        }
    })

    function set_txt(){
        var url         = $("#url_api").val()
        var list_data   = get_setting('all')
        var type_connect= $("#type_connect").val()
        var name_api    = $("#name_api").val()
        console.log(list_data);
        $.post("{{url('api/jquery')}}",
        {
            event           : 'txt_api',
            url             : url,
            list_data       : list_data,
            type_connect    : type_connect,
            name_api        : name_api
        },
        function(data, status) {
            if(data=='success'){
                location.reload();
            }
        })
    }
</script>



@endsection
