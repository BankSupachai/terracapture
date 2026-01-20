<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Endocapture\ExportController;
use App\Http\Controllers\MongoDB\BrowseController;
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Patient;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use function GuzzleHttp\json_decode;

class JqueryController extends Controller
{


    public function store(Request $r)
    {
        // dd($r->all());
        if(isset($r->event)){
            // new
            if($r->event == 'theme_fontsize'){
                setCONFIG("admin","theme_fontsize",$r->size);
            }

            if($r->event == 'hamburger'){
                $admin = getCONFIG("admin");
                if(@$admin->menu_left_big_small){
                    @$admin->menu_left_big_small = false;
                }else{
                    @$admin->menu_left_big_small = true;
                }
                setCONFIG("admin","menu_left_big_small",$admin->menu_left_big_small);
            }

            if($r->event == 'system'){
                $admin = (array) getCONFIG("admin");
                if($r->value=="true"){
                    $value = "true";
                }else{
                    $value = "false";
                }
                setCONFIG("admin",$r->systemname,$value);
            }



            if($r->event == 'book_confirm'){
                $this->book_confirm($r);
            }
            if($r->event == 'book_cancel'){
                $this->book_cancel($r);
            }
            if($r->event == 'get_book_data'){
                $this->get_book_data($r);
            }

            if($r->event == 'get_phone'){
                $pt = Mongo::table('tb_patient')->where('hn',$r->hn)->first();
                $pt = (object) $pt;
                if(isset($pt)){
                    echo isset($pt->phone) ? $pt->phone : '';
                }else{
                    echo 'none';
                }

            }
            if($r->event == 'update_many_checked'){
                $this->update_many_checked($r);
            }
            if($r->event == 'update_tb_case'){
                $this->update_tb_case($r->id,$r->idhtml,$r->value);
            }


            if($r->event == 'save_note'){
                $this->notecase_jsonpatient($r->id,$r->idhtml,$r->value,$r->step);
            }

            if($r->event == 'save_note_sub'){
                if(str_contains($r->key, '_ck')){
                    return 'wrong key';
                }
                $head     = $r->head;
                $key      = $r->key;
                $_id      = $r->id;
                $choice   = isset($r->choice) ? $r->choice : '';
                $tb_casenote = Mongo::table('tb_casenote')->where('_id', $_id)->first();
                $up          = isset($tb_casenote[$head]) ? $tb_casenote[$head] : [];
                if(isset($head) && isset($key) && isset($_id) && isset($choice)){
                    $up[$key] = $choice;
                    $tb_casenote[$head] = $up;
                    Mongo::table('tb_casenote')->where('_id', $_id)->update($tb_casenote);
                    echo 'success';
                } else { echo 'error';}
            }

            if($r->event=="queue_update")   {$this->next_queue($r->queue_status,$r->q_id);}

            if($r->event=="delete_scope")   {
                $tb_case = Mongo::table('tb_case')->where('_id',$r->case_id)->first();
                $tb_case = (object) $tb_case;
                $scope   = isset($tb_case->scope) ? $tb_case->scope : [];
                if(in_array($r->scope_name, $scope)){
                    $index = array_search($r->scope_name, $scope);
                    unset($scope[$index]);
                    $data['scope'] = $scope;
                    Mongo::table('tb_case')->where('_id',$r->case_id)->update($data);
                    return 'success';
                }
            }
            if($r->event=="add_scope")   {
                $tb_case = Mongo::table('tb_case')->where('_id',$r->case_id)->first();
                $tb_case = (object) $tb_case;
                $scope   = isset($tb_case->scope) ? $tb_case->scope : [];
                if(in_array($r->scope_name, $scope) == false){
                    $scope[] = $r->scope_name;
                    $data['scope'] = $scope;
                    Mongo::table('tb_case')->where('_id',$r->case_id)->update($data);

                    $scope = Mongo::table('tb_scope')->where('scope_id',intval($r->scope_name))->first();
                    $scope = (object) $scope;
                    return jsonEncode($scope);
                }
            }
            if($r->event=="display_n_0")    {$this->display($r->value,$r->data_type);}


            if($r->event=='savejson_checkbox'){
                Datacase::dataUPDATE($r->id,[$r->idhtml=>$r->value]);
            }

            if($r->event=='savejson_checkbox2'){
                $tb_case = (array) Mongo::table('tb_case')->where('_id',$r->id)->first();
                $tb_case[$r->idhtml] = $r->value;
                unset($tb_case['id']);
                Mongo::table('tb_case')->where('_id',$r->id)->update($tb_case);
            }


            if($r->event=='save_followup'){
                $noteid = $r->noteid;
                $value['followup']  = jsonDecode($r->value);
                Mongo::table('tb_casenote')->where('_id', $noteid)->update($value);
                echo 'success';
            }

            if($r->event=='save_followup_str'){
                $noteid = $r->noteid;
                $value  = $r->value;
                $tb_casenote = Mongo::table('tb_casenote')->where('_id', $noteid)->first();
                $tb_casenote = (object) $tb_casenote;
                $data['followup_other'] = $value;
                Mongo::table('tb_casenote')->where('_id', $noteid)->update($data);
            }


            if($r->event=='save_medication'){
                $value = isset($r->value) ? $r->value : [];
                $tb_casemedication = (object) Mongo::table('tb_casemedication')->where('_id',$r->id)->first();
                $medi_case = [];
                if(isset($tb_casemedication->medi_casejson)){
                    $medi_case = $tb_casemedication->medi_casejson;
                }

                foreach($value as $data){
                    $medi_case[$data] = isset($medi_case[$data]) ? $medi_case[$data] : 0;
                }

                foreach($medi_case as $key=>$medi){
                    $is_inchecked = in_array($key, $value);
                    if($is_inchecked == false){
                        $medi_case[$key] = '';
                    }
                }

                $val['medi_casejson'] = $medi_case;
                Mongo::table('tb_casemedication')->where('_id',$r->id)->update($val);
            }

            if($r->event=='save_medicationnum'){
                $tb_casemedication = (object) Mongo::table('tb_casemedication')->where('_id',$r->id)->first();
                if(isset($tb_casemedication->medi_casejson)){
                    $medi_case = $tb_casemedication->medi_casejson;
                    $medi_case[$r->text] = $r->num;
                    $val['medi_casejson'] = $medi_case;
                    Mongo::table('tb_casemedication')->where('_id',$r->id)->update($val);
                }
            }

            if($r->event=='save_medicationother'){
                $val[$r->key] = $r->value;
                Mongo::table('tb_casemedication')->where('_id',$r->id)->update($val);
            }

            if($r->event=='save_description'){
                // dd($r->all());
                if(isset($r->type) && @$r->type."" != ""){
                    $status        = @$r->type;
                    $description   = @$r->text;
                    $hn            = @$r->hn;
                    $date          = @$r->date;
                    if($r->type == 'Booking'){
                        $u['description']     = $description;
                        $w['_id']                = $r->_id;
                        $w['hn']                 = $hn;
                        $w['date']          = $date;
                        Mongo::table('tb_booking')->where($w)->update($u);
                    } else {
                        $u['monitor_description']  = $description;
                        $w['monitor_status']      = $status;
                        $w['monitor_hn']          = $hn;
                        $w['monitor_date']        = $date;
                        Mongo::table('tb_casemonitor')->where($w)->update($u);
                    }
                } else {
                    echo "error";
                }
            }

            if($r->event=="count_all"){
                $count['left']  = DB::table('tb_queue')->whereDate('q_datetime',date('Y-m-d'))->where('q_type','regis')->count();
                $count['right'] = DB::table('tb_queue')->whereDate('q_datetime',date('Y-m-d'))->where('q_type','appoint')->count();
                return $count;
            }
            if($r->event=="change_accessory"){
                $accessory = DB::table('tb_procedureicd9')->where('procedure_code',$r->id)->get()->toJson();
                return $accessory;
            }

            if($r->event=="data_book"){
                $w[] = array('book_topic','endoscopy');
                if($r->doctor!="all"){
                    $w[] = array('book_doctoremail',$r->doctor);
                }

                if($r->branch!="all"){
                    if($r->branch=="GIS"){
                        $w[] = array('book_branch','!=',"GIP");
                    }
                    if($r->branch=="GIP"){
                        $w[] = array('book_branch',"GIP");
                    }
                }

                $date = date('Y-m-d');
                if(isset($r->activeday)){
                    $date = date('Y-m-d', $r->activeday/1000);
                }
                $book_data          = DB::table('tb_casebooking')->where($w)->whereDate('book_date_end', $date)->get();
                $book_count         = DB::table('tb_casebooking')->where($w)->whereDate('book_date_end', $date)->count();
                $data['status']     = true;
                $data['date']       = $date;
                $data['datethai']   = DateThai($date);
                $data['data_show']  = $book_data;
                $data['counts']     = $book_count;

                $json               = jsonEncode($data);
                echo $json;
            }
            if($r->event=="detail_api")   {
                return file_get_contents("D:/laragon/htdocs/config/api/$r->file");
            }
            if($r->event=="connect_api")   {
                try {
                    $url = $r->url;
                    $data = array();
                    if($r->type_connect==1){
                        $json = jsonDecode($r->list_data);
                        if(count($json->key)>0){
                            for($i=0;$i<count($json->key);$i++){
                                $key = $json->key[$i];
                                $data[$key] = $json->value[$i];
                            }
                        }
                        $api =connectwebPOST($url,$data);
                    }elseif($r->type_connect==2){
                        if(count($json->key)>0){
                            for($i=0;$i<count($json->key);$i++){
                                if($i==0){
                                    $plus = '?'.$json->key[$i].'='.$json->value[$i];
                                }else{
                                    $plus = '&'.$json->key[$i].'='.$json->value[$i];
                                }
                                $url = $url.$plus;
                            }
                        }
                        $api = connectweb($url);
                    }
                    if(is_array(jsonDecode($api, true))){
                        return view('EndoCAPTURE.superadmin.component.list_api',['data'=>jsonDecode($api)]);
                    }else{
                        return $api;
                    }
                }catch(\Throwable $e) {
                    return 'error';
                }
            }
            if($r->event=="txt_api"){
                $data['url']            = $r->url;
                $data['list_data']      = $r->list_data;
                $data['type_connect']   = $r->type_connect;
                $name_api               = $r->name_api;
                $json = jsonEncode($data);
                file_put_contents($_SERVER['DOCUMENT_ROOT']."/config/api/$name_api.txt", $json);
                return 'success';
            }
            if($r->event=="month_color"){
                try {
                    $w[] = array('book_topic','endoscopy');
                    if(isset($r->doctor_data)){
                        if($r->doctor_data!='0'){
                            $w[] = array('book_doctor',$r->doctor_data);
                        }
                    }

                    $get_color = DB::table('tb_casebooking')
                    ->where($w)
                    ->whereYear('book_date_end',$r->year_data)
                    ->whereMonth('book_date_end',$r->month_data)
                    ->select(DB::raw('DATE(book_date_end) as date'))
                    ->groupBy('date')
                    ->get();

                    $procedure = DB::table('tb_procedure')->select('procedure_name')->get();
                    $date_case = 0;
                    foreach ($get_color as $gc) {
                        foreach ($procedure as $pcd) {
                            $pcd_name   = $pcd->procedure_name;
                            $count_pcd  = DB::table('tb_casebooking')
                            ->where($w)
                            ->where('book_title','like',"%$pcd_name%")
                            ->whereDate('book_date_end',$gc->date)
                            ->count();

                            if($count_pcd>0){
                                $test[$pcd_name] = $count_pcd;
                            }
                        }
                        if(isset($test)){
                            $d = date("d", strtotime($gc->date));
                            $date[$d]= $test;
                        }
                    }
                    foreach ($date as $keys => $value) {
                        foreach ($value as $day => $value_day) {
                            $date_case+=intval($value_day);
                        }
                        $x[$keys] = $date_case;
                        $date_case = 0;
                    }
                    $json = jsonEncode($x);
                }
                catch(\Throwable $e) {
                    $json = 0;
                }
                echo $json;
            }

            if($r->event=='delete_field_mongo'){
                $value = $r->value;
                $tablename = $r->tablename;
                $key = $r->key;
                if($r->type == 'array'){
                    $value = (array) jsonDecode($value);
                } else if($r->type == 'boolean'){
                    $value = $value=='true' ? true : false;
                }
                Mongo::table($tablename)->where('_id', $r->id)->update([ '$unset' => [$key => $value] ] );
            }

            if($r->event=='change_department_status'){
                $department_id = $r->department_id;
                $status        = $r->status;
                $u['department_status'] = $status;
                Mongo::table('tb_department')->where('department_id', intval($department_id))->update($u);
            }

            if($r->event=='change_user_status'){
                $user_id       = $r->user_id;
                $status        = $r->status;
                $u['user_status'] = $status;
                Server::table('users')->where('uid', intval($user_id))->update($u);
            }

            if($r->event=='change_status'){
                $id             = $r->id;
                $status         = $r->status;
                $tb_status_name = $r->tb_status_name;
                $tb_name        = $r->tb_name;
                $tb_key         = $r->tb_key;
                $u[$tb_status_name] = $status;
                if($tb_key != 'code'){
                    Server::table($tb_name)->where($tb_key, intval($id))->update($u);
                } else if($tb_key == 'code'){
                    Server::table($tb_name)->where($tb_key, $id)->update($u);
                }
            }

            if($r->event=="get_array_data"){
                $w[] = array('_id', $r->_id);
                $data = Mongo::table($r->tablename)->where($w)->select($r->field)->first();
                $arr = [];
                if(isset($data)){
                    $main = $data["$r->field"];
                    $arr  = isset($main[$r->index]) ? $main[$r->index] : [];
                }
                return jsonEncode($arr);
            }

            if($r->event=="edit_field_array_mongo"){
                $data = Mongo::table($r->tablename)->where('_id', $r->_id)->first();
                if($data != null && $data != []){
                    $field = str_contains($r->head, 'sub_sub') ? str_replace('sub_sub_', '', $r->head) : $r->head;
                    $data  = $data[$field];
                    $main_key   = is_numeric($r->main_key) ? intval($r->main_key) : $r->main_key;
                    $key   = is_numeric($r->key) ? intval($r->key) : $r->key;
                    if(str_contains($r->head, 'sub_sub')){
                        // have array inside - have key
                        $data[$main_key][$key] = $r->data;
                    } else {
                        // no array inside - no key
                        $data[$key] = $r->data;
                    }

                    $u[$field] = $data;
                    Mongo::table($r->tablename)->where('_id', $r->_id)->update($u);
                }
            }

            if($r->event=="add_field_items_mongo"){
                $data = Mongo::table($r->tablename)->where('_id', $r->_id)->first();
                if($data != null && $data != []){
                    $data      = $data[$r->head];
                    $each_type = $r->item_type;
                    $value     = $r->item_val;
                    $index     = 0;
                    if(isset($r->index)){
                        $index     = is_numeric($r->index) ? intval($r->index) : $r->index;
                    }
                    if($each_type == 'array'){
                        $value = json_decode($value, true);
                    } else if($each_type == 'boolean'){
                        $value = $value=='true' ? true : false;
                    } else if ($each_type == 'integer'){
                        $value = intval($value);
                    }

                    if($r->is_main != ''){
                        $data[$r->item_key] = $value;
                    } else {
                        $data[$index][$r->item_key] = $value;
                    }

                    $u[$r->head] = $data;
                    Mongo::table($r->tablename)->where('_id', $r->_id)->update($u);
                }
            }

            if($r->event=="delete_field_items_mongo"){
                $data = Mongo::table($r->tablename)->where('_id', $r->_id)->first();
                if($data != null && $data != []){
                    $field = str_contains($r->head, 'sub_sub') ? str_replace('sub_sub_', '', $r->head) : $r->head;
                    $data  = $data[$field];
                    $main_key   = is_numeric($r->main_key) ? intval($r->main_key) : $r->main_key;
                    $key   = is_numeric($r->key) ? intval($r->key) : $r->key;

                    $pos   = false;
                    if(str_contains($r->head, 'sub_sub')){
                    } else {
                        $pos = array_search($data[$key], $data);
                    }

                    if ($pos !== false) {
                        unset($data[$pos]);
                    } else{
                        unset($data[$main_key][$key]);
                    }

                    $u[$field] = $data;
                    Mongo::table($r->tablename)->where('_id', $r->_id)->update($u);
                }
            }

            if($r->event=="reindex_items_mongo"){
                $index_order = $r->indexs;
                $data = Mongo::table($r->tablename)->where('_id', $r->_id)->first();
                if ($data != null && $data != []) {
                    $data  = $data[$r->field];
                    $normal_data_array = array_values($data);
                    $key_array = array_keys($data);

                    $new_array = [];
                    for ($i=0; $i < count($index_order); $i++) {
                        $new_array[$key_array[$index_order[$i]]] = $normal_data_array[$index_order[$i]];
                    }

                    if(is_int($key_array[0]) && is_int($key_array[count($index_order) - 1])){
                        $new_array = array_values($new_array);
                    }

                    $u[$r->field] = $new_array;
                    Mongo::table($r->tablename)->where('_id', $r->_id)->update($u);
                }
            }

            if($r->event=='change_room_ready'){
                $room_id = @$r->room_id;
                $status  = @$r->status;
                $w[] = array('_id', $room_id);
                $up['room_ready'] = (int) $status;
                Mongo::table('tb_room')->where($w)->update($up);
            }

            if($r->event=='check_hn_move_case'){
                $patient_hn = $r->hn;
                $upper      = strtoupper($patient_hn);
                $lower      = strtolower($patient_hn);
                $patient = (object) Mongo::table('tb_patient')->where('hn', $upper)->orWhere('hn', $lower)->first();
                $name = isset($patient->firstname) ? $patient->firstname." ".@$patient->middlename." ".$patient->lastname : "";
                echo $name;
            }

            if($r->event=='check_scope'){
                $scope_serial = $r->scope_serial ?? null;
                $status = 'false';
                if(isset($scope_serial)){
                    $tb_scope = Mongo::table('tb_scope')->where('scope_serial', $scope_serial)->first() ?? [];
                    if(count($tb_scope) > 0){
                        $status = 'true';
                    }
                }
                echo $status;
            }

            if($r->event=='check_tablename_mongo'){
                $status = 'notexist';
                $alltable = BrowseController::alltable();
                if(in_array($r->name, $alltable)){
                    $status = 'exist';
                }
                echo $status;
            }





            if($r->event=="get_user_room"){
                $_id = $r->room_id;
                $w[] = array('id', $_id);
                $tb_room = (object) Mongo::table('tb_room')->where($w)->first();
                $room_user = $tb_room->room_user ?? [];
                $arr = [];
                // dd($room_user);
                foreach($room_user as $user) {
                    $user_doctor = Mongo::table('users')
                    ->where('uid', $user)
                    ->where("user_type", "doctor")
                    ->first();
                    if($user_doctor) {
                        $user_doctor = $user_doctor->uid;
                        if(!empty($user_doctor)) {
                            $arr['doctor'][] = $user_doctor;
                        }
                    }

                    $user_nurse = Mongo::table('users')
                    ->where('uid', $user)
                    ->where("user_type", "nurse")
                    ->first();
                    if($user_nurse) {
                        $user_nurse = $user_nurse->uid;
                        if(!empty($user_nurse)) {
                            $arr['nurse'][] = $user_nurse;
                        }
                    }

                    $user_nurse_assist = Mongo::table('users')
                    ->where('uid', $user)
                    ->where("user_type", "nurse_assist")
                    ->first();
                    if($user_nurse_assist) {
                        $user_nurse_assist = $user_nurse_assist->uid;
                        if(!empty($user_nurse_assist)) {
                            $arr['nurse_assist'][] = $user_nurse_assist;
                        }
                    }
                }

                $arr = array_filter($arr);
                $arr['room_name'] = $tb_room->room_name;

                // dd($arr);

                return $arr;
            }

            if($r->event == 'check_hn_viewer'){
                $status = true;
                $patient = Patient::get_patient_by_id($r->hn, 'server');
                try{
                    $patient_endosmart = Server::table('newendosmart_data')->where('hn', $r->hn)->get();
                    if(!isset($patient) && count($patient_endosmart)==0){
                        $status = 'none';
                    }
                    return $status;
                } catch (\Exception $e) {
                    return 'none';
                } catch (\Throwable $e) {
                    return 'none';
                }
            }

            if($r->event == 'get_user_select'){
                $users_arr = [];
                if(isset($r->type) && @$r->type."" != 'ไม่ระบุ'){
                    $users = Mongo::table('users')->where('user_branch', $r->type)->get();
                    $users_arr = $users;
                } else {
                    $users = Mongo::table('users')->get();
                    $users_arr = $users;
                }
                return jsonEncode($users_arr);
            }

            if($r->event == 'get_procedure'){
                $procedures = [];
                $all_procedures = Mongo::table('tb_procedure')->get();
                foreach ($all_procedures as $index => $proc) {
                    $proc = (object) $proc;
                    if(isset($proc->name) && @$proc->name."" != ""){
                    $procedures[] = $proc->name;
                    }
                }
                return jsonEncode($procedures);
            }

            if($r->event == 'get_scope'){
                $scopes = [];
                $all_scopes = Mongo::table('tb_scope')->get();
                foreach ($all_scopes as $index => $scope) {
                    $scope = (object) $scope;
                    if(isset($scope->scope_name) && @$scope->scope_name."" != ""){
                    $scopes[] = $scope;
                    }
                }
                return jsonEncode($scopes);
            }

            if($r->event == 'get_icd10'){
                $data = ExportController::geticd10($r);
                return jsonEncode($data);
            }

            if($r->event == 'get_icd9'){
                $data = ExportController::geticd9($r);
                return jsonEncode($data);
            }

            if($r->event == 'save_video_data'){
                $cid = isset($r->cid) ? $r->cid : '';
                $vdoname = $r->vdoname;
                if((isset($cid) && @$cid."" != "") && (isset($vdoname) && @$vdoname."" != "")){
                    $case = (object) Mongo::table('tb_case')->where('_id', $cid)->first();
                    if(isset($case)){
                        $only_date = isset($case->appointment) ? explode(" ", $case->appointment)[0] : '';
                        $path = htdocs("store/$case->case_hn/$only_date/vdo");
                        $url  = domainname("store/$case->case_hn/$only_date/vdo/$vdoname");

                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }

                        // check if this file really exist
                        if(!file_exists($path."/$vdoname")){
                            return 'vdo file does not exist';
                        }

                        $case_vdo = isset($case->video) ? $case->video : [];
                        if(is_array($case_vdo)){
                            $case_vdo[] = $vdoname;
                        }
                        $u['video'] = $case_vdo;
                        Mongo::table('tb_case')->where('_id', $cid)->update($u);
                        return 'success';
                    }
                } else {
                    return 'error at cid or vdoname';
                }
            }

            if($r->event=="save_vital_sign"){
                $vital = $r->vital;
                $cid   = $r->cid;
                $process = $r->process;
                if(isset($vital) && isset($cid)){
                    foreach ($vital as $key => $val) {
                        $vital[$key] = isset($vital[$key]) ? $vital[$key] : '-';
                    }

                    $case = (object) Mongo::table('tb_case')->where('_id', $cid)->first();
                    $noteid = isset($case->noteid) ? $case->noteid : '';
                    if($noteid != ''){
                        $tb_casenote = Mongo::table('tb_casenote')->where('_id', $noteid)->first();
                        $temp        = isset($tb_casenote[$process]['vital_sign']) ? $tb_casenote[$process]['vital_sign'] : [];
                        $temp[]      = $vital;
                        $tb_casenote[$process]['status']     = "true";
                        $tb_casenote[$process]['vital_sign'] = $temp;
                        Mongo::table('tb_casenote')->where('_id', $noteid)->update($tb_casenote);
                        return 'success';
                    }

                }
            }

            if($r->event=="save_followup_note"){
                $condition  = $r->condition;
                $cid        = $r->cid;
                $other      = $r->condition_other;
                if(isset($condition) && isset($cid)){
                    $case   = (object) Mongo::table('tb_case')->where('_id', $cid)->first();
                    $noteid = isset($case->noteid) ? $case->noteid : '';
                    $sub    = [];
                    $followup_day   = isset($case->followup_date) ? intval($case->followup_date) : 0;

                    $sub['date']    = Carbon::now()->toDateString();
                    if(is_int($followup_day)){
                        $sub['date'] = str_replace('-', '/', $sub['date']);
                        $sub['date'] = date('Y-m-d',strtotime($sub['date'] . "+$followup_day days"));
                    }
                    $sub['condition'] = $condition;
                    $sub['doctor']    = isset($case->doctorname) ? $case->doctorname : '';
                    $sub['other']     = isset($other) ? $other : '';

                    if($noteid != ''){
                        $tb_casenote = Mongo::table('tb_casenote')->where('_id', $noteid)->first();
                        $temp        = isset($tb_casenote['followup']['followup']) ? $tb_casenote['followup']['followup'] : [];
                        $temp[]      = $sub;
                        $tb_casenote['followup']['status']     = "true";
                        $tb_casenote['followup']['followup']   = $temp;
                        Mongo::table('tb_casenote')->where('_id', $noteid)->update($tb_casenote);
                        $tb_casenote = Mongo::table('tb_casenote')->where('_id', $noteid)->first();
                        return jsonEncode($sub);
                    }
                }
            }


            if($r->event=='update_time'){
                $tb_case = (object) Mongo::table('tb_case')->where('_id', $r->cid)->first();
                $case_time = isset($tb_case->case_time) ? $tb_case->case_time : [];
                $case_time[intval($r->index)] = $r->time;
                $arr['case_time'] = $case_time;
                Mongo::table('tb_case')->where('_id', $r->cid)->update($arr);
            }

            if($r->event=='save_properties'){
                $camera_temp = htdocs('config/project/cameratemp.txt');
                $property = $r->property;
                $value    = $r->value;
                $source   = $r->source;
                $read = file_get_contents($camera_temp);
                $read = (array) jsonDecode($read);
                $read["$property$source"] = $value;
                $encode = jsonEncode($read);
                file_put_contents($camera_temp, $encode);
            }

            if($r->event=='check_vdofile_size'){
                $case = (object) Mongo::table('tb_case')->where('_id',$r->id)->first();
                $operation_date = isset($case->appointment) ? explode(' ', $case->appointment)[0] : '';
                $video_path     = htdocs("store")."/$case->hn/$operation_date/vdo";
                $fullpath       = "$video_path/$r->name";
                try{
                    $filesize       = filesize($fullpath);
                } catch(\Exception $e) {
                    $filesize       = 0;
                }
                return $filesize;
            }

            if($r->event == 'patient_check'){
                $tb_patient = Mongo::table("tb_patient")->where("hn",$r->hn)->first();
                if(isset($tb_patient['_id'])){
                    $arr['prefix']      = $tb_patient['prefix'];
                    $arr['firstname']   = $tb_patient['firstname'];
                    $arr['lastname']    = $tb_patient['lastname'];
                    $arr['hn']          = $tb_patient['hn'];
                    $arr['gender']      = $tb_patient['gender'];
                    $arr['mongoid']     = (string) $tb_patient['_id'];
                    $arr['age']         = age(@$tb_patient['birthdate']);
                    $arr['status']      = true;
                }else{
                    $arr['status']      = false;
                }
                return jsonEncode($arr);
            }



            if($r->event=="create_sign")    {$this->create_sign($r);}
            if($r->event=="skip_all")       {$this->skip_all();}
            if($r->event=="re_print")       {$this->printer_queue($r->q_id);}
            if($r->event=="check_hn")       {$this->check_hn_queue($r->hn);}
            if($r->event=="add_new_pt")     {
                $data['hn']                 = @$r->hn.'';
                $data['an']                 = @$r->an.'';
                $data['citizen']            = @$r->citizen.'';
                $data['prefix']             = @$r->prefix.'';
                $data['firstname']          = @$r->firstname.'';
                $data['lastname']           = @$r->lastname.'';
                $data['gender']             = @$r->gender.'';
                $data['birthdate']          = @$r->birthdate.'';
                $data['email']              = @$r->email.'';
                $data['allergic']           = @$r->allergic.'';
                $data['congenital_disease'] = @$r->congenital_disease.'';
                $data['emer_name']          = @$r->emer_name.'';
                $data['phone']              = @$r->phone.'';
                DB::table('patient')->insert($data);
            }
            if($r->event=="check_patient_id")       {$this->check_patient_id($r);}
            if($r->event=="set_mysqlmigrate")       {$this->set_mysqlmigrate($r);}
            if($r->event=="remove_key_mysqlmigrate") {$this->remove_key_mysqlmigrate($r);}




        }
    }



    public function update_tb_case($id,$idhtml, $value){

        $w[] = array('id',$id);
        $data[$idhtml] = jsonDecode($value);
        Mongo::table('tb_case')->where($w)->update($data);
    }

    public function update_user_in_case($id,$idhtml, $value){


        $decode = isset($value) ? jsonDecode($value, true) : [];

        $w[] = array('id',$id);
        $tb_case = Mongo::table('tb_case')->where($w)->first();
        // dd($w);
        $tb_case = (object) $tb_case;
        $user_in_case = isset($tb_case->user_in_case) ? $tb_case->user_in_case : [];
        foreach($decode as $d){
            if(in_array($d, $user_in_case) == false && $d != " " && $d != ""){
                $user_in_case[] = $d;
            }
        }


        $data['user_in_case'] = $user_in_case;
        Mongo::table('tb_case')->where($w)->update($data);
    }
    public function autoesign($r){

    }






    public function create_sign($r){

        $uid        = intval($r->doctor_id);
        $cid        = $r->cid;

        $code       = $r->doctor_code;
        $folderdate = $r->folderdate;
        $caseuniq   = $r->caseuniq;
        $comcreate  = $r->comcreate;
        $hn         = $r->hn;
        $user       = Mongo::table('users')->where('user_code',$code)->first();
        if(!empty($user)){
            if($code==$user->user_code){
                if(!empty($user->signature)){
                    $sign_url       = storePATH("$hn/$folderdate/$caseuniq.txt");
                    $myfile = fopen($sign_url, "w") or die("Unable to open file!");
                    fwrite($myfile, $user->signature);
                    fclose($myfile);

                    createTEMP('tb_case',$caseuniq,$comcreate,date("ymdHis"));
                    $u['pdfcreate']        = false;
                    Mongo::table('tb_case')->where('id',$cid)->update($u);
                    echo "success";
                    return true;
                } else {
                    echo "ไม่มีข้อมูลลายเซ็นในฐานข้อมูล";
                }
            }
        } else {
            echo "ไม่มีรหัสในฐานข้อมูล";
        }


    }





    public function delete_user_in_case($id,$idhtml, $value){

        $w[] = array('id',$id);
        $tb_case = Mongo::table('tb_case')->where($w)->first();
        $tb_case = (object) $tb_case;
        $user_in_case = isset($tb_case->user_in_case) ? $tb_case->user_in_case : [];
        if(in_array(intval($value), $user_in_case)){
            $index = array_search(intval($value), $user_in_case);
            unset($user_in_case[$index]);
        }
        $data['user_in_case'] = $user_in_case;
        Mongo::table('tb_case')->where($w)->update($data);
    }

    public function update_many_checked($r){
        $count = count($r->js_id);
        $step = $r->step;
        for($i=0;$i<$count;$i++){
            $this->notecase_jsonpatient($r->id,$r->js_id[$i],'',$r->step);
        }
        echo 'success';
    }
    function notecase_jsonpatient($id,$idhtml, $value, $step)
    {
        $value = jsonDecode($value);
        $w[] = array('_id',$id);
        $data = Mongo::table('tb_casenote')->where($w)->first();
        $data[$step][$idhtml] = $value;
        Mongo::table('tb_casenote')->where($w)->update($data);
        echo jsonEncode($data);
    }
    public function get_book_data($r){
        // dd($r->all());

        $book = Mongo::table('tb_booking')->where('noteid',$r->id)->first();
        $note = Mongo::table('tb_casenote')->where('_id',$r->id)->first();
        $data['template'] = "";
        if(isset($note['template'])){
            $data['template'] = $note['template'];
        }

        $data['noteid']         = $r->id;
        $data['date']           = Carbon::create($book['date'])->format('D, d F Y');
        $data['physician']      = @$book['physician_name'];
        $data['patient_type']   = case_book_text(@$book['patient_type']);
        $data['period']         = case_book_text(@$book['period']);
        $data['urgent']         = case_book_text(@$book['urgent']);
        $data['hn']             = @$book['hn'];
        $data['name']           = @$book['prefixname']." ".@$book['firstname']." ".@$book['middlename']." ".@$book['lastname'];

        $procedure = "";
        foreach($book['procedure'] as $val){
            $tb_procedure = (object) Mongo::table('tb_procedure')->where('code',$val)->first();
            $procedure = $procedure." ".$tb_procedure->name;
        }

        $data['procedure']              = $procedure;

        $data['age']                    = @$book['age'];
        $data['user_id']                = @$book['user_id'];
        $data['abstain_from_food']      = '';
        $data['switt']                  = '';
        $data['pressure_medication']    = '';
        $data['clear_water']            = '';
        if(@$book['abstain_from_food']=='งดน้ำ/งดอาหาร 8 ชั่วโมง'){
            $data['abstain_from_food'] = 'checked';
        }
        if(@$book['switt']=='ทานยา Swift ครบ'){
            $data['switt'] = 'checked';
        }
        if(@$book['pressure_medication']=='ทานยาลดความดัน'){
            $data['pressure_medication'] = 'checked';
        }
        if(@$book['clear_water']=='ถ่ายเป็นลักษณะน้ำใส'){
            $data['clear_water'] = 'checked';
        }
        printJSON($data);
    }

    public function book_cancel($r){
        // dd($r->all());
        $data['user_id']                = @$r->user_id;
        $data['book_cancel']            = @$r->book_cancel;
        $data['book_reason']            = @$r->book_reason;
        $data['description']             = $r->desciption;
        $data['confirm']                = 'cancel';

        $w[] = array('_id',$r->book_id);
        $w[] = array('date',$r->date);
        $w[] = array('hn' , $r->hn);
        // dd($w);
        $w[] = array('department' , $r->department);
        Mongo::table('tb_booking')->where($w)->update($data);
        echo 'success';

    }







    public function book_confirm($r){
        // dd($r->all());
        // $data['abstain_from_food']      = @$r->abstain_from_food;
        // $data['switt']                  = @$r->switt;
        // $data['pressure_medication']    = @$r->pressure_medication;
        // $data['clear_water']            = @$r->clear_water;
        $data['user_id']                = @$r->user_id;
        $data['description']             = $r->desciption;
        $data['confirm']                = 'confirm';
        $data['book_cancel']            = @$r->book_cancel;
        $data['book_reason']            = @$r->book_reason;
        $w[] = array('_id',$r->book_id);
        $w[] = array('date',$r->date);
        $w[] = array('hn' , $r->hn);
        $w[] = array('department' , $r->department);
        Mongo::table('tb_booking')->where($w)->update($data);
        echo 'success';

    }
    public function check_hn_queue($pt_hn){
        $check = DB::table('patient')->where('hn',$pt_hn)->first();
        $data['count'] = 2;
        if(isset($check)){
            $data['count'] = 1;
            $data['prefix'] = $check->prefix;
            $data['firstname'] = $check->firstname;
            $data['lastname'] = $check->lastname;
            $data['hn'] = $check->hn;
            $data['gender'] = $check->gender;
            $data['birthdate'] = $check->birthdate;
        }
        $json = jsonEncode($data);
        // echo $data;
        echo $json;
    }

    public function display($q_status,$q_type)
    {
        if($q_type==3){
            $q_type = [1,2];
        }
        $w[0] = array('q_status',$q_status);
        $w[1] = array('q_status_sub',0);
        $data = DB::table('tb_queue')
        ->whereDate('q_datetime',date('Y-m-d'))
        ->where($w)
        ->whereIn('q_type',$q_type)
        ->get();
        $i = 0;
        $t = '';
        foreach($data as $d){
            if($i==0){
                $t .= "<tr>";
                $t .= "<td class='border-0 display-4 p-0' colspan='2'>$d->q_number</td>";
                $t .= "</tr>";
                }else{

                if(($i % 2 != 0)&&($i!=0)){
                        $t .= "<tr>";
                    }
                    $t .= "<td class='border-0 h3 p-0'>$d->q_number</td>";
                if(($i % 2 == 0)&&($i!=0)){
                    $t .= "</tr>";
                }
            }
            $i++;
        }
        echo $t;
    }



    public function printer_queue($id)
    {
        $tb_queue = (object) Mongo::table('tb_queue')->where('q_id',$id)->first();
        echo $tb_queue->q_number;
    }

    public function check_patient_id($r){
        $patient = Patient::get_patient_by_id($r->id);
        $is_match = (isset($patient) && $patient != '') ? $patient : 0;
        return json_encode($is_match);
    }

    public function check_room($room_data, $only_check=false){
        $arr = [];
        if(isset($room_data)){
            $data_type = gettype($room_data);
            if($data_type == 'string'){
                $room_data =  jsonDecode($room_data);
            }

            if($only_check==true){
                return $room_data;
            } else {
                foreach($room_data as $id){
                    $user = Mongo::table('users')->where('uid', intval($id))->first();
                    if(isset($user) && count($user) > 0){
                        $arr[] = $user;
                    }
                }
            }

        }

        return $arr;
    }

    public function set_mysqlmigrate($r){
        try{
            $tb_mysqlmigrate = Mongo::table('tb_mysqlmigrate')->where('table_name', $r->tablename)->first() ?? [];
            if(count($tb_mysqlmigrate) == 0){
                $i['table_id'] = get_last_id('table_id','tb_mysqlmigrate');
                $i['table_name'] = $r->tablename ?? '';
                $i['table_data'] = [];
                Mongo::table('tb_mysqlmigrate')->insert($i);
            }
        } catch(\Exception $e){}
        $tb_mysqlmigrate = (object) Mongo::table('tb_mysqlmigrate')->where('table_name', $r->tablename)->first();
        $table_data = $tb_mysqlmigrate->table_data ?? [];
        if($r->type == 'key'){
            $table_data[$r->original_key]['key'] = $r->value;
        } elseif($r->type == 'type'){
            $table_data[$r->original_key]['type'] = $r->value;
        }
        $u['table_data'] = $table_data;
        Mongo::table('tb_mysqlmigrate')->where('table_name', $r->tablename)->update($u);
    }

    public function remove_key_mysqlmigrate($r){
        $tb_mysqlmigrate = Mongo::table('tb_mysqlmigrate')->where('table_name', $r->tablename)->first() ?? [];
        try{
            $table_data = $tb_mysqlmigrate['table_data'] ?? [];
            if(isset($table_data[$r->original_key])){
                // unset($table_data[$r->original_key]);
                $table_data[$r->original_key]['key'] = '';
                $u['table_data'] = $table_data;
                Mongo::table('tb_mysqlmigrate')->where('table_name', $r->tablename)->update($u);
            }
        } catch (\Exception $e) {}
    }
}
