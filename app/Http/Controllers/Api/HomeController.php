<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Datacase;
use App\Models\Casebooking;
use App\Models\Holiday;
use App\Models\Department;
use App\Models\Mongo;
use Exception;
use PDO;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use Symfony\Component\Console\Input\Input as InputInput;

class HomeController extends Controller
{
    // public function __construct(Request $r){checklogin();}

    public function index(Request $r){

        if(isset($r->action)){
            if($r->action == 'cancel'){
                $u['statusjob'] = 'delete';
                Mongo::table('tb_case')->where('_id', $r->cid)->update($u);
            }
            return redirect(url('home'));
        }

        // dd(uget("user_type"));
        $project = configTYPE("admin","project");

        $view['doctor']         = Department::user('doctor');
        $view['procedure']      = Department::procedure(uid());
        $view['room']           = Department::room();
        $str                    = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        $view['config']         = jsonDecode($str);
        $view['date']           = date('Y-m-d');
        $view['set_page']       = jsonDecode($str);
        $view['holiday']        = Holiday::where('holiday_user_id',uid())->where('holiday_status','!=','delete')->get();
        $view['book']           = Casebooking::booktoday();
        $view['i']              = 0;
        $view['url']            = url('');
        $view['count_casetoday']= Datacase::counttoday();
        $view['notestep00'] = DB::table('tb_casenote')->where('note_status',0)->orderby('note_id','desc')->get();
        $view['notestep01'] = DB::table('tb_casenote')->where('note_status',1)->orderby('note_id','desc')->get();
        $view['notestep02'] = DB::table('tb_casenote')->where('note_status',2)->orderby('note_id','desc')->get();
        $view['notestep03'] = DB::table('tb_casenote')->where('note_status',3)->orderby('note_id','desc')->get();
        $view['notestep04'] = DB::table('tb_casenote')->where('note_status',4)->orderby('note_id','desc')->get();
        $view['notestep05'] = DB::table('tb_casenote')->where('note_status',5)->orderby('note_id','desc')->get();
        $view['notestep06'] = DB::table('tb_casenote')->where('note_status',6)->orderby('note_id','desc')->get();


        return view('endocapture.home.index', $view);
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





    public function store(Request $r){
        if($r->event=="s_appointment")        {$this->s_appointment($r);}
        if($r->event=="s_appointmentbox")     {$this->s_appointmentbox($r);}
        if($r->event=="barcodescan")          {$this->barcodescan($r);}
        if($r->event=="his_detail")           {$this->his_detail($r);}
        if($r->event=="book_detail")          {$this->book_detail($r);}
        if($r->event=="render_cases")         {$this->render_cases($r);}
        if($r->event=="render_casesipad")     {$this->render_casesipad($r);}
        if($r->event=="same_hn_cases")        {$this->same_hn_cases($r);}
        if($r->event=="delete_case")          {return $this->delete_case($r);}
        if($r->event=="upload_file_excel")    {return $this->upload_file_excel($r);}
        if($r->event=="upload_excel_row")     {return $this->upload_excel_row($r);}
        if($r->event=="get_only_egd")         {return $this->get_only_egd($r);}
        if($r->event=="line_login")         {return $this->line_login($r);}





    }




    public function render_casesipad($r){

        if($r->type=="all") {
            $view['all_case'] = $this->statusall();
            $html= view("EndoCAPTURE.home.table.02allcaseipad" ,$view)->render();
        }
        echo $html;
    }


    public function statusholdingipad($r, $status){
        $w[0] = array('appointment',"like",date('Y-m-d')."%");
        $w[1] = array("statusjob" , $status);
        $tb_case = Mongo::table('tb_case')->where($w)->orderBy('_id','DESC')->limit(100)->get();
        $arr = array();
        foreach($tb_case as $data){
            $data = (object) $data;
            $case_hn      = isset($data->case_hn)       ? $data->case_hn     : $data->hn;
            $patient_name = isset($data->patientname)   ? $data->patientname : $data->firstname.' '.$data->lastname;
            $doctor1      = isset($data->doctorname)    ? $data->doctorname  : $data->physician;
            $pdfversion   = isset($data->case_pdfversion) ? $data->case_pdfversion : [];

            $arr[$case_hn]['_id']               = $data->id;
            $arr[$case_hn]['hn']                = $case_hn;
            $arr[$case_hn]['patientname']       = @$patient_name."";
            $arr[$case_hn]['physician']         = @$doctor1."";
            $arr[$case_hn]['procedure'][]       = @$data->procedurename."";
            $arr[$case_hn]['description']       = @$data->description."";
            $arr[$case_hn]['waitinglocation']   = @$data->waitinglocation."";
            $arr[$case_hn]['statusjob'][]       = @$data->statusjob."";
            $arr[$case_hn]['room']              = @$data->room."";
            $arr[$case_hn]['appointment']       = @$data->appointment."";
            $arr[$case_hn]['case_pdfversion']   = @$pdfversion;
        }
        return $arr;
    }


    public function render_cases($r){
        if($r->type=="all") {
            $view['tb_case'] = $this->statusall();
            $html= view("EndoCAPTURE.home.table.02allcase" ,$view)->render();
        }
        if($r->type=="today" || $r->type=="holding"){
            $view['tb_case'] = $this->statusholding($r, 'holding');
            $html= view("EndoCAPTURE.home.table.03holding" ,$view)->render();
        }
        if($r->type=="operation"){
            $view['tb_case'] = $this->statusholding($r, 'operation');
            $html= view("EndoCAPTURE.home.table.04operation" ,$view)->render();
        }
        if($r->type=="recovery"){
            $view['tb_case'] = $this->statusholding($r, 'recovery');
            $html= view("EndoCAPTURE.home.table.05recovery" ,$view)->render();
        }
        if($r->type=="discharged"){
            $view['tb_case'] = $this->statusholding($r, 'discharged');
            $html= view("EndoCAPTURE.home.table.06discharged" ,$view)->render();
        }
        echo $html;
    }


    public function statusholding($r, $status){
        $w[0] = array('appointment',"like",date('Y-m-d')."%");
        $w[1] = array("statusjob" , $status);
        $tb_case = Mongo::table('tb_case')->where($w)->orderBy('_id','DESC')->limit(100)->get();
        $arr = array();
        foreach($tb_case as $data){
            $data = (object) $data;
            $case_hn      = isset($data->case_hn)       ? $data->case_hn     : $data->hn;
            $patient_name = isset($data->patientname)   ? $data->patientname : $data->firstname.' '.$data->lastname;
            $doctor1      = isset($data->doctorname)    ? $data->doctorname  : $data->physician;
            $pdfversion   = isset($data->case_pdfversion) ? $data->case_pdfversion : [];

            $arr[$case_hn]['_id']               = $data->id;
            $arr[$case_hn]['hn']                = $case_hn;
            $arr[$case_hn]['patientname']       = @$patient_name."";
            $arr[$case_hn]['physician']         = @$doctor1."";
            $arr[$case_hn]['procedure'][]       = @$data->procedurename."";
            $arr[$case_hn]['description']       = @$data->description."";
            $arr[$case_hn]['waitinglocation']   = @$data->waitinglocation."";
            $arr[$case_hn]['statusjob'][]       = @$data->statusjob."";
            $arr[$case_hn]['room']              = @$data->room."";
            $arr[$case_hn]['appointment']       = @$data->appointment."";
            $arr[$case_hn]['case_pdfversion']   = @$pdfversion;
        }
        return $arr;
    }

    public function upload_file_excel($r){
        try {
            if(isset($r->type)){
                $data = $this->get_excel_data($r, true, false);

                if($r->type == 'update_single'){
                    $single_row = (object) $data['all_case'][$r->hn];
                    $this->create_case_excel($single_row);
                } else {
                    $hns = explode(',', $r->hn);
                    foreach ($hns as $hn) {
                        $row = (object) $data['all_case'][$hn];
                        $this->create_case_excel($row);
                    }
                }

                echo 'success';
            } else {
                $encode = $this->get_excel_data($r);
                echo $encode;
            }
        } catch (\Exception $e) {
            echo 'error';
        }
    }

    public function create_case_excel($data_row){
        $proc = $data_row->procedure;
        $data_row->case_procedurecode   = $this->change_procedure_name($proc);
        $data_row->case_dateappointment = "$data_row->date $data_row->time";
        $data_row->case_physicians01    = $data_row->physician;
        $data_row->room                 = "";
        $data_row->meet_date            = $data_row->date;
        $data_row->meet_hour            = $data_row->time;
        $data_row->hn                   = $data_row->hn;
        $val['comcreate']               = getCONFIG('admin')->com_name;
        insertCASE($val, $data_row);
    }

    public function change_procedure_name($proc_arr){
        $proc_code = [];
        foreach ($proc_arr as $p) {
            $tb_procedure = (object) Mongo::table('tb_procedure')->where('name', $p)->first();
            if(isset($tb_procedure->code)){
                $proc_code[] = $tb_procedure->code;
            }
        }
        return $proc_code;
    }

    public function get_excel_data($r, $sort=true, $encode=true){
        $new_data  = [];
        $hn_arr    = [];
        $files = $r->file('upload_files');
        foreach ($files as $file) {
            if(isset($file)){
                $temppath = $file->getPathName();
                $user_data = Excel::toArray([], $temppath);
                foreach ($user_data[0] as $index=>$data) {
                    if($index != 0){
                        $new_data[] = $data;
                        $hn_arr[]   = $data[0];
                    }
                }
            }
        }

        $sort_data = [];
        if($sort){
            $hn_arr = array_unique($hn_arr);
            for ($i=0; $i < count($new_data); $i++) {
                $hn                             = $new_data[$i][0];
                $date_carbon                    = $this->transformDate($new_data[$i][4]);
                $time_carbon                    = $this->transformDate($new_data[$i][5]);
                $sort_data[$hn]['hn']           = $hn;
                $sort_data[$hn]['patientname']  = $new_data[$i][1];
                $sort_data[$hn]['age']          = $new_data[$i][2];
                $sort_data[$hn]['physician']    = $new_data[$i][3];
                $sort_data[$hn]['date']         = $date_carbon->format('Y-m-d');
                $sort_data[$hn]['time']         = $time_carbon->format('h:i');
                $sort_data[$hn]['procedure'][]  = $new_data[$i][6];
            }
        }

        $arr['all_hn']   = $hn_arr;
        $arr['all_case'] = $sort_data;
        return $encode==true ? jsonEncode($arr) : $arr;
    }

    public function transformDate($value, $format = 'Y-m-d') {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }

    public function upload_excel_row($r){
        echo 'test';
    }

    public function statusall(){
        $w[0] = array(' appointment', "!=", "");
        $tb_case = Mongo::table('tb_case')->where($w)->orderBy('_id','DESC')->limit(100)->get();
        $arr     = isset($tb_case) ? $tb_case : [];
        return $arr;
    }

    public function same_hn_cases($r){
        // dd(1);
        $w[] = array('hn', $r->case_hn);
        $view['status'] = strtolower($r->status_name);

        $w[] = array('statusjob', '!=', 'delete');
        $w[] = array('statusjob', '!=', 'cancel');
        if($r->date != 'all'){
            $w[] = array('appointment','LIKE','%'.date('Y-m-d').'%');
        }

        $data      = Mongo::table('tb_case')->where($w)->orderby('appointment', 'desc')->get();
        $patient   = (object) Mongo::table('tb_patient')->where('hn', $r->case_hn)->first();
        $view['tb_case'] = $data;
        $view['patient'] = $patient;
        $view['type']    = $r->btn;
        $view['url']     = url('');
        $view['tb_procedure'] =(object) Mongo::table('tb_procedure')->get();
        $html = view("EndoCAPTURE.home.component.content_case",$view)->render();
        echo $html;
    }

    public function delete_case($r){
        $w[] = array('_id', $r->del_caseid);
        $u['statusjob'] = 'deleted';
        $update = Mongo::table('tb_case')->where($w)->update($u);
        return  redirect(url('home'));
    }

    public function count_duplicate($array){
        $vals = array_count_values($array);
    }

    public function get_only_egd($r){
        $date_now = Carbon::now()->toDateString();
        $w[] = array('appointment', 'like', '%'.$date_now.'%');
        $w[] = array('case_hn', $r->hn);
        $w[] = array('procedurename', 'EGD');
        $case = Mongo::table('tb_case')->where($w)->first();
        return jsonEncode($case);
    }

    public function destroy($id){
        $data['case_status'] = 90;
        Datacase::where('case_id',$id)->update($data);
        $case = Datacase::where('case_id',$id)->first();
        createTEMP('tb_case',$case->caseuniq,$case->comcreate,date("ymdHis"));
        return redirect('home');
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

    public function line_login($r){
        if(isset($r)){
            $email = $r->email ?? null;
            $page  = $r->page ?? null;
            $user =   (object) Mongo::table('users')->where('user_email', $email)->first();
            if ( $user ) {
                $timeend = time() + 2592000;
                setcookie("uid", $user->id, $timeend, "/");
                return $page;
            }
        }
    }



}
