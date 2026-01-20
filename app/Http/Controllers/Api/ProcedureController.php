<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\Datacase;
use App\Models\Mongo;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use ZipArchive;
use Illuminate\Support\Facades\Hash;
use App\Models\Server;
class ProcedureController extends Controller
{


    public function show($id)
    {
       $this->photozip($id);
    }

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }

    public function compartrecord($table,$comname,$primary){
        $master     = Server::table($table)->get();
        foreach($master as $data){
                $data = (array)$data;
                $local  = Mongo::table($table)->where($primary,$data[$primary])->first();
                $local = $local ? (array)$local : null;
            if($local && isset($local[$primary])){
                if(isset($data['id'])) {
                    unset($data['id']);
                    unset($data['_id']);
                }
                Mongo::table($table)->where($primary,$local[$primary])->update($data);
            }else{
                unset($data['id']);
                unset($data['_id']);
                Mongo::table($table)->insert($data);
            }
        }
        if($table!="tb_department"){
            $w[] = array("client",$comname);
            $w[] = array("table",$table);
            Server::table("tb_semimasterdata")->where($w)->delete();
        }

    }


    public function add_doctor($r){
        $admin      = getCONFIG("admin");
        $comname    = $admin->com_name;

        // dd($r->all());
        $w[] = array('user_firstname', $r->user_firstname);
        $w[] = array('user_lastname', $r->user_lastname);

        $tb_users = server::table("users")->where($w)->first();
        // dd($tb_users);
        if($tb_users == Null){
            $val['id']              = get_last_id('id', 'users') + 1;
            $val['user_code']       = '';
            $val['color']           = '';
            $val['phone']           = '';
            $val['opencase']        = 1;
            $val['procedure_json']  = '';
            $val['user_type']       = "doctor";
            $val['name']            = "Doctor";


            $val['user_prefix']     = $r->user_prefix;
            $val['user_firstname']  = $r->user_firstname;
            $val['user_lastname']   = $r->user_lastname;
            $id = server::table('users')->insertGetId($val);
            $val2['email'] = "doctor$id";
            $val2['password'] = Hash::make("123456");
            $val2['opencase'] = 1;
            server::table("users")->where("uid" , $id)->update($val2);
            semi_createtemp_masterdata("users");
            semi_createtemp_masterdata("tb_department");
            $this->compartrecord("users",$comname,"id");
            $this->compartrecord("tb_department",$comname,"department_id");

            return redirect("procedure/$r->cid");

            // dd($id);
        }
    }


    public function autotextgroup_save($r){
        if($r->text!="" && $r->text!=null){
            $wa[0] = array('auto_text'       ,$r->text);
            $wa[1] = array('auto_textid'     ,$r->name);
            $wa[2] = array('auto_procedure'  ,$r->code);
            $count = Mongo::table('tb_autotext')->where($wa)->count();
            if($count==0){
                $auto['auto_procedure']  = $r->code;
                $auto['auto_text']       = $r->text;
                $auto['auto_textid']     = $r->name;
                Mongo::table('tb_autotext')->insert($auto);
            }
        }
    }

    public function mainpart_photo_text($r){
        $val = Mongo::table("tb_case")->where("_id",$r->cid)->first();
        $val['advance'][$r->mainpart][$r->lesion]['photo'][$r->photo]['text'] = $r->text;
        Mongo::table("tb_case")->where("_id",$r->cid)->update($val);
    }

    public function mainpart_text($r){
        if($r->text!=""){
            $val = Mongo::table("tb_case")->where("_id",$r->cid)->first();
            $val['advance'][$r->mainpart][$r->lesion]['text'][$r->component_name] = $r->text;
            Mongo::table("tb_case")->where("_id",$r->cid)->update($val);
        }
    }

    public function mainpart_checkbox($r){
        $val = Mongo::table("tb_case")->where("_id",$r->cid)->first();
        if(isset($val['advance'][$r->mainpart][$r->lesion]['checkbox'][$r->group][$r->component_name])){
            unset($val['advance'][$r->mainpart][$r->lesion]['checkbox'][$r->group][$r->component_name]);
        }
        $val['advance'][$r->mainpart][$r->lesion]['checkbox'][$r->group] = $r->checkall;
        Mongo::table("tb_case")->where("_id",$r->cid)->update($val);
    }

    public function lesion_add($r){
        $html   = $r->html;
        $num    = $r->num;
        $html   = str_replace('999',$num,$html);
        // About component Checkbox
        $html   = str_replace('for="','for="'.$num,$html);
        $html   = str_replace('lesion="'.$num.'" id="' ,'lesion="'.$num.'" id="' .$num,$html);
        echo $html;
    }


    public function lesion_delete($r){
        $val = Mongo::table("tb_case")->where("_id",$r->cid)->first();
        unset($val['advance'][$r->mainpart][$r->lesion]);
        Mongo::table("tb_case")->where("_id",$r->cid)->update($val);
    }





    public function checkport($r){
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
        echo exec("D:\\allindex\\service\\portscanner.py $r->comname $r->port");
    }


    public function photozip($r)
    {
        $zip = new ZipArchive;
        $photo = array();
        $tb_case = Mongo::table("tb_case")->where("id" , $r->cid)->first();
        $procedure = $tb_case->procedurename;

        $hn     = $tb_case->case_hn;
        $date = $tb_case->appointment_date;

        $zipFilePath = "D:\\laragon\\htdocs\\temp\\photo_".$procedure."_$hn"."_"."$date.zip";
        $path = "D:\\laragon\\htdocs\\store\\$hn\\$date\\";
        // dd($path);

        foreach($tb_case->photo as $data){
            $photopath = $path . $data['na'];
            if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
                $zip->addFile($photopath, $data['na']);
                $zip->close();

            }
        }
        // return response()->download($zipFilePath)->deleteFileAfterSend(true);


        // dd($photo);
        }


    public function semi($r)
    {
        $case = (object) Mongo::table("tb_case")->where("_id", $r->cid)->first();
        exec("D:\\allindex\\ftp\\__pycache__\\client.cpython-310.pyc $case->case_hn");
        $val['semi'] = false;
        Mongo::table("tb_case")->where("_id", $case->id)->update($val);
        createTEMP('tb_case', $case->caseuniq, $case->comcreate, date("ymdHis"));
    }


    public function boston_bowel($r)
    {
        $tb_case = Mongo::table("tb_case")->where("id", $r->cid)->first();
        // Convert object to array if it's not already an array
        $tb_case = is_object($tb_case) ? (array) $tb_case : $tb_case;

        $location = $r->location;
        $id       = $r->cid;
        $score    = $r->score;

        // ถ้า score เป็น empty string หรือ null ให้ลบค่านั้นออก (unset)
        if ($score === "" || $score === null) {
            if (isset($tb_case['bowel_score'])) {
                $u['bowel_score'] = $tb_case['bowel_score'];
                // ลบค่า location นี้ออก
                if (isset($u['bowel_score'][$location])) {
                    unset($u['bowel_score'][$location]);
                    // ถ้า bowel_score ว่างแล้ว ให้ลบ field ออก
                    if (empty($u['bowel_score'])) {
                        Mongo::table('tb_case')->where('id', $id)->update(['$unset' => ['bowel_score' => '', 'boston_score' => '']]);
                    } else {
                        Mongo::table('tb_case')->where('id', $id)->update($u);
                    }
                }
            }
        } else {
            $u = [];
            if(isset($tb_case['bowel_score'])){
                $u['bowel_score'] = $tb_case['bowel_score'];
                $u['bowel_score'][$location] = $score;
            }else{
                $u['bowel_score'][$location] = $score;
            }
            Mongo::table('tb_case')->where('id', $id)->update($u);
        }
    }

    public function save_boston($r)
    {
        $total_score = $r->total;
        // ถ้าเป็น empty string ให้แปลงเป็น 0 สำหรับการบันทึก
        $left_side = ($r->left_side === "" || $r->left_side === null) ? 0 : intval($r->left_side);
        $transverse_colon = ($r->transverse_colon === "" || $r->transverse_colon === null) ? 0 : intval($r->transverse_colon);
        $right_side = ($r->right_side === "" || $r->right_side === null) ? 0 : intval($r->right_side);

        // ถ้าคะแนนรวมเป็น 0 (หมายความว่าทุก location เป็น 0 หรือ empty) ให้ลบ boston_score ออกเพื่อให้แสดงเป็น "-"
        if ($total_score == 0) {
            // ลบ boston_score และ bowel_score ออกเพื่อให้แสดงเป็น "-"
            Mongo::table('tb_case')->where('id', $r->cid)->update(['$unset' => ['boston_score' => '', 'bowel_score' => '']]);
        } else {
            $u['bowel_score'] = [];
            $u['bowel_score']['left_side'] = $left_side;
            $u['bowel_score']['transverse_colon'] = $transverse_colon;
            $u['bowel_score']['right_side'] = $right_side;
            $u['boston_score'] = $total_score;
            Mongo::table('tb_case')->where('id', $r->cid)->update($u);
        }
    }










    public function savejsongroup($r)
    {
        $cid    = $r->cid;
        $name   = $r->name;
        $value  = jsonDecode($r->val);
        $key    = jsonDecode($r->key);
        $arr    = array();
        $i      = 0;
        foreach ($key as $k) {
            if ($value[$i] != "") {
                $w[0] = array('auto_text', $value[$i]);
                $w[1] = array('auto_textid', $r->html_id);
                $w[2] = array('auto_procedure', $r->procedure);
                $count = Mongo::table('tb_autotext')->where($w)->count();
                if ($count == 0) {
                    $val['auto_procedure']  = $r->procedure;
                    $val['auto_text']       = $value[$i];
                    $val['auto_textid']     = $r->html_id;
                    Mongo::table('tb_autotext')->insert($val);
                }
            }
            $arr[$k] = $value[$i];
            $i++;
        }
        case_jsonSave($cid, $name, $arr);
    }

    public function focusout3($r)
    {
        Mongo::table('tb_case')
            ->where('case_id', $r->case_id)
            ->where($r->idname, $r->id)
            ->update([$r->name => $r->value]);
        if ($r->value != "") {
            $w[0] = array('auto_text', $r->value);
            $w[1] = array('auto_textid', $r->name);
            $w[2] = array('auto_procedure', $r->procedure);
            $count = Mongo::table('autotext')->where($w)->count();
            if ($count == 0) {
                $val['auto_procedure']  = $r->procedure;
                $val['auto_text']       = $r->value;
                $val['auto_textid']     = $r->name;
                Mongo::table('autotext')->insert($val);
            }
        }
    }

    public function focusout($r)
    {
        Mongo::table($r->table)
            ->where($r->idname, $r->id)
            ->update([$r->name => $r->value]);
        if ($r->value != "") {
            $w[0] = array('auto_text', $r->value);
            $w[1] = array('auto_textid', $r->name);
            $w[2] = array('auto_procedure', $r->procedure);
            $count = Mongo::table('autotext')->where($w)->count();
            if ($count == 0) {
                $val['auto_procedure']  = $r->procedure;
                $val['auto_text']       = $r->value;
                $val['auto_textid']     = $r->name;
                Mongo::table('autotext')->insert($val);
            }
        }
    }

    public function savejson($r)
    {
        Datacase::dataUPDATE2($r->id, $r->name, $r->value);
        Datacase::dataUPDATE2($r->id, "pdfcreate", false);
        if ($r->value != "") {
            $w[0] = array('auto_text', $r->value);
            $w[1] = array('auto_textid', $r->name);
            $w[2] = array('auto_procedure', $r->procedure);
            $count = Mongo::table('tb_autotext')->where($w)->count();
            if ($count == 0) {
                $val['auto_procedure']  = $r->procedure;
                $val['auto_text']       = $r->value;
                $val['auto_textid']     = $r->name;
                Mongo::table('tb_autotext')->insert($val);
            }
        }
    }

    public function savedoctor($r)
    {
        $user        = Mongo::table('users')->where('uid', $r->value)->orWhere('id', intval($r->value))->first();
        $user        = (object) $user;
        $fullname    = $user->user_prefix;
        $fullname   .= $user->user_firstname . " ";
        $fullname   .= $user->user_lastname;

        $w['_id']          = $r->id;
        $tb_case = Mongo::table('tb_case')->where($w)->first();
        if (isset($tb_case)) {
            $tb_case =  (object) $tb_case;
            $case_json = isset($tb_case->case_json) ? $tb_case->case_json : [];
            $case_json['doctorname'] = $fullname;
            $val['case_json'] = $case_json;
            Mongo::table('tb_case')->where($w)->update($val);
        }
        $u['doctorname'] = $fullname;
        Mongo::table('tb_case')->where('_id', $r->id)->update($u);
    }


    public function edittreatment($r){
        Mongo::table("tb_casenote")->where("id", $r->noteid)->update(['treatment'=>$r->code]);
        Mongo::table("tb_booking")->where("noteid",$r->noteidstr)->update(['treatment'=>$r->code]);
    }

    public function json_del($r){
        $w      = (object) Mongo::table('tb_case')->where('id',$r->case_id)->first();
        $json   = $w->photo;
        $ppp    = array();
        $x=0;
        foreach($json as $j){
            $j = (object)$j;
            if($j->nu==$r->id){
                $mos = 0;
                if($j->st == 0){
                    $mos = 10;
                }
                $ppp[$x]['nu']  = $j->nu;
                $ppp[$x]['ns']  = 0;
                $ppp[$x]['na']  = $j->na;
                $ppp[$x]['sc']  = $j->sc;
                $ppp[$x]['st']  = $mos;
                $ppp[$x]['tx']  = $j->tx;
            }else{
                $ppp[$x]['nu']  = $j->nu;
                $ppp[$x]['ns']  = $j->ns;
                $ppp[$x]['na']  = $j->na;
                $ppp[$x]['sc']  = $j->sc;
                $ppp[$x]['st']  = $j->st;
                $ppp[$x]['tx']  = $j->tx;
            }
            $x++;

        }
        $val['photo'] = $ppp;
        Mongo::table('tb_case')->where('id',$r->case_id)->update($val);
        echo $mos;
    }


    public function medi_other($r){
        $tb_case            = Mongo::table('tb_case')->where('_id',$r->cid)->first();
        $w['caseuniq']      = $tb_case->caseuniq;
        $tb_casemedication  = Mongo::table('tb_casemedication')->where($w)->first();
        if($tb_casemedication==null){
            $w[$r->name] = $r->value;
            Mongo::table('tb_casemedication')->insert($w);
        }else{
            Mongo::table('tb_casemedication')->where($w)->update([$r->name=>$r->value]);
        }
        Mongo::table('tb_case')->where($w)->update([$r->name=>$r->value]);
    }


    public function checkboxgroupsave($r){
        $val[$r->datagroup] = $r->array;
        Mongo::table('tb_case')->where("id",$r->cid)->update($val);
    }

    public function saveradio($r)
    {
        $val[$r->name] = $r->value;
        Mongo::table("tb_case")->where("_id", $r->cid)->update($val);
    }


    public function radiosave($r){
        if(empty($r->datagroup)){return '';}
        if(empty($r->value)){ $r->value = ''; }
        $val[$r->datagroup] = $r->value;
        Mongo::table('tb_case')->where("id",$r->cid)->update($val);
    }

    public function selectsave($r){
        $val[$r->datagroup] = $r->value;
        // dd($r->all());
        Mongo::table('tb_case')->where("id",$r->cid)->update($val);
    }

    public function radiosavename($r){
        if(!isset($r->datagroup)){
            return 'error';
        }

        if(empty($r->value)){
            $r->value = '';
        }

        if(is_array($r->value)){
            $fullnames = [];
            foreach ($r->value as $id) {
                $w[0] = array('uid', intval($id));
                $user = (object) Mongo::table('users')->where($w)->first();
                $fullnames[] = fullName($user);
                $w = [];
            }
            $u[$r->datagroup] = $fullnames;
            Mongo::table('tb_case')->where("id",$r->cid)->update($u);
        } else {
            $w[0] = array('uid', intval($r->value));
            $user = (object) Mongo::table('users')->where($w)->first();
            $fullname = fullName($user);
            $u[$r->datagroup] = $fullname;
            Mongo::table('tb_case')->where("id",$r->cid)->update($u);
        }
        return jsonEncode($u);
    }




    public function caseupdate($r){
        $val[$r->key] = $r->value;
        Mongo::table('tb_case')->where("id",$r->cid)->update($val);
    }

    public function changedoctor($r){
        $uid    = (int) $r->value;
        $user   = (object) Mongo::table("users")->where("uid",$uid)->first();
        if(isset($user->user_prefix)){
            $fullname = $user->user_prefix.$user->user_firstname." ".$user->user_lastname;
            $val[$r->name] = $uid;
            if($r->name == 'case_reportedby') {
                $val['doctorreported'] = $fullname;
            } else {
                $val['doctorname'] = $fullname;
            }
            Mongo::table("tb_case")->where("id",$r->cid)->update($val);
        }
    }


    public function savejson_edit($r){
        if(gettype($r->value) != 'array'){
            $value = json_decode($r->value, true);
        } else { $value = $r->value; }

        if(!isset($r->value)){
            $value = $r->is_array ?  [] : '';
        }
        // if (json_last_error() === JSON_ERROR_NONE) {
        if (isset($r->value) || $value == "") {
            if(isset($r->is_other)){

                $key = array_key_first($value);
                $val[$key] =  $value[$key];

            } else {
                $val[$r->datagroup] = $value;
            }
        } else {
            $val[$r->datagroup] = [];
        }
        Mongo::table('tb_case')->where("id",$r->cid)->update($val);
    }

    public function checkboxgroupsave_edit($r){
        $array = json_decode($r->value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // $r->merge(['array' => $r->array]);
            $val[$r->datagroup] = $array;
            Mongo::table('tb_case')->where("id",$r->cid)->update($val);
        }
    }






}
