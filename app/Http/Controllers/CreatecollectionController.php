<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mongo;
use DB;

class CreatecollectionController extends Controller
{

    public function index()
    {
        return view('collection');

    }


    public function store(Request $r)
    {
        $text = '{ "_id" : ObjectId("63dc8a453de33c06310e7d32"), "mmm" : "mmm", "fdjsklfj" : "aaaaaaaaaaaaaaa" },
        { "_id" : ObjectId("63edbc624ecc177d1103e422"), "mmm" : "mmm", "fdjsklfj" : "aaaaaaaaaaaaaaa" },
        { "_id" : ObjectId("63edbca94ecc177d1103e425"), "mmm" : "mmm", "fdjsklfj" : "aaaaaaaaaaaaaaa" }';

        $file = $r->file('files');
        if($r->hasfile('files'))
        {
           foreach($r->file('files') as $file)
           {
                $test = file_get_contents($file);
                // dd(to_jsons($test));
                $test = trim(preg_replace('/\s+/', ' ', $test));

                dd(jsonDecode($test),$test);
                $temp = $file->getClientOriginalName();
                $data[] = str_replace('','',$temp);

           }
        }else{
            dd(111);
        }
    }

    public function show($id)
    {
        if($id=="export"){
            return $this->export();
        }
        if($id=="import"){
            return $this->import();
        }
    }


    public function import(){
        // $arr = $this->alltable();
        $test = scandir('D:/mongodb/mongodb/');
        for($i=2;$i<count($test);$i++){
            $host = 'localhost';
            $dbname = 'endoindex';
            $collection = $test[$i];
            $json_file = "D:\\mongodb\\mongodb\\$collection";
            $command = 'mongoimport --host ' . $host . ' --db ' . $dbname . ' --collection ' . $collection . ' --file ' . $json_file;
            dd($command);
            // Run the command
            exec("{$command} 2>&1", $output, $return_var);
        }
    }

    public function export(){
        $arr = $this->alltable();

        foreach($arr as $data){
            $host = '192.168.68.28';
            $dbname = 'endoindex';
            $collection = $data;
            $output_file = "D:\mongodb\\$data.json";

            // Build the mongoexport command
            $command = 'D:\allindex\mongo\mongoexport.exe --host ' . $host . ' --db ' . $dbname . ' --collection ' . $collection . ' --out ' . $output_file;

            // Run the command
            exec("{$command} 2>&1", $output, $return_var);
        }
    }

}
