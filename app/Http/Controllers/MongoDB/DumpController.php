<?php

namespace App\Http\Controllers\MongoDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;

class DumpController extends Controller
{

    private $host   = "localhost";
    private $dbname = "endoindex";

    public function index(){
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            $data[]    = $collection['name'] ;
        }
        asort($data);
        $view['alltable'] = $data;
        return view('mongodb.home.index',$view);
    }

    public function show($id){
        switch($id){
            case "export"     :   $this->export();    break;
            case "import"     :   $this->import();    break;
        }
    }


    private function export(){
        $date = date('YmdHi');
        $foldername = "D:\mongodb\\export$date";
        // dd($date);
        makedirfull($foldername);
        $alltable = $this->alltable();
        foreach($alltable as $collection){
            $output_file = "$foldername\\$collection.json";
            $command = 'D:\allindex\mongo\mongoexport.exe --host ' . $this->host . ' --db ' . $this->dbname . ' --collection ' . $collection . ' --out ' . $output_file;
            exec("{$command} 2>&1", $output, $return_var);
        }
    }

    public function import(){
        $test = scandir('D:/mongodb/import/');
        for($i=2;$i<count($test);$i++){
            $collection = $test[$i];
			$ex = explode(".json",$collection);
            $json_file = "D:\\mongodb\\import\\$collection";
            $command = 'D:\allindex\mongo\mongoimport.exe --host ' . $this->host . ' --db ' . $this->dbname . ' --collection ' . $ex[0] . ' --file ' . $json_file;
            exec("{$command} 2>&1", $output, $return_var);
        }
    }


    public function alltable(){
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            $data[]    = $collection['name'] ;
        }
        asort($data);
        return $data;
    }








}
