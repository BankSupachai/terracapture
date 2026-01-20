@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    .dropzone {
    max-width: 48%;
    margin: auto;
    margin-top: 2em;
    }
    .literally {
        width: 100%;
        height: 100%;
    }
    .fs-container {
            width: 100%;
            height: 100%;
            margin: auto;
        }
    /* .clear-button{
            top: 0 !important;
            width: 15em !important;
            height: 2em !important;
            line-height: 2em !important;
            font-size: 2em !important;
            border-radius: 0 !important;
            display: none
        } */
        .literally .toolbar{
            /* width: min-content; */
            display: :none
        }
        .toolbar-row-left{
            display: none;
        }
        .toolbar-row-right{
            display:none
        }
        .action-buttons .button-group{
            display: none !important;
            position: absolute !important;
        }
        #canvas{
            width: 100% !important;
            height: 100% !important;}
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
@section('modal')
    <div class="modal fade" id="signed_modal"tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Signature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if (isset($signed_data))
                            <img src="{{@$signed_data}}" alt="">
                        @else
                            <p>ไม่มีข้อมูลลายเซ็นในระบบ</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary ">Save Changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_line" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <form action="{{url("admin/user")}}" method="post">
                    @csrf
                    <input type="text" name="event" value="lineidtocloud" class="form-control">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Line</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" name="lineid" class="form-control">
                            <input type="text" name="userid" value="{{$uid}}" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </form>


            </div>
        </div>
    </div>



    <div id="upload_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Upload Signature</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <img src="" class="img-fluid mb-3" id="signed_img" >
                        <button id="upload_dummy_btn" class="btn btn-info">Upload</button>
                        <button id="clear_upload_btn" class="btn btn-danger mt-3">Clear</button>
                    </div>

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
@section('content')

