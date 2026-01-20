<?php

namespace App\Http\Controllers\Capture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Datacase;
use App\Models\Casebooking;
use App\Models\Department;
use App\Models\Mongo;
use Illuminate\Support\Facades\Auth;
use MongoDB\BSON\ObjectId;
use App\Models\Config;
use PDO;
class HomeController extends Controller
{

    public function index(Request $r){
        // dd(Auth::user()->user_firstname);

        // dd($_COOKIE);
        if(isMobile()){
            return redirect("tablet/home");
        }
        $view['doctor']             = Department::user('doctor', uid());
        $view['procedure']          = Department::procedure(uid());
        $view['room']               = Department::room(uid());
        $view['tb_case'] = Mongo::table('tb_case')->get();
        $view['admin'] = getConfig("admin");
        // $view['url_terra'] = getConfig("terra")->url;
        // $val['moss'] = "test";
        // Config::name("moss")->update($val);
        // $pacs = Config::get("pacs");
        // ddd

        return view('capture.home.index',$view);
        // return view('endocapture.home.index',$view); //อันเก่า
    }
    public function havedata($json,$date){
        foreach($json->Result as $j){
            $this->checkHN($j);
            $this->insertHIS_CONNECT($j,$date);
        }
    }

    public function checkHN($j){
        $val['hn']          = $j->HN;
        $exname             = explode(" ",$j->PTNAME);
        $val['firstname']   = current($exname);
        $val['lastname']    = end($exname);
        $year               = date('Y')-$j->AGE;
        $val['birthdate']   = $year."-01-01";
        if($j->MALE=="ชาย"){$gender = 1;}else{$gender = 2;}
        $val['gender']      = $gender;
        $patient = DB::table('patient')->where('hn',$j->HN)->first();
        if($patient==null){
            DB::table('patient')->insert($val);
        }
    }

    public function worklist_today(){
        $today = date("Ymd");
        $w[]   = array('date', $today);
        $w[]   = array('import_status', '!=', 'success');
        if(uget('department') == 'GYNE'){
            $w[] = array('proceduredescription', 'Colposcopy');
        }
        $tb_caseworklist = Mongo::table('tb_caseworklist')->where($w)->orderBy('time', 'desc')->limit(100)->get();
        return isset($tb_caseworklist) ? $tb_caseworklist : [];
    }





    public function store(Request $r){
        if($r->event=="s_appointment")      {$this->s_appointment($r);}
        if($r->event=="s_appointmentbox")   {$this->s_appointmentbox($r);}
        if($r->event=="barcodescan")        {$this->barcodescan($r);}
        if($r->event=="his_detail")         {$this->his_detail($r);}
        if($r->event=="book_detail")        {$this->book_detail($r);}
        if($r->event=="render_cases")       {$this->render_cases($r);}
        if($r->event=="same_hn_cases")      {$this->same_hn_cases($r);}
        if($r->event=="auto_gencase")       {$this->auto_gencase($r);return redirect("home");}
        if($r->event=="delete_case")        {return $this->delete_case($r);}
        if($r->event=="job_all")            {$this->job_all($r);}
        if($r->event=="edit_urease")        {return $this->edit_urease($r);}
    }

