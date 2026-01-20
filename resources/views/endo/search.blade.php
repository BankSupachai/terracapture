@php
    $layouts = 'layouts.app';
    if($project=='endoindex'){
        $layouts = 'layouts.layout_capture';
    }
@endphp
@extends($layouts)

@section('style')
    <style>
        .card-body {
            padding: 1em;
        }

    </style>
@endsection

@section('content')
    <div class="row" style="margin: 0;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group" style="margin: 0;">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="input-icon mb-2">
                                        <input type="text" name="search" class="form-control" placeholder="Search..." value="{{@$search}}" />
                                        <span><i class="flaticon2-search-1 icon-md"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-success" style="width: 100%;"><i class="flaticon2-search-1 icon-md"></i>Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12" style="margin-top: 1em;">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 6%;">&nbsp; #</th>
                                <th style="text-align: center;">HN</th>
                                <th style="width: 20%;">Patient Name</th>
                                <th class="thage" style="width: 5%;text-align:center;">Age</th>
                                <th style="width: 25%;text-align: center;">Procedure</th>
                                <th style="text-align: center;">Room</th>
                                <th style="width: 10%;text-align:center;">Date</th>
                                <th style="text-align: center;width:8%;">Manage</th>
                            </tr>
                        </thead>
                        <tbody id="set_data">
                            @foreach ($tb_case as $tb)
                                @php
                                    $json = jsonDecode($tb->case_json);
                                    $date = new DateTime($tb->case_dateappointment);
                                    $date = $date->format('Y-m-d');
                                @endphp
                                <tr>
                                    <th style="width: 6%;">
                                        <a href="loadpic/{{ $tb->case_id }}">
                                            {{ $tb->case_id }}
                                        </a>
                                    </th>
                                    <th style="text-align: center;">{{ $tb->case_hn }}</th>
                                    <th style="width: 20%;">{{ @$json->patientname }}</th>
                                    <th class="thage" style="width: 5%;text-align:center;">{{ @$json->age }}</th>
                                    <th style="width: 25%;text-align: center;">{{ @$json->procedurename }}</th>
                                    <th style="text-align: center;">{{ @$json->room }}</th>
                                    <th style="width: 10%;text-align:center;">{{@$date}}</th>
                                    <th style="text-align: center;width:8%;">
                                        <div class="btn-group">
                                            @if($tb->case_status==2)
                                            <a data-container="body" data-offset="60px 0px" data-toggle="popover" data-placement="top" data-content="Report"  href="{{url("reportendocapture/$tb->case_id")}}" class="btn btn-primary"><i class="far fa-calendar-check"></i></a>
                                            @else
                                            <button data-container="body" data-offset="60px 0px" data-toggle="popover" data-placement="top" data-content="No Report" class="btn btn-secondary text-dark" disabled><i class="far fa-calendar-times"></i></button>
                                            @endif
                                            <a data-container="body" data-offset="60px 0px" data-toggle="popover" data-placement="top" data-content="Record" href="{{url("loadpic/$tb->case_id")}}" class="btn btn-icon waves-effect waves-light btn-info"> <i class="far fa-folder-open"></i></a>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                            @if ($tb_case == null)
                                <tr>
                                    <td colspan="8" class="text-center">No Data!!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
@endsection
