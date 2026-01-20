<?php
namespace App\Http\Controllers\Endocapture;
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
        $case             = (object) Mongo::table('tb_case')->where('_id', $r->case_id)->first();
        $view['caseuniq'] = @$case->caseuniq;
        return view('endocapture.selfupload.newindex', $view);
    }
}
