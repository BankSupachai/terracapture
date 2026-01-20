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
            padding: 10px;
        }
        table{
            width: 100%;
        }
        .head tr td:last-child{
            font-size:large;
            line-height: 16px !important;
        }
        .head tr td img{
            margin-top: 15px;
            width: 120px;
            margin-right: 5px;
        }
        .head tr td:last-child{
            text-align: center;
        }
        .head tr td:first-child{
            width: 35%;
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
        .table_body tr td{
            line-height: 14px;
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
    </style>
</head>
<body>
<table  class="head">
    <tr>
        <td rowspan="4" class="vb">
            <img src="{{fileconfig($hospital->hospital_pic)}}" alt="">
        </td>
        <td><b>Division Of Maternal Fetal Medicine</b></td>
    </tr>
    <tr>
        <td>Department of Obstetrics and Gynaecology</td>
    </tr>
    <tr>
        <td>Ramathododi Hospital</td>
    </tr>
    <tr>
        <td>Rama VI Road, Bangkok, Thailand 10400</td>
    </tr>
    <tr>
        <td colspan="2" class="text-center"><b>Second Trimester Ultrasound</b></td>
    </tr>
</table>
{{-- <br> --}}
<table class="table_body">
    <tr>
        <td>Patient</td>
        <td>: {{@$case->prefix}} {{@$case->firstname}} {{@$case->middlename}} {{@$case->lastname}}</td>
    </tr>
    <tr>
        <td>Patient ID</td>
        <td>: {{@$case->hn}}</td>
    </tr>
    <tr>
        <td>Exam date</td>
        <td>: {{date('d/m/Y')}}</td>
    </tr>
</table>
{{-- <br> --}}
<table class="table_body">
    <tr>
        <td class="text-blue vt">Indication</td>
        <td>{{@$json->indication}}</td>
    </tr>
    <tr>
        <td class="text-blue vt">Method</td>
        <td>{{@$json->history}}</td>
    </tr>
    <tr>
        <td class="text-blue vt">Pregnancy</td>
        <td>Singleton pregnacy. Number of fetuses: {{@$json->number_of_fetuses}}</td>
    </tr>
    <tr>
        <td class="text-blue vt">Dating</td>
        <td>
            <table class="table-line">
                <tr>
                    <td></td>
                    <td class="text-center"><b>Date</b></td>
                    <td class="text-center"><b>Details</b></td>
                    <td class="text-center"><b>Gest. age</b></td>
                    <td class="text-center"><b>EDD</b></td>
                </tr>
                <tr>
                    <td class="text-right">External<br>assessment</td>
                    <td></td>
                    <td></td>
                    <td class="text-center">16 w + 5 d</td>
                    <td class="text-center">{{date('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td class="text-right">U/S</td>
                    <td class="text-center">{{date('d/m/Y')}}</td>
                    <td>based upon BPD, HC, AC, Femur</td>
                    <td class="text-center">16 w + 4 d</td>
                    <td class="text-center">{{date('d/m/Y')}}</td>
                </tr>
                <tr>
                    <td class="text-right"><b>Agreed<br>dating</b></td>
                    <td colspan="2"><b>based on the external assessment</b></td>
                    <td class="text-center"><b>16 w + 4 d</b></td>
                    <td class="text-center"><b>{{date('d/m/Y')}}</b></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="text-blue vt">General</td>
        <td><b>Cardiac activity</b> present. FHR 149 bpm. <b>Fetal movements:</b> present. <b>Presentation:</b> breech</td>
    </tr>
    <tr>
        <td class="text-blue vt">Evaluation</td>
        <td>
            <b>Placenta:</b> anterior
            <br>
            <b>Umbilical cord:</b> normal, 3 vessel cord
            <br>
            <b>Amniotic fluid:</b> Normal amount
        </td>
    </tr>
    <tr>
        <td class="text-blue vt">Fetal Biometry</td>
        <td>
            <table class="table-border">
                <tr>
                    <td>BPD</td>
                    <td class="text-right">34.20</td>
                    <td>mm</td>
                    <td class="text-center">16w 4d</td>
                    <td>41%</td>
                    <td>AC</td>
                    <td class="text-right">108.30</td>
                    <td>mm</td>
                    <td class="text-center">16w 5d</td>
                    <td class="text-center">50%</td>
                </tr>
                <tr>
                    <td>OFD</td>
                    <td class="text-right">45.9</td>
                    <td>mm</td>
                    <td class="text-center">16w 0d</td>
                    <td>33%</td>
                    <td>Femur</td>
                    <td class="text-right">20.50</td>
                    <td>mm</td>
                    <td class="text-center">15w 1d</td>
                    <td class="text-center">22%</td>
                </tr>
                <tr>
                    <td>HC</td>
                    <td class="text-right">128.40</td>
                    <td>mm</td>
                    <td class="text-center">16w 4d</td>
                    <td>29%</td>
                    <td>Humerus</td>
                    <td class="text-right">19.80</td>
                    <td>mm</td>
                    <td class="text-center"></td>
                    <td class="text-center">9%</td>
                </tr>
                <tr>
                    <td>Cerebellum</td>
                    <td class="text-right">17.40</td>
                    <td>mm</td>
                    <td class="text-center"></td>
                    <td>93%</td>
                    <td>HC / AC</td>
                    <td class="text-right">1.9</td>
                    <td></td>
                    <td class="text-center"></td>
                    <td class="text-center">44%</td>
                </tr>
                <tr>
                    <td class="10">tr</td>
                </tr>
                <tr>
                    <td>Nuchai fold</td>
                    <td class="text-right">2.72</td>
                    <td colspan="8">mm</td>
                </tr>
            </table>
            <b>Fetal Weight Calculation:</b>
            <table class="table-border">
                <tr>
                    <td>EFW</td>
                    <td class="text-right">157</td>
                    <td>g</td>
                    <td class="text-center">16w 2d</td>
                    <td class="text-center">26%</td>
                    <td>EFW by</td>
                    <td class="w-35">Hadlock (BPD-HC-AC-FL)</td>
                </tr>
            </table>
            <b>Head / Face / Neck Biometry</b>
            <table class="table-border">
                <tr>
                    <td>BPD / OFD</td>
                    <td class="text-right">0.7</td>
                    <td>mm</td>
                    <td class="text-center">&nbsp;</td>
                    <td>7%</td>
                    <td>CM</td>
                    <td class="text-right">3.2</td>
                    <td>mm</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">19%</td>
                </tr>
                <tr>
                    <td>Vp</td>
                    <td class="text-right">7.04</td>
                    <td colspan="8">mm</td>
                </tr>
                <tr>
                    <td>Inner IOD</td>
                    <td class="text-right">11.3</td>
                    <td colspan="8">mm</td>
                </tr>
            </table>
            <b>The following structures appear normal :</b>
            <br>
            <b>Head / Neck</b> Cranium. Lateral ventricles. Choroid plexus. Midline falx. Cavum septi pellucidi,
            <br>
            {{nbsp(18)}} Cerebellum. Cisterna magna
            <br>
            <b>Face</b>{{nbsp(11)}} Lips. Profile. Nose
            <br>
            <b>Heart / Thorax4</b>-chamber view. RVOT View. LVOT view. 3-vessel view. 3-Vessl-trachea view.
            <br>
            <b>Abdomen</b>{{nbsp(4)}}Cord insertion. Stomach. Kidneys. Bladder. Genitals.
            <br>
            <b>Spine</b>{{nbsp(11)}}Cervical spine. Thoracic spine. Lumbar Spine. Sacral spine.
            <br>
            <b>Extremities /</b> Arms. Hands. Legs. Feet.
            <br>
            <b>Skeleton</b>
            <br>
            <br>
            <b>Impression :</b> No obvious fetal defect.
        </td>
    </tr>
    <tr>
        <td class="text-blue vt">Fetal Doppler</td>
        <td>
            <table class="table-border">
                <tr>
                    <td colspan="10"><b>Ductus Venosus:</b></td>
                </tr>
                <tr>
                    <td>S-wave</td>
                    <td class="text-right">-36.96</td>
                    <td>cm/s</td>
                    <td class="text-center">&nbsp;</td>
                    <td>PLI</td>
                    <td>&nbsp;</td>
                    <td class="text-right">0.76</td>
                    <td>&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="table_body">
    <tr>
        <td class="text-blue vt"></td>
        <td>
            <table class="table-border">
                <tr>
                    <td>S-Wave</td>
                    <td class="text-right">-34.64</td>
                    <td>cm/s</td>
                    <td class="text-center">&nbsp;</td>
                    <td>S/a</td>
                    <td>&nbsp;</td>
                    <td class="text-right">4.10</td>
                    <td>&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                </tr>
                <tr>
                    <td>A-wave</td>
                    <td class="text-right">-9.01</td>
                    <td>cm/s</td>
                    <td class="text-center">&nbsp;</td>
                    <td>a/S</td>
                    <td>&nbsp;</td>
                    <td class="text-right">0.24</td>
                    <td>&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                </tr>
                <tr>
                    <td>TAmax</td>
                    <td class="text-right">-29.18</td>
                    <td>cm/s</td>
                    <td class="text-center">&nbsp;</td>
                    <td>D/a</td>
                    <td>&nbsp;</td>
                    <td class="text-right">3.84</td>
                    <td>&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                </tr>
                <tr>
                    <td>PIV</td>
                    <td class="text-right">0.96</td>
                    <td></td>
                    <td class="text-center">&nbsp;</td>
                    <td>HR</td>
                    <td>&nbsp;</td>
                    <td class="text-right">144</td>
                    <td>bpm</td>
                    <td class="text-center">&nbsp;</td>
                    <td class="text-center">&nbsp;</td>
                </tr>
                <tr>
                    <td>PVIV</td>
                    <td class="text-right">0.81</td>
                    <td colspan="8"></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td class="text-blue vt">Invasive</td>
        <td>
            <b>Amio-</b>{{nbsp(11)}}Start 10:00. End 10:25
        </td>
    </tr>
    <tr>
        <td class="text-blue vt">Procedures</td>
        <td>
            <b>centesis</b>{{nbsp(8)}}Instrument: TA 20G needle. Insertion site: lower abdomen mid. Method:
            <br>
            {{nbsp(20)}}transplacental. Entries uterus: 2
            <br>
            {{nbsp(20)}}Sample: obtained. Sample amount 15 ml. Sample quality: clear yellow
            <br>
            {{nbsp(20)}}<b>1st attempt contaminated blood</b>
            <br>
            {{nbsp(20)}}<b>2st attempt clear AF</b>
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <b>Lab request</b>{{nbsp(2)}}Karyotyping
            <br>
            <b>Evaluation</b>{{nbsp(4)}}Post cardiac activity: present, normal. FHR post 157 bpm
        </td>
    </tr>
    <tr>
        <td class="text-blue vt">Impression</td>
        <td>Growth and anatomy survey appears normal.</td>
    </tr>
    <tr>
        <td class="text-blue vt">Follow-up</td>
        <td>Repeat evaluation for fetal growth assessment and anatomy survey is recommended</td>
    </tr>
</table>
<table>
    <tr>
        <td>
            <ul>
                <li>Ultrasound cannot exclude all chromosomal or genetic abnormalities in the fetus.</li>
                <li>Some congenital malformations may be missed durung the scan, even with high quality sonographic equipment in the best of hands.</li>
                <li>Some fetal abnormalities may develop later in pregnacy.</li>
                <li>Visualisation of fetal structures may be limited by the following sub-optimal scanning conditions - maternal adiposity, scarring of abdominal wall,<br>reduced liquor volume, fetal activity and fetal position.</li>
            </ul>
        </td>
    </tr>
</table>
    @if(isset($charts))
        <table id="tb_chart">
            @for ($i=0;$i<count($charts);$i++)
            <tr>
                <td>
                    <img src="{{url("public/images/chart/$charts[$i].jpg")}}" class="chart">
                </td>

                <td>
                    @if(isset($charts[$i+1]))
                        <img src="{{url("public/images/chart/$charts[$i++].jpg")}}" class="chart">
                    @endif
                </td>
                <td>
                    @if(isset($charts[$i+1]))
                        <img src="{{url("public/images/chart/$charts[$i++].jpg")}}" class="chart">
                    @endif
                </td>
            </tr>
            @endfor
        </table>
    @endif
</body>
</html>
