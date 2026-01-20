<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CasesExport implements FromCollection, WithHeadings, WithChunkReading
{
    protected $cases;
    protected $heads;
    protected $values;
    protected $search;

    public function __construct(Collection $cases, $heads=[], $values=[])
    {
        $this->cases = $cases;
        $this->heads = $heads;
        $this->values = $values;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->cases;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * @return array
     */
    public function headings(): array
    {

        $headings = count($this->heads) == 0 ? [
            'Case ID',
            'HN',
            'Name',
            'Age',
            'Gender',
            'Appointment Date',
            'Operation Date',
            'Procedure',
            'Endoscopist',
            'User Department',
            'Department (Case)',
            'Attendant',
            'Nurse',
            'Nurse Assistant',
            'Anesthesia',
            'Scope',
            'Room',
            'Ward',
            'OPD',
            'Refer',
            'Patient In',
            'Operation Start',
            'Operation End',
            'Withdrawal (min)',
            'Endoscope',
            'Followup',
            'Gastric Content',
            'Bowel Preparation',
            'Brief History',
            'Pre-Diagnosis',
            'Anesthesis',
            'Medication',
            'Indication',
            'Finding',
            'Overall Finding',
            'Post-Diagnosis',
            'Post-Diagnosis (other)',
            'Procedures',
            'ICD-10',
            'ICD-9',
            'Rapid Urease Test',
            'Complication',
            'Estimate blood loss',
            'Blood Transfusion',
            'Specimen',
            'Comment',
            'Status'
        ] : $this->heads;

        return $headings;

    }

    public function keys(): array
    {
        $keys = [
            'case_id',
            'case_hn',
            'patientname',
            'age',
            'gender',
            'appointment',
            'operationdate',
            'procedurename',
            'doctorname',
            'branch',
            'department',
            'attendant',
            'nurse',
            'nurse_assist',
            'anesthesia',
            'scopes',
            'room_name',
            'ward',
            'opd',
            'refer',
            'time_patientin',
            'time_start',
            'time_end',
            'time_withdrawal',
            'scopes_only',
            'followup_date',
            'gastriccontent',
            'gastriccontent_other', // combined with gastriccontent
            'bowel',
            'case_history',
            'prediagnostic_other',
            'anesthesia', // combined with anesthesiaother
            'anesthesiaother',
            'medication', // combined with medi_str
            'medi_str',
            'indication', // combined with indication_other
            'indication_other',
            'mainpart',
            'overall_finding',
            'postdiagnosis10',
            'overall_diagnosis',
            'procedureicd9',
            'needcode_icd10',
            'needcode_icd9',
            'rapid_other',
            'complication',
            'blood_loss',
            'blood_transfusion',
            'specimen_str',
            'case_comment',
            'status'
        ];
        return $keys;
    }

    public function match_key() : array {
        return [
            'case_id' => 'Case ID',
            'case_hn' => 'HN',
            'patientname' => 'Name',
            'age' => 'Age',
            'gender' => 'Gender',
            'appointment' => 'Appointment Date',
            'operationdate'=> 'Operation Date',
            'procedurename' => 'Procedure',
            'doctorname' => 'Endoscopist',
            'branch' => 'User Department',
            'department' => 'Department (Case)',
            'attendant' => 'Attendant',
            'nurse' => 'Nurse',
            'nurse_assist' => 'Nurse Assistant',
            'anesthesia' => 'Anesthesia',
            'scopes' => 'Scope',
            'room_name' => 'Room',
            'ward' => 'Ward',
            'opd' => 'OPD',
            'refer' => 'Refer',
            'time_patientin' => 'Patient In',
            'time_start' => 'Operation Start',
            'time_end' => 'Operation End',
            'time_withdrawal' => 'Withdrawal (min)',
            'scopes_only' => 'Endoscope',
            'followup_date' => 'Followup',
            'gastriccontent' => 'Gastric Content',
            'gastriccontent_other' => 'Gastric Content (Other)', // combined with gastriccontent
            'bowel' => 'Bowel Preparation',
            'case_history' => 'Brief History',
            'prediagnostic_other' => 'Pre-Diagnosis',
            'anesthesiaother' => 'Anesthesis (Other)', // combined with anesthesia
            'medication' => 'Medication', // combined with medi_str
            'medi_str' => 'Medication (Other)', // combined with medi_str
            'indication' => 'Indication', // combined with indication_other
            'indication_other' => 'Indication (Other)',
            'mainpart' => 'Finding',
            'overall_finding' => 'Overall Finding',
            'postdiagnosis10' => 'Post-Diagnosis',
            'overall_diagnosis' => 'Post-Diagnosis (Other)',
            'procedureicd9' => 'Procedures',
            'needcode_icd10' => 'ICD-10',
            'needcode_icd9' => 'ICD-9',
            'rapid_other' => 'Rapid Urease Test',
            'complication' => 'Complication',
            'blood_loss' => 'Estimate blood loss',
            'blood_transfusion' => 'Blood Transfusion',
            'specimen_str' => 'Specimen',
            'case_comment' => 'Comment',
            'status' => 'Status'
        ];
    }

    public function getMatchingHeadings(array $distinctkeys): array
    {
        $matchKey = $this->match_key();
        $displayStatus = [];
        foreach ($matchKey as $key => $heading) {
            $displayStatus[$key] = in_array($key, $distinctkeys) ? 'show' : 'hide';
            if($key == 'status'){
                $displayStatus[$key] = 'show';
            }
        }
        return $displayStatus;
    }
}
