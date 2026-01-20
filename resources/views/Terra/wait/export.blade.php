@extends('layouts.layout_capture')


@section('title', 'Endocapture')

@section('style')
<style>
    .btn-terralink{
        background: #264C60;
        color: white !important;
    }
    .btn-terralink:hover{
        background: #173241;
    }
    .choices__list--single{
        padding-bottom: 0 !important;
    }
    .card-search{
        height: 80vh;
    }
    .list-select{
        margin-top: 2em;
        height: 50vh;
        overflow-y: auto;
    }
    .list-select tr td:first-child{width: 2em;}
    .list-select tr td{line-height: 2em}
    .list-select tr{
        border: none !important;
    }
    .list-select tr td:first-child .btn{width: 2em;}
    @media (max-height: 960px) {
        .card-search{
            height: 78vh;
        }
    }
    @media (max-height: 850px) {
        .card-search{
            height: 76vh;
        }
    }
    @media (max-height: 785px) {
        .card-search{
            height: 74vh;
        }
    }
    @media (max-height: 720px) {
        .card-search{
            height: 72vh;
        }
    }
</style>
@endsection

@section('modal')

@endsection

@section('lpage')
EXPORT DATA
@endsection
@section('rpage')
Export
@endsection
@section('rppage')
Export
@endsection

@section('content')
@php
    $procedure   = DB::table('tb_procedure')->select('procedure_id','procedure_code','procedure_name')->get();
    $user        = DB::table('users')->select('user_type')->groupBy('user_type')->get();
@endphp
<div class="row m-0">
    <div class="col-lg-3">
        <div class="card">
            <div class="card-body card-search">
                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-light w-100"><i class=" ri-list-check-2"></i> <br> Operation Data</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-light w-100"><i class="ri-file-text-fill"></i> <br> Summary Data</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 mt-3">
                        <input type="text" name="" id="" class="form-control form-control-lg">
                    </div>
                    <div class="col-lg-12 mt-2">
                        <select class="form-control bg-light border-light" data-choices  name="choices-single-default" id="modality" onchange="function_search()">
                            <option value="0">Modality</option>
                            <option value="CR">CR</option>
                            <option value="CT">CT</option>
                            <option value="MR">MR</option>
                            <option value="US">US</option>
                            <option value="OT">OT</option>
                            <option value="BI">BI</option>
                            <option value="CD">CD</option>
                            <option value="DD">DD</option>
                            <option value="DG">DG</option>
                            <option value="ES">ES</option>
                            <option value="LS">LS</option>
                            <option value="PT">PT</option>
                            <option value="RG">RG</option>
                            <option value="ST">ST</option>
                            <option value="TG">TG</option>
                            <option value="XA">XA</option>
                            <option value="RF">RF</option>
                            <option value="RTIMAGE">RTIMAGE</option>
                            <option value="RTDOSE">RTDOSE</option>
                            <option value="RTSTRUCT">RTSTRUCT</option>
                            <option value="RTPLAN">RTPLAN</option>
                            <option value="RTRECORD">RTRECORD</option>
                            <option value="HC">HC</option>
                            <option value="DX">DX</option>
                            <option value="NM">NM</option>
                            <option value="MG">MG</option>
                            <option value="IO">IO</option>
                            <option value="PX">PX</option>
                            <option value="GM">GM</option>
                            <option value="SM">SM</option>
                            <option value="XC">XC</option>
                            <option value="PR">PR</option>
                            <option value="AU">AU</option>
                            <option value="EPS">EPS</option>
                            <option value="HD">HD</option>
                            <option value="SR">SR</option>
                            <option value="IVUS">IVUS</option>
                            <option value="OP">OP</option>
                            <option value="SMR">SMR</option>
                        </select>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <select class="form-control bg-light border-light" data-choices name="choices-single-default" id="procedure" onchange="function_search()">
                            <option value="">User type</option>
                            @foreach ($user as $u)
                            <option value="">{{$u->user_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <select class="form-control bg-light border-light procedure-select" data-choices name="choices-single-default" id="procedure" onchange="function_search()">
                            <option value="">Procedure</option>
                            @foreach ($procedure as $pcd)
                                <option class="pdc-opt" value="{{$pcd->procedure_code}}">{{$pcd->procedure_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="list-select">
                    <table class="table table-borderless"></table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card">
            <div class="card-body card-search">
                <div class="row border-bottom pb-3 cn">
                    <div class="col"><b>Operation Data</b></div>
                    <div class="col text-end">
                        <button class="btn btn-terralink">Excel (.xls)</button>
                        <button class="btn btn-terralink">CSV (.csv)</button>
                        <button class="btn btn-terralink">PDF (.pdf)</button>
                    </div>
                </div>
                <div class="table-responsive table-card p-3 mt-3">
                    <table class="table align-middle table-nowrap mb-0" id="tasksTable">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="sort" data-sort="pt_id">Patient ID</th>
                                <th class="sort" data-sort="pt_name">Name</th>
                                <th class="sort" data-sort="procedure">Procedure</th>
                                <th class="sort" data-sort="modality">Modality</th>
                                <th class="sort" data-sort="doctor">date</th>
                                <th class="sort" data-sort="time">Time</th>
                                <th class="sort" data-sort="remark">Remark</th>
                                <th class="sort" data-sort="report">Report</th>
                            </tr>
                        </thead>


                        <tbody class="list form-check-all">
                            <td colspan="8" class="bg-soft-warning text-center">ไม่พบข้อมูล</td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection






@section('script')
<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script>
    $(".procedure-select").on("change",function(){
        var col = `<tr id='tr${$(this).val()}'><td><buttun class='btn btn-danger p-1 rounded-circle' onclick="del_list('${$(this).val()}')">-</button></td><td>${$(this).text()}</td></tr>`
        $(".list-select table").append(col)
        $(this).val(null)
    })
    function del_list(code){
        $("#tr"+code).remove()
    }
    function function_search(){}
</script>
@endsection
