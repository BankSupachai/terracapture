<link rel="stylesheet" href="{{url("public/css/admin/department.css")}}">
<div class="row m-0">
    <div class="col-lg-6">
        <div class="row" style="align-items: center;">
            <div class="col-3">Procedure list </div>
            <div class="col-6">
                <div class="input-icon input-icon-right">
                    <input id="edit_procedure_code" type="hidden">
                    <input type="text" class="form-control form-control-sm" id="doctor_search" placeholder="Search..."/>
                    <span><i class="flaticon2-search-1 icon-md"></i></span>
                </div>
            </div>
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
                        @foreach($tb_procedure as $data)
                        <tr class="procedure_edit" procedure_code="{{$data->procedure_code}}">
                            <td>{{$data->procedure_name}}</td>
                            @if(checkNULL($data->procedure_color))
                                <td><div class="box_color" style="background-color:{{$data->procedure_color}};"></div></td>
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


    <div class="col-lg-6 border border-secondary">
        <form action="{{url('department/1/edit')}}" method="POST">
            @method('GET')
            @csrf
            <input type="hidden" name="id_procedure" id="id_procedure">
            <div class="row mt-6">
                <div class="col-lg-12 mb-2">
                    <h3>Procedure detail</h3>
                </div>
                <div class="col-lg-12 mb-4">
                    <label for="name_doctor">Procedure Name</label>
                    <input id="edit_procedure_name" type="text" class="form-control"  placeholder="Procedure" disabled>
                </div>
                <div class="col-lg-12 mb-4">
                    <div class="form-group m-0">
                        <label>Color</label>
                        <div class="input-group">
                            <input id="edit_procedure_color" name="edit_procedure_color" type="color" class="form-control p-0" placeholder="Recipient's username" aria-describedby="basic-addon2"/>
                            <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4">
                    <label for="exampleFormControlSelect1">Department</label>

                    @foreach($tb_department as $data)
                        <br>

                            <input  class="edit_department_procedure"
                                    id="edit_department_procedure{{$data->department_id}}"
                                    type="checkbox"
                                    name="edit_checkbox_procedure[]"
                                    value="{{$data->department_id}}"
                                    @php
                                        $json = json_decode($data->department_procedure);
                                    @endphp
                                    {{-- @dd($json); --}}
                                    @for($m=0;$m<count($json);$m++)
                                        @if($data->department_id == $json[$m])
                                            checked
                                        @endif
                                    @endfor
                            >
                        <label for="edit_department_procedure{{$data->department_id}}">
                            {{nbsp(3)}}{{$data->department_name}}
                        </label>
                    @endforeach
                </div>
                <div class="col-lg-12 mb-4">
                    <img src="" alt="" srcset="" id="img_procedure" class="img-thumbnail">
                </div>
                <div class="col-lg-12 mb-4">
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Upload Procedure</label>
                        <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                    </div>
                </div>

                <div class="col-lg-12 mt-3 mb-4 text-right">
                    <button type="submit" class="btn btn-warning btn-lg">Edit</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script>
    $('.procedure_edit').click(function(){

        $('.procedure_edit').attr('style','');
        $(this).attr('style','background-color:#c0c0c0');
        var part = "{{url('public/images')}}";
        let id = $(this).attr('procedure_code');
        $('#edit_procedure_code').val(id);
        $.post('{{ url('department') }}', {
            event   : 'procedure_show',
            id      : id,
        }, function(data, status) {
            let procedure = JSON.parse(data);
            console.log(procedure);
            $('.edit_department_procedure').prop('checked', false);
            procedure.department.forEach(element =>$('#edit_department_procedure'+element).prop('checked', true));
            $('#id_procedure').val(procedure.procedure_code);
            $('#edit_procedure_name').val(procedure.procedure_name);
            $('#img_procedure').attr('src',part+'/'+procedure.procedure_pic);
            $('#edit_procedure_color').val(procedure.procedure_color);
        });
    });

    $('#btn_procedure_edit_submit').click(function(){
        let department  = [];
        $('[name=edit_checkbox_procedure]:checked').each(function(){department.push($(this).val());});
        $.post('{{ url('department') }}', {
            event       : 'procedure_update',
            id          : $('#edit_procedure_code').val(),
            department  : JSON.stringify(department),
            color       : $('#edit_procedure_color').val(),
        }, function(data, status){});
    });

</script>
