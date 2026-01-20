<?php
namespace App\Http\Controllers\Capture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use function PHPUnit\Framework\fileExists;
use App\Models\Mongo;

class LoadPicController  extends Controller
{

    // public function __construct(Request $r){checklogin();}

    public function show($id,Request $r)
    {
        $view['cid'] = $id;
        return view('capture/reportendocapture.loadpic',$view);
    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=="procedure_pic_change"){$this->procedure_pic_change($r);return redirect(url("procedure/$r->cid"));}
        }
    }

    public function procedure_pic_change($r){
        $tb_case    = (object) Mongo::table('tb_case')->where('_id',$r->cid)->first();
        $uniqpic    = htdocs("store\\$tb_case->case_hn\\$tb_case->caseuniq.jpg");
        if(fileExists($uniqpic)){unlink($uniqpic);}

        $procedure_picori           = exfolder("config/procedure/$r->photoname");
        $folder_hnpath              = exfolder("store/$tb_case->case_hn/");
        $view['procedure_piccopy']  = $folder_hnpath.$tb_case->caseuniq.".jpg";
        makedirfull($folder_hnpath);
        if(!file_exists($view['procedure_piccopy'])){copy($procedure_picori,$view['procedure_piccopy']);}
    }


}
