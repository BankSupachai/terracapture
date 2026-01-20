@extends('layouts.layouts_index.main')
{{-- @extends('layouts.appindex') --}}

@section('title', 'User')
@section('content')
<div class="row m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url('admin/procedure')}}" method="POST">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-12 mb-4">
                            <h1>
                                Add Procedure
                            </h1>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="Procedure_name">Procedure Name</label>
                                <input type="text" name="procedure_name" class="form-control" id="Procedure_name" aria-describedby="Procedure_name" placeholder="Enter Procedure Name" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="procedure_color">Procedure Color</label>
                                <input type="color" name="procedure_color" class="form-control p-0" id="procedure_color" aria-describedby="procedure_color" value="#ffffff">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>IMAGE</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile"/>
                                    <label class="custom-file-label" for="customFile" name="file" accept="png">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                      <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('public/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<script>

</script>
@endsection
