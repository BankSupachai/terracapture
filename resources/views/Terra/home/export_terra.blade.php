@extends('layouts.layout_capture')
@section('title', 'Terralink')
@section('style')
    <style>
        h2 {
            margin: 0;
            margin-top: 0.5em;
        }

        .form-control {
            margin-bottom: 1em;
        }
        #setting_export .col-3{
            margin-top: 0.5em;
        }
        .set-scroll > .col-6{
            height: 90vh;
            overflow-y: auto;
        }
    </style>
@endsection
@section('content')



    @if (isset($_GET['sdate']))
        @php
            $sdate = substr(@$_GET['sdate'], 0, 10);
            $sdate = date('d-m-Y', $sdate);
        @endphp
    @else
        @php
            $sdate = '';
        @endphp
    @endif
    <div class="clearfix"></div>


    <div class="row" style="margin: 0;">
        <div class="cardcode col-12" style="padding: 0;display:none">
            <div class="card-box">
                <label id="discharge_toggle">
                    <font size='4'><b>Page Detail</b></font>
                </label>
                <div class="row">
                    <div class="col-12">
                        Controller : <a
                            href="autoit?run=visualcode_open\\endo.exe&path=ExportController">ExportController</a>
                    </div>
                    <div class="col-12">
                        View : <a href="autoit?run=visualcode_open\\endo.exe&path=exportindex">exportindex</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">

            <div class="row set-scroll">
            <div class="col-6" style="padding-top: 2em;">
                <div class="card">
                    <div class="card-body" id="setting_export" style="display: none;">
                        <div class="row m-0">
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_cid"/>
                                    <span></span>
                                    &emsp; Case ID
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_hn"/>
                                    <span></span>
                                    &emsp; HN
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_patientname"/>
                                    <span></span>
                                    &emsp; Patient Name
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_age"/>
                                    <span></span>
                                    &emsp; Age
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success" id="report_gender">
                                    <input type="checkbox" name="Checkboxes15" class="config_export"/>
                                    <span></span>
                                    &emsp; Gender
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_citizen"/>
                                    <span></span>
                                    &emsp; ID/Passport
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_allergic"/>
                                    <span></span>
                                    &emsp; Allergic
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_type_of_case"/>
                                    <span></span>
                                    &emsp; TypeOfCase
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_contact"/>
                                    <span></span>
                                    &emsp; Contact
                                </label>
                            </div>

                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_conginital_disease"/>
                                    <span></span>
                                    &emsp; Conginital disease
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_right2treatment"/>
                                    <span></span>
                                    &emsp; Treatment Coverage
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_type_of_case"/>
                                    <span></span>
                                    &emsp; Type of case
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_appointment_date"/>
                                    <span></span>
                                    &emsp; Appointment Date
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_appointment_time"/>
                                    <span></span>
                                    &emsp; Time
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_procedure"/>
                                    <span></span>
                                    &emsp; Procedure
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_endoscopist"/>
                                    <span></span>
                                    &emsp; Endoscopist
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_doctorconsult01"/>
                                    <span></span>
                                    &emsp; Doctor consult#1
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_doctorconsult02"/>
                                    <span></span>
                                    &emsp; Doctor consult#2
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_doctorconsult03"/>
                                    <span></span>
                                    &emsp; Doctor consult#3
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_nurse01"/>
                                    <span></span>
                                    &emsp; Nurse #1
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_nurse02"/>
                                    <span></span>
                                    &emsp; Nurse #2
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_nurse03"/>
                                    <span></span>
                                    &emsp; Assist nurse#1
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_nurse04"/>
                                    <span></span>
                                    &emsp; Assist nurse#2
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_scope"/>
                                    <span></span>
                                    &emsp; Scope
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_room"/>
                                    <span></span>
                                    &emsp; Room
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_ward"/>
                                    <span></span>
                                    &emsp; Ward
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_opd"/>
                                    <span></span>
                                    &emsp; OPD
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_refer"/>
                                    <span></span>
                                    &emsp; Refer
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_briefhistory"/>
                                    <span></span>
                                    &emsp; Brief history
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_prediagnosis"/>
                                    <span></span>
                                    &emsp; Pre Diagnosis
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_anesthesia"/>
                                    <span></span>
                                    &emsp; Anesthesia
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_medication"/>
                                    <span></span>
                                    &emsp; Medication
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_overallfinding"/>
                                    <span></span>
                                    &emsp; Finding
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export"/>
                                    <span></span>
                                    &emsp; ---
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_overallfinding"/>
                                    <span></span>
                                    &emsp; Overall finding
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_diagnostic_primary"/>
                                    <span></span>
                                    &emsp; Primary Diagnosis
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_diagnostic_secondary"/>
                                    <span></span>
                                    &emsp; Secondary Diagnosis
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_diagnostic_other01"/>
                                    <span></span>
                                    &emsp; Other Diagnosis(1)
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_diagnostic_other02"/>
                                    <span></span>
                                    &emsp; Other Diagnosis(2)
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_diagnostic_other03"/>
                                    <span></span>
                                    &emsp; Other Diagnosis(3)
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_icd10code"/>
                                    <span></span>
                                    &emsp; ICD 10 Code
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_diagnostic_freetext"/>
                                    <span></span>
                                    &emsp; Freetext Diagnosis
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_procedure_primary"/>
                                    <span></span>
                                    &emsp; Primary Procedure
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_procedure_secondary"/>
                                    <span></span>
                                    &emsp; Secondary Procedure
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_procedure_other01"/>
                                    <span></span>
                                    &emsp; Other Procedure(1)
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_procedure_other02"/>
                                    <span></span>
                                    &emsp; Other Procedure(2)
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_procedure_other03"/>
                                    <span></span>
                                    &emsp; Other Procedure(3)
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_icd9code"/>
                                    <span></span>
                                    &emsp; icd9code
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_diagnostic_freetext"/>
                                    <span></span>
                                    &emsp; Freetext Diagnosis
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_complication"/>
                                    <span></span>
                                    &emsp; Complication
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_histopathology"/>
                                    <span></span>
                                    &emsp; Histopathology
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_recommendation"/>
                                    <span></span>
                                    &emsp; Recommendation
                                </label>
                            </div>
                            <div class="col-3">
                                <label class="checkbox checkbox-outline checkbox-success">
                                    <input type="checkbox" name="Checkboxes15" class="config_export" id="report_comment"/>
                                    <span></span>
                                    &emsp; Comment
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center">
                        <span class="svg-icon svg-icon-primary svg-icon-3x">
                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Outgoing-box.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z"
                                        fill="#000000" />
                                    <path
                                        d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z"
                                        fill="#000000" opacity="0.3" />
                                    <path
                                        d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(11.959697, 3.661508) rotate(-90.000000) translate(-11.959697, -3.661508) " />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <h2>Export Data</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('exportindex') }}" method="post">
                            @csrf

                            <div class="row">

                                <div class="col-lg-12">
                                    {!!userSELECT('doctorID','เลือกแพทย์',$doctor,'','class="form-control form-control-lg"')!!}
                                </div>

                                <div class="col-6">
                                    <input name="date_start" type="text" class="form-control datepicker" id="date_start" placeholder="Start date"   autocomplete="off" required>
                                </div>

                                <div class="col-6">
                                    <input name="date_end" type="text" class="form-control datepicker" id="date_end" placeholder="End date" value="{{date('Y-m-d')}}"  autocomplete="off" required>
                                </div>

                                <div class="col-lg-12">
                                    <div class="row">

                                    <div class="col-12">&emsp;<b>Please choose Procedure</b></div>
                                        @foreach ($procedure as $data)
                                        <div class="col-6">
                                            {{--  --}}
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="procedure[]" id="procedure{{$data->procedure_code}}" value="{{$data->procedure_name}}">
                                                <label class="form-check-label" for="procedure{{$data->procedure_code}}">
                                                    &nbsp; {{$data->procedure_name}}
                                                </label>
                                            </div>
                                            {{--  --}}

                                        </div>
                                        @endforeach

                                    {{-- <div class="col-12"><b>Request</b></div>

                                    <div class="col-4">Case&nbsp;ID</div>
                                    <div class="col-4">HN</div>
                                    <div class="col-4">Name</div>
                                    <div class="col-4">Age</div>
                                    <div class="col-4">Gender</div>
                                    <div class="col-4">ID/Passport</div>
                                    <div class="col-4">Allergic</div>
                                    <div class="col-4">Contact</div>
                                    <div class="col-4">Conginital&nbsp;disease</div>
                                    <div class="col-4">Right&nbsp;to&nbsp;treatment</div>
                                    <div class="col-4">Appointment&nbsp;Date</div>
                                    <div class="col-4">Time</div>
                                    <div class="col-4">Procedure</div>
                                    <div class="col-4">Endoscopist</div>
                                    <div class="col-4">Doctor&nbsp;consult#1</div>
                                    <div class="col-4">Doctor&nbsp;consult#2</div>
                                    <div class="col-4">Doctor&nbsp;consult#3</div>
                                    <div class="col-4">Nurse&nbsp;#1</div>
                                    <div class="col-4">Nurse&nbsp;#2</div>
                                    <div class="col-4">Assist&nbsp;nurse#1</div>
                                    <div class="col-4">Assist&nbsp;nurse#2</div>
                                    <div class="col-4">Scope</div>
                                    <div class="col-4">Room</div>
                                    <div class="col-4">Ward</div>
                                    <div class="col-4">OPD</div>
                                    <div class="col-4">Refer</div>
                                    <div class="col-4">Brief&nbsp;history</div>
                                    <div class="col-4">Pre&nbsp;Diagnosis</div>
                                    <div class="col-4">Anesthesia</div>
                                    <div class="col-4">Medication</div>
                                    <div class="col-4">Finding</div>
                                    <div class="col-4">---</div>
                                    <div class="col-4">Overall&nbsp;finding</div>
                                    <div class="col-4">Primary&nbsp;Diagnosis</div>
                                    <div class="col-4">Secondary&nbsp;Diagnosis</div>
                                    <div class="col-4">Other&nbsp;Diagnosis(1)</div>
                                    <div class="col-4">Other&nbsp;Diagnosis(2)</div>
                                    <div class="col-4">Other&nbsp;Diagnosis(3)</div>
                                    <div class="col-4">ICD&nbsp;10&nbsp;Code</div>
                                    <div class="col-4">Freetext&nbsp;Diagnosis</div>
                                    <div class="col-4">Primary&nbsp;Procedure</div>
                                    <div class="col-4">Secondary&nbsp;Procedure</div>
                                    <div class="col-4">Other&nbsp;Procedure(1)</div>
                                    <div class="col-4">Other&nbsp;Procedure(2)</div>
                                    <div class="col-4">Other&nbsp;Procedure(3)</div>
                                    <div class="col-4">icd9code</div>
                                    <div class="col-4">Freetext&nbsp;Diagnosis</div>
                                    <div class="col-4">Complication</div>
                                    <div class="col-4">Histopathology</div>
                                    <div class="col-4">Recommendation</div>
                                    <div class="col-4">Comment</div> --}}


                                </div>




                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                </div>
                                    <div class="col-lg-6" style="padding-top: 1.5em;">
                                        <button name="onerow" value="true"
                                            type="submit" class="btn btn-success btn-lg"
                                            style="width:100%;border-radius:10px;">Export Excel Data (one row)</button>
                                    </div>

                                    <div class="col-lg-6" style="padding-top: 1.5em;">
                                        {{-- <button name="html" value="true"
                                            type="submit" class="btn btn-primary btn-lg"
                                            style="width:100%;border-radius:10px;">Export Excel Data
                                        </button> --}}
                                        <button type="button" class="btn btn-primary btn-lg w-100" id="btn_setting">Setting</button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
             <!--end export excel data -->

            <div class="col-6" style="padding-top: 2em;" >
                <div class="card">
                    <div class="card-header text-center">
                        <span class="svg-icon svg-icon-success svg-icon-3x">
                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Outgoing-box.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                     <polygon points="0 0 24 0 24 24 0 24"/>
                                     <path d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                     <path d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z" fill="#000000" fill-rule="nonzero"/>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <h2>Summary Report Data</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{url('summary')}}" method="post">
                            <input type="hidden" name="event" value="show_one_person">
                            @csrf

                            <div class="row">
                                        <div class="col-lg-12 text-center pb-5">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a class="btn btn-info call_doctor">เลือกแพทย์</a>
                                                <a class="btn btn-info call_nurse">เลือกพยาบาล</a>
                                                <a class="btn btn-info call_register">เลือกผู้ช่วยพยาบาล</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 list_all" id="list_doctor" style="display: none">
                                            <div class="row">
                                                @foreach ($doctor as $user)
                                                <div class="col-4 text-dark mt-3">
                                                    <input  name="user[]"
                                                            value="{{$user->id}}"
                                                            type="checkbox"
                                                            class="doctor"
                                                            id="doctor{{$user->id}}">
                                                    <label for="doctor{{$user->id}}">&nbsp; {{$user->user_prefix}}{{$user->user_firstname}} {{$user->user_lastname}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-lg-12 list_all" id="list_nurse" style="display: none">
                                            <div class="row">
                                                @foreach ($nurse as $user)
                                                <div class="col-4 text-dark mt-3">
                                                    <input  name="user[]"
                                                            value="{{$user->id}}"
                                                            type="checkbox"
                                                            class="doctor"
                                                            id="doctor{{$user->id}}">
                                                    <label for="doctor{{$user->id}}">&nbsp; {{$user->user_prefix}}{{$user->user_firstname}} {{$user->user_lastname}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-lg-12 list_all" id="list_register" style="display: none">
                                            <div class="row">
                                                @foreach ($register as $user)
                                                <div class="col-4 text-dark mt-3">
                                                    <input  name="user[]"
                                                            value="{{$user->id}}"
                                                            type="checkbox"
                                                            class="doctor"
                                                            id="doctor{{$user->id}}">
                                                    <label for="doctor{{$user->id}}">&nbsp; {{$user->user_prefix}}{{$user->user_firstname}} {{$user->user_lastname}}</label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>

                                <div class="col-lg-12">
                                    <div class="row">
                                    <div class="col-12">&emsp;<b>Please choose Procedure</b></div>

                                        @foreach ($procedure as $data)
                                        <div class="col-6">

                                            {{--  --}}
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" name="procedure[]" id="procedure_summary{{$data->procedure_code}}" value="{{$data->procedure_name}}">
                                                <label class="form-check-label" for="procedure_summary{{$data->procedure_code}}">
                                                    &nbsp;{{$data->procedure_name}}
                                                </label>
                                            </div>
                                            {{--  --}}
                                             {{-- <div class="row" >
                                                &emsp;&emsp;<input type="checkbox" name="procedure[]" id="procedure_summary{{$data->procedure_code}}" value="{{$data->procedure_name}}" >
                                                <label for="procedure_summary{{$data->procedure_code}}">&nbsp;{{$data->procedure_name}}</label>
                                            </div> --}}
                                             </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="padding-top: 2em;">
                            <div class="col-12">&emsp;<b>Please choose Year Report</b></div>
                                    <div class="col-12">
                                        <select name="year" class="form-control">
                                            @foreach (yearall() as $year)
                                                <option value="{{$year}}">{{$year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </div>





                            <div class="row">
                                <div class="col-lg-12">
                                </div>
                                    <div class="col-lg-12" style="padding-top: 1.5em;">
                                        <button name="html" value="true"
                                            type="submit" class="btn btn-success btn-lg"
                                            style="width:100%;border-radius:10px;">Export Summary Report</button>
                                    </div>

                            </div>













































                        </form>
                    </div>
                </div>
            </div>
            </div> <!--end row-->
        </div>
    @endsection

    @section('script')
        <script src="{{ url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
        <script src="{{ url('public/sample/assets/plugins/global/plugins.bundle.js')}}"></script>
        <script src="{{ url('public/sample/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
        <script src="{{ url('public/sample/assets/js/scripts.bundle.js')}}"></script>
        <script src="{{url("public/sample/assets/js/pages/crud/forms/widgets/bootstrap-select.js")}}"></script>


        <script>
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            $('.call_doctor').click(function(){
                $('.list_all').hide();
                $('#list_doctor').show();
            })
            $('.call_nurse').click(function(){
                $('.list_all').hide();
                $('#list_nurse').show();
            })
            $('.call_register').click(function(){
                $('.list_all').hide();
                $('#list_register').show();
            })
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });

            $("#setting_export").slideUp()
            $("#btn_setting").click(function(){
                $("#setting_export").toggle(500)
            })
            $(".config_export").on('click change',function(){
                var value   = $(this).val();
                var id      = $(this).attr('id');
                if($(this).is(':checked')){
                    value = 'on';
                }else{
                    value = 'off'
                }
                $.post("{{url('jquery')}}",{
                    event   : "config_export",
                    id      : id,
                    value   : value,
                },function(data, status){});
            });
        </script>



    @endsection
