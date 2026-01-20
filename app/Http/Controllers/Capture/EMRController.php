<?php

namespace App\Http\Controllers\Capture;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\PDFController;

use Image;
use Illuminate\Http\Request;

class EMRController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $r)
    {
        $view['cid'] = "";
        $view['case_list']  = $this->case_list($r);
        $view['case_data']  = $this->case_data($r);
        $view['patient']    = $this->patient($r);
        $view['project'] = configTYPE("admin","project");
        if(isset($r->cid)){
            $view['cid'] = $r->cid;
            $this->case_edit($r->cid);
        }

        return view('capture.emr.index',$view);
    }


    public function store(Request $r)
    {
        if(isset($r->event)){
            if($r->event=="step01")             {$this->step01($r);}
            if($r->event=="step02")             {$this->step02($r);}
            if($r->event=="step03")             {$this->step03($r);}
            if($r->event=="emr_send")           {$this->emr_send($r);}
            if($r->event=="createbilling")      {$this->createbilling($r); return redirect("billhomc?search=&hn=$r->hn&date=$r->date");}
        }
    }


    public function case_edit($cid){
        // $tb_case = DB::table('tb_case')->where('case_id', $cid)->first();
        // $arr = (array) jsonDecode($tb_case->case_json);
        // $arr['case_edit']   = true;
        // $arr['pdfcreate']   = false;
        // $json['case_json'] = jsonEncode($arr);
        // DB::table('tb_case')->where('case_id', $cid)->update($json);
    }





    public function emr_send($r){
        $case           = DB::table('tb_case')->where('id',$r->cid)->first();
        $apppoint       = explode(" ",$case->appointment);
        $folderdate     = $apppoint[0];
        $hn             = $case->case_hn;
        $caseuniq       = $case->caseuniq;
        $date           = date('dmY');
        $doctor         = DB::table('users')->where('uid',$case->case_physicians01)->first();
        $departmentcode = "1214";
        //1889618_21122021_1214_17301
        $newfile    = $hn."_".$date."_".$departmentcode."_".$doctor->user_code.".pdf";
        // $path_ori   = storePATH("$hn\\$folderdate\pdf\\$caseuniq.pdf");

        makedirfull(htdocs("store/$hn/temp"));
        // $pdf_file       = htdocs("store/$hn/temp/$case->caseuniq.pdf");
        // file_put_contents($pdf_file, file_get_contents(url("api/pdf/$r->cid")));
        // copy(url("api/pdf/$r->cid"),$pdf_file);
        // $pdf_content = file_get_contents(url("api/pdf/$r->cid"));
        // file_put_contents($pdf_file, $pdf_content);

        $pdf_content = new PDFController();
        $pdf_content->show($r->cid);

        $path_ori    = htdocs("store/$hn/temp/temp.pdf");

        // file_put_contents(htdocs("store/$hn/temp/temp.pdf"), $content, LOCK_EX);



        $path_emr = configTYPE('path','path_emr');
        $path_copy  = "$path_emr:\\$newfile";
        copy($path_ori,$path_copy);
        copy($path_ori,"d:\\emr\\$newfile");
    }



    public function case_list($r){
        if (isset($r->search)) {
            $val = DB::table('tb_case')
            // ->where('case_json', 'like', "%$r->search%")
            ->where('statusreport',true)
            ->where('appointment','like',date('Y-m-d')."%")
            ->orwhere('case_hn',$r->search)
            ->orderBy('id','desc')
            ->paginate(200);
        } else {
            $val = DB::table('tb_case')
            ->where('statusreport',true)
            ->where('appointment','like',date('Y-m-d')."%")
            ->orderBy('case_id', 'desc')
            ->paginate(200);
        }
        return $val;
    }

    public function case_data($r){
        $val = "";
        if (isset($r->hn)) {
            $val = DB::table('tb_case')
            ->where('case_hn', $r->hn)
            ->where('case_status',2)
            ->where('case_dateappointment','like',$r->date."%")
            ->orderBy('case_id','desc')
            ->paginate(200);
        }
        return $val;
    }

    public function patient($r){
        $val = "";
        if (isset($r->hn)) {
            $val = DB::table('patient')->where('hn',$r->hn)->first();
        }
        return $val;
    }


}
