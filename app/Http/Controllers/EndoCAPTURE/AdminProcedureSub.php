<?php

namespace App\Http\Controllers\Endocapture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminProcedureSub extends Controller
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
        $this->validate($request, []);
        $users = new User;
        $users->name      = $request->firstname;
        $users->email     = $request->email;
        $users->password  = Hash::make('$request->password');
        $users->save();

        return redirect('user');
    }


    public function show($id)
    {
        $users    = DB::table('users')->where('id', $id)->get();
        return view('endo.useredit', ['users' => $users,]);
    }


    public function edit($id)
    {
        $id = $request->input('id');
        $patient = DB::table('patient')->where('id', 'like', '%' . $id . '%')->paginate(1);
        return view('endo.procedure', ['patient' => $patient]);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, []);
        $password  = Hash::make($request->password);
        return redirect('user');
    }

    public function proceduresubedit(Request $r)
    {
        $procedure_sub = DB::table('tb_procedure_sub')
            ->select('*')
            ->where('psub_id', '=', @$r['psub_id'])->paginate(10);

        return view('admin/proceduresubedit', [
            'procedure_sub' => $procedure_sub,
        ]);
    }


    public function proceduresubadd(Request $r)
    {
        DB::table('tb_procedure_sub')->insert([
            'psub_name'           => $r['psub_name'],
            'psub_procedure_code' => $r['procedure_code'],
        ]);
        return redirect('admin/procedure/' . $r->procedure_code . '/?procedure_code=' . $r->procedure_code);
    }



    public function proceduresubupdate(Request $r)
    {
        DB::table('tb_procedure_sub')
            ->where('psub_id', $r['psub_id'])
            ->update([
                'psub_name'  => $r['psub_name'],
            ]);
        return redirect('admin/procedure/' . $r->procedure_code . '/?procedure_code=' . $r->procedure_code);
    }
}
