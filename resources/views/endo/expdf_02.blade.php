@extends('layouts.app3')
@section('title', 'EndoINDEX')
@section('content')


    <div class="row">
        <div class="col-12">
            &nbsp;
        </div>
        <div class="col-5">
            <div class="row">

                <div class="col-12">
                    <div class="card-box">
                        <form action="" class="row">
                            <div class="col-2">
                                ค้นหา
                            </div>
                            <div class="col-8">
                                <input name="search" class="form-control">
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-success">ค้นหา</button>
                            </div>
                        </form>
                    </div>
                </div>

        <div class="col-12">
            <div class="card-box">


    <table id="tech-companies-1" class="table table-striped">
    <thead>
    <tr>

    <th>HN</th>
    <th>Patient Name</th>
    <th>	Procedure	</th>
    <th> Date </th>
    <th width="100"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PDF </th>
    </tr>
    </thead>
    <tbody>

    @forelse($case as $l)
    <tr>
    @php
    $gender =  DB::table('dd_gender')->where('gender_id','=',$l->gender)->first();
    $aname = str_replace(" ","_",$l->name);

    $status="Registered";
    if($l->case_status==0){$status=" Registered ";$color="#FFFF00";}
    if($l->case_status==1){$status=" Operation ";$color="#FFA500";}
    if($l->case_status==2){$status=" Finished ";$color="#32CD32";}
    @endphp

    <th>{{ $l->hn }}</th>
    <th>{{ $l->firstname." ".$l->lastname }}</th>
    <td>{{ $l->procedure_name }}</td>
    @php
    $datemeet = substr($l->case_dateappointment, 0,-8);
    @endphp
    <td>{{ $datemeet }}</td>
    <td>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="?type=Procedure&caseid={{ $l->case_id }}" class="btn btn-icon waves-effect waves-light btn-info">
        <i class="fa dripicons-folder-open"></i>
        </a>
    </td>
    </tr>
    @empty
    <tr>
    <td colspan="10">No data!!! </td>
    </tr>
    @endforelse
    </tbody>
    </table>
    </div>
    </div>


            </div>
        </div>

        <div class="col-7">
            <div class="card-box">
                PDF
                @if(isset($_GET['type']))
                    <iframe id="iframepdf" src="{{url("pdf?id={{$_GET['caseid']}}&type={{$_GET['type']}}")}}" width="100%" height="800"></iframe>
                @endif

            </div>
        </div>
    </div>
@endsection

@section('endscript')

@endsection
