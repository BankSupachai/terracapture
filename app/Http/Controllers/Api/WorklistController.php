<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;
use App\Models\Server;

use App\Models\Datacase;
use App\Models\Department;
use PDO;
use stdClass;

class WorklistController extends Controller
{

    public function index(){
        $findpatient = DB::connection('mssql')->table('vEndosmartInterface')
        ->where('hn',"2262250")
        ->first();
    }


    public function show($id){
        $findpatient = DB::connection('mssql')->table('vEndosmartInterface')
        ->where('hn',$id)
        ->first();

        dd($findpatient);
    }


    public function store(Request $r)
    {
        switch($r->event){
            case "json2DB"          :   $this->json2DB($r);             break;
            case "worklistGET"      :   $this->worklistGET($r);         break;
            case "getworklistBYID"  :   $this->getworklistBYID($r);     break;
            case "getworklistsiph"  :   $this->getworklistsiph($r);     break;
            case "filter_worklist"  :   $this->filter_worklist($r);     break;
            case "save_findtext"    :   $this->save_findtext($r);       break;
            case "delete_findtext"  :   $this->delete_findtext($r);     break;
            case "wk_movecase"      :   return $this->wk_movecase($r);  break;
            case "changedoctorcode" :   $this->changedoctorcode($r);    break;
        }
    }

    public function getworklistsiph($r){
        shell_exec("D:\allindex\worklist\getworklist_mongo222.pyw");
    }


    public function changedoctorcode($r){
        $w[] = array("_id",$r->wid);
        $uid = intval($r->uid);
        $physician = Mongo::table("users")->where("uid",$uid)->first();
        $val['physiciancode'] = @$physician['user_code']."";
        $val['physicianname'] = @$physician['user_prefix'].@$physician['user_firstname']." ".@$physician['user_lastname'];
        Mongo::table("tb_caseworklist")->where($w)->update($val);
    }



    public function getworklistBYID($r){

        $tb_bookworklist = DB::table("tb_bookworklist")->where("id",$r->id)->first();


        $patient = DB::table("patient")->where("hn",$r->hn)->first();

        if($patient==null){
            $patient2 = DB::connection('mssql')->table('vEndosmartInterface')
            ->where('hn',$r->hn)
            ->first();

            if($patient2!=null){
                $temp = explode(" ",$patient2->BirthDateTime);
                $birthdate = $temp[0];

                $gender = 1;
                $gender2 = "MALE";
                if($patient2->SexCode=="F"){
                    $gender = 2;
                    $gender2 = "FEMALE";
                }

                $val['hn']              = $r->hn;
                $val['an']              = null;
                $val['citizen']         = "";
                $val['pic']             = "";
                $val['prefix']          = "";
                $val['firstname']       = $patient2->Name."";
                $val['middlename']      = "";
                $val['lastname']        = $patient2->SurName."";
                $val['gender']          = $gender."";
                $val['nationality']     = 1;
                $val['birthdate']       = $birthdate."";
                $val['phone']           = null;
                $val['email']           = null;
                $val['patient_json']    = "{}";
                $val['vip']             = null;
                DB::table("patient")->insert($val);
            }

        }




        $patient = DB::table("patient")->where("hn",$r->hn)->first();
        $gender = "MALE";
        if(@$patient->gender=="1"){
            $gender = "FEMALE";
        }

        $json = jsonDecode($tb_bookworklist->worklist_json);
        $arr["id"]          = $tb_bookworklist->id;
        $arr["hn"]          = @$patient->hn;
        $arr["patientname"] = @$patient->firstname." ".@$patient->lastname;
        $arr['age']         = age(@$patient->birthdate);
        $arr['gender']      = $gender;

        $ex = explode(" ", $json->procedureDescription);

        $tb_hisfindtext     = DB::table('tb_hisfindtext')->wherein('hisfindtext_find',$ex)->get();
        if($tb_hisfindtext !=null){
            foreach($tb_hisfindtext as $data){
                $arr['procedure'][] = str_replace(" ","",$data->hisfindtext_return);
            }
        }else{
            $arr['procedure'][] = "";
        }
        printJSON($arr);

    }



    public function worklistGET($r){
        $w[0] = array("worklist_date"       ,date("Ymd"));
        $w[1] = array("worklist_status"     ,"create");
        $view['tb_bookworklist'] = DB::table("tb_bookworklist")->where($w)->get();
        $view['doctor']         = Department::user('doctor');
        $view['procedure']      = Department::procedure(uid());

        $data = view("EndoCAPTURE.home.box.table_worklist",$view)->render();
        echo $data;
    }


    public function json2DB($r){

        exec("D:\allindex\worklist\__pycache__\getworklist.cpython-310.pyc");

        $department = "GI";
        $temp       = file_get_contents(htdocs("store/worklist/temp.txt"));
        $arr        = jsonDecode($temp);

        foreach($arr as $data){
            $w[0] = array("worklist_pid"        ,$data->patientID);
            $w[1] = array("worklist_date"       ,$data->date);
            $w[2] = array("worklist_modality"   ,$data->modality);
            $w[3] = array("worklist_department" ,$department);
            $tb_bookworklist = DB::table("tb_bookworklist")->where($w)->first();

            if($tb_bookworklist==null){
                $val["worklist_pid"]        = $data->patientID;
                $val["worklist_date"]       = $data->date;
                $val["worklist_modality"]   = $data->modality;
                $val["worklist_department"] = $department;
                $val["worklist_json"]       = jsonEncode($data);
                $val["worklist_status"]     = "create";
                DB::table("tb_bookworklist")->insert($val);
            }
        }

        echo "success";
    }

