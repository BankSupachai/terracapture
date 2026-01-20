<link rel="stylesheet" href="{{url("public/css/admin/department.css")}}">
<div class="row m-0">
    <div class="col-lg-6">
        <div class="row" style="align-items: center;">
            <div class="col-3">Nurse list</div>
            <div class="col-6">
                <div class="input-icon input-icon-right">
                    <input type="text" class="form-control form-control-sm" id="nurse_search" placeholder="Search..."/>
                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                </div>
            </div>
            <div class="col-3 text-left"><button class="btn btn-primary nurse_create">+ Add</button></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Color</th>
                        <th colspan="2">Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($nurse as $doc)
                        <tr class="nurse_edit" nurse_id="{{$doc->id}}">
                            <td>
                                {{$doc->user_prefix}}{{$doc->user_firstname}} {{$doc->user_lastname}}</td>
                            @if(checkNULL($doc->color))
                                <td><div class="box_color" style="background-color:{{$doc->color}};"></div></td>
                            @else
                                <td><div class="box_color" style="background-color: white;"></div></td>
                            @endif
                            <td>{{$doc->phone}}</td>
                            <td>
                                <a href="#"><i class="fas fa-angle-right"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div id="nurse_create" class="col-lg-6 border border-secondary" style="display: none">
        <form action="{{url('department')}}" method="POST" class="row mt-6" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="event" value="user_add">
            <input type="hidden" name="user_type" value="nurse">

            <div class="col-lg-12 mb-2">
                <h3>Nurse detail (Create)</h3>
            </div>

            <div class="col-lg-2 mb-4">
                <label for="name_nurse">Prefix</label>
                <input type="text" name="user_prefix" class="form-control" id="create_nurse_prefix" placeholder="prefix" required>
            </div>

            <div class="col-lg-5 mb-4">
                <label for="name_nurse">Firstname</label>
                <input type="text" name="user_firstname" class="form-control" id="create_nurse_firstname" placeholder="first name" required>
            </div>

            <div class="col-lg-5 mb-4">
                <label for="name_nurse">Lastname</label>
                <input type="text" class="form-control" name="user_lastname" id="create_nurse_lastname" placeholder="last name" required>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Phone</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                        <input id="create_nurse_phone" type="text" name="phone" class="form-control" placeholder="Phone" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-0">
                    <label>Color</label>
                    <div class="input-group">
                        <input id="create_nurse_color" name="color" type="color" class="form-control p-0"/>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <label>RFID</label>
                <input id="create_nurse_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
            </div>
            <div class="col-lg-12 mt-2 mb-2">
                <label>User Code</label>
                <input id="create_nurse_user_code" type="text" name="user_code" class="form-control" placeholder="user code" />
            </div>
            <div class="col-lg-12 mb-4">
                <label for="exampleFormControlSelect1">Department</label>
                @foreach($tb_department as $data)

                    <br>

                                @if(Request::segment(2)==$data->department_id)
                                <input  id      ="create_department_nurse{{$data->department_id}}"
                                        type    ="checkbox"
                                        name    ="department_id[]"
                                        value   ="{{$data->department_id}}"
                                        checked
                                >
                                @else
                                <input  id      ="create_department_nurse{{$data->department_id}}"
                                        type    ="checkbox"
                                        name    ="department_id[]"
                                        value   ="{{$data->department_id}}"
                                >
                                @endif

                    <label for="create_department_nurse{{$data->department_id}}">{{nbsp(3)}}{{$data->department_name}}</label>

                    @endforeach
            </div>
            <div class="col-lg-6 mb-4">
                <label for="name_user">Username</label>
                <input id="name_user_insert" name="email" type="text" class="form-control name_user_insert" autocomplete="new-email">
                <small id="alert_nurse"></small>
            </div>
            <div class="col-lg-6 mb-4">
                <label for="name_pass">Password</label>
                <input id="create_nurse_password" type="password" name="password"  class="form-control" autocomplete="new-password">
            </div>
            <div class="col-lg-6 mt-3 mb-4">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="rfid_file" id="customFile" accept="image/*"/>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="col-lg-6 mt-3 mb-4 text-right">
                <button type="submit" id="edit_btn_dictor" class="btn btn-primary btn-lg">Create</button>
            </div>
        </form>
    </div>






    <div id="nurse_edit" class="col-lg-6 border border-secondary" style="display: none">
        <form method="POST" action="{{url('department')}}" enctype="multipart/form-data" id="nurse_myform">
            @csrf
            <input type="hidden" name="event" value="update_image">
            <input type="hidden" name="id" id="users_nurse_id">
            <input type="hidden" name="type_select" value="nurse">
            <input type="hidden" name="department_select" value="{{@$department->department_id}}">
            <div class="row mt-6">
                <div class="col-lg-12 mb-2">
                    <h3>Nurse detail</h3>
                </div>

                <div class="col-lg-2 mb-4">
                    <label for="name_nurse">Prefix</label>
                    <input id="edit_nurse_id" type="hidden">
                    <input id="edit_nurse_prefix" type="text" class="form-control"  placeholder="prefix" required>
                </div>

                <div class="col-lg-5 mb-4">
                    <label for="name_nurse">Firstname</label>
                    <input type="text" class="form-control" id="edit_nurse_firstname" placeholder="first name" required>
                </div>

                <div class="col-lg-5 mb-4">
                    <label for="name_nurse">Lastname</label>
                    <input type="text" class="form-control" id="edit_nurse_lastname" placeholder="last name" required>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                            <input id="edit_nurse_phone" type="text" class="form-control" placeholder="Phone" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group m-0">
                        <label>Color</label>
                        <div class="input-group">
                            <input id="edit_nurse_color" type="color" class="form-control p-0"/>
                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>RFID</label>
                    <input id="edit_nurse_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
                </div>
                <div class="col-lg-12 mt-2 mb-2">
                    <label>User Code</label>
                    <input id="edit_nurse_user_code" type="text" name="user_code" class="form-control" placeholder="user code" />
                </div>
                <div class="col-lg-12 mb-4">
                    <label for="exampleFormControlSelect1">Department</label>
                    @foreach($tb_department as $data)
                        <br>
                            <input  class="edit_department_nurse"
                                    id="edit_department_nurse{{$data->department_id}}"
                                    type="checkbox"
                                    name="edit_checkbox_nurse"
                                    value="{{$data->department_id}}"
                            >
                        <label for="edit_department_nurse{{$data->department_id}}">
                            {{nbsp(3)}}{{$data->department_name}}
                        </label>
                    @endforeach
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="name_user">Username</label>
                    <input id="edit_nurse_username" type="text" name="" class="form-control">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="name_pass">Password</label>
                    <input id="edit_nurse_password" type="text" name="" class="form-control" >
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4" id="nurse_img"></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-6 mt-3 mb-4">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="rfid_file" id="nurse_customFile" accept="image/*"/>
                        <label class="custom-file-label" for="nurse_customFile">Choose file</label>
                    </div>
                </div>
                <div class="col-lg-6 mt-3 mb-4 text-right">
                    <button id="btn_nurse_edit_submit" type="button" class="btn btn-warning btn-lg">Edit</button>
                </div>
                <input type="hidden" name="" id="part_image" value="{{@$part_image}}">
            </div>
        </form>
    </div>
