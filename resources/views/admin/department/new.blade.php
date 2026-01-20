@extends('layouts.app')
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
    .list-button {
        position: absolute;
        right: 10px;
        top: 6px;
        border-radius: 40%;
    }

    .has-search .form-control-feedback {
        position: absolute;
        right: 20px;
        z-index: 2;
        display: block;
        width: 2.375rem;
        height: 2.375rem;
        line-height: 2.375rem;
        text-align: center;
        pointer-events: none;
        color: #aaa;
    }

    .has-search .form-control {
        /* padding-left: 2.375rem; */
    }
    .button-data{
        margin-top: 3px;
        width: 100%;
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
                <button type="button" class="btn-close btn btn-sm btn-danger" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <input type="text" name="department_name" class="form-control">
            </div>
            <div class="modal-footer row m-0">
                <div class="col-4">
                    <button type="button" class="btn btn-secondary waves-effect waves-light w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-success waves-effect waves-light w-100">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Soft Buttons -->
@endsection
@section('lpage')
    Department - new edit
@endsection
@section('rpage')
    Administrator
@endsection
@section('rppage')
    Department
@endsection
@section('content')

<div class="card" style="position: relative;">
    <h5 class="card-header">DEPARTMENT <button class="btn btn-primary" style="position: absolute;right: 10px;top: 6px" data-toggle="modal" data-target="#add_department">+Add department</button></h5>
    <div class="card-body">
        <div class="row">
            <div class="col-1" style="top: 15px" onclick="change_dpm_tab('backward')"><i class="las la-angle-left" style="font-size: 36px;"></i></div>
            <div class="col-10">
                @php $i = 0; @endphp
                @foreach ($department as $dpm)
                    {{-- change to tab --}}
                    @php
                        $color_class = 'light';
                        if(isset($rtn_dep) && ($rtn_dep == $dpm->department_id) ){
                            $color_class = 'primary';
                        }
                    @endphp
                    <button style="width: 150px" class="btn btn-{{$color_class}} m-3 department-list" id="dpmid{{$dpm->department_id}}" value="{{floor($i/5)}}" @if($i > 4) hidden @endif onclick="choose_dpm(this.id)">{{$dpm->department_name}}</button>
                    @php $i += 1; @endphp
                @endforeach
            </div>
            <div class="col-1" style="top: 15px" onclick="change_dpm_tab('forward')"><i class="las la-angle-right" style="font-size: 36px;"></i></div>
        </div>
        <br>
        <div class="row">
            <div class="col-3" style="position: relative;">
                <ul class="list-group">
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'endo') active @endif @endisset"      id="li_endo" onclick="choose_menu(this.id)">Endo<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_endo" onclick="to_create_url(this.id);event.stopPropagation();" style="z-index: 999">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'doctor') active @endif @endisset"    id="li_doctor" onclick="choose_menu(this.id)">Doctor<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_doctor" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'anes') active @endif @endisset"        id="li_anes" onclick="choose_menu(this.id)">Anes<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_anesthesia" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'nurse') active @endif @endisset"     id="li_nurse" onclick="choose_menu(this.id)">Nurse<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_nurse" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'register') active @endif @endisset"  id="li_register" onclick="choose_menu(this.id)">Register<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_register" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'procedure') active @endif @endisset" id="li_procedure" onclick="choose_menu(this.id)">Procedure<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_procedure" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'room') active @endif @endisset"      id="li_room" onclick="choose_menu(this.id)">Room<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_room" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'scope') active @endif @endisset"     id="li_scope" onclick="choose_menu(this.id)">Scope<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_scope" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'reprocess') active @endif @endisset" id="li_reprocess" onclick="choose_menu(this.id)">Reprocess<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_reprocess" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                    <li class="list-group-item list-item @isset($rtn_type) @if($rtn_type == 'nurse_anes') active @endif @endisset" id="li_nurse_anes" onclick="choose_menu(this.id)">Nurse Anes<button class="btn btn-info btn-sm list-button rounded-pill" id="btn_nurse_anes" onclick="to_create_url(this.id);event.stopPropagation();">+</button></li>
                </ul>
            </div>
            <div class="col-9">
                <div class="form-group has-search" >
                    <span class="fa fa-search form-control-feedback"></span>
                    <input type="text" class="form-control" id="search_inp" style="border-radius: 10px;" placeholder="" oninput="search_data(this.value)">
                </div>
                <br>
                <div class="d-grid gap-2">
                    @isset($data)
                        @foreach ($data as $d)
                            @php
                                $set_name = '';
                                if (isset($d->user_firstname)){
                                    $set_name = isset($d->user_lastname) ? $d->user_firstname.' '.$d->user_lastname : $d->user_firstname;
                                }
                                else if(isset($d->name)){
                                    $set_name = $d->name;
                                } else {
                                    $set_name = '-';
                                }
                            @endphp
                            <button class="btn btn-light button-data" type="button" value="{{$set_name}}">
                                <div style="position: relative">
                                    {{$set_name}} <i class="las la-edit" style="position:absolute;right:0;font-size:20px; color: rgb(64, 64, 137)" onclick="to_edit_url('{{$d->id}}', '{{$rtn_dep}}','{{$rtn_type}}')"></i>
                                </div>
                            </button>
                        @endforeach
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <form action="{{url('department')}}" method="get" id="get_names_form" hidden>
        @method('PUT')
        <input type="text" name="department" id="dpm_id">
        <input type="text" name="type" id="menu_id">
        <button id="submitbtn"></button>
    </form>
