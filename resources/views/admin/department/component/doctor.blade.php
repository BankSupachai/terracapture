<link rel="stylesheet" href="{{url("public/css/admin/department.css")}}">
<div class="row m-0">
    <div class="col-lg-6">
        <div class="row" style="align-items: center;">
            <div class="col-3">Doctor list</div>
            <div class="col-6">
                <div class="input-icon input-icon-right">
                    <input type="text" class="form-control form-control-sm" id="doctor_search" placeholder="Search..."/>
                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                </div>
            </div>
            <div class="col-3 text-left"><button class="btn btn-primary doctor_create">+ Add</button></div>
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
                        @foreach ($doctor as $doc)
                        <tr class="doctor_edit" doctor_id="{{$doc->id}}">
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

    <div id="doctor_create" class="col-lg-6 border border-secondary" style="display: none">
        <form action="{{url('department')}}" method="POST" class="row mt-6" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="event" value="user_add">
            <input type="hidden" name="user_type" value="doctor">

            <div class="col-lg-12 mb-2">
                <h3>Doctor detail (Create)</h3>
            </div>

            <div class="col-lg-2 mb-4">
                <label for="name_doctor">Prefix</label>
                <input type="text" name="user_prefix" class="form-control" id="create_doctor_prefix" placeholder="prefix" required>
            </div>

            <div class="col-lg-5 mb-4">
                <label for="name_doctor">Firstname</label>
                <input type="text" name="user_firstname" class="form-control" id="create_doctor_firstname" placeholder="first name" required>
            </div>

            <div class="col-lg-5 mb-4">
                <label for="name_doctor">Lastname</label>
                <input type="text" class="form-control" name="user_lastname" id="create_doctor_lastname" placeholder="last name" required>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Phone</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                        <input id="create_doctor_phone" type="text" name="phone" class="form-control" placeholder="Phone" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-0">
                    <label>Color</label>
                    <div class="input-group">
                        <input id="create_doctor_color" name="color" type="color" class="form-control p-0"/>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <label>RFID</label>
                <input id="create_doctor_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
            </div>
            <div class="col-lg-12 mt-2 mb-2">
                <label>User Code</label>
                <input id="create_doctor_user_code" type="text" name="user_code" class="form-control" placeholder="user code" />
            </div>
            <div class="col-lg-12 mb-4">
                <label for="exampleFormControlSelect1">Department</label>
                @foreach($tb_department as $data)

                    <br>

                                @if(Request::segment(2)==$data->department_id)
                                <input  id      ="create_department_doctor{{$data->department_id}}"
                                        type    ="checkbox"
                                        name    ="department_id[]"
                                        value   ="{{$data->department_id}}"
                                        checked
                                >
                                @else
                                <input  id      ="create_department_doctor{{$data->department_id}}"
                                        type    ="checkbox"
                                        name    ="department_id[]"
                                        value   ="{{$data->department_id}}"
                                >
                                @endif

                    <label for="create_department_doctor{{$data->department_id}}">{{nbsp(3)}}{{$data->department_name}}</label>

                    @endforeach
            </div>
            <div class="col-lg-6 mb-4">
                <label for="name_user">Username</label>
                <input id="name_user_insert" name="email" type="text" class="form-control name_user_insert" autocomplete="new-email">
                <small id="alert_doctor"></small>
            </div>
            <div class="col-lg-6 mb-4">
                <label for="name_pass">Password</label>
                <input id="create_doctor_password" type="password" name="password"  class="form-control" autocomplete="new-password">
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




    <div id="doctor_edit" class="col-lg-6 border border-secondary" style="display: none">
        <form method="POST" action="{{url('department')}}" enctype="multipart/form-data" id="myform_doctor">
            @csrf
            <input type="hidden" name="event" value="update_image">
            <input type="hidden" name="id" id="users_doctor_id">
            <input type="hidden" name="type_select" value="doctor">
            <input type="hidden" name="department_select" value="{{@$department->department_id}}">
            <div class="row mt-6">
                <div class="col-lg-12 mb-2">
                    <h3>Doctor detail</h3>
                </div>

                <div class="col-lg-2 mb-4">
                    <label for="name_doctor">Prefix</label>
                    <input id="edit_doctor_id" type="hidden">
                    <input id="edit_doctor_prefix" type="text" class="form-control"  placeholder="prefix" required>
                </div>

                <div class="col-lg-5 mb-4">
                    <label for="name_doctor">Firstname</label>
                    <input type="text" class="form-control" id="edit_doctor_firstname" placeholder="first name" required>
                </div>

                <div class="col-lg-5 mb-4">
                    <label for="name_doctor">Lastname</label>
                    <input type="text" class="form-control" id="edit_doctor_lastname" placeholder="last name" required>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                            <input id="edit_doctor_phone" type="text" class="form-control" placeholder="Phone" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group m-0">
                        <label>Color</label>
                        <div class="input-group">
                            <input id="edit_doctor_color" type="color" class="form-control p-0"/>
                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>RFID</label>
                    <input id="edit_doctor_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
                </div>
                <div class="col-lg-12 mt-2 mb-2">
                    <label>User Code</label>
                    <input id="edit_doctor_user_code" type="text" name="user_code" class="form-control" placeholder="user code" />
                </div>
                <div class="col-lg-12 mb-4">
                    <label for="exampleFormControlSelect1">Department</label>
                    @foreach($tb_department as $data)
                        <br>
                            <input  class="edit_department_doctor"
                                    id="edit_department_doctor{{$data->department_id}}"
                                    type="checkbox"
                                    name="edit_checkbox_doctor"
                                    value="{{$data->department_id}}"
                            >
                        <label for="edit_department_doctor{{$data->department_id}}">
                            {{nbsp(3)}}{{$data->department_name}}
                        </label>
                    @endforeach
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="name_user">Username</label>
                    <input id="edit_doctor_username" type="text" name="" class="form-control" id="name_user" autocomplete="off">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="name_pass">Password</label>
                    <input id="edit_doctor_password" type="text" name="" class="form-control" autocomplete="off">
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4" id="doctor_img"></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-6 mt-3 mb-4">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="rfid_file" id="doctor_customFile" accept="image/*"/>
                        <label class="custom-file-label" for="doctor_customFile">Choose file</label>
                    </div>
                </div>
                <div class="col-lg-12 mt-3 mb-4 text-right">
                    <button id="btn_doctor_edit_submit" type="button" class="btn btn-warning btn-lg">Edit</button>
                </div>
                <input type="hidden" name="" id="part_image" value="{{@$part_image}}">
            </div>
        </form>
    </div>
