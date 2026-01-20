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
        .w-20 {
            width: 20%;
        }

        .m-input {
            width: 72%;
            margin-left: 68px;
        }

        .m-input1 {
            width: 76%;
            margin-left: 21px;
        }

        .m-input2 {
            width: 77%;
            margin-left: 84px;
        }

        .bg-setting {
            /* background: #b3b3b3; */
        }

        .bg-setting:disabled {
            background: #b3b3b3;
        }
    </style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">{{ @$type }} Role </h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Role Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('content')

    @php
        if($role==null){
            $role = array();
        }
    @endphp



    <div class="card">
        <h5 class="p-3">{{ $id }}</h5>


        {{-- @dd($role) --}}

        <form action="{{ url('admin/role') }}" method="POST">

            @csrf
            <input type="hidden" name="event" value="editrole">
            <input type="hidden" name="type"  value="{{$id}}">
            <div class="row p-3">
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="CreatePatient" name="role[]" value="CreatePatient" @if (in_array("CreatePatient", $role)) checked @endif>
                        <label class="form-check-label" for="CreatePatient">
                            Create Patient
                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="CreateCase" name="role[]" value="CreateCase" @if (in_array("CreateCase", $role)) checked @endif>
                        <label class="form-check-label" for="CreateCase">
                            Create Case
                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="TakePhoto" name="role[]" value="TakePhoto"  @if (in_array("TakePhoto", $role)) checked @endif>
                        <label class="form-check-label" for="TakePhoto">
                            Take Photo
                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="MakeReport" name="role[]" value="MakeReport" @if (in_array("MakeReport", $role)) checked @endif>
                        <label class="form-check-label" for="MakeReport">
                            Make Report
                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="Sendto" name="role[]"value="Sendto" @if (in_array("Sendto", $role)) checked @endif>
                        <label class="form-check-label" for="Sendto">
                            Send to
                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="ViewerHistory" name="role[]" value="ViewerHistory" @if (in_array("ViewerHistory", $role)) checked @endif>
                        <label class="form-check-label" for="ViewerHistory">
                            Viewer History
                        </label>
                    </div>

                </div>

                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="DataAnalyze" name="role[]" value="DataAnalyze" @if (in_array("DataAnalyze", $role)) checked @endif>
                        <label class="form-check-label" for="DataAnalyze">
                            Data Analyze
                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="DataExport" name="role[]" value="DataExport" @if (in_array("DataExport", $role)) checked @endif>
                        <label class="form-check-label" for="DataExport">
                            Data Export

                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="HospitalSetting" name="role[]" value="HospitalSetting" @if (in_array("DataExport", $role)) checked @endif>
                        <label class="form-check-label" for="HospitalSetting">
                            Hospital Setting

                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="ProcedureSetting" name="role[]" value="ProcedureSetting" @if (in_array("DataExport", $role)) checked @endif>
                        <label class="form-check-label" for="ProcedureSetting">
                            Procedure Setting

                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="DepartmentSetting" name="role[]" value="DepartmentSetting" @if (in_array("DepartmentSetting", $role)) checked @endif>
                        <label class="form-check-label" for="DepartmentSetting">
                            Department Setting

                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="UserSetting" name="role[]" value="UserSetting"@if (in_array("UserSetting", $role)) checked @endif>
                        <label class="form-check-label" for="UserSetting">

                            User Setting

                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="ScopeSetting" name="role[]" value="ScopeSetting"@if (in_array("ScopeSetting", $role)) checked @endif>
                        <label class="form-check-label" for="ScopeSetting">
                            Scope Setting

                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="RoomSetting" name="role[]" value="RoomSetting" @if (in_array("RoomSetting", $role)) checked @endif>
                        <label class="form-check-label" for="RoomSetting">
                            Room Setting

                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="Treatment" name="role[]" value="Treatment" @if (in_array("Treatment", $role)) checked @endif>
                        <label class="form-check-label" for="Treatment">
                            Treatment Coverage

                        </label>
                    </div>

                </div>
                <div class="col-12">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="Logdata" name="role[]" value="Logdata" @if (in_array("Logdata", $role)) checked @endif>
                        <label class="form-check-label" for="Logdata">
                            Log Data

                        </label>
                    </div>

                </div>

            </div>
            <button style="display:none" id="warning_div" type="button" data-toast data-toast-text=""
                data-toast-gravity="bottom" data-toast-position="right" data-toast-duration="3000"
                data-toast-close="close" data-toast-className="danger" class="btn btn-light w-xs">Bottom Right</button>
            <div class="row mb-3 me-5">
                <div class="col text-end">
                    <a href="{{ url('admin/role') }}" type="button" class="btn btn-secondary" style="width: 8em;">
                        Back</a>
                    <button type="submit" id="scope_submit_btn"
                        class="btn btn-primary btn-label waves-effect right waves-light" style="width: 10em;"><i
                            class="ri-arrow-right-s-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
                </div>
            </div>
        </form>

    </div>
@endsection




@section('script')


@endsection
