@php
        $data = DB::table('tb_case')
        ->join('patient','patient.id','tb_case.case_patientid')
        ->join('tb_procedure', 'tb_case.case_procedurecode', 'tb_procedure.procedure_code')
        ->where('case_id',$_GET['case_id'])
        ->first();


@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Queue</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{url('url_monitor/popmenu.css')}}">
    <link rel="stylesheet" href="{{url('url_monitor/bootstrap-switch-button.min.css')}}">
    <link rel="stylesheet" href="{{url('url_monitor/bootstrap.min.css')}}">
    <style>


    #aaa {
        position: relative;
    }
    #ccc {
        margin: 20;
        padding: 20;
        list-style: none;
        position: absolute;
        top: 3;
    }
    </style>
</head>

    <body>
        <div style="width: 270px;padding: 20;">
            <div align="center">
                <div id="aaa">
                    <div id="ccc"align="center">
                        <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ศูนย์ส่องกล้อง</h4>
                    </div>
                        <div style="line-height: 80%;">&nbsp;</div>
                        <img src="{{url("")}}/genqrcode?gen=http://medicaendo.com/public/queue_showdetail?hn={{$_GET['hn']}}" width="250">
                        <div style="line-height: 80%;">&nbsp;</div>
                        <h3 style="line-height: 0.2;">{{$data->hn}}</h3>
                        <h4>{{$data->firstname}} {{$data->lastname}}</h4>
                        ออกบัตร {{date('Y-m-d H:i:s')}}
                </div>
            </div>
            <div style="line-height: 50%;"><a onclick="window.print()">Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="goBack()">Go Back</a></div>

        </div>
    </body>

</html>



<script>
function goBack() {
  window.history.back();
}
</script>
