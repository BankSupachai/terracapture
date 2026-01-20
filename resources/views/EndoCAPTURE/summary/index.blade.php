<?php

    $uidname        = 'วิไลชนม์';
    $uid            = 9;
    $tb_procedure   = Department::procedure(uid());
    $monthall       = array('01','02','03','04','05','06','07','08','09','10','11','12');
    $year           = '2020';

    $countpro = count($tb_procedure);




    foreach($tb_procedure as $pro){
        foreach ($monthall as $month){
            $w[0] = array('report_endoscopist','like','%'.$uidname.'%');
            $w[1] = array('report_procedure',$pro->procedure_name);
            $w[2] = array('report_appointment_month',$month);
            $w[3] = array('report_appointment_year',$year);
            $summary[$uid][$pro->procedure_code][$month] = DB::table('tb_report')->where($w)->count();
        }
    }

?>


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

        @foreach($summary[9] as $key=>$val)
            <tr>
                @if($usernamerow==0)
                    @php
                        $user = DB::table('users')->where('id',$uid)->first();
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

    </table>
