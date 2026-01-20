<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face{
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{public_path('public/fonts/THSarabunNew.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{public_path('public/fonts/THSarabunNew Bold.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{public_path('public/fonts/THSarabunNew Italic.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{public_path('public/fonts/THSarabunNew BoldItalic.ttf')}}") format("truetype");
        }
        *{
            font-family: "THSarabunNew";
        }
        html{
            padding: 0;
            margin: 0;
        }
        td{
            padding: 0px 5px;
        }
        body{
            padding: 135px 25px;
        }
        table{
            width: 100%;
        }

        .head tr{
            line-height: 10px !important;
        }
        .head tr:first-child td{
            font-size: 26px;
            font-weight: bold;
            vertical-align: bottom;
            padding-left: 0;
        }
        .head tr:last-child td{
            font-size: 24px;
            vertical-align: top;
            padding: 0 !important;
            padding-top: 15px !important;
        }
        .head tr td img{
            width: 80px;
        }
        .sub-head tr td{
            line-height: 12px;
            width: 50%;
        }

        .border-bottom{
            border-bottom: 1px solid gray;
        }
        .text-right{
            width: fit-content;
            text-align: right;
        }
        .vb{
            vertical-align: bottom !important;
        }
        .vt{
            vertical-align: top !important;
        }
        .text-center{
            text-align: center !important;
        }
        .text-right{
            text-align: right !important;
        }
        .table_body tr td:first-child{
            width: 20%;
        }

        .text-blue{
            color:dodgerblue;
        }
        .table-line,.table-line td,.table-line th {
            border: 1px solid grey;
        }

        .table-line {
            border-collapse: collapse;
            width: 100%;
        }
        .table-border{
            border: 1px solid grey;
        }
        .w-35{
            width: 35%;
        }
        ul{
            padding-left: 15px;
        }
        ul li{
            font-size: small;
            padding-left: 0;
        }
        .chart{
            width: 25%;
            margin: auto;
        }
        #tb_chart td{
            height: 150px;
            text-align: center;
        }
        .p-0{padding: 0 !important;}
        .data-body tr td:first-child{
            width: 500px;
        }
        .data-body tr td{
            vertical-align: top !important;
        }
        .form-git{
            width: 100%;
            display: flex;
            margin-top: 200px !important;
        }
        #content{
            width: 500px;
            position: absolute;
        }
        #sub_content{
            /* padding-top: 120px !important; */
            width: 100%;
            /* position: absolute; */
        }
        .list-new-page{
            padding-top: 0px;
        }
        .list-img{
            /* padding-top: 200px !important; */
            position: absolute;
            top: 200px;
            right: 0px;
            /* margin-right: -25px; */
            width: 210px;
        }
        .text-blue{color: #295EA9;}
        .text-green{color: #267631;}
        .data-list tr td{line-height: 10px;}
        .table-list, .table-list td ,.table-fetal, .table-fetal td,.table-teral, .table-teral td{
            /* border: 1px solid #F3F6F9; */

            vertical-align: middle;
        }
        .table-list td, .table-fetal td,.table-teral td{
            padding-bottom: 3px;
        }
        .table-list,.table-fetal,.table-teral{
            border: 1px solid black !important;
        }
        .table-list td,.table-fetal td,.table-teral td{
            line-height: 10px;
            /* border-collapse: collapse; */
        }
        .table-list td:nth-child(2),.table-list td:nth-child(4),.table-list td:nth-child(5),.table-fetal tr td:nth-child(2),.table-fetal tr td:nth-child(3),.table-fetal tr td:nth-child(4),.sub-head1 tr td:nth-child(2),.sub-head1 tr td:nth-child(4){
            text-align: center;
        }
        .sub-head1 tr td{width: 20%;}
        .table-list tr td{
            width: 15%;
            line-height: 16px;
        }
        .table-list tr td:nth-child(3){
            width: 40%;
        }
        .table-fetal tr td{width: 15%;}
        .table-fetal tr td:last-child{width: 40%;}
        .table-list tr:first-child td{background: #F3F6F9;text-align: center;}
        .bg-select{
            background: #2F4B5E;color: #fff;
        }
        .table-general{
            width: 100%;
        }
        .table-general tr td:first-child{
            width: 25%;
        }
        .w-25per tr td:first-child{
            width: 25%;
        }
        .table-general td{line-height: 10px;}
        .sub-head1 tr td{
            line-height: 12px;
        }
        .img-pdf{
            width: 180px;
            height: 180px;
        }
        .pl-15px{padding-left: 15px;}
        /* @page {  margin: 180px 50px;} */

        #header { position: fixed; left: 25px; top: 0px; right: 25px; height: 130px; background-color: white; text-align: center; }
        #footer { position: fixed; left: 10px; bottom: 20px; right: 10px; height: 30px;}
        .page-break {
            page-break-after: always;
        }
        .form-git{
            display: flex;
        }
        .lh10px{
            line-height: 10px !important;
        }
        .w-left{
            width: 70%;
        }
    </style>
    <style>

    </style>
</head>
<body>
    <div id="header">
        <table class="head border-bottom">
            <tr>
                <td>{{@$hospital->hospital_name}}</td>
                <td rowspan="2" class="text-right vt p-0"><img src="{{fileconfig($hospital->hospital_pic)}}" alt=""></td>
            </tr>
            <tr>
                <td>{{@$hospital->hospital_address}}</td>
            </tr>
        </table>
        <table class="sub-head1 border-bottom">
            <tr>
                <td><b>Procedure</b></td>
                <td><b>PID</b></td>
                <td><b>Name</b></td>
                <td><b>Age</b></td>
                <td><b>Date</b></td>
            </tr>
            <tr>
                {{-- Growth Scan --}}
                <td class="text-green">{{@$case->procedure_name}}</td>
                <td>{{@$case->case_hn}}</td>
                <td>{{@$case->prefix}} {{@$case->firstname}} {{@$case->middlename}} {{@$case->lastname}} ({{@$case->gender_name[0]}}) </td>
                <td>{{age_form_bd($case->birthdate)}} </td>
                <td>{{$date}}</td>
            </tr>
        </table>
    </div>
    <div id="footer">Signature <span class="border-bottom">{{nbsp(80)}}</span> , -Dicom (0008,1050)</div>
    <div id="sub_content">
        <table class="sub-head border-bottom">
            <tr>
                <td><b>Treatment Coverage :</b> - </td>
                <td><b>Ward :</b> -</td>
            </tr>
            <tr>
                <td><b>Interventionist Fellow :</b> -</td>
                <td></td>
            </tr>

        </table>
    </div>
    <div class="list-img">
        <table>
            @if(isset($photo) || isset($charts))
                @php
                    $count_photo  = 0;
                    $count_charts = 0;
                    if(isset($photo)){
                        $count_photo = count($photo);
                    }
                    if(isset($charts)){
                        $count_charts = count($charts);
                    }
                @endphp
                @if(isset($photo))
                    @for ($i=0;$i<count($photo);$i++)
                        @php
                            $n = explode('/',$photo[$i]);
                            $n0 = str_replace('.jpg','',$n[2]);
                            $n00 = str_replace('.png','',$n0);
                            $text0 = "text_img[$n00]";
                            $text0 = "[ ".($i+1)." ] ".@$json->$text0;
                        @endphp
                        <tr>
                            <td><img src='{{picurl($photo[$i])}}' class="img-pdf"></td>
                        </tr>
                        <tr>
                            <td class="pl-15px">{{$text0}}</td>
                        </tr>
                        @php
                            if($i==3){break;};
                        @endphp
                    @endfor
                @endif
                @if($i<=2)
                        @for($ii=0;$ii<$count_charts;$ii++)
                            <tr>
                                <td>
                                    @if(isset($charts[$ii]) && @$charts[$ii]!='')
                                    <img src="data:image/png;base64, {{$charts_img[$ii]}}" class="img-pdf">
                                    {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$ii]}}.jpg" class="img-pdf"> --}}
                                    @endif
                                </td>
                            </tr>
                            @php
                                if($i+($ii+1)==3){break;};
                            @endphp
                        @endfor
                    @endif
                {{-- @endif --}}
            @endif
        </table>
    </div>
    {{-- <div class="form-git">
        <div id="content"> --}}

            <table class="data-list w-left">
                @if(@$json->ck_brief_history!='false')
                    @if(isset($json->brief_history))
                    <tr>
                        <td><b class="text-blue">BRIEF HISTORY :</b> {{@$json->brief_history}}</td>
                    </tr>
                    @endif
                @endif
                @if(@$json->ck_indication!='false')
                    @if(isset($json->indication))
                    <tr>
                        <td><b class="text-blue">INDICATION :</b> {{@$json->indication}}</td>
                    </tr>
                    @endif
                @endif
                @if(@$json->ck_indication!='false')
                    @if(isset($json->gestation))
                    <tr>
                        <td><b class="text-blue">PregnaNcy :</b> {{@$json->gestation}}, Number of Fetuses : {{@$json->fetuses}}</td>
                    </tr>
                    @endif
                @endif

            </table>
            @if(@$json->ck_dating!='false')
            <table class="lh10px w-left">
                <tr>
                    <td><b class="text-blue">DATING  : </b></td>
                </tr>
            </table>
            @endif
            @if(@$json->ck_dating!='false')
            <table class="table-list w-left">
                <tr>
                    <td>Method</td>
                    <td>Date</td>
                    <td>Detail</td>
                    <td>Gest.age</td>
                    <td>EDD</td>
                </tr>
                <tr @if(@$json->radio_dating=='lmp') class="bg-select" @endif>
                    <td>LMP</td>
                    <td>@if(count($dic) != 0) {{$dic['LMP']}} @else {{@$json->lmp_cycle}}  @endif</td>
                    <td>{{@$json->lmp_cycle}} {{@$json->lmp_length}}</td>
                    <td>{{@$json->lmp_age}}</td>
                    <td>{{@$json->lmp_egd}}</td>
                </tr>
                <tr @if(@$json->radio_dating=='egd') class="bg-select" @endif>
                    <td>Conception</td>
                    <td>{{@$json->egd_date}}</td>
                    <td>{{@$json->egd_detail}}</td>
                    <td>{{@$json->egd_age}}</td>
                    <td>{{@$json->egd_egd}}</td>
                </tr>
                <tr @if(@$json->radio_dating=='us') class="bg-select" @endif>
                    <td>US</td>
                    <td>{{@$json->us_date}}</td>
                    <td>{{@$json->us_upon}}</td>
                    <td>{{@$json->us_age}}</td>
                    <td>{{@$json->us_egd}}</td>
                </tr>
            </table>
            @endif
            @if(@$json->ck_general_evaluation!='false')
            <table class="table-general w-left">
                <tr>
                    <td><b class="text-blue">General evaluation : </b></td>
                    <td></td>
                </tr>
                @if(isset($json->cardiac_activity))
                <tr>
                    <td class="text-green">Cardiac activity :</td>
                    <td>{{@$json->cardiac_activity}}</td>
                </tr>
                @endif
                @if(isset($json->fetal_movements))
                <tr>
                    <td class="text-green">Fetal movements :</td>
                    <td>{{@$json->fetal_movements}}</td>
                </tr>
                @endif
                @if(isset($json->fhr))
                <tr>
                    <td class="text-green">FHR :</td>
                    <td>{{@$json->fhr}}</td>
                </tr>
                @endif
                @if(isset($json->presentation))
                <tr>
                    <td class="text-green">Presentation :</td>
                    <td>{{@$json->presentation}}</td>
                </tr>
                @endif
                @if(isset($json->placenta))
                <tr>
                    <td class="text-green">Placenta :</td>
                    <td>{{@$json->placenta}}</td>
                </tr>
                @endif
                @if(isset($json->umbilical_cord))
                <tr>
                    <td class="text-green">Umbilical Cord :</td>
                    <td>{{@$json->umbilical_cord}}</td>
                </tr>
                @endif
                @if(isset($json->amniotic_fluid))
                <tr>
                    <td class="text-green">Amniotic Fluid :</td>
                    <td>{{@$json->amniotic_fluid}}</td>
                </tr>
                @endif
            </table>
            @endif
            @if(@$json->ck_non_stress_test!='false')
            <table class="table-general w-left">
                <tr>
                    <td><b class="text-blue">Non Stress Test : </b></td>
                    <td></td>
                </tr>
                @if(isset($json->nst_text))
                <tr>
                    <td class="text-green">NST interpretation :</td>
                    <td>{{@$json->nst_num}} {{@$json->nst_text}}</td>
                </tr>
                @endif
                @if(isset($json->accelerations_text))
                <tr>
                    <td class="text-green">Accelerations :</td>
                    <td>{{@$json->accelerations_num}} {{@$json->accelerations_text}}</td>
                </tr>
                @endif
                @if(isset($json->test_duration))
                <tr>
                    <td class="text-green">Test duration :</td>
                    <td>{{@$json->test_duration}}</td>
                </tr>
                @endif
                @if(isset($json->decelerations))
                <tr>
                    <td class="text-green">Decelerations :</td>
                    <td>{{@$json->decelerations}}</td>
                </tr>
                @endif
                @if(isset($json->baseline_fhr))
                <tr>
                    <td class="text-green">Baseline FHR :</td>
                    <td>{{@$json->baseline_fhr}}</td>
                </tr>
                @endif
                @if(isset($json->uterine_activity))
                <tr>
                    <td class="text-green">Uterine activity :</td>
                    <td>{{@$json->uterine_activity}}</td>
                </tr>
                @endif
                @if(isset($json->baseline_variability))
                <tr>
                    <td class="text-green">Baseline variability :</td>
                    <td>{{@$json->baseline_variability}}</td>
                </tr>
                @endif
                @if(isset($json->ctg_category))
                <tr>
                    <td class="text-green">CTG category :</td>
                    <td>{{@$json->ctg_category}}</td>
                </tr>
                @endif
                @if(isset($json->stimulation))
                <tr>
                    <td class="text-green">Acoustic stimulation :</td>
                    <td>{{@$json->stimulation}}</td>
                </tr>
                @endif
                @if(isset($json->non_stress_test_other))
                <tr>
                    <td class="text-green">Other :</td>
                    <td>{{@$json->non_stress_test_other}}</td>
                </tr>
                @endif
            </table>
            @endif
            @if(@$json->ck_biophysical_profile!='false')
            <table class="table-general w-left">
                <tr>
                    <td><b class="text-blue">BIOphySIcal ProFIle : </b></td>
                    <td></td>
                </tr>
                @if(isset($json->biophysical_profile_movements))
                <tr>
                    <td class="text-green">Breathing movements :</td>
                    <td>{{@$json->biophysical_profile_movements}}</td>
                </tr>
                @endif
                @if(isset($json->biophysical_profile_nts))
                <tr>
                    <td class="text-green">NST :</td>
                    <td>{{@$json->biophysical_profile_nts}}</td>
                </tr>
                @endif
                @if(isset($json->body_movements))
                <tr>
                    <td class="text-green">Body movements :</td>
                    <td>{{@$json->body_movements}}</td>
                </tr>
                @endif
                @if(isset($json->biophysical_profile_tone))
                <tr>
                    <td class="text-green">Fetal tone :</td>
                    <td>{{@$json->biophysical_profile_tone}}</td>
                </tr>
                @endif
                @if(isset($json->biophysical_profile_score))
                <tr>
                    <td class="text-green">Total score :</td>
                    <td>{{@$json->biophysical_profile_score}}</td>
                </tr>
                @endif
                @if(isset($json->biophysical_profile_af))
                <tr>
                    <td class="text-green">AF volume :</td>
                    <td>{{@$json->biophysical_profile_af}}</td>
                </tr>
                @endif
                @if(isset($json->biophysical_profile_interpretation))
                <tr>
                    <td class="text-green">Interpretation :</td>
                    <td>{{@$json->biophysical_profile_interpretation}}</td>
                </tr>
                @endif
                @if(isset($json->biophysical_profile_other))
                <tr>
                    <td class="text-green">Other :</td>
                    <td>{{@$json->biophysical_profile_other}}</td>
                </tr>
                @endif
            </table>
            @endif
            @if(@$json->ck_fetal_biometry!='false')

            <table class="w-left">
                <tr>
                    <td colspan="5" style="line-height: 10px;"><b class="text-blue">Fetal Biometry  : </b></td>
                </tr>
            </table>
            <table class="table-fetal w-left">
                @php
                    $bpd = isset($dic['BPD']) && $dic['BPD'] != '' ? explode(' ',$dic['BPD']) : null;
                    $hc = isset($dic['HC']) && $dic['HC'] != '' ? explode(' ', $dic['HC']) : null;
                    $ac = isset($dic['AC']) && $dic['AC'] != '' ? explode(' ', $dic['AC'] ): null;
                    $fl = isset($dic['FL']) && $dic['FL'] != '' ? explode(' ', $dic['FL'] ): null;
                    $efw = isset($dic['EFW']) && $dic['EFW'] != '' ? explode(' ', $dic['EFW']) : null;
                @endphp
                <tr>
                    <td>BPD</td>
                    <td>@if(isset($bpd[0])) {{$bpd[0]}} @else 52.2 @endif @if(isset($bpd[1])) {{$bpd[1]}} @else mm @endif</td>
                    <td>@if(isset($bpd[2])) {{$bpd[2]}} @else 21w + 2d  @endif</td>
                    <td>98%</td>
                    <td>@if(isset($bpd[3])) {{$bpd[3]}} @else Thai Siriraj selection @endif</td>
                </tr>
                <tr>
                    <td>HC</td>
                    <td>@if(isset($hc[0])) {{$hc[0]}} @else 52.2 @endif @if(isset($hc[1])) {{$hc[1]}} @else mm @endif</td>
                    <td>@if(isset($hc[2])) {{$hc[2]}} @else 21w + 2d  @endif</td>
                    <td>+3.15D</td>
                    <td>@if(isset($hc[3])) {{$hc[3]}} @else Thai Siriraj selection @endif</td>
                </tr>
                <tr>
                    <td>AC</td>
                    <td>@if(isset($ac[0])) {{$ac[0]}} @else 52.2 @endif @if(isset($ac[1])) {{$ac[1]}} @else mm @endif</td>
                    <td>@if(isset($ac[2])) {{$ac[2]}} @else 21w + 2d  @endif</td>
                    <td>+2.75D</td>
                    <td>@if(isset($ac[3])) {{$ac[3]}} @else Thai Siriraj selection @endif</td>
                </tr>
                <tr>
                    <td>Femur</td>
                    <td>@if(isset($fl[0])) {{$fl[0]}} @else 52.2 @endif</td>
                    <td>@if(isset($fl[1])) {{$fl[1]}} @else 20w + 3d @endif</td>
                    <td>91%</td>
                    <td>@if(isset($fl[2])) {{$fl[2]}} @else Thai Siriraj selection @endif</td>
                </tr>
            </table>
            <table class="w-left">
                <tr>
                    <td><b>Fetal weight calculation</b></td>
                </tr>
            </table>
            <table class="w-25per table-teral w-left">
                <tr>
                    <td>EPW</td>
                    <td>485g</td>
                </tr>
                <tr>
                    <td>EPW (lb,oz)</td>
                    <td>1 lb, 1 oz.</td>
                </tr>
                <tr>
                    <td>EPW by</td>
                    <td>Hadlock (BPD-HC-AC-FL)</td>
                </tr>
            </table>
            @if(isset($json->fetal_biometry_other))
                <table class="w-25per">
                    <tr>
                        <td class="text-green">Impression :</td>
                        <td>{{@$json->fetal_biometry_other}}</td>
                    </tr>
                </table>
            @endif

            @endif
            @if(@$json->ck_fetal_doppler!='false')

            <table class="w-left">
                <tr class="lh10px">
                    <td colspan="5" style="line-height: 10px;"><b class="text-blue">Fetal doppler  : </b></td>
                </tr>
            </table>
            <table class="w-left">
                <tr>
                    <td><b>Umbilical Artery :</b></td>
                </tr>
            </table>
            <table class="table-fetal w-left">
                <tr>
                    <td>PI</td>
                    <td>52.2 mm.</td>
                    <td>98%</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>RI</td>
                    <td>52.2 mm.</td>
                    <td>+3.15D</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>PS</td>
                    <td>52.2 mm.</td>
                    <td>+2.75D</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>ED</td>
                    <td>52.2 mm.</td>
                    <td>91%</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>TAmax</td>
                    <td>52.2 mm.</td>
                    <td>98%</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>MD</td>
                    <td>52.2 mm.</td>
                    <td>+3.15D</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>S/D</td>
                    <td>52.2 mm.</td>
                    <td>+2.75D</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>HR</td>
                    <td>52.2 mm.</td>
                    <td>91%</td>
                    <td>Thai siriraj Selection</td>
                </tr>
            </table>
            <table class="w-left">
                <tr>
                    <td><b>Right Mid Cerebral Artery :</b></td>
                </tr>
            </table>
            <table class="table-fetal w-left">
                <tr>
                    <td>PI</td>
                    <td>52.2 mm.</td>
                    <td>98%</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>RI</td>
                    <td>52.2 mm.</td>
                    <td>+3.15D</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>PS</td>
                    <td>52.2 mm.</td>
                    <td>+2.75D</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>ED</td>
                    <td>52.2 mm.</td>
                    <td>91%</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>TAmax</td>
                    <td>52.2 mm.</td>
                    <td>98%</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>MD</td>
                    <td>52.2 mm.</td>
                    <td>+3.15D</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>S/D</td>
                    <td>52.2 mm.</td>
                    <td>+2.75D</td>
                    <td>Thai siriraj Selection</td>
                </tr>
                <tr>
                    <td>HR</td>
                    <td>52.2 mm.</td>
                    <td>91%</td>
                    <td>Thai siriraj Selection</td>
                </tr>
            </table>
                @if(isset($json->fetal_doppler_impression))
                    <table class="w-25per">
                        <tr class="lh10px">
                            <td class="text-green">Impression :</td>
                            <td>{{@$json->fetal_doppler_impression}}</td>
                        </tr>
                    </table>
                @endif
                @if(isset($json->fetal_doppler_other))
                    <table class="w-25per">
                        <tr class="lh10px">
                            <td class="text-green">Other :</td>
                            <td>{{@$json->fetal_doppler_other}}</td>
                        </tr>
                    </table>
                @endif
            @endif

            @if(@$json->ck_comment!='false')
            <table class="w-25per w-left">
                <tr class="lh10px">
                    <td><b class="text-blue">Comment  : </b></td>
                    <td>{{@$json->fetal_doppler_other}}</td>
                </tr>
            </table>
            @endif
{{--
        </div>
    </div> --}}

    {{-- </div> --}}

    @if(isset($photo) || isset($charts))
        @if($count_photo+$count_charts>=5)
        @php
            if(isset($ii)){
                $num = $ii;
            }else{
                $num = 0;
            }
        @endphp
        <div class="page-break"></div>
            <div class="list-new-page">
                <table>
                    @if(isset($photo) && $count_photo>=5)
                        @for ($i=4;$i<count($photo);$i++)
                            <tr>
                                <td>
                                    @if(isset($photo[$i]))
                                        <img src='{{picurl($photo[$i])}}' class="img-pdf">
                                        @php
                                            $n1 = explode('/',$photo[$i]);
                                            $n01 = str_replace('.jpg','',$n1[2]);
                                            $n001 = str_replace('.png','',$n01);
                                            $text01 = "text_img[$n001]";
                                            $text01 = "[ ".($i+1)." ] ".@$json->$text01;
                                            $i++;
                                        @endphp
                                    @else
                                        <img src="data:image/png;base64, {{$charts_img[$num]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$num]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $num++;
                                            $text01 = '';
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($photo[$i]))
                                        <img src='{{picurl($photo[$i])}}' class="img-pdf">
                                        @php
                                            $n2 = explode('/',$photo[$i]);
                                            $n02 = str_replace('.jpg','',$n2[2]);
                                            $n002 = str_replace('.png','',$n02);
                                            $text02 = "text_img[$n002]";
                                            $text02 = "[ ".($i+1)." ] ".@$json->$text02;
                                            $i++;
                                        @endphp
                                    @else
                                        <img src="data:image/png;base64, {{$charts_img[$num]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$num]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $num++;
                                            $text02 = '';
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($photo[$i]))
                                        <img src='{{picurl($photo[$i])}}' class="img-pdf">
                                        @php
                                            $n3 = explode('/',$photo[$i]);
                                            $n03 = str_replace('.jpg','',$n3[2]);
                                            $n003 = str_replace('.png','',$n03);
                                            $text03 = "text_img[$n003]";
                                            $text03 = "[ ".($i+1)." ] ".@$json->$text03;
                                            $i++;
                                        @endphp
                                    @else
                                        <img src="data:image/png;base64, {{$charts_img[$num]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$num]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $num++;
                                            $text03 = '';
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($photo[$i]))
                                        <img src='{{picurl($photo[$i])}}' class="img-pdf">
                                        @php
                                            $n4 = explode('/',$photo[$i]);
                                            $n04 = str_replace('.jpg','',$n4[2]);
                                            $n004 = str_replace('.png','',$n04);
                                            $text04 = "text_img[$n004]";
                                            $text04 = "[ ".($i+1)." ] ".@$json->$text04;
                                            $i++;
                                        @endphp
                                    @else
                                        <img src="data:image/png;base64, {{$charts_img[$num]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$num]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $num++;
                                            $text04 = '';
                                        @endphp
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{$text01}}</td>
                                <td>{{$text02}}</td>
                                <td>{{$text03}}</td>
                                <td>{{$text04}}</td>
                            </tr>
                        @endfor
                        @for ($x=$num;$x<$count_charts;$x++)
                            <tr>
                                <td>

                                    @if(isset($charts[$x]))
                                        <img src="data:image/png;base64, {{$charts_img[$x]}}" class="img-pdf">
                                        @php
                                            $x++;
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($charts[$x]))
                                        <img src="data:image/png;base64, {{$charts_img[$x]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$x]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $x++;
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($charts[$x]))
                                        <img src="data:image/png;base64, {{$charts_img[$x]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$x]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $x++;
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($charts[$x]))
                                        <img src="data:image/png;base64, {{$charts_img[$x]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$x]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $x++;
                                        @endphp
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    @else
                        @php
                            if(isset($ii)){
                                $num = $ii;
                            }else{
                                $num = 0;
                            }
                        @endphp
                        @for ($x=$num;$x<$count_charts;$x++)
                            <tr>
                                <td>
                                    @if(isset($charts[$x]))
                                        <img src="data:image/png;base64, {{$charts_img[$x]}}" class="img-pdf">
                                        @php
                                            $x++;
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($charts[$x]))
                                        <img src="data:image/png;base64, {{$charts_img[$x]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$x]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $x++;
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($charts[$x]))
                                        <img src="data:image/png;base64, {{$charts_img[$x]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$x]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $x++;
                                        @endphp
                                    @endif
                                </td>
                                <td>
                                    @if(isset($charts[$x]))
                                        <img src="data:image/png;base64, {{$charts_img[$x]}}" class="img-pdf">
                                        {{-- <img src="{{url("")}}/public/images/chart/{{$charts[$x]}}.jpg" class="img-pdf"> --}}
                                        @php
                                            $x++;
                                        @endphp
                                    @endif
                                </td>
                            </tr>
                        @endfor
                    @endif
                </table>
            </div>
        @endif
    @endif
</body>
</html>
