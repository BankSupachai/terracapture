@php
    $view33['casedata']       = $casedata;
    $view33['hospital']       = $hospital;
    $view33['doctor']         = $doctor;
    $view33['doctor01']       = $doctor01;
    $view33['nurse']          = $nurse;
    $view33['totaltime']      = $totaltime;
    $view33['scopeall']       = $scopeall;
    $view33['folderdate']     = $folderdate;
    $view33['mmm']  = "mmm";
@endphp
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    @page {
        margin-top: 200px;
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 70px;
    }
    header {
        position: fixed;
        margin-top: -190px;
        top: 0px;
        left: 0px;
        right: 0px;
        /* font-weight: bold; */
    }
    @font-face {
        font-family: 'Kanit';
        src: url("{{ public_path('fonts/Kanit-Regular.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }
    @font-face {
        font-family: 'Kanit_semibold';
        src: url("{{ public_path('fonts/Kanit-SemiBold.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }
    body {
        font-family: "Kanit";
        font-size: 11px;

    }


    right_menu{
        position: fixed;
        top:0px;
        right: 0px;
        padding: 0px;
        font-weight: bold;
    }
    footer {
        position: fixed;
        margin-bottom: 0;
        bottom: 0;
        left: 2em;
        right: 2em;
        height: 50px;
        line-height: 35px;
    }
    .f-900{
        font-family: "Kanit_semibold";
        font-weight: 190 !important;
    }
    #left_menu table:nth-child(2) tr{
        line-height: 5px;
    }
    #left_menu table:nth-child(2) tr td table tr{
        line-height: 5px;
    }
    #left_menu table tr td,#left_menu table tr td table tr td {
        border: 1px solid #fff;
        vertical-align: top !important;
        /* line-height: 0.5em !important; */
    }
    .w-100{
        width: 100%;
    }
    .text-right{
        text-align: right;
    }
    .mt-5{
        margin-top: 2em;
    }

    .menu-accessory{
        width: 100%;
        border-collapse: collapse;
    }
    .menu-accessory, .menu-accessory td, .menu-accessory th{
        border: 1px solid rgb(179, 178, 178) !important;
    }
    .menu-accessory td{
        line-height: 14px !important;
        font-size: 14px !important;
        padding-left: 2em;
        padding-right: 2em;
    }
</style>
    </head>
<body>


    <header>
        @php
            $head = configTYPE('pdf','pdf_folder_head');
        @endphp
        @component("pdfhead.$head.pdf_head01",$view33)@endcomponent
    </header>
    <main>
            {{-- <right_menu style="left: {{$right_page}};padding-left:1em;">
                @component('endocapture.pdf.component.right_section.procedure_new',$view33)@endcomponent
            </right_menu> --}}

            <div id="left_menu" style="padding:0em 2em;width:100%;height: 700px;">

                <table class="w-100 mt-5 menu-accessory">
                    <tr>
                        @isset($json->righttotreatment)
                            <td colspan="3">สิทธิการรักษา : {{$json->righttotreatment}}</td>
                        @else
                            <td colspan="3">สิทธิการรักษา : - </td>
                        @endisset
                    </tr>
                </table>
                <br>


                @php

                $arr = array();

                // $json       = jsonEncode($arr);
                // $hn         = "12548001";
                // $pre_reqno  = "64021555";
                // $date       = date('YmdHi');

                $case       = DB::table('tb_case')->where('case_id',$casedata->case_id)->first();
                $data       = jsonDecode($case->case_json);

                $pre_reqno  = date('Y')."000001";
                $keyinuser  = DB::table('users')->where('id',$data->useropencase)->first();
                $doctor     = DB::table('users')->where('id',$case->case_physicians01)->first();
                $dateapp    = str_replace(" ","T",$case->case_dateappointment).".000";
                $dateregis  = str_replace(" ","T",$case->case_dateregister).".000";

                // dd($case,$data);

                $arr = array();
                $arr['OPERATION']['hn']             = $case->case_hn;
                $arr['OPERATION']['visit']          = "";
                $arr['OPERATION']['pre_reqno']      = $pre_reqno;
                $arr['OPERATION']['keyin_datetime'] = $dateregis;
                $arr['OPERATION']['REQ_datetime']   = $dateapp;
                $arr['OPERATION']['ORSTATUS']       = "NW";
                $arr['OPERATION']['MAINDOCC']       = $doctor->user_code;
                $arr['OPERATION']['keyin_user']     = $keyinuser->user_code;
                $arr['OPERATION']['START_DATE']     = $dateapp;
                $arr['OPERATION']['END_DATE']       = $dateapp;

                if(isset($data->billingicd9)){
                    $i=0;
                    $tb_procedureicd9 = DB::table('tb_procedureicd9')->wherein('proicd9_id',$data->billingicd9)->get();
                    $count = count($tb_procedureicd9);
                    foreach($tb_procedureicd9 as $minor){
                            $arr['MINOR'][$i]['ORCODE']         = $minor->icd9;             //  "ORCODE": "45161GI",                            --รหัส OPERATION
                            $arr['MINOR'][$i]['ORNAME']         = $minor->proicd9_name;
                            $arr['MINOR'][$i]['ORPRICE']        = $minor->icd9_billprice;   //  "ORPRICE":3500 ,                                --ราคา
                            $arr['MINOR'][$i]['REQSIDE']        = 0;                        //  "REQSIDE":'0'  ,                                --0 ไม่ระบุข้าง , 1 ข้างซ้าย ม2 ข้างขวา , 3 ทั้งสองข้าง
                        $i++;
                    }

                }else{

                }

                if(isset($data->billing_accessory)){
                    $i=0;
                    foreach($data->billing_accessory as $bill){
                        $arr['BILL'][$i]['pre_reqno']       = $pre_reqno;                               //  "pre_reqno"     :"6400001",                     -- YY+running 5 หลัก, ปี2หลัก+XXXXX
                        $arr['BILL'][$i]['keyin_datetime']  = $dateregis;                               //  "keyin_datetime":"2021-07-01T08:00:00.000",     -- วันที่คีย์ข้อมูล
                        $arr['BILL'][$i]['keyin_user']      = $keyinuser->user_code;                    //  "keyin_user"    :"45760" ,                      -- userที่ทำรายการ
                        $accessory = DB::table('accessory')->where('accessory_id',$bill[0])->first();
                        if($accessory!=null){
                            $arr['BILL'][$i]['PRDCODE']         = $accessory->accessory_code;           //  "PRDCODE"       :"A001" ,                       -- รหัสกิจกรรม
                            $arr['BILL'][$i]['PRDNAME']         = $accessory->accessory_name;

                            $arr['BILL'][$i]['PRDPRICE']        = $bill[2];                             //  "PRDPRICE"      :200 ,                          -- ราคารวม
                            $arr['BILL'][$i]['PRDQTY']          = $bill[1];                             //  "PRDQTY"        :"1" ,                          -- จำนวน
                        }else{
                            $arr['BILL'][$i]['PRDCODE']         = 0;                                    //  "PRDCODE"       :"A001" ,                       -- รหัสกิจกรรม
                            $arr['BILL'][$i]['PRDPRICE']        = 0;                                    //  "PRDPRICE"      :200 ,                          -- ราคารวม
                            $arr['BILL'][$i]['PRDQTY']          = 0;                                    //  "PRDQTY"        :"1" ,                          -- จำนวน
                        }
                        $i++;
                    }
                }


                if(isset($data->diagnostic)){
                    $i=0;
                    $tb_diagnostic = DB::table('tb_diagnostic')->wherein('diagnostic_name',jsonDecode($data->diagnostic))->get();

                    foreach($tb_diagnostic as $di){
                        $arr['DIAGNOSIS'][$i]['DIAG_DATE']  = $dateapp;                 // 	 "DIAG_DATE"    :"2021-07-03T09:00:00.000" ,    -- วันที่ลง DIAGNOSIS
                        $arr['DIAGNOSIS'][$i]['pre_reqno']  = $pre_reqno;               // 	 "pre_reqno"    :"6400001",                     -- YY+running 5 หลัก, ปี2หลัก+XXXXX
                        $arr['DIAGNOSIS'][$i]['doctor']     = $doctor->user_code;       // 	 "doctor"       :"45760" ,                      -- รหัสแพทย์
                        $arr['DIAGNOSIS'][$i]['ICDCODE']    = $di->icd10;               // 	 "ICDCODE"      :"D805" ,                       --
                        $arr['DIAGNOSIS'][$i]['DIAGTYPE']   = "I";                      // 	 "DIAGTYPE"     :"I" ,                          -- I ICD10,P  ICD9
                        $arr['DIAGNOSIS'][$i]['ICDEXTN']    = "";                       // 	 "ICDEXTN"      :"" ,                           -- รหัส icd EXTENION
                        $arr['DIAGNOSIS'][$i]['DIAGNOTE']   = "";                       // 	 "DIAGNOTE"     :"" ,                           -- note ของ DIAG
                        $arr['DIAGNOSIS'][$i]['keyin_user'] = $keyinuser->user_code;    // 	 "keyin_user"   :" 45760" ,                     -- userที่ทำการ DIAGNOSIS
                        $arr['DIAGNOSIS'][$i]['OPSTATUS']   = "A";                      // 	 "OPSTATUS"     :"B",                           -- Bก่อน  ผ่าตัด ม A หลังผ่าตัด
                        $i++;
                    }
                }

                $json   = jsonEncode($arr);
                // $date   = date('YmdHi');
                // $dir    = "D:\INBOX\\";
                // // $file = [hn]_[pre_reqno]_[yyyymmddmmnn].json
                // $filename = $case->case_hn."_".$pre_reqno."_".$date.".JSON";


                // $fp = fopen($dir.$filename, 'w');
                // fwrite($fp, $json);
                // fclose($fp);





                // function billicd99($case){
                //     $w[0] = array('procedure_code',$case->case_procedure);
                //     $w[1] = array('icd9_status',"main");
                //     $tb_procedureicd9   = DB::table('tb_procedureicd9')->where($w)->first();
                //     $arr['ORCODE']      = $tb_procedureicd9->icd9;
                //     $arr['ORPRICE']     = $tb_procedureicd9->icd9_billprice;
                //     return $arr;
                // }


            @endphp






                {{-- @dd($json) --}}

                <table class="w-100 menu-accessory">
                    <tr>
                        <td colspan="3">Operation</td>
                    </tr>
                    <tr>
                        <td>Code</td>
                        <td>Operation</td>
                        <td>Price</td>
                    </tr>
                    @php
                        $totalprice = 0;
                    @endphp

                    @isset($arr['MINOR'])
                        @foreach($arr['MINOR'] as $minor)
                        {{-- @dd($minor) --}}
                        <tr>
                            <td>{{@$minor['ORCODE']}}</td>
                            <td>{{@$minor['ORNAME']}}</td>
                            <td>{{@$minor['ORPRICE']}}</td>
                        </tr>
                        @php
                            $totalprice = $totalprice+$minor['ORPRICE'];
                        @endphp


                        @endforeach
                    @endisset


                    <tr>
                        <td colspan="3" class="text-right">Total {{$totalprice}}</td>
                    </tr>
                </table>


                <table class="w-100 mt-5 menu-accessory">





                    <tr>
                        <td colspan="5">Accessory</td>
                    </tr>

                    <tr>
                        <td>Code</td>
                        <td>Accessory</td>
                        <td>Price/Unit</td>
                        <td>Unit</td>
                        <td>Total</td>
                    </tr>
                    @php
                        $totalaccess = 0;

                        // $arr['BILL'][$i]['PRDCODE']         = $accessory->accessory_code;           //  "PRDCODE"       :"A001" ,                       -- รหัสกิจกรรม
                        //     $arr['BILL'][$i]['PRDPRICE']        = $bill[2];                             //  "PRDPRICE"      :200 ,                          -- ราคารวม
                        //     $arr['BILL'][$i]['PRDQTY']          = $bill[1];

                    @endphp

                    @isset($arr['BILL'])
                        @foreach ($arr['BILL'] as $bill)
                            @php
                                $totalaccess = $totalaccess+$bill['PRDPRICE'];
                                $piece = $bill['PRDPRICE']/$bill['PRDQTY'];
                            @endphp


                            <tr>
                                <td>{{$bill['PRDCODE']}}</td>
                                <td>{{$bill['PRDNAME']}}</td>
                                <td>{{$piece}}</td>
                                <td>{{$bill['PRDQTY']}}</td>
                                <td>{{$bill['PRDPRICE']}}</td>
                            </tr>


                        @endforeach
                    @endisset

                    <tr>
                        <td colspan="5" class="text-right menu-detail">Total {{$totalaccess}}</td>
                    </tr>
                </table>


                @php
                    $totalall = $totalaccess+$totalprice;
                @endphp



                <table class="w-100 mt-5 menu-accessory">
                    <tr>
                        <td  class="menu-detail">Total Billing  </td>
                        <td>{{$totalall}} Baht</td>
                    </tr>
                </table>


                {{-- <table class="w-100 mt-5 menu-accessory">
                    <tr>
                        <td colspan="3">คงเหลือ</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">รวม 0</td>
                    </tr>
                </table> --}}



            </div>


    </main>
    <footer> @component("pdfhead.$head.pdf_footer",$view33)@endcomponent </footer>
    {{-- @dd(111) --}}

</body>
</html>
