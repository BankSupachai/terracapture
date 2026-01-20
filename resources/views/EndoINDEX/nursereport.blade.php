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
            font-family: 'kanit';

        }

        .nurse-pdf {
            color: #808080;
            font-size: 10px;
        }

        .nurse-pdf-red {
            color: #F06548;
            font-size: 10px;
        }

        .fs-10 {
            font-size: 10px
        }
        .fs-8{font-size: 8px;}
        .nurse-index {
            color: #245788;
            font-size: 10px;
            font-weight: bold !important;
        }
        .nurse-pdf-blue {
            color: #4675E9;
            font-size: 10px;
        }
        .border {
            border: 1px solid #808080;
        }

        .nurse-pdf-green {
            color: #0AB39C;
            font-size: 10px
        }

        @page {
            size: A4;
            margin: 0;
        }

        html,
        body {
            width: 210mm;
            /* height: 297mm; */
        }
        #table-pb>:not(caption)>*>* {
            padding: 7px;
            border: 0;
        }
    </style>
</head>
<body>
    {{-- @dd($hospital); --}}
    {{-- @dd($patient); --}}
    {{-- @dd($casedata); --}}
    {{-- @dd($note); --}}

    <div class="card">
        <div class="card-body">
            <div class="row p-2" style="border: 1px solid #808080;">
                <div class="col-5">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{ fileconfig(@$hospital->hospital_pic) }}" width="50" alt="">
                        </div>
                        <div class="col-9 nurse-pdf fs-10">
                            <span class="fw-bold"></span> {{@$hospital->hospital_name}} <br>
                            {{@$hospital->hospital_address}} Phone: {{@$hospital->hospital_tel}}
                         </div>
                         <div class="col-12 nurse-pdf fs-10">
                             หน่วยส่องกล้องทางเดินอาหาร (Endoscopy Center) <br>
                             Nurse Record Report
                         </div>
                    </div>
                </div>
                <div class="col-4 nurse-pdf ">
                  <span class="fw-bold">HN :  &ensp; </span><span class="nurse-pdf-red">{{@$casedata->case_hn}}</span> <br>
                    <span class="fw-bold">Name : &ensp;</span><span class="nurse-pdf">{{@$casedata->patientname}}</span> <br>

                    <span class="fw-bold">Age : &ensp;</span><span class="nurse-pdf">  {{(isset($patient->birthdate) ? $patient->birthdate : '1982-01-01') }} ({{@$casedata->age}})</span> <br>
                    <span class="fw-bold">Treatment Coverage : &ensp;</span><span class="nurse-pdf"> {{@$casedata->treatment_coverage}}</span> <br>
                    <span class="fw-bold">Operation Date  : &ensp;</span><span class="nurse-pdf-red"> 15/02/2566 09:00</span>
                </div>
                <div class="col-3 nurse-pdf">
                    <span class="fw-bold">An : &ensp;</span><span class="nurse-pdf"> -</span> <br>
                    <span class="fw-bold">Gender: &ensp;</span>
                    {{-- @dd($patient['gender']) --}}
                        @php
                        $gender = 'ไม่ระบุ';
                        if (@$patient->gender == '1') {
                            $gender = 'Male';
                        }
                        if (@$patient->gender == '2') {
                            $gender = 'Female';
                        }
                    @endphp
                    <span class="nurse-pdf">
                        {{ @$gender }}

                    </span>




                    <br>
                    <span class="fw-bold">Location :  &ensp;</span>
                    <span class="nurse-pdf">
                        @if (@$casedata->opd)
                         {{ @$casedata->opd }}
                    @endif
                    @if (@$casedata->ward)
                         {{ @$casedata->ward }}
                    @endif
                    @if (@$casedata->refer)
                        {{ @$casedata->refer }}
                    @endif
                    </span>
                </div>

            </div>
            {{-- @dd($casedata); --}}
            <div class="row mt-2">
                <div class="col-6">
                    <div class="row">
                        <div class="col-4">
                            <span class=" nurse-index">Physician</span>
                        </div>
                        <div class="col-6 ">
                            <span class="nurse-pdf">{{@$casedata->doctorname}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <span class=" nurse-index">Consultant :</span>
                        </div>
                        <div class="col-4">
                            <span class="nurse-pdf fs-10">นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                        </div>
                        <div class="col-4">
                            <span class="nurse-pdf fs-10">นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <span class=" nurse-index">Nurse/Assist :</span>
                        </div>
                        <div class="col-4">
                            <span class="nurse-pdf fs-10">นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                        </div>
                        <div class="col-4">
                            <span class="nurse-pdf fs-10">นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                        </div>

                        <div class="col-4">
                            <span class="nurse-pdf fs-10">นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                        </div>
                        <div class="col-4">
                            <span class="nurse-pdf fs-10">นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                        </div>
                        <div class="col-4">
                            <span class="nurse-pdf fs-10">นพ.สุรัชณัฏฐ์ จิตรัตน์</span>
                        </div>

                    </div>
                </div>
                <div class="col-6">
                    <div class="row">
                        <div class="col-6">
                            <span class=" nurse-index">Procedure :</span>
                        </div>
                        <div class="col-6">
                            <span class="nurse-pdf-red">EGD, Colonoscopy</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span class=" nurse-index">Patient in :</span>
                        </div>
                        <div class="col-6">
                            <span class="nurse-pdf">{{@$casedata->time_start}}</span>
                        </div>
                    </div>
                    @php
                        $start_date = new Datetime(@$casedata->time_start);
                        $since_start = $start_date->diff(new DateTime(@$casedata->time_end));

                        $h = $since_start->h*60;
                        $i = $since_start->i;
                        $min = $h+$i;
                    @endphp
                    <div class="row">
                        <div class="col-6">
                            <span class="nurse-index">Operation Time :</span>
                        </div>
                        <div class="col-6">
                            <span class="nurse-pdf">{{@$casedata->time_start}} - {{@$casedata->time_end}} ( {{$min }} Minutes )</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <span class=" nurse-index">Patient Out :</span>
                        </div>
                        <div class="col-6">
                            <span class="nurse-pdf">{{@$casedata->time_end}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 my-2" style="border-top: 1px solid #808080"></div>
            <div class="row ">
                <div class="col-6 ">
                    <span class="nurse-index">History taking (Before Appointment) :</span>
                    <div class="row">
                        <div class="col-12 ">
                            <span class="nurse-pdf-red">พว.กฤษณา น้ำใจดี (10/02/2566 09:14)</span>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green">อาการนำมาโรงพยาบาล : </span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                ปวดท้อง, คลื่นใส้, ถ่ายดำ
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green">ประวัติการความเจ็บป่วย :</span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                ความดันโลหิตสูง, เบาหวาน
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green text-nowrap">การเเพ้ยา เเละการเเพ้อาหาร :</span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                ยาความดันโลหิตสูง, ยาเบาหวาน
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green">ประวัติการเเพ้ยา :</span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                ไม่เคย
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green">ประวัติการผ่าตัด :</span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                ปวดท้อง, คลื่นใส้, ถ่ายดำ
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green">การตั้งครรภ์ :</span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                -
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green">ประวัติการส่องกล้อง :</span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                ไม่เคย
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green">ประวัติการดื่มสุรา :</span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                5 เเก้ว/วัน
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 ">
                                <span class="nurse-pdf-green">ประวัติการสูบบุหรี่ :</span>
                            </div>
                            <div class="col-6 nurse-pdf">
                                10 มวน/วัน
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 ">
                    <span class="nurse-index">History taking (Before operation) :</span>
                    <div class="row">
                        <div class="col-12">
                            <span class="nurse-pdf-red">พว.กฤษณา น้ำใจดี (10/02/2566 09:14)</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 nurse-pdf-green">
                            สภาพเเรกรับ :
                        </div>
                        <div class="col-6 nurse-pdf">
                            รู้สึกตัว, เปลนั่ง
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 nurse-pdf-green">
                            การประเมินด้านจิตใจ :
                        </div>
                        <div class="col-6 nurse-pdf">
                            ผ่าน
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 nurse-pdf-green">
                            การประเมินด้านร่างกาย :
                        </div>
                        <div class="col-6 nurse-pdf">
                            ผ่าน
                        </div>
                    </div>
                    <div style="border: 1px solid #808080; padding: 0.5em; margin-top: 1em;">
                        <div class="row ">
                            <div class="col-6 nurse-pdf fw-bold ps-4">
                                ความดัน (mmHg) :
                            </div>
                            <div class="col-6 nurse-pdf">
                                120/80
                            </div>
                            <div class="col-6 nurse-pdf fw-bold ps-4">
                                Pulse (bpm) :
                            </div>
                            <div class="col-6 nurse-pdf">
                                120/80
                            </div>
                            <div class="col-6 nurse-pdf fw-bold ps-4">
                                งดอาหารเเละน้ำ 6-8 ชม. :
                            </div>
                            <div class="col-6 nurse-pdf-green">
                                <i class="ri ri-check-fill"></i>
                            </div>
                            <div class="col-6 nurse-pdf fw-bold ps-4">
                                เช็คฟันปลอม :
                            </div>
                            <div class="col-6 nurse-pdf-green">
                                <i class="ri ri-check-fill"></i>
                            </div>
                            <div class="col-6 nurse-pdf fw-bold ps-4">
                                งดยาสลายลิ่มเลือด :
                            </div>
                            <div class="col-6 nurse-pdf-green">
                                <i class="ri ri-check-fill"></i>
                            </div>
                            <div class="col-6 nurse-pdf fw-bold ps-4">
                                รับประทานยาลดความดัน :
                            </div>
                            <div class="col-6 nurse-pdf-green">
                                <i class="ri ri-check-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 my-1 nurse-index ">
                Operation detail :
            </div>
            <div style="border: 1px solid #808080;">
                <div class="row ps-3 my-1">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3 nurse-pdf-green">EGD</div>
                            <div class="col-9 nurse-pdf-red">
                              พว.กฤษณา น้ำใจดี (10/02/2566 09:14)
                            </div>
                            <div class="col-3 nurse-pdf text-nowrap">Medication : </div>
                            <div class="col-9 d-flex justify-content-between">
                                <span class="nurse-pdf">Buscopan 50 mg.</span>
                                <span class="nurse-pdf">Buscopan 50 mg.</span>
                            </div>
                            <div class="col-3 nurse-pdf text-nowrap">C/S : </div>
                            <div class="col-9 nurse-pdf">
                                {{-- @dd($casedata); --}}
                                {{-- @if (isset($casedata->["C/S"])){
                                    {{$casedata->AFB}}
                                }@else
                                -
                                @endif --}}
                            </div>
                            <div class="col-3 nurse-pdf text-nowrap">Cytology :</div>
                            <div class="col-9 nurse-pdf">Done</div>
                            <div class="col-3 nurse-pdf text-nowrap">H.pylori :</div>
                            <div class="col-9 nurse-pdf">Done</div>
                            <div class="col-3 nurse-pdf text-nowrap">AFB :</div>
                            <div class="col-9 nurse-pdf">
                                @if (isset($casedata->AFB)){
                                    {{$casedata->AFB}}
                                }@else
                                -
                                @endif
                            </div>
                            <div class="col-3 nurse-pdf text-nowrap">Pathology :</div>
                            <div class="col-9 nurse-pdf">Biopsy ขวดที่ 1 - Body</div>
                            <div class="col-3 nurse-pdf text-nowrap">Complication :</div>
                            <div class="col-9 nurse-pdf-red">None Immediately Complication</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3 nurse-pdf-green text-nowrap">Colonoscopy</div>
                            <div class="col-9 nurse-pdf-red">
                               พว.กฤษณา น้ำใจดี (10/02/2566 09:14)
                            </div>
                            <div class="col-3 nurse-pdf text-nowrap">Medication : </div>
                            <div class="col-9 d-flex justify-content-between">
                                <span class="nurse-pdf">Buscopan 50 mg.</span>
                                <span class="nurse-pdf">Buscopan 50 mg.</span>
                            </div>
                            <div class="col-3 nurse-pdf text-nowrap">C/S : </div>
                            <div class="col-9 nurse-pdf">Done</div>
                            <div class="col-3 nurse-pdf text-nowrap">Cytology :</div>
                            <div class="col-9 nurse-pdf">Done</div>
                            <div class="col-3 nurse-pdf text-nowrap">H.pylori :</div>
                            <div class="col-9 nurse-pdf">Done</div>
                            <div class="col-3 nurse-pdf text-nowrap">AFB :</div>
                            <div class="col-9 nurse-pdf">Done</div>
                            <div class="col-3 nurse-pdf text-nowrap">Pathology :</div>
                            <div class="col-9 nurse-pdf">Biopsy ขวดที่ 1 - Body</div>
                            <div class="col-3 nurse-pdf text-nowrap">Complication :</div>
                            <div class="col-9 nurse-pdf-red">None Immediately Complication</div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div style="page-break-after:auto;"></div> --}}
            <div class="row mt-2">
                <div class="col-12 ">
                    <div class="row">
                        <div class="col-6">
                            <span class="nurse-index">PROBLEM / ACTION  :</span>
                            <span class="nurse-pdf-red fw-bold">OPERATION</span>
                            <table id="table-pb" class="table table-nowrap fs-8">
                                <thead style="border-bottom: 1px solid #808080;">
                                    <tr>
                                        <td>Time</td>
                                        <td>BP</td>
                                        <td>PR</td>
                                        <td>RR</td>
                                        <td>SpO2</td>
                                        <td>Temp</td>
                                        <td>LOC</td>
                                        <td>Pain</td>
                                        <td>Recorder</td>
                                    </tr>
                                </thead>
                                <tbody style="border-bottom: 1px solid #808080;">
                                    @php
                                        $op_vitalsign = $note->recovery['vitalsign'] ?? [];
                                    @endphp
                                    @foreach ($op_vitalsign as $row)
                                    @php
                                        $user = get_user_data(intval($row['nurse_record']));
                                        $fullname = @$user->user_prefix.@$user->user_firstname.' '.@$user->user_lastname;
                                    @endphp
                                    <tr >
                                        <td > <span class="nurse-pdf-red">{{@$row['time']}}</span></td>
                                        <td>{{@$row['diastolic']}}/{{@$row['systolic']}}</td>
                                        <td>{{@$row['pr']}}</td>
                                        <td>{{@$row['rr']}}</td>
                                        <td>{{@$row['spo']}}%</td>
                                        <td>{{@$row['loc']}}C</td>
                                        <td>{{@$row['otwo']}}</td>
                                        <td></td>
                                        <td ><span class="nurse-pdf-red text-nowrap">{{@$fullname}}</span> </td>
                                    </tr>
                                    @endforeach
                                    {{-- <tr >
                                        <td > <span class="nurse-pdf-red">09:30</span></td>
                                        <td>120/80</td>
                                        <td>68</td>
                                        <td>24</td>
                                        <td>97%</td>
                                        <td>37.5C</td>
                                        <td>5</td>
                                        <td></td>
                                        <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                                    </tr>
                                    <tr >
                                        <td > <span class="nurse-pdf-red">09:30</span></td>
                                        <td>120/80</td>
                                        <td>68</td>
                                        <td>24</td>
                                        <td>97%</td>
                                        <td>37.5C</td>
                                        <td>5</td>
                                        <td></td>
                                        <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                                    </tr>
                                    <tr >
                                        <td > <span class="nurse-pdf-red">09:30</span></td>
                                        <td>120/80</td>
                                        <td>68</td>
                                        <td>24</td>
                                        <td>97%</td>
                                        <td>37.5C</td>
                                        <td>5</td>
                                        <td></td>
                                        <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                                    </tr>
                                    <tr >
                                        <td > <span class="nurse-pdf-red">09:30</span></td>
                                        <td>120/80</td>
                                        <td>68</td>
                                        <td>24</td>
                                        <td>97%</td>
                                        <td>37.5C</td>
                                        <td>5</td>
                                        <td></td>
                                        <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                                    </tr>
                                    <tr >
                                        <td > <span class="nurse-pdf-red">09:30</span></td>
                                        <td>120/80</td>
                                        <td>68</td>
                                        <td>24</td>
                                        <td>97%</td>
                                        <td>37.5C</td>
                                        <td>5</td>
                                        <td></td>
                                        <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                                    </tr>
                                    <tr >
                                        <td > <span class="nurse-pdf-red">09:30</span></td>
                                        <td>120/80</td>
                                        <td>68</td>
                                        <td>24</td>
                                        <td>97%</td>
                                        <td>37.5C</td>
                                        <td>5</td>
                                        <td></td>
                                        <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                                    </tr> --}}
                                </tbody>
                            </table>

                        </div>
                        <div class="col-6 ">
                            <span class="nurse-index"> Summary (Systolic / Diastolic)</span>
                            <div class="col-12 p-0 m-0" id="operation_chart"></div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div class="" style="page-break-after: always;"></div> --}}
            <div class="row">
                <div class="col-12">
                    <span class="nurse-index">VITAL SIGNS MONITOR :</span>
                    <span class="nurse-pdf-red fw-bold">OPERATION</span>
                </div>
                <table class="table table-nowrap fs-10 nurse-pdf">
                    <thead>
                        <tr>
                            <td>Time</td>
                            <td>Problem</td>
                            <td>Action</td>
                            <td>Response Time</td>
                            <td>Response</td>
                            <td>Recorder</td>

                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td class="nurse-pdf-red">13:10</td>
                            <td>อาจเกิดภาวะเเทรกซ้อน <br>
                                ขณะเกิดทำหัตถการ</td>
                            <td>● ประเมินระดับความรู้สึกตัว <br>
                                ● Monitor Vital Sign, O2 Sat, ให้ออกซิเจน
                            </td>
                            <td>13:10</td>
                            <td>● Pain Score < 2 <br>
                                ● ไม่มีอาการปวดท้องรุนเเรง</td>
                            <td>สุนิตา เเหลมคม</td>

                        </tr>
                        <tr >
                            <td class="nurse-pdf-red">13:10</td>
                            <td>อาจเกิดภาวะเเทรกซ้อน <br>
                                ขณะเกิดทำหัตถการ</td>
                            <td>● ประเมินระดับความรู้สึกตัว <br>
                                ● Monitor Vital Sign, O2 Sat, ให้ออกซิเจน
                            </td>
                            <td>13:10</td>

                            <td>● Pain Score < 2 <br>
                                ● ไม่มีอาการปวดท้องรุนเเรง</td>
                            <td>สุนิตา เเหลมคม</td>

                        </tr>
                        <tr >
                            <td class="nurse-pdf-red">13:10</td>
                            <td>อาจเกิดภาวะเเทรกซ้อน <br>
                                ขณะเกิดทำหัตถการ</td>
                            <td>● ประเมินระดับความรู้สึกตัว <br>
                                ● Monitor Vital Sign, O2 Sat, ให้ออกซิเจน
                            </td>
                            <td>13:10</td>

                            <td>● Pain Score < 2 <br>
                                ● ไม่มีอาการปวดท้องรุนเเรง</td>
                            <td>สุนิตา เเหลมคม</td>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div  style="page-break-after: always;"></div>
            <div class="row p-2 mt-2" style="border: 1px solid #808080;">
                <div class="col-5">
                    <div class="row">
                        <div class="col-3">
                            <img src="{{url("public/images/medicalogo.png")}}" width="50" alt="">
                        </div>
                        <div class="col-9 nurse-pdf fs-10">
                            <span class="fw-bold">โรงพยาบาลเมดิกา เฮลท์แคร์ จำกัด</span> <br>
                             989/17 Nuanchan Rd, Nuanchan, Buengkum,
                             <br> Bangkok 10230  Phone : 02-7802399
                         </div>
                         <div class="col-12 nurse-pdf fs-10">
                             หน่วยส่องกล้องทางเดินอาหาร (Endoscopy Center) <br>
                             Nurse Record Report
                         </div>
                    </div>
                </div>
                <div class="col-4 nurse-pdf ">
                  <span class="fw-bold">HN :  &ensp; </span><span class="nurse-pdf-red">45846256</span> <br>
                    <span class="fw-bold">Name : &ensp;</span><span class="nurse-pdf">นายสุรัชณัฏฐ์ จิตรัตน</span> <br>
                    <span class="fw-bold">Age : &ensp;</span><span class="nurse-pdf"> 20/09/2536 (30 years)</span> <br>
                    <span class="fw-bold">Treatment Coverage : &ensp;</span><span class="nurse-pdf"> ประกันสังคม</span> <br>
                    <span class="fw-bold">Operation Date  : &ensp;</span><span class="nurse-pdf-red"> 15/02/2566 09:00</span>
                </div>
                <div class="col-3 nurse-pdf">
                    <span class="fw-bold">An : &ensp;</span><span class="nurse-pdf"> -</span> <br>
                    <span class="fw-bold">Gender: &ensp;</span><span class="nurse-pdf"> Male</span> <br>
                    <span class="fw-bold">Location :  &ensp;</span><span class="nurse-pdf"> อายุรกรรมชาย  </span>
                </div>

            </div>
            <div class="row">
                <div class="col-6">
                    <span class="nurse-index">PROBLEM / ACTION :</span>
                    <span class="nurse-pdf-blue fw-bold">RECOVERY</span>

                    <table id="table-pb" class="table table-nowrap fs-8">
                        <thead style="border-bottom: 1px solid #808080;">
                            <tr>
                                <td>Time</td>
                                <td>BP</td>
                                <td>PR</td>
                                <td>RR</td>
                                <td>SpO2</td>
                                <td>Temp</td>
                                <td>LOC</td>
                                <td>Pain</td>
                                <td>Recorder</td>
                            </tr>
                        </thead>
                        <tbody style="border-bottom: 1px solid #808080;">
                            @php
                                $rec_vitalsign = $note->recovery['vitalsign'] ?? [];
                                // dd($rec_vitalsign);
                            @endphp
                            @foreach ($rec_vitalsign as $row)
                            @php
                                $user = get_user_data(intval($row['nurse_record']));
                                $fullname = @$user->user_prefix.@$user->user_firstname.' '.@$user->user_lastname;
                            @endphp
                            <tr >
                                <td > <span class="nurse-pdf-red">{{@$row['time']}}</span></td>
                                <td>{{@$row['diastolic']}}/{{@$row['systolic']}}</td>
                                <td>{{@$row['pr']}}</td>
                                <td>{{@$row['rr']}}</td>
                                <td>{{@$row['spo']}}%</td>
                                <td>{{@$row['loc']}}C</td>
                                <td>{{@$row['otwo']}}</td>
                                <td></td>
                                <td ><span class="nurse-pdf-red text-nowrap">{{@$fullname}}</span> </td>
                            </tr>
                            @endforeach
                            {{-- <tr >
                                <td > <span class="nurse-pdf-red">09:30</span></td>
                                <td>120/80</td>
                                <td>68</td>
                                <td>24</td>
                                <td>97%</td>
                                <td>37.5C</td>
                                <td>5</td>
                                <td></td>
                                <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                            </tr>
                            <tr >
                                <td > <span class="nurse-pdf-red">09:30</span></td>
                                <td>120/80</td>
                                <td>68</td>
                                <td>24</td>
                                <td>97%</td>
                                <td>37.5C</td>
                                <td>5</td>
                                <td></td>
                                <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                            </tr>
                            <tr >
                                <td > <span class="nurse-pdf-red">09:30</span></td>
                                <td>120/80</td>
                                <td>68</td>
                                <td>24</td>
                                <td>97%</td>
                                <td>37.5C</td>
                                <td>5</td>
                                <td></td>
                                <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                            </tr>
                            <tr >
                                <td > <span class="nurse-pdf-red">09:30</span></td>
                                <td>120/80</td>
                                <td>68</td>
                                <td>24</td>
                                <td>97%</td>
                                <td>37.5C</td>
                                <td>5</td>
                                <td></td>
                                <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                            </tr>
                            <tr >
                                <td > <span class="nurse-pdf-red">09:30</span></td>
                                <td>120/80</td>
                                <td>68</td>
                                <td>24</td>
                                <td>97%</td>
                                <td>37.5C</td>
                                <td>5</td>
                                <td></td>
                                <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                            </tr>
                            <tr >
                                <td > <span class="nurse-pdf-red">09:30</span></td>
                                <td>120/80</td>
                                <td>68</td>
                                <td>24</td>
                                <td>97%</td>
                                <td>37.5C</td>
                                <td>5</td>
                                <td></td>
                                <td ><span class="nurse-pdf-red text-nowrap">สดายุ ทองลอย</span> </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
                <div class="col-6">
                    <span class="nurse-index"> Summary (Systolic / Diastolic)</span>
                    <div class="col-12 p-0 m-0" id="recovery_chart"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span class="nurse-index">VITAL SIGNS MONITOR :</span>
                        <span class="nurse-pdf-blue fw-bold">RECOVERY</span>
                    </div>
                    <table class="table table-nowrap fs-10 nurse-pdf">
                        <thead>
                            <tr>
                                <td>Time</td>
                                <td>Problem</td>
                                <td>Action</td>
                                <td>Response Time</td>
                                <td>Response</td>
                                <td>Recorder</td>

                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                <td ><span class="nurse-pdf-red">13:10</span></td>
                                <td>อาจเกิดภาวะเเทรกซ้อน <br>
                                    ขณะเกิดทำหัตถการ</td>
                                <td>● ประเมินระดับความรู้สึกตัว <br>
                                    ● Monitor Vital Sign, O2 Sat, ให้ออกซิเจน
                                </td>
                                <td><span class="nurse-pdf-red">13:10</span></td>
                                <td>● Pain Score < 2 <br>
                                    ● ไม่มีอาการปวดท้องรุนเเรง</td>
                                <td><span class="nurse-pdf-red">สุนิตา เเหลมคม</span></td>

                            </tr>
                            <tr >
                                <td><span class="nurse-pdf-red">13:10</span></td>
                                <td>อาจเกิดภาวะเเทรกซ้อน <br>
                                    ขณะเกิดทำหัตถการ</td>
                                <td>● ประเมินระดับความรู้สึกตัว <br>
                                    ● Monitor Vital Sign, O2 Sat, ให้ออกซิเจน
                                </td>
                                <td><span class="nurse-pdf-red">13:10</span></td>

                                <td>● Pain Score < 2 <br>
                                    ● ไม่มีอาการปวดท้องรุนเเรง</td>
                                <td><span class="nurse-pdf-red">สุนิตา เเหลมคม</span></td>

                            </tr>
                            <tr >
                                <td ><span class="nurse-pdf-red">13:10</span></td>
                                <td>อาจเกิดภาวะเเทรกซ้อน <br>
                                    ขณะเกิดทำหัตถการ</td>
                                <td>● ประเมินระดับความรู้สึกตัว <br>
                                    ● Monitor Vital Sign, O2 Sat, ให้ออกซิเจน
                                </td>
                                <td><span class="nurse-pdf-red">13:10</span></td>

                                <td>● Pain Score < 2 <br>
                                    ● ไม่มีอาการปวดท้องรุนเเรง</td>
                                <td><span class="nurse-pdf-red">สุนิตา เเหลมคม</span></td>

                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="row">
                    <span class="nurse-index">DISCHARGE</span> <br>
                    <span class="nurse-pdf-red"> พว.กฤษณา น้ำใจดี (10/02/2566 09:14)</span> <br>
                    <div class="col-4">
                        <span class="nurse-pdf-green">ความรู้สึกตัว : </span>
                    </div>
                    <div class="col-6 nurse-pdf">
                        Good
                    </div>

                    <div class="col-4">
                        <span class="nurse-pdf-green">Pain Score : </span>
                    </div>
                    <div class="col-6 nurse-pdf">
                        4
                    </div>

                    <div class="col-4">
                        <span class="nurse-pdf-green">Discharge Score :  </span>
                    </div>
                    <div class="col-6 nurse-pdf">
                        9
                    </div>
                    <div class="col-4">
                        <span class="nurse-pdf-green">Discharge Time :  </span>
                    </div>
                    <div class="col-6 nurse-pdf">
                        09:15:15
                    </div>

                </div>
                <div class="row mt-2">
                    <span class="nurse-index">FOLLOW UP :</span>
                    <div class="col-12">
                        <table class="table table-nowrap nurse-pdf">
                            <thead>
                                <tr>
                                    <td scope="col">Recorder</td>
                                    <td scope="col">เลือดออก</td>
                                    <td scope="col">ถ่ายออกเป็นลักษณะ</td>
                                    <td scope="col">อาการไข้</td>
                                    <td scope="col">ปวดท้อง</td>
                                    <td scope="col">อาการอื่นๆ</td>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td ><span class="nurse-pdf-red">พว.กฤษณา น้ำใจดี (10/02/2566 09:14)</span></td>
                                    <td>ไม่มี</td>
                                    <td>ใสเป็นน้ำ</td>
                                    <td>ไม่มี</td>
                                    <td>ไม่มี</td>
                                    <td>ไม่มี</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $operation_bp = $note->operation['vitalsign'] ?? [];
        $op_systolic = [];
        $op_diastolic = [];
        $op_time = [];
        foreach ($operation_bp as $key => $val) {
            if(!empty($val['systolic'])){
                $op_systolic[] = $val['systolic'] ?? 0;
            } else {
                $op_systolic[] = $val['systolic'] ?? 0;
            }

            if(!empty($val['diastolic'])){
                $op_diastolic[] = $val['diastolic'] ?? 0;
            } else {
                $op_diastolic[] = $val['diastolic'] ?? 0;
            }

            if(!empty($val['time'])){
                $op_time[] = $val['time'] ?? 0;
            }
        }
    @endphp

    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        let op_systolic = @json(@$op_systolic);
        let op_diastolic = @json(@$op_diastolic);
        let op_time = @json(@$op_time);
        var options = {
             series: [
             {
               name: "Systolic",
               data: op_systolic,
             },
             {
               name: "Diastolic",
               data: op_diastolic,
             }
           ],
             chart: {
             height: 200,
             type: 'line',
             dropShadow: {
               enabled: true,
               color: '#000',
               top: 18,
               left: 7,
               blur: 10,
               opacity: 0.2
             },
             toolbar: {
               show: false
             },
             animations: {
                enabled: false,
             }
           },
           colors: ['#245788', '#0ab39d'],
           dataLabels: {
             enabled: true,
           },
           stroke: {
             curve: 'smooth'
           },
           title: {
             text: '',
             align: 'left'
           },
           grid: {
             borderColor: '#e7e7e7',
             row: {
               colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
               opacity: 0.5
             },
           },
           markers: {
             size: 1
           },
           xaxis: {
             categories: op_time,
             title: {
               text: ''
             }
           },
           yaxis: {
             title: {
               text: 'BP (mmHg)'
             },
             min: 80,
             max: 160,
             tickAmount: 4,
           },
           legend: {
             position: 'top',
             horizontalAlign: 'right',
             floating: true,
             offsetY: -25,
             offsetX: -5
           }
           };

           var chart = new ApexCharts(document.querySelector("#operation_chart"), options);
           chart.render();

   </script>

@php
$recovery_bp = $note->recovery['vitalsign'] ?? [];
$rec_systolic = [];
$rec_diastolic = [];
$red_time = [];
foreach ($recovery_bp as $key => $val) {
    if(!empty($val['systolic'])){
        $rec_systolic[] = $val['systolic'] ?? 0;
    } else {
        $rec_systolic[] = $val['systolic'] ?? 0;
    }

    if(!empty($val['diastolic'])){
        $rec_diastolic[] = $val['diastolic'] ?? 0;
    } else {
        $rec_diastolic[] = $val['diastolic'] ?? 0;
    }

    if(!empty($val['time'])){
        $rec_time[] = $val['time'] ?? 0;
    }
}
@endphp

<script>
    let rec_systolic = @json(@$rec_systolic);
    let rec_diastolic = @json(@$rec_diastolic);
    let rec_time = @json(@$rec_time);
    var options = {
         series: [
         {
           name: "Systolic",
           data: rec_systolic
         },
         {
           name: "Diastolic",
           data: rec_diastolic
         }
       ],
         chart: {
         height: 200,
         type: 'line',
         dropShadow: {
           enabled: true,
           color: '#000',
           top: 18,
           left: 7,
           blur: 10,
           opacity: 0.2
         },
         toolbar: {
           show: false
         },
         animations: {
            enabled: false,
         }
       },
       colors: ['#245788', '#0ab39d'],
       dataLabels: {
         enabled: true,
       },
       stroke: {
         curve: 'smooth'
       },
       title: {
         text: '',
         align: 'left'
       },
       grid: {
         borderColor: '#e7e7e7',
         row: {
           colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
           opacity: 0.5
         },
       },
       markers: {
         size: 1
       },
       xaxis: {
         categories: rec_time,
         title: {
           text: ''
         }
       },
       yaxis: {
         title: {
           text: 'BP (mmHg)'
         },
         min: 80,
         max: 160,
         tickAmount: 4,
       },
       legend: {
         position: 'top',
         horizontalAlign: 'right',
         floating: true,
         offsetY: -25,
         offsetX: -5
       }
       };

       var chart = new ApexCharts(document.querySelector("#recovery_chart"), options);
       chart.render();

</script>
</body>
</html>






