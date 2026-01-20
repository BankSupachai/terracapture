<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Datacase;
use App\Http\Controllers\Api\RamaConnectController;
use App\Models\Mongo;


class OrdataController extends Controller
{

    //Server จริง
    public $server = "http://prod-frontserv1.rama.mahidol.ac.th";


    public function store(Request $r)
    {
        switch($r->event){

            case "ordata_icd9"              : $this->ordata_icd9($r);               break;
            case "ordata_icd9select"        : $this->ordata_icd9select($r);         break;
            case "load_icd9select"          : $this->load_icd9select($r);           break;
            case "ordata_icd9remove"        : $this->ordata_icd9remove($r);         break;

            //------------------- ICD10 -----------------//
            case "ordata_icd10"             : $this->ordata_icd10($r);              break;
            case "ordata_icd10select"       : $this->ordata_icd10select($r);        break;
            case "load_icd10select"         : $this->load_icd10select($r);          break;
            case "ordata_icd10remove"       : $this->ordata_icd10remove($r);        break;
            //------------------- ICD10 -----------------//

            case "user_in_case"             : $this->user_in_case($r);              break;
            case "ordatatechanes"           : $this->ordatatechanes($r);            break;
            case "ordatadepartment"         : $this->ordatadepartment($r);          break;
            case "ordataclinic"             : $this->ordataclinic($r);              break;
            case "getdata_ordata"           : $this->getdata_ordata($r);            break;
            case "senddata_ordata"          : $this->senddata_ordata($r);           break;
        }
    }

    public function user_in_case($r){
        $user_in_case = jsonDecode($r->val);
        // $user_in_case = array();
        // foreach($temp as $data){
        //     $user_in_case[] = $data;
        // }
        Mongo::table("tb_case")->where("_id",$r->cid)->update(["user_in_case"=>$user_in_case]);
    }


    public function login(){
        $ramafolder = htdocs("config/rama");
        makedir($ramafolder);
        $header[0] = 'Content-Type:application/json';
        $arr['data']['username']    = "MedicaHealthcare";
        $arr['data']['password']    = "G1Sc0pe";
        $arr['data']['appCode']     = "GI Scope";
        $post['json']               = jsonEncode($arr);
        $str        = connectwebJSON("$this->server/api/client/login",$post['json'],$header);
        $json       = jsonDecode($str);
        $tokenlogin = htdocs("config/rama/tokenlogin.txt");
        if(isset($json->data->accessToken)){
            if(file_exists($tokenlogin)){
                file_put_contents($tokenlogin, $json->data->accessToken);
            }else{
                $myfile = fopen($tokenlogin, "w");
                fwrite($myfile, $json->data->accessToken);
            }
        }
    }

    public function header(){
        $tokenlogin     = htdocs("config/rama/tokenlogin.txt");
        if(is_file($tokenlogin)){}else{$this->login();}
        $token          = file_get_contents($tokenlogin);
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = 'Authorization: Bearer '.$token;
        return $header;
    }

    public function getpatientprofile($hn){
        $header     = $this->header();
        $arr['mrn'] = $hn;
        $json       = jsonEncode($arr);
        $str        = connectwebJSON("$this->server/api/MR/Patients/GetPatientProfileByMrn",$json,$header);
        $json       = jsonDecode($str);
        return $json;
    }

    public function getencounter($hn){
        $header     = $this->header();
        $arr['mrn'] = $hn;
        $json       = jsonEncode($arr);
        $str        = connectwebJSON("$this->server/api/Encounter/search/$hn",$json,$header);
        $json       = jsonDecode($str);
        $data = $this->aasort($json->data, "objectId");
        $count_data = count($json->data);

        $i      = 0;
        $found  = false;
        while($i < $count_data){
            if($data[$i]->encounterType=="IMP"){
                $encounterId    = $data[$i]->encounterId;
                $encounterType  = $data[$i]->encounterType;
                $found          = true;
                break;
            }


            if($data[$i]->encounterType=="AMB"){
                if(strpos($data[$i]->sdlocId,"GI")){
                    $encounterId    = $data[$i]->encounterId;
                    $encounterType  = $data[$i]->encounterType;
                    $found          = true;
                    break;
                }
            }

            if($i>20){break;}
            $i++;
        }

        if($found==false){
            $encounterId    = $data[0]->encounterId;
            $encounterType  = $data[0]->encounterType;
        }
        $arr['encounterId']     = $encounterId;
        $arr['encounterType']   = $encounterType;
        return $arr;
    }


