<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
    <script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
    <script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>
    <script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <title>Document</title>
    <style>
        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Regular.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-Bold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Italic.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-ExtraBoldItalic.ttf') }}") format("truetype");
        }

      *{
        font-size: 12px;
      }
        .fs-10 {
            font-size: 10px
        }

        .fs-8 {
            font-size: 8px;
        }

        .fs-12 {
            font-size: 12px;
        }

        @page {
            size: A4;
            margin: 0;
        }

        html,
        body {
            width: 210mm;
            /* height: 297mm; */
            padding: 10px 3px 10px 14px;

        }

        #table-pb>:not(caption)>*>* {
            padding: 7px;
            border: 0;
        }

        .report_lpm {
            font-size: 10px;
        }

        .lh-custom-head {
            line-height: 12px;
        }

        .lh-custom {
            line-height: 20px;
        }

        .form-check-input[type=checkbox] {
            background: #ffffff !important;
            border: 1px solid #000000;
        }

        .form-check-input:checked[type=checkbox] {
            background: #000000 !important;


        }

        .form-check-input[type=radio] {
            background: #ffffff !important;
            border: 1px solid #000000;
        }

        .form-check-input:checked[type=radio] {
            background: #000000 !important;
        }

        .form-check-input {
            margin-top: 0px;
        }

        .border_col{border : 1px solid;}
        .ps-custom{padding-left: 6.4em;}
        .table-lpm{
            line-height: 15px;
        }
    </style>
</head>

