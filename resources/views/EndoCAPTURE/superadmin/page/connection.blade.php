@extends('capture.layoutv6')

@section('title', 'EndoINDEX')
@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ url('public/css/superadmin/index.css') }}" rel="stylesheet" type="text/css" />
    <style>
        tr td:first-child{width: 25%;}
        td{vertical-align: middle !important;}
    </style>
@endsection
@section('modal')
<div class="modal fade" id="add_connection_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add connection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="fas fa-ban"></i>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" name="" id="txt_connection" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-dark font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success font-weight-bold" onclick="add_connection_file()" id="modal_add" data-dismiss="modal" disabled>Add</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row m-0 cn">
                    <div class="col-12 mb-3">
                        <h2 style="text-align: center;">การเปิดปิดการใช้งานระบบ Database Connection</h2>
                    </div>
                    @include('EndoCAPTURE.superadmin.component.menutopbar')
                    <div class="col-12 d-flex justify-content-between">
                        <h2>Connection hospital</h2>
                        <button type="button" class="btn btn-soft-success font-weight-bold btn-lg" id="show_list" data-toggle="modal" data-target="#add_connection_modal">Add connect</button>
                    </div>

                </div>
                <table class="table table-borderless">
                    <thead class="border-bottom">
                        <tr>
                            <td colspan="2" id="list_file_connection">

                            </td>
                        </tr>
                    </thead>
                    <tbody id="list_connection">

                    </tbody>
                </table>
                <div class="col-12 text-right border-top pt-5">
                    <button type="button" onclick="test_connect()" class="btn btn-transparent-dark font-weight-bold btn-lg">Test connect</button>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="data_list_check">

@endsection
@section('script')


<script>
    function gen_connection(name) {
        $.post("{{url('superadmin')}}",
        {
            event       : 'connection_hospital',
            name        : name
        },
        function(data, status) {
            $("#list_connection").html(data)
        })
    }
    function list_file_connection(){
        $.post("{{url('superadmin')}}",
        {
            event       : 'list_file_connection'
        },
        function(data, status) {
            $("#list_file_connection").html(data)
        })
    }
    function add_connection_file() {
        var namefile = $("#txt_connection").val()
        $.post("{{url('superadmin')}}",
        {
        event       : 'add_connection_file',
        namefile    : namefile
        },
        function(data, status) {
            list_file_connection()
        })
    }

    function update_connect(id,value,file){
        $.post("{{url('superadmin')}}",
        {
            event       : 'update_connect',
            id          : id,
            value       : value,
            file        : file
        },
        function(data, status) {
        })
    }

    function test_connect(){
        var host = $("#host").val()
        var port = $("#port").val()
        var database = $("#database").val()
        var username = $("#username").val()
        var password = $("#password").val()
        var driver = $("#driver").val()
        $.post("{{url('superadmin')}}",
        {
            event       : 'test_connect',
            host        : host,
            port        : port,
            database    : database,
            username    : username,
            password    : password,
            driver      : driver,
        },
        function(data, status) {
            if(data=='success'){
                Swal.fire("Connect", "เชื่อมต่อระบบได้", "success");
            }else{
                Swal.fire("Error", "ไม่สามารถเชื่อมต่อได้", "error");
            }
        })
    }


    $("#txt_connection").keyup(function (e) {
        var array = JSON.parse($("#data_list_check").val())
        var value = $(this).val()
        if(array.indexOf(value)){
            $("#modal_add").attr('disabled',false)
        }else{
            $("#modal_add").attr('disabled',true)
        }

    });
    $("#show_list").click(function(){
        var count = $("#ls_file option").length
        var array = [];
        for(i=0;i<count;i++){
            array[i] = $($("#ls_file option")[i]).val()
        }
        var data = JSON.stringify(array)
        $("#data_list_check").val(data)
        console.log(data);
    })
    gen_connection('Default')
    list_file_connection()
</script>


@endsection
