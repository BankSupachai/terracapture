<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SynchronizeController extends Controller
{

    public function index(Request $r){
        $semihttps      = configTYPE("feature","semihttps");
        if($semihttps){
            if(isset($r->hn)){synfilehttps($r->com_name,$r->hn);}
        }else{
            if(isset($r->hn)){synfile($r->com_name,$r->hn);}
        }
    }

    public function store(Request $r)
    {
        $servername = getCONFIG('admin')->server_name;
        $exec       = exec("ping $servername");
        $find_text01= strpos($exec,"loss");
        $find_text02= strpos($exec,"not find");

        if($find_text01 || $find_text02){
            echo "Loss connection";
            exit();
        }

        if(isset($r->event)){
            if($r->event=="pictoserver"){$this->pic2server($r->hn);}
        }else{
            $serverconnect = @fsockopen($servername, portnumber(), $errno, $errstr, 1);
            if($serverconnect){
                $randtext = rand(10000,99999);
                $this->clearRAND();
                $this->tempUPTOserver($randtext);
                $this->tempSERVER   ('tb_case'          ,'case_id'  ,'caseuniq','comcreate','updatetime',$randtext);
                $this->tempSERVERVDO('tb_casevdo'       ,'vdo_id'   ,'caseuniq','comcreate','updatetime',$randtext);
                $this->tempSERVER   ('tb_report'        ,'report_id','caseuniq','comcreate','updatetime',$randtext);
                $this->tempSERVER   ('tb_casemedication','medi_id'  ,'caseuniq','comcreate','updatetime',$randtext);
                $this->tempDOWN     ('tb_case'          ,'case_id'  ,$randtext,false);
                $this->tempDOWN     ('tb_casemedication','medi_id'  ,$randtext,true);
                sameMASTERDATA();
                $this->vdo2server();
            }
        }
    }


    public function pic2server($hn){
        $app_name   = app_name();
        $portnumber = portnumber();
        connectweb("http://endocapture:$portnumber/$app_name/synchronize?com_name=".getCONFIG('admin')->com_name."&hn=".$hn);
    }

    public function vdo2server(){
        $app_name   = app_name();
        $portnumber = portnumber();
        connectweb("http://endocapture:$portnumber/$app_name/synchronize?vdo=have");
    }

}
