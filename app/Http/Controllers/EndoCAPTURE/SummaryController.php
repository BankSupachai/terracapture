<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use DB;
use Image;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $r)
    {




        return view('endocapture.summary.index');
        // return view('endocapture.crop.index');
    }


    public function create()
    {

    }


    public function store(Request $r)
    {


        if(!isset($r->user)){
            return redirect('exportindex');
        }


        if($r->event=="show_one_person"){
            $view['procedure'] = $r->procedure;
            $view['user'] = $r->user;
            $view['year'] = $r->year;
            return view('endocapture.summary.show',$view);
        }




    }

    public function show($id)
    {
        $view['id'] = $id;
        return view('endocapture.summary.show',$view);
    }

    public function edit($id)
    {

    }


    public function update(Request $r, $id)
    {

    }


    public function destroy($id)
    {

    }

}
