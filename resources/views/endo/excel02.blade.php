<!DOCTYPE html>
<html lang="th" class="isDesktop" style="display: none">
    <head>
        <meta charSet="utf-8"/>
		<script src="{{url("public/js/jquery-1.11.1.min.js")}}"></script>
        <script src="{{url("public/js//tableToExcel.js")}}"></script>
        <link href="{{asset('public/css/bootstrap.min.css')}}"                             rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/css/font-awesome.min.css')}}"                          rel="stylesheet" type="text/css"/>
        <link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
        <link rel="stylesheet" href="{{url("public/css/endo/excel02.css")}}">
    </head>
<style>
</style>
<div class="row" style="width: 100%;">
    <div class="col-12" style="padding: 2em;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-4 text-left"><button onclick="window.history.back()" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i> Back</button></div>
                    <div class="col-4 text-center"><button id="btnExport" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Excel</button></div>
                    <div class="col-4">
                        <select name="perpage" class="form-control">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="card-body pt-2">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table2excel">
                        <tr class="bg-dark text-light">
                            <th>Case&nbsp;ID</th>
                            @php /*
                            <th>HN</th>
                            <th>Name</th>
                            */
                            @endphp
                            <th>HN</th>
                            <th>Patient Name</th>
                            <th>Age</th>
                            <th>Gender</th>



                            <th>ID/Passport</th>
                            <th>Allergic</th>
                            <th>Contact</th>
                            <th>Conginital&nbsp;disease</th>
                            <th>Right&nbsp;to&nbsp;treatment</th>
                            <th>TypeOfCase</th>
                            <th>Appointment&nbsp;Date</th>
                            <th>Time</th>
                            <th>Procedure</th>
                            <th>Endoscopist</th>
                            <th>Doctor&nbsp;consult#1</th>
                            <th>Doctor&nbsp;consult#2</th>
                            <th>Doctor&nbsp;consult#3</th>
                            <th>Nurse&nbsp;#1</th>
                            <th>Nurse&nbsp;#2</th>
                            <th>Assist&nbsp;nurse#1</th>
                            <th>Assist&nbsp;nurse#2</th>
                            <th>Scope</th>
                            <th>Room</th>
                            <th>Ward</th>
                            <th>OPD</th>
                            <th>Refer</th>
                            <th>Brief&nbsp;history</th>
                            <th>Pre&nbsp;Diagnosis</th>
                            <th>Anesthesia</th>
                            <th>Medication</th>
                            <th>Finding</th>
                            <th>---</th>
                            <th>Overall&nbsp;finding</th>
                            <th>Primary&nbsp;Diagnosis</th>
                            <th>Secondary&nbsp;Diagnosis</th>
                            <th>Other&nbsp;Diagnosis(1)</th>
                            <th>Other&nbsp;Diagnosis(2)</th>
                            <th>Other&nbsp;Diagnosis(3)</th>
                            <th>ICD&nbsp;10&nbsp;Code</th>
                            <th>Freetext&nbsp;Diagnosis</th>
                            <th>Primary&nbsp;Procedure</th>
                            <th>Secondary&nbsp;Procedure</th>
                            <th>Other&nbsp;Procedure(1)</th>
                            <th>Other&nbsp;Procedure(2)</th>
                            <th>Other&nbsp;Procedure(3)</th>
                            <th>icd9code</th>
                            <th>Freetext&nbsp;Diagnosis</th>
                            <th>Complication</th>
                            <th>Bowel preparation</th>
                            <th>Histopathology</th>
                            <th>Recommendation</th>
                            <th>Comment</th>
                        </tr>


                        @foreach ($tb_report as $tb)
                            @php
                                $tb->sample = "";
                                $arr = array();
                                $arr[0]['report_cid']                   = $tb->report_cid;

                                $arr[0]['report_hn']                    = pdpaDecode($tb->report_hn);
                                $arr[0]['report_patientname']           = pdpaDecode($tb->report_patientname);

                                $arr[0]['report_age']                   = $tb->report_age;
                                $arr[0]['report_gender']                = $tb->report_gender;
                                $arr[0]['report_citizen']               = $tb->report_citizen;
                                $arr[0]['report_allergic']              = $tb->report_allergic;
                                $arr[0]['report_contact']               = $tb->report_contact;
                                $arr[0]['report_conginital_disease']    = $tb->report_conginital_disease;
                                $arr[0]['report_right2treatment']       = $tb->report_right2treatment;
                                $arr[0]['report_type_of_case']          = @$tb->report_type_of_case;
                                $arr[0]['report_appointment_date']      = $tb->report_appointment_year.'-'.$tb->report_appointment_month.'-'.$tb->report_appointment_day;
                                $arr[0]['report_appointment_time']      = $tb->report_appointment_time;
                                $arr[0]['report_procedure']             = $tb->report_procedure;
                                $arr[0]['report_endoscopist']           = $tb->report_endoscopist;
                                $arr[0]['report_doctorconsult01']       = $tb->report_doctorconsult01;
                                $arr[0]['report_doctorconsult02']       = $tb->report_doctorconsult02;
                                $arr[0]['report_doctorconsult03']       = $tb->report_doctorconsult03;
                                $arr[0]['report_nurse01']               = $tb->report_nurse01;
                                $arr[0]['report_nurse02']               = $tb->report_nurse02;
                                $arr[0]['report_nurse03']               = $tb->report_nurse03;
                                $arr[0]['report_nurse04']               = $tb->report_nurse04;

                                $arr[0]['report_scope']                 = $tb->report_scope;
                                $i = 0;
                                $json = jsonDecode($tb->report_scope);
                                foreach($json as $j){
                                    $arr[0]['report_scope']       .=" | ".$j;
                                    if($j!=""){$i++;}
                                }


                                $arr[0]['report_room']                  = $tb->report_room;
                                $arr[0]['report_ward']                  = $tb->report_ward;
                                $arr[0]['report_opd']                   = $tb->report_opd;
                                $arr[0]['report_refer']                 = $tb->report_refer;
                                $arr[0]['report_briefhistory']          = $tb->report_briefhistory;
                                $arr[0]['report_prediagnosis']          = $tb->report_prediagnosis;

                                $i = 0;
                                $json = jsonDecode($tb->report_anesthesia);
                                $arr[0]['report_anesthesia']            ="";
                                foreach($json as $j){
                                    $arr[0]['report_anesthesia']       .=" | ".$j;
                                    if($j!=""){$i++;}
                                }


                                $arr[0]['report_medication']            = "";
                                $i = 0;
                                $json = jsonDecode($tb->report_medication);
                                foreach($json as $j=>$a){
                                    if($a!=0){
                                       $arr[0]['report_medication']       .=" | ". $j." ".$a;
                                    }
                                    if($j!=""){$i++;}
                                }


                                $i = 0;
                                $json = jsonDecode($tb->report_finding);
                                $arr[0]['report_finding']      = "";
                                $arr[0]['report_findingval']   = "";
                                foreach($json as $key => $val){
                                    $arr[0]['report_finding']      .= " | ".$key;
                                    $arr[0]['report_findingval']   .= " | ".$val;
                                    if($j!=""){$i++;}
                                }

                                $arr[0]['report_overallfinding']        = $tb->report_overallfinding;
                                $arr[0]['report_diagnostic_primary']     = $tb->report_diagnostic_primary;
                                $arr[0]['report_diagnostic_secondary']   = $tb->report_diagnostic_secondary;
                                $arr[0]['report_diagnostic_other01']     = $tb->report_diagnostic_other01;
                                $arr[0]['report_diagnostic_other02']     = $tb->report_diagnostic_other02;
                                $arr[0]['report_diagnostic_other03']     = $tb->report_diagnostic_other03;


                                $i = 0;
                                $json = jsonDecode($tb->report_icd10code);
                                $arr[0]['report_icd10code']       = "";
                                foreach($json as $j){
                                    $arr[0]['report_icd10code']       = " | ".$j;
                                    if($j!=""){$i++;}
                                }


                                $arr[0]['report_diagnostic_freetext']    = $tb->report_diagnostic_freetext;
                                $arr[0]['report_procedure_primary']     = $tb->report_procedure_primary;
                                $arr[0]['report_procedure_secondary']   = $tb->report_procedure_secondary;
                                $arr[0]['report_procedure_other01']     = $tb->report_procedure_other01;
                                $arr[0]['report_procedure_other02']     = $tb->report_procedure_other02;
                                $arr[0]['report_procedure_other03']     = $tb->report_procedure_other03;

                                $i = 0;
                                $json = jsonDecode($tb->report_icd9code);
                                foreach($json as $j){
                                    $arr[$i]['report_icd9code']       = $j;
                                    if($j!=""){$i++;}
                                }


                                $arr[0]['sample']                       = "";

                                $i = 0;
                                $json = jsonDecode($tb->report_complication);
                                $arr[0]['report_complication']       = "";
                                foreach($json as $j){
                                    $arr[0]['report_complication']       .= " | " .$j;
                                    if($j!=""){$i++;}
                                }
                                $arr[0]['report_bowel']                 = $tb->report_bowel;
                                $arr[0]['report_histopathology']        = $tb->report_histopathology;
                                $arr[0]['report_recommendation']        = $tb->report_recommendation;
                                $arr[0]['report_comment']               = $tb->report_comment;
                            @endphp

                            @php
                            $i=0;
                            @endphp
                            @foreach($arr as $a)
                            <tr>
                                <td>{{@$arr[$i]['report_cid']}}</td>
                                <td>{{@$arr[$i]['report_hn']}}</td>
                                <td>{{@$arr[$i]['report_patientname']}}</td>
                                <td>{{@$arr[$i]['report_age']}}</td>
                                <td>{{@$arr[$i]['report_gender']}}</td>
                                <td>{{@$arr[$i]['report_citizen']}}</td>
                                <td>{{@$arr[$i]['report_allergic']}}</td>
                                <td>{{@$arr[$i]['report_contact']}}</td>
                                <td>{{@$arr[$i]['report_conginital_disease']}}</td>
                                <td>{{@$arr[$i]['report_right2treatment']}}</td>
                                <td>{{@$arr[$i]['report_type_of_case']}}</td>
                                <td>{{@$arr[$i]['report_appointment_date']}}</td>
                                <td>{{@$arr[$i]['report_appointment_time']}}</td>
                                <td>{{@$arr[$i]['report_procedure']}}</td>
                                <td>{{@$arr[$i]['report_endoscopist']}}</td>
                                <td>{{@$arr[$i]['report_doctorconsult01']}}</td>
                                <td>{{@$arr[$i]['report_doctorconsult02']}}</td>
                                <td>{{@$arr[$i]['report_doctorconsult03']}}</td>
                                <td>{{@$arr[$i]['report_nurse01']}}</td>
                                <td>{{@$arr[$i]['report_nurse02']}}</td>
                                <td>{{@$arr[$i]['report_nurse03']}}</td>
                                <td>{{@$arr[$i]['report_nurse04']}}</td>
                                <td>{{@$arr[$i]['report_scope']}}</td>
                                <td>{{@$arr[$i]['report_room']}}</td>
                                <td>{{@$arr[$i]['report_ward']}}</td>
                                <td>{{@$arr[$i]['report_opd']}}</td>
                                <td>{{@$arr[$i]['report_refer']}}</td>
                                <td>{{@$arr[$i]['report_briefhistory']}}</td>
                                <td>{{@$arr[$i]['report_prediagnosis']}}</td>
                                <td>{{@$arr[$i]['report_anesthesia']}}</td>
                                <td>{{@$arr[$i]['report_medication']}}</td>
                                <td>{{@$arr[$i]['report_finding']}}</td>
                                <td>{{@$arr[$i]['report_findingval']}}</td>
                                <td>{{@$arr[$i]['report_overallfinding']}}</td>
                                <td>{{@$arr[$i]['report_diagnostic_primary']}}</td>
                                <td>{{@$arr[$i]['report_diagnostic_secondary']}}</td>
                                <td>{{@$arr[$i]['report_diagnostic_other01']}}</td>
                                <td>{{@$arr[$i]['report_diagnostic_other02']}}</td>
                                <td>{{@$arr[$i]['report_diagnostic_other03']}}</td>
                                <td>{{@$arr[$i]['report_icd10code']}}</td>
                                <td>{{@$arr[$i]['report_diagnostic_freetext']}}</td>
                                <td>{{@$arr[$i]['report_procedure_primary']}}</td>
                                <td>{{@$arr[$i]['report_procedure_secondary']}}</td>
                                <td>{{@$arr[$i]['report_procedure_other01']}}</td>
                                <td>{{@$arr[$i]['report_procedure_other02']}}</td>
                                <td>{{@$arr[$i]['report_procedure_other03']}}</td>
                                <td>{{@$arr[$i]['report_icd9code']}}</td>
                                <td>{{@$arr[$i]['sample']}}</td>
                                <td>{{@$arr[$i]['report_complication']}}</td>
                                <td>{{@$arr[$i]['report_bowel']}}</td>
                                <td>{{@$arr[$i]['report_histopathology']}}</td>
                                <td>{{@$arr[$i]['report_recommendation']}}</td>
                                <td>{{@$arr[$i]['report_comment']}}</td>
                                @php
                                $i++;
                                @endphp
                            </tr>
                            @endforeach
                        @endforeach
                    </table>
                </div>
                <div class="row">
                    <div class="col-12 text-center">{{ $tb_report->appends($_GET)->render() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>



</html>
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
    });


    let table = document.getElementsByTagName("table");
    TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
        name: `{{$filename}}.xlsx`, // fileName you could use any name
        sheet: {
            name: 'Sheet 1' // sheetName
        }

    });

    window.history.back();


});



    $(function() {
        $("dddbutton").click(function(){
        $("#table2excel").table2excel({
            exclude: ".noExl",
            name: "Excel Document Name"
        });
         });
    });
</script>
<script>

