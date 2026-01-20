<?php
namespace App\Http\Controllers\capture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\fileExists;
use App\Models\Mongo;

class LoadPic2ServerController  extends Controller
{

    // public function __construct(Request $r){checklogin();}

    public function show($id,Request $r)
    {
        $view['cid'] = $id;
        $tb_case = Mongo::table('tb_case')->where('id',$id)->first();
        $tb_case = (object) $tb_case;


        autocrop($id,$tb_case->case_hn);
        createTEMP('tb_case',$tb_case->caseuniq,$tb_case->comcreate,date("ymdHis"));
        fastsemi($id);

        if(isset($r->newcase)){
            $this->copyuser($id,$r->newcase);
            return redirect(url("capture/$r->newcase"));
        }else{
            return redirect(url("capture/$id"));
        }
    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=="aaa"){$this->aaa($r);return redirect(url("procedure/$r->cid"));}
        }
    }

    public function aaa($r){

    }

    public function copyuser($old,$new){
        $case_old       = (object) Mongo::table('tb_case')->where("id",$old)->first();
        $case_new       = (object) Mongo::table('tb_case')->where("id",$new)->first();
        $uic_new        = isset($case_new->user_in_case) ? $case_new->user_in_case : [];
        $uic_old        = isset($case_old->user_in_case) ? $case_old->user_in_case : [];
        $diff           = false;
        $new_arr        = [];

        if(@$uic_new==null||$uic_new==[]){
            $diff=true;
            $new_arr['user_in_case'] = $uic_old;
        }

        if($case_old->hn==$case_new->hn){
            $diff=true;
            $new_arr['time_patientin']  = isset($case_old->time_patientin)?$case_old->time_patientin:"";
            // $new_arr['time_start']      = isset($case_old->time_start)?$case_old->time_start:"";
        }

        if($diff){
            Mongo::table('tb_case')->where("id",$new)->update($new_arr);
        }
    }

}
