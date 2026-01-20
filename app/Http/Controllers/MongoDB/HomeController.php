<?php

namespace App\Http\Controllers\MongoDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;

class HomeController extends Controller
{
    public function index(){
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            $data[]    = $collection['name'] ;
        }
        asort($data);
        $view['alltable'] = $data;
        return view('mongodb.home.index',$view);
    }


}
