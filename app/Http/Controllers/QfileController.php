<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qfile;
class QfileController extends Controller
{
    public function index(Request $r){

        $view["qfile"] = Qfile::all();
        return view('endocapture.home.index', $view);
    }
}