{{-- @dd("mmfdfdf") --}}
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
                    <li class="nav-item border-end border-dark user-tab">
                        <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab" id="user_tab">
                            User
                        </a>
                    </li>
                    @if ($type != 'EDIT')
                        <li class="nav-item user-tab">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab" id="endo_tab">
                                Endoindex
                            </a>
                        </li>
                    @else
                        {{-- <li class="nav-item"></li> --}}
                    @endif
                </ul>
            </div>
            <div class="col-8"></div>
            <div class="col-1">
                <a id="btn_modal_line" class="btn btn-success">Line</a>
            </div>
        </div>
        <div class="row"><hr></div>
        <div class="row">
            {{-- <span>User</span> --}}
        </div>
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="home1" role="tabpanel">
                <form action="{{url("admin/user")}}" method="post" enctype="multipart/form-data" id="edit_form" onsubmit="return validateForm()">
                    @csrf
                    <input type="hidden" name="type" value="{{@$type}}">
                    <input type="hidden" name="user_tab" value="user">
                    <input type="hidden" name="event" value="user_edit">
                    @isset($user)
                        <input type="hidden" name="id" value="{{@$user->uid}}">
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
                                <input type="text" class="form-control bg-light" id="user_firstname" name="user_firstname" value="@isset($user->user_type)  @if($user->user_type != 'endo' || isset($user->user_firstname)) {{@$user->user_firstname}} @else {{@$user->name}} @endif @endisset"   @isset($user->user_type) @if($user->user_type != 'endo') required  @endif @endisset>
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basicInput" class="form-label">Last Name <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" id="user_lastname" name="user_lastname" value="{{@$user->user_lastname}}"  @isset($user->user_type) @if($user->user_type != 'endo') required  @endif @endisset>
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basicInput" class="form-label">Eng Name </label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" id="user_engname" name="user_engname" value="{{@$user->name_eng}}"  @isset($user->user_type) @if($user->user_type != 'endo')   @endif @endisset>
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
                        {{-- @dd($user) --}}
                        <div class="col-auto">
                            <label for="basiInput" class="form-label" style="margin-left: 1em;">Phone</label>
                        </div>
                        <div class="col-2 ">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <input type="text" class="form-control bg-light" style="margin-left: 3em;" id="user_phone" name="user_phone" value="{{@$user->phone}}">
                            </div>
                        </div>
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Color</label>
                        </div>
                        <div class="col-2">
                            {{-- @dd($user->color) --}}
                            <div class="align-items-center text-nowrap" style="width: 30%">
                                <input type="color" class="form-control bg-light"  id="user_color" name="user_color" value="{{@$user->color}}">
                            </div>
                        </div>
                    </div>


                    <div class="row cn p-3">
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Type <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2">
                            <select class="form-control" style="width: 86%;" name="user_type" required>
                                <option value="">Please choose user type</option>
                                <option @isset($user->user_type) @if($user->user_type == 'anesthesia') selected  @endif @endisset value="anesthesia">Anesthesia</option>
                                <option @isset($user->user_type) @if($user->user_type == 'doctor') selected  @endif @endisset value="doctor">Doctor</option>
                                <option @isset($user->user_type) @if($user->user_type == 'endo') selected  @endif @endisset value="endo">Endo</option>
                                <option @isset($user->user_type) @if($user->user_type == 'nurse') selected  @endif @endisset value="nurse">Nurse</option>
                                <option @isset($user->user_type) @if($user->user_type == 'nurse_anas') selected  @endif @endisset value="nurse_anas">Nurse Anas</option>
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
                                    <input class="form-check-input" type="radio"  name="user_status" id="radio_active" value="active" @isset($user->user_status) @if($user->user_status == 'active') checked @endif  @endisset required>
                                    <label class="form-check-label" for="radio_active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" name="user_status" value="inactive" id="radio_inactive" @isset($user->user_status) @if($user->user_status == 'inactive') checked @endif  @endisset>
                                    <label class="form-check-label" for="radio_inactive">
                                        Inactive
                                    </label>

                                </div>
                            </div>
                        </div>
                        <div class="col-2" >
                            <select class="form-select" name="user_branch" id="user_branch">
                              <option  value="">N/A</option>
                              <option @isset($user->user_branch) @if($user->user_branch == 'med')      selected @endif @endisset value="med">MED</option>
                              <option @isset($user->user_branch) @if($user->user_branch == 'sur')      selected @endif @endisset value="sur">SUR</option>
                              <option @isset($user->user_branch) @if($user->user_branch == 'sur(gen)')      selected @endif @endisset value="sur(gen)">SUR(Gen)</option>
                              <option @isset($user->user_branch) @if($user->user_branch == 'sur(ped)') selected @endif @endisset value="sur(ped)">SUR(PED)</option>
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

                        <div class="col-auto" style="display: none">
                            <label for="basiInput" class="form-label">Password <span style="color: red">*</span></label>
                        </div>
                        <div class="col-3" style="display: none">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                @if ($type == 'EDIT')
                                    <input type="password" class="form-control bg-light " style="margin-left: 21px;" id="password" name="user_password" value="{{@$user->password}}" >
                                    <input type="password" class="form-control bg-light " style="margin-left: 21px;" id="password_dummy" name="user_password_dummy" value="123456" oninput="set_password()">
                                @else
                                    <input type="password" class="form-control bg-light " style="margin-left: 21px;" id="password" name="user_password" value="" required>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 border p-5">
                            <h4>Department set case <span style="color: red">*</span></h4>
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
                            <input class="form-control input-pos mb-3" name="user_image" style="" type="file" accept="image/*" onchange="loadFile(event, 'blah')">
                            <img src="{{@$img}}" class="img-fluid" id="blah" >
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="row">
                            <div class="col-1"><h4 class="mb-3 mt-2">E-sign</h4></div>
                            <div class="col-2"><a href="{{url('esign/'.@$user->id).'?from=admin'}}" class="btn btn-primary">Edit Signature</a></div>
                        </div>
                    </div>
                    <input class="form-control input-pos mb-3" id="signed_img_inp" name="user_sign_upload" type="file" accept="image/*" onchange="loadFile(event, 'signed_img')" style="display:none">

                    <div class="row m-0 mt-5">
                        <div class="col"></div>
                        <div class="col-auto">
                            <a href="{{url("admin/user")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                            <button type="submit" id="submit_btn" class="btn btn-primary btn-label waves-effect btn-md right waves-light"><i class=" ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="profile1" role="tabpanel">
                <form action="{{url("admin/user")}}" method="post">
                    @csrf
                    <input type="hidden" name="type" value="{{@$type}}">
                    <input type="hidden"  name="user_tab" value="endo">
                    <input type="hidden" name="event" value="user_create">
                    @isset($user)
                        <input type="hidden" name="id" value="{{@$user->id}}">
                    @endisset
                    <div class="row align-items-center p-3">
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Name <span style="color: red">*</span></label>
                        </div>
                        <div class="col-6" style="width: 56%">
                            <div class="">
                                <input type="text" class="form-control bg-light" name="endo_name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center p-3">
                        <div class="col-auto">
                            <label for="basiInput" class="form-label">Type <span style="color: red">*</span></label>
                        </div>
                        <div class="col-3">
                                <select class="form-control" name="endo_type" required>
                                    <option value="endo" selected>endo</option>
                                </select>
                        </div>
                        <div class="col-auto">
                            <label for="basiInput" class="form-label" style="margin-left: 1em;">Status <span style="color: red">*</span></label>
                        </div>
                        <div class="col-2">
                            <div class="d-inline-flex align-items-center text-nowrap ">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="endo_status" id="flexRadioDefault1" required checked>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check ms-3">
                                    <input class="form-check-input" type="radio" name="endo_status" id="flexRadioDefault1">
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
                                    <input type="text" class="form-control bg-light" style="margin-left: 11px;" name="endo_email" required>
                                </div>
                            </div>
                            <div class="col-auto">
                                <label for="basiInput" class="form-label ms-3">Password <span style="color: red">*</span></label>
                            </div>
                            <div class="col-3">
                                <div class="">
                                    <input type="password" class="form-control bg-light ms-3" name="endo_password" required>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row m-0 mt-5">
                        <div class="col"></div>
                        <div class="col-auto">
                            <a href="{{url("admin/user")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                            <button type="type" class="btn btn-primary btn-label waves-effect btn-md right waves-light"><i class=" ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Edit</button>
                        </div>
                    </div>
                    </div>

                </form>
        </div>
    </div>