<body>


    <div class="row">
        <div class="col-8 text-center">
            <span class="fs-12">แบบบันทึกทางการพยาบาล</span>
        </div>
        <div class="col-4 text-center">
            <span class="report_lpm fw-bold fs-12">สติ๊กเกอร์ชื่อ</span>
        </div>
    </div>
    <div class="row">
        <div class="col-12 lh-custom-head px-0">
            <span class="report_lpm ">งานการพยาบาลตรวจรักษาพิเศษ แผนกการพยาบาลผู้ป่วยนอก
                กลุ่มภารกิจบริการวิชาการโรงพยาบาลมะเร็งลำปาง</span> <br>
            <span
                class="report_lpm ">วัน-เดือน-ปี..................Dx.....................................................................................
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    OPD
                </label>
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Ward ช/ญ
                </label>
                Bed...........
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    ICU Bed...........
                </label>
            </span>
                <table class="table table-bordered  w-100 table-lpm" border="1">
                    <tr height="">
                        <td width="10%" >
                            <input class="form-check-input" type="checkbox" id="formCheck1">
                            <label class="form-check-label" for="formCheck1">
                                Emergency
                            </label> <br>
                            <input class="form-check-input" type="checkbox" id="formCheck1">
                            <label class="form-check-label" for="formCheck1">
                                Elective
                            </label>
                        </td>
                        <td width="30%">
                            <input class="form-check-input" type="checkbox" id="formCheck1">
                            <label class="form-check-label" for="formCheck1">
                                EGD &ensp; &ensp; &ensp;
                            </label>
                            Start{{ printdot(10) }} End{{ printdot(10) }} <br>
                            <input class="form-check-input" type="checkbox" id="formCheck1">
                            <label class="form-check-label" for="formCheck1">
                                Colono &ensp; &ensp;
                            </label>
                            Start{{ printdot(10) }} End{{ printdot(10) }}
                        </td>
                        <td width="10%">Vital sign <br>
                            Time {{printdot(10)}}น.
                        </td>
                        <td>T{{ printdot(10) }} <sup>.</sup>C , PR {{ printdot(10) }}ครั้ง /min, RR{{ printdot(10) }}ครั้ง/min,O2sat{{ printdot(10) }} <br>
                            BP(1){{ printdot(10) }}/{{ printdot(10) }}mm.Hg., BP(2){{ printdot(10) }}/{{ printdot(10) }}mmHg.
                        </td>
                        <td width="10%">BW{{ printdot(10) }}Kgs. <br>
                            Ht{{ printdot(10) }}Cms.
                        </td>
                    </tr>

                </table>

            <div class="mb-2 mt-2" style="padding-left: 1em;">
                <span class="report_lpm">แพทย์.............</span>
                <span class="report_lpm">Assistant{{ printdot(17) }}/{{ printdot(17) }}Scrub nurse
                    {{ printdot(17) }}Circulate {{ printdot(17) }}Anesthesiologist {{ printdot(17) }} Nurse
                    Anesthesiologist {{ printdot(40) }} </span>
            </div>


        </div>
    </div>

    <div class="row">
        <div class="col-4 border_col">
            <span class=" fw-bold">
                กิจกรรมพยาบาลก่อนการส่องตรวจ <br>
                1. การเตรียมด้านร่างกาย
            </span>
            <div class="row  ps-2 lh-custom">
                <div class="col-12 ">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        ถามชื่อ-สกุล
                    </label>
                    <input class="form-check-input    " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        เซ็นใบยินยอม
                    </label>
                </div>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        ฟันปลอม
                    </label>
                    <input class="form-check-input   " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        ไม่มี
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label " for="formCheck1">
                        มี {{ printdot(25) }}
                    </label>
                </div>
                <div class="col-12">
                    <input class="form-check-input" type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        เครื่องประดับ
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        ไม่มี
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label " for="formCheck1">
                        มี {{ printdot(20) }}
                    </label>
                </div>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        ทาเล็บมือ-เล็บเท้า/แต่งหน้า {{ printdot(19) }}
                    </label>
                </div>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        ประวัติการผ่าตัด{{ printdot(36) }}
                    </label> <br>
                    {{ printdot(62) }} <br>
                    {{ printdot(72) }}
                </div>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        โรคประจำตัว
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        No
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label " for="formCheck1">
                        Yes
                    </label>
                </div>
            </div>
            <div class="row ">
                <div class="col-12">
                    <input class="form-check-input " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        HT {{ printdot(64) }}
                    </label>
                    {{ printdot(74) }}
                </div>
                <div class="col-12">
                    <input class="form-check-input " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        DM {{ printdot(64) }}
                    </label>
                    {{ printdot(74) }}

                </div>
                <div class="col-12">
                    <input class="form-check-input " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        โรคหัวใจ {{ printdot(56) }}
                    </label>
                    {{ printdot(74) }}

                </div>
                <div class="col-12">
                    <input class="form-check-input " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        อื่นๆ {{ printdot(63) }}
                    </label>
                    {{ printdot(74) }} <br>
                    {{ printdot(74) }}


                </div>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        แพ้ยา/แพ้อาหาร {{ printdot(46) }}
                    </label>
                </div> <br>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        ประวัติการใช้ยา  <br>
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        Aspirin
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label " for="formCheck1">
                        Warfarin
                    </label>
                </div>
                <div class="col-12 ps-3">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        ทานยาต่อเนื่อง
                    </label><br>
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        งด ตั้งแต่  {{ printdot(25) }} ถึง  {{ printdot(25) }}
                    </label>
                </div>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        การทานยาระบาย  <br>
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        swiff
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label " for="formCheck1">
                        Niflec
                    </label>
                </div>
                <div class="col-12 text-center ps-custom">

                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        หมด
                    </label>
                    <input class="form-check-input     " type="radio" id="formCheck1">
                    <label class="form-check-label " for="formCheck1">
                        ไม่หมด
                    </label>
                </div>
                <div class="col-12">
                    หมายเหตุ {{printdot(60)}}
                </div>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        การเตรียม Bowel gr. 1&ensp; &ensp; 2 &ensp; &ensp; 3 &ensp; &ensp; 4
                    </label>
                </div>
                <div class="col-12">
                    <input class="form-check-input " type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                    NPO เวลา {{printdot(55)}}
                    </label>

                </div>
                <div class="col-12">
                    2. อธิบายขั้นตอนการส่องตรวจโดย แผ่นพลิก<br>
                    3. การเตรียมด้านจิตใจ อารมณ์และสังคม <br>
                    &ensp; &ensp; สังเกตอาการ ความวิตกกังวล
                </div>
                <div class="col-12 mt-2">  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp; &ensp;&ensp;
                    <input class="form-check-input" type="checkbox" id="formCheck1">
                    <label class="form-check-label" for="formCheck1">
                        มี
                    </label>  &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                    <input class="form-check-input" type="checkbox" id="formCheck1">
                    <label class="form-check-label " for="formCheck1">
                        ไม่มี
                    </label>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;
                </div>
                <div class="col-12 ">
                    <u>แก้ไข</u> โดยการพูดคุย
                    เปิดโอกาสให้ซักถามเพื่อ <br>
                    ผ่อนคลายความวิตกกังวล
                </div>
                <div class="col-12">
                    4. เตรียมเครื่องมือ/อุปกรณ์การส่องตรวจ <br>
                    พร้อมใช้ <br>
                    CC {{printdot(69)}}
                    {{printdot(74)}} <br>
                    {{printdot(74)}} <br>
                    {{printdot(74)}} <br>

                </div>
        </div>
    </div>
    <div class="col-4 border_col report_detail lh-custom " >
        <span class=" fw-bold">
            กิจกรรมพยาบาลขณะส่องตรวจ
        </span>
        <div class="col-12 fw-bold ">
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                ถามชื่อ-สกุล
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                สอบถามหัตถการ
            </label>
        </div>
        <div class="col-12 ">
            1. EGD V/S: BP {{printdot(10)}}/{{printdot(10)}} mmHg. <br>
            PR{{printdot(10)}}ครั้ง/min, RR{{printdot(10)}}ครั้ง/min, O<sub>2</sub>sat{{printdot(10)}}% <br>
            2. Colono V/S: BP {{printdot(10)}}/{{printdot(10)}} mmHg. <br>
            PR{{printdot(10)}}ครั้ง/min, RR{{printdot(10)}}ครั้ง/min, O<sub>2</sub>sat{{printdot(10)}}%
        </div>
        <div class="col-12 text-center fw-bold">
            Bowel gr. 1&ensp; &ensp; 2 &ensp; &ensp; 3 &ensp; &ensp; 4
        </div>
        <div class="col-12">
            3. จัดท่าสำหรับส่องตรวจให้เหมาะสม <br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                นอนตะแคง ซ้าย / ขวา
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                นอนหงาย
            </label>
        </div>
        <div class="col-12">
            4. ดูแลความปลอดภัยระหว่างส่องตรวจ เช่น <br>
            การตกเตียง การติด plate
        </div>
        <div class="col-12">
            5. ช่วยแพทย์ทำหัตการเพิ่มเติม <br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Bx.
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Polypectomy
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Hemostatic clipping
            </label> <br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                injection
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Loop
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                APC
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                อื่นๆ {{printdot(10)}}
            </label>
        </div>
        <div class="col-12">
            6. สังเกตอาการขณะส่องตรวจ <br>
            &ensp; &ensp; - อาการปวดท้อง &ensp;  - อืดแน่นท้อง <br>
            &ensp; &ensp; - Bleeding &ensp; &ensp; &ensp; &ensp;   -  อาการแพ้ยา

        </div>
        <div class="col-12">
            7. การช่วยเหลือผู้ป่วยในภาวะฉุกเฉิน <br>
            - เตรียมรถ Emergency ให้พร้อมใช้งาน <br>
            - เตรียมความพร้อมบุคคลากรและช่วยเหลือ <br>
            ทีมตามหน้าที่ที่ได้รับมอบหมาย <br>
            - ประสานงานกับสหวิชาชีพ <br>
            ประสานงานกับ call center โทร.200 ใน <br>
            กรณีส่ง ต่อผู้ป่วยไปรักษาต่อ ร.พ. อื่นๆ
            - เตรียม CPR
        </div>
        <div class="col-12">
            8. Medication
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                IV sedation
            </label> <br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                10% Xylocain Spray
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Air -X drop
            </label> <br>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Petidine  {{printdot(10)}}mg.
            </label>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Buscopan {{printdot(10)}}mg.
            </label> <br>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Fentany {{printdot(10)}}mcg.
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Dormicum {{printdot(10)}}mg.
            </label> <br>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Propofol {{printdot(10)}}mg.
            </label> <br>

        </div>
        <div class="col-12">
            9. specimen <br>
            EGD &ensp;
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                ไม่มี
            </label>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                มี จำนวน {{printdot(10)}} กระป๋อง
            </label> <br>
            Colono &ensp;
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                ไม่มี
            </label>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                มี จำนวน {{printdot(10)}} กระป๋อง
            </label>
        </div>
        <div class="col-12">
           10. HP-one
           <input class="form-check-input " type="checkbox" id="formCheck1">
           <label class="form-check-label" for="formCheck1">
               ไม่มี
           </label>
           <input class="form-check-input " type="checkbox" id="formCheck1">
           <label class="form-check-label" for="formCheck1">
               มี จำนวน
           </label>
        </div>
        <div class="col-12">
            11. Complication
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                ไม่มี
            </label>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                มี จำนวน
            </label>
         </div>
         <div class="col-12">
            12. Blood loss
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                ไม่มี
            </label>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                มี ปริมาณ {{printdot(10)}}

            </label>
         </div>
         <div class="col-12">
            13. Insertion/withdrawal {{printdot(10)}}/{{printdot(10)}}min
            </label>
         </div>
         <div class="col-12">
            14. End point {{printdot(55)}}
            </label>
         </div>
         <div class="col-12">
            15. Volume {{printdot(55)}}
            </label>
         </div>
    </div>
    <div class="col-4 border_col lh-custom">
        <span class=" fw-bold">
            กิจกรรมพยาบาลหลังส่องตรวจ
        </span>

        <div class="col-12 fw-bold ">
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                ถามชื่อ-สกุล
            </label>
            <input class="form-check-input    " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                สอบถามหัตถการ
            </label>
        </div>
        <div class="col-12">
           3. สังเกตอาการ / ซักถาม / ภาวะแทรกซ้อน <br>
           &ensp; &ensp; - อืดแน่นท้อง ,ปวดท้อง <br>
           &ensp; &ensp; - หน้ามืด ใจสั่น <br>
           &ensp; &ensp; - ความรู้สึกด้านการกลืนลดลงชั่วคราว<br>

        </div>
        <div class="col-12">
            <u>Nursing Care</u> <br>
            <div class="ps-3">
                - แนะนำให้มีการเรอ/ผายลม <br>
                - จัด position ในท่าที่เหมาะสม <br>
                - ดูแลให้พักผ่อนบนเตียง/พักในท่าที่สบาย <br>
                - วัด v/s, O,sat <br>
                - (กรณีEGD) แนะนำเรื่องฤทธิ์ของยาชา <br> ที่ทำให้การกลืนลดลงว่าจะหมดไปภายใน 30 นาที <br>
                - ให้จิบน้ำหวานทีละน้อยเมื่อไม่มีภาวะแทรกซ้อนหลังการส่องตรวจ


           </div>

         </div>
         <div class="col-12">
            4. ส่งตรวจแผนกอื่นๆ<br>
            NPO ต่อ
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                NO
            </label>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                Yes เวลา {{printdot(30)}}
            </label> <br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                ห้อง Lab
            </label>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                X-ray {{printdot(30)}}
            </label> <br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                CT Scan {{printdot(56)}}
            </label><br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                OPD เคมี
            </label>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                OPD RT
            </label> <br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                OPD ทั่วไป {{printdot(53)}}
            </label> <br>
            <input class="form-check-input " type="checkbox" id="formCheck1">
            <label class="form-check-label" for="formCheck1">
                อื่นๆ {{printdot(63)}}
            </label>
         </div>
         <div class="col-12">
            5. ให้คำแนะนำ {{printdot(53)}} <br>
            {{printdot(74)}} <br>
            {{printdot(74)}} <br>
            F/U {{printdot(68)}} <br>

         </div>
         <div class="col-12">
            6. ล้างทำความสะอาดเครื่องมือ - อุปกรณ์ให้ <br>
            พร้อมใช้งาน <br>
            Note {{printdot(66)}} <br>
            {{printdot(74)}} <br>
            {{printdot(74)}} <br>
            {{printdot(74)}} <br>
            {{printdot(74)}} <br>
            ผู้บันทึก {{printdot(63)}} <br>
            ตำแหน่ง {{printdot(62)}} <br>
            เวลา {{printdot(30)}}วันที่{{printdot(32)}} <br>

         </div>
    </div>
    </div>



    <script></script>
</body>
