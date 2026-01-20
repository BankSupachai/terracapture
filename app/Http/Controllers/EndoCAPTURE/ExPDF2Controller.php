<?php

namespace App\Http\Controllers\EndoCAPTURE;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\Department;

class ExPDF2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {

        $comname = getCONFIG('admin')->com_name;
        $view['month_all']  = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $view['year_all']   = yearALL();
        $view['filter_procedure'] = Department::procedure(uid());
        if($comname=="Mors"){
            if (isset($r->search)) {
                $w[0] = array('case_status','!=',90);
                $w[1] = array('case_physicians01',$r->search_doctor);
                $w[2] = array('case_procedurecode',$r->search_procedure);

                $view['search_doctor'] = $r->search_doctor;
                $view['search_procedure'] = $r->search_procedure;
                $view['search_month'] = $r->search_month;
                $view['search_year'] = $r->search_year;

                $view['case'] = DB::table('tb_case')
                    // ->where('case_json', 'like', '%' . $r->search . '%')
                    ->where($w)
                    ->whereMonth('case_dateregister',$r->search_month)
                    ->whereYear('case_dateregister',$r->search_year)
                    ->orderBy('case_id', 'desc')
                    ->get();
            } else {
                $view['case'] = DB::table('tb_case')
                ->where('case_status','!=',90)
                    ->orderBy('case_id', 'desc')
                    ->get();
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
            $view['config']     = $str;
            return view('endo.expdf2', $view);
        }

        $serverconnect = @fsockopen(getCONFIG('admin')->server_name, portnumber(), $errno, $errstr, 1);
        if($serverconnect){
            $view['portnumber'] = portnumber();
            return view('endo.expdfserver',$view);
        }else{
            return view('endocapture.iframe/export_excell');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function yearALL(){
        $year_start = intval(getCONFIG('admin')->year_install);
        $year_end   = date('Y');
        for($i=$year_start;$i<=$year_end;$i++){
            $year_all[] = $i;
        }
        return $year_all;
    }
}
