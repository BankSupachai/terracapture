
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .dropzone {
    max-width: 48%;
    margin: auto;
    margin-top: 2em;
    }
</style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">{{@$type}} USER </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">User Setting </a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
                    <li class="nav-item border-end border-dark">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab" id="user_tab">
                            User
                        </a>
                    </li>
                    @if ($type != 'EDIT')
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab" id="endo_tab">
                                Endoindex
                            </a>
                        </li>
                    @else
                        <li class="nav-item"></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="row"><hr></div>
        <div class="row">
            <span>User</span>
        </div>
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="home1" role="tabpanel">
                <form action="{{url("admin/user")}}" method="post" id="create_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="{{@$type}}">
                    <input type="hidden" name="user_tab" value="user">
                    <input type="hidden" name="event" value="user_create">
                    @isset($user)
                        <input type="hidden" name="id" value="{{@$user->id}}">
                    @endisset
                    <div class="row cn p-3">
                        <div class="col-auto">
                            <label for="basicInput" class="form-label">Prefix</label>
                        </div>
                        <div class="col-2">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" id="user_prefix" name="user_prefix" value="{{@$user->user_prefix}}">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basicInput" class="form-label">First Name <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" id="user_firstname" name="user_firstname" value="{{@$user->user_firstname}}" required>
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basicInput" class="form-label">Last Name <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" id="user_lastname" name="user_lastname" value="{{@$use->user_lastname}}" required>
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basicInput" class="form-label">Eng Name <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" id="user_engname" name="user_engname"
                                value="{{@$user->name_eng}}"  @isset($user->user_type) @if($user->user_type != 'endo') required  @endif @endisset>
                            </div>
                        </div>
                    </div>

                    <div class="row cn p-3">
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Code</label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" id="user_code" name="user_code" value="{{@$user->user_code}}">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">RFID Code</label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center">
                                <input type="text" class="form-control bg-light" style="margin-left: 13px;" id="user_rfid" name="user_rfid" value="{{@$user->user_rfid}}">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basiInput" class="form-label" style="margin-left: 1em;">Phone</label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" style="margin-left: 3em;" id="user_phone" name="user_phone" value="{{@$user->user_phone}}">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Color</label>
                        </div>
                        <div class="col-2">
                            <div class="align-items-center text-nowrap" style="width: 30%">
                                <input type="color" class="form-control bg-light"  id="user_color" name="user_color" value="{{@$user->user_color}}">
                            </div>
                        </div>
                    </div>


                    <div class="row cn p-3">
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Type <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2">
                            <select class="form-control" style="width: 86%;" id="user_type" name="user_type" required>
                                <option value="">Please choose user type</option>
                                {{-- <option @isset($user->user_type) @if($user->user_type == 'admin') selected  @endif @endisset value="admin">Admin</option> --}}
                                <option @isset($user->user_type) @if($user->user_type == 'anesthesia') selected  @endif @endisset value="anesthesia">Anesthesia</option>
                                <option @isset($user->user_type) @if($user->user_type == 'doctor') selected  @endif @endisset value="doctor">Doctor</option>
                                <option @isset($user->user_type) @if($user->user_type == 'endo') selected  @endif @endisset value="endo">Endo</option>
                                <option @isset($user->user_type) @if($user->user_type == 'nurse') selected  @endif @endisset value="nurse">Nurse</option>
                                <option @isset($user->user_type) @if($user->user_type == 'nurse_anes') selected  @endif @endisset value="nurse_anes">Nurse Anes</option>
                                <option @isset($user->user_type) @if($user->user_type == 'nurse_assistant') selected  @endif @endisset value="nurse_assistant">Nurse Assistant</option>
                                <option @isset($user->user_type) @if($user->user_type == 'viewer') selected  @endif @endisset value="viewer">Viewer</option>
                                <option @isset($user->user_type) @if($user->user_type == 'scientific') selected  @endif @endisset value="scientific">Scientific Officer</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Status <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2" >
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"  name="user_status" id="flexRadioDefault1 " value="active" checked required>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" name="user_status" value="inactive" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Inactive
                                    </label>

                                </div>
                            </div>
                        </div>


                        <div class="col-2" >
                          <select class="form-select" name="user_branch" id="user_branch">
                            <option value="" > N/A</option>
                            <option value="med">MED</option>
                            <option value="sur">SUR</option>
                            <option value="sur(gen)" >SUR(Gen)</option>
                            <option value="sur(ped)">SUR(PED)</option>
                          </select>
                        </div>

                    </div>
                    <div class="row cn p-3">
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">User <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" style="margin-left: 3px;" id="email" name="user_email" value="{{@$user->email}}" required>
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Password <span style="color: red">*</span></label>
                        </div>
                        <div class="col-3">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                @if ($type == 'EDIT')
                                    <input type="password" class="form-control bg-light " style="margin-left: 21px;" id="password" name="user_password" value="{{@$user->password}}" hidden>
                                    <input type="password" class="form-control bg-light " style="margin-left: 21px;" id="password_dummy" name="user_password_dummy" value="123456" onchange="set_password()">
                                @else
                                    <input type="password" class="form-control bg-light " style="margin-left: 21px;" id="password" name="user_password" value="123456" required>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 border p-5">
                            <h4>Department <span style="color: red">*</span></h4>
                            <select class="form-control" name="department" id="department_select">
                                <option value="">Select Department</option>
                                @foreach ($departments as $data)
                                    <option value="{{$data->department_name}}" @if(@$user->department==$data->department_name) selected @endif>{{$data->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6  border p-5 ">
                            @php
                                $img = isset($user->user_pic) && @$user->user_pic != "" ? $img_url.$user->user_pic : $img_url.'avatar.png';
                            @endphp
                            <h4>Photo</h4>
                            <input class="form-control input-pos mb-3" name="user_image" style="" type="file" accept="image/*" onchange="loadFile(event)">
                            <img src="{{@$img}}" class="img-fluid" id="blah" >
                        </div>
                    </div>
                    <div class="row m-0 mt-5">
                        <div class="col"></div>
                        <div class="col-auto">
                            <a href="{{url("admin/user")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                            <a href="javascript:;" id="user_submit_btn" class="btn btn-primary btn-label waves-effect btn-md right waves-light"><i class=" ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="profile1" role="tabpanel">
                <form action="{{url("admin/user")}}" method="post" id="create_endo_form">
                    @csrf
                    <input type="hidden" name="type" value="{{@$type}}">
                    <input type="hidden"  name="user_tab" value="endo">
                    <input type="hidden" name="event" value="user_create">
                    @isset($user)
                        <input type="hidden" name="id" value="{{@$user->id}}">
                    @endisset
                    <div class="row align-items-center p-3">
                        <div class="col-auto">
                            <label for="endo_name" class="form-label">Name <span style="color: red">*</span></label>
                        </div>
                        <div class="col-6" style="width: 56%">
                            <div class="">
                                <input type="text" class="form-control bg-light" id="endo_name" name="endo_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center p-3">
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Type <span style="color: red">*</span></label>
                        </div>
                        <div class="col-3">
                                <select class="form-control" id="endo_type" name="endo_type" required>
                                    <option value="endo" selected>endo</option>
                                </select>
                        </div>
                        <div class="col-auto">
                            <label for="basiInput" class="form-label" style="margin-left: 1em;">Status <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="endo_status" value="active" id="flexRadioDefault1" required checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" name="endo_status" value="inactive" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Inactive
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center p-3">
                            <div class="col-auto">
                                <label for="basiInput" class="form-label">User <span style="color: red">*</span></label>
                            </div>
                            <div class="col-3 user-margin">
                                <div class="">
                                    <input type="text" class="form-control bg-light" style="margin-left: 11px;" id="endo_email" name="endo_email" required>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label for="basiInput" class="form-label ms-3">Password <span style="color: red">*</span></label>
                            </div>
                            <div class="col-3">
                                <div class="">
                                    <input type="password" class="form-control bg-light ms-3" id="endo_password" name="endo_password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 border p-5">
                                <h4>Department<span style="color: red">*</span></h4>
                            </div>
                        </div>
                    </div>
                    <button style="display:none" id="warning_div" type="button" data-toast data-toast-text="" data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs">Bottom Right</button>
                    <div class="row m-0 mt-5">
                        <div class="col"></div>
                        <div class="col-auto">
                            <a href="{{url("admin/user")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                            <a href="javascript:;" id="userendo_submit_btn" class="btn btn-primary btn-label waves-effect btn-md right waves-light"><i class=" ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection




@section('script')
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script>
    var submit_status = true

    function set_password(){
        $('#password').val($('#password_dummy').val())
    }

    $("#user_type").change(function(){
        let usertype = $(this).val();
        $.post('{{url("admin/user")}}',{
            event       : "usertypecreate",
            usertype    : usertype
        },function(d,s){
            let json = JSON.parse(d);
            if(json.status){
                $("#email").val(json.username);
            }else{
                $("#email").val("");
            }
        });
    });


    $('#user_submit_btn').on('click', function () {
        // var is_checked           = get_checked_ck('ck-department') > 0
        let user_firstname       = $('#user_firstname').val()
        let user_lastname        = $('#user_lastname').val()
        let user_type            = $('#user_type').val()
        let user_status          = $('input[name="user_status"]:checked').val()
        let user_email           = $('#email').val()
        let user_password        = $('#password').val()
        let missing_data         = []

        if(user_firstname == ''){
            missing_data.push('First Name')
        }

        if(user_lastname == ''){
            missing_data.push('Last Name')
        }

        if(user_type == ''){
            missing_data.push('Type')
        }

        if(user_status == '' || user_status == undefined){
            missing_data.push('Status')
        }

        if(user_email == ''){
            missing_data.push('User')
        }

        if(user_password == ''){
            missing_data.push('Password')
        }

        // if(!is_checked){
            // missing_data.push('Department')
        // }

        let warning_txt = 'กรุณาตรวจสอบข้อมูลในช่อง '
        missing_data.forEach((e, i) => {
            if(i == 0){
                warning_txt += e
            }
        })

        if(user_firstname != '' &&  user_lastname != '' && user_type != "" && user_email != '' && user_password != ""
        && (user_status != '' && user_status != undefined) && submit_status == true){
            $('#create_form').submit()
            submit_status = false
        } else {
            // Swal.fire('โปรดเลือก Department')
            $('#warning_div').attr('data-toast-text', warning_txt)
            $('#warning_div').click()
        }
    })

    $('#userendo_submit_btn').on('click', function () {
        var is_checked           = get_checked_ck('ck-endo') > 0
        let endo_name            = $('#endo_name').val()
        let endo_type            = $('#endo_type option:selected').text()
        let endo_status          = $('input[name="endo_status"]:checked').val()
        let endo_email           = $('#endo_email').val()
        let endo_password        = $('#endo_password').val()
        let missing_data         = []
        console.log($('input[name="department_endo"]'));

        if(endo_name == ''){
            missing_data.push('Name')
        }

        if(endo_type == ''){
            missing_data.push('Type')
        }

        if(endo_status == '' || endo_status == undefined){
            missing_data.push('Status')
        }

        if(endo_email == ''){
            missing_data.push('User')
        }

        if(endo_password == ''){
            missing_data.push('Password')
        }

        if(!is_checked){
            missing_data.push('Department')
        }

        let warning_txt = 'กรุณาตรวจสอบข้อมูลในช่อง '
        missing_data.forEach((e, i) => {
            if(i == 0){
                warning_txt += e
            }
        })

        if(is_checked == true && endo_name != '' &&  endo_type != '' && endo_email != "" && endo_password != ""
        && (endo_status != '' && endo_status != undefined) && submit_status == true){
            $('#create_endo_form').submit()
            submit_status = false
        } else {
            // Swal.fire('โปรดเลือก Department')
            $('#warning_div').attr('data-toast-text', warning_txt)
            $('#warning_div').click()
        }


    })

    function get_checked_ck(className){
        let num = 0
        for (let i = 0; i < $(`.${className}`).length; i++) {
            let is_check = $($(`.${className}`)[i]).is(':checked')
            if(is_check){
                num += 1
            }
        }
        return num
    }

    // $('#create_form').submit(function () {
    //     event.preventDefault();
    //     var lg  = $('.ck-department').length
    //     var num = 0
    //     for (let i = 0; i < lg; i++) {
    //         var is_checked = $($('.ck-department')[i]).is(':checked')
    //         if(is_checked){
    //             num = num + 1
    //         }
    //     }
    //     if(num > 0){
    //         $(this).unbind('submit').submit()
    //     } else {
    //         Swal.fire('โปรดเลือก Department')
    //     }
    // })

    // $('#create_endo_form').submit(function () {
    //     event.preventDefault();
    //     var lg = $('.ck-endo').length
    //     var num = 0
    //     for (let i = 0; i < lg; i++) {
    //         var is_checked = $($('.ck-endo')[i]).is(':checked')
    //         if(is_checked){
    //             num = num + 1
    //         }
    //     }
    //     if(num > 0){
    //         $(this).unbind('submit').submit()
    //     } else {
    //         Swal.fire('โปรดเลือก Department')
    //     }
    // })

    var loadFile = function(event) {
        var output = document.getElementById('blah');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endsection
