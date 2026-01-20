<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Http\Request;

class LiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('EndoCAPTURE.camera.live');
    }

    public function create()
    {

    }

    public function store(Request $r)
    {

    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $r, $id)
    {


    }

    public function destroy($id)
    {
        //
    }







}
