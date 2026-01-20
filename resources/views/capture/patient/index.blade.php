{{-- @extends('layouts.app') --}}
{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')

@section('title', 'EndoINDEX')
@section('style')
<link href="{{url("public/css/patient/index.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('modal')

<div id="modal_Userdownload" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Import List</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('screening')}}"  method="POST" enctype="multipart/form-data" class="w-100">
                    @method('POST')
                    @csrf
                    <input type="hidden" name="event" value="patient_import">
                    {{-- <div class='file-input w-100'>
                        <input type='file' name="fileicd10">
                        <span class='button'>ICD-10 Excel</span>
                        <span class='label' data-js-label>No file selected</label>
                    </div> --}}
                    <div class="dropzone">
                        <div class="fallback">
                            <input type="file" name="fileuser" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
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
                    <a href="{{url("public/user/user.xlsx")}}" class="btn btn-warning">Download template</a>
                    <button name="user" type="submit" value="1" class="btn btn-primary">Confirm </button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>



    @endsection
@section('content')



<div class="clearfix"></div>

<div class="row" style="margin: 0;">
	<div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <form action="" method="get">
                    <div class="row">
                        <div class="col-lg-2 pdx">
                            {{Html::link('patient/create','Add new patient ',['class'=>'btn btn-secondary btn-rounded waves-light waves-effect w-md w100']) }}
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-2 pdx">
                            <input type="search" name="search" class="form-control" style="width:100%" placeholder="ค้นหาผู้ป่วย">
                        </div>
                        <div class="col-lg-2 pdx">
                            <span class="form-group-btn" >
                                <button type="submit" class="btn btn-success" style="width:100%"><i class="flaticon2-search-1 icon-md"></i>Search</button>
                            </span>
                        </div>
                        <div class="col-lg-2">
                            <a data-container="body" data-bs-toggle="modal" data-bs-target="#modal_Userdownload"  data-toggle="popover" data-placement="top" data-content="Create New Case" href="patient/create" class="btn btn-danger btn-label h5 text-white">
                                <i class="ri-download-2-line label-icon align-middle fs-16 me-2"></i>
                                &nbsp;Import List
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin: 0;margin-top: 1em;">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="table-rep-plugin table-responsive">
                    <table id="tech-companies-1" class="table table-hover" data-add-focus-btn="">
                        <thead>
                        <tr>
                            <th>HN</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th width="90" class="text-center">Select</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $m = 1;
                                $newset = "";
                            @endphp
                            @forelse($patient as $l)

                                @php
                                    if($newset != $l->hn){
                                        $newset = $l->hn;
                                        $m=1;
                                    }else{
                                        $m++;
                                    }
                                    $count_case = DB::table('tb_case')->where('case_hn',$l->hn)->count();
                                @endphp

                            @if($m==1)
                            <tr>
                                <td>{{ $l->hn }}</td>
                                <td>{{ $l->firstname }} {{ @$l->middlename }} {{ $l->lastname }}</td>
                            @php
                                $datetime1 = date_create($l->birthdate);
                                $datetime2 = date_create(date('Y-m-d'));

                                $interval = date_diff($datetime1, $datetime2);

                                $age = $interval->format('%y');
                                if($age>150){
                                    $datetime1 = date_create($l->birthdate);
                                    $year = date('Y')+543;
                                    $datetime2 = date_create(date("$year-m-d"));

                                $interval = date_diff($datetime1, $datetime2);

                                $age = $interval->format('%y');
                                }
                            @endphp
                                <td>{{ $age }}</td>
                                <td>
                                    <button class="btn btn-icon waves-effect waves-light btn-info search_val" style="width: 100%;" btn_id="{{$l->patient_id}}" btn_name="{{$l->firstname}} {{$l->lastname}}" btn_hn="{{$l->hn}}"><i class="far fa-folder-open"></i></button>
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="9">No data!!! </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{$patient->appends(request()->input())->links()}}
            </div>
        </div>
    </div>


    <div class="col-lg-7">
        <div class="card" style="height: 100%;">
            <div class="card-header" style="padding-bottom: 1em;">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 id="btn_name"></h5>
                        <h5 id="btn_hn"></h5>
                        <k id="link_edit"></k>
                    </div>
                    <div class="col-lg-6 text-right">
                        <h2>HISTORY</h2>
                        <k id="btn_create"></k>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-striped">
                        <thead class="">
                            <tr>
                                <th scope="col">Case ID</th>
                                <th scope="col">Status</th>
                                <th scope="col">Doctor</th>
                                <th scope="col">Procedure</th>
                                <th scope="col">Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="td_data">
                            <tr>
                                <th scope="row" colspan="6" class="text-center">No data !!</th>
                            </tr>
                        </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $('.search_val').click(function(){
        var btn_id      = $(this).attr('btn_id');
        var this_name   = $(this).attr('btn_name');
        var this_hn     = $(this).attr('btn_hn');
        var this_url    = "{{url("")}}";
        $('#btn_name').text("Name : "+this_name);
        $('#btn_hn').text("HN : "+this_hn);
        $('#btn_create').html("<a href='"+this_url+"/registration/"+btn_id+"' class='btn btn-primary btn-lg'><i class='fa fa-plus'></i> New case</a>");
        $('#link_edit').html("<a href='"+this_url+"/patient/"+btn_id+"/edit?prepage={{url()->full()}}' "+"class='btn btn-warning btn-lg'><i class='far fa-edit icon-sm'></i>&nbsp;Edit patient info</a>");
        $("#td_data").html("<tr><td colspan='6' style='text-align: center;'><div class='loadingio-spinner-bars-zy9i70wgs1m'><div class='ldio-vfu9b3lacsh'><div></div><div></div><div></div><div></div></div></div></td></tr>");
        $.post("{{url('jquery')}}",{
            event       : 'query_patient',
            this_hn     :  this_hn,
            this_url    : this_url,
        },function(data,status){
            $("#td_data").html(data);
            $('[data-toggle="popover"]').popover();
        });
    });
    $(document).ajaxSuccess(function() {
        $('[data-toggle="popover"]').popover();
    });
</script>
@endsection




