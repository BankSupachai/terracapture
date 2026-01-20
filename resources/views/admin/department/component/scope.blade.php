<link rel="stylesheet" href="{{url("public/css/admin/department.css")}}">
<div class="row m-0">
    <div class="col-lg-6">
        <div class="row" style="align-items: center;">
            <div class="col-3">Scope list</div>
            <div class="col-6">
                <div class="input-icon input-icon-right">
                    <input type="text" class="form-control form-control-sm" id="doctor_search" placeholder="Search..."/>
                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                </div>
            </div>
            <div class="col-3 text-left"><button class="btn btn-primary scope_create" >+ Add</button></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Model</th>
                        <th>Installation date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tb_scope as $data)
                        <tr class="scope_edit" scope_id="{{$data->scope_id}}">
                            <td>{{$data->scope_name}}</td>
                            <td>{{$data->scope_model}}</td>
                            <td>{{$data->scope_installdate}}</td>
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

    <div id="scope_create" class="col-lg-6 border border-secondary" style="display: none">
        <form action="{{url('department')}}" method="POST" class="row mt-6">
            @csrf
            <input type="hidden" name="event" value="scope_add">
            <input type="hidden" name="type" value="scope">

        <div class="col-lg-12 mb-2">
            <h3>Scope detail</h3>
        </div>
        <div class="col-lg-12 mb-4">
            <input id="create_scope_id" type="hidden">
            <label for="name_doctor">Name</label>
            <input id="create_scope_name" type="text" name="scope_name" class="form-control" placeholder="Scope Name" required>
            <small id="alert_name"></small>
        </div>
        <div class="col-lg-6 mb-4">
            <label>Brand</label>
            <input id="create_scope_band" name="scope_band" type="text" class="form-control" id="">
        </div>
        <div class="col-lg-6 mb-4">
            <label>Model</label>
            <input id="create_scope_model" name="scope_model" type="text"class="form-control" id="">
        </div>
        <div class="col-lg-6 mb-4">
            <label>Serial number</label>
            <input id="create_scope_serial" type="text" name="scope_serial" class="form-control" id="">
        </div>
        <div class="col-lg-6 mb-4">
            <label>Installation date</label>
            <input id="create_scope_installdate" type="date" name="scope_installdate" class="form-control" id="">
        </div>
        <div class="col-lg-12">
            <label>RFID</label>
            <input id="create_scope_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
        </div>
        <div class="col-lg-12 mb-4">
            <label for="exampleFormControlSelect1">Department</label>
            @foreach($tb_department as $data)

            <br>

                        @if(Request::segment(2)==$data->department_id)
                        <input  id      ="create_department_scope{{$data->department_id}}"
                                type    ="checkbox"
                                name    ="department_id[]"
                                value   ="{{$data->department_id}}"
                                checked
                        >
                        @else
                        <input  id      ="create_department_scope{{$data->department_id}}"
                                type    ="checkbox"
                                name    ="department_id[]"
                                value   ="{{$data->department_id}}"
                        >
                        @endif

            <label for="create_department_scope{{$data->department_id}}">{{nbsp(3)}}{{$data->department_name}}</label>

            @endforeach
        </div>
        <div class="col-lg-12 mb-4">
            <div class="form-check">
                <input  id="create_scope_autocrop" class="form-check-input" name="scope_autocrop" type="checkbox" value="1">
                <label class="form-check-label" for="defaultCheck1">
                  Manual Crop
                </label>
            </div>
        </div>
        <div class="col-lg-3 mb-4">
            <label for="name_pass">Top</label>
            <input id="create_scope_top" type="text" name="scope_top" value="0" class="form-control bg-secondary">
        </div>
        <div class="col-lg-3 mb-4">
            <label for="name_pass">Bottom</label>
            <input id="create_scope_bottom" type="text" name="scope_bottom" value="0" class="form-control bg-secondary">
        </div>
        <div class="col-lg-3 mb-4">
            <label for="name_pass">Left</label>
            <input id="create_scope_left" type="text" name="scope_left" value="0" class="form-control bg-secondary">
        </div>
        <div class="col-lg-3 mb-4">
            <label for="name_pass">Right</label>
            <input id="create_scope_right" type="text" name="scope_right" value="0" class="form-control bg-secondary">
        </div>
        <div class="col-lg-12 mt-3 mb-4 text-right">
            <button type="submit" class="btn btn-success btn-lg">Record</button>
        </div>
        </form>
    </div>

    <div id="scope_edit" class="col-lg-6 border border-secondary" style="display: none">
        <div class="row">
            <div class="col-lg-12 mb-2">
                <h3>Scope detail</h3>
            </div>
            <div class="col-lg-12 mb-4">
                <input id="edit_scope_id" type="hidden">
                <label for="name_doctor">Name</label>
                <input id="edit_scope_name" type="text" name="scope_name" class="form-control" placeholder="Scope Name" required>
                <small id="alert_name"></small>
            </div>
            <div class="col-lg-6 mb-4">
                <label>Brand</label>
                <input id="edit_scope_band" name="scope_band" type="text" class="form-control" id="">
            </div>
            <div class="col-lg-6 mb-4">
                <label>Model</label>
                <input id="edit_scope_model" name="scope_model" type="text"class="form-control" id="">
            </div>
            <div class="col-lg-6 mb-4">
                <label>Serial number</label>
                <input id="edit_scope_serial" type="text" name="scope_serial" class="form-control" id="">
            </div>
            <div class="col-lg-6 mb-4">
                <label>Installation date</label>
                <input id="edit_scope_installdate" type="date" name="scope_installdate" class="form-control" id="">
            </div>
            <div class="col-lg-12">
                <label>RFID</label>
                <input id="edit_scope_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" />
            </div>

            <div class="col-lg-12 mb-4">
                <label for="exampleFormControlSelect1">Department</label>
                @foreach($tb_department as $data)
                <br>
                    <input  class="edit_department_scope"
                            id="edit_department_scope{{$data->department_id}}"
                            type="checkbox"
                            name="edit_checkbox_scope"
                            value="{{$data->department_id}}"
                    >
                <label for="edit_department_scope{{$data->department_id}}">
                    {{nbsp(3)}}{{$data->department_name}}
                </label>
                @endforeach
            </div>
            <div class="col-lg-12 mb-4">
                <div class="form-check">
                    <input  id="edit_scope_autocrop" class="form-check-input" name="scope_autocrop" type="checkbox" value="1">
                    <label class="form-check-label" for="defaultCheck1">
                      Manual Crop
                    </label>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <label for="name_pass">Top</label>
                <input id="edit_scope_top" type="text" name="scope_top" class="form-control bg-secondary">
            </div>
            <div class="col-lg-3 mb-4">
                <label for="name_pass">Bottom</label>
                <input id="edit_scope_bottom" type="text" name="scope_bottom" class="form-control bg-secondary">
            </div>
            <div class="col-lg-3 mb-4">
                <label for="name_pass">Left</label>
                <input id="edit_scope_left" type="text" name="scope_left" class="form-control bg-secondary">
            </div>
            <div class="col-lg-3 mb-4">
                <label for="name_pass">Right</label>
                <input id="edit_scope_right" type="text" name="scope_rigth" class="form-control bg-secondary">
            </div>
            <div class="col-lg-12 mt-3 mb-4 text-right">
                <button id="btn_scope_edit_submit" class="btn btn-warning btn-lg">Edit</button>
            </div>
        </div>
    </div>





