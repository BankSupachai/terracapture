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
        <h3 class="">Repocess  detail</h3>
        <input type="hidden" name="user_type" value="{{$type}}">
        <div class="row">
            <div class="col-lg">
                <label for="name_repocess" class="form-label">Prefix</label>
                <input type="text" class="form-control" name="user_prefix" placeholder="Prefix" id="edit_doctor_prefix" value="{{@$data->user_prefix}}">
            </div>
            <div class="col-lg">
                <label for="name_repocess" class="form-label">Firstname</label>
                <input type="text" class="form-control"  name="user_firstname" id="edit_repocess_firstname" placeholder="First name" value="{{@$data->user_firstname}}">
            </div>
            <div class="col-lg">
                <label for="name_repocess" class="form-label">Lastname</label>
                <input type="text" class="form-control" name="user_lastname" id="edit_repocess_lastname" placeholder="Last name" value="{{@$data->user_lastname}}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label for="" class="form-label">phone</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroup-sizing-default"><i class="fas fa-phone-alt"></i> </span>
                    <input type="text" class="form-control" name="phone" aria-label="Sizing example input" value="{{@$data->phone}}" aria-describedby="inputGroup-sizing-default" placeholder="Phone" id="edit_repocess_phone">
                </div>
            </div>
            <div class="col-lg">
                <div class="form-group m-0">
                    <label style="font-size: 15px;">Color</label>
                        <div class="input-group">
                            <input id="edit_repocess_color" name="color" type="color" class="form-control p-0" value="{{@$data->color}}">
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
                <label for="exampleFormControlInput1" class="form-label">RFID</label>
                <input type="text" class="form-control" id="edit_repocess_rfid" placeholder="rfid" name="user_rfid" value="{{@$data->user_rfid}}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label for="exampleFormControlInput1" class="form-label">User Code</label>
                <input type="text" class="form-control" id="edit_repocess_user_code" placeholder="User code" name="user_code" value="{{@$data->user_code}}">
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
                    <input id="edit_repocess_username" type="text" name="email" class="form-control" value="{{@$data->email}}">
            </div>
            <div class="col-lg">
                <label for="name_pass">Password</label>
                <input id="edit_repocess_password" type="password" name="password" class="form-control">
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
                    <label class="custom-file-label" for="reprocess_customFile">Choose file</label>
                </div>
            </div>
            <div class="col-lg-6 text-end">
                @if(isset($id))
                    <button id="btn_endo_edit_submit" type="submit" class="btn btn-warning">Edit</button>
                @else
                    <button id="btn_endo_edit_submit" type="submit" class="btn btn-success">Submit</button>
                @endif
            </div>
        </div>
</div>
