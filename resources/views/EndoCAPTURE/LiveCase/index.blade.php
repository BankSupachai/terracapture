@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
@section('style')
<style>
    input , select{
        border: 0px !important;
        --vz-input-bg: #f3f6f9;


    }
    table tr{
        vertical-align: middle;
    }
</style>
@endsection

@section('modal')
@include('EndoCAPTURE.LiveCase.modalLiveCase')
@endsection


@section('title-left')
    <h4 class="mb-sm-0">LIVE CASE</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Operation</a></li>
        <li class="breadcrumb-item active">Cases list</li>
    </ol>
@endsection
@section('content')
<div class="card mb-0">
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <input type="text" class="form-control bg-light" placeholder="Description">
            </div>
            <div class="col-2">
                <select class="form-select mb-3 " aria-label="Default select example">
                    <option selected>Physician</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-2">
                <select class="form-select mb-3 " aria-label="Default select example">
                    <option selected>Procedure</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>

    </div>
</div>

    <table class="table table-nowrap" style="background: #ffffff;">
        <thead class="bg-light">
            <tr>
                <td scope="col">Start Time</td>
                <td scope="col">Physician</td>
                <td scope="col">Procedure</td>
                <td scope="col">Description</td>
                <td scope="col">Live Status</td>
                <td scope="col">Action</td>

            </tr>
        </thead>

        <tbody>
            <tr>
                <td scope="row">09:00</a></td>
                <td>Suratchanut Chitrat (235235)</td>
                <td>EGD</td>
                <td>Performing new technique ESD with needle knife </td>
                <td><span class="badge rounded-pill badge-soft-success fw-normal">Public</span> </td>

                <td>
                    <button data-bs-toggle="modal" data-bs-target="#LiveCase_modal" class="btn btn-danger btn-icon">
                        <i class="ri-live-fill"></i></button>
                </td>
            </tr>

            <tr>
                <td scope="row">09:00</a></td>
                <td>Suratchanut Chitrat (235235)</td>
                <td>EGD</td>
                <td>Performing new technique ESD with needle knife </td>
                <td><span class="badge rounded-pill badge-soft-success fw-normal">Public</span> </td>

                <td>
                    <button data-bs-toggle="modal" data-bs-target="#LiveCase_modal" class="btn btn-danger btn-icon">
                        <i class="ri-live-fill"></i></button>
                </td>
            </tr>

            <tr>
                <td scope="row">09:00</a></td>
                <td>Suratchanut Chitrat (235235)</td>
                <td>EGD</td>
                <td>Performing new technique ESD with needle knife </td>
                <td><span class="badge rounded-pill badge-soft-dark fw-normal">Private</span> </td>

                <td>
                    <button data-bs-toggle="modal" data-bs-target="#LiveCase_modal" class="btn btn-danger btn-icon">
                        <i class="ri-live-fill"></i></button>
                </td>
            </tr>
            <tr>
                <td scope="row">09:00</a></td>
                <td>Suratchanut Chitrat (235235)</td>
                <td>EGD</td>
                <td>Performing new technique ESD with needle knife </td>
                <td><span class="badge rounded-pill badge-soft-dark fw-normal">Private</span> </td>

                <td>
                    <button data-bs-toggle="modal" data-bs-target="#LiveCase_modal" class="btn btn-danger btn-icon">
                        <i class="ri-live-fill"></i></button>
                </td>
            </tr>
        </tbody>
    </table>


@endsection


@section('scrpit')
<script>
     $(window).on('load', function() {
        $('#LiveCase_modal').modal('show');
    });
</script>
@endsection