</div>

<script>
    $('#edit_scope_name').keyup(function(){
        var scopename = $(this).val();
        $.post('{{ url('jquery') }}', {
            event               : 'check_scopename',
            scopename           : scopename
        }, function(data, status){
            if(data>=1){
                $('#edit_scope_name').css('border-color','red');
                $("#alert_name").html('Scope นี้มีในระบบแล้ว').css('color','red');
                $("#btn_scope_edit_submit").attr('disabled',true);
            }else{
                $('#edit_scope_name').css('border-color','green');
                $("#alert_name").html('Scope นี้สามารถใช้ได้').css('color','green');
                $("#btn_scope_edit_submit").attr('disabled',false);
            }
        });
    });
        $('.scope_edit').click(function(){
            $('#scope_edit').show();

            $('.scope_edit').attr('style','');
            $(this).attr('style','background-color:#c0c0c0');




        let id = $(this).attr('scope_id');
        $('#edit_scope_id').val(id);
        $.post('{{ url('department') }}', {
            event   : 'scope_show',
            id      : id,
        }, function(data, status) {
            let scope = JSON.parse(data);
            $('.edit_department_scope').prop('checked', false);
            scope.department.forEach(element =>$('#edit_department_scope'+element).prop('checked', true));
            console.log(scope);
            $('#edit_scope_name').val(scope.scope_name);
            $('#edit_scope_band').val(scope.scope_band);
            $('#edit_scope_model').val(scope.scope_model);
            $('#edit_scope_serial').val(scope.scope_serial);
            $('#edit_scope_installdate').val(scope.scope_installdate);
            $('#edit_scope_top').val(scope.scope_top);
            $('#edit_scope_bottom').val(scope.scope_bottom);
            $('#edit_scope_left').val(scope.scope_left);
            $('#edit_scope_right').val(scope.scope_right);
            $('#edit_scope_rfid').val(scope.scope_rfid);
        });
    });

    $('#btn_scope_edit_submit').click(function(){
        let department  = [];
        $('[name=edit_checkbox_scope]:checked').each(function(){department.push($(this).val());});
        $.post('{{ url('department') }}', {
            event               : 'scope_update',
            id                  : $('#edit_scope_id').val(),
            department          : JSON.stringify(department),
            scope_name          : $('#edit_scope_name').val(),
            scope_band          : $('#edit_scope_band').val(),
            scope_model         : $('#edit_scope_model').val(),
            scope_serial        : $('#edit_scope_serial').val(),
            scope_installdate   : $('#edit_scope_installdate').val(),
            scope_top           : $('#edit_scope_top').val(),
            scope_bottom        : $('#edit_scope_bottom').val(),
            scope_left          : $('#edit_scope_left').val(),
            scope_right         : $('#edit_scope_right').val(),
            scope_rfid          : $('#edit_scope_rfid').val(),

        }, function(data, status){
            window.location.reload();
        });
    });


    $('.scope_create').click(function(){
        $('#scope_edit').hide();
        $('#scope_create').show();
    });

    </script>
