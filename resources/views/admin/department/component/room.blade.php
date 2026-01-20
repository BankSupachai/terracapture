<link rel="stylesheet" href="{{url("public/css/admin/department.css")}}">
<div class="row m-0">
    <div class="col-lg-6">
        <div class="row" style="align-items: center;">
            <div class="col-3">Room list</div>
            <div class="col-6">
                <div class="input-icon input-icon-right">
                    <input type="text" class="form-control form-control-sm" id="room_search" placeholder="Search..."/>
                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                </div>
            </div>
            <div class="col-3 text-left room_create"><button class="btn btn-primary">+ Add</button></div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th colspan="2">Color</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($tb_room as $data)
                        <tr class="room_edit" room_id="{{$data->room_id}}">
                            <td>{{$data->room_name}}</td>
                            @if(checkNULL($data->room_color))
                                <td><div class="box_color" style="background-color:{{$data->room_color}};"></div></td>
                            @else
                                <td><div class="box_color" style="background-color: white;"></div></td>
                            @endif
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


    <div id="room_create" class="col-lg-6 border border-secondary" style="display: none">
        <form action="{{url('department')}}" method="POST" class="row mt-6">
            @csrf
            <input type="hidden" name="event" value="room_add">
            <input type="hidden" name="type" value="room">
            <div class="col-lg-12 mb-2">
                <h3>Room detail</h3>
            </div>
            <div class="col-lg-12 mb-4">
                <input id="edit_room_id" type="hidden">
                <label for="name_room">Name</label>
                <input type="text" class="form-control" name="room_name" placeholder="Room Name">
                <small id="alert_room"></small>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="form-group m-0">
                    <label>Color</label>
                    <div class="input-group">
                        <input type="color" name="room_color" class="form-control p-0" aria-describedby="basic-addon2"/>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4">
                <label for="exampleFormControlSelect1">Department</label>
                @foreach($tb_department as $data)

                <br>

                            @if(Request::segment(2)==$data->department_id)
                            <input  id      ="create_department_room{{$data->department_id}}"
                                    type    ="checkbox"
                                    name    ="department_id[]"
                                    value   ="{{$data->department_id}}"
                                    checked
                            >
                            @else
                            <input  id      ="create_department_room{{$data->department_id}}"
                                    type    ="checkbox"
                                    name    ="department_id[]"
                                    value   ="{{$data->department_id}}"
                            >
                            @endif

                <label for="create_department_room{{$data->department_id}}">{{nbsp(3)}}{{$data->department_name}}</label>

                @endforeach
            </div>
            <div class="col-lg-12 mt-3 mb-4 text-right">
                <button type="submit" class="btn btn-success btn-lg">Record</button>
            </div>
        </form>
    </div>






    <div id="room_edit" class="col-lg-6 border border-secondary" style="display: none">

            <div class="col-lg-12 mb-2">
                <h3>Room detail</h3>
            </div>
            <div class="col-lg-12 mb-4">
                <input id="edit_room_id" type="hidden">
                <label for="name_room">Name</label>
                <input type="text" class="form-control" name="room_name" id="edit_room_name" placeholder="Room Name">
                <small id="alert_room"></small>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="form-group m-0">
                    <label>Color</label>
                    <div class="input-group">
                        <input id="edit_room_color" type="color" name="room_color" class="form-control p-0" aria-describedby="basic-addon2"/>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4">
                <label for="exampleFormControlSelect1">Department</label>
                @foreach($tb_department as $data)
                <br>
                    <input  class="edit_department_room"
                            id="edit_department_room{{$data->department_id}}"
                            type="checkbox"
                            name="edit_checkbox_room"
                            value="{{$data->department_id}}"
                    >
                <label for="edit_department_room{{$data->department_id}}">
                    {{nbsp(3)}}{{$data->department_name}}
                </label>
                @endforeach
            </div>
            <div class="col-lg-12 mt-3 mb-4 text-right">
                <button id="btn_room_edit_submit" class="btn btn-warning btn-lg">Edit</button>
            </div>
    </div>
</div>


<script>
    $('#edit_room_name').keyup(function(){
        var roomname = $(this).val();
        $.post('{{ url('jquery') }}', {
            event               : 'check_roomname',
            roomname            : roomname
        }, function(data, status){
            if(data>=1){
                $('#edit_room_name').css('border-color','red');
                $("#alert_room").html('Room นี้มีในระบบแล้ว').css('color','red');
                $("#btn_room_edit_submit").attr('disabled',true);
            }else{
                $('#edit_room_name').css('border-color','green');
                $("#alert_room").html('Room นี้สามารถใช้ได้').css('color','green');
                $("#btn_room_edit_submit").attr('disabled',false);
            }
        });
    });

    $('.room_edit').click(function(){
        $('#room_edit').show();
        $('#room_create').hide();

        $('.room_edit').attr('style','');
        $(this).attr('style','background-color:#c0c0c0');

        let id = $(this).attr('room_id');
        $('#edit_room_id').val(id);
        $.post('{{ url('department') }}', {
            event   : 'room_show',
            id      : id,
        }, function(data, status) {
            console.log(data);
            let room = JSON.parse(data);
            $('.edit_department_room').prop('checked', false);
            room.department.forEach(element =>$('#edit_department_room'+element).prop('checked', true));
            $('#edit_room_name').val(room.room_name);
            $('#edit_room_color').val(room.room_color);
        });
    });

    $('#btn_room_edit_submit').click(function(){
        if($(this).attr('disabled')==false){
            let department  = [];
            $('[name=edit_checkbox_room]:checked').each(function(){department.push($(this).val());});
            $.post('{{ url('department') }}', {
                event       : 'room_update',
                id          : $('#edit_room_id').val(),
                name        : $('#edit_room_name').val(),
                department  : JSON.stringify(department),
                color       : $('#edit_room_color').val(),
            }, function(data, status){
                window.location.reload();
            });
        }else{
            window.location.reload();
        }

    });

    $('.room_create').click(function(){
        $('#room_edit').hide();
        $('#room_create').show();
    });

</script>
