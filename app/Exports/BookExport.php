<?php
// app/Exports/UsersExport.php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\Mongo;
use App\Models\Server;
use MongoDB\BSON\Regex;

class Bookexport implements FromCollection, WithHeadings
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

        if ($keyword != "") {
            $tb_booking    = Mongo::table("tb_booking")
                // ->whereArr($search)
                // ->where(function ($query) use ($keyword) {
                //     $query->orWhere('title', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('case_hn', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('procedurename', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('case_history', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('indication', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('indication_other', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('medication_unit', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('medi_other', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('anesthesia', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('anesthesiaother', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('finding', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('overall_finding', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('diagnostic_text', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('overall_diagnosis', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('procedure_subtext', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('bowel_other', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('bowelpreparation', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('gastriccontent', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('specimen1', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('specimen2', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('specimen3', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('specimen4', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('box_rapid_pending', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('rapid_other', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('complication', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('technique_other', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('case_comment', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('assistant', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('urgent', 'regexp', new Regex($keyword, 'i'))
                //         ->orWhere('overall_procedure', 'regexp', new Regex($keyword, 'i'));
                // })
                ->get();
        } else {
            $tb_booking    = Mongo::table("tb_booking")->get();
            // dd($tb_booking);
        }
        $tb_booking       = $tb_booking->slice($_SESSION['download_start'], 10000);
        $arr        = $this->changevalue($tb_booking);
        return $arr;
    }


    public function matchheader()
    {
        // $v['CaseID']            = "_ID";
        // $v['ลำดับ']                = "ลำดับ";
        $v['HN']              = "HN";
        $v['ชื่อ-นามสกุล']               = "Patient_name";
        $v['แพทย์ผู้นัด']            = "physician name";
        $v['หัตถการ']  = "Procedure";
        $v['นัดจาก']  = "Patienttype";
        $v['หมายเหตุ']  = "book_reason";
        // $v['เบอร์ติดต่อ']  = "phone";



        return $v;
    }

    public function changevalue($tb_booking)
    {
        $arr = array();

        foreach ($tb_booking as $key01 => $key02) {
            $arr[$key01]['HN']                  = $this->printtext($key02, "hn", "-");
            $arr[$key01]['patientname']                = $this->printtext($key02, "patientname", "-");
            $arr[$key01]['doctorname']         = $this->printtext($key02, "doctorname", "-");
            $arr[$key01]['Procedure']           = "-";
            $arr[$key01]['patient_type']                 = $this->printtext($key02, "patient_type", "-");
            $arr[$key01]['book_reason']              = $this->printtext($key02, "book_reason" , "-");
            // $arr[$key01]['book_phone']    = $this->printtext($key02, "appointment", "-");


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
            if (isset($data[$text])) {
                if (gettype($data[$text]) == 'string' || gettype($data[$text]) == 'integer') {
                    $str = $data[$text];
                }
            }
        } catch (\Throwable $th) {
        }
        return $str;
    }


    public function mediother($case)
    {
        $str = "";
        $str .= @$case['medi_other'] . " " . @$case['medi_otherdose'] . " " . @$case['medi_otherunit'] ;
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
        $str .= @$table['specimen1'] . " " . @$table['specimenbottle1'] . "|";
        $str .= @$table['specimen2'] . " " . @$table['specimenbottle2'] . "|";
        $str .= @$table['specimen3'] . " " . @$table['specimenbottle3'] . "|";
        $str .= @$table['specimen4'] . " " . @$table['specimenbottle4'];
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
