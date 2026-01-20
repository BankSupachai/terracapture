<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Server;

class AllDataExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($r)
    {
        $this->request = $r;
    }

    public function collection()
    {
        $r = $this->request;
        $query = Server::table("tb_prepareexport");

        if (!empty($r->keyword)) {
            $query->where('text', 'like', '%' . $r->keyword . '%');
        }
        if (!empty($r->user)) {
            $query->where('doctorcode', intval($r->user));
        }
        if (!empty($r->procedure)) {
            $query->where('procedurecode', $r->procedure);
        }
        if (!empty($r->start_date)) {
            $query->where('date', '>=', $r->start_date);
        }
        if (!empty($r->end_date)) {
            $query->where('date', '<=', $r->end_date);
        }

        $cases = $query->get()->slice($r->download_start, 10000);
        return $this->changevalue($cases);
    }


    public function matchheader()
    {
        return [
            'HN' => "case_hn",
            'Name' => "patientname",
            'Age' => "age",
            'Gender' => "gender",
            'Treatment Coverage' => "treatment_coverage",
            'Appointment Date' => "appointment",
            'Procedure' => "procedurename",
            'Endoscopist' => "doctorname",
            'Assistant' => "user_in_case",
            'Nurse' => "user_in_case",
            'Nurse Assistant' => "user_in_case ",
            'Anesthesia' => "user_in_case",
            'Nurse Anesthesia' => "user_in_case ",
            'Patient type' => "case_type",
            'Scientific' => "user_in_case",
            'User Branch' => "branch ",
            'Department' => "department",
            'Scope' => "scope",
            'Scope Serial' => "scope_serial",
            'Room' => "room",
            'Ward' => "ward",
            'OPD' => "opd",
            'Refer' => "refer",
            'Patient In' => "time_patientin",
            'Start time' => "time_start",
            'Withdrawal (min)' => "time_withdrawal",
            'End time' => "time_end",
            'Followup' => "followup_date",
            'Brief History' => "case_history",
            'Pre-Diagnosis' => "prediagnostic_other",
            'Indication' => "indication",
            'Indication Other' => "indication_other",
            'Medication' => "select",
            'Medication other' => "medi_other",
            'Anesthesis' => "anesthesia",
            'Finding' => "finding",
            'Overall Finding' => "overall_finding",
            'Diagnosis (ICD 10)' => "diagnostic",
            'Diagnosis other' => "diagnostic_text",
            'Procedure (ICD 9)' => "procedure_subtext",
            'Procedure other' => "overall_procedure",
            'Bowel Preparation' => "bowel",
            'Bowel other' => "bowel_other",
            'Gastric Content' => "gastric content",
            'Estimate blood loss' => "blood_loss",
            'Blood Transfusion' => "blood_transfusion",
            'Rapid Urease Test' => "rapid_other",
            'Complication' => "complication",
            'Specimen' => "specimen1",
            'Comment' => "case_comment",
            'Status' => "statusjob",
        ];
    }

    public function printarray($array)
    {
        return implode(", ", $array ?? []);
    }

    public function changevalue($case)
    {
        $arr = [];
        $scopeCache = [];

        foreach ($case as $idx => $item) {
            $data = json_decode($item->text);
            $scopeData = $this->scope($data->scope ?? [], $scopeCache);

            $arr[$idx] = [
                'HN' => $this->printtext($data, "case_hn"),
                'Name' => $this->printtext($data, "patientname"),
                'Age' => $this->printtext($data, "age"),
                'Gender' => $this->gender($data->gender ?? "ไม่ระบุ"),
                'Treatment Coverage' => $this->printtext($data, "treatment_coverage"),
                'Appointment Date' => $this->printtext($data, "appointment"),
                'Procedure' => $this->printtext($data, "procedurename"),
                'Endoscopist' => $this->printtext($data, "doctorname"),
                'Assistant' => $this->printtext($data, "Assistant"),
                'Nurse' => $this->printarray($item->nurse ?? []),
                'Nurse Assistant' => $this->printarray($item->nurse_assistant ?? []),
                'Anesthesia' => $this->printarray($item->anesthesia ?? []),
                'Nurse Anesthesia' => $this->printarray($item->nurse_anes ?? []),
                'Patient type' => $this->printtext($data, "case_type"),
                'Scientific' => $this->printarray($item->scientific ?? []),
                'User Branch' => $this->printtext($data, "branch"),
                'Department' => $this->printtext($data, "department"),
                'Scope' => $scopeData['name'],
                'Scope Serial' => $scopeData['serial'],
                'Room' => $this->room($data->room ?? ""),
                'Ward' => $this->printtext($data, "ward"),
                'OPD' => $this->printtext($data, "opd"),
                'Refer' => $this->printtext($data, "refer"),
                'Patient In' => $this->printtext($data, "time_patientin"),
                'Start time' => $this->printtext($data, "time_start"),
                'Withdrawal (min)' => $this->printtext($data, "time_withdrawal"),
                'End time' => $this->printtext($data, "time_end"),
                'Followup' => $this->printtext($data, "followup_date"),
                'Brief History' => $this->printtext($data, "case_history"),
                'Pre-Diagnosis' => $this->printtext($data, "prediagnostic_other"),
                'Indication' => $this->arr2str($data->indication ?? []),
                'Indication other' => $this->printtext($data, "indication_other"),
                'Medication' => $this->medi($data ?? ""),
                'Medication other' => $this->mediother($data ?? ""),
                'Anesthesis' => $this->arr2str($data->anesthesia ?? []),
                'Finding' => $this->arr2str($data->finding ?? []),
                'Overall Finding' => $this->printtext($data, "overall_finding"),
                'Diagnosis (ICD 10)' => $this->procedure($data->diagnostic_text ?? []),
                'Diagnosis other' => $this->printtext($data, "overall_diagnosis"),
                'Procedure (ICD 9)' => $this->procedure($data->procedure_subtext ?? []),
                'Procedure (other)' => $this->printtext($data, "overall_procedure"),
                'Quality of Bowel' => $this->printtext($data, "bowel"),
                'Bowel other' => $this->printtext($data, "bowel_other"),
                'Gastric Content' => $this->arr2str($data->gastriccontent ?? []),
                'Estimate blood loss' => $this->printtext($data, "blood_loss"),
                'Blood Transfusion' => $this->printtext($data, "blood_transfusion"),
                'Rapid Urease Test' => $this->printtext($data, "rapid_other"),
                'Complication' => $this->arr2str($data->complication ?? []),
                'Specimen' => $this->specimen($data) ?? "",
                'Comment' => $this->printtext($data, "case_comment"),
                'Status' => $this->status($data->statusjob ?? null),
            ];
        }

        return collect($arr);
    }


    public function procedure($icd)
    {
        try {
            return implode(", ", array_filter($icd ?? []));
        } catch (\Throwable $th) {
            return "";
        }
    }

    public function medi($case)
    {
        try {
            if (!is_array($case) || empty($case['medication_unit'])) {
                return "";
            }

            $bank = [];
            foreach ($case['medication_unit'] as $key => $value) {
                if (!empty($value['dose'])) {
                    $bank[] = $key;
                }
            }

            $merge_medi = array_merge($case['select'] ?? [], $bank);
            $uniq = array_unique($merge_medi);

            $result = [];
            foreach ($uniq as $medi) {
                $dose = $case['medication_unit'][$medi]['dose'] ?? " - ";
                $unit = $case['medication_unit'][$medi]['unit'] ?? "";
                $result[] = $medi . " " . $dose . " " . $unit;
            }

            return implode("|", $result);
        } catch (\Throwable $th) {
            return "";
        }
    }

    public function printtext($data, $text, $default = "-")
    {
        try {
            if (isset($data->$text) && in_array(gettype($data->$text), ['string', 'integer'])) {
                return $data->$text;
            }
        } catch (\Throwable $th) {
        }
        return $default;
    }

    public function mediother($case)
    {
        return trim(($case->medi_other ?? "") . " " . ($case->medi_otherdose ?? "") . " " . ($case->medi_otherunit ?? ""));
    }

    public function status($statusjob)
    {
        return ($statusjob == "recovery") ? "Complete" : "Incomplete";
    }

    public function specimen($table)
    {
        $parts = [];
        for ($i = 1; $i <= 4; $i++) {
            $specimen = $table->{"specimen{$i}"} ?? "";
            $bottle = $table->{"specimenbottle{$i}"} ?? "";
            if ($specimen || $bottle) {
                $parts[] = trim($specimen . " " . $bottle);
            }
        }
        return implode("|", $parts);
    }

    public function arr2str($source)
    {
        try {
            if (is_array($source)) {
                $parts = [];
                foreach ($source as $key => $value) {
                    $parts[] = "[$key : $value]";
                }
                return implode(" ,", $parts);
            }
            if (is_object($source)) {
                $parts = [];
                foreach ($source as $key => $value) {
                    $parts[] = "[$key : $value]";
                }
                return implode("", $parts);
            }
        } catch (\Throwable $th) {
        }
        return "";
    }

    public function gender($val)
    {
        return match($val) {
            1 => "male",
            2 => "female",
            default => "-"
        };
    }


    public function room($val)
    {
        try {
            $tb_room = Server::table("tb_room")->where("room_id", intval($val))->first();
            return $tb_room['room_name'] ?? "-";
        } catch (\Throwable $th) {
            return "-";
        }
    }

    public function scope($val, &$cache = [])
    {
        $scopename = [];
        $serialarr = [];

        foreach ($val as $value) {
            $scopeId = intval($value);
            if (isset($cache[$scopeId])) {
                $scopename[] = $cache[$scopeId]['name'];
                $serialarr[] = $cache[$scopeId]['serial'];
            } else {
                $temp = Server::table("tb_scope")->where("scope_id", $scopeId)->first();
                if ($temp) {
                    $name = $temp->scope_name ?? "";
                    $serial = $temp->scope_serial ?? "";
                    $cache[$scopeId] = ['name' => $name, 'serial' => $serial];
                    $scopename[] = $name;
                    $serialarr[] = $serial;
                }
            }
        }

        return [
            'name' => !empty($scopename) ? implode(",", $scopename) : "-",
            'serial' => !empty($serialarr) ? implode(",", $serialarr) : "-"
        ];
    }

    public function headings(): array
    {
        return array_keys($this->matchheader());
    }
}
