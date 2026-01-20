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
    .bg-secondary{
        background: #E4E6EF !important
    }
</style>

<div class="card">
    <div class="cardbody">
        <h3 class="">Scope detail</h3>
        <input type="hidden" name="user_type" value="{{$type}}">
        <div class="row">
            <div class="col-lg-12">
                <input id="edit_scope_id" type="hidden">
                <label for="name_doctor">Name</label>
                <input id="edit_scope_name" type="text" name="scope_name" class="form-control" placeholder="Scope Name" required value="{{@$data->scope_name}}">
                <small id="alert_name"></small>
            </div>
            <div class="col-lg">
                <label>Brand</label>
                <input id="edit_scope_band" name="scope_band" type="text" class="form-control" id="" value="{{@$data->scope_band}}">
            </div>
            <div class="col-lg">
                <label>Model</label>
                <input id="edit_scope_model" name="scope_model" type="text"class="form-control" id="" value="{{@$data->scope_model}}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label>Serial number</label>
                <div class="input-group">
                <input id="edit_scope_serial" type="text" name="scope_serial" class="form-control" id="" value="{{@$data->scope_serial}}">
                </div>
            </div>
            <div class="col-lg">
                <div class="form-group m-0">
                    <label>Installation date</label>
                <input id="edit_scope_installdate" type="date" name="scope_installdate" class="form-control" id=""  value="{{@$data->scope_installdate}}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label for="exampleFormControlInput1" class="form-label">RFID</label>
                <input id="edit_scope_rfid" type="text" name="scope_rfid" class="form-control" placeholder="rfid" value="{{@$data->scope_rfid}}"/>
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label for="exampleFormControlInput1" class="form-label">Department</label>
                @foreach ($department_all as $dpma)
                @if(isset($id))
                    @php
                        $check = array_search("$id",json_decode($dpma->department_scope));
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
            <div class="col-lg-12 mt-4">
                <div class="form-check">
                    <input  id="edit_scope_autocrop" class="form-check-input" name="scope_autocrop" type="checkbox" value="1">
                    <label class="form-check-label" for="defaultCheck">
                      Manual Crop
                    </label>
                </div>
            </div>
            <div class="col-lg-3 mb-4">
                <label for="name_pass">Top</label>
                <input id="edit_scope_top" type="text" name="scope_top" class="form-control bg-secondary" value="{{@$data->scope_top}}">
            </div>
            <div class="col-lg-3 mb-4">
                <label for="name_pass">Bottom</label>
                <input id="edit_scope_bottom" type="text" name="scope_bottom" class="form-control bg-secondary" value="{{@$data->scope_bottom}}">
            </div>
            <div class="col-lg-3 mb-4">
                <label for="name_pass">Left</label>
                <input id="edit_scope_left" type="text" name="scope_left" class="form-control bg-secondary" value="{{@$data->scope_left}}">
            </div>
            <div class="col-lg-3 mb-4">
                <label for="name_pass">Right</label>
                <input id="edit_scope_right" type="text" name="scope_rigth" class="form-control bg-secondary" value="{{@$data->scope_rigth}}">
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
</div>
