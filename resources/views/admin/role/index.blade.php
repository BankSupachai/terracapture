@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
    <style>
        .table-w tr td:nth-child(1) {
            width: 20%;
        }

        .table-w tr td:nth-child(2) {
            width: 15%;
        }

        .table-w tr td:nth-child(3) {
            width: 20%;
        }

        .table-w tr td:nth-child(4) {
            width: 15%;
        }

        .table-w tr td:nth-child(5) {
            width: 10%;
        }

        .table-w tr td:nth-child(6) {
            width: 10%;
        }

        ::-webkit-scrollbar {
            width: 3px !important;
            height: 3px !important;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1 !important;
        }

        ::-webkit-scrollbar-thumb {
            background: #888 !important;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555 !important;
        }
    </style>


@endsection
@section('title-left')
    <h4 class="mb-sm-0">USER SETTING</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">User Setting</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('modal')
    <div id="modal_Userdownload" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Import List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('importexcel') }}" method="POST" enctype="multipart/form-data" class="w-100">
                        @method('POST')
                        @csrf
                        {{-- <div class='file-input w-100'>
                        <input type='file' name="fileicd10">
                        <span class='button'>ICD-10 Excel</span>
                        <span class='label' data-js-label>No file selected</label>
                    </div> --}}
                        <div class="dropzone">
                            <div class="fallback">
                                <input type="file" name="fileuser"
                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                </div>

                                <h4>Drop files here or click to upload.</h4>
                            </div>
                        </div>
                        {{-- <button class="btn btn-primary rounded-0" name="icd10" value="1"  type="submit">Start Import</button> --}}

                </div>
                <div class="modal-footer">
                    <div class="col-12 d-flex justify-content-between">
                        {{-- <button type="button" class="btn btn-warning " data-bs-dismiss="modal">Download template </button> --}}
                        <a href="{{ url('public/user/user.xlsx') }}" class="btn btn-warning">Download template</a>
                        <button name="user" type="submit" value="1" class="btn btn-primary">Confirm </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row m-3">
                @if (Session::has('status'))
                    @if (Session::get('status') == 'success')
                        <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                            ทำการดึงข้อมูลจาก server เสร็จสิ้น
                            <button type="button" id="alert_btn" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @else
                        <div class="col-12 alert alert-danger alert-dismissible fade show" role="alert">
                            เกิดข้อผิดพลาด กรุณาตรวจสอบอีกครั้ง
                            <button type="button" id="alert_btn" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
    </div>
    <div class="card">
        <div style="overflow-y: scroll; max-height: 590px;">
            <div class="table-responsive table-card table-w m-1">

                <table class="table table-nowrap mb-0" id="table-search">
                    <thead class="table-light">
                        <tr>
                            <th width="95%">Name</th>
                            <th  >Edit</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Admin</td>
                            <td><a href="{{ url('admin/role/admin/edit') }}" class="btn btn-soft-primary">Edit</a></td>
                        </tr>
                        <tr>
                            <td>doctor</td>
                            <td><a href="{{ url('admin/role/doctor/edit') }}" class="btn btn-soft-primary">Edit</a></td>
                        </tr>


                        <tr>
                            <td>anesthesia</td>
                            <td><a href="{{ url('admin/role/anesthesia/edit') }}" class="btn btn-soft-primary">Edit</a></td>
                        </tr>
                        <tr>
                            <td>endo</td>
                            <td><a href="{{ url('admin/role/endo/edit') }}" class="btn btn-soft-primary">Edit</a></td>
                        </tr>
                        <tr>
                            <td>nurse</td>
                            <td><a href="{{ url('admin/role/nurse/edit') }}" class="btn btn-soft-primary">Edit</a></td>
                        </tr>
                        <tr>
                            <td>nurse_anas</td>
                            <td><a href="{{ url('admin/role/nurse_anas/edit') }}" class="btn btn-soft-primary">Edit</a></td>
                        </tr>

                        <tr>
                            <td>register</td>
                            <td><a href="{{ url('admin/role/register/edit') }}" class="btn btn-soft-primary">Edit</a></td>
                        </tr>





                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection




@section('script')


@endsection
