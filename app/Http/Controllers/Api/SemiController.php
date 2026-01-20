<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo;
use App\Models\Server;
use Illuminate\Support\Facades\DB;

class SemiController extends Controller
{

    public function index()
    {
        $this->checktempin("test");
    }

    public function store(Request $r){
        switch ($r->event) {
            case 'checktempin'          :$this->checktempin($r);
            case 'comparemasterdata'    :$this->comparemasterdata($r);
        }
    }

    public function comparemasterdata($r){
        $admin      = getCONFIG("admin");
        $comname    = $admin->com_name;
        if(Server::check_connection()){return null;}

        $tb_semimasterdata = Server::table("tb_semimasterdata")->where("client",$comname)->get();
        foreach($tb_semimasterdata as $data){
            $data = (array) $data;
            $table  = $data['table'];
            if($table=="users")                 {$this->compartrecord($table,$comname,"id");}
            if($table=="tb_room")               {$this->compartrecord($table,$comname,"room_id");}
            if($table=="tb_procedure")          {$this->compartrecord($table,$comname,"code");}
            if($table=="tb_scope")              {$this->compartrecord($table,$comname,"scope_id");}
            if($table=="tb_doccat")             {$this->compartrecord($table,$comname,"doccat");}
            if($table=="tb_worklistfindtext")   {$this->compartrecord($table,$comname,"text_find");}
        }
        $this->compartrecord("tb_department",$comname,"department_id");
    }


    public function compartrecord($table,$comname,$primary){
        $master     = Server::table($table)->get();
        foreach($master as $data){
            $data = (array) $data;
            $local  = (array) Mongo::table($table)->where($primary,$data[$primary])->first();
            if(isset($local[$primary])){
                unset($data['_id']);
                unset($data['id']);
                Mongo::table($table)->where($primary,$local[$primary])->update($data);
            }else{
                Mongo::table($table)->insert($data);
            }
        }
        if($table!="tb_department"){
            $w[] = array("client",$comname);
            $w[] = array("table",$table);
            Server::table("tb_semimasterdata")->where($w)->delete();
        }

    }






    public function checktempin($r){
        $temps = (object) Mongo::table("tb_casetempin")->orderby("updatetime","desc")->get();
        $i = 1;
        foreach ($temps as $temp){
            $temp = (object) $temp;
            $w[0] = array("caseuniq",@$temp->caseuniq);
            $w[1] = array("comcreate",@$temp->comcreate);
            $case = (object) Mongo::table("tb_case")->where($w)->orderByDesc('id')->first();
            unset($temp->id);
            unset($temp->tb_case["id"]);
            unset($temp->tb_casemedication["id"]);
            if(isset($case->id)){
                $inttemp    = (int) $temp->updatetime;
                $intcase    = (int) $case->updatetime;
                if($inttemp > $intcase){
                    if(isset($temp->tb_case)){Mongo::table("tb_case")->where($w)->update($temp->tb_case);}
                    if(isset($case->tb_casemedication)){Mongo::table("tb_casemedication")->where($w)->update($temp->tb_casemedication);}
                }
            }else{
                if(isset($temp->tb_case)){Mongo::table("tb_case")->insert($temp->tb_case);}
                if(isset($temp->tb_casemedication)){Mongo::table("tb_casemedication")->insert($temp->tb_casemedication);}
            }
            Mongo::table("tb_casetempin")->where($w)->delete();
            echo $i." ";
            $i++;
        }
    }


}
