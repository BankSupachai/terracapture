<?php

namespace App\Http\Controllers\Capture;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Mongo;
use App\Models\Department;
use App\Models\Server;
use Illuminate\Support\Facades\Hash;
use App\Models\Datacase;

class PatientEntController extends Controller
{

    public function __construct(Request $r)
    {
        checklogin();
    }

    public function index(Request $r)
    {

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

        $view['procedure'] = Department::procedure(uid());
        $view['physician'] = Department::user("doctor",uid());
        $view['attendant'] = Mongo::table("users")->whereIn("uid",Department::arr(uid(),"department_user"))->get();
        return view('capture.patient.createent', $view);
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
                if ($r->event == "add_doctor") {
                    return $this->add_doctor($r);
                }
        }
    }

    public function add_doctor($r)
    {
        // dd($r->all());
        $admin      = getCONFIG("admin");
        $comname    = $admin->com_name;

        $w[] = array('user_firstname', $r->user_firstname);
        $w[] = array('user_lastname', $r->user_lastname);

        $tb_users = server::table("users")->where($w)->first();
        if ($tb_users == Null) {
            $val['uid']              = get_last_id('uid', 'users') + 1;
            $val['user_code']       = $r->user_code;
            $val['color']           = '';
            $val['phone']           = '';
            $val['opencase']        = 1;
            $val['procedure_json']  = '';
            $val['user_type']       = "doctor";
            $val['name']            = "Doctor";

            $val['department']      = uget('department');
            $val['user_status']     = 'active';
            $val['comname']         = $comname;
            $val['user_prefix']     = $r->user_prefix;
            $val['user_firstname']  = $r->user_firstname;
            $val['user_lastname']   = $r->user_lastname;
            $val['created_at']        = Carbon::now()->toDateTimeString();


            // dd($val);
            $local_cid = Server::table('users')->insert($val);
            // $cid = server::table('users')->insertGetId($val);

            $local_case = Server::table("users")->where('uid', get_last_id('uid', 'users'))->first();
            // $case = server::table("users")->where('_id', $cid)->first();
            $department_name = uget('department');
            // dd($department_name);
            $local_id = $local_case->uid ?? '';
            $tb_department = Server::table('tb_department')->where('department_name', $department_name)->first();
            $department_user = $tb_department->department_user ?? [];
            $department_user[] = intval($local_id);

            $u['department_user'] = $department_user;
            // dd($u);
            // dd(Mongo::table('tb_department')->where('department_name', $department_name)->first());
            Server::table('tb_department')->where('department_name', $department_name)->update($u);

            // $id = $case['id'] ?? '';
            $val2['email'] = "doctor$local_id";
            $val2['password'] = Hash::make("123456");
            $val2['opencase'] = 1;
            // server::table("users")->where("uid" , $id)->update($val2);

            Server::table("users")->where("uid", $local_id)->update($val2);
            semi_createtemp_masterdata("users");
            semi_createtemp_masterdata("tb_department");
            // $procedure_api = new ApiProcedureController;

            // $procedure_api->compartrecord("users", $comname, "uid");
            // $procedure_api->compartrecord("tb_department", $comname, "department_id");

            // dd($r->id);


                      return redirect(url('patientent/create'));


                // return redirect("capture/procedure/$r->id");
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

        $birthmonth = (!empty($r->birthmonth)) ? $r->birthmonth : '01';
        $birthday   = (!empty($r->birthday)) ? $r->birthday : '01';
        $birth =  ($r->birthyear) . "-" . $birthmonth . "-" . $birthday;
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
        $val['comcreate']           = getCONFIG('admin')->com_name;
        $lastid = Mongo::table('tb_patient')->insertGetId($val);

        $cid = insertCASE($val, $r);

        if($r->action == 'save_start'){
            return redirect('capture/' . $cid);
        }else{
            return redirect('home');
        }




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
