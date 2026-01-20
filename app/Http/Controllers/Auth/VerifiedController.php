<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Server;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class VerifiedController extends Controller
{



    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            return $this->$event($r);
        }
    }

    public function redirect_to_google($r){

    }
    

    public function index(){
        // return view('auth.verify.index');
        dd('verify for user');
    }

    public function show($id, Request $r){

    }


}