</div>

@endsection




@section('script')
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script src="{{ url('public/extra/esign/literallycanvas.fat.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var literally_obj;

    $("#btn_modal_line").click(function(){
        // alert('Modal');
        $("#modal_line").modal('show');
    });


    function set_password(){
        $('#password').val($('#password_dummy').val())
    }

    $('#edit_form').submit(function () {
        event.preventDefault();
        // var is_checked = $('div.checkbox-group :checkbox:checked').length > 0
        let department_select = $('#department_select').val();
        if(department_select!=""){
            $(this).unbind('submit').submit()
        } else {
            Swal.fire('โปรดเลือก Department')
        }
    })

    $('#upload_dummy_btn').on('click', function () {
        $('#signed_img_inp').click()
    })

    $('#clear_upload_btn').on('click', function () {
        removeFileFromFileList(0, 'signed_img_inp')
        $('#signed_img').attr('src', '')
    })

    $('#clear_canvas').on('click', function () {
        literally_obj = $('.literally').literallycanvas();
    })

    var loadFile = function(event, img_id) {
        var output = document.getElementById(img_id);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    $(document).ready(function() {
        literally_obj = $('.literally').literallycanvas();
        $('.toolbar').css('display', 'none')
    });

    function validateForm() {
        var user_code = $('#user_code').val()
        var user_code_esign = $('#user_code_esign').val()
        var check_file_inp = $('#signed_img_inp').get(0).files.length

        if(user_code != undefined && (user_code_esign != undefined && user_code_esign != '') ){
            if(user_code != user_code_esign){
                Swal.fire('Doctor code ไม่ถูกต้อง')
                $('#user_code_esign').val()
                return false
            } else {

                if(check_file_inp == 0){
                    var canvas = document.getElementById('canvas');
                    var dataURL = canvas.toDataURL();
                    $('#user_code_dataurl').text(dataURL)
                }
            }
        } else {
            if(check_file_inp > 0){
                if(user_code_esign == undefined || user_code_esign == ''){
                    Swal.fire('Doctor code ไม่ถูกต้อง')
                    $('#user_code_esign').val()
                    return false
                }
            }
        }
        return true
    }

    function removeFileFromFileList(index, inp_file_id) {
        const dt = new DataTransfer()
        const input = document.getElementById(inp_file_id)
        const { files } = input

        for (let i = 0; i < files.length; i++) {
            const file = files[i]
            if (index !== i)
            dt.items.add(file)
        }

        input.files = dt.files
    }



</script>
@endsection
