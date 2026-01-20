<div class="row">
    @foreach($casetoday as $data)
        <div class="col-8">
            <h4><b>{{$data->procedure_name}}</b></h4>
        </div>

        <div class="col-4" style="display: flex; justify-content: flex-end">
            <a href="{{url("loadpic/$data->case_id")}}" type="button" class="btn btn-warning">Edit Report</a>
        </div>
        <div class="col-12">
            <hr>
        </div>
    @endforeach
</div>
