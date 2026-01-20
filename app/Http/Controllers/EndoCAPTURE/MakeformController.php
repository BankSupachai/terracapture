<?php

namespace App\Http\Controllers\Endocapture;

use Illuminate\Http\Request;
use Exception;
use DB;

class MakeformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('endocapture.home6.makeform.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('endocapture.home6.makeform.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // $data = jsonEncode($r->form_data);
        // $data = $r->form_data;
        // return $data;


        try {
            $base_path = base_path();
            $file_s = date('Ymdhis');
            $file_name = $file_s.'.blade.php';
            $blade_file = fopen("$base_path/resources/views/from/$file_name", "w");
            $text = "   @extends('layouts.main')
                        @section('title', 'Make')
                        @section('style')
                        @endsection
                        @section('modal')
                        @section('tab')
                        @endsection
                        @section('content')
                        <div class='row m-0'><div class='col-12'><div class='card'><div class='card-body'>".
                        $r->form_data
                        ."
                        </div></div></div></div>
                        @endsection
                        @section('script')
                        @endsection"
            ;
            fwrite($blade_file, $text);
            fclose($blade_file);
            $data['form_json'] = "";
            $data['form_file'] = $file_s;
            DB::table('form')->insert($data);
        } catch(\Throwable $e) {
            dd('something wrong', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view = DB::table('form')->where('form_id',$id)->first();
        // dd($view->form_file);
        // dd($v);
        return view("from.$view->form_file");

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
}
