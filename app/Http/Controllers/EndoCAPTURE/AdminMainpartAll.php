<?php
namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMainpartAll extends Controller
{
    public function __construct(Request $r){checklogin();}




    public function mpproblemedit(Request $r)
    {
        $mainproblem = DB::table('tb_mainproblem')->select('*')->where('mainproblem_id', '=', @$r['mainproblem_id'])->get();
        return view('admin/mainpartproblem', ['mainproblem' => $mainproblem,]);
    }

    public function mpproblemupdate(Request $r)
    {
        DB::table('tb_mainproblem')->where('mainproblem_id', $r['mainproblem_id'])->update(['mainproblem_name'  => $r['mainproblem_name'],]);
        return redirect('admin_mainpartedit/?mainpart_id=' . $r->mainpart_id . '&procedure_code=' . $r->procedure_code);
    }

    public function mpproblemadd(Request $r)
    {
        DB::table('tb_mainproblem')->insert(['mainproblem_name'  => $r['mainproblem_name'], 'mainproblem_mp_id' => $r['mainpart_id'],]);
        return redirect('admin_mainpartedit/?mainpart_id=' . $r->mainpart_id . '&procedure_code=' . $r->procedure_code);
    }


















    public function mainpartsubedit(Request $r){
        $mainpartsub = DB::table('tb_mainpartsub')->select('*')->where('mainpartsub_id', '=', @$r['mainpartsub_id'])->get();
        return view('admin/mainpartsub', ['mainpartsub' => $mainpartsub,]);
    }

    public function mainpartsubupdate(Request $r)
    {
        DB::table('tb_mainpartsub')->where('mainpartsub_id', $r['mainpartsub_id'])->update(['mainpartsub_name'  => $r['mainpartsub_name'],]);
        return redirect('admin_mainpartedit/?mainpart_id=' . $r->mainpart_id . '&procedure_code=' . $r->procedure_code);
    }

    public function mainpartsubadd(Request $r)
    {
        DB::table('tb_mainpartsub')->insert(['mainpartsub_name'  => $r['mainpartsub_name'], 'mainpartsub_mp_id' => $r['mainpart_id'],]);
        return redirect('admin_mainpartedit/?mainpart_id=' . $r->mainpart_id . '&procedure_code=' . $r->procedure_code);
    }



    public function smgledit(Request $r)
    {
        $mainsubgl = DB::table('tb_mainsubgl')->select('*')->where('mainsubgl_id', '=', @$r['mainsubgl_id'])->get();
        return view('admin/smgl', ['mainsubgl' => $mainsubgl,]);
    }

    public function smglupdate(Request $r)
    {
        DB::table('tb_mainsubgl')->where('mainsubgl_id', $r['mainsubgl_id'])->update(['mainsubgl_name'  => $r['mainsubgl_name'],]);
        return redirect('admin_mainpartedit/?mainpart_id=' . $r->mainpart_id . '&procedure_code=' . $r->procedure_code);
    }

    public function smgladd(Request $r)
    {
        DB::table('tb_mainsubgl')->insert(['mainsubgl_name'  => $r['mainsubgl_name'], 'mainsubgl_mp_id' => $r['mainpart_id'],]);
        return redirect('admin_mainpartedit/?mainpart_id=' . $r->mainpart_id . '&procedure_code=' . $r->procedure_code);
    }
}
