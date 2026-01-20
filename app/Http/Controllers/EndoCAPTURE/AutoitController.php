<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutoitController extends Controller
{

    public function index(Request $r)
    {
        $project    = app_name();
        $run        = "D:\python\\visualcode_open\__pycache__\call_vscode_step01.cpython-310.pyc $project $r->path";
        $exe        = exec($run);
        return redirect()->back()->with('success', 'your message,here');
    }

}
