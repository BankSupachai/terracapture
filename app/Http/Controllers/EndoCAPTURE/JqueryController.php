<?php
namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use App\Models\Datacase;
use App\Models\Mongo;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JqueryController extends Controller
{



    public function index(Request $r)
    {
        if($r->event=="checkconnect"){
            echo "true";
        }
    }


    public function store(Request $r)
    {

        if($r->event=="update_rfid"){
            $data['scope_rfid'] = $r->value;
            $scope = Mongo::table('tb_scope')->where('scope_id',intval($r->this_id))->update($data);
            echo 'success';
        }

        if($r->event=='birth_change'){
            $day    = $r->day;
            $month  = $r->month;
            $year   = $r->year-543;
            $birth  = "$year-$month-$day";
            $age    = jsonEncode(array(Carbon::parse($birth)->age));
            echo $age;
        }

        if($r->event=='age_change'){
            $date   = date('Y')+543;
            $year   = $date-$r->age;
            $val    = jsonEncode(array($year));
            echo $val;
        }


        if($r->event=='edit_q_pt'){
            $tb_patient = (object) Mongo::table("tb_patient")->where("hn",$r->q_hn)->first();
            if($tb_patient){
                $patientname    = $tb_patient->firstname." ";
                $patientname    .= $tb_patient->lastname;
            }else{
                $patientname    = "None";
            }
            $data['q_hn']           = @$r->q_hn.'';
            $data['q_tel']          = @$r->q_tel.'';
            $data['q_patientname']  = $patientname;

            $qid = (int) $r->q_id;
            Mongo::table('tb_queue')->where('q_id',$qid)->update($data);

            $tb_queue   = Mongo::table('tb_queue')->where('q_id',$r->q_id)->first();
            insertqueue2cloud($tb_queue,false);
            echo 1;
        }

        if($r->event=="detectbody"){
            $cid         = $r->cid;
            $val_time    = jsonDecode($r->val_time);
            $val_bp      = jsonDecode($r->val_bp);
            $val_p       = jsonDecode($r->val_p);
            $val_rr      = jsonDecode($r->val_rr);
            $val_spo     = jsonDecode($r->val_spo);
            $val_loc     = jsonDecode($r->val_loc);
            $val_o       = jsonDecode($r->val_o);
            $val_symptom = jsonDecode($r->val_symptom);
            $val_remark  = jsonDecode($r->val_remark);
            $arr = array();
            $i = 0;
            foreach($val_time as $t){
                $arr[$i]['time']    = $val_time[$i];
                $arr[$i]['bp']      = $val_bp[$i];
                $arr[$i]['p']       = $val_p[$i];
                $arr[$i]['rr']      = $val_rr[$i];
                $arr[$i]['spo']     = $val_spo[$i];
                $arr[$i]['loc']     = $val_loc[$i];
                $arr[$i]['o']       = $val_o[$i];
                $arr[$i]['symptom'] = $val_symptom[$i];
                $arr[$i]['remark']  = $val_remark[$i];
                $i++;
            }
            if($r->actwhen=="after"){
                case_jsonNOTE($cid,'detectbodyafter',$arr);
            }
            if($r->actwhen=="active"){
                case_jsonNOTE($cid,'detectbodyactive',$arr);
            }
        }

        if($r->event=='patientsavejson'){
            case_jsonpatient($r->id,$r->idhtml,$r->value);
        }


        if($r->event=='notesavejson_checkbox'){
            case_jsonNOTE($r->id,$r->idhtml,$r->value);
        }


        if($r->event=='medijson'){
            $medi_id    = $r->medi_id;
            $jsonval    = $r->jsonval;
            $jsonid     = $r->jsonid;
            $arr        = array();
            $i          = 0;
            foreach($jsonid as $id){
                if($jsonval[$i]!="" && $jsonval[$i]!=null){
                    $w[0] = array('auto_text'       ,$jsonval[$i]);
                    $w[1] = array('auto_textid'     ,$r->idhtml);
                    $w[2] = array('auto_procedure'  ,$r->procedure);
                    $count = Mongo::table('autotext')->where($w)->count();
                    if($count==0){
                        $val['auto_procedure']  = $r->procedure;
                        $val['auto_text']       = $jsonval[$i];
                        $val['auto_textid']     = $r->idhtml;
                        Mongo::table('autotext')->insert($val);
                    }
                    $arr[$id] = $jsonval[$i];
                }
                $i++;
            }
            $json = jsonEncode($arr);
            Mongo::table('tb_casemedication')->where('_id',$medi_id)->update(['medi_casejson'=>$json]);
        }



        if($r->event=='save_attendant'){
            $w['_id']          = $r->cid;
            $i['user_in_case'] = $r->val;
            Mongo::table('tb_case')->where($w)->update($i);
        }

        if($r->event=='save_followup'){
            $w['_id']          = $r->_id;
            $tb_case = Mongo::table('tb_case')->where($w)->first();
            if(isset($tb_case)){
                $tb_case =  (object) $tb_case;
                $case_json = isset($tb_case->case_json) ? $tb_case->case_json : [];
                $case_json['followup'] = $r->days;
                $val['case_json'] = $case_json;
                Mongo::table('tb_case')->where($w)->update($val);
            }
        }

        if($r->event=="checkconnect"){
            echo "true";
        }

        if($r->event=="configtext"){
            $config = (array) Mongo::table('tb_config')->where('config_type','admin')->first();
            $config[$r->id]           = $r->value;
            unset($config['id']);
            Mongo::table('tb_config')->where('config_type','admin')->update($config);
        }
        if($r->event=="configpacs"){
            $config =(array) Mongo::table('tb_config')->where('config_type','pacs')->first();
            $config[$r->id]           = $r->value;
            unset($config['id']);
            Mongo::table('tb_config')->where('config_type','pacs')->update($config);
        }


        if($r->event=="configcamera"){
            $config = (array)Mongo::table('tb_config')->where('config_type','camera')->first();
            $config[$r->id]           = $r->value;
            unset($config['id']);
            Mongo::table('tb_config')->where('config_type','camera')->update($config);


        }

        if($r->event=="config_export"){
            $config = (array)Mongo::table('tb_config')->where('config_type','captureexcel')->first();
            $config[$r->id]           = $r->value;
            unset($config['id']);
            Mongo::table('tb_config')->where('config_type','captureexcel')->update($config);
        }


        if($r->event=="configcheck"){
            $config = (array)Mongo::table('tb_config')->where('config_type',$r->config_type)->first();
            if($r->value=="true"){
                $config[$r->id]           = true;
            }else{
                $config[$r->id]           = false;
            }
            unset($config['id']);
            Mongo::table('tb_config')->where('config_type',$r->config_type)->update($config);
        }







        // if($r->event=="configtext"){
        //     $str    = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        //     $json                   = (array) jsonDecode($str);
        //     $json[$r->id]           = $r->value;
        //     file_put_contents("D:/laragon/htdocs/config/project/admin.txt", jsonEncode($json));
        // }
        // if($r->event=="configpacs"){
        //     $str    = file_get_contents("D:/laragon/htdocs/config/project/pacs.txt");
        //     $json                   = (array) jsonDecode($str);
        //     $json[$r->id]           = $r->value;
        //     file_put_contents("D:/laragon/htdocs/config/project/pacs.txt", jsonEncode($json));
        // }

        // if($r->event=="configcamera"){
        //     $str    = file_get_contents("D:/laragon/htdocs/config/project/camera.txt");
        //     $json                   = (array) jsonDecode($str);
        //     $json[$r->id]           = $r->value;
        //     file_put_contents("D:/laragon/htdocs/config/project/camera.txt", jsonEncode($json));
        // }

        // if($r->event=="config_export"){
        //     $str    = file_get_contents("D:/laragon/htdocs/config/project/captureexcel.txt");
        //     $json                   = (array) jsonDecode($str);
        //     $json[$r->id]           = $r->value;
        //     file_put_contents("D:/laragon/htdocs/config/project/captureexcel.txt", jsonEncode($json));
        // }

        // if($r->event=="configcheck"){
        //     $str    = file_get_contents("D:/laragon/htdocs/config/project/$r->config_type.txt");
        //     $json   = (array) jsonDecode($str);
        //     if($r->value=="true"){
        //         $json[$r->id]           = true;
        //     }else{
        //         $json[$r->id]           = false;
        //     }
        //     file_put_contents("D:/laragon/htdocs/config/project/$r->config_type.txt", jsonEncode($json));
        // }

        if($r->event=="picselect"){
            $photoall   = Datacase::photoALL($r->case_id);
            $photo      = array();
            $x          = 0;
            $print      = 0;
            $num_condition = (int) $r->selectnum;

            if($num_condition==0){
                $print = (int) $r->innum;
            }

            foreach($photoall as $j){
                $j = (object) $j;
                if(isset($j->nu)){
                    if($j->nu==$r->photo_id){
                        $photo[$x]['nu']  = $j->nu;
                        $photo[$x]['ns']  = $print;
                        $photo[$x]['na']  = $j->na;
                        $photo[$x]['sc']  = $j->sc;
                        $photo[$x]['st']  = $j->st;
                        $photo[$x]['tx']  = $j->tx;
                    }else{
                        $mm = (int) $j->ns;
                        if($mm > $num_condition && $mm!=0 && $num_condition!=0){
                            $number = $mm-1;
                        }else{
                            $number = $mm;
                        }
                        $photo[$x]['nu']  = $j->nu;
                        $photo[$x]['ns']  = $number;
                        $photo[$x]['na']  = $j->na;
                        $photo[$x]['sc']  = $j->sc;
                        $photo[$x]['st']  = $j->st;
                        $photo[$x]['tx']  = $j->tx;
                    }
                    $x++;
                }
            }
            Datacase::dataUPDATE($r->case_id,['photo'=>$photo]);
            echo $print;
        }



        if ($r->event=="photorollback") {
            copy(htdocs(("store/$r->hn/$r->folderdate/backup/$r->photoname")),htdocs("store/$r->hn/$r->folderdate/$r->photoname"));
        }



    }

}
