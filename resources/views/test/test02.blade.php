<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
       
        body {
            font-family: "THSarabunNew";
        }
        .text-right{
            text-align: right;
        }
        table{
            width: 100%;
        }
        .w80{
            width: 75%;
        }
        .text-center{
            text-align: center;
        }
        br{
            margin: 0;
        }
        .box-s{
            /* position: absolute; */
            width: 15px;
            height: 15px;
            border: 1px solid black;
            margin-top: 5px;
        }
        .pl-5{
            padding-left: 5px;
        }
        .pl-25{
            padding-left: 25px;
        }
        tr{
            line-height: 13px;
        }
        .tb-image-top{
            width: 2.5cm;
            height: 2.5cm;
            border: 1px solid black;
        }
        .dot{
            border-bottom: 1px dotted black;
        }
        .vtn{
            vertical-align: bottom;
        }
        .vtc{
            vertical-align: middle;
        }
        .vtt{
            vertical-align:top;
        }
        .w-fit{
            white-space: nowrap;
            width: fit-content;
        }
        .w-50{
            width: 50%;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
        }
        .border-bottom{
            border-bottom: 1px solid gray;
        }
        #footer{
            position: absolute;
            bottom: 37px;
        }
        .page-break {
            page-break-after: always;
        }
        .garp-dot{
            border-left: 1px dotted gray;
        }
        .garp-solid{
            border-bottom: 1px solid gray;
        }
        .pt-1em{
            padding-top: 13px;
        }
        .left-garp{
            position: absolute;
            left: 10px;
            margin-top: 7px;
        }
        .pt-3{
            padding-top: 22px;
        }
        .w-1{
            width: 5px;
        }
        .text-right{
            text-align: right !important;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td class="w80"></td>
            <td><img src="data:image/png;base64,{{DNS1D::getBarcodePNG("45846256", "C128")}}" alt="barcode"/></td>
        </tr>
        <tr>
            <td class="w80"></td>
            <td class="text-center">45846256</td>
        </tr>
    </table>

    <table>
        <tr>
            <td>สถานที่ตรวจ : (26)คลินิกระงับปวด อาคาร 10 ชั้น</td>
            <td rowspan="6" class="text-center">
                <img src="{{url('public/image/avatar.png')}}" class="tb-image-top">
            </td>
            <td>สิทธิ์ค่ารักษา() บัตรทอง รพ.อื่น</td>
        </tr>
        <tr>
            <td>โทร....02-4197842....</td>
            <td>คำวินิจฉัยโรค................</td>
        </tr>
        <tr>
            <td>วันที่ {{date('d/m/')}}{{date('Y')+543}} ({{date('H:i น.')}}) {{nbsp(3)}} HN {{rand(10000000,99999999)}}</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>นาย สุรเชษฐ ช่างพานิช</td>
            <td></td>
        </tr>
        <tr>
            <td>อายุ 47.0.14 (14/03/2518) เพศ ชาย</td>
            {{-- <td></td> --}}
            <td>น้ำหนัก............กิโลกรัม {{nbsp(3)}} BP............mmHg</td>
        </tr>

    </table>
    <table>
        <tr>
            <td>
                ประวัติแพ้ยา
                <table>
                    <tr>
                        <td>
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            ไม่มี
                        </td>
                        <td>
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            มี
                        </td>
                    </tr>
                </table>
            </td>
            <td class="w80 vtc"><div class="dot"></div></td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="w-50"><h1>Procedural Intervention</h1></td>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">Inverventionist Fellow</td>
                        <td class="vtn"><div class="dot"></div></td>
                        <td class="w-fit">Staff</td>
                        <td class="vtn"><div class="dot"></div></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="text-center w-50" rowspan="8"><img src="{{url("public/images/test.png")}}" alt="" class="w80"></td>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">Diagnosis</td>
                        <td class="vtn"><div class="dot"></div></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">Planed Procedure</td>
                        <td class="vtn"><div class="dot"></div></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">Actual Procedure</td>
                        <td class="vtn"><div class="dot"></div></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">Side</td>
                        <td class="vtn"><div class="dot"></div></td>
                        <td class="w-fit">Level</td>
                        <td class="vtn"><div class="dot"></div></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit"><font class="border-bottom">Safety Pause</font> by</td>
                        <td class="vtn"><div class="dot"></div></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">{{nbsp(5)}}</td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            ผู้ป่วยพูดชื่อ - นามสกุล
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">{{nbsp(5)}}</td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            ตำแหน่ง, ข้างที่มีอาการปวด แพทย์
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="w-fit">mark side</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            Consent
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Allergy
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Anticoagulant N/Y ชื่อยา
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            ตั้งครรภ์ Y/N
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            NPO
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            hr.
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="pl-5 w-fit">
                            หยุดยา N/Y เมื่อ
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            มีคนพากลับบ้าน
                        </td>
                    </tr>
                </table>
            </td>
            <td colspan="2">
                <table>
                    <tr>
                        <td class="pl-5 w-fit">
                            Specific concern
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2"><font class="border-bottom">Technique and Procedure</font></td>
        </tr>
    </table>
    <table>
        <tr>
            <td>Technique</td>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            Fluoroscopy
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            Ultrasound guidance
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5">
                            Anatomical Landmark
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Agents</td>
            <td colspan="3">
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Local anesthetic {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            % Lidocaine {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            % Bupivacaine {{nbsp(3)}}
                        </td>
                        <td class="pl-5 w-fit">
                            Volume
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            ml
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Steroid
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="w-fit">
                            {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            neurolytic agent
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="w-fit">
                            {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Other
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Radiofrequency
                        </td>
                        <td class="w-fit">
                            {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Thermal
                        </td>
                        <td class="w-fit">
                            {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Pulsed
                        </td>
                        <td class="w-fit">
                            {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            temp
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="w-fit">
                            {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            duration
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="w-fit">
                            {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            cycles
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <table>
                    <tr>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            Needle
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Findings</td>
            <td colspan="3">
                <table>
                    <tr>
                        <td class="w-fit">
                            :
                        </td>
                        <td class="pl-5 w-fit">
                            Structural
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            normal
                        </td>
                        <td class="w-fit">
                            {{nbsp(3)}}
                        </td>
                        <td class="w-fit">
                            <div class="box-s"></div>
                        </td>
                        <td class="pl-5 w-fit">
                            abnormal
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <table>
                    <tr>
                        <td class="w-fit">
                            :
                        </td>
                        <td class="pl-5 w-fit">
                            Difficulty N/Y
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <table>
                    <tr>
                        <td class="pl-5 w-fit">
                            Immediate effects and complications
                        </td>
                        <td class="vtn">
                            <div class="dot"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td class="pl-5 w-fit">
                            Note
                        </td>
                        <td>
                            :
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table id="footer">
        <tr>
            <td class="text-center w-fit vtt">
                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG('9999999999', "C128")}}" alt="barcode" /><br>9999999999
            </td>
            <td></td>
            <td class="w-50 vtt">
                <img src="data:image/png;base64,{{DNS1D::getBarcodePNG("45461654987946545fds", "C128")}}" alt="barcode" class="w-100"/>
            </td>
        </tr>
    </table>
    <div class="page-break"></div>
    <table>
        <tr>
            <td><font class="border-bottom">Pain assessment</font>{{nbsp(5)}} Numerice rating scale (NRS) : If 0 = no pain, 10 = worst possible pain</td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td class="text-center w-50">at rest</td>
            <td class="text-center w-50 pl-25">on movement <font class="border-bottom">{{nbsp(50)}}</font></td>
        </tr>
    </table>
    <table >
        <tr>
            <td>
                <table >
                    @for ($i=10;$i>=0;$i--)
                    <tr class="pr">
                        <td class="w-fit"><div class="left-garp">{{$i}}</div></td>
                        <td class="@if($i!=0) garp-solid @endif">&nbsp;</td>
                        <td class="garp-dot @if($i!=0) garp-solid @endif"></td>
                        <td class="garp-dot @if($i!=0) garp-solid @endif"></td>
                        <td class="garp-dot @if($i!=0) garp-solid @endif"></td>
                        <td class="@if($i!=0)garp-solid @endif"></td>
                    </tr>
                    @endfor
                    <tr>
                        <td></td>
                        <td class="text-right">pre</td>
                        <td class="text-right">immediate post</td>
                        <td class="text-right">1 h post</td>
                        <td class="text-right">before</td>
                        <td></td>
                    </tr>
                </table>
            </td>

            <td>
                <table>
                    @for ($i=10;$i>=0;$i--)
                    <tr class="pr">
                        <td class="w-fit">{{$i}}</td>
                        {{-- <td class="w-fit"><div class="left-garp">{{$i}}</div></td> --}}
                        <td class="@if($i!=0) garp-solid @endif">&nbsp;</td>
                        <td class="garp-dot @if($i!=0) garp-solid @endif"></td>
                        <td class="garp-dot @if($i!=0) garp-solid @endif"></td>
                        <td class="garp-dot @if($i!=0) garp-solid @endif"></td>
                        <td class="@if($i!=0)garp-solid @endif"></td>
                    </tr>
                    @endfor
                    <tr>
                        <td></td>
                        <td class="text-right">pre</td>
                        <td class="text-right">immediate post</td>
                        <td class="text-right">1 h post</td>
                        <td class="text-right">before</td>
                        <td></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br><br><br><br>
    <table>
        <tr>
            <td class="pl-5 w-fit">
                Plan of management
            </td>
            <td class="vtn">
                <div class="dot"></div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="pl-5 w-fit">
                Home Medication
            </td>
            <td class="vtn w-fit">
                <div class="dot">{{nbsp(20)}}</div>
            </td>
            <td class="w-fit">
                {{nbsp(3)}}
            </td>
            <td class="w-fit">
                <div class="box-s"></div>
            </td>
            <td class="pl-5 w-fit">
                RM to
            </td>
            <td class="vtn">
                <div class="dot"></div>
            </td>
            <td class="w-fit">
                {{nbsp(3)}}
            </td>
            <td class="w-fit">
                <div class="box-s"></div>
            </td>
            <td class="pl-5 w-fit">
                Drug
            </td>
            <td class="vtn">
                <div class="dot"></div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="pl-5 w-fit">
                Follow up
            </td>
            <td class="vtn">
                <div class="dot"></div>
            </td>
            <td class="pl-5 w-fit">
                Pain Diary Y/N
            </td>
        </tr>
    </table>
</body>
</html>
