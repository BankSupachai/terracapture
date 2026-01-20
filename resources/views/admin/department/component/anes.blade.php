<link rel="stylesheet" href="{{url("public/css/admin/department.css")}}">
<div class="row m-0">
    <div class="col-lg-6">
        <div class="row" style="align-items: center;">
            <div class="col-3">Anes list</div>
            <div class="col-6">
                <div class="input-icon input-icon-right">
                    <input type="text" class="form-control form-control-sm" id="anes_search" placeholder="Search..."/>
                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                </div>
            </div>
            <div class="col-3 text-left"><button class="btn btn-primary anes_create">+ Add</button></div>
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
                        @foreach ($anes as $doc)
                        <tr class="anes_edit" anes_id="{{$doc->id}}">
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

    <div id="anes_create" class="col-lg-6 border border-secondary" style="display: none">
        <form action="{{url('department')}}" method="POST" class="row mt-6" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="event" value="user_add">
            <input type="hidden" name="user_type" value="anes">


            <div class="col-lg-12 mb-2">
                <h3>Anes detail (Create)</h3>
            </div>

            <div class="col-lg-2 mb-4">
                <label for="name_anes">Prefix</label>
                <input type="text" name="user_prefix" class="form-control" id="create_anes_prefix" placeholder="prefix" required>
            </div>

            <div class="col-lg-5 mb-4">
                <label for="name_anes">Firstname</label>
                <input type="text" name="user_firstname" class="form-control" id="create_anes_firstname" placeholder="first name" required>
            </div>

            <div class="col-lg-5 mb-4">
                <label for="name_anes">Lastname</label>
                <input type="text" class="form-control" name="user_lastname" id="create_anes_lastname" placeholder="last name" required>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Phone</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                        <input id="create_anes_phone" type="text" name="phone" class="form-control" placeholder="Phone" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-0">
                    <label>Color</label>
                    <div class="input-group">
                        <input id="create_anes_color" name="color" type="color" class="form-control p-0"/>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <label>RFID</label>
                <input id="create_anes_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
            </div>
            <div class="col-lg-12 mt-2 mb-2">
                <label>User Code</label>
                <input id="create_anes_user_code" type="text" name="user_code" class="form-control" placeholder="user code" />
            </div>
            <div class="col-lg-12 mb-4">
                <label for="exampleFormControlSelect1">Department</label>
                @foreach($tb_department as $data)

                    <br>

                                @if(Request::segment(2)==$data->department_id)
                                <input  id      ="create_department_anes{{$data->department_id}}"
                                        type    ="checkbox"
                                        name    ="department_id[]"
                                        value   ="{{$data->department_id}}"
                                        checked
                                >
                                @else
                                <input  id      ="create_department_anes{{$data->department_id}}"
                                        type    ="checkbox"
                                        name    ="department_id[]"
                                        value   ="{{$data->department_id}}"
                                >
                                @endif

                    <label for="create_department_anes{{$data->department_id}}">{{nbsp(3)}}{{$data->department_name}}</label>

                    @endforeach
            </div>
            <div class="col-lg-6 mb-4">
                <label for="name_user">Username</label>
                <input id="name_user_insert" name="email" type="text" class="form-control name_user_insert" autocomplete="new-email">
                <small id="alert_anes"></small>
            </div>
            <div class="col-lg-6 mb-4">
                <label for="name_pass">Password</label>
                <input id="create_anes_password" type="password" name="password"  class="form-control" autocomplete="new-password">
            </div>
            <div class="col-lg-6 mt-3 mb-4">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="rfid_file" id="customFile" accept="image/*"/>
                    <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
            </div>
            <div class="col-lg-12 mt-3 mb-4 text-right">
                <button type="submit" id="edit_btn_dictor" class="btn btn-primary btn-lg">Create</button>
            </div>
        </form>
    </div>




    <div id="anes_edit" class="col-lg-6 border border-secondary" style="display: none;">
        <form method="POST" action="{{url('department')}}" enctype="multipart/form-data" id="anes_myform">
            @csrf
            <input type="hidden" name="event" value="update_image">
            <input type="hidden" name="id" id="users_anes_id">
            <input type="hidden" name="type_select" value="anes">
            <input type="hidden" name="department_select" value="{{$department->department_id}}">
            <div class="row mt-6">
                <div class="col-lg-12 mb-2">
                    <h3>anes detail</h3>
                </div>
                <input id="edit_anes_id" type="hidden">
                <div class="col-lg-2 mb-4">
                    <label for="name_anes">Prefix</label>
                    <input id="edit_anes_id" type="hidden">
                    <input id="edit_anes_prefix" type="text" class="form-control"  placeholder="prefix" required>
                </div>

                <div class="col-lg-5 mb-4">
                    <label for="name_anes">Firstname</label>
                    <input type="text" class="form-control" id="edit_anes_firstname" placeholder="first name" required>
                </div>

                <div class="col-lg-5 mb-4">
                    <label for="name_anes">Lastname</label>
                    <input type="text" class="form-control" id="edit_anes_lastname" placeholder="last name" required>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                            <input id="edit_anes_phone" type="text" class="form-control" placeholder="Phone" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group m-0">
                        <label>Color</label>
                        <div class="input-group">
                            <input id="edit_anes_color" type="color" class="form-control p-0"/>
                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>RFID</label>
                    <input id="edit_anes_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
                </div>
                <div class="col-lg-12 mt-2 mb-2">
                    <label>User Code</label>
                    <input id="edit_anes_user_code" type="text" name="user_code" class="form-control" placeholder="user_code" />
                </div>
                <div class="col-lg-12 mb-4">
                    <label for="exampleFormControlSelect1">Department</label>
                    @foreach($tb_department as $data)
                        <br>
                            <input  class="edit_department_anes"
                                    id="edit_department_anes{{$data->department_id}}"
                                    type="checkbox"
                                    name="edit_checkbox_anes"
                                    value="{{$data->department_id}}"
                            >
                        <label for="edit_department_anes{{$data->department_id}}">
                            {{nbsp(3)}}{{$data->department_name}}
                        </label>
                    @endforeach
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="name_user">Username</label>
                    <input id="edit_anes_username" type="text" name="" class="form-control" id="name_user" autocomplete="off">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="name_pass">Password</label>
                    <input id="edit_anes_password" type="text" name="" class="form-control" autocomplete="off">
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4" id="anes_img"></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-6 mt-3 mb-4">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="rfid_file" id="anes_customFile" accept="image/*"/>
                        <label class="custom-file-label" for="anes_customFile">Choose file</label>
                    </div>
                </div>
                <div class="col-lg-6 mt-3 mb-4 text-right">
                    <button id="btn_anes_edit_submit" type="button" class="btn btn-warning btn-lg">Edit</button>
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
    //             $("#alert_anes").html('User นี้มีในระบบแล้ว').css('color','red');
    //             $("#edit_btn_dictor").attr('disabled',true);
    //         }else{
    //             $('#name_user_insert').css('border-color','green');
    //             $("#alert_anes").html('User นี้สามารถใช้ได้').css('color','green');
    //             $("#edit_btn_dictor").attr('disabled',false);
    //         }
    //     });
    // });
    $('.anes_edit').click(function(){
        var part_img = $("#part_image").val();
        $('.anes_edit').attr('style','');
        $(this).attr('style','background-color:#c0c0c0');
        let id = $(this).attr('anes_id');
        $('#anes_edit').show();
        $('#anes_create').hide();
        $.post('{{ url('department') }}', {
            event   : 'user_show',
            id      : id,
        }, function(data, status) {
            let anes = JSON.parse(data);
            $('.edit_department_anes').prop('checked', false);
            anes.department.forEach(element =>$('#edit_department_anes'+element).prop('checked', true));
            $('#edit_anes_id').val(anes.id);
            $('#users_anes_id').val(anes.id);
            $('#anes_img').html('<img src='+part_img+'/'+anes.user_pic+' class="img-fluid">');
            $('#edit_anes_prefix').val(anes.user_prefix);
            $('#edit_anes_rfid').val(anes.user_rfid);
            $('#edit_anes_firstname').val(anes.user_firstname);
            $('#edit_anes_lastname').val(anes.user_lastname);
            $('#edit_anes_phone').val(anes.phone);
            $('#edit_anes_color').val(anes.color);
            $('#edit_anes_username').val(anes.email);
            $('#edit_anes_user_code').val(anes.user_code);
        });
    });

    $('#btn_anes_edit_submit').click(function(){
        let department  = [];
        $('[name=edit_checkbox_anes]:checked').each(function(){department.push($(this).val());});
        $.post('{{ url('department') }}', {
            event       : 'user_update',
            id          : $('#edit_anes_id').val(),
            prefix      : $('#edit_anes_prefix').val(),
            firstname   : $('#edit_anes_firstname').val(),
            lastname    : $('#edit_anes_lastname').val(),
            user_code   : $('#edit_anes_user_code').val(),
            phone       : $('#edit_anes_phone').val(),
            rfid        : $('#edit_anes_rfid').val(),
            color       : $('#edit_anes_color').val(),
            department  : JSON.stringify(department),
            username    : $('#edit_anes_username').val(),
            password    : $('#edit_anes_password').val(),
        }, function(data, status){
            var files = $('#anes_customFile')[0].files;
            if(files.length > 0){
                $("#anes_myform").submit()
            }else{
                window.location.reload();
            }
        });
    });

    $('.anes_create').click(function(){
        $('#anes_edit').hide();
        $('#anes_create').show();
    });
</script>
