<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Datacase;
use App\Models\Casebooking;
use App\Models\Holiday;
use App\Models\Department;
use App\Models\Mongo;
use Exception;


class AppointmentController extends Controller
{

//   !!!!! โปรดอ่านก่อนทำ อันนี้เป็นเพียง Controller สำหรับ Mockup Book เท่านั้นนะ




    public function index(Request $r)
    {

        $view['procedure']          = Department::procedure(uid());
        // dd($view);
        return view('EndoINDEX.mockupbook.index', $view);
    }



    public function create(Request $r)
    {

    }

    public function store(Request $r)
    {
        // $val['day'] = $r->day;

        // dd($r->day);
        if (isset($r->day)){
            // $val['date'] = $r->date;
           $dent =  adddate(date('Y-m-d'), $r->day);
           dd($dent);
        }

        $val['date'] = $r->date;
        $val['hn'] = $r->hn;
        $val['name'] = $r->name;
        $val['doctor'] = $r->doctor;

        Mongo::table('mockup_appoint')->insert($r->input());


    }





    public function show($id)
    {

    }


}