    public function auto_gencase($r){
        $hn           = $r->hn;
        $prefix       = $r->prefix;
        $firstname    = $r->firstname;
        $lastname     = $r->lastname;
        $gender       = $r->gender;
        $age          = $r->age;
        $physician    = $r->physician;
        $appointment_date         = $r->appointment_date;
        $calbirthdate = '2024';
        $birthdate    = date('Y');
        // dd($r->all());
        foreach ($r->procedure as $key => $value) {
            try {
                $birthdate =  intval($calbirthdate) - intval($age[$key]);
                // dd($birthdate);
            } catch (\Throwable $th) {}

            // dd($r->procedure);
            if ($value != 'Procedure') {
                $data = (object) array();
                $data->hn                   = $hn[$key];
                $data->prefix               = $prefix[$key];
                $data->firstname            = $firstname[$key];
                $data->lastname             = $lastname[$key];
                $data->gender               = $gender[$key];
                $data->age                  = $age[$key];
                $data->birthdate            = $birthdate;
                $data->physician            = $physician[$key];
                $data->appointment_date     = $appointment_date;

                if(isset($hn[$key])){
                    $this->createPatienttest($hn[$key],$prefix[$key], $firstname[$key],$lastname[$key] , $gender[$key] , $birthdate , $age[$key] , $physician[$key], $appointment_date[$key]);


                    //fix physician01
                    $data->case_physicians01    = $physician[$key];
                    $data->meet_date            = $appointment_date;
                    $data->meet_hour            = "08";

                    //fix room
                    $data->room                 = "1";
                    $data->useropencase         = "1";

                    //fix procedure
                    // $data->case_procedurecode   = "gi002";

                    $data->case_procedurecode   = $value;
                    $val['updatetime']  = date("ymdHis");
                    $val['comcreate']   = getCONFIG('admin')->com_name;
                    $val['created_from'] = 'regis';
                    // dd($val, $data);
                    $cid                = insertCASE($val,$data);
                    $val['caseuniq']    = $cid;
                    //  Mongo::table("tb_case")->insert($value);

                    insertMEDICATION($val);
                }

            }
        }
    }


    public function createPatienttest($hn, $prefix, $firstname,$lastname , $gender , $birthdate , $age){
        $patient = Mongo::table("tb_patient")->where("hn",$hn)->first();
        if($patient==null){
            $val['allergic']            = "";
            $val['congenital_disease']  = "";
            $val['emer_name']           = "";
            $val['emer_tel']            = "";
            $val['firstname']           = $firstname;
            $val['middlename']          = "";
            $val['lastname']            = $lastname;
            $val['phone']               = "";
            $val['an']                  = "";
            $val['citizen']             = "";
            $val['pic']                 = "";
            $val['email']               = "";
            $val['prefix']              = $prefix;
            $val['hn']                  = $hn;
            $val['gender']              = $gender;
            $val['birthdate']           = $birthdate."-01-01";
            $val['nationality']         = "";
            $val['regis_date']          = "";
            $val['regis_time']          = "";
            $val['age']                 = $age;
            Mongo::table("tb_patient")->insert($val);
        }
    }



    public function job_all($r){
        $view['all_case'] = $this->statusall($r);

        // dd($view);
        $html = view("capture.home.table.02allcase",$view)->render();
        echo $html;
    }


    public function render_cases($r){
        if($r->type=="all") {
            $view['tb_case'] = $this->statusall($r);
            $html= view("capture.home.table.02allcase" ,$view)->render();
        }
        echo $html;
    }


