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
        <h3 class="">Procedure detail </h3>
        <input type="hidden" name="user_type" value="{{$type}}">
        <div class="row">
            <div class="col-lg">
                <label for="procedure_code" class="form-label">Procedure Code</label>
                <input id="procedure_code" name="procedure_code" type="text" class="form-control"  placeholder="Procedure Code" required value="{{@$data->procedure_code}}">
            </div>

        </div>
        <div class="row">
            <div class="col-lg">
                <label for="procedure_name" class="form-label">Procedure Name</label>
                <input id="procedure_name" name="procedure_name" type="text" class="form-control"  placeholder="Procedure" required value="{{@$data->procedure_name}}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label for="procedure_findding" class="form-label">Procedure Finding</label>
                <input id="procedure_findding" name="procedure_findding" type="text" class="form-control"  placeholder="Procedure" required value="{{@$data->procedure_findding}}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <label for="procedure_scope" class="form-label">Procedure Scope</label>
                <input id="procedure_scope" name="procedure_scope" type="text" class="form-control"  placeholder="Procedure" required value="{{@$data->procedure_scope}}">
            </div>
        </div>
        <div class="row">
            <div class="col-lg">
                <div class="form-group m-0">
                    <label class="form-label">Color</label>
                    <div class="input-group">
                        <input id="edit_procedure_color" name="procedure_color" type="color" class="form-control p-0" value="{{@$data->procedure_color}}"/>
                        <div class="input-group-append"><span class="input-group-text"><i class="fas fa-palette"></i></span></div>
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
                        $check = array_search("$id",json_decode($dpma->department_procedure));
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
        <div class="row mt-5 mb-5">
            <div class="col"></div>
            <div class="col text-center"><img src="{{$image}}" class="img-fluid" id="blah"></div>
            <div class="col"></div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-6">
                <label for="" class="form-label">Upload Procedure</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="rfid_file" id="imgInp" accept="image/*"/>
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
</div>