</div>


{{-- old here --}}
{{-- <div class="card">
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
</div> --}}




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

<script>
    // after refresh page if button is (primary) and list is (active) need get val to input in form
    dpm_lg = $('.department-list').length
    for(j=0;j<dpm_lg;j++){
        btn_class = $($('.department-list')[j]).prop('class')
        if(btn_class.includes('btn btn-primary') == true){
            btn_id = $($('.department-list')[j]).prop('id')
            btn_id = btn_id.substring(5)
            $('#dpm_id').val(btn_id)
        }
    }

    li_lg = $('.list-item').length
    for(k=0;k<li_lg;k++){
        li_class = $($('.list-item')[k]).prop('class')
        if(li_class.includes('active') == true){
            li_id = $($('.list-item')[k]).prop('id')
            li_id = li_id.substring(3)
            $('#menu_id').val(li_id)
        }
    }

    function change_dpm_tab(type) {
        dpm_num = $('.department-list').length
        val_arr = []
        last_shown_val = ''
        for(i=0;i<dpm_num;i++){
            visibility = $($('.department-list')[i]).is(':visible')
            val_arr.push($($('.department-list')[i]).prop('value'))
            if(visibility == true){
                last_shown_val = $($('.department-list')[i]).prop('value')
            }
        }

        num = (type == 'forward') ? parseInt(last_shown_val) + 1 : parseInt(last_shown_val) - 1
        if(num < 0){
            num = 0
        }

        is_exist = val_arr.includes(String(num))
        if(is_exist == true){
            for(i=0;i<dpm_num;i++){
                value = $($('.department-list')[i]).prop('value')
                if(value == num){
                    $($('.department-list')[i]).prop('hidden', false)
                } else {
                    $($('.department-list')[i]).prop('hidden', true)
                }
            }
        }

    }

    function choose_dpm(button_id, need_submit=true){
        $(`#${button_id}`).removeClass('btn btn-light').addClass('btn btn-primary')

        dpm_num = $('.department-list').length
        arr = []
        for(i=0;i<dpm_num;i++){
            btn_id = $($('.department-list')[i]).prop('id')
            arr.push(btn_id)
        }
        arr.splice(arr.indexOf(button_id), 1)
        arr.forEach((id) => {
            is_class = $(`#${id}`).hasClass("btn btn-primary")
            if(is_class == true){
                $(`#${id}`).removeClass('btn btn-primary').addClass('btn btn-light')
            }
        })

        // need to send value to form
        id = button_id.substring(5)
        $('#dpm_id').val(id)
        if(need_submit == true){
            check_value_form()
        }
    }

    function choose_menu(menu_id, need_submit=true) {
        $(`#${menu_id}`).addClass('active')

        li_num = $('.list-item').length
        arr = []
        for(i=0;i<li_num;i++){
            li_id = $($('.list-item')[i]).prop('id')
            arr.push(li_id)
        }
        arr.splice(arr.indexOf(menu_id), 1)
        arr.forEach((id) => {
            is_class = $(`#${id}`).hasClass("active")
            if(is_class == true){
                $(`#${id}`).removeClass('active')
            }
        })

        // need to send value to form
        id = menu_id.substring(3)
        $('#menu_id').val(id)
        if(need_submit == true){
            check_value_form()
        }
    }

    function check_value_form() {
        dpm = $('#dpm_id').val()
        type = $('#menu_id').val()
        if(dpm && type){
            $('#submitbtn').click()
        }
    }

    function to_edit_url(id, department,type){
        window.location.href = `{{url('department')}}/${id}?type=${type}&department=${department}`
    }

    function to_create_url(id){
        type = id.substring(4)
        if(type == 'nesthesia'){
            type = 'anesthesia'
        }
        department = $('#dpm_id').val()
        if(type && department){
            window.location.href = `{{url('department')}}/create?type=${type}&department=${department}`
        }
        setTimeout(() => {
            choose_menu(`li_${type}`, true)
        }, 400);
    }

    function search_data(val){
        data_lg = $('.button-data').length
        if(val != '' || val != null){
            for(i=0;i<data_lg;i++){
                button_text = $($('.button-data')[i]).val().toLowerCase()
                if(button_text.includes(val)){
                    console.log(button_text, val, 'false');
                    $($('.button-data')[i]).prop('hidden', false)
                } else {
                    console.log(button_text, val, 'true');
                    $($('.button-data')[i]).prop('hidden', true)
                }
            }
        } else {
            $('.button-data').prop('hidden', false)
        }
    }
</script>
@endsection
