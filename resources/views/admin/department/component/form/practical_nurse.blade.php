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
        <h3>Practical nurse detail</h3>
        <input type="hidden" name="user_type" value="{{$type}}">
        <div class="row">
            <div class="col-lg">
                <label for="name_register">Prefix</label>
                <input id="edit_register_id" type="hidden">
                <input id="edit_register_prefix" type="text" class="form-control"  placeholder="prefix" name="user_prefix" required value="{{@$data->user_prefix}}">
            </div>
            <div class="col-lg">
                <label for="name_register">Firstname</label>
                <input type="text" class="form-control" id="edit_register_firstname" placeholder="first name" name="user_firstname" required value="{{@$data->user_firstname}}">
            </div>
            <div class="col-lg">
                <label for="name_register">Lastname</label>
                <input type="text" class="form-control" id="edit_register_lastname" placeholder="last name" name="user_lastname" required value="{{@$data->user_lastname}}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label>Phone</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                    <input id="edit_register_phone" type="text" class="form-control" placeholder="Phone" name="phone" value="{{@$data->phone}}"/>
                </div>
            </div>
            <div class="col-lg">
                <div class="form-group m-0">
                    <label>Color</label>
                    <div class="input-group">
                        <input id="edit_register_color" type="color" name="color" class="form-control p-0" value="{{@$data->color}}"/>
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
                <label>RFID</label>
                <input id="edit_register_rfid" type="text" name="user_rfid" class="form-control" placeholder="rfid" value="{{@$data->user_rfid}}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label>User Code</label>
                <input id="edit_register_user_code" type="text" name="user_code" class="form-control" placeholder="user code" value="{{@$data->user_code}}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label for="exampleFormControlInput1" class="form-label">Department</label>
                @foreach ($department_all as $dpma)
                @if(isset($id))
                    @php
                        $check = array_search("$id",json_decode($dpma->department_user));
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
        <div class="row">
            <div class="col-lg">
                <label for="name_user">Username</label>
                    <input id="edit_register_username" type="text" name="email" class="form-control" value="{{@$data->email}}">
            </div>
            <div class="col-lg">
                <label for="name_pass">Password</label>
                <input id="edit_register_password" type="password" name="password" class="form-control">
            </div>
        </div>
        <div class="row mt-5 mb-5">
            <div class="col"></div>
            <div class="col text-center"><img src="{{$image}}" class="img-fluid" id="blah"></div>
            <div class="col"></div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="rfid_file" id="imgInp" accept="image/*"/>
                    <label class="custom-file-label" for="register_customFile">Choose file</label>
                </div>
            </div>
            <div class="col-lg-6 mt-3 mb-4 text-end">
                @if(isset($id))
                    <button id="btn_endo_edit_submit" type="submit" class="btn btn-warning">Edit</button>
                @else
                    <button id="btn_endo_edit_submit" type="submit" class="btn btn-success">Submit</button>
                @endif
            </div>
        </div>
    </div>
</div>
