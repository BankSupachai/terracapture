@extends('layouts.app3')
@section('title', 'EndoINDEX')
@section('content')


<br><br>
<div class="row">
    <div class="col-12">
        <div class="row">


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
                            <a href="?search={{$_GET['search']}}&type=Procedure&caseid={{ $l->case_id }}" class="btn btn-icon waves-effect waves-light btn-info">
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

                    @php
                    if(isset($_GET['type'])){
                        $type=$_GET['type'];
                    }else{
                        $type="Procedure";
                    }

                    if(isset($_GET['savepdf'])){
                        $savepdf="&savepdf=true";
                    }else{
                        $savepdf="";
                    }
                    @endphp

                    @if(isset($_GET['type']))





                    @forelse($casedata as $data)

                    @php
                    if($data->birthdate!=""){
                      $birthDate = explode("-", $data->birthdate);
                      $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2])))
                      > date("md") ? (((date("Y")+543) - $birthDate[2]) - 1) : ((date("Y")+543) - $birthDate[2]));
                    }


                    $gander = DB::table('dd_gender')->where('gender_id','=',$data->gender)->first();

                    $ex = explode(' ',$data->case_dateappointment);



                    $str  = $data->case_id."!";
                    $str .= $data->hn."!";
                    $str .= $data->firstname."!";
                    $str .= $data->lastname."!";
                    $str .= $gander->name."!";
                    $str .= $age."!";
                    $str .= $ex[0]."!";
                    $str .= $ex[1]."!";
                    $str .= $data->procedure_name."!";
                    $str .= $data->birthdate;



                    @endphp



@empty
@endforelse



                        <iframe id="iframepdf" src="{{url("pdf?id={{$_GET['caseid']}}&type={{$type}}{{$savepdf}}")}}" width="100%" height="800"></iframe>
                    <label class="col-12"></label>

                        <div class="row">

                        <div class="col-4">
                            <a class="btn btn-info btn-block" href="?search={{$_GET['search']}}&type=Procedure&caseid={{@$_GET['caseid']}}">Procedure Report</a>
                        </div>


                        <div class="col-4">
                            <a class="btn btn-info btn-block" href="?search={{$_GET['search']}}&type=ProcedureWriting&caseid={{@$_GET['caseid']}}">Procedure Report (Long writing) </a>
                        </div>



                        <div class="col-4">
                            <a class="btn btn-primary btn-block" href="?search={{$_GET['search']}}&type=ProcedureDraw&caseid={{@$_GET['caseid']}}">Procedure Report (Drawing)</a>
                        </div>

                        <br></br>


                        <div class="col-4">
                            <a class="btn btn-success btn-block" href="?search={{$_GET['search']}}&type=Pathology&caseid={{@$_GET['caseid']}}">Pathology Report</a>
                        </div>



                        <div class="col-4">
                            <a class="btn btn-danger btn-block"  href="?search={{$_GET['search']}}&type=Discharge&caseid={{@$_GET['caseid']}}">Discharge Report</a>
                        </div>


                        <div class="col-4">
                            <a class="btn btn-warning btn-block" href="?search={{$_GET['search']}}&type=Accessory&caseid={{@$_GET['caseid']}}">Accessory Report</a>
                        </div>

                        </div>

                        @endif
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

        $('.btn-outline-success').click(function(){
            pdftype = $(this).attr('id');
            $('#mi-modal').modal('show');
        });


        $('#btnYes').click(function(){
            window.location.replace("{{url("expdf/{{@$_GET['caseid']}}?type="+pdftype+"&savepdf=true")}}");
        });


    </script>

@endsection