    public function statusholding($r, $status){

        $department = [];

        $user_id    = uget("uid");
        $user_type = uget("user_type");
        // dd($user_id);
        $department = uget("department");



        $w[0]       = array('appointment_date',"like",date('Y-m-d')."%");
        // $w[1] = array("statusjob" , $status);

        if ($user_type == "doctor") {
            // dd($user_id);
            $w[6]       = array("case_physicians01" , $user_id);
                }elseif($user_type == "nurse"){
                    $w[5]       = array("user_in_case", "in", [$user_id]);
                    $orw[5]     = array("user_in_case", "in", [$user_id]);
                    $orw1[5]    = array("user_in_case", "in", [$user_id]);
        }else{
            $w[5]       = array("department" , $department);
            $orw[5]     = array("department" , $department);
            $orw1[5]    = array("department" , $department);
        }
        // dd($user_id);
        $tb_case    = Mongo::table('tb_case')->where($w)->orderBy('id','DESC')->limit(500)->get();

        if($status == 'holding'){
            $orw[0] = array('appointment_date',"like",date('Y-m-d')."%");
            $orw[1] = array("statusjob" , 'operation');
            $orw1[0] = array('appointment_date',"like",date('Y-m-d')."%");
            $orw1[1] = array("statusjob" , 'recovery');
            $tb_case = Mongo::table('tb_case')->where($w)
            ->orWhere($orw)
            ->orWhere($orw1)
            ->orderBy('id','DESC')
            ->limit(500)->get();
        } elseif($status == 'operation'){
            $orw[0] = array('appointment_date',"like",date('Y-m-d')."%");
            $orw[1] = array("statusjob", "recovery");
            $orw1[0] = array('appointment_date',"like",date('Y-m-d')."%");
            $orw1[1] = array("statusjob", "holding");
            $tb_case = Mongo::table('tb_case')->where($w)->orWhere($orw)->orWhere($orw1)->orderBy('id','DESC')->limit(500)->get();
        } elseif($status == 'recovery'){
            $orw[0] = array('appointment_date',"like",date('Y-m-d')."%");
            $orw[1] = array("statusjob" , 'discharged');
            $orw1[0] = array('appointment_date',"like",date('Y-m-d')."%");
            $orw1[1] = array("statusjob" , 'operation');
            $tb_case = Mongo::table('tb_case')->where($w)->orWhere($orw)->orWhere($orw1)->orderBy('id','DESC')->limit(500)->get();
        } else if($status == 'all'){
            // array_pop($w);

            $tb_case = Mongo::table('tb_case')->where($w)->orderBy('id','DESC')->limit(100)->get();
            // dd($w,$tb_case);
        }
        // dd($tb_case);

        return $tb_case;
        }



    public function statusall($r){

        $w[]        = array('statusjob', '!=', 'delete');
        $w[]        = array('statusjob', '!=', 'cancel');

        $name       = $r->search_name ?? '';
        $hn         = $r->search_hn ?? '';
        $physician  = $r->search_physician ?? '';
        $procedure  = $r->search_procedure ?? '';
        $datefrom   = isset($r->search_datefrom) ? $r->search_datefrom : '';
        $dateto     = isset($r->search_dateto) ? $r->search_dateto : '';
        $room       = $r->search_room ?? '' ;

        if($physician!="")  {$w[] = array('doctorname', 'LIKE','%'.$physician.'%');}
        if($procedure!="")  {$w[] = array('procedurename', $procedure);}
        if($name!="")       {$w[] = array('patientname', 'LIKE','%'.$name.'%');}
        if($hn!="")         {$w[] = array('case_hn', 'LIKE','%'.$hn.'%');}
        $query = Mongo::table('tb_case')->where($w);

        if($room != "") {
            $query = $query->where(function($q) use ($room) {
                $q->where('room', 'LIKE', '%'.$room.'%')
                  ->orWhere('room_id', 'LIKE', '%'.$room.'%');
            });
        }

        if(uget("user_type")=="doctor"){
            $query = $query->where('case_physicians01', uid());
        }


        $tb_case = $query->orderBy('id', 'DESC')
        ->limit(100)
        ->get();
        if($datefrom != '' && $dateto != '') {
            $tb_case = $query->where('appointment_date', '>=', $datefrom)
                             ->where('appointment_date', '<=', $dateto)
                             ->orderBy('appointment_date', 'DESC')
                             ->limit(100)
                             ->get();
        } elseif($datefrom != '' && $dateto == '') {
            $tb_case = $query->where('appointment_date', '>=', $datefrom)
                             ->orderBy('appointment_date', 'DESC')
                             ->limit(100)
                             ->get();
        }



        // dd($datefrom, $dateto);
        // if($name==""&&$hn=="") {
        //     $tb_case    = Mongo::table('tb_case')->where($w)->orderBy('_id','DESC')->limit(500)->get();
        // }else{
        //     $tb_case    = Mongo::table('tb_case')
        //                 ->where($w)
        //                 ->where("case_hn","LIKE","%".$text."%")
        //                 // ->orwhere("patientname","LIKE","%".$text."%")
        //                 ->orderBy('_id','DESC')
        //                 ->limit(500)->get();
        // }
        $arr        = isset($tb_case) ? $tb_case : [];



        return $arr;
    }

