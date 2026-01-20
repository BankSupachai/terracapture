<?php

use App\Models\Datacase;
use App\Models\Mongo;

    function SEND2TBreport($case)
    {

        $json                               = jsonDecode($case->case_json);
        $patient                            = DB::table('patient')->where('hn',$case->case_hn)->first();
        $doctorconsult01                    = DB::table('users')->where('id',@$json->physicians02)->first();
        $doctorconsult02                    = DB::table('users')->where('id',@$json->physicians03)->first();
        $doctorconsult03                    = DB::table('users')->where('id',@$json->physicians04)->first();
        $nurse01                            = DB::table('users')->where('id',@$json->nurse01)->first();
        $nurse02                            = DB::table('users')->where('id',@$json->nurse02)->first();
        $nurse03                            = DB::table('users')->where('id',@$json->nurse03)->first();
        $nurse04                            = DB::table('users')->where('id',@$json->nurse04)->first();
        $gender                             = DB::table('dd_gender')->where('gender_id',$patient->gender)->first();
        $room                               = DB::table('tb_room')->where('room_id',$case->case_room)->first();

        $caseuniq                           = array('caseuniq',$case->caseuniq);
        $comcreate                          = array('comcreate',$case->comcreate);

        $val['caseuniq']                    = $case->caseuniq;
        $val['comcreate']                   = $case->comcreate;
        $val['updatetime']                  = $case->updatetime;
        $val['report_cid']                  = $case->case_id;
        $val['report_hn']                   = pdpaEncode($patient->hn);
        $val['report_patientname']          = pdpaEncode($patient->firstname.' '.$patient->lastname);
        $val['report_age']                  = age($patient->birthdate);
        $val['report_gender']               = $gender->gender_name;
        $val['report_citizen']              = @$patient->citizen."";
        $val['report_allergic']             = @$patient->allergic."";
        $val['report_contact']              = @$patient->phone."";
        $val['report_conginital_disease']   = @$patient->congenital_disease."";
        $val['report_right2treatment']      = @$json->righttotreatment."";
        $datetime                           = explode(' ',$case->case_dateappointment);
        $date                               = explode('-',$datetime[0]);
        $time                               = explode(':',$datetime[1]);

        $val['report_appointment_date']     = $datetime[0];
        $val['report_appointment_year']     = $date[0];
        $val['report_appointment_month']    = $date[1];
        $val['report_appointment_day']      = $date[2];
        $val['report_appointment_time']     = $time[0];
        $val['report_procedure']            = @$json->procedurename;
        $val['report_endoscopist']          = @$json->doctorname;
        $val['report_doctorconsult01']      = @$doctorconsult01->name;
        $val['report_doctorconsult02']      = @$doctorconsult02->name;
        $val['report_doctorconsult03']      = @$doctorconsult03->name;
        $val['report_nurse01']              = @$nurse01->name;
        $val['report_nurse02']              = @$nurse02->name;
        $val['report_nurse03']              = @$nurse03->name;
        $val['report_nurse04']              = @$nurse04->name;
        $val['report_room']                 = @$room->room_name;
        $val['report_ward']                 = @$json->ward;
        $val['report_type_of_case']         = @$json->typeofcase;
        $val['report_opd']                  = @$json->opd;
        $val['report_refer']                = @$json->refer;
        $val['report_briefhistory']         = @$json->briefhistory;
        $val['report_prediagnosis']         = @$json->prediagnostic_other;
        $val['report_anesthesia']           = @$json->anesthesia;



        if(isset($json->endoscope)){
            $arr = array();
            foreach($json->endoscope as $scope){
                $tb_scope = DB::table('tb_scope')->where('scope_id',$scope)->first();
                if($tb_scope!=null){
                    $arr[] = $tb_scope->scope_name;
                }
            }
            $val['report_scope'] = jsonEncode($arr);
        }else{
            $val['report_scope'] = "";
        }




        $medication = DB::table('tb_casemedication')->where([$caseuniq,$comcreate])->first();
        if($medication!=null){
            $medijson   = jsonDecode($medication->medi_casejson);
            $arr = array();
            foreach($medijson as $medi=>$v){
                if($medi!=null){
                    $dd_anesthesis = DB::table('dd_anesthesis')->where('anesthesis_id',$medi)->first();
                    if($dd_anesthesis!=null){
                        $arr[$dd_anesthesis->anesthesis_name]=$v;
                    }
                }
            }
            $medij = jsonEncode($arr);
            $val['report_medication']           = @$medij;
        }else{
            $val['report_medication']           = "[]";
        }

        if(isset($json->finding)){
            $finding = jsonEncode($json->finding);
        }else{
            $finding ="{}";
        }
        $val['report_finding']              = $finding;

        $val['report_overallfinding']       = @$json->overallfinding;


        $texticd10 = array();
        if(isset($json->texticd10)){$texticd10 = jsonDecode($json->texticd10);}
        $val['report_diagnostic']            = @$json->texticd10;
        $val['report_diagnostic_primary']    = @$texticd10[0];
        $val['report_diagnostic_secondary']  = @$texticd10[1];
        $val['report_diagnostic_other01']    = @$texticd10[2];
        $val['report_diagnostic_other02']    = @$texticd10[3];
        $val['report_diagnostic_other03']    = @$texticd10[4];
        $val['report_diagnostic_freetext']   = @$json->overall_diagnosis;
        $arr = array();
        $icd10code = "";
        if(isset($json->diagnostic)){
            $proicd10 = jsonDecode($json->diagnostic);
            foreach($proicd10 as $key){
                $diagnostic = DB::table('tb_diagnostic')->where('diagnostic_name',$key)->first();
                $arr[] = @$diagnostic->icd10;
            }
            $icd10code = jsonEncode($arr);
        }
        $val['report_icd10code']            = @$icd10code;






        $texticd9 = array();
        if(isset($json->texticd9)){$texticd9    = jsonDecode($json->texticd9);}
        $val['report_procedure_icd9']           = @$json->overall_procedure;
        $val['report_procedure_primary']        = @$texticd9[0];
        $val['report_procedure_secondary']      = @$texticd9[1];
        $val['report_procedure_other01']        = @$texticd9[2];
        $val['report_procedure_other02']        = @$texticd9[3];
        $val['report_procedure_other03']        = @$texticd9[4];

        $arr = array();
        $icd9code = "";
        if(isset($json->proicd9)){
            $proicd9 = jsonDecode($json->proicd9);
            foreach($proicd9 as $key){
                $gettype = gettype($key);
                if($gettype != "object"){
                    $tb_procedureicd9 = DB::table('tb_procedureicd9')->where('proicd9_name',$key)->first();
                    $arr[] = @$tb_procedureicd9->icd9;
                }
            }
            $icd9code = jsonEncode($arr);
        }
        $val['report_icd9code']             = @$icd9code;
        $val['report_bowel']                = bowel(@$json->bowel);
        $val['report_complication']         = @$json->complication;
        $val['report_histopathology']       = @$json->histopathology;
        $val['report_recommendation']       = @$json->recommendation;
        $val['report_comment']              = @$json->comment;

        return $val;
    }


    function bowel($val){
        if($val==1){return "Excellent";}
        if($val==2){return "Good";}
        if($val==3){return "Fair";}
        if($val==4){return "Poor";}
        return "";
    }


    function keepLOGeditreport($cid,$pdfversion){
        $tb_case            = (object) Mongo::table('tb_case')->where('_id',$cid)->first();
        $case_pdfversion    = isset($tb_case->case_pdfversion) ? $tb_case->case_pdfversion : null;
        if(isset($tb_case->case_pdfversion)==false){
            Datacase::dataUPDATE($cid,['case_pdfversion'=>[]]);
        }

        $tb_case            = (object) Mongo::table('tb_case')->where('_id',$cid)->first();
        $case_pdfversion    = isset($tb_case->case_pdfversion) ? $tb_case->case_pdfversion : [];
        $newarr             = array_filter($case_pdfversion);
        $count              = count($newarr);
        $name               = "Endocapture";

        // เพิ่มกำกับภาษา
        $language_label = '';
        if (isset($tb_case->pdf_language)) {
            if ($tb_case->pdf_language == 'th') {
                $language_label = ' (TH)';
            } elseif ($tb_case->pdf_language == 'eng') {
                $language_label = ' (ENG)';
            }
        }
        $name .= $language_label;

        $newarr[$count]['user']    = $name;
        $newarr[$count]['when']    = date('Y-m-d H:i:s');
        $newarr[$count]['pdf']     = $pdfversion;
        $data['case_pdfversion']    =  $newarr;
        Mongo::table('tb_case')->where('_id',$cid)->update($data);
    }













?>
