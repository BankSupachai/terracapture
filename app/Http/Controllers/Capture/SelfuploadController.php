<?php
namespace App\Http\Controllers\capture;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Mongo;
use Illuminate\Http\Request;

class SelfuploadController extends Controller
{
    public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {

        $view['aaa']      = "";
        $view['scopes']   = Department::scope(uid());
        $view['hn']       = @$r->hn;
        $view['case_id']  = @$r->case_id;
        $case             = (object) Mongo::table('tb_case')->where('id', $r->case_id)->first();
        $view['caseuniq'] = @$case->caseuniq;
        return view('capture.selfupload.newindex', $view);
    }

    // public function store(Request $r)
    // {
    //     if ($r->hasFile('files')) {
    //         $images = $r->file('files');
    //         foreach ($images as $img) {
    //             $millisec   = gettimeofday()['usec'];
    //             $sec        = date("s");
    //             $name       = $r->case_id . "_1_" . date("Y_m_d_h_i") . "_" . $sec . "_" . $millisec . "." . $img->getClientOriginalExtension();
    //             $destinationPath    = htdocs('ScreenRecord');
    //             $img->move($destinationPath, $name);
    //             // sleep(1);
    //             $path = "$destinationPath\\$name";
    //             $size = file_exists($path) ? filesize($path) : 0;
    //             Photo::logphoto($name, 'photoincase', $size);
    //         }
    //     }
    // }

    public function store(Request $r){
        switch($r->event){
            // case "upload_photo"         : $this->upload_photo($r);          break;
        }
    }








}
