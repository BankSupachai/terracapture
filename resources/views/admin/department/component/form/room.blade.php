<style>
    .card
    {

        padding: 30px;
    }
    .row{
        margin: 0;
    }
    .form-check{
        padding-top: 5px;
    }
    .form-label{
        font-size: 15px;
    }
</style>

<div class="card">
    <div class="cardbody">
        <h3 class="">Room Detail </h3>
        <input type="hidden" name="user_type" value="{{$type}}">
        <div class="row">
            <div class="col-lg">
                <label for="name_room" class="form-label">Name</label>
                <input type="text" class="form-control" name="room_name" placeholder="Room Name" id="edit_room_name" value="{{@$data->room_name}}">
                <small id="alert_room"></small>
            </div>

        </div>
        <div class="row">
            <div class="col-lg">
                <div class="form-group m-0">
                    <label class="form-label">Color</label>
                    <div class="input-group">
                        <input type="color" name="room_color" class="form-control p-0" aria-describedby="basic-addon2" value="{{@$data->color}}"/>
                        <div class="input-group-append">
                            <span class="input-group-text">
                            <i class="fas fa-palette"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg">
                <label for="exampleFormControlInput1" class="form-label">Department</label>
                @foreach ($department_all as $dpma)
                @if(isset($id))
                    @php
                        $check = array_search("$id",json_decode($dpma->department_room));
                    @endphp
                @endif
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="edit_department_endo{{$dpma->department_id}}" name="department[{{$dpma->department_id}}]"
                    @if($_GET['department'] == $dpma->department_id || @$check!=null) checked @endif>
                    <label class="form-check-label" for="edit_department_endo{{$dpma->department_id}}">
                        {{$dpma->department_name}}
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-12 mt-3 mb-4 text-end">
            @if(isset($id))
                <button id="btn_endo_edit_submit" type="submit" class="btn btn-warning">Edit</button>
            @else
                <button id="btn_endo_edit_submit" type="submit" class="btn btn-success">Submit</button>
            @endif
        </div>
    </div>
</div>