</div>


<script>
    // $('#name_user_insert').keyup(function(){
    //     var username = $(this).val();
    //     $.post('{{ url('jquery') }}', {
    //         event               : 'check_user_name',
    //         username            : username
    //     }, function(data, status){
    //         if(data>=1){
    //             $('#name_user_insert').css('border-color','red');
    //             $("#alert_doctor").html('User นี้มีในระบบแล้ว').css('color','red');
    //             $("#edit_btn_dictor").attr('disabled',true);
    //         }else{
    //             $('#name_user_insert').css('border-color','green');
    //             $("#alert_doctor").html('User นี้สามารถใช้ได้').css('color','green');
    //             $("#edit_btn_dictor").attr('disabled',false);
    //         }
    //     });
    // });
    $('.doctor_edit').click(function(){
        $('.doctor_edit').attr('style','');
        $(this).attr('style','background-color:#c0c0c0');
        var part_img = $("#part_image").val();
        let id = $(this).attr('doctor_id');
        $('#doctor_edit').show();
        $('#doctor_create').hide();
        $.post('{{ url('department') }}', {
            event   : 'user_show',
            id      : id,
        }, function(data, status) {
            let doctor = JSON.parse(data);
            $('.edit_department_doctor').prop('checked', false);
            doctor.department.forEach(element =>$('#edit_department_doctor'+element).prop('checked', true));
            $('#edit_doctor_id').val(doctor.id);
            $('#users_doctor_id').val(doctor.id);
            $('#doctor_img').html('<img src='+part_img+'/'+doctor.user_pic+' class="img-fluid">');
            $('#edit_doctor_rfid').val(doctor.user_rfid);
            $('#edit_doctor_prefix').val(doctor.user_prefix);
            $('#edit_doctor_firstname').val(doctor.user_firstname);
            $('#edit_doctor_lastname').val(doctor.user_lastname);
            $('#edit_doctor_phone').val(doctor.phone);
            $('#edit_doctor_color').val(doctor.color);
            $('#edit_doctor_username').val(doctor.email);
            $('#edit_doctor_user_code').val(doctor.user_code);

        });
    });

    $('#btn_doctor_edit_submit').click(function(){
        let department  = [];
        $('[name=edit_checkbox_doctor]:checked').each(function(){department.push($(this).val());});
        $.post('{{ url('department') }}', {
            event       : 'user_update',
            id          : $('#edit_doctor_id').val(),
            prefix      : $('#edit_doctor_prefix').val(),
            firstname   : $('#edit_doctor_firstname').val(),
            lastname    : $('#edit_doctor_lastname').val(),
            phone       : $('#edit_doctor_phone').val(),
            user_code   : $('#edit_doctor_user_code').val(),
            color       : $('#edit_doctor_color').val(),
            rfid        : $('#edit_doctor_rfid').val(),
            department  : JSON.stringify(department),
            username    : $('#edit_doctor_username').val(),
            password    : $('#edit_doctor_password').val(),
        }, function(data, status){
            var files = $('#doctor_customFile')[0].files;
            if(files.length > 0){
                $("#myform_doctor").submit()
            }else{
                window.location.reload();
            }
        });
    });

    $('.doctor_create').click(function(){
        $('#doctor_edit').hide();
        $('#doctor_create').show();
    });
</script>
