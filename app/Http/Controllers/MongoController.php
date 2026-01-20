<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;


class MongoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $i=0;
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            // dd($collection['name']);
            $data['mongo'][$i]    = $collection['name'] ;
            // $datas     = Mongo::table($collection['name'])->get();
            // $x = 0;
            // foreach ($datas as $key => $value) {
            //     foreach ($value as $k => $v) {
            //         $data['data'][$i][$x][$k] = $v;
            //     }
            //     $x++;
            // }
            $i++;
        }




        // $test = array_keys($mongo);
        return view('mongo.index',$data);
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
    public function store(Request $r)
    {
        $host = 'localhost';
        $dbname = 'endoindex';
        $collection = $r->collection;
        if($r->event=='import'){
            $file = $r->file('file')->getRealPath();
            // dd($file);
            $command = 'D:\allindex\mongo\mongoimport.exe --host ' . $host . ' --db ' . $dbname . ' --collection ' . $collection . ' --file ' . $file;
            exec("{$command} 2>&1", $output, $return_var);
            return redirect()->back();
        }else if($r->event=='export'){
            $date = date('Ymd');
            $output_file = "D:\mongodb\\$date\\$collection.json";
            $command = 'D:\allindex\mongo\mongoexport.exe --host ' . $host . ' --db ' . $dbname . ' --collection ' . $collection . ' --out ' . $output_file;
            exec("{$command} 2>&1", $output, $return_var);
            return redirect()->back();
        }else if($r->event=='clear'){
            Mongo::table($collection)->delete();
            return redirect()->back();
        } else if($r->event=="clear_all"){
            Mongo::table($r->collection)->delete();
            return redirect()->back();
        }
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
        switch($id){
            case "export"     :   $this->export();    break;
            case "import"     :   $this->import();    break;
        }
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

    private function export(){
        $alltable = $this->alltable();
        foreach($alltable as $data){
            $host = 'localhost';
            $dbname = 'endoindex';
            $collection = $data;
            $output_file = "D:\mongodb\\export\\$data.json";
            $command = 'D:\allindex\mongo\mongoexport.exe --host ' . $host . ' --db ' . $dbname . ' --collection ' . $collection . ' --out ' . $output_file;
            exec("{$command} 2>&1", $output, $return_var);
        }
        return 'success';
    }

    public function import(){
        $test = scandir('D:/mongodb/export/');
        for($i=2;$i<count($test);$i++){
            $host = 'localhost';
            $dbname = 'endoindex';
            $collection = $test[$i];
			$ex = explode(".json",$collection);
            $json_file = "D:\\mongodb\\export\\$collection";
            $command = 'D:\allindex\mongo\mongoimport.exe --host ' . $host . ' --db ' . $dbname . ' --collection ' . $ex[0] . ' --file ' . $json_file;
            exec("{$command} 2>&1", $output, $return_var);
        }
        return 'success';
    }


    public function alltable(){
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            $data[]    = $collection['name'] ;
        }
        asort($data);
        return $data;
    }
}
