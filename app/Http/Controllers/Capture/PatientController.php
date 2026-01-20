<?php

namespace App\Http\Controllers\capture;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Mongo;

class PatientController extends Controller
{

    public function __construct(Request $r)
    {
        checklogin();
    }

    public function index(Request $r)
    {
        $search  = $r->input('search');
        $view['patient'] = DB::table('patient')
            ->leftJoin('dd_gender', 'dd_gender.gender_id', 'patient.gender')
            ->where('firstname', 'like', '%' . $search . '%')
            ->orwhere('lastname', 'like', '%' . $search . '%')
            ->orwhere('hn', 'like', '%' . $search . '%')
            ->orwhere('an', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('capture.patient.index', $view);
    }


    public function create(Request $r)
    {
        $view['feature']    = getCONFIG("feature");
        $view['month_all']  = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $view['day_all']    = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
        $view['year_all']   = array();
        for (
            $i = intval(date('Y') + 543);
            $i >= intval(date('Y') + 543) - 120;
            $i--
        ) {
            array_push($view['year_all'], $i);
        }

        return view('capture.patient.create', $view);
    }

    public function store(Request $r)
    {

        if (isset($r->event)) {
            if ($r->event == "edit_patient") {
                return $this->edit_patient($r);
            }
            if ($r->event == "patient_create") {
                return $this->patient_create($r);
            }
            if ($r->event == "patient_check") {
                return $this->patient_check($r);
            }
        }
    }


    public function patient_check($r)
    {
        $tb_patient = Mongo::table("tb_patient")->where("hn", $r->hn)->first();
        if (isset($tb_patient['_id'])) {
            $arr['firstname']   = $tb_patient['firstname'];
            $arr['lastname']    = $tb_patient['lastname'];
            $arr['hn']          = $tb_patient['hn'];
            $arr['mongoid']     = (string) $tb_patient['_id'];
            $arr['status']      = true;
        } else {
            $arr['status']      = false;
        }
        printJSON($arr);
    }


    public function patient_create($r)
    {

        $birth =  ($r->birthyear - 543) . "-" . $r->birthmonth . "-" . $r->birthday;
        if ($r['myHiddenField'] != null) {
            $data              = $r['myHiddenField'];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data              = base64_decode($data);
            file_put_contents('pic_patient/' . $r->hn . '.png', $data);
            $pic = $r->hn . '.png';
        } else {
            $pic = "";
        }

        $val['allergic']            = $r->allergic . "";
        $val['congenital_disease']  = $r->congenital_disease . "";
        $val['emer_name']           = $r->emer_name . "";
        $val['emer_tel']            = $r->emer_tel . "";
        $val['firstname']           = $r->firstname;
        $val['middlename']          = $r->middlename . '';
        $val['lastname']            = $r->lastname;
        $val['phone']               = $r->phone;
        $val['an']                  = $r->an;
        $val['citizen']             = $r->citizen;
        $val['pic']                 = $pic;
        $val['email']               = $r->email;
        $val['prefix']              = $r->prefix;
        $hn                         =  str_replace(".", "", $r->hn);
        $val['hn']                  = $hn;
        $val['gender']              = $r->gender;
        $val['birthdate']           = $birth;
        $val['nationality']         = $r->nationality;
        $val['regis_date']          = $r->regis_date;
        $val['regis_time']          = $r->regis_time;
        $lastid = Mongo::table('tb_patient')->insertGetId($val);


        // if (isset($r->historytaking)) {

        //     $dates['date']     = date("Y-m-d");
        //     $dates['appointment']   = date("Y-m-d H:i");
        //     $datas['hn']       = $r->hn;
        //     $datas['status']   = "create";
        //     $cid = Mongo::table('tb_casenote')->insertGetId($datas);
        //     return redirect("book/registration/$cid?historytaking=true");
        // }

        if (isset($r->next)) {
            return redirect('registration/' . $lastid);
        } else {
            if (isset($r->back_to)) {
                return Redirect::to($r->back_to);
            } else {
                return redirect('patient');
            }
        }

        // return redirect("registration/$cid");
    }












    public function edit_patient($r)
    {
        $patient = Mongo::table('tb_patient')->where('id', $r->patient_id)->first();
        // dd($patient);
        if (isset($patient)) {
            $birthdate                  = '';
            if (isset($r->birthyear)) {
                $year  = intval($r->birthyear) - 543;
                $month = @$r->birthmonth . "";
                $day   = @$r->birthday . "";
                $birthdate = "$year-$month-$day";
            }

            $patient                    = (object) $patient;
            $val['hn']                  = isset($r->hn)         ? $r->hn : $patient->hn;
            $val['an']                  = isset($r->an)         ? $r->an : $patient->an;
            $val['prefix']              = isset($r->prefix)     ? $r->prefix : $patient->prefix;
            $val['firstname']           = isset($r->firstname)  ? $r->firstname : $patient->firstname;
            $val['middlename']          = isset($r->middlename) ? $r->middlename : $patient->middlename;
            $val['lastname']            = isset($r->lastname)   ? $r->lastname : $patient->lastname;
            $val['birthdate']           = isset($r->birthyear) && $birthdate != "" ? $birthdate : $patient->birthdate;
            $val['phone']               = isset($r->phone)      ? $r->phone : $patient->phone;
            $val['email']               = isset($r->email)      ? $r->email : $patient->email;
            $val['gender']              = isset($r->gender)     ? $r->gender : $patient->gender;

            Mongo::table('tb_patient')->where('_id', $r->patient_id)->update($val);
            $val2['patientname'] = $r->firstname . " " . $r->lastname;
            Mongo::table("tb_case")
                ->where("case_hn", $patient->hn)
                // ->where("appointment_date",date("Y-m-d"))
                ->update($val2);

            // patient_create
        }

        if ($r->type == 'procedure') {
            return redirect(url('procedure') . "/$r->cid");
        } else if ($r->type == 'registration') {
            return redirect(url('registration') . "/$r->patient_id");
        }
    }

    public function edit($id, Request $r)
    {
        $view['gender']           = [];
        $view['righttotreatment'] = (object) Mongo::table('tb_treatmentcoverage')->get();
        $view['prefix']           = [];
        $view['nationality']      = DB::table('dd_national')->get();
        $view['patient']          = (object) Mongo::table('tb_patient')->where('_id', $id)->first();

        $birth =  isset($view['patient']->birthdate) ? explode('-', $view['patient']->birthdate) : null;
        $view['birthday']   = isset($birth[2]) ? $birth[2] : '';
        $view['birthmonth'] = isset($birth[1]) ? $birth[1] : '';
        $view['birthyear']  = isset($birth[0]) ? $birth[0] + 543 : '';
        $view['age']        = isset($view['patient']->birthdate) ? Carbon::parse($view['patient']->birthdate)->age : '';

        $view['month_all']  = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $view['day_all']    = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
        $view['year_all']   = array();
        for ($i = intval(date('Y') + 543); $i >= intval(date('Y') + 543) - 120; $i--) {
            array_push($view['year_all'], $i);
        }
        $view['action']     = 'edit';
        $view['patient_id'] = $id;
        $view['type']       = @$r->type . "";
        $view['cid']        = @$r->cid . "";
        return view('capture.patient.create', $view);
    }



    public function update(Request $r, $id)
    {
        $birth =  ($r->birthyear - 543) . "-" . $r->birthmonth . "-" . $r->birthday;
        if ($r['myHiddenField'] != null) {
            $data              = $r['myHiddenField'];
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data              = base64_decode($data);
            file_put_contents('pic_patient/' . $r->hn . '.png', $data);
            $pic = $r->hn . '.png';
            $patient['pic']             = $pic;
        }

        $patient['firstname']           = $r->firstname;
        $patient['middlename']          = @$r->middlename . '';
        $patient['lastname']            = $r->lastname;
        $patient['phone']               = $r->phone;
        $patient['an']                  = $r->an;
        $patient['citizen']             = $r->citizen;
        $patient['email']               = $r->email;
        $patient['prefix']              = $r->prefix;
        $patient['nationality']         = $r->nationality;
        $patient['hn']                  = $r->hn;
        $patient['birthdate']           = $birth;
        $patient['gender']              = $r->gender;
        $patient['regis_date']          = $r->regis_date;
        $patient['regis_time']          = $r->regis_time;
        $patient['congenital_disease']  = @$r->congenital_disease . '';
        $patient['emer_tel']            = @$r->emer_tel . '';
        $patient['emer_name']           = @$r->emer_name . '';
        $patient['allergic']            = @$r->allergic . '';
        Mongo::table('tb_patient')->where('_id', $id)->update($patient);
        $this->update_patient_tb_case($patient);
        return redirect($r->prepage);
    }

    public function update_patient_tb_case($patient)
    {
        $u['patientname'] = @$patient['firstname'] . @$patient['middlename'] . ' ' . @$patient['lastname'] . "";
        $u['age']         = $this->calculate_age($patient['birthdate']);
        Mongo::table('tb_case')->where('hn', $patient['hn'])->update($u);
    }

    public function calculate_age($birthdate)
    {
        $age = '';
        if (isset($birthdate)) {
            $bd = $birthdate;
            $dob = strtotime(str_replace('/', '-', $bd));
            $tdate = time();
            $age = date('Y', $tdate) - date('Y', $dob);
        }
        return $age;
    }

    public function destroy($id) {}
}
