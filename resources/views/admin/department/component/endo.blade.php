<link rel="stylesheet" href="{{url("public/css/admin/department.css")}}">
<div class="row m-0">
    <div class="col-lg-6">
        <div class="row" style="align-items: center;">
            <div class="col-3">Endocapture list</div>
            <div class="col-6">
                <div class="input-icon input-icon-right">
                    <input type="text" class="form-control form-control-sm" id="endo_search" placeholder="Search..."/>
                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                </div>
            </div>
            <div class="col-3 text-left"><button class="btn btn-primary endo_create">+ Add</button></div>
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
                        @foreach ($endo as $doc)
                        <tr class="endo_edit" endo_id="{{$doc->id}}">
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


    <div id="endo_create" class="col-lg-6 border border-secondary" style="display: none">
        <form action="{{url('department')}}" method="POST" class="row mt-6" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="event" value="user_add">
            <input type="hidden" name="user_type" value="endo">

            <div class="col-lg-12 mb-2">
                <h3>endo detail (Create)</h3>
            </div>

            {{-- <div class="col-lg-2 mb-4">
                <label for="name_endo">Prefix</label>

            </div> --}}
            <input type="hidden" name="user_prefix" class="form-control" id="create_endo_prefix" placeholder="prefix" required>
            <input type="hidden" name="user_lastname" class="form-control" id="create_endo_prefix" placeholder="prefix" required>

            <div class="col-lg-12 mb-4">
                <label for="name_endo">Name</label>
                <input type="text" name="user_firstname" class="form-control" id="create_endo_firstname" placeholder="Name" required>
            </div>

            {{--
             <div class="col-lg-5 mb-4">
                <label for="name_endo">Lastname</label>
                <input type="text" class="form-control" name="user_lastname" id="create_endo_lastname" placeholder="last name" required>
            </div>
            --}}

            <div class="col-lg-6">
                <div class="form-group">
                    <label>Phone</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                        <input id="create_endo_phone" type="text" name="phone" class="form-control" placeholder="Phone" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group m-0">
                    <label>Color</label>
                    <div class="input-group">
                        <input id="create_endo_color" name="color" type="color" class="form-control p-0"/>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <label>RFID</label>
                <input id="create_endo_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
            </div>
            <div class="col-lg-12 mb-4">
                <label for="exampleFormControlSelect1">Department</label>
                @foreach($tb_department as $data)

                    <br>

                                @if(Request::segment(2)==$data->department_id)
                                <input  id      ="create_department_endo{{$data->department_id}}"
                                        type    ="checkbox"
                                        name    ="department_id[]"
                                        value   ="{{$data->department_id}}"
                                        checked
                                >
                                @else
                                <input  id      ="create_department_endo{{$data->department_id}}"
                                        type    ="checkbox"
                                        name    ="department_id[]"
                                        value   ="{{$data->department_id}}"
                                >
                                @endif

                    <label for="create_department_endo{{$data->department_id}}">{{nbsp(3)}}{{$data->department_name}}</label>

                    @endforeach
            </div>
            <div class="col-lg-6 mb-4">
                <label for="name_user">Username</label>
                <input id="name_user_insert" name="email" type="text" class="form-control name_user_insert" autocomplete="new-email">
                <small id="alert_endo"></small>
            </div>
            <div class="col-lg-6 mb-4">
                <label for="name_pass">Password</label>
                <input id="create_endo_password" type="password" name="password"  class="form-control" autocomplete="new-password">
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





    <div id="endo_edit" class="col-lg-6 border border-secondary" style="display: none">
        <form method="POST" action="{{url('department')}}" enctype="multipart/form-data" id="endo_myform">
            @csrf
            <input type="hidden" name="event" value="update_image">
            <input type="hidden" name="id" id="users_endo_id">
            <input type="hidden" name="type_select" value="endo">
            <input type="hidden" name="department_select" value="{{@$department->department_id}}">
            <div class="row mt-6">
                <div class="col-lg-12 mb-2">
                    <h3>ENDOCAPTURE Department</h3>
                </div>
                <input id="edit_endo_id" type="hidden">

                <!--
                <div class="col-lg-2 mb-4">
                    <label for="name_endo">Prefix</label>
                    <input id="edit_endo_prefix" type="text" class="form-control"  placeholder="prefix">
                </div>
                -->
                <div class="col-lg-12">
                    <label for="name_endo">Endocapture Name</label>
                    <input type="text" class="form-control" id="edit_endo_firstname" placeholder="name" required>
                </div>
                <!--
                <div class="col-lg-5 mb-4">
                    <label for="name_endo">Lastname</label>
                    <input type="text" class="form-control" id="edit_endo_lastname" placeholder="last name">
                </div>
                -->
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Phone</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-phone-alt"></i></span></div>
                            <input id="edit_endo_phone" type="text" class="form-control" placeholder="Phone" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group m-0">
                        <label>Color</label>
                        <div class="input-group">
                            <input id="edit_endo_color" type="color" class="form-control p-0"/>
                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>RFID</label>
                    <input id="edit_endo_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
                </div>
                <div class="col-lg-12 mb-4">
                    <label for="exampleFormControlSelect1">Department</label>
                    @foreach($tb_department as $data)
                        <br>
                            <input  class="edit_department_endo"
                                    id="edit_department_endo{{$data->department_id}}"
                                    type="checkbox"
                                    name="edit_checkbox_endo"
                                    value="{{$data->department_id}}"
                            >
                        <label for="edit_department_endo{{$data->department_id}}">
                            {{nbsp(3)}}{{$data->department_name}}
                        </label>
                    @endforeach
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="name_user">Username</label>
                    <input id="edit_endo_username" type="text" name="" class="form-control" id="name_user">
                </div>
                <div class="col-lg-6 mb-4">
                    <label for="name_pass">Password</label>
                    <input id="edit_endo_password" type="text" name="" class="form-control" >
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4" id="endo_img"></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-6 mt-3 mb-4">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="rfid_file" id="endo_customFile" accept="image/*"/>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>
                <div class="col-lg-6 mt-3 mb-4 text-right">
                    <button id="btn_endo_edit_submit" type="button" class="btn btn-warning btn-lg">Edit</button>
                </div>
                <input type="hidden" name="" id="part_image" value="{{@$part_image}}">
            </div>
        </form>
    </div>