    public function same_hn_cases($r){
        $w[] = array('hn', $r->case_hn);
        $view['status'] = strtolower($r->status_name);

        $w[] = array('statusjob', '!=', 'delete');
        $w[] = array('statusjob', '!=', 'cancel');
        if($r->date != 'all'){
            $w[] = array('appointment_date','LIKE','%'.date('Y-m-d').'%');
        }

        $data      = Mongo::table('tb_case')->where($w)->orderby('appointment_date', 'desc')->get();
        $patient   = (object) Mongo::table('tb_patient')->where('hn', $r->case_hn)->first();
        $view['tb_case'] = $data;
        $view['patient'] = $patient;
        $view['type']    = $r->btn;
        $view['url']     = url('');


        $html = view("capture.home.component.content_case",$view)->render();
        echo $html;
    }

    public function delete_case($r){
        $w[] = array('_id', $r->del_caseid);
        $u['statusjob'] = 'delete';
        $update = Mongo::table('tb_case')->where($w)->update($u);
        return  redirect(url('home'));
    }

    public function count_duplicate($array){
        $vals = array_count_values($array);
    }





    public function edit_urease($r){
        if(isset($r->case_id)){
            $up['rapid_other']        = @$r->urease_text."";
            $up['rapid_urease_test']  = @$r->urease."";
            Mongo::table('tb_case')->where('_id', $r->case_id)->update($up);
        }

            return redirect(url('home'));

    }


    public function destroy($id){
        // $data['case_status'] = 0;

        // $data['case_status'] = 90;
        // $data['statusjob']   = 'delete';
        // $w[] = array('_id', $id);
        // Mongo::table('tb_case')->where($w)->update($data);

        $w[0] = array('id', $id);
        $case_old = Mongo::table('tb_case')->where($w)->first();
        unset($case_old->id);
        Mongo::table('tb_case')->where($w)->delete();
        $casebackup_id = Mongo::table('tb_casebackup')->insertGetId((array)$case_old);
        $w[0] = array('id', $casebackup_id);
        $case = (object) Mongo::table('tb_casebackup')->where($w)->first();

        createTEMP('tb_case',$case->caseuniq,$case->comcreate,date("ymdHis"));
        $this->delete_case_backup($id, $case->caseuniq);

        $log['case_from'] = $case->caseuniq;
        $log['case_hn']   = $case->case_hn;
        logdata('tb_logcase', uid(), 'cancel case', $log);
        return redirect('home');
    }

    public function delete_case_backup($_id, $caseuniq){
        $w[] = array('_id', $_id);
        $w1[] = array('caseuniq', $caseuniq);
        $orw1[] = array('caseuniq', new ObjectId($caseuniq));
        $tb_casetemp = Mongo::table('tb_case')->where($w)->project(['_id' => 0])->first();
        $tb_casemedicationtemp = Mongo::table('tb_casemedication')->where($w1)->orWhere($orw1)->project(['_id' => 0])->first();
        if(isset($tb_casetemp)){
            Mongo::table('tb_casebackup')->insert($tb_casetemp);
            $check_insert = Mongo::table('tb_casebackup')->where($w1)->first();
            if(isset($check_insert)){
                Mongo::table('tb_case')->where($w)->delete();
            }
        }

        if(isset($tb_casemedicationtemp)){
            Mongo::table('tb_casebackup_medication')->insert((array)$tb_casemedicationtemp);
            $check_insert = Mongo::table('tb_casebackup_medication')->where($w1)->orWhere($orw1)->first();
            if(isset($check_insert)){
                Mongo::table('tb_casemedication')->where($w1)->delete();
            }
        }
    }