</div>


<script>
    $('#create_nurse_username').keyup(function(){
        var username = $(this).val();
        $.post('{{ url('jquery') }}', {
            event               : 'check_user_name',
            username            : username
        }, function(data, status){
            if(data>=1){
                $('#create_nurse_username').css('border-color','red');
                $("#alert_nurse").html('User นี้มีในระบบแล้ว').css('color','red');
                $("#insert_btn_nurse").attr('disabled',true);
            }else{
                $('#create_nurse_username').css('border-color','green');
                $("#alert_nurse").html('User นี้สามารถใช้ได้').css('color','green');
                $("#insert_btn_nurse").attr('disabled',false);
            }
        });
    });
    $('.nurse_edit').click(function(){
        var part_img = $("#part_image").val();
        $('.nurse_edit').attr('style','');
        $(this).attr('style','background-color:#c0c0c0');

        let id = $(this).attr('nurse_id');
        $('#nurse_edit').show();
        $('#nurse_create').hide();
        $.post('{{ url('department') }}', {
            event   : 'user_show',
            id      : id,
        }, function(data, status) {
            let nurse = JSON.parse(data);
            $('.edit_department_nurse').prop('checked', false);
            nurse.department.forEach(element =>$('#edit_department_nurse'+element).prop('checked', true));
            $('#edit_nurse_id').val(nurse.id);
            $('#users_nurse_id').val(nurse.id);
            $('#nurse_img').html('<img src='+part_img+'/'+nurse.user_pic+' class="img-fluid">');
            $('#edit_nurse_prefix').val(nurse.user_prefix);
            $('#edit_nurse_rfid').val(nurse.user_rfid);
            $('#edit_nurse_firstname').val(nurse.user_firstname);
            $('#edit_nurse_lastname').val(nurse.user_lastname);
            $('#edit_nurse_phone').val(nurse.phone);
            $('#edit_nurse_color').val(nurse.color);
            $('#edit_nurse_username').val(nurse.email);
            $('#edit_nurse_user_code').val(nurse.user_code);
        });
    });

    $('#btn_nurse_edit_submit').click(function(){
        let department  = [];
        $('[name=edit_checkbox_nurse]:checked').each(function(){department.push($(this).val());});
        $.post('{{ url('department') }}', {
            event       : 'user_update',
            id          : $('#edit_nurse_id').val(),
            prefix      : $('#edit_nurse_prefix').val(),
            firstname   : $('#edit_nurse_firstname').val(),
            lastname    : $('#edit_nurse_lastname').val(),
            phone       : $('#edit_nurse_phone').val(),
            user_code   : $('#edit_nurse_user_code').val(),
            color       : $('#edit_nurse_color').val(),
            rfid        : $('#edit_nurse_rfid').val(),
            department  : JSON.stringify(department),
            username    : $('#edit_nurse_username').val(),
            password    : $('#edit_nurse_password').val(),
        }, function(data, status){
            var files = $('#nurse_customFile')[0].files;
            if(files.length > 0){
                $("#nurse_myform").submit()
            }else{
                window.location.reload();
            }
        });
    });

    $('.nurse_create').click(function(){
        $('#nurse_edit').hide();
        $('#nurse_create').show();
    });
</script>