</div>
{{-- @dd($part_image) --}}
<script>
    $('.endo_edit').click(function(){
        var part_img = $("#part_image").val();
        $('.endo_edit').attr('style','');
        $(this).attr('style','background-color:#c0c0c0');
        let id = $(this).attr('endo_id');
        $('#endo_edit').show();
        $('#endo_create').hide();
        $.post('{{ url('department') }}', {
            event   : 'user_show',
            id      : id,
        }, function(data, status) {
            let endo = JSON.parse(data);
            $('.edit_department_endo').prop('checked', false);
            endo.department.forEach(element =>$('#edit_department_endo'+element).prop('checked', true));
            $('#edit_endo_id').val(endo.id);
            $('#users_endo_id').val(endo.id);
            $('#endo_img').html('<img src='+part_img+'/'+endo.user_pic+' class="img-fluid">');
            $('#edit_endo_prefix').val(endo.user_prefix);
            $('#edit_endo_rfid').val(endo.user_rfid);
            $('#edit_endo_firstname').val(endo.user_firstname);
            $('#edit_endo_lastname').val(endo.user_lastname);
            $('#edit_endo_phone').val(endo.phone);
            $('#edit_endo_color').val(endo.color);
            $('#edit_endo_username').val(endo.email);
        });
    });

    $('#btn_endo_edit_submit').click(function(){
        let department  = [];
        $('[name=edit_checkbox_endo]:checked').each(function(){department.push($(this).val());});
        $.post('{{ url('department') }}', {
            event       : 'user_update',
            id          : $('#edit_endo_id').val(),
            prefix      : $('#edit_endo_prefix').val(),
            firstname   : $('#edit_endo_firstname').val(),
            lastname    : $('#edit_endo_lastname').val(),
            phone       : $('#edit_endo_phone').val(),
            color       : $('#edit_endo_color').val(),
            rfid        : $('#edit_endo_rfid').val(),
            department  : JSON.stringify(department),
            username    : $('#edit_endo_username').val(),
            password    : $('#edit_endo_password').val(),
        }, function(data, status){
            var files = $('#endo_customFile')[0].files;
            if(files.length > 0){
                $("#endo_myform").submit()
            }else{
                window.location.reload();
            }
        });
    });

    $('.endo_create').click(function(){
        $('#endo_edit').hide();
        $('#endo_create').show();
    });
</script>