    public function s_appointment($r){
        // dd("mmmm");
        $w[] = array('case_status','!=',90);
        if(checkNULL($r->sl_status))        {$w[] = array('case_status'             ,$r->sl_status);}
        if(checkNULL($r->tx_hn))            {$w[] = array('case_hn'                 ,'like',"%$r->tx_hn%");}
        if(checkNULL($r->sl_room))          {$w[] = array('case_room'               ,$r->sl_room);}
        if(checkNULL($r->tx_name))          {$w[] = array('case_json'               ,'like',"%patientname%$r->tx_name%");}
        if(checkNULL($r->sl_procedure))     {$w[] = array('case_procedure'          ,$r->sl_procedure);}
        if(checkNULL($r->tx_datepicker))    {
            $exdate = explode(' / ',$r->tx_datepicker);
            $end = (new Carbon($exdate[1]))->addDays(1);
            $w[] = array('case_dateappointment'       ,'>=',$exdate[0]);
            $w[] = array('case_dateappointment'       ,'<=',$end);
        }
        if(checkNULL($r->tx_age))           {$w[] = array('case_json'               ,'like',"%age%$r->tx_age%");}
        if($r->switch_on != 'allday')       {$w[] = array('case_dateappointment'    ,'like',date('Y-m-d').'%');}

        if(uget("user_type")=="doctor"){
            $w[]        = array('case_physicians01',uid());
            $tb_case    = Mongo::table('tb_case')
            ->join('tb_patient', 'tb_case.case_hn', 'patient.hn')
            ->where($w)
            ->orderBy('case_id', 'desc')
            ->paginate(100);
        }else{

            if(checkNULL($r->sl_doctor)){
                $w[] = array('case_physicians01'       ,$r->sl_doctor);
                $tb_case    = Mongo::table('tb_case')
                ->where($w)
                ->orderBy('case_id','desc')
                ->paginate(100);
            }else{
                $allprocedure   = Department::arr(uid(),'department_procedure');
                $tb_case        = Mongo::table('tb_case')
                ->whereIn('case_procedure',$allprocedure)
                ->where($w)
                ->orderBy('case_id','desc')
                ->paginate(100);
            }
        }

        $i      = 0;
        $arr    = array();
        foreach($tb_case as $case){
            // $json = jsonDecode($case->case_json);
            $case_status = "Registered";
            $date = explode(' ',$case->case_dateappointment);
            if($case->case_status==0){$case_status=" Registered "; $class="label label-warning label-pill label-inline mr-2";}
            if($case->case_status==1){$case_status=" Operation  "; $class="label label-info label-pill label-inline mr-2";}
            if($case->case_status==2){$case_status=" Finished   "; $class="label label-success label-pill label-inline mr-2";}
            $arr[$i]['case_id']         = $case->case_id;
            $arr[$i]['case_status']     = $case_status;
            $arr[$i]['case_hn']         = $case->case_hn;
            $arr[$i]['case_patient']    = @$case->patientname."";
            $arr[$i]['case_age']        = @$case->age."";
            $arr[$i]['case_doctor']     = @$case->doctorname."";
            $arr[$i]['case_procedure']  = @$case->procedurename."";
            $arr[$i]['case_room']       = @$case->room."";
            $arr[$i]['case_appointment']= $date[0];
            $i++;
        }
        printJSON($arr);
    }


