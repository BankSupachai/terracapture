<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Models\Department;

class MonitorController extends Controller
{
    public function __construct()
    {$this->middleware('auth');}

    public function index(Request $r)
    {
        $view['nurse']          = department::user('nurse');
        $view['register']       = department::user('register');
        $view['nurse_room']     = department::room(uid());
        $view['ready']          = department::room(uid());

        $from   = Carbon::now()->format('Y-m-d');
        $to     = Carbon::now()->format('Y-m-d');
        $view['tb_case'] = DB::table('tb_case')
        ->leftjoin('patient'        ,'tb_case.case_hn'       ,'patient.hn')
        ->leftjoin('users'          ,'tb_case.case_physicians01','users.id')
        ->leftjoin('tb_procedure'   ,'tb_case.case_procedurecode'   ,'tb_procedure.procedure_code')
        ->where('case_dateappointment','like',$from.'%')
        ->orderby('case_roomsort','asc')
        ->get();
        $view['tb_procedure'] = Department::procedure(uid());
        $view['datenow'] = Carbon::now()->format('Y-m-d');
        return view('endo.monitor', $view);
    }



    public function roomedit(Request $r)
    {
        $room = DB::table('tb_room')
            ->select('*')
            ->where('id', '=', @$r->id)->get();
        return view('admin/roomedit', [
            'room' => $room,
        ]);
    }

    public function roomadd(Request $r)
    {
        DB::table('tb_room')->insert(['name' => $r->room_name]);

        $room = DB::table('tb_room')->select('*')->paginate(10);
        return view('admin/room', ['room' => $room]);
    }

    public function roomupdate(Request $r)
    {
        DB::table('tb_room')->where('id', $r->room_id)->update(['name' => $r->room_name]);
        $room = DB::table('tb_room')->select('*')->paginate(10);
        return view('admin/room', ['room' => $room]);
    }
}