    public function aasort (&$array, $key) {
        $sorter = array();
        $ret = array();
        $numarr = array();
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii] = $va->$key;
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $numarr[] = $ii;
        }
        $numarr2 = array_reverse($numarr);
        foreach ($numarr2 as $ii) {
            $ret[$ii] = $array[$ii];
        }
        $array = $ret;
        return $array;
    }



    public function getdata_ordata($r){
        // $ordatatechanes      = Datacase::jsonDATA($r->cid,"ordatatechanes");
        // $ordatadepartment    = Datacase::jsonDATA($r->cid,"ordatadepartment");
        // $ordataclinic        = Datacase::jsonDATA($r->cid,"ordataclinic");

        $tb_case            = Datacase::first($r->cid);
        $ordatatechanes     = @$tb_case->ordatatechanes;
        $ordatadepartment   = @$tb_case->ordatadepartment;
        $ordataclinic       = @$tb_case->ordataclinic;

        if(isset($ordatatechanes))  {$arr["ordatatechanes"]=$ordatatechanes;}       else{$arr["ordatatechanes"]=array();}
        if(isset($ordatadepartment)){$arr["ordatadepartment"]=$ordatadepartment;}   else{$arr["ordatadepartment"]="";}
        if(isset($ordataclinic))    {$arr["ordataclinic"]=$ordataclinic;}           else{$arr["ordataclinic"]="";}
        printJSON($arr);
    }

    public function checkVALUE($arr,$txt){
        if($arr==null){
            $val['status']  = "unsuccess";
            $val['msg']     = $txt;
            printJSON($val);
            exit;
        }
    }

    public function checkUSER($json,$type,$txt){
        $haveuser = false;
        // $arr = jsonDecode($json);
        $arr = $json;
        foreach($arr as $data){
            $data = (int)$data;
            $user = (object) Mongo::table("users")->where("uid",$data)->first();
            if($user->user_type==$type){
                $array[]    = @$user->user_code;
                $haveuser = true;
            }
        }

        if($haveuser==false){
            $val['status']  = "unsuccess";
            $val['msg']     = $txt;
            printJSON($val);
            exit;
        }else{
            return $array;
        }

    }


    public function getdoctorCODE($id){
        $tb_case = Datacase::first($id);
        $uid    = (int) $tb_case->case_physicians01;
        $user = (object) Mongo::table("users")->where("uid",$uid)->first();
        return $user->user_code;
    }

    public function senddata_ordata($r){
        $searchAnesTechnique    = file_get_contents(htdocs("config/or/searchAnesTechnique.json"));
        $anes                   = jsonDecode($searchAnesTechnique);
        $tb_case                = Datacase::first($r->cid);
        $ordatatechanes         = @$tb_case->ordatatechanes;
        $ordatadepartment       = @$tb_case->ordatadepartment;
        $ordataclinic           = @$tb_case->ordataclinic;
        $icd9select             = @$tb_case->icd9operator;
        $icd10select_pre        = @$tb_case->icd10pre;
        $icd10select_post       = @$tb_case->icd10post;
        $user_in_case           = @$tb_case->user_in_case;
        $this->checkVALUE($user_in_case     ,"กรุณาเลือกผู้ร่วมทำหัตถการ");
        $this->checkVALUE($ordatadepartment ,"กรุณาเลือกแผนก");
        $this->checkVALUE($ordataclinic     ,"กรุณาคลีนิค");
        $this->checkVALUE($ordatatechanes   ,"กรุณาเลือกเทคนิคการวางยา");
        $this->checkVALUE($icd9select       ,"กรุณาเลือก ICD9 PROCEDURE");
        $this->checkVALUE($icd10select_pre  ,"กรุณาเลือก ICD10 PRE-diagnostic");
        $this->checkVALUE($icd10select_post ,"กรุณาเลือก ICD10 POST-diagnostic");
        $datetime = date("d/m/Y H:i:s");
        $date     = date("d/m/Y");
        // $tech="";
        // foreach($ordatatechanes as $data){
        //     foreach ($anes->data->anestech as $anestech) {
        //         if($anestech->no == $data){
        //             $tech.= $anestech->desc." | ";
        //         }
        //     }
        // }

        $enc = $this->getencounter($r->hn);
        $keyin = $this->keyincheck($r);


        //************************************ */
        $patient['mrn']             = $r->hn;
        $patient['sdloc']           = $ordatadepartment;
        $patient['sdlocfrom']       = $ordatadepartment;
        $patient['clinicname']      = $ordataclinic;
        $patient['enc_type']        = $enc['encounterType'];
        $patient['enc_id']          = $enc['encounterId'];
        $patient['op_dt']           = $date;
        //************************************* */

        $a['patientdetail']         = $patient;
        $a['checkin']               = $datetime;
        $a['checkout']              = $datetime;
        $a['keyid']                 = $keyin;
        $a['keydt']                 = $datetime;

        $team['teamid']             = "027";
        $team['type']               = "major";
        $team['room']               = "xxx";
        $team['timeinroom']         = $datetime;
        $team['timeoutroom']        = $datetime;
        $team['starop']             = $datetime;
        $team['endop']              = $datetime;
        $team['staff']              = $keyin;
        $team['surgeon']            = array($this->getdoctorCODE($r->cid));
        $team['assistants']         = $this->checkUSER($user_in_case,"doctor"       ,"กรุณาเลือกแพทย์ผู้ช่วย");
        $team['scrubnurse']         = $this->checkUSER($user_in_case,"nurse"        ,"กรุณาเลือกพยาบาล");
        $team['circnurse']          = $this->checkUSER($user_in_case,"nurse"        ,"กรุณาเลือกพยาบาล");
        $team['anesthesilogist']    = $this->checkUSER($user_in_case,"anes"         ,"กรุณาเลือกวิสัญญี");
        $team['anestechnique']      = $ordatatechanes;
        $team['opnote']             = "GI";

        /* ************************************************** */

        $team['diagnosis']['prediag']   = $this->putdataicd10($icd10select_pre);
        $team['diagnosis']['postdiag']  = $this->putdataicd10($icd10select_post);
        $team['operation']              = $this->putdataicd9($icd9select);
        $a['team'][] = $team;


        $json = jsonEncode($a);

        $newjson = str_replace("\/","/",$json);

        // $url = "http://10.6.165.116:8080/gitorservice/services/orservice/sendOR";
        $url = "http://d-nodeserv1.rama.mahidol.ac.th:8080/gitorservice/services/orservice/sendOR";
        $header[0]      = 'Content-Type:application/json';
        // $header[1]      = 'Authorization: Basic Vk5BTWlyYWNsZTpSQU1BIzIwMjI='; //ค่านี้ได้มาจากโปรแกรม postman
        $str = connectwebJSON($url,$newjson,$header);

        echo $str;

    }


    public function keyincheck($r){
        $val = "005748";
        if(isset($r->keyin)){
            if($r->keyin!=""){
                $val = $r->keyin;
            }
        }
        return $val;
    }





    public function putdataicd9($source){
        $empty  = [];
        $i      = 0;
        foreach($source as $data){
            if($i==0){
                $main = 'principle';
            }else{
                $main ='secondary';
            }
            $w[0] = array("code",$data[0]);
            $w[1] = array("codeseq",$data[1]);
            $icd = (object) Mongo::table('tb_ordataicd9')->where($w)->first();
            $ope['code']    = $icd->code;
            $ope['codeseq'] = $icd->codeseq;
            $ope['desc']    = $icd->descript;
            $ope['gendesc'] = $icd->gen_desc;
            $operation['preop'][$main]  = $ope;
        }
        if(!isset($operation['preop']['secondary'])){
            $operation['preop']['secondary'] = $empty;
        }
        $operation['postop']    = $empty;
        return $operation;
    }

    public function putdataicd10($source){
        $arr    = array();
        $empty  = [];
        $i      = 0;
        foreach($source as $data){
            if($i==0){
                $main = 'principle';
            }else{
                $main ='secondary';
            }
            $w[0] = array("code",$data[0]);
            $w[1] = array("codeseq",$data[1]);
            $icd = DB::table('tb_ordataicd10')->where($w)->first();
            $ope['code']    = $icd->code;
            $ope['codeseq'] = $icd->codeseq;
            $ope['desc']    = $icd->descript;
            $ope['gendesc'] = $icd->gen_desc;
            $arr[$main]  = $ope;
        }
        if(!isset($arr['secondary'])){
            $arr['secondary'] = $empty;
        }
        return $arr;
    }



    public function ordatadepartment($r){
        Datacase::jsonUPDATE($r->cid,"ordatadepartment",$r->val);
    }

    public function ordataclinic($r){
        Mongo::table("tb_case")->where("_id",$r->cid)->update(["ordataclinic"=>$r->val]);
    }

    public function ordatatechanes($r){
        Mongo::table("tb_case")->where("_id",$r->cid)->update(["ordatatechanes"=>$r->val]);
    }



    public function ordata_icd10select($r){
        $arr            = array();
        $arr['cid']     = $r->cid;
        $arr['prepost'] = $r->prepost;
        $tb_case        = DataCase::first($r->cid);
        $icd10prepost   = "icd10$r->prepost";
        $icd10          = @$tb_case->$icd10prepost;
        $newarr         = array($r->code,$r->codeseq);
        $icd10[]        = $newarr;
        Mongo::table("tb_case")->where("_id",$r->cid)->update([$icd10prepost=>$icd10]);
        $i              = 0;
        foreach($icd10 as $data){
            $table = (object) Mongo::table('tb_ordataicd10')
            ->where("code",$data[0])
            ->where("codeseq",$data[1])
            ->first();
            if($table){
                $arr['icd10'][$i]['code']       = $table->code;
                $arr['icd10'][$i]['codeseq']    = $table->codeseq;
                $arr['icd10'][$i]['descript']   = $table->descript;
                $arr['icd10'][$i]['gen_desc']   = $table->gen_desc;
                $arr['icd10'][$i]['acc_code']   = $table->acc_code;
                $i++;
            }
        }
        if(isset($arr['icd10'])){
            $data = view("case/box/ordata/ordata_icd10select",$arr)->render();       // แปลง .Blade และค่า เป็น text
            echo $data;
        }

    }

    public function ordata_icd10remove($r){
        // $icd10              = Datacase::jsonDATA($r->cid,"ordataicd10_".$r->prepost);

        $tb_case        = DataCase::first($r->cid);
        $icd10prepost   = "icd10$r->prepost";
        $icd10          = @$tb_case->$icd10prepost;



        $i                  = 0;
        $arr                = array();
        $array['status']    = false;
        $arr['prepost']     = $r->prepost;
        $arr['cid']         = $r->cid;
        $icd10new           = array();

        if(isset($icd10)){
            foreach($icd10 as $data){
                if($r->code==$data[0] && $r->codeseq==$data[1]){

                }else{
                    $icd10new[$i]= array($data[0],$data[1]);
                    $i++;
                }
            }
        }

        // Datacase::jsonUPDATE($r->cid,"ordataicd10_".$r->prepost,$icd10new);

        // $icd10[]        = $newarr;
        Mongo::table("tb_case")->where("_id",$r->cid)->update([$icd10prepost=>$icd10new]);



        if(isset($icd10new)){
            foreach($icd10new as $new){
                $table = (object) Mongo::table('tb_ordataicd10')
                ->where("code",$new[0])
                ->where("codeseq",$new[1])
                ->first();

                if($table){
                    $arr['icd10'][$i]['code']       = $table->code;
                    $arr['icd10'][$i]['codeseq']    = $table->codeseq;
                    $arr['icd10'][$i]['descript']   = $table->descript;
                    $arr['icd10'][$i]['gen_desc']   = $table->gen_desc;
                    $arr['icd10'][$i]['acc_code']   = $table->acc_code;
                    $i++;
                    $array['status'] = true;
                }
            }
        }

        if(isset($arr['icd10'])){
            $data = view("case/box/ordata/ordata_icd10select",$arr)->render();       // แปลง .Blade และค่า เป็น text
            echo $data;
        }
    }



    public function load_icd10select($r){
        $tb_case            = Datacase::first($r->cid);
        // $icd10              = Datacase::jsonDATA($r->cid,"ordataicd10_".$r->prepost);
        $icd10prepost       = "icd10$r->prepost";
        $icd10              = @$tb_case->$icd10prepost;
        // $icd10              = @$tb_case->ordataicd10;
        $i                  = 0;
        $arr                = array();
        $array['status']    = false;
        $arr['prepost']     = $r->prepost;

        if(isset($icd10)){
            foreach($icd10 as $data){
                $table = (object) Mongo::table('tb_ordataicd10')
                ->where("code",$data[0])
                ->where("codeseq",$data[1])
                ->first();

                if($table){
                    $arr['icd10'][$i]['code']       = $table->code;
                    $arr['icd10'][$i]['codeseq']    = $table->codeseq;
                    $arr['icd10'][$i]['descript']   = $table->descript;
                    $arr['icd10'][$i]['gen_desc']   = $table->gen_desc;
                    $arr['icd10'][$i]['acc_code']   = $table->acc_code;
                    $i++;
                    $array['status'] = true;
                }
            }
        }
        $arr['cid'] = $r->cid;
        if(isset($arr['icd10'])){
            $data = view("case/box/ordata/ordata_icd10select",$arr)->render();       // แปลง .Blade และค่า เป็น text
            echo $data;
        }
    }
    public function ordata_icd10($r){
        $tb_ordataicd10 = (object) Mongo::table('tb_ordataicd10')
        ->where("code"          ,"like","%".$r->search."%")
        ->orwhere("descript"    ,"like","%".$r->search."%")
        ->orwhere("gen_desc"    ,"like","%".$r->search."%")
        ->paginate(10);
        $i                  = 0;
        $arr                = array();
        $array['status']    = false;
        foreach($tb_ordataicd10 as $data){
            $data = (object) $data;
            $arr['icd10'][$i]['code']       = $data->code;
            $arr['icd10'][$i]['codeseq']    = $data->codeseq;
            $arr['icd10'][$i]['descript']   = $data->descript;
            $arr['icd10'][$i]['gen_desc']   = $data->gen_desc;
            $arr['icd10'][$i]['acc_code']   = $data->acc_code;
            $i++;
            $array['status'] = true;
        }
        $array['data']          = $arr;
        $array['data']['cid']   = $r->cid;
        $arr["cid"]             = $r->cid;
        $arr['prepost']         = $r->prepost;
        $data = view("case/box/ordata/ordata_icd10",$arr)->render();
        echo $data;
    }


    public function ordata_icd9select($r){
        $arr        = array();
        $arr['cid'] = $r->cid;
        // $icd9       = Datacase::jsonDATA($arr['cid'],"ordataicd9");
        $tb_case    = Datacase::first($r->cid);
        $icd9       = @$tb_case->icd9operator;
        $newarr     = array($r->code,$r->codeseq);
        $icd9[]     = $newarr;
        // Datacase::jsonUPDATE($arr['cid'],"ordataicd9",$icd9);
        Mongo::table("tb_case")->where("_id",$r->cid)->update(["icd9operator"=>$icd9]);

        $i          = 0;
        foreach($icd9 as $data){
            $table = (object) Mongo::table('tb_ordataicd9')
            ->where("code",$data[0])
            ->where("codeseq",$data[1])
            ->first();
            if($table){
                $arr['icd9'][$i]['code']       = $table->code;
                $arr['icd9'][$i]['codeseq']    = $table->codeseq;
                $arr['icd9'][$i]['descript']   = $table->descript;
                $arr['icd9'][$i]['gen_desc']   = $table->gen_desc;
                $arr['icd9'][$i]['acc_code']   = $table->acc_code;
                $i++;
            }
        }
        if(isset($arr['icd9'])){
            $data = view("case/box/ordata/ordata_icd9select",$arr)->render();       // แปลง .Blade และค่า เป็น text
            echo $data;
        }
    }
    public function ordata_icd9remove($r){
        // $icd9               = Datacase::jsonDATA($r->cid,"ordataicd9");
        $tb_case            = Datacase::first($r->cid);
        $icd9               =@$tb_case->icd9operator;
        $i                  = 0;
        $arr                = array();
        $array['status']    = false;
        $arr['cid']         = $r->cid;
        $icd9new            = array();

        if(isset($icd9)){
            foreach($icd9 as $data){
                if($r->code==$data[0] && $r->codeseq==$data[1]){

                }else{
                    $icd9new[$i]= array($data[0],$data[1]);
                    $i++;
                }
            }
        }
        Mongo::table("tb_case")->where("_id",$r->cid)->update(["icd9operator"=>$icd9new]);

        // Datacase::jsonUPDATE($r->cid,"ordataicd9",$icd9new);
        if(isset($icd9new)){
            foreach($icd9new as $new){
                $table = (object) Mongo::table('tb_ordataicd9')
                ->where("code",$new[0])
                ->where("codeseq",$new[1])
                ->first();

                if($table){
                    $arr['icd9'][$i]['code']       = $table->code;
                    $arr['icd9'][$i]['codeseq']    = $table->codeseq;
                    $arr['icd9'][$i]['descript']   = $table->descript;
                    $arr['icd9'][$i]['gen_desc']   = $table->gen_desc;
                    $arr['icd9'][$i]['acc_code']   = $table->acc_code;
                    $i++;
                    $array['status'] = true;
                }
            }
        }

        if(isset($arr['icd9'])){
            $data = view("case/box/ordata/ordata_icd9select",$arr)->render();       // แปลง .Blade และค่า เป็น text
            echo $data;
        }
    }
    public function load_icd9select($r){
        $tb_case            = Datacase::first($r->cid);
        $icd9               = @$tb_case->icd9operator;
        $i                  = 0;
        $arr                = array();
        $array['status']    = false;
        if(isset($icd9)){
            foreach($icd9 as $data){
                $table = (object) Mongo::table('tb_ordataicd9')
                ->where("code",$data[0])
                ->where("codeseq",$data[1])
                ->first();

                if($table){
                    $arr['icd9'][$i]['code']       = $table->code;
                    $arr['icd9'][$i]['codeseq']    = $table->codeseq;
                    $arr['icd9'][$i]['descript']   = $table->descript;
                    $arr['icd9'][$i]['gen_desc']   = $table->gen_desc;
                    $arr['icd9'][$i]['acc_code']   = $table->acc_code;
                    $i++;
                    $array['status'] = true;
                }
            }
        }
        $arr['cid'] = $r->cid;
        if(isset($arr['icd9'])){
            $data = view("case/box/ordata/ordata_icd9select",$arr)->render();       // แปลง .Blade และค่า เป็น text
            echo $data;
        }
    }


    public function ordata_icd9($r){


        $checknumber = is_numeric($r->search);
        if($checknumber){$row=50;}else{$row=10;}


        $tb_ordataicd9 = (object) Mongo::table('tb_ordataicd9')
        ->where("code"          ,"like","%".$r->search."%")
        ->orwhere("descript"    ,"like","%".$r->search."%")
        ->orwhere("gen_desc"    ,"like","%".$r->search."%")
        ->paginate($row);


        $i                  = 0;
        $arr                = array();
        $array['status']    = false;

        // dd($tb_ordataicd9);

        foreach($tb_ordataicd9 as $data){
            $data = (object) $data;
            $arr['icd9'][$i]['code']       = $data->code;
            $arr['icd9'][$i]['codeseq']    = $data->codeseq;
            $arr['icd9'][$i]['descript']   = $data->descript;
            $arr['icd9'][$i]['gen_desc']   = $data->gen_desc;
            $arr['icd9'][$i]['acc_code']   = $data->acc_code;
            $i++;
            $array['status'] = true;
        }
        $array['data']          = $arr;
        $array['data']['cid']   = $r->cid;
        $arr["cid"] = $r->cid;
        $data = view("case/box/ordata/ordata_icd9",$arr)->render();
        echo $data;
    }



}
