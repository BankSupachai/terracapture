@extends('layouts.app_unmenu')
@section('title', 'EndoINDEX')
@section('content')

    <div class="row" style="margin: 0;margin-top:3px;">
        <div class="cardcode col-12" style="padding: 0;display:none">
            <div class="card">
                <div class="card-body">
                    <label id="discharge_toggle">
                        <font size='4'><b>Page Detail</b></font>
                    </label>
                    <div class="row">
                        <div class="col-12">
                            Controller : <a
                                href="autoit?run=visualcode_open\\endo.exe&path=ExPDFController">ExPDFController</a>
                        </div>
                        <div class="col-12">
                            View : <a href="autoit?run=visualcode_open\\endo.exe&path=expdf">expdf</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row" style="margin: 0;margin-top:0.5em;">
        <div class="col-lg-5">
            <div class="row">
                <div class="col-12">
                    <div class="card" style="height: 100%;">
                        <div class="card-body" style="padding: 1em;">
                            <form action="" class="row">
                                <div class="col-lg-9" style="padding-bottom: 3px;">
                                    <input name="search" class="form-control" placeholder="Search..........">
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-success" style="width: 100%;"><i class="flaticon2-search-1 icon-md"></i>Search</button>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table id="tech-companies-1" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>HN</th>
                                            <th>PATIENT NAME</th>
                                            <th>PROCEDURE</th>
                                            <th>DATE</th>
                                            <th width="100"> &nbsp;&nbsp;&nbsp;&nbsp;REPORT </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($case as $l)
                                            <tr>
                                                @php
                                                    $aname = str_replace(' ', '_', @$l->name);
                                                    $json = jsonDecode($l->case_json);
                                                @endphp
                                                <th>{{ @$l->case_hn }}</th>
                                                <th>{{ @$json->patientname }}</th>
                                                <td>{{ @$json->procedurename }}</td>
                                                @php
                                                    $datemeet = substr(@$l->case_dateappointment, 0, -8);
                                                @endphp
                                                <td>{{ $datemeet }}</td>
                                                <td>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="?search={{ @$_GET['search'] }}&type=procedure&caseid={{ @$l->case_id }}"
                                                        class="btn btn-icon waves-effect waves-light btn-primary">
                                                        <i class="far fa-file-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10">ไม่มีข้อมูลในฐานข้อมูลปัจจุบัน</td>
                                            </tr>
                                        @endforelse

                                        @if (isset($endosmart))
                                            @forelse($endosmart as $l)
                                                <tr>
                                                    @php

                                                    @endphp
                                                    <th>{{ @$l->HN_ID }}</th>
                                                    <th>
                                                        {{ @$l->PT_NAME . ' ' . @$l->PT_SURNAME }}<br>
                                                        <br>

                                                        @php

                                                            $step1 = explode('HYPER_DATA', @$l->DATA_FOLDER);

                                                            $path = '';

                                                            if (@$l->DATA_FOLDER != null) {
                                                                $Colonoscopy = strpos($step1[1], 'Colonoscopy');
                                                                $EGD = strpos($step1[1], 'EGD');
                                                                $ERCP = strpos($step1[1], 'ERCP');
                                                                $Bronchoscopy = strpos($step1[1], 'Bronchoscopy');
                                                                $Liverbiopsy = strpos($step1[1], 'Liverbiopsy');
                                                                $EUS = strpos($step1[1], 'EUS');
                                                                $Cystoscopy = strpos($step1[1], 'Cystoscopy');
                                                                $FlexibleSigmoidoscopy = strpos($step1[1], 'Flexible-Sigmoidoscopy');

                                                                if ($Colonoscopy > 0) {
                                                                    $path = extradata($Colonoscopy, 'Colonoscopy', @$l->HN_ID, $step1[1]);
                                                                }
                                                                if ($EGD > 0) {
                                                                    $path = extradata($EGD, 'EGD', @$l->HN_ID, $step1[1]);
                                                                }
                                                                if ($ERCP > 0) {
                                                                    $path = extradata($ERCP, 'ERCP', @$l->HN_ID, $step1[1]);
                                                                }
                                                                if ($Bronchoscopy > 0) {
                                                                    $path = extradata($Bronchoscopy, 'Bronchoscopy', @$l->HN_ID, $step1[1]);
                                                                }
                                                                if ($Liverbiopsy > 0) {
                                                                    $path = extradata($Liverbiopsy, 'Liverbiopsy', @$l->HN_ID, $step1[1]);
                                                                }
                                                                if ($EUS > 0) {
                                                                    $path = extradata($EUS, 'EUS', @$l->HN_ID, $step1[1]);
                                                                }
                                                                if ($Cystoscopy > 0) {
                                                                    $path = extradata($Cystoscopy, 'Cystoscopy', @$l->HN_ID, $step1[1]);
                                                                }
                                                                if ($FlexibleSigmoidoscopy > 0) {
                                                                    $path = extradata($FlexibleSigmoidoscopy, 'Flexible-Sigmoidoscopy', @$l->HN_ID, $step1[1]);
                                                                }
                                                            }


                                                            $newpath = str_replace("D:\\","D:\laragon\htdocs\\",$l->DATA_FOLDER);
                                                            if($newpath==""){
                                                                $newpath = "D:\\laragon\\htdocs\\HYPER_DATA\\";
                                                            }
                                                        @endphp



                                                </th>
                                                <td>{{ @$l->CASE_TYPE }}</td>
                                                @php
                                                    $datemeet = substr(@$l->CASE_APPOINT_DATE, 0, -8);
                                                @endphp
                                                <td>{{ $datemeet }}</td>
                                                <td>

                                                    <a href="?search={{ @$_GET['search'] }}&path={{@$newpath}}&caseid={{ @$l->CASE_ID }}&dataform=endosmart"
                                                        class="btn btn-icon waves-effect waves-light btn-info">JPG</a>

                                                </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10">ไม่มีข้อมูลในฐานข้อมูลเก่า</td>
                                                </tr>
                                        @endforelse
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h2>
                                        Report Type
                                    </h2>
                                </div>
                                <div class="col-lg-3" style="padding: 5px;">
                                    <a class="btn btn-outline-primary btn-block"
                                        href="?search={{ @$_GET['search'] }}&type=procedure&caseid={{ @$_GET['caseid'] }}">Procedure
                                        Report</a>
                                </div>

                                <div class="col-lg-3" style="padding: 5px;">
                                    <a class="btn btn-outline-primary btn-block"
                                        href="?search={{ @$_GET['search'] }}&type=long_writing&caseid={{ @$_GET['caseid'] }}">Long Writing Report</a>
                                </div>

                                <div class="col-lg-3" style="padding: 5px;">
                                    <a class="btn btn-outline-primary btn-block"
                                        href="?search={{ @$_GET['search'] }}&type=drawing&caseid={{ @$_GET['caseid'] }}">Drawing Report</a>
                                </div>

                                <div class="col-lg-3" style="padding: 5px;">
                                    <a class="btn btn-outline-primary btn-block"
                                        href="?search={{ @$_GET['search'] }}&type=long_image&caseid={{ @$_GET['caseid'] }}">Long image Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body" style="padding: 1em;">
                    REPORT

                    @php
                        if (isset($_GET['type'])) {
                            $type = $_GET['type'];
                        } else {
                            $type = 'procedure';
                        }

                        if (isset($_GET['savepdf'])) {
                            $savepdf = '&savepdf=true';
                        } else {
                            $savepdf = '';
                        }
                    @endphp

                    @if (isset($_GET['type']))

                        @php
                            $tb_case = DB::table('tb_case')->where('case_id',$_GET['caseid'])->first();
                        @endphp

                        @if($tb_case!=null)
                            @if($tb_case->caseuniq>15000)
                                <iframe id="iframepdf"
                                    src="{{ url('') }}/api/pdf?id={{ @$_GET['caseid'] }}&type={{ $type }}{{ $savepdf }}"
                                    width="100%" height="1200"></iframe>
                                <label class="col-12"></label>
                            @else
                                <iframe id="iframepdf"
                                    src="http://192.168.199.163/endocapture/public/pdf?id={{ $tb_case->caseuniq }}&type=Procedure{{ $savepdf }}"
                                    width="100%" height="1200"></iframe>
                                <label class="col-12"></label>
                            @endif
                        @endif

                    @endif
                    @if (isset($_GET['path']))
                        <br><br>
                        {{--
                        <iframe id="iframepdf" src="{{ url('') }}/api/pdf?type=endosmart&path={{ $_GET['path'] }}"
                            width="100%" height="800"></iframe>
                        --}}

                        <iframe id="iframepdf"
                                src="{{url("api/pdf/endosmart?path={{$_GET['path']}}")}}"
                                width="100%" height="800"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>





@endsection




@section('endscript')

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });



        var pdftype = "";

        $('.btn-outline-success').click(function() {
            pdftype = $(this).attr('id');
            $('#mi-modal').modal('show');
        });


        $('#btnYes').click(function() {
            window.location.replace("{{ url('') }}/expdf/{{ @$_GET['caseid'] }}?type=" + pdftype +
                "&savepdf=true");
        });

    </script>

@endsection
