<script src="{{url("public/js/jquery-1.11.1.min.js")}}"></script>
<script src="{{url("public/js//tableToExcel.js")}}"></script>
<link href="{{asset('public/css/bootstrap.min.css')}}"                             rel="stylesheet" type="text/css"/>
<link href="{{asset('public/css/font-awesome.min.css')}}"                          rel="stylesheet" type="text/css"/>
<link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">

<?php

    $uidname        = 'วิไลชนม์';
    // $uid            = $id;

    if($procedure==null){
        // $tb_procedure   = Department::procedure(uid());
        $procedure = array();
    }



    $tb_procedure   = DB::table('tb_procedure')->wherein('procedure_name',$procedure)->get();

    $monthall   = array('01','02','03','04','05','06','07','08','09','10','11','12');
    $countpro   = count($tb_procedure);


    foreach ($user as $uid) {
        $username = DB::table('users')->where('id',$uid)->first();
        foreach($tb_procedure as $pro){
            foreach ($monthall as $month){
                $w[0] = array('report_endoscopist','like','%'.$username->user_lastname.'%');
                $w[1] = array('report_endoscopist','like','%'.$username->user_firstname.'%');
                $w[2] = array('report_procedure',$pro->procedure_name);
                $w[3] = array('report_appointment_month',$month);
                $w[4] = array('report_appointment_year',$year);
                $summary[$uid][$pro->procedure_code][$month] = DB::table('tb_report')->where($w)->count();
            }
        }
    }



?>

    <div class="row">


        <div class="col-12"><br></div>
        <div class="col-2"></div>
    <div class="col-4">
       <button onclick="goBack()" class="btn btn-info btn-block">ย้อนกลับ</button>
    </div>
    <div class="col-4">
        <button id="btnExport" class="btn btn-success btn-block">Excel</button>
     </div>



    <div class="col-2"></div>
    <div class="col-12"><br></div>
    <div class="col-12">
    <table border="1" width="50%">

        <tr>
            <td>name</td>
            <td>procedure</td>
            <td>Jan</td>
            <td>Feb</td>
            <td>Mar</td>
            <td>Apr</td>
            <td>May</td>
            <td>Jun</td>
            <td>Jul</td>
            <td>Aug</td>
            <td>Sep</td>
            <td>Oct</td>
            <td>Nov</td>
            <td>Dec</td>
        </tr>

        @php
            $usernamerow = 0;
        @endphp

    @foreach ($user as $id)

        @isset($summary[$id])
            @foreach($summary[$id] as $key=>$val)
                <tr>
                    @if($usernamerow==0)
                        @php
                            $user = DB::table('users')->where('id',$id)->first();
                        @endphp

                        <td rowspan="{{$countpro}}">
                            {{$user->user_prefix}}
                            {{$user->user_firstname}}
                            {{$user->user_lastname}}
                        </td>
                    @endif


                    @php
                        $proce = DB::table('tb_procedure')->where('procedure_code',$key)->first();
                    @endphp

                    <td>{{$proce->procedure_name}}</td>
                    @foreach($val as $mon=>$count)
                        <td>{{$count}}</td>
                    @endforeach
                </tr>

                    @php
                        $usernamerow++;
                        if($usernamerow==$countpro){
                            $usernamerow=0;
                        }
                    @endphp


            @endforeach
        @endisset

    @endforeach
    </table>
    </div>
    </div>

<script>

    $(document).ready(function(){
        $("#btnExport").click(function() {

            /*
            let table = document.getElementsByTagName("table");
            TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
               name: `export.xlsx`, // fileName you could use any name
               sheet: {
                  name: 'Sheet 1' // sheetName
               }
            });
            */

            let table = document.getElementsByTagName("table");
            TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
                name: `{{$year}}.xlsx`, // fileName you could use any name
                sheet: {
                    name: 'Sheet 1' // sheetName
                }

            });


        });




        //window.history.back();


    });



        $(function() {
            $("dddbutton").click(function(){
            $("#table2excel").table2excel({
                exclude: ".noExl",
                name: "Excel Document Name"
            });
             });
        });

        function goBack() {
            window.history.back();
        }
    </script>
