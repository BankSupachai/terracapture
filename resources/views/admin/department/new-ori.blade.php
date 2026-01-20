@extends('layouts.layouts_index.main')
@section('style')
<link href="{{url("public/assets5/libs/sweetalert2/sweetalert2.min.css")}}" rel="stylesheet" type="text/css" />
<style>
    .table-hover tr td:last-child,.table-hover tr td:nth-child(2){
        width: 4em;
    }
    .border-start{
        display: none;
    }
    td{
        vertical-align: middle;
    }
    .border-start.active{
        display: block;
    }
    .col{
        transition: 0.5s;
    }
</style>
@endsection
@section('modal')
<div class="modal fade" id="add_department" tabindex="-1" aria-labelledby="add_departmentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{url('department')}}" method="POST" class="modal-content">
            @csrf
            <input type="hidden" name="event" value="add_department">
            <div class="modal-header">
                <h5 class="modal-title" id="add_departmentLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="department_name" class="form-control">
            </div>
            <div class="modal-footer row m-0">
                <div class="col-4">
                    <button type="button" class="btn btn-soft-dark waves-effect waves-light w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-soft-success waves-effect waves-light w-100">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Soft Buttons -->
@endsection
@section('lpage')
    Department
@endsection
@section('rpage')
    Administrator
@endsection
@section('rppage')
    Department
@endsection
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-auto border-end">
                <div class="row">

                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <button type="button" class="btn btn-soft-primary waves-effect waves-light w-100" data-bs-toggle="modal" data-bs-target="#add_department" >
                                    Add Department
                                </button>
                            </td>
                        </tr>
                        @foreach ($department as $dpm)
                        <tr>
                            <td>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="department" id="department{{$dpm->department_id}}" value="{{$dpm->department_id}}">
                                    <label class="form-check-label" for="department{{$dpm->department_id}}">
                                        {{$dpm->department_name}}
                                    </label>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col">
                <table class="table table-hover">
                    <tr class="set_tr" set="endo">
                        <td>Endo</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('endo')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                    <tr class="set_tr" set="doctor">
                        <td>Doctor</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('doctor')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                    <tr class="set_tr" set="anesthesia">
                        <td>Anes</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('anesthesia')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                    <tr class="set_tr" set="nurse">
                        <td>Nurse</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('nurse')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                    <tr class="set_tr" set="register">
                        <td>Register</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('register')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                    <tr class="set_tr" set="procedure">
                        <td>Procedure</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('procedure')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                    <tr class="set_tr" set="room">
                        <td>Room</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('room')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                    <tr class="set_tr" set="scope">
                        <td>Scope</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('scope')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                    <tr class="set_tr" set="reprocess">
                        <td>Reprocess</td>
                        <td><a class="btn btn-ghost-success waves-effect waves-light link-create" href="javascript:alert_department();"><i class="ri-add-line"></i></a></td>
                        <td><button type="button" class="btn btn-ghost-info waves-effect waves-light" onclick="call_data('reprocess')"><i class=" ri-send-plane-2-fill"></i></button></td>
                    </tr>
                </table>
            </div>
            <div class="col-7 border-start"  data-simplebar data-simplebar-auto-hide="false" data-simplebar-track="secondary" style="max-height: 70vh;">
                <table class="table table-hover">
                    <tbody id="set_data">

                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>




@endsection


@section('script')
<script src="{{url("public/assets5/libs/sweetalert2/sweetalert2.min.js")}}"></script>
<script src="{{url("public/assets5/js/pages/sweetalerts.init.js")}}"></script>
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $(".form-check-input").on('click',function(){
        var department = $(this).val()
        for(i=0;i<9;i++){
            var type = $($(".set_tr")[i]).attr('set')
            var url  = "{{url('department')}}/create?type="+type+"&department="+department
            $($(".link-create")[i]).attr('href',url)
            if($(".bg-soft-info").length!=0){
                gen_data()
            }
        }
    })

    function alert_department(){
        Swal.fire({title:"กรุณาเลือก Department",icon:"warning",confirmButtonClass:"btn btn-primary w-xs mt-2",buttonsStyling:!1,showCloseButton:!0})
    }


    function call_data(type){
        if($('.form-check-input:checked').length ==0){
            alert_department()
        }else{
            $(".border-start").addClass('active')
            $('.set_tr').removeClass('bg-soft-info')
            $(".set_tr[set='"+type+"']").addClass('bg-soft-info')
            gen_data()
        }
    }

    function gen_data(){
        var tr = "";
        var department = $('.form-check-input:checked').val()
        var type       = $(".bg-soft-info").attr('set')
        var set_name   = ''
        $.post("{{url('api/jquery')}}",
        {
            event       : 'department_search',
            department  : department,
            type        : type
        },
        function(data, status) {
            var new_tr = JSON.parse(data)
            console.log(new_tr.length);
            if(new_tr.length!=0){
                new_tr.forEach((e, i) => {
                    if(e.name){
                        set_name = e.name
                    }else if(e.user_firstname){
                        set_name = e.user_firstname+' '+check_null(e.user_lastname)
                    }else{
                        set_name = '-'
                    }
                    tr += "<tr><td>"+set_name+"</td>"+"<td><a href='{{url('department')}}/"+e.id+"?type="+type+"&department="+department+"' class='btn btn-ghost-info waves-effect waves-light'><i class='ri-send-plane-2-fill'></i></a></td></tr>"
                })
            }else{
                tr += "<tr class='bg-soft-warning'><td colspan='2' class='text-center'>!! No Data !!</td></tr>"
            }
            $("#set_data").html(null);
            $("#set_data").append(tr)
            Swal.fire({position:"top-end",icon:"success",title:"ดึงข้อมูลเสร็จสิ้น",showConfirmButton:!1,timer:1500,showCloseButton:!0})
        })
    }

    function check_null(data){
        if(!data){
            return ''
        }else{
            return data
        }
    }
    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            blah.src = URL.createObjectURL(file)
        }
    }
</script>
@endsection