    public function s_appointmentbox($r){
        $w[] = ['where','case_status','!=',90];
        if(checkNULL($r->sl_status))        {$w[] = ['where','case_status'          ,"=", $r->sl_status];}
        if(checkNULL($r->tx_hn))            {$w[] = ['where','case_hn'              ,'like',"%$r->tx_hn%"];}
        if(checkNULL($r->sl_room))          {$w[] = ['where','case_room'            ,"=", $r->sl_room];}
        if(checkNULL($r->tx_name))          {$w[] = ['where','case_json'            ,'like',"%patientname%$r->tx_name%"];}
        if(checkNULL($r->sl_procedure))     {$w[] = ['where','case_procedurecode'   ,"=", $r->sl_procedure];}
        if(checkNULL($r->tx_age))           {$w[] = ['where','case_json'               ,'like',"%age%$r->tx_age%"];}
        if($r->switch_on != 'allday')       {
            $w[] = ['where','case_dateappointment'    ,'like',date('Y-m-d').'%'];
        }else{
            $daterange = explode(" - ",$r->tx_datepicker);
            if($daterange[0] != $daterange[1]){
                $datestart  = $this->formatdate($daterange[0]);
                $dateend    = $this->formatdate($daterange[1]);
                $w[]        = ['whereBetween','case_dateappointment',$datestart,$dateend];
            }
        }



        if(uget("user_type")=="doctor"){
                $w[] = ['where','case_physicians01',"=",uid()];
        }else{
            if(checkNULL($r->sl_doctor)){
                if($r->sl_doctor!="SUR" && $r->sl_doctor!="MED"){
                    $w[] = ['where','case_physicians01',"=",$r->sl_doctor];
                }else{
                    $users      = DB::table('users')->where("user_branch",$r->sl_doctor)->get();
                    $userarr    = array();
                    foreach($users as $data){
                        $userarr[] = $data->id;
                    }
                    $w[] = ['whereIn','case_physicians01',$userarr];
                }
            }
        }

        $tb_case    = Mongo::table('tb_case')
        ->whereArr($w)
        ->orderBy('case_id','desc')
        ->paginate(100);

        $i                  = 0;
        $arr                = array();
        $arr['url']         = url('camera');
        $array['status']    = false;

        foreach($tb_case as $case){
            // $json           = jsonDecode($case->case_json);
            $case_status    = "Registered";
            $date           = explode(' ',$case->case_dateappointment);
            if($case->case_status==0){$case_status="Registered";    $colorstatus="warning";  $colorreport ="secondary text-dark" ;$href="";}
            if($case->case_status==1){$case_status="Operation";     $colorstatus="info";     $colorreport ="secondary text-dark" ;$href="";}
            if($case->case_status==2){
                $case_status    = "Reported";
                $colorstatus    = "success";
                $colorreport    = "primary";
                $url            = url("reportendocapture/$case->case_id");
                $href           = 'href="'.$url.'"';
            }
            $arr['caseall'][$i]['colorreport']      = $colorreport;
            $arr['caseall'][$i]['colorstatus']      = $colorstatus;
            $arr['caseall'][$i]['case_status']      = $case_status;
            $arr['caseall'][$i]['href']             = $href;
            $arr['caseall'][$i]['case_id']          = $case->case_id;
            $arr['caseall'][$i]['case_hn']          = $case->case_hn;
            $arr['caseall'][$i]['case_patient']     = @$case->patientname."";
            $arr['caseall'][$i]['case_age']         = @$case->age."";
            $arr['caseall'][$i]['case_doctor']      = @$case->doctorname."";
            $arr['caseall'][$i]['case_procedure']   = @$case->procedurename."";
            $arr['caseall'][$i]['case_room']        = @$case->room."";
            $arr['caseall'][$i]['case_appointment'] = $date[0];

            $i++;
            $array['status'] = true;
        }

        $array['caseall'] = $arr;
        printJSON($array);
    }

    public function formatdate($date){
        $date   = explode('/',$date);
        $new    = $date['2'].'-'.$date['0'].'-'.$date['1']." 00:00:00";
        return $new;
    }

    public function barcodescan($r){
        $arr['casetoday']           = Datacase::barcode_today($r->value);
        $arr['caseother']           = Datacase::barcode_other($r->value);
        $arr['casetodaystatus']     = (count($arr['casetoday'])==0)?false:true;
        $arr['caseotherdaystatus']  = (count($arr['caseother'])==0)?false:true;
        printJSON($arr);
    }
}