    public function filter_worklist($r){
        // $w[] = array('accessionnumber', '!=', '');
        $w[] = array('date', '!=', '');
        if(isset($r->patient_id)){
            $w[] = array('patientid', 'like', '%'.$r->patient_id.'%');
        }

        if(isset($r->patient_name)){
            $w[] = array('patient_nameTH', 'like', '%'.$r->patient_name.'%');
        }

        // dd($r->showall);

        if($r->showall=="false"){

            $lumina = getCONFIG('lumina');
            // $w[] = array('department',  $lumina->department);
        }
        $tb_worklist = Mongo::table('tb_caseworklist')->where($w)->orderBy('_id', 'desc')->limit(100)->get();

        foreach (isset($tb_worklist)?$tb_worklist:[] as $index =>  $worklist) {
            $worklist = (object) $worklist;
            $wk_procedure = isset($worklist->proceduredescription) ? $worklist->proceduredescription : '';
            $matchs = $this->match_procedure($wk_procedure, 'recorder');
            if(isset($matchs[0])){
                $worklist->match_procedure =  $matchs[0];
            } else{
                $worklist->match_procedure = get_key_config("default_procedure", 'lumina');
            }
            if(empty($worklist->match_procedure)){
                $worklist->match_procedure = get_key_config("default_procedure", 'lumina');
            }
            $tb_worklist[$index] = $worklist;
        }

        echo json_encode($tb_worklist);
    }

    public function match_procedure($r, $type=''){
        $procedurename = $type == '' ? @$r->procedure : $r;
        $tb_worklistfindtext = Mongo::table('tb_worklistfindtext')->get();
        $match = [];
        foreach(isset($tb_worklistfindtext)?$tb_worklistfindtext:[] as $findtext){
            $findtext = (object) $findtext;
            $find = @$findtext->text_find."";
            $text = @$findtext->text_match."";
            if(str_contains(strtolower($procedurename), strtolower($find))){
                $match[] = $text;
            }
        }
        return $type == '' ? json_encode($match) : $match;
    }

    public function save_findtext($r){
        $_id = $r->id;
        $text_match = $r->match;
        $w[0] = array('_id', $_id);
        $u['text_match'] = @$text_match;
        try{
            Server::table('tb_worklistfindtext')->where($w)->update($u);
        } catch(\Exception $e){}
        semi_createtemp_masterdata("tb_worklistfindtext");
    }

    public function delete_findtext($r){
        $_id = $r->id;
        $w[0] = array('_id', $_id);
        try{
            Server::table('tb_worklistfindtext')->where($w)->delete();
        } catch(\Exception $e){}
    }

    public function wk_movecase($r){
        $w[0] = array('hn', $r->hn);
        $tb_patient = Mongo::table('tb_patient')->where($w)->first();
        $worklist = (object) Mongo::table('tb_caseworklist')->where('_id', $r->worklist_id)->first();
        if(!isset($tb_patient)){
            $patientname = @$worklist->patient_nameTH."" != "" ? explode(' ', $worklist->patient_nameTH) : explode('^', $worklist->patientname);
            $data['firstname'] = @$patientname[0]."";
            $data['lastname'] = @$patientname[1]."";
            $data['gender'] = '';
            if(str_contains($data['firstname'], 'นาย')){
                $data['firstname'] =  str_replace('นาย', '', $data['firstname']);
                $data['prefix'] = 'นาย';
                $data['gender'] = 1;
            } else if(str_contains($data['firstname'], 'นางสาว')){
                $data['firstname'] =  str_replace('นางสาว', '', $data['firstname']);
                $data['prefix'] = 'นางสาว';
                $data['gender'] = 2;
            } else if(str_contains($data['firstname'], 'นาง')){
                $data['firstname'] =  str_replace('นาง', '', $data['firstname']);
                $data['prefix'] = 'นาง';
                $data['gender'] = 2;
            }

            $data['age'] = date('Y-m-d');
            $this->create_patient($data, $r->hn);
        }



        $instant_case = (object) Mongo::table('tb_case')->where('_id', $r->instant_cid)->first();
        $procedure = (object) Mongo::table('tb_procedure')->where('name', $r->procedure)->first();

        $case = new stdClass();
        $case->move_hn = @$r->hn."";
        $case->case_id = @$instant_case->_id."";
        $case->folderdate = @explode(' ', @$instant_case->appointment."")[0]."";
        $case->procedure_code = @$procedure->code."";
        $case->physician_id = @$instant_case->case_physicians01."";
        $case->accessionno = @$worklist->accessionnumber."";
        $case->visitno = @$worklist->visitno."";
        $newcid = move_case($case);
        echo $newcid;
    }

    function sendfile_server($r){
        shell_exec("D:/allindex/recorder/other/ftp/client.py $r->hn");
    }


    function create_patient($patient, $hn){
        // dd($patient);
        $val['firstname']           = @$patient['firstname']."";
        $val['lastname']            = @$patient['lastname']."";
        $val['prefix']              = @$patient['prefix']."";
        $val['hn']                  = $hn."";
        $val['gender']              = $patient['gender'];
        $val['birthdate']           = $patient['age'];
        $lastid = Mongo::table('tb_patient')->insertGetId($val);
    }



}
