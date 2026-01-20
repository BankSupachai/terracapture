<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Endocapture\ProcedureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Server;
use DateTime;
use Exception;

class CalbookController extends Controller
{



    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $this->$event($r);
        }
    }


    public function caselist_view($r)
    {
        // dd(1);
        $user_department    = uget("department");
        $user_type          = uget("user_type");
        $filter_physician   = $r->physician;
        $filter_department  = $r->department;
        $effectiveDate      = date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));
        $arr = array();
        // $w[] = array("date", ">", date("Y-m-d"));
        $w[] = array("confirm" , "!=" , "cancel" );
        $w[] = array("date", "<", $effectiveDate);
        if ($filter_physician != "") {
            $w[] = array("physician", $r->physician);
        }
        if ($filter_department != "") {

            $w[] = array("department", $r->department);
        }
        // dd($w , $user_type);
        if ($user_type == "doctor") {
            $w[] = array("physician", uid());
            $tb_booking = Mongo::table("tb_booking")
            ->groupBy('date')
            ->where($w)
            ->get();
        } else {
            $tb_booking = Mongo::table("tb_booking")
                ->groupBy('date')
                ->where($w)
                ->get();
        }

        $i = 0;
        $countcase = 0;
        $countcase = Mongo::table("tb_booking")->where($w)->count();
        // dd($countcase);
        foreach ($tb_booking as $key => $value) {
            $arr[$i]['start']           = $value->date;
            $arr[$i]['title'] = "Case list " . "($countcase)";
            $arr[$i]['backgroundColor'] = "#2457882e";
            $arr[$i]['borderColor']     = "#2457882e";
            $arr[$i]['textColor']       = "#245788";
            $arr[$i]['value']       = "caselist";
            $i++;
        }
        // dd($tb_booking);
        printJSON($arr);

    }


    public function filter_book($r)
    {

        $doctorwork = $this->doctorwork($r);
        $booking = getCONFIG("booking");
        $department = $r->department;
        $physician = $r->physician;
        $book_type = $r->selectedValue;
        $arr = array();
        $effectiveDate  = date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));
        // $w[] = array("date", ">", date("Y-m-d"));
        $w[] = array("date", "<", $effectiveDate);

        // dd($effectiveDate);
        // if ($department != "") {
        //     $w[] = array("department", $department);

        // }

        // if ($physician != "") {
        //     $w[] = array("physician", intval($physician));

        // }
        if ($book_type == "patienttype") {
            $arr = $this->patienttype($r, $w, $booking);
        }

        if ($book_type == "urgent") {
            $arr = $this->urgent($r, $w, $effectiveDate);
        }

        if ($book_type == "density") {
            $arr = $this->density($r, $w, $effectiveDate);
        }

        // $tb_booking = Mongo::table("tb_booking")->where($w)->get();
        // $arr = $tb_booking;

        // dd($arr);
        printJSON($arr);
    }


    public function patienttype($r, $w, $booking)
    {

        if ($r->physician) {
            $w[] = array("physician", intval($r->physician));
        }

        $tb_booking = Mongo::table("tb_booking")
            ->where(function ($query) {
                $query->where('period', 'am')
                    ->orWhere('period', 'pm')
                    ->orWhere('period', 'ot');
            })
            ->where($w)
            ->where("confirm", "!=", "cancel")
            ->get();

        $i = 0;
        $dateservice = array();
        foreach ($tb_booking as $key => $value) {





            if ($value->period == "am" && !in_array($value->date . "am", $dateservice)) {
                array_push($dateservice, $value->date . "am");
                $count_am = count(array_filter($value->procedure));
                $arr[$i]['start']           = $value->date;
                $arr[$i]['title']           = ($booking->period_service ?? "AM") . " " . "($count_am)";
                $arr[$i]['backgroundColor'] = "#2457882e";
                $arr[$i]['borderColor']     = "#2457882e";
                $arr[$i]['textColor']       = "#245788";
                $i++;
            }

            if ($value->period == "pm" && !in_array($value->date . "pm", $dateservice)) {
                array_push($dateservice, $value->date . "pm");
                $count_pm = count(array_filter($value->procedure));
                $arr[$i]['start']           = $value->date;
                $arr[$i]['title']           = ($booking->period_special ?? "PM") . " " . "($count_pm)";
                $arr[$i]['backgroundColor'] = "#F7B84B2e";
                $arr[$i]['borderColor']     = "#F7B84B2e";
                $arr[$i]['textColor']       = "#F7B84B";
                $i++;
            }

            if ($value->period == "ot" && !in_array($value->date . "ot", $dateservice)) {
                array_push($dateservice, $value->date . "ot");
                $count_ot = count(array_filter($value->procedure));
                $arr[$i]['start']           = $value->date;
                $arr[$i]['title']           = ($booking->period_overtime ?? "OT") . " " . "($count_ot)";
                $arr[$i]['backgroundColor'] = "#F065482e";
                $arr[$i]['borderColor']     = "#F065482e";
                $arr[$i]['textColor']       = "#F06548";
                $i++;
            }
        }
        return $arr;
    }


    public function urgent($r, $w, $effectiveDate)
    {
        if ($r->physician) {
            $w[] = array("physician", intval($r->physician));
        }



        $arr = array();
        $tb_booking = Mongo::table("tb_booking")
            ->where(function ($query) {
                $query->where('urgent', 'urgency')
                    ->orWhere('urgent', 'elective')
                    ->orWhere('urgent', 'emergency');
            })
            ->where($w)
            ->where("confirm", "!=", "cancel")
            ->get();

        $i = 0;
        $dateservice = array();


        foreach ($tb_booking as $key => $value) {

            if ($value->urgent == "elective" && !in_array($value->date . "elective", $dateservice)) {

                array_push($dateservice, $value->date . "elective");
                $count_elective = count(array_filter($value->procedure));
                $arr[$i]['start']           = $value->date;
                $arr[$i]['title']           = "Elective ($count_elective)";
                $arr[$i]['backgroundColor'] = "#2457882e";
                $arr[$i]['borderColor']     = "#2457882e";
                $arr[$i]['textColor']       = "#245788";
                $i++;
            }

            if ($value->urgent == "urgency" && !in_array($value->date . "urgency", $dateservice)) {
                array_push($dateservice, $value->date . "urgency");
                $count_urgency = count(array_filter($value->procedure));
                $arr[$i]['start']           = $value->date;
                $arr[$i]['title']           = "Urgency ($count_urgency)";
                $arr[$i]['backgroundColor'] = "#F7B84B2e";
                $arr[$i]['borderColor']     = "#F7B84B2e";
                $arr[$i]['textColor']       = "#F7B84B";
                $i++;

            }

            if ($value->urgent == "emergency" && !in_array($value->date . "emergency", $dateservice)) {
                array_push($dateservice, $value->date . "emergency");
                $count_emergency = count(array_filter($value->procedure));
                $arr[$i]['start']           = $value->date;
                $arr[$i]['title']           = "Emergency ($count_emergency)";
                $arr[$i]['backgroundColor'] = "#F065482e";
                $arr[$i]['borderColor']     = "#F065482e";
                $arr[$i]['textColor']       = "#F06548";
                $i++;
            }
        }
        // dd($arr);
        return $arr;
    }







    public function density($r, $w, $effectiveDate)
    {
        // dd($r, $w, $effectiveDate);
        $arr = array();
        $tempdate = array();
        if ($r->physician) {
            $w2[] = array("physician", intval($r->physician));
        }
        if ($r->department) {
            $w2[] = array("department", $r->department);
        }
        // $w2[] = array("date", ">", date("Y-m-d"));
        $w2[] = array("date", "<", $effectiveDate);

        $tb_booking = Mongo::table("tb_booking")
            ->where($w2)
            ->where("confirm", "!=", "cancel")
            // ->where("period", "am")
            ->get();
        $i = 0;

        foreach ($tb_booking as $key => $data) {
            // นับจำนวนเคสทั้งหมดในวันนั้น
            $count_case = 0;
            foreach($tb_booking as $booking) {
                if($booking->date == $data->date) {
                    $count_case += count(array_filter($booking->procedure));
                }
            }

            if (!in_array($data->date, $tempdate)) {
                $tempdate[] = $data->date;
                $tb_bookcal = Mongo::table('tb_bookcal')
                    ->where("date", $data->date)
                    ->Orwhere("id", $data->id)
                    ->first();

                $arr[$i]['date'] = @$data->date;
                $percent = @$tb_bookcal->timeusedpercent;
                // dd($data);
                if ($percent >= 0 && $percent < 60) {
                    $arr[$i]['title'] = "Available " . "($count_case)";
                    $arr[$i]['backgroundColor'] = "#0ab39c2e";
                    $arr[$i]['borderColor']     = "#0ab39c2e";
                    $arr[$i]['textColor']            = "#0ab39c";
                    $i++;
                }

                if ($percent >= 60 && $percent < 80) {
                    $arr[$i]['title'] = "Available " . "($count_case)";
                    $arr[$i]['backgroundColor'] = "#f7b84b2e";
                    $arr[$i]['borderColor']     = "#f7b84b2e";
                    $arr[$i]['textColor']     = "#f7b84b";
                    $i++;
                }

                if ($percent >= 80) {
                    $arr[$i]['title'] = "Full " . "($count_case)";
                    $arr[$i]['backgroundColor'] = "#f065482E";
                    $arr[$i]['borderColor']     = "#f065482E";
                    $arr[$i]['textColor']     = "#f06548";
                    $i++;
                }
            }
        }
        return $arr;
    }





    /*
    คำนวณหาวันที่ลงเคสได้
    */
    public function calbook($r)
    {
        // dd($r->all());
        $effectiveDate  = date('Y-m-d', strtotime("+10 months", strtotime(date('Y-m-d'))));
        $procedurescore = 0;
        // $tb_bookcal     = array();


        $doctorwork = $this->doctorwork($r);

        $w[] = array("physicianArray", intval($r->physician));
        $w[] = array("statusbook", true);
        $w[] = array("period", $r->period);
        $w[] = array("date", ">", date("Y-m-d"));
        $w[] = array("date", "<", $effectiveDate);
        // $w[] = array("timeusedpercent","<",81);




        if (isset($r->procedure1)) {
            $w[] = array("procedureArray", $r->procedure1);
            $w[] = array("physicianmaxArray", "!=", $r->procedure1);
            $procedurescore++;
        }
        if (isset($r->procedure2)) {
            $w[] = array("procedureArray", $r->procedure2);
            $w[] = array("physicianmaxArray", "!=", $r->procedure2);
            $procedurescore++;
        }
        if (isset($r->procedure3)) {
            $w[] = array("procedureArray", $r->procedure3);
            $w[] = array("physicianmaxArray", "!=", $r->procedure3);
            $procedurescore++;
        }

        if ($procedurescore != 0) {
            $tb_bookcalget = Mongo::table('tb_bookcal')
                ->select("date", "title", "timeusedpercent")
                ->whereIn("dayweek", $doctorwork)
                ->where($w)
                ->get();



            $i = 0;





            foreach ($tb_bookcalget as $key => $data) {
                $data = (array) $data;
                $tb_bookcal[$i]['date'] = @$data['date'];
                $tb_bookcal[$i]['title'] = @$data['title'];
                $percent = @$data['timeusedpercent'];
                if ($percent >= 0 && $percent < 60) {
                    $tb_bookcal[$i]['backgroundColor'] = "#0ab39c2e";
                    $tb_bookcal[$i]['borderColor']     = "#0ab39c2e";
                    $tb_bookcal[$i]['textColor']            = "#0ab39c";
                }

                if ($percent >= 60 && $percent < 80) {
                    $tb_bookcal[$i]['backgroundColor'] = "#f7b84b2e";
                    $tb_bookcal[$i]['borderColor']     = "#f7b84b2e";
                    $tb_bookcal[$i]['textColor']     = "#f7b84b";
                }

                if ($percent >= 80) {
                    $tb_bookcal[$i]['backgroundColor'] = "#f065482E";
                    $tb_bookcal[$i]['borderColor']     = "#f065482E";
                    $tb_bookcal[$i]['textColor']     = "#f06548";
                }

                $i++;
            }
        }
        printJSON($tb_bookcal);
    }


    public function detect_hn($r)
    {
        $feature    = getCONFIG("feature");

        $hn = $r->hn;
        $tb_patient    = Mongo::table("tb_patient")->where("hn", $hn)->first();
        if ($tb_patient) {
            $date_all      = explode("-", $tb_patient->birthdate);
            $tb_case       = Mongo::table("tb_case")->where("case_hn", $hn)->first();
            $tb_patient->year    = $date_all[0];
            $tb_patient->month    = $date_all[1];
            $tb_patient->day    = $date_all[2];
            $tb_patient->age    = date("Y") - $tb_patient->year;
            $tb_patient->status = true;
            // echo jsonEncode($tb_patient);

        } else {
            $arr['status'] = false;
            $tb_patient = $arr;
        }

        printJSON($tb_patient);
    }

    public function change_date($r)
    {
        // dd($r->all());
        $val['date'] = $r->date;
        $w[] = array("_id", $r->book_id);
        $w[] = array("hn", $r->hn);


        // $tb_booking = Mongo::table("tb_booking")->where($w)->first();
        // dd($tb_booking);
        Mongo::table("tb_booking")->where($w)->update($val);
    }



    public function doctorwork($r)
    {
        // "Sun","Mon","Tue","Wed","Thu","Fri","Sat"
        $days[] = $this->daycheck($r, "Sun");
        $days[] = $this->daycheck($r, "Mon");
        $days[] = $this->daycheck($r, "Tue");
        $days[] = $this->daycheck($r, "Wed");
        $days[] = $this->daycheck($r, "Thu");
        $days[] = $this->daycheck($r, "Fri");
        $days[] = $this->daycheck($r, "Sat");
        $days = array_diff($days, [""]);
        return $days;
    }


    public function daycheck($r, $day)
    {
        $status = "";
        $period = $r->period;

        // dd($r->physician);
        $array = array();
        $tb_bookset_doctor = Mongo::table("tb_bookset_doctor")
            ->where("uid", intval($r->physician))
            ->first();

        // dd($tb_bookset_doctor,$r);
        if (isset($tb_bookset_doctor->$day)) {
            if ($tb_bookset_doctor->$day["work"] == "true") {
                // dd($tb_bookset_doctor[$day]);
                $ppp = $tb_bookset_doctor->$day["period"] ?? "amot";
                $ppp = "anything" . $ppp;
                if (strpos($ppp, $period)) {
                    $procedure = $tb_bookset_doctor->$day["procedure"];
                    $p1 = true;
                    $p2 = true;
                    $p3 = true;
                    if (isset($r->procedure1)) {
                        $p1 = array_search($r->procedure1, $procedure);
                    };
                    if (isset($r->procedure2)) {
                        $p2 = array_search($r->procedure2, $procedure);
                    };
                    if (isset($r->procedure3)) {
                        $p3 = array_search($r->procedure3, $procedure);
                    };

                    if ($p1 > -1) {
                        $p1 = true;
                    }
                    if ($p2 > -1) {
                        $p2 = true;
                    }
                    if ($p3 > -1) {
                        $p3 = true;
                    }

                    // dd($p1,$p2,$p3,$procedure,$r->procedure1,$r->procedure2);
                    if ($p1 && $p2 && $p3) {
                        $status = $day;
                    }
                }
            }
        }


        return $status;
    }



    public function caselist($r)
    {
        $user_type = uget("user_type");
        // $html = '';

        $effectiveDate  = date('Y-m-d', strtotime("+3 months", strtotime(date('Y-m-d'))));
        $arr = array();

        if ($user_type == "doctor") {
            // $tb_booking = Mongo::table("tb_booking")->where("date",$r->date)->where("physician",uid())->get();
            $tb_booking = Mongo::table("tb_booking")
                ->groupBy('date')
                ->where("physician", uid())
                ->where("date", ">", date("Y-m-d"))
                ->where("date", "<", $effectiveDate)
                ->get();
        } else {

            if ($r->physician == "") {
                $tb_booking = Mongo::table("tb_booking")
                    ->groupBy('date')
                    ->where("date", ">", date("Y-m-d"))
                    ->where("date", "<", $effectiveDate)
                    ->get();
            } else {
                $tb_booking = Mongo::table("tb_booking")
                    ->groupBy('date')
                    ->where("physician", intval($r->physician))
                    ->where("date", ">", date("Y-m-d"))
                    ->where("date", "<", $effectiveDate)
                    ->get();
            }
        }


        $i = 0;
        foreach ($tb_booking as $key => $value) {
            $arr[$i]['start']           = $value['date'];
            $arr[$i]['title']           = "case list";
            $arr[$i]['backgroundColor'] = "#2457882e";
            $arr[$i]['borderColor']     = "#2457882e";
            $arr[$i]['textColor']       = "#245788";
            $i++;
        }

        printJSON($arr);
    }

    public function render_caselist($r)
    {
        $tb_booking = Mongo::table('tb_booking')->where('date', $r->date)->get();

        // $procedure = array();
        // foreach ($tb_booking as $data => $value) {
        //     $procedure = array_merge($value['procedure'],$procedure);

        // }
        // $procedure = array_filter($procedure);

        // $html = "";
        // foreach ($procedure as $data2) {
        //     $tb_procedure = (object) Mongo::table('tb_procedure')->where("code" , $data2)->first();
        //     $count = count()
        //     $html .= "<br>$tb_procedure->name | ";
        // }

        // dd($arr);
    }

    public function cancel_doctor_leave($r)
    {
        $u['calendardoctor_status'] = 90;
        try {
            Mongo::table('tb_bookset_calendar_doctor')->where('_id', $r->leave_id)->update($u);
        } catch (Exception $e) {
        }
    }





    public function get_book($r)
    {
        try {
            $book = Mongo::table('tb_booking')->where('id', $r->bookid)->first();

            $book->bookid = (string) $book->id;
            $book->procedure_name = [];
            $dateObject = new Datetime($book->date);
            $formattedDate = $dateObject->format('D, d F Y');
            // dd($formattedDate);
            $book->dateformat = $formattedDate;
            if (!empty($book->procedure)) {
                foreach ($book->procedure ?? [] as $p) {
                    if (!empty($p)) {
                        $book->procedure_name[] = getprocedure($p);
                    }
                }
            }
            $results = [];
            if (!empty($book->hn)) {
                $patient = Mongo::table('tb_patient')->where('hn', $book->hn)->first() ?? [];
                $patient = (object) $patient;
                if (!empty($patient->birthdate)) {
                    $date   = new DateTime($patient->birthdate);
                    $now    = new DateTime();
                    $interval = $now->diff($date);

                    $patient->age = $interval->y . ' y';
                    if ($interval->m > 0) {
                        $patient->age = $patient->age . ' ' . $interval->m . ' m';
                    }
                }

                $date = new DateTime($book->date);
                // dd($date);
                // $formattedDate =
                $book->datetext = $date->format('D, j M Y');

                $tb_template = Mongo::table("tb_preparetemplate")->first();

                $book->first_template = $tb_template->templatename;
                // $dateString = '2024-04-02';





                $results = array_merge((array) $book, (array) $patient);
            }
            echo jsonEncode($results) ?? '';
        } catch (Exception $e) {
            echo 'error';
        }
    }
}
