<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AdminMainpart extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $r)
    {

        $procedure_sub = DB::table('tb_procedure_sub')
            ->select('*')
            ->paginate(10);
        return view('admin/procedure_sub', ['procedure_sub' => $procedure_sub]);
    }


    public function create()
    {
        return view('endo.procedure');
    }


    public function store(Request $request)
    {
        $this->validate($request, [

        ]);
        $users           = new User;
        $users->name     = $request->firstname;
        $users->email    = $request->email;
        $users->password = Hash::make('$request->password');
        $users->save();

        return redirect('user');
    }


    public function show($id)
    {
        $users = DB::table('users')->where('id', $id)->get();
        return view('endo.useredit', ['users' => $users]);
    }


    public function edit($id)
    {
        $id      = $request->input('id');
        $patient = DB::table('patient')->where('id', 'like', '%' . $id . '%')->paginate(1);
        return view('endo.procedure', ['patient' => $patient]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, []);
        $password = Hash::make($request->password);
        return redirect('user');
    }

    public function mainpartedit(Request $r)
    {

        $mainpart = DB::table('tb_mainpart')
            ->select('*')
            ->where('mainpart_id', '=', @$r['mainpart_id'])->get();

        $mainproblem = DB::table('tb_mainproblem')->select('*')
            ->where('mainproblem_mp_id', '=', @$r['mainpart_id'])->get();

        $mainpartsub = DB::table('tb_mainpartsub')->select('*')
            ->where('mainpartsub_mp_id', '=', @$r['mainpart_id'])->get();

        $mainsubgl = DB::table('tb_mainsubgl')->select('*')
            ->where('mainsubgl_mp_id', '=', @$r['mainpart_id'])->get();

        return view('admin/mainpartedit', [
            'mainpart'    => $mainpart,
            'mainproblem' => $mainproblem,
            'mainpartsub' => $mainpartsub,
            'mainsubgl'   => $mainsubgl,
        ]);
    }

    public function mainpartupdate(Request $r)
    {
        DB::table('tb_mainpart')
            ->where('mainpart_id', $r['mainpart_id'])
            ->update(['mainpart_name' => $r['mainpart_name']]);
        return redirect('admin/procedure/' . $r->procedure_code . '/?procedure_code=' . $r->procedure_code);
    }

    public function mainpartadd(Request $r)
    {
        DB::table('tb_mainpart')->insert([
            'mainpart_name'         => $r['mainpart_name'],
            'mainpart_procedure_code' => $r['procedure_code'],
        ]);
        return redirect('admin/procedure/' . $r->procedure_code . '/?procedure_code=' . $r->procedure_code);
    }

}
