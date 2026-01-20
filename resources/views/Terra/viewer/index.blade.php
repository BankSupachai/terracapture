@extends('layouts.layout_capture')


@section('title', 'Endocapture - Viewer')

@section('style')
<style>
    .bg-white td{
        background: white !important;
    }
</style>

@endsection

@section('modal')

@endsection

@section('lpage')
Viewer
@endsection
@section('rpage')
Report
@endsection
@section('rppage')
Report
@endsection


@section('content')
<div class="row m-0">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row m-0">
                    <div class="col px-0"><input type="text" name="" class="form-control form-control-sm"></div>
                    <div class="col-auto px-0"><button class="btn btn-primary btn-sm"><i class="ri-list-check"></i> Filters</button></div>
                </div>
                <div class="row m-0 mt-3">
                    <div class="col-4 px-0">Patient ID :</div>
                    <div class="col px-0"><b>1243534</b></div>
                </div>
                <div class="row m-0 mt-1">
                    <div class="col-4 px-0">Name :</div>
                    <div class="col px-0"><b>Suratchanut Chitrat</b></div>
                </div>
                <div class="row m-0 mt-1">
                    <div class="col-4 px-0">Gender :</div>
                    <div class="col px-0"><b>Male</b></div>
                </div>
                <div class="row m-0 mt-1">
                    <div class="col-4 px-0">Age :</div>
                    <div class="col px-0">29</div>
                </div>
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="sort" data-sort="modality">Modality</th>
                                <th class="sort" data-sort="operation">Operation</th>
                                <th class="sort" data-sort="date">Date</th>
                                <th class="sort" data-sort="viewer">Viewer</th>
                            </tr>
                            <tr class="bg-white">
                                <td>Es</td>
                                <td>Colonoscopy</td>
                                <td>02 Oct, 2022</td>
                                <td class="text-center"><a href="{{url('viewer')}}/{{rand(1,99)}}" class="btn btn-success btn-icon waves-effect btn-sm"><i class="mdi mdi-view-carousel"></i></a></td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <img src="{{url("public/images/Screen Shot 2565-05-30 at 12.14.21.png")}}" class="w-100">
    </div>
</div>
@endsection









@section('script')

@endsection
