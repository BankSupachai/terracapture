
@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    /* .table-w tr td:nth-child(1){width: 20%;}
    .table-w tr td:nth-child(2){width: 15%;}
    .table-w tr td:nth-child(3){width: 20%;}
    .table-w tr td:nth-child(4){width: 15%;}
    .table-w tr td:nth-child(5){width: 10%;}
    .table-w tr td:nth-child(6){width: 10%;} */
    .w-20
    {
        width: 20%;
    }
    .m-input
    {
        width: 72%;
        margin-left: 68px;
    }
</style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">{{@$type}} DEPARTMENT  </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Department Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')

<form action="{{url("admin/department")}}" method="post" id="department_setting_form">
    @csrf
    <input type="hidden" name="event" value="department_create">
    <input type="hidden" name="type" value="{{@$type}}">
    @if($type == 'EDIT')
        <input type="hidden" name="department_id" value="{{@$department['$department_id']}}">
    @endif
    <div class="card">
        <h5 class="p-3">DEPARTMENT</h5>
        <div class="row ">
            <div class="col-4 d-flex align-items-center ms-5">
                <label for="department_name" class="form-label">Name</label>
                <input type="text" class="form-control bg-light m-input" id="department_name" name="department_name" value="{{@$department['department_name']}}" required>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col d-flex align-items-center ms-5">
                <label for="basicInput" class="form-label text-nowrap">Status</label>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input ms-1" type="radio" name="department_status" value="active" id="radio_active" required>
                    <label class="form-check-label ms-3" for="radio_active">
                        Active
                    </label>
                </div>
                <div class="form-check mb-2 ms-5">
                    <input class="form-check-input" type="radio" name="department_status" value="inactive" id="radio_inactive">
                    <label class="form-check-label ms-3" for="radio_inactive">
                        Inactive
                    </label>
                </div>
            </div>
        </div>
        <button style="display:none" id="warning_div" type="button" data-toast data-toast-text="" data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000" data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs">Bottom Right</button>
        <div class="row mb-3 me-5">
            <div class="col text-end">
                <a href="{{url("admin/department")}}" type="button" class="btn btn-secondary" style="width: 8em;"> Back</a>
                <button id="department_submit_btn" type="button" class="btn btn-primary btn-label waves-effect right waves-light" style="width: 10em;"><i class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
            </div>
        </div>
    </div>
</form>


@endsection




@section('script')
<script>
    var submit_status = true
    $("#department_submit_btn").click(function(){
        var name      = $("#department_name").val();
        var status    = $('input[name="department_status"]:checked').val();
        var missing_data    = []

        if(name ==""){
            missing_data.push('Name')
        }

        if(status == undefined || status == ""){
            missing_data.push('Status')
        }

        let warning_txt = 'กรุณาตรวจสอบข้อมูลในช่อง '
        missing_data.forEach((e, i) => {
            if(i == 0){
                warning_txt += e
            }
        })

        if(name != ""  && (status != undefined && status != "")){
            if(submit_status == true){
                $('#department_setting_form').submit()
                submit_status = false
            }
        } else {
            $('#warning_div').attr('data-toast-text', warning_txt)
            $('#warning_div').click()
        }

    });
</script>

@endsection
