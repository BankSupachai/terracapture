<?php
// app/Exports/UsersExport.php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Mongo;
use App\Models\Server;
use MongoDB\BSON\Regex;

class DataExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $temp = array();
        foreach ($this->matchheader() as $key => $value) {
            if ($value != "") {
                $temp[] = $value;
            }
        }
        $search     = $_SESSION['search'];
        $keyword    = $_SESSION['keyword'];
        $tb_case = Server::table("tb_case");

        if ($keyword != "") {
            $tb_case    = Server::table("tb_case")
                ->where(function ($query) use ($keyword) {
                    $query->orWhere('title', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('case_hn', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('procedurename', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('case_history', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('indication', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('indication_other', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('medication_unit', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('medi_other', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('anesthesia', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('anesthesiaother', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('finding', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('overall_finding', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('diagnostic_text', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('overall_diagnosis', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('procedure_subtext', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('bowel_other', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('bowelpreparation', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('gastriccontent', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('specimen1', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('specimen2', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('specimen3', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('specimen4', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('box_rapid_pending', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('rapid_other', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('complication', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('technique_other', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('case_comment', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('assistant', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('urgent', 'regexp', new Regex($keyword, 'i'))
                        ->orWhere('overall_procedure', 'regexp', new Regex($keyword, 'i'));
                })
                ->get();
        } else {
                $tb_case    = Server::table("tb_case");
        }

        $r = (object) $_SESSION['inputall'];
        // $r = $temp;


        if (isset($r->start_date)) {
            $tb_case->where('appointment_date', '>=', $r->start_date);
        }
        if (isset($r->end_date)) {
            $tb_case->where('appointment_date', '<=', $r->end_date);
        }

        @$r->procedure   ? $tb_case->whereIn('case_procedurecode', @$r->procedure) : '';
        @$r->user        ? $tb_case->whereIn('case_physicians01', @$r->user) : '';
        @$r->scope       ? $tb_case->whereIn('scope', @$r->scope) : '';
        @$r->icd10       ? $tb_case->whereIn('diagnostic', @$r->icd10) : '';
        @$r->icd9        ? $tb_case->whereIn('proicd9', @$r->icd9) : '';
        @$r->indication  ? $tb_case->whereIn('indication', @$r->indication) : '';
        @$r->department  ? $tb_case->where('department', @$r->department) : '';
        @$r->user_type   ? $tb_case->where('branch', @$r->user_type) : '';
        @$r->room        ? $tb_case->where('room', @$r->room) : '';

        $tb_case = $tb_case->get();


        // dd($tb_case,$_SESSION,$r);



        $case       = $tb_case->slice($_SESSION['download_start'], 10000);
        $arr        = $this->changevalue($case);
        return $arr;
    }


    public function matchheader()
    {
        // $v['CaseID']            = "_ID";
        $v['HN']                = "case_hn";
        $v['Name']              = "patientname";
        $v['Age']               = "age";
        $v['Gender']            = "gender";
        $v['Treatment Coverage']         = "treatment_coverage";
        $v['Appointment Date']  = "appointment";
        // $v['Operation Date']    = "appointment_date";
        $v['Procedure']         = "procedurename";
        $v['Endoscopist']       = "doctorname";
        $v['Assistant']         = "user_in_case";
        $v['Nurse']             = "user_in_case";
        $v['Nurse Assistant']   = "user_in_case ";
        $v['Anesthesia']         = "user_in_case";
        $v['Nurse Anesthesia']   = "user_in_case ";
        $v['Patient type']       = "case_type";
        $v['Scientific']         = "user_in_case";
        $v['User Branch']   = "branch ";
        $v['Department'] = "department";
        // $v['Anesthesia']        = "anes";
        $v['Scope']             = "scope";
        $v['Room']              = "room";
        $v['Ward']              = "ward";
        $v['OPD']               = "opd";
        $v['Refer']             = "refer";
        $v['Patient In']        = "time_patientin";
        $v['Start time']    = "time_start";
        $v['Withdrawal (min)']  = "time_withdrawal";
        $v['End time']     = "time_end";
        $v['Followup']          = "followup_date";
        $v['Brief History']     = "case_history";
        $v['Pre-Diagnosis']     = "prediagnostic_other";
        $v['Indication']        = "indication";
        $v['Indication Other']        = "indication_other";

        $v['Medication']        = "select";
        $v['Medication other']        = "medi_other";

        $v['Anesthesis']        = "anesthesia";
        $v['Finding']           = "finding";
        $v['Overall Finding']   = "overall_finding";
        // $v['Gastric Content']   = "gastriccontent";
        // $v['Bowel Preparation'] = "bowelpreparation" ;
        $v['Diagnosis (ICD 10)']    = "diagnostic";
        $v['Diagnosis other'] = "diagnostic_text";
        $v['Procedure (ICD 9)'] = "procedure_subtext";
        $v['Procedure other'] = "overall_procedure";
        // ทำถึง icd 9 แล้วนะ
        $v['Bowel Preparation'] = "bowel";
        $v['Bowel other'] = "bowel_other";
        $v['Gastric Content'] = "gastric content";
        $v['Estimate blood loss'] = "blood_loss";
        $v['Blood Transfusion'] = "blood_transfusion";
        $v['Rapid Urease Test'] = "rapid_other";
        $v['Complication']      = "complication";
        $v['Specimen']          = "specimen1";
        $v['Comment']           = "case_comment";
        $v['Status']            = "statusjob";
        return $v;
    }

    public function changevalue($case)
    {
        $arr = array();

        foreach ($case as $key01 => $key02) {
            $arr[$key01]['HN']                  = $this->printtext($key02, "case_hn", "-");
            $arr[$key01]['Name']                = $this->printtext($key02, "patientname", "-");
            $arr[$key01]['Age']                 = $this->printtext($key02, "age", "-");
            $arr[$key01]['Gender']              = $this->gender($key02->gender ?? "ไม่ระบุ");
            $arr[$key01]['Treatment Coverage']  = $this->printtext($key02, "treatment_coverage", "-");
            $arr[$key01]['Appointment Date']    = $this->printtext($key02, "appointment", "-");
            $arr[$key01]['Procedure']           = $this->printtext($key02, "procedurename", "-");
            $arr[$key01]['Endoscopist']         = $this->printtext($key02, "doctorname", "-");
            $arr[$key01]['Assistant']           = $this->printtext($key02, "Assistant", "-");
            $arr[$key01]['Nurse']               = $this->userincase($key02->user_in_case ?? [], "nurse");
            $arr[$key01]['Nurse Assistant']     = $this->userincase($key02->user_in_case ?? [], "nurse_assistant");
            $arr[$key01]['Anesthesia']          = $this->userincase($key02->user_in_case ?? [], "anesthesia");
            $arr[$key01]['Nurse Anesthesia']    = $this->userincase($key02->user_in_case ?? [], "nurse_anes");
            $arr[$key01]['Patient type']        = $this->printtext($key02, "case_type", "-");
            $arr[$key01]['Scientific']    = $this->userincase($key02->user_in_case ?? [], "scientific");
            $arr[$key01]['Patient type']    = $this->printtext($key02, "case_type", "-");
            $arr[$key01]['User Branch']         = $this->printtext($key02, "branch", "-");
            $arr[$key01]['Department']          = $this->printtext($key02, "department", "-");
            $arr[$key01]['Scope']               = $this->scope($key02->scope ?? []);
            $arr[$key01]['Room']                = $this->room($key02->room ?? "");
            $arr[$key01]['Ward']                = $this->printtext($key02, "ward", "-");
            $arr[$key01]['OPD']                 = $this->printtext($key02, "opd", "-");
            $arr[$key01]['Refer']               = $this->printtext($key02, "refer", "-");
            $arr[$key01]['Patient In']          = $this->printtext($key02, "time_patientin", "-");
            $arr[$key01]['Start time']          = $this->printtext($key02, "time_start", "-");
            $arr[$key01]['Withdrawal (min)']    = $this->printtext($key02, "time_withdrawal", "-");
            $arr[$key01]['End time']            = $this->printtext($key02, "time_end", "-");
            $arr[$key01]['Followup']            = $this->printtext($key02, "followup_date", "-");
            $arr[$key01]['Brief History']       = $this->printtext($key02, "case_history", "-");
            $arr[$key01]['Pre-Diagnosis']       = $this->printtext($key02, "prediagnostic_other", "-");
            $arr[$key01]['Indication']          = $this->arr2str($key02->indication ?? []);
            $arr[$key01]['Indication other']    = $this->printtext($key02, "indication_other", "-");

            $arr[$key01]['Medication']          = $this->medi($key02 ?? "");
            $arr[$key01]['Medication other']    = $this->mediother($key02 ?? "");

            $arr[$key01]['Anesthesis']          = $this->arr2str($key02->anesthesia ?? []);
            $arr[$key01]['Finding']             = $this->arr2str($key02->finding ?? []);
            $arr[$key01]['Overall Finding']     = $this->printtext($key02, "overall_finding", "-");
            $arr[$key01]['Diagnosis (ICD 10)'] = $this->procedure($key02->diagnostic_text ?? []);


            $arr[$key01]['Diagnosis other']     = $this->printtext($key02, "overall_diagnosis", "-");
            $arr[$key01]['Procedure (ICD 9)']   = $this->procedure($key02->procedure_subtext ?? []);
            $arr[$key01]['Procedure (other)']   = $this->printtext($key02, "overall_procedure", "-");
            $arr[$key01]['Quality of Bowel']    = $this->printtext($key02, "bowel", "-");
            $arr[$key01]['Bowel other']         = $this->printtext($key02, "bowel_other", "-");
            $arr[$key01]['Gastric Content']     = $this->arr2str($key02->gastriccontent ?? []);
            $arr[$key01]['Estimate blood loss'] = $this->printtext($key02, "blood_loss", "-");
            $arr[$key01]['Blood Transfusion']   = $this->printtext($key02, "blood_transfusion", "-");
            $arr[$key01]['Rapid Urease Test']   = $this->printtext($key02, "rapid_other", "-");
            $arr[$key01]['Complication']        = $this->arr2str($key02->complication ?? []);
            $arr[$key01]['Specimen']            = $this->specimen($key02) ?? "";
            $arr[$key01]['Comment']             = $this->printtext($key02, "case_comment", "-");
            $arr[$key01]['Status']              = $this->status(@$key02->statusjob);
        }
        $collection = collect($arr);
        return $collection;
    }


    public function procedure($icd){
        $str = "";
        try {
            $str = implode(", ", array_filter($icd ?? []));

        } catch (\Throwable $th) {
            //throw $th;
        }
        return $str;
    }

    public function medi($case){
        $bank = array();
        $str = "";
        try {
            foreach ($case['medication_unit'] as $key => $value) {
                // dd($value['dose']);
                if(isset($value['dose'])){
                    if($value['dose'] != ""){
                        $bank[] = $key;
                     }
                 }
             }
             $merge_medi = array_merge($case['select'] , $bank);
             $uniq = array_unique($merge_medi);


             foreach ($uniq as $medi) {
                 // dd($medi);
                 $str.=$medi." ";
                 $str.=$case['medication_unit'][$medi]['dose'] ? $case['medication_unit'][$medi]['dose']:" - ";
                 $str.=$case['medication_unit'][$medi]['unit'] ? $case['medication_unit'][$medi]['unit'] : "";
                 $str.="|";

             }
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $str;

    }






    public function printtext($data, $text, $str)
    {
        try {
            if (isset($data->$text)) {
                if (gettype($data->$text) == 'string' || gettype($data->$text) == 'integer') {
                    $str = $data->$text;
                }
            }
        } catch (\Throwable $th) {
        }
        return $str;
    }


    public function mediother($case)
    {
        $str = "";
        $str .= @$case->medi_other . " " . @$case->medi_otherdose . " " . @$case->medi_otherunit ;
        return $str;
    }


    public function status($statusjob)
    {
        $str = "Complete";
        if ($statusjob != "recovery") {
            $str = "Incomplete";
        }
        return $str;
    }

    public function specimen($table)
    {
        $str = "";
        $str .= @$table->specimen1 . " " . @$table->specimenbottle1 . "|";
        $str .= @$table->specimen2 . " " . @$table->specimenbottle2 . "|";
        $str .= @$table->specimen3 . " " . @$table->specimenbottle3 . "|";
        $str .= @$table->specimen4 . " " . @$table->specimenbottle4;
        if ($str == " | | | ") {
            $str = "";
        }
        return $str;
    }

    public function medi_json($medication){
        $str = "";
        try {
            $str = json_encode($medication);
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $str ;
    }

    public function arr2str($source)
    {
        $str = "";
        try {
            //code...
            if (gettype($source) == "array") {
                foreach ($source as $key => $value) {
                    try {
                        $str .= "[$key : $value] ,";
                    } catch (\Throwable $th) {
                        // throw $th;
                    }
                }
            }
            if (gettype($source) == "object") {
                foreach ($source as $key => $value) {
                    try {
                        $str .= "[$key : $value]";
                    } catch (\Throwable $th) {
                        // throw $th;
                    }
                }
            }
        } catch (\Throwable $th) {
        }
        return $str;
    }

    public function userincase($val, $type)
    {
        $str = "-";
        $names = [];
        if(gettype($val) == "array" || gettype($val) == "object"){
            foreach ($val as $key => $value) {
                $user = Server::table("users")
                    ->where("id", intval($value))
                ->where("user_type", $type)
                ->first();
            if ($user) {
                $names[] = fullname($user);
                }
            }
            if (!empty($names)) {
                $str = implode(', ', $names);
            }
        }

        return $str;
    }



    public function gender($val)
    {
        $str = "-";
        if ($val == 1) {
            $str = "male";
        }
        if ($val == 2) {
            $str = "female";
        }
        return $str;
    }


    public function room($val)
    {
        $str = "-";
        try {
            $tb_room = Server::table("tb_room")->where("room_id", intval($val))->first();
            if ($tb_room) {
                $str = $tb_room['room_name'];
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $str;
    }

    public function scope($val)
    {
        $str = "-";
        $scopename = array();
        try {
            foreach ($val as $value) {
                $temp = Server::table("tb_scope")->where("scope_id", intval($value))->get();
            }

            foreach ($temp as $scope) {
                $scopename[] = $scope['scope_name'];
            }
            $str = implode(",", $scopename);
        } catch (\Throwable $th) {
            //throw $th;
        }


        return $str;
    }

    public function anes($val)
    {
        $str = "";
        // dd(gettype($val));
        try {
            if (gettype($val) == "array") {
                foreach ($val as $key => $value) {
                    $users = Mongo::table("users")->where("uid", intval($value))->first();
                    if ($users) {
                        $str .=  fullname($users) . "|";
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $str;
    }


    public function headings(): array
    {
        $temp = array();
        foreach ($this->matchheader() as $key => $value) {
            $temp[] = $key;
        }
        return $temp;
    }
}
