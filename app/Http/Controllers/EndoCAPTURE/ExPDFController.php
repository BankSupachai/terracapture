<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class ExPDFController extends Controller
{

    public function index(Request $r)
    {


        $comname = getCONFIG('admin')->com_name;

        if($comname=="endocapture"){
            if (isset($r->search)) {
                $view['case'] = DB::table('tb_case')
                    ->where('case_json', 'like', '%' . $r->search . '%')
                    ->where('case_status','!=',90)
                    ->orwhere('case_hn', 'like', '%' . $r->search . '%')
                    ->orderBy('case_id', 'desc')
                    ->paginate(50);
            } else {
                $view['case'] = DB::table('tb_case')
                ->where('case_status','!=',90)
                    ->orderBy('case_id', 'desc')
                    ->paginate(50);
            }

            $view['endosmart'] =  DB::table('tb_endosmart')
                ->where('PT_NAME', 'like', '%' . $r->search . '%')
                ->orwhere('PT_SURNAME', 'like', '%' . $r->search . '%')
                ->orwhere('HN_ID', 'like', '%' . $r->search . '%')
                ->orderBy('case_id', 'desc')
                ->paginate(50);

            // $view['endosmart'] = null;
            $view['doctor']     = DB::table('users')->where([['user_type', '=', 'doctor']])->get();
            $view['procedure']  = DB::table('tb_procedure')->get();

            $str    = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
            $view['config']     = jsonDecode($str);

            return view('endo.expdf', $view);
        }

        $serverconnect = @fsockopen(getCONFIG('admin')->server_name, portnumber(), $errno, $errstr, 1);
        if($serverconnect){
            $view['portnumber'] = portnumber();
            return view('endo.expdfserver',$view);
        }else{
            return view('endocapture.iframe/export_excell');
        }
    }



    public function show($id,Request $r)
    {
        if (isset($r->search)) {
            $view['case'] = DB::table('tb_case')
                ->where('case_json', 'like', '%' . $r->search . '%')
                ->where('case_status','!=',90)
                ->orwhere('case_hn', 'like', '%' . $r->search . '%')
                ->orderBy('case_id', 'desc')
                ->paginate(50);
        } else {
            $view['case'] = DB::table('tb_case')
            ->where('case_status','!=',90)
                ->orderBy('case_id', 'desc')
                ->paginate(50);
        }

        $view['endosmart'] =  DB::table('tb_endosmart')
            ->where('PT_NAME', 'like', '%' . $r->search . '%')
            ->orwhere('PT_SURNAME', 'like', '%' . $r->search . '%')
            ->orwhere('HN_ID', 'like', '%' . $r->search . '%')
            ->orderBy('case_id', 'desc')
            ->paginate(50);

        $view['doctor']     = DB::table('users')->where([['user_type', '=', 'doctor']])->get();
        $view['procedure']  = DB::table('tb_procedure')->get();
        $str                = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        $view['config']     = jsonDecode($str);

        return view('endo.expdf_unmenu',$view);
    }


    public function create()
    {
        return view('admin/procedureedit');
    }


    public function store(Request $r)
    {
        $val['procedure_name']  = $r->procedure_name;
        $val['procedure_scope'] = $r->procedure_scope;
        $val['procedure_color'] = $r->procedure_color;

        if ($r->hasFile('file')) {
            $image           = $r->file('file');
            $name            = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $name);
            $image           = $r->file('file');
            $name            = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $name);
            $val['procedure_pic'] = $name;
        }

        DB::table('tb_procedure')->insert($val);

        $procedure = DB::table('tb_procedure')->select('*')->paginate(10);
        return view('admin/procedure', ['procedure' => $procedure]);
    }



    public function edit($id)
    {
    }

    public function update(Request $r, $id)
    {
        if (Input::hasFile('file')) {
            $image      = Input::file('file');
            $name            = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/');
            $image->move($destinationPath, $name);
            DB::table('tb_procedure')->where('procedure_code', $id)->update(['procedure_pic' => $name]);
        }




        DB::table('tb_procedure')
            ->where('procedure_code', $id)
            ->update([
                'procedure_name'  => $r['procedure_name'],
                'procedure_scope' => $r['procedure_scope'],
                'procedure_color' => $r['procedure_color'],
            ]);

        $procedure = DB::table('tb_procedure')
            ->select('*')
            ->paginate(10);
        return view('admin/procedure', ['procedure' => $procedure]);
    }

    public function destroy($id)
    {
        //
    }

    public function procedureupdate(Request $r)
    {

        // $this->validate($r, ['file' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:20480',]);

    }


    public function addicd10(Request $r){}
}